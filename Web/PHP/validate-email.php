<?php
include_once 'Classes/Class_Usuaris.php';

if (!isset($_GET['hash'])) {
    header('location: ../../HTML/Login');
} 

$hash = $_GET['hash'];

$user = new Usuari($hash);
$user->validate_email();

header('location: ../../HTML/Login');
?>