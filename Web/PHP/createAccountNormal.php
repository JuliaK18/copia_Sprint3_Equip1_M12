<?php
include_once 'Classes/Class_Usuaris.php';
include_once 'Classes/Class_Validate.php';

// Recuperem les dades enviades des del client
$data = json_decode(file_get_contents('php://input'), true);
// Guardem les dades extretes de la petició en variables
['username' => $username, 'email' => $email, 'password' => $password, 'passwordRepeat' => $passwordRepeat] = $data;

// Eliminem els espais en blanc que puguin haver
Validate::remove_all_whitespaces($username, $email, $password, $passwordRepeat);

// Ens assegurem que les variables no tenen caràcters perillosos (XSS protection) 
Validate::sanitize($username, $email, $password, $passwordRepeat);

// Si algun dels camps estan buits, avisa i surt
if (Validate::is_any_empty($username, $password)) {
    echo json_encode(array('ok' => false, 'msg' => 'Fields empty') );
    return;
}

// Si la contrasenya i la de verificació no coincideixen, avisa i surt
if ($password != $passwordRepeat) {
    echo json_encode(array('ok' => false, 'msg' => 'Passwords don\'t match') );
    return;
}

// Si el correu electrònic no correspon al format, avisa i surt
if (!Validate::is_email($email)) {
    echo json_encode(array('ok' => false, 'msg' => 'The email is not valid') );
    return;
}

// Encripta la contrasenya
$password = password_hash($password, PASSWORD_DEFAULT);

// Creem una nova instància d'usuari
$user = new Usuari($username, $email, $password);

// Creem l'usuari a la base de dades i guardem si hi ha hagut èxit o no
$success = $user->create();

// Si hi ha hagut èxit, envia que tot ok. Si no, avisa que no ok i el perquè
echo $success ? 
    json_encode(array('ok' => true)) : 
    json_encode(array('ok' => false))

?>