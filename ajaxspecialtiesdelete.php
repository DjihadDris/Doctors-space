<?php

include('db.php');

$namefr = $_POST['namefr'];
$namear = $_POST['namear'];

$sql = "DELETE FROM specialties WHERE namefr='$namefr' AND namear='$namear'";

if ($conn->query($sql) === TRUE) {
  echo '200';
} else {
  echo '201';
}

$conn->close();

?>