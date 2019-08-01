<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php";
require_once "desarrollo.php"; // debug show errors

//	clRepoBorrar		borra reporte de corte a largo

$db=db::getInstance();
if(!isset($_SESSION["idrepocl"])){ // viene de scDetalle
	$_SESSION["msg"]="Acceso incorrecto a borrar reporte!";
	header('Location: clListado.php');
}
$id=$_SESSION["idrepocl"];
$q="delete from movsRepoCL where idRepoCL='$id'";
$db->query($q);
$q="delete from movsRepoOtrasActiv where idRepoCL='$id'";
$db->query($q);
$q="delete from repoCL where id='$id'";
$db->query($q);
$_SESSION["msg"]="Reporte $id eliminado";
unset($_SESSION["idrepocl"]);
header('Location: clListado.php');
?>
