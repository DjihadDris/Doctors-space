<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
	include('db.php');
	$id=$_POST['id'];
	$name=$_POST['name'];
	$dob=$_POST['dob'];
	$gender=$_POST['gender'];
	$email=$_POST['email'];
	$pn=$_POST['pn'];
	$fn=$_POST['fn'];
	$address=$_POST['address'];
	$wilaya=$_POST['wilaya'];
	$groupage=$_POST['groupage'];
	$password=$_POST['password'];
	$message = "Votre mot de passe est: ".$password."\r\rVeuillez changer votre mot de passe après vous être connecté\r\rMinistère de la Santé";
if($_COOKIE['job'] == "Admin"){
	$sql = "UPDATE `admins` 
	SET `fn`='$fn',
	`name`='$name',
	`email`='$email',
	`gender`='$gender',
	`dob`='$dob',
	`pn`='$pn',
	`password`='$password', `address`='$address', `wilaya`='$wilaya', `groupage`='$groupage' WHERE job='Infirmier' AND ID=$id";
}else{
	$sql = "UPDATE `admins` 
	SET `fn`='$fn',
	`name`='$name',
	`email`='$email',
	`gender`='$gender',
	`dob`='$dob',
	`pn`='$pn', `address`='$address', `wilaya`='$wilaya', `groupage`='$groupage' WHERE job='Infirmier' AND ID=$id";
}
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