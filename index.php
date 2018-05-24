<?php
require_once "Auth/session.php";
require_once "desarrollo.php";
?>
<!DOCTYPE html>
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
<h1>Delta</h1>
<?php
$db=db::getInstance();
$q="SELECT valor FROM claveValor WHERE clave='linktogether'";
$db->query($q);
if($db->num_rows()>0){
	$db->next_row();
	$l=$db->f("valor");
	echo "<a href='$l'>Monitoreo</a><br>\n";
}
?>
<div class="container">
	<ul class="tabs">
		<li class="tab-link current" data-tab="tab-1">Empleados</li>
		<li class="tab-link" data-tab="tab-2">Actividades</li>
		<li class="tab-link" data-tab="tab-3">Producción</li>
		<li class="tab-link" data-tab="tab-4">Madera Dim</li>
		<li class="tab-link" data-tab="tab-5">Tarimas</li>
		<li class="tab-link" data-tab="tab-6">Reportes</li>
	</ul>

	<div id="tab-1" class="tab-content current">
	<?php require "help-empleados.php";?>
	</div>
	<div id="tab-2" class="tab-content">
	<?php require "help-actividades.php";?>
	</div>
	<div id="tab-3" class="tab-content">
	<?php require "help-produccion.php";?>
	</div>
	<div id="tab-4" class="tab-content">
	<?php require "help-maderaDim.php";?>
	</div>
	<div id="tab-5" class="tab-content">
	<?php require "help-tarimas.php";?>
	</div>
	<div id="tab-6" class="tab-content">
	<?php require "help-reportes.php";?>
	</div>

</div><!-- container -->
</body>
</html>

