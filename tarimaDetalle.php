<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
$db=db::getInstance();
if(isset($_POST["renombrar"])){
	$newdescrip=$_POST["descripcion"];
	//$q="insert into tarimas(tarima, descripcion) values ('$tarima', '$descripcion')";
	$id=$_SESSION["idtarima"];
	$q="update tarimas set descripcion='$newdescrip' where id='$id'";
	$db->query($q);
	$_SESSION["msg"]="descripción actualizada";
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<script src="libs/jquery-3.3.1.min.js"></script>
<script LANGUAGE="JavaScript">
function dimensionada(){
    var x = document.getElementById("madera");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
function otros(){
    var x = document.getElementById("otros");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
</head>
<body>
<?php require('menu.php'); ?>
<h1>Detalle de componentes de tarima</h1>
<?php
if(isset($_GET["id"])){
	$id=$_GET["id"];
	$_SESSION["idtarima"]=$id;
}else if(isset($_SESSION["idtarima"])){
	$id=$_SESSION["idtarima"];
} else{
	echo "<div class='mensaje'>Acceso incorrecto a este lugar</div>";
	echo "</body></html>";
	die();
}

if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}

$q="select tarima, descripcion, editable from tarimas where id='$id'";
$db->query($q);
$db->next_row();
$t=$db->f("tarima");
$ctarima=$t;
$d=$db->f("descripcion");
$editable=$db->f("editable");
echo "Detalles de la tarima <b>$t: $d</b>\n";
?>
<br>
<?php
if($editable=='s'){
$q="select distinct especie from tablas";
$especies=htmlSelect($q, "especie", "especie", "especie", '');
?>
<form id='cant_esp_dim' action='tarimaDetalleAlta.php' method='POST'>
cantidad[-clave] <input id=cantidad type=text name=cantidad size=4> 
especie <?php echo $especies;?> 
Dimensiones <input id=dimensiones type=text name=descripcion>
<input type=submit name=agregar value=agregar> 
<button id="verlista">Ver Lista</button>
</form>
<div id=lista></div>
<?php
} // editable
// mostrar componnetes de la tarima
$q="select deftarima.id, cantidad, especie, descrip, volpt, volpt*cantidad as vol from deftarima LEFT JOIN tablas ON idtabla=tablas.id WHERE deftarima.idtarima='$id'";
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
 echo "<form action='tarimaDetalleBorra.php' method='POST'>\n";
 $t->show();
 echo "</form>\n";
 echo "Total volumen (pt): <b>".$t->getFieldTotalizado("vol")."</b><br>\n";
 echo "<form action='tarimaDetalleBorra.php' method='POST'>\n";
 echo "<input type=submit name=terminaDef value='Terminar Definición'>\n";
 echo " Ya no será posible modificar detalles de esta tarima\n";
 echo "</form>\n";
 //
 echo "<form action='tarimaBorrar.php' method='POST'>\n";
 echo "<input type=submit name=borrarTarima value='Elimar tarima'>\n";
 echo "<input type=hidden name='ctarima' value='$ctarima'>\n";
 echo " Elimina completamente la definicion de la tarima\n";
 echo "</form>\n";
 //
 echo "<form method='POST'>\n";
 echo "Nombre nuevo: <input type=text name=descripcion value='$d' size=50>\n";
 echo "<input type=submit name=renombrar value='Cambiar nombre'>\n";
 echo "</form>\n";
} else {
 $t->setcdatas(array("cantidad" => "cantidad", "descrip"=>"descrip", "vol u" => "volpt", "especie"=>"especie", "vol pt"=>"vol"));
 $t->show();
 echo "Total volumen (pt): <b>".$t->getFieldTotalizado("vol")."</b><br>\n";
}
//$t->setFieldClas("Importe","class='alin-der'"); //campo=>id_class, p.e. 'id'=>"class='myclas'"
?>
<script>
var status=0;
// 0=no cargada, no mostrada, 1=cargada, mostrada, 2=cargada,no mostrada
$( document ).ready(function() {
  $("#cantidad").focus();
});

$( "#verlista" )
.click(function(){
	//alert( "Handler for .click() called." );
	if(status==0){
		$.get("ajaxMaderaDim.php")
		  .done( function (data) {
			  //alert("data descrip: "+data);
			  $("#lista").append( data );
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

$( "#cantidad" )
  .focusout(function() {
	  // si hay separador la 1a es cantidad, la 2a es clave de tabla
	  //var cc = $( "#cantidad" ).text();
	  var cc = $( "#cantidad" ).val();
	  var nd;
	  cc=cc.trim();
	  cc=cc.replace(/ /gi,"-");
	  res=cc.split("-");
	  //alert("tokens: "+res);
	  if((nd=res.length)<2){
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

//var override_keys = [13, 38, 40];
/*
$('#cantidad').keyup(function(e){
  var code = e.keyCode ? e.keyCode : e.which;

  if ($.inArray(code, override_keys)) {
    e.preventDefault();
    e.stopPropagation();
	//alert("code="+code);
    return false;
  }
});
*/
$('#cant_esp_dim').submit(function(e){

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
	  e.preventDefault();
});

</script>
</body>
</html>

