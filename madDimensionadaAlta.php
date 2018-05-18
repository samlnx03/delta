<?php
require_once "Auth/session.php";
// borrar 2
//require_once "Auth/proteger.php";
require_once "funcs.php";
require_once("desarrollo.php");  // reporta errores

if(!isset($_POST["agregar"])){
	header('Location: madDimensionadaNueva.php');
	die();
}

// checar que no exista descrip (medidas) con la especie
$descripcion=$_POST["descripcion"];
$especie=$_POST["especie"];
$db=db::getInstance();
$q="select id from tablas where especie='$especie' AND descrip='$descripcion'";
$db->query($q);
if($db->num_rows()>0){
	$_SESSION["msg"]="Ya existe $especie en $descripcion";
	header('Location: madDimensionadaNueva.php');
	die();
}
// dar el alta
$grueso=htmlNpost("grueso");
$ugrueso=htmlpost("ugrueso");
$ancho=htmlNpost("ancho");
$uancho=htmlpost("uancho");
$largo=htmlNpost("largo");
$ulargo=htmlpost("ulargo");
$volumenPT=htmlNpost("volumenPT");

$q="insert into tablas ";
$q.=	"(especie, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt, existen) ";
$q.=	"VALUES ";
$q.=	"('$especie', '$descripcion', $grueso, '$ugrueso', $ancho, '$uancho', $largo, '$ulargo', $volumenPT, 0)";

$db->query($q);
$id=$db->insert_id;
$_SESSION["msg"]="Registro realizado (id=$id)"; 
header("Location: madDimensionadaNueva.php");	//a los detalles
die();
?>

<?php
require_once "funcs.php";
?>

