<?php
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

$proceso=NULL;
if(isset($_POST['destajos_proceso'])) 
	$proceso=$_POST['destajos_proceso'];

if($proceso==1)
	$trepo="<h1>Reporte de destajos de Aserrío</h1>\n";
elseif($proceso==2)
	$trepo="<h1>Reporte de destajos de Corte a Largo</h1>\n";
elseif($proceso==3)
	$trepo="<h1>Reporte de destajos de Clavado de Tarimas</h1>\n";
elseif($proceso==0)
	$trepo="<h1>Reporte de Otros Destajos</h1>\n";
else
	$trepo="<h1>Ups, esto no debia pasar!</h1>\n";

if(isset($_POST['todosRepos'])){
	$f1=$_POST['f1'];
	$f2=$_POST['f2'];
	echo "$trepo\n";
	echo "Periodo del $f1 al $f2<br>\n";
	if($proceso==1 ||  $proceso==2)
		$acumula="sum(volpt) as volumen";
	elseif($proceso==3)
		$acumula="sum(cantidad) as cant";
	elseif($proceso==0)
		$acumula="sum(cantidad) as activ";
	$q="select any_value(nombre) as nombre, $acumula, sum(destajo) as destajo from destajos where proceso='$proceso' group by nombre";

}
elseif(isset($_POST['xrepo'])){
	$nrepo=htmlNpost('nrepo');
	$q="select * from destajos where proceso='$proceso' AND idRepo=$nrepo";
	echo "$trepo\n";
	echo "Reporte $nrepo<br>\n";
	//$q="select any_value(nombre) as nombre, sum(volpt) as volumen, sum(destajo) as destajo from destajos where idRepo=$nrepo group by nombre";
}
elseif(isset($_POST['xempleado'])){
	$persona=htmlNpost('empleado');
	$f1=$_POST['f1'];
	$f2=$_POST['f2'];
	$q="select * from destajos where proceso='$proceso' AND empleado=$persona";
	echo "$trepo\n";
	echo "Reporte del trabajador $persona, del $f1 al $f2<br>\n";
}
elseif(isset($_POST['rasdesglo'])){  // reporte de aserrio desglosado
	require_once("destaASrepoDesglo.php");
	exit;

}
elseif(isset($_POST['rctdesglo'])){  // reporte de clavado de tarima desglosado
	require_once("destaCTrepoDesglo.php");
	exit;

}
elseif(isset($_POST['roddesglo'])){  // reporte otros destajos desglosado
	require_once("destaODrepoDesglo.php");
	exit;
}

//$q="select any_value(r.sierraCinta) as Sierra, any_value(t.especie), sum(m.cantidad*t.volpt) as vol FROM repoProd r LEFT JOIN movsRepoDimensionado as m ON r.id=m.idRepo LEFT JOIN actividades as a ON m.actividad=a.clave LEFT JOIN tablas as t ON m.idtabla=t.id WHERE fecha='2018-5-31' and r.sierraCinta=1 and a.proceso=1 group by especie ";
//$q="select r.fecha, r.id as Repo, r.sierraCinta as Sierra, m.cantidad, t.especie, t.descrip as dimensiones, m.cantidad*t.volpt as vol FROM repoProd r LEFT JOIN movsRepoDimensionado as m ON r.id=m.idRepo LEFT JOIN actividades as a ON m.actividad=a.clave LEFT JOIN tablas as t ON m.idtabla=t.id WHERE fecha='2018-5-31' and a.proceso=1 order by sierra,especie,grueso,ancho,largo";
//echo "$q<br>\n";
$db->query($q);
$t=new html_table();
//$t->setcdatas(array("cant" => "cantidad", "descrip"=>"descrip", "especie"=>"especie", "dimensiones"=>"dimensiones" ));
$t->setbody($db->get_all());
$t->show();
?>	
</body>
</html>

