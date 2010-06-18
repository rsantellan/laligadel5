<?php include('header.php') ?>

<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true, 
				continuous: true
			});
      		/*$("img").lazyload({ 
                    placeholder : "photos/waiting.gif",
                    effect : "fadeIn"
        	});*/
      		$('#menu_index').addClass('active');
		});	
	</script>
<?php include('closeHeader.php')?>

<?php include('logoAndMenu.php')?>

<div id="body">
	<h2 class="title">Resumen de la ultima fecha</h2>
	<div class="story">
		<div class="post hr">
			<h1><em>Comentarios</em></h1>
			
			<?php 
			if ($_POST["email"]<>'') {
				require_once('recaptcha-php/recaptchalib.php');
				$privatekey = "6LdZ4goAAAAAAFpYtpqM3kT31X2RDRVquuQhVNf2";
				$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

				if (!$resp->is_valid) {
					die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
       							"(reCAPTCHA said: " . $resp->error . ")");
				}
 				include("logica/sendMails.php");
				$sendMail = new sendMails();
				$sendMail->sendFeedBackMail($_POST["email"],$_POST["name"],$_POST["comment"]);
			?> 
			<h2>Gracias por su comentario</h2>
		<?php 
		} else { 
		?> 
		<form action="contact.php" method="post"> 
			<table width="400" border="0" cellspacing="2" cellpadding="0"> 
				<tr> 
					<td width="29%" class="bodytext">Nombre:</td> 
					<td width="71%"><input name="name" type="text" id="name" size="32"></td> 
				</tr> 
				<tr> 
					<td class="bodytext">Correo Electronico:</td> 
					<td><input name="email" type="text" id="email" size="32"></td> 
				</tr> 
				<tr> 
					<td class="bodytext">Comentario:</td> 
					<td><textarea name="comment" cols="45" rows="6" id="comment" class="bodytext"></textarea></td> 
				</tr> 
				<tr>
					<td> </td>
					<td> 
					<?php require_once('recaptcha-php/recaptchalib.php');
						$publickey = "6LdZ4goAAAAAAKIWfiTHnuYWSOUen6cmixtQA2-3"; // you got this from the signup page
						echo recaptcha_get_html($publickey);?> 
					</td>
				</tr>
				<tr> 
					<td class="bodytext">&nbsp;</td> 
					<td align="left" valign="top"><input type="submit" name="Submit" value="Send"></td> 
				</tr> 
			</table>
		</form> 
	<?php 
	}; 
	?>
	</div>
</div>

<?php include('bottom.php')?>