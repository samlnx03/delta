<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php";
// borrar 2
//require_once "funcs.php";
//					PROVEEDORES DE ROLLITO (Y ROLLO)

//create table proveedores ( id int not null auto_increment primary key, nombre char(60), baja char(1) default ' ');

//create table provProcedencias (id int not null auto_increment primary key, id_prov int, procedencia char(60));

//create table provProductos (id int not null auto_increment primary key, producto char(60), id_prov int, id_proced int, precio decimal(9,2), baja char(1) default ' ');

//create table entradasCD(id int not null auto_increment primary key, fecha date, remision char(10), chofer varchar(60),  producto int, folioftal char(10), altoProm decimal(4,2), ancho decimal(4,2), largo decimal(4,2), largoCDcm int, vol_embarcadoM3 decimal(7,3), vol_recibidoM3 decimal(7,3));


// alta
$db=db::getInstance();
$cond="";
$nobaja="baja=' '"; // una s es baja, va en el where mas adelante
if(isset($_POST["opcion"])){
	$opcion=$_POST["opcion"];
	$nombre=$_POST["nombre"];
	if($opcion=="Agregar"){
		$q="insert into proveedores (nombre) values ('$nombre')";
        	$db->query($q);
	} elseif($opcion=="Buscar"){
		$cond="nombre like '%$nombre%'";
	}
} else if(isset($_POST["baja"])){
	$baja=$_POST["baja"];
	$_SESSION["msg"]="El empleado ya no aparecerá en la lista";
} else if(isset($_POST["bajaokid"])){
	$id=$_POST["bajaokid"];
	$q="update proveedores set baja='s' where id='$id'";
	$db->query($q);
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/abutton.css">
</head>




<body>
<?php require('menu.php'); ?>
<?php require('menuRyR.php'); ?>
<h1>Proveedores</h1>
<?php
if(isset($_SESSION["msg"])){
	echo "<div class='mensaje'>".$_SESSION["msg"]."</div>";
	unset($_SESSION["msg"]);
}
if(isset($baja)){
	echo <<<EOF
<br>
<form method=POST>
<input type=submit name=bajaok value='OK Baja'>
<input type=hidden name=bajaokid value='$baja'>
<a href=proveedores.php>Regresar</a>
</form>
</body>
</html>
EOF;
	exit;
}
?>
<div id="altas">
<form method=POST>
nombre: <input type=text name=nombre size=60 required>
<input type=submit name=opcion value=Agregar>
<input type=submit name=opcion value=Buscar>
</form>
</div>

<div id="lista">
<a href=proveedores.php>Ver todos</a>
<?php
//<div id="lista" style="overflow:scroll">
if($cond!=''){
	$q="select id, nombre from proveedores WHERE $nobaja AND $cond order by id desc";
}else{
	$q="select id, nombre from proveedores WHERE $nobaja order by id desc";
}
//echo "q:$q<br>\n";
$t=new html_table();
// no se podra borrar 
$t->addextras( array(
	"productos", 
	"<a href=provProced.php?prov=%f0%>Ver</a>", 
	array("id")
	)
);
 
$t->addextras( array(
	"baja", 
	"<button class='red' type='submit' name='baja' value='%f0%'>Baja</button>", 
	array("id")
	)
);
$t->setcdatas(array("Baja"=>"baja", "id"=>"id", "nombre" => "nombre", "Productos"=>"productos"));
//echo "q:$q<br>";
$db->query($q);
if($db->num_rows()>0){
       $t->setbody($db->get_all());
	echo "<form method=POST>\n";
	$t->show();
	echo "</form>\n";
} else {
	echo "<div class='mensaje'>No encontrado</div>";
}
?>
</div>


</body>
</html>

