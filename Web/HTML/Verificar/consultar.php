<?php
include "../PHP/Class_Usuaris.php";

$nom = $_POST['user'];

$verificacio = new Usuari();
$verificacio->update_to_not_verify_user($nom);
?>