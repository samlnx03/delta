<?php
require_once "Auth/session.php";
//require_once "Auth/proteger.php";
require_once "funcs.php";
require_once("desarrollo.php");  // reporta errores
if(!(isset($_POST["borrar"]) OR isset($_POST["terminaDef"])))
{
	$_SESSION["msg"]="Acceso incorrecto a script";
	header('Location: comprasmaDetalle.php');
	die();
}

$db=db::getInstance();

if(isset($_POST["terminaDef"])){
	$idcompra=$_SESSION["idcompra"];
	$q="update comprasMA set editable='n' where id='$idcompra'";
	$db->query($q);

	$id=$db->affected_rows();
	$_SESSION["msg"]="Definicion de compra $id bloqueada"; 
	header("Location: comprasmaDetalle.php");
	die();
}

$id=htmlNpost("borrar");

$q="delete from comprasMAmovs where id='$id'";
$db->query($q);
$id=$db->affected_rows();

$_SESSION["msg"]="Registros eliminados: $id"; 
header("Location: comprasmaDetalle.php");
die();
?>

