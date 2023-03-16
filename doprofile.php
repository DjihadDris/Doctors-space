<?php
include('db.php');

$id = $_POST['id'];
$name = $_POST['name'];
$fn = $_POST['fn'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$pn = $_POST['pn'];
$gender = $_POST['gender'];
$job = $_POST['job'];
$password = $_POST['password'];
$seal = $_POST['seal'];
$signature = $_POST['signature'];
$address = $_POST['address'];
$wilaya = $_POST['wilaya'];
$groupage = $_POST['groupage'];
$description = $_POST['description'];

$sqld = "SELECT * FROM admins WHERE id='$id'";
$resultd = $conn->query($sqld);

if ($resultd->num_rows > 0) {
  // output data of each row
while($row = $resultd->fetch_assoc()) {

if("$row[password]" == $password){

$sql = "UPDATE admins SET name='$name', fn='$fn', dob='$dob', email='$email', pn='$pn', gender='$gender', job='$job', signature='$signature', seal='$seal', address='$address', wilaya='$wilaya', groupage='$groupage', description='$description' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {

if($_COOKIE['remember'] == "yes"){
setcookie("name", "", time() - (60*60*24*30), "/");
setcookie("name", "$name", time() + (60*60*24*30), "/");

setcookie("email", "", time() - (60*60*24*30), "/");
setcookie("email", "$email", time() + (60*60*24*30), "/");

setcookie("gender", "", time() - (60*60*24*30), "/");
setcookie("gender", "$gender", time() + (60*60*24*30), "/");

setcookie("job", "", time() - (60*60*24*30), "/");
setcookie("job", "$job", time() + (60*60*24*30), "/");
}else{
setcookie("name", "", time() - (86400 * 30), "/");
setcookie("name", "$name", time() + (86400 * 30), "/");

setcookie("email", "", time() - (86400 * 30), "/");
setcookie("email", "$email", time() + (86400 * 30), "/");

setcookie("gender", "", time() - (86400 * 30), "/");
setcookie("gender", "$gender", time() + (86400 * 30), "/");

setcookie("job", "", time() - (86400 * 30), "/");
setcookie("job", "$job", time() + (86400 * 30), "/");
}
    header('Location: profile?true');
} else {
    header('Location: profile?false=errordb');
}}else{
	header('Location: profile?false=errorpassword');
}

}} else {

header('Location: profile?false=errordb');

}

$conn->close();


?>