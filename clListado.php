<?php
require_once "Auth/session.php";
require_once "Auth/table.php";

//		corte a largo Listado de reportes

$cond="order by p.id desc limit 10";
if(isset($_POST["alta"])){
        header('Location: clNuevoRepo.php');
        die();
}
elseif(isset($_POST["today"])){
	$cond="where fecha=date(now()) order by p.id desc";
} elseif (isset($_POST["semana"])){
	$cond="where fecha<=date(NOW()) AND fecha>=date(DATE_SUB(NOW(), INTERVAL 7 DAY)) order by p.id desc";
} elseif (isset($_POST["rango"])){
	$f1=$_POST["f1"];
	$f2=$_POST["f2"];
	$cond="where fecha>='$f1' AND fecha<='$f2' order by p.id desc";
}
elseif(isset($_POST["ultimos"])){
	$cond="order by p.id desc limit 10";
}


?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/abutton.css">
</head>
<body>
<?php require('menu.php'); ?>
<?php require('menuProd.php'); ?>
<h1>Corte a Largo</h1>
<?php
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}
if(isset($_SESSION["agregando"]))
       unset($_SESSION["agregando"]); // no abras formularios al entrar a revisar detalles
?>
<form method='POST'>
<input type=submit name=alta value='Nuevo Reporte'> 
ver: <input type=submit name=ultimos value='Ultimos 10'>
<input type=submit name=today value=Hoy>
<input type=submit name=semana value='7 Dias'>
o entre las fechas <input type=date name=f1> 
y <input type=date name=f2>
<input type=submit name=rango value='Ver'>
</form>

<?php
$q="select p.id, supervisores.nombre, fecha, sierraGemela, e1.nombre as operador, entrego, recibio, aplicadaEnInventario ".
	"from repoCL as p LEFT JOIN empleados as e1 on p.operador=e1.id ".
	"LEFT JOIN supervisores on p.supervisor=supervisores.id $cond";
//echo "<br>q: $q<br>\n";
$db=db::getInstance();
$db->query($q);
$t=new html_table();
$t->setbody($db->get_all());
$t->addextras( array(
	"Editar", 
		"<button class='green' type='submit' name='id' value='%f0%'>Revisar</button>", 
		array("id")
		)
);
$t->setcdatas(array("Ver"=>"Editar", "id"=>"id", "supervisor" => "nombre", "fecha" => "fecha", "# sierra"=>"sierraGemela", "operador"=>"operador", "entregó"=>"entrego", "recibió"=>"recibio","en<br>Inv"=>"aplicadaEnInventario"));
//$t->setFieldClas("Importe","class='alin-der'"); //campo=>id_class, p.e. 'id'=>"class='myclas'"
//$t->setFieldTotalizado("total", 0); // campo a totalizar, inicializado en 0
echo "<form action='clDetalle.php' method='GET'>\n";
$t->show();
echo "</form>\n";
?>
</body>
</html>


