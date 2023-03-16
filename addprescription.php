<?php
include('db.php');

$details = $_POST['details'];
$date = $_POST['date'];
$id = $_POST['id'];
$name = $_POST['name'];
$fn = $_POST['fn'];
$dob = $_POST['dob'];
$mp = $_POST['mp'];


$sqlt = "SELECT * FROM prescriptions WHERE namepatient='$name' AND fnpatient='$fn' AND date='$date'";

  $resultt = $conn->query($sqlt);
  if ($resultt->num_rows > 0) {
    while($row = $resultt->fetch_assoc()) {
$sql = "UPDATE prescriptions SET details='$details', del='' WHERE namepatient='$name' AND fnpatient='$fn' AND date='$date'";

if ($conn->query($sql) === TRUE) {
  echo "200";
} else {
  echo "201";
}
    }}else{
$sql = "INSERT INTO prescriptions (details, mp, namepatient, fnpatient, dob, date, del)
VALUES ('$details', '$mp', '$name', '$fn', '$dob', '$date', '')";

if ($conn->query($sql) === TRUE) {
  echo "200";
} else {
  echo "201";
}
    }


$conn->close();

	?>