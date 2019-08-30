<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
// borrar 2
require_once "Auth/proteger.php";
//require_once "funcs.php";

//$cond="order by p.id desc limit 10";
//$cond="where month(fecha)=month(now()) order by fecha desc";
$db=db::getInstance();
$cond="order by id desc limit 10";
$msg="Ultimos 10 capturados";
if(isset($_POST["id"])){  // borrar viaje de entrada de madera
	$id=$_POST['id'];
	$db->query("delete from entradasCD where id='$id'");
	$msg="Registro de entrada c.d. Eliminado";
}
elseif(isset($_POST["mes"])){
	$cond="where month(fecha)=month(now()) order by fecha desc";
	$msg="Este mes";
}
elseif(isset($_POST["today"])){
	$cond="where fecha=date(now()) order by id desc";
	$msg="solo el día de Hoy";
} elseif (isset($_POST["semana"])){
	$cond="where fecha<=date(NOW()) AND fecha>=date(DATE_SUB(NOW(), INTERVAL 7 DAY)) order by id desc";
	$msg="Ultimos 7 dias";
} elseif (isset($_POST["rango"])){
	$f1=$_POST["f1"];
	$f2=$_POST["f2"];
	$cond="where fecha>='$f1' AND fecha<='$f2' order by id desc";
	$msg="Entre $f1 y $f2";
}
elseif(isset($_POST["ultimos"])){
	$cond="order by id desc limit 10";
	$msg="Ultimos 10 capturados";
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
<?php require('menuRyR.php'); ?>
<h1>Entradas de Rollito Cortas Dimensiones</h1>
<?php
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}
if(isset($_SESSION["agregando"]))
       unset($_SESSION["agregando"]); // no abras formularios al entrar a revisar detalles
?>
<form method='POST'>
[<a href=provViajeCD.php>Capturar Viaje</a>] 
ver: <input type=submit name=mes value='Mes'> 
<input type=submit name=ultimos value='Ultimos 10'>
<input type=submit name=today value=Hoy>
<input type=submit name=semana value='7 Dias'>
o entre las fechas <input type=date name=f1> 
y <input type=date name=f2>
<input type=submit name=rango value='Ver'>
</form>
<?php
$q="select prov.nombre, pg.generoDimension as producto, i.id, i.fecha, i.remision, i.largoCDcm, i.vol_recibidoM3, i.vol_embarcadoM3, folioftal, i.precio ".
	"from entradasCD i LEFT JOIN provProductos prod ON i.producto=prod.id ".
	"LEFT JOIN provProcedencias proced ON prod.id_proced=proced.id ".
	"LEFT JOIN proveedores prov ON prod.id_prov=prov.id ".
	"LEFT JOIN provGeneros pg ON prod.generoDimension=pg.id ".
	"$cond ".
	"";
//echo "<br>q: $q<br>\n";
$db->query($q);
$t=new html_table();
$t->setbody($db->get_all());

$t->addextras( array(
	"Borrar", 
		"<button class='red' type='submit' name='id' value='%f0%'>Borrar</button>", 
		array("id")
		)
);

$t->setcdatas(array("Acción"=>"Borrar", "Producto"=>"producto", "largo"=>"largoCDcm", "Proveedor" => "nombre", "fecha" => "fecha", "Remision"=>"remision", "Precio"=>"precio", "Vol Rec"=>"vol_recibidoM3", "Vol Emb"=>"vol_embarcadoM3", "Folio Ftal"=>"folioftal"));
//$t->setFieldClas("Importe","class='alin-der'"); //campo=>id_class, p.e. 'id'=>"class='myclas'"
//$t->setFieldTotalizado("total", 0); // campo a totalizar, inicializado en 0
echo "<form method='POST'>\n";
if($msg!="") echo "$msg<br>\n";
$t->show();
echo "</form>\n";
?>
</body>
</html>


