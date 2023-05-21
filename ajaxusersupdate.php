<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
include('db.php');
	$id=$_POST['id'];
	$fn=$_POST['fn'];
	$job=$_POST['job'];
	$gender=$_POST['gender'];
	$dob=$_POST['dob'];
	$seal=$_POST['seal'];
	$signature=$_POST['signature'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$pn=$_POST['pn'];
	$password=$_POST['password'];
	$address=$_POST['address'];
	$wilaya=$_POST['wilaya'];
	$groupage=$_POST['groupage'];
	$description=$_POST['description'];
	$message = "Votre mot de passe est: ".$password."\r\rVeuillez changer votre mot de passe après vous être connecté\r\rMinistère de la Santé";
	$sql = "UPDATE `admins` 
	SET `name`='$name',
	`email`='$email',
	`fn`='$fn',
	`job`='$job',
	`gender`='$gender',
	`dob`='$dob',
	`seal`='$seal',
	`signature`='$signature',
	`pn`='$pn',
	`password`='$password',
    `address`='$address',
    `wilaya`='$wilaya',
	`groupage`='$groupage', `description`='$description' WHERE ID=$id";
	if (mysqli_query($conn, $sql)) {
		try {
			$mail = new PHPMailer(true);
		
			// SMTP configuration
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';  // Your SMTP server hostname
			$mail->SMTPAuth = true;
			$mail->Username = 'djihad139@gmail.com'; // Your SMTP username
			$mail->Password = 'acxvkdwyxkityhfc'; // Your SMTP password
			$mail->SMTPSecure = 'ssl'; // Enable encryption, 'ssl' also accepted
			$mail->Port = 465; // TCP port to connect to
		
			// Sender and recipient details
			$mail->setFrom('no-reply@medecin.epizy.com', 'Ministère de la Santé');
			$mail->addAddress("$email", "$name");
		
			// Email content
			$mail->Subject = 'Récupération de mot de passe - Ministère de la Santé';
			$mail->Body = "$message";
		
			// Send the email
			$mail->send();
			echo json_encode(array("statusCode"=>200, "message"=>"Votre mot de passe a été envoyé à votre adresse e-mail avec succès"));
		} catch (Exception $e) {
			echo json_encode(array("statusCode"=>201, "message"=>"Erreur: ".$mail->ErrorInfo));
		}
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>