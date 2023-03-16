<?php
include('db.php');
$email=$_POST['email'];
$sqld = "SELECT name, password FROM admins WHERE email='$email' AND status='Activé'";
$resultd = $conn->query($sqld);

if ($resultd->num_rows > 0) {
  // output data of each row
while($row = $resultd->fetch_assoc()) {
echo "200";
$msg = "Bonjour, $row[name] \n Votre mot de passe est: $row[password]";
$msg = wordwrap($msg,70);
mail($email,"Récupération de mot de passe - Ministère de la Santé",$msg);

  }
} else {
  echo "201";
}
mysqli_close($conn);
?>