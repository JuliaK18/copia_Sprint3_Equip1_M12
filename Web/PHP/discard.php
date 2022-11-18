<?php
include_once 'Classes/Class_Validate.php';
include_once 'Classes/Class_Usuaris.php';

// Recuperem les dades enviades des del client
$data = json_decode(file_get_contents('php://input'), true);

['userID' => $userID] = $data;

// Eliminem els espais en blanc
Validate::remove_all_whitespaces($userID);

// Si està buit, retorna error
if (Validate::is_empty($userID)) 
    return json_encode(array('ok' => false, 'msg' => 'Empty'));


$user = new Usuari($userID);
$success = $user->discard();

if ($success) {
    echo json_encode(array('ok' => true));
} else {
    echo json_encode(array('ok' => false));
}
?>