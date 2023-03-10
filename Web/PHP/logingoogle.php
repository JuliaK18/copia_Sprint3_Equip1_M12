<?php
include_once '../modules/soo-google/vendor/autoload.php';
include_once 'Classes/Class_Usuaris.php';

// ID que genera Google
$client_id = '822015483698-5d28u0rfk1359t6tpn2trni7a9b66u1d.apps.googleusercontent.com';
// Token retornat per la petició de Google
$id_token = $_POST['token'];

// Instanciem un client de Google, al qui li passem la id generada per Google
$client = new Google_Client(['client_id' => $client_id]);

// Recuperem les dades
$payload = $client->verifyIdToken($id_token);

// Si hi ha dades...
if ($payload) {
    $email = $payload['email'];
    $given_name = $payload['given_name'];
    $user = new Usuari($email);

    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['given_name'] = $given_name;
    //$_SESSION['id_user'] = $user->get_id();

    echo json_encode(array('ok' => true, 'exists' => $user->exists_user()));

} else {
    // Invalid ID token
    echo json_encode(array('ok' => false ));
}


?>