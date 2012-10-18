<?php
// including necessary files
require_once 'config/config.php';
require_once 'twitter/twitteroauth.php';
require_once 'config/twitter.php';

if (!empty($_REQUEST['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {

	// We've got everything we need
	$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

	// Let's request the access token
	$access_token = $twitteroauth->getAccessToken($_REQUEST['oauth_verifier']);

	// Save it in a session var
	$_SESSION['access_token'] = $access_token;

	// Let's get the user's info
	$user_info = $twitteroauth->get('account/verify_credentials');

	if (isset($user_info->error)) {
		// Something's wrong, go back
		header('Location: login-twitter.php');
	} else {
		$_SESSION['id'] 							= $user_info->id;
		$_SESSION['username'] 						= $user_info->screen_name;
		$_SESSION['oauth_provider'] 				= 'twitter';


		$_SESSION['screen_name'] 					= $user_info->screen_name;
		$_SESSION['utc_offset'] 					= $user_info->utc_offset;
		$_SESSION['name'] 							= $user_info->name;
		$_SESSION['lang'] 							= $user_info->lang;
		$_SESSION['time_zone'] 						= $user_info->time_zone;
		$_SESSION['location'] 						= $user_info->location;

		$_SESSION['profile_background_color'] 		= $user_info->profile_background_color;
		$_SESSION['profile_background_image_url'] 	= $user_info->profile_background_image_url;
		$_SESSION['profile_link_color']				= $user_info->profile_link_color;
		$_SESSION['friends_count'] 					= $user_info->friends_count;
		$_SESSION['url'] 							= $user_info->url;
		$_SESSION['profile_image_url'] 				= $user_info->profile_image_url;
		$_SESSION['description'] 					= $user_info->description;

		// redirect to show all the details
		header("Location: home.php");
	}
} else {
	// Something's missing, go back
	header('Location: login-twitter.php');
}