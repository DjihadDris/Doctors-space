<?php
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

$msg = "Bonjour, $name \n Votre mot de passe est: $password";
$msg = wordwrap($msg,70);
mail($email,"Ministère de la Santé",$msg);

	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>