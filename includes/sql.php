<?php

	function get_PDO_connection()
	{
		return new PDO('mysql:host=' . MYSQL_HOSTNAME . ';dbname=' . MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD,
			array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}

	try {
		$db = get_PDO_connection();
		$db->query("SELECT * FROM dev_projects");
	} catch (PDOException $e) {
		echo file_get_contents(ROOT_SITE_URL . "error.php?code=-100");
		exit();
	}

?>