<?php
require_once "Auth/session.php";
//require_once "Auth/proteger.php";
require_once "funcs.php";
require_once("desarrollo.php");  // reporta errores
if(!(isset($_POST["aserrioYhojeado"]) OR
	isset($_POST["soloOperador"]) OR
	isset($_POST["soloAyudante"]) OR
	isset($_SESSION["idrepo"]) OR
	isset($_POST["operadorYayudante"])))
{
	$_SESSION["msg"]="Acceso incorrecto a script";
	header('Location: prodDetalle.php');
	die();
}

$db=db::getInstance();
$idRepo=$_SESSION["idrepo"];
$q="select r.operador as idOp, e1.nombre as operador, r.ayudante as idAyu, e2.nombre as ayudante from prodRepos as r LEFT JOIN empleados as e1 on r.operador=e1.id LEFT JOIN empleados as e2 on r.ayudante=e2.id WHERE r.id='$idRepo'";
// datos sobre el empleado que estan en prodRepos (reportes de produccion)
$db->query($q);
$db->next_row();
$idOp=$db->f("idOp");
$op=$db->f("operador");
$idAyu=$db->f("idAyu");
$ayu=$db->f("ayudante");

// datos del formulario de movimientos del reporte
$cantidad=htmlNpost("cantidad");
$clave=htmlpost("clave");
$descripcion=htmlpost("descripcion");
$_SESSION["agregando"]=0; 
if(isset($_POST["aserrioYhojeado"])){
	$_SESSION["agregando"]=1; 
	// un solo se registro y aplica op y ayudante como diga el reporte a la hora de los destajos
	$q="insert into repoMovs ";
	$q.="(idRepo, actividad, cantidad, descripcion) ";
	$q.="VALUES ";
	$q.="($idRepo,'$clave',$cantidad,'$descripcion')";
	// $clave es ap (aserrio de pino) u hp (hojeado de pino) etc.
	// descripcion son las medidas de la tabla de pino
	$db->query($q);
} elseif (isset($_POST["soloOperador"])){
	$_SESSION["agregando"]=2; 
	$descripcion="$idOp: $op";
	$q="insert into repoMovs ";
	$q.="(idRepo, actividad, cantidad, descripcion) ";
	$q.="VALUES ";
	$q.="($idRepo,'$clave',$cantidad,'$descripcion')";
	// $clave es otro destajo
	// descripcion son clave y nombe del tabajador separados por :
	$db->query($q);
} elseif (isset($_POST["soloAyudante"])){
	$_SESSION["agregando"]=2; 
	$descripcion="$idAyu: $ayu";
	$q="insert into repoMovs ";
	$q.="(idRepo, actividad, cantidad, descripcion) ";
	$q.="VALUES ";
	$q.="($idRepo,'$clave',$cantidad,'$descripcion')";
	// $clave es otro destajo
	// descripcion son clave y nombe del tabajador separados por :
	$db->query($q);
} elseif (isset($_POST["operadorYayudante"])){
	$_SESSION["agregando"]=2; 
	$descripcion="$idOp: $op";
	$q="insert into repoMovs ";
	$q.="(idRepo, actividad, cantidad, descripcion) ";
	$q.="VALUES ";
	$q1="($idRepo,'$clave',$cantidad,'$descripcion')";
	$db->query($q.$q1);
	// $clave es ap (aserrio de pino) u hp (hojeado de pino) etc.
	// descripcion son las medidas de la tabla de pino
	$descripcion="$idAyu: $ayu";
	$q2="($idRepo,'$clave',$cantidad,'$descripcion')";
	$db->query($q.$q2);
}
//$_SESSION["q"]="$q<br>\n"; 
$id=$db->insert_id;
$_SESSION["msg"]="Registro realizado (id=$id)"; 
header("Location: prodDetalle.php");
die();
?>

