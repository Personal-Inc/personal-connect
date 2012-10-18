<?php
// including necessary files
require_once 'config/config.php';
require_once 'config/personalconfig.php';
require_once 'personal/personal.php';

if (!empty($_REQUEST['code'])) {
	$code 	= $_REQUEST['code'];
	$url 	= PERSONAL_URL.'oauth/access_token';
	$fields = array(
	    'grant_type'		=> 'authorization_code',
	 	'code'				=> $code,
	 	'client_id'			=> PERSONAL_CLIENT_ID,
	 	'client_secret'		=> PERSONAL_SHARED_SECRET,
	 	'redirect_uri'		=> RESPONSE_URL
	);

	$accessTokenResponseJSON	= getResponse($url, $fields);
	$accessTokenResponse		= json_decode($accessTokenResponseJSON);
	$accessToken 				= $accessTokenResponse->access_token;

	$_SESSION['personal_accessToken'] = $accessToken;
	getGemList();
} else {
	$url = PERSONAL_URL.'oauth/authorize';
	$fields = array(
			  'client_id'			=> PERSONAL_CLIENT_ID,
			  'response_type'		=> 'code',
			  'redirect_uri' 		=> RESPONSE_URL,
			  'scope'				=> 'read_0001',
			  'update'				=> true
	);

	$fields_string  = createRequestString($fields);
	header("Location: $url?$fields_string");
}