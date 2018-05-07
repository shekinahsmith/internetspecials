<?
	require($_SERVER['DOCUMENT_ROOT'] . 'define.php');

	// this contains function necessary to switch shard to directv for channel lookup
	require_once( $_SERVER['DOCUMENT_ROOT']. '/directv-channel-lookup.php' );
	
	// dynamically loaded correct include (fallback to select if error)
    // Strip tags, sanitize input from all form vars submitted
    $packagesArray = array('select', 'entertainment', 'choice', 'xtra', 'ultimate', 'premier');
    $channelLineupPackage = 'error';

    if($_GET['package']) {

        // sanitize input
        $_GET['package'] = preg_replace('/[^A-Za-z0-9\-\@\.\%\ \_\/]/', '', $_GET['package']);

        // make sure package is in our expected array of packages
        if (in_array($_GET['package'], $packagesArray)) {
            $channelLineupPackage = $_GET['package'];
        }
    }

    // make sure its a valid package
    if ($channelLineupPackage == 'error') {
        echo '<p>We are having an issue loading the requested channel lineup. Please try again.</p>';
    }
    else {

		// fail gracefully if the theme doesn't use this file structure
		include(RV_LandingPage::try_find($site_settings['path']['includes'] . '/modals/channels/_modal-channels--' . $channelLineupPackage . '.php'));

	}
	
?>