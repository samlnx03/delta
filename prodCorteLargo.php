<h3>Producción de Corte a Largo</h3>
<form method=post action=rprodCorteLargo.php>
<input type=hidden name=f1 value='<?php echo $f1;?>'>
<input type=hidden name=f2 value='<?php echo $f2;?>'>
Por medidas <input type=submit name=xmedidas value=ver><br>
<?php
/*
Del reporte <input type=text name=nrepo size=5> <input type=submit name=xrepo value='ver'><br>
<?php
$q="select id, nombre from empleados order by nombre";
$empleado=htmlSelect($q, "empleado", "id", "nombre", '');
echo "Para el trabajador $empleado\n";
echo "<input type=submit name=xempleado value=ver><br>\n";
 */
echo "</form>\n";
?>
