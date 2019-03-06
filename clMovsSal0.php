<?php
require_once "clMovsFormHead.php";
?>
<div style="background-color: #a8dede80; padding-top: 3px; padding-left: 4px; padding-bottom: 1px;">
<b>(1) Salidas de madera aserrada llevadas a corte a largo</b>
<?php
$tipoMov='descontar';  // disminuye el inventario
require "clMovsFormSalidas.php";
// registros de salidas
//
$q="select d.id, d.cantidad, t.especie, t.descrip as dimensiones from movsRepoCL as d LEFT JOIN tablas as t ON d.idtabla=t.id WHERE d.idRepoCL='$id' AND tipomov='descontar'";
//echo "$q<br>\n";
$db->query($q);
$t=new html_table();
$t->addextras( array(
	"Editar", 
	"<button class='red' type='submit' name='id' value='%f0%'>Eliminar</button>", 
	array("id")
	)
);
$t->setcdatas(array("Salidas"=>"Editar", "cant" => "cantidad", "especie"=>"especie", "dimensiones"=>"dimensiones" ));
$t->setbody($db->get_all());
echo "<div class='divrow'>\n"; 
echo "<div class='divcol' id='SalidasMA'>\n";
echo "<form action='clDetalleBorrar.php' method='POST'>\n";
$t->show();
echo "<input type=hidden name=tabla value=MD>";  // madera dimensionada (tablas)
echo "<input type=hidden name=redirect value='".$_SERVER['PHP_SELF']."'>";
echo "</form>\n";
?>
</div> <!-- id='SalidasMA' divcol 1 -->
<div class='divcol' id='listax'></div>
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
