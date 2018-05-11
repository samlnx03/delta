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

// checar que no exista descrip (medidas) con la clave de prod y especie
$claveProd=$_POST["claveProd"];
$descripcion=$_POST["descripcion"];
$db=db::getInstance();
$q="select id from tablas where claveprod='$claveProd' AND descrip='$descripcion'";
$db->query($q);
if($db->num_rows()>0){
	$_SESSION["msg"]="Ya existe la clave de produccion y descripcion";
	header('Location: madDimensionadaNueva.php');
	die();
}
// dar el alta
$especie=$_POST["especie"];
$grueso=htmlNpost("grueso");
$ugrueso=htmlpost("ugrueso");
$ancho=htmlNpost("ancho");
$uancho=htmlpost("uancho");
$largo=htmlNpost("largo");
$ulargo=htmlpost("ulargo");
$volumenPT=htmlNpost("volumenPT");

$q="insert into tablas ";
$q.=	"(especie, claveprod, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt, existen) ";
$q.=	"VALUES ";
$q.=	"('$especie','$claveProd', '$descripcion', $grueso, '$ugrueso', $ancho, '$uancho', $largo, '$ulargo', $volumenPT, 0)";

$db->query($q);
$id=$db->insert_id;
//$_SESSION["q"]="$q<br>\n"; 
header("Location: madDimensionadaNueva.php");	//a los detalles
die();
?>

<?php
require_once "funcs.php";
?>

