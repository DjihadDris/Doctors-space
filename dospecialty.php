<?php

include('db.php');

$name = $_POST['name'];

$sql = "INSERT INTO specialties (name)
VALUES ('$name')";

if ($conn->query($sql) === TRUE) {
  echo '200';
} else {
  echo '201';
}

$conn->close();

?>