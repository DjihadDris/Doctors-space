<?php
include('db.php');
$name = $_POST['name'];
$fn = $_POST['fn'];
$date = $_POST['date'];
$time = $_POST['time'];

$sql = "UPDATE appointments SET del='' WHERE namepatient='$name' AND fnpatient='$fn' AND date='$date' AND time='$time'";

if ($conn->query($sql) === TRUE) {
  echo "200";
} else {
  echo "201";
}
?>