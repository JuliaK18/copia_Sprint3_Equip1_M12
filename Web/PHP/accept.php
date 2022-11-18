<?php
include_once 'Classes/Class_Usuaris.php';

// Recuperem les dades enviades des del client
$data = json_decode(file_get_contents('php://input'), true);

['userID' => $userID] = $data;

$user = new Usuari($userID);
$success = $user->validate();

if ($success) {
    echo json_encode(array('ok' => true));
} else {
    echo json_encode(array('ok' => false));
}
?>