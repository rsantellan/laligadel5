<?php

class SendMail {

	private $username = "rsantellan@gmail.com";

	private $list = array(
                'rsantellan@gmail.com',
                'alfredobalino@gmail.com',
                'fbola18@hotmail.com',
                'diegoceicys@hotmail.com',
                'spi.loki@gmail.com',
                'brusco84@gmail.com',
                'juanmorlan@gmail.com',
                'flowersuy@gmail.com',
                'lmauro_7@hotmail.com',
                'chogron@hotmail.com',
                'lbueno26@gmail.com',
                'juan.taborelli@gmail.com',
                'agustin2424@gmail.com',
                'jgmeilan@hotmail.com',
                'jocheval@gmail.com',
                'andalican17@hotmail.com',
                'pablo.morlan@linde.com',
                'agustin.recine@gmail.com',
                'arq.fflores@gmail.com',
                'giannibazz@gmail.com'
                );

	public function sendFeedBackMail($from, $name, $comment){
		$MESSAGE_BODY = "Name: ".$name."<br>"; 
		$MESSAGE_BODY .= "Email: ".$from."<br>"; 
		$MESSAGE_BODY .= "Comment: ".nl2br($comment)."<br>";
		$first = true;
		foreach($this->list as $mail){
			$this->actualSendMail($from, "La liga del 5 Comentario",$MESSAGE_BODY,$mail, $first);
			if($first)$first =false;
		} 
		return true;
	}

        public function sendPhotoMail($file_name){
            $MESSAGE_BODY = "Se subion la siguiente foto por uploads ". $file_name;
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
            $mail->FromName = "laligadel5";
            $mail->Subject = "La liga del 5 admin";
            $mail->AltBody = $MESSAGE_BODY;
            $mail->MsgHTML($MESSAGE_BODY);
            $mail->AddAddress('rsantellan@gmail.com', "Destinatario");
            $mail->IsHTML(true);
            if(!$mail->Send()) {
            	print_r( "Error: " . $mail->ErrorInfo);
                return false;
            }
            return true;
	}

	public function actualSendMail($from, $Subject,$MESSAGE_BODY,$to, $include){
		if($include){
			include("./PHPMailer/class.phpmailer.php");
			include("./PHPMailer/class.smtp.php");
		}        	
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
		$mail->FromName = "laligadel5";
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

