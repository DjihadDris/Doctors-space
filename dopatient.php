<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
include('db.php');

$name = $_POST['name'];
$fn = $_POST['fn'];
$pn = $_POST['pn'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$notes = $_POST['notes'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$chronic = $_POST['chronic'];
$surgeries = $_POST['surgeries'];
$allergies = $_POST['allergies'];
$groupage = $_POST['groupage'];
$wilaya = $_POST['wilaya'];
$address = $_POST['address'];
/*$password = $_POST['password'];*/
$mpi = $_POST['mpi'];
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


$sql = "INSERT INTO patients (name, fn, pn, email, gender, dob, password, mpi, status, del, notes, code, address, wilaya, height, weight, groupage, allergies, surgeries, chronic)
VALUES ('$name', '$fn', '$pn', '$email', '$gender', '$dob', '$password', '$mpi', 'Activé', '', '$notes', '$code', '$address', '$wilaya', '$height', '$weight', '$groupage', '$allergies', '$surgeries', '$chronic')";

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
        header('Location: patients?true&name='.$name.'&fn='.$fn.'&dob='.$dob.'&pn='.$pn.'&email='.$email.'&gender='.$gender.'&notes='.$notes.'&wilaya='.$wilaya.'&address='.$address.'&groupage='.$groupage.'&height='.$height.'&weight='.$weight.'&chronic='.$chronic.'&surgeries='.$surgeries.'&allergies='.$allergies.'&mpi='.$mpi.'&password='.$password.'&code='.$code);
    } catch (Exception $e) {
        header('Location: patients?false=errordb');
    }

} else {
  header('Location: patients?false=errordb');
}

$conn->close();

?>