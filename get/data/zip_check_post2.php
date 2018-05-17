<?php

require_once("define.php");

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
    $availability = DB_ATT_MarketZip::is_serviceable($zip);
    $WebLocation->set_source(RV_Web_Location_Enum::SOURCE_ZIPSUBMIT);
    $WebLocation->postalCode = $zip;
    $WebLocation->notify();

   if(!$availability){
      $_SESSION['ATTServiceability']['Serviceable'] = false;
   } else {
      $_SESSION['ATTServiceability']['Serviceable'] = true;
   }


} catch (Exception $e) {

}

header("Location: /plans.html");
exit;

?>
