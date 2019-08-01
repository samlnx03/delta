<?php
require_once "Auth/proteger.php";
require_once "odMovsFormHead.php";

echo "<form action=odDetalleAlta.php method=POST>\n";
echo "Cantidad <input type=text name=cantidad size=3>\n";
//$q="select clave, concat(clave,': (',unidad,') ',descrip) as descrip from actividades where tipo='tarima'";
$q="select clave, concat(clave,': (',unidad,') ',descrip) as descrip from actividades where proceso=0"; // otros destajos
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
//echo "<div class='divrow'>\n"; 
//<div class='divcol30' style="background-color: #719f9f80; padding-top: 3px; padding-left: 4px; padding-bottom: 1px;">
?>
<?php
$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepoOD='$id' AND a.proceso=0";
$db->query($q);
$t=new html_table();
$t->addextras( array(
	"Editar", 
	"<button class='red' type='submit' name='id' value='%f0%'>Eliminar</button>", 
	array("id")
	)
);
$t->setcdatas(array("Eliminar"=>"Editar", "cant" => "cantidad", "unidad"=>"unidad", "descrip"=>"descrip","empleado"=>"nombre" ));
//$t->setTclas("Txml");
//$t->setcdatas(array("cant" => "cantidad", "unidad"=>"unidad", "descrip"=>"descrip","empleado"=>"nombre" ));
echo "<form action='odDetalleBorrar.php' method='POST'>\n";
$t->setbody($db->get_all());
$t->show();
echo "<input type=hidden name=tabla value=OA>";
echo "<input type=hidden name=redirect value='{$_SERVER["PHP_SELF"]}'>\n";
echo "</form>\n";
//</div> <!-- stilized backgrouncolor -->
//</div> <!-- divrow -->
?>
<br>
<?php
require_once "odMovsFormFoot.php";
?>
</body>
</html>

