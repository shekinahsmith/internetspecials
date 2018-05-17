<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<head>
<meta charset="UTF-8"/>
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<![endif]-->

<meta name="robots" content="noindex,nofollow,noodp" />

<?= isset($hailoJs) ? $hailoJs : '' ?>

<? if ($canonicalURL = RV_Web_PageMeta::get_canonical_url()) { ?>
<link rel="canonical" href="<?=$canonicalURL?>" />
<? } ?>


<title><?=$headerTitle ?></title>

<!-- CSS STYLE -->
<link href="/css/normalize.css" rel="stylesheet" media="screen" />
<link href="/<?= RV_LandingPage::try_find_web('css/style.css', 'css/style.css'); ?>" rel="stylesheet" media="screen" />
<?= RV_LandingPage::try_find_web_tag('css/experience.css','<link href="/##PATH##" rel="stylesheet" media="screen" />'); ?>
<?= RV_LandingPage::try_find_web_tag('css/experience.min.css','<link href="/##PATH##" rel="stylesheet" media="screen" />'); ?>
<?= RV_LandingPage::try_find_web_tag('library/css/experience.css','<link href="/##PATH##" rel="stylesheet" media="screen" />'); ?>
<link href="/css/animate.css" rel="stylesheet" media="screen" />
<link href="/css/tipTip.css" rel="stylesheet" media="screen" />

<!-- APPLE TOUCH ICON -->
<link rel="apple-touch-icon" href="/apple-touch-icon.png"/>

<!-- JAVASCRIPT -->
<script src="/global_js/jQuery/jquery-1.8.3.min.js"></script>
<script src="/global_js/modernizr.js"></script>
<script src="/global_js/jQuery/active-menu/jquery.active-menu.min.js"></script>
<script src="/js/css3-mediaqueries.js"></script>

<?php include_once( RV_LandingPage::find( 'includes/assets/_header_js.html' ) ); ?>

<?
	// this is here so we can split test additional css/js/etc. without having to split header.php
	include_once(RV_LandingPage::try_find('includes/extra_head_tag_assets.html'));
?>

<script type="text/javascript">

	$(document).ready(function() {

		// this highlights the errors on the contact form
        <?
        	if($_SESSION['bad_fields']) {
				foreach($_SESSION['bad_fields'] as $fieldName) {
		?>
				$(".<?= $fieldName ?>").css('color', '#fe0000');
		<?		}
			}
		?>
	});

</script>

<? echo RV_webTools::get_js_enabled_script($siteParams->CompanyID); ?>
<? include_once(INCLUDE_DIR . "/ga_async.inc"); ?>
<?//Full Story Tracking Integration
    echo RV_Web_FullStory::init(RV_Web_FullStory::get_config_id());
?>

</head>

<?
	// body class
	if ($_SERVER['SCRIPT_NAME'] == '/index.html') {
		$bodyClass = 'page home';
	} else {
		$bodyClass = 'page page-' . str_replace(array('.html', '.php', '_'), array('', '', '-'), basename($_SERVER['SCRIPT_NAME']));
	}
?>

<body class="<?= $bodyClass; ?>">