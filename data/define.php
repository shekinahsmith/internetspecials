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

    // Skip the rest of this script if DEFINE_ONLY is defined and true
    if (defined('DEFINE_ONLY') && DEFINE_ONLY) {
        return;
    }

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

    /*****************************
     *
     * Articulate START
     * - only show if a LP has "CHAT" in it
     * - $showChat is depreciated, do not use
     *
     *****************************/
    $currentLpID = RV_LandingPage::get_real_lpid();
    switch (true) {

        case strstr($currentLpID, 'CHAT'):
            $hasChat = true;
            $hasSMS = false;
        break;

        case strstr($currentLpID, 'SMS'):
            $hasSMS = true;
            $hasChat = false;
        break;

        default:
            $hasSMS = false;
            $hasChat = false;
        break;

    }

    // Debugging :: turn Articulate on
    if(isset($_GET['showChat'])) { $hasChat = (bool)$_GET['showChat']; }

    // Debugging :: display proactive after 1 second
    if (isset($_GET['showProactive'])) { $articulate_settings['proactive_timing_override'] = $_GET['showProactive']; }
    /*****************************
     *      Articulate END       *
     *****************************/

    /*
     * TEMPORARY BLACK FRIDAY/CYBER MONDAY LOGIC
     */

    // setup holiday logic
    $currentDate = !empty($_GET['date']) ? $_GET['date'] : date('Y-m-d');

    // black friday
    if ( $currentDate >= '2015-11-24' && $currentDate <= '2015-11-27') {

        $isBlackFriday = true;
    }
    else {

        $isBlackFriday = false;
    }

    // black friday extended
    if ( $currentDate >= '2015-11-28' && $currentDate <= '2015-11-29') {

        $isBlackFridayExt = true;
    }
    else {

        $isBlackFridayExt = false;
    }

    // cyber monday
    if ( $currentDate == '2015-11-30') {

        $isCyberMonday = true;
    }
    else {

        $isCyberMonday = false;
    }

    // cyber monday extended
    if ( $currentDate >= '2015-12-01') {

        $isCyberMondayExt = true;
    }
    else {

        $isCyberMondayExt = false;
    }

    // debug stuff
    if ( defined('INTERNAL_ADDRESS') && INTERNAL_ADDRESS && isset($_GET['dateDebug']) ) {
        echo '$currentDate: ' . $currentDate;
        echo $isBlackFriday ? '<b style="color: red"><br>Black Friday:</b> ' : '<br>Black Friday: '; var_dump($isBlackFriday);
        echo $isBlackFridayExt ? '<b style="color: red"><br>Black Friday Extended:</b> ' : '<br>Black Friday Extended: '; var_dump($isBlackFridayExt);
        echo $isCyberMonday ? '<b style="color: red"><br>Cyber Monday:</b> ' : '<br>Cyber Monday: '; var_dump($isCyberMonday);
        echo $isCyberMondayExt ? '<b style="color: red"><br>Cyber Monday Extended:</b> ' : '<br>Cyber Monday Extended: '; var_dump($isCyberMondayExt);
    }

    // holiday specific variables
    if ($isBlackFridayExt) {

        $holidayHeroImgSrc = '/images/holiday/2015/black-friday/black-friday-bg.png';
        $holidayHeroHeadline = '<h2 style="font-weight: lighter; color: #fff; font-size: 48px; text-transform: uppercase; display: inline-block; padding-right: 15px; position: relative; left: 35px; top: 5px"><span style="color: #fcb314"><b>Extended Savings</b></span> on AT&T!</h2><a href="/plans.html" data-hailo-event="hero_shop_now" data-hailo-label="click" data-hailo-value="1" class="js-hailo btn is-primary link-plans" style="position: relative; left: 40px; top: -5px;">Shop Now</a>';
        $holidayHeroHeadlineMobile = '<h2 style="font-weight: lighter; color: #fff; font-size: 48px; text-transform: uppercase; display: inline-block; padding-right: 15px; position: relative; left: 35px; top: 5px"><span style="color: #fcb314"><b>Extended Savings</b></span> on AT&T!</h2><a href="/plans.html" data-hailo-event="hero_call_now" data-hailo-label="click" data-hailo-value="1" class="js-hailo js-click-to-call btn is-primary link-plans" style="position: relative; left: 40px; top: -5px;">Call Now</a>';
    }
    else if ($isCyberMonday) {

        $holidayHeroImgSrc = '/images/holiday/2015/cyber-monday/cyber-monday-bg.png';
        $holidayHeroHeadline = '<h2 style="font-weight: lighter; color: #fff; font-size: 30px; text-transform: uppercase; display: inline-block; padding-right: 15px; position: relative; left: 100px">Bring <b>AT&T</b> Home for the Holidays!</h2><a href="/plans.html" data-hailo-event="hero_shop_now" data-hailo-label="click" data-hailo-value="1" class="js-hailo btn is-secondary link-plans" style="position: relative; left: 120px; top: -5px;">Shop Now</a>';
        $holidayHeroHeadlineMobile = '<h2 style="font-weight: lighter; color: #fff; font-size: 30px; text-transform: uppercase; display: inline-block; padding-right: 15px; position: relative; left: 100px">Bring <b>AT&T</b> Home for the Holidays!</h2><a href="/plans.html" data-hailo-event="hero_call_now" data-hailo-label="click" data-hailo-value="1" class="js-hailo js-click-to-call btn is-secondary link-plans" style="position: relative; left: 120px; top: -5px;">Call Now</a>';
    }
    else if ($isCyberMondayExt) {

        $holidayHeroImgSrc = '/images/holiday/2015/cyber-monday/cyber-monday-bg.png';
        $holidayHeroHeadline = '<h2 style="font-weight: lighter; color: #fff; font-size: 48px; text-transform: uppercase; display: inline-block; padding-right: 15px; position: relative; left: 35px; top: 5px"><span style="color: #3492d4"><b>Extended Savings</b></span> on AT&T!</h2><a href="/plans.html" data-hailo-event="hero_shop_now" data-hailo-label="click" data-hailo-value="1" class="js-hailo btn is-secondary link-plans" style="position: relative; left: 40px; top: -5px;">Shop Now</a>';
        $holidayHeroHeadlineMobile = '<h2 style="font-weight: lighter; color: #fff; font-size: 48px; text-transform: uppercase; display: inline-block; padding-right: 15px; position: relative; left: 35px; top: 5px"><span style="color: #3492d4"><b>Extended Savings</b></span> on AT&T!</h2><a href="/plans.html" data-hailo-event="hero_call_now" data-hailo-label="click" data-hailo-value="1" class="js-hailo js-click-to-call btn is-secondary link-plans" style="position: relative; left: 40px; top: -5px;">Call Now</a>';
    }
    else {

        // black friday (default)
        $holidayHeroImgSrc = '/images/holiday/2015/black-friday/black-friday-bg.png';
        $holidayHeroHeadline = '<h2 style="font-weight: 500; color: #fff; font-size: 38px; text-transform: uppercase; display: inline-block; padding-right: 15px; position: relative; left: 35px">Savings on AT&T!</h2><p style="display: inline-block; padding-right: 15px; position: relative; left: 35px; font-size: 18px; top: -5px; color: #fcb314">Find something for everyone on your list.</p><a href="/plans.html" data-hailo-event="hero_shop_now" data-hailo-label="click" data-hailo-value="1" class="js-hailo btn is-primary link-plans" style="position: relative; left: 40px; top: -5px;">Shop Now</a>';
        $holidayHeroHeadlineMobile = '<h2 style="font-weight: 500; color: #fff; font-size: 38px; text-transform: uppercase; display: inline-block; padding-right: 15px; position: relative; left: 35px">Savings on AT&T!</h2><p style="display: inline-block; padding-right: 15px; position: relative; left: 35px; font-size: 18px; top: -5px; color: #fcb314">Find something for everyone on your list.</p><a href="/plans.html" data-hailo-event="hero_call_now" data-hailo-label="click" data-hailo-value="1" class="js-hailo js-click-to-call btn is-primary link-plans" style="position: relative; left: 40px; top: -5px;">Call Now</a>';
    }

    require_once(BASE_INCLUDE_DIR . "debug.inc");



    // THEME FRAMEWORK: global settings for site
    global $site_settings;
    include_once(RV_LandingPage::find('includes/global/base/_site-settings.php'));
