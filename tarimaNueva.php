<?php
require_once "Auth/session.php"; // include dbclass.php
require_once "Auth/table.php";
// borrar 2
//require_once "Auth/proteger.php";
//require_once "funcs.php";
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
<h1>Catalogo de tarimas</h1>
<h3>Nueva tarima</h3>
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
<form action='tarimaAlta.php' method='POST'>
<table>
<tr>
<td>Clave<td><input type=text name=tarima size=10 maxlength=10 required>
<tr>
<td>descripción<td><input type=text name=descripcion size=50>
<tr><td><td><input type=submit name=agregar value=Agregar>
</table>

</form>
</body>
</html>
