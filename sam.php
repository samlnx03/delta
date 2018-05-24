<?php
require_once "Auth/session.php";
require_once "desarrollo.php";
// borrar 2
//require_once "Auth/proteger.php";
//require_once "funcs.php";

?>

<html>
<head>
</head>

<body>
<h1>Link together</h1>
<?php
$db=db::getInstance();
if(isset($_POST["linktogether"])){
	$l=$_POST["linktogether"];
	$q="REPLACE INTO claveValor (clave, valor) VALUES ('linktogether', '$l')";
	$db->query($q);
	echo "link registrado<br>\n";
}
if(isset($_POST["quitar"])){
	$q="DELETE FROM claveValor WHERE clave='linktogether'";
	$db->query($q);
	echo "link eliminado<br>\n";
}
?>
<form method=POST>
link: <input type=text name=linktogether size=60>
<input type=submit name=opcion value=Registrar>
<input type=submit name=quitar value=Quitar>
</form>

</body>
</html>

