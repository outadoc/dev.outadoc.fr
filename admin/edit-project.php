<?php 
	include_once('../private/config.php');
	include_once('../includes/sql.php');

	$app_info = null;

	if(isset($_GET['action']) && $_GET['action'] == "edit") 
	{
		if(isset($_POST['project']) &&
			isset($_POST['project_name']) &&
			isset($_POST['project_name_normalized']) &&
			isset($_POST['project_description_short']) &&
			isset($_POST['project_category']) &&
			isset($_POST['project_description']) &&
			isset($_POST['project_source'])) 
		{
			update_project($_POST['project'], $_POST);
			$app_info = get_app_info($_POST['project'])->fetch();
			process_uploaded_files($app_info);
		} else {
			//show a prefilled form
			$app_info = get_app_info($_GET['project'])->fetch();
		}
	}
	else if(isset($_GET['action']) && $_GET['action'] == "add") 
	{
		
		if(isset($_POST['project']) && $_POST['project'] == -1 &&
			isset($_POST['project']) &&
			isset($_POST['project_name']) &&
			isset($_POST['project_name_normalized']) &&
			isset($_POST['project_description_short']) &&
			isset($_POST['project_category']) &&
			isset($_POST['project_description']) &&
			isset($_POST['project_source'])) 
		{
			//actually add the new project to the db
			add_project($_POST);
			$app_info = get_app_info(get_last_inserted_id())->fetch();
			process_uploaded_files($app_info);
		} else {
			//show a blank form
			$app_info = array('id' => -1, 'name' => "", 'name_normalized' => "", 'description_short' => "", 'description' => "", 
				'browse_source' => "", 'show_on_home' => 0, 'french_only' => 0, 'visible' => 1, 'category_id' => 0);
		}

	} else {
		header("Location: " . ROOT_SITE_URL . "error.php?code=400");
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>outa[dev] - Edit a Project</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../assets/css/edit-project.css">
	</head>
	<body>
		<a href="./">&lt; Back</a>
		<form action="edit-project.php?action=<?php echo $_GET['action']; ?>" method="post" enctype="multipart/form-data">
			<h1>
			<?php 
			
				if($app_info['name'] == "") {
					echo "New Project";
				} else {
					echo "Details for " . $app_info['name'];
				} 

			?>
			</h1>
			<h2>Description</h2>
			<p>
				<label for="project_name">Project Name</label>
				<input type="text" name="project_name" value="<?php echo $app_info['name']; ?>">
			</p>
			<p>
				<label for="project_name_normalized">Normalized Project Name</label>
				<input type="text" name="project_name_normalized" value="<?php echo $app_info['name_normalized']; ?>">
			</p>
			<p>
				<label for="project_description_short">Short Description</label>
				<input type="text" name="project_description_short" value="<?php echo $app_info['description_short']; ?>">
			</p>
			<p>
				<label for="project_source">Source URL</label>
				<input type="text" name="project_source" value="<?php echo $app_info['browse_source']; ?>">
			</p>
			<p>
				<label for="show_on_home">Show on Home</label>
				<input type="checkbox" name="show_on_home" <?php echo ($app_info['show_on_home'] == 1) ? "checked" : ""; ?>>
			</p>
			<p>
				<label for="french_only">French Only</label>
				<input type="checkbox" name="french_only" <?php echo ($app_info['french_only'] == 1) ? "checked" : ""; ?>>
			</p>
			<p>
				<label for="visible">Visible</label>
				<input type="checkbox" name="visible" <?php echo ($app_info['visible'] == 1) ? "checked" : ""; ?>>
			</p>
			<p>
				<label for="project_category">Category</label>
				<select name="project_category">
					<?php

					$cat = get_categories();

					while($data = $cat->fetch()) {
						$selected = ($app_info['category_id'] == $data['category_id']) ? "selected" : "";
						echo "<option value=\"" . $data['category_id'] . "\"" . $selected . ">" . $data['category_name'] . "</option>";
					}

					?>
				</select>
			</p>
			<p>
				<label for="project_description">Description</label>
				<textarea name="project_description" rows="15" cols="60"><?php echo $app_info['description']; ?></textarea>
			</p>
			
			<h2>Downloads</h2>
			<?php

				$count = 0;
				$platform_count = 0;

				$downloads = get_downloads($app_info['id']);
				$platforms_query = get_platforms();
				$platforms;

				while($data = $platforms_query->fetch()) {
					$platforms[$platform_count]['id'] = $data['platform_id'];
					$platforms[$platform_count]['name'] = $data['platform_name'];
					$platform_count++;
				}

				while(($data = $downloads->fetch()) || $count < 5) {
					echo "<p><input type=\"text\" name=\"download_url_" . $count . "\" value=\"" . $data['download_url'] . "\" placeholder=\"http://example.com\">";
					echo "<input type=\"text\" name=\"download_price_" . $count . "\" value=\"" . $data['download_price'] . "\" placeholder=\"123€\">";
					echo "<input type=\"text\" name=\"download_version_" . $count . "\" value=\"" . $data['download_version'] . "\" placeholder=\"1.0\">";

					echo "<select name=\"download_platform_" . $count . "\">";

					foreach ($platforms as $platform) {
						$selected = ($data['platform_id'] == $platform['id']) ? "selected" : "";
						echo "<option value=\"" . $platform['id'] . "\" " . $selected . ">" . $platform['name'] . "</option>";
					}

					echo "</select></p>";

					$count++;
				}

			?>

			<h2>Image Assets</h2>
			<h3>Screenshots</h3>
			<?php show_screenshots($app_info); ?>
			<h3>Icons</h3>
			<?php show_icons($app_info); ?>

			<input type="hidden" name="project" value="<?php echo $app_info['id']; ?>">
			<input type="submit">
		</form>
	</body>
</html>

<?php

	function get_app_info($id) {
		return handle_query("SELECT * FROM dev_projects JOIN dev_categories USING(category_id) WHERE id = ?", array($id));
	}

	function get_categories() {
		return handle_query("SELECT * FROM dev_categories", null);
	}

	function get_downloads($id) {
		return handle_query("SELECT * FROM dev_download_links WHERE id = ?", array($id));
	}

	function get_platforms() {
		return handle_query("SELECT * FROM dev_platforms", null);
	}

	function get_last_inserted_id() {
		$query = handle_query("SELECT MAX(id) as id FROM dev_projects", null);
		$data = $query->fetch();

		return $data['id'];
	}

	function handle_query($query_str, $params) {
		try {
			$db = get_PDO_connection();
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = $db->prepare($query_str);
			$query->execute($params);
			return $query;
		} catch (Exception $e) {
			die($e);
		}
	}

	function update_project($project_id, $url_params) {
		$query = "UPDATE dev_projects SET name = ?, name_normalized = ?, description_short = ?, category_id = ?, description = ?, browse_source = ?, french_only = ?, show_on_home = ?, visible = ? WHERE id = ?";
		
		handle_query($query, array($url_params['project_name'], 
			$url_params['project_name_normalized'],
			$url_params['project_description_short'], 
			$url_params['project_category'], 
			$url_params['project_description'],
			$url_params['project_source'],
			(isset($url_params['french_only']) && $url_params['french_only'] == "on") ? 1 : 0, 
			(isset($url_params['show_on_home']) && $url_params['show_on_home'] == "on") ? 1 : 0, 
			(isset($url_params['visible']) && $url_params['visible'] == "on") ? 1 : 0, 
			$project_id
		));

		update_download_links($project_id, $url_params);
		echo "<h3 style=\"color: red;\">Updated successfully</h3>";
	}

	function add_project($url_params) {
		$query = "INSERT INTO dev_projects (name, name_normalized, description_short, category_id, description, browse_source, french_only, show_on_home, visible) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
		handle_query($query, array($url_params['project_name'], 
			$url_params['project_name_normalized'],
			$url_params['project_description_short'], 
			$url_params['project_category'], 
			$url_params['project_description'],
			$url_params['project_source'],
			(isset($url_params['french_only']) && $url_params['french_only'] == "on") ? 1 : 0, 
			(isset($url_params['show_on_home']) && $url_params['show_on_home'] == "on") ? 1 : 0, 
			(isset($url_params['visible']) && $url_params['visible'] == "on") ? 1 : 0
		));

		update_download_links(get_last_inserted_id(), $url_params);
		echo "<h3 style=\"color: red;\">Added successfully</h3>";
	}

	function update_download_links($project_id, $url_params) {
		handle_query("DELETE FROM dev_download_links WHERE id = ?", array($project_id));
		$count = 0;

		while(isset($url_params['download_url_' . $count]) && $url_params['download_url_' . $count] != "") {
			$query = "INSERT INTO dev_download_links (id, download_url, platform_id, download_price, download_version) VALUES (?, ?, ?, ?, ?)";
			handle_query($query, array($project_id, 
				$url_params['download_url_' . $count], 
				$url_params['download_platform_' . $count], 
				$url_params['download_price_' . $count], 
				$url_params['download_version_' . $count]
			));

			$count++;
		}
	}

	function show_screenshots($app_info) {
		echo "<table><tr>";
		
		for($i = 0; $i < 4; $i++) {
			show_single_screenshot($app_info, $i);
		}

		echo "</tr></table>";
	}

	function show_single_screenshot($app_info, $screnshot_num) {
		echo "<td>";
		echo "<img src=\"" . ROOT_SITE_URL . "assets/img/data/screen/" . $app_info['name_normalized'] . "/" . $screnshot_num . ".png\">";
		echo "<input type=\"file\" name=\"screenshot_" . $screnshot_num . "\" accept=\"image/png\">";
		echo "<p><input type=\"checkbox\" name=\"delete_screenshot_" . $screnshot_num . "\"><label for=\"delete_screenshot_" . $screnshot_num . "\">Remove this screenshot</label></p>";
		echo "<p>Screenshot #" . ($screnshot_num + 1) . "</p>";
		echo "</td>";
	}

	function show_icons($app_info) {
		?>

		<table>
			<tr>
				<td>
					<img src="<?php echo ROOT_SITE_URL . "assets/img/data/icon/" . $app_info['name_normalized'] . ".png"; ?>">
					<input type="file" name="home_icon" accept="image/png">
					<p>Home Icon</p>
				</td>
				<td>
					<img src="<?php echo ROOT_SITE_URL . "assets/img/data/thumb/" . $app_info['name_normalized'] . ".png"; ?>">
					<input type="file" name="thumbnail" accept="image/png">
					<p>Thumbnail</p>
				</td>
			</tr>
		</table>

		<?php
	}

	function process_uploaded_files($app_info) {
		for($i = 0; $i < 4; $i++) {
			if(isset($_FILES['screenshot_' . $i])) {
				process_single_file($_FILES['screenshot_' . $i], "../assets/img/data/screen/" . $app_info['name_normalized'] . "/" . $i . ".png", (isset($_POST['delete_screenshot_' . $i]) && $_POST['delete_screenshot_' . $i] == "on"));
			}
		}
	}

	function process_single_file($file, $fs_path, $should_delete) {
		if($should_delete) {
			@unlink($fs_path);
		} else if(isset($file) && (!isset($file['error']) || $file['error'] == UPLOAD_ERR_OK)) {
			move_uploaded_file($file['tmp_name'], $fs_path);
		}
	}

?>