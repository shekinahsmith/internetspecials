<? 
    if( $site_settings['quick_link']['enabled'] === true) {
        include(RV_LandingPage::find($site_settings['path']['includes'] . '/mastfoot/_mastfoot-quick-links.php'));
    }
?>

<footer class="mastfoot">

    <div class="row">

        <div class="small-12 columns">

            <div class="mastfoot__logo"><img src="/webshared/ds/images/logos/att/logo-att-ar-reversed.svg" alt="Att Authorized Retailer "></div>

            <? include(RV_LandingPage::find($site_settings['path']['includes'] . '/navigation/_navigation-mastfoot-legal.php')); ?>

        </div><!-- /.columns -->

    </div><!-- /.row -->
    
    <div class="row">

        <div class="small-12 columns">

            <? include(RV_LandingPage::find($site_settings['path']['includes'] . '/legal/_legal-mastfoot.php')); ?>

        </div><!-- /.columns -->

    </div><!-- /.row -->

</footer><!-- /.mastfoot -->