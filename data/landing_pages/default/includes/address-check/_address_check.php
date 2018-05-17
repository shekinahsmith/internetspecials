<section class="address-check <? if($_SERVER['SCRIPT_NAME'] == '/index.html') { echo 'js-auto-slide'; } ?>" id="address-check">
	<div class="row">
		<? include_once(RV_LandingPage::find('includes/address-check/_banner_vrc.php')); ?>
		<? include_once(RV_LandingPage::find('includes/address-check/_slidedown_vrc.php')); ?>
		<? include_once(RV_LandingPage::find('includes/address-check/_banner_vrc_congrats.php')); ?> 
	</div><!-- /.row -->
</section><!-- /.address-check -->