<?php
require_once "desarrollo.php"; // show errors
require_once "Auth/session.php";

//	ALta del reporte de otros destajos

if(!isset($_POST["agregar"])){
	header('Location: odNuevoRepo.php');
	die();
}
// dar el alta
$supervisor=htmlpost("supervisor");
$fecha=htmlFpost("fecha");
$observaciones=htmlpost("observaciones");
$db=db::getInstance();
$q="insert into repoOD(supervisor,fecha,observaciones) values ('$supervisor',$fecha,'$observaciones')";
$db->query($q);
$id=$db->insert_id;
header("Location: odDetalle.php?id=$id");	//a los detalles
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

