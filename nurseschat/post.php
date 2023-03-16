<?php
session_start();
if(isset($_COOKIE['name'])){
    date_default_timezone_set('Africa/Algiers');
    date_default_timezone_set('CET');
    $text = $_POST['text'];
    if($text != ""){
    $cb = fopen("allmsg.php", 'a');
    fwrite($cb, "<div>(".date("g:i A")." - ".date("Y-m-d").") <b>".$_COOKIE['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($cb);
}
}
?>