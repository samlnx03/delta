<div style="background-color: #a8dede80; padding-top: 3px; padding-left: 4px; padding-bottom: 1px;">
<button id="btnotros">Ver/ocultar</button> <b>Otros Destajos</b>
<div id='OtrosD'>
<?php
require "clMovsFormOtrosD.php";
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
?>
</div> <!-- id='OtrosD' ocultable -->
</div>

