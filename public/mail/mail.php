<?php
require("class.phpmailer.php");


	//form validation vars
	$formok = true;
	$errors = array();
	
	//sumbission data
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$date = date('d/m/Y');
	$time = date('H:i:s');
	
	//form data
	$name = $_POST['name'];	
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];



	$mail = new PHPMailer();

	/*
	$mail->IsSMTP();                                 		 // send via SMTP
	$mail->Host     = "smtp.domain.com"; 					 // SMTP server
	$mail->SMTPAuth = true;    								 // turn on SMTP authentication
	$mail->Username = "no-reply@domain.com"; 			     // SMTP username
	$mail->Password = "password";							 // SMTP password
	*/

	$mail->From     = "no-reply@domain.com";				 // SMTP username
	$mail->AddAddress("thecodecafe@gmail.com");			  	 // Your Adress
	$mail->Subject  =  "New mail from Spri !";
	$mail->IsHTML(true);  
	$mail->CharSet = 'UTF-8';
	$mail->Body     =  "<p>You have recieved a new message from the enquiries form on your website.</p>
						  <p><strong>Name: </strong> {$name} </p>
						  <p><strong>Email Address: </strong> {$email} </p>
						  <p><strong>Phone Number: </strong> {$phone} </p>
						  <p><strong>Website: </strong> {$phone} </p>
						  <p><strong>Message: </strong> {$message} </p>
						  <p>This message was sent from the IP Address: {$ipaddress} on {$date} at {$time}</p>";

	if(!$mail->Send())
	{
	   echo "Mail Not Sent <p>";
	   echo "Mailer Error: " . $mail->ErrorInfo;
	   exit;
	}

	echo " Your message has been sent successfully.";


?>
