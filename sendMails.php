<?php

class sendMails {

	private $username = "rsantellan@gmail.com";
	private $password = "";
	private $placeURL = "http://www.thetaterra.com/beta";//"http://myfiles.dnsdojo.org/subdued"; //"http://local.tethaterra.com/";// "http://myfiles.dnsdojo.org/";
	
	public function sendUploadMail($userId,$file){
        $MESSAGE_BODY = "<h2>Un usuario a subido un archivo a ThetaTerra</h2><br>";
        $MESSAGE_BODY .= "Para ver el archivo haga click aqui link(En este momento no funciona el link).";
        $MESSAGE_BODY .= "<br>";
        $MESSAGE_BODY .= "El id del usuario es: ".$userId." y el archivo es: ".$file;
		$MESSAGE_BODY .= "<br>";

		return $this->altSendMail($this->username,"Archivo subido a Theta terra",$MESSAGE_BODY,$this->username);
	}
	
	public function sendActivationMail($email, $name = null){
        $Usuario = "";
        if($name != null){
        	$Usuario = $name." "; 
        }
        $MESSAGE_BODY = "<h2>Bienvenido ". $Usuario ."al servicio de mailing de ThetaTerra</h2><br>";
        $MESSAGE_BODY .= "Para activar este servicio por favor haga click en el siguiente ";
        $MESSAGE_BODY .= "<a href='".$this->placeURL."/listActivation.php?m=".base64_encode ( $email )."'>link</a><br>";
		$MESSAGE_BODY .= "<br>";

		return $this->sendMail($this->username,"Bienvenido a Theta terra",$MESSAGE_BODY,$email);
	}
	
	public function sendDeactivationEmail($email){
		$MESSAGE_BODY = "<h2>Usted se ha dado de baja al servicio de mailing de ThetaTerra</h2><br>";
        $MESSAGE_BODY .= "Para desactivar este servicio por favor haga click en el siguiente ";
        $MESSAGE_BODY .= "<a href='".$this->placeURL."/listDeactivation.php?m=".base64_encode ( $email )."'>link</a><br>";
		$MESSAGE_BODY .= "<br>";

		return $this->sendMail($this->username,"Confirmacion del mailing de Theta terra",$MESSAGE_BODY,$email);
	}
	
	public function sendFeedBackMail($from, $name, $comment){
		$MESSAGE_BODY = "Name: ".$name."<br>"; 
		$MESSAGE_BODY .= "Email: ".$from."<br>"; 
		$MESSAGE_BODY .= "Comment: ".nl2br($comment)."<br>"; 

		return $this->sendMail($from, "Theta terra Comentario",$MESSAGE_BODY,$this->username);
	}
	
	private function sendMail($from, $Subject,$MESSAGE_BODY,$to){
		include("./PHPMailer/class.phpmailer.php");
		include("./PHPMailer/class.smtp.php");
        $mail = new PHPMailer();
		$mail->Host = "relay-hosting.secureserver.net";
		/*
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		//$mail->SMTPSecure = "ssl";
		$mail->Host = "smtp.gmail.com";
		//$mail->Port = 465; // set the SMTP port for the GMAIL server        
		$mail->Port = 587;
		$mail->Username = $this->username;
		$mail->Password = $this->password;
		*/
        $mail->From = 'thetaterra@mail.com';//$from;
        $mail->FromName = "Theta terra";
        $mail->Subject = $Subject;

        $mail->AltBody = $MESSAGE_BODY;
        $mail->MsgHTML($MESSAGE_BODY);
        $mail->AddAddress($to, "Destinatario");
        $mail->IsHTML(true);
        if(!$mail->Send()) {
        	print_r( "Error: " . $mail->ErrorInfo);
            return false;
        }
		return true;
	}
	
	private function altSendMail($from, $Subject,$MESSAGE_BODY,$to){
		include("../PHPMailer/class.phpmailer.php");
		include("../PHPMailer/class.smtp.php");
        $mail = new PHPMailer();
        $mail->Host = "relay-hosting.secureserver.net";
		/*
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		//$mail->SMTPSecure = "ssl";
		$mail->Host = "smtp.gmail.com";
		//$mail->Port = 465; // set the SMTP port for the GMAIL server        
		$mail->Port = 587;
		$mail->Username = $this->username;
		$mail->Password = $this->password;
		*/
        $mail->From = 'thetaterra@mail.com';//$from;
        $mail->FromName = "Theta terra";
        $mail->Subject = $Subject;

        $mail->AltBody = $MESSAGE_BODY;
        $mail->MsgHTML($MESSAGE_BODY);
        $mail->AddAddress($to, "Destinatario");
        $mail->IsHTML(true);
        if(!$mail->Send()) {
        	print_r( "Error: " . $mail->ErrorInfo);
            return false;
        }
		return true;
	}
}

