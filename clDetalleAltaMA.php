<?php
// reporte produccion detalle alta madera aserrada
//
require_once "Auth/session.php";
//require_once "Auth/proteger.php";
require_once "funcs.php";
require_once("desarrollo.php");  // reporta errores
if(!(isset($_POST["salidaMA"]) OR
	isset($_SESSION["idrepocl"])))
{
	$_SESSION["msg"]="Acceso incorrecto a script alta M.A.";
	header('Location: clListado.php');
	die();
}

$db=db::getInstance();
// busqueda de la tabla
$tipoMov=htmlpost("tipoMov");
$redirect=htmlpost('redirect');
if($tipoMov=='descontar'){ // salidas de mad aserrada entra a corte a largo
	$especie=htmlpost("especiex");
	// datos del formulario de movimientos del reporte
	$clave=htmlpost("clave");
} else {
	$especie=htmlpost("especie");
	// datos del formulario de movimientos del reporte
	$clave=htmlpost("clave");
}
$cantidad=htmlNpost("cantidad");
$descripcion=htmlpost("descripcion");
$q="select id from tablas where especie='$especie' AND descrip='$descripcion' LIMIT 1";
$db->query($q);
if($db->num_rows()==0)
{
	$_SESSION["msg"]="No exite especie y dimensiones dadas";
	header("Location: $redirect");
	die();
}
$db->next_row();
$idtabla=$db->f("id");

$idRepo=$_SESSION["idrepocl"];


// un solo se registro y aplica operador  como diga el reporte a la hora de los destajos
// no hay clave para salidas de madera serrada que se van a habilitar a corte a largo
$q="insert into movsRepoCL ";
$q.="(idRepoCL, actividad, cantidad, idtabla, tipomov) ";
$q.="VALUES ";
$q.="($idRepo,'$clave',$cantidad,'$idtabla', '$tipoMov')";
// $clave es ap (aserrio de pino) u hp (hojeado de pino) etc.
$db->query($q);

//$_SESSION["q"]="$q<br>\n"; 
$id=$db->insert_id;
$_SESSION["msg"]="Registro realizado (id=$id)"; 
$_SESSION["agregando"]=1; 
header("Location: $redirect");
die();
?>

