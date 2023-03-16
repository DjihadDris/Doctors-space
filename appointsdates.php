<?php

include('db.php');

$name = $_POST['name'];
$fn = $_POST['fn'];

if($_COOKIE['job'] == "Admin"){
$sql = "SELECT * FROM appointments WHERE del='' AND namepatient='$name' AND fnpatient='$fn' ORDER BY date DESC, time ASC";
}elseif($_COOKIE['job'] == "Médecin"){
$sql = "SELECT * FROM appointments WHERE del='' AND namepatient='$name' AND fnpatient='$fn' AND mp='$_COOKIE[name]' ORDER BY date DESC, time ASC";
}else{
$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sql = "SELECT * FROM appointments WHERE del='' AND namepatient='$name' AND fnpatient='$fn' AND mp='$medecin' ORDER BY date DESC, time ASC";

  }
} else {
$sql = "";
}
}

$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
      ?>
<tr class="center aligned">
<td><?php if("$row[valid]" == "yes"){echo "<i class='check icon green'></i>";}else{echo "<i class='close icon red'></i>";} ?></td>
<td style="<?php if("$row[date]" == date("Y-m-d")){echo "color:  #21ba45;";}else if("$row[date]" > date("Y-m-d")){echo "color: #2185d0;";}else{echo "color: #f2711c;";} ?>"><?php echo "$row[date]"; ?></td>
<td><?php echo "$row[time]"; ?></td>
<td><?php echo "$row[observation]"; ?></td>
<td><?php if("$row[price]" == "-"){echo "-";}else{echo number_format("$row[price]", 2)." DA";} ?></td>
<td><?php if("$row[pay]" == "-"){echo "-";}else{echo number_format("$row[pay]", 2)." DA";} ?></td>
<td><?php if("$row[remain]" == "-"){echo "-";}else{echo number_format("$row[remain]", 2)." DA";} ?></td>
</tr>
      <?php
      }}else{
      	echo "<tr class='center aligned'><td colspan='7'>Aucun rendez-vous</td></tr>";
      }

?>