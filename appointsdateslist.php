<option value=''>--Sélectionner la date--</option>
<?php

include('db.php');

$name = $_POST['name'];
$fn = $_POST['fn'];

if($_COOKIE['job'] == "Admin"){
$sql = "SELECT DISTINCT date FROM appointments WHERE del='' AND namepatient='$name' AND fnpatient='$fn' AND valid='' ORDER BY date ASC";
}elseif($_COOKIE['job'] == "Médecin"){
$sql = "SELECT DISTINCT date FROM appointments WHERE del='' AND namepatient='$name' AND fnpatient='$fn' AND valid='' AND mp='$_COOKIE[name]' ORDER BY date ASC";
}else{
$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sql = "SELECT DISTINCT date FROM appointments WHERE del='' AND namepatient='$name' AND fnpatient='$fn' AND valid='' AND mp='$medecin' ORDER BY date ASC";

  }
} else {
$sql = "";
}
}
$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
      ?>

<option <?php if("$row[date]" == date("Y-m-d")){echo "selected";} ?> value="<?php echo "$row[date]"; ?>"><?php echo "$row[date]"; ?></option>

      <?php

      }}else{
      	echo "";
      }

?>