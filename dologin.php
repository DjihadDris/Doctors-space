<?php
include('db.php');
	
$email=$_POST['email'];
$password=$_POST['password'];
$remember=$_POST['remember'];
$wilaya=$_POST['wilaya'];

$sql = "SELECT * FROM admins WHERE wilaya='$wilaya' AND email='$email' OR wilaya='$wilaya' AND pn='$email' OR wilaya='$wilaya' AND code='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {

if("$row[password]" == $password){

if("$row[status]" == "Activé"){

  	if($remember == "yes"){
    setcookie("name", "$row[name]", time() + (60*60*24*30), "/");
    setcookie("email", "$row[email]", time() + (60*60*24*30), "/");
    setcookie("gender", "$row[gender]", time() + (60*60*24*30), "/");
    setcookie("job", "$row[job]", time() + (60*60*24*30), "/");
    setcookie("remember", "yes", time() + (60*60*24*30), "/");
  	}else{
    setcookie("name", "$row[name]", time() + (86400 * 30), "/");
    setcookie("email", "$row[email]", time() + (86400 * 30), "/");
    setcookie("gender", "$row[gender]", time() + (86400 * 30), "/");
    setcookie("job", "$row[job]", time() + (86400 * 30), "/");
    setcookie("remember", "no", time() + (86400 * 30), "/");
    }
	  
    if("$row[new]" == "yes" && "$row[job]" <> "Infirmier"){

$sqls = "UPDATE `admins` SET `new`='' WHERE email='$email' OR pn='$email' AND wilaya='$wilaya' AND password='$row[password]'";
if (mysqli_query($conn, $sqls)) {
    echo "3";
  }else{}

    }else{
      echo "1";
    }

}else{
	echo "5"; /* Status */
}
}else{
	echo "4"; /* Password */
}
}} else {
  echo "2"; /* Email */
}

mysqli_close($conn);
?>