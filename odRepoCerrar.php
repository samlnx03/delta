<?php
require_once "Auth/session.php";
require_once "desarrollo.php"; // debug show errors

$db=db::getInstance();
if(!isset($_SESSION["idrepood"])){ // viene de prodDetalle
	$_SESSION["msg"]="Acceso incorrecto a cerrar reporte!";
	header('Location: odListado.php');
}
$id=$_SESSION["idrepood"];
// PENDIENTE aplicar al inventario y luego
$q="update repoOD set aplicadaEnInventario='s' where id='$id'";
$db->query($q);
$_SESSION["msg"]="Reporte $id aplicado al inventario";
unset($_SESSION["idrepood"]);
header('Location: odListado.php');
?>
