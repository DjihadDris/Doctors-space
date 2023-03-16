<?php
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

if($_COOKIE['job'] == "Admin"){
 
	$password=$_POST['password'];
	$sql = "UPDATE `admins` 
	SET `fn`='$fn',
	`name`='$name',
	`email`='$email',
	`gender`='$gender',
	`dob`='$dob',
	`pn`='$pn',
	`password`='$password', `address`='$address', `wilaya`='$wilaya', `groupage`='$groupage' WHERE job='Infirmier' AND ID=$id";

$msg = "Bonjour, $name \n Votre mot de passe est: $password";
$msg = wordwrap($msg,70);
mail($email,"Ministère de la Santé",$msg);
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
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>