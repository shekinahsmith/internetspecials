<?php

require_once("define.php");

use Rope\Client\RopeClient;
RVLibraries\Rope\RopeApplication::include_phar();


// when using full address check
$_SESSION['submission'] = $_POST;
$redirectVal = isset($_POST['redirect']) ? $_POST['redirect'] : '';
$redirectURL = !empty($redirectVal) ? $redirectVal : '/plans.html';

// Strip tags, sanitize input from all form vars submitted
foreach( $_POST as $field => $value ) {
      $_POST[$field] = preg_replace('/[^A-Za-z0-9\-\@\.\%]/', '', strip_tags($_POST[$field]));
}

$zip = trim($_POST['AvailabilityZipCode']);

$FormValidator = new RV_Validator();
$FormValidator->attach_required_field('AvailabilityZipCode', new RV_Validator_Zip());

try {

    $FormValidator->validate( $_POST );

} catch (RV_Validator_Exception $e) {

    $_SESSION['zip_rmsg'] = "Please enter a valid 5-digit zip code";
    $_SESSION['bad_fields'] = $FormValidator->get_failing_fields();

    header("Location: /");

    exit;

}

$_SESSION['ATTServiceability']['Zip'] = $zip;
$_SESSION['ATTServiceability']['EnteredZip'] = true;

try{

  $RopeClient = new RopeClient();
  $serviceabilityObj = $RopeClient->getServiceabilityPercentages($zip);

  $WebLocation->set_source(RV_Web_Location_Enum::SOURCE_ZIPSUBMIT);
  $WebLocation->postalCode = $zip;
  $WebLocation->notify();

  if($serviceabilityObj->ATTServiceablePerc > 49){
    $_SESSION['ATTServiceability']['Serviceable'] = true;
  } else {
    $_SESSION['ATTServiceability']['Serviceable'] = false;
  }

  //RVHOMEDEV-903
  //let's save the serviceability percentages in an array if the perc is over 0 ...
  $servArray = array();
  foreach($serviceabilityObj as $key => $val) {
    if(strpos($key, "ServiceablePerc") !== false && $val != 0) {
      $servArray[$key] = $val;
    }
  }

  //... add the zip for hailo storing ...
  $servArray['zipCode'] = $zip;

  $hud = new RV_Hailo_Hive_Hud($_COOKIE['hud']);
  $TrackEventHelper = new RV_Hailo_Helper_TrackEvent();
  $TrackEventHelper->set_token_from_hud($hud);
  $TrackEventHelper->track_generic_event('zipServiceability', $servArray);

} catch (Exception $e) {

}

header("Location: " . $redirectURL);
exit;

?>
