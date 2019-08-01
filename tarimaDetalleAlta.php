<?php
require_once "Auth/session.php";
require_once "Auth/proteger.php";
require_once "funcs.php";
require_once("desarrollo.php");  // reporta errores
if(!(isset($_POST["agregar"])))
{
	$_SESSION["msg"]="Acceso incorrecto a script";
	header('Location: tarimaDetalle.php');
	die();
}

$db=db::getInstance();
$idtarima=$_SESSION["idtarima"];

// datos del formulario de movimientos del reporte
$cantidad=htmlNpost("cantidad");
$clave=htmlpost("clave");
$especie=htmlpost("especie");
$descripcion=htmlpost("descripcion");
// verificar que exista la tabla
$q="select id from tablas where especie='$especie' AND descrip='$descripcion' LIMIT 1";
$db->query($q);
if($db->num_rows()==0)
{
	$_SESSION["msg"]="No exite especie y dimensiones dadas";
	header('Location: tarimaDetalle.php');
	die();
}
$db->next_row();
$idtabla=$db->f("id");
$q="insert into deftarima ";
$q.="(idtarima, idtabla, cantidad) ";
$q.="VALUES ";
$q.="($idtarima, $idtabla, $cantidad)";
$db->query($q);

$id=$db->insert_id;
$_SESSION["msg"]="Registro realizado (id=$id)"; 
header("Location: tarimaDetalle.php");
die();
?>

