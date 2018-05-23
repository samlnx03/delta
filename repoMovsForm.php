<br>
Mostrar/Ocultar captura de 
<button onclick="dimensionada()">Madera Dimensionada</button>
<button onclick="otros()">otros destajos</button>
<?php 
if(!isset($_SESSION["agregando"])){
	$styl1="display: none; ";
	$styl2="display: none; ";
}
elseif($_SESSION["agregando"]==1){
	$styl1="display: block; ";
	$styl2="display: none; ";
}
elseif($_SESSION["agregando"]==2){
	$styl2="display: block; ";
	$styl1="display: none; ";
}
$styl1.="background-color: eeeeee; font-weight: bold; color: black; border:thin Black; border-style : dashed; line-height: 20px; padding-top: 6px; padding-left: 6px; padding-bottom: 6px; padding-right: 6px;";
?>
<div  id="madera" style="<?php echo $styl1;?>">
<form action=prodDetalleAltaMA.php method=POST>
<table>
<tr>
<td>
Producción<br>
<?php
//$q="select clave, descrip from actividades where unidad='pie-tabla'";
$q="select clave, descrip from actividades where tipo='tabla'";
$clave=htmlSelect($q, "clave", "clave", "descrip", '');
echo "$clave\n";
?>
<td>Cantidad<br><input type=text name=cantidad size=3 required>
<td>Especie<br><input onKeyUp="this.value = this.value.toUpperCase();" type=text name=especie size=7 required>
<td>Dimensiones<br><input type=text name=descripcion size=50 required>
<td><br>
<input type=submit name=aserrioYhojeado value='Agregar'>
<b>Aserrio y hojeado</b>
</table>
</form>
</div>
<?php
$styl2.="background-color: eeeeee; font-weight: bold; color: black; border:thin Black; border-style : dashed; line-height: 20px; padding-top: 6px; padding-left: 6px; padding-bottom: 6px; padding-right: 6px;";
?>
<div  id="otros" style="<?php echo $styl2;?>">
<form action=prodDetalleAltaOD.php method=POST>
<table>
<tr>
<td>Cantidad<br><input type=text name=cantidad size=3>
<?php
//$q="select clave, concat(unidad,' ',descrip) as descrip from actividades where unidad<>'pie-tabla'";
$q="select clave, concat(clave,': (',unidad,') ',descrip) as descrip from actividades where tipo<>'tabla'";
$clave=htmlSelect($q, "clave", "clave", "descrip", '');
echo "<td>Clave<br>$clave\n";
echo "<td> \n";
echo "<input type=hidden name=descripcion>";
?>
<td> <br>
<input type=submit name=soloOperador value='Agregar'>
<?php echo "Solo el Operador: <b>$o</b>\n";?>
</td></tr></table></form>
<form action=prodDetalleAltaOD.php method=POST>
<table>
<tr>
<td>Cantidad<br><input type=text name=cantidad size=3>
<?php
echo "<td>Clave<br>$clave\n";
echo "<td> \n";
echo "<input type=hidden name=descripcion>";
?>
<td> <br>
<input type=submit name=soloAyudante value='Agregar'>
<?php echo "Solo el Ayudante: <b>$a</b>\n";?>
</td></tr></table></form>
<form action=prodDetalleAltaOD.php method=POST>
<table>
<tr>
<td>Cantidad<br><input type=text name=cantidad size=3>
<?php
echo "<td>Clave<br>$clave\n";
echo "<td> \n";
echo "<input type=hidden name=descripcion>";
?>
<td> <br>
<input type=submit name=operadorYayudante value='Agregar'>
<?php echo "Para cada uno: <b>$o y $a</b>\n";?>
</td></tr></table></form>
</div>
<?php
	// mostrar movimeintos de madera dimensionada
	$q="select d.id, d.cantidad, a.descrip, t.especie, t.descrip as dimensiones from movsRepoDimensionado as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN tablas as t ON d.idtabla=t.id WHERE d.idRepo='$id'";
	//echo "$q<br>\n";
	$db->query($q);
	$t=new html_table();
  	$t->addextras( array(
		"Editar", 
		"<button type='submit' name='id' value='%f0%'>Eliminar</button>", 
		array("id")
		)
  	);
	  $t->setcdatas(array("Eliminar"=>"Editar", "cant" => "cantidad", "descrip"=>"descrip", "especie"=>"especie", "dimensiones"=>"dimensiones" ));
	$t->setbody($db->get_all());
  	echo "<form action='prodDetalleBorrar.php' method='POST'>\n";
	$t->show();
	echo "<input type=hidden name=tabla value=MD>";
	echo "</form>\n";
	
	// mostrar movimientos de otros destajos
	$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepo='$id'";
	$db->query($q);
	$t=new html_table();
	$t->addextras( array(
		"Editar", 
		"<button type='submit' name='id' value='%f0%'>Eliminar</button>", 
		array("id")
		)
  	);
	$t->setcdatas(array("Eliminar"=>"Editar", "cant" => "cantidad", "unidad"=>"unidad", "descrip"=>"descrip","empleado"=>"nombre" ));
	$t->setbody($db->get_all());
	echo "<form action='prodDetalleBorrar.php' method='POST'>\n";
	$t->show();
	echo "<input type=hidden name=tabla value=OA>";
	echo "</form>\n";
?>
