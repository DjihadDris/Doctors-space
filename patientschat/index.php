<?php
        $cb = fopen ( "allmsg.php", 'a' );
        fwrite ( $cb, "<div><i>L'utilisateur <b>" . $_COOKIE ['name'] . "</b> a rejoint la session de chat.</i><br></div>" );
        fclose ( $cb );
 
if (isset ( $_GET ['logout'] )) {
    $cb = fopen ( "allmsg.php", 'a' );
    fwrite ( $cb, "<div><i>L'utilisateur <b>" . $_COOKIE ['name'] . "</b> a quitté la session de chat.</i><br></div>" );
    fclose ( $cb );
    header ( "Location: ../patientschoose" );
}
?>
<?php
if(!isset($_COOKIE['name'])){
  header('Location: login');
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Discussion</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

<link rel="stylesheet" type="text/css" href="../ui/semantic.min.css">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="../ui/semantic.min.js"></script>
<link rel="stylesheet" href="../admin.css" />
<script src="../alertify.min.js"></script>
    <link rel="stylesheet" href="../css/alertify.min.css" />
    <link rel="stylesheet" href="../css/themes/default.min.css" />
<link rel="shortcut icon" type="text/css" href="../square.webp">
<style type="text/css">
.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
  width: 52.5%;
}

.container.leftc{
	float: left;
}

.container.rightc{
	float: right;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
</style>
</head>
<body style="overflow-y: hidden !important;">

<?php
include('../sidebarchat.php');
?>


<div class="ui large breadcrumb">
<a id="exit" class="ui blue tag label">Gestion des patients</a>
<a class="ui green tag label">Discussion</a>
</div>


<div style="margin: 25px !important;" class="ui grid">
  <div class="four wide column">
    <div class="ui vertical fluid tabular menu" id="list">
      <a class="active item" data-tab="group" id="1g">
        Discussion de groupe
      </a>
      <hr>
      <?php
include "../db.php";



if($_COOKIE['job'] == "Admin"){
$sql = "SELECT * FROM patients WHERE del<>'yes'";
}else if($_COOKIE['job'] == "Infirmier"){

$sqls = "SELECT fn FROM admins WHERE job='Infirmier' AND name='$_COOKIE[name]' AND status='Activé' AND del<>'yes'";
$results = $conn->query($sqls);

if ($results->num_rows > 0) {
  // output data of each row
  while($rows = $results->fetch_assoc()) {

$medecin = "$rows[fn]";

$sql = "SELECT * FROM patients WHERE mpi='$medecin' AND del<>'yes'";

  }
} else {
$sql = "";
}

}else{
$sql = "SELECT * FROM patients WHERE mpi='$_COOKIE[name]' AND del<>'yes'";
}

$i = 1;

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {  
?>
<a class="item" id="<?php echo "$row[ID]" ?>" onclick="show(<?php echo "$row[ID]" ?>, '<?php echo "$row[name]" ?>', '<?php echo "$row[email]" ?>', '<?php echo "$row[gender]" ?>')" id="chatr">
        <img src="../img/admin-<?php echo "$row[gender]"; ?>.png" class="imgradius" style="width: 35px; height: 35px;"><span style="margin-left: 10px;"><?php echo "$row[name] "."$row[fn]"; ?></span>
</a>
<?php
}}
?>
    </div>
  </div>
  <div class="twelve wide stretched column">
    <div class="ui bottom attached active tab segment" id="group" data-tab="group">

<div style="overflow-y: auto !important; height: 375px !important;" id="chatbox">
	<?php
		if (file_exists ( "allmsg.php" ) && filesize ( "allmsg.php" ) > 0) {
		$handle = fopen ( "allmsg.php", "r" );
		$contents = fread ( $handle, filesize ("allmsg.php") );
		fclose ($handle);
		echo $contents;
		}else{
?>
<center><span style="bottom: 0 !important; vertical-align: middle; line-height: 375px;">Aucun messages...</span></center>
<?php
}
?>
</div>

<form style="margin-top: 5px !important;" class="ui form">
	<div class="field">
	<div class="ui action input">
	<input style="width: 80% !important" type="text" id="usermsg" placeholder="Votre message...">
	<button class="ui primary button labeled icon" id="submitmsg"><i class="send icon"></i> Envoyer</button>
    </div>
    </div>
</form>


    </div>
    <div class="ui bottom attached tab segment" id="personal">
    	<input hidden id="namep">
    	<input hidden id="emailp">
    	<input hidden id="genderp">
<div style="overflow-y: auto !important; height: 375px !important;" id="chatbox2"></div>

<form style="margin-top: 5px !important;" class="ui form">
	<div class="field">
	<div class="ui action input">
	<input style="width: 80% !important" type="text" id="usermsg2" placeholder="Votre message...">
	<button class="ui primary button labeled icon" id="submitmsg2"><i class="send icon"></i> Envoyer</button>
    </div>
    </div>
</form>

    </div>
  </div>
</div>

<script type="text/javascript">
$('.menu .item').tab();

function show(id, name, email, gender){
document.getElementById('1g').setAttribute('class', 'item');
document.getElementById(id).setAttribute('class', 'item active');
document.getElementById('group').setAttribute('class', 'ui bottom attached tab segment');
document.getElementById('personal').setAttribute('class', 'ui bottom attached tab segment active');
document.getElementById('emailp').value = email;
document.getElementById('genderp').value = gender;
document.getElementById('namep').value = name;
$.ajax({
        url: "messages.php",
        data: {
           name: name
       },
        type: 'POST',
        cache: false,
        success: function(html){       
            $("#chatbox2").html(html);          
        },
    });
}

function reload(){
var name = document.getElementById('namep').value;
$.ajax({
        url: "messages.php",
        data: {
           name: name
       },
        type: 'POST',
        cache: false,
        success: function(html){       
            $("#chatbox2").html(html);          
        },
    });
}

$("#submitmsg2").click(function(){

var name = document.getElementById('namep').value;
var email = document.getElementById('emailp').value;
var gender = document.getElementById('genderp').value;
var message = document.getElementById('usermsg2').value;

if(message != ""){
$.ajax({
        url: "sendmessage.php",
        data: {
           name: name,
           email: email,
           gender: gender,
           message: message
        },
        type: 'POST',
        cache: false,
        success: function(html){   
        if(html == "201"){ 
        	document.getElementById('usermsg2').value = "";
            reload.call();
            }else{
             alertify.error(html);
            }   
        },
    });

}else{
	alertify.error('Remplir le message');
}

return false;
});

$(document).ready(function(){
    $("#exit").click(function(){
        window.location = 'index?logout';
    });
});
$("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();
        $.post("post.php", {text: clientmsg});             
        $("#usermsg").val("");
        reloadg.call();
    return false;
});
function reloadg(){    
    $.ajax({
        url: "allmsg.php",
        cache: false,
        success: function(html){       
            $("#chatbox").html(html);                    
        },
    });
}
setInterval (reloadg, 250);
setInterval (reload, 250);
</script>
</body>
</html>