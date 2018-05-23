<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
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

$db=db::getInstance();
$q="select tarima, descripcion, editable from tarimas where id='$id'";
$db->query($q);
$db->next_row();
$t=$db->f("tarima");
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
<form action='tarimaDetalleAlta.php' method='POST'>
cantidad <input type=text name=cantidad size=4> 
especie <?php echo $especies;?> 
Dimensiones <input type=text name=descripcion>
<input type=submit name=agregar value=agregar>
</form>
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
 echo "Total volumen (pt): <b>".$t->getFieldTotalizado("vol")."</b><br>\n";
 echo "<input type=submit name=terminaDef value='Terminar Definición'>\n";
 echo " Ya no será posible modificar detalles de esta tarima\n";
 echo "</form>\n";
} else {
 $t->setcdatas(array("cantidad" => "cantidad", "descrip"=>"descrip", "vol u" => "volpt", "especie"=>"especie", "vol pt"=>"vol"));
 $t->show();
 echo "Total volumen (pt): <b>".$t->getFieldTotalizado("vol")."</b><br>\n";
}
//$t->setFieldClas("Importe","class='alin-der'"); //campo=>id_class, p.e. 'id'=>"class='myclas'"
?>
</body>
</html>

