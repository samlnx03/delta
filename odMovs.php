<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
//
// solo mostrar items
// desaplicar en otro script especial para ello

require_once "odMovsFormHead.php";

// mostrar movimientos del reporte de otros destajos
$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepoOD='$id' AND a.proceso=0";
//echo "$q<br>\n";
$db->query($q);
$t=new html_table();
$t->setcdatas(array("cant" => "cantidad", "unidad"=>"unidad", "descrip"=>"descrip","empleado"=>"nombre" ));
$t->setbody($db->get_all());
echo "<b>Otros Destajos</b><br>\n";
$t->show();
echo "<br>\n";
unset($_SESSION["idrepoct"]);
?>
</body>
</html>
