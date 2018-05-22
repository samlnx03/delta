<?php
	// mostrar movimeintos de madera dimensionada
	$q="select d.id, d.cantidad, a.descrip, t.especie, t.descrip as dimensiones from movsRepoDimensionado as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN tablas as t ON d.idtabla=t.id WHERE d.idRepo='$id'";
	//echo "$q<br>\n";
	$db->query($q);
	$t=new html_table();
	$t->setcdatas(array("cant" => "cantidad", "descrip"=>"descrip", "especie"=>"especie", "dimensiones"=>"dimensiones" ));
	$t->setbody($db->get_all());
	$t->show();
	echo "<br>\n";
	// mostrar movimientos de otros destajos
	$q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepo='$id'";
	$db->query($q);
	$t=new html_table();
  	$t->setcdatas(array("cant" => "cantidad", "unidad"=>"unidad", "descrip"=>"descrip","empleado"=>"nombre" ));
	$t->setbody($db->get_all());
	$t->show();
?>

