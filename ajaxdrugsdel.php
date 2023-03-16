[
<?php
include('db.php');

$sql = "SELECT * FROM drugs WHERE del='yes'";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

      $sqlo = "SELECT ID FROM drugs WHERE del='yes' ORDER BY ID DESC LIMIT 1";
      $resulto = $conn->query($sqlo);
  if ($resulto->num_rows > 0) {
    while($rowo = $resulto->fetch_assoc()) {   
      if("$row[ID]" == "$rowo[ID]"){
?>
["<?php echo "$row[ID]"; ?>", "<?php echo "$row[name]"; ?>", "<?php echo "$row[form]"; ?>", "<a class='ui button blue restore' href='#restore'><i class='icon history'></i> Restaurer</a>"]
<?php
}else{
?>
["<?php echo "$row[ID]"; ?>", "<?php echo "$row[name]"; ?>", "<?php echo "$row[form]"; ?>", "<a class='ui button blue restore' href='#restore'><i class='icon history'></i> Restaurer</a>"],
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