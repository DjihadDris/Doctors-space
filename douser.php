<?php

include('db.php');

$from = $_POST['from'];
$name = $_POST['name'];
$fn = $_POST['fn'];
$pn = $_POST['pn'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$job = $_POST['job'];
$seal = $_POST['seal'];
$signature = $_POST['signature'];
$address = $_POST['address'];
$wilaya = $_POST['wilaya'];
$groupage = $_POST['groupage'];
$description = $_POST['description'];

if($job == "Médecin"){
    $new = "new";
}else{
    $new = "";
}

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

$sql = "INSERT INTO admins (name, fn, pn, email, gender, dob, job, password, seal, signature, status, del, code, address, wilaya, groupage, description, new)
VALUES ('$name', '$fn', '$pn', '$email', '$gender', '$dob', '$job', '$password', '$seal', '$signature', 'Activé', '', '$code', '$address', '$wilaya', '$groupage', '$description', '$new')";

if ($conn->query($sql) === TRUE) {
$msg = "Bonjour, $name \n Votre mot de passe est: $password";
$msg = wordwrap($msg,70);
mail($email,"Ministère de la Santé",$msg);
  header('Location: '.$from.'?true');
} else {
  header('Location: '.$from.'?false=errordb');
}

$conn->close();

?>