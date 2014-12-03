<?php include_once('private/config.php'); ?>
	<!DOCTYPE html>
	<html>
	<head>
		<?php include_once("includes/header.php"); ?>
		<link rel="stylesheet" href="<?php echo ROOT_SITE_URL; ?>assets/css/about.css">
	</head>
	<body>
	<div class="wrapper">
		<?php include_once("includes/navbar.php"); ?>
		<div class="container">
			<div class="content">
				<div class="page-header">
					<h1>About the developer</h1>
				</div>
				<div class="row">
					<div class="span12">
						<img src="<?php echo ROOT_SITE_URL; ?>assets/img/avatar_wondercraft.png" alt="Avatar">

						<p>Hello there! I'm a French <?php echo getAgeFromBithdate(805845600); ?> years old indie
							developer who loves milkshakes. I have created a few mobile, web and mobile projects in
							different languages. I don't have a preferred language; I mostly use Java, HTML/CSS, PHP,
							Javascript in my projects, and basically anything I'm intrigued by. I'm not scared of
							learning and discovering new stuff, especially if they're useful.</p>

						<p>I'm also using and enjoying version control tools, like git. I'm getting pretty good at
							Android development, and also have a couple of iOS apps in my track record, but they're a
							bit left out right now since I'm quite a busy student.</p>

						<p>French is my mother tongue, but I'm fluent in English and have no problem conversing in
							either language. I practice daily, thanks to movies, series and other videos, as well as
							news articles and acquaintances. The web is amazing for things like that.</p>

						<p>I'm not really available to participate in projects for now, because of my studies and my own
							personal projects. But don't be afraid to
							<a href="<?php echo ROOT_SITE_URL; ?>contact.html">contact me</a> anyway, that's what the
							form is here for!</p>
					</div>
				</div>
			</div>
		</div>
		<?php include_once("includes/footer.php"); ?>
	</div>
	</body>
	</html>
<?php

	function getAgeFromBithdate($birthdate)
	{
		return floor((time() - $birthdate) / 60 / 60 / 24 / 365);
	}

?>