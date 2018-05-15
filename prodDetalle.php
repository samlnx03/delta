<?php
require_once "Auth/dbclass.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<script LANGUAGE="JavaScript">
function dimensionada(){
    var x = document.getElementById("madera");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
function otros(){
    var x = document.getElementById("otros");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
</head>
<body>
<?php require('menu.php'); ?>
<h1>Detalle de reporte de Produccion</h1>
<?php
if(isset($_GET["id"])){
	$id=$_GET["id"];
	$_SESSION["idrepo"]=$id;
}else if(isset($_SESSION["idrepo"])){
	$id=$_SESSION["idrepo"];
} else{
	echo "<div class='mensaje'>Acceso incorrecto a este lugar</div>";
	echo "</body></html>";
	die();
}
$db=db::getInstance();
$q="select fecha, e1.nombre as operador, e2.nombre as ayudante from prodRepos as r LEFT JOIN empleados as e1 on r.operador=e1.id LEFT JOIN empleados as e2 on r.ayudante=e2.id WHERE r.id='$id'";
$db->query($q);
$db->next_row();
$o=$db->f("operador");
$a=$db->f("ayudante");
$f=$db->f("fecha");
echo "Movimientos del Reporte No. <b>$id</b>. del día <b>$f</b> Operador: <b>$o</b>, Ayudante: <b>$a</b>\n";
?>
<br>
Mostrar/Ocultar
<button onclick="dimensionada()">Madera Dimensionada</button>
<button onclick="otros()">otros destajos</button>
<div  id="madera" style="display: none; background-color: eeeeee; font-weight: bold; color: black; border:thin Black; border-style : dashed; line-height: 20px; padding-top: 6px; padding-left: 6px; padding-bottom: 6px; padding-right: 6px;">
<form action=prodDetalleAlta.php method=POST>
<table>
<tr>
<td>
Producción<br>
<?php
$q="select clave, descrip from clavesActividad where unidad='pie-tabla'";
$clave=htmlSelect($q, "clave", "clave", "descrip", '');
echo "$clave\n";
?>
<td>Cantidad<br><input type=text name=cantidad size=9>
<td>Dimensiones<br><input type=text name=descripcion size=50>
<td><br>
<input type=submit name=aserrioYhojeado value='Agregar'>
<b>Aserrio y hojeado</b>
</table>
</form>
</div>

<div id="otros" style="display: none; background-color: eeeeee; font-weight: bold; color: black; border:thin Black; border-style : dashed; line-height: 20px; padding-top: 6px; padding-left: 6px; padding-bottom: 6px; padding-right: 6px;">
<form action=prodDetalleAlta.php method=POST>
<table>
<tr>
<td>Cantidad<br><input type=text name=cantidad size=9>
<?php
$q="select clave, concat(unidad,' ',descrip) as descrip from clavesActividad where unidad<>'pie-tabla'";
$clave=htmlSelect($q, "clave", "clave", "descrip", '');
echo "<td>Clave<br>$clave\n";
echo "<td> \n";
echo "<input type=hidden name=descripcion>";
?>
<td> <br>
<input type=submit name=soloOperador value='Agregar'>
<?php echo "Solo el Operador: <b>$o</b>\n";?>
<tr>
<td>Cantidad<br><input type=text name=cantidad size=9>
<?php
echo "<td>Clave<br>$clave\n";
echo "<td> \n";
echo "<input type=hidden name=descripcion>";
?>
<td> <br>
<input type=submit name=soloAyudante value='Agregar'>
<?php echo "Solo el Ayudante: <b>$a</b>\n";?>
<tr>
<td>Cantidad<br><input type=text name=cantidad size=9>
<?php
echo "<td>Clave<br>$clave\n";
echo "<td> \n";
echo "<input type=hidden name=descripcion>";
?>
<td> <br>
<input type=submit name=operadorYayudante value='Agregar'>
<?php echo "Para cada uno: <b>$o y $a</b>\n";?>
</table>
</form>
</div>
<?php
// mostrar movimientos de madera habilitada
// mostrar otros destajos
?>
</body>
</html>

