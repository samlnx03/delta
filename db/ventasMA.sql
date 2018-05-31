CREATE TABLE `ventasMA` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `cliente` char(80) DEFAULT NULL,
  `observ` char(80) DEFAULT NULL,
  `editable` char(1) DEFAULT 's' comment 'al cambiar a no editable se aplica al inventario',
  PRIMARY KEY (`id`)
);

CREATE TABLE `ventasMAmovs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idVentasMA` int(11) NOT NULL,
  `idtabla` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idVentasMA` (`idVentasMA`)
);
