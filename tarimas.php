<?php
require_once "Auth/dbclass.php";
require_once "Auth/table.php";

require_once "desarrollo.php";
// borrar 2
//require_once "Auth/proteger.php";
//require_once "funcs.php";

$cond="order by p.id desc limit 10";
if(isset($_POST["alta"])){
        header('Location: tarimaNueva.php');
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
<h1>Catalogo de tarimas</h1>
<form method='POST'>
<input type=submit name=alta value='Nueva Tarima'> 
</form>

<?php
$q="select id, tarima, descripcion from tarimas";
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
$t->setcdatas(array("Ver"=>"Editar", "id"=>"id", "tarima" => "tarima", "descripcion" => "descripcion"));
//$t->setFieldClas("Importe","class='alin-der'"); //campo=>id_class, p.e. 'id'=>"class='myclas'"
//$t->setFieldTotalizado("total", 0); // campo a totalizar, inicializado en 0
echo "<form action='tarimaDetalle.php' method='GET'>\n";
$t->show();
echo "</form>\n";
?>
</body>
</html>


