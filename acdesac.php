<?php

include('db.php');

$name = $_POST['name'];
$email = $_POST['email'];
$change = $_POST['change'];
$from = $_POST['from'];

if($from == "users"){
$sql = "UPDATE admins SET status='$change' WHERE name='$name' AND email='$email'";
}else if($from == "patients"){
$sql = "UPDATE patients SET status='$change' WHERE name='$name' AND email='$email'";
}else if($from == "nurses"){
$sql = "UPDATE admins SET status='$change' WHERE job='Infirmier' AND name='$name' AND email='$email'";
}else{
$sql = "UPDATE drugs SET status='$change' WHERE name='$name'";
}
if ($conn->query($sql) === TRUE) {
echo "200";
}else{
	echo "201";
}
?>