[
<?php
include('db.php');

if($_COOKIE['job'] == "Admin"){
$sql = "SELECT * FROM patients WHERE del<>'yes'";
}else if($_COOKIE['job'] == "Infirmier"){

$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]' AND status='Activé' AND del<>'yes'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sql = "SELECT * FROM patients WHERE mpi='$medecin' AND del<>'yes'";

  }
} else {
$sql = "";
}

}else{
$sql = "SELECT * FROM patients WHERE mpi='$_COOKIE[name]' AND del<>'yes'";
}


	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {   
		 
if($_COOKIE['job'] == "Admin"){
			$sqlo = "SELECT ID FROM patients WHERE del<>'yes' ORDER BY ID DESC LIMIT 1";
			}else if($_COOKIE['job'] == "Infirmier"){

$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sqlo = "SELECT ID FROM patients WHERE del<>'yes' AND mpi='$medecin' ORDER BY ID DESC LIMIT 1";

  }
} else {
$sql = "";
}

}else{
$sqlo = "SELECT ID FROM patients WHERE del<>'yes' AND mpi='$_COOKIE[name]' ORDER BY ID DESC LIMIT 1";
}
				$resulto = $conn->query($sqlo);
	if ($resulto->num_rows > 0) {
		while($rowo = $resulto->fetch_assoc()) {   
			if("$row[ID]" == "$rowo[ID]"){

?>

["<?php echo "$row[ID]"; ?>", "<img src='img/admin-<?php echo "$row[gender]"; ?>.png' style='width: 45px; height: 45px; border-radius: 50%;'>", "<?php echo "$row[name]"; ?>", "<?php echo "$row[fn]"; ?>", "<?php echo "$row[dob]"; ?>", "<?php echo "$row[gender]"; ?>", "<?php echo "$row[email]"; ?>", "<?php echo "$row[pn]"; ?>",<?php if($_COOKIE['job'] == "Admin"){ ?>"<?php echo "$row[mpi]"; ?>",<?php } ?> "<?php echo "$row[wilaya]"; ?>", "<?php echo "$row[address]"; ?>", "<?php echo "$row[groupage]"; ?>", "<?php echo "$row[height]"; ?>", "<?php echo "$row[weight]"; ?>", "<?php echo "$row[chronic]"; ?>", "<?php echo "$row[surgeries]"; ?>", "<?php echo "$row[allergies]"; ?>", "<?php echo "$row[notes]"; ?>", "<span id='acdesac' class='badge badge-pill acdesac <?php if("$row[status]" == "Activé"){ echo "badge-success"; }else{ echo "badge-danger"; } ?>'><?php echo "$row[status]"; ?></span>", "<?php echo "$row[code]"; ?>", "<div class='ui buttons'><a class='edit ui button green icon' href='#edit'><i class='edit icon'></i></a><a class='print ui button blue icon' href='#print'><i class='print icon'></i></a><a class='delete ui button red icon' href='#delete'><i class='trash icon'></i></a></div>"]
<?php
}else{
?>
["<?php echo "$row[ID]"; ?>", "<img src='img/admin-<?php echo "$row[gender]"; ?>.png' style='width: 45px; height: 45px; border-radius: 50%;'>", "<?php echo "$row[name]"; ?>", "<?php echo "$row[fn]"; ?>", "<?php echo "$row[dob]"; ?>", "<?php echo "$row[gender]"; ?>", "<?php echo "$row[email]"; ?>", "<?php echo "$row[pn]"; ?>",<?php if($_COOKIE['job'] == "Admin"){ ?>"<?php echo "$row[mpi]"; ?>",<?php } ?> "<?php echo "$row[wilaya]"; ?>", "<?php echo "$row[address]"; ?>", "<?php echo "$row[groupage]"; ?>", "<?php echo "$row[height]"; ?>", "<?php echo "$row[weight]"; ?>", "<?php echo "$row[chronic]"; ?>", "<?php echo "$row[surgeries]"; ?>", "<?php echo "$row[allergies]"; ?>", "<?php echo "$row[notes]"; ?>", "<span id='acdesac' class='badge badge-pill acdesac <?php if("$row[status]" == "Activé"){ echo "badge-success"; }else{ echo "badge-danger"; } ?>'><?php echo "$row[status]"; ?></span>", "<?php echo "$row[code]"; ?>", "<div class='ui buttons'><a class='edit ui button green icon' href='#edit'><i class='edit icon'></i></a><a class='print ui button blue icon' href='#print'><i class='print icon'></i></a><a class='delete ui button red icon' href='#delete'><i class='trash icon'></i></a></div>"],
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