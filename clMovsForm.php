<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
//
//	corte a largo
// no ha sido inventariado y es editable
// desaplicar en otro script especial para ello
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<link rel="stylesheet" type="text/css" href="styles/abutton.css">
<script src="libs/jquery-3.3.1.min.js"></script>
</head>
<body>
<?php require('menu.php');
require("menuProd.php");
?>
<h1>Detalle de reporte de Corte a Largo</h1>
<?php
if(!isset($_SESSION["idrepocl"])){ // viene de clDetalle que hace require a este script
	echo "<div class='mensaje'>Acceso incorrecto a este lugar</div>";
	echo "</body></html>";
	die();
}
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}

$db=db::getInstance();
$q="select fecha, sierraGemela, e1.nombre as operador, aplicadaEnInventario from repoCL as r LEFT JOIN empleados as e1 on r.operador=e1.id WHERE r.id='$id'";
$db->query($q);
$db->next_row();
$o=$db->f("operador");
$f=$db->f("fecha");
$sg=$db->f("sierraGemela");
$readonly=$db->f("aplicadaEnInventario");
echo "Movimientos del Reporte No. <b>$id</b>. del día <b>$f</b> Sierra Gemela: <b>$sg</b><br>Operador: <b>$o</b><br>\n";
?>
[ Mostrar/Ocultar captura de 
<button id='bmaderaexit'>Tablas Origen</button>
<button id='bmadera'>Corte a Largo</button>
<button id="botros">otros destajos</button> ]
<?php 
if(!isset($_SESSION["agregando"])){
	$styl1="display: none; ";
	$styl2="display: none; ";
	$styl0="display: none; ";
}
elseif($_SESSION["agregando"]==1){
	$styl1="display: block; ";
	$styl2="display: none; ";
	$styl0="display: none; ";
}
elseif($_SESSION["agregando"]==2){
	$styl1="display: none; ";
	$styl2="display: block; ";
	$styl0="display: none; ";
}
elseif($_SESSION["agregando"]==3){
	$styl1="display: none; ";
	$styl2="display: none; ";
	$styl0="display: block; ";
}
$styl0.="background-color: eeeeee; color: black; border:thin Black; border-style : dashed; line-height: 20px; padding-top: 6px; padding-left: 6px; padding-bottom: 6px; padding-right: 6px;";

$styl1.="background-color: eeeeee; color: black; border:thin Black; border-style : dashed; line-height: 20px; padding-top: 6px; padding-left: 6px; padding-bottom: 6px; padding-right: 6px;";

$styl2.="background-color: eeeeee; color: black; border:thin Black; border-style : dashed; line-height: 20px; padding-top: 6px; padding-left: 6px; padding-bottom: 6px; padding-right: 6px;";

// formularios
require "clMovsFormSalidas.php";
require "clMovsFormEntradas.php";
require "clMovsFormOtrosD.php";

// registros agregados
require "clMovsSal.php";
require "clMovsEn.php";
require "clMovsOD.php";
?>

<script>
	/*
$( document ).ready(function() {
  $("#cantidad").focus();
});
*/
$("#botros").click(function(){
	$("#otros").toggle();
	if($("#otros").is(":visible"))
		$("#cantidadO").focus();
	});
	
</script>
<script>
function cantidadFocusOut(cantidad,dimensiones,especie){
	// los tres campos que se afectaran
	//
	  // en cantidad si hay separador la 1a es cantidad, la 2a es clave de tabla
	  //var cc = $( "#cantidad" ).text();
	  var cc = $( cantidad ).val();
	  cc=cc.trim();
	  cc=cc.replace(/ /gi,"-");
	  res=cc.split("-");
	  //alert("tokens: "+res);
	  if(res.length<2){
		  //alert("solo cantidad "+nd);
		  return;
	  }
	  //alert("cantidad y clave tabla "+res[0]+"-"+res[1]);
	  $( cantidad ).val(res[0]);
	  $.get( "getdescrip.php", { id:res[1] } )
		  .done( function (data) {
			  //alert("data descrip: "+data);
			  var r=jQuery.parseJSON(data);
			  $( dimensiones ).val( r.descrip );
			  $( especie ).val(r.especie);
	  		});
	  return;
}
</script>
<script>
function analizadimensiones(d){
	var res;
        var d1;
        d1=d.replace(/X/gi,"x");
        d1=d1.replace(/\*/gi,"x");
        d1=d1.replace(/[ ]*x[ ]*/g,"x");
        //d1=d1.replace(/ /g,"+");
        //alert("normalizando dimensones: "+d1);
        res=d1.split("x");
        //alert("tokens: "+res);
	if(res.length!=3){
		return d;  // tu sabras lo que metes!
                //alert("dimensiones incorrectas, hay "+nd);
                //return;
        }
	return d1;
}
</script>
<script>
var status=0;
var medidas="";
// 0=no cargada, no mostrada, 1=cargada, mostrada, 2=cargada,no mostrada
$( "#verlista" )
.click(function(){
	//alert( "Handler for .click() called." );
	var dim=$( "#dimensiones" ).val();
	if(medidas!=dim) {
		status=0;
		medidas=dim;
	}
	if(status==0){
		$.get("ajaxMaderaDim.php",{descrip:medidas})
		  .done( function (data) {
			  //alert("data descrip: "+data);
			  $("#lista").empty().append( data );
	  		});
		status=1;
	} else if(status==1){
		// ocultar
		$("#lista").hide();
		status=2;
	} else {
		// mostrar
		$("#lista").show();
		status=1;
	}
	return false; // no submit
});

function botonclicked(b) { // en la lista ajax de tablas
	$.get( "getdescrip.php", { id:b.value } )
		.done( function (data) {
		//alert("data descrip: "+data);
		var r=jQuery.parseJSON(data);
		$( "#dimensiones" ).val( r.descrip );
		$( "#especie" ).val(r.especie);
		}
	);
	//document.getElementById("dimensiones").value = "Hello World" + b.value;
	//alert("boton: "+b.value);
	//document.getElementById("lista").style.display = "none";
	$("#verlista").trigger("click");
  	$("#cantidad").focus();
}
</script>
</body>
</html>
