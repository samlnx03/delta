<?php
// reporte produccion detalle alta madera aserrada
//
require_once "Auth/session.php";
require_once "Auth/proteger.php";
require_once "funcs.php";
require_once("desarrollo.php");  // reporta errores
if(!(isset($_POST["aserrioYhojeado"]) OR
	isset($_SESSION["idrepo"])))
{
	$_SESSION["msg"]="Acceso incorrecto a script alta M.A.";
	header('Location: scListado.php');
	die();
}

$db=db::getInstance();
// busqueda de la tabla
$especie=htmlpost("especie");
$descripcion=htmlpost("descripcion");
$q="select id from tablas where especie='$especie' AND descrip='$descripcion' LIMIT 1";
$db->query($q);
if($db->num_rows()==0)
{
	$_SESSION["msg"]="No exite especie y dimensiones dadas";
	header('Location: scDetalle.php');
	die();
}
$db->next_row();
$idtabla=$db->f("id");

$idRepo=$_SESSION["idrepo"];

// datos del formulario de movimientos del reporte
$cantidad=htmlNpost("cantidad");
$clave=htmlpost("clave");

// un solo se registro y aplica op y ayudante como diga el reporte a la hora de los destajos
$q="insert into movsRepoDimensionado ";
$q.="(idRepo, actividad, cantidad, idtabla) ";
$q.="VALUES ";
$q.="($idRepo,'$clave',$cantidad,'$idtabla')";
// $clave es ap (aserrio de pino) u hp (hojeado de pino) etc.
$db->query($q);

//$_SESSION["q"]="$q<br>\n"; 
$id=$db->insert_id;
$_SESSION["msg"]="Registro realizado (id=$id)"; 
$_SESSION["agregando"]=1; 
header("Location: scDetalle.php");
die();
?>

