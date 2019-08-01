<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
$db=db::getInstance();
if(isset($_POST["borrarComprama"])){
	$id=$_SESSION["idcompra"];
	$q="delete from comprasMAmovs where idComprasMA='$id'";
	$db->query($q);
	$q="delete from comprasMA where id='$id'";
	$db->query($q);
	$_SESSION["msg"]="Compra eliminada";
	unset($_SESSION["idcompra"]);
	header('Location: comprasma.php');
}
?>
