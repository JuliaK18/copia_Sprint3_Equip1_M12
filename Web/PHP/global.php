<?php

$url = 'http://localhost:88/HTML/Login/';


#Si no tenim una sessio iniciada ens redirecciona a la pàgina de login i ens fot fora
    
if(!isset($_SESSION['login'])){ //if login in session is not set
    header("Location: $url");
    exit;
}

?>