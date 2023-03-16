<?php
include('db.php');

$id = $_POST['id'];
$name = $_POST['name'];
$fn = $_POST['fn'];
$dob = $_POST['dob'];
$date = $_POST['date'];
$time = $_POST['time'];
$mp = $_POST['mp'];

if($_POST['obs'] != ""){
  $observation = $_POST['obs'];
}else{
  $observation = "-";
}


$sqlt = "SELECT * FROM appointments WHERE namepatient='$name' AND fnpatient='$fn' AND date='$date' AND time='$time' AND del=''";

  $resultt = $conn->query($sqlt);
  if ($resultt->num_rows > 0) {
    while($row = $resultt->fetch_assoc()) {
echo "200";
    }}else{
$sql = "INSERT INTO appointments (mp, namepatient, fnpatient, dob, date, time, valid, observation, price, pay, remain, del)
VALUES ('$mp', '$name', '$fn', '$dob', '$date', '$time', '', '$observation', '-', '-', '-', '')";

if ($conn->query($sql) === TRUE) {
  echo "200";
} else {
  echo "201";
}
    }


$conn->close();

	?>