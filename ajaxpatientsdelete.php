<?php
include('db.php');
$name = $_POST['name'];
$email = $_POST['email'];

$sql = "UPDATE patients SET status='Désactivé', del='yes' WHERE name='$name' AND email='$email'";

if ($conn->query($sql) === TRUE) {
  echo "200";
} else {
  echo "201";
}
?>