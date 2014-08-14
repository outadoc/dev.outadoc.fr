<?php 
	include_once('../private/config.php');
	include_once('../includes/sql.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>outa[dev] - Admin</title>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Edit an existing app</h1>
		<p><?php echo edit_existing_app(); ?></p>
		<h1>Add a new app</h1>
		<p><?php echo add_new_app(); ?></p>
		<h1>Add a new category</h1>
		<p><?php echo add_new_category(); ?></p>
		<h1>Add a new platform</h1>
		<p><?php echo add_new_platform(); ?></p>
	</body>
</html>
<?php 

	function edit_existing_app() {
		echo "<form action=\"edit-project.php\" method=\"get\">";
		echo "<select name=\"project\">";
		$apps = handle_query("SELECT * FROM dev_projects ORDER BY name");

		while($data = $apps->fetch()) {
			echo "<option value=\"" . $data['id'] . "\">" . $data['name'] . "</option>";
		}

		echo "<input type=\"hidden\" name=\"action\" value=\"edit\">";
		echo "<input type=\"submit\">";
		echo "</select></form>";
	}

	function add_new_app() {
		echo "<a href=\"edit-project.php?action=add\">Add a new project</a>";
	}

	function add_new_category() {
		echo "<form action=\"add-category.php\" method=\"get\">";
		echo "<input type=\"text\" name=\"name\" placeholder=\"awesome\"><input type=\"text\" name=\"name_long\" placeholder=\"Awesome Category\"><input type=\"hidden\" name=\"type\" value=\"category\"><input type=\"submit\">";
		echo "</form>";
	}

	function add_new_platform() {
		echo "<form action=\"add-category.php\" method=\"get\">";
		echo "<input type=\"text\" name=\"name\" placeholder=\"FreeBSD\"><input type=\"hidden\" name=\"type\" value=\"platform\"><input type=\"submit\">";
		echo "</form>";
	}

	function handle_query($query_str) {
		try {
			$db = get_PDO_connection();
			return $query = $db->query($query_str);
		} catch (Exception $e) {
			header("Location: " . ROOT_SITE_URL . "error.php?code=-100");
		}
	}
?>