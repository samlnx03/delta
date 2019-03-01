<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles

if(isset($_GET["id"])){
	$id=$_GET["id"];
	$_SESSION["idrepood"]=$id;
}else if(isset($_SESSION["idrepood"])){
	$id=$_SESSION["idrepood"];
} else{
	$_SESSION["msg"]="Acceso incorrecto a detalle de reporte";
	header('Location: odListado.php');
	die();
}
$db=db::getInstance();
$q="select aplicadaEnInventario from repoOD WHERE id='$id'";
$db->query($q);
$db->next_row();
$readonly=$db->f("aplicadaEnInventario");
if($readonly=='n'){
	//require_once "ctMovsForm.php";
	require_once "odMovsEdit.php";
}else{
	require_once "odMovs.php";
}
