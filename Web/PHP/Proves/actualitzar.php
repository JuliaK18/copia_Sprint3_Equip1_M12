<?php
include_once '../Classes/Class_Usuaris.php';

$verificar = new Usuari();
echo $verificar->verify_user(1);
?>
