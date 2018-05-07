/*
 * Include JS
 *
*/

// Foundation
//=include "../../global/frameworks/foundation/js/foundation/foundation.js"
//=include "../../global/frameworks/foundation/js/foundation/foundation.equalizer.js"
//=include "../../global/frameworks/foundation/js/foundation/foundation.slider.js"
//=include "../../global/frameworks/foundation/js/foundation/foundation.tooltip.js"

// JavaScript Cookie (JavaScript API for handling cookies)
//=include "../../global/js/plugins/js.cookie.js"

// Slick Carousel (Slider for heroes, cards, etc)
//=include "../../global/js/plugins/slick.min.js"

// SVG Injection
//=include "../../global/js/plugins/svg-injector.js"

// Headroom (Hide/reveal header on scroll)
//=include "../../global/js/plugins/headroom.js"
//=include "../../global/js/plugins/jQuery.headroom.js"

// Tooltips (Used for legal)
//=include "../../global/js/plugins/jquery.tooltipster.js"

// SVG polyfill
//=include "../../global/js/plugins/svgxuse.js"

// Datatables
//=include "../../global/js/plugins/dataTables-1.10.10.min.js"

// SmartyStreets (For address check autocompletion)
//=include "../../global/js/plugins/jquery.liveaddress.js"

// RV Tracker
//=include "../../global/js/src/rv-tracker.js"

// jQuery UI
//=include "../../global/js/plugins/jquery-ui.js"

// Load RV Modules
//=include "modules/*.js"

// Set cart cookie
//=include "../../global/js/src/rv-cart-fullstory.js"
/*
 * end includes
 *
*/


// load foundation
$(document).foundation();

// wait for DOM to finish loading
$(document).on('ready', function () {

    // if ga is undefined, set it to an empty function so it doesn't throw errors
    window.ga = window.ga || $.noop;

    // Inject SVG path
    // Elements to inject
    var atvSvg = document.querySelectorAll('svg[data-src]');

    // Do the injection
    new SVGInjector().inject(atvSvg);

    // toggle navigation drawer
    $('.js-masthead__toggle').on('click', function () {

        var navDrawer = $('.js-masthead__drawer');
        var navDrawerToggle = $('.js-masthead__toggle');
        var navCTA = $('.js-masthead__cta');
        var navExistingCustomer = $('.js-masthead__existing-customer');

        navDrawer.toggleClass('is-visible');
        navDrawerToggle.toggleClass('is-rotated');
        $('html, body').toggleClass('has-nav-drawer-open');

        // hiding and showing existing customer link vs cta
        if (navDrawer.hasClass('is-visible')) {
            navCTA.css('display', 'none');
            navExistingCustomer.css('display', 'block');
        }
        else {
            navExistingCustomer.css('display', 'none');
            navCTA.css('display', 'block');
        }

    });

    // closing navigation drawer when modal is opened from navigation
    $('.navigation-primary .js-modal-show').on('click', function () {
        $('.js-masthead__toggle').click();
    });

    // opening fixed navigation
    $('.js-navigation-fixed__toggle').on('click', function () {

        var fixedNavWrapper = $('.js-navigation-fixed__wrapper');
        var fixedNavIcon = $('.js-navigation-fixed__toggle-menu-icon');

        fixedNavWrapper.toggleClass('opened-nav');
        fixedNavIcon.toggleClass('opened-nav');

    });

    // closing fixed navigation when modal is opened from navigation
    $('.navigation-fixed .js-modal-show').on('click', function () {
        $('.js-navigation-fixed__toggle').click();
    });

    // hiding and showing additional card information
    $(document).on('click', '.js-package-card__cta-toggle', function () {

        var $this = $(this);
        var isOpen = $this.hasClass('card-expanded') === true;

        // reset everything...
        // hiding all cards to all for other cards to close when new one is opened
        $('.js-package-card__additional-info').removeClass('is-visible');
        // resetting all other toggle text to default
        $('.js-package-card__cta-toggle').removeClass('card-expanded').text('View Plan Details');

        // focus on the button/card clicked
        $this.text(isOpen ? 'View Plan Details' : 'Close Plan Details')
            .toggleClass('card-expanded', !isOpen)
            .closest('.package-card').find('.js-package-card__additional-info').toggleClass('is-visible', !isOpen);

        directvPackageCards.isotope('layout');
        bundlePackageCards.isotope('layout');
        internetPackageCards.isotope('layout');
    });

    // Original JavaScript code by Chirp Internet: www.chirp.com.au
    function getCookie(name) {
        var re = new RegExp(name + "=([^;]+)");
        var value = re.exec(document.cookie);
        return (value != null) ? unescape(value[1]) : null;
    }

    // updating zip value based on cookie set in address check vue app
    function updateZip() {

        var userZip = getCookie('userZip');

        if (userZip !== null) {
            $('.js-hero__address-check-zip-code').text(userZip);
        }
    }
    updateZip();

    // modals
    $('.js-modal-show').plumModal();

    $(document).on('plumModalClose', function () {
        updateZip();
    });

    //---------------------------------------------------------------------
    // ISOTOPE Filtering - used for deals page and DIRECTV Package Cards
    //---------------------------------------------------------------------

    // directv package cards
    var directvPackageCards = $('.js-package-cards--directv').isotope({
        filter: '.most-popular', // setting initial filter
        layoutMode: 'vertical',
        itemSelector: '.package-card--directv'
    });

    // sorting directv package cards based on option selected
    $('.js-toggle-packages').on('click', function () {

        var filterValue;

        // button has initial data flter set in html
        if ($(this).is('.is-checked')) {

            // AFTER class is toggled, the next time you click the button it will filter back out the most popular packages
            filterValue = '.most-popular';
            $(this).text('Show More Packages');
        }
        else {
            // returning filter value to value set in html
            filterValue = $(this).attr('data-filter');
            $(this).text('Show Less Packages');
        }

        $(this).toggleClass('is-checked');
        directvPackageCards.isotope({ filter: filterValue });

        scrollToElement('.js-package-cards--directv', 400);
    });


    // deals cards
    var dealsGrid = $('.js-deal-boxes').isotope({
        layoutMode: 'vertical',
        itemSelector: '.deal-box'
    });

    // sorting deal boxes based on option selected
    $('.js-deals-sort__form').on('click', 'input', function() {

        var filterValue = $(this).attr('data-filter');
        dealsGrid.isotope({ filter: filterValue });

    });

    // initialzing isotop for bundle cards
    var bundlePackageCards = $('.js-package-cards--bundles').isotope({
        filter: '.internet-tv-50', // setting initial filter
        layoutMode: 'vertical',
        itemSelector: '.package-card--bundle'
    });

    // initialzing isotop for internet cards
    var internetPackageCards = $('.js-package-cards--internet').isotope({
        filter: '.internet-50', // setting initial filter
        layoutMode: 'vertical',
        itemSelector: '.package-card--internet'
    });

    //reinitializing the layout method to avoid layout issues on page load
    var existCondition = setInterval(function () {

        if ($('.deal-box, .package-card--directv, .package-card--bundles, .package-card--internet').length) {

            clearInterval(existCondition);
            dealsGrid.isotope('layout');
            directvPackageCards.isotope('layout');
            bundlePackageCards.isotope('layout');
            internetPackageCards.isotope('layout');
        }
    }, 100); // check every 100ms


    // toggling between package filters
    $('.js-package-filter-toggles__toggle').on('click', function () {
        var $this = $(this);
        var packageToggle = $this.attr('data-filter-toggle');

        $('.js-package-filter-toggles__toggle').removeClass('active');
        $this.addClass('active');

        $('[data-filter-group]').removeClass('active');
        $('[data-filter-group="' + packageToggle + '"]').addClass('active');

    });

    // cardFilter() - used to dynamically filter cards with range slider
    function cardFilter() {

        // object for bundle filters
        var bundlesFilter = {
            1: '.internet-tv-10',
            2: '.internet-tv-50',
            3: '.internet-tv-75'
        };

        // object for channel filters
        var channelsFilter = {
            1: '.all',
            2: '.basic-channels',
            3: '.sports-channels',
            4: '.premium-channels'
        };

        // object for internet filters
        var internetFilter = {
            1: '.internet-10',
            2: '.internet-25',
            3: '.internet-50',
            4: '.internet-75'
        };

        // filter values are pushed into this array specifically for combination filters
        // slider needs click to "fix" issue where tapping on slider won't adjust the slider position
        var filters = {};
        var oldVal = null;
        $('[data-slider]').on('change.fndtn.slider click mouseend touchend', function() {

            var $this = $(this);
            // slider returns data-slider as integer
            var val = parseInt($this.attr('data-slider'));

            var bundleFilter = $('.js-package-filter__range-slider--bundle > [data-slider]');
            var bundleFilterVal = parseInt(bundleFilter.attr('data-slider'));

            var channelFilter = $('.js-package-filter__range-slider--channels > [data-slider]');
            var channelFilterVal = parseInt(channelFilter.attr('data-slider'));

            var cardGroup = $this.parents('.package-filter__range-slider');
            var filterGroup = cardGroup.attr('data-filter-group');

            var filterTrackingLabel = cardGroup.find('.range-slider-labels__label--' + filterGroup);

            if (filterGroup == 'bundle') {
                filters[filterGroup] = bundlesFilter[val];

                // this is needed to prevent tracking from firing for every second the user is holding the range slider handle - bug comes from foundation 5 range slider - no fixes found on their github
                if (oldVal !== val) {
                    hQ.storeLast(filterTrackingLabel[val - 1].innerHTML + ' |Slider| ' + trackPage, {});
                    ga('send', 'event', trackPage, 'Slider', filterTrackingLabel[val - 1].innerHTML);
                    oldVal = val;
                }
            }
            else if (filterGroup == 'channels') {
                filters[filterGroup] = channelsFilter[val];

                if (oldVal !== val) {
                    hQ.storeLast(filterTrackingLabel[val - 1].innerHTML + ' |Slider| ' + trackPage, {});
                    ga('send', 'event', trackPage, 'Slider', filterTrackingLabel[val - 1].innerHTML);
                    oldVal = val;
                }
            }
            else if (filterGroup == 'internet') {
                filters[filterGroup] = internetFilter[val];

                // this is needed to prevent tracking from firing for every second the user is holding the range slider handle - bug comes from foundation 5 range slider - no fixes found on their github
                if (oldVal !== val) {
                    hQ.storeLast(filterTrackingLabel[val - 1].innerHTML + ' |Slider| ' + trackPage, {});
                    ga('send', 'event', trackPage, 'Slider', filterTrackingLabel[val - 1].innerHTML);
                    oldVal = val;
                }
            }

            // hiding/showing the limited bundle banner on packages page
            if (bundleFilterVal === 1) {
                $('.js-banner--limited-offer').css('display', 'block');
            }
            else {
                $('.js-banner--limited-offer').css('display', 'none');
            }

            var filterValue = concatValues(filters);
            bundlePackageCards.isotope({ filter: filterValue });
            internetPackageCards.isotope({ filter: filterValue });

        });

        // prevents slider from firing events twice and allows for filter option to stay
        $(document).foundation('slider', 'reflow');

        // prevents slider from not showing filter mainly here for android devices
        $('[data-slider]').on('mouseend touchend', function(e) {
            e.stopPropagation();
        });

        // flatten object by concatting values
        function concatValues(obj) {
            var value = '';
            for (var prop in obj) {
                value += obj[prop];
            }
            return value;
        }

    }
    cardFilter();

    /*
    ** conditional event tracking
    */

    // navigation open/close
    $('.js-masthead__toggle').on('click', function () {
    	if($(this).hasClass('is-rotated')){
		    emitTracking("nav open", "click", "MainNav");
	    }else{
		    emitTracking("nav close", "click", "MainNav");
	    }
    });

    // package cards open/close
	$('.js-package-card__cta-toggle').on('click', function () {
		var packageName = $(this).closest(".package-card").data("package");

		if ($(this).hasClass('card-expanded')) {
			emitTracking(trackPage, packageName, "card close");
		} else {
			emitTracking(trackPage, packageName, "card open");
		}
	});

	// tracking when the modal closes
	$(document).one('plumModalClose', function () {
        emitTracking("X", "click", "serv modal");
	});

	$(document).on('modal-open:channel-lineup', function(e, package){
		emitTracking(trackPage, package, "view chan");
	});

	/**
     * emitTracking()
	 *
	 * @author SCF
	 *
	 * @param string cat - typically the current page
	 * @param string action - typically the event eg click, slide
	 * @param string label - text for CE's to query off of
     *
     * @desc: combining the 2 tracking events into one function
     */
	function emitTracking(cat, action, label){
		hQ.storeLast(label + '|' + action + '|' + cat, {});
		ga('send', 'event', cat, action, label);
	}

}); // end doc ready

$(window).on('load', function () {
    $('.js-mastfoot-quick-links__list-item').equalHeights();
});


