<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "Auth/proteger.php";
//require_once "funcs.php";

$db=db::getInstance();
if(isset($_POST["alta"])){
	$fecha=$_POST['fecha'];
	$remision=$_POST['remision'];
	$chofer=$_POST['chofer'];
	$producto=$_POST['producto'];
	$folioftal=$_POST['folioftal'];
	$altoProm=$_POST['alto'];
	$ancho=$_POST['ancho'];
	$largo=$_POST['largo'];
	$largoCDcm=$_POST['largoCD'];
	$vol_embarcadoM3=$_POST['volEmbarcado'];
	$vol_recibidoM3=$_POST['volRecibido'];
	$q="insert into entradasCD ".
		"(fecha, remision, chofer, producto, folioftal, altoProm, ancho, largo, ".
		"largoCDcm, vol_embarcadoM3, vol_recibidoM3) ".
		"values ".
		"('$fecha', '$remision', '$chofer', '$producto', '$folioftal', '$altoProm', ".
		"'$ancho', '$largo', '$largoCDcm', '$vol_embarcadoM3', '$vol_recibidoM3')";
	$db->query($q);
	$_SESSION["msg"]="Viaje de rollito CD agregado";
        header('Location: provEntradasCD.php');
        die();
}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/abutton.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<script src="libs/jquery-3.3.1.min.js"></script>
</head>
<body>
<?php require('menu.php'); ?>
<?php require('menuRyR.php'); ?>
<h1>Capturar Entrada de Rollito Cortas Dimensiones</h1>
<?php
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}
?>
<div class="divrow">
<div class="divcol">
<form method='POST'>
Producto: <input id='producto' type='text' size='5' name='producto' required />
<input id='prodDetalle' type=text size=50 readonly>
<br>
Fecha: <input type=date name='fecha' required> Remisión <input type=text name='remision'> <br>
Chofer: <input type=text name='chofer'> 
Folio Forestal: <input type=text name='folioftal'>
<br>
<br>
<b>Medidas del camión METROS</b><br>
Alto (promedio) <input id="alto" size=10 type=text name=alto required>
Ancho <input id="ancho" type=text size=10 name=ancho required>
Largo <input id="largo" type=text size=10 name=largo required>
<br><br>
Longitud del rollito (<b>cm</b>) <input type=text size=10 name=largoCD required><br>
<br>
Vol Embarcado (m3) <input type=text name='volEmbarcado' required> 
Vol Recibido (m3) <input id="volrecibido" type=text name='volRecibido' required> <br>
<br>
<input type=submit name=alta value='Agregar'>
</form>
</div> <!-- column1 -->
<div class="divcol" style="overflow-y: scroll; overflow-x: hidden; height: 300px;">
<?php
require_once("provSelprod.php");
?>
</div>  <!-- col2 -->
</div>  <!-- row -->


<script>
$( "#producto" )
  .focusout(function() {
	  // si hay separador la 1a es cantidad, la 2a es clave de tabla
	  //var cc = $( "#cantidad" ).text();
	  var cc = $( "#producto" ).val();
	  cc=cc.trim();
	  $.get( "provAjaxGetProd.php", { id:cc } )
		  .done( function (data) {
			  //alert("data descrip: "+data);
			  var r=jQuery.parseJSON(data);
			  $( "#prodDetalle" ).val( r.prodDetalle );
	  		});
	  return;
  });

$( "#alto" )
  .focusout(function() {
	  var alto = $( "#alto" ).val();
	  var ancho = $( "#ancho" ).val();
	  var largo = $( "#largo" ).val();
	  $( "#volrecibido" ).val( Math.trunc(alto*ancho*largo*0.7*1000)/1000 );
	  return;
  });

$( "#ancho" )
  .focusout(function() {
	  var alto = $( "#alto" ).val();
	  var ancho = $( "#ancho" ).val();
	  var largo = $( "#largo" ).val();
	  $( "#volrecibido" ).val( Math.trunc(alto*ancho*largo*0.7*1000)/1000 );
	  return;
  });

$( "#largo" )
  .focusout(function() {
	  var alto = $( "#alto" ).val();
	  var ancho = $( "#ancho" ).val();
	  var largo = $( "#largo" ).val();
	  $( "#volrecibido" ).val( Math.trunc(alto*ancho*largo*0.7*1000)/1000 );
	  return;
  });
</script>
</body>
</html>


