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
$q="insert into tarimas(tarima, descripcion) values ('$tarima', '$descripcion')";
$db=db::getInstance();
$db->query($q);
$id=$db->insert_id;
//$_SESSION["q"]="$q<br>\n"; 
header("Location: tarimaDetalle.php?id=$id");	//a los detalles
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
