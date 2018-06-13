CREATE TABLE `repoCL` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supervisor` char(20) DEFAULT NULL,
  `area` int DEFAULT 0,
  `fecha` date DEFAULT NULL,
  `sierraGemela` char(10) DEFAULT NULL,
  `operador` int(11) DEFAULT NULL,
  `entrego` char(20) DEFAULT NULL,
  `recibio` char(20) DEFAULT NULL,
  `aplicadaEnInventario` char(1) DEFAULT 'n',
  PRIMARY KEY (`id`),
  KEY `fecha` (`fecha`),
  KEY `operador` (`operador`)
);

CREATE TABLE `movsRepoCL` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idRepoCL` int(11) DEFAULT NULL,
  `actividad` char(10) NOT NULL COMMENT 'aserrio u hojeado',
  `cantidad` int(11) NOT NULL,
  `idtabla` int(11) NOT NULL COMMENT 'la tabla incluye la especie de madera',
  `tipomov` enum('descontar','agregar') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idRepoCL` (`idRepoCL`),
  KEY `actividad` (`actividad`,`idtabla`)
);

