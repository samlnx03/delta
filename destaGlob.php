<h3>Destajos Globales (pendiente)</h3>
<form method=post action=rdestajosAMD.php>
<input type=hidden name=destajos_proceso value='1'>
<input type=hidden name=f1 value='<?php echo $f1;?>'>
<input type=hidden name=f2 value='<?php echo $f2;?>'>
Todos en el periodo <input type=submit name=todosRepos value=ver><br>
<?php
$q="select id, nombre from empleados order by nombre";
$empleado=htmlSelect($q, "empleado", "id", "nombre", '');
echo "Para el trabajador $empleado\n";
echo "<input type=submit name=xempleado value=ver><br>\n";
echo "</form>\n";
?>


