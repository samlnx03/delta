<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php";
require_once "desarrollo.php"; // debug show errors

// cerrar reporte de sierra cinta, ya no se podra modificar

$db=db::getInstance();
if(!isset($_SESSION["idrepo"])){ // viene de prodDetalle
	$_SESSION["msg"]="Acceso incorrecto a cerrar reporte sierra cinta!";
	header('Location: scListado.php');
}
$id=$_SESSION["idrepo"];
// PENDIENTE aplicar al inventario y luego
$q="update repoProd set aplicadaEnInventario='s' where id='$id'";
$db->query($q);
$_SESSION["msg"]="Reporte $id aplicado al inventario";
unset($_SESSION["idrepo"]);
header('Location: scListado.php');
?>
