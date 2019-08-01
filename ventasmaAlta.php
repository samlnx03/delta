<?php
require_once "Auth/proteger.php";
require_once "desarrollo.php"; // show errors
require_once "Auth/session.php";

if(!isset($_POST["agregar"])){
	header('Location: ventasmaNueva.php');
	die();
}
// dar el alta
$fecha=htmlFpost("fecha");
$cliente=htmlpost("cliente");
$observ=htmlpost("observ");
$db=db::getInstance();

$q="insert into ventasMA(fecha, cliente, observ) values ($fecha, '$cliente','$observ')";
$db->query($q);
$_SESSION["msg"]="Venta agregada ".$db->insert_id;
$_SESSION["idventa"]=$db->insert_id;
header("Location: ventasmaDetalle.php");	//a los detalles, ya hay id de compra en la sessioni
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
