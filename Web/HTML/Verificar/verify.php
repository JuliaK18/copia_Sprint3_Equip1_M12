<?php
include "../../PHP/Classes/Class_Usuaris.php";

$nom = $_POST['user'];
$nom2 = $_POST['user'];

$verificacio = new Usuari();
$verificacio2 = new Usuari();

if(!empty($nom)){
   $objecte = $verificacio->update_to_verify_user($nom);
}

if(!empty($nom2)){
    $objecte = $verificacio2->update_to_not_verify_user($nom2);
 }
 

?>