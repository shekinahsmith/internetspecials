<?
	/*
	*	Do -NOT- test this file, split _legal-footer-experience.php
	*/

	// Set the var to an empty string
	$legalFooterAdditional = '';

	// extra legal based on page, use addition here
	switch($_SERVER['SCRIPT_URL']) {

	  	case '/':
		   //$legalFooterAdditional .= '<p>*' . $attLegal->ATTWiFiFree->Language->English . '</p>';
	  	   $legalFooterAdditional = '';
		break;

	  	case '/u-verse-internet.html':
	  		//$legalFooterAdditional .= '<p>*' . $attLegal->ATTWiFiFree->Language->English . '</p>';
	  	    $legalFooterAdditional = '';
		break;

	}

	// include the experience legal
	include(RV_LandingPage::find('includes/legal/_legal-footer-experience.php'));

?>