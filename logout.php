<?php
if($_COOKIE['remember'] == "no"){
setcookie("name", "", time() - (86400 * 30), "/");
}else{
setcookie("name", "", time() - (60*60*24*30), "/");
}
header('Location: login');
?>