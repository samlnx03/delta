<?php
require_once "Auth/session.php";
//require_once "Auth/proteger.php";
require_once "funcs.php";
require_once("desarrollo.php");  // reporta errores
if(!(isset($_POST["borrar"]) OR isset($_POST["terminaDef"])))
{
	$_SESSION["msg"]="Acceso incorrecto a script";
	header('Location: tarimaDetalle.php');
	die();
}

$db=db::getInstance();

if(isset($_POST["terminaDef"])){
	$idtarima=$_SESSION["idtarima"];
	$q="update tarimas set editable='n' where id='$idtarima'";
	$db->query($q);

	$id=$db->affected_rows();
	$_SESSION["msg"]="Definicion de tarima $id bloqueada"; 
	header("Location: tarimaDetalle.php");
	die();
}

$id=htmlNpost("borrar");

$q="delete from deftarima where id='$id'";
$db->query($q);
$id=$db->affected_rows();

$_SESSION["msg"]="Registros eliminados: $id"; 
header("Location: tarimaDetalle.php");
die();
?>

