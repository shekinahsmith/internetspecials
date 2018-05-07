<?php 

require_once("define.php");


if (!isset($_SESSION['Hailo']['RedirectOriginalRequestURI'])) {
    // We need the original query string to get the zip code
    header("Location: /");
}

parse_str(str_replace("/?","",$_SESSION['Hailo']['RedirectOriginalRequestURI']),$originalQueryStringArr);
$zip = $originalQueryStringArr['zip_code'] ? $originalQueryStringArr['zip_code'] : trim($_GET['zip_code']);

if (!$zip) {
  header("Location: /");
  exit;
}

if (!RV_Validator_Zip::validate_value($zip)) {
    
    $_SESSION['zip_rmsg'] = "Please enter a valid 5-digit zip code";
    $_SESSION['bad_fields'] = "AvailabilityZipCode";
    
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