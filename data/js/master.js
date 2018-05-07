// @codekit-prepend "plugins/jquery.cookie.js";

//-----------------------------------------------------
// MODALS - PREVENT BODY SCROLLING
//-----------------------------------------------------
// Use data attr to control whether or not body scrolls when modal is open
// example data-body-locked="true"
// this does not need to be added to every modal

function modalBodyLock(e) {

	var html = $('html');
	var modal = $('.' + $(e.target).data('modal') );

	if( modal.data('body-locked') == undefined ) {
		return;
	}
	else if( modal.data('body-locked') == true && modal.is(':visible') ) {
		html.addClass('is-locked');
	}
}

$(function(){

	$('.main-nav ul, .footer-nav ul').setActiveMenu();

	// Establish the initial slide based on which button has class 'active'
	var init_slide,curr_slide,next_slide;
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

	// Adding padding-bottom to body if agents banner is present (*135px = large version)
	if ( $('.banner-agents').length > 0 ) {
		var banner_agent_height = $('.banner-agents').outerHeight();
		$('body').css({'padding-bottom': banner_agent_height + 'px'});
	}

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
        hQ.on("initialized", function(){ // wait for Hailo to initialize before running
    		$('.js-hailo').on('click', hailoEventTracking);
        });
    }

	$('.js-modal-open').click(function(e) {
		e.preventDefault();
		$('.' + $(this).data('modal')).fadeIn();

		modalBodyLock(e);
	});

	$('.js-modal-close').click(function(e) {
		e.preventDefault();
		$('.' + $(this).data('modal')).fadeOut();
	});

});

//Clickable Hero
   $('.js-hero-content-click[data-url]').on('click.heroContentClick', function( event ) {
	   var $tgt = $(event.target);
	   var url = $(this).data('url');
		// IF the target IS NOT an anchor tag,
		// AND IS NOT within a form element,
		// AND the data-url returns a value (isnt undefined or empty)...
	   if (!$tgt.is('a') && $tgt.closest('form').length === 0 && url) {
		   event.preventDefault(); // prevent the default action
			if ($(this).data('hailo-event') && window.hQ) { //Check for data-hailo-event attribute
			   hQ.store($(this).data('hailo-event'),{}, function() {
					window.location = url; // goto the new url
				});
			}
			else {
				window.location = url; // goto the new url
			}
	   }
   });//END Clickable Hero



// Address check stuff 

$(document).ready(function() {
    var address_check = (function() {

        // variables
        var s = {
            unit_type: $('.unit-type'),
            unit: $('.unit')
        };

        // functions
        return {

            // main 'init' function
            init: function() {
                address_check.unit_type_selection();
            },

            unit_type_selection: function() {
                s.unit_type.on('change', function() {

                    if (s.unit_type.val() == 'APT') {
                        s.unit.addClass('is-visible');
                        setTimeout( function() {
                            s.unit.css({'opacity': 1});
                        }, 100);

                    } else {

                        s.unit.css({'opacity': 0});
                        setTimeout( function() {
                            s.unit.removeClass('is-visible');
                        }, 100);
                    }
                });
            }
        };
    })();


//POP MODAL ON CLICK
    var modal_pop_click = (function() {

        // variables
        var s = {
            modal_launch_click: $('.js-modal-pop-click'),
            modal_close_click: $('.js-modal-close')
        };

        // functions
        return {
            // main 'init' function
            init: function() {
                modal_pop_click.modal_open_close_click();
            },

            modal_open_close_click: function() {
                s.modal_launch_click.on('click',function(e) {
                    e.preventDefault();
                    $('.js-modal-click').addClass('is-open').fadeIn(600);
                    // hailo tracking for exit modal
                    hQ.store('show - limited vrc modal', {});
                });

                s.modal_close_click.on('click',function() {
                    $('.js-modal-click').fadeOut(300);

                    setTimeout(function(){
                        $('.js-modal-click').removeClass('is-open');
                    }, 600);
                });
            }
        };
    })();

    address_check.init();
    modal_pop_click.init();

});

/*----- 737CHAT ADDRESS CHECK OVERLAY MODAL -----*/

$(document).ready(function() {
	var modal_pop = (function() {
		// variables
        var s = {
            modal_launch: $('.js-modal-pop'),
            modal_close: $('.js-modal-close')
        };

		//functions
		return {
			init: function() {
                modal_pop.modal_open_close();
			},

			modal_open_close: function() {
                setTimeout( function() {

                   if( $.cookie('address-check' ) !== '1') {
                        // set cookie to only pop once
                        $.cookie('address-check', 1);

                        // fade in modal
                        $('.js-modal').addClass('is-open').fadeIn(600);

                        $('body').addClass('is-locked');
                        $('html').addClass('is-locked');
                    }
                }, 1000);

                s.modal_close.on('click', function() {

                    // fade out modal
                    $('.js-modal').fadeOut(300);

                    // remove .is-open class after modal has completely faded out
                    setTimeout( function(){
                        $('.js-modal').removeClass('is-open');
                        $('body').removeClass('is-locked');
                        $('html').removeClass('is-locked');
                    }, 300);
                });
            },
		};
	})();

    var modal_steps = (function() {

        // variables
        var s = {
            step_one: $('.address-check__step.step-1'),
            step_two: $('.address-check__step.step-2'),
            step_three: $('.address-check__step.step-3'),
            step_one_bar_mask: $('.js-step-bar-1 .bar-mask'),
            step_two_bar_mask: $('.js-step-bar-2 .bar-mask'),
            step_three_bar_mask: $('.js-step-bar-3 .bar-mask'),
            step_one_circle: $('.step-circle.circle-1'),
            step_two_circle: $('.step-circle.circle-2'),
            step_three_circle: $('.step-circle.circle-3'),
            step_one_button: $('.js-btn-step-1'),
            step_two_button: $('.js-btn-step-2'),
            step_three_button: $('.js-btn-step-3'),
            step_one_zip: $('.js-zip-step-1'),
            step_two_zip: $('#zip'),
            step_two_street: $('#street'),
            step_two_city: $('#city'),
            step_two_state: $('#state'),
            step_two_unit_type: $('#unit_type'),
            step_two_unit: $('#unit'),
            step_three_serviceable: $('.step-3__is-servicable'),
            step_three_not_serviceable: $('.step-3__is-not-servicable'),
            step_address_check_form: $('.js-address-check-form'),
            step_loader: $('.loader')
        };

        //functions
        return {

            init: function() {
                modal_steps.step_progression();
            },

            step_progression: function() {

                s.step_one_button.on('click', function(e) {
                    e.preventDefault();

                    s.step_one_bar_mask.addClass('complete');
                    s.step_one_circle.addClass('complete').removeClass('active');
                    s.step_one.fadeOut(500);

                    setTimeout( function() {
                        s.step_one_bar_mask.removeClass('active');
                        s.step_one.addClass('is-hidden');
                        s.step_two.fadeIn(500).removeClass('is-hidden');
                        }, 650);

                    setTimeout( function() {
                        s.step_two_circle.addClass('active');
                    }, 700);

                    setTimeout( function() {
                        s.step_two_bar_mask.addClass('active');
                    }, 700);
                });


                s.step_two_button.on('click', function(e) {
                    e.preventDefault();

                    //CHECK FOR VALUE IN ZIP FIELD
                    if ( s.step_one_zip.val().length < 5 ) {
                        s.step_one_zip.addClass('error');
                    } else {
                        s.step_one_zip.removeClass('error');

	                    s.step_two_bar_mask.addClass('complete');
	                    s.step_two_circle.addClass('complete').removeClass('active');
	                    s.step_two.fadeOut(500);

	                    setTimeout( function() {
	                        s.step_two_bar_mask.removeClass('active');
	                        s.step_two.addClass('is-hidden');
	                        s.step_three.fadeIn(500).removeClass('is-hidden');
	                            s.step_two_zip.focus(); //SETS FOCUS TO ZIP
	                            s.step_two_street.focus();//MOVES FOCUS TO AUTO-POPULATE: CITY, STATE
	                        }, 650);

	                    setTimeout( function() {
	                        s.step_three_circle.addClass('active');
	                    }, 700);

	                    setTimeout( function() {
	                        s.step_three_bar_mask.addClass('active');
	                    }, 700);

                    } //END ZIP CHECK

                });

                s.step_three_button.on('click', function(e) {

                    s.step_three_button.addClass('is-hidden'); //HIDE BUTTON
                    s.step_loader.removeClass('is-hidden'); //SHOW LOADER

                    var formValid = true;

                    if ( s.step_two_zip.val().length < 1 ||  //IF NO VALUES DO NOT SHOW LOADER
                         s.step_two_city.val().length < 1 ||
                         s.step_two_state.val().length < 1 ||
                         s.step_two_street.val().length < 1 ||
                         s.step_two_unit_type.val().length < 1 ) {
                            s.step_three_button.removeClass('is-hidden');
                            s.step_loader.addClass('is-hidden');
                            formValid = false;
                    } else if( s.step_two_unit_type.val() === 'APT' && s.step_two_unit.val() === '' ) {
                        s.step_three_button.removeClass('is-hidden');
                        s.step_loader.addClass('is-hidden');
                        formValid = false;
                    }

                    //CHECK FOR VALUES IN FIELDS AND ADD .error IF THERE IS NOT
                    if ( s.step_two_zip.val().length < 1 ) { //ZIP CHECK
						s.step_two_zip.addClass('error');
					} else {
						s.step_two_zip.removeClass('error');
                    }

                    if ( s.step_two_city.val().length < 1 ) { //CITY CHECK
						s.step_two_city.addClass('error');
					} else {
						s.step_two_city.removeClass('error');
                    }

                    if ( s.step_two_state.val().length < 1 ) { //STATE CHECK
						s.step_two_state.addClass('error');
					} else {
						s.step_two_state.removeClass('error');
                    }

                    if ( s.step_two_street.val().length < 1 ) { //STREET ADDRESS CHECK
						s.step_two_street.addClass('error');
                    } else {
                        s.step_two_street.removeClass('error');
                    }

                    if ( s.step_two_unit_type.val().length < 1 ) { //UNIT TYPE CHECK
						s.step_two_unit_type.addClass('error');
                    } else {
                        s.step_two_unit_type.removeClass('error');
                    }

                    if ( s.step_two_unit_type.val() === 'APT' && s.step_two_unit.val() === '' ) {
                        s.step_two_unit.addClass('error');
                    }
                    else {
                        s.step_two_unit.removeClass('error');
                    }
                    //END VALUE CHECK

                    // address object
                    addressObj = {
	                    street: s.step_two_street.val(),
                        city: s.step_two_city.val(),
                        state: s.step_two_state.val(),
                        zip: s.step_two_zip.val(),
                        unitType: s.step_two_unit_type.val(),
                        unitVal: s.step_two_unit.val()
                    }

					if (formValid === true) {

						// store address object in cookie so we can use later in ajax request for ROPE
						$.cookie.json = true;
	                    $.cookie('address', addressObj);

                        if( s.step_two_unit_type.val() === 'NONE' ) {
                            hQ.storeLast('house|step 2|two_step address check', {});
                        }
                        else if( s.step_two_unit_type.val() === 'APT' ){
                            hQ.storeLast('apt|step 2|two_step address check', {});
                        }

						$('.js-address-check-form').submit();
					}

                });
            }
        };
    })();


    // initiate rope session if we have an address and we're on the plans page
    if (typeof $.cookie('address') != 'undefined' ) {

	    $.ajax({
			url: "/ajax_rope_check.php",
			type: "POST",
			dataType: "JSON",
			data: JSON.parse($.cookie('address'))
		});

		// we only need to run this once, so remove the cookie after request
	    $.removeCookie('address');
    }


    //ZIP CODE PASSING
    var $zip_step_two = $("#zip");

    $(".js-zip-step-1").keyup(function() {
        $zip_step_two.val( this.value );
    });


	//ENTER KEY SUBMITS FORMS
	$('.js-zip-step-1').keypress(function(event){
  		if(event.keyCode == 13){ $('.js-btn-step-2').click(); }
	}); //ZIP CHECK ONLY
	$('.js-address-check-form').keypress(function(event){
  		if(event.keyCode == 13){ $('.js-btn-step-3').click(); }
	}); //ADDRESS CHECK FORM

    // ADDRESS CHECK
    var address_check = (function() {

        // variables
        var s = {
            unit_type: $('.unit-type'),
            unit: $('.unit')
        };

        // functions
        return {
            // main 'init' function
            init: function() {
                address_check.unit_type_selection();
            },

            unit_type_selection: function() {
                s.unit_type.on('change', function() {

                    if (s.unit_type.val() === 'APT') {
                        s.unit.addClass('is-visible');
                        setTimeout( function() {
                            s.unit.css({'opacity': 1});
                        }, 100);

                    } else {

                        s.unit.css({'opacity': 0});
                        setTimeout( function() {
                            s.unit.removeClass('is-visible');
                        }, 100);
                    }

                });
            },

            submit_spinner: function() {

                // does "loading" animation on form submit
                $('.js-address-check-form').submit(function(){
                    var spinner = new Spinner({'left' : '83%', 'top' : '60%'}).spin();
                    $('.js-availability-submit').addClass('is-submitted');
                    setTimeout(function(){
                        document.querySelector('.spin-wrapper').appendChild(spinner.el);
                    }, 500);
                });
            }
        };
    })();

    modal_pop.init();
    modal_steps.init();
    address_check.init();
});
