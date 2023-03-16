<?php
include('db.php');
$name = $_POST['name'];
$email = $_POST['email'];

$sql = "UPDATE admins SET status='Activé', del='' WHERE name='$name' AND email='$email'";

if ($conn->query($sql) === TRUE) {
  echo "200";
} else {
  echo "201";
}
?>