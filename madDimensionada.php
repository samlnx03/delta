<?php
require_once "Auth/dbclass.php";
require_once "Auth/table.php";

require_once "desarrollo.php"; // reporta errores

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<script LANGUAGE="JavaScript">
</script>
</head>
<body>
<?php require('menu.php'); ?>
<h1>Madera Dimensionada</h1>
<?php
$condi="";
$descrip="";
$consultar=false;
if(isset($_SESSION["newIO"])){
	$descrip=$_SESSION["newIO"];
	unset($_SESSION["newIO"]);
	$condi=" WHERE descrip like '$descrip%'";
	$consultar=true;
}
if(isset($_POST["buscar"])){
	$descrip=$_POST["descripcion"];
	if($descrip!="") {
		$condi=" WHERE descrip like '$descrip%'";
		$consultar=true;
	}
}
if(isset($_POST["verTodas"])){
	$descrip="";
	$condi="";
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
</form>

<?php
echo "<form action=madDimensionadaNueva.php method=post>\n";
echo "<input type=hidden name=descripcion value='$descrip'>\n";
echo "<input type=submit name=nueva value=Agregar>\n";
echo "</form>\n";

if($results){
	$t=new html_table();
	$t->setbody($db->get_all());
	//$q="select id, especie, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt from tablas where descrip like '$descrip%'";
	$t->addextras( array(
		"Entradas", 
		"<button class='red' type='submit' name='borrar' value='%f0%'>Entradas</button>", 
		array("id")
		)
	);
	$t->addextras( array(
		"Salida", 
		"<button class='red' type='submit' name='borrar' value='%f0%'>Salidas</button>", 
		array("id")
		)
	);
	$t->setcdatas(array("Registar"=>"Entradas", "Agregar"=>"Salida", 
		"Especie"=>"especie", "Descrip"=>"descrip", 
		"grueso" => "grueso", "ug"=>"ugrueso", "ancho"=>"ancho", "ua"=>"uancho", 
		"largo"=>"largo", "ul"=>"ulargo", "volpt"=>"volpt"
		)
	);
	//echo "<form action='madDimIO.php' method=POST>\n";
	$t->show();
	echo "<input type=hidden name=newIOdescrip value='$descrip'>\n";
	echo "</form>\n";
}
?>
</body>
</html>

