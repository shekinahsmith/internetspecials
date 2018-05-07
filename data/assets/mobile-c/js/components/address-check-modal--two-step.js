//-----------------------------------------------------
// 3-Step Address Check
//-----------------------------------------------------
$(document).ready(function() {

        var modal_steps = (function() {
    
            // variables
            var s = {
                step_one: $('.address-check__step.step-1'),
                step_two: $('.address-check__step.step-2'),
                step_three: $('.address-check__step.step-3'),
                step_one_bar_mask: $('.js-step-bar-1 .bar-mask'),
                step_two_bar_mask: $('.js-step-bar-2 .bar-mask'),
                step_one_circle: $('.step-circle.circle-1'),
                step_two_circle: $('.step-circle.circle-2'),
                step_three_circle: $('.step-circle.circle-3'),
                step_one_button: $('.js-btn-step-1'),
                step_two_button: $('.js-btn-step-2'),
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
                step_loader: $('.loader-overlay')
            };
    
            //functions
            return {
    
                init: function() {
                    modal_steps.step_progression();
                },
    
                step_progression: function() {
    
                    s.step_one_button.on('click', function(e) {
                        e.preventDefault();
    
                        //CHECK FOR VALUE IN ZIP FIELD
                        if ( s.step_one_zip.val().length < 5 ) {
                            s.step_one_zip.addClass('error');
                        } else {
                            s.step_one_zip.removeClass('error');
    
                            s.step_one_bar_mask.addClass('complete');
                            s.step_one_circle.addClass('complete').removeClass('active');
                            s.step_one.fadeOut(500);
        
                            s.step_one_bar_mask.removeClass('active');
                            s.step_one.addClass('is-hidden');
                            s.step_two.fadeIn(500).removeClass('is-hidden');
                            s.step_two_zip.focus(); //SETS FOCUS TO ZIP
                            s.step_two_street.focus();//MOVES FOCUS TO AUTO-POPULATE: CITY, STATE
                            $(".js-modal-container-size").removeClass('modal-resize'); // Remove the class that changes the modal size
                                
                                
                            setTimeout( function() {
                                $('.js-headline-city').text(s.step_two_city.val());
                                $('.js-headline-state').text(s.step_two_state.val());
                                $('.js-headline-zip').text(s.step_two_zip.val());
                            }, 300);
                            
                            setTimeout( function() {
                                $('.form-collapser').addClass('form-collapser-active');
                            }, 300);
                            
                            setTimeout( function() {
                                s.step_two_circle.addClass('active');
                            }, 700);
                            
                            setTimeout( function() {
                                s.step_two_bar_mask.addClass('active');
                            }, 700);
                            

                            $('.js-address-check-form__change-button').on('click', function() {
                                $('.form-collapser').removeClass('form-collapser-active');
                                $('.form-collapser').addClass('form-collaper-inactive');
                            }); 

                        } //END ZIP CHECK
    
                    });
    
                    s.step_two_button.on('click', function(e) {
                        
                        s.step_loader.fadeIn(500).removeClass('is-hidden'); //SHOW LOADER
                        
                        var formValid = true;
    
                        if ( s.step_two_zip.val().length < 1 ||  //IF NO VALUES DO NOT SHOW LOADER
                             s.step_two_city.val().length < 1 ||
                             s.step_two_state.val().length < 1 ||
                             s.step_two_street.val().length < 1 ||
                             s.step_two_unit_type.val().length < 1 ) {
                                s.step_loader.fadeOut(500).addClass('is-hidden');
                                formValid = false;
                        }
    
                        // Seprate validation for unit number
                        if (s.step_two_unit.hasClass('is-visible')) { // IF UNIT NUMBER IS VISIBLE
                            if ( s.step_two_unit.val().length < 1 ) { // IF NO VALUE FAIL VALIDATION
                                    s.step_loader.fadeOut(500).addClass('is-hidden');
                                    formValid = false;
                            }
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
    
                        if (s.step_two_unit.hasClass('is-visible')) { // IF UNIT NUMBER IS VISIBLE
                            if ( s.step_two_unit.val().length < 1 ) { // UNIT NUMBER CHECK
                                s.step_two_unit.addClass('error');
                            } else {
                                s.step_two_unit.removeClass('error');
                            }
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
                            //console.log("Form Valid");
                            
                            // store address object in cookie so we can use later in ajax request for ROPE
                            $.cookie.json = true;
                            $.cookie('address', addressObj);
                            
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
              if(event.keyCode == 13){ $('.js-btn-step-1').click(); }
        }); //ZIP CHECK ONLY
        $('.js-address-check-form').keypress(function(event){
              if(event.keyCode == 13){ $('.js-btn-step-2').click(); }
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
            };
        })();
        
        modal_steps.init();
        address_check.init();
    
       });
    