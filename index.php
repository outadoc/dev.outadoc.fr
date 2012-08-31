<?php 
include_once('private/config.php');
include_once('includes/sql.php');
?>
<!DOCTYPE html>
<html>
	<?php include_once("includes/header.php"); ?>
	<link rel="stylesheet" href="assets/css/index.css" />
	<body>
	    <?php include_once("includes/navbar.php"); ?>
	    <div class="page-header">
	    	<ul class="thumbnails">
	    		<?php 
	    		try {
	    			$db = get_PDO_connection();
	    			$query = $db->query("SELECT * FROM projects WHERE show_on_home=1");

	    			while($data = $query->fetch()) {
    				?>
    					<li class="thumbnail">
    						<a href="projects/<?php echo $data['name_normalized']; ?>"><img src="assets/img/data/icon/<?php echo $data['name_normalized']; ?>.png" alt="" /></a>
    						<h3><?php echo $data['name']; ?></h3>
    					</li>
    				<?php
	    			}
	    		} catch (Exception $e) {
	    			die('Erreur lors de la connexion à la base de données : ' . $e->getMessage());
	    		}
	    		?>
	    	</ul>
	    </div>
	    <div class="container">
	    	<div class="row" id="home-info">
	    		<div class="span5">
	    			<h1>Amateur Programming</h1>
	    			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a faucibus nunc. Integer tincidunt, ligula eget lobortis pharetra, ligula tellus suscipit mi, ut pharetra erat justo in odio. In ut erat sit amet nulla ullamcorper semper. Cras fringilla, dolor lobortis egestas auctor, justo urna interdum sem, vel pharetra sapien sem ut urna.
	    		</div>
	    		<div class="span5 offset1">
	    			<h1>Donate!</h1>
	    			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a faucibus nunc. Integer tincidunt, ligula eget lobortis pharetra, ligula tellus suscipit mi, ut pharetra erat justo in odio. In ut erat sit amet nulla ullamcorper semper. Cras fringilla, dolor lobortis egestas auctor, justo urna interdum sem, vel pharetra sapien sem ut urna.
	    		</div>
	    	</div>
	    </div>
	    <?php include_once("includes/footer.php"); ?>
	</body>
</html>