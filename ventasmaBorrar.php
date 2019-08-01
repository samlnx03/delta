<?php
require_once "Auth/proteger.php";
require_once "Auth/session.php";
require_once "Auth/table.php";
require_once "desarrollo.php"; // debug show errors

require_once "funcs.php";  // funciones utiles
$db=db::getInstance();
if(isset($_POST["borrarVentama"])){
	$id=$_SESSION["idventa"];
	$q="delete from ventasMAmovs where idVentasMA='$id'";
	$db->query($q);
	$q="delete from ventasMA where id='$id'";
	$db->query($q);
	$_SESSION["msg"]="Venta eliminada";
	unset($_SESSION["idventa"]);
	header('Location: ventasma.php');
}
?>
