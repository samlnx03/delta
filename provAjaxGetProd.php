<?php
// ajax regresa Proveedor, procedencia y producto dad la clave 
//
require_once "Auth/session.php";
require_once "Auth/proteger.php";
$id=$_GET["id"];
$db=db::getInstance();
$q="select prov.nombre, proced.procedencia, pg.generoDimension as producto ".
	"FROM provProductos prod ".
	"LEFT JOIN provProcedencias proced ON prod.id_proced=proced.id ".
	"LEFT JOIN proveedores prov ON prod.id_prov=prov.id ".
	"LEFT JOIN provGeneros pg ON prod.generoDimension=pg.id ".
       "where prod.id='$id'";
$db->query($q);
if($db->num_rows()>0){
	$db->next_row();
	echo json_encode(array(
		"prodDetalle"=>$db->f("producto")."+". $db->f("nombre")."+".$db->f("procedencia")
		)
	);
}else {
	echo json_encode(array(
		"prodDetalle"=>"" 
		)
	);
}
?>

