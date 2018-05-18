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
$q="select tarima, descripcion from tarimas where id='$id'";
$db->query($q);
$db->next_row();
$t=$db->f("tarima");
$d=$db->f("descripcion");
echo "Detalles de la tarima <b>$t: $d</b>\n";
?>
<br>
<?php
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
// mostrar componnetes de la tarima
$q="select deftarima.id, cantidad, especie, descrip, volpt, volpt*cantidad as vol from deftarima LEFT JOIN tablas ON idtabla=tablas.id WHERE deftarima.idtarima='$id'";
$db->query($q);
$t=new html_table();
$t->setbody($db->get_all());
$t->addextras( array(
	"Editar", 
		"<button type='submit' name='id' value='%f0%'>Eliminar</button>", 
		array("id")
		)
);
$t->setcdatas(array("Eliminar"=>"Editar", "cantidad" => "cantidad", "descrip"=>"descrip", "vol u" => "volpt", "especie"=>"especie", "vol pt"=>"vol"));
//$t->setFieldClas("Importe","class='alin-der'"); //campo=>id_class, p.e. 'id'=>"class='myclas'"
$t->setFieldTotalizado("vol", 0); // campo a totalizar, inicializado en 0
echo "<form action='e.php' method='GET'>\n";
$t->show();
echo "Total volumen (pt): ".$t->getFieldTotalizado("vol")."<br>\n";
echo "</form>\n";
?>
</body>
</html>

