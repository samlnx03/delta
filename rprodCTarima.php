<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
//
// checar si hay reportes sin inventariar
//
//
if(isset($_POST['xtarimayarea'])){
	$f1=$_POST['f1'];
	$f2=$_POST['f2'];
	$rangoFechas="fecha>='$f1' AND fecha<='$f2'";
} else {
	$_SESSION["msg"]="Periodo de producción no especificado";
	header("Location: produccion.php");
	exit;
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<link rel="stylesheet" type="text/css" href="styles/abutton.css">
<script src="libs/jquery-3.3.1.min.js"></script>
</head>
<body>
<?php
require('menu.php');
require('menuReportes.php');
?>
<h1>Reporte de Clavado de Tarima</h1>
<?php
echo "<h3>Periodo del $f1 al $f2</h3>\n";
$db=db::getInstance();
$q="select a.descrip, supervisor, sum(m.cantidad) as cantidad ".
	"FROM repoCT r ".
	"LEFT JOIN movsRepoOtrasActiv as m ON r.id=m.idRepoCT ".
	"LEFT JOIN actividades as a ON m.actividad=a.clave ".
	"WHERE $rangoFechas AND proceso=3 group by descrip, supervisor";
//$q="select any_value(r.sierraCinta) as Sierra, any_value(t.especie), sum(m.cantidad*t.volpt) as vol FROM repoProd r LEFT JOIN movsRepoDimensionado as m ON r.id=m.idRepo LEFT JOIN actividades as a ON m.actividad=a.clave LEFT JOIN tablas as t ON m.idtabla=t.id WHERE fecha='2019-1-02' and r.sierraCinta=1 and a.proceso=1 group by especie ";
//$q="select r.fecha, r.id as Repo, r.sierraCinta as Sierra, m.cantidad, t.especie, t.descrip as dimensiones, m.cantidad*t.volpt as vol FROM repoProd r LEFT JOIN movsRepoDimensionado as m ON r.id=m.idRepo LEFT JOIN actividades as a ON m.actividad=a.clave LEFT JOIN tablas as t ON m.idtabla=t.id WHERE fecha='2018-5-31' and a.proceso=1 order by sierra,especie,grueso,ancho,largo";
//echo "$q<br>\n";
$db->query($q);
$t=new html_table();
//$t->setcdatas(array("cant" => "cantidad", "descrip"=>"descrip", "especie"=>"especie", "dimensiones"=>"dimensiones" ));
//$t->setFieldTotalizado("vol", 0); // campo a totalizar, inicializado en 0
$t->setbody($db->get_all());
$t->show();
//echo "Total volumen (pt): <b>".$t->getFieldTotalizado("vol")."</b><br>\n";
?>	
</body>
</html>
<!--
Aserrío Diario por máquina <a href=raserrio.php>Ver</a>
<br>
cantidad total diaria de piezas aserradas de cada dimension y especie
<br>
Pagos de destajos (jueves-miercoles)
<br>
Entradas y salidas de madera dimensionada
<br>
Inventario de materias primas
<br>
-->

