=== Login with Twitter and Facebook ===
Contributors: Siddhesh Shivtarkar (siddhesh619@gmail.com)

Requires : PHP 5.3 or later, Curl, SSL enabled

Application adds Facebook, Twitter OAuth flows to authenticate the user and request the user's basic contact info. 
When logged in, the application displays the user's contact info. 
More info: http://www.cloudspokes.com/challenges/1799

== Description ==

This application prints the user's twitter and facebook profile details.

After seletion of one of the services from the pool mainly facebook and twitter. 
User is redirected to facebook or twitter website to get authenticated.
After authentication is done, service prompts user whether to allow access to application or not.
After allowing the access to application, this application accesses the information with the help of APIs.
(This process is nothing but OAuth.)  


== Installation ==

1. To use this application you must create facebook and twitter application
   For specifying callback URL give your domain name and 
   1.1 For twitter give callback URL as http://domain/twitter-details.php
   1.2 For facebook give callback URL as http://domain/login-facebook.php
   
2. Use application's keys and shared secret keys to get this application running. 
   2.1	for twitter 
   		"config/twitter.php" contains YOUR_CONSUMER_KEY and YOUR_CONSUMER_SECRET
		Put appropriate values to these.
		More help can be found from https://dev.twitter.com/apps
		
   2.2	for facebook 
   		"config/facebook.php" contains APP_ID and APP_SECRET
		Put appropriate values to these.
		More help can be found from https://developers.facebook.com/apps	
		
   2.3 	for personal
   		"config/personalconfig.php" contains CLIENT_ID and SHARED_SECRET
		Put appropriate values to these.

3. There is one more setting for twitter in config.php
   change BASE_URL to your domain name. e.g. http://yahoo.com/
   P.S. ending slash is important	
	 
4. There is one more setting for personal in config.php
	Change RESPONSE_URL to http://domainname/personal.php
	
4. That's it!!! Run the application.


== Live demo ==
Live demo can be checked on http://siddhesh.phpfogapp.com/challengeLoginNew/
== License ==
Free to use

