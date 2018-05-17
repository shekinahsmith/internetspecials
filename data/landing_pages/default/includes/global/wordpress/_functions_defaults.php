<?
/**
* Author: Brian Hamlett for Red Ventures
* URL: http://www.redventures.com/
* Date: 10/2/2015
*
* This new WP theme structure allows us to leverage the power
* of our new theming framework to make even our WP blogs match
* our individual site themes (desktop-a, seo-b, etc.)
*
* This file includes all "default" functions and WP settings that
* are shared across all themes on this site.
*
*
* If you need to make custom adjustments or additions to the
* functions below, use the referenced "actions" to inject your
* code using a custom function in your theme's wordpress/_functions.php
* file.
**/


// Variables that help power the theme loader
$wp_theme_root = $_SERVER['DOCUMENT_ROOT'] . 'landing_pages/default' . $site_settings['path']['includes'] . '/wordpress';
$wp_theme_file = $wp_theme_root . '/' . $_SERVER['SCRIPT_FILENAME'];
// Set the "blank" file path that RV_LP class uses. We'll use this in a comparison check.
$file_blank	 = '/usr/share/www/base_includes/website/blank.php';

/**
* This custom function outputs additional needed items in the <head>
* of your theme (also includes wp_head).
**/
function rv_wp_head() {
	ob_start();

	?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<link rel="pingback" href="<? bloginfo( 'pingback_url' ); ?>" />

	<?
	/**
	 * HOOK: Inject custom theme code
	 **/
	do_action('rv_theme_wp_head');

	/**
	 * We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 **/
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/**
	 * Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 **/
	wp_head();

	// Get the ouptut
	$output = ob_get_contents();

	// Clean up
	ob_end_clean();

	// Add in ajustments to show a shortlink/alternate
	$output = preg_replace( '#<link rel=\'shortlink\' href=\'.*?\' />#', '',$output );
	$output = preg_replace( '#<link rel=\"alternate\" .*? />#', '',$output );

	// Print the output into the <head>
	echo $output;

} // END rv_wp_head()


/**
 * This custom function should include native WP functions/calls
 * that helps setup items like custom post types, taxonomies, image sizes, etc.
 **/
function rv_wp_theme_setup() {

	/************* THEME SUPPORT OPTIONS *************/
	add_theme_support( 'post-thumbnails' );

	/************* THUMBNAIL SIZE OPTIONS *************/
	/* Note that you can only use a custom size label
	   once. Any new label is compared against the
	   active list in the dB and if your custom label
	   is used, an error will alert you that it needs
	   to be modified to a unique name.				  */

	// add_image_size( '<size-name>', 600, 150, true );
	add_image_size( 'two-column-45', 603, 665, true );
	add_image_size( 'two-column-55', 697, 665, true );

	/**
	 * HOOK: Inject custom theme code
	 **/
	do_action('rv_theme_wp_theme_setup');

} // END rv_wp_theme_setup()
add_action( 'after_setup_theme', 'rv_wp_theme_setup' );

/************* CUSTOM POST TYPES/TAXONOMIES *************/


function rv_add_custom_post_types() {
}
add_action( 'init', 'rv_add_custom_post_types', 0 );


/************* SCRIPTS/STYLES OPTIONS *************/

/**
 * To add specific wordpress scripts and styles
 **/
function rv_theme_scripts_and_styles() {
	/**
	 * HOOK: Inject custom theme code
	 **/
	do_action('rv_theme_scripts_and_styles');
}
add_action( 'wp_enqueue_scripts', 'rv_theme_scripts_and_styles' );

/**
 * Custom Editor CSS
 **/
function rv_custom_editor_css() {
	//add_editor_style( $site_settings['path']['assets'] . 'path/to/your/style.css' );

	/**
	 * HOOK: Inject custom theme code
	 **/
	do_action('rv_custom_editor_css');
}
add_action( 'init', 'rv_custom_editor_css' );

/**
 * Load Admin Stylesheet
 **/
function rv_custom_admin_css() {
	//wp_register_style( 'label', $site_settings['path']['assets'] . '/path/to/admin.css', null, true, 'all' );
	//wp_enqueue_style( 'label' );

	/**
	 * HOOK: Inject custom theme code
	 **/
	do_action('rv_custom_admin_css');
}
add_action( 'admin_enqueue_scripts', 'rv_custom_admin_css' );

/**
 * Prevents the toolbar from showing up on actual pages.
 **/
if( !is_admin() ) {
	show_admin_bar(false);
}

/**
 * Include ACF - Since a lot of our SEO sites use ACF, let's try and find it
 **/
include_once(RV_LandingPage::try_find($site_settings['path']['includes'] . '/wordpress/_acf.php'));

function rv_wp_theme_loader($script_name) {
	global $site_settings, $file_blank, $sitePhone, $page, $paged, $chatProactiveDelayTime, $sitePhone, $sitePromoCode, $sitePromoPrompt, $siteParams, $showChat, $hasChat, $hailoJs, $amountArray, $WebLocation;

	// ATT Shared Data globals
	global $attProductsWireless1, $attProductsWireless2, $attProductsWireless3, $attProductsWireless4, $attProductsInternetExpress, $attProductsInternetPro, $attProductsInternetElite, $attProductsInternetMax, $attProductsInternetMaxPlus, $attProductsInternetMaxTurbo, $attProductsInternet75, $attProductsInternet4, $attProductsSMB1, $attProductsSMB2, $attProductsSMB3, $attProductsSMBB, $attProductsTV, $attProductsTVInternet, $attProductsTVInternetAllIncluded, $attProductsTVInternetPhone, $attProductsTVInternetPhone2, $attProductsTVInternetPhone3, $attProductsTVInternetPhone4, $attProductsTVUFamily, $attProductsTVU200, $attProductsTVU300, $attProductsTVU450, $dtvProductsSelect, $dtvProductsEntertainment, $dtvProductsChoice, $dtvProductsUltimate;
	global $attPromoRewardCardResidential, $attPromoRewardCardMovers, $attPromoRewardCard400, $attPromoSavingsForMovers, $attPromoRewardCardSmallBusiness, $attPromoTwoYearPriceGuarantee, $attRewardCard200Generic, $attRewardCard200Qualifying, $attPromoRewardCard400, $attProductsUverseTVInternet;

	$this_file = RV_LandingPage::try_find($site_settings['path']['includes'] . '/wordpress/_' . $script_name);

	if($this_file && $this_file != $file_blank) {
		include_once($this_file);
	}
}

?>
