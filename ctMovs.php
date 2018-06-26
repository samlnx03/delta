<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
//
// solo mostrar items
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
require('menuProd.php');
?>

<h1>Detalle de reporte de Clavado de Tarima</h1>
<?php
if(isset($_GET["id"])){
	$id=$_GET["id"];
	$_SESSION["idrepoct"]=$id;
}else if(isset($_SESSION["idrepoct"])){
	$id=$_SESSION["idrepoct"];
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
$q="select fecha, supervisor, aplicadaEnInventario from repoCT as r WHERE r.id='$id'";
$db->query($q);
$db->next_row();
$f=$db->f("fecha");
$s=$db->f("supervisor");
$readonly=$db->f("aplicadaEnInventario");
echo "Movimientos del Reporte No. <b>$id</b>. del día <b>$f</b><br>Supervisor: <b>$s</b><br>\n";

// mostrar movimientos del reporte de clavado de Tarima
$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepoCT='$id'  AND a.proceso=3";
//echo "$q<br>\n";
$db->query($q);
$t=new html_table();
$t->setcdatas(array("cant" => "cantidad", "unidad"=>"unidad", "descrip"=>"descrip","empleado"=>"nombre" ));
$t->setbody($db->get_all());
echo "<br>\n";
echo "<b>Clavado de Tarimas</b><br>\n";
$t->show();
echo "<br>\n";
// mostrar movimientos del reporte de otros destajos en reporte de clavado de Tarima
$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepoCT='$id'  AND a.proceso=0";
//echo "$q<br>\n";
$db->query($q);
$t=new html_table();
$t->setcdatas(array("cant" => "cantidad", "unidad"=>"unidad", "descrip"=>"descrip","empleado"=>"nombre" ));
$t->setbody($db->get_all());
echo "<b>Otros Destajos</b><br>\n";
$t->show();
echo "<br>\n";
unset($_SESSION["idrepoct"]);
?>
</body>
</html>
