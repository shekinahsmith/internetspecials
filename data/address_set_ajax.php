<?php

	require($_SERVER['DOCUMENT_ROOT'] . 'define.php');

    /*
	 * ajax request to sync weblocation based on zip code and return single internet amount and bundle pricing based on that zip
	 */

	// address vars
	$addressObj = $_POST['address'];
	
	// sanitize post data
    foreach($addressObj as $input => $val) {
        
        $addressObj[$input] = preg_replace('/[^A-Za-z0-9\-\.\ \_]/', '', $val);
    }
    
	// assign new sanitized values
	$address = $addressObj['street'];
	$unitType = $addressObj['unitType'];
	$unitValue = $addressObj['unitNumber'];
	$unitOwnership = $addressObj['unitOwnership'];
	$city = $addressObj['city'];
	$state = $addressObj['state'];
	$zip = $addressObj['zip'];

	// sync
	$WebLocation->address = ucwords( strtolower($address) );
	$WebLocation->city = ucwords( strtolower($city) );
	$WebLocation->region = $state;
	$WebLocation->postalCode = $zip;
	$WebLocation->sync();

	$_SESSION['unitType'] = $unitType; // so we can auto select dropdown on page refresh
	$_SESSION['unitNumber'] = $unitValue; // so we can auto select dropdown on page refresh
	$_SESSION['unitOwnership'] = $unitOwnership; // so we can auto select dropdown on page refresh
	$_SESSION['streetAddress'] = $address; // so we can prepopulate address on page refresh

	// build address to return (key these to be identical to rv_geocode just in case we need to go that route in the future)
	$address = array(
		'street_address' => ucwords(strtolower($address)),
		'city' => $WebLocation->city, 
		'state' => $WebLocation->region, 
		'postal_code' => $WebLocation->postalCode,
		'formatted_address' => ucwords(strtolower($address)) . ', ' . $WebLocation->city . ', ' . $WebLocation->region . ' ' . $WebLocation->postalCode
	);

	$ServiceabilityArray = array(
		'address' => $address
	);

	// return
	echo json_encode($ServiceabilityArray);

	exit;
