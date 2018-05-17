<?
    if(defined("ENVIRONMENT") && ENVIRONMENT === "production" || ENVIRONMENT === "staging") {
        echo '<link href="https://d3p8lb1f750jvr.cloudfront.net/att-default/production/latest/css/articulate.min.css" rel="stylesheet" media="screen" />';
    } else if(defined("ENVIRONMENT") && ENVIRONMENT === "test") {
        echo '<link href="https://d3p8lb1f750jvr.cloudfront.net/att-default/staging/latest/css/articulate.min.css" rel="stylesheet" media="screen" />';
    } else {
       	//echo '<link href="//localhost:3001/dist/latest/css/articulate.css" rel="stylesheet" media="screen" />';
    	echo '<link href="https://d3p8lb1f750jvr.cloudfront.net/att-default/staging/latest/css/articulate.min.css" rel="stylesheet" media="screen" />';
    }
?>

<link href="/<?= RV_LandingPage::try_find_web('assets/css/aio.css', 'webshared/articulate/v2/att/chat/assets/desktop/css/aio-shared.css'); ?>" rel="stylesheet" media="screen" />