<?php
	$hasError = true;
	
	function getAlertBar($message, $isError) {
		$alert = '<div class="alert';
		if($isError) {
			$alert .= ' alert-error';
		} else {
			$alert .= ' alert-success';
		}
		
		$alert .= '"><strong>';
		
		if($isError) {
			$alert .= 'Erreur !';
		} else {
			$alert .= 'Succès !';
		}
		
		$alert .= '</strong> ' . $message . '</div>';
		return $alert;
	}
	
	function getIfError($field) {
		if(isset($_POST[$field]) && empty($_POST[$field])) {
			return 'error';
		}
	}
	
	function getFieldValue($field) {
		global $hasError;
		if($hasError && isset($_POST[$field]) && !empty($_POST[$field])) {
			return $_POST[$field];
		}
	}
	
	if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['message'])) {
		require_once('lib/recaptchalib.php');
		$privatekey = "6Lccb80SAAAAAIkqLR_k7p_DLxkU5VICUqjslKSr";
		$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
		
		if(empty($_POST['pseudo']))
			echo getAlertBar('Vérifiez que vous avez bien entré votre pseudo/nom.', true);
		
		else if(empty($_POST['email']))
		{
			echo getAlertBar('Vérifiez que vous avez bien entré votre adresse email et qu\'elle est correcte.', true);
		}
		
		else if(empty($_POST['message']))
		{
			echo getAlertBar('Vous devez entrer un message.', true);
		}
		
		else if (!$resp->is_valid) //recaptcha validation
		{
		    echo getAlertBar('Le captcha entré est incorrect.', true);
		}
		
		else
		{
			$hasError = false;
			echo getAlertBar('L\'email a été envoyé.', false);
			
			$to = 'outadoc@me.com';
			
			$subject = 'Message de ' . $_POST['pseudo'];
			
			$headers = 'Mime-Version: 1.0'."\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
			$headers .= 'From: ' . $_POST['pseudo'] . ' <' . $_POST['email'] . '>' . "\r\n";
			$headers .= 'Sender: outa[dev] <postmaster@outadoc.fr>' . "\r\n";
			$headers .= "\r\n";
			
			$msg = "<html><body><h1 style=\"font-size:25px; font-family: Minecraft\">Formulaire de contact outa[dev]</h1><hr /><div style=\"font-size:17px; line-height: 1.5;\"><p>" . str_replace("\n", "<br />", stripslashes(htmlspecialchars($_POST['message']))) . "</p><p>-- " . $_POST['pseudo'] . "</p></div></body></html>";
			
			mail($to, $subject, $msg, $headers);
		}
	}
?>