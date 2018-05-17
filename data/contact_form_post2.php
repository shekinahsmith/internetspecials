<?
    require_once('define.php');
	get_id_action();

  // Strip tags, sanitize input from all form vars submitted
  foreach( $_POST as $field => $value ) {
  	$_POST[$field] = preg_replace('/[^A-Za-z0-9\-\@\.\%\ \_\/]/', '', urldecode($value));
  }

	$_SESSION['ContactArray'] = $_POST;

	//  ////////////////////////
	//  create a new lead
	if($action == 'create_lead') {

		$_SESSION['form_rmsg'] = "";

        $_POST['FirstName'] = preg_replace("['|&]", "", $_POST['FirstName']);
        $_POST['LastName'] = preg_replace("['|&]", "", $_POST['LastName']);

        $FormValidator = new RV_Validator();
        $FormValidator->attach_required_field('FirstName', new RV_Validator_Name());
        $FormValidator->attach_required_field('LastName', new RV_Validator_Name());
        $FormValidator->attach_required_field('Phone1', new RV_Validator_Phone());
        $FormValidator->attach_required_field('ZipCode', new RV_Validator_Zip());
//        $FormValidator->attach_required_field('City', new RV_Validator_Address());
//        $FormValidator->attach_required_field('Email', new RV_Validator_Email());

        try {

        	$FormValidator->validate( $_POST );

        } catch (RV_Validator_Exception $e) {


        	$_SESSION['bad_fields'] = $FormValidator->get_failing_fields();

        }

    	// if we are using the clickclear form (values inside of input already, not label)
    	// this to adds the specified fields to the bad_fields array so that it will not submit
    	// while the values are 'First Name' and 'Last Name' for example

    	if ($_POST['FirstName'] == 'First Name') {

	    		$_SESSION['bad_fields'][] = 'FirstName';

    	}

    	if ($_POST['LastName'] == 'Last Name') {

	    		$_SESSION['bad_fields'][] = 'LastName';

    	}

    	// if we have bad fields, set error message and redirect back to page where form failed
    	if ( !empty($_SESSION['bad_fields']) ) {

	    	$_SESSION['form_rmsg'] = "Please fix the highlighted fields";

	    	header('Location: ' . r3d(trim($_POST['ref'])));
			exit;
    	}

        // Get company info
        $key = "$companyID::".SITEID;
        $CompanyInfo = RV_Cache::get($key);

        if($CompanyInfo === false) {

        	$CompanyInfo = DB_Corporate_Companies::fetch_by_id($companyID);
        	// set cache expiry to 1 year
        	RV_Cache::set($key, (!$CompanyInfo ? "empty" : $CompanyInfo), 30758400);

        }

        // Create a new lead object
    	$leadObjString = str_replace(" ", "", $CompanyInfo->CompanyName) . "Lead";
		$leadObj = new $leadObjString();
        $leadArray = Array();
        $leadArray['Live']                    = "true";
        $leadArray['LeadType']                = 'residential';
        $leadArray['MarketingCodeID']         = $_SESSION['Marketing']['MarketingCodeID'];
        $leadArray['FirstName']               = trim($_POST['FirstName']);
        $leadArray['LastName']                = trim($_POST['LastName']);
        $leadArray['ZipCode']                 = trim($_POST['ZipCode']);
        $leadArray['Phone1']                  = clean_phone_number($_POST['Phone1']);
		$leadArray['Phone2']                  = clean_phone_number($_POST['Phone2']);

		// $leadArray['City']				  = trim($_POST['City']);
		// $leadArray['Email']                = trim($_POST['Email']);

        $leadArray['DialerType']              = 'dialer';
        $leadArray['VisitID']      			  = $_SESSION['Tracker']->visitId;
        // fetch PageID, if applicable
		$pageId = RV_WebTools::get_pageid_form_value($_REQUEST['PageID']);
		if($pageId !== false) {
			$leadArray['PageID']      		  = $pageId;
		}

        /**
         * TCPA Consent Disclosure Fields
         */
        $leadArray['ConsentDisclosureID'] = trim($_POST['ConsentDisclosureID']);
        $leadArray['DisclosureHash']  = trim($_POST['DisclosureHash']);


        if(!$leadObj->process_lead($leadArray)) { // failure :(

            $errorSystemID = 27;
            // we hit an error, send a rederror
			$tmpErrorArray = array(
				array('ErrorNumber' => 101)
			);

            $configArray							= array();
            $configArray['ErrorArray']				= $tmpErrorArray;
            $configArray['ErrorSystemID']			= $errorSystemID; // ----- this is optional, it will default to a defined var RED_ERROR_SYSTEM_ID or 20 which is RedVentures Default
            $configArray['ErrorDisplayType']		= 'internal'; // or 'external' ---- this is optional, it will default to "external"
            $configArray['ErrorDisplaySeparator']	= ', '; // ---- this is optional, Default is: "<br />\n "
            $_SESSION['form_rmsg'] 					= $leadObj->errorText;

        } else {

            // success
            $leadId = $leadObj->leadId;
            $_SESSION['ContactArray']['LeadID'] = $leadId;
            $_SESSION['ContactArray']['LeadObj'] = $leadObj;
            if ($_POST['thankyoupage']) {
                header('Location: ' . $_POST['thankyoupage']);
            	exit;
            }

    		header('Location: contact-thankyou.html');
    		exit;

        }

	}

    header('Location: ' . r3d(trim($_POST['ref'])));
	exit;

?>
