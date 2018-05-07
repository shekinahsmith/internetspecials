<?php

    require_once('define.php');

    /*****
    Validate input fields
     *****/

    foreach($_POST as $field => $value) {
        $_POST[$field] = strip_tags($_POST[$field]);
    }

    $_SESSION['submission'] = $_POST;

    $_POST['state'] = strtoupper($_POST['state']);
    $zip = trim($_POST['zip']);
    $_POST['form_rmsg'] = "";

    $FormValidator = new RV_Validator();
    $FormValidator->attach_required_field('street', new RV_Validator_StreetName());
    $FormValidator->attach_required_field('city', new RV_Validator_Address());
    $FormValidator->attach_optional_field('unitType', new RV_Validator_Address());
    $FormValidator->attach_optional_field('unitValue', new RV_Validator_Address());
    $FormValidator->attach_required_field('state', new RV_Validator_State());
    $FormValidator->attach_required_field('zip', new RV_Validator_Zip());
    try {

        $FormValidator->validate($_POST);

    } catch (RV_Validator_Exception $e) {

        $_SESSION['bad_fields'] = $FormValidator->get_failing_fields();

        header("Location: /");
    }

    // if we have bad fields, set error message and redirect back to page where form failed
    if (!empty($_SESSION['bad_fields']) ) {

        $_SESSION['form_rmsg'] = 'Please fix the highlighted fields';

        header('Location: /');
        exit;
    }

    use Rope\Client\RopeClient;
    RVLibraries\Rope\RopeApplication::include_phar();

    // This is the Id for att serviceability check on internetspecials.com.
    $applicationProfileId = 15;

    // Create a new Rope Client
    $RopeClient = new RopeClient(null, 'production');

    //Setting hailo tracking ID as tracking ID for rope client
    if(isset($_SESSION['Hailo']['hud']) && !empty($_SESSION['Hailo']['hud'])) {

        $trackingId = json_decode($_SESSION['Hailo']['hud']);
        $trackingId = intval($trackingId->i, 10);

    } else {

        //Setting trackingId to zero. On the sales ops side, this will mean hailo id is not being passed.
        $trackingId = 0;

    }

    // Create a Rope Session
    $ropeId = $RopeClient->createSessionUsingTrackingId($applicationProfileId, $trackingId, 9);

    //Populate address model
    $Address = new \Rope\Model\Address();
    $Address->companyId = 65;
    $Address->primary = true;
    $Address->address = $_POST['street'];
    if(isset($_POST['unitType']) && $_POST['unitType'] != 'NONE'){
        $Address->unitType = $_POST['unitType'];
        $Address->unitValue = $_POST['unitValue'];
    }
    $Address->city = $_POST['city'];
    $Address->state = $_POST['state'];
    $Address->zip = $_POST['zip'];

    //Set the appropriate vars
    $_SESSION['ATTServiceability']['Zip'] = $zip;
    $_SESSION['ATTServiceability']['EnteredZip'] = true;
    $_SESSION['ATTServiceability']['Serviceable'] = false;

    try {

        $temp = $RopeClient->createAddresses($Address);
        $Address = $temp[65];
    
    } catch (Exception $e) {

        header("Location: /plans.html#results");
        exit;
    }

    $addressArray = array(
        array(
            "addressId" => $Address->addressId,
            "companyId" => 65
        )
    );

    /** Run serviceable request on address */
    try {

        $Response = $RopeClient->runServiceableOnAddress($addressArray);

    } catch (Exception $e){

        header("Location: /plans.html#results");
        exit;

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

    } elseif ($Response[65]->isMaybeServiceable()) {

        $hailoTrackedServices["MaybeServiceable"] = 1;
        
    } else {
        
        $hailoTrackedServices['Unserviceable'] = 1;
        $serviceableCustomer = false;
    }

    //Pricing grid vars
    if ($Response[65]->isServiceable() || $Response[65]->isMaybeServiceable()) {
        $_SESSION['ATTServiceability']['Serviceable'] = true;
        $serviceableCustomer = true;
    }

    try {

        // Hud cookie is the Hailo identifier and will only be present
        // if the visitor is Hailo-enabled.
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
            
            try {
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

            } catch (Exception $e) {
                // lol
            }

            // For testing purposes only, will remove soon
            $_SESSION['contextID'] = $Client->getContext();

            //echo "contextID was {$Client->getContext()}" . PHP_EOL; die;

        }

    } catch (Exception $e) {

        // Nothing to see here, move along.
    }


    header("Location: /plans.html#results");

?>
