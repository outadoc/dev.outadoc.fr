<div class="navbar">
	<div class="navbar-inner">
    	<div class="container">
      		<a class="brand" href="<?php echo ROOT_SITE_URL; ?>">outa[dev]</a>
      		<ul class="nav pull-right">
      		<?php $page = $_SERVER['PHP_SELF']; ?>
        		<li <?php if(strpos($page, "index.php")) {echo('class="active"');}?>><a href="<?php echo ROOT_SITE_URL; ?>">Home</a></li>
        		<li <?php if(strpos($page, "projects.php") || strpos($page, "view-project.php")) {echo('class="active"');}?>><a href="<?php echo ROOT_SITE_URL; ?>projects.php">Projects</a></li>
       			<li <?php if(strpos($page, "about.php")) {echo('class="active"');}?>><a href="<?php echo ROOT_SITE_URL; ?>about.php">About</a></li>
        		<li <?php if(strpos($page, "contact.php")) {echo('class="active"');}?>><a href="<?php echo ROOT_SITE_URL; ?>contact.php">Contact</a></li>
        		<li class="nav-separator">//</li>
        		<li><a href="http://github.com/outadoc">Github</a></li>
        		<li><a href="http://twitter.com/#!/outadev">Twitter</a></li>
      		</ul>
    	</div>
  	</div>
</div>