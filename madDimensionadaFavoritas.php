<?php
require_once "Auth/session.php";
require_once "Auth/table.php";

require_once "desarrollo.php"; // reporta errores

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
<?php require('menu.php'); ?>
<h1>Madera Dimensionada (favoritas)</h1>
<?php

$db=db::getInstance();
if(isset($_POST["borrar"])){
	$idtabla=$_POST["borrar"];
	$usuario=$_POST["usuario"]; // cambiar al user_id de la session
	$q="delete from favoritablas where usuario='$usuario' AND idtabla='$idtabla'";
	//echo "q:$q<br>\n";
	$db->query($q);
	if($db->affected_rows()>0) {
		echo "<div class='mensaje'>Favorita eliminada</div>";
	}
}
$q="select usuario, idtabla, especie, descrip, volpt from favoritablas f LEFT JOIN tablas t ON f.idtabla=t.id WHERE usuario='sam' ORDER BY descrip";
$db->query($q);
if($db->num_rows()==0){
	echo "<div class='mensaje'>No hay favoritas</div>";
}

$t=new html_table();
$t->setTclas("Txml"); // table class
$t->setbody($db->get_all());
$t->addextras( array(
	"IO", 
	"<button class='red' type='submit' name='borrar' value='%f0%'>Borrar</button>", 
	array("idtabla")
	)
);
$t->setcdatas(array("Borrar"=>"IO", "usuario"=>"usuario", "id"=>"idtabla", 
	"Especie"=>"especie", "Descrip"=>"descrip",
	"volpt"=>"volpt"
	)
);
echo "<form method=POST>\n";
$t->show();
echo "<input type=hidden name=usuario value='sam'>\n";
echo "</form>\n";
?>
</body>
</html>

