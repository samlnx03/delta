<?php
require_once "Auth/dbclass.php";
require_once "Auth/session.php";
require_once "Auth/table.php";

require_once "desarrollo.php";
/*
if(!isset($_POST["nueva"])){
        header('Location: madDimensionada.php');
        die();
}
 */
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<script src="js/cubicar.js"></script>
</head>
<body>
<?php require('menu.php'); 
$descrip='';
if(isset($_POST["descripcion"]))
	$descrip=$_POST["descripcion"];
?>
<h1>Nueva madera dimensionada</h1>
<?php
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}
?>
<form action='madDimensionadaAlta.php' method=POST>
Especie <input type=text name=especie onKeyUp="this.value = this.value.toUpperCase();" required> (pino, encino, etc.)
<br>
<?php
echo "<br>\n";
echo "Descripción (dimensiones) <input type=text id='descripcion' name=descripcion value='$descrip''
 size=50 onfocusout='analizadimensiones(this.value)'>\n";
echo "<br>\n";
echo "ejemplo1: <input type=text value='3/4x4x8 1/4' disabled>  ejemplo2: <input type=text value='1 1/2x4 1/2x120' disabled><br>\n";
echo "<br>\n";

?>
<br>
Rectifique medidas de ser necesario<br>
grueso <input type=text id='gruesoDecimal' name=grueso size=5 required>
<select id='ugrueso' name='ugrueso'>
<option id='ugruesoI' value='I'>Inches</option>
<option id='ugruesoC' value='C'>Cm.</option>
</select>

<?php //echo ifc("ugrueso");?> 
 ancho <input type=text id='anchoDecimal' name=ancho size=5 required>
<select id='uancho' name='uancho'>
<option id='uanchoI' value='I'>Inches</option>
<option id='uanchoC' value='C'>Cm.</option>
</select>

<?php //echo ifc("uancho");?> 
 largo <input type=text id='largoDecimal' name=largo size=5 required>
<?php //echo ifc("ulargo");?> 
<select id='ulargo' name='ulargo'>
<option id='ulargoI' value='I'>Inches</option>
<option id='ulargoF' value='F'>Feets</option>
<option id='ulargoC' value='C'>Cm.</option>
<option id='ulargoM' value='M'>Metros</option>
</select>
 <button onclick='recalcVol(); return false'>Recubicar</button>
<br>
<br>
Rectifique volumen en pie-tabla de ser necesario<br>
volumen <input id='volumenPT' type=text name=volumenPT size=5> (pie-tabla) 

<br>
<br>
<input type=submit name=agregar value='Agregar'>
</form>
<?php
/*
(id int not null auto_increment, especie char(10) not null, claveprod char(10) not null, descrip char(50) not null, grueso decimal(9,4) not null, ugrueso char(1) not null default 'i', ancho decimal(9,4) not null, uancho char(1) not null default 'i', largo decimal(9,4) not null, ulargo char(1) not null default 'i', volpt decimal(9,4) not null,  existen int, primary key(id), key(descrip), key(claveprod,descrip));

 */
?>

</body>
</html>
<?php
function ifcRadio($d){	// inches feet centimetros en la dimension grueso ancho o largo
	echo "$d<br><input type='radio' name='$d' value='pulgadas'> Pulgadas<br>".
		"<input type='radio' name='$d' value='pies'> Pies<br>".
		"<input type='radio' name='$d' value='centimetros'> Centimetros";
}
function htmlSelect($qry, $name, $val, $tit, $selected){
	$db=db::getInstance();
	$db->query($qry);
	$ops="<select name='$name'>\n";
	while($db->next_row()){
		$ops=$ops."<option ";
		if($db->f($val)==$selected){
			$ops.="selected ";
		}
		$ops.= "value='".$db->f("$val")."'>".$db->f($tit)."</option>\n";
	}
	$ops=$ops."</select>\n";
	return $ops;
}
function ifc($name){
	$ops="<select name='$name'>\n";
	$ops=$ops."<option id='$name"."I' value='i'>Inches</option>\n";
	$ops=$ops."<option id='$name"."F' value='f'>Feets</option>\n";
	$ops=$ops."<option id='$name"."C' value='c'>Cm.</option>\n";
	$ops=$ops."</select>\n";
	return $ops;
}
?>
