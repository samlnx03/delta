<?php
require_once "Auth/session.php";
//require_once "Auth/table.php";

require_once "desarrollo.php";

$db=db::getInstance();
if(!isset($_POST["favorita"])){
	$_SESSION["msg"]="Acceso incorrecto a favoritos";
	header('Location: madDimensionada.php');
	die();
}
$idtabla=$_POST["favorita"];
$q="insert IGNORE into favoritablas (idtabla, usuario) VALUES ('$idtabla', 'sam')";
$db->query($q);
if($db->affected_rows()>0){
	$_SESSION["msg"]="Se agregó a favoritos la $idtabla";
}else{
	$_SESSION["msg"]="No se pudo agregar a favoritos la $idtabla";
}
header('Location: madDimensionada.php');
die();
