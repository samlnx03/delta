<?php
require_once "Auth/session.php";
require_once "Auth/table.php";

//	Clavado de taria, Listado de reportes
//
//$cond="order by p.id desc limit 10";
$cond="where month(fecha)=month(now()) order by fecha desc";
if(isset($_POST["alta"])){
        header('Location: ctNuevoRepo.php');
        die();
}
elseif(isset($_POST["mes"])){
	$cond="where month(fecha)=month(now()) order by fecha desc";
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

if(isset($_SESSION["idrepoct"])){
	unset($_SESSION["idrepoct"]);
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
<h1>Reportes de Clavado de Tarima</h1>
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


<!-- Aqui voy -->
ver: <input type=submit name=mes value='Mes'>  
<input type=submit name=ultimos value='Ultimos 10'>
<input type=submit name=today value=Hoy>
<input type=submit name=semana value='7 Dias'>
o entre las fechas <input type=date name=f1> 
y <input type=date name=f2>
<input type=submit name=rango value='Ver'>
</form>

<?php
$q="select p.id, supervisores.nombre, fecha, aplicadaEnInventario from ".
	"repoCT as p LEFT JOIN supervisores on p.supervisor=supervisores.id $cond";
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
$t->setcdatas(array("Ver"=>"Editar", "id"=>"id", "supervisor" => "nombre", "fecha" => "fecha",
       "en<br>Inv"=>"aplicadaEnInventario"));
//$t->setFieldClas("Importe","class='alin-der'"); //campo=>id_class, p.e. 'id'=>"class='myclas'"
//$t->setFieldTotalizado("total", 0); // campo a totalizar, inicializado en 0
echo "<form action='ctDetalle.php' method='GET'>\n";
$t->show();
echo "</form>\n";
?>
</body>
</html>


