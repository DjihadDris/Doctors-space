<?php

include('db.php');

$name = $_POST['name'];
$fn = $_POST['mpi'];
$pn = $_POST['pn'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$wilaya = $_POST['wilaya'];
$groupage = $_POST['groupage'];
$address = $_POST['address'];
/*$password = $_POST['password'];*/
$n=10; 
$p=8; 

function getName($n) { 
/* A, M, Q, W, Z */

    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 

    $randomString = ""; 

    for ($i = 0; $i < $n; $i++) { 

        $index = rand(0, strlen($characters)-1); 

        $randomString .= $characters[$index]; 

    } 

  

    return $randomString; 

} 

$code = getName($n);

function getPass($p) { 

    $charactersp = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 

    $randomStringp = ""; 

    for ($ip = 0; $ip < $p; $ip++) { 

        $indexp = rand(0, strlen($charactersp)-1); 

        $randomStringp .= $charactersp[$indexp]; 

    } 

  

    return $randomStringp; 

} 

$password = getPass($p);

$sql = "INSERT INTO admins (name, fn, pn, email, gender, dob, job, password, status, del, code, address, wilaya, groupage)
VALUES ('$name', '$fn', '$pn', '$email', '$gender', '$dob', 'Infirmier', '$password', 'Activé', '', '$code', '$address', '$wilaya', '$groupage')";

if ($conn->query($sql) === TRUE) {
$msg = "Bonjour, $name \n Votre mot de passe est: $password";
$msg = wordwrap($msg,70);
mail($email,"Ministère de la Santé",$msg);
  header('Location: nurses?true&name='.$name.'&mp='.$fn.'&dob='.$dob.'&pn='.$pn.'&email='.$email.'&gender='.$gender.'&groupage='.$groupage.'&address='.$address.'&wilaya='.$wilaya.'&password='.$password.'&code='.$code);
} else {
  header('Location: nurses?false=errordb');
}

$conn->close();

?>