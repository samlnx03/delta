<?php
// regresa las dimensiones dada el id de tabla
//
require_once "Auth/session.php";
//require_once "Auth/proteger.php";
$id=$_GET["id"];
$db=db::getInstance();
$q="select descrip, especie from tablas where id='$id'";
$db->query($q);
if($db->num_rows()>0){
	$db->next_row();
	echo json_encode(array(
		"especie"=>$db->f("especie"), 
		"descrip"=>$db->f("descrip")
		)
	);
}else {
	echo json_encode(array(
		"especie"=>"", 
		"descrip"=>""
		)
	);
}
?>

