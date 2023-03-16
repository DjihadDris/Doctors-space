<?php
include('db.php');
$name = $_POST['name'];

$sql = "UPDATE drugs SET del='' WHERE name='$name'";

if ($conn->query($sql) === TRUE) {
  echo "200";
} else {
  echo "201";
}
?>