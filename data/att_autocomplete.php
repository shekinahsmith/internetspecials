<?php

    define('DS_SCRIPT', TRUE);
    header('Content-Type', 'application/json');

    /***** ONLY UNCOMMENT autoload.php IF TESTING LOCALLY, ELSE DO NOT TOUCH *****/
    //require_once('vendor/autoload.php');
    /***** ONLY UNCOMMENT autoload.php IF TESTING LOCALLY, ELSE DO NOT TOUCH *****/

    /* Autocomplete script that utilizes USPS address info */
    $getAddress = $_GET['term'];

    if ($getAddress == "") {
        exit;
    }

    // Json encode response that can be used by Ajax request to autocomplete address
    try {

        $AddressFill = new RV_Helper_AddressAutoComplete(RV_Helper_AddressAutoComplete::DRIVER_USPS, RV_Helper_AddressAutoComplete::ENV_PRODUCTION);
        $aResponses = $AddressFill->autoCompleteNoZip($getAddress);

    } catch (Exception $e) {
        exit;
    }

    $listAddress = array();
    $x = 1;
    foreach ($aResponses->streets as $street) {

        $listAddress[] = array(
                                'label' => $street->formattedAddress,
                                'value' => $x,
                                'fields' => $street
                            );
        $x++;
    }

    echo json_encode($listAddress);

?>