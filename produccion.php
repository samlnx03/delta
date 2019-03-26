<?php
require_once "Auth/session.php";
require_once "Auth/dbclass.php";
//require_once "Auth/table.php";
require_once "desarrollo.php";  // show errores
require_once "funcs.php";  // funciones utiles

$db=db::getInstance();
//$q="select min(fecha) as F1, max(fecha) as F2 from destajos";
$q="select valor from claveValor where clave like 'rProdf_'"; // f1 o f2
$db->query($q);
if($db->num_rows()==0){
        $q="insert into claveValor values('rProdf1','')";
        $db->query($q);
        $q="insert into claveValor values('rProdf2','')";
        $db->query($q);
        $f1=""; $f2="";
} else {
        $db->next_row(); $f1=$db->f("valor");
        $db->next_row(); $f2=$db->f("valor");
}
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
<h1>Reportes de Producción</h1>
<form method='POST' action='periodoProduccion.php'>
Periodo para calculo de reportes de producción: de 
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
	</ul>

	<div id="tab-1" class="tab-content current">
	<?php require "prodAserrio.php";?>
	</div>
	<div id="tab-2" class="tab-content">
	<?php require "prodCorteLargo.php";?>
	</div>
	<div id="tab-3" class="tab-content">
	<?php require "prodCTarima.php";?>
	</div>
</div><!-- container -->
</body>
</html>

