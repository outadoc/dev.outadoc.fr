<?php 
include_once('private/config.php');
include_once('includes/sql.php');
?>
<!DOCTYPE html>
<html>
	<?php include_once("includes/header.php"); ?>
	<link rel="stylesheet" href="<?php echo ROOT_SITE_URL; ?>assets/css/projects.css" />
	<body>
	    <?php 
	    include_once("includes/navbar.php");
	 	
	 	function get_thumbnail($data) {
	 		$language_alert='';
	 		if($data['french_only']) {
	 			$language_alert = '<p class=\'language-alert\'>This project is available in French only.</p>';
	 		}
	 		return '<li class="thumbnail"><a href="' . ROOT_SITE_URL . 'project/' . $data['name_normalized'] . '/" title="' . $data['name'] . '" data-content="' . $data['description_short'] . $language_alert . '"><img src="' . ROOT_SITE_URL . 'assets/img/data/thumb/' . $data['name_normalized'] . '.png" alt="" /><div class="caption">' . $data['name'] . '</div></a></li>';
	 	}
	 	
	    function display_projects($db, $cat_id, $cat_disp_name) {
	    	$query = $db->prepare("SELECT * FROM dev_projects WHERE category=?");
	    	$query->execute(array($cat_id));
	    	
	    	?>
	    	<div class="row">
	    		<div class="span12 proj-row-header" data-toggle="collapse" data-target="#<?php echo $cat_id; ?>"><?php echo $cat_disp_name; ?></div>
	    		<div id="<?php echo $cat_id; ?>" class="span12 projects-list collapse <?php if($query->rowCount() != 0){echo 'in';} ?>">
	    			<ul class="span12 projects-list thumbnails">
	    		    	<?php 
	    		    	while($data = $query->fetch()) {
	    			    	echo get_thumbnail($data);
	    		    	}
	    		    	
	    		    	if($query->rowCount() == 0) {
	    		    		echo '<p>There are no projects in this section.</p>';
	    		    	}
	    		    	?>
	    			</ul>
	    		</div>
	    	</div>
	    	<?php
	    }
	    ?>
	    
	    <div class="container">
	    	<div class="page-header">
	    		<h1>Projects</h1>
	    	</div>
	   		<?php 
	   		try {
	   			$db = get_PDO_connection();
	   			
	   			display_projects($db, 'app', 'Mobile Applications');
	   			display_projects($db, 'web', 'Websites');
	   			display_projects($db, 'extension', 'Browser Extensions');
	   			display_projects($db, 'desktop', 'Desktop Programs');
	   			display_projects($db, 'other', 'Other');
	   		} catch (Exception $e) {
	   			die('Error connecting to the database: ' . $e->getMessage());
	   		}
	   		?>
	   	</div>
	    <?php include_once("includes/footer.php"); ?>
	    <script type="text/javascript">
	    	$('.thumbnail a').popover({
	    		html: true,
	    		trigger: 'hover',
	    		placement: 'top',
	    		delay: 50
	    	});
	    </script>
	</body>
</html>