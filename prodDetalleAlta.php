<?php
require_once "Auth/session.php";
// borrar 2
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

$idRepo=$_SESSION["idrepo"];
$cantidad=htmlNpost("cantidad");
$clave=htmlpost("clave");
$descripcion=htmlpost("descripcion");
if(isset($_POST["aserrioYhojeado"])){
	// un solo se registro y aplica op y ayudante como diga el reporte
	// 	id int not null auto_increment,
	//	idRepo int not null,
	//	actividad char(10) not null,
	//	cantidad int not null,
	//	descripcion char(50) not null,
	//	cubicacionPT decimal(9,3),

	$q="insert into RepoMovs ";
	$q.="(idRepo, actividad, cantidad, descripcion) ";
	$q.="VALUES ";
	$q.="($idRepo,'$calve',$cantidad,'$descripcion')";
}
$db=db::getInstance();
$q="select id from tablas where claveprod='$claveProd' AND descrip='$descripcion'";
//$db->query($q);
// dar el alta
//$volumenPT=htmlNpost("volumenPT");

$q="insert into tablas ";
$q.=	"(especie, claveprod, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt, existen) ";
$q.=	"VALUES ";
$q.=	"('$especie','$claveProd', '$descripcion', $grueso, '$ugrueso', $ancho, '$uancho', $largo, '$ulargo', $volumenPT, 0)";

//$db->query($q);
$id=$db->insert_id;
//$_SESSION["q"]="$q<br>\n"; 
header("Location: prodDetalle.php");
die();
?>

<?php
require_once "funcs.php";
?>
