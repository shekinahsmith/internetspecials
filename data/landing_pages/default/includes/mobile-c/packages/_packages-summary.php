<?// This Partial Contains all of the product information for the pricing grids.  Much of this is variable data from webshared, but things that are not can be changed here.
// This file should not be split INTO and experience, if you need to split it, rename it and keep it in default

//-----------------------------
// Channel Logo Paths
//-----------------------------
    $channelAMC = '/webshared/ds/images/logos/networks/amc.svg';
    $channelAnimalPlanet = '/webshared/ds/images/logos/networks/animal-planet.svg';
    $channelBoomerang = '/webshared/ds/images/logos/networks/boomerang.png';
    $channelComedyCentral = '/webshared/ds/images/logos/networks/comedy-central.svg';
    $channelCNN = '/webshared/ds/images/logos/networks/cnn.svg';
    $channelChiller = '/webshared/ds/images/logos/networks/chiller-tv.png';
    $channelDisneyChannel = '/webshared/ds/images/logos/networks/disney-channel.svg';
    $channelElRey = '/webshared/ds/images/logos/networks/el-rey.png';
    $channelESPN = '/webshared/ds/images/logos/networks/espn.svg';
    $channelESPN2 = '/webshared/ds/images/logos/networks/espn2.svg';
    $channelFS1 = '/webshared/ds/images/logos/networks/fs1.svg';
    $channelFX = '/webshared/ds/images/logos/networks/fx.svg';
    $channelFXX = '/webshared/ds/images/logos/networks/fxx.svg';
    $channelFYI = '/webshared/ds/images/logos/networks/fyi.png';
    $channelGSN = '/webshared/ds/images/logos/networks/gsn.png';
    $channelHGTV = '/webshared/ds/images/logos/networks/hgtv.svg';
    $channelIFC = '/webshared/ds/images/logos/networks/ifc.svg';
    $channelHistory = '/webshared/ds/images/logos/networks/history.svg';
    $channelNatGeoWild = '/webshared/ds/images/logos/networks/nat-geo-wild.svg';
    $channelNick = '/webshared/ds/images/logos/networks/nickelodeon.svg';
    $channelNHLNetwork = '/webshared/ds/images/logos/networks/nhl-network.png';
    $channelOxygen = '/webshared/ds/images/logos/networks/oxygen-alternate.svg';
    $channelSprout = '/webshared/ds/images/logos/networks/sprout.svg';
    $channelTBS = '/webshared/ds/images/logos/networks/tbs.svg';
    $channelTravelChannel = '/webshared/ds/images/logos/networks/travel.svg';
    $channelUSA = '/webshared/ds/images/logos/networks/usa.svg';
    $channelCinemax = '/webshared/ds/images/logos/premiums/logo-cinemax-color-black-on-yellow.svg';
    $channelShowtime = '/webshared/ds/images/logos/premiums/logo-showtime-color.svg';
    $channelHBO = '/webshared/ds/images/logos/premiums/logo-hbo-blue.svg';
    $channelSTARZ = '/webshared/ds/images/logos/premiums/logo-starz.svg';
    $channelSTARZEncore = '/webshared/ds/images/logos/networks/starz-encore.svg';
    $channelNFLNetwork = '/webshared/ds/images/logos/networks/nfl-network.svg';


$packageInternet = array(

//-----------------------------
// INTERNET
//-----------------------------
    // 10Mps - Internet
    $packageInternet10Mbps = array(
        'package' => 'internet-10',
        'packageClass' => 'internet-10',
        'packageTracking' => 'internet-10',
        'packageType' => 'internet',
        'packageFilter' => 'internet-10',
        'packageTagLine' => 'Best for browsing & email',
        'packagePriceDollars' => $attProductsInternetElite->Price->Dollars,
        'packagePriceCents' => '',
        'packageFrequency' => '/mo',
        'packageInternetSpeed' => $attProductsInternetElite->Internet->Speed,
        'packageProximityLegal' => $attProductsInternetElite->Language->English->Legal->PricePoint,
        'packageBundled' => 'DIRECTV SELECT<sup>&trade;</sup>',
        'packageBundledTracking' => 'bundle10',
        'packageBundledModal' => 'select',
        'packageBundledPriceExtraWide' => false,
        'packagePriceBundledDollars' => $dtvProductsSelect->Price->Dollars + $attProductsInternetElite->Price->Dollars,
        'packageBundledChannelCnt' => $dtvProductsSelect->Channels->Total,
        'packageBundledChannelLogos' => array( $channelAMC, $channelUSA, $channelDisneyChannel, $channelNick), // Reference variables at top of file
        'packageBundledPremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
        'packageBundledPremiumLegal' => 'First 3 months at no extra cost',
        'packageBundledProximityLegal' =>  $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint
    ),

    // 25Mps - Internet
    $packageInternet25Mbps = array(
        'package' => 'internet-25',
        'packageClass' => 'internet-25',
        'packageTracking' => 'internet-25',
        'packageType' => 'internet',
        'packageFilter' => 'internet-25',
        'packageTagLine' => 'Best for streaming',
        'packagePriceDollars' => $attProductsInternetMaxTurbo->Price->Dollars,
        'packagePriceCents' => '',
        'packageFrequency' => '/mo',
        'packageProximityLegal' => $attProductsInternetMaxTurbo->Language->English->Legal->PricePoint,
        'packageInternetSpeed' => $attProductsInternetMaxTurbo->Internet->Speed,
        'packageBundledPriceExtraWide' => false,
        'packageBundled' => 'DIRECTV SELECT<sup>&trade;</sup>',
        'packageBundledTracking' => 'bundle25',
        'packageBundledModal' => 'select',
        'packagePriceBundledDollars' => $dtvProductsSelect->Price->Dollars + $attProductsInternetMaxTurbo->Price->Dollars,
        'packageBundledChannelCnt' => $dtvProductsSelect->Channels->Total,
        'packageBundledChannelLogos' => array( $channelAMC, $channelUSA, $channelDisneyChannel, $channelNick), // Reference variables at top of file
        'packageBundledPremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
        'packageBundledPremiumLegal' => 'First 3 months at no extra cost',
        'packageBundledProximityLegal' =>  $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint
    ),

    // 50Mps - Internet
    $packageInternet50Mbps = array(
        'package' => 'internet-50',
        'packageClass' => 'internet-50',
        'packageTracking' => 'internet-50',
        'packageType' => 'internet',
        'packageFilter' => 'internet-50',
        'packageTagLine' => 'Best for multi-device streaming',
        'packagePriceDollars' => $attProductsInternet75->Price->Dollars,
        'packagePriceCents' => '',
        'packageFrequency' => 'per mo.<br>plus taxes',
        'packageProximityLegal' => $attProductsInternet75->Language->English->Legal->PricePoint,
        'packageInternetSpeed' => $attProductsInternet75->Internet->Speed,
        'packageBundledPriceExtraWide' => false,
        'packageBundled' => 'DIRECTV SELECT<sup>&trade;</sup>',
        'packageBundledTracking' => 'bundle50',
        'packageBundledModal' => 'select',
        'packagePriceBundledDollars' => $dtvProductsSelect->Price->Dollars + $attProductsInternet75->Price->Dollars,
        'packageBundledChannelCnt' => $dtvProductsSelect->Channels->Total,
        'packageBundledChannelLogos' => array( $channelAMC, $channelUSA, $channelDisneyChannel, $channelNick), // Reference variables at top of file
        'packageBundledPremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
        'packageBundledPremiumLegal' => 'First 3 months at no extra cost',
        'packageBundledProximityLegal' =>  $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint
    ),

    // 75Mps - Internet
    $packageInternet75Mbps = array(
        'package' => 'internet-75',
        'packageClass' => 'internet-75',
        'packageTracking' => 'internet-75',
        'packageType' => 'internet',
        'packageFilter' => 'internet-75',
        'packageTagLine' => 'Best for gaming & heavy usage',
        'packagePriceDollars' => $attProductsInternet4->Price->Dollars,
        'packagePriceCents' => '',
        'packageFrequency' => 'per mo.<br>plus taxes',
        'packageProximityLegal' => $attProductsInternet4->Language->English->Legal->PricePoint,
        'packageInternetSpeed' => $attProductsInternet4->Internet->Speed,
        'packageBundledPriceExtraWide' => true,
        'packageBundled' => 'DIRECTV SELECT<sup>&trade;</sup>',
        'packageBundledTracking' => 'bundle75',
        'packageBundledModal' => 'select',
        'packagePriceBundledDollars' => $dtvProductsSelect->Price->Dollars + $attProductsInternet4->Price->Dollars,
        'packageBundledChannelCnt' => $dtvProductsSelect->Channels->Total,
        'packageBundledChannelLogos' => array( $channelAMC, $channelUSA, $channelDisneyChannel, $channelNick), // Reference variables at top of file
        'packageBundledPremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
        'packageBundledPremiumLegal' => 'First 3 months at no extra cost',
        'packageBundledProximityLegal' => $attProductsTVInternetPhone7->Language->English->Legal->PricePoint
    )

);//------------- END OF INTERNET


//-----------------------------
// BUNDLES
//-----------------------------

$packageBundle10Mbps = array(

	$packageSelectBundle10 = array(
		'package' => 'select',
        'packageFilter' => 'internet-tv-10',
        'packageTracking' => 'select10',
        'packageChannelFilter' => 'all basic-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-select-bundle',
		'packageTitle' => '10 Mbps High-Speed Internet plus DIRECTV SELECT<sup>&trade;</sup> All Included',
        'packagePriceExtraWide' => false,
		'packagePriceDollars' => $dtvProductsSelect->Price->Dollars + $attProductsInternetElite->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsSelect->Channels->Total,
        'packageInternetSpeed' => '10 Mbps',
        'packageChannelLogos' => array( $channelAMC, $channelUSA, $channelDisneyChannel, $channelNick), // Reference
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference
		'packageDescription' => 'Best for anyone who wants essential entertainment at a great price.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => false
	),

    $packageEntertainmentBundle10 = array(
		'package' => 'entertainment',
        'packageFilter' => 'internet-tv-10',
        'packageTracking' => 'ent10',
        'packageChannelFilter' => 'all basic-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-entertainment-bundle',
		'packageTitle' => '10 Mbps High-Speed Internet plus DIRECTV ENTERTAINMENT All Included',
        'packagePriceExtraWide' => false,
		'packagePriceDollars' => $dtvProductsEntertainment->Price->Dollars + $attProductsInternetElite->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsEntertainment->Channels->Total,
        'packageInternetSpeed' => '10 Mbps',
        'packageChannelLogos' => array( $channelESPN, $channelESPN2, $channelFS1, $channelFX), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
		'packageDescription' => 'Best for anyone who wants essential entertainment at a great price.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => false
	),

	$packageChoiceBundle10 = array(
		'package' => 'choice',
        'packageFilter' => 'internet-tv-10',
        'packageTracking' => 'choice10',
        'packageChannelFilter' => 'all basic-channels sports-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-choice-bundle',
		'packageTitle' => '10 Mbps High-Speed Internet plus DIRECTV CHOICE<sup>&trade;</sup> All Included',
        'packagePriceExtraWide' => false,
		'packagePriceDollars' => $dtvProductsChoice->Price->Dollars + $attProductsInternetElite->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsChoice->Channels->Total,
        'packageInternetSpeed' => '10 Mbps',
        'packageChannelLogos' => array( $channelNick, $channelGSN, $channelIFC, $channelTravelChannel), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
		'packageDescription' => 'Best for anyone who’s frustrated with their current cable or satellite service.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => true
	),

	$packageXtraBundle10 = array(
		'package' => 'xtra',
        'packageFilter' => 'internet-tv-10',
        'packageTracking' => 'xtra10',
        'packageChannelFilter' => 'all sports-channels premium-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-xtra-bundle',
		'packageTitle' => '10 Mbps High-Speed Internet plus DIRECTV XTRA All Included',
        'packagePriceExtraWide' => true,
		'packagePriceDollars' => $dtvProductsXtra->Price->Dollars + $attProductsInternetElite->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsXtra->Channels->Total,
        'packageInternetSpeed' => '10 Mbps',
        'packageChannelLogos' => array( $channelOxygen, $channelSprout, $channelFYI, $channelNHLNetwork), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
		'packageDescription' => 'Best for anyone who wants premium entertainment without the high price tag.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => true
	),

    $packageUltimateBundle10 = array(
		'package' => 'ultimate',
        'packageFilter' => 'internet-tv-10',
        'packageTracking' => 'ultimate10',
        'packageChannelFilter' => 'all sports-channels premium-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-ultimate-bundle',
		'packageTitle' => '10 Mbps High-Speed Internet plus DIRECTV ULTIMATE All Included',
        'packagePriceExtraWide' => true,
		'packagePriceDollars' => $dtvProductsUltimate->Price->Dollars + $attProductsInternetElite->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsUltimate->Channels->Total,
        'packageInternetSpeed' => '10 Mbps',
        'packageChannelLogos' => array( $channelBoomerang, $channelChiller, $channelElRey, $channelSTARZEncore), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
		'packageDescription' => 'Best for anyone who wants premium entertainment without the high price tag.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => true
	),

    $packagePremierBundle10 = array(
		'package' => 'premier',
        'packageFilter' => 'internet-tv-10',
        'packageChannelFilter' => 'all sports-channels premium-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-prem-bundle',
		'packageTitle' => '10 Mbps High-Speed Internet plus DIRECTV PREMIER<sup>&trade;</sup> All Included',
        'packagePriceExtraWide' => true,
		'packagePriceDollars' => $dtvProductsPremier->Price->Dollars + $attProductsInternetElite->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsPremier->Channels->Total,
        'packageInternetSpeed' => '10 Mbps',
        'packageChannelLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
        'packagePremiumFree' => false,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
		'packageDescription' => 'Best for anyone who wants premium entertainment without the high price tag.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => true
	)

);//------------- END OF packageBundle5Mbps

$packageBundle50Mbps = array(

	$packageSelectBundle50 = array(
		'package' => 'select',
        'packageFilter' => 'internet-tv-50',
        'packageTracking' => 'select50',
        'packageChannelFilter' => 'all basic-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-select-bundle',
		'packageTitle' => 'DIRECTV Select All-Included plus '.$attProductsTVInternetPhone9->Internet->Speed.' Internet Plan',
        'packagePriceExtraWide' => false,
		'packagePriceDollars' => $dtvProductsSelect->Price->Dollars + $attProductsInternetMaxTurbo->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetPhone9->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsSelect->Channels->Total,
        'packageInternetSpeed' => '50Mbps',
        'packageChannelLogos' => array( $channelAMC, $channelUSA, $channelDisneyChannel, $channelNick), // Reference
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference
		'packageDescription' => 'Best for anyone who wants essential entertainment at a great price.',
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => false
	),

    $packageEntertainmentBundle50 = array(
		'package' => 'entertainment',
        'packageFilter' => 'internet-tv-50',
        'packageTracking' => 'ent50',
        'packageChannelFilter' => 'all basic-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-entertainment-bundle',
		'packageTitle' => 'DIRECTV Entertainment All-Included plus '.$attProductsTVInternetPhone15->Internet->Speed.' Internet Plan',
        'packagePriceExtraWide' => false,
		'packagePriceDollars' => $dtvProductsEntertainment->Price->Dollars + $attProductsInternetElite->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetPhone15->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsEntertainment->Channels->Total,
        'packageInternetSpeed' => '50Mbps',
        'packageChannelLogos' => array( $channelESPN, $channelESPN2, $channelFS1, $channelFX), // Reference variables at top of file
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
        'packagePremiumFree' => true,
		'packageDescription' => 'Best for anyone who wants essential entertainment at a great price.',
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => false
	),

	$packageChoiceBundle50 = array(
		'package' => 'choice',
        'packageFilter' => 'internet-tv-50',
        'packageTracking' => 'choice50',
        'packageChannelFilter' => 'all sports-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-choice-bundle',
		'packageTitle' => 'DIRECTV Choice All-Included plus '.$attProductsTVInternetPhone10->Internet->Speed.' Internet Plan',
        'packagePriceExtraWide' => false,
		'packagePriceDollars' => $dtvProductsChoice->Price->Dollars + $attProductsInternetMaxTurbo->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetPhone10->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsChoice->Channels->Total,
        'packageInternetSpeed' => '50Mbps',
        'packageChannelLogos' => array( $channelNick, $channelGSN, $channelIFC, $channelTravelChannel), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
		'packageDescription' => 'Best for anyone who’s frustrated with their current cable or satellite service.',
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => false
	),

	$packageXtraBundle50 = array(
		'package' => 'xtra',
        'packageFilter' => 'internet-tv-50',
        'packageTracking' => 'xtra50',
        'packageChannelFilter' => 'all sports-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-xtra-bundle',
		'packageTitle' => 'DIRECTV XTRA All-Included plus '.$attProductsTVInternetPhone11->Internet->Speed.' Internet Plan',
        'packagePriceExtraWide' => true,
		'packagePriceDollars' => $dtvProductsXtra->Price->Dollars + $attProductsInternetMaxTurbo->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetPhone11->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsXtra->Channels->Total,
        'packageInternetSpeed' => '50Mbps',
        'packageChannelLogos' => array( $channelOxygen, $channelSprout, $channelFYI, $channelNHLNetwork), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
		'packageDescription' => 'Best for anyone who wants premium entertainment without the high price tag.',
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => false
	),

    $packageUltimateBundle50 = array(
		'package' => 'ultimate',
        'packageFilter' => 'internet-tv-50',
        'packageTracking' => 'ultimate50',
        'packageChannelFilter' => 'all premium-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-ultimate-bundle',
		'packageTitle' => 'DIRECTV Ultimate All-Included plus '.$attProductsTVInternetPhone22->Internet->Speed.' Internet Plan',
        'packagePriceExtraWide' => true,
		'packagePriceDollars' => $dtvProductsUltimate->Price->Dollars + $attProductsInternetElite->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetPhone22->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsUltimate->Channels->Total,
        'packageInternetSpeed' => '50Mbps',
        'packageChannelLogos' => array( $channelBoomerang, $channelChiller, $channelElRey, $channelSTARZEncore), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
		'packageDescription' => 'Best for anyone who wants premium entertainment without the high price tag.',
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => false
	),

    $packagePremierBundle50 = array(
		'package' => 'premier',
        'packageFilter' => 'internet-tv-50',
        'packageTracking' => 'premier50',
        'packageChannelFilter' => 'all premium-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-prem-bundle',
		'packageTitle' => 'DIRECTV Premier All-Included plus '.$attProductsTVInternetPhone24->Internet->Speed.' Internet Plan',
        'packagePriceExtraWide' => true,
		'packagePriceDollars' => $dtvProductsPremier->Price->Dollars + $attProductsInternetElite->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetPhone24->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsPremier->Channels->Total,
        'packageInternetSpeed' => '50Mbps',
        'packageChannelLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
        'packagePremiumFree' => false,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
		'packageDescription' => 'Best for anyone who wants premium entertainment without the high price tag.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => false
	)

);//------------- END OF packageBundle5Mbps

$packageBundle75Mbps = array(

	$packageSelectBundle75 = array(
		'package' => 'select',
        'packageFilter' => 'internet-tv-75',
        'packageChannelFilter' => 'all basic-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-select-bundle',
		'packageTitle' => '75 Mbps High-Speed Internet plus DIRECTV SELECT<sup>&trade;</sup> All Included',
        'packagePriceExtraWide' => true,
		'packagePriceDollars' => $dtvProductsSelect->Price->Dollars +  $attProductsInternet4->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsSelect->Channels->Total,
        'packageInternetSpeed' => '75Mbps',
        'packageChannelLogos' => array( $channelAMC, $channelUSA, $channelDisneyChannel, $channelNick), // Reference
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference
		'packageDescription' => 'Best for anyone who wants essential entertainment at a great price.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => false
	),

    $packageEntertainmentBundle75 = array(
		'package' => 'entertainment',
        'packageFilter' => 'internet-tv-75',
        'packageChannelFilter' => 'all basic-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-entertainment-bundle',
		'packageTitle' => '75 Mbps High-Speed Internet plus DIRECTV ENTERTAINMENT All Included',
        'packagePriceExtraWide' => true,
		'packagePriceDollars' => $dtvProductsEntertainment->Price->Dollars +  $attProductsInternet4->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsEntertainment->Channels->Total,
        'packageInternetSpeed' => '75Mbps',
        'packageChannelLogos' => array( $channelESPN, $channelESPN2, $channelFS1, $channelFX), // Reference variables at top of file
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
        'packagePremiumFree' => true,
		'packageDescription' => 'Best for anyone who wants essential entertainment at a great price.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => false
	),

	$packageChoiceBundle75 = array(
		'package' => 'choice',
        'packageFilter' => 'internet-tv-75',
        'packageChannelFilter' => 'all basic-channels sports-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-choice-bundle',
		'packageTitle' => '75 Mbps High-Speed Internet plus DIRECTV CHOICE<sup>&trade;</sup> All Included',
        'packagePriceExtraWide' => true,
		'packagePriceDollars' => $dtvProductsChoice->Price->Dollars + $attProductsInternet4->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsChoice->Channels->Total,
        'packageInternetSpeed' => '50Mbps',
        'packageChannelLogos' => array( $channelNick, $channelGSN, $channelIFC, $channelTravelChannel), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
		'packageDescription' => 'Best for anyone who’s frustrated with their current cable or satellite service.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => true
	),

	$packageXtraBundle75 = array(
		'package' => 'xtra',
        'packageFilter' => 'internet-tv-75',
        'packageChannelFilter' => 'all sports-channels premium-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-xtra-bundle',
		'packageTitle' => '75 Mbps High-Speed Internet plus DIRECTV XTRA All Included',
        'packagePriceExtraWide' => true,
		'packagePriceDollars' => $dtvProductsXtra->Price->Dollars + $attProductsInternet4->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsXtra->Channels->Total,
        'packageInternetSpeed' => '50Mbps',
        'packageChannelLogos' => array( $channelOxygen, $channelSprout, $channelFYI, $channelNHLNetwork), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
		'packageDescription' => 'Best for anyone who wants premium entertainment without the high price tag.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => true
	),

    $packageUltimateBundle75 = array(
		'package' => 'ultimate',
        'packageFilter' => 'internet-tv-75',
        'packageChannelFilter' => 'all sports-channels premium-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-ultimate-bundle',
		'packageTitle' => '75 Mbps High-Speed Internet plus DIRECTV ULTIMATE All Included',
        'packagePriceExtraWide' => true,
		'packagePriceDollars' => $dtvProductsUltimate->Price->Dollars + $attProductsInternet4->Price->Dollars,
		'packageProximityLegal' =>$attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsUltimate->Channels->Total,
        'packageInternetSpeed' => '75Mbps',
        'packageChannelLogos' => array( $channelBoomerang, $channelChiller, $channelElRey, $channelSTARZEncore), // Reference variables at top of file
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
        'packagePremiumFree' => true,
		'packageDescription' => 'Best for anyone who wants premium entertainment without the high price tag.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => true
	),

    $packagePremierBundle75 = array(
		'package' => 'premier',
        'packageFilter' => 'internet-tv-75',
        'packageChannelFilter' => 'all sports-channels premium-channels',
        'packageType' => 'bundle',
		'packageClass' => 'directv-prem-bundle',
		'packageTitle' => '75 Mbps High-Speed Internet plus DIRECTV PREMIER<sup>&trade;</sup> All Included',
        'packagePriceExtraWide' => true,
		'packagePriceDollars' => $dtvProductsPremier->Price->Dollars + $attProductsInternet4->Price->Dollars,
		'packageProximityLegal' => $attProductsTVInternetAllIncluded->Language->English->Legal->PricePoint,
        'packageChannelCnt' => $dtvProductsPremier->Channels->Total,
        'packageInternetSpeed' => '75Mbps',
        'packageChannelLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
        'packagePremiumFree' => false,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
		'packageDescription' => 'Best for anyone who wants premium entertainment without the high price tag.',
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
		'packageNflst' => true
	)

);//------------- END OF BUNDLES


//-----------------------------
// DIRECTV
//-----------------------------

$packageDirectv = array(

    // $50 - Select All Included
    $packageDirectvSelect = array(
        'package' => 'select',
        'packageFilter' => 'most-popular',
        'packageClass' => 'directv-select',
        'packageHailo' => 'select',
        'packageType' => 'directv',
        'packageTracking' => 'select',
        'packageTitle' => $dtvProductsSelect->Name . ' All Included',
        'packageSubTitle' => $dtvProductsSelect->Channels->Total . '+ Channels',
        'packageTagLine' => 'Ideal for essential entertainment at a great price.',
        'packagePriceExtraWide' => false,
        'packagePriceDollars' => $dtvProductsSelect->Price->Dollars,
        'packagePriceCents' => $dtvProductsSelect->Price->Cents,
        'packageFrequency' => $dtvProductsSelect->Price->Frequency,
        'packageProximityLegal' => $dtvProductsSelect->Legal->Proximity,
        'packageChannelCnt' => $dtvProductsSelect->Channels->Total,
        'packageChannelCntHD' => $dtvProductsSelect->Channels->HD,
        'packageInternetSpeed' => '',
        'packageChannelHeading' => 'Best for essential entertainment',
        'packageChannelLogos' => array( $channelAMC, $channelUSA, $channelDisneyChannel, $channelNick), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packageNflst' => false,
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
        'packagePhone' => $sitePhone
    ),

    // $55 - Entertainment All Included
    $packageDirectvEntertainment = array(
        'package' => 'entertainment',
        'packageFilter' => 'additional',
        'packageClass' => 'directv-entertainment',
        'packageHailo' => 'entertainment',
        'packageType' => 'directv',
        'packageTracking' => 'ent',
        'packageTitle' => $dtvProductsEntertainment->Name . ' All Included',
        'packageSubTitle' => $dtvProductsEntertainment->Channels->Total . '+ Channels',
        'packageTagLine' => 'Best for essential entertainment',
        'packagePriceExtraWide' => false,
        'packagePriceDollars' => $dtvProductsEntertainment->Price->Dollars,
        'packagePriceCents' => $dtvProductsEntertainment->Price->Cents,
        'packageFrequency' => $dtvProductsEntertainment->Price->Frequency,
        'packageProximityLegal' => $dtvProductsEntertainment->Legal->Proximity,
        'packageChannelCnt' => $dtvProductsEntertainment->Channels->Total,
        'packageChannelCntHD' => $dtvProductsEntertainment->Channels->HD,
        'packageInternetSpeed' => '',
        'packageChannelHeading' => 'Value-packed package',
        'packageChannelLogos' => array( $channelESPN, $channelESPN2, $channelFS1, $channelFX), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packageNflst' => false,
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
        'packagePhone' => $sitePhone
    ),


    // $60 - Choice All Included
    $packageDirectvChoice = array(
        'package' => 'choice',
        'packageFilter' => 'most-popular',
        'packageClass' => 'directv-choice',
        'packageHailo' => 'choice',
        'packageType' => 'directv',
        'packageTracking' => 'choice',
        'packageTitle' => $dtvProductsChoice->Name . ' All Included',
        'packageSubTitle' => $dtvProductsChoice->Channels->Total . '+ Channels',
        'packageTagLine' => 'Ideal for elevating your entertainment over cable.',
        'packagePriceExtraWide' => false,
        'packagePriceDollars' => $dtvProductsChoice->Price->Dollars,
        'packagePriceCents' => $dtvProductsChoice->Price->Cents,
        'packageFrequency' => $dtvProductsChoice->Price->Frequency,
        'packageProximityLegal' => $dtvProductsChoice->Legal->Proximity,
        'packageChannelCnt' => $dtvProductsChoice->Channels->Total,
        'packageChannelCntHD' => $dtvProductsSelect->Channels->HD,
        'packageInternetSpeed' => '',
        'packageChannelHeading' => 'Best for beating cable',
        'packageChannelLogos' => array( $channelNick, $channelGSN, $channelIFC, $channelTravelChannel), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packageNflst' => false,
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
        'packagePhone' => $sitePhone
    ),


    // $70 - Xtra
    $packageDirectvXtra = array(
        'package' => 'xtra',
        'packageFilter' => 'most-popular',
        'packageClass' => 'directv-xtra',
        'packageHailo' => 'xtra',
        'packageType' => 'directv',
        'packageTracking' => 'xtra',
        'packageTitle' => $dtvProductsXtra->Name . ' All Included',
        'packageSubTitle' => $dtvProductsXtra->Channels->Total . '+ Channels',
        'packageTagLine' => 'Premium entertainment without the premium price tag.',
        'packagePriceExtraWide' => false,
        'packagePriceDollars' => $dtvProductsXtra->Price->Dollars,
        'packagePriceCents' => $dtvProductsXtra->Price->Cents,
        'packageFrequency' => $dtvProductsXtra->Price->Frequency,
        'packageProximityLegal' => $dtvProductsXtra->Legal->Proximity,
        'packageChannelCnt' => $dtvProductsXtra->Channels->Total,
        'packageChannelCntHD' => $dtvProductsSelect->Channels->HD,
        'packageInternetSpeed' => '',
        'packageChannelHeading' => 'Best for premium entertainment',
        'packageChannelLogos' => array( $channelOxygen, $channelSprout, $channelFYI, $channelNHLNetwork), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packageNflst' => false,
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
        'packagePhone' => $sitePhone
    ),

    // $75 - Ultimate
    $packageDirectvUltimate = array(
        'package' => 'ultimate',
        'packageFilter' => 'additional',
        'packageClass' => 'directv-ultimate',
        'packageHailo' => 'ultimate',
        'packageType' => 'directv',
        'packageTracking' => 'ultimate',
        'packageTitle' => $dtvProductsUltimate->Name . ' All Included',
        'packageSubTitle' => $dtvProductsUltimate->Channels->Total . '+ Channels',
        'packageTagLine' => 'Premium entertainment without the premium price tag.',
        'packagePriceExtraWide' => false,
        'packagePriceDollars' => $dtvProductsUltimate->Price->Dollars,
        'packagePriceCents' => $dtvProductsUltimate->Price->Cents,
        'packageFrequency' => $dtvProductsUltimate->Price->Frequency,
        'packageProximityLegal' => $dtvProductsUltimate->Legal->Proximity,
        'packageChannelCnt' => $dtvProductsUltimate->Channels->Total,
        'packageChannelCntHD' => $dtvProductsSUltimate->Channels->HD,
        'packageInternetSpeed' => '',
        'packageChannelHeading' => 'The movie lover’s package',
        'packageChannelLogos' => array($channelBoomerang, $channelChiller, $channelElRey, $channelSTARZEncore), // Reference variables at top of file
        'packagePremiumFree' => true,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ ), // Reference variables at top of file
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packageNflst' => true,
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
        'packagePhone' => $sitePhone
    ),


    // $125 - Premier
    $packageDirectvPremier = array(
        'package' => 'premier',
        'packageFilter' => 'additional',
        'packageClass' => 'directv-prem',
        'packageHailo' => 'prem',
        'packageType' => 'directv',
        'packageTracking' => 'prem',
        'packageTitle' => $dtvProductsPremier->Name . ' All Included',
        'packageSubTitle' => $dtvProductsPremier->Channels->Total . '+ Channels',
        'packageTagLine' => 'Ideal for the premier entertainment experience.',
        'packagePriceExtraWide' => true,
        'packagePriceDollars' => $dtvProductsPremier->Price->Dollars,
        'packagePriceCents' => $dtvProductsPremier->Price->Cents,
        'packageFrequency' => $dtvProductsPremier->Price->Frequency,
        'packageProximityLegal' => $dtvProductsPremier->Legal->Proximity,
        'packageChannelCnt' => $dtvProductsPremier->Channels->Total,
        'packageChannelCntHD' => $dtvProductsSelect->Channels->HD,
        'packageInternetSpeed' => '',
        'packageChannelHeading' => 'Our top-of-the-line package',
        'packageChannelLogos' => array($channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
        'packagePremiumFree' => false,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelSTARZ, $channelShowtime, $channelCinemax), // Reference variables at top of file
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packageNflst' => true,
        'packageNflstHeading' => 'NFL SUNDAY TICKET 2017 SEASON',
        'packagePhone' => $sitePhone
    )

);//------------- END OF DIRECTV

//-----------------------------
// SMB
//-----------------------------

$packageBusiness = array(

    // Business Package 25
    $packageSMB1 = array(
        'package' => '',
        'packageClass' => 'internet-25',
        'packageHailo' => '',
        'packageType' => 'business',
        'packageTitle' => 'Internet 25',
        'packageTagLine' => ' Ideal for streaming movies and music.',
        'packagePriceExtraWide' => false,
        'packagePriceDollars' => $attProductsSMB1->Price->Dollars,
        'packagePriceCents' => $attProductsSMB1->Price->Cents,
        'packageFrequency' => $attProductsSMB1->Price->Frequency,
        'packageProximityLegal' => $attProductsSMB3->English->Legal->PricePoint,
        'packageInternetSpeed' => '25 Mbps',
        'packageUploadSpeed' => '5 Mbps',
        'packagePhone' => $sitePhone

    ),


    // Business Package 50
    $packageSMB2 = array(
        'package' => '',
        'packageClass' => 'internet-50',
        'packageHailo' => '',
        'packageType' => 'business',
        'packageTitle' => 'Internet 50',
        'packageTagLine' => 'Ideal for streaming and hosting websites.',
        'packagePriceExtraWide' => true,
        'packagePriceDollars' => $attProductsSMB2->Price->Dollars,
        'packagePriceCents' => $attProductsSMB2->Price->Cents,
        'packageFrequency' => $attProductsSMB2->Price->Frequency,
        'packageProximityLegal' => $attProductsSMB3->English->Legal->PricePoint,
        'packageInternetSpeed' => '50 Mbps',
        'packageUploadSpeed' => '10 Mbps',
        'packagePhone' => $sitePhone

    ),


    // Business Package 100
    $packageSMB3 = array(
        'package' => '',
        'packageClass' => 'internet-100',
        'packageHailo' => '',
        'packageType' => 'business',
        'packageTitle' => 'Internet 100',
        'packageTagLine' => 'Ideal for downloading movies and music.',
        'packagePriceExtraWide' => true,
        'packagePriceDollars' => $attProductsSMB3->Price->Dollars,
        'packagePriceCents' => $attProductsSMB3->Price->Cents,
        'packageFrequency' => $attProductsSMB3->Price->Frequency,
        'packageProximityLegal' => $attProductsSMB3->English->Legal->PricePoint,
        'packageInternetSpeed' => '100 Mps',
        'packageUploadSpeed' => '20 Mbps',
        'packagePhone' => $sitePhone

    )

);//------------- END OF BUSINESS


//-----------------------------
// PRODUCT RECOMMENDATON TOOL
//-----------------------------

$packageProductRecTool = array(

    $packageRecommendedInternet50 = array(
        'packageClass' => 'internet-50',
        'packageTitle' => '50 Mbps High-Speed Internet',
        'packageDownloadSpeed' => $attProductsInternet75->Internet->Speed,
        'packageUploadSpeed' => '10Mbps',
        '$packagePriceExtraWide' => false,
        'packagePrice' => $attProductsInternet75->Price->Dollars,
        'packageProximityLegal' => sprintf($attProductsTVInternetAllIncluded->Language->English->Legal->PricePointLegalOnly, ""),
         'packageToolTip' => 'Geographic and service restrictions apply to AT&T services. Call to see if you qualify. >$30 Internet Offer: Price for Internet plans (768K-50M) for new residential customers when bundled with another qualifying AT&T service (TV/AT&T Phone/Wireless). Pricing includes Wi-Fi Gateway. Must maintain a qualifying bundle to receive advertised pricing. Prorated ETF ($180) applies if Internet is disconnected before end of 12 months. Up to $99 installation fee applies. Credit restrictions apply. † Unlimited data allowance may also be purchased separately for an add’l $30/mo., or maintain a bundle of TV & Internet on a combined bill and receive Unlimited Internet data ($30 value) at no add’l charge. For more info, go to www.att.com/internet-usage. INTERNET SVC: AT&T Internet, formerly known as AT&T U-verse, is high speed internet provided over an advanced digital network.',
        'packageFeatures' => array (
            'Best for streaming & gaming on multiple devices.',
            'Wi-Fi Gateway router to connect your devices.'
        ),
        'isBundled' => false
    ),

    $packageRecommendedInternet75 = array(
        'packageClass' => 'internet-75',
        'packageTitle' => '75 Mbps High-Speed Internet',
        'packageDownloadSpeed' => $attProductsInternet4->Internet->Speed,
        'packageUploadSpeed' => '20Mbps',
        'packagePriceExtraWide' => false,
        'packagePrice' => $attProductsInternet4->Price->Dollars,
        'packageProximityLegal' => sprintf($attProductsTVInternetAllIncluded->Language->English->Legal->PricePointLegalOnly, ""),
        'packageToolTip' => 'Geographic and service restrictions apply to AT&T services. Call to see if you qualify. >$50 Internet Offer: Price for Internet 75M plan for new residential customers when bundled with another qualifying AT&T service (TV/AT&T Phone/Wireless). Pricing includes Wi-Fi Gateway. Must maintain a qualifying bundle to receive advertised pricing. Prorated ETF ($180) applies if Internet is disconnected before end of 12 months. Up to $99 installation fee applies. Credit restrictions apply. † Unlimited data allowance may also be purchased separately for an add’l $30/mo., or maintain a bundle of TV & Internet on a combined bill and receive Unlimited Internet data ($30 value) at no add’l charge. For more info, go to www.att.com/internet-usage. INTERNET SVC: AT&T Internet, formerly known as AT&T U-verse, is high speed internet provided over an advanced digital network.',
        'packageFeatures' => array (
            'Best for heavy streaming & gaming on multiple devices.',
            'Wi-Fi Gateway router to connect your devices.'
        ),
        'isBundled' => false

    ),

    $packageRecommendedInternet50Select = array(
        'packageClass' => 'internet-50-select',
        'packageTitle' => 'DIRECTV Select All-Included plus 50 Mbps Internet Plan',
        'packageDownloadSpeed' => $attProductsInternet75->Internet->Speed,
        'packageBundled' => 'select',
        'packageBundledTitle' => 'SELECT<sup>&trade;</sup> All Included TV',
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        '$packagePriceExtraWide' => false,
        'packagePrice' => $dtvProductsSelect->Price->Dollars + $attProductsInternet75->Price->Dollars,
        'packageProximityLegal' => sprintf($attProductsTVInternetAllIncluded->Language->English->Legal->PricePointLegalOnly, "Select"),
        'packageToolTip' => 'Geographic and service restrictions apply to AT&T Internet services. Call or go to www.att.com to see if you qualify.<br><br>$80 2-YR BUNDLE PRICE: Ends 9/30/17. Price Includes SELECT All-Included TV Pkg. ($50/mo.) and Internet plans (768k – 50M) ($30/mo.), monthly fees for Wi-Fi Gateway and a Genie HD DVR + three (3) add’l receivers , and standard prof’l installation in up to four rooms. Custom installation extra. Svcs: Must maintain all bundled services for 24 mos. to receive advertised pricing. After 24 mos., then prevailing monthly rates apply, unless cancelled or changed by customer prior to end of 24 mos. Exclusions: Price does not include taxes, $35 activation & other fees apply, applicable use tax expense surcharge on retail value of installation, equipment upgrades/add-ons, and certain other add’l fees & chrgs. Some offers may not be available through all channels and in select areas.<br><br>†Must maintain a bundle of TV and Internet on a combined bill in order to receive unlimited data allowance at no add’l charge. For more info, go to www.att.com/internet-usage.<br><br>DIRECTV SVC TERMS: Subject to Equipment Lease & Customer Agreements. Must maintain a min. base TV pkg of $29.99/mo. Programming, pricing, terms and conditions subject to change at any time. Visit directv.com/legal or call for details. Offers may not be combined with other promotional offers on the same services and may be modified or discontinued at any time without notice.<br><br>Other conditions apply to all offers.<br><br>©2017 AT&T Intellectual Property. All Rights Reserved. AT&T, Globe logo, DIRECTV, and all other DIRECTV marks contained herein are trademarks of AT&T Intellectual Property and/or AT&T affiliated companies. All other marks are the property of their respective owners.',
        'packageChannelCnt' => $dtvProductsSelect->Channels->Total,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
        'isBundled' => true
    ),

    $packageRecommendedInternet75Select = array(
        'packageClass' => 'internet-75-select',
        'packageTitle' => 'DIRECTV Select All-Included plus 75 Mbps Internet Plan',
        'packageDownloadSpeed' => $attProductsInternet4->Internet->Speed,
        'packageBundled' => 'select',
        'packageBundledTitle' => 'SELECT<sup>&trade;</sup> All Included TV',
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        '$packagePriceExtraWide' => true,
        'packagePrice' => $dtvProductsSelect->Price->Dollars + $attProductsInternet4->Price->Dollars,
        'packageProximityLegal' => sprintf($attProductsTVInternetAllIncluded->Language->English->Legal->PricePointLegalOnly, "Select"),
        'packageToolTip' => 'Geographic and service restrictions apply to AT&T Internet services. Call or go to www.att.com to see if you qualify.<br><br>$100 2-YR BUNDLE PRICE: Ends 9/30/17. Price Includes SELECT All-Included TV Pkg. ($50/mo.) and Internet 75M ($50/mo.), monthly fees for Wi-Fi Gateway and a Genie HD DVR + three (3) add’l receivers , and standard prof’l installation in up to four rooms. Custom installation extra. Svcs: Must maintain all bundled services for 24 mos. to receive advertised pricing. After 24 mos., then prevailing monthly rates apply, unless cancelled or changed by customer prior to end of 24 mos. Exclusions: Price does not include taxes, $35 activation & other fees apply, applicable use tax expense surcharge on retail value of installation, equipment upgrades/add-ons, and certain other add’l fees & chrgs. Some offers may not be available through all channels and in select areas.<br><br>†Must maintain a bundle of TV and Internet on a combined bill in order to receive unlimited data allowance at no add’l charge. For more info, go to www.att.com/internet-usage.<br><br>DIRECTV SVC TERMS: Subject to Equipment Lease & Customer Agreements. Must maintain a min. base TV pkg of $29.99/mo. Programming, pricing, terms and conditions subject to change at any time. Visit directv.com/legal or call for details.<br><br>Offers may not be combined with other promotional offers on the same services and may be modified or discontinued at any time without notice. Other conditions apply to all offers.<br><br>©2017 AT&T Intellectual Property. All Rights Reserved. AT&T, Globe logo, DIRECTV, and all other DIRECTV marks contained herein are trademarks of AT&T Intellectual Property and/or AT&T affiliated companies. All other marks are the property of their respective owners.',
        'packageChannelCnt' => $dtvProductsSelect->Channels->Total,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
        'isBundled' => true

    ),

    $packageRecommendedInternet50Entertainment = array(
        'packageClass' => 'internet-50-entertainment',
        'packageTitle' => 'DIRECTV Entertainment All-Included plus 50 Mbps Internet Plan',
        'packageDownloadSpeed' => $attProductsInternet75->Internet->Speed,
        'packageBundled' => 'entertainment',
        'packageBundledTitle' => 'ENTERTAINMENT All Included TV',
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        '$packagePriceExtraWide' => tue,
        'packagePrice' => $dtvProductsEntertainment->Price->Dollars + $attProductsInternet75->Price->Dollars,
        'packageProximityLegal' => sprintf($attProductsTVInternetAllIncluded->Language->English->Legal->PricePointLegalOnly, "Entertainment"),
        'packageToolTip' => 'Geographic and service restrictions apply to AT&T Internet services. Call or go to www.att.com to see if you qualify. <br><br>$85 2-YR BUNDLE PRICE: Ends 9/30/17. Price Includes ENTERTAINMENT All-Included TV Pkg. ($55/mo.) and Internet plans (768k – 50M) ($30/mo.), monthly fees for Wi-Fi Gateway and a Genie HD DVR + three (3) add’l receivers , and standard prof’l installation in up to four rooms. Custom installation extra. Svcs: Must maintain all bundled services for 24 mos. to receive advertised pricing. After 24 mos., then prevailing monthly rates apply, unless cancelled or changed by customer prior to end of 24 mos. Exclusions: Price does not include taxes, $35 activation & other fees, Regional Sports Fee of up to $7.29/mo. (which is extra & applies in select markets to CHOICE and/or MÁS ULTRA and higher Pkgs.), applicable use tax expense surcharge on retail value of installation, equipment upgrades/add-ons, and certain other add’l fees & chrgs. Some offers may not be available through all channels and in select areas. <br><br>†Must maintain a bundle of TV and Internet on a combined bill in order to receive unlimited data allowance at no add’l charge. For more info, go to www.att.com/internet-usage.<br><br>DIRECTV SVC TERMS: Subject to Equipment Lease & Customer Agreements. Must maintain a min. base TV pkg of $29.99/mo. Programming, pricing, terms and conditions subject to change at any time. Visit directv.com/legal or call for details. <br><br>Offers may not be combined with other promotional offers on the same services and may be modified or discontinued at any time without notice. Other conditions apply to all offers.',
        'packageChannelCnt' => $dtvProductsEntertainment->Channels->Total,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
        'isBundled' => true

    ),

    $packageRecommendedInternet75Entertainment = array(
        'packageClass' => 'internet-75-entertainment',
        'packageTitle' => 'DIRECTV Entertainment All-Included plus 75 Mbps Internet Plan',
        'packageDownloadSpeed' => $attProductsInternet4->Internet->Speed,
        'packageBundled' => 'entertainment',
        'packageBundledTitle' => 'ENTERTAINMENT All Included TV',
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packagePriceExtraWide' => true,
        'packagePrice' => $dtvProductsEntertainment->Price->Dollars + $attProductsInternet4->Price->Dollars,
        'packageProximityLegal' => sprintf($attProductsTVInternetAllIncluded->Language->English->Legal->PricePointLegalOnly, "Entertainment"),
        'packageToolTip' => 'Geographic and service restrictions apply to AT&T Internet services. Call or go to www.att.com to see if you qualify.<br><br>$105 2-YR BUNDLE PRICE: Ends 9/30/17. Price Includes ENTERTAINMENT All-Included TV Pkg. ($55/mo.) and Internet plan (75M) ($50/mo.), monthly fees for Wi-Fi Gateway and a Genie HD DVR + three (3) add’l receivers , and standard prof’l installation in up to four rooms. Custom installation extra. Svcs: Must maintain all bundled services for 24 mos. to receive advertised pricing. After 24 mos., then prevailing monthly rates apply, unless cancelled or changed by customer prior to end of 24 mos. Exclusions: Price does not include taxes, $35 activation & other fees, Regional Sports fee of up to $7.29/mo. assessed with CHOICE and/or MÁS ULTRA Pkg and above, applicable use tax expense surcharge on retail value of installation, equipment upgrades/add-ons, and certain other add’l fees & chrgs. Some offers may not be available through all channels and in select areas.<br><br>†Must maintain a bundle of TV and Internet on a combined bill in order to receive unlimited data allowance at no add’l charge. For more info, go to www.att.com/internet-usage.<br><br>DIRECTV SVC TERMS: Subject to Equipment Lease & Customer Agreements. Must maintain a min. base TV pkg of $29.99/mo. Programming, pricing, terms and conditions subject to change at any time. Visit directv.com/legal or call for details.<br><br>Offers may not be combined with other promotional offers on the same services and may be modified or discontinued at any time without notice. Other conditions apply to all offers.',
        'packageChannelCnt' => $dtvProductsEntertainment->Channels->Total,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
        'isBundled' => true

    ),

    $packageRecommendedInternet50Choice = array(
        'packageClass' => 'internet-50-choice',
        'packageTitle' => 'DIRECTV Choice All-Included plus 50 Mbps Internet Plan',
        'packageDownloadSpeed' => $attProductsInternet75->Internet->Speed,
        'packageBundled' => 'choice',
        'packageBundledTitle' => 'CHOICE All Included TV',
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packagePriceExtraWide' => true,
        'packagePrice' => $dtvProductsChoice->Price->Dollars + $attProductsInternet75->Price->Dollars,
        'packageProximityLegal' => sprintf($attProductsTVInternetAllIncluded->Language->English->Legal->PricePointLegalOnly, "Choice"),
        'packageToolTip' => 'Geographic and service restrictions apply to AT&T Internet services. Call or go to www.att.com to see if you qualify.<br><br>$90 2-YR BUNDLE PRICE: Ends 9/30/17. Price Includes CHOICE All-Included TV Pkg. ($60/mo.) and Internet plans (768k – 50M) ($30/mo.), monthly fees for Wi-Fi Gateway and a Genie HD DVR + three (3) add’l receivers , and standard prof’l installation in up to four rooms. Custom installation extra. Svcs: Must maintain all bundled services for 24 mos. to receive advertised pricing. After 24 mos., then prevailing monthly rates apply, unless cancelled or changed by customer prior to end of 24 mos. Exclusions: Price does not include taxes, $35 activation & other fees, Regional Sports fee of up to $7.29/mo. assessed with CHOICE and/or MÁS ULTRA Pkg and above, applicable use tax expense surcharge on retail value of installation, equipment upgrades/add-ons, and certain other add’l fees & chrgs. Some offers may not be available through all channels and in select areas. <br><br>†Must maintain a bundle of TV and Internet on a combined bill in order to receive unlimited data allowance at no add’l charge. For more info, go to www.att.com/internet-usage. <br><br>DIRECTV SVC TERMS: Subject to Equipment Lease & Customer Agreements. Must maintain a min. base TV pkg of $29.99/mo. Programming, pricing, terms and conditions subject to change at any time. Visit directv.com/legal or call for details. <br><br>Offers may not be combined with other promotional offers on the same services and may be modified or discontinued at any time without notice. Other conditions apply to all offers.',
        'packageChannelCnt' => $dtvProductsChoice->Channels->Total,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
        'isBundled' => true

    ),

    $packageRecommendedInternet75Choice = array(
        'packageClass' => 'internet-75-choice',
        'packageTitle' => 'DIRECTV Choice All-Included plus 75 Mbps Internet Plan',
        'packageDownloadSpeed' => $attProductsInternet4->Internet->Speed,
        'packageBundled' => 'choice',
        'packageBundledTitle' => 'CHOICE All Included TV',
        'packageBundlePremiumLegal' => 'For first 3 months at no extra cost',
        'packagePriceExtraWide' => true,
        'packagePrice' => $dtvProductsChoice->Price->Dollars + $attProductsInternet4->Price->Dollars,
        'packageProximityLegal' => sprintf($attProductsTVInternetAllIncluded->Language->English->Legal->PricePointLegalOnly, "Choice"),
        'packageToolTip' => 'Geographic and service restrictions apply to AT&T Internet services. Call or go to www.att.com to see if you qualify. <br><br>$110 2-YR BUNDLE PRICE: Ends 9/30/17. Price Includes CHOICE All-Included TV Pkg. ($60/mo.) and Internet plan (75M) ($50/mo.), monthly fees for Wi-Fi Gateway and a Genie HD DVR + three (3) add’l receivers , and standard prof’l installation in up to four rooms. Custom installation extra. Svcs: Must maintain all bundled services for 24 mos. to receive advertised pricing. After 24 mos., then prevailing monthly rates apply, unless cancelled or changed by customer prior to end of 24 mos. Exclusions: Price does not include taxes, $35 activation & other fees, Regional Sports fee of up to $7.29/mo. assessed with CHOICE and/or MÁS ULTRA Pkg and above, applicable use tax expense surcharge on retail value of installation, equipment upgrades/add-ons, and certain other add’l fees & chrgs. Some offers may not be available through all channels and in select areas. <br><br>†Must maintain a bundle of TV and Internet on a combined bill in order to receive unlimited data allowance at no add’l charge. For more info, go to www.att.com/internet-usage. <br><br>DIRECTV SVC TERMS: Subject to Equipment Lease & Customer Agreements. Must maintain a min. base TV pkg of $29.99/mo. Programming, pricing, terms and conditions subject to change at any time. Visit directv.com/legal or call for details. <br><br>Offers may not be combined with other promotional offers on the same services and may be modified or discontinued at any time without notice. Other conditions apply to all offers',
        'packageChannelCnt' => $dtvProductsChoice->Channels->Total,
        'packageBundlePremiumLogos' => array( $channelHBO, $channelShowtime, $channelCinemax, $channelSTARZ), // Reference variables at top of file
        'isBundled' => true
    )
);

?>
