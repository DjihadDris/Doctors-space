<?php

include('db.php');
	
$code=$_POST['code'];
$mpi = "";

$sqlo = "SELECT * FROM admins WHERE job='Infirmier' AND code='$code'";
$resulto = $conn->query($sqlo);
	if ($resulto->num_rows > 0) {
while($rowo = $resulto->fetch_assoc()) {

if($_COOKIE['job'] == "Médecin" OR $_COOKIE['job'] == "Pharmacien"){
$mpi = $_COOKIE['name'];
} else {
$mpi = $_POST['mpi'];
}
$sql = "UPDATE `admins` 
SET fn='$mpi', del='' WHERE job='Infirmier' AND code='$code'";
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