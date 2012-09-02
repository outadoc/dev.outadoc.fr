<?php 
include_once('private/config.php');
include_once('includes/sql.php');
?>
<!DOCTYPE html>
<html>
	<?php include_once("includes/header.php"); ?>
	<link rel="stylesheet" href="<?php echo ROOT_SITE_URL; ?>assets/css/view-project.css" />
	<body>
		<?php 
		include_once("includes/navbar.php"); 

		try {
			$db = get_PDO_connection();
			$query = $db->prepare("SELECT * FROM projects WHERE name_normalized=?");
			$query->execute(array($_GET['name']));
			$data = $query->fetch();
		} catch (Exception $e) {
			die('Error connecting to the database: ' . $e->getMessage());
		}
		?>
		<div class="container">
			<div class="page-header">
				<h1><?php echo $data['name']; ?></h1>
				<h2><?php echo $data['description_short']; ?></h2>
			</div>
		</div>
		<div id="screenshots-bg">
			<ul>
				<?php 
				if(file_exists('assets/img/data/screen/' . $data['name_normalized'] . '/0.png')) {
					echo '<li id="one"><img src="' . ROOT_SITE_URL . 'assets/img/data/screen/' . $data['name_normalized'] . '/0.png" /></li>';
				} if(file_exists('assets/img/data/screen/' . $data['name_normalized'] . '/1.png')) {
					echo '<li id="two"><img src="' . ROOT_SITE_URL . 'assets/img/data/screen/' . $data['name_normalized'] . '/1.png" /></li>';
				} if(file_exists('assets/img/data/screen/' . $data['name_normalized'] . '/2.png')) {
					echo '<li id="three"><img src="' . ROOT_SITE_URL . 'assets/img/data/screen/' . $data['name_normalized'] . '/2.png" /></li>';
				} if(file_exists('assets/img/data/screen/' . $data['name_normalized'] . '/3.png')) {
					echo '<li id="four"><img src="' . ROOT_SITE_URL . 'assets/img/data/screen/' . $data['name_normalized'] . '/3.png" /></li>';
				}
				?>
			</ul>
		</div>
		<div class="container">
			<div class="row">
				<div class="span8">
					<?php 
					if($data['french_only']) {
						echo '<p style="color:red;">This project is only available in French!</p>';
					}
					
					echo $data['description']; 
					?>
				</div>
				<div class="span3">
					<a class="btn btn-primary" target="_blank" href="<?php echo $data['download_url']; ?>">
						<?php 
						$dl_title;
						
						if($data['category'] == 'web') {
							$dl_title = 'Go to';
						} else {
							$dl_title = 'Download';
						} 
						
						echo '<h1>' . $dl_title . ' ' . $data['name'] . '</h1>';
						?>
						<h2>
							<?php 
							if($data['price'] != null){
								echo $data['price'] . ' - ';
							} if($data['download_version'] != null){
								echo 'v' . $data['download_version'] . ' - ';
							} if($data['download_size'] != null && $data['download_size'] != 0){
								echo $data['download_size'] . 'Mo';
							} 
							?>
						</h2>
					</a>
					<a class="btn" href="<?php echo ROOT_SITE_URL; ?>contact.html"><i class="icon-flag"></i>&nbsp;Report a bug</a>
				</div>
			</div>
		</div>
		<?php include_once("includes/footer.php"); ?>
		<script type="text/javascript">
			$('#screenshots-bg ul li').click(function() {
				if($(this).css('height') != '150px') {
					$(this).css('height', '150px');
				} else {
					$(this).css('height', $(this).children('img').css('height'));
				}
			});
			$('#screenshots-bg ul li').mouseleave(function() {
				$(this).css('height', '150px');
			});
		</script>
	</body>
</html>