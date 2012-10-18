<?php
// including necessary files
require 'config/config.php'; 
require('twitter/twitteroauth.php');
require 'config/twitter.php';

// creating an object with the help of consumer key and secret key
$twitteroauth 						= new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);

// requesting authentication tokens, the parameter is the URL we will be redirected to
$request_token 						= $twitteroauth->getRequestToken(BASE_URL.'twitter-details.php'); 

// saving them into the session
$_SESSION['oauth_token'] 			= $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] 	= $request_token['oauth_token_secret'];

// if everything goes well..
if ($twitteroauth->http_code == 200) {
    // let's generate the URL and redirect
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    header('Location: ' . $url);
} else {
    die('Something wrong happened.');
}