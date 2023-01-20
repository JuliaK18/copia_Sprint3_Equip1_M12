<?php
include "Classes/Class_Usuaris.php";

$id = $_POST['id'];
echo $id;

$verificacio = new Usuari(intval($id));


   $objecte = $verificacio->update_to_not_verify_user();

/* 
if(!empty($nom2)){
    $objecte = $verificacio2->update_to_not_verify_user($nom2);
 } */
 

?>