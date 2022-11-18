<?php
include_once 'Classes/Class_Usuaris.php';
include_once 'Classes/Class_Validate.php';

// Recuperem les dades enviades des del client
$username = $_POST['username'];
$password = $_POST['password'];

// Eliminem els espais en blanc que puguin haver
Validate::remove_all_whitespaces($username, $password);

// Ens assegurem que les variables no tenen caràcters perillosos (XSS protection) 
Validate::sanitize($username, $password);

// Si algun dels camps estan buits
if (Validate::is_any_empty($username, $password)) {
    // Torna al login i avisa
    header('Location: ../HTML/Login?error=empty');
    return;
}

$user = new Usuari($username, $password);

$accepted = $user->login();

if ($accepted) {
    echo 'Hello, ' . $username;
} else {
    header('Location: ../HTML/Login?error=true');
}

?>