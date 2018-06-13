<script>
function empleadoSel(id) {
	document.getElementById('operador').value=id;
}
</script>
<?php
	$db=db::getInstance();
        $q="select id, nombre from empleados order by nombre";
        $t=new html_table();
        $t->addextras( array(
                "Acción",
                "<button onclick='empleadoSel(this.value)' class='green' name='seleccionar' value='%f0%'>Seleccionar</button>",
                array("id")
                )
        );
        $t->setcdatas(array("Acción"=>"Acción", "id"=>"id", "nombre" => "nombre"));
        //echo "q:$q<br>";
        $db->query($q);
        $t->setbody($db->get_all());
        //echo "<form method=POST>\n";
        $t->show();
        //echo "</form>\n";
?>
