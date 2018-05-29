<?php
require_once "Auth/session.php";
require_once "Auth/table.php";

require_once "desarrollo.php"; // reporta errores

?>
<?php

$results=0; // hay resultados de la consulta
//if(isset($descrip)){
//$condi=" WHERE descrip like '$descrip%'";
$condi=" WHERE descrip like '3/4%'";
$q="select id, especie, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt from tablas $condi ORDER BY especie,grueso";
$db=db::getInstance();
$db->query($q);
$t=new html_table();
$t->setbody($db->get_all());
$t->addextras( array(
	"IO", 
	"<button class='red' type='submit' name='inout' value='%f0%'>E/S</button>", 
	array("id")
	)
);
$t->setcdatas(array("Seleccionar"=>"IO", "id"=>"id",
	"Especie"=>"especie", "Descrip"=>"descrip",
	"grueso" => "grueso", "ug"=>"ugrueso", "ancho"=>"ancho", "ua"=>"uancho", 
	"largo"=>"largo", "ul"=>"ulargo", "volpt"=>"volpt"
	)
);
$t->show();
?>
