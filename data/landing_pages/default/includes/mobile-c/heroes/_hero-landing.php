<div class="hero hero--landing">

    <div class="row">

        <div class="small-9 columns">

            <div class="hero__headline">Finding fast<br>internet has<br>never been easier.</div>

            <div class="price-lockup price-lockup--hero">

                <div class="price-lockup__headline">AT&T Internet starting at</div>
                <? include(RV_LandingPage::find($site_settings['path']['includes'] . '/price-points/_price-point-att.php')); ?>
                <div class="price-lockup__legal legal"><?= $attProductsInternetElite->Language->English->Legal->PricePoint; ?></div>

            </div><!-- /.price-point__lockup -->

        </div><!-- /.columns -->

    </div><!-- /.row -->

    <div class="row">

        <div class="small-12 columns">

            <div class="hero__c2c-button button button--tertiary button--block button--centered js-track" data-tracker='<?= rv_tracker_attrs($trackPage, 'Hero', 'Call to order'); ?>'>Call <span class="hero__cta-phone-number js-track" data-tracker='<?= rv_tracker_attrs($trackPage, "MainNav", "Phone Number"); ?>'><span class="h-phone" data-c2c-parent="hero__c2c-button"><?= $sitePhone; ?></span></span> to order</div>
            <div class="legal legal--movie-caption"><span>Finding Dory</span> Now playing on DIRECTV CINEMA<sup>&reg;</sup></div>

        </div><!-- /.columns -->

    </div><!-- /.row -->

</div><!-- /.hero--landing -->