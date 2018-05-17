<?php
require_once("{$_SERVER['BaseIncludesPath']}/base_core.inc");

// Split rollups
/*
$rollupPrograms = array(
	'webdefault',
);
RV_WebTools::roll_it_up(DEFAULTREFERID, array('webdefault'));
*/

$sitePhone 			= "1-" . $_SESSION['Marketing']['PhoneNumber'];
//Old promo code based on visit id (123456789)
//$sitePromoCode 		= $tracker->visitId;
//New promo code from base core (456-789)
$sitePromoCode          = $_SESSION["SearchVars"]["PromoCode"] ? $_SESSION["SearchVars"]["PromoCode"] : $tracker->visitId; 
$sitePromoPrompt 	= "Promo Code:";
