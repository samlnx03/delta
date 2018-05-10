<?php

require_once "Auth/dbclass.php";
require_once "Auth/table.php";
// borrar 2

//require_once "Auth/proteger.php";
require_once "funcs.php";
require_once "desarrollo.php"; // debug

// alta
// clave char(10), descrip char(50), costo Decimal(9,4), unidad char(10)
$db=db::getInstance();
$cond="";
if(isset($_POST["alta"])){
	$clave=$_POST["clave"];
	$descrip=$_POST["descrip"];
	$costo=htmlNpost("costo");
	$unidad=$_POST["unidad"];
	$q="insert into clavesActividad (clave, descrip, costo, unidad) values ('$clave','$descrip',$costo,'$unidad')";
        $db->query($q);
	$_SESSION["msg"]="No borrado porque existe producción";
} else if(isset($_POST["borrar"])){
	$clave=$_POST["borrar"];
	$q="select id from prodSierrasCintasMovs where clave='$clave' limit 1";
        $db->query($q);
	if($db->num_rows()==0){
		$q="delete from clavesActividad where clave='$clave'";
		//$_SESSION["msg"]="$q";
		$db->query($q);
	} else {
		$_SESSION["msg"]="No borrado porque existe producción";
	}
}
?>
<html lang='es'>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/abutton.css">
</head>




<body>
<?php require('menu.php'); ?>
<h1>Actividades de producción</h1>

<div id="altas">
<form method='POST'>
Nueva actividad:<br>
clave: <input type=text name=clave size=10 required>
descripcion: <input type=text name=descrip required>
<br>
costo: <input type=text name=costo size=10 required>
por <input type=text name=unidad required>
(pieza, m3, pies, hora, dia, etc)
<br>
<input type=submit name=alta value=Agregar>
</form>
</div>


<div id="lista">
<?php
//<div id="lista" style="overflow:scroll">
        $q="select * from clavesActividad";
        $db=db::getInstance();
        $db->query($q);
        $t=new html_table();
        $t->setbody($db->get_all());
	$t->addextras( array(
		"Acción", 
		"<button class='red' type='submit' name='borrar' value='%f0%'>Borrar</button>", 
		array("clave")
		)
	);
	$t->setcdatas(array("Acción"=>"Acción", "clave"=>"clave", "descripcion" => "descrip", "costo"=>"costo", "unidad"=>"unidad"));
	//echo "q:$q<br>";
	echo "<form method='POST'>\n";
	$t->show();
	echo "</form>\n";
?>
</div>

</body>
</html>

