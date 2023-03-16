<?php
include "../db.php";

$sender = $_COOKIE['name'];
$receiver = $_POST['name'];
$email = $_POST['email'];
$gender = $_POST['gender'];
date_default_timezone_set('Africa/Algiers');
date_default_timezone_set('CET');
$date = date("Y-m-d");
$time = date("g:i A");
$message = $_POST['message'];

$sql = "INSERT INTO chat (email, gender, message, sender, receiver, date, time, del)
VALUES ('$email', '$gender', '$message', '$sender', '$receiver', '$date', '$time', '')";

if ($conn->query($sql) === TRUE) {
  echo "201";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>