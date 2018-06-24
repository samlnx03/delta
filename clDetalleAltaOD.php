<?php
require_once "Auth/session.php";
//require_once "Auth/proteger.php";
require_once "funcs.php";
require_once("desarrollo.php");  // reporta errores
if(!(isset($_POST["soloOperador"]) OR
	isset($_SESSION["idrepocl"])))
{
	$_SESSION["msg"]="Acceso incorrecto a script Alta Otros Destajos (desde corte a largo)";
	header('Location: clListado.php');
	die();
}

$db=db::getInstance();
$idRepo=$_SESSION["idrepocl"];
$q="select r.operador as idOp, e1.nombre as operador from repoCL as r LEFT JOIN empleados as e1 on r.operador=e1.id WHERE r.id='$idRepo'";
// datos sobre el empleado que estan en repoProd (reportes de produccion)
$db->query($q);
$db->next_row();
$idOp=$db->f("idOp");
$op=$db->f("operador");

// datos del formulario de movimientos del reporte
$cantidad=htmlNpost("cantidad");
$clave=htmlpost("clave");

if (isset($_POST["soloOperador"])){
	$_SESSION["agregando"]=2;  // para mostrar el mismo formulario y agregar otro
	$q="insert into movsRepoOtrasActiv ";
	$q.="(idRepoCL, actividad, cantidad, idEmpleado) ";
	$q.="VALUES ";
	$q.="($idRepo,'$clave',$cantidad,'$idOp')";
	$db->query($q);
} 
//$_SESSION["q"]="$q<br>\n"; 
$id=$db->insert_id;
$_SESSION["msg"]="Registro realizado ( id=$id)"; 
//header("Location: scDetalle.php");
$redirect=htmlpost("redirect");
header("Location: $redirect");
die();
?>

