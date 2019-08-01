<?php
require_once "Auth/proteger.php";
//		odRepoBorrar   borrar un reporte de otros destajos
//
require_once "Auth/session.php";
require_once "desarrollo.php"; // debug show errors

$db=db::getInstance();
if(!isset($_SESSION["idrepood"])){ // viene de odDetalle
	$_SESSION["msg"]="Acceso incorrecto a borrar reporte!";
	header('Location: odListado.php');
}
$id=$_SESSION["idrepood"];
$q="delete from movsRepoOtrasActiv where idRepoOD='$id'";
$db->query($q);
$q="delete from repoOD where id='$id'";
$db->query($q);
$_SESSION["msg"]="Reporte $id eliminado";
unset($_SESSION["idrepood"]);
header('Location: odListado.php');
?>
