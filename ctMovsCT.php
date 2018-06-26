<?php
require_once "ctMovsFormHead.php";
// mostrar forma para el clavado de tarima
?>
<div style="background-color: #a8dede80; padding-top: 3px; padding-left: 4px; padding-bottom: 1px;">
<b>(1) Clavado de Tarima</b>
<?php
echo "<form action=ctDetalleAlta.php method=POST>\n";
echo "Cantidad <input type=text name=cantidad size=3>\n";
//$q="select clave, concat(clave,': (',unidad,') ',descrip) as descrip from actividades where tipo='tarima'";
$q="select clave, concat(clave,': (',unidad,') ',descrip) as descrip from actividades where proceso=3";  // clavado de tarimas
$clave=htmlSelect($q, "clave", "clave", "descrip", '');
echo "Clave $clave\n";
$q="select id, nombre from empleados order by nombre";
$empleado=htmlSelect($q, "empleado", "id", "nombre", '');
echo "Empleado $empleado\n";

?>
<input type=submit name=soloOperador value='Agregar'>
<input type=hidden name=redirect value="<?php echo $_SERVER["PHP_SELF"];?>">
</form>
<?php
// mostrar movimientos de clavado de tarima
// pero dados de alta desde clavado de tarimas y no desde sierras cintas
//
// se agrego otro campo a movsRepoOtrasActiv idRepoCT 
// 	para identificar a los movtos de Clavado de Tarima de la tabla repoCT
//
$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepoCT='$id' AND a.proceso=3";

$db->query($q);
$t=new html_table();
$t->addextras( array(
	"Editar", 
	"<button class='red' type='submit' name='id' value='%f0%'>Eliminar</button>", 
	array("id")
	)
);
$t->setcdatas(array("Eliminar"=>"Editar", "cant" => "cantidad", "unidad"=>"unidad", "descrip"=>"descrip","empleado"=>"nombre" ));
$t->setbody($db->get_all());
echo "<form action='ctDetalleBorrar.php' method='POST'>\n";
$t->show();
echo "<input type=hidden name=tabla value=OA>";
echo "<input type=hidden name=redirect value='{$_SERVER["PHP_SELF"]}'>\n";
echo "</form>\n";
?>
</div>
<?php
require_once "ctMovsFormFoot.php";
?>
</body>
</html>
