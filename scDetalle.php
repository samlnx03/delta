<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles

if(isset($_GET["id"])){
	$id=$_GET["id"];
	$_SESSION["idrepo"]=$id;
}else if(isset($_SESSION["idrepo"])){
	$id=$_SESSION["idrepo"];
} else{
	$_SESSION["msg"]="Acceso incorrecto a detalle de reporte";
	header('Location: scListado.php');
	die();
}
$db=db::getInstance();
$q="select aplicadaEnInventario from repoProd WHERE id='$id'";
$db->query($q);
$db->next_row();
$readonly=$db->f("aplicadaEnInventario");
if($readonly=='n'){
	require_once "scMovsForm.php";
}else{
	require_once "scMovs.php";
}
