<?php

include('db.php');
	
$code=$_POST['code'];
$mpi = "";

$sqlo = "SELECT * FROM patients WHERE code='$code'";
$resulto = $conn->query($sqlo);
	if ($resulto->num_rows > 0) {
while($rowo = $resulto->fetch_assoc()) {

if($_COOKIE['job'] == "Médecin" OR $_COOKIE['job'] == "Pharmacien"){
$mpi = $_COOKIE['name'];
}else if($_COOKIE['job'] == "Infirmier"){
$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
while($rows = $results->fetch_assoc()) {

$mpi = "$rows[fn]";

}}else{
	echo "201";
}
} else {
$mpi = $_POST['mpi'];
}
$sql = "UPDATE `patients` 
SET mpi='$mpi', del='' WHERE code='$code'";
if (mysqli_query($conn, $sql)) {
	echo "200";
} 
else {
	echo "201";
}

}}else{
	echo "202";
}

mysqli_close($conn);
?>