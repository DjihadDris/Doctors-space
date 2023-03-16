<?php
include('db.php');


$name = $_POST['name'];
$fn = $_POST['fn'];
$dob = $_POST['dob'];
$date = $_POST['date'];
$time = $_POST['time'];
if($_POST['price'] != ""){
$price = $_POST['price'];
}else{
$price = "-";
}
if($_POST['pay'] != ""){
$pay = $_POST['pay'];
}else{
$pay = "-";
}
if($_POST['remain'] != ""){
$remain = $_POST['remain'];
}else{
$remain = "-";
}
if($_POST['observation'] != ""){
$observation = $_POST['observation'];
}else{
$observation = "-";
}

$sql = "UPDATE appointments SET price='$price', pay='$pay', remain='$remain', observation='$observation' WHERE namepatient='$name' AND fnpatient='$fn' AND dob='$dob' AND date='$date' AND time='$time'";

if ($conn->query($sql) === TRUE) {
  echo "200";
} else {
  echo "201";
}
?>