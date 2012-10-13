<head>
	<?php 
	
	$title = "";
	$page = $_SERVER['PHP_SELF'];
	
	if(preg_match('#/index.php#', $page)) {
		$title = "outadev";
	} else if(preg_match('#/projects.php#', $page)) {
		$title = "Projects";
	} else if(preg_match('#/about.php#', $page)) {
		$title = "About";
	} else if(preg_match('#/contact.php#', $page)) {
		$title = "Contact";
	} else if(preg_match('#/view-project.php#', $page)) {
		$title = htmlspecialchars($data['name']);
	}
	
	?>
	
	<title>outa[dev] - <?php echo $title; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta property="description" content="Web, mobile and desktop amateur development. Download SkinSwitch, FreeStance and many more!" />
	<meta property="keywords" content="outadev, outadoc, development, freestance, skinswitch, application, iphone, ios, amateur, programming" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="icon" type="image/png" href="<?php echo ROOT_SITE_URL; ?>assets/img/favicon.png" />
	<link rel="stylesheet" href="<?php echo ROOT_SITE_URL; ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo ROOT_SITE_URL; ?>assets/css/main.css" />
</head>