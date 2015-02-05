<?php
	include_once('private/config.php');
	include_once('includes/sql.php');

	try {
		$db    = get_PDO_connection();
		$query = $db->prepare("SELECT * FROM dev_projects JOIN dev_categories USING(category_id) WHERE name_normalized = ? AND visible = 1");
		$query->execute(array($_GET['name']));
		$data = $query->fetch();

		if ($query->rowCount() < 1) {
			echo file_get_contents(ROOT_SITE_URL . "error.php?code=-200");
			exit();
		}
	} catch (Exception $e) {
		echo file_get_contents(ROOT_SITE_URL . "error.php?code=-100");
		exit();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once("includes/header.php"); ?>
	<link rel="stylesheet" href="<?php echo ROOT_SITE_URL; ?>assets/css/view-project.css">
</head>
<body>
<div class="wrapper">
	<?php include_once("includes/navbar.php"); ?>
	<div class="container">
		<div class="page-header">
			<h1><?php echo $data['name']; ?></h1>

			<h2><?php echo $data['description_short']; ?></h2>
		</div>
	</div>
	<div id="screenshots-bg">
		<ul>
			<?php

				if (file_exists('assets/img/data/screen/' . $data['name_normalized'] . '/0.png')) {
					echo '<li id="one"><img src="' . ROOT_SITE_URL . 'assets/img/data/screen/' . $data['name_normalized'] . '/0.png" alt="Screenshot 1"></li>';
				}
				if (file_exists('assets/img/data/screen/' . $data['name_normalized'] . '/1.png')) {
					echo '<li id="two"><img src="' . ROOT_SITE_URL . 'assets/img/data/screen/' . $data['name_normalized'] . '/1.png" alt="Screenshot 2"></li>';
				}
				if (file_exists('assets/img/data/screen/' . $data['name_normalized'] . '/2.png')) {
					echo '<li id="three"><img src="' . ROOT_SITE_URL . 'assets/img/data/screen/' . $data['name_normalized'] . '/2.png" alt="Screenshot 3"></li>';
				}
				if (file_exists('assets/img/data/screen/' . $data['name_normalized'] . '/3.png')) {
					echo '<li id="four"><img src="' . ROOT_SITE_URL . 'assets/img/data/screen/' . $data['name_normalized'] . '/3.png" alt="Screenshot 4"></li>';
				}

			?>
		</ul>
	</div>
	<div class="container">
		<div class="row">
			<div class="span6 offset1">
				<?php

					if ($data['french_only']) {
						echo '<p style="color:red;">This project is only available in <span itemprop="inLanguage" content="fr-FR">French</span>!</p>';
					}

					echo $data['description'];

				?>
			</div>
			<div class="span3" itemscope>
				<?php

					$query_download = $db->prepare("SELECT * FROM dev_download_links JOIN dev_platforms USING(platform_id) WHERE id = ?");
					$query_download->execute(Array($data['id']));

					while ($link = $query_download->fetch()) {

						$dl_title = $data['category_name'] == 'web' ? 'Go to' : 'Download';
						?>

						<div itemscope itemtype="http://schema.org/SoftwareApplication">
							<meta itemprop="description" content="<?php echo $data['description_short']; ?>">
							<a class="btn btn-primary btn-dl" itemprop="downloadUrl"
							   href="<?php echo $link['download_url'] ?>">
								<h1>
									<?php echo $dl_title ?> <span itemprop="name"><?php echo $data['name'] ?></span>
								</h1>
								<?php

									$displayPlatform = $link['platform_name'];
									$displayVersion  = $link['download_version'] == null ? null : 'v' . $link['download_version'];

									if ($link['download_price'] == null) {
										$displayPrice = '';
									} else if ($link['download_price'] == 0) {
										$displayPrice = 'Free';
									} else {
										$displayPrice = $link['download_price'] . ' €';
									}

								?>
								<h2>
									<span itemprop="operatingSystem"><?php echo $displayPlatform ?></span>
									<?php if (!empty($displayPrice) || !empty($displayVersion)) echo ' - '; ?>
									<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
										<meta itemprop="priceCurrency" content="EUR">
										<span itemprop="price"
										      content="<?php echo $link['download_price'] ?>"><?php echo $displayPrice ?></span>
									</span>
									<?php if (!empty($displayVersion)) echo ' - '; ?>
									<span itemprop="softwareVersion"><?php echo $displayVersion ?></span>
								</h2>
							</a>
						</div>

					<?php
					}

					if ($data['browse_source'] != null) {
						echo '<a class="btn btn-source" href="' . $data['browse_source'] . '">Fork me on Github</a>';
					}
				?>

				<a class="btn" href="<?php echo ROOT_SITE_URL; ?>contact.html">
					<i class="icon-flag"></i>&nbsp;Report a bug
				</a>

				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
					<a class="addthis_button_preferred_1"></a>
					<a class="addthis_button_preferred_2"></a>
					<a class="addthis_button_preferred_3"></a>
					<a class="addthis_button_preferred_4"></a>
					<a class="addthis_button_compact"></a>
					<a class="addthis_counter addthis_bubble_style"></a>
				</div>
				<script type="text/javascript"
				        src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-508050052591f516"></script>
				<!-- AddThis Button END -->
			</div>
		</div>
	</div>
	<?php include_once("includes/footer.php"); ?>
</div>
<script type="text/javascript">

	var screenshots = $('#screenshots-bg').find('ul li');

	screenshots.click(function () {
		if (Math.round($(this).height()) != 150) {
			$(this).css('height', '150px');
		} else {
			$(this).css('height', $(this).children('img').css('height'));
		}
	});

	screenshots.mouseleave(function () {
		$(this).css('height', '150px');
	});

</script>
</body>
</html>