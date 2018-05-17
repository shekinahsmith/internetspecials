<? 
    $trackingLabel = '';

    if( $_SERVER['SCRIPT_URL'] == '/customer-support.html' ) {
        $trackingLabel = 'Sub3';
    }
?>
<div class="banner banner--blue">

    <div class="row">

        <div class="small-12 columns">

            <div class="banner__headline">My Account</div>
            <p>Pay your bill, review orders, edit your account information & more!</p>

            <a href="https://www.att.com/olam/passthroughAction.myworld?actionType=Manage" class="button button--secondary button--block js-track" data-tracker='<?= rv_tracker_attrs($trackPage, $trackingLabel, "Manage"); ?>'>Manage my account</a>

        </div><!-- /.columns -->

    </div><!-- /.row -->

</div><!-- /.banner -->