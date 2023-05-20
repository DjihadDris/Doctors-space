<?php
include('db.php');

$namefr = $_POST['namefr'];
$namear = $_POST['namear'];

$sql = "INSERT INTO specialties (namefr, namear)
VALUES ('$namefr', '$namear')";

if ($conn->query($sql) === TRUE) {
  echo '200';
} else {
  echo '201';
}

$conn->close();

?>