<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "Auth/proteger.php";
require_once "funcs.php";

if(isset($_POST["proveedor"])){
	$f1=$_POST["f1"];
	$f2=$_POST["f2"];
	$_SESSION["f1"]=$f1;
	$_SESSION["f2"]=$f2;
	header("Location: provRepoCDprov.php");
}
if(isset($_POST["genero"])){
	$f1=$_POST["f1"];
	$f2=$_POST["f2"];
	$_SESSION["f1"]=$f1;
	$_SESSION["f2"]=$f2;
	header("Location: provRepoCDgenero.php");
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/abutton.css">
</head>
<body>
<?php require('menu.php'); ?>
<?php require('menuRyR.php'); ?>
<h1>Reporte de Entradas de Rollito Cortas Dimensiones</h1>
<?php
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}
?>
<form method='POST'>
<?php
if(isset($_SESSION['f1'])){
	$f1=$_SESSION['f1'];
	$f2=$_SESSION['f2'];
	echo "entre las fechas <input type=date name=f1 value='$f1'> ";
	echo "y <input type=date name=f2 value='$f2'>";
}else{
	echo "entre las fechas <input type=date name=f1> ";
	echo "y <input type=date name=f2>";
}
?>
<br>
<input type=submit name=genero value='Resumen por Genero'> 
<input type=submit name=proveedor value='Resumen por Proveedor'>
</form>
</body>
</html>
