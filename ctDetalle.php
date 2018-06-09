<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles

if(isset($_GET["id"])){
	$id=$_GET["id"];
	$_SESSION["idrepoct"]=$id;
}else if(isset($_SESSION["idrepoct"])){
	$id=$_SESSION["idrepoct"];
} else{
	$_SESSION["msg"]="Acceso incorrecto a detalle de reporte";
	header('Location: ctListado.php');
	die();
}
$db=db::getInstance();
$q="select aplicadaEnInventario from repoCT WHERE id='$id'";
$db->query($q);
$db->next_row();
$readonly=$db->f("aplicadaEnInventario");
if($readonly=='n'){
	require_once "ctMovsForm.php";
}else{
	require_once "ctMovs.php";
}
