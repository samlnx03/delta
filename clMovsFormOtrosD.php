<div  id="otros" style="<?php echo $styl2;?>">
<form action=clDetalleAltaOD.php method=POST>
Cantidad <input id='cantidadO' type=text name=cantidad size=3>
<?php
//$q="select clave, concat(unidad,' ',descrip) as descrip from actividades where unidad<>'pie-tabla'";
$q="select clave, concat(clave,': (',unidad,') ',descrip) as descrip from actividades where tipo<>'tabla'";
$clave=htmlSelect($q, "clave", "clave", "descrip", '');
echo " Clave $clave\n";
//echo " <input type=hidden name=descripcion>";
?>
<input type=submit name=soloOperador value='Agregar'>
<?php echo "<b>$o</b>\n";?>
</form>
</div> <!-- fin se otros destajos -->

