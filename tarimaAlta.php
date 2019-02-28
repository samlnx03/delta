<?php
require_once "desarrollo.php"; // show errors
require_once "Auth/session.php";
// borrar 2
//require_once "Auth/proteger.php";
//require_once "funcs.php";

if(!isset($_POST["agregar"])){
	header('Location: tarimaNueva.php');
	die();
}
// dar el alta
$tarima=htmlpost("tarima");
$descripcion=htmlpost("descripcion");
$db=db::getInstance();
// checar que no exista la clave en actividades y en tarimas
$q="select tarima,descripcion from tarimas where tarima='$tarima'";
$db->query($q);
if($db->num_rows()>0){
	$_SESSION["msg"]="Ya existe la clave $tarima para otra tarima";
	header('Location: tarimaNueva.php');
	die();
}
$q="select descrip from actividades where clave='ct$tarima'";
$db->query($q);
if($db->num_rows()>0){
	$_SESSION["msg"]="Ya existe la clave $tarima en otra actividad";
	header('Location: tarimaNueva.php');
	die();
}
$q="insert into tarimas(tarima, descripcion) values ('$tarima', '$descripcion')";
$db->query($q);
$_SESSION["msg"]="Agregada tarima ".$db->insert_id;
$_SESSION["idtarima"]=$db->insert_id;
// insertar tambien la clave de produccion para clavado
// el costo de clavado se debe poner en actividades
$clave="ct$tarima";
$q="select substr(clave,-1) as proceso from claveValor where valor='Clavado de Tarima'";
$db->query($q);
if($db->num_rows()>0) {$db->next_row(); $proceso=$db->f("proceso");} else $proceso=0;
//$q="insert into actividades (clave, descrip, costo, unidad, tipo) values ('$clave','$descripcion',0,'tarima','tarima')";
$q="insert into actividades (clave, descrip, costo, unidad, proceso) values ('$clave','$descripcion',0,'tarima',$proceso)";
$db->query($q);
//$_SESSION["q"]="$q<br>\n"; 
$_SESSION["msg"].="<br><br>Se agregó actividad de producción pero debe poner el costo en Actividades ";
header("Location: tarimaDetalle.php");	//a los detalles, ya hay id de tarima en la session
die();
?>

<?php
require_once "funcs.php";
function htmlpost($campo){
	if(isset($_POST[$campo])) 
		return $_POST[$campo];
	return '';
}
function htmlNpost($campo){	// numero
	$d=htmlpost($campo);
	if(strlen($d)==0)
		return "NULL";
	return $d;
}
function htmlFpost($campo){  // fecha
	$d=htmlpost($campo);
	if(strlen($d)==0)
		return "NULL";
	return "'$d'";
}

?>
