<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
$db=db::getInstance();
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
<h1>Detalle de venta de madera dimensionada</h1>
<?php echo "<a class='button-green' href='ventasma.php'>Regresar a la lista de Ventas</a>\n";?>
<br>
<?php
if(isset($_GET["id"])){
	$id=$_GET["id"];
	$_SESSION["idventa"]=$id;
}else if(isset($_SESSION["idventa"])){
	$id=$_SESSION["idventa"];
} else{
	echo "<div class='mensaje'>Acceso incorrecto a este lugar</div>";
	echo "</body></html>";
	die();
}

if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}

$q="select id, fecha, cliente, observ, editable from ventasMA where id='$id'";
$db->query($q);
$db->next_row();
$fecha=$db->f("fecha");
$cliente=$db->f("cliente");
$observ=$db->f("observ");
$editable=$db->f("editable");
echo "Detalles de la venta: <b>$id</b>, de fecha: <b>$fecha</b><br>\n";
echo "Cliente: <b>$cliente</b>, observaciones: <b>$observ</b><br>\n";
?>
<?php
if($editable=='s'){
$q="select distinct especie from tablas";
$especies=htmlSelect($q, "especie", "especie", "especie", '');
?>
<form id='cant_esp_dim' action='ventasmaDetalleAlta.php' method='POST'>
cantidad[-clave] <input id=cantidad type=text name=cantidad size=4> 
especie <?php echo $especies;?> 
Dimensiones <input id=dimensiones type=text name=descripcion>
<input type=submit name=agregar value=agregar> 
<button id="verlista">Ver Lista</button>
</form>
<div id=lista></div>
<?php
} // editable
// mostrar items de la venta
$q="select movs.id, cantidad, especie, descrip, volpt, volpt*cantidad as vol from ventasMAmovs as movs LEFT JOIN tablas as t ON movs.idtabla=t.id WHERE movs.idVentasMA='$id'";
$db->query($q);
$t=new html_table();
$t->setFieldTotalizado("vol", 0); // campo a totalizar, inicializado en 0
$t->setbody($db->get_all());
if($editable=='s'){
 $t->addextras( array(
	"Editar", 
		"<button type='submit' name='borrar' value='%f0%'>Eliminar</button>", 
		array("id")
		)
 );
 $t->setcdatas(array("Eliminar"=>"Editar", "cantidad" => "cantidad", "descrip"=>"descrip", "vol u" => "volpt", "especie"=>"especie", "vol pt"=>"vol"));
 echo "<form action='ventasmaDetalleBorra.php' method='POST'>\n";
 $t->show();
 echo "</form>\n";
 echo "Total volumen (pt): <b>".$t->getFieldTotalizado("vol")."</b><br>\n";

 echo "<form action='ventasmaDetalleBorra.php' method='POST'>\n";
 echo "<input type=submit name=terminaDef value='Terminar Definición'>\n";
 echo " Ya no será posible modificar detalles de esta venta\n";
 echo "</form>\n";
 //
 echo "<form action='ventasmaBorrar.php' method='POST'>\n";
 echo "<input type=submit name=borrarVentama value='Elimar venta'>\n";
// echo "<input type=hidden name='ctarima' value='$ctarima'>\n";
 echo " Elimina completamente esta venta y sus movimientos\n";
 echo "</form>\n";
 //
} else {
 $t->setcdatas(array("cantidad" => "cantidad", "descrip"=>"descrip", "vol u" => "volpt", "especie"=>"especie", "vol pt"=>"vol"));
 $t->show();
 echo "Total volumen (pt): <b>".$t->getFieldTotalizado("vol")."</b><br>\n";
}
//$t->setFieldClas("Importe","class='alin-der'"); //campo=>id_class, p.e. 'id'=>"class='myclas'"
?>
<script>
$( document ).ready(function() {
  $("#cantidad").focus();
});

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

$('#cant_esp_dim').submit(function(e){  // al enviar el formulario (enter)
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

