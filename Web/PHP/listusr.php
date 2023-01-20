<?php
include_once 'Classes/Class_Usuaris.php';
$llista = Usuari::get_list_users();

echo json_encode($llista

)

?>