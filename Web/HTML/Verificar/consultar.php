<?php
include "../PHP/Class_Usuaris.php";

$nom = $_POST['user'];

$verificacio = new Usuari();
$verificacio->get_users_not_verified2();
?>