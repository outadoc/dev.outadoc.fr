<?php 

////////////////////////////////////
// CONFIG VARS FOR DEV.OUTADOC.FR //
////////////////////////////////////

/***** MYSQL ******/
define('MYSQL_USERNAME', 'root');          					//mysql username
define('MYSQL_PASSWORD', 'root');              				//mysql password
define('MYSQL_HOSTNAME', 'localhost');     					//host name of the mysql server
define('MYSQL_DATABASE', 'outadev');  						//name of the mysql database

/***** ADMIN VARS *****/
define('ADMIN_PASSWORD', '');								//password for the administration section
define('CONTACT_EMAIL', 'outadev@outadoc.fr');				//email address where the manager can be contacted (used for forms)

/***** USER TRACKING *****/
define('GOOGLE_ANALYTICS_KEY', 'UA-XXXXXXXX-X');			//google analytics key, to record statistics

/***** GLOBAL PHP CONFIG *****/
define('ROOT_SITE_URL', 'http://localhost/outadev2/');		//the url of the of the website (where index.php is, basically)

?>