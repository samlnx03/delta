<?php
require_once "desarrollo.php"; // show errors
require_once "Auth/session.php";

if(!isset($_POST["agregar"])){
	header('Location: comprasmaNueva.php');
	die();
}
// dar el alta
$fecha=htmlFpost("fecha");
$proveedor=htmlpost("proveedor");
$observ=htmlpost("observ");
$db=db::getInstance();

$q="insert into comprasMA(fecha, proveedor, observ) values ($fecha, '$proveedor','$observ')";
$db->query($q);
$_SESSION["msg"]="Compra agregada ".$db->insert_id;
$_SESSION["idcompra"]=$db->insert_id;
header("Location: comprasmaDetalle.php");	//a los detalles, ya hay id de compra en la sessioni
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
