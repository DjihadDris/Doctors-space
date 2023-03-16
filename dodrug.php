<?php

include('db.php');

$name = $_POST['name'];
$form = $_POST['form'];

$sql = "INSERT INTO drugs (name, form, del)
VALUES ('$name', '$form', '')";

if ($conn->query($sql) === TRUE) {
  if(!isset($_POST['type'])){
  header('Location: drugs?true');
}else{
  echo '200';
}
} else {
  if(!isset($_POST['type'])){
  header('Location: drugs?false=errordb');
}else{
  echo '201';
}
}

$conn->close();

?>