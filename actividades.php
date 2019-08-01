<?php

require_once "Auth/dbclass.php";
require_once "Auth/table.php";
// borrar 2

require_once "Auth/proteger.php";
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
	$q="select descrip, costo, inventario, proceso from actividades where clave='$clave'";
	$db->query($q);
	if($db->num_rows()>0){
		$existe=true;
		$db->next_row();
		$descrip=$db->f("descrip");
		$costo1=$db->f("costo");
		$inventario=$db->f("inventario");
		$proceso=$db->f("proceso");
	}
}
if(isset($_POST["alta"])){
	if(!$existe){
		$clave=$_POST["clave"];
		$descrip=$_POST["descrip"];
		$costo=htmlNpost("costo");
		$unidad=$_POST["unidad"];
		$unidadotro=$_POST["unidadotro"];
		//$tipo=$_POST["tipo"];
		if($unidad=="pie-tabla")
			$tipo="tabla";
		elseif($unidad=="tarima")
			$tipo="tarima";
		else
			$tipo="otro";
		$inventario=$_POST["inventario"];
		if($unidadotro!='') $unidad=$unidadotro;
		$proceso=htmlNpost("proceso");
		$q="insert into actividades (clave, descrip, costo, unidad, tipo, inventario,proceso) values ('$clave','$descrip',$costo,'$unidad','$tipo', '$inventario','$proceso')";
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
	if(isset($_POST["inventario"])){
		$inventario=htmlNpost("inventario");
		$proceso=htmlNpost("proceso");
		$q="update actividades set costo=$newvalue,inventario=$inventario, proceso=$proceso WHERE clave='$clave'";
	} else {
		$q="update actividades set costo=$newvalue WHERE clave='$clave'";
	}
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
	echo "actividad: <b>$actividad</b>: $descrip<br>\n";
	echo "<input type=hidden name=activ2change value='$actividad'>";
	echo " costo: <input type=text name=newCosto size=10 value='$costo1' required>";

        $q="select id from movsRepoDimensionado where actividad='$actividad' limit 1";
        $db->query($q);
        $mdim=$db->num_rows();
        $q="select id from movsRepoOtrasActiv where actividad='$actividad' limit 1";
        $db->query($q);
        $moa=$db->num_rows();
        if($mdim==0 AND $moa==0){
		echo "Inventario: ";
		//function htmlSelect($qry, $name, $val, $tit, $selected){
		$q="select substr(clave, -1,1) as value, valor as toshow from claveValor where clave like 'invent_'";
		$s=htmlSelect($q, "inventario", 'value', 'toshow', $inventario);
		echo $s;
		echo " Proceso: ";
		$q="select substr(clave, -1,1) as value, concat(substr(clave,-1,1), ' - ', valor) as toshow from claveValor where clave like 'proceso_'";
		$s=htmlSelect($q, "proceso", 'value', 'toshow', $proceso);
		echo $s;

/*$q="delete from actividades where clave='$clave'";
                $db->query($q);
                $nreg=$db->affected_rows();
		$_SESSION["msg"]="$nreg registro(s) eliminado(s)";*/
	}

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
descripcion: <input type=text name=descrip required>
<br>
costo: <input type=text name=costo size=10 required>
por: <select name='unidad'>
<option selected value='otro'>Otro</option>
<option value='pie-tabla'>pie-tabla</option>
<option value='M3'>M3</option>
<option value='tarima'>Tarima</option>
</select>
otro (especifique) <input type=text name=unidadotro size=10>
<!-- tipo es importante para el inventario de tablas -->
 (hora, bulto, pieza, etc.)
<br>
Inventario: 
<?php
//function htmlSelect($qry, $name, $val, $tit, $selected){
$q="select substr(clave, -1,1) as value, valor as toshow from claveValor where clave like 'invent_'";
$s=htmlSelect($q, "inventario", 'value', 'toshow', '0');
echo $s;
echo " Proceso: ";
$q="select substr(clave, -1,1) as value, concat(substr(clave,-1,1), ' - ', valor) as toshow from claveValor where clave like 'proceso_'";
$s=htmlSelect($q, "proceso", 'value', 'toshow', '0');
echo $s;
?>
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
		"<button class='red' type='submit' name='cambiaCosto' value='%f0%'>Modif</button>", 
		array("clave")
		)
	);
	$t->setcdatas(array("Acción"=>"Acción", "clave"=>"clave", "descripcion" => "descrip", "costo"=>"costo", "unidad"=>"unidad", "inv"=>"inventario", "Proc"=>"proceso", "cambiar"=>"cambiar"));
	//echo "q:$q<br>";
	echo "<form method='POST'>\n";
	$t->show();
	echo "</form>\n";
?>
</div>

</body>
</html>

