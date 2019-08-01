<?php
require_once "Auth/session.php";
require_once "Auth/proteger.php";
require_once "funcs.php";
require_once("desarrollo.php");  // reporta errores

// odDetalleAlta.php   alta de un movto de reporte de otros destajos

$db=db::getInstance();
$idRepo=$_SESSION["idrepood"];

// ahora el dato del empleado esta asociado con el movto y no con el reporte
// un reporte incluye a avarios empleados

// datos del formulario de movimientos del reporte
$cantidad=htmlNpost("cantidad");
$clave=htmlpost("clave");
$idOp=htmlpost("empleado");
$redirect=htmlpost("redirect");

$id2='';
if (isset($_POST["soloOperador"])){   // para clavado es soloOperador
	//$_SESSION["agregando"]=2;  // para mostrar el mismo formulario y agregar otro
	$q="insert into movsRepoOtrasActiv ";
	$q.="(idRepoOD, actividad, cantidad, idEmpleado) ";
	$q.="VALUES ";
	$q.="($idRepo,'$clave',$cantidad,'$idOp')";
	$db->query($q);
}
//$_SESSION["q"]="$q<br>\n"; 
$id=$db->insert_id;
$_SESSION["msg"]="Registro realizado ( id=$id $id2)"; 
header("Location: $redirect");
die();
?>

