<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php"; // include dbclass.php
require_once "Auth/table.php";
require_once "desarrollo.php";  // show errors
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<link rel="stylesheet" type="text/css" href="styles/abutton.css">
<script>
</script>
</head>
<body>
<?php require('menu.php'); ?>
<h1>Compras de Madera Dimensionada</h1>
<h3>Nueva compra</h3>
<?php
//<a class='button-slategray' href=prodSClistado.php>Listado</a>
?>
<?php 
//if(isset($_SESSION["q1"])) echo $_SESSION["q1"];
//if(isset($_SESSION["q"])) echo $_SESSION["q"];
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}
?>
<form action='comprasmaAlta.php' method='POST'>
<table>
<tr>
<td>Fecha<td><input type=date name=fecha>
<tr>
<td>Proveedor<td><input type=text name=proveedor size=60 maxlength=80>
<tr>
<td>Observaciones<td><input type=text name=observ size=60 maxlength=80>
<tr><td><td><input type=submit name=agregar value=Agregar>
<?php echo "<a class='button-green' href='comprasma.php'>Regresar a la lista de Compras</a>\n";?>
</table>

</form>
</body>
</html>
