[
<?php
include('db.php');

if($_COOKIE['job'] == "Admin"){
$sql = "SELECT * FROM appointments WHERE valid='yes'";
}else if($_COOKIE['job'] == "Infirmier"){

$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sql = "SELECT * FROM appointments WHERE mp='$medecin' AND valid='yes'";

  }
} else {
$sql = "";
}

}else{
$sql = "SELECT * FROM appointments WHERE mp='$_COOKIE[name]' AND valid='yes'";
}

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
   
   if($_COOKIE['job'] == "Admin"){
      $sqlo = "SELECT ID FROM appointments WHERE valid='yes' ORDER BY ID DESC LIMIT 1";
      }else if($_COOKIE['job'] == "Infirmier"){

$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sqlo = "SELECT ID FROM appointments WHERE valid='yes' AND mp='$medecin' ORDER BY ID DESC LIMIT 1";

  }
} else {
$sql = "";
}

}else{
$sqlo = "SELECT ID FROM appointments WHERE valid='yes' AND mp='$_COOKIE[name]' ORDER BY ID DESC LIMIT 1";
}
        $resulto = $conn->query($sqlo);
  if ($resulto->num_rows > 0) {
    while($rowo = $resulto->fetch_assoc()) {   
      if("$row[ID]" == "$rowo[ID]"){   
?>
["<?php echo "$row[ID]"; ?>", "<?php echo "$row[date]"; ?>", "<?php echo "$row[time]"; ?>", "<?php echo "$row[namepatient]"; ?>", "<?php echo "$row[fnpatient]"; ?>", "<?php echo "$row[dob]"; ?>", <?php if($_COOKIE['job'] == "Admin"){ ?>"<?php echo "$row[mp]"; ?>",<?php } ?> "<?php echo "$row[price]"; ?>", "<?php echo "$row[pay]"; ?>", "<?php echo "$row[remain]"; ?>", "<?php echo "$row[observation]"; ?>", "<div class='ui buttons'><button class='ui green left labeled icon button edit'><i class='edit icon'></i> Éditer</button><div class='or' data-text='ou'></div><button class='ui red right labeled icon button unvalid'><i class='close icon'></i> Invalider</button></div>"]
<?php
}else{
?>
["<?php echo "$row[ID]"; ?>", "<?php echo "$row[date]"; ?>", "<?php echo "$row[time]"; ?>", "<?php echo "$row[namepatient]"; ?>", "<?php echo "$row[fnpatient]"; ?>", "<?php echo "$row[dob]"; ?>", <?php if($_COOKIE['job'] == "Admin"){ ?>"<?php echo "$row[mp]"; ?>",<?php } ?> "<?php echo "$row[price]"; ?>", "<?php echo "$row[pay]"; ?>", "<?php echo "$row[remain]"; ?>", "<?php echo "$row[observation]"; ?>", "<div class='ui buttons'><button class='ui green left labeled icon button edit'><i class='edit icon'></i> Éditer</button><div class='or' data-text='ou'></div><button class='ui red right labeled icon button unvalid'><i class='close icon'></i> Invalider</button></div>"],
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