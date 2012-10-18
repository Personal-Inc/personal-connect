<?php
require_once 'config/config.php';
require_once 'config/personalconfig.php';
//check curl is enabled or not
//throw exception if not enabled
if (!function_exists('curl_init')) {
	throw new Exception('Personal needs the CURL PHP extension.');
}

//check json is enabled or not
//throw exception if not enabled
if (!function_exists('json_decode')) {
	throw new Exception('Personal needs the JSON PHP extension.');
}

function getPersonalCode() {
	$url = PERSONAL_URL;
	$fields = array(
			  'client_id'			=> PERSONAL_CLIENT_ID,
			  'response_type'		=> code,
			  'redirect_uri' 		=> PERSONAL_URL,
			  'scope'				=> 'read_contacts',
			  'update'				=> 'false'
			  );

			  return getResponse($url, $fields);
}

function getResponse($url, $fields) {
	$fields_string = createRequestString($fields);

	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
	//curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "charset=UTF-8"));

	//execute post
	$result = curl_exec($ch);

	//show(curl_getinfo($ch));
	//close connection
	curl_close($ch);

	return $result;
}

function createRequestString($fields) {
	//url-ify the data for the POST
	$fields_string = "";
	foreach($fields as $key => $value) {
		$fields_string .= $key.'='.urlencode($value).'&';
	}
	//show(rtrim($fields_string, '&'), 1);
	return rtrim($fields_string, '&');
}

function getGemList() {
	$accessToken 	= $_SESSION['personal_accessToken'];
	$url 			= PERSONAL_URL.'api/v1/gems?client_id='.PERSONAL_CLIENT_ID;

	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$accessToken, 'Secure-Password: '.PERSONAL_SHARED_SECRET));

	//execute post
	$result = curl_exec($ch);

	//close connection
	curl_close($ch);

	$response 					= json_decode($result);
	$gems 						= $response->gems;

	$_SESSION['oauth_provider'] = 'personal';
	$_SESSION['id'] 			= 'personal';
	$_SESSION['gems'] 			= $gems;
	header("Location: home.php");
}

function getGemDetail($gemId) {
	$accessToken 	= $_SESSION['personal_accessToken'];
	$url 			= PERSONAL_URL.'api/v1/gems/'.urlencode($gemId).'?client_id='.PERSONAL_CLIENT_ID;

	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$accessToken, 'Secure-Password: '.PERSONAL_SHARED_SECRET));

	//execute post
	$result = curl_exec($ch);

	//close connection
	curl_close($ch);

	$response 							= json_decode($result);

	$details 							= $response->gem->data;
	
	$array['contact_info_name'] 		= isset($details->contact_info_name) 		? $details->contact_info_name 		: '';
	$array['personal_email'] 			= isset($details->personal_email) 			? $details->personal_email 			: '';
	$array['personal_secondary_email'] 	= isset($details->personal_secondary_email) ? $details->personal_secondary_email: '';
	$array['home_mobile_phone'] 		= isset($details->home_mobile_phone) 		? $details->home_mobile_phone 		: '';
	$array['home_phone'] 				= isset($details->home_phone) 				? $details->home_phone 				: '';
	$array['contact_info_fax'] 			= isset($details->contact_info_fax) 		? $details->contact_info_fax 		: '';
	$array['personal_website'] 			= isset($details->personal_website) 		? $details->personal_website 		: '';
	$array['facebook_profile'] 			= isset($details->facebook_profile) 		? $details->facebook_profile 		: '';
	$array['twitter_name'] 				= isset($details->twitter_name) 			? $details->twitter_name 			: '';
	
	return $array;
}
