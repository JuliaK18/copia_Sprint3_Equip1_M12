<?php
include_once './Classes/Class_Usuaris.php';

$usermail = $_POST['usermail'];
$password = $_POST['password'];
#$ID = $_POST['userid'];
$ID = 1; #hardcoded


$usuari = new Usuari($ID);

if(!empty($usermail)){
    $object = $usuari->change_mail($usermail);
    }

if(!empty($usermail)){
    $object = $usuari->change_password($password);
    }

?>