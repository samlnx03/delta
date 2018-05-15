<?php
require_once "Auth/dbclass.php";
//require_once "Auth/table.php";
require_once "desarrollo.php";  // show errores

/*
$cond="order by p.id desc limit 10";
if(isset($_POST["alta"])){
        header('Location: prodNuevoRepo.php');
        die();
}
elseif(isset($_POST["today"])){
	$cond="where fecha=date(now()) order by p.id desc";
} elseif (isset($_POST["semana"])){
	$cond="where fecha<=date(NOW()) AND fecha>=date(DATE_SUB(NOW(), INTERVAL 7 DAY)) order by p.id desc";
} elseif (isset($_POST["rango"])){
	$f1=$_POST["f1"];
	$f2=$_POST["f2"];
	$cond="where fecha>='$f1' AND fecha<='$f2' order by p.id desc";
}
elseif(isset($_POST["ultimos"])){
	$cond="order by p.id desc limit 10";
}

 */
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
</head>
<body>
<?php require('menu.php'); ?>
<h1>Reportes Ejecutivos</h1>
Aserrío Diario por máquina
<br>
cantidad total diaria de piezas aserradas de cada dimension y especie
<br>
Pagos de destajos (jueves-miercoles)
<br>
Inventario de materias primas
<br>
</body>
</html>

