<?php
//		ctRepoBorrar   borrar un reporte de calavado de tarima
//
require_once "Auth/session.php";
require_once "desarrollo.php"; // debug show errors

$db=db::getInstance();
if(!isset($_SESSION["idrepoct"])){ // viene de ctDetalle
	$_SESSION["msg"]="Acceso incorrecto a borrar reporte!";
	header('Location: ctListado.php');
}
$id=$_SESSION["idrepoct"];
$q="delete from movsRepoOtrasActiv where idRepoCT='$id'";
$db->query($q);
$q="delete from repoCT where id='$id'";
$db->query($q);
$_SESSION["msg"]="Reporte $id eliminado";
unset($_SESSION["idrepoct"]);
header('Location: ctListado.php');
?>
