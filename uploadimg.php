<?php
$valid_extensions = array('jpeg', 'jpg','png'); 

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Erreur: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
       
        $code=$_COOKIE['name'].mt_rand(10,100000);/* rename the file name*/
        $size= $_FILES['file']['size'];
        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        if($size > 2097152) /*2 mb 1024*1024 bytes*/
        {
            echo json_encode(array("statusCode"=>400,'msg'=>"Image autorisée inférieure à 10 Mo"));
        }
        else if(!in_array($ext, $valid_extensions)) {
            echo json_encode(array("statusCode"=>400,'msg'=>$ext.' interdit'));
        }
        else{
           
            $result = move_uploaded_file($_FILES['file']['tmp_name'], 'sealssignatures/' . $code.'.'.$ext);
            echo "http://localhost/E-learning DZ/admin/sealssignatures/".$code.".".$ext;
        }
        
    }
?>