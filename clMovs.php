<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
//
// solo mostrar items  reporte de corte a largo
// desaplicar en otro script especial para ello
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<script src="libs/jquery-3.3.1.min.js"></script>
</head>
<body>
<?php require('menu.php');
require("menuProd.php");
?>
<h1>Detalle de reporte de Corte a Largo</h1>
<?php
if(isset($_GET["id"])){
	$id=$_GET["id"];
	$_SESSION["idrepocl"]=$id;
}else if(isset($_SESSION["idrepocl"])){
	$id=$_SESSION["idrepocl"];
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
$q="select fecha, sierraGemela, e1.nombre as operador, aplicadaEnInventario from repoCL as r LEFT JOIN empleados as e1 on r.operador=e1.id WHERE r.id='$id'";
$db->query($q);
$db->next_row();
$o=$db->f("operador");
$f=$db->f("fecha");
$sg=$db->f("sierraGemela");
$readonly=$db->f("aplicadaEnInventario");
echo "Movimientos del Reporte No. <b>$id</b>. del día <b>$f</b> Sierra Gemela: <b>$sg</b><br>Operador: <b>$o</b>\n";
	// mostrar movimeintos de madera dimensionada
	$q="select d.id, d.cantidad, a.descrip, t.especie, t.descrip as dimensiones from movsRepoCL as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN tablas as t ON d.idtabla=t.id WHERE d.idRepoCL='$id'";
	//echo "$q<br>\n";
	$db->query($q);
	$t=new html_table();
	$t->setcdatas(array("cant" => "cantidad", "descrip"=>"descrip", "especie"=>"especie", "dimensiones"=>"dimensiones" ));
	$t->setbody($db->get_all());
	$t->show();
	echo "<br>\n";
	// mostrar movimientos de otros destajos
	$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepoCL='$id'";
	$db->query($q);
	$t=new html_table();
  	$t->setcdatas(array("cant" => "cantidad", "unidad"=>"unidad", "descrip"=>"descrip","empleado"=>"nombre" ));
	$t->setbody($db->get_all());
	$t->show();
	unset($_SESSION["idrepocl"]);
?>
</body>
</html>
