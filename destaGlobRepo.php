<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
//
// checar si hay reportes sin inventariar
//
//
// reporte de destajos de aserrio de madera dimensionada
//
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<link rel="stylesheet" type="text/css" href="styles/abutton.css">
</head>
<body>
<?php 
require('menu.php');
require('menuReportes.php');
?>
<?php
$db=db::getInstance();


$f1=$_POST['f1'];
$f2=$_POST['f2'];
echo "<h1>Reporte Global de destajos de $f1 a $f2</h1>\n";

if(isset($_POST['condensado'])){
	$q="select nombre, 
		sum(case when proceso=1 then destajo end) as Aserrio, 
		sum(case when proceso=2 then destajo end) as Corte_a_largo, 
		sum(case when proceso=3 then destajo end) as Clavado_tarima, 
		sum(case when proceso=0 then destajo end) as Otros_destajos,
		sum(destajo) as suma
		FROM destajos group by nombre";
	$db->query($q);
	if($db->num_rows()>0){
		echo "Condensado de destajos<br>\n";
		$t=new html_table();
		$t->setFieldTotalizado("Aserrio", 0); // campo a totalizar, inicializado en 0
		$t->setFieldTotalizado("Corte_a_largo", 0); // campo a totalizar, inicializado en 0
		$t->setFieldTotalizado("Clavado_tarima", 0); // campo a totalizar, inicializado en 0
		$t->setFieldTotalizado("Otros_destajos", 0); // campo a totalizar, inicializado en 0
		$t->setFieldTotalizado("suma", 0); // campo a totalizar, inicializado en 0
		$t->setbody($db->get_all());
		$t->show();
		echo "Totales: Aserrio:".number_format($t->getFieldTotalizado("Aserrio"),2).", 
			Corte a largo:".number_format($t->getFieldTotalizado("Corte_a_largo"),2).",
			Clavado de tarima:".number_format($t->getFieldTotalizado("Clavado_tarima"),2).",
			Otros destajos:".number_format($t->getFieldTotalizado("Otros_destajos"),2)."<br>\n";
		echo "<b>Gran total: ".number_format($t->getFieldTotalizado("suma"),2)."</b><br>\n";
		echo "<br>\n";
	}
	echo "</body></html>";
	exit;
}
elseif(isset($_POST['todosRepos'])){
	$q="SELECT distinct nombre,empleado from destajos order by nombre";
}
else  {
	$persona=htmlNpost('empleado');
        $q="select distinct nombre,empleado from destajos where empleado=$persona";
}
$db->query($q);
$trabajadores=$db->get_all();

foreach($trabajadores as $persona){
	$numemp=$persona['empleado']."<br>\n";

	$proceso=1; // aserrio
	$acumula="sum(volpt) as volumen";

	$q="select * from destajos where proceso='$proceso' AND empleado='$numemp'";
	echo "<b>".$persona['nombre']."</b><br>\n";
	$db->query($q);
	if($db->num_rows()>0){
		echo "Destajos de Aserrio<br>\n";
		$t=new html_table();
		$t->setcdatas(array("fecha" => "fecha", "pctj" => "pctj", "activ"=>"activ", "cantidad"=>"cantidad", "especie"=>"especie", "medidas"=>"medidas", "vol_pt"=>"volpt", "costo"=>"costo", "destajo"=>"destajo"));
		$t->setFieldTotalizado("volpt", 0); // campo a totalizar, inicializado en 0
		$t->setFieldTotalizado("destajo", 0); // campo a totalizar, inicializado en 0
		$t->setbody($db->get_all());
		$t->show();
		echo "Total: <b>".$t->getFieldTotalizado("volpt")." pie-tabla. $".number_format($t->getFieldTotalizado("destajo"),2)."</b>\n";
		echo "<br>\n";
	}
/*
	$q="select any_value(activ) as Actividad, $acumula, any_value(costo) as unitario, sum(destajo) as destajo from destajos where proceso='$proceso' AND empleado='$numemp' group by activ";
	echo "<b>".$persona['nombre']."</b><br>\n";
	$db->query($q);
	if($db->num_rows()>0){
		echo "Destajos de Aserrio<br>\n";
		$t=new html_table();
		$t->setFieldTotalizado("volumen", 0); // campo a totalizar, inicializado en 0
		$t->setFieldTotalizado("destajo", 0); // campo a totalizar, inicializado en 0
		$t->setbody($db->get_all());
		$t->show();
		echo "Total: <b>".$t->getFieldTotalizado("volumen")." pie-tabla. $".number_format($t->getFieldTotalizado("destajo"),2)."</b>\n";
		echo "<br>\n";
	} */
	$proceso=2; // corte a largo
	$acumula="sum(volpt) as volumen";
	$q="select any_value(activ) as Actividad, $acumula, any_value(costo) as unitario, sum(destajo) as destajo from destajos where proceso='$proceso' AND empleado='$numemp' group by activ";
	$db->query($q);
	if($db->num_rows()>0){
		echo "Destajos de Corte a largo<br>\n";
		$t=new html_table();
		$t->setFieldTotalizado("volumen", 0); // campo a totalizar, inicializado en 0
		$t->setFieldTotalizado("destajo", 0); // campo a totalizar, inicializado en 0
		$t->setbody($db->get_all());
		$t->show();
		echo "Total: <b>".$t->getFieldTotalizado("volumen")." pie-tabla. $".number_format($t->getFieldTotalizado("destajo"),2)."</b>\n";
		echo "<br>\n";
	}
	$proceso=3; // clavado de tarima
	$acumula="sum(cantidad) as cant";
	$q="select activ as Actividad, $acumula, any_value(costo) as unitario, sum(destajo) as destajo from destajos where proceso='$proceso' AND empleado='$numemp' group by activ";
	$db->query($q);
	if($db->num_rows()>0){
		echo "Destajos de Clavado de Tarimas<br>\n";
		$t=new html_table();
		$t->setFieldTotalizado("cant", 0); // campo a totalizar, inicializado en 0
		$t->setFieldTotalizado("destajo", 0); // campo a totalizar, inicializado en 0
		$t->setbody($db->get_all());
		$t->show();
		echo "Total: <b>".$t->getFieldTotalizado("cant")." piezas. $".number_format($t->getFieldTotalizado("destajo"),2)."</b>\n";
		echo "<br>\n";
	}
	$proceso=0; // otros destajos
	$acumula="sum(cantidad) as cantidad";
	$q="select activ as Actividad, $acumula, any_value(costo) as unitario, sum(destajo) as destajo from destajos where proceso='$proceso' AND empleado='$numemp' group by activ";
	$db->query($q);
	if($db->num_rows()>0){
		echo "Otros Destajos<br>\n";
		$t=new html_table();
		$t->setFieldTotalizado("destajo", 0); // campo a totalizar, inicializado en 0
		$t->setbody($db->get_all());
		$t->show();
		echo "Total: <b>".number_format($t->getFieldTotalizado("destajo"),2)."</b>\n";
		echo "<br>\n";
	}

	echo "<br>\n";
}
?>	
</body>
</html>

