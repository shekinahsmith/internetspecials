/**
 * @name          RV Tracker - Plugin - v1.0
 * @description   An all-in-one event tracker for Google, hailo, and others that attempts to
 *                normalize the data being sent/tracked to all sources
 * @requires      jQuery 1.8.3+ (http://jquery.com)
 * @author        Reid Linker
 * @since         2015-08-21
 * @updated
 *
 */
(function( $, W, D, undefined ) {
    'use strict';

    // abort if jQuery isn't loaded
    if (typeof $ === undefined) {
        return;
    }

    // reference $.rv namespace (create if it doesn't exist)
    $.rv = $.rv || {};

    // plugin name helpers
    var pluginKey = 'tracker';
    var pluginName = 'rv_tracker';

    // tracker ID (keeps events unique)
    var trackerID  = -1;

    // default options/settings
    var defaults = {
        // basic settings
        event:          'click', // the event to bind the tracking to (i.e.- `click`, `hover`, `submit`, etc)
        eventType:      null, // set to `link` or `submit` to briefly suppress default action until tracking is complete
        data: { // data-* attributes config that will be used for all tracking (object or string)
            key:        'tracker', // master `key` that expects a valid JSON object as contents
            category:   'category',
            action:     'action',
            label:      'label',
            value:      'value'
        },
        google:         true, // track in google analytics
        hailo:          true, // track in hailo
        // event callbacks
        onBeforeSend:   $.noop, // do before sending tracking request(s) (return `false` to abort)
        onDone:         $.noop, // do on success
        onFail:         $.noop, // do on error
        onAlways:       $.noop // do always (after success or error)
    };

    // Regex to determine a valid URL structure; https://gist.github.com/gruber/249502
    var regex = /\b((?:[a-z][\w\-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]|\((?:[^\s()<>]|(?:\([^\s()<>]+\)))*\))+(?:\((?:[^\s()<>]|(?:\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'".,<>?«»“”‘’]))/i;

    function isExternal( href ) {
        var regExp = new RegExp('//' + location.host + '($|/)');
        return (href.substring(0,4) === "http") ? regExp.test(href) : true;
    }

    // reference to this plugin's default options/methods
    function Plugin( root, options ) {
        var $root, event;

        // store custom settings
        this.options = $.extend(true, {}, defaults, options);

        $root = $(root);
        event = this.options.event.toLowerCase();

        // make sure `event` is set properly
        if (event === 'hover') {
            this.options.event = 'mouseover';
        }

        // make sure `eventType` is set properly
        if (event === 'submit') {
            this.options.eventType = 'submit';
        } else if (event === 'click') {
            if ($root.is('a[href]') && !regex.test($root.attr('href'))) {
                this.options.eventType = 'link';
            }
        }

        // legacy support: set `eventType` to `data-hailo-event-type` value (if available)
        if ($root.data('hailo-event-type')) {
            this.options.eventType = $root.data('hailo-event-type');
        }

        // if no `eventType` is set and the element is an anchor tag, validate the href value
        // if it is an external link, make sure `eventType` is set to 'link'
        if (!this.options.eventType && $root.is('a') && $(root)[0].href) {
            this.options.eventType = isExternal($root[0].href) ? 'link' : null;
        }

        // store this instance's information for reference
        this.root = root;
        this.callbacks = {};
        this.trackerID = (++trackerID).toString();
        this.eventName = this.options.event + '.' + pluginKey + '.' + this.trackerID;

        // store references to the default config and plugin name/key
        this._defaults = defaults;
        this._name = pluginName;
        this._key = pluginKey;

        // initialize the plugin instance
        this.init();
    }

    Plugin.prototype = {

        init: function() {
            var $root, conf;
            $root = this.getRoot(true);
            conf = this.getOptions();

            if ($root.data('google') === false || $root.data('ga') === false) {
                conf.google = false;
            }

            if ($root.data('hailo') === false) {
                conf.hailo = false;
            }

            $root.on(this.eventName, $.proxy(this.track, this));
        },

        destroy: function() {
            this.getRoot(true).off(this.eventName);
        },

        getOptions: function() {
            return this.options;
        },

        getRoot: function( jQ ) {
            var root = this.root;
            return jQ ? $(root) : root;
        },

        getParams: function( data ) {
            var $root, conf, params, self;

            if (!data) {
                return;
            }

            self = this;
            conf = self.getOptions();
            $root = self.getRoot(true);

            params = $root.data(data.key);

            if (typeof params === 'string') {
                try {
                    params = $.parseJSON(params);
                } catch(error) {
                    params = null;
                }
            }

            if (!params) {
                params = {};
                params.category = $root.data(data.category);
                params.action = $root.data(data.action);
                params.label = $root.data(data.label);
                params.value = $root.data(data.value);
            }

            return params;
        },

        // master tracking handler
        track: function( event ) {
            var $root, before, conf, deferred, google, hailo, params, self;

            self = this;
            $root = self.getRoot(true);
            conf = self.getOptions();
            deferred = $.Deferred();
            params = self.getParams(conf.data);

            // run the onBeforeSend callback, and abort if it returns false
            before = conf.onBeforeSend(self.root);
            if (before === false) {
                return;
            }

            // setup the google analytics tracker
            if (!!window.ga && conf.google) {
                google = self.trackGoogle(params);
            } else {
                google = $.Deferred().resolve(false);
            }

            // setup the hailo tracker
            if (!!window.hQ && conf.hailo) {
                hailo = self.trackHailo(params);
            } else {
                hailo = $.Deferred().resolve(false);
            }

            switch (self.eventType) {
                case 'submit':
                    // prevent default action from occuring until AFTER the promise can be resolved
                    event.preventDefault();

                    $.when(google, hailo)
                        .done(conf.onDone)
                        .fail(conf.onFail)
                        .always([conf.onAlways, function() {
                            $self.closest('form').submit();
                        }]);
                    break;
                case 'link':
                    // prevent default action from occuring until AFTER the promise can be resolved
                    event.preventDefault();

                    $.when(google, hailo)
                        .done(conf.onDone)
                        .fail(conf.onFail)
                        .always([conf.onAlways, function() {
                            var href = $self.attr('href');

                            if (href.length > 1 && href.indexOf('#') !== 0) {
                                window.location = href;
                            } else if (href.length > 1 && href.indexOf('#') === 0) {
                                window.location.hash = href;
                            }
                        }]);
                    break;
                default:
                    $.when(google, hailo)
                        .done(conf.onDone)
                        .fail(conf.onFail)
                        .always(conf.onAlways);
                    break;
            }
        },

        trackGoogle: function( params ) {
            var deferred, ga_conf;

            // create the deferred object
            deferred = $.Deferred();

            // if no catgory or action is defined, reject the promise
            if (!params.category || !params.action) {
                deferred.reject(params);
            }

            // set up the main GA configuration for the event
            ga_conf = {
                hitType:        'event',        // required
                eventCategory:  params.category,// required
                eventAction:    params.action,  // required
                hitCallback:    function() {    // https://developers.google.com/analytics/devguides/collection/analyticsjs/field-reference#hitCallback
                    // resolve the promise using the `hitCallback` property
                    deferred.resolve(ga_conf);
                }
            };

            // add `label` if exists
            if (params.label) {
                ga_conf.eventLabel = params.label;
            }

            // add `value` if exists
            if (params.value && typeof params.value === 'number' && params.value >= 0) {
                ga_conf.eventValue = params.value;
            }

            // send the event
            window.ga('send', ga_conf);

            // return the deferred object so it can be resolved later
            return deferred;
        },

        trackHailo: function( params ) {
            var data, deferred, name;

            data = {};

            // create the deferred object
            deferred = $.Deferred();

            // concatenate category/action/label/value to make the hailo event name

            // Need to check if variables have value before piping

            name = [params.label];

            if (params.action) {
                name.push(params.action);
            }

            if (params.category) {
                name.push(params.category);
            }

            name = name.join('|');

            // add the label/value pair to the data object if `value` is valid
            if (params.value && typeof params.value === 'number' && params.value >= 0 && params.category) {
                data[params.category] = params.value;
            }
            else {

	            // we need to store a label/val even if we can't pull it in with SSAS so that storeOnce
	            // actually stores it once. if left out, it will continue storing over and over again.
                if (params.category) {
	                data[params.category] = params.label;
                }
            }

            // do the hailo tracking, using the first 30 characters of the event name
            hQ.storeLast(name, data, function() {
                // use the hailo callback to resolve the promise
                deferred.resolve(name, data);
            });

            // return the deferred object so it can be resolved later
            return deferred;
        }
    };

    // Add plugin to to `$.rv` namespace
    $.rv[pluginKey] = Plugin;

    $.fn[pluginName] = function( options ) {
        return this.each(function() {
            var plugin = $(this).data(pluginName);

            // ensure plugin only is setup once per element
            if (plugin) {
                plugin.destroy();
                $(this).removeData(pluginName);
            }

            $.data(this, pluginName, new Plugin(this, options));
        });
    };

    // auto-execute for elements with `data-ga` and `data-hailo` attributes
    $(document).on('ready.' + pluginName, function() {
        $('.js-track[data-tracker]')[pluginName]();
    });

})(jQuery, window, document);
