<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
<link rel="stylesheet" type="text/css" href="styles/2cols.css">
<script LANGUAGE="JavaScript">
</script>
</head>
<body>
<?php require('menu.php'); ?>
<h1>Produccion Sierras Cintas</h1>
<form>
<table>
<tr>
<td>Cantidad<br><input type=text name=cantidad size=9>
<td>Clave<br><input type=text name=clave size=5>
<td>Descripción<br><input type=text name=descripcion size=50>
<td>Cubicación<br><input type=text name=cubicacion>
<td>total<br><input type=text name=total>
<tr><td><td><td>
<div class="divrow">
<div class="divcol3">
<?php ifc("grueso");?>
</div>
<div class="divcol3">
<?php ifc("ancho");?>
</div>
<div class="divcol3">
<?php ifc("largo");?>
</div>
</div>
<td><td>
</table>

</form>
<?php
function ifc($d){	// inches feet centimetros en la dimension grueso ancho o largo
	echo "$d<br><input type='radio' name='$d' value='pulgadas'> Pulgadas<br>".
		"<input type='radio' name='$d' value='pies'> Pies<br>".
		"<input type='radio' name='$d' value='centimetros'> Centimetros";
}
?>
</body>
</html>

