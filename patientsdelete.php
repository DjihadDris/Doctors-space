<?php
require("db.php");
$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($conn, "UPDATE patients SET del='yes' WHERE ID='" . $_POST["users"][$i] . "'");
}
header("Location: patients");
?>