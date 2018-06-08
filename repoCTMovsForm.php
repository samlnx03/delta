<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
//
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
<?php require('menu.php'); ?>
<div class=mensaje>Todavia no funciona</div>
<h1>Detalle de reporte de Clavado de Tarima</h1>
<?php
if(!isset($_SESSION["idrepoct"])){ // viene de ctDetalle que hace require a este script
	echo "<div class='mensaje'>Acceso incorrecto a este lugar</div>";
	echo "</body></html>";
	die();
}
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}

$db=db::getInstance();
$q="select fecha, supervisor, aplicadaEnInventario from repoCT as r WHERE r.id='$id'";
$db->query($q);
$db->next_row();
/*$o=$db->f("operador");
$a=$db->f("ayudante");
 */
$f=$db->f("fecha");
$s=$db->f("supervisor");
$readonly=$db->f("aplicadaEnInventario");
echo "Movimientos del Reporte No. <b>$id</b>. del día <b>$f</b><br>Supervisor: <b>$s</b><br>\n";
// mostrar forma para el clavado de tarima
?>
<?php
echo "<form action=prodDetalleAltaCT.php method=POST>\n";
echo "Cantidad <input type=text name=cantidad size=3>\n";
$q="select clave, concat(clave,': (',unidad,') ',descrip) as descrip from actividades where tipo='tarima'";
$clave=htmlSelect($q, "clave", "clave", "descrip", '');
echo "Clave $clave\n";
$q="select id, nombre from empleados order by nombre";
$empleado=htmlSelect($q, "empleado", "id", "nombre", '');
echo "Empleado $empleado\n";

//echo "<tr><td>Clave<td<>$clave\n";
//echo "<tr> \n";
//echo "<td><td>";
?>
<input type=submit name=soloOperador value='Agregar'>
</form>
<?php
// mostrar movimientos de clavado de tarima
// pero dados de alta desde clavado de tarimas y no desde sierras cintas
//
// se agrego otro campo a movsRepoOtrasActiv idRepoCT 
// 	para identificar a los movtos de Clavado de Tarima de la tabla repoCT
//
$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepoCT='$id'";

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
echo "<form action='ctDetalleBorrar.php' method='POST'>\n";
$t->show();
echo "<input type=hidden name=tabla value=OA>";
echo "</form>\n";
echo "<a class='button-red' href='ctRepoBorrar.php?id=$id'>Borrar Repo</a> ";
echo "OJO: Se borra definitivamente!   ---\n";
echo "<a class='button-green' href='ctRepoCerrar.php?id=$id'>Cerrar Repo</a> ";
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
</body>
</html>
