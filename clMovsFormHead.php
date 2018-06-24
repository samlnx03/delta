<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
//
//	corte a largo
// no ha sido inventariado y es editable
// desaplicar en otro script especial para ello
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<link rel="stylesheet" type="text/css" href="styles/abutton.css">
<script src="libs/jquery-3.3.1.min.js"></script>
</head>
<body>
<?php require('menu.php');
require("menuProd.php");
?>
<h1>Detalle de reporte de Corte a Largo</h1>
<?php
if(!isset($_SESSION["idrepocl"])){ // viene de clDetalle que hace require a este script
	echo "<div class='mensaje'>Acceso incorrecto a este lugar</div>";
	echo "</body></html>";
	die();
}
$id=$_SESSION["idrepocl"];
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}

$db=db::getInstance();
$q="select fecha, sierraGemela, e1.nombre as operador, aplicadaEnInventario from repoCL as r LEFT JOIN empleados as e1 on r.operador=e1.id WHERE r.id='$id'";
$db->query($q);
$db->next_row();
$o=$db->f("operador");
$f=$db->f("fecha");
$sg=$db->f("sierraGemela");
$readonly=$db->f("aplicadaEnInventario");
echo "Movimientos del Reporte No. <b>$id</b>. del día <b>$f</b> Sierra Gemela: <b>$sg</b><br>Operador: <b>$o</b><br>\n";
?>
<a class='button-green' href='clMovsSal0.php'>(1) Salidas de Aserrío</a>
<a class='button-green' href='clMovsEn0.php'>(2) Prod Corte a Largo</a>
<a class='button-green' href='clMovsOD0.php'>(3) Otros Destajos</a>
<a class='button-green' href='clDetalle.php'>(4) Ver 1,2 y 3</a>
<br>
