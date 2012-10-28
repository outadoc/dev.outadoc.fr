<!--[if lt IE 10]>
<div class="ie-warning">
	<img src="<?php echo ROOT_SITE_URL; ?>assets/img/ie-warning-icon.png" alt="" />
	<h1>Please, hold your horses. Are you using Internet Explorer, for real?</h1>
	<h2>This website (and a lot of others) may be really badly displayed in this crappy browser. You should consider using <a href="https://google.com/browser/">Google Chrome</a> or <a href="http://www.mozilla.org/fr/firefox/new/">Mozilla Firefox</a> instead!</h2>
</div>
<![endif]-->
<div class="navbar">
	<div class="navbar-inner">
    	<div class="container">
      		<a class="brand" href="<?php echo ROOT_SITE_URL; ?>">outa[dev]</a>
      		<ul class="nav pull-right">
      		<?php $page = $_SERVER['PHP_SELF']; ?>
        		<li <?php if(strpos($page, "index.php")) {echo('class="active"');}?>><a href="<?php echo ROOT_SITE_URL; ?>">Home</a></li>
        		<li <?php if(strpos($page, "projects.php") || strpos($page, "view-project.php")) {echo('class="active"');}?>><a href="<?php echo ROOT_SITE_URL; ?>projects.html">Projects</a></li>
       			<li <?php if(strpos($page, "about.php")) {echo('class="active"');}?>><a href="<?php echo ROOT_SITE_URL; ?>about.html">About</a></li>
        		<li <?php if(strpos($page, "contact.php")) {echo('class="active"');}?>><a href="<?php echo ROOT_SITE_URL; ?>contact.html">Contact</a></li>
        		<li class="nav-separator">//</li>
        		<li><a href="http://github.com/outadoc">Github</a></li>
        		<li><a href="http://twitter.com/outadev">Twitter</a></li>
      		</ul>
    	</div>
  	</div>
</div>