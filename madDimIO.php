<?php
require_once "Auth/session.php";
require_once "desarrollo.php";

if(isset($_POST["similar"])){
	// dar de alta una dimension similar a otra (cambira la especie)
	require_once("similar.php");
} elseif(isset($_POST["favorita"])){

} elseif(isset($_POST["inout"])){

} else{
	//$_SESSION["msg"]="Acceso incorrecto a script";
	header('Location: madDimensionada.php');
	die();
}
?>

