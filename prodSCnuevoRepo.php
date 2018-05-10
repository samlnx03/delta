<?php
require_once "Auth/session.php"; // include dbclass.php
require_once "Auth/table.php";
// borrar 2
//require_once "Auth/proteger.php";
//require_once "funcs.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<link rel="stylesheet" type="text/css" href="styles/abutton.css">
<script>
function validar(){
	if(document.getElementById("ayudante").value=='')
		document.getElementById("ayudante").value='0';
	return true;
}
</script>
</head>
<body>
<?php require('menu.php'); ?>
<h1>Producción Sierras Cintas</h1>
<h3>Nuevo reporte de producción</h3>
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
<div class="divrow">
<div class="divcol">
<form action='prodSCaltaRepo.php' method='POST' onsubmit='validar()'>
<table>
<tr>
<td>Supervisor de Area<td><input type=text name=supervisor required>
<tr>
<td>fecha<td><input type=date name=fecha required>
<tr>
<td>Sierra cinta No.<td><input type=text name=sierraCinta required>
<tr>
<td># Operador<td><input id='operador' type=text name=operador required> 

<tr>
<td># Ayudante<td><input id='ayudante' type=text name=ayudante>
<tr>
<td>Entregó<td><input type=text name=entrego>
<tr>
<td>Recibió<td><input type=text name=recibio>
<tr><td><td><input type=submit name=agregar value=Agregar>
</table>

</form>
</div> <!-- column1 -->
<div class="divcol" style="overflow-y: scroll; overflow-x: hidden; height: 300px;">
<?php
require_once("sel-empleado.php");
?>
</div>  <!-- col2 -->
</div>  <!-- row -->
</body>
</html>
