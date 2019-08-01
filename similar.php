<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php";
//require_once "Auth/table.php";

require_once "desarrollo.php";

$db=db::getInstance();
if(isset($_POST["borrar"])){
	$borrar=$_POST["borrar"];
	$q="select existen from tablas where id='$borrar'";
	$db->query($q); $db->next_row();
	if($db->f("existen")>0){
		$_SESSION["msg"]="Error: Ya existe inventario";
	}
	$q="delete from tablas where id='$borrar'";
	$db->query($q);
	$_SESSION["msg"]="Eliminado!";
	header('Location: madDimensionada.php');
	die();
}
if(isset($_POST["agregar"])){
	$especie=$_POST["especie"];
	$descripcion=$_POST["descripcion"];
	$q="select id from tablas where especie='$especie' AND descrip='$descripcion'";
	$db->query($q);
	if($db->num_rows()>0){
		$_SESSION["msg"]="Ya existe $especie en $descripcion";
		header('Location: madDimensionada.php');
		die();
	}
	$idt=$_POST["similar"];
	$q="insert into tablas ";
	$q.="(especie, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt, existen) ";
	$q.="SELECT '$especie' as especie, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt, 0 as existen ";
	$q.="from tablas where id='$idt'";
	$db->query($q);

	$_SESSION["msg"]="Agegado:  $especie en $descripcion";
	header('Location: madDimensionada.php');
	die();
}

$idtablasimilar=$_POST["similar"];
// obtner datos de la tabla oroginal
$q="select  especie, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt from tablas where id='$idtablasimilar'";
$db->query($q);
$db->next_row();
//$especie=$db->f("especie");
$descrip=$db->f("descrip");
$grueso=$db->f("grueso");
$ugrueso=$db->f("ugrueso");
$ancho=$db->f("ancho");
$uancho=$db->f("uancho");
$largo=$db->f("largo");
$ulargo=$db->f("ulargo");
$volpt=$db->f("volpt");

/*
$descripcion=$descrip;

$especie=$_POST["especie"];
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
 */
?>
<html>
<head>
<title>Alta similar a madera dimensionada</title>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<script src="js/cubicar.js"></script>
</head>
<body>
<?php require('menu.php');
//echo "q:$q<br>\n";
?>
<h1>Nueva madera dimensionada (similar)</h1>
<?php
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}
?>
<form action=similar.php method=POST>
<input type=hidden name=similar value='<?php echo $idtablasimilar;?>'>
Especie <input type=text name=especie onKeyUp="this.value = this.value.toUpperCase();" required> (pino, encino, etc.)
<br>
<?php
echo "<br>\n";
echo "Descripción (dimensiones) <input type=text id='descripcion' name=descripcion value='$descrip' size=50 onfocusout='analizadimensiones(this.value)' readonly>\n";
echo "<br>\n";
//echo "ejemplo1: <input type=text value='3/4x4x8 1/4' disabled>  ejemplo2: <input type=text value='1 1/2x4 1/2x120' disabled><br>\n";

?>
grueso <input type=text id='gruesoDecimal' name=grueso value='<?php echo $grueso;?>' size=5 required readonly>
<input type=text name=ugrueso size=2 value='<?php echo $ugrueso;?>' readonly>
<!--
<select id='ugrueso' name='ugrueso'>
<option id='ugruesoI' value='I'>Inches</option>
<option id='ugruesoC' value='C'>Cm.</option>
</select>
-->

<?php //echo ifc("ugrueso");?> 
ancho <input type=text id='anchoDecimal' name=ancho value='<?php echo $ancho;?>' size=5 required readonly>
<input type=text name=ugrueso size=2 value='<?php echo $uancho;?>' readonly>
<!--
<select id='uancho' name='uancho'>
<option id='uanchoI' value='I'>Inches</option>
<option id='uanchoC' value='C'>Cm.</option>
</select>
-->

<?php //echo ifc("uancho");?> 
largo <input type=text id='largoDecimal' name=largo value='<?php echo $largo;?>' size=5 required readonly>
<input type=text name=ugrueso size=2 value='<?php echo $ulargo;?>' readonly>
<?php //echo ifc("ulargo");?> 
<!--
<select id='ulargo' name='ulargo'>
<option id='ulargoI' value='I'>Inches</option>
<option id='ulargoF' value='F'>Feets</option>
<option id='ulargoC' value='C'>Cm.</option>
<option id='ulargoM' value='M'>Metros</option>
</select>
 <button onclick='recalcVol(); return false'>Recubicar</button>
-->
<br>
volumen <input id='volumenPT' type=text name=volpt value='<?php echo $volpt;?>' size=5 readonly> (pie-tabla) 

<br>
<br>
<input type=submit name=agregar value='Agregar'>
</form>
</body>
</html>
