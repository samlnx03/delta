<?php
require_once "Auth/session.php";
require_once "Auth/dbclass.php";
//require_once "Auth/table.php";
require_once "desarrollo.php";  // show errores
require_once "funcs.php";  // funciones utiles

/*
$cond="order by p.id desc limit 10";
if(isset($_POST["alta"])){
        //header('Location: prodNuevoRepo.php');
        die();
}
elseif(isset($_POST["today"])){
	$cond="where fecha=date(now()) order by p.id desc";
} elseif (isset($_POST["semana"])){
	$cond="where fecha<=date(NOW()) AND fecha>=date(DATE_SUB(NOW(), INTERVAL 7 DAY)) order by p.id desc";
} elseif (isset($_POST["rango"])){
	$f1=$_POST["f1"];
	$f2=$_POST["f2"];
	$cond="where fecha>='$f1' AND fecha<='$f2' order by p.id desc";
}
elseif(isset($_POST["ultimos"])){
	$cond="order by p.id desc limit 10";
}

 */

$db=db::getInstance();
//$q="select min(fecha) as F1, max(fecha) as F2 from destajosMDim";
$q="select valor from claveValor where clave like 'rDestajSCf_'"; // f1 o f2
$db->query($q);
if($db->num_rows()==0){
        $q="insert into claveValor values('rDestajSCf1','')";
        $db->query($q);
        $q="insert into claveValor values('rDestajSCf2','')";
        $db->query($q);
        $f1=""; $f2="";
} else {
        $db->next_row(); $f1=$db->f("valor");
        $db->next_row(); $f2=$db->f("valor");
}
//$db->next_row();
//$f1=$db->f("F1");
//$f2=$db->f("F2");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
</head>
<body>
<?php require('menu.php'); ?>
<h1>Reportes Ejecutivos</h1>
<?php
if(isset($_SESSION["msg"])){
        echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
        unset($_SESSION["msg"]);
}
?>
<form method='POST' action='destajos.php'>
Periodo para calculo de destajos: de 
<?php echo" <input type=date name=f1 value='$f1' required> ";?>
a 
<?php echo "<input type=date name=f2 value='$f2' required> ";?> 
<input type=submit name=recalc value='Recalcular'>
</form>

<h3>Destajos Aserrío</h3>
<form method=post action=rdestajosAMD.php>
<input type=hidden name=destajos_proceso value='1'>
<input type=hidden name=f1 value='<?php echo $f1;?>'>
<input type=hidden name=f2 value='<?php echo $f2;?>'>
Todos en el periodo <input type=submit name=todosRepos value=ver><br>
Del reporte <input type=text name=nrepo size=5> <input type=submit name=xrepo value='ver'><br>
<?php
$q="select id, nombre from empleados order by nombre";
$empleado=htmlSelect($q, "empleado", "id", "nombre", '');
echo "Para el trabajador $empleado\n";
echo "<input type=submit name=xempleado value=ver><br>\n";
echo "</form>\n";
?>

<h3>Destajos Corte a Largo</h3>
<form method=post action=rdestajosAMD.php>
<input type=hidden name=destajos_proceso value='2'>
<input type=hidden name=f1 value='<?php echo $f1;?>'>
<input type=hidden name=f2 value='<?php echo $f2;?>'>
Todos en el periodo <input type=submit name=todosRepos value=ver><br>
Del reporte <input type=text name=nrepo size=5> <input type=submit name=xrepo value='ver'><br>
<?php
$q="select id, nombre from empleados order by nombre";
$empleado=htmlSelect($q, "empleado", "id", "nombre", '');
echo "Para el trabajador $empleado\n";
echo "<input type=submit name=xempleado value=ver><br>\n";
echo "</form>\n";
?>

<h3>Destajos de Clavado de Tarimas</h3>
<form method=post action=rdestajosAMD.php>
<input type=hidden name=destajos_proceso value='3'>
<input type=hidden name=f1 value='<?php echo $f1;?>'>
<input type=hidden name=f2 value='<?php echo $f2;?>'>
Todos en el periodo <input type=submit name=todosRepos value=ver>
<input type=submit name=rctdesglo value=desglosado>
<br>
Del reporte <input type=text name=nrepo size=5> <input type=submit name=xrepo value='ver'><br>
<?php
$q="select id, nombre from empleados order by nombre";
$empleado=htmlSelect($q, "empleado", "id", "nombre", '');
echo "Para el trabajador $empleado\n";
echo "<input type=submit name=xempleado value=ver><br>\n";
echo "</form>\n";
?>

Aserrío Diario por máquina <a href=raserrio.php>Ver</a>
<br>
cantidad total diaria de piezas aserradas de cada dimension y especie
<br>
Pagos de destajos (jueves-miercoles)
<br>
Entradas y salidas de madera dimensionada
<br>
Inventario de materias primas
<br>
</body>
</html>

