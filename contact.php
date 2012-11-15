<?php 
include_once('private/config.php');
?>
<!DOCTYPE html>
<html>
	<?php include_once("includes/header.php"); ?>
	<link rel="stylesheet" href="<?php echo ROOT_SITE_URL; ?>assets/css/contact.css" />
	<body>
		<?php 
		include_once("includes/navbar.php");
		
		function checkFields() {
			if(!isset($_POST['inputName']) || !isset($_POST['inputEmail']) || !isset($_POST['inputMessage'])) {
				return "Something went wrong. Please use the form and don't try to be smart.";
			} else if(empty($_POST['inputName']) || empty($_POST['inputEmail']) || empty($_POST['inputMessage'])){
				return "Looks like you forgot one of the fields.";
			} else if(stristr($_POST['inputMessage'], '<a href=') != false) {
				return "You're trying to spam, ain't you?";
			}
			
			return null;
		}
		
		$error = false;
		$success = false;
		$error_text;
		
		if(isset($_POST['inputName']) || isset($_POST['inputEmail']) || isset($_POST['inputMessage'])) {
			require_once('lib/recaptchalib.php');
			$privatekey = "6Lccb80SAAAAAIkqLR_k7p_DLxkU5VICUqjslKSr";
			$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
					
			if(($error_text = checkFields()) != null) {
				$error = true;
			} else if(!$resp->is_valid) {
				$error = true;
				$error_text = "The captcha you entered is incorrect.";
			} else {
				$subject = 'Message de ' . $_POST['inputName'];
				
				$headers = 'Mime-Version: 1.0'."\r\n";
				$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
				$headers .= 'From: ' . $_POST['inputName'] . ' <' . $_POST['inputEmail'] . '>' . "\r\n";
				$headers .= 'Sender: outa[dev] <postmaster@outadoc.fr>' . "\r\n";
				$headers .= "\r\n";
				
				$msg = "<html><body><h1 style=\"font-size:25px; font-family: Minecraft\">Formulaire de contact outa[dev]</h1><hr /><div style=\"font-size:17px; line-height: 1.5;\"><p>" . str_replace("\n", "<br />", stripslashes(htmlspecialchars($_POST['inputMessage']))) . "</p><p>-- " . $_POST['inputName'] . "</p></div></body></html>";
				
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
						if($error) {echo '<div class="alert alert-error"><strong>Woops!</strong> ' . $error_text . '</div>';} 
						if($success) {echo '<div class="alert alert-success"><strong>Yay!</strong> Your email was sent successfuly.</div>';} 
						?>
						<form class="form-horizontal" action="contact.html" method="post">
							<div class="control-group <?php if($error && empty($_POST['inputName'])){echo 'error';} ?>">
								<label class="control-label" for="inputName">Name</label>
								<div class="controls">
									<input type="text" class="span5" name="inputName" placeholder="Chuck Norris" value="<?php echo ($error) ? $_POST['inputName'] : ""; ?>" />
								</div>
							</div>
							<div class="control-group <?php if($error && empty($_POST['inputEmail'])){echo 'error';} ?>">
								<label class="control-label" for="inputEmail">Your Email</label>
								<div class="controls">
									<input type="text" class="span5" name="inputEmail" placeholder="yourname@example.com" value="<?php echo ($error) ? $_POST['inputEmail'] : ""; ?>" />
								</div>
							</div>
							<div class="control-group <?php if($error && empty($_POST['inputMessage'])){echo 'error';} ?>">
								<label class="control-label" for="inputMessage">Message</label>
								<div class="controls">
									<textarea name="inputMessage" class="span5" placeholder="Your message here"><?php echo ($error) ? $_POST['inputMessage'] : ""; ?></textarea>
								</div>
							</div>
							<div class="control-group">
								<div class="controls">
									<?php
		    						require_once('lib/recaptchalib.php');
		    						$publickey = "6Lccb80SAAAAAKMYuirEyInGqL27DRDwp-PwvsEH";
		    						echo recaptcha_get_html($publickey);
									?>
								</div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Send message</button>
							  <button type="reset" class="btn">Reset</button>
							</div>
						</form>
					</div>
					<div class="span4">
						<p>A problem, a bug, an idea, an offer for a job, or simply the need to contact me? Fill the form on the side, and I'll try to contact you ASAP!</p>
						<p>All the fields are required.</p>
					</div>
				</div>
				<?php include_once("includes/footer.php"); ?>
			</div>
	</body>
</html>