<?php

require_once($_SERVER['DOCUMENT_ROOT'] . 'define.php');

/**
 * Rope Address check for redesign, delivered to customers via ajax to avoid page reloads!
 * @TODO: Fix this file to account for suggested addresses from ATT
 * @author: Jose De La O Hernandez
 * @since: October, 15, 2015
 * @listeningTo: Siento Que... by Jumbo
 */

	use Rope\Client\RopeClient;

		try {

			RVLibraries\Rope\RopeApplication::include_phar();

			$RopeClient = new RopeClient();

			// Dstar rope application id
			$applicationProfileId = 22;

			// get address
			$addressObj = $_POST['address'];

			// sanitize post data
	        foreach($addressObj as $input => $val) {

		        $addressObj[$input] = preg_replace('/[^A-Za-z0-9\-\.\ \_]/', '', $val);
	        }

			// Set Vars
			$address = $addressObj['address'];
			$city = $addressObj['city'];
			$state = $addressObj['state'];
			$zip = $addressObj['zip'];

			//Check for these somehow
			$unitType = $addressObj['unitType'];
			$unitValue = $addressObj['unitNumber'];
			$_SESSION['unitType'] = $addressObj['unitType']; // so we can auto select dropdown on page refreshes
			$_SESSION['unitNumber'] = $addressObj['unitNumber']; // so we can auto select dropdown on page refreshes

			// Hailo tracking key passed via form!
            // Adding stripslashes for escaped quotes
            $cleanHud = stripslashes($_COOKIE['hud']);

			$Hud = new RV_Hailo_Hive_Hud($cleanHud);
			$trackingId = ($Hud->interactionId) ? $Hud->interactionId : time();

			$_SESSION['TID'] = $trackingId; //debugging, remove!

			$RopeClient->createSessionUsingTrackingId($applicationProfileId, $trackingId, 9);

			$Address = new \Rope\Model\Address();
			$Address->companyId = 1;
			$Address->primary = true;
			$Address->address = $address;
			//Let's only send if we have values, skip if we don't
			if(!empty($_POST['unitType'])){
				$Address->unitType = $unitType;
				$Address->unitValue = $unitValue;
			}
			$Address->city = $city;
			$Address->state = $state;
			$Address->zip = $zip;

			//Create Address arrays for each company
	    	$temp = $RopeClient->createAddresses($Address);
	    	$DTVAddress = $temp[1];
	    	$VZAddress = $temp[54];
	    	$CLAddress = $temp[59];
	    	$ATTAddress = $temp[65];
	    	$FRAddress = $temp[73];

			//Make sure each address was assigned an addressId
			if(!empty($VZAddress->addressId) && !empty($ATTAddress->addressId) && !empty($CLAddress->addressId) && !empty($DTVAddress) && !empty($FRAddress->addressId)){

				$AddressObjs = array(
					array("addressId" => $DTVAddress->addressId, "companyId" => 1),
					array("addressId" => $VZAddress->addressId, "companyId" => 54),
					array("addressId" => $CLAddress->addressId, "companyId" => 59),
					array("addressId" => $ATTAddress->addressId, "companyId" => 65),
					array("addressId" => $FRAddress->addressId, "companyId" => 73)
				);
			}

			//Run!
			$Serviceability = $RopeClient->runServiceableOnAddress($AddressObjs);

			// what providers to DISPLAY on website
			$providersToDisplay = isset($site_settings['serviceability']['providers_to_display']) ? $site_settings['serviceability']['providers_to_display'] : array('att');

			$ServiceabilityArray = array('serviceability' => $Serviceability, 'providersToDisplay' => $providersToDisplay);

			echo json_encode($ServiceabilityArray);

			// set serviceability session vars to true/false
			// this is only used to control what we display on the site, no functionality
			if ( $Serviceability[65]->maybeServiceable || $Serviceability[65]->serviceable ) {

				if ($_COOKIE['hud']) {
					$hud = new RV_Hailo_Hive_Hud($_COOKIE['hud']);
					$tracker = new RV_Hailo_Helper_TrackEvent();
					$tracker->set_token_from_hud($hud);
					$tracker->track_generic_event('att|result|' . $_POST['page'] . ' address check', array('result' => 'att'), RV_Hailo_Hive_Request_TrackEvent_Generic::STORE_LAST);
				}
			}
			else if ( $Serviceability[59]->maybeServiceable || $Serviceability[59]->serviceable ) {

				if ($_COOKIE['hud']) {
					$hud = new RV_Hailo_Hive_Hud($_COOKIE['hud']);
					$tracker = new RV_Hailo_Helper_TrackEvent();
					$tracker->set_token_from_hud($hud);
					$tracker->track_generic_event('cl|result|' . $_POST['page'] . ' address check', array('result' => 'cl'), RV_Hailo_Hive_Request_TrackEvent_Generic::STORE_LAST);
				}
			}
			else if ( $Serviceability[54]->maybeServiceable || $Serviceability[54]->serviceable ) {

				if ($_COOKIE['hud']) {
					$hud = new RV_Hailo_Hive_Hud($_COOKIE['hud']);
					$tracker = new RV_Hailo_Helper_TrackEvent();
					$tracker->set_token_from_hud($hud);
					$tracker->track_generic_event('vz|result|' . $_POST['page'] . ' address check', array('result' => 'vz'), RV_Hailo_Hive_Request_TrackEvent_Generic::STORE_LAST);
				}
			}
			else {

				if ($_COOKIE['hud']) {
					$hud = new RV_Hailo_Hive_Hud($_COOKIE['hud']);
					$tracker = new RV_Hailo_Helper_TrackEvent();
					$tracker->set_token_from_hud($hud);
					$tracker->track_generic_event('hsi|result|' . $_POST['page'] . ' address check', array('result' => 'hsi'), RV_Hailo_Hive_Request_TrackEvent_Generic::STORE_LAST);
				}
			}

			//JRL --> RVHOMEDEV-613 adding two generic hailo events for IVR routing
			try {

				if ($_COOKIE['hud']) {
					$source = isset($_POST['source']) ? $_POST['source'] : 'input';
					$sourceArray = array('source' => $source);
					$hud = new RV_Hailo_Hive_Hud($_COOKIE['hud']);
					$tracker = new RV_Hailo_Helper_TrackEvent();
					$tracker->set_token_from_hud($hud);
					$tracker->track_generic_event('serviceCheck', $sourceArray, RV_Hailo_Hive_Request_TrackEvent_Generic::STORE_LAST);
				}
			} catch (Exception $e) {}

			// update webLocation
			$WebLocation->address = ucwords( strtolower($address) );
			$WebLocation->city = ucwords( strtolower($city) );
			$WebLocation->region = $state;
			$WebLocation->postalCode = $zip;
			$WebLocation->sync();

			exit;


		} catch(Exception $e) {
			echo json_encode('rope error');
			exit;
		}
?>
