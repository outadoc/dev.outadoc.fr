<?php 
include_once('private/config.php');
include_once('includes/sql.php');

try {
	$db = get_PDO_connection();
	$query = $db->query("SELECT * FROM dev_projects WHERE show_on_home=1");
} catch (Exception $e) {
	header("Location: " . ROOT_SITE_URL . "error.php?code=-100");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once("includes/header.php"); ?>
		<link rel="stylesheet" href="<?php echo ROOT_SITE_URL; ?>assets/css/index.css" />
	</head>
	<body>
	    <?php include_once("includes/navbar.php"); ?>
	    <div class="page-header">
	    	<ul class="thumbnails">
	    		<?php 
	    			while($data = $query->fetch()) {
    				?>
    					<li class="thumbnail">
    						<a href="<?php echo ROOT_SITE_URL; ?>project/<?php echo $data['name_normalized']; ?>/"><img src="<?php echo ROOT_SITE_URL; ?>assets/img/data/icon/<?php echo $data['name_normalized']; ?>.png" alt="" /></a>
    						<h3><?php echo $data['name']; ?></h3>
    					</li>
    				<?php
	    			}
	    		?>
	    		<li class="thumbnail other">
	    			<a href="<?php echo ROOT_SITE_URL; ?>projects.html"><img src="assets/img/other.png" alt="" /></a>
	    			<h3>More</h3>
	    		</li>
	    	</ul>
	    </div>
	    <div class="container">
	    	<div class="row" id="home-info">
	    		<div class="span5 offset1">
	    			<h1>Amateur Programming</h1>
	    			I'm a young developer who has completed a few projects; you can find them on this website. You can also find most of them on Github (links are on their respective page), and you can <a href="http://twitter.com/outadoc">follow me</a> on Twitter.
	    		</div>
	    		<div class="span5">
	    			<h1>More Projects</h1>
	    			Not every project of mine is displayed on this website: if you want more, please visit my <a href="http://github.com/outadoc">Github page</a>, and you'll probably (hopefully) find some interesting stuff!
	    		</div>
	    	</div>
	    </div>
	    <?php include_once("includes/footer.php"); ?>
	</body>
</html>