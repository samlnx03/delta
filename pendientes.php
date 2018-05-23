<?php

//require_once "Auth/proteger.php";
//require_once "funcs.php";

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/menu.css">
<link rel="stylesheet" type="text/css" href="styles/tableStyle.css">
</head>
<body>
<?php require('menu.php'); ?>
<h1>Pendientes en el desarrollo del sistema</h1>
<pre>

Empleados agregar boton de dar de BAJA (no borrar para mantener historico)
no se debe poder borrar si esta en reportes de produccion como operador o ayudante

Madera dimensionada
agregar entrdas y salidas para ajustes de inventario

Invetario
al consultar el inventario reportar si hay reportes de produccion pendientes o entradas/salidas de madera dimensionada

Reporte de produccion
actualizar la bandera al aplicar al inventario los reportes de producción
solo afectan al inventario los destajos de tablas (el aserrio y el hojeado)

Reporte de produccion
al agregar aserrio u hojeado normalizar las dimensiones para la busqueda

-------- YA REALIZADO ----

Borrar en actividades YA funciona
no de debe poder borrar si hay produccion de esa actividad (bandera?) no, se checa la tabla de movs del reporte de produccion.

Reporte de produccion
una vez agregado a inventarios no de debe poder modificar (prodDetalle.php)

</pre>

</body>
</html>

