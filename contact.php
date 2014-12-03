<?php include_once('private/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once("includes/header.php"); ?>
	<link rel="stylesheet" href="<?php echo ROOT_SITE_URL; ?>assets/css/contact.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<div class="wrapper">
	<?php include_once("includes/navbar.php");

		function checkFields()
		{
			if (!isset($_POST['inputName']) || !isset($_POST['inputEmail']) || !isset($_POST['inputMessage'])) {
				return "Something messed with the form. <em>Don't try to fool me.</em>";
			} else if (empty($_POST['inputName']) || empty($_POST['inputEmail']) || empty($_POST['inputMessage'])) {
				return "Looks like you forgot one of the fields, try again!";
			} else if (stristr($_POST['inputMessage'], '<a href=') != false) {
				return "Bots are not welcome in this place.";
			} else if (!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) {
				return "Your email address looks invalid.";
			}

			return null;
		}

		$error   = false;
		$success = false;

		if (isset($_POST['inputName']) || isset($_POST['inputEmail']) || isset($_POST['inputMessage'])) {
			//check if the captcha was okay
			$recaptcha_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='
				. RECAPTCHA_PRIVATE_KEY . '&response=' . $_POST['g-recaptcha-response']);

			if (($error_text = checkFields()) != null) {
				//there was an error in the form
				$error = true;
			} else if (strpos($recaptcha_response, '"success": true') === false) {
				//the captcha was invalid
				$error      = true;
				$error_text = "Couldn't confirm that you <em>are</em> human. Sorry, robot.";
			} else {
				//everything's supposedly okay, send the mail
				$subject = 'Message from ' . $_POST['inputName'];

				$headers = 'Mime-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				$headers .= 'From: ' . $_POST['inputName'] . ' <' . $_POST['inputEmail'] . '>' . "\r\n";
				$headers .= 'Sender: outa[dev] <postmaster@outadoc.fr>' . "\r\n";
				$headers .= 'X-Sender-IP: ' . $_SERVER['REMOTE_ADDR'] . "\r\n";
				$headers .= "\r\n";

				$msg = "<html><body><h1 style=\"font-size:25px; font-family:'Helvetica Neue'\">outa[dev] contact form</h1><hr /><div style=\"font-size:17px; line-height: 1.5;\"><p>" . str_replace("\n", "<br />", stripslashes(htmlspecialchars($_POST['inputMessage']))) . "</p><p>-- " . $_POST['inputName'] . "</p></div></body></html>";

				mail(CONTACT_EMAIL, $subject, $msg, $headers);
				$success = true;
			}
		}
	?>
	<div class="container">
		<div class="page-header">
			<h1>Contact form</h1>
		</div>
		<div class="row">
			<div class="span7">
				<?php

					if ($error) {
						echo '<div class="alert alert-error"><strong>Woops!</strong> ' . $error_text . '</div>';
					}

					if ($success) {
						echo '<div class="alert alert-success"><strong>Yay!</strong> Your email was sent successfuly.</div>';
					}

				?>
				<form class="form-horizontal" action="contact.html" method="post">
					<div class="control-group <?php if ($error && empty($_POST['inputName'])) {
						echo 'error';
					} ?>">
						<label class="control-label" for="inputName">Your Name</label>

						<div class="controls">
							<input type="text" class="span5" name="inputName" placeholder="Chuck Norris"
							       value="<?php echo ($error) ? $_POST['inputName'] : ""; ?>">
						</div>
					</div>
					<div class="control-group <?php if ($error && empty($_POST['inputEmail'])) {
						echo 'error';
					} ?>">
						<label class="control-label" for="inputEmail">Your Email</label>

						<div class="controls">
							<input type="text" class="span5" name="inputEmail" placeholder="yourname@example.com"
							       value="<?php echo ($error) ? $_POST['inputEmail'] : ""; ?>">
						</div>
					</div>
					<div class="control-group <?php if ($error && empty($_POST['inputMessage'])) {
						echo 'error';
					} ?>">
						<label class="control-label" for="inputMessage">Your Message</label>

						<div class="controls">
							<textarea name="inputMessage" class="span5"
							          placeholder="Your message here"><?php echo ($error) ? $_POST['inputMessage'] : ""; ?></textarea>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<div class="g-recaptcha" data-sitekey="6LeNsP4SAAAAAGaq5BnDPhqvBBd0Y4E-HQ5tMKe3"></div>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Send message</button>
						<button type="reset" class="btn">Reset</button>
					</div>
				</form>
			</div>
			<div class="span4">
				<p>A problem, a bug, an idea, or simply the need to contact me? Fill the form on the side, and I'll try
					to contact you ASAP!</p>

				<p>All the fields are required.</p>

				<p>Please write your message in English or in French.</p>
			</div>
		</div>
		<?php include_once("includes/footer.php"); ?>
	</div>
</div>
</body>
</html>