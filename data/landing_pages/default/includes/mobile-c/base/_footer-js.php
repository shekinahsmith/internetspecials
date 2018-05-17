<?
	/*
	 * these are default project JS files. do not split this file to add experience specific JS files.
	 *
	 * if you need to add a new JS file for a specific experience, you should split includes/{theme}/base/_footer-assets-additional.php
	 * and add your files there. this file is intended for default files, not experiences files.
	 */
?>
<? // making $trackPage accessible to JS ?>
<script type='text/javascript'>var trackPage = '<?= $trackPage; ?>';</script>

<script src="<?= $site_settings['path']['assets'] . '/js/project.min.js'; ?>"></script>
<?= RV_LandingPage::try_find_web_tag('assets/js/experience.min.js','<script src="/##PATH##"></script>'); ?>