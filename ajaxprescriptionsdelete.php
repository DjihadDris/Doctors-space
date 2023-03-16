<?php
include('db.php');
$name = $_POST['name'];
$fn = $_POST['fn'];
$date = $_POST['date'];

$sql = "UPDATE prescriptions SET del='yes' WHERE namepatient='$name' AND fnpatient='$fn' AND date='$date'";

if ($conn->query($sql) === TRUE) {
  echo "200";
} else {
  echo "201";
}
?>