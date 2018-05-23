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
}
if(isset($_POST["cambiaCosto"])){
	$clave=$_POST["cambiaCosto"];
}
$existe=false;
if(isset($clave)){
	$q="select descrip from actividades where clave='$clave'";
	$db->query($q);
	if($db->num_rows()>0){
		$existe=true;
		$db->next_row();
		$descrip=$db->f("descrip");
	}
}
if(isset($_POST["alta"])){
	if(!$existe){
		$clave=$_POST["clave"];
		$descrip=$_POST["descrip"];
		$costo=htmlNpost("costo");
		$unidad=$_POST["unidad"];
		$tipo=$_POST["tipo"];
		$q="insert into actividades (clave, descrip, costo, unidad, tipo) values ('$clave','$descrip',$costo,'$unidad','$tipo')";
		$db->query($q);
		$nreg=$db->affected_rows();
		$_SESSION["msg"]="$nreg registro(s) insertado(s)";
	} else {
		$_SESSION["msg"]="Ya existe la clave $clave";
	}
} else if(isset($_POST["borrar"])){
        $clave=$_POST["borrar"];
        $q="select id from movsRepoDimensionado where actividad='$clave' limit 1";
        $db->query($q);
        $mdim=$db->num_rows();
        $q="select id from movsRepoOtrasActiv where actividad='$clave' limit 1";
        $db->query($q);
        $moa=$db->num_rows();
        if($mdim==0 AND $moa==0){
                $q="delete from actividades where clave='$clave'";
                $db->query($q);
                $nreg=$db->affected_rows();
                $_SESSION["msg"]="$nreg registro(s) eliminado(s)";
        } else {
                $_SESSION["msg"]="No borrado porque existe producción";
        }
} else if(isset($_POST["okCambiaCosto"])){
	$clave=htmlpost("activ2change");
	$newvalue=htmlNpost("newCosto");
	$q="update actividades set costo=$newvalue WHERE clave='$clave'";
	$db->query($q);
	$_SESSION["msg"]=$db->affected_rows()." Renglon(es) actualizado(s)";
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
<?php
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}

if(isset($_POST["cambiaCosto"])){
	$actividad=$_POST["cambiaCosto"];
	echo "<form method='POST'>\n";
	echo "actividad: $actividad: $descrip<br>\n";
	echo "<input type=hidden name=activ2change value='$actividad'>";
	echo " costo: <input type=text name=newCosto size=10 required>";
	echo "<input type=submit name=okCambiaCosto value=Actualizar>\n";
	echo "</form>\n";
	echo "</body></html>\n";
	exit;
}
?>
<div id="altas">
<form method='POST'>
Nueva actividad:<br>
clave: <input type=text name=clave size=10 maxlength=10 required>
<!-- tipo es importante para el inventario de tablas -->
tipo: <select name='tipo'>
<option selected value='otro'>1 Otro</option>
<option value='tabla'>2 Tablas</option>
<option value='tarima'>3 Tarimas</option>
</select>
descripcion: <input type=text name=descrip required>
<br>
costo: <input type=text name=costo size=10 required>
por <input type=text name=unidad size=10 required>
(pie-tabla, tarima, hora, bulto, etc.)
<br>
Especifique <b>pie-tabla</b> para madera dimensionada pagada por volumen en pie-tabla
<br>
Especifique <b>tarima</b> para clavado de tarima por pieza
<br>
<input type=submit name=alta value=Agregar>
</form>
</div>


<div id="lista">
<?php
//<div id="lista" style="overflow:scroll">
        $q="select * from actividades";
        $db=db::getInstance();
        $db->query($q);
        $t=new html_table();
        $t->setbody($db->get_all());
	$t->addextras( 
		array(
		"Acción", 
		"<button class='red' type='submit' name='borrar' value='%f0%'>Borrar</button>", 
		array("clave")
		)
	);
	$t->addextras( 
		array(
		"cambiar", 
		"<button class='red' type='submit' name='cambiaCosto' value='%f0%'>costo</button>", 
		array("clave")
		)
	);
	$t->setcdatas(array("Acción"=>"Acción", "clave"=>"clave", "descripcion" => "descrip", "costo"=>"costo", "cambiar"=>"cambiar", "unidad"=>"unidad", "tipo"=>"tipo"));
	//echo "q:$q<br>";
	echo "<form method='POST'>\n";
	$t->show();
	echo "</form>\n";
?>
</div>

</body>
</html>

