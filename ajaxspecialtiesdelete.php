<?php

include('db.php');

$name = $_POST['name'];

$sql = "DELETE FROM specialties WHERE name='$name'";

if ($conn->query($sql) === TRUE) {
  echo '200';
} else {
  echo '201';
}

$conn->close();

?>