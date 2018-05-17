<? 
    $trackingLabel = '';

    if( $_SERVER['SCRIPT_URL'] == '/customer-support.html' ) {
        $trackingLabel = 'Sub4';
    }
?>

<div class="banner banner--gray">

    <div class="row">

        <div class="small-12 columns">

            <div class="banner__headline">Get help from AT&T<br>tech experts</div>
            <p>AT&T technical support is available online 24 hours a day, 7 days a week.</p>

            <a href="tel://1-800-288-2020" class="button button--secondary button--block js-track" data-tracker='<?= rv_tracker_attrs($trackPage, $trackingLabel, "Cust Support"); ?>'>Call 1-800-288-2020</a>

        </div><!-- /.columns -->

    </div><!-- /.row -->

</div><!-- /.banner -->