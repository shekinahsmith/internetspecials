<?php

//include geo version of header
include_once("geo_header.php");

//breadcrumb nav
echo '<div id="geo_breadcrumbs">';
		$geo->breadcrumbs();
echo '</div>';
 
echo $geo->content();
//include geo version of footer
include_once("geo_footer.php");

?>