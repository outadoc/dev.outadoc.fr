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
	<?php include_once("includes/header.php"); ?>
	<link rel="stylesheet" href="assets/css/index.css" />
	<body>
	    <?php include_once("includes/navbar.php"); ?>
	    <div class="page-header">
	    	<ul class="thumbnails">
	    		<?php 
	    			while($data = $query->fetch()) {
    				?>
    					<li class="thumbnail">
    						<a href="<?php echo ROOT_SITE_URL; ?>project/<?php echo $data['name_normalized']; ?>/"><img src="assets/img/data/icon/<?php echo $data['name_normalized']; ?>.png" alt="" /></a>
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
	    			I'm a young developer who has completed a few projects; you can find them on this website. You can also find most of them on my <a href="http://github.com/outadoc">Github repo</a>, and you can <a href="http://twitter.com/outadoc">follow me</a> on Twitter.
	    		</div>
	    		<div class="span5">
	    			<h1>Donate!</h1>
	    			I distribute most of my apps for free, and they are often open-source. If you feel like paying me a coffee or a croissant, you can do so by clicking the button below. Thanks!&nbsp;:)
	    			<div class="donate-container">
	    				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	    					<input type="hidden" name="cmd" value="_s-xclick">
	    					<input type="hidden" name="hosted_button_id" value="RSVCTFJFV7PNW">
	    					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	    					<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
	    				</form>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	    <?php include_once("includes/footer.php"); ?>
	</body>
</html>