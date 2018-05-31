<?php
require_once "Auth/session.php";
require_once "Auth/table.php";

require_once "desarrollo.php"; // reporta errores

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
<h1>Madera Dimensionada</h1>
<?php

if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}

$condi="";
$descrip="";
$consultar=false;
/*
if(isset($_SESSION["newIO"])){
	$descrip=$_SESSION["newIO"];
	unset($_SESSION["newIO"]);
	$condi=" WHERE descrip like '$descrip%'";
	$consultar=true;
}
 */
if(isset($_SESSION["buscar"])){
	$descrip=$_SESSION["buscar"];
	if($descrip!="") {
		$condi=" WHERE descrip like '$descrip%'";
		$consultar=true;
	}
}
if(isset($_POST["buscar"])){
	$descrip=$_POST["descripcion"];
	$_SESSION["buscar"]=$descrip;
	if($descrip!="") {
		$condi=" WHERE descrip like '$descrip%'";
		$consultar=true;
	}
}
if(isset($_POST["verTodas"])){
	$descrip="";
	$condi="";
	if(isset($_SESSION["buscar"]))
		unset($_SESSION["buscar"]);
	$consultar=true;
}
$results=0; // hay resultados de la consulta
//if(isset($descrip)){
if($consultar){
	//$q="select id, especie, claveprod, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt, existen from tablas where descrip like '$descrip%'";
	$q="select id, especie, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt from tablas $condi ORDER BY especie,grueso";
	$db=db::getInstance();
	$db->query($q);
	if($db->num_rows()==0){
		echo "<div class='mensaje'>No encontrado</div>";
	} else {
		$results=1;
	}
}
?>
<form method=POST>
Dimensiones <input type=text name=descripcion <?php echo "value='$descrip' ";?> size=50>
<input type=submit name=buscar value='Buscar'> 
<input type=submit name=verTodas value='Ver Todas'>
<!-- <input type=submit name=verFavoritas value='Ver Favoritas'> -->
<!-- <a href=madDimensionadaFavoritas.php>Ver Favoritas</a> -->
</form>

<?php
echo "<form action=madDimensionadaNueva.php method=post>\n";
echo "<input type=hidden name=descripcion value='$descrip'>\n";
echo "<input type=submit name=nueva value='Nueva Medida'>\n";
echo "<a class='button-green' href='comprasma.php'>Compras</a>\n";
echo "<a class='button-green' href='ventasma.php'>Ventas</a>\n";
echo "</form>\n";

echo "<div id='listaFavoritas'></div>\n";

if($results){
	$t=new html_table();
	$t->setbody($db->get_all());
	//$q="select id, especie, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt from tablas where descrip like '$descrip%'";
	//$t->addextras( array(
	//	"IO", 
	//	"<button class='red' type='submit' name='inout' value='%f0%'>E/S</button>", 
	//	array("id")
	//	)
	//);
	//$t->addextras( array(
	//	"Favoritos", 
	//	"<button class='red' id='favorita' type='submit' name='favorita' value='%f0%'>F</button>", 
	//	array("id")
	//	)
	//);
	$t->addextras( array(
		"Sim", 
		"<button class='red' type='submit' name='similar' value='%f0%'>+</button>", 
		array("id")
		)
	);
	$lfav="<a href=favoritas.php title='Medidas Favoritas'>Fav</a>";
	//$t->setcdatas(array("Agregar"=>"IO", "fav"=>"Favoritos", "id"=>"id",
	$t->setcdatas(array("id"=>"id",
		"Especie"=>"especie", "sim"=>"Sim", "Descrip"=>"descrip",
		"grueso" => "grueso", "ug"=>"ugrueso", "ancho"=>"ancho", "ua"=>"uancho", 
		"largo"=>"largo", "ul"=>"ulargo", "volpt"=>"volpt"
		)
	);
	// echo "<form action='madDimIO.php' method=POST>\n"; directo a similar.php
	echo "<form action='similar.php' method=POST>\n";
	$t->show();
	echo "<input type=hidden name=newIOdescrip value='$descrip'>\n";
	echo "</form>\n";
}
?>
<script>
/*
$( "p" ).click(function() {
  $( this ).slideUp();
});
$("#b1").click(function(){
	alert("B1 was clicked!");
});
$("#b2").click(function(){
	$.ajax({
	  url: "ajaxMaderaDim.php",
	  context: document.body
	}).done(function(r) {
	  //$( this ).addClass( "done" );
	  $("#ajaxOut").html( r );
	});	
});

$("#favorita").click(function(){
	$.get("ajaxMaderaDim.php",
		function(r) {
	  		$("#listaFavoritas").html( r );
		});
	return false;
	//
});
*/
</script>
</body>
</html>

