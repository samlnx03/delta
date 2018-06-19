<div style="background-color: #a8dede80; padding-top: 3px; padding-left: 4px; padding-bottom: 1px;">
<button id="btnsalidas">Ver/ocultar</button> <b>Salidas de madera aserrada llevadas a corte a largo</b>
<div id='SalidasMA'>
<?php
require "clMovsFormSalidas.php";
// registros de salidas
//
$q="select d.id, d.cantidad, a.descrip, t.especie, t.descrip as dimensiones from movsRepoCL as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN tablas as t ON d.idtabla=t.id WHERE d.idRepoCL='$id'";
//echo "$q<br>\n";
$db->query($q);
$t=new html_table();
$t->addextras( array(
	"Editar", 
	"<button class='red' type='submit' name='id' value='%f0%'>Eliminar</button>", 
	array("id")
	)
);
$t->setcdatas(array("Eliminar"=>"Editar", "cant" => "cantidad", "descrip"=>"descrip", "especie"=>"especie", "dimensiones"=>"dimensiones" ));
$t->setbody($db->get_all());
echo "<form action='clDetalleBorrar.php' method='POST'>\n";
$t->show();
echo "<input type=hidden name=tabla value=MD>";
echo "</form>\n";
?>
</div> <!-- id='SalidasMA' ocultable -->
</div>
