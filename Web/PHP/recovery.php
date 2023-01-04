<?php
include_once 'Classes/Class_Usuaris.php';

// Recuperem les dades enviades des del client
$data = json_decode(file_get_contents('php://input'), true);

['email' => $email] = $data;

$user = new Usuari($email);
$user->recovery();

?>