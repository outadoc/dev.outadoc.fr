<?php

function get_PDO_connection() {
	return new PDO('mysql:host=' . MYSQL_HOSTNAME . ';dbname=' . MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}

try {
	$db = get_PDO_connection();
	$db->query("CREATE TABLE IF NOT EXISTS `dev_projects` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `name` varchar(60) NOT NULL,
	  `name_normalized` varchar(30) NOT NULL,
	  `description_short` varchar(500) NOT NULL,
	  `description` mediumtext NOT NULL,
	  `category` enum('app','desktop','web','extension','other') NOT NULL DEFAULT 'other',
	  `download_url` varchar(400) DEFAULT NULL,
	  `download_version` varchar(5) DEFAULT NULL,
	  `download_size` float DEFAULT NULL,
	  `price` varchar(5) DEFAULT NULL,
	  `browse_source` varchar(400) DEFAULT NULL,
	  `show_on_home` tinyint(1) NOT NULL DEFAULT '0',
	  `french_only` tinyint(1) NOT NULL DEFAULT '0',
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0");
} catch(PDOException $e) {
	echo file_get_contents(ROOT_SITE_URL . "error.php?code=-100");
	exit();
}

?>