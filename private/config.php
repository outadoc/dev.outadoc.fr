<?php

	////////////////////////////////////
	// CONFIG VARS FOR DEV.OUTADOC.FR //
	////////////////////////////////////

	/***** MYSQL ******/
	define('MYSQL_USERNAME', 'root');                           //mysql username
	define('MYSQL_PASSWORD', '');                               //mysql password
	define('MYSQL_HOSTNAME', 'localhost');                      //host name of the mysql server
	define('MYSQL_DATABASE', 'outadev');                        //name of the mysql database

	/***** ADMIN VARS *****/
	define('CONTACT_EMAIL', 'contact@dev.outadoc.fr');          //email address where the manager can be contacted (used for forms)

	/***** GLOBAL PHP CONFIG *****/
	define('ROOT_SITE_URL', 'http://localhost/dev/web/outadev-website/');   //the url of the of the website (where index.php is, basically)

	/***** ANALYTICS & CAPTCHA *****/
	define('GOOGLE_ANALYTICS_KEY', 'UA-XXXXXXXX-X');                //google analytics key, to record statistics
	define('RECAPTCHA_PRIVATE_KEY', 'xxxxxxxxxxxxxxxxxxxxxxxx');    //recaptcha private key
