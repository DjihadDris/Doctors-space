<?php
include "../db.php";

$name = $_POST['name'];

$sql = "SELECT * FROM chat WHERE receiver='$name' AND sender='$_COOKIE[name]' OR sender='$name' AND del<>'yes'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {  
?>

<div class="container <?php if("$row[sender]" == $_COOKIE['name']){echo "rightc";}else{echo "darker leftc";} ?>">
  <img src="../img/admin-<?php if("$row[sender]" == $_COOKIE['name']){echo $_COOKIE['gender'];}else{echo "$row[gender]";} ?>.png" <?php if("$row[sender]" == $_COOKIE['name']){}else{echo "class='right'";} ?> alt="Avatar" style="width:100%;">
  <p><?php echo "$row[message]"; ?></p>
  <span class="time-<?php if("$row[sender]" == $_COOKIE['name']){echo "right";}else{echo "left";} ?>"><?php echo "$row[time] - $row[date]"; ?></span>
</div>

<?php
}}else{
?>
<center><span style="bottom: 0 !important; vertical-align: middle; line-height: 375px;">Aucun messages...</span></center>
<?php
}
?>