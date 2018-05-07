/*
 * loaderShow()
 *
 * @desc: shows a loading animation during ajax requests, had to add to plumModal to ensure that it shoes with new webpack config
 * @param string elem  Custom selector for loader
 * @param string htmlClass  Custom class to add to loader
 * @param object appendTo  Custom jQuery object to append loader to
 */
function loaderShow(elem, htmlClass, appendTo) {

    var body = $('body');
    var defaultLoader =
        '<div class="loader  js-loader">' +

        '<div class="loader__content"><img src="/webshared/ds/images/logos/dstar/logo-star.png" alt="Loading..."></div>' +

        '</div>';
    var loader = elem !== '' ? $(elem) : $(defaultLoader);
    var appendElem = appendTo !== undefined ? $(appendTo) : body;

    // go away
    if (loader.length < 1) return;

    // append loader
    appendElem.append(loader);

    loader.addClass('is-visible');

    if (htmlClass !== undefined) {

        loader.addClass(htmlClass);
    }
}


/*
 * loaderHide()
 *
 * @desc: hides loading animation
 */
function loaderHide(elem) {

    var loader = elem !== undefined ? $(elem) : $('.js-loader');

    // go away
    if (loader.length < 1) return;

    loader.remove();
}


/*
 * plumModal()
 *
 * @desc: fire modal on click based on data-modal attribute
 */
(function ($) {

    $.fn.plumModal = function (options) {

        if (!this.length) return;

        // default settings
        var settings = $.extend({

            closeButton: '.js-modal-close',
            overlaySelector: '.js-modal-overlay',
            allowClose: true,
            autoPop: false,
            autoPopTiming: 0

        }, options);

        /*
         * modalShow()
         *
         * @desc: show modal
         */
        function modalShow(elem) {

            var $elem = elem.jquery ? elem : $(elem); // elem instance
            var $modal = $('.js-modal[data-modal="' + $elem.data('modal') + '"]');
            var dtvPackage = $elem.data('package'); // for channel lineups

            $('html').addClass('modal-open no-scroll');

            // if we are clicking on an element with data-modal attribute
            if ($elem.data('modal') !== undefined) {

                $modal.addClass('is-visible');

                // always pop overlay with modal
                $(settings.overlaySelector).addClass('is-visible');
            } else {

                // if we are autopopping it (ie: existing customer modal)
                setTimeout(function () {

                    $elem.addClass('is-visible');

                    // always pop overlay with modal
                    $(settings.overlaySelector).addClass('is-visible');

                }, settings.autoPopTiming * 1000);
            }

            /*
             * if its a channel modal, dynamically load the include so we don't have to put 5 modals on the same page
             * with the possibility of them never viewing them
             */
            if ($elem.data('modal') === 'channel-lineup') {

                // use loader because ajax calls take a few ms
                loaderShow('', 'loader--channel-lineup', '.js-modal--channel-lineup');

                /*
                 * we have to load from /data/ because we can't put PHP in a .js file. the file in /data/ does the RVLP magic
                 * so we can still split test if we need to
                 */
                $modal
                    .addClass('is-visible')
                    .find('.columns .modal__content')
                    .empty()
                    .load('/includes/modals/_channel-lineup.php?package=' + dtvPackage, function () {

                        // hide loader
                        loaderHide();

                        // give control over styling of modal header based on package
                        $(this).find('.modal__header').addClass('modal__header--package-' + dtvPackage);

                        $('.js-channel-print').click(function () {

                            window.open('http://www.directvdeals.com/channels-print.html?channels=' + dtvPackage, '_blank');
                        });
                    });
	            $(document).trigger('modal-open:channel-lineup', [dtvPackage]);
            }

            // if running rope serviceability inside of a modal
            $(window).on('complete.addressUpdate.rope', modalClose);

        }


        /*
         * modalClose()
         *
         * @desc: close all modals and overlay
         */
        function modalClose() {

            $('html').removeClass('modal-open no-scroll');
            $('[class*="js-modal"]').removeClass('is-visible');
            $(settings.overlaySelector).removeClass('is-visible');

            // hide the loader if modal is using it
            loaderHide();

            // if running rope serviceability inside of a modal
            $(window).off('complete.addressUpdate.rope');

        }

        // close on esc key
        $(document).on('keyup', function (e) {

            if (e.keyCode === 27) {

                modalClose();
            }
        });

        // create separate instance for each modal
        return this.each(function () {

            // auto pop modal
            if (settings.autoPop === true) {
                modalShow(this);

                // firing an event once auto pop modal is visible
                $(document).trigger('plumAutoModalShow');
            } else {

                // pop on click
                $(document).off('click.modal').on('click.modal', '.js-modal-show', function (e) {

                    e.preventDefault();
                    modalShow($(this));
                    $(document).foundation('equalizer'); // reinitialize

                    // firing an event once modal is visible - necessary to hook into click function
                    $(document).trigger('plumModalShow');
                });
            }

            // click to close
            $(settings.closeButton).on('click', function (e) {

                e.preventDefault();
                modalClose();

                // firing an event once modal is closed - necessary to hook into click function
                $(document).trigger('plumModalClose');
            });

            $(settings.overlaySelector).on('click', function (e) {

                e.preventDefault();
                modalClose();

            });

        }); // this.each

    }; // $.fn.plumModal

}(jQuery));
