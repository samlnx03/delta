<?php
require_once "clMovsFormHead.php";
?>
<div style="background-color: #b4d7d7; padding-top: 3px; padding-left: 4px; padding-bottom: 1px;">
<b>(2) Producción de Corte a Largo</b>
<?php
$tipoMov='agregar';  // aumenta el inventario
require "clMovsFormEntradas.php";
// entradas a inventario, produccion de corte a largo
//
$q="select d.id, d.cantidad, a.descrip, t.especie, t.descrip as dimensiones from movsRepoCL as d LEFT JOIN actividades as a ON d.actividad=a.clave LEFT JOIN tablas as t ON d.idtabla=t.id WHERE d.idRepoCL='$id' AND tipomov='agregar'";
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
echo "<div class='divrow'>\n"; 
echo "<div class='divcol' id='SalidasMA'>\n";
echo "<form action='clDetalleBorrar.php' method='POST'>\n";
$t->show();
echo "<input type=hidden name=tabla value=MD>"; // madera dimensionada (tablas)
echo "<input type=hidden name=redirect value='".$_SERVER['PHP_SELF']."'>";
echo "</form>\n";
?>
</div> <!-- id='SalidasMA' divcol 1 -->
<div class='divcol' id='lista'></div>
</div> <!-- divrow -->
</div> <!-- stilized backgrouncolor -->
<br>

<?php
require_once "clMovsFormFoot.php";
?>
<script>
var status=0;
var medidas="";
</script>
</body>
</html>
