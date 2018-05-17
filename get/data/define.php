<?

    // DEFINES =====================================================================
    // Override the DALF default page (usually default.html)
    define("DALF_DEFAULT_PAGE", "/index.html");

    // Turn on lite mode (e.g. disable higher-level DALF landing page features)
    define("DALF_LITE", true);

    // Turn off the dev database (for program testing that requires access to LIVE immediate data)
    define("DALF_DISALLOW_DEVDB", true);

    // DALF auto-senses test and dev to use the devdb01.  This flag will also include staging
    define("DALF_STAGING_USES_DEVDB", true);
    
    // DALF honors current urls when processing referIDs (jump pages)
    define("DALF_STICKY_JUMP_URL", true);

    // BOOTSTRAP =====================================================================

    // Observers who care about location changes.
    $LocationObserversFunc = function() {
        return array(
            new ATT_Web_Location_Observer($_COOKIE['hud'], $_SERVER['HTTP_HOST'])
        );
    };

    //  The core define file takes care of all the base visit tracking, database connections, etc.
    require_once("{$_SERVER['BaseIncludesPath']}/define_core.php") ;

    // Place any other global defines you need for this site here
    require_once("{$_SERVER['BaseIncludesPath']}/leads/class.attlead.php");

    // shared data
   include( RV_Web_SharedInclude::include_shared_file('att', 'shared_data.php') );

    switch ($_SERVER['SCRIPT_URL']) {
        case '/':
        case '/index.html':
            $tapToTalkLabel = 'homepage';
            break;

        case '/plans.html':
            $tapToTalkLabel = 'Plans and Pricing';
            break;

        case '/u-verse-internet.html':
            $tapToTalkLabel = 'u-verse-internet';
            break;

        case '/u-verse-phone.html':
            $tapToTalkLabel = 'u-verse-phone';
            break;

        case '/order.html':
            $tapToTalkLabel = 'order';
            break;
        
        default:
            $tapToTalkLabel = 'default';
            break;
    }

    // get info on the device so we can do click to site, click to call
    try {
	$DeviceIdentifier = new RV_Web_DeviceIdentifier;
	$deviceInfoArray = $DeviceIdentifier->lookup($_SERVER);
	define('DEVICE_TYPE', $deviceInfoArray['DeviceType']);
    } catch (\Exception $e) {
	syslog(LOG_ERR, 'system="web" application="internetspecials.com" error="' . $e->getMessage() . '"');
    }
  
    require_once(BASE_INCLUDE_DIR . "debug.inc");
    
