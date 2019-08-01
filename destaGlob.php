<h3>Destajos Globales</h3>
require_once "Auth/proteger.php";
<form method=post action=destaGlobRepo.php>
<input type=hidden name=f1 value='<?php echo $f1;?>'>
<input type=hidden name=f2 value='<?php echo $f2;?>'>
Condensado <input type=submit name=condensado value=ver><br>
Desglosado Todos en el periodo <input type=submit name=todosRepos value=ver><br>
<?php
$q="select id, nombre from empleados order by nombre";
$empleado=htmlSelect($q, "empleado", "id", "nombre", '');
echo "Desglosado Para el trabajador $empleado\n";
echo "<input type=submit name=xempleado value=ver><br>\n";
echo "</form>\n";
?>


