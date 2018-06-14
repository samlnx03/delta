<?php
// otros destajos reg
        // mostrar movimientos de otros destajos
        $q="select d.id, d.cantidad, a.unidad, a.descrip, e.nombre from movsRepoOtrasActiv as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN empleados as e ON d.idEmpleado=e.id WHERE d.idRepoCL='$id'";
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
        echo "<form action='clDetalleBorrar.php' method='POST'>\n";
        $t->show();
        echo "<input type=hidden name=tabla value=OA>";
        echo "</form>\n";
        echo "<a class='button-red' href='clRepoBorrar.php?id=$id'>Borrar Repo</a> ";
        echo "OJO: Se borra definitivamente!   ---\n";
        echo "<a class='button-green' href='clRepoCerrar.php?id=$id'>Cerrar Repo</a> ";
        echo "No se podrá ni borrar ni agregar nada al reporte\n";
?>
