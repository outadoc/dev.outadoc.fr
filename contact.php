<?php include_once('private/config.php'); ?>
<!DOCTYPE html>
<html>
	<?php include_once("includes/header.php"); ?>
	<link rel="stylesheet" href="<?php echo ROOT_SITE_URL; ?>assets/css/contact.css" />
	<body>
	    <?php include_once("includes/navbar.php"); ?>
	    	<div class="container">
	    		<div class="content">
	    			<div class="page-header">
	    			    <h1>Contacter le développeur</h1>
	    			</div>
	    			<div class="row">
	    				<div class="span12">
		    				<div class="span6">
		    					<form class="form-horizontal" method="POST" action="./contact">
		    						<fieldset>
		    							<?php 
		    								include_once('includes/mail.php');
		    							?>
				    					<div class="control-group <?php echo getIfError('pseudo'); ?>">
				    						<label class="control-label" for="name">Nom ou pseudo</label>
				    						<div class="controls">
				    							<input class="input-xlarge" id="name" name="pseudo" type="text" value="<?php echo getFieldValue('pseudo'); ?>">
				    						</div>
				    					</div>
				    					<div class="control-group <?php echo getIfError('email'); ?>">
				    						<label class="control-label" for="email">Adresse email</label>
				    						<div class="controls">
				    							<input class="input-xlarge" id="email" name="email" type="text" value="<?php echo getFieldValue('email'); ?>">
				    						</div>
				    					</div>
				    					<div class="control-group <?php echo getIfError('message'); ?>">
				    						<label class="control-label" for="message">Contenu du message</label>
				    						<div class="controls">
				    							<textarea class="input-xlarge" id="message" name="message" type="text" rows="4"><?php echo getFieldValue('message'); ?></textarea>
				    						</div>
				    					</div>
				    					<div class="control-group">
					    					<?php
					    						require_once('lib/recaptchalib.php');
					    						$publickey = "6Lccb80SAAAAAKMYuirEyInGqL27DRDwp-PwvsEH";
					    						echo recaptcha_get_html($publickey);
					    					?>
				    					</div>
				    					<div class="form-actions">
				    						<button type="submit" class="btn btn-primary">Envoyer</button>
				    						<button type="reset" class="btn">Effacer</button>
				    					</div>
			    					</fieldset>
		    					</form>
		    			    </div>
		    			    <div class="span4">
		    			    	<p>
		    			    		Un problème, un bug, une idée, une offre de travail, ou simplement besoin de me contacter ? Remplissez le formulaire ci-contre, et je me ferai une joie de vous répondre dans les plus brefs délais !
		    			    	</p>
		    			    	<p>
		    			    		Tous les champs sont obligatoires.
		    			    	</p>
		    			    </div>
		    			</div>
	    			</div>
	    		</div>
	    		<?php include_once("includes/footer.php"); ?>
	    	</div>
	</body>
</html>