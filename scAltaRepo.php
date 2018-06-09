<?php
require_once "desarrollo.php"; // show errors
require_once "Auth/session.php";
// borrar 2
//require_once "Auth/proteger.php";
//require_once "funcs.php";

if(!isset($_POST["agregar"])){
	header('Location: scNuevoRepo.php');
	die();
}
// checar que exista operador y ayudante
$op=htmlNpost("operador");
if($op=="NULL") {
	$_SESSION["msg"]="Debe especificar operador";
	header('Location: scNuevoRepo.php');
	die();
}

$db=db::getInstance();
$q="select nombre from empleados where id='$op'";
$db->query($q);
if($db->num_rows()==0){
	$_SESSION["msg"]="No existe el operador $op";
	header('Location: scNuevoRepo.php');
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
		header('Location: scNuevoRepo.php');
		die();
	}
} else{
	$pctjAyu=0;
}
// dar el alta
$supervisor=htmlpost("supervisor");
$fecha=htmlFpost("fecha");
$sierraCinta=htmlpost("sierraCinta");
$entrego=htmlpost("entrego");
$recibio=htmlpost("recibio");
$q="insert into repoProd(supervisor,fecha,sierraCinta, operador, pctjOp, ayudante, pctjAyu, entrego, recibio) values ('$supervisor',$fecha,'$sierraCinta',$op, $pctjOp, $ayu,$pctjAyu, '$entrego','$recibio')";
$db->query($q);
$id=$db->insert_id;
//$_SESSION["q"]="$q<br>\n"; 
header("Location: scDetalle.php?id=$id");	//a los detalles
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

