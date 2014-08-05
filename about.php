<?php include_once('private/config.php'); ?>
<!DOCTYPE html>
<html>
	<head>
	   <?php include_once("includes/header.php"); ?>
	   <link rel="stylesheet" href="<?php echo ROOT_SITE_URL; ?>assets/css/about.css" />
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
							<img src="<?php echo ROOT_SITE_URL; ?>assets/img/avatar_wondercraft.png" alt="Avatar" />
							<p>Hello there! I am a French <?php echo getAgeFromBithdate(805845600); ?> years-old indie developer. I have created a few mobile, desktop and web projects in different languages. I don't have a preferred language; I mostly use JavaScript, HTML/CSS, PHP, C and Java in my projects.</p>
							<p>I'm also using and enjoy version control tools; Git, more precisely. I know how to use development tools like <a href="http://www.appcelerator.com/products/titanium-mobile-application-development/">Appcelerator Titanium</a>, for iOS development, as well as a bit of Java here and there for Android development. I'm mostly at ease with web projects though, HTML5, and other newer technologies in that domain.</p>
							<p>My native language is French, even though I've got a B1 level in English, if that means anything. I already participated to the translation of projects like <a href="http://hyperdock.bahoom.com">HyperDock</a> or <a href="http://minecraft.net">Minecraft</a>, and am using Crowdin to manage the strings of my most successful projet, <a href="<?php echo ROOT_SITE_URL; ?>project/skinswitch/">SkinSwitch</a>.</p>
							<p>I'm not really available to participate in projects for now, because of my studies and my own personal projects. But don't be afraid to <a href="<?php echo ROOT_SITE_URL; ?>contact.html">contact me</a>!</p>
						</div>
					</div>
				</div>
			</div>
			<?php include_once("includes/footer.php"); ?>
		</div>
	</body>
</html>
<?php 
	function getAgeFromBithdate($birthdate) {
		return floor((time() - $birthdate) / 60 / 60 / 24 / 365);
	}
?>