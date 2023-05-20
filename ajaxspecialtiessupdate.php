<?php
	include('db.php');
	$id=$_POST['id'];
	$namefr=$_POST['namefr'];
	$namear=$_POST['namear'];
	$sql = "UPDATE `specialties` 
	SET `namefr`='$namefr',
	`namear`='$namear' WHERE ID=$id";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>