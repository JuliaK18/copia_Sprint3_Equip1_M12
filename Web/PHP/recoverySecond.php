<?php
include_once 'Classes/Class_Usuaris.php';
include_once 'Classes/Class_Validate.php';

// Recuperem les dades enviades des del client
$data = json_decode(file_get_contents('php://input'), true);

['password' => $password, 'password_verify' => $password_verify, 'hash' => $hash] = $data;

// Eliminem els espais en blanc que puguin haver
Validate::remove_all_whitespaces($hash);

// Ens assegurem que les variables no tenen caràcters perillosos (XSS protection) 
Validate::sanitize($password, $password_verify, $hash);

// Si algun dels camps estan buits, avisa i surt
if (Validate::is_any_empty($password, $password_verify, $hash)) {
    echo json_encode(array('ok' => false, 'msg' => 'Fields empty') );
    return;
}

// Si la contrasenya i la de verificació no coincideixen, avisa i surt
if ($password != $password_verify) {
    echo json_encode(array('ok' => false, 'msg' => 'Passwords don\'t match') );
    return;
}

// Encripta la contrasenya
$password = password_hash($password, PASSWORD_DEFAULT);

$user = new Usuari($hash);
$user->change_password_recovery($password);

?>