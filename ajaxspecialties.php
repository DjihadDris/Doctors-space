[
<?php
include('db.php');

$sql = "SELECT * FROM specialties";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {

      $sqlo = "SELECT ID FROM specialties ORDER BY ID DESC LIMIT 1";
      $resulto = $conn->query($sqlo);
  if ($resulto->num_rows > 0) {
    while($rowo = $resulto->fetch_assoc()) {   
      if("$row[ID]" == "$rowo[ID]"){
?>
["<?php echo "$row[ID]"; ?>", "<?php echo "$row[name]"; ?>"<?php if($_COOKIE['name'] == "Djihad"){ ?>, "<button class='ui negative left labeled icon button delete'><i class='trash icon'></i> Supprimer</button>"<?php } ?>]
<?php
}else{
?>
["<?php echo "$row[ID]"; ?>", "<?php echo "$row[name]"; ?>"<?php if($_COOKIE['name'] == "Djihad"){ ?>, "<button class='ui negative left labeled icon button delete'><i class='trash icon'></i> Supprimer</button>"<?php } ?>],
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