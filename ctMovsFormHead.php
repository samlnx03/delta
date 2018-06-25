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
<h1>Detalle de reporte de Clavado de Tarima</h1>
<?php
if(!isset($_SESSION["idrepoct"])){ // viene de clDetalle que hace require a este script
	echo "<div class='mensaje'>Acceso incorrecto a este lugar</div>";
	echo "</body></html>";
	die();
}
$id=$_SESSION["idrepoct"];
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}

$db=db::getInstance();
$q="select fecha, supervisor, aplicadaEnInventario from repoCT as r WHERE r.id='$id'";
$db->query($q);
$db->next_row();
/*$o=$db->f("operador");
$a=$db->f("ayudante");
 */
$f=$db->f("fecha");
$s=$db->f("supervisor");
$readonly=$db->f("aplicadaEnInventario");
echo "Movimientos del Reporte No. <b>$id</b>. del día <b>$f</b><br>Supervisor: <b>$s</b><br>\n";

?>
<a class='button-green' href='ctMovsCT.php'>(1) Clavado de Tarima</a>
<a class='button-green' href='ctMovsOD.php'>(2) Otros Destajos</a>
<a class='button-green' href='ctMovsEdit.php'>(3) Ver 1 y 2</a>
<br>
