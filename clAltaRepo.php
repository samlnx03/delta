<?php
require_once "Auth/proteger.php";
require_once "desarrollo.php"; // show errors
require_once "Auth/session.php";

if(!isset($_POST["agregar"])){
	header('Location: clNuevoRepo.php');
	die();
}
// checar que exista operador
$op=htmlNpost("operador");
if($op=="NULL") {
	$_SESSION["msg"]="Debe especificar operador";
	header('Location: clNuevoRepo.php');
	die();
}

$db=db::getInstance();
$q="select nombre from empleados where id='$op'";
$db->query($q);
if($db->num_rows()==0){
	$_SESSION["msg"]="No existe el operador $op";
	header('Location: clNuevoRepo.php');
	die();
}
// dar el alta
$supervisor=htmlpost("supervisor");
$fecha=htmlFpost("fecha");
$sierraGemela=htmlpost("sierraGemela");
//$area=htmlNpost("area");
$entrego=htmlpost("entrego");
$recibio=htmlpost("recibio");
$q="insert into repoCL(supervisor,fecha,sierraGemela, operador, entrego, recibio) values ('$supervisor',$fecha,'$sierraGemela',$op, '$entrego','$recibio')";
$db->query($q);
$id=$db->insert_id;
//$_SESSION["q"]="$q<br>\n"; 
header("Location: clDetalle.php?id=$id");	//a los detalles
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

