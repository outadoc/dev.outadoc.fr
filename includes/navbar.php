<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
    	<div class="container">
      		<a class="brand" href="./">outa[dev]</a>
      		<ul class="nav">
      		<?php $page = $_SERVER['PHP_SELF']; ?>
        		<li <?php if(strpos($page, "index.php")) {echo('class="active"');}?>><a href="./">Accueil</a></li>
       			<li <?php if(strpos($page, "about.php")) {echo('class="active"');}?>><a href="about.php">À propos</a></li>
        		<li <?php if(strpos($page, "contact.php")) {echo('class="active"');}?>><a href="contact.php">Contact</a></li>
        		<li class="divider-vertical"></li>
        		<li><a href="http://twitter.com/#!/outadev">Twitter</a></li>
      		</ul>
    	</div>
  	</div>
</div>