<?php

require_once "Auth/dbclass.php";
require_once "Auth/table.php";

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
</head>
<body>
<h1>Prueba de class tabla_html</h1>
<?php
$a=array(
	array("fruta" => "sandia", "color"=>"verde", "gusto"=>80),
	array("fruta" => "platano", "color"=>"amarillo", "gusto"=>70),
	array("fruta" => "fresa", "color"=>"rojo", "gusto"=>75),
	array("fruta" => "zapote", "color"=>"negro", "gusto"=>82)
);
	// mostrar en tabla
	$t=new html_table();
	$t->setbody($a);
	$t->show();

	echo "<br>\n";
	$t->setcdatas(array("nombre fruta"=>"fruta", "Colour"=>"color"));
	$t->show();
	echo "<br>\n";

	//$q="select 'link', variable, valor from entorno";
	$q="select id, nombre from empleados";
	$db=db::getInstance();
	$db->query($q);
	$t=new html_table();
	$t->setbody($db->get_all());
	$t->show();
	echo "<br>\n";

?>
</body>
</html>

<?php
function envVar($variable){
        $q="select valor from entorno where variable='$variable'";
        $db=db::getInstance();
        $db->query($q);
        $val="";
        while($db->next_row()){
                $val=$db->f("valor");
        }
        return $val;
}

function envVars(){
	$q="select variable, valor from entorno";
	$db=db::getInstance();
	$db->query($q);
	// mostrar sn tabla
	$t=new html_table();
	$t->setbody($db->get_all());
	//$t->setcdatas(array("var"=>"variable", "val"=>"valor"));
	$t->show();
	echo "<br>\n";

	$db->query($q);
	$ambiente=array();
	while($db->next_row()){
		$ambiente[$db->f("variable")]=$db->f("valor");
	}
	return $ambiente;
}

function showEnvVars($arr){
foreach($arr as $key => $value)
	echo "variable $key = $value<br>\n";
}

function hayXmlSinProcesar($xmlpath2save){
	//echo "Revisando: $xmlpath2save<br>\n";
	$dir = "$xmlpath2save/";
	// Open a known directory, and proceed to read its contents
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if(substr($file,-3)=="xml" || substr($file,-3)=="XML")
					return true;
					//echo "filename: $file : filetype: " . filetype($dir . $file) . "<br>\n";
			}
        	}
	}
        closedir($dh);
	return false;
}

?>

