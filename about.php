<?php include_once('private/config.php'); ?>
<!DOCTYPE html>
<html>
    <head>
	   <?php include_once("includes/header.php"); ?>
	   <link rel="stylesheet" href="<?php echo ROOT_SITE_URL; ?>assets/css/about.css" />
    </head>
	<body>
	    <?php include_once("includes/navbar.php"); ?>
    	<div class="container">
    		<div class="content">
    			<div class="page-header">
    			    <h1>About the developer</h1>
    			</div>
    			<div class="row">
    				<div class="span12">
    					<img src="<?php echo ROOT_SITE_URL; ?>assets/img/avatar_wondercraft.png" alt="Avatar" />
    					<p>Hello there! I am a French <?php echo getAgeFromBithdate(805845600); ?> years-old indie developer. I have created a few mobile, desktop and web projects in different languages. I don't have a preferred language; I master some (JavaScript, HTML/CSS, PHP,..) and know the basics of a few others (C, C++, Java, Python, Visual Basic,..).</p>
    					<p>I also master version control tools like Git. I know how to use development tools like <a href="http://www.appcelerator.com/products/titanium-mobile-application-development/">Appcelerator Titanium</a>, for iOS/Android development, as well as frameworks like <a href="http://twitter.github.com/bootstrap">Twitter Bootstrap</a>, with which was designed this website.</p>
    					<p>My native language is French and I have a B1 level in English. I already participated to the localization of projects like <a href="http://hyperdock.bahoom.com">HyperDock</a> or <a href="http://minecraft.net">Minecraft</a>.</p>
    					<p>I can be interested in participating in small projects, web mainly; <a href="<?php echo ROOT_SITE_URL; ?>contact.html">contact me</a>!</p>
    			    </div>
    			</div>
    		</div>
    	</div>
    	<?php include_once("includes/footer.php"); ?>
	</body>
</html>
<?php 
    function getAgeFromBithdate($birthdate) {
        return floor((time() - $birthdate) / 60 / 60 / 24 / 365);
    }
?>