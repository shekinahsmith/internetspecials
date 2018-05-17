<?
	if(defined("ENVIRONMENT") && ENVIRONMENT === "production" || ENVIRONMENT === "staging") {
		echo '<link href="http://s3.amazonaws.com/articulate.io/app-ui-themes/att-sms-modal/latest/css/articulate.min.css" rel="stylesheet" media="screen" />';
	} else if(defined("ENVIRONMENT") && ENVIRONMENT === "test") {
		echo '<link href="http://s3.amazonaws.com/articulate-staging/app-ui-themes/att-sms-modal/latest/css/articulate.min.css" rel="stylesheet" media="screen" />';
	} else {
		echo '<link href="http://localhost:3001/dist/latest/css/articulate.css" rel="stylesheet" media="screen" />';
		//echo '<link href="http://s3.amazonaws.com/articulate-staging/app-ui-themes/att-sms-modal/latest/css/articulate.min.css" rel="stylesheet" media="screen" />';
	}
?>

<link href="/<?= RV_LandingPage::try_find_web('assets/css/aio.css', 'webshared/articulate/v2/att/sms/assets/desktop/css/aio-shared.css'); ?>" rel="stylesheet" media="screen" />