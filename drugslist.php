<option value="">--Sélectionner--</option>
<?php
include('db.php');

$sql = "SELECT * FROM drugs WHERE del<>'yes'";


	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
?>

<option value="<?php echo "$row[name]"; ?>"><?php echo "$row[name]"; ?></option>

<?php
}} else {
echo "";
}
mysqli_close($conn);
?>