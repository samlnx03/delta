<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
$db=db::getInstance();
if(isset($_POST["borrarTarima"])){
	$ctarima=$_POST["ctarima"];
	$id=$_SESSION["idtarima"];
	$q="delete from deftarima where idtarima='$id'";
	$db->query($q);
	$q="delete from tarimas where id='$id'";
	$db->query($q);
	$q="delete from actividades where clave='ct$ctarima'";
	$db->query($q);
	$_SESSION["msg"]="Tarima eliminada";
	unset($_SESSION["idtarima"]);
	header('Location: tarimas.php');
}
?>
