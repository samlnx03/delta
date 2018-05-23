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
<script LANGUAGE="JavaScript">
function analizadimensiones(d){
	var res;
	var nd;
        var d1;
        d1=d.replace(/X/gi,"x");
        d1=d1.replace(/\*/gi,"x");
        d1=d1.replace(/[ ]*x[ ]*/g,"x");
        d1=d1.replace(/ /g,"+");
        alert("normalizando dimensones: "+d1);
        res=d1.split("x");
        //alert("tokens: "+res);
        if((nd=res.length)!=3){
                alert("dimensiones incorrectas, hay "+nd);
                return;
        }
	
	var g,a,l;
	g=res[0]; a=res[1]; l=res[2];
	//alert("g:"+g+" a:"+a+" l:"+l);
	var vg,va,vl;
	vg=eval(g); va=eval(a); vl=eval(l);
	//alert("vg:"+vg+" va:"+va+" vl:"+vl);
	
	var ug, ua, ul;
	// grueso
	if(g.includes("."))
		ug='C'; // centimetros
	else if(g.includes("/"))
		ug='I'; // pulgadas
	else if(vg>3)
		ug='C'; // centimetros
	else
		ug='I'; // pulgadas
	// ancho
	if(a.includes("."))
		ua='C'; // centimetros
	else if(a.includes("/"))
		ua='I'; // pulgadas
	else if(va>10)
		ua='C'; // centimetros
	else
		ua='I'; // pulgadas
	// largo
	if(l.includes("."))
		ul='M'; // metros
	else if(l.includes("/")){
		if(vl<8)
			ul='I'; // pulgadas
		else
			ul='F';	// pies
	}
	else if(vl>100)	// no hay . ni /
		ul='C'; // centimetros
	else if(vl>12)
		ul='I'; // pulgadas
	else
		ul='F'; // pies
	//alert("ug:"+ug+" ua:"+ua+" ul:"+ul);
	//
	// ajuste de selects
	var gid='ugrueso'+ug;
	//alert("gid:"+gid); //+" ua:"+ua+" ul:"+ul);
	document.getElementById(gid).selected = true;
	document.getElementById("gruesoDecimal").value = vg;
	var aid='uancho'+ua;
	document.getElementById(aid).selected = true; 
	document.getElementById("anchoDecimal").value = va;
	var lid='ulargo'+ul;
	document.getElementById(lid).selected = true; 
	document.getElementById("largoDecimal").value = vl;
	//alert("vg:"+vg+" va:"+va+" vl:"+vl);
	// calculo del volumne en pie-t
	var vol=vg*va*vl;
	if(ug=='C') vol=vol/2.54;
	if(ua=='C') vol=vol/2.54;
	if(ul=='C') vol=vol/2.54;
	else if(ul=='M') vol=vol*100/2.54;
	else if(ul=='F') vol=vol*12;
	vol=vol/144;
	document.getElementById("volumenPT").value = vol;
	// descripcion normalizada
	d1=d1.replace(/\+/gi," ");
	document.getElementById("descripcion").value = d1;
}
function recalcVol(){
	var vg=document.getElementById("gruesoDecimal").value;
	var va=document.getElementById("anchoDecimal").value;
	var vl=document.getElementById("largoDecimal").value;
	//alert("vg:"+vg+" va:"+va+" vl:"+vl);
	//var x  = document.getElementById("ugrueso").selectedIndex;
	var ug  = document.getElementById("ugrueso").value;
//	alert("grueso index x:"+x);
	var ua  = document.getElementById("uancho").value;
	var ul  = document.getElementById("ulargo").value;
	/*
	var ua = document.getElementsByTagName("option")[x].value;
	var x  = document.getElementById("ulargo").selectedIndex;
	var ul = document.getElementsByTagName("option")[x].value;
	 */
	//alert("ug:"+ug+" ua:"+ua+" ul:"+ul);
	var vol=vg*va*vl;
	if(ug=='C') vol=vol/2.54;
	if(ua=='C') vol=vol/2.54;
	if(ul=='C') vol=vol/2.54;
	else if(ul=='M') vol=vol*100/2.54;
	else if(ul=='F') vol=vol*12;
	vol=vol/144;
	document.getElementById("volumenPT").value = vol;
}

</script>
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
Especie <input type=text name=especie required> (pino, encino, etc.)
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
