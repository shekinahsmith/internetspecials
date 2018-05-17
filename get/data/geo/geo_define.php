<?
	define("ISGEO", TRUE);
	define("GEO_DIR", '%%GEO_DIR%%');
	
	include_once($_SERVER['DOCUMENT_ROOT']."define.php");

	//instantiate geonator to determine where we are and set the geo variables
	$geo = new RV_Tools_Geonator2(GEO_DIR,SITEID,'',DEBUG);
	

	//will validate, or redirect to the appropriate URL
	//this will fill in the variables for state, city, etc.
	$geo->validate_or_redirect($_SERVER['SCRIPT_URI']);
	
	
    $geo->defaultPhoneNumber = $sitePhone;//important!
    $geo->PromoCode = $sitePromoCode;
    
    $headerTitle = $geo->title();//the title (without the HTML tag)
    $metaDescription = $geo->description(false);
    $metaKeywords = $geo->keywords(false);
    
		
    //get the render path
	$incPath = $_SERVER['DOCUMENT_ROOT'] . $geo->render();
	
	//make sure its a file
	if( is_file($incPath) ) {
		
		include_once($incPath);
		
	}else{
		
		echo "Cant find include file";
		
	}
?>
