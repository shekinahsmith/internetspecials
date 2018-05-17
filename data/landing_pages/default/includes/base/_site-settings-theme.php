<?
    // Assign default values to variables
    global $site_settings;
    $site_settings['site_loader']['enabled'] = false;
    $site_settings['wordpress']['enabled'] = false;

    // Include experience config: Use this file so we can preform logic based on anything here or above
    include_once(RV_LandingPage::find($site_settings['path']['includes'] . '/base/_site-settings-experience-config.php'));
     
    // Preform any logic needed here
    // if (this) { that }

    // Include experience override: Use this file to override anything above. It has last say.
    include_once(RV_LandingPage::find($site_settings['path']['includes'] . '/base/_site-settings-experience-override.php'));
?>
