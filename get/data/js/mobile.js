$(document).ready(function() {
	/**
	 * Menu Toggle
	 */
	var menuToggle = $('.menu-toggle');

	menuToggle.on('click', function() {


		if( !$('.masthead').hasClass('open') ) {

			$('.masthead').toggleClass('open');

		} else {

			$('.masthead').toggleClass('open');
			$('.masthead').toggleClass('closing');

			setTimeout( function() {
				$('.masthead').toggleClass('closing');
			}, 500);
		}

		if( $('.body-wrap').length < 1 ) {

			$('.masthead').nextAll().wrapAll('<div class="body-wrap"></div>');

		} else {

			$('.body-wrap').children().unwrap();

		}

	});

	/**
	 * Color the menu after scrolling a certain distance.
	 */
	var header = $('.masthead'),
		scrollDistance,
		requiredDistance;

	$(window).bind('scroll', function() {
			scrollDistance = $(window).scrollTop(),
			requiredDistance = header.height() + 20;

		if( !header.hasClass('blue') && requiredDistance < scrollDistance ) {
			header.addClass('blue');
		} else if( requiredDistance > scrollDistance ) {
			header.removeClass('blue');
		}
	});

	/**
	 * Slider
	 */
	$.fn.slider = function() {

		var slider = $(this),
			slides = $('.slide-container [class*="slide-"]', this),
			controls = $('.slide-controls', this),
			activeSlide;

		slides.first().addClass('active');
		controls.children('li').first().addClass('active');

		controls.children('li').on('click', function() {
			var slideNum = $(this).index();

			console.log(slideNum);

			if( !slides.is(':animated') ) {
				changeSlide( slideNum );
			}
		});

		function changeSlide( slideNum ) {
			activeSlide = $('.slide-container [class*="slide-"].active'),
			nextSlide = slides.eq(slideNum),
			activeControl = $('.active', controls),
			nextControl = $('li', controls).eq(slideNum);


			activeSlide.fadeOut(500);

			nextSlide.css({
				'position': 'absolute',
				'top': 0,
				'left': 0
			}).fadeIn(500).promise().done(function() {
				nextSlide.addClass('active').removeAttr('style');
				activeSlide.removeClass('active');
			});

			activeControl.removeClass('active');
			nextControl.addClass('active');

		}

		// if( slides.length > 1 ) {
		// 	setInterval(function() {
		// 		if( slides.length > 1 ) {
		// 			if( $('.slide-container [class*="slide-"].active').index() + 1 != slides.length ) {
		// 				slideNum = $('.slide-container [class*="slide-"].active').next().index();
		// 			} else {
		// 				slideNum = 0;
		// 			}

		// 			if( !slides.is(':animated') ) {
		// 				changeSlide( slideNum );
		// 			}
		// 		}
		// 	}, 7000);
		// }
	}

	$('.hero-slider').slider();

	/**
	 * Price Cards
	 */

	$.fn.cardDeck = function() {

		var deck = $(this),
			cards = $('.pricing-card', deck),
			totalHeight = 0;

		// cards.first().addClass('active').css('height','auto');

		cards.on('click', function() {
			totalHeight = 0;

			$(this).css('height','auto');
			totalHeight = $(this).outerHeight();
			$(this).height(70);

			$('.pricing-card.active').removeClass('active').animate({
				height: 70
			}, 300);

			$(this).addClass('active').animate({
				height: totalHeight
			}, 300).promise().done(function() {
				$('body').animate({
					scrollTop: $(this).offset().top - 50
				}, 500);
			});
		});

		$("body").bind("scroll mousedown DOMMouseScroll mousewheel keyup", function(){
			$('html, body').stop();
		});
	}

	$('.pricing-grid').cardDeck();
});

// hailo event tracking
function hailoEventTracking() {

	$trigger = $('.js-hailo');

	$trigger.on('click', function(e) {

		var self = $(this);
		var event = self.data('hailo-event');
		var label = self.data('hailo-label');
		var value = self.data('hailo-value');
		var params = {};
		params[label] = value;

		// if they are submitting a form, we need a callback
		if ( event === 'submit' ) {

			e.preventDefault();

			var form = $(this).parent('form');

			hQ.store(event, params);

			// hack for FF since it won't fire in a callback function of hQ.store();
			setTimeout(function() {

				form.submit();

			}, 50);

		}
		else {

			// console.log( 'Not a form. Logging click.' );

			// Check to make sure the "rotate" class for sliders is not on the slider
			if( !$(this).hasClass('rotate') ) {
				hQ.store(event, params);
			}

			// If this is a link, prevent the default action until hailo has had a chance to log the event.
			if( $(this).attr('href') != undefined && $(this).attr('href').length !== 0 ) {
				var href = $(this).attr('href');

				e.preventDefault();
				e.stopPropagation();

				setTimeout( function(e) {
					window.location.href = href;
				}, 50);
			}// END if
		}
	});
}