//------------------------------------------------------
// Click 2 Call - mobileClickToCall()
//------------------------------------------------------
// wrap all h-phone in <a> tags to force c2c on mobile.
// also allows for wrapping a parent element in <a> tag (such as a banner) if a whole element needs to be c2c.

(function () {

    function mobileClickToCall() {

        // we will update this later
        var hPhone;
        var hailoFired = false;
        var cssFixes = function () {
            return "style='" + [
                "font-family:inherit !important",
                "font-size:inherit !important",
                "font-weight:inherit !important",
                "text-decoration: inherit !important",
                "color:inherit !important"].join(';') + "'";
        };

        // make sure we have an hQ object
        if (typeof hQ !== 'undefined') {

            // wait for hailo to be initialized
            hQ.on('initialized', function () {

                // if it exists, grab phone number from hud
                if (typeof halcyon !== 'undefined') {

                    hud = halcyon.cookie.getHUD();
                    hPhone = halcyon.formatPhoneNumber(hud.n);
                    hailoFired = true;
                }

                wrapPhoneNumbers(hPhone);
            });
        }

        // give hailo a chance to fire, but if something goes wrong, get $sitePhone value and load that
        $(window).on('load', function () {

            setTimeout(function () {

                if (hailoFired == false) {

                    $.post('/get_sitephone_ajax_post2.php', function (sitePhone) {

                        sitePhone = sitePhone.replace(/\"/g, '');
                        wrapPhoneNumbers(sitePhone);
                    });
                }

            }, 500);
        });

        // check all h-phones for data attribute to wrap the parent element in an <a href="tel:">
        function wrapPhoneNumbers(phone) {

            // wrap numbers that are just text links
            $('.h-phone:not([data-c2c-parent])').each(function () {

                var self = $(this);
                var wrapped = self.find('a').hasClass('h-phone-c2c');

                if (!wrapped) {

                    self.wrapInner('<a href="tel://' + phone + '" class="h-phone-c2c"' + cssFixes() + '></a>');
                }
                else {

                    self.find('.h-phone-c2c').attr('href', phone);
                }
            });

            // wrap parent element
            $('[data-c2c-parent]').each(function () {

                var self = $(this);
                var parent = '.' + self.data('c2c-parent');
                var wrapped = self.parent(parent).parent().hasClass('h-phone-c2c');

                if (!wrapped) {

                    self.closest(parent).wrap(' <a href="tel://' + phone + '" class="h-phone-c2c"></a>');
                }
                else {

                    self.closest('.h-phone-c2c').attr('href', phone);
                }
            });
        }
    }

    $(document).on('ready', mobileClickToCall);

})();// END -- MOBILE CLICK 2 CALL 

