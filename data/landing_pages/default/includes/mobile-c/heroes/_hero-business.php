<div class="hero hero--business">
    
    <div class="row">

        <div class="small-7 columns">

            <div class="hero__headline">Built for<br>your business</div>

            <div class="price-lockup price-lockup--hero">

                <div class="price-lockup__headline">AT&T Internet<br>starting at</div>
                <? include(RV_LandingPage::find($site_settings['path']['includes'] . '/price-points/_price-point-business.php')); ?>
                <div class="price-lockup__legal legal"><?= $attProductsSMB2->Language->English->Legal->PricePoint; ?></div>

            </div><!-- /.price-point__lockup -->

        </div><!-- /.columns -->

    </div><!-- /.row -->

    <div class="row">

        <div class="small-12 columns">

            <div class="button button--tertiary button--block button--centered"><span class="h-phone" data-c2c-parent="button">Call Now</span></div>

        </div><!-- /.columns -->

    </div><!-- /.row -->
    
</div><!-- /.hero--landing -->