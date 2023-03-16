[
<?php
include('db.php');

$sql = "SELECT * FROM admins WHERE job='Pharmacien' AND del<>'yes'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {

      $sqlo = "SELECT ID FROM admins WHERE del<>'yes' AND job='Pharmacien' ORDER BY ID DESC LIMIT 1";
        $resulto = $conn->query($sqlo);
  if ($resulto->num_rows > 0) {
    while($rowo = $resulto->fetch_assoc()) {   
      if("$row[ID]" == "$rowo[ID]"){
?>
["<?php echo "$row[ID]"; ?>", "<img src='img/admin-<?php echo "$row[gender]"; ?>.png' style='width: 45px; height: 45px; border-radius: 50%;'>", "<?php echo "$row[name]"; ?>", "<?php echo "$row[fn]"; ?>", "<?php echo "$row[dob]"; ?>", "<?php echo "$row[gender]"; ?>", "<?php echo "$row[email]"; ?>", "<?php echo "$row[pn]"; ?>", "<?php echo "$row[wilaya]"; ?>", "<?php echo "$row[address]"; ?>", "<?php echo "$row[groupage]"; ?>", "<span id='acdesac' class='badge badge-pill acdesac <?php if("$row[status]" == "Activé"){ echo "badge-success"; }else{ echo "badge-danger"; } ?>'><?php echo "$row[status]"; ?></span>", "<?php echo "$row[code]"; ?>", "<div class='ui buttons'><a class='edit ui button green icon' href='#edit'><i class='edit icon'></i></a><a class='print ui button blue icon' href='#print'><i class='print icon'></i></a><a class='delete ui button red icon' href='#delete'><i class='trash icon'></i></a></div>"]
<?php
}else{
?>
["<?php echo "$row[ID]"; ?>", "<img src='img/admin-<?php echo "$row[gender]"; ?>.png' style='width: 45px; height: 45px; border-radius: 50%;'>", "<?php echo "$row[name]"; ?>", "<?php echo "$row[fn]"; ?>", "<?php echo "$row[dob]"; ?>", "<?php echo "$row[gender]"; ?>", "<?php echo "$row[email]"; ?>", "<?php echo "$row[pn]"; ?>", "<?php echo "$row[wilaya]"; ?>", "<?php echo "$row[address]"; ?>", "<?php echo "$row[groupage]"; ?>", "<span id='acdesac' class='badge badge-pill acdesac <?php if("$row[status]" == "Activé"){ echo "badge-success"; }else{ echo "badge-danger"; } ?>'><?php echo "$row[status]"; ?></span>", "<?php echo "$row[code]"; ?>", "<div class='ui buttons'><a class='edit ui button green icon' href='#edit'><i class='edit icon'></i></a><a class='print ui button blue icon' href='#print'><i class='print icon'></i></a><a class='delete ui button red icon' href='#delete'><i class='trash icon'></i></a></div>"],
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