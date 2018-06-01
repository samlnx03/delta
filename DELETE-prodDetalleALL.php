<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
//
// checar si ya fue inventariado y si es el caso solo mostrar items
// desaplicar en otro script especial para ello
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<script src="libs/jquery-3.3.1.min.js"></script>
<script LANGUAGE="JavaScript">
function dimensionada(){
    var x = document.getElementById("madera");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
function otros(){
    var x = document.getElementById("otros");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
</head>
<body>
<?php require('menu.php'); ?>
<h1>Detalle de reporte de Produccion</h1>
<?php
if(isset($_GET["id"])){
	$id=$_GET["id"];
	$_SESSION["idrepo"]=$id;
}else if(isset($_SESSION["idrepo"])){
	$id=$_SESSION["idrepo"];
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
$q="select fecha, e1.nombre as operador, e2.nombre as ayudante, aplicadaEnInventario from repoProd as r LEFT JOIN empleados as e1 on r.operador=e1.id LEFT JOIN empleados as e2 on r.ayudante=e2.id WHERE r.id='$id'";
$db->query($q);
$db->next_row();
$o=$db->f("operador");
$a=$db->f("ayudante");
$f=$db->f("fecha");
$readonly=$db->f("aplicadaEnInventario");
echo "Movimientos del Reporte No. <b>$id</b>. del día <b>$f</b> Operador: <b>$o</b>, Ayudante: <b>$a</b>\n";
//echo "<br>readonly: $readonly<br>\n";
if($readonly=='n'){
	require_once "repoMovsForm.php";
}else{
	require_once "repoMovs.php";
}
?>
</body>
</html>

