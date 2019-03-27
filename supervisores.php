<?php
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php";
// borrar 2
//require_once "Auth/proteger.php";
//require_once "funcs.php";

// alta
$db=db::getInstance();
$cond="";
$nobaja="baja=' '"; // una s es baja, va en el where mas adelante
if(isset($_POST["opcion"])){
	$opcion=$_POST["opcion"];
	$nombre=$_POST["nombre"];
	if($opcion=="Agregar"){
		$q="insert into supervisores (nombre) values ('$nombre')";
        	$db->query($q);
	} elseif($opcion=="Buscar"){
		$cond="nombre like '%$nombre%'";
	}
} else if(isset($_POST["borrar"])){ /// verificar que no se haya usado en algun reporte
	$id=$_POST["borrar"];
	$q="select id from repoProd where supervisor='$id'";
	$db->query($q);
	$ntr=$db->num_rows();
	$q="select id from repoCT where supervisor='$id'";
	$db->query($q);
	$ntr+=$db->num_rows();
	$q="select id from repoCL where supervisor='$id'";
	$db->query($q);
	$ntr+=$db->num_rows();
	$q="select id from repoOD where supervisor='$id'";
	$db->query($q);
	$ntr+=$db->num_rows();

	if($db->num_rows()>0){
		$_SESSION["msg"]="El supervisor tiene registros de producción";
	}
	else {
		$q="delete from supervisores where id='$id'";
		//$_SESSION["msg"]="$q";
		$db->query($q);
	}
} else if(isset($_POST["baja"])){
	$baja=$_POST["baja"];
	$_SESSION["msg"]="El supervisor ya no aparecerá en la lista";
} else if(isset($_POST["bajaokid"])){
	$id=$_POST["bajaokid"];
	$q="update supervisores set baja='s' where id='$id'";
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
<h1>Supervisores</h1>
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
<a href=supervisores.php>Regresar</a>
</form>
</body>
</html>
EOF;
	exit;
}
?>
<div id="altas">
<form method=POST>
nombre: <input type=text name=nombre size=60>
<input type=submit name=opcion value=Agregar>
<input type=submit name=opcion value=Buscar>
</form>
<a href=supervisores.php>Ver todos</a>
</div>


<div id="lista">
<?php
//<div id="lista" style="overflow:scroll">
if($cond!=''){
	$q="select id, nombre from supervisores WHERE $nobaja AND $cond order by id desc";
}else{
	$q="select id, nombre from supervisores WHERE $nobaja order by id desc";
}
//echo "q:$q<br>\n";
        $t=new html_table();
$t->addextras( array(
	"Acción", 
	"<button class='red' type='submit' name='borrar' value='%f0%'>Borrar</button>", 
	array("id")
	)
);
$t->addextras( array(
	"baja", 
	"<button class='red' type='submit' name='baja' value='%f0%'>Baja</button>", 
	array("id")
	)
);
$t->setcdatas(array("Acción"=>"Acción", "id"=>"id", "nombre" => "nombre", "Baja"=>"baja"));
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
