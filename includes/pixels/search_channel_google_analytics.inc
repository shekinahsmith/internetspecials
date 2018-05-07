<!-- Channel 5/13 ONLY GA Tracking Pixel -->
<?/*
if(in_array($_SESSION['Marketing']['ChannelID'], array(5, 13))) { 
	$customVarArray = array(
		2 => array(
					'V' => $_SESSION['Tracker']->visitId, 
					'MC' => $_SESSION['Marketing']['MarketingCodeID'], 
					'LP' => RV_LandingPage::get_lpid()
				  ),
		3 => array('P' => $_SESSION['Tracker']->pageId)
	);
	
	RV_OnlineSearch_AnalyticsEngine::render_google_analytics($siteParams->AnalyticsNumber_GA, 'default', $customVarArray);
}*/?>