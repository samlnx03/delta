<?php
require_once "Auth/session.php";
require_once "Auth/dbclass.php";
//require_once "Auth/table.php";
require_once "desarrollo.php";  // show errores
require_once "funcs.php";  // funciones utiles

/*
$cond="order by p.id desc limit 10";
if(isset($_POST["alta"])){
        //header('Location: prodNuevoRepo.php');
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

$db=db::getInstance();
//$q="select min(fecha) as F1, max(fecha) as F2 from destajos";
$q="select valor from claveValor where clave like 'rDestajSCf_'"; // f1 o f2
$db->query($q);
if($db->num_rows()==0){
        $q="insert into claveValor values('rDestajSCf1','')";
        $db->query($q);
        $q="insert into claveValor values('rDestajSCf2','')";
        $db->query($q);
        $f1=""; $f2="";
} else {
        $db->next_row(); $f1=$db->f("valor");
        $db->next_row(); $f2=$db->f("valor");
}
//$db->next_row();
//$f1=$db->f("F1");
//$f2=$db->f("F2");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tabs.css">
<script src="libs/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function(){

	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})
</script>
</head>
<body>
<?php require('menu.php'); ?>
<?php require('menuReportes.php'); ?>
<h1>Reportes de Destajos</h1>
<form method='POST' action='periodoDestajos.php'>
Periodo para calculo de destajos: de 
<?php echo" <input type=date name=f1 value='$f1' required> ";?>
a 
<?php echo "<input type=date name=f2 value='$f2' required> ";?> 
<input type=submit name=recalc value='Recalcular'>
</form>
<?php
if(isset($_SESSION["msg"])){
        echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
        unset($_SESSION["msg"]);
}
?>
<div class="container">
	<ul class="tabs">
		<li class="tab-link current" data-tab="tab-1">Aserrío</li>
		<li class="tab-link" data-tab="tab-2">Corte a Largo</li>
		<li class="tab-link" data-tab="tab-3">Clavado de Tarimas</li>
		<li class="tab-link" data-tab="tab-4">Otros destajos</li>
		<li class="tab-link" data-tab="tab-5">Globales</li>
	</ul>

	<div id="tab-1" class="tab-content current">
	<?php require "destaAserrio.php";?>
	</div>
	<div id="tab-2" class="tab-content">
	<?php require "destaCorteLargo.php";?>
	</div>
	<div id="tab-3" class="tab-content">
	<?php require "destaCTarima.php";?>
	</div>
	<div id="tab-4" class="tab-content">
	<?php require "destaOtrosD.php";?>
	</div>
	<div id="tab-5" class="tab-content">
	<?php require "destaGlob.php";?>
	</div>
</div><!-- container -->

<!--
Aserrío Diario por máquina <a href=raserrio.php>Ver</a>
<br>
cantidad total diaria de piezas aserradas de cada dimension y especie
<br>
Pagos de destajos (jueves-miercoles)
<br>
Entradas y salidas de madera dimensionada
<br>
Inventario de materias primas
<br>
-->
</body>
</html>

