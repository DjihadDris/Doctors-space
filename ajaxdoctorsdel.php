[
<?php
include('db.php');

$sql = "SELECT * FROM admins WHERE job='Médecin' AND del='yes'";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

      $sqlo = "SELECT ID FROM admins WHERE del='yes' AND job='Médecin' ORDER BY ID DESC LIMIT 1";
        $resulto = $conn->query($sqlo);
  if ($resulto->num_rows > 0) {
    while($rowo = $resulto->fetch_assoc()) {   
      if("$row[ID]" == "$rowo[ID]"){
?>
["<?php echo "$row[ID]"; ?>", "<img src='img/admin-<?php echo "$row[gender]"; ?>.png' style='width: 45px; height: 45px; border-radius: 50%;'>", "<?php echo "$row[name]"; ?>", "<?php echo "$row[fn]"; ?>", "<?php echo "$row[dob]"; ?>", "<?php echo "$row[gender]"; ?>", "<?php echo "$row[email]"; ?>", "<?php echo "$row[pn]"; ?>", "<?php echo "$row[wilaya]"; ?>", "<?php echo "$row[address]"; ?>", "<?php echo "$row[description]"; ?>", "<?php echo "$row[groupage]"; ?>", "<img id='<?php echo "$row[ID]"; ?>f' style='margin-left: 2.5px;' src='<?php if("$row[seal]" != ""){echo "$row[seal]";}else{echo "img/no.jpg";} ?>' width='50' height='50'>", "<img id='<?php echo "$row[ID]"; ?>s' style='margin-left: 2.5px;' src='<?php if("$row[signature]" != ""){ echo "$row[signature]";}else{echo "img/no.jpg";} ?>' width='50' height='50'>", "<?php echo "$row[code]"; ?>", "<a class='ui button blue restore' href='#restore'><i class='icon history'></i> Restaurer</a>"]
<?php
}else{
?>
["<?php echo "$row[ID]"; ?>", "<img src='img/admin-<?php echo "$row[gender]"; ?>.png' style='width: 45px; height: 45px; border-radius: 50%;'>", "<?php echo "$row[name]"; ?>", "<?php echo "$row[fn]"; ?>", "<?php echo "$row[dob]"; ?>", "<?php echo "$row[gender]"; ?>", "<?php echo "$row[email]"; ?>", "<?php echo "$row[pn]"; ?>", "<?php echo "$row[wilaya]"; ?>", "<?php echo "$row[address]"; ?>", "<?php echo "$row[description]"; ?>", "<?php echo "$row[groupage]"; ?>", "<img id='<?php echo "$row[ID]"; ?>f' style='margin-left: 2.5px;' src='<?php if("$row[seal]" != ""){echo "$row[seal]";}else{echo "img/no.jpg";} ?>' width='50' height='50'>", "<img id='<?php echo "$row[ID]"; ?>s' style='margin-left: 2.5px;' src='<?php if("$row[signature]" != ""){ echo "$row[signature]";}else{echo "img/no.jpg";} ?>' width='50' height='50'>", "<?php echo "$row[code]"; ?>", "<a class='ui button blue restore' href='#restore'><i class='icon history'></i> Restaurer</a>"],
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