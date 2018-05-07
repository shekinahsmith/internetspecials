<?php
/**
 * RVHOMEDEV-787 Switching to Server side API key due to deprecation of client side key
 * This script will be called via Ajax by rv-geocode, and return the response from google geocoding api
 * @author: Jose De La O
 * @since: December 4, 2015
 *listeningTo: Cannabis - Ska-P
 *
 */

define('DS_SCRIPT', TRUE);

require_once( $_SERVER['DOCUMENT_ROOT'] . "define.php" );

// All these params are needed in order for rv-geocode.js to work correctly
if ( !$_GET['latlng'] || !$_GET['key'] || !$_GET['result_type'] ) {

	echo json_encode( throwError( "The request's lat, long, or result type is either missing or malformed.", 0 ) );
	exit;
}

// Make the request to Google for an address on visitor's behalf
$url = "https://maps.googleapis.com/maps/api/geocode/json?" . http_build_query( $_GET );
$cURL = curl_init( $url );

curl_setopt( $cURL, CURLOPT_TIMEOUT, 2 );
curl_setopt( $cURL, CURLOPT_CONNECTTIMEOUT, 4 );
curl_setopt( $cURL, CURLOPT_RETURNTRANSFER, TRUE );

$response = curl_exec( $cURL );
curl_close( $cURL );

if ( $response ) {
	echo ( $response ); // Success!
	exit;
}

// Keeping my error naming consistent with Google Error naming conventions. NOTE: This can be expanded to account for future front-end(rv-geocode.js) changes.
function throwError($errorMsg, $errorCode) {

	$status = array( 0 => "MISSING_COORDINATES_PARAMS", 1 => "INVALID_REQUEST_FORMAT", 2 => "UNKNOWN_ERROR" );

	return array(
				"error_message" => $errorMsg,
				"results" => array(),
				"status" => $status[$errorCode]
			);
}

?>