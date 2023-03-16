<?php

include('db.php');

$date = $_POST['date'];
$i = 1;
$i1 = 1;
$i2 = 1;
$i3 = 1;
$i4 = 1;
$ii = 1;

if($_COOKIE['job'] == "Admin"){
$sql = "SELECT * FROM appointments WHERE date='$date' AND del='' ORDER BY time ASC, time ASC";
}elseif($_COOKIE['job'] == "Médecin"){
$sql = "SELECT * FROM appointments WHERE date='$date' AND del='' AND mp='$_COOKIE[name]' ORDER BY time ASC, time ASC";
}else{
$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sql = "SELECT * FROM appointments WHERE date='$date' AND del='' AND mp='$medecin' ORDER BY time ASC, time ASC";

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
<td><?php echo "$row[fnpatient]"; ?></td>
<td><?php echo "$row[namepatient]"; ?></td>
<td><?php echo "$row[dob]"; ?></td>
<td><?php echo "$row[time]"; ?></td>
<td id="<?php echo $i1;$i1++; ?>ob" <?php if("$row[valid]" == "yes"){}else{ ?>contenteditable="true"<?php } ?>><?php echo "$row[observation]"; ?></td>
<td id="<?php echo $i2;$i2++; ?>pr" <?php if("$row[valid]" == "yes"){}else{ ?>contenteditable="true"<?php } ?>><?php if("$row[price]" == "-"){echo "-";}else{echo number_format("$row[price]", 2)." DA";} ?></td>
<td id="<?php echo $i3;$i3++; ?>pa" <?php if("$row[valid]" == "yes"){}else{ ?>contenteditable="true"<?php } ?>><?php if("$row[pay]" == "-"){echo "-";}else{echo number_format("$row[pay]", 2)." DA";} ?></td>
<td id="<?php echo $i4;$i4++; ?>re"><?php if("$row[remain]" == "-"){echo "-";}else{echo number_format("$row[remain]", 2)." DA";} ?></td>
<td><?php if("$row[valid]" == "yes"){ ?><button class="ui labeled icon button red inverted" onclick="invalider2('<?php echo $i;$i++; ?>', '<?php echo "$row[fnpatient]"; ?>', '<?php echo "$row[namepatient]"; ?>', '<?php echo "$row[date]"; ?>', '<?php echo "$row[time]"; ?>')"><i class="close icon"></i> Invalider</button><?php }else{ ?><button class="ui labeled icon button green inverted" onclick="valider2('<?php echo $i;$i++; ?>', '<?php echo "$row[fnpatient]"; ?>', '<?php echo "$row[namepatient]"; ?>', '<?php echo "$row[date]"; ?>', '<?php echo "$row[time]"; ?>')"><i class="check icon"></i> Valider</button><?php } ?></td>
</tr>
      <?php
      }}else{
      	echo "<tr class='center aligned'><td colspan='10'>Aucun rendez-vous</td></tr>";
      }

?>