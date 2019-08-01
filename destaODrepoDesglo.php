<?php
require_once "Auth/proteger.php";
// destaODrepoDesglo	destajos Otros Destajos desglosado
//
$acumula="sum(cantidad) as cant";
$q="select distinct nombre,empleado from destajos where proceso='$proceso' order by nombre";
$db->query($q);
$trabajadores=$db->get_all();
$f1=$_POST['f1'];
$f2=$_POST['f2'];
echo "$trepo\n";
echo "<h3>Periodo del $f1 al $f2</h3>\n";
foreach($trabajadores as $persona){
	$numemp=$persona['empleado']."<br>\n";
	$q="select dayname(fecha) dia, fecha, activ, $acumula, any_value(costo) as unitario, sum(destajo) as destajo from destajos where proceso='$proceso' AND empleado='$numemp' group by fecha,activ";
	echo "<b>".$persona['nombre']."</b><br>\n";
	$db->query($q);
	$t=new html_table();
	$t->setFieldTotalizado("cant", 0); // campo a totalizar, inicializado en 0
	$t->setFieldTotalizado("destajo", 0); // campo a totalizar, inicializado en 0
	$t->setbody($db->get_all());
	$t->show();
	echo "Total: <b>".number_format($t->getFieldTotalizado("destajo"),2)."</b>\n";
	echo "<br><br>\n";
}
?>
