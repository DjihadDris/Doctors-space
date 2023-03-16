<option value=''>--Sélectionner--</option>
<?php

include('db.php');

$name = $_POST['name'];
$fn = $_POST['fn'];

$sql = "SELECT * FROM prescriptions WHERE del='' AND namepatient='$name' AND fnpatient='$fn' ORDER BY ID DESC";
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