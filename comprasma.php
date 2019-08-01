<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php";
require_once "Auth/table.php";

require_once "desarrollo.php";

if(isset($_POST["alta"])){
        header('Location: comprasmaNueva.php');
        die();
}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
</head>
<body>
<?php require('menu.php'); ?>
<?php require('menuMaDim.php'); ?>
<h1>Compras de Madera Dimensionada</h1>
<?php
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}
?>
<form method='POST'>
<input type=submit name=alta value='Nueva Compra'> 
</form>

<?php
$q="select id, fecha, proveedor, observ from comprasMA";
//echo "<br>q: $q<br>\n";
$db=db::getInstance();
$db->query($q);
$t=new html_table();
$t->setbody($db->get_all());
$t->addextras( array(
	"Editar", 
		"<button type='submit' name='id' value='%f0%'>Revisar</button>", 
		array("id")
		)
);
$t->setcdatas(array("Ver"=>"Editar", "Num"=>"id", "Fecha" => "fecha", "Proveedor" => "proveedor", "Observaciones"=>"observ"));
//$t->setFieldClas("Importe","class='alin-der'"); //campo=>id_class, p.e. 'id'=>"class='myclas'"
//$t->setFieldTotalizado("total", 0); // campo a totalizar, inicializado en 0
echo "<form action='comprasmaDetalle.php' method='GET'>\n";
$t->show();
echo "</form>\n";
?>
</body>
</html>


