<?php
	include('db.php');
	$id=$_POST['id'];
	$name=$_POST['name'];
	$form=$_POST['form'];
	$sql = "UPDATE `drugs` 
	SET `name`='$name',
	`form`='$form' WHERE ID=$id";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>