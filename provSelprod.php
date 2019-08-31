<script>
function provProdSel(id) {
	//document.getElementById("demo").innerHTML = "Hello World";
	document.getElementById('producto').value=id;
	//alert("op_o_ayu:"+oper_o_ayud+" id:"+id);
	// llenar detalles del producto con consulta ajax
        $.get( "provAjaxGetProd.php", { id:id } )
                  .done( function (data) {
                          //alert("data descrip: "+data);
                          var r=jQuery.parseJSON(data);
			  $( "#prodDetalle" ).val( r.prodDetalle );
			  $( "#prodPrecio" ).val( r.precio );
                        });

}
</script>
<?php
	$db=db::getInstance();
	$q="SELECT prod.id, prov.nombre, proced.procedencia, pg.generoDimension as producto, prod.precio ".
		"FROM provProductos prod ".
		"LEFT JOIN provProcedencias proced ON prod.id_proced=proced.id ".
		"LEFT JOIN proveedores prov ON prod.id_prov=prov.id ".
		"LEFT JOIN provGeneros pg ON prod.generoDimension=pg.id ".
		"ORDER BY prov.nombre, proced.procedencia, producto ".
		"";
        $t=new html_table();
        $t->addextras( array(
                "Acción",
                "<button onclick='provProdSel(this.value)' class='green' name='seleccionar' value='%f0%'>Seleccionar</button>",
                array("id")
                )
        );
        $t->setcdatas(array("Acción"=>"Acción", "id"=>"id", "Proveedor" => "nombre", "Procedencia"=>"procedencia", "Producto"=>"producto", "Precio"=>"precio"));
        //echo "q:$q<br>";
        $db->query($q);
        $t->setbody($db->get_all());
        //echo "<form method=POST>\n";
        $t->show();
        //echo "</form>\n";
?>
