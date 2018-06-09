<?php
require_once "Auth/session.php";
//require_once "Auth/proteger.php";
require_once "funcs.php";
require_once("desarrollo.php");  // reporta errores
if(!(isset($_POST["soloOperador"]) OR
	isset($_POST["soloAyudante"]) OR
	isset($_SESSION["idrepo"]) OR
	isset($_POST["operadorYayudante"])))
{
	$_SESSION["msg"]="Acceso incorrecto a script Alta Otros Destajos";
	header('Location: scListado.php');
	die();
}

$db=db::getInstance();
$idRepo=$_SESSION["idrepo"];
$q="select r.operador as idOp, e1.nombre as operador, r.ayudante as idAyu, e2.nombre as ayudante from repoProd as r LEFT JOIN empleados as e1 on r.operador=e1.id LEFT JOIN empleados as e2 on r.ayudante=e2.id WHERE r.id='$idRepo'";
// datos sobre el empleado que estan en repoProd (reportes de produccion)
$db->query($q);
$db->next_row();
$idOp=$db->f("idOp");
$op=$db->f("operador");
$idAyu=$db->f("idAyu");
$ayu=$db->f("ayudante");

// datos del formulario de movimientos del reporte
$cantidad=htmlNpost("cantidad");
$clave=htmlpost("clave");

$id2='';
if (isset($_POST["soloOperador"])){
	$_SESSION["agregando"]=2;  // para mostrar el mismo formulario y agregar otro
	$q="insert into movsRepoOtrasActiv ";
	$q.="(idRepo, actividad, cantidad, idEmpleado) ";
	$q.="VALUES ";
	$q.="($idRepo,'$clave',$cantidad,'$idOp')";
	$db->query($q);
} elseif (isset($_POST["soloAyudante"])){
	$_SESSION["agregando"]=2; 
	$q="insert into movsRepoOtrasActiv ";
	$q.="(idRepo, actividad, cantidad, idEmpleado) ";
	$q.="VALUES ";
	$q.="($idRepo,'$clave',$cantidad,'$idAyu')";
	$db->query($q);
} elseif (isset($_POST["operadorYayudante"])){
	$_SESSION["agregando"]=2; 
	$q="insert into movsRepoOtrasActiv ";
	$q.="(idRepo, actividad, cantidad, idEmpleado) ";
	$q.="VALUES ";
	$q1="($idRepo,'$clave',$cantidad,'$idOp')";
	$db->query($q.$q1);
	$id2=$db->insert_id;
	$q2="($idRepo,'$clave',$cantidad,'$idAyu')";
	$db->query($q.$q2);
}
//$_SESSION["q"]="$q<br>\n"; 
$id=$db->insert_id;
$_SESSION["msg"]="Registro realizado ( id=$id $id2)"; 
//header("Location: scDetalle.php");
header("Location: scDetalle.php");
die();
?>

