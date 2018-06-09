<?php
require_once "Auth/session.php";
require_once "desarrollo.php"; // debug show errors

//	scRepoBorrar		borra reporte de sierra cinta

$db=db::getInstance();
if(!isset($_SESSION["idrepo"])){ // viene de scDetalle
	$_SESSION["msg"]="Acceso incorrecto a borrar reporte!";
	header('Location: scListado.php');
}
$id=$_SESSION["idrepo"];
$q="delete from movsRepoDimensionado where idRepo='$id'";
$db->query($q);
$q="delete from movsRepoOtrasActiv where idRepo='$id'";
$db->query($q);
$q="delete from repoProd where id='$id'";
$db->query($q);
$_SESSION["msg"]="Reporte $id eliminado";
unset($_SESSION["idrepo"]);
header('Location: scListado.php');
?>
