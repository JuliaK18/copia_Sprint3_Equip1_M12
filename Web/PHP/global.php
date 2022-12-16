<?php

$url = 'http://localhost:88/HTML/Login/';

if(!isset($_SESSION['login'])){ //if login in session is not set
    header("Location: $url");
}

?>