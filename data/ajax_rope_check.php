<?php

    require_once('define.php');

    use Rope\Client\RopeClient;
    try{

        RVLibraries\Rope\RopeApplication::include_phar();

        // This is the Id for att serviceability check on internetspecials.com.
        $applicationProfileId = 15;

        // Create a new Rope Client
        // $RopeClient = new RopeClient(null, 'production');
        $RopeClient = new RopeClient();

        // Check for hailo interaction id
        $Hud = new RV_Hailo_Hive_Hud($_COOKIE['hud']);
        $trackingId = ($Hud->interactionId) ? $Hud->interactionId : 0; // Default to zero if no interactionId

        // Create a Rope Session
        $ropeId = $RopeClient->createSessionUsingTrackingId($applicationProfileId, $trackingId, 9);

        //Populate address model
        $Address = new \Rope\Model\Address();
        $Address->companyId = 65;
        $Address->primary = true;
        $Address->address = $_POST['street'];
        if($_POST['unitType'] != 'NONE'){
            $Address->unitType = $_POST['unitType'];
            $Address->unitValue = $_POST['unitValue'];
        }
        $Address->city = $_POST['city'];
        $Address->state = $_POST['state'];
        $Address->zip = $_POST['zip'];

        //Set the appropriate vars
        $_SESSION['ATTServiceability']['Zip'] = $_POST['zip'];
        $_SESSION['ATTServiceability']['EnteredZip'] = true;
        $_SESSION['ATTServiceability']['Serviceable'] = false;

        $temp = $RopeClient->createAddresses($Address);
        $Address = $temp[65];

        // Get each company's address id
        $addressIds = array();
        foreach ( $temp as $companyId => $v ) {
            if ( $companyId != $Address->companyId ) {
                $addressIds[$companyId] = $v->addressId;
            }
        }

        $addressArray = array(
            array(
                "addressId" => $Address->addressId,
                "companyId" => 65
            )
        );

        $Response = $RopeClient->runServiceableOnAddress($addressArray);

        // Gather information to record in multi-serviceability
        $storeAddress = array(
            'addressIds' => $addressIds
        );

        // Store serviceability record in corporate db (sanity check the interactionId first)
        if ( $trackingId != 0 ) {
            storeServiceabilityRecord($trackingId, $ropeId, json_encode($storeAddress));
        }

        //Serviceability meta object
        $Serviceability = $Response[65]->metaObject;

        //IVR needed vars
        if ($Response[65]->isServiceable()) {

            $hailoTrackedServices = array(
                                            "Fiber" => $Serviceability->hasFiber(),
                                            "Video" => $Serviceability->hasVideo(),
                                            "VOIP" => $Serviceability->hasVOIP(),
                                            "AccessLine" => $Serviceability->hasAccessLine(),
                                            "hasDSL" => $Serviceability->hasDSL()
                                        );

            $serviceableCustomer = serviceability(true);

        } elseif ($Response[65]->isMaybeServiceable()) {

            $hailoTrackedServices["MaybeServiceable"] = 1;
            $serviceableCustomer = serviceability(true);

        } else {

            $hailoTrackedServices['Unserviceable'] = 1;
            $serviceableCustomer = serviceability(false);
        }

        $hud = $_COOKIE['hud'];

        if ($hud){

            $TrackEventHelper = new RV_Hailo_Helper_TrackEvent();
            $TrackEventHelper->set_token_from_hud($hud);

            //RVHOMEDEV-1046
            $zipToIvrHelper = new RV_Hailo_Helper_TrackEvent();
            $zipToIvrHelper->set_token_from_hud($hud);
            $zipCodeEvent = $zipToIvrHelper->track_generic_event('ZipCode', array('ZipCode' => r3a($_POST['zip'], false)));
            //END OF RVHOMEDEV-1046

            if ($serviceableCustomer) {

                $response = $TrackEventHelper->store_serviceability(true, $hailoTrackedServices);

            } else {

                $response = $TrackEventHelper->store_serviceability(false, $hailoTrackedServices);
            }

            // RVHOMEDEV-409 Let's send these events to Tagular!
            $Client = RV_Helper_Tagular::get_dmp_client(
                RV_Constants_Companies::ATT,
                'alias.hailo',  $trackingId
            );

            $Client->alias('hailo',  $trackingId);

            if ($hailoTrackedServices['Video'] == 'true') {
                $Client->track('hasVideo');
            }
            if ($hailoTrackedServices['Fiber'] == 1) {
                $Client->track('hasFiber');
            }
            if ($hailoTrackedServices['VOIP'] == 'true') {
                $Client->track('hasVOIP');
            }
            if ($hailoTrackedServices['AccessLine'] == 'true') {
                $Client->track('hasAccessLine');
            }
            if ($hailoTrackedServices['hasDSL'] == 'true') {
                $Client->track('hasDSL');
            }
            if ($hailoTrackedServices['Unserviceable'] == 1) {
                $Client->track('isUnserviceable');
            }
        }

    } catch (Exception $e){

       print_r($e->getMessage());
        exit;

    }

    function serviceability($true){

        if($true === true){

            $_SESSION['ATTServiceability']['Serviceable'] = true;
            $serviceableCustomer = true;
            echo json_encode(array("serviceable" => true));
            return true;

        }else{
            echo json_encode(array("serviceable" => false));
            return false;
        }
    }

    // Inserts record into MultiServiceability
    function storeServiceabilityRecord($interactionID, $ropeId, $addressInfo) {

        // Get a date
        $insertDate = date("Y-m-d");

        // Get a datetime
        $insertDateTime = DateTime::createFromFormat("Y-m-d", $insertDate);
        $insertDateTime = $insertDateTime->format("Y-m-d H:i:s");

        // Insert
        $resp = DB_ATT_MultiServiceability::insertRecord($interactionID, $ropeId, $addressInfo, $insertDate, $insertDateTime);
    }

?>