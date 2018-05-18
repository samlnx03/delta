<?php
require_once "Auth/dbclass.php";
require_once "Auth/table.php";

require_once "desarrollo.php"; // reporta errores

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<script LANGUAGE="JavaScript">
</script>
</head>
<body>
<?php require('menu.php'); ?>
<h1>Madera Dimensionada</h1>
<?php
$descrip="";
$results=0; // hay resultados de la consulta
if(isset($_POST["buscar"])){
	$descrip=$_POST["descripcion"];
	//$q="select id, especie, claveprod, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt, existen from tablas where descrip like '$descrip%'";
	$q="select id, especie, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt from tablas where descrip like '$descrip%'";
	$db=db::getInstance();
	$db->query($q);
	if($db->num_rows()==0){
		echo "<div class='mensaje'>No encontrado</div>";
	} else 
		$results=1;
}
?>
<form method=POST>
Dimensiones <input type=text name=descripcion <?php echo "value='$descrip' ";?> size=50>
<input type=submit name=buscar value='Buscar'>
</form>

<?php
echo "<form action=madDimensionadaNueva.php method=post>\n";
echo "<input type=hidden name=descripcion value='$descrip'>\n";
echo "<input type=submit name=nueva value=Agregar>\n";
echo "</form>\n";

if($results){
	$t=new html_table();
	$t->setbody($db->get_all());
	$t->show();
}
?>
</body>
</html>

