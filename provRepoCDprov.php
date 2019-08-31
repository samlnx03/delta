<?php
//		RESUMEN Y DESGLOSE POR GENERO
require_once "Auth/session.php";
require_once "Auth/table.php";
// borrar 2
require_once "Auth/proteger.php";
require_once "funcs.php";

if(!isset($_SESSION['f1'])){
	header('Location: provRepoCD.php');
	exit;
}
$f1=$_SESSION["f1"];
$f2=$_SESSION["f2"];

$db=db::getInstance();


if(isset($_GET['p'])){
	// consutar deglose de un proveedor genero y largo
	$tiporepo=1;
}
elseif(isset($_GET['t'])){
	// consultar todo el desglose
	$tiporepo=2;
} else {
	// resumen
	$tiporepo=0;
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
<h1>Reporte de Entradas de Rollito Cortas Dimensiones</h1>
<h3>Resumen por proveedores</h3>
<?php
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}
?>
<?php
$t=new html_table();
$cond="fecha>='$f1' AND fecha<='$f2'";
if($tiporepo==0){
	// RESUMEN
$qr="select i.producto as iprod, count(*) as viajes, prov.nombre, pg.generoDimension as producto, i.largoCDcm, sum(i.vol_recibidoM3) as vol_recibidoM3, sum(i.vol_embarcadoM3) as vol_embarcadoM3, sum(i.precio*i.vol_recibidoM3) as importe ".
"from entradasCD i LEFT JOIN provProductos prod ON i.producto=prod.id ".
"LEFT JOIN provProcedencias proced ON prod.id_proced=proced.id ".
"LEFT JOIN proveedores prov ON prod.id_prov=prov.id ".
"LEFT JOIN provGeneros pg ON prod.generoDimension=pg.id ".
"WHERE $cond ".
"GROUP BY prov.id, producto,largoCDcm ".
"";
$t->setcdatas(array("Detalle"=>"ver", "Viajes"=>"viajes", "Prov"=>"nombre", "Producto"=>"producto", "largo"=>"largoCDcm", "Vol emb"=>"vol_embarcadoM3", "Vol Rec"=>"vol_recibidoM3", "Importe"=>"importe" ));
$t->addextras( array(
	"ver", 
		"<a class='button-green' style='font-size:small;' href='?p=%f0%&l=%f1%'>Revisar</a>", 
		array("iprod","largoCDcm")
		)
);
}elseif($tiporepo==1){
        // DESGLOSE DE 1 proveedor GENERO y LONGITUD
$iprod=$_GET['p'];  // la clave del producto del proveedor
$long=$_GET['l'];
$cond.=" AND i.producto='$iprod' AND i.largoCDcm='$long'";

$qr="select prov.nombre, proced.procedencia, pg.generoDimension as producto, i.id, i.fecha, i.remision, i.largoCDcm, i.vol_recibidoM3, i.vol_embarcadoM3, i.precio, i.folioftal, i.precio*i.vol_recibidoM3 as importe ".
"from entradasCD i LEFT JOIN provProductos prod ON i.producto=prod.id ".
"LEFT JOIN provProcedencias proced ON prod.id_proced=proced.id ".
"LEFT JOIN proveedores prov ON prod.id_prov=prov.id ".
"LEFT JOIN provGeneros pg ON prod.generoDimension=pg.id ".
"WHERE $cond ".
"";
$t->setcdatas(array("Prov"=>"nombre", "Procedencia"=>"procedencia", "fecha"=>"fecha", "Rem"=>"remision", "FolioFtal"=>"folioftal","Producto"=>"producto", "largo"=>"largoCDcm", "Vol emb"=>"vol_embarcadoM3", "Vol Rec"=>"vol_recibidoM3", "Precio"=>"precio", "Importe"=>"importe" ));
}else{
        // DESGLOSE TOTAL TIPO=2
$qr="select prov.nombre, proced.procedencia, pg.generoDimension as producto, i.id, i.fecha, i.remision, i.largoCDcm, i.vol_recibidoM3, i.vol_embarcadoM3, i.precio, i.folioftal, i.precio*i.vol_recibidoM3 as importe ".
"from entradasCD i LEFT JOIN provProductos prod ON i.producto=prod.id ".
"LEFT JOIN provProcedencias proced ON prod.id_proced=proced.id ".
"LEFT JOIN proveedores prov ON prod.id_prov=prov.id ".
"LEFT JOIN provGeneros pg ON prod.generoDimension=pg.id ".
"WHERE $cond ".
"ORDER BY prov.id, producto,largoCDcm ".
"";
$t->setcdatas(array("Prov"=>"nombre", "Procedencia"=>"procedencia", "fecha"=>"fecha", "Rem"=>"remision", "FolioFtal"=>"folioftal","Producto"=>"producto", "largo"=>"largoCDcm", "Vol emb"=>"vol_embarcadoM3", "Vol Rec"=>"vol_recibidoM3", "Precio"=>"precio", "Importe"=>"importe" ));
}
/*
$qr="select count(*) as viajes, pg.generoDimension as producto, prod.generoDimension as idprod, i.largoCDcm, sum(i.vol_recibidoM3) as vol_recibidoM3, sum(i.vol_recibidoM3*i.precio) as importe ".
"from entradasCD i LEFT JOIN provProductos prod ON i.producto=prod.id ".
"LEFT JOIN provGeneros pg ON prod.generoDimension=pg.id ".
"WHERE $cond ".
"GROUP BY producto,largoCDcm ".
"";
 */
$msg="Entre las fechas <b>$f1</b> y <b>$f2</b>";
//echo "<br>qr: $qr<br>\n";
$db->query($qr);
$t->setbody($db->get_all());

//$t->setFieldClas("Importe","class='alin-der'"); //campo=>id_class, p.e. 'id'=>"class='myclas'"
//$t->setFieldTotalizado("total", 0); // campo a totalizar, inicializado en 0
if($msg!="") echo "$msg<br>\n";
$t->show();
if($tiporepo==0) // resumen
	echo "<br><a class='button-green' href='?t=1'>Ver Todos</a><br>\n";
else // desglose total
	echo "<br><a class='button-green' href='?'>Ver Resumen</a><br>\n";
?>
</body>
</html>
