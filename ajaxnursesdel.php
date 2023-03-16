[
<?php
include('db.php');

if($_COOKIE['job'] == "Admin"){
$sql = "SELECT * FROM admins WHERE job='Infirmier' AND del='yes'";
}else{
$sql = "SELECT * FROM admins WHERE fn='$_COOKIE[name]' AND job='Infirmier' AND del='yes'";
}

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      
if($_COOKIE['job'] == "Admin"){
      $sqlo = "SELECT ID FROM admins WHERE del='yes' AND job='Infirmier' ORDER BY ID DESC LIMIT 1";
      }else{
$sqlo = "SELECT ID FROM admins WHERE del='yes' AND fn='$_COOKIE[name]' AND job='Infirmier' ORDER BY ID DESC LIMIT 1";
}
        $resulto = $conn->query($sqlo);
  if ($resulto->num_rows > 0) {
    while($rowo = $resulto->fetch_assoc()) {   
      if("$row[ID]" == "$rowo[ID]"){

?>

["<?php echo "$row[ID]"; ?>", "<img src='img/admin-<?php echo "$row[gender]"; ?>.png' style='width: 45px; height: 45px; border-radius: 50%;'>", "<?php echo "$row[name]"; ?>", "<?php echo "$row[dob]"; ?>", "<?php echo "$row[gender]"; ?>", "<?php echo "$row[email]"; ?>", "<?php echo "$row[pn]"; ?>",<?php if($_COOKIE['job'] == "Admin"){ ?>"<?php echo "$row[fn]"; ?>",<?php } ?> "<?php echo "$row[wilaya]"; ?>", "<?php echo "$row[address]"; ?>", "<?php echo "$row[groupage]"; ?>", "<?php echo "$row[code]"; ?>", "<a class='ui button blue restore' href='#restore'><i class='icon history'></i> Restaurer</a>"]
<?php
}else{
?>
["<?php echo "$row[ID]"; ?>", "<img src='img/admin-<?php echo "$row[gender]"; ?>.png' style='width: 45px; height: 45px; border-radius: 50%;'>", "<?php echo "$row[name]"; ?>", "<?php echo "$row[dob]"; ?>", "<?php echo "$row[gender]"; ?>", "<?php echo "$row[email]"; ?>", "<?php echo "$row[pn]"; ?>",<?php if($_COOKIE['job'] == "Admin"){ ?>"<?php echo "$row[fn]"; ?>",<?php } ?> "<?php echo "$row[wilaya]"; ?>", "<?php echo "$row[address]"; ?>", "<?php echo "$row[groupage]"; ?>", "<?php echo "$row[code]"; ?>", "<a class='ui button blue restore' href='#restore'><i class='icon history'></i> Restaurer</a>"],
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