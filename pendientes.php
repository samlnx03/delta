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

agilizar captura de tabla de dimensiones muy comunes
-en movimeinto de reporte de produccion
-en def de tarima
usar un lista desplegable o cuadro de texto
las mas comunes se editan en una tabla

Madera dimensionada
agregar entrdas y salidas para ajustes de inventario

Invetario
al consultar el inventario reportar si hay reportes de produccion pendientes o entradas/salidas de madera dimensionada

Reporte de produccion
actualizar la bandera al aplicar al inventario los reportes de producción
solo afectan al inventario los destajos de tablas (el aserrio y el hojeado)

agregar otros destajos sin sierra cinta prque en el reporte de prod solo salen op y ay
y hay destajos de gente que no sierracinteros

Reporte de produccion
registrar el rollito que se uso para descontar del inventario (que largo, piezas o m3)

Reporte de produccion
poder borrar el reporte si no a sido aplicado al inventario
agregar boton de aplicar reporte al inventario
al agregar aserrio u hojeado normalizar las dimensiones para la busqueda
no se deben ven las tarimas a menos que este cerrada su definicion (que ya no se pueda cambiar las tablas que tiene una tarima)

corte a largo
ver la produccion de madera dimensionada y poder escoger cual se pasa en bloque a corte a largo
y quien realiza el destajo (sierras paralelas)

madDimensionadaNueva.php
quitar espacios al frente y detras de las dimensiones

filtros como excel en el inventario de madera dimensionada

-------- YA REALIZADO ----
alta de madera aserrada que ya existen dimensiones pero es otra especie (agilizar)

Tarima. poder cambiarle el nombre (antes de cerrar la definicion)
y borrar la tarima (antes de cerrar definicion)

madDimensionadaNueva.php
solo mayusculas en la especie

Empleados agregar boton de dar de BAJA (no borrar para mantener historico)
no se debe poder borrar si esta en reportes de produccion como operador o ayudante

Borrar en actividades YA funciona
no de debe poder borrar si hay produccion de esa actividad (bandera?) no, se checa la tabla de movs del reporte de produccion.

Reporte de produccion
una vez agregado a inventarios no de debe poder modificar (prodDetalle.php)

</pre>

</body>
</html>

