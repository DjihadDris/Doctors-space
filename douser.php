<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
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

    try {
        $mail = new PHPMailer(true);
    
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Your SMTP server hostname
        $mail->SMTPAuth = true;
        $mail->Username = 'djihad139@gmail.com'; // Your SMTP username
        $mail->Password = 'acxvkdwyxkityhfc'; // Your SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable encryption, 'ssl' also accepted
        $mail->Port = 465; // TCP port to connect to
    
        // Sender and recipient details
        $mail->setFrom('no-reply@medecin.epizy.com', 'Ministère de la Santé');
        $mail->addAddress("$email", "$name");
    
        // Email content
        $mail->Subject = 'Mot de passe - Ministère de la Santé';
        $mail->Body = "$message";
    
        // Send the email
        $mail->send();
        header('Location: '.$from.'?true');
    } catch (Exception $e) {
        header('Location: '.$from.'?false=errordb');
    }

} else {
  header('Location: '.$from.'?false=errordb');
}

$conn->close();

?>