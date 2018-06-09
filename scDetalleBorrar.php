<?php
// borrar detalle de reporte de produccion, madera dimensionada u otras actividades
//
require_once "Auth/session.php";
//require_once "Auth/proteger.php";
require_once "funcs.php";
require_once("desarrollo.php");  // reporta errores
if(!isset($_POST["id"]))
{
	$_SESSION["msg"]="Acceso incorrecto a script";
	header('Location: scDetalle.php');
	die();
}

$db=db::getInstance();
$t=htmlpost("tabla");
if($t=="MD")
	$tabla="movsRepoDimensionado";
else if($t=="OA")
	$tabla="movsRepoOtrasActiv";

$id=htmlNpost("id");
$q="delete from $tabla where id='$id'";
$db->query($q);
$ar=$db->affected_rows();
	
$_SESSION["msg"]="Registros eliminados: $ar";
header('Location: scDetalle.php');
die();

?>

