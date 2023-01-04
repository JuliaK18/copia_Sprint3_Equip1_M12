<?php
include_once 'Classes/Class_Usuaris.php';
include_once 'Classes/Class_Validate.php';

// Recuperem les dades enviades des del client
$data = json_decode(file_get_contents('php://input'), true);
// Guardem les dades extretes de la petició en variables (el nom d'usuari)
['username' => $username] = $data;

// Recuperem el correu de la sessió
session_start();
$email = $_SESSION['email'];
$given_name = $_SESSION['given_name'];

// Creem una instància d'usuaris amb el correu
$user = new Usuari($email);

// Eliminem els espais en blanc que puguin haver
Validate::remove_all_whitespaces($username, $email);

// Ens assegurem que les variables no tenen caràcters perillosos (XSS protection) 
Validate::sanitize($username, $email, $given_name);

// Si el nom d'usuari està buit, avisa i surt
if (Validate::is_any_empty($username, $email)) {
    echo json_encode(array('ok' => false, 'msg' => 'Fields empty') );
    return;
}

// Si el correu electrònic no correspon al format, avisa i surt
if (!Validate::is_email($email)) {
    echo json_encode(array('ok' => false, 'msg' => 'The email is not valid') );
    return;
}

// Assignem el nom d'usuari a l'usuari actual
$user->set_username($username);

// Creem l'usuari a la base de dades i guardem si hi ha hagut èxit o no
$success = $user->create();

// Si hi ha hagut èxit, envia que tot ok. Si no, avisa que no ok i el perquè
echo $success ? 
    json_encode(array('ok' => true)) : 
    json_encode(array('ok' => false))

?>