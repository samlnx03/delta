<?php
require_once "Auth/session.php";
require_once "desarrollo.php"; // debug show errors

// cerrar reporte de corte a largo, ya no se podra modificar

$db=db::getInstance();
if(!isset($_SESSION["idrepocl"])){ // viene de prodDetalle
	$_SESSION["msg"]="Acceso incorrecto a cerrar reporte corte a largo!";
	header('Location: clListado.php');
}
$id=$_SESSION["idrepocl"];
// PENDIENTE aplicar al inventario y luego
$q="update repoCL set aplicadaEnInventario='s' where id='$id'";
$db->query($q);
$_SESSION["msg"]="Reporte $id aplicado al inventario";
unset($_SESSION["idrepocl"]);
header('Location: clListado.php');
?>
