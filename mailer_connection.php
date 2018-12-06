<?php
	require 'PHPMailerAutoload.php';
	$mail = new PHPMailer(true);
	$mail->isSMTP();					// Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'YOUR EMAIL';                 // SMTP username
	$mail->Password = 'YOUR PASSWORD';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
	$mail->Port = 465;

	$mail->From = 'vivekagal90@gmail.com';
	$mail->FromName = 'Vivek Shah';
	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	$mail->isHTML(true);                                  // Set email format to HTML
?>
