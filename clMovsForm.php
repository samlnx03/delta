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

?>
<div  id="maderaexit" style="<?php echo $styl1;?>">
<form id='cant_esp_dimx' action='clDetalleAltaMA.php' method='POST'>
<?php
//$q="select clave, descrip from actividades where tipo='tabla'";
//$clave=htmlSelect($q, "clave", "clave", "descrip", '');
//echo "$clave\n";
$q="select distinct especie from tablas";
$especies=htmlSelect($q, "especiex", "especie", "especie", '');
?>
<?php //echo "$clave\n";?>
cantidad[-clave] <input id='cantidadx' type='text' name='cantidad' size='4'> 
especie <?php echo $especies;?> 
Dimensiones <input id='dimensionesx' type='text' name='descripcion'>
<input type='submit' name='salidaMA' value='agregar'> 
<button id="verlistax">Ver Lista</button>
</form>
<div id=listax></div>
</div>


<div  id="madera" style="<?php echo $styl1;?>">
<form id='cant_esp_dim' action='clDetalleAltaMA.php' method='POST'>
<?php
$q="select clave, descrip from actividades where tipo='tabla'";
$clave=htmlSelect($q, "clave", "clave", "descrip", '');
//echo "$clave\n";
$q="select distinct especie from tablas";
$especies=htmlSelect($q, "especie", "especie", "especie", '');
?>
<?php echo "$clave\n";?>
cantidad[-clave] <input id='cantidad' type='text' name='cantidad' size='4'> 
especie <?php echo $especies;?> 
Dimensiones <input id='dimensiones' type='text' name='descripcion'>
<input type='submit' name='aserrioYhojeado' value='agregar'> 
<button id="verlista">Ver Lista</button>
</form>
<div id=lista></div>
</div>
<?php
$styl2.="background-color: eeeeee; color: black; border:thin Black; border-style : dashed; line-height: 20px; padding-top: 6px; padding-left: 6px; padding-bottom: 6px; padding-right: 6px;";
?>


<div  id="otros" style="<?php echo $styl2;?>">
<form action=clDetalleAltaOD.php method=POST>
<table>
<tr>
<td>Cantidad<br><input type=text name=cantidad size=3>
<?php
//$q="select clave, concat(unidad,' ',descrip) as descrip from actividades where unidad<>'pie-tabla'";
$q="select clave, concat(clave,': (',unidad,') ',descrip) as descrip from actividades where tipo<>'tabla'";
$clave=htmlSelect($q, "clave", "clave", "descrip", '');
echo "<td>Clave<br>$clave\n";
echo "<td> \n";
echo "<input type=hidden name=descripcion>";
?>
<td> <br>
<input type=submit name=soloOperador value='Agregar'>
<?php echo "<b>$o</b>\n";?>
</td></tr></table></form>
</div>
<?php
	// mostrar movimientos de madera dimensionada
	$q="select d.id, d.cantidad, a.descrip, t.especie, t.descrip as dimensiones from movsRepoCL as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN tablas as t ON d.idtabla=t.id WHERE d.idRepoCL='$id'";
	//echo "$q<br>\n";
	$db->query($q);
	$t=new html_table();
  	$t->addextras( array(
		"Editar", 
		"<button class='red' type='submit' name='id' value='%f0%'>Eliminar</button>", 
		array("id")
		)
  	);
	  $t->setcdatas(array("Eliminar"=>"Editar", "cant" => "cantidad", "descrip"=>"descrip", "especie"=>"especie", "dimensiones"=>"dimensiones" ));
	$t->setbody($db->get_all());
  	echo "<form action='clDetalleBorrar.php' method='POST'>\n";
	$t->show();
	echo "<input type=hidden name=tabla value=MD>";
	echo "</form>\n";
	
	// mostrar movimientos de otros destajos
	$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepoCL='$id'";
	$db->query($q);
	$t=new html_table();
	$t->addextras( array(
		"Editar", 
		"<button class='red' type='submit' name='id' value='%f0%'>Eliminar</button>", 
		array("id")
		)
  	);
	$t->setcdatas(array("Eliminar"=>"Editar", "cant" => "cantidad", "unidad"=>"unidad", "descrip"=>"descrip","empleado"=>"nombre" ));
	$t->setbody($db->get_all());
	echo "<form action='clDetalleBorrar.php' method='POST'>\n";
	$t->show();
	echo "<input type=hidden name=tabla value=OA>";
	echo "</form>\n";
	echo "<a class='button-red' href='clRepoBorrar.php?id=$id'>Borrar Repo</a> ";
	echo "OJO: Se borra definitivamente!   ---\n";
	echo "<a class='button-green' href='clRepoCerrar.php?id=$id'>Cerrar Repo</a> ";
	echo "No se podrá ni borrar ni agregar nada al reporte\n";
?>
<script>
	/*
$( document ).ready(function() {
  $("#cantidad").focus();
});
*/
$("#botros").click(function(){
	$("#otros").toggle();
	});

$("#bmadera").click(function(){
	$("#madera").toggle();
	if($("#madera").is(":visible"))
		$("#cantidad").focus();
	});
	
$("#bmaderaexit").click(function(){
	$("#maderaexit").toggle();
	if($("#maderaexit").is(":visible"))
		$("#cantidadexit").focus();
	});
</script>
<script>
$( "#cantidad" )
  .focusout(function() {
	  // si hay separador la 1a es cantidad, la 2a es clave de tabla
	  //var cc = $( "#cantidad" ).text();
	  var cc = $( "#cantidad" ).val();
	  cc=cc.trim();
	  cc=cc.replace(/ /gi,"-");
	  res=cc.split("-");
	  //alert("tokens: "+res);
	  if(res.length<2){
		  //alert("solo cantidad "+nd);
		  return;
	  }
	  //alert("cantidad y clave tabla "+res[0]+"-"+res[1]);
	  $( "#cantidad" ).val(res[0]);
	  $.get( "getdescrip.php", { id:res[1] } )
		  .done( function (data) {
			  //alert("data descrip: "+data);
			  var r=jQuery.parseJSON(data);
			  $( "#dimensiones" ).val( r.descrip );
			  $( "#especie" ).val(r.especie);
	  		});
	  return;
  });
</script>
<script>
$('#cant_esp_dim').submit(function(e){  // al enviar el formulario mad dimensionada (enter)
	// form submit
	  var cc = $( "#cantidad" ).val();
	  var nd;
	  cc=cc.trim();
	  cc=cc.replace(/ /gi,"-");
	  res=cc.split("-");
	  //alert("tokens: "+res);
	  if(res.length<2){
		if($("#dimensiones").val().length==0){
			e.preventDefault();
			return;
		}else{ //hay dimensiones, normalizar
			nd=analizadimensiones($("#dimensiones").val());
			$("#dimensiones").val(nd);
		}
		return;
	  }
	  //alert("cantidad y clave tabla "+res[0]+"-"+res[1]);
	  $( "#cantidad" ).val(res[0]);
	  $.get( "getdescrip.php", { id:res[1] })
		  .done( function (data) {
			  //alert("data descrip: "+data);
			  var r=jQuery.parseJSON(data);
			  $( "#dimensiones" ).val( r.descrip );
			  $( "#especie" ).val(r.especie);
		  });
	  e.preventDefault(); // asyncrona, espera antes de enviar sirve que se revisa
});

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
