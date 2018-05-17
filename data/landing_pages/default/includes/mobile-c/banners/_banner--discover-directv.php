<?
    $trackingLabel = '';

    if( $_SERVER['SCRIPT_URL'] == '/directv.html' ) {
        $trackingLabel = 'Sub7';
    }
?>
<div class="banner banner--blue">

    <div class="row">

        <div class="small-12 columns">

            <div class="banner__headline">Discover all DIRECTV has to offer.</div>

            <div class="button button--secondary button--block js-track" data-tracker='<?= rv_tracker_attrs($trackPage, $trackingLabel, "Order"); ?>'>Call <span class="h-phone" data-c2c-parent="button"><?= $sitePhone; ?> to order</span></div>

        </div><!-- /.columns -->

    </div><!-- /.row -->

</div><!-- /.banner -->