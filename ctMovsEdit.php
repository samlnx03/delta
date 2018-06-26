<?php
require_once "ctMovsFormHead.php";
echo "<br>\n";
echo "<div class='divrow'>\n"; 
?>
<div class='divcol30' style="background-color: #a8dede80; padding-top: 3px; padding-left: 4px; padding-bottom: 1px;">
<b>(1) Clavado de tarima</b>
<?php
$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepoCT='$id' AND a.proceso=3";

$db->query($q);
$t=new html_table();
$t->setTclas("Txml");
$t->setcdatas(array("cant" => "cantidad", "unidad"=>"unidad", "descrip"=>"descrip","empleado"=>"nombre" ));
$t->setbody($db->get_all());
$t->show();
echo "</div>\n";
?>

<div class='divcol30' style="background-color: #719f9f80; padding-top: 3px; padding-left: 4px; padding-bottom: 1px;">
<b>(2) Otros Destajos</b>
<?php
$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepoCT='$id' AND a.proceso=0";
$db->query($q);
$t=new html_table();
$t->setTclas("Txml");
$t->setcdatas(array("cant" => "cantidad", "unidad"=>"unidad", "descrip"=>"descrip","empleado"=>"nombre" ));
$t->setbody($db->get_all());
$t->show();
?>
</div> <!-- stilized backgrouncolor -->
</div> <!-- divrow -->
<br>
<?php
require_once "ctMovsFormFoot.php";
?>
</body>
</html>

