<?php
require_once "Auth/session.php";
require_once "Auth/proteger.php";
require_once "funcs.php";
require_once("desarrollo.php");  // reporta errores
if(!(isset($_POST["borrar"]) OR isset($_POST["terminaDef"])))
{
	$_SESSION["msg"]="Acceso incorrecto a script";
	header('Location: ventasmaDetalle.php');
	die();
}

$db=db::getInstance();

if(isset($_POST["terminaDef"])){
	$idventa=$_SESSION["idventa"];
	$q="update ventasMA set editable='n' where id='$idventa'";
	$db->query($q);

	$id=$db->affected_rows();
	$_SESSION["msg"]="Definicion de venta $id bloqueada"; 
	header("Location: ventasmaDetalle.php");
	die();
}

$id=htmlNpost("borrar");

$q="delete from ventasMAmovs where id='$id'";
$db->query($q);
$id=$db->affected_rows();

$_SESSION["msg"]="Registros eliminados: $id"; 
header("Location: ventasmaDetalle.php");
die();
?>

