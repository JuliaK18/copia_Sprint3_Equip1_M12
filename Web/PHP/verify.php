<?php
include "Classes/Class_Usuaris.php";

$id = $_POST['id'];
echo $id;

$verificacio = new Usuari(intval($id));


   $objecte = $verificacio->update_to_verify_user();

?>