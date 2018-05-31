<?php
require_once "Auth/session.php";
require_once "Auth/table.php";

require_once "desarrollo.php"; // reporta errores

?>
<?php
$desc="";
if(isset($_GET["descrip"])){
	$desc=$_GET["descrip"];
}
if($desc!="")
	$condi=" WHERE descrip like '$desc%'";
else
	$condi="";
$q="select id, especie, descrip, grueso, ugrueso, ancho, uancho, largo, ulargo, volpt from tablas $condi ORDER BY grueso";
$db=db::getInstance();
$db->query($q);
$t=new html_table();
$t->setTclas("Txml");
$t->setbody($db->get_all());
$t->addextras( array(
	"IO", 
	"<button onclick='botonclicked(this);return false;' class='green' id='ok' name='inout' value='%f0%'>OK</button>", 
	array("id")
	)
);
$t->setcdatas(array("Sel"=>"IO", "id"=>"id",
	"Especie"=>"especie", "Descrip"=>"descrip",
	"volpt"=>"volpt"
	)
);
//echo "q:$q<br>\n";
echo "<form>\n";
$t->show();
echo "</form>\n";
?>
