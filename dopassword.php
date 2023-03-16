<?php
include('db.php');

$name = $_COOKIE['name'];
$email = $_COOKIE['email'];

$actualpassword = $_POST['actualpassword'];
$newpassword = $_POST['newpassword'];
$newnewpassword = $_POST['newnewpassword'];

$sqld = "SELECT * FROM admins WHERE name='$name' AND email='$email'";
$resultd = $conn->query($sqld);

if ($resultd->num_rows > 0) {
  // output data of each row
while($row = $resultd->fetch_assoc()) {

if("$row[password]" == $actualpassword){
if($newpassword == $newnewpassword){

$sql = "UPDATE admins SET password='$newpassword' WHERE email='$email'";

if ($conn->query($sql) === TRUE) {
header('Location: profile?true');
}else{
header('Location: profile?false=errordb');
}
}else{
	header('Location: profile?false=errornewpassword');
}
}else{
header('Location: profile?false=erroractualpassword');
}
}}else{
	echo '0 results...';
}
?>