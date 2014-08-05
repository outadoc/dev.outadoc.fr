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
		<div class="wrapper">
			<?php include_once("includes/navbar.php"); ?>
			<div class="container">
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
				<?php include_once("includes/footer.php"); ?>
			</div>
		</div>
		<script type="text/javascript">

			//center the header vertically... yup, couldn't find anything better than that.
			function adjustHeaderMargin() {
				var winHeight = $(window).height();
				var margin;

				if($(window).width() > 760) {
					margin = ((winHeight / 2) - ($(".page-header").height() / 2)) / 2;
				} else {
					margin = 20;
				}

				$(".page-header").css("margin-top", margin + "px");
			}

			$(window).resize(adjustHeaderMargin);
			adjustHeaderMargin();

		</script>
	</body>
</html>