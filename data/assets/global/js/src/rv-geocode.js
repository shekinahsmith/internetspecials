;(function( $, window, document, undefined ) {
	'use strict';

	// Create the defaults once
	var pluginKey = 'geocode';
	var pluginName = 'rv_geocode';

	// default settings
	var defaults = {
		cookieName: 'rv_geolocated',
		hailoEventName: 'gelocated', // mispelled 'on purpose' to differentiate from old events in hailo/SSAS
		serverApiKey: 'AIzaSyB4hZCoFaB6xFj5hMJfRKqgpN84lNG3W80', //Changed to server side key!
		keys: {
			single: 'geolocation',
			formatted: 'geolocation-formatted'
		},
		positionOptions: { // https://developer.mozilla.org/en-US/docs/Web/API/PositionOptions
			enableHighAccuracy: false, // a Boolean that indicates the application would like to receive the best possible results; default: false
			maximumAge: 300000, // the maximum age (ms) of a possible cached position that is acceptable to return; default: 5 mins
			timeout: 3000 // the maximum length of time (ms) the device is allowed to take in order to return a position; default: 3 secs
		},
		runServicability: true, // save/sync location with rope ('false' will still run the reverse geocode and fire google/hailo click events, but not run through Rope/serviceability)
		// event callbacks
		onDone: $.noop, // callback to do when geolocation succeeds
		onFail: $.noop, // callback to do when geolocation fails
		onAlways: $.noop // callback to do regardless of geolocation outcome
	};

	// Create `$.rv` namespace if it doesn't exist
	$.rv = $.rv || {};

	// The actual plugin constructor
	var Plugin = $.rv[pluginKey] = function( element, options ) {
		this.element = element;
		this.options = $.extend(true, {}, defaults, options);
		// store references to the default config and plugin name
		this._defaults = defaults;
		this._name = pluginName;
		// "commands"
		this.run = this.runCommand;
		// initialize the plugin instance
		this.init();
	};

	// Other plugin methods
	Plugin.prototype = {

		init: function() {
			var cookie, dfd, onAlways, onDone, onFail, updateLocation;

			cookie = this.checkStatus();

			if ($(this.element).length > 0) {
				if (cookie) {
					onAlways = this.options.onAlways.bind(this);
					onDone = this.options.onDone.bind(this);
					onFail = this.options.onFail.bind(this);
					updateLocation = this.updateLocation.bind(this);

					dfd = $.Deferred();
					dfd.done([updateLocation, onDone]).fail(onFail).always(onAlways);

					if ('status' in cookie && cookie.status.toUpperCase() === 'OK') {
						dfd.resolveWith(cookie);
					} else {
						dfd.rejectWith(cookie);
					}
				} else {
					this.getCurrentPosition();
				}
			}
		},

		runCommand: function( command, params ) {
			if (this.hasOwnProperty(command)) {
				this[command](params);
			}
		},

		getCurrentPosition: function() {
			var handleError, positionOptions, showPosition;

			showPosition = this.showPosition.bind(this);
			handleError = this.handleError.bind(this);
			positionOptions = this.options.positionOptions;

			navigator.geolocation.getCurrentPosition(showPosition, handleError, positionOptions);
		},

		checkStatus: function( name ) {
			if (!name) {
				return;
			}
			if (cached_address) {
				return $.parseJSON(address);
			} else {
				return false;
			}
		},

		showPosition: function( position ) {
			var coords, handleError, onAlways, onDone, onFail, saveStatus, updateLocation;

			if (!position) {
				return false;
			}

			coords = [];
			coords.push($.trim(position.coords.latitude));
			coords.push($.trim(position.coords.longitude));

			onAlways = this.options.onAlways.bind(this);
			onDone = this.options.onDone.bind(this);
			onFail = this.options.onFail.bind(this);
			saveStatus = this.saveStatus.bind(this);
			updateLocation = this.updateLocation.bind(this);

			_getLocation(this.options.serverApiKey, coords)
				// save the status to cookie and do event tracking, or handle failed lookup first
				.then(saveStatus, onFail)
					// if resolved, continue on to update DOM and custom callbacks
					.done([updateLocation, onDone])
					.always(onAlways);
		},

		saveStatus: function( data ) {
			var address, defer, results;

			address = {};
			defer = $.Deferred();
			results = data.results;

			if (results.length > 0) {

				// Parse the data returned by Google Maps API
				$.each(results, function( index, result ) {

					if (!address.formatted_address && result.formatted_address) {
						address.formatted_address = result.formatted_address;
					}

					$.each(result.address_components, function(index, component) {
						if (!address.street_number && $.inArray('street_number', component.types) > -1) {
							address.street_number = $.trim(component.short_name);
						}
						if (!address.route && $.inArray('route', component.types) > -1) {
							address.route = $.trim(component.short_name);
							address.route_long = $.trim(component.long_name);
						}
						if (!address.city && $.inArray('locality', component.types) > -1 && $.inArray('political', component.types) > -1) {
							address.city = $.trim(component.short_name);
							address.city_long = $.trim(component.long_name);
						}
						if (!address.state && $.inArray('administrative_area_level_1', component.types) > -1 && $.inArray('political', component.types) > -1) {
							address.state = $.trim(component.short_name);
							address.state_long = $.trim(component.long_name);
						}
						if (!address.postal_code && $.inArray('postal_code', component.types) > -1) {
							address.postal_code = $.trim(component.long_name).substr(0, 5);
						}
					});

					if (address.route) {
						address.street_address = $.trim([address.street_number, address.route].join(' '));
					}

				});

				data.rv_address_data = $.extend(true, {}, address);
			}

			// set the cookie for faster retrieval during session
			_setCookie(this.options.cookieName, JSON.stringify(data));

			if ('status' in data && data.status.toUpperCase() === 'OK') {
				// save hailo event
				_doHailo(this.options.hailoEventName, { 'location': address.formatted_address });

				// save serviceability?
				if (this.options.runServicability) {
					_doServiceability(address.formatted_address, address.postal_code);
				}

				// trigger custom event on body so we can bind callbacks
				$('body').trigger('locationFound');
			}

			return defer.resolve(data);
		},

		handleError: function( error ) {
			// handle errors (?)
			this.options.onFail.call(this);

			switch(error.code) {
				case 1: // 'PERMISSION_DENIED'
					console.warn('User denied the request for Geolocation.');
					// save the error status to cookie
					this.saveStatus.call(this, error);
					break;
				case 2: // 'POSITION_UNAVAILABLE'
					console.warn('Location information is unavailable.');
					_deleteCookie(this.options.cookieName);
					break;
				case 3: // 'TIMEOUT'
					console.warn('The request to get user location timed out.');
					_deleteCookie(this.options.cookieName);
					break;
				default: // unknown error
					console.warn(error.message);
					_deleteCookie(this.options.cookieName);
			}
		},

		updateLocation: function( data ) {
			var address, keys;

			address = data.rv_address_data;
			keys = this.options.keys;

			if (address) {

				// Replace DOM components
				$(this.element)
					// ...with singular geolocation data (based on `data-geolocation` attribute)
					.find('[data-' + keys.single + ']').each(function(index, element) {
						var _result = address[$(element).data(keys.single)];

						if (_result) {
							$(element).text(_result);
						}
					}).end()
					// ...with formatted geolocation data (based on `data-geolocation-formatted` attribute)
					.find('[data-' + keys.formatted + ']').each(function(index, element) {
						var _format, _keys, _result;

						_format = $(element).data(keys.formatted);
						_keys = _format.match(/\{\{[a-z,A-Z,\d]+\}\}/g);

						if ($.isArray(_keys)) {
							_result = _format + '';
							$.each(_keys, function(i, v) {
								var k = $.trim(v.replace('{{','').replace('}}',''));
								if (address[k]) {
									_result = _result.replace(v, address[k]);
								} else {
									_result = '';
								}
							});

							if (_result && _result.length) {
								$(element).text(_result);
							}
						}
					});
			}
		}

	};

	function _getLocation( apiKey, coords ) {
		return $.getJSON('/reverse_geocode.php', {
			key: apiKey,
			latlng: coords.join(','),
			result_type: ['street_address','postal_code'].join('|')
		});
	}

	function _doHailo( name, data ) {
		if (typeof hQ !== 'undefined') {
			try {
				hQ.storeOnce(name, data);
			} catch ( error ) {
				// handle hailo-related error (?)
			}
		}
	}

	function _doGoogle( name, data ) {
		if (typeof hQ !== 'undefined') {
			try {
				hQ.storeOnce(name, data);
			} catch ( error ) {
				// handle hailo-related error (?)
			}
		}
	}

	function _doServiceability( formatted_address, postal_code ) {
		if (typeof halcyon === 'object') {
			try {
				// TODO: break serviceability URL out to options
				$.post('/geo_location_serviceability.php', {
					'address': formatted_address,
					'zip': postal_code,
					'hud': halcyon.cookie.getHUD().i,
					'source': 'GPS'
				});
			} catch( error ) {
				// handle no serviceability (?)
			}
		}
	}

	function _deleteCookie( name, path, domain ) {
		if (name && _getCookie(name)) {
			document.cookie = name + '=' +
				(path ? ';path=' + path : '') +
				(domain ? ';domain=' + domain : '') +
				';expires=Thu, 01-Jan-1970 00:00:01 GMT';
		}
	}

	function _getCookie( name ) {
		var cookie_found, cookie_name, cookie_value, temp_cookie;

		cookie_found = false;

		$.each(document.cookie.split(';'), function(index, cookie) {
			// split each `name=value` pair
			temp_cookie = cookie.split('=');
			// trim left/right whitespace while we're at it
			cookie_name = $.trim(temp_cookie[0]);
			// check the name
			if (name.toLowerCase() === cookie_name.toLowerCase()) {
				cookie_found = true;
				// handle empty-value cookies (cookie name set, but no value)
				if (temp_cookie.length > 1) {
					cookie_value = unescape($.trim(temp_cookie[1]));
				} else {
					cookie_value = null;
				}
			}
		});

		if (cookie_found) {
			return cookie_value;
		} else {
			return false;
		}
	}

	function _setCookie( name, value, expires, path, domain, secure ) {
		var today = new Date();
		today.setTime(today.getTime());

		if (typeof name === 'undefined') {
			return;
		}

		if (typeof value === 'undefined') {
			value = '';
		}

		if (typeof expires === 'number') {
			expires = new Date(today.getTime() + expires);
		} else {
			expires = false;
		}

		if (typeof path === 'undefined') {
			path = '/';
		}

		document.cookie = name + '=' + escape(value) +
			(expires ? ';expires=' + expires.toGMTString() : '') +
			(path ? ';path=' + path : '') +
			(domain ? ';domain=' + domain : '') +
			(secure ? ';secure' : '');
	}

	$.fn[pluginName] = function( options ) {
		if (typeof $ === 'function' && 'geolocation' in navigator) {
			return this.each(function() {
				if (!$.data(this, pluginName)) {
					$.data(this, pluginName, new Plugin( this, options ));
				}
			});
		}
	};

}( jQuery, window, document ));
