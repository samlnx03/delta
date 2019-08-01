<?php
//
// incluir este script en las paginas que se quiera proteger con password
//
require_once "Auth/session.php";
require_once "Auth/auth.php";

$auth = Auth::getInstance();
$auth->start();  // inicia el proceso de autenticacion

// para llegar a las funciones
// $session=Session::getInstance;
// $auth=Auth::getInstance;
?>

