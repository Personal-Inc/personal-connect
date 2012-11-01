# Login with Twitter and Facebook

Contributors: Redacted (Redacted)

### Requires

* PHP 5.3 or later
* Curl
* SSL enabled

Application adds Facebook, Twitter OAuth flows to authenticate the user and request the user's basic contact info. 

When logged in, the application displays the user's contact info. 

More info: http://www.cloudspokes.com/challenges/1799

### Description

This application prints the user's twitter and facebook profile details.

After seletion of one of the services from the pool mainly facebook and twitter. 

User is redirected to facebook or twitter website to get authenticated.

After authentication is done, service prompts user whether to allow access to application or not.

After allowing the access to application, this application accesses the information with the help of APIs.

(This process is nothing but OAuth.)  

### Installation

1. To use this application you must create facebook and twitter application

    For specifying callback URL give your domain name and 
    
    1. For twitter give callback URL as http://domain/twitter-details.php
    
    1. For facebook give callback URL as http://domain/login-facebook.php
   
2. Use application's keys and shared secret keys to get this application running. 
   
    2.	for twitter 
   		
        "config/twitter.php" contains YOUR_CONSUMER_KEY and YOUR_CONSUMER_SECRET
	
        Put appropriate values to these.
		
        More help can be found from https://dev.twitter.com/apps
		
    2.	for facebook 
   		
        "config/facebook.php" contains APP_ID and APP_SECRET
		
        Put appropriate values to these.
		
        More help can be found from https://developers.facebook.com/apps	
		
    2. 	for personal
   		
        "config/personalconfig.php" contains CLIENT_ID and SHARED_SECRET
		
        Put appropriate values to these.

3. There is one more setting for twitter in config.php
   
    change BASE\_URL to your domain name. e.g. http://yahoo.com/
   
    P.S. ending slash is important	
	 
4. There is one more setting for personal in config.php

    Change RESPONSE_URL to http://domainname/personal.php
	
4. That's it!!! Run the application.


### License
Copyright (C) 2012 Personal

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
