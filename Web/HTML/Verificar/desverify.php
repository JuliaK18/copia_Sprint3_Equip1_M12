<?php
include "../../PHP/Classes/Class_Usuaris.php";

$nom2 = $_POST['user2'];


$verificacio = new Usuari();
$verificacio->update_to_not_verify_user($nom);
?>