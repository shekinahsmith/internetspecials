<header class="masthead js-masthead">

    <div class="masthead__banner" role="banner">

        <div class="row collapse">

            <div class="small-5 columns">

                <div class="masthead__logo js-masthead__toggle"><img src="/webshared/ds/images/logos/att/logo-att-ar-reversed.svg" alt="Att Authorized Retailer "></div>

                <div class="masthead__toggle js-masthead__toggle"></div>

            </div><!-- /.columns -->

            <div class="small-7 columns">

                <div class="masthead__cta js-masthead__cta"><span class="masthead__cta-phone-number js-track" data-tracker='<?= rv_tracker_attrs($trackPage, "MainNav", "Phone Number"); ?>'><span class="h-phone" data-c2c-parent="masthead__cta-phone-number"><?= $sitePhone; ?></span></span></div>

                <div class="masthead__existing-customer js-masthead__existing-customer">

                    <a href="/" class="js-track" data-tracker='<?= rv_tracker_attrs($trackPage, "MainNav", "My ATT"); ?>'>

                        <span class="existing-customer-icon"><svg width="18" height="18" xmlns="http://www.w3.org/2000/svg"><title>home_icon</title><path d="M17.04 7.967L9.418.313C9.21.11 8.94 0 8.65 0c-.287 0-.56.11-.765.313L.26 7.967c-.453.454-.298.826.342.826H2.37v7.387c0 .455.37.828.823.828H6.33v-5.436c0-.274.216-.495.477-.495h3.712c.262 0 .476.22.476.495v5.436h3.113c.447 0 .82-.373.82-.828l-.006-.016.007.016V8.793H16.7c.64 0 .796-.372.343-.826" fill="#009FDB" fill-rule="evenodd"/></svg></span>

                        <span class="existing-customer-text">Home</span>

                    </a>

                </div>

            </div><!-- /.columns -->

        </div><!--/.row -->

    </div><!-- /.masthead__banner -->

    <div class="masthead__drawer js-masthead__drawer">

        <? include(RV_LandingPage::find($site_settings['path']['includes'] . '/navigation/_navigation-primary.php')); ?>

        <? include(RV_LandingPage::find($site_settings['path']['includes'] . '/navigation/_navigation-auxiliary.php')); ?>

    </div><!-- /.masthead__drawer -->

</header><!-- /.masthead -->