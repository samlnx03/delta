<script>
var oper_o_ayud=0;
function empleadoSel(id) {
	//document.getElementById("demo").innerHTML = "Hello World";
	if(oper_o_ayud==0){
		document.getElementById('operador').value=id;
		document.getElementById('pctjOp').value=100;
		document.getElementById('pctjAyu').value=0;
		oper_o_ayud=1;
	} else {
		document.getElementById('ayudante').value=id;
		document.getElementById('pctjOp').value=50;
		document.getElementById('pctjAyu').value=50;
		oper_o_ayud=0;
	}
	//alert("op_o_ayu:"+oper_o_ayud+" id:"+id);
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
