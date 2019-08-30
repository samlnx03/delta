<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php";
// borrar 2
require_once "funcs.php";
//					PROVEEDORES DE ROLLITO (Y ROLLO) procedencias

//create table proveedores ( id int not null auto_increment primary key, nombre char(60), baja char(1) default ' ');
//create table procedencias (id int not null auto_increment primary key, id_prov int, procedencia char(60));
//create table preciosProv(id int not null auto_increment primary key, producto char(60), id_prov int, id_proced int, precio decimal(9,2));
//
if(isset($_GET['prov'])){
	$id_prov=$_GET['prov'];
	$_SESSION['id_prov']=$id_prov;
} else{
	$id_prov=$_SESSION['id_prov'];
}
$db=db::getInstance();
if(isset($_POST["altaproced"])){
	$proced=$_POST["proced"];
	$q="insert into provProcedencias (id_prov, procedencia) values ('$id_prov','$proced')";
        $db->query($q);
} else if(isset($_POST["altagenero"])){
	$genero=$_POST["genero"];
	$q="select * from provGeneros where generoLargo='$genero'";
	$db->query($q);
	if($db->num_rows()<1){
		$q="insert into provGeneros (generoLargo) values ('$genero')";
        	$db->query($q);
	} else {
		$_SESSION["msg"]="El Género ya existe";
	}
} else if(isset($_POST["altaprod"])){
	$prod=$_POST["generoylargo"];
	$origen=$_POST['origenes'];
	$precio=$_POST['precio'];
	$q="insert into provProductos (generoylargo, id_prov, id_proced, precio) values ('$prod', '$id_prov', '$origen', '$precio')";
        $db->query($q);
} else if(isset($_POST["baja"])){
	$baja=$_POST["baja"];
	$_SESSION["msg"]="Este producto ya no aparecerá en la lista, pero se queda por propósitos históricos";
} else if(isset($_POST["bajaokid"])){
	$id=$_POST["bajaokid"];
	$q="update provProductos set baja='s' where id='$id'";
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
$q="select nombre from proveedores where id='$id_prov'";
$db->query($q);
$db->next_row();
echo "Procedencias de productos y precios del Proveedor: <b>".$db->f("nombre")."</b>\n";
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
<?php
$q="select id, procedencia from provProcedencias where id_prov='$id_prov'";
$origenes=htmlSelect($q, "origenes", "id", "procedencia", ''); // ($qry, $name, $val, $tit, $selected, $initial="")
$q="select id, generoLargo from provGeneros order by generoLargo";
$gl=htmlSelect($q, "generoylargo", "id", "generoLargo", ''); // ($qry, $name, $val, $tit, $selected, $initial="")
?>
<div id="altas">
<!-- <h3>Procedencias</h3> -->
<form method=POST>
<b>Nueva Procedencia</b>: <input type=text name=proced size=40 required>
<input type=submit name=altaproced value=Agregar>
</form>
<form method=POST>
<b>Nuevo Género y Largo:</b> (p.e. Pino c.d.) <input type=text name=genero required> 
<input type=submit name=altagenero value=Agregar>
</form>
<form method=POST>
<?php echo "<b>Nuevo Producto</b><br>Procedencia:".$origenes; ?>
<!--
 Producto:<input type=text name=prod size=30>
-->
<?php echo $gl; ?> 
Precio:<input type=text size=10 name=precio value'0.00'> 
<input type=submit name=altaprod value=Agregar>
</form>
</div>

<div id="lista">
<?php
$q="select prod.id, procedencia, provGeneros.generoLargo as producto, precio from provProcedencias proced LEFT JOIN provProductos prod ON prod.id_proced=proced.id LEFT JOIN provGeneros ON prod.generoylargo=provGeneros.id WHERE proced.id_prov='$id_prov' AND prod.baja=' '";

//echo "q:$q<br>\n";
$t=new html_table();
// no se podra borrar 
$t->addextras( array(
	"precios", 
	"<button class='green' type='submit' name='precios' value='%f0%'>Precios</button>", 
	array("id")
	)
);
 
$t->addextras( array(
	"baja", 
	"<button class='red' type='submit' name='baja' value='%f0%'>Baja</button>", 
	array("id")
	)
);
$t->setcdatas(array("Baja"=>"baja", "Procedencia" => "procedencia", "Producto"=>"producto", "Precio"=>"precio"));
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

