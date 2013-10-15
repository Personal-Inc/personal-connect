<?php
// including necessary files
require_once 'config/config.php';
if (isset($_SESSION['id'])) {
	// if session is already set then redirect to home page to show the details
    header("location: home.php");
}

// depending upon service i.e. oauth_provider redirect user
if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'twitter') {
    	header("Location: login-twitter.php");
    } else if ($oauth_provider == 'facebook') {
    	header("Location: login-facebook.php");
    } else if ($oauth_provider == 'personal') {
    	header("Location: personal.php");
    }
}
?>
<html>
<head>
	<title>Twitter Facebook Login</title>
	<link rel="stylesheet" href="css/styles.css" />
	
</head>
<body>
<?php 
if (array_key_exists('logout', $_GET)) {
?>
	<div>You have successfully logged out.</div>
<?php 	
}
?>
	<div id="buttons">
	    <a href="?login&oauth_provider=twitter"><img src="images/twitter.png"></a>&nbsp;&nbsp;&nbsp;
	    <a href="?login&oauth_provider=facebook"><img src="images/facebook.png"></a>
	    <a href="?login&oauth_provider=personal"><img src="images/personal.png"></a>
		<h1>Twitter Facebook Login<br/>...By Siddhesh Shivtarkar </h1>
	</div>
</body>
</html>
