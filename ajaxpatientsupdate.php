<?php
	include('db.php');
	$id=$_POST['id'];
	$fn=$_POST['fn'];
	$notes=$_POST['notes'];
	$gender=$_POST['gender'];
	$dob=$_POST['dob'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$pn=$_POST['pn'];
	$mpi=$_POST['mpi'];
	$height = $_POST['height'];
    $weight = $_POST['weight'];
    $chronic = $_POST['chronic'];
    $surgeries = $_POST['surgeries'];
    $allergies = $_POST['allergies'];
    $wilaya = $_POST['wilaya'];
    $groupage = $_POST['groupage'];
    $address = $_POST['address'];
	if($_COOKIE['job'] == "Admin"){
 
	$password=$_POST['password'];
$sql = "UPDATE `patients` 
	SET `name`='$name',
	`email`='$email',
	`fn`='$fn',
	`notes`='$notes',
	`gender`='$gender',
	`dob`='$dob',
	`pn`='$pn',
	`mpi`='$mpi',
	`height`='$height',
	`weight`='$weight',
	`chronic`='$chronic',
	`surgeries`='$surgeries',
	`allergies`='$allergies',
	`groupage`='$groupage',
	`wilaya`='$wilaya',
	`address`='$address',
	`password`='$password' WHERE ID=$id";

	$msg = "Bonjour, $name \n Votre mot de passe est: $password";
$msg = wordwrap($msg,70);
mail($email,"Ministère de la Santé",$msg);
}else{
	$sql = "UPDATE `patients` 
	SET `name`='$name',
	`email`='$email',
	`fn`='$fn',
	`notes`='$notes',
	`gender`='$gender',
	`dob`='$dob',
	`pn`='$pn',
	`mpi`='$mpi',
	`height`='$height',
	`weight`='$weight',
	`chronic`='$chronic',
	`surgeries`='$surgeries',
	`allergies`='$allergies',
	`groupage`='$groupage',
	`wilaya`='$wilaya',
	`address`='$address' WHERE ID=$id";
}
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>