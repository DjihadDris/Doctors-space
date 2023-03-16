<?php
include('db.php');


$valid = $_POST['valid'];
$name = $_POST['name'];
$fn = $_POST['fn'];
$date = $_POST['date'];
$time = $_POST['time'];
if($valid == "yes"){

if($_POST['observation'] != ""){
$observation = $_POST['observation'];
}else{
$observation = "-";
}

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

$remain = $_POST['remain'];

}

if($valid == "yes"){
$sql = "UPDATE appointments SET price='$price', pay='$pay', remain='$remain', valid='yes', observation='$observation' WHERE namepatient='$name' AND fnpatient='$fn' AND date='$date' AND time='$time'";
}else{
$sql = "UPDATE appointments SET price='-', pay='-', remain='-', valid='' WHERE namepatient='$name' AND fnpatient='$fn' AND date='$date' AND time='$time'";
}

if ($conn->query($sql) === TRUE) {
  echo "200";
} else {
  echo "201";
}
?>