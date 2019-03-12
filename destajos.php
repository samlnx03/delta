<?php
require_once "Auth/session.php";
//require_once "Auth/table.php";
require_once "desarrollo.php";  // show errores

$db=db::getInstance();
$f1="";
$f2="";
if (isset($_POST["recalc"])){
	$f1=$_POST["f1"];
	$f2=$_POST["f2"];
	$rangoFechas="fecha>='$f1' AND fecha<='$f2'";
	$q="DELETE FROM destajosMDim";
	$db->query($q);
	$q="ALTER TABLE destajosMDim AUTO_INCREMENT = 1";
	$db->query($q);
	// aserrio operadores
	$q="INSERT into destajosMDim (fecha,empleado,nombre,pctj,idmov,idrepo,actividad,activ,cantidad,idtabla,especie,medidas,volpt,costo,destajo) 
	select fecha, operador as empleado, e.nombre, pctjOp as pctj, m.id, m.idrepo, m.actividad, a.descrip as activ, m.cantidad, m.idtabla, t.especie, t.descrip as medidas,  t.volpt*cantidad as volpt, a.costo, round(a.costo*volpt*cantidad*pctjOp/100,2) as destajo
	from movsRepoDimensionado m
	     left join repoProd rp1 on m.idRepo=rp1.id
		left join tablas t on m.idtabla=t.id
		left join actividades a on m.actividad=a.clave
		left join empleados e on operador=e.id
	where e.id IS NOT NULL AND $rangoFechas
";
	//echo $q;
	$db->query($q);
	// aserrio ayudantes
	$q="INSERT into destajosMDim (fecha,empleado,nombre,pctj,idmov,idrepo,actividad,activ,cantidad,idtabla,especie,medidas,volpt,costo,destajo) 
	select fecha, ayudante as empleado, e.nombre, pctjAyu as pctj, m.id, m.idrepo, m.actividad, a.descrip as activ, m.cantidad, m.idtabla, t.especie, t.descrip as medidas,  t.volpt*cantidad as volpt, a.costo, round(a.costo*volpt*cantidad*pctjOp/100,2) as destajo
	from movsRepoDimensionado m
	     left join repoProd rp1 on m.idRepo=rp1.id
		left join tablas t on m.idtabla=t.id
		left join actividades a on m.actividad=a.clave
		left join empleados e on ayudante=e.id
	where e.id IS NOT NULL AND $rangoFechas
";
	//echo $q;
	$db->query($q);
}
$_SESSION["msg"]="Periodo de destajos actualizado";
header("Location: reportes.php");
die();
?>
