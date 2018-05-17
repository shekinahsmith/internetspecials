$(function(){
	
	$('.main-nav ul, .footer-nav ul').setActiveMenu();
	
	// Establish the initial slide based on which button has class 'active'
	var init_slide;
	$('.hero-nav-wrap .manual-nav a').each(function(){
		if ($(this).hasClass('current-slide')) {
			init_slide = $(this).children('span').attr('rel');
			$('.'+init_slide).show();
		}
	});

	$('.hero-nav-wrap .manual-nav a').click(function(e){

		$('.hero-nav-wrap .manual-nav a').removeClass('active');
		$(this).addClass('active');
		
		$('.hero-nav-wrap .manual-nav a').each(function(){
			if ($(this).hasClass('current-slide')) {
				curr_slide = $(this).children('span').attr('rel');
				$(this).removeClass('current-slide');
			}
		});
		
		/*
		$('.hero-nav span').removeClass('cycle-pager-active');
		curr_btn = $(this).children('span').attr('rel');
		$('.hero-nav span[rel="'+curr_btn+'"]').addClass('cycle-pager-active');
		*/
		
		$(this).addClass('current-slide');
		
		next_slide = $(this).children('span').attr('rel');
		
		$('.'+curr_slide+' .hero-img').removeClass('animated bounceInRight delay');
		$('.'+curr_slide+' .hero-img').addClass('animated bounceOutLeft delay');
		$('.'+curr_slide+' .hero-info').removeClass('animated bounceInRight');
		$('.'+curr_slide+' .hero-info').addClass('animated bounceOutLeft');
		
		setTimeout(function() {
			$('.'+curr_slide).hide();
			$('.'+next_slide).show();
			$('.'+next_slide+' .hero-img').removeClass('animated bounceOutLeft delay');
			$('.'+next_slide+' .hero-img').addClass('animated bounceInRight delay');
			$('.'+next_slide+' .hero-info').removeClass('animated bounceOutLeft');
			$('.'+next_slide+' .hero-info').addClass('animated bounceInRight');
		}, 500);
		
		e.preventDefault();
		
	});
	
	$('.tooltip').tipTip({
		maxWidth: '700px',
		edgeOffset: 10,
		delay: 0
	});
	
});

// hailo event tracking
function hailoEventTracking(e) {
	
	var self = $(this); // DOM element that contains 'js-hailo' class
	var event = self.data('hailo-event');
	var label = self.data('hailo-label'); // going forward, only use this if we HAVE TO -- returns null if not specified (thats ok)
	var value = self.data('hailo-value'); // going forward, only use this if we HAVE TO -- returns null if not specified (thats ok)
	var params = {};
	params[label] = value;
	
	/*
	 * now that we are only passing back hailo-event instead of all 3 params, we need to check against
	 * event-type instead of event for things like forms, external links, etc. that need to prevent default action
	 * so that hailo has time to fire
	 */
	var eventType = self.data('hailo-event-type');
	
	if ( eventType === 'submit' ) {
		
		e.preventDefault();
		
		var form = $(this).parent('form'); // submit button must be direct child of <form>, if not update this line
		
		hQ.store(event, params, function() {
			
			form.submit();
		});

	}
	else if ( eventType === 'link' ) {
		
		e.preventDefault();
		
		hQ.store(event, params, function() {
		
			window.location = self.attr('href');
		});

	}
	else {
	
		// do default hQ.store
		hQ.store(event, params);
	}
}

// wait for DOM to finish loading
$(document).on('ready', function() {
	// hailo event tracking
	if( typeof hailoEventTracking === 'function' ) {
		$('.js-hailo').on('click', hailoEventTracking);
	}// END If
});