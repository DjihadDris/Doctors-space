[
<?php
include('db.php');

if($_COOKIE['job'] == "Admin"){
$sql = "SELECT * FROM appointments WHERE del='yes'";
}else if($_COOKIE['job'] == "Infirmier"){

$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sql = "SELECT * FROM appointments WHERE mp='$medecin' AND del='yes'";

  }
} else {
$sql = "";
}

}else{
$sql = "SELECT * FROM appointments WHERE mp='$_COOKIE[name]' AND del='yes'";
}

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
   
   if($_COOKIE['job'] == "Admin"){
      $sqlo = "SELECT ID FROM appointments WHERE del='yes' ORDER BY ID DESC LIMIT 1";
      }else if($_COOKIE['job'] == "Infirmier"){

$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sqlo = "SELECT ID FROM appointments WHERE del='yes' AND mp='$medecin' ORDER BY ID DESC LIMIT 1";

  }
} else {
$sql = "";
}

}else{
$sqlo = "SELECT ID FROM appointments WHERE del='yes' AND mp='$_COOKIE[name]' ORDER BY ID DESC LIMIT 1";
}
        $resulto = $conn->query($sqlo);
  if ($resulto->num_rows > 0) {
    while($rowo = $resulto->fetch_assoc()) {   
      if("$row[ID]" == "$rowo[ID]"){   
?>
["<?php echo "$row[ID]"; ?>", "<?php echo "$row[date]"; ?>", "<?php echo "$row[time]"; ?>", "<?php echo "$row[namepatient]"; ?>", "<?php echo "$row[fnpatient]"; ?>", "<?php echo "$row[dob]"; ?>", <?php if($_COOKIE['job'] == "Admin"){ ?>"<?php echo "$row[mp]"; ?>",<?php } ?> "<button class='ui button blue restore'><i class='history icon'></i> Restaurer</button>"]
<?php
}else{
?>
["<?php echo "$row[ID]"; ?>", "<?php echo "$row[date]"; ?>", "<?php echo "$row[date]"; ?>", "<?php echo "$row[namepatient]"; ?>", "<?php echo "$row[fnpatient]"; ?>", "<?php echo "$row[dob]"; ?>", <?php if($_COOKIE['job'] == "Admin"){ ?>"<?php echo "$row[mp]"; ?>",<?php } ?> "<button class='ui button blue restore'><i class='history icon'></i> Restaurer</button>"],
<?php
}
}}else{

}
}}else{
echo "";
}
mysqli_close($conn);
?>
]