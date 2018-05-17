<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>	<html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>	<html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>	<html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<head>
<meta charset="UTF-8">

<!-- META -->
<?
	// default meta are $metaRobots, $metaDescription, $metaKeywords, $canonicalURL, $headerTitle
	include(RV_LandingPage::find($site_settings['path']['includes'] . '/base/_header-meta.php'));

	 // if you need additional meta (ie: viewport), add it here
	include(RV_LandingPage::find($site_settings['path']['includes'] . '/base/_header-meta-additional.php'));
?>

<!-- CSS -->
<?
	/*
	 * this is now an include so that in the instance we test a completely different site, ie: mobile, tablet, redesign,
	 * we don't need to split header.php to use all new CSS files.
	 *
	 * however, this still may not be necessary thanks to using try_find_web inside of this file. but it's here if you need it.
	 */
	include(RV_LandingPage::find($site_settings['path']['includes'] . '/base/_header-css.php'));
?>

<!-- JAVASCRIPT -->
<?
	/*
	 * this is now an include so that in the instance we test a completely different site, ie: mobile, tablet, redesign
	 * we don't need to split header.php to use all new js files.
	 */
	include(RV_LandingPage::find($site_settings['path']['includes'] . '/base/_header-js.php'));
?>

<script>

	$(document).ready(function() {

		/*
		 * add a class of 'error' to each bad field so we can style with CSS.
		 * by default, this will add a class of 'error' on the invalid input field.
		 *
		 * @required: input field must have class name that is identical to its name attribute (stored in $_SESSION['bad_fields'])
		 *
		 * @example: <input type="text" name="FirstName" class="FirstName">
		 */
		<?
			if($_SESSION['bad_fields']) {

				foreach($_SESSION['bad_fields'] as $fieldName) {
		?>
				$(".<?= $fieldName ?>").addClass('error');
		<?
				}
			}
		?>
	});

</script>

<?
	// init hailo
	echo isset($hailoJs) ? $hailoJs : '';

	// check for bots
	echo RV_webTools::get_js_enabled_script($siteParams->CompanyID);

	// tracking
	include_once(INCLUDE_DIR . "/ga_async.inc");
?>

<?
	//Full Story Tracking Integration
	echo RV_Web_FullStory::init(RV_Web_FullStory::get_config_id());
?>

<?
	/*
	 * this is so we can split test to add additional CSS/JS/etc. without having to split header.php/_header-css.php/_header-js.php.
	 * it goes at the very end because it needs to load after everything else such as hailo in case we need to override anything that comes
	 * from other files.
	 */

	//
	include_once(RV_LandingPage::find($site_settings['path']['includes'] . '/base/_header-assets-additional.php'));
?>

<? $page_class = $page_class ? $page_class : ''; ?>

</head>

<body class="page page-<?= str_replace(array('.html', '.php', '_'), array('', '', '-'), basename($_SERVER['SCRIPT_NAME'])); ?> <?=$page_class;?>">
