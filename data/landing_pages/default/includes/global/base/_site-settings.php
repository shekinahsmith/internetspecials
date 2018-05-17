<?
    global $site_settings;

	// check to see if we have turned off theming for unique cases (such as an SEO outreach asset)
	// and if not, continue with normal site settings functionality
    if (!defined('NO_THEMING')) {

	    // Set use of site loader (default=false)
	    // Overriden in _site-settings-theme.php
	    $site_settings['site_loader']['enabled'] = false;

	    // split this file into your experience so that you can select a theme
	    include_once(RV_LandingPage::find('includes/global/base/_site-settings-theme-select.php'));

	    // method for switching themes for microsites within subfolders (could also be used for specfic pages)
	    switch (true) {

	        case strpos($_SERVER['SCRIPT_URI'], '/microsite/'): // Change 'microsite' to the your subfolder/page URL
	            $theme_tmp = $site_settings['theme']['microsite']; // Change 'microsite' be your microsite's name, not your theme name (ex. existingcustomer that can be set to 'existingcustomer-a' theme)
	        break;

	        case strpos($_SERVER['SCRIPT_FILENAME'], 'redwpv3'):
	            $theme_tmp = $site_settings['theme']['wordpress']; // Set what LP theme should skin WordPress.
	        break;

	        default:
	            $theme_tmp = $site_settings['theme']['main'];
	        break;

	    }

	    // setup the include path
	    $site_settings['path']['includes'] = '/includes';
	    ($theme_tmp != '' ? $site_settings['path']['includes'] .= '/' . $theme_tmp : '' ); // this is needed for sites on older structure

	    // setup the assets path
	    $site_settings['path']['assets'] = '/assets';
	    ($theme_tmp != '' ? $site_settings['path']['assets'] .= '/' . $theme_tmp : '' ); // this is needed for sites on older structure

	    // Allow the ability to change settings on an experience level
	    include_once(RV_LandingPage::find($site_settings['path']['includes'] . '/base/_site-settings-theme.php'));

	    // Include manifest - used to create manifest file for URL checking
	    if ($site_settings['site_loader']['enabled']) {
	        include_once(RV_LandingPage::find('includes/global/base/_site-settings-loader.php'));
	    }
    }
?>
