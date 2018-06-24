<?php
require_once "clMovsFormHead.php";
echo "<br>\n";
echo "<div class='divrow'>\n"; 
?>
<div class='divcol20' style="background-color: #a8dede80; padding-top: 3px; padding-left: 4px; padding-bottom: 1px;">
<b>(1) Salidas de madera</b>
<?php
$q="select d.id, d.cantidad, t.especie, t.descrip as dimensiones from movsRepoCL as d LEFT JOIN tablas as t ON d.idtabla=t.id WHERE d.idRepoCL='$id' AND tipomov='descontar'";
$db->query($q);
$t=new html_table();
$t->setTclas("Txml");
$t->setcdatas(array("cant" => "cantidad", "especie"=>"especie", "dimensiones"=>"dimensiones" ));
$t->setbody($db->get_all());
$t->show();
?>
</div> <!-- id='SalidasMA' divcol 1 -->
<div class='divcol30' style="background-color: #b4d7d7; padding-top: 3px; padding-left: 4px; padding-bottom: 1px;">
<b>(2) Producción de Corte a Largo</b>
<?php
$q="select d.id, d.cantidad, a.descrip, t.especie, t.descrip as dimensiones from movsRepoCL as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN tablas as t ON d.idtabla=t.id WHERE d.idRepoCL='$id' AND tipomov='agregar'";
$db->query($q);
$t=new html_table();
$t->setTclas("Txml");
$t->setcdatas(array("cant" => "cantidad", "descrip"=>"descrip", "especie"=>"especie", "dimensiones"=>"dimensiones" ));
$t->setbody($db->get_all());
$t->show();
?>
</div> <!-- id='SalidasMA' divcol 1 -->

<div class='divcol30' style="background-color: #719f9f80; padding-top: 3px; padding-left: 4px; padding-bottom: 1px;">
<b>(3) Otros Destajos</b>
<?php
$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepoCL='$id'";
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
require_once "clMovsFormFoot.php";
?>
</body>
</html>
