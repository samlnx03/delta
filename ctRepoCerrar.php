<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php";
require_once "desarrollo.php"; // debug show errors

$db=db::getInstance();
if(!isset($_SESSION["idrepoct"])){ // viene de prodDetalle
	$_SESSION["msg"]="Acceso incorrecto a cerrar reporte!";
	header('Location: ctListado.php');
}
$id=$_SESSION["idrepoct"];
// PENDIENTE aplicar al inventario y luego
$q="update repoCT set aplicadaEnInventario='s' where id='$id'";
$db->query($q);
$_SESSION["msg"]="Reporte $id aplicado al inventario";
unset($_SESSION["idrepoct"]);
header('Location: ctListado.php');
?>
