<?php
	/*use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'vendor/autoload.php';
	$mail = PHPMailer();
	*/

	require 'PHPMailerAutoload.php';
	$mail = new PHPMailer;
	

	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];

	$content = 'Name: '.$name."\r\n";
	$content .= 'Email: '.$email."\r\n";
	$content .= 'Phone: '.$phone."\r\n";
	$content .= 'Subject: '.$subject."\r\n";
	$content .= 'Message: '.$message."\r\n";
	//$to = "georgeeejacob@gmail.com";
	$to = "athiraraj.aj@gmail.com";
	$subject = "LFPAC - Contact";


	$headers = "From: georgeeejacob@gmail.com" . "\r\n" .
	"CC: georgeeejacob@gmail.com";

	/*mail($to,$subject,$content,$headers);
	exit;*/

	/*if(mail($to,$subject,$content,$headers))
	{
		echo "Sent";
	}else{
		echo "Failed";
	}
	header("Location: contact.html");*/ 

	$mail->setFrom('georgeeejacob@gmail.com', 'GEORGE');
	$mail->addAddress('myfriend@example.net', 'My Friend');
	$mail->Subject  = 'LFPAC - Contact';
	$mail->Body     = $content;
	if(!$mail->send()) {
	  echo 'Mail was not sent.';
	  echo 'Mailer error: ' . $mail->ErrorInfo;
	} else {
	  echo 'Mail has been sent.';
	}

?>