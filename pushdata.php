<?php 
// GEt Curl Helper class required to call our REST API
require_once 'curlHelper.php';
// Create Key for Data layer auth 
define("DATA_LAYER_ROOT", "http://myvideoappdb.localhost");
// Create authentication keys
$timeStamp = time();
$hash = hash_hmac("sha256", "vid30_APP" . strrev("OTPB3Ne65vMm") .":". strrev($timeStamp) , "OTPB3Ne65vMm");
// Create URL to send request to 
$url = DATA_LAYER_ROOT . '/watchedvideos/save.json';

// Assing data

$postArray = $_POST;


$postArray['ts'] =  $timeStamp;
$postArray['sig'] =  $hash;
// Send a curl request and post the data
$curlObj = new Curl;
$curlReturn = $curlObj->post($url, $postArray);
$result = json_decode($curlReturn->response);
//Return insert results
echo $result->watchedvideos->id;