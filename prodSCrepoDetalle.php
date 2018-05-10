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
<h1>Produccion Sierras Cintas</h1>
<?php
if(isset($_GET["id"])){
	$id=$_GET["id"];
}
$db=db::getInstance();
$q="select e1.nombre as operador, e2.nombre as ayudante from prodSierrasCintas as p LEFT JOIN empleados as e1 on p.operador=e1.id LEFT JOIN empleados as e2 on p.ayudante=e2.id WHERE p.id='$id'";
$db->query($q);
$db->next_row();
$o=$db->f("operador");
$a=$db->f("ayudante");
echo "<h3>Movimientos del Reporte No. $id. Operador:$o, Ayudante:$a</h3>\n";
?>
<form method=POST>
<table>
<tr>
<td>Cantidad<br><input type=text name=cantidad size=9>
<td>Clave<br><input type=text name=clave size=5>
<td>Descripción<br><input type=text name=descripcion size=50>
<td> <br>
<input type=submit name=nuevo value='Agregar'>
</table>
</form>

</body>
</html>

