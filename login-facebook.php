<?php
// including necessary files
require 'config/config.php';
require 'facebook/facebook.php';
require 'config/facebook.php';

// create object with the help of app id and secret key
$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            'cookie' => true
));

// get facebook session details 
$session = $facebook->getSession();

if (!empty($session)) {
	try {
		// fetch user profile details with the help of "/me" api
		$user = $facebook->api('/me');
		if (!empty($user)) {
			// store user information in session
			$_SESSION['id'] 							= $user['id'];
			$_SESSION['username'] 						= $user['username'];
			$_SESSION['oauth_provider'] 				= 'facebook';

			$_SESSION['name'] 							= $user['name'];
			$_SESSION['link'] 							= $user['link'];
			$_SESSION['username'] 						= $user['username'];
			$_SESSION['hometown']['name'] 				= $user['hometown']['name'];
			$_SESSION['location']['name'] 				= $user['location']['name'];
			$_SESSION['bio'] 							= $user['bio'];
			$_SESSION['gender'] 						= $user['gender'];
			$_SESSION['timezone'] 						= $user['timezone'];
			$_SESSION['locale'] 						= $user['locale'];

			// as user might have multiple languages
			// facebook gives it in arrays
			// use this array to format a string
			if (!empty($user['languages'])) {
				$languages = '';
				foreach ($user['languages'] as $language) {
					$languages .= $language['name'].', ';
				}
				$languages = rtrim($languages, ', ');
			}
			$_SESSION['languages'] 						= $languages;

			// after this values are set, redirect to home to display them
			header("Location: home.php");
		}
	} catch (Exception $e) {
		// catch an exception if something went wrong
		echo 'Ooops!! Something went wrong!!!';
		echo 'error occurred is '.$e.'<br />';  
		$redirect_url = "<a href='{$facebook->getLoginUrl()}'>Click here to login</a>";
		die("If you are logged out from facebook. $redirect_url");
	}
} else {
	// most probably there's no active session
	// redirect user to generate one
	$login_url = $facebook->getLoginUrl();
	header('Location: ' . $login_url);
}