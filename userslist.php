<option value="">--Sélectionner--</option>
<?php
include('db.php');

if($_COOKIE['name'] == "Djihad"){
$sql = "SELECT * FROM admins WHERE name<>'Djihad' AND job<>'Admin' AND status<>'Désactivé' AND job<>'Infirmier'";
}else{
$sql = "SELECT * FROM admins WHERE name<>'$_COOKIE[name]' AND job<>'Admin' AND name<>'Djihad' AND name<>'Djihad' AND status<>'Désactivé' AND job<>'Infirmier'";
}

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
?>

<option value="<?php echo "$row[name]"; ?>"><?php echo "$row[name]"; ?> (<?php echo "$row[job]"; ?>)</option>

<?php
}} else {
echo "";
}
mysqli_close($conn);
?>