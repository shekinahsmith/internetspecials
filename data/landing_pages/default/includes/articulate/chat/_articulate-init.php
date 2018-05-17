<?	
	include_once(RV_LandingPage::find('includes/articulate/chat/_articulate-config.php')); // default settings
	include_once(RV_LandingPage::find('includes/articulate/chat/_articulate-config-custom.php')); // custom settings
	include_once('/usr/share/www/webshared/data/articulate/v2/att/chat/articulate.php'); // articulate.io
	include_once(RV_LandingPage::find('includes/articulate/chat/_articulate-css.php')); // articulate.io styles
	include_once(RV_LandingPage::find('includes/articulate/chat/_articulate-reactive.php')); // reactive
	include_once(RV_LandingPage::find('includes/articulate/chat/_articulate-proactive.php')); // proactive

	if ($articulate_settings['listeners']) { 
		include_once(RV_LandingPage::find('includes/articulate/chat/_articulate-listeners.php')); // listeners
	}
	
?>