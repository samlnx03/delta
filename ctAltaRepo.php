<?php
require_once "desarrollo.php"; // show errors
require_once "Auth/session.php";

//	ALta del reporte de clavado

if(!isset($_POST["agregar"])){
	header('Location: ctNuevoRepo.php');
	die();
}
// checar que exista operador y ayudante
/*
$op=htmlNpost("operador");
if($op=="NULL") {
	$_SESSION["msg"]="Debe especificar operador";
	header('Location: prodNuevoRepo.php');
	die();
}

$db=db::getInstance();
$q="select nombre from empleados where id='$op'";
$db->query($q);
if($db->num_rows()==0){
	$_SESSION["msg"]="No existe el operador $op";
	header('Location: prodNuevoRepo.php');
	die();
}
$pctjOp=htmlNpost("pctjOp");
$ayu=htmlNpost("ayudante");
if($ayu!="NULL" AND $ayu!='0'){
	$pctjAyu=htmlNpost("pctjAyu");
	$q="select nombre from empleados where id='$ayu'";
	$db->query($q);
	if($db->num_rows()==0){
		$_SESSION["msg"]="No existe el ayudante $ayu"; 
		header('Location: prodNuevoRepo.php');
		die();
	}
} else{
	$pctjAyu=0;
}
 */
// dar el alta
$supervisor=htmlpost("supervisor");
$fecha=htmlFpost("fecha");
/*
$sierraCinta=htmlpost("sierraCinta");
$entrego=htmlpost("entrego");
$recibio=htmlpost("recibio");
 */
$db=db::getInstance();
$q="insert into repoCT(supervisor,fecha) values ('$supervisor',$fecha)";
$db->query($q);
$id=$db->insert_id;
//$_SESSION["q"]="$q<br>\n"; 
header("Location: ctDetalle.php?id=$id");	//a los detalles
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

