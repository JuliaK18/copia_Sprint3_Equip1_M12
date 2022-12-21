<?php
include_once "../Classes/Class_Usuaris.php";
session_start();

    $id = $_GET['verificat'];

    $desverificar = new Usuari();
    $desverificar->update_to_not_verify_user($id);

?>