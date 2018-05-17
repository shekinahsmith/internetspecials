<?php
if(defined('INTERNAL_ADDRESS') && INTERNAL_ADDRESS && $_GET['forceExternal'] != 1) {
	
		echo "\n<!-- INTERNAL_ADDRESS -->\n";
		echo RV_OnlineSearch_Analytics_Google_Tracker::render_async_debug_library();
		
} else {
	
	// Global skip on internal traffic (unless ?forceExternal=1)
	if($_GET['forceExternal'] == 1) {
		echo "\n<!-- Faking EXTERNAL -->\n";
	}
	
	if(in_array($_SESSION['Marketing']['ChannelID'], array(5, 13))) { 
		// GA Pixel
		$GA = new RV_OnlineSearch_Analytics_Google_Tracker($GLOBALS['siteParams']->AnalyticsNumber_GA);
		$GA->mode_async(true);
		
		// GA Custom Data Object
		$GACustom = new RV_OnlineSearch_Analytics_Google_CustomData();
		$GACustom->push('V', $_SESSION['Tracker']->visitId, RV_OnlineSearch_Analytics_Google_CustomData::SCOPE_SESSION);
		$GACustom->push('MC', $_SESSION['Marketing']['MarketingCodeID'], RV_OnlineSearch_Analytics_Google_CustomData::SCOPE_SESSION);
		$GACustom->push('LP', RV_LandingPage::get_lpid(), RV_OnlineSearch_Analytics_Google_CustomData::SCOPE_SESSION);
		$GACustom->push('P', $_SESSION['Tracker']->pageId, RV_OnlineSearch_Analytics_Google_CustomData::SCOPE_PAGE);
		
		$GA->ga_set_custom_data_obj($GACustom);
		$GA->ga_set_site_speed_sample_rate(50);
		$GA->ga_track_page_view(true);
		
		echo $GA->render_tracking();
	}
	
}
