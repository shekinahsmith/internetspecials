<?
	/*
	 * this is now an include so that in the instance we test a completely different site, ie: mobile, tablet, redesign,
	 * we don't need to split footer.php to use all new js files.
	 *
	 * however, this still may not be necessary thanks to using try_find_web inside of this file. but it's here if you need it.
	 */
	include_once(RV_LandingPage::find($site_settings['path']['includes'] . '/base/_footer-js.php'));
?>

<?
	// this is so we can split test to add additional js/php/etc. without having to split footer.php/footer-js.php.
	include_once(RV_LandingPage::find($site_settings['path']['includes'] . '/base/_footer-assets-additional.php'));
?>


<? 
	// modals
	include_once(RV_LandingPage::find($site_settings['path']['includes'] . '/modals/_modals.php'));
?>

<? include_once(BASE_INCLUDE_DIR . 'pix3lator_core.inc'); ?>
<? require_once(BASE_INCLUDE_DIR . 'debug_footer.inc'); ?>

</body>
</html>
