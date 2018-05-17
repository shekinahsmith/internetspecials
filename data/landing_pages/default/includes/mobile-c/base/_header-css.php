<?
	/*
	 * these are default project CSS files. do not split this file to add experience specific CSS files.
	 *
	 * if you need to add a new CSS file for a specific experience, you should split includes/{theme}/base/_header-assets-additional.php
	 * and add your files there. this file is intended for default files, not experiences files.
	 */
?>
<link href="<?= $site_settings['path']['assets']?>/css/project.min.css" rel="stylesheet">
<?= RV_LandingPage::try_find_web_tag('assets/css/experience.min.css','<link href="/##PATH##" rel="stylesheet" media="screen">'); ?>