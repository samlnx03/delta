<?php

require_once "Auth/dbclass.php";
require_once "Auth/table.php";
// borrar 2
//require_once "Auth/proteger.php";
//require_once "funcs.php";

// alta
$db=db::getInstance();
$cond="";
if(isset($_POST["opcion"])){
	$opcion=$_POST["opcion"];
	$nombre=$_POST["nombre"];
	if($opcion=="Agregar"){
		$q="insert into empleados (nombre) values ('$nombre')";
        	$db->query($q);
	} elseif($opcion=="Buscar"){
		$cond=" where nombre like '%$nombre%'";
	}
} else if(isset($_POST["borrar"])){
	$id=$_POST["borrar"];
	$q="select id from prodSierrasCintas where operador='$id' or ayudante='$id'";
        $db->query($q);
	if($db->num_rows()==0){
		$q="delete from empleados where id='$id'";
		//$_SESSION["msg"]="$q";
		$db->query($q);
	} else {
		$_SESSION["msg"]="El empleado tiene registros de produccion";
	}
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
<h1>Empleados</h1>
<?php
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}
?>
<div id="altas">
<form method=POST>
nombre: <input type=text name=nombre size=60>
<input type=submit name=opcion value=Agregar>
<input type=submit name=opcion value=Buscar>
</form>
</div>


<div id="lista">
<?php
//<div id="lista" style="overflow:scroll">
        $q="select id, nombre from empleados $cond order by id desc";
        $t=new html_table();
	$t->addextras( array(
		"Acción", 
		"<button class='red' type='submit' name='borrar' value='%f0%'>Borrar</button>", 
		array("id")
		)
	);
	$t->setcdatas(array("Acción"=>"Acción", "id"=>"id", "nombre" => "nombre"));
	//echo "q:$q<br>";
        $db->query($q);
        $t->setbody($db->get_all());
	echo "<form method=POST>\n";
	$t->show();
	echo "</form>\n";
?>
</div>

</body>
</html>

