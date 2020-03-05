<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	if(isset($_POST['name'])){
		$name = $_POST['name'];
	}
	if(isset($_POST['name1'])){
		$name = $_POST['name1'];
	}
	if(isset($_POST['name2'])){
		$name = $_POST['name2'];
	}
	if(isset($_POST['name3'])){
		$name = $_POST['name3'];
	}

	if(isset($_POST['email'])){
		$email = $_POST['email'];
	}
	if(isset($_POST['email1'])){
		$email = $_POST['email1'];
	}
	if(isset($_POST['email2'])){
		$email = $_POST['email2'];
	}
	if(isset($_POST['email3'])){
		$email = $_POST['email3'];
	}

	if(isset($_POST['phone'])){
		$phone = $_POST['phone'];
	}
	if(isset($_POST['phone1'])){
		$phone = $_POST['phone1'];
	}
	if(isset($_POST['phone2'])){
		$phone = $_POST['phone2'];
	}
	if(isset($_POST['phone3'])){
		$phone = $_POST['phone3'];
	}

	if(isset($_POST['subject'])){
		$subject = $_POST['subject'];
	}
	if(isset($_POST['message'])){
		$message = $_POST['message'];
	}	

	$content = 'Name: '.$name."\r\n";
	$content .= 'Email: '.$email."\r\n";
	$content .= 'Phone: '.$phone."\r\n";
	$content .= 'Subject: '.$subject."\r\n";
	$content .= 'Message: '.$message."\r\n";

	/* File upload */

	if(isset($_FILES['fileupload1'])){
		$fileTmpPath = $_FILES['fileupload1']['tmp_name'];
		$fileName = $_FILES['fileupload1']['name'];
		$fileSize = $_FILES['fileupload1']['size'];
		$fileType = $_FILES['fileupload1']['type'];
	}
	if(isset($_FILES['fileupload2'])){
		$fileTmpPath = $_FILES['fileupload2']['tmp_name'];
		$fileName = $_FILES['fileupload2']['name'];
		$fileSize = $_FILES['fileupload2']['size'];
		$fileType = $_FILES['fileupload2']['type'];
	}
	if(isset($_FILES['fileupload3'])){
		$fileTmpPath = $_FILES['fileupload3']['tmp_name'];
		$fileName = $_FILES['fileupload3']['name'];
		$fileSize = $_FILES['fileupload3']['size'];
		$fileType = $_FILES['fileupload3']['type'];
	}

	/*$fileTmpPath = $_FILES['fileupload']['tmp_name'];
	$fileName = $_FILES['fileupload']['name'];
	$fileSize = $_FILES['fileupload']['size'];
	$fileType = $_FILES['fileupload']['type'];*/
	$fileNameCmps = explode(".", $fileName);
	$fileExtension = strtolower(end($fileNameCmps));
	$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

	$uploadFileDir = 'upload/';
	$dest_path = $uploadFileDir . $newFileName;

	$allowedfileExtensions = array('doc', 'docx', 'pdf');
	if (in_array($fileExtension, $allowedfileExtensions)) {
		if(move_uploaded_file($fileTmpPath, $dest_path)){
		  $message ='File is successfully uploaded.';
		}else{
		  $message = 'Failed to upload file.';
		}
	}else{
	  $message = 'Failed to upload file.Please check the file type.';
	}

	//$to = "georgeeejacob@gmail.com";
	$to = "athira.raj@serville.in";
	//$subject = "LFPAC - Contact";
	$emailToName = 'Test Athira';

	$mail = new PHPMailer;
	//try {
	//$mail->SMTPDebug 	= SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->SMTPDebug 	= 2;
	$mail->Host 	 	= "smtp.gmail.com";
	$mail->Port 	 	= 587;
	$mail->SMTPSecure 	= 'tls';
	//$mail->SMTPSecure 	= PHPMailer::ENCRYPTION_STARTTLS;
	$mail->SMTPAuth 	= true;
	$mail->Username = 'athira.raj@serville.in';
	$mail->Password = 'Serv@2019';
	$mail->setFrom($email, $name);
	$mail->addAddress($to, $emailToName);

	//CC and BCC
	/*$mail->addCC("cc@example.com");
	$mail->addBCC("bcc@example.com");*/

	$mail->isHTML(true); // Set email format to HTML
	
	if(isset($_POST['subject'])){
		$mail->Subject 		= $subject;
	}else{
		$mail->Subject = "LFPAC - Contact";
	}
	//$mail->msgHTML("test body");
	$mail->Body 		= $content;
	$mail->AltBody 		= 'No content.';
	$mail->AddAttachment($dest_path , $fileName);

	if(isset($_POST['subject'])){
		$location = 'contact.html';
	}else{
		$location = 'career.html';
	}

	if(!$mail->Send()){
		/*echo "Mailer error : ". $mail->ErrorInfo;
		header("Location: $location");*/

		echo "Message could not be sent. <p>";
		echo "Mailer Error: " . $mail->ErrorInfo;
		exit;

	}else{
		/*echo "Message sent";*/
		echo "<script>alert('Message has been sent')</script>";
		header("Location: $location");

	}
?>