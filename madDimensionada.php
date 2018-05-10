<?php
require_once "Auth/dbclass.php";
require_once "Auth/table.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<script LANGUAGE="JavaScript">
</script>
</head>
<body>
<?php require('menu.php'); ?>
<h1>Madera Dimensionada</h1>
<?php
/*
if(isset($_GET["id"])){
	$id=$_GET["id"];
}
echo "<h3>Movimientos del Reporte No. $id. Operador:$o, Ayudante:$a</h3>\n";
 */
?>
<form method=POST>
Dimensiones <input type=text name=descripcion size=50>
<input type=submit name=buscar value='Buscar'>
</form>
<?php

if(!isset($_POST["buscar"])){
	echo "</body></html>\n";
	exit;
}
/*
(id int not null auto_increment, especie char(10) not null, claveprod char(10) not null, descrip char(50) not null, grueso decimal(9,4) not null, ugrueso char(1) not null default 'i', ancho decimal(9,4) not null, uancho char(1) not null default 'i', largo decimal(9,4) not null, ulargo char(1) not null default 'i', volpt decimal(9,4) not null,  existen int, primary key(id), key(descrip), key(claveprod,descrip));
*/
$descrip=$_POST["descripcion"];
$q="select id, especie, claveprod, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt, existen from tablas where descrip like '$descrip%'";
//echo "q:$q<br>";
//$q="select id, nombre from empleados";
$db=db::getInstance();
$db->query($q);
if($db->num_rows()==0){
	echo "<div class='mensaje'>No encontrado: $descrip</div>";
	echo "<br>\n";
	$_SESSION["descrip"]=$descrip;
	echo "<form action=madDimensionadaNueva.php method=post>\n";
	echo "<input type=hidden name=descripcion value='$descrip'>\n";
	echo "<input type=submit name=nueva value=Agregar>\n";
	echo "</form>\n";
	echo "</body></html>\n";
	exit;
}
$t=new html_table();
$t->setbody($db->get_all());
$t->show();
?>

</body>
</html>

