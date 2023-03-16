<option value=''>--Sélectionner l'heure--</option>
<?php

include('db.php');

$name = $_POST['name'];
$fn = $_POST['fn'];
$date = $_POST['date'];

if($_COOKIE['job'] == "Admin"){
$sql = "SELECT DISTINCT time FROM appointments WHERE del='' AND namepatient='$name' AND fnpatient='$fn' AND date='$date' AND valid='' ORDER BY time ASC";
}elseif($_COOKIE['job'] == "Médecin") {
$sql = "SELECT DISTINCT time FROM appointments WHERE del='' AND namepatient='$name' AND fnpatient='$fn' AND date='$date' AND valid='' AND mp='$_COOKIE[name]' ORDER BY time ASC";
}else{
$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sql = "SELECT DISTINCT time FROM appointments WHERE del='' AND namepatient='$name' AND fnpatient='$fn' AND date='$date' AND valid='' AND mp='$medecin' ORDER BY time ASC";

  }
} else {
$sql = "";
}
}
$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
      ?>

<option value="<?php echo "$row[time]"; ?>"><?php echo "$row[time]"; ?></option>

      <?php

      }}else{
      	echo "";
      }

?>