<?php 
	include_once('../private/config.php');
	include_once('../includes/sql.php');

	if(isset($_GET['type']) && $_GET['type'] == "category" 
		&& isset($_GET['name']) && isset($_GET['name_long'])
		&& !empty($_GET['name']) && !empty($_GET['name_long'])) {
		add_category($_GET['name'], $_GET['name_long']);
	} else if(isset($_GET['type']) && $_GET['type'] == "platform" && isset($_GET['name']) && !empty($_GET['name'])) {
		add_platform($_GET['name']);
	} else {
		header("Location: " . ROOT_SITE_URL . "error.php?code=400");
	}

	function handle_query($query_str, $params) {
		try {
			$db = get_PDO_connection();
			$query = $db->prepare($query_str);
			$query->execute($params);

			return $query;
		} catch (Exception $e) {
			die($e);
		}
	}

	function add_category($name, $name_long) {
		handle_query("INSERT INTO dev_categories (category_name, category_name_long) VALUES(?, ?)", array($name, $name_long));
		header("Location: " . ROOT_SITE_URL . "admin/");
	}

	function add_platform($name) {
		handle_query("INSERT INTO dev_platforms (platform_name) VALUES(?)", array($name));
		header("Location: " . ROOT_SITE_URL . "admin/");
	}

?>