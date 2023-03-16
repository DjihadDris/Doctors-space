<?php
include('db.php');

$drug = $_POST['drug'];

$sql = "SELECT * FROM drugs WHERE name='$drug' AND del<>'yes'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {

echo "$row[form]";

}} else {
echo "";
}
mysqli_close($conn);
?>