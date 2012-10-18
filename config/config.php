<?php
/*
 * configuration file for starting session and making some error settings
 */

//comment following 2 line to get rid of errors, notices and warnings
ini_set('display_errors', 0);

//Always place this code at the top of the Page
session_start();

//BASE_URL used while redirecting User for authentication 
define('BASE_URL', 'http://siddhesh.phpfogapp.com/challengeLoginNew/');

// RESPONSE_URL where personal will post the information
//define('RESPONSE_URL', 'http://siddhesh.phpfogapp.com/challengeLoginNew/personal.php');
define('RESPONSE_URL', 'http://siddhesh.phpfogapp.com/challengeLoginNew/personal.php');


define('PERSONAL_URL', 'https://api-sandbox.personal.com/');

/*
 * function show
 * 
 * @param var variable to be dumped
 * @param exit whether to exit or not, after printing $var
 * @param before text to be printed before variable is printed
 */
function show($var, $exit = 0, $before = '') {
	echo '<pre>----------------', $before, '---------------------', '<br />';
	print_r($var);
	echo '<br />--------------------</pre>';
	echo '<br />';
	if ($exit == 1) exit;
}