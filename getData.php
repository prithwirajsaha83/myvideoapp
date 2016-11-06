<?php 
// GEt Curl Helper class required to call our REST API
require_once 'curlHelper.php';
// Create Key for Data layer auth 
define("DATA_LAYER_ROOT", "http://myvideoappdb.localhost");
// Create authentication keys
$timeStamp = time();
$hash = hash_hmac("sha256", "vid30_APP" . strrev("OTPB3Ne65vMm") .":". strrev($timeStamp) , "OTPB3Ne65vMm");
// Create URL to send request to 
$url = DATA_LAYER_ROOT . '/rest/watchedvideos.json';


$currentSessionId = $_POST['sessionId'];
// Assign timestamp and hash to postarray else REST API won't grant access
$postArray['ts'] =  $timeStamp;
$postArray['sig'] =  $hash;
// Send a curl request and get teh data
$curlObj = new Curl;
$curlReturn = $curlObj->get($url, $postArray);
$result = json_decode($curlReturn->response,TRUE);


$searchFor = $currentSessionId;
// Filter out matching sessions from the records returned
$filteredArray = array_filter($result, function($element) use($searchFor){
  return isset($element['sessionId']) && $element['sessionId'] == $searchFor;
});

echo json_encode($filteredArray);