-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: delta
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `DELmovsRepoOtrasActiv`
--

DROP TABLE IF EXISTS `DELmovsRepoOtrasActiv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DELmovsRepoOtrasActiv` (
  `id` int(11) NOT NULL DEFAULT '0',
  `idRepo` int(11) NOT NULL,
  `actividad` char(12) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL COMMENT 'a quien se le paga el destajo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DELmovsRepoOtrasActiv`
--

LOCK TABLES `DELmovsRepoOtrasActiv` WRITE;
/*!40000 ALTER TABLE `DELmovsRepoOtrasActiv` DISABLE KEYS */;
INSERT INTO `DELmovsRepoOtrasActiv` VALUES (3,6,'hra',1,35),(4,6,'hra',1,19),(5,8,'hra',1,13),(6,8,'hra',1,14),(7,9,'hra',1,4),(8,9,'hra',1,2),(9,10,'ctCORONA',66,12),(10,10,'ct43 1/4 1/2',20,12),(11,11,'ctCORONA',26,36),(12,11,'ct43 1/4 1/2',12,36),(13,12,'ctCORONA',6,38),(14,12,'ct43 1/4 1/2',76,38),(15,18,'ctDAL 38X38',48,46),(16,19,'hra',1,15),(17,19,'hra',1,26),(19,20,'Caja 2',11,25),(20,20,'Caja 2',11,5),(21,20,'hra',1,25),(22,20,'hra',1,5),(23,21,'hra',1,8),(24,21,'hra',1,48),(26,23,'ct43 1/4 1/2',58,17),(27,24,'ct43 1/4 1/2',42,10),(30,25,'ct43 1/4 1/2',47,30),(31,25,'ctDAL 36X48',12,30),(32,25,'hra Clava1',3,30),(33,24,'hra Clava1',3,10),(34,23,'hra Clava1',3,17),(36,11,'hra Clava2',1,36),(37,12,'hra Clava2',2,38),(38,13,'ctDAL 38X38',48,46),(39,13,'hra Clava2',3,46),(40,26,'ctCORONA',66,12),(41,26,'ct43 1/4 1/2',20,12),(42,26,'hra Clava1',2,12),(43,22,'hra Barrer',2,49),(44,33,'YUGO',1100,22);
/*!40000 ALTER TABLE `DELmovsRepoOtrasActiv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actividades`
--

DROP TABLE IF EXISTS `actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividades` (
  `clave` char(12) NOT NULL,
  `descrip` char(50) DEFAULT NULL,
  `costo` decimal(9,4) DEFAULT NULL,
  `unidad` char(10) DEFAULT NULL,
  `tipo` enum('tabla','tarima','otro') DEFAULT 'otro',
  `inventario` int(11) NOT NULL DEFAULT '0' COMMENT 'invent# de claveValor -> tabla inventario',
  `proceso` int(11) DEFAULT '0',
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividades`
--

LOCK TABLES `actividades` WRITE;
/*!40000 ALTER TABLE `actividades` DISABLE KEYS */;
INSERT INTO `actividades` VALUES ('1-2 Rabr','Abrir Rollos',8.0000,'Pieza','otro',0,0),('1-3 Rarr','Arrimar Rollos',20.0000,'HORA','otro',0,0),('10-1 EnTGA','Entongado  A',19.7900,'HORA','otro',0,0),('10-1 EnTGB','Entongado B',18.7500,'HORA','otro',0,0),('10-1 EnTGC','Entongado C',17.0800,'HORA','otro',0,0),('10-1 EnTGD','Entongado D',15.0000,'HORA','otro',0,0),('10-2  CAvA','Clavador(A) -Act. Varias en Area Aserrio',20.0000,'HORA','otro',0,0),('10-2  CAvC',' Clavador(A)  -Act. Varias en Area Clavado',20.0000,'HORA','otro',0,0),('10-2  CAvE','Clavador(A) -Act. Varias en Area Embarques',20.0000,'HORA','otro',0,0),('10-2  CAvP','Clavador(A) -Act. Varias en Area Patios',20.0000,'HORA','otro',0,0),('10-2  SCAv','S.cintero(A)-Act. Varias  Area Patios',62.1900,'HORA','otro',0,0),('10-2  SCBC','S.cintero(B)-Act.varias Area Clavado',62.1000,'HORA','otro',0,0),('10-2  SCBE','S.cintero(B)-Act.Varias  Area Embarques',62.1000,'HORA','otro',0,0),('10-2  SCBP','S.cintero(B)-Act. Varias  Area Patios',62.1000,'HORA','otro',0,0),('10-2  SCNP','S.cintero(A)-Act.Varias No Proceso Produccion',62.1900,'HORAS','otro',0,0),('2-1 AsCB','Aserrio rollito Cedro Blanco',0.5000,'pie-tabla','tabla',1,1),('2-1 AsEN','Aserrio rollito Encino',0.5000,'pie-tabla','tabla',1,1),('2-1 AsEu','Aserrio rollito Eucalipto',0.5000,'pie-tabla','tabla',1,1),('2-1 AsML','Aserrio rollito Melina',0.5000,'pie-tabla','tabla',1,1),('2-1 AsOH','Aserrio rollito Otras Hojosas',0.5000,'pie-tabla','tabla',1,1),('2-1 AsOY','Aserrio rollito oyamel',0.5000,'pie-tabla','tabla',1,1),('2-1 AsP','Aserrio rollito pino',0.5000,'pie-tabla','tabla',1,1),('2-2 AsCB','Aserrio rollo LD Cedro Blanco-8',1.0000,'pie-tabla','tabla',1,1),('2-2 AsEN','Aserrio rollo LD Encino-8',1.0000,'pie-tabla','tabla',1,1),('2-2 AsOY','Aserrio rollo LD Oyamel-8',1.0000,'pie-tabla','tabla',1,1),('2-2 AsP','Aserrio rollo LD pino  -8',1.0000,'pie-tabla','tabla',1,1),('2-2-1 AsCB','Aserrio rollo LD Cedro Blanco-8 1/4',1.0000,'pie-tabla','tabla',1,1),('2-2-1 AsEN','Aserrio rollo LD Encino-8 1/4',1.0000,'pie-tabla','tabla',1,1),('2-2-1 AsP','Aserrio rollo LD pino  -8 1/4',1.0000,'pie-tabla','tabla',1,1),('2-3 AsCBZ','Aserrio cajas -Cabecera',5.0000,'bulto','otro',0,0),('2-3 AsCJD','Aserrio cajas -Duela',12.0000,'bulto','otro',0,0),('2-3 AsCJE','Aserrio cajas -Esquinero',18.0000,'bulto','otro',0,0),('2-4-Rec2','Rectificado dos lados y recortado',0.1800,'pie-tabla','tabla',0,0),('3-1HjPV','Hojeado Pino de Viga-Delta',0.2150,'pie-tabla','tabla',0,0),('4-1 RcCD','Recorte Tabla Corona-Delta',0.0400,'pie-tabla','tabla',0,2),('4-1 RcCF','Recorte Tabla Corona -comprada',0.0400,'pie-tabla','tabla',0,2),('4-1 RcCMC','Recorte Tabla Mainland -comprada',0.0400,'pie-tabla','tabla',0,2),('4-1 RcCMD','Recorte Tabla Mainland-Delta',0.0400,'pie-tabla','tabla',0,2),('4-1 RcDD','Recorte Tabla Daltile-Delta',0.0400,'pie-tabla','tabla',0,2),('4-1 RcDF','Recorte Tabla Daltile-comprada',0.0400,'pie-tabla','tabla',0,2),('4-1 RcIQC','Recorte Tabla IEQSA -comprada',0.0400,'pie-tabla','tabla',0,2),('4-1 RcIQD','Recorte Tabla IEQSA-Delta',0.0400,'pie-tabla','tabla',0,2),('5-1- BrA','Borcelado',30.8300,'HORAS','otro',0,0),('5-1- BrB','Borcelado',20.8500,'HORA','otro',0,0),('5-1- BrC','Borcelado',19.7900,'HORAS','otro',0,0),('5-2 Yg','Saque de Yugo y Corte 45',0.2100,'pie-tabla','tabla',0,1),('5-4 MpCD','Marcado de polin Corona-Delta',20.8300,'HORA','otro',0,0),('5-4 MpCF','Marcado de polin Corona-Foranea',20.8300,'HORA','otro',0,0),('5-4 MpDD','Marcado de polin Daltile-Delta',20.8300,'HORA','otro',0,0),('5-4 MpDF','Marcado de polin Daltile-Foranea',20.8300,'HORA','otro',0,0),('6-1 BTrA','BaÃ±o-Limpieza Maderas-A',37.7500,'HORA','otro',0,0),('6-1 BTrB','BaÃ±o-Limpieza Maderas-B',30.7500,'HORA','otro',0,0),('6-1 BTrC','BaÃ±o-Limpieza Maderas-C',20.8300,'HORA','otro',0,0),('6-1 BTrD','BaÃ±o-Limpieza Maderas-D',19.7900,'HORA','otro',0,0),('6-1 BTrE','BaÃ±o-Limpieza Maderas-E',18.8500,'HORA','otro',0,0),('6-1 BTrF','BaÃ±o-Limpieza Maderas-F',18.7500,'HORA','otro',0,0),('8-1 CrA','Estufado-Corona',150.0000,'HORA','otro',0,0),('8-1 CrB','Estufado-Corona',100.0000,'otro','otro',0,0),('8-1 CrF','Estufado-Corona',200.0000,'HORA','otro',0,0),('8-1 IEQA','Estufado-IEQSA',150.0000,'DIA','otro',0,0),('8-1 IEQB','Estufado-IEQSA',100.0000,'DIA','otro',0,0),('8-1 IEQF','Estufado-IEQSA',200.0000,'DIA','otro',0,0),('8-2 Velar','velar',142.8600,'DIA','otro',0,0),('9-1 PEmbA','Preparar embarque',19.7900,'HORA','otro',0,0),('9-1 PEmbB','Preparar embarque',18.7500,'HORA','otro',0,0),('9-1 PembC','Preparar embarque',16.6600,'HORA','otro',0,0),('9-1 PEmbS','SelecciÃ³n de Tarimas',20.0000,'HORA','otro',0,0),('ct 0085D','Daltile-38\" x 42.5\"',2.4600,'tarima','tarima',0,3),('ct0043D','Daltile- 38\" x 38\"',2.2100,'tarima','tarima',0,3),('ct0139D','Daltile- 43.25 x 43.25 CON 3/4',2.2800,'tarima','tarima',0,3),('ct0141D','Daltile-38.5\" x 43.25\"',1.9400,'tarima','tarima',0,3),('ct0141D+','Daltile- 39\" x 44\"',1.9400,'tarima','tarima',0,0),('ct0174D','Daltile- 36\" x 48\"',2.9000,'tarima','tarima',0,3),('ct0203D','Daltile- 31\"  X  34\"',2.2000,'tarima','tarima',0,3),('ct0207D','Daltile- 44\" x 46\"',2.2900,'tarima','tarima',0,3),('ct0224D','Daltile-44\"x49\"',2.6400,'tarima','tarima',0,3),('ct0236D','Daltile- 31\"  X  42\"',0.0000,'tarima','tarima',0,0),('ctCOR01','Corona- 40 x 48 Euro',3.5700,'tarima','tarima',0,3),('ctIEQ','IEQSA  40\" x 48\"',3.1000,'tarima','tarima',0,3),('ctMAI01','MAINLAND- 40 x 48 CON TAQUETE DE  9 TABLAS',3.2000,'tarima','tarima',0,3);
/*!40000 ALTER TABLE `actividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `claveValor`
--

DROP TABLE IF EXISTS `claveValor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `claveValor` (
  `clave` char(20) NOT NULL,
  `valor` char(255) DEFAULT NULL,
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `claveValor`
--

LOCK TABLES `claveValor` WRITE;
/*!40000 ALTER TABLE `claveValor` DISABLE KEYS */;
INSERT INTO `claveValor` VALUES ('invent0','-- NO --'),('invent1','tablas'),('proceso0','Otros destajos'),('proceso1','Aserrio'),('proceso2','Corte a Longitud'),('proceso3','Clavado de Tarima');
/*!40000 ALTER TABLE `claveValor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprasMA`
--

DROP TABLE IF EXISTS `comprasMA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comprasMA` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `proveedor` char(80) DEFAULT NULL,
  `observ` char(80) DEFAULT NULL,
  `editable` char(1) DEFAULT 's' COMMENT 'al cambiar a no editable se aplica al inventario',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprasMA`
--

LOCK TABLES `comprasMA` WRITE;
/*!40000 ALTER TABLE `comprasMA` DISABLE KEYS */;
INSERT INTO `comprasMA` VALUES (4,'2019-01-05','EMIGDIO ORNELAS LOPEZ','Aserrada L.A.B planta','s'),(5,'2019-01-09','EMIGDIO ORNELAS LOPEZ','Aserrada L.A.B planta','s'),(6,'2019-01-11','EMIGDIO ORNELAS LOPEZ','Aserrada L.A.B planta','s'),(7,'2019-01-12','EMIGDIO ORNELAS LOPEZ','Aserrada L.A.B planta','s'),(10,'2019-01-17','EMIGDIO ORNELAS LOPEZ','Aserrada L.A.B planta','s'),(11,'2019-01-18','EMIGDIO ORNELAS LOPEZ','Aserrada L.A.B planta','s'),(12,'2019-01-21','EMIGDIO ORNELAS LOPEZ','Aserrada L.A.B planta','s'),(13,'2019-01-30','EMIGDIO ORNELAS LOPEZ','Aserrada L.A.B planta','s'),(14,'2019-01-05','JUAN ROSALES SOBERANO','Aserrada L.A.B planta','s'),(15,'2019-01-17','JUAN ROSALES SOBERANO','Aserrada L.A.B planta','s'),(16,'2019-01-28','JUAN ROSALES SOBERANO','Aserrada L.A.B planta','s'),(17,'2019-01-03','VICTOR EFRAIN GALLARDO SOBERANO','Aserrada L.A.B planta','s'),(18,'2019-01-09','VICTOR EFRAIN GALLARDO SOBERANO','Aserrada L.A.B planta','s');
/*!40000 ALTER TABLE `comprasMA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprasMAmovs`
--

DROP TABLE IF EXISTS `comprasMAmovs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comprasMAmovs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idComprasMA` int(11) NOT NULL,
  `idtabla` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idComprasMA` (`idComprasMA`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprasMAmovs`
--

LOCK TABLES `comprasMAmovs` WRITE;
/*!40000 ALTER TABLE `comprasMAmovs` DISABLE KEYS */;
INSERT INTO `comprasMAmovs` VALUES (1,4,257,2832),(2,4,260,11504),(3,5,257,2179),(4,5,260,9990),(5,5,269,1360),(6,5,274,371),(7,5,258,499),(9,6,265,4682),(10,6,264,2184),(11,6,241,2198),(12,6,257,1188),(13,6,260,2573),(14,7,268,4679),(15,7,281,1766),(16,7,257,964),(17,7,274,891),(18,7,260,4619),(19,10,268,3352),(20,10,281,1850),(21,10,257,205),(23,10,260,2379),(24,10,271,1250),(25,10,272,3499),(26,10,273,1094),(27,11,257,673),(28,11,260,6673),(29,11,271,1260),(30,11,250,4549),(31,11,273,1998),(32,12,257,1341),(33,12,260,6701),(34,12,281,1927),(35,12,268,2999),(36,12,258,94),(37,13,274,1794),(38,13,260,993),(39,13,269,3414),(40,13,281,1007),(41,13,271,1150),(42,13,273,1179),(43,13,272,2278),(44,13,268,1615),(45,14,288,1780),(46,14,222,900),(47,15,288,1752),(50,15,222,876),(51,16,288,1769),(52,16,222,1360),(53,17,288,910),(54,17,222,490),(55,17,223,55),(56,18,288,980),(57,18,222,570),(58,18,223,60);
/*!40000 ALTER TABLE `comprasMAmovs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deftarima`
--

DROP TABLE IF EXISTS `deftarima`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deftarima` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtarima` int(11) NOT NULL,
  `idtabla` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deftarima`
--

LOCK TABLES `deftarima` WRITE;
/*!40000 ALTER TABLE `deftarima` DISABLE KEYS */;
INSERT INTO `deftarima` VALUES (107,27,224,2),(108,27,225,6),(109,27,226,2),(110,27,227,2),(111,27,248,4),(115,29,243,9),(116,29,249,5),(117,29,245,4),(118,30,246,7),(119,30,246,4),(120,30,247,4),(121,31,228,9),(122,31,229,4),(123,31,228,4),(124,32,250,8),(125,32,248,4),(126,32,251,4),(127,33,242,8),(128,33,252,4),(129,33,253,4),(130,34,230,9),(131,34,231,4),(132,34,232,4),(133,35,254,11),(134,35,230,4),(135,35,234,4),(136,36,235,6),(137,36,255,4),(139,36,236,3),(140,36,206,3),(141,36,256,6),(142,36,238,2),(143,36,239,3),(144,37,235,9),(145,37,236,3),(146,37,205,3),(147,37,206,6),(148,37,235,2),(149,37,237,3),(150,38,235,8),(151,38,236,3),(152,38,205,3),(153,38,206,6),(154,38,235,2),(155,38,237,3),(156,39,230,7),(157,39,230,4),(159,39,296,4),(160,40,299,11),(161,40,300,4),(162,40,299,4);
/*!40000 ALTER TABLE `deftarima` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destajosDim`
--

DROP TABLE IF EXISTS `destajosDim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `destajosDim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idDimensionado` int(11) DEFAULT NULL COMMENT 'tabla movsRepoDimensionado',
  `idEmpleado` int(11) NOT NULL,
  `cubicacionPT` decimal(9,3) DEFAULT NULL,
  `costo_pu` decimal(9,4) DEFAULT NULL COMMENT 'de la tabla de actividades',
  `costo` decimal(9,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idEmpleado` (`idEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destajosDim`
--

LOCK TABLES `destajosDim` WRITE;
/*!40000 ALTER TABLE `destajosDim` DISABLE KEYS */;
/*!40000 ALTER TABLE `destajosDim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destajosOtros`
--

DROP TABLE IF EXISTS `destajosOtros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `destajosOtros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idOtras` int(11) DEFAULT NULL COMMENT 'tabla movsRepoOtrasActividades',
  `idEmpleado` int(11) NOT NULL,
  `costo_pu` decimal(9,4) DEFAULT NULL COMMENT 'de la tabla de actividades',
  `costo` decimal(9,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idEmpleado` (`idEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destajosOtros`
--

LOCK TABLES `destajosOtros` WRITE;
/*!40000 ALTER TABLE `destajosOtros` DISABLE KEYS */;
/*!40000 ALTER TABLE `destajosOtros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(60) DEFAULT NULL,
  `baja` char(1) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (2,'TALAVERA MEJIA JESUS','s'),(9,'BARRIGA PIÃ‘A ANTONIO','s'),(54,'ALONSO NAMBO IGNACIO',''),(55,' ALONSO NAMBO SANTIAGO',''),(56,' BASTIDA GUZMAN JOSE',''),(57,' BEDOLLA CORONA BELEN',''),(58,'BARRERA SERVIN JOSE',''),(59,'BARRIGA MOTA CRISTINA',''),(60,'BARRIGA PIÃ‘A ADOLFO',''),(61,'BARRIGA RODRIGUEZ ADRIAN',''),(62,'DIAZ IBAÃ‘EZ ARTURO',''),(63,' DOMINGO CORONA GLORIA',''),(64,'GARCIA ONOFRE EDUARDO',''),(65,' GONZALEZ FRAGA UBALDO',''),(66,'GONZALEZ VELEZ ALMA DELIA',''),(67,'HERNANDEZ ACOSTA ROSA ELENA',''),(68,'LARA VELEZ MARIA DEL CARMEN',''),(69,'LEDEZMA FUERTE ANGEL',''),(70,'MELCHOR LOPEZ JOSE LUIS',''),(71,' MELCHOR MOTA ZENAIDA',''),(72,'MONTAÃ‘O PAHUA RAFAEL',''),(73,'MOTA LOPEZ MARIA ESTHER',''),(74,' OLIVO SIXTOS FERNANDO',''),(75,' ORTEGA ALVAREZ FRANCISCO',''),(76,'PIÃ‘A PIÃ‘A ARMANDO',''),(77,' PIÃ‘A PIÃ‘A MARINA',''),(78,' PIÃ‘A TORRES GUADALUPE',''),(79,'PURECO SAAVEDRA MAXIMILIANO',''),(80,'RAFAEL BUENROSTRO GUTIERREZ',''),(81,' REYES AGUILAR CARLOS ALBERTO',''),(82,' REYES AGUILAR DANIEL ALBERTO',''),(83,'SANCHEZ SANCHEZ  LUIS FELIPE',''),(84,'SANCHEZ SANCHEZ SUSANA',''),(85,' SAAVEDRA MOLINERO JORGE',''),(87,'SERVIN GARFIAS GILDARDO',''),(88,' TALAVERA MORALES ANTONIO',''),(89,'TINOCO CAMPOS ROBERTO',''),(90,'VELEZ PIÃ‘A JUAN CARLOS',''),(93,'TALAVERA MORALES ERASMO',''),(94,'LARA VELEZ VICTOR',''),(95,'CALVILLO SOTO GILDARDO',''),(96,'HERNANDEZ ACOSTA ROSA ELENA',''),(98,'PIÃ‘A TORRES J GUADALUPE',''),(99,'BARRIGA PIÃ‘A ALFONSO',''),(100,'BARRIGA PIÃ‘A LEONEL',''),(101,'ALVAREZ CARLOS ALBERTO','');
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoritablas`
--

DROP TABLE IF EXISTS `favoritablas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favoritablas` (
  `idtabla` int(11) NOT NULL,
  `usuario` char(50) NOT NULL,
  PRIMARY KEY (`usuario`,`idtabla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoritablas`
--

LOCK TABLES `favoritablas` WRITE;
/*!40000 ALTER TABLE `favoritablas` DISABLE KEYS */;
INSERT INTO `favoritablas` VALUES (22,'sam'),(24,'sam'),(40,'sam');
/*!40000 ALTER TABLE `favoritablas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movsRepoCL`
--

DROP TABLE IF EXISTS `movsRepoCL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=513 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movsRepoCL`
--

LOCK TABLES `movsRepoCL` WRITE;
/*!40000 ALTER TABLE `movsRepoCL` DISABLE KEYS */;
INSERT INTO `movsRepoCL` VALUES (212,39,'4-1 RcDD',780,258,'agregar'),(213,39,'4-1 RcDD',500,259,'agregar'),(214,39,'4-1 RcDD',190,244,'agregar'),(215,39,'4-1 RcCF',1710,257,'agregar'),(216,39,'4-1 RcCF',360,260,'agregar'),(217,40,'4-1 RcDD',602,214,'agregar'),(218,40,'4-1 RcDD',350,259,'agregar'),(219,40,'4-1 RcDD',540,258,'agregar'),(220,40,'4-1 RcCMC',864,261,'agregar'),(221,40,'4-1 RcCMC',886,260,'agregar'),(222,40,'4-1 RcCMC',320,257,'agregar'),(223,41,'4-1 RcDD',200,243,'agregar'),(224,41,'4-1 RcDD',1163,243,'agregar'),(225,41,'4-1 RcDD',1060,249,'agregar'),(226,41,'4-1 RcCD',100,249,'agregar'),(227,42,'4-1 RcCMC',510,261,'agregar'),(228,42,'4-1 RcCMC',980,260,'agregar'),(229,42,'4-1 RcCMD',600,243,'agregar'),(230,42,'4-1 RcCMD',340,249,'agregar'),(231,43,'4-1 RcDD',1646,243,'agregar'),(232,43,'4-1 RcDD',1000,249,'agregar'),(233,43,'4-1 RcDD',1047,245,'agregar'),(234,44,'4-1 RcDD',1535,249,'agregar'),(235,44,'4-1 RcDD',2763,243,'agregar'),(236,44,'4-1 RcDD',1128,245,'agregar'),(237,45,'4-1 RcDD',2985,254,'agregar'),(238,45,'4-1 RcCD',234,230,'agregar'),(240,45,'4-1 RcCD',460,231,'agregar'),(248,46,'4-1 RcDF',195,263,'agregar'),(249,46,'4-1 RcDF',445,264,'agregar'),(250,46,'4-1 RcDF',743,265,'agregar'),(251,46,'4-1 RcDF',300,266,'agregar'),(252,47,'4-1 RcDF',1200,263,'agregar'),(255,48,'4-1 RcDF',118,264,'agregar'),(256,48,'4-1 RcDF',514,265,'agregar'),(257,49,'4-1 RcCD',2300,228,'agregar'),(258,49,'4-1 RcCD',870,229,'agregar'),(260,49,'4-1 RcCD',100,241,'agregar'),(261,49,'4-1 RcCD',200,251,'agregar'),(262,50,'4-1 RcDD',700,232,'agregar'),(263,50,'4-1 RcCD',1291,248,'agregar'),(264,50,'4-1 RcCD',1800,250,'agregar'),(265,50,'4-1 RcCD',700,251,'agregar'),(266,51,'4-1 RcCD',328,227,'agregar'),(267,51,'4-1 RcCD',1000,226,'agregar'),(268,51,'4-1 RcCD',190,248,'agregar'),(269,51,'4-1 RcCD',390,250,'agregar'),(270,51,'4-1 RcCD',315,251,'agregar'),(271,51,'4-1 RcCD',900,247,'agregar'),(272,52,'4-1 RcCF',3500,260,'agregar'),(273,52,'4-1 RcDF',500,266,'agregar'),(276,53,'4-1 RcCF',3500,260,'agregar'),(278,53,'4-1 RcDF',500,266,'agregar'),(279,53,'4-1 RcDF',667,268,'agregar'),(280,54,'4-1 RcCF',3087,260,'agregar'),(282,54,'4-1 RcCF',458,257,'agregar'),(283,54,'4-1 RcCF',375,269,'agregar'),(284,54,'4-1 RcDD',305,270,'agregar'),(286,55,'4-1 RcDF',564,268,'agregar'),(287,55,'4-1 RcDD',590,227,'agregar'),(288,55,'4-1 RcDD',1043,247,'agregar'),(289,55,'4-1 RcDF',455,271,'agregar'),(290,55,'4-1 RcDF',903,225,'agregar'),(291,56,'4-1 RcDD',832,248,'agregar'),(292,56,'4-1 RcDD',758,224,'agregar'),(293,56,'4-1 RcDD',1160,225,'agregar'),(294,56,'4-1 RcDD',660,226,'agregar'),(295,56,'4-1 RcDD',255,271,'agregar'),(296,56,'4-1 RcCD',250,272,'agregar'),(297,57,'4-1 RcCF',1150,257,'agregar'),(299,57,'4-1 RcCF',1250,260,'agregar'),(300,57,'4-1 RcDF',170,271,'agregar'),(303,57,'4-1 RcDF',276,272,'agregar'),(305,57,'4-1 RcDF',220,273,'agregar'),(306,57,'4-1 RcDD',530,225,'agregar'),(309,57,'4-1 RcDF',417,266,'agregar'),(310,58,'4-1 RcDD',120,226,'agregar'),(311,58,'4-1 RcDD',945,225,'agregar'),(312,58,'4-1 RcDD',131,248,'agregar'),(313,58,'4-1 RcDF',440,272,'agregar'),(316,58,'4-1 RcDF',260,273,'agregar'),(317,58,'4-1 RcDF',130,271,'agregar'),(318,59,'4-1 RcCF',370,260,'agregar'),(319,59,'4-1 RcCF',160,269,'agregar'),(320,59,'4-1 RcCF',370,271,'agregar'),(321,59,'4-1 RcCF',366,258,'agregar'),(322,59,'4-1 RcCF',680,266,'agregar'),(323,59,'4-1 RcCF',330,274,'agregar'),(329,60,'4-1 RcDF',1292,272,'agregar'),(332,60,'4-1 RcCD',812,236,'agregar'),(333,60,'4-1 RcCD',280,235,'agregar'),(334,60,'4-1 RcCD',620,255,'agregar'),(335,60,'4-1 RcCD',305,248,'agregar'),(336,60,'4-1 RcDF',374,273,'agregar'),(337,60,'4-1 RcDF',672,271,'agregar'),(338,61,'4-1 RcCF',410,271,'agregar'),(339,61,'4-1 RcCF',555,257,'agregar'),(341,61,'4-1 RcDD',370,226,'agregar'),(342,62,'4-1 RcDF',410,271,'agregar'),(343,62,'4-1 RcCF',555,257,'agregar'),(344,62,'4-1 RcDD',370,226,'agregar'),(345,62,'4-1 RcCD',975,238,'agregar'),(346,62,'4-1 RcCD',565,235,'agregar'),(347,62,'4-1 RcCF',382,260,'agregar'),(348,63,'4-1 RcDD',252,232,'agregar'),(349,63,'4-1 RcDD',620,230,'agregar'),(350,63,'4-1 RcCF',980,266,'agregar'),(351,63,'4-1 RcCF',2000,260,'agregar'),(352,64,'4-1 RcDD',1346,247,'agregar'),(353,64,'4-1 RcDD',1050,268,'agregar'),(354,64,'4-1 RcDF',2064,268,'agregar'),(355,64,'4-1 RcCD',100,255,'agregar'),(356,65,'4-1 RcCF',2540,260,'agregar'),(357,65,'4-1 RcCF',540,257,'agregar'),(358,65,'4-1 RcCF',576,266,'agregar'),(359,65,'4-1 RcCF',73,261,'agregar'),(360,67,'4-1 RcDD',2794,268,'agregar'),(361,67,'4-1 RcDD',1456,247,'agregar'),(362,67,'4-1 RcDF',1156,268,'agregar'),(363,68,'4-1 RcDF',1450,275,'agregar'),(365,68,'4-1 RcCF',540,257,'agregar'),(366,68,'4-1 RcDD',715,234,'agregar'),(367,68,'4-1 RcDD',580,232,'agregar'),(368,68,'4-1 RcDD',191,247,'agregar'),(369,68,'4-1 RcCF',878,260,'agregar'),(370,68,'4-1 RcDD',626,231,'agregar'),(371,68,'4-1 RcCF',262,266,'agregar'),(372,68,'4-1 RcCD',268,255,'agregar'),(373,69,'4-1 RcDD',655,247,'agregar'),(374,69,'4-1 RcDD',1100,268,'agregar'),(375,69,'4-1 RcDD',450,275,'agregar'),(376,69,'4-1 RcDD',266,263,'agregar'),(377,69,'4-1 RcDD',235,274,'agregar'),(378,69,'4-1 RcCD',190,269,'agregar'),(379,69,'4-1 RcDF',542,268,'agregar'),(380,69,'4-1 RcDD',267,281,'agregar'),(382,70,'4-1 RcCF',1702,260,'agregar'),(383,70,'4-1 RcCD',180,255,'agregar'),(384,70,'4-1 RcCF',47,274,'agregar'),(386,70,'4-1 RcDD',408,275,'agregar'),(387,70,'4-1 RcDD',241,229,'agregar'),(388,70,'4-1 RcCMC',300,261,'agregar'),(389,71,'4-1 RcDD',1380,272,'agregar'),(390,71,'4-1 RcDD',760,273,'agregar'),(391,71,'4-1 RcDD',894,271,'agregar'),(392,71,'4-1 RcDD',40,275,'agregar'),(393,71,'4-1 RcDD',1150,285,'agregar'),(394,71,'4-1 RcCD',180,236,'agregar'),(395,71,'4-1 RcCD',217,235,'agregar'),(396,72,'4-1 RcDD',1800,272,'agregar'),(397,72,'4-1 RcDD',770,250,'agregar'),(398,72,'4-1 RcDD',479,273,'agregar'),(399,72,'4-1 RcDF',1003,273,'agregar'),(400,72,'4-1 RcDF',1046,272,'agregar'),(401,72,'4-1 RcDF',1286,271,'agregar'),(402,73,'4-1 RcDD',1810,250,'agregar'),(403,73,'4-1 RcDD',1168,251,'agregar'),(404,73,'4-1 RcDD',166,248,'agregar'),(405,74,'4-1 RcDD',1045,250,'agregar'),(408,74,'4-1 RcDD',230,251,'agregar'),(409,74,'4-1 RcDD',156,248,'agregar'),(410,74,'4-1 RcCD',350,269,'agregar'),(411,74,'4-1 RcCD',30,260,'agregar'),(412,75,'4-1 RcDD',990,250,'agregar'),(413,75,'4-1 RcDD',58,270,'agregar'),(414,75,'4-1 RcDD',1223,248,'agregar'),(415,75,'4-1 RcDD',338,226,'agregar'),(416,77,'4-1 RcCMC',860,257,'agregar'),(417,77,'4-1 RcCMC',645,261,'agregar'),(419,77,'4-1 RcCMC',2350,260,'agregar'),(420,77,'4-1 RcDD',206,250,'agregar'),(421,77,'4-1 RcDD',50,251,'agregar'),(422,77,'4-1 RcDD',530,225,'agregar'),(423,78,'4-1 RcIQC',550,257,'agregar'),(424,78,'4-1 RcIQC',713,261,'agregar'),(425,78,'4-1 RcIQC',1040,260,'agregar'),(426,78,'4-1 RcIQC',500,271,'agregar'),(427,79,'4-1 RcIQD',150,257,'agregar'),(429,79,'4-1 RcIQC',556,260,'agregar'),(430,79,'4-1 RcIQC',330,261,'agregar'),(432,79,'4-1 RcDD',504,272,'agregar'),(433,80,'4-1 RcDD',2050,272,'agregar'),(434,80,'4-1 RcDD',780,251,'agregar'),(435,80,'4-1 RcDD',485,248,'agregar'),(436,81,'4-1 RcIQC',571,257,'agregar'),(437,81,'4-1 RcIQC',7,260,'agregar'),(438,81,'4-1 RcIQC',11,269,'agregar'),(439,81,'4-1 RcIQC',114,274,'agregar'),(440,81,'4-1 RcIQC',260,270,'agregar'),(441,81,'4-1 RcIQC',765,271,'agregar'),(442,81,'4-1 RcIQC',607,295,'agregar'),(443,82,'4-1 RcDF',740,270,'agregar'),(444,82,'4-1 RcIQC',704,260,'agregar'),(445,82,'4-1 RcIQC',215,271,'agregar'),(446,83,'4-1 RcIQC',615,257,'agregar'),(447,83,'4-1 RcIQC',440,260,'agregar'),(448,83,'4-1 RcIQC',1361,261,'agregar'),(449,83,'4-1 RcIQC',730,270,'agregar'),(450,84,'4-1 RcCF',1097,257,'agregar'),(451,84,'4-1 RcCF',1895,260,'agregar'),(452,84,'4-1 RcCF',900,266,'agregar'),(453,84,'4-1 RcDF',418,270,'agregar'),(454,85,'4-1 RcCF',440,260,'agregar'),(455,85,'4-1 RcCF',390,257,'agregar'),(456,85,'4-1 RcCF',93,266,'agregar'),(459,85,'4-1 RcDF',666,272,'agregar'),(460,85,'4-1 RcDF',393,273,'agregar'),(461,86,'4-1 RcDD',1942,230,'agregar'),(463,86,'4-1 RcCD',1520,298,'agregar'),(465,86,'4-1 RcDF',540,275,'agregar'),(466,87,'4-1 RcDD',1640,230,'agregar'),(467,87,'4-1 RcDD',496,296,'agregar'),(468,87,'4-1 RcCMD',553,237,'agregar'),(469,87,'4-1 RcCMD',800,235,'agregar'),(470,87,'4-1 RcCMD',760,260,'agregar'),(471,88,'4-1 RcDD',800,300,'agregar'),(472,88,'4-1 RcDD',310,237,'agregar'),(473,88,'4-1 RcDD',2050,235,'agregar'),(474,88,'4-1 RcDD',334,230,'agregar'),(475,88,'4-1 RcDD',280,231,'agregar'),(476,89,'4-1 RcDD',320,237,'agregar'),(477,89,'4-1 RcDD',1060,235,'agregar'),(478,89,'4-1 RcDD',420,235,'agregar'),(479,89,'4-1 RcDD',660,230,'agregar'),(480,89,'4-1 RcDD',120,231,'agregar'),(481,89,'4-1 RcDD',170,303,'agregar'),(482,90,'4-1 RcIQD',330,237,'agregar'),(483,90,'4-1 RcIQD',720,235,'agregar'),(484,90,'4-1 RcIQC',662,257,'agregar'),(485,90,'4-1 RcDD',950,230,'agregar'),(486,90,'4-1 RcDD',960,299,'agregar'),(488,90,'4-1 RcDD',720,300,'agregar'),(490,91,'4-1 RcDD',480,304,'agregar'),(491,91,'4-1 RcDD',1044,230,'agregar'),(492,91,'4-1 RcCD',541,296,'agregar'),(493,39,'',780,214,'descontar'),(494,39,'',500,219,'descontar'),(496,39,'',190,214,'descontar'),(499,40,'',602,214,'descontar'),(501,40,'',540,214,'descontar'),(502,40,'',35,219,'descontar'),(503,41,'',200,194,'descontar'),(504,41,'',1163,262,'descontar'),(505,41,'',1060,185,'descontar'),(506,41,'',100,187,'descontar'),(507,42,'',600,194,'descontar'),(509,42,'',340,185,'descontar'),(510,43,'',1646,194,'descontar'),(511,43,'',1000,185,'descontar'),(512,43,'',1047,187,'descontar');
/*!40000 ALTER TABLE `movsRepoCL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movsRepoDimensionado`
--

DROP TABLE IF EXISTS `movsRepoDimensionado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movsRepoDimensionado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idRepo` int(11) NOT NULL,
  `actividad` char(10) NOT NULL COMMENT 'aserrio u hojeado',
  `cantidad` int(11) NOT NULL,
  `idtabla` int(11) NOT NULL COMMENT 'la tabla incluye la especie de madera',
  PRIMARY KEY (`id`),
  KEY `idRepo` (`idRepo`),
  KEY `actividad` (`actividad`,`idtabla`)
) ENGINE=InnoDB AUTO_INCREMENT=1152 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movsRepoDimensionado`
--

LOCK TABLES `movsRepoDimensionado` WRITE;
/*!40000 ALTER TABLE `movsRepoDimensionado` DISABLE KEYS */;
INSERT INTO `movsRepoDimensionado` VALUES (436,175,'2-1 AsP',343,187),(437,175,'2-1 AsP',500,219),(438,176,'2-1 AsP',576,214),(439,176,'2-1 AsP',14,213),(440,176,'2-1 AsP',125,216),(441,176,'2-1 AsP',78,221),(442,177,'2-1 AsP',700,214),(443,177,'2-1 AsP',150,216),(444,178,'2-1 AsCB',334,187),(447,178,'2-1 AsP',20,221),(448,178,'2-1 AsP',40,210),(449,179,'2-1 AsCB',211,187),(450,179,'2-1 AsCB',39,185),(451,179,'2-1 AsCB',170,209),(452,179,'2-1 AsCB',200,193),(453,180,'2-1 AsP',226,214),(454,180,'2-1 AsP',150,219),(455,180,'2-1 AsP',300,222),(456,180,'2-1 AsP',127,223),(457,181,'2-1 AsP',200,219),(458,181,'2-1 AsP',235,214),(459,181,'2-1 AsP',210,222),(460,181,'2-1 AsP',30,223),(461,183,'2-1 AsP',103,214),(462,183,'2-1 AsP',130,222),(463,183,'2-1 AsP',8,223),(464,184,'2-1 AsCB',437,185),(465,184,'2-1 AsCB',943,194),(466,184,'2-1 AsCB',60,200),(467,185,'2-1 AsCB',305,185),(468,185,'2-1 AsCB',450,194),(469,186,'2-1 AsCB',477,185),(470,186,'2-1 AsCB',919,194),(471,186,'2-1 AsCB',35,200),(472,186,'2-1 AsCB',104,191),(473,187,'2-1 AsCB',724,262),(474,187,'2-1 AsCB',427,187),(477,189,'2-1 AsCB',337,185),(478,189,'2-1 AsCB',234,194),(479,189,'2-1 AsCB',37,200),(480,190,'2-1 AsCB',50,185),(481,190,'2-1 AsCB',133,206),(482,191,'2-1 AsCB',600,194),(483,191,'2-1 AsCB',114,185),(484,191,'2-1 AsCB',160,191),(485,192,'2-1 AsCB',145,187),(486,192,'2-1 AsCB',200,185),(487,192,'2-1 AsP',300,222),(488,192,'2-1 AsP',150,223),(490,193,'2-1 AsP',450,222),(491,193,'2-1 AsP',193,223),(492,194,'2-1 AsCB',480,185),(493,194,'2-1 AsCB',818,194),(494,194,'2-1 AsCB',110,200),(495,195,'2-1 AsCB',317,185),(496,195,'2-1 AsCB',470,194),(497,196,'2-1 AsCB',618,185),(498,196,'2-1 AsCB',577,194),(499,196,'2-1 AsCB',95,200),(500,196,'2-1 AsCB',90,191),(501,197,'2-1 AsCB',408,185),(502,197,'2-1 AsCB',680,194),(503,198,'2-1 AsCB',210,187),(504,198,'2-1 AsCB',810,262),(505,199,'2-1 AsCB',425,187),(506,199,'2-1 AsCB',156,193),(507,200,'2-1 AsCB',692,194),(508,200,'2-1 AsCB',309,185),(509,200,'2-1 AsCB',30,200),(510,200,'2-1 AsCB',340,187),(511,200,'2-1 AsCB',47,209),(512,201,'2-1 AsCB',566,187),(513,201,'2-1 AsCB',200,194),(514,201,'2-1 AsCB',70,209),(515,202,'2-1 AsCB',605,194),(516,202,'2-1 AsCB',207,185),(517,202,'2-1 AsCB',908,200),(518,202,'2-1 AsCB',148,191),(519,202,'2-1 AsCB',380,187),(520,202,'2-1 AsCB',30,209),(521,203,'2-1 AsCB',565,185),(522,203,'2-1 AsCB',660,194),(523,203,'2-1 AsCB',10,191),(524,203,'2-1 AsCB',54,200),(525,204,'2-1 AsCB',556,187),(526,204,'2-1 AsCB',220,193),(527,205,'2-1 AsCB',324,194),(528,205,'2-1 AsCB',592,187),(529,205,'2-1 AsCB',109,189),(530,205,'2-1 AsCB',85,193),(531,205,'2-1 AsCB',55,178),(532,205,'2-1 AsCB',44,200),(533,206,'2-1 AsCB',450,187),(534,206,'2-1 AsCB',103,189),(535,206,'2-1 AsCB',200,193),(536,206,'2-1 AsCB',60,194),(537,207,'2-1 AsCB',627,195),(538,207,'2-1 AsCB',880,190),(539,207,'2-1 AsCB',140,192),(540,208,'2-1 AsCB',755,190),(541,208,'2-1 AsCB',657,195),(542,208,'2-1 AsCB',190,192),(543,209,'2-1 AsCB',460,187),(544,209,'2-1 AsCB',70,189),(545,209,'2-1 AsCB',126,193),(546,209,'2-1 AsCB',554,181),(547,209,'2-1 AsCB',23,185),(548,210,'2-1 AsCB',810,181),(549,210,'2-1 AsCB',100,191),(550,211,'2-1 AsCB',580,190),(551,211,'2-1 AsCB',350,195),(552,211,'2-1 AsCB',178,192),(553,212,'2-1 AsCB',475,201),(554,212,'2-1 AsCB',200,186),(555,212,'2-1 AsCB',34,208),(556,212,'2-1 AsCB',170,192),(557,213,'2-1 AsCB',475,201),(558,213,'2-1 AsCB',200,186),(559,213,'2-1 AsCB',34,208),(560,213,'2-1 AsCB',170,192),(561,214,'2-1 AsCB',557,201),(562,214,'2-1 AsCB',40,208),(563,214,'2-1 AsCB',40,192),(564,215,'2-1 AsCB',225,201),(565,216,'2-1 AsCB',329,185),(566,216,'2-1 AsCB',252,181),(567,216,'2-1 AsCB',40,197),(568,217,'2-1 AsCB',250,185),(569,217,'2-1 AsCB',67,197),(570,217,'2-1 AsCB',70,193),(571,217,'2-1 AsCB',550,191),(577,219,'2-1 AsCB',708,201),(578,219,'2-1 AsCB',270,186),(579,219,'2-1 AsCB',73,208),(580,219,'2-1 AsCB',210,192),(581,220,'2-1 AsCB',646,201),(582,220,'2-1 AsCB',330,186),(583,220,'2-1 AsCB',180,192),(584,221,'2-1 AsCB',400,185),(585,221,'2-1 AsCB',120,200),(586,222,'2-1 AsCB',250,185),(587,222,'2-1 AsCB',720,181),(588,222,'2-1 AsCB',275,179),(589,222,'2-1 AsCB',340,179),(590,222,'2-1 AsCB',300,176),(591,222,'2-1 AsCB',100,183),(592,223,'2-1 AsCB',1206,195),(593,223,'2-1 AsCB',77,192),(594,223,'2-1 AsCB',251,267),(595,223,'2-1 AsCB',140,177),(596,224,'2-1 AsCB',644,195),(597,224,'2-1 AsCB',140,186),(598,224,'2-1 AsCB',120,192),(599,224,'2-1 AsCB',350,267),(600,224,'2-1 AsCB',80,177),(601,225,'2-1 AsCB',800,181),(602,225,'2-1 AsCB',125,179),(603,225,'2-1 AsCB',180,185),(604,226,'2-1 AsCB',413,181),(605,226,'2-1 AsCB',255,179),(606,226,'2-1 AsCB',622,185),(607,226,'2-1 AsCB',80,197),(608,226,'2-1 AsCB',80,176),(609,227,'2-1 AsCB',296,267),(610,227,'2-1 AsCB',320,177),(611,227,'2-1 AsCB',505,196),(612,227,'2-1 AsCB',104,191),(613,227,'2-1 AsCB',180,185),(614,227,'2-1 AsCB',26,200),(615,228,'2-1 AsCB',150,267),(616,228,'2-1 AsCB',1250,177),(617,228,'2-1 AsCB',134,201),(618,228,'2-1 AsCB',150,195),(619,229,'2-1 AsCB',250,181),(620,229,'2-1 AsCB',38,179),(621,229,'2-1 AsCB',500,196),(622,229,'2-1 AsCB',80,185),(623,230,'2-1 AsCB',900,177),(624,230,'2-1 AsCB',167,181),(625,230,'2-1 AsCB',10,179),(626,230,'2-1 AsCB',150,195),(627,230,'2-1 AsCB',55,192),(628,231,'2-1 AsCB',1017,185),(629,231,'2-1 AsCB',82,200),(630,232,'2-1 AsCB',742,195),(631,232,'2-1 AsCB',106,186),(632,232,'2-1 AsCB',30,185),(633,232,'2-1 AsCB',257,267),(634,232,'2-1 AsCB',450,177),(635,232,'2-1 AsCB',140,197),(636,233,'2-1 AsCB',760,206),(637,233,'2-1 AsCB',210,185),(638,233,'2-1 AsCB',200,191),(639,234,'2-1 AsCB',360,206),(640,234,'2-1 AsCB',461,185),(641,234,'2-1 AsCB',23,200),(642,234,'2-1 AsCB',511,196),(643,234,'2-1 AsCB',100,179),(644,234,'2-1 AsCB',32,191),(645,235,'2-1 AsCB',560,267),(646,235,'2-1 AsCB',1186,177),(647,236,'2-1 AsCB',1016,177),(648,236,'2-1 AsCB',506,267),(649,236,'2-1 AsCB',410,206),(650,236,'2-1 AsCB',25,205),(651,237,'2-1 AsCB',520,196),(652,237,'2-1 AsCB',137,185),(653,237,'2-1 AsCB',370,191),(654,238,'2-1 AsCB',500,197),(655,239,'2-1 AsCB',660,195),(656,239,'2-1 AsCB',110,177),(657,240,'2-1 AsCB',600,197),(658,241,'2-1 AsCB',810,177),(659,241,'2-1 AsCB',102,195),(660,242,'2-1 AsCB',820,256),(661,242,'2-1 AsCB',57,205),(662,242,'2-1 AsCB',388,187),(663,242,'2-1 AsCB',165,193),(664,243,'2-1 AsCB',1230,195),(665,243,'2-1 AsCB',310,177),(666,244,'2-1 AsCB',600,256),(667,244,'2-1 AsCB',30,205),(668,244,'2-1 AsCB',370,193),(669,244,'2-1 AsCB',60,191),(670,245,'2-1 AsCB',814,256),(671,245,'2-1 AsCB',415,187),(672,245,'2-1 AsCB',160,193),(673,245,'2-1 AsCB',80,209),(674,245,'2-1 AsCB',30,205),(675,246,'2-1 AsCB',300,185),(676,246,'2-1 AsCB',100,197),(677,247,'2-1 AsCB',900,187),(678,247,'2-1 AsCB',170,193),(679,248,'2-1 AsCB',230,179),(680,248,'2-1 AsCB',160,185),(681,248,'2-1 AsCB',630,202),(682,248,'2-1 AsCB',190,197),(683,249,'2-1 AsCB',555,187),(684,249,'2-1 AsCB',250,193),(685,250,'2-1 AsCB',723,202),(686,250,'2-1 AsCB',433,197),(687,250,'2-1 AsCB',243,185),(688,250,'2-1 AsCB',201,179),(689,251,'2-1 AsP',1135,218),(690,251,'2-1 AsP',138,215),(691,252,'2-1 AsCB',600,256),(692,252,'2-1 AsCB',303,205),(693,252,'2-1 AsCB',100,187),(694,253,'2-1 AsCB',610,256),(695,253,'2-1 AsCB',305,206),(696,253,'2-1 AsCB',345,187),(697,253,'2-1 AsCB',120,193),(698,253,'2-1 AsCB',125,209),(699,254,'2-1 AsCB',932,185),(700,254,'2-1 AsCB',180,179),(701,255,'2-1 AsCB',400,185),(702,255,'2-1 AsCB',145,197),(703,256,'2-1 AsP',1007,218),(704,256,'2-1 AsP',60,215),(705,257,'2-1 AsP',800,218),(706,257,'2-1 AsCB',105,186),(707,257,'2-1 AsP',120,215),(709,258,'2-1 AsCB',210,192),(710,258,'2-1 AsP',236,222),(711,258,'2-1 AsP',48,223),(712,258,'2-1 AsP',1254,218),(713,260,'2-1 AsCB',515,185),(714,260,'2-1 AsCB',145,197),(715,261,'2-1 AsP',1048,218),(717,261,'2-1 AsP',415,222),(718,261,'2-1 AsP',14,223),(719,261,'2-1 AsP',415,222),(720,261,'2-1 AsP',14,223),(721,262,'2-1 AsP',622,218),(722,262,'2-1 AsP',410,215),(723,262,'2-1 AsP',305,222),(724,262,'2-1 AsP',15,223),(725,263,'2-1 AsP',208,214),(726,263,'2-1 AsP',266,276),(727,263,'2-1 AsP',235,277),(728,263,'2-1 AsP',269,278),(729,263,'2-1 AsP',100,222),(730,264,'2-1 AsP',100,279),(731,264,'2-1 AsP',990,218),(732,264,'2-1 AsP',60,280),(733,264,'2-1 AsP',110,215),(734,264,'2-1 AsP',320,222),(735,264,'2-1 AsP',20,223),(736,265,'2-1 AsCB',480,185),(737,265,'2-1 AsCB',176,197),(738,265,'2-1 AsCB',371,206),(739,267,'2-1 AsP',143,217),(740,267,'2-1 AsP',329,222),(741,267,'2-1 AsP',206,223),(742,267,'2-1 AsP',39,279),(743,268,'2-1 AsP',311,222),(744,268,'2-1 AsP',238,223),(745,268,'2-1 AsP',96,221),(746,268,'2-1 AsP',252,220),(747,269,'2-1 AsCB',330,201),(748,269,'2-1 AsCB',110,198),(749,269,'2-1 AsCB',310,206),(750,269,'2-1 AsCB',210,205),(751,270,'2-1 AsCB',310,206),(752,270,'2-1 AsCB',210,205),(755,272,'2-1 AsP',215,222),(756,272,'2-1 AsP',300,279),(757,272,'2-1 AsP',540,284),(758,272,'2-1 AsP',20,223),(759,273,'2-1 AsP',400,279),(760,273,'2-1 AsP',560,284),(761,273,'2-1 AsP',140,215),(762,274,'2-1 AsP',610,213),(763,274,'2-1 AsP',365,212),(764,274,'2-1 AsP',95,282),(765,274,'2-1 AsP',35,220),(766,274,'2-1 AsP',29,211),(767,275,'2-1 AsP',630,217),(768,275,'2-1 AsCB',40,205),(769,275,'2-1 AsP',160,215),(770,276,'2-1 AsP',1480,212),(771,276,'2-1 AsP',90,211),(772,276,'2-1 AsP',141,213),(773,276,'2-1 AsP',60,220),(774,276,'2-1 AsP',170,282),(775,277,'2-1 AsP',408,284),(776,277,'2-1 AsCB',505,186),(777,277,'2-1 AsCB',94,180),(778,278,'2-1 AsCB',565,201),(779,278,'2-1 AsCB',184,186),(780,278,'2-1 AsCB',60,180),(781,278,'2-1 AsCB',135,177),(782,278,'2-1 AsCB',614,206),(783,278,'2-1 AsCB',300,205),(784,279,'2-1 AsCB',1013,181),(785,279,'2-1 AsCB',124,179),(786,280,'2-1 AsP',1570,212),(787,280,'2-1 AsP',368,211),(788,280,'2-1 AsP',30,213),(789,280,'2-1 AsP',90,286),(790,281,'2-1 AsCB',400,201),(791,281,'2-1 AsCB',100,208),(792,281,'2-1 AsCB',90,180),(793,281,'2-1 AsCB',600,206),(794,281,'2-1 AsCB',300,177),(795,281,'2-1 AsCB',150,186),(796,282,'2-1 AsP',1063,212),(797,282,'2-1 AsP',231,211),(798,282,'2-1 AsP',249,213),(799,282,'2-1 AsCB',56,286),(800,283,'2-1 AsP',1000,212),(801,283,'2-1 AsP',515,211),(802,283,'2-1 AsP',233,213),(803,283,'2-1 AsP',70,282),(804,284,'2-1 AsCB',370,181),(805,284,'2-1 AsCB',147,179),(806,284,'2-1 AsCB',172,185),(807,284,'2-1 AsCB',300,222),(808,284,'2-1 AsP',45,223),(813,286,'2-1 AsCB',500,267),(814,286,'2-1 AsCB',70,180),(815,286,'2-1 AsCB',1000,177),(816,287,'2-1 AsP',623,222),(817,287,'2-1 AsP',302,223),(818,287,'2-1 AsCB',330,289),(819,287,'2-1 AsCB',178,178),(820,288,'2-1 AsCB',765,186),(821,288,'2-1 AsCB',141,180),(822,289,'2-1 AsCB',300,206),(823,289,'2-1 AsCB',255,205),(824,289,'2-1 AsCB',520,180),(825,289,'2-1 AsCB',480,177),(826,290,'2-1 AsCB',893,181),(827,290,'2-1 AsCB',500,179),(828,290,'2-1 AsCB',260,197),(829,290,'2-1 AsCB',166,185),(830,291,'2-1 AsCB',67,181),(831,291,'2-1 AsCB',40,179),(832,292,'2-1 AsCB',370,181),(834,293,'2-1 AsCB',620,181),(835,293,'2-1 AsCB',40,179),(836,293,'2-1 AsCB',100,185),(837,294,'2-1 AsCB',279,186),(838,294,'2-1 AsCB',50,180),(839,294,'2-1 AsCB',220,206),(840,294,'2-1 AsCB',10,205),(841,295,'2-1 AsCB',237,181),(842,295,'2-1 AsCB',150,179),(844,295,'2-1 AsCB',678,185),(845,295,'2-1 AsCB',204,196),(846,295,'2-1 AsCB',30,176),(847,296,'2-1 AsCB',405,181),(848,296,'2-1 AsCB',130,196),(850,296,'2-1 AsP',450,222),(851,296,'2-1 AsP',65,223),(853,297,'2-1 AsCB',330,185),(854,297,'2-1 AsP',465,222),(855,297,'2-1 AsP',325,223),(856,297,'2-1 AsCB',260,196),(857,297,'2-1 AsCB',220,197),(858,297,'2-1 AsP',60,214),(859,298,'2-1 AsCB',671,185),(860,298,'2-1 AsCB',123,179),(861,298,'2-1 AsCB',70,176),(862,299,'2-1 AsP',150,222),(863,299,'2-1 AsP',290,223),(864,299,'2-1 AsCB',277,196),(865,299,'2-1 AsCB',77,185),(866,299,'2-1 AsCB',108,181),(869,299,'2-1 AsP',110,290),(870,300,'2-1 AsCB',186,196),(871,300,'2-1 AsCB',802,185),(872,300,'2-1 AsCB',310,197),(873,301,'2-1 AsCB',450,206),(874,301,'2-1 AsCB',330,205),(875,301,'2-1 AsCB',290,178),(876,301,'2-1 AsCB',120,267),(877,302,'2-1 AsCB',650,206),(878,302,'2-1 AsCB',345,205),(879,302,'2-1 AsCB',143,186),(880,302,'2-1 AsCB',420,177),(881,303,'2-1 AsP',280,290),(882,303,'2-1 AsP',323,291),(883,303,'2-1 AsCB',107,179),(884,303,'2-1 AsCB',44,176),(885,303,'2-1 AsCB',381,185),(886,303,'2-1 AsCB',160,196),(887,304,'2-1 AsCB',700,185),(888,304,'2-1 AsCB',373,181),(889,304,'2-1 AsCB',40,179),(891,304,'2-1 AsCB',370,197),(892,304,'2-1 AsCB',30,209),(893,305,'2-1 AsCB',410,181),(894,305,'2-1 AsCB',214,185),(895,305,'2-1 AsCB',45,187),(896,305,'2-1 AsCB',310,191),(897,305,'2-1 AsCB',140,196),(898,306,'2-1 AsCB',1400,206),(899,306,'2-1 AsCB',150,205),(900,306,'2-1 AsCB',470,177),(901,306,'2-1 AsCB',150,186),(902,307,'2-1 AsCB',1843,206),(903,307,'2-1 AsCB',600,205),(904,307,'2-1 AsCB',160,185),(905,307,'2-1 AsCB',101,179),(906,308,'2-1 AsCB',1200,206),(907,308,'2-1 AsCB',366,205),(908,308,'2-1 AsCB',100,181),(909,309,'2-1 AsCB',1392,206),(910,309,'2-1 AsCB',537,205),(911,309,'2-1 AsCB',275,185),(912,309,'2-1 AsCB',240,197),(913,310,'2-1 AsCB',900,206),(914,310,'2-1 AsCB',310,205),(915,310,'2-1 AsCB',150,185),(916,311,'2-1 AsCB',1350,206),(917,311,'2-1 AsCB',450,205),(918,311,'2-1 AsCB',150,186),(919,312,'2-1 AsCB',929,206),(920,312,'2-1 AsCB',300,205),(921,312,'2-1 AsCB',258,185),(922,312,'2-1 AsCB',140,179),(923,312,'2-1 AsP',223,212),(924,313,'2-1 AsCB',614,206),(925,313,'2-1 AsCB',250,205),(926,313,'2-1 AsCB',240,185),(927,313,'2-1 AsP',160,221),(928,314,'2-1 AsCB',600,256),(929,314,'2-1 AsCB',311,206),(930,314,'2-1 AsCB',210,185),(931,314,'2-1 AsCB',160,179),(932,314,'2-1 AsCB',60,191),(933,314,'2-1 AsCB',500,181),(934,316,'2-1 AsCB',600,206),(935,316,'2-1 AsCB',160,205),(936,316,'2-1 AsCB',103,185),(937,316,'2-1 AsCB',100,209),(938,316,'2-1 AsCB',50,191),(939,317,'2-1 AsCB',1020,256),(940,317,'2-1 AsCB',50,206),(941,317,'2-1 AsCB',337,186),(942,317,'2-1 AsCB',300,177),(943,318,'2-1 AsP',580,212),(944,318,'2-1 AsP',40,211),(945,318,'2-1 AsP',50,286),(946,318,'2-1 AsP',150,213),(947,319,'2-1 AsP',240,221),(951,319,'2-1 AsP',50,292),(952,319,'2-1 AsP',90,293),(953,319,'2-1 AsCB',60,179),(954,320,'2-1 AsP',700,212),(955,320,'2-1 AsP',65,211),(956,320,'2-1 AsP',31,213),(957,321,'2-1 AsP',150,221),(959,321,'2-1 AsP',130,292),(960,321,'2-1 AsP',100,293),(961,322,'2-1 AsCB',270,256),(962,322,'2-1 AsCB',240,186),(963,322,'2-1 AsCB',190,192),(964,323,'2-1 AsP',793,212),(965,323,'2-1 AsP',72,211),(966,323,'2-1 AsP',361,213),(967,324,'2-1 AsCB',410,209),(968,324,'2-1 AsCB',350,209),(969,324,'2-1 AsCB',140,193),(970,325,'2-1 AsP',658,212),(971,325,'2-1 AsP',120,211),(972,325,'2-1 AsP',530,213),(973,325,'2-1 AsP',220,191),(974,326,'2-1 AsCB',670,209),(975,326,'2-1 AsCB',230,191),(976,327,'2-1 AsCB',1100,195),(977,327,'2-1 AsCB',200,192),(978,328,'2-1 AsP',614,211),(979,328,'2-1 AsP',186,213),(980,328,'2-1 AsP',180,286),(981,328,'2-1 AsCB',557,209),(982,329,'2-1 AsCB',240,289),(983,329,'2-1 AsP',90,294),(984,329,'2-1 AsCB',150,193),(985,330,'2-1 AsP',930,212),(986,330,'2-1 AsP',832,211),(987,330,'2-1 AsP',77,213),(988,330,'2-1 AsP',120,286),(989,331,'2-1 AsCB',335,209),(990,331,'2-1 AsCB',135,193),(991,331,'2-1 AsCB',254,181),(994,331,'2-1 AsCB',56,179),(995,331,'2-1 AsCB',54,185),(996,332,'2-1 AsP',331,213),(997,332,'2-1 AsCB',439,209),(998,332,'2-1 AsP',32,211),(999,332,'2-1 AsCB',500,195),(1000,332,'2-1 AsCB',70,192),(1001,333,'2-1 AsP',190,215),(1002,333,'2-1 AsP',100,291),(1003,334,'2-1 AsP',810,213),(1004,334,'2-1 AsP',20,211),(1005,335,'2-1 AsCB',474,185),(1006,335,'2-1 AsCB',100,191),(1007,336,'2-1 AsCB',1280,195),(1008,336,'2-1 AsCB',150,192),(1009,337,'2-1 AsCB',1300,195),(1010,337,'2-1 AsCB',150,192),(1011,338,'2-1 AsCB',1083,195),(1012,338,'2-1 AsP',117,213),(1013,338,'2-1 AsCB',91,192),(1014,339,'2-1 AsCB',200,187),(1015,340,'2-1 AsCB',622,195),(1016,340,'2-1 AsCB',140,192),(1017,340,'2-1 AsP',302,213),(1018,340,'2-1 AsP',76,211),(1019,341,'2-1 AsCB',255,187),(1020,341,'2-1 AsCB',110,193),(1021,341,'2-1 AsP',115,218),(1022,342,'2-1 AsP',250,213),(1023,342,'2-1 AsCB',540,195),(1024,342,'2-1 AsCB',393,192),(1025,342,'2-1 AsP',82,211),(1026,344,'2-1 AsCB',171,187),(1027,344,'2-1 AsCB',180,195),(1028,345,'2-1 AsP',561,213),(1029,345,'2-1 AsP',95,211),(1030,345,'2-1 AsP',140,297),(1031,345,'2-1 AsP',290,222),(1032,346,'2-1 AsCB',332,187),(1033,346,'2-1 AsCB',220,193),(1034,347,'2-1 AsCB',890,195),(1035,347,'2-1 AsCB',500,192),(1036,348,'2-1 AsCB',516,195),(1037,350,'2-1 AsCB',72,187),(1038,351,'2-1 AsCB',270,195),(1039,351,'2-1 AsCB',430,192),(1040,353,'2-1 AsCB',720,195),(1041,353,'2-1 AsCB',150,192),(1042,354,'2-1 AsCB',1075,195),(1043,354,'2-1 AsCB',300,192),(1044,354,'2-1 AsCB',51,200),(1045,355,'2-1 AsCB',1100,195),(1046,355,'2-1 AsCB',100,192),(1047,357,'2-1 AsCB',710,195),(1048,357,'2-1 AsCB',300,192),(1049,357,'2-1 AsCB',553,200),(1050,358,'2-1 AsCB',250,185),(1051,358,'2-1 AsCB',800,200),(1052,358,'2-1 AsCB',200,191),(1053,359,'2-1 AsCB',700,195),(1054,359,'2-1 AsCB',50,192),(1055,359,'2-1 AsCB',70,200),(1058,359,'2-1 AsP',760,220),(1059,359,'2-1 AsP',60,297),(1060,360,'2-1 AsCB',553,195),(1061,360,'2-1 AsCB',140,192),(1062,360,'5-2 Yg',803,300),(1063,361,'2-1 AsP',1201,220),(1064,361,'2-1 AsP',200,297),(1065,361,'2-1 AsCB',164,195),(1066,362,'2-1 AsCB',1120,200),(1067,362,'2-1 AsCB',130,191),(1069,362,'2-1 AsCB',95,301),(1070,363,'2-1 AsCB',47,206),(1071,363,'2-1 AsCB',709,205),(1072,363,'2-1 AsCB',819,195),(1073,363,'2-1 AsCB',300,177),(1074,363,'2-1 AsCB',40,302),(1075,363,'2-1 AsCB',73,208),(1076,364,'2-1 AsP',600,220),(1077,364,'2-1 AsCB',910,200),(1078,364,'2-1 AsP',270,176),(1080,365,'2-1 AsP',460,220),(1081,365,'2-1 AsCB',540,200),(1082,365,'2-1 AsCB',210,176),(1083,366,'2-1 AsCB',1320,195),(1084,366,'2-1 AsCB',180,177),(1085,366,'2-1 AsCB',70,302),(1086,367,'2-1 AsCB',300,185),(1087,367,'2-2-1 AsCB',300,304),(1088,367,'5-2 Yg',720,300),(1089,368,'2-1 AsCB',604,185),(1091,368,'2-2-1 AsCB',669,304),(1092,368,'2-1 AsCB',88,200),(1093,368,'2-1 AsCB',220,176),(1094,369,'2-1 AsCB',336,185),(1095,369,'2-2-1 AsCB',535,304),(1096,369,'2-1 AsCB',200,179),(1097,369,'2-1 AsCB',254,200),(1098,370,'2-1 AsCB',450,195),(1099,370,'2-1 AsCB',140,177),(1100,370,'2-1 AsCB',60,302),(1101,370,'2-1 AsCB',217,186),(1102,370,'2-1 AsCB',620,206),(1103,370,'2-1 AsCB',315,205),(1104,371,'2-1 AsCB',304,206),(1105,371,'2-1 AsCB',150,205),(1106,371,'2-1 AsCB',272,185),(1107,371,'2-1 AsCB',187,176),(1108,371,'2-1 AsCB',90,200),(1109,371,'2-2-1 AsCB',423,304),(1110,372,'2-1 AsCB',320,206),(1111,372,'2-1 AsCB',166,205),(1112,372,'2-1 AsCB',251,185),(1113,372,'2-1 AsCB',70,176),(1114,372,'2-1 AsCB',70,200),(1115,373,'2-1 AsCB',300,206),(1116,373,'2-1 AsCB',160,205),(1117,373,'2-1 AsCB',100,185),(1118,373,'2-1 AsCB',100,176),(1119,373,'2-1 AsCB',100,305),(1120,373,'2-1 AsCB',55,200),(1121,374,'2-1 AsCB',510,206),(1122,374,'2-1 AsCB',150,205),(1123,374,'2-1 AsCB',100,186),(1124,374,'2-1 AsCB',160,177),(1125,374,'2-1 AsCB',60,302),(1126,375,'2-1 AsCB',504,185),(1127,375,'2-1 AsCB',227,176),(1128,375,'2-1 AsCB',543,195),(1129,375,'2-1 AsCB',20,177),(1130,375,'2-1 AsCB',76,200),(1131,376,'2-1 AsCB',482,185),(1132,376,'2-1 AsCB',330,176),(1133,376,'2-1 AsCB',80,200),(1134,376,'2-1 AsCB',495,195),(1135,377,'2-1 AsCB',420,185),(1136,377,'2-1 AsCB',70,176),(1137,377,'2-1 AsCB',161,194),(1138,378,'2-1 AsCB',1240,195),(1139,378,'2-1 AsCB',160,177),(1140,378,'2-1 AsCB',90,302),(1141,379,'2-1 AsCB',923,194),(1142,379,'2-1 AsCB',110,181),(1143,379,'2-1 AsCB',200,195),(1144,379,'2-1 AsCB',230,176),(1145,379,'2-1 AsCB',30,305),(1146,380,'2-1 AsCB',200,181),(1147,380,'2-1 AsCB',560,194),(1148,380,'2-1 AsCB',180,176),(1149,380,'2-1 AsCB',300,206),(1150,380,'2-1 AsCB',150,205),(1151,380,'2-1 AsCB',160,200);
/*!40000 ALTER TABLE `movsRepoDimensionado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movsRepoOtrasActiv`
--

DROP TABLE IF EXISTS `movsRepoOtrasActiv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movsRepoOtrasActiv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idRepo` int(11) DEFAULT '0' COMMENT 'id de reportes de aserrio',
  `idRepoCT` int(11) DEFAULT '0' COMMENT 'id de reportes de clavado de tarima',
  `idRepoCL` int(11) DEFAULT '0' COMMENT 'id de reportes de corte a largo',
  `actividad` char(12) DEFAULT NULL,
  `cantidad` decimal(13,3) DEFAULT NULL,
  `idEmpleado` int(11) NOT NULL COMMENT 'a quien se le paga el destajo',
  PRIMARY KEY (`id`),
  KEY `idEmpleado` (`idEmpleado`,`idRepo`),
  KEY `idRepo` (`idRepo`),
  KEY `idRepoCT` (`idRepoCT`),
  KEY `idEmpleado_2` (`idEmpleado`,`idRepoCT`),
  KEY `idRepoCL` (`idRepoCL`),
  KEY `idEmpleado_3` (`idEmpleado`,`idRepoCL`)
) ENGINE=InnoDB AUTO_INCREMENT=1088 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movsRepoOtrasActiv`
--

LOCK TABLES `movsRepoOtrasActiv` WRITE;
/*!40000 ALTER TABLE `movsRepoOtrasActiv` DISABLE KEYS */;
INSERT INTO `movsRepoOtrasActiv` VALUES (9,10,0,0,'ctCORONA',66.000,12),(10,10,0,0,'ct43 1/4 1/2',20.000,12),(15,18,0,0,'ctDAL 38X38',48.000,46),(525,176,0,0,'2-3 AsCBZ',41.000,88),(527,178,0,0,'2-3 AsCJE',12.000,87),(529,178,0,0,'2-3 AsCBZ',28.000,87),(534,180,0,0,'2-3 AsCJD',4.000,55),(535,180,0,0,'2-3 AsCBZ',38.000,54),(537,182,0,0,'2-3 AsCJD',12.000,87),(539,182,0,0,'2-3 AsCBZ',100.000,87),(545,189,0,0,'2-3 AsCBZ',55.000,90),(546,189,0,0,'1-2 Rabr',8.000,87),(553,193,0,0,'2-3 AsCBZ',63.000,93),(555,202,0,0,'10-2  SCAv',1.000,88),(556,202,0,0,'10-2  SCAv',1.000,74),(559,205,0,0,'2-3 AsCBZ',40.000,87),(560,205,0,0,'2-3 AsCBZ',40.000,90),(561,231,0,0,'2-3 AsCJE',2.000,87),(562,231,0,0,'2-3 AsCJE',2.000,90),(563,238,0,0,'2-3 AsCJE',31.000,87),(564,238,0,0,'2-3 AsCJE',31.000,90),(565,241,0,0,'2-3 AsCBZ',10.000,88),(566,241,0,0,'2-3 AsCBZ',10.000,74),(567,242,0,0,'2-3 AsCBZ',16.000,87),(568,242,0,0,'2-3 AsCBZ',16.000,90),(569,251,0,0,'2-3 AsCBZ',14.000,87),(570,251,0,0,'2-3 AsCBZ',14.000,90),(571,251,0,0,'2-3 AsCJD',14.000,87),(572,251,0,0,'2-3 AsCJD',14.000,90),(573,252,0,0,'2-3 AsCBZ',24.500,69),(574,252,0,0,'2-3 AsCBZ',24.500,79),(575,256,0,0,'2-3 AsCJE',5.500,87),(576,256,0,0,'2-3 AsCJE',5.500,90),(578,268,0,0,'2-3 AsCBZ',10.000,88),(579,268,0,0,'2-3 AsCBZ',10.000,74),(580,273,0,0,'2-3 AsCJD',18.500,87),(581,273,0,0,'2-3 AsCJD',18.500,90),(584,277,0,0,'2-3 AsCJE',8.500,87),(585,277,0,0,'2-3 AsCJE',8.500,90),(586,283,0,0,'1-2 Rabr',5.000,88),(587,286,0,0,'1-3 Rarr',1.000,54),(588,286,0,0,'1-3 Rarr',1.000,55),(589,287,0,0,'2-3 AsCJE',8.900,87),(590,287,0,0,'2-3 AsCJE',8.900,90),(591,287,0,0,'2-3 AsCJE',5.000,87),(592,287,0,0,'2-3 AsCJE',5.000,90),(593,288,0,0,'1-3 Rarr',2.000,54),(594,288,0,0,'1-3 Rarr',2.000,55),(595,289,0,0,'1-3 Rarr',1.000,69),(596,289,0,0,'1-3 Rarr',1.000,79),(597,290,0,0,'2-3 AsCBZ',11.000,88),(598,290,0,0,'2-3 AsCBZ',11.000,74),(599,290,0,0,'1-3 Rarr',1.300,88),(600,290,0,0,'1-3 Rarr',1.300,74),(601,291,0,0,'2-3 AsCJE',10.000,87),(602,291,0,0,'2-3 AsCJE',10.000,90),(603,291,0,0,'2-3 AsCJD',10.000,87),(604,291,0,0,'2-3 AsCJD',10.000,90),(605,294,0,0,'1-3 Rarr',1.000,54),(606,294,0,0,'1-3 Rarr',1.000,55),(607,303,0,0,'2-3 AsCBZ',21.000,87),(608,303,0,0,'2-3 AsCBZ',21.000,90),(609,306,0,0,'2-3 AsCBZ',10.000,54),(610,306,0,0,'2-3 AsCBZ',10.000,55),(611,306,0,0,'1-3 Rarr',2.000,54),(612,306,0,0,'1-3 Rarr',2.000,55),(613,311,0,0,'1-3 Rarr',2.000,54),(614,311,0,0,'1-3 Rarr',2.000,55),(615,312,0,0,'2-3 AsCJD',27.000,87),(616,312,0,0,'2-3 AsCJD',27.000,90),(617,314,0,0,'10-2  SCAv',1.000,88),(618,318,0,0,'2-3 AsCJE',10.000,87),(619,318,0,0,'2-3 AsCJE',10.000,90),(620,320,0,0,'2-3 AsCBZ',12.500,88),(621,320,0,0,'2-3 AsCBZ',12.500,74),(622,324,0,0,'10-2  SCAv',3.000,69),(623,324,0,0,'10-2  SCAv',3.000,79),(624,0,58,0,'ctMAI01',143.000,60),(625,0,58,0,'ctMAI01',168.000,76),(626,0,58,0,'ctMAI01',25.000,90),(627,0,58,0,'ctMAI01',53.000,87),(628,0,58,0,'ctMAI01',7.000,88),(629,0,59,0,'ctMAI01',113.000,60),(630,0,59,0,'ctMAI01',110.000,76),(631,0,59,0,'ct0174D',151.000,70),(632,0,60,0,'ct0174D',112.000,60),(633,0,60,0,'ctMAI01',35.000,60),(634,0,60,0,'ct0174D',105.000,76),(635,0,60,0,'ctMAI01',32.000,76),(636,0,60,0,'ct0174D',130.000,70),(637,0,62,0,'ctMAI01',66.000,60),(638,0,62,0,'ctMAI01',60.000,76),(639,0,62,0,'ctMAI01',17.000,70),(640,0,63,0,'ct0174D',105.000,60),(641,0,63,0,'ct0174D',100.000,76),(642,0,63,0,'ct0174D',98.000,70),(644,0,65,0,'ct0174D',110.000,60),(645,0,65,0,'ct0174D',112.000,76),(646,0,65,0,'ct0174D',85.000,70),(647,0,65,0,'ctCOR01',10.000,70),(648,0,65,0,'10-2  CAvA',1.000,76),(649,0,66,0,'ct0174D',85.000,60),(650,0,66,0,'ct0207D',13.000,60),(651,0,66,0,'ct0174D',83.000,76),(652,0,66,0,'ct0207D',13.000,76),(653,0,66,0,'ctCOR01',103.000,70),(654,0,66,0,'ctCOR01',22.000,99),(655,0,66,0,'ctCOR01',10.000,100),(656,0,66,0,'10-2  CAvC',0.300,70),(657,0,67,0,'ct0207D',93.000,60),(658,0,67,0,'ct0224D',47.000,60),(659,0,67,0,'ct0207D',94.000,76),(660,0,67,0,'ct0224D',50.000,76),(661,0,67,0,'ctCOR01',109.000,70),(662,0,67,0,'ctCOR01',33.000,99),(663,0,67,0,'ctCOR01',17.000,100),(664,0,67,0,'10-2  CAvC',3.300,70),(665,0,68,0,'ct0224D',96.000,60),(666,0,68,0,'ct0207D',51.000,60),(667,0,68,0,'ct0224D',108.000,76),(668,0,68,0,'ct0207D',51.000,76),(669,0,68,0,'ct0207D',56.000,61),(670,0,68,0,'ctCOR01',110.000,70),(671,0,68,0,'ctCOR01',30.000,99),(672,0,68,0,'ctCOR01',22.000,100),(673,0,68,0,'10-2  CAvA',1.000,70),(674,0,69,0,'ct0203D',87.000,99),(675,0,69,0,'ct0203D',81.000,76),(676,0,69,0,'ct0203D',37.000,61),(677,0,69,0,'ctCOR01',54.000,70),(678,0,69,0,'10-2  CAvC',1.000,70),(684,0,71,0,'ct0203D',50.000,61),(685,0,71,0,'ct0203D',38.000,87),(686,0,71,0,'ct0203D',107.000,83),(687,0,71,0,'ct0203D',114.000,70),(688,0,72,0,'ct0203D',28.000,60),(689,0,72,0,'ct0043D',96.000,60),(690,0,72,0,'ctCOR01',59.000,70),(691,0,72,0,'ct0043D',60.000,70),(692,0,73,0,'ct0043D',136.000,60),(693,0,73,0,'ct0043D',135.000,76),(694,0,73,0,'ct0043D',40.000,61),(695,0,73,0,'ct0207D',52.000,61),(696,0,73,0,'ct0207D',106.000,70),(697,0,73,0,'ctCOR01',11.000,70),(698,0,73,0,'ctCOR01',38.000,99),(699,0,73,0,'ct0043D',38.000,100),(700,0,74,0,'ct0043D',36.000,60),(701,0,74,0,'ct0141D',121.000,60),(702,0,74,0,'ct0043D',35.000,76),(703,0,74,0,'ct0141D',76.000,76),(704,0,74,0,'ct0139D',51.000,76),(705,0,74,0,'ct0139D',86.000,61),(706,0,74,0,'ct0139D',27.000,101),(707,0,74,0,'ct0139D',37.000,99),(708,0,74,0,'ctCOR01',35.000,100),(709,0,74,0,'ctIEQ',2.000,99),(710,0,75,0,'ct0141D',118.000,60),(711,0,75,0,'ct 0085D',17.000,60),(713,0,75,0,'ct 0085D',114.000,61),(714,0,75,0,'ct0141D',122.000,76),(715,0,75,0,'ct 0085D',17.000,76),(716,0,75,0,'ct 0085D',42.000,99),(717,0,75,0,'ct0139D',20.000,100),(718,0,76,0,'ct 0085D',141.000,60),(719,0,76,0,'ct 0085D',135.000,76),(720,0,76,0,'ct 0085D',168.000,61),(721,0,76,0,'ct 0085D',41.000,100),(722,0,76,0,'ct0141D',25.000,76),(730,0,79,0,'ctCOR01',42.000,60),(731,0,79,0,'ct 0085D',105.000,76),(732,0,79,0,'ct 0085D',71.000,61),(733,0,81,0,'ctCOR01',100.000,76),(734,0,81,0,'ctCOR01',37.000,82),(740,0,81,0,'ctCOR01',37.000,81),(741,0,81,0,'ct 0085D',93.000,61),(742,0,81,0,'ct0043D',154.000,70),(743,0,81,0,'ct0043D',148.000,83),(744,0,82,0,'ct0043D',101.000,60),(746,0,82,0,'ct0043D',86.000,70),(747,0,82,0,'ctCOR01',71.000,76),(748,0,82,0,'ctCOR01',60.000,82),(749,0,82,0,'ctCOR01',68.000,81),(750,0,82,0,'ct0207D',5.000,61),(751,0,83,0,'ct0043D',170.000,60),(752,0,83,0,'ct0043D',132.000,70),(753,0,83,0,'ctCOR01',109.000,76),(754,0,83,0,'ctCOR01',54.000,82),(755,0,83,0,'ctCOR01',64.000,81),(756,0,83,0,'ct0207D',122.000,61),(761,0,85,0,'ct0043D',32.000,60),(762,0,85,0,'ct0141D',118.000,60),(763,0,85,0,'ct0043D',26.000,70),(764,0,85,0,'ct0141D',104.000,70),(765,0,85,0,'ctCOR01',43.000,76),(766,0,85,0,'ct0141D',91.000,76),(767,0,85,0,'ctCOR01',70.000,82),(768,0,85,0,'ctIEQ',20.000,81),(769,0,85,0,'ctCOR01',61.000,81),(770,0,85,0,'ct0207D',100.000,61),(771,0,86,0,'ctCOR01',70.000,82),(772,0,86,0,'ctCOR01',61.000,81),(773,0,86,0,'ct0207D',100.000,61),(774,0,86,0,'ctIEQ',20.000,81),(775,0,87,0,'ct0141D',145.000,60),(776,0,87,0,'ct0141D',142.000,76),(777,0,87,0,'ct0141D',105.000,70),(778,0,88,0,'ctCOR01',86.000,81),(779,0,88,0,'ctCOR01',77.000,82),(780,0,88,0,'ctCOR01',36.000,61),(782,0,88,0,'ct0207D',36.000,61),(783,0,89,0,'ct0141D',80.000,60),(784,0,89,0,'ct0224D',28.000,60),(785,0,89,0,'ct0141D',76.000,76),(786,0,89,0,'ct0224D',31.000,76),(787,0,89,0,'ct0141D',67.000,70),(788,0,89,0,'ct0224D',23.000,70),(789,0,90,0,'ct0224D',6.000,60),(790,0,90,0,'ctMAI01',67.000,60),(791,0,90,0,'ct0224D',4.000,76),(792,0,90,0,'ctMAI01',94.000,76),(793,0,91,0,'ctMAI01',11.000,61),(794,0,91,0,'ct0203D',31.000,61),(795,0,91,0,'ctMAI01',96.000,81),(796,0,91,0,'ctMAI01',96.000,82),(797,0,91,0,'ctMAI01',68.000,83),(798,0,92,0,'ct0139D',21.000,61),(799,0,92,0,'ct0203D',3.000,61),(800,0,92,0,'ct0139D',17.000,82),(801,0,92,0,'ctCOR01',28.000,82),(802,0,92,0,'ct0203D',32.000,81),(803,0,92,0,'ctCOR01',41.000,81),(804,0,93,0,'ct0139D',85.000,61),(805,0,93,0,'ct0139D',61.000,82),(806,0,93,0,'ctIEQ',66.000,81),(807,0,94,0,'ct0043D',74.000,60),(808,0,94,0,'ct0224D',23.000,60),(809,0,94,0,'ct0141D',27.000,60),(810,0,94,0,'ct0043D',75.000,76),(811,0,94,0,'ct0224D',20.000,76),(812,0,94,0,'ct0141D',26.000,76),(813,0,94,0,'ct0043D',68.000,70),(814,0,94,0,'ct0224D',28.000,70),(815,0,94,0,'ct0141D',22.000,70),(816,0,95,0,'ct0043D',144.000,60),(817,0,95,0,'ct0043D',131.000,76),(818,0,95,0,'ct0043D',124.000,70),(824,0,97,0,'ctIEQ',100.000,82),(825,0,97,0,'ctIEQ',100.000,81),(826,0,97,0,'ct0139D',71.000,61),(827,0,97,0,'ct0043D',9.000,61),(828,0,97,0,'10-2  CAvC',2.300,81),(829,0,97,0,'10-2  CAvC',2.300,82),(830,0,97,0,'10-2  CAvA',3.000,61),(831,0,98,0,'ct0043D',82.000,60),(832,0,98,0,'ct0043D',82.000,76),(833,0,98,0,'ct0043D',73.000,70),(834,0,98,0,'10-2  CAvE',1.300,81),(835,0,98,0,'10-2  CAvE',1.300,82),(836,0,99,0,'ctIEQ',80.000,82),(837,0,99,0,'ctIEQ',84.000,81),(838,0,99,0,'ct0043D',75.000,61),(839,0,100,0,'ct0043D',111.000,60),(840,0,100,0,'ct0043D',101.000,76),(841,0,100,0,'ct0043D',94.000,70),(842,0,101,0,'ctIEQ',80.000,82),(843,0,101,0,'ctIEQ',34.000,81),(844,0,101,0,'ctIEQ',54.000,61),(846,0,101,0,'ctIEQ',28.000,83),(847,0,102,0,'ct0043D',38.000,60),(848,0,102,0,'ct0043D',33.000,76),(849,0,102,0,'ct0043D',33.000,70),(850,0,103,0,'ctIEQ',1.000,82),(851,0,103,0,'ctIEQ',8.000,81),(852,0,103,0,'ctIEQ',18.000,61),(853,0,104,0,'ct0043D',93.000,60),(854,0,104,0,'ct 0085D',45.000,60),(855,0,104,0,'ct0043D',88.000,76),(856,0,104,0,'ct 0085D',43.000,76),(857,0,105,0,'ctIEQ',67.000,82),(858,0,105,0,'ctIEQ',54.000,81),(859,0,106,0,'ctIEQ',36.000,81),(860,0,106,0,'ctCOR01',28.000,81),(861,0,106,0,'ctIEQ',90.000,82),(862,0,106,0,'ctCOR01',68.000,61),(863,0,107,0,'ct 0085D',160.000,60),(864,0,107,0,'ct 0085D',161.000,76),(865,0,107,0,'ct 0085D',40.000,70),(866,0,108,0,'ctIEQ',90.000,82),(867,0,108,0,'ctCOR01',90.000,61),(868,0,108,0,'ctCOR01',44.000,81),(869,0,109,0,'ct0141D',60.000,60),(870,0,109,0,'ct0043D',61.000,60),(871,0,109,0,'ct 0085D',45.000,76),(872,0,109,0,'ct0043D',96.000,76),(873,0,109,0,'ct 0085D',47.000,70),(875,0,109,0,'ct0043D',38.000,70),(876,0,110,0,'ct0043D',9.000,60),(877,0,110,0,'ct 0085D',41.000,60),(878,0,110,0,'ctIEQ',53.000,60),(879,0,110,0,'ct0043D',8.000,76),(880,0,110,0,'ct 0085D',41.000,76),(881,0,110,0,'ctIEQ',50.000,76),(882,0,110,0,'ct0043D',8.000,70),(883,0,110,0,'ct 0085D',37.000,70),(884,0,110,0,'ctIEQ',44.000,70),(885,0,111,0,'ctCOR01',29.000,61),(886,0,111,0,'ctIEQ',50.000,82),(887,0,111,0,'ctCOR01',37.000,83),(888,0,111,0,'ctCOR01',28.000,81),(892,0,111,0,'10-2  CAvC',6.000,81),(893,0,111,0,'10-2  CAvC',6.000,82),(894,0,112,0,'ctIEQ',92.000,60),(895,0,112,0,'ctIEQ',90.000,76),(896,0,112,0,'ctIEQ',66.000,70),(897,0,113,0,'ctCOR01',73.000,83),(898,0,113,0,'ctIEQ',3.000,83),(899,0,113,0,'ctCOR01',70.000,81),(900,0,113,0,'10-2  CAvC',8.000,82),(902,0,113,0,'10-2  CAvC',8.000,61),(903,0,114,0,'ctIEQ',33.000,60),(904,0,114,0,'ctIEQ',29.000,76),(905,0,115,0,'ctIEQ',54.000,82),(906,0,115,0,'ctCOR01',49.000,81),(907,0,115,0,'ctIEQ',15.000,61),(908,0,115,0,'10-2  CAvC',3.000,82),(909,0,115,0,'10-2  CAvC',3.000,81),(910,0,115,0,'10-2  CAvC',6.000,83),(912,0,115,0,'10-2  CAvC',4.000,61),(913,0,115,0,'9-1 PEmbA',1.000,81),(914,0,115,0,'9-1 PEmbA',1.000,82),(915,0,116,0,'10-2  CAvC',5.000,82),(916,0,116,0,'10-2  CAvC',3.000,61),(918,0,116,0,'10-2  CAvE',5.000,81),(919,0,116,0,'10-2  CAvP',4.000,61),(920,0,117,0,'ctIEQ',49.000,60),(921,0,117,0,'ct0043D',85.000,60),(922,0,117,0,'ct0043D',60.000,61),(923,0,117,0,'ct0043D',58.000,83),(924,0,118,0,'ct0043D',122.000,60),(925,0,118,0,'ct0043D',118.000,76),(926,0,118,0,'ct0043D',113.000,70),(927,0,119,0,'ctCOR01',55.000,81),(928,0,119,0,'ctCOR01',55.000,61),(929,0,119,0,'ctCOR01',74.000,82),(930,0,119,0,'10-2  CAvC',9.000,83),(931,0,119,0,'10-2  CAvC',1.000,83),(932,0,120,0,'ctCOR01',24.000,61),(933,0,120,0,'ctIEQ',74.000,81),(934,0,120,0,'ctIEQ',72.000,82),(935,332,0,0,'2-3 AsCBZ',15.000,87),(936,332,0,0,'2-3 AsCBZ',15.000,90),(937,333,0,0,'2-3 AsCBZ',25.000,79),(943,338,0,0,'2-3 AsCBZ',7.000,87),(944,338,0,0,'2-3 AsCBZ',7.000,90),(945,339,0,0,'10-2  SCBC',3.000,79),(946,340,0,0,'2-3 AsCBZ',6.500,88),(947,340,0,0,'2-3 AsCBZ',6.500,74),(948,0,124,0,'ctIEQ',70.000,81),(949,0,124,0,'ctCOR01',18.000,61),(950,0,124,0,'ctIEQ',62.000,82),(951,0,124,0,'ctIEQ',69.000,83),(952,0,124,0,'10-2  CAvC',2.000,81),(953,0,124,0,'10-2  CAvC',2.000,82),(954,0,125,0,'ct0207D',76.000,60),(956,0,125,0,'ct0207D',78.000,61),(957,0,125,0,'ct0207D',67.000,70),(958,0,126,0,'ctIEQ',100.000,81),(959,0,126,0,'ctIEQ',73.000,82),(960,0,126,0,'ctIEQ',96.000,83),(961,0,127,0,'ct0207D',98.000,60),(962,0,127,0,'ct0207D',88.000,76),(963,0,127,0,'ct0207D',85.000,70),(964,0,127,0,'10-2  CAvC',1.000,60),(965,0,127,0,'10-2  CAvC',1.000,76),(966,0,127,0,'10-2  CAvC',1.000,70),(967,342,0,0,'10-2  SCAv',1.000,87),(968,342,0,0,'10-2  SCAv',1.000,90),(969,344,0,0,'10-2  CAvC',3.000,79),(974,344,0,0,'10-2  SCAv',3.000,56),(975,0,128,0,'ct0207D',30.000,60),(976,0,128,0,'ct0207D',27.000,76),(977,0,128,0,'ct0207D',27.000,70),(978,348,0,0,'2-3 AsCJE',15.000,87),(979,348,0,0,'2-3 AsCJE',15.000,90),(980,349,0,0,'2-3 AsCBZ',7.500,88),(981,349,0,0,'2-3 AsCBZ',7.500,74),(982,349,0,0,'1-2 Rabr',5.000,74),(983,351,0,0,'2-3 AsCBZ',5.000,54),(984,351,0,0,'2-3 AsCBZ',5.000,55),(986,0,129,0,'10-2  CAvC',5.000,82),(987,0,129,0,'10-2  CAvC',5.000,81),(988,0,129,0,'10-2  CAvC',5.000,83),(989,0,130,0,'ctCOR01',33.000,82),(990,0,130,0,'ctCOR01',40.000,81),(991,0,130,0,'ctCOR01',40.000,83),(992,0,130,0,'ctIEQ',19.000,82),(993,0,130,0,'ctIEQ',27.000,81),(994,0,130,0,'ctIEQ',28.000,83),(995,0,131,0,'ct0141D',115.000,60),(996,0,131,0,'ct0141D',106.000,76),(997,0,131,0,'ct0141D',105.000,70),(998,0,131,0,'10-2  CAvC',1.000,60),(999,0,131,0,'10-2  CAvC',1.000,76),(1000,0,131,0,'10-2  CAvC',1.000,70),(1001,352,0,0,'2-3 AsCJD',10.500,87),(1002,352,0,0,'2-3 AsCJD',10.500,90),(1003,352,0,0,'2-3 AsCBZ',25.500,87),(1004,352,0,0,'2-3 AsCBZ',25.500,90),(1005,352,0,0,'2-3 AsCJE',2.000,87),(1006,352,0,0,'2-3 AsCJE',2.000,90),(1007,0,132,0,'ct0141D',54.000,60),(1008,0,132,0,'ct0207D',9.000,60),(1009,0,132,0,'ct0141D',53.000,76),(1010,0,132,0,'ct0207D',8.000,76),(1011,0,132,0,'ct0141D',47.000,70),(1012,0,132,0,'ct0207D',8.000,70),(1014,356,0,0,'1-3 Rarr',2.000,90),(1015,356,0,0,'10-2  SCNP',7.000,90),(1018,359,0,0,'10-2  SCAv',2.000,54),(1019,359,0,0,'10-2  SCAv',2.000,55),(1020,0,133,0,'ctCOR01',13.000,81),(1021,0,133,0,'ctCOR01',14.000,82),(1022,0,133,0,'ctCOR01',17.000,83),(1023,0,133,0,'ctMAI01',10.000,81),(1024,0,133,0,'ctMAI01',8.000,82),(1025,0,133,0,'ctMAI01',9.000,83),(1026,0,134,0,'ctMAI01',104.000,81),(1027,0,134,0,'ctMAI01',100.000,82),(1028,0,134,0,'ctMAI01',117.000,83),(1029,0,135,0,'ct0207D',66.000,60),(1030,0,135,0,'ct0203D',35.000,60),(1031,0,135,0,'10-2  CAvC',2.000,60),(1032,0,135,0,'10-2  CAvC',9.000,76),(1033,0,135,0,'10-2  CAvC',9.000,70),(1034,361,0,0,'10-2  SCAv',1.000,88),(1035,361,0,0,'10-2  SCAv',1.000,74),(1036,362,0,0,'2-3 AsCJD',5.000,72),(1037,362,0,0,'2-3 AsCJD',5.000,79),(1038,0,136,0,'ctMAI01',90.000,81),(1039,0,136,0,'ctMAI01',82.000,82),(1040,0,136,0,'ctMAI01',94.000,83),(1041,0,137,0,'10-2  CAvA',9.000,76),(1042,0,137,0,'10-2  CAvA',6.000,70),(1043,0,137,0,'ct0203D',124.000,60),(1044,0,138,0,'ctMAI01',103.000,81),(1045,0,138,0,'ctMAI01',92.000,82),(1046,0,138,0,'ctMAI01',113.000,83),(1048,0,138,0,'10-2  CAvA',1.000,83),(1049,0,139,0,'ct0203D',79.000,60),(1050,0,139,0,'ctIEQ',64.000,60),(1051,0,139,0,'ct0141D',87.000,76),(1052,0,139,0,'ct0141D',51.000,76),(1053,0,139,0,'ct0203D',54.000,70),(1054,0,139,0,'ctIEQ',45.000,70),(1055,0,139,0,'10-2  CAvP',1.000,60),(1056,0,139,0,'10-2  SCAv',1.000,76),(1057,0,139,0,'10-2  CAvP',1.000,70),(1058,0,139,0,'10-2  CAvA',4.000,76),(1059,0,140,0,'ctMAI01',18.000,82),(1060,0,140,0,'ctMAI01',20.000,81),(1062,0,140,0,'10-2  CAvA',4.000,83),(1063,0,141,0,'ct0141D',103.000,76),(1064,0,141,0,'ct0141D',38.000,70),(1065,0,141,0,'ct0203D',39.000,70),(1066,372,0,0,'2-3 AsCBZ',12.000,88),(1067,372,0,0,'2-3 AsCBZ',12.000,74),(1068,0,143,0,'ctMAI01',37.000,81),(1069,0,143,0,'ctIEQ',17.000,81),(1070,0,143,0,'ctMAI01',29.000,82),(1071,0,143,0,'ctIEQ',13.000,81),(1072,0,143,0,'ctMAI01',38.000,83),(1073,0,143,0,'ctIEQ',74.000,83),(1074,0,144,0,'ct0141D',118.000,60),(1075,0,144,0,'ct0141D',41.000,76),(1076,0,144,0,'10-2  CAvP',1.000,60),(1077,0,144,0,'10-2  CAvP',5.000,76),(1078,375,0,0,'2-3 AsCJE',9.500,87),(1079,375,0,0,'2-3 AsCJE',9.500,90),(1080,0,145,0,'ctIEQ',75.000,81),(1081,0,145,0,'ctIEQ',77.000,82),(1082,0,145,0,'ctIEQ',77.000,83),(1083,0,146,0,'ct0141D',54.000,60),(1084,0,146,0,'ct0174D',92.000,60),(1085,0,146,0,'ct0141D',50.000,76),(1087,0,146,0,'ct0174D',91.000,76);
/*!40000 ALTER TABLE `movsRepoOtrasActiv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repoCL`
--

DROP TABLE IF EXISTS `repoCL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repoCL` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supervisor` char(20) DEFAULT NULL,
  `area` int(11) DEFAULT '0',
  `fecha` date DEFAULT NULL,
  `sierraGemela` char(10) DEFAULT NULL,
  `operador` int(11) DEFAULT NULL,
  `entrego` char(20) DEFAULT NULL,
  `recibio` char(20) DEFAULT NULL,
  `aplicadaEnInventario` char(1) DEFAULT 'n',
  PRIMARY KEY (`id`),
  KEY `fecha` (`fecha`),
  KEY `operador` (`operador`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repoCL`
--

LOCK TABLES `repoCL` WRITE;
/*!40000 ALTER TABLE `repoCL` DISABLE KEYS */;
INSERT INTO `repoCL` VALUES (39,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-02','1',56,'56','62','n'),(40,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-03','1',58,'58','62','n'),(41,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-04','1',56,'56','62','n'),(42,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-05','1',56,'56','62','n'),(43,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-07','1',56,'56','62','n'),(44,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-08','1',56,'56','62','n'),(45,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-11','1',56,'56','62','n'),(46,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-12','1',56,'56','62','n'),(47,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-12','1',58,'58','62','n'),(48,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-12','1',9,'9','62','n'),(49,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-14','1',56,'56','62','n'),(50,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-15','1',56,'56','62','n'),(51,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-16','1',56,'56','62','n'),(52,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-16','1',94,'94','62','n'),(53,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-16','1',94,'94','62','n'),(54,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-17','1',94,'94','62','n'),(55,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-17','1',56,'56','62','n'),(56,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-18','1',56,'56','62','n'),(57,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-18','1',94,'94','62','n'),(58,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-19','1',56,'56','62','n'),(59,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-19','1',94,'94','62','n'),(60,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-21','1',56,'56','62','n'),(61,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-22','1',56,'56','62','n'),(62,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-22','1',56,'56','62','n'),(63,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-22','1',94,'94','62','n'),(64,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-23','1',56,'56','62','n'),(65,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-23','1',94,'94','62','n'),(66,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-24','1',56,'56','62','n'),(67,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-24','1',56,'56','62','n'),(68,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-24','1',95,'95','62','n'),(69,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-25','1',56,'56','62','n'),(70,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-25','1',94,'94','62','n'),(71,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-29','1',56,'56','62','n'),(72,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-01-30','1',56,'56','62','n'),(73,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-01','1',56,'56','62','n'),(74,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-02','1',56,'56','62','n'),(75,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-04','1',56,'56','62','n'),(76,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-07','1',56,'56','62','n'),(77,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-07','1',56,'56','62','n'),(78,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-08','1',56,'56','62','n'),(79,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-08','1',56,'56','62','n'),(80,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-11','1',56,'56','62','n'),(81,'SEÃ‘ORA ROSA',0,'2019-02-08','1',67,'61','67','n'),(82,'SEÃ‘ORA ROSA',0,'2019-02-02','1',83,'83','67','n'),(83,'SEÃ‘ORA ROSA',0,'2019-02-04','1',83,'83','67','n'),(84,'SEÃ‘ORA ROSA',0,'2019-02-05','1',83,'83','67','n'),(85,'SEÃ‘ORA ROSA',0,'2019-02-06','1',83,'83','67','n'),(86,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-18','1',56,'56','62','n'),(87,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-19','1',56,'56','62','n'),(88,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-20','1',56,'56','62','n'),(89,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-21','1',56,'56','62','n'),(90,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-22','1',56,'56','62','n'),(91,'ARTURO DIAZ IBAÃ‘EZ',0,'2019-02-23','1',56,'56','62','n');
/*!40000 ALTER TABLE `repoCL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repoCT`
--

DROP TABLE IF EXISTS `repoCT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repoCT` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supervisor` char(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `aplicadaEnInventario` char(1) DEFAULT 'n',
  PRIMARY KEY (`id`),
  KEY `fecha` (`fecha`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repoCT`
--

LOCK TABLES `repoCT` WRITE;
/*!40000 ALTER TABLE `repoCT` DISABLE KEYS */;
INSERT INTO `repoCT` VALUES (58,'ARTURO DIAZ IBAÃ‘EZ','2019-01-02','n'),(59,'ARTURO DIAZ IBAÃ‘EZ','2019-01-03','n'),(60,'ARTURO DIAZ IBAÃ‘EZ','2019-01-04','n'),(62,'ARTURO DIAZ IBAÃ‘EZ','2019-01-05','n'),(63,'ARTURO DIAZ IBAÃ‘EZ','2019-01-07','n'),(65,'ARTURO DIAZ IBAÃ‘EZ','2019-01-08','n'),(66,'ARTURO DIAZ IBAÃ‘EZ','2019-01-09','n'),(67,'ARTURO DIAZ IBAÃ‘EZ','2019-01-10','n'),(68,'ARTURO DIAZ IBAÃ‘EZ','2019-01-11','n'),(69,'ARTURO DIAZ IBAÃ‘EZ','2019-01-12','n'),(71,'SEÃ‘ORA ROSA','2019-01-13','n'),(72,'ARTURO DIAZ IBAÃ‘EZ','2019-01-14','n'),(73,'ARTURO DIAZ IBAÃ‘EZ','2019-01-15','n'),(74,'ARTURO DIAZ IBAÃ‘EZ','2019-01-16','n'),(75,'ARTURO DIAZ IBAÃ‘EZ','2019-01-17','n'),(76,'ARTURO DIAZ IBAÃ‘EZ','2019-01-18','n'),(79,'ARTURO DIAZ IBAÃ‘EZ','2019-01-19','n'),(81,'SEÃ‘ORA ROSA','2019-01-20','n'),(82,'ARTURO DIAZ IBAÃ‘EZ','2019-01-21','n'),(83,'ARTURO DIAZ IBAÃ‘EZ','2019-01-22','n'),(85,'ARTURO DIAZ IBAÃ‘EZ','2019-01-23','n'),(86,'SEÃ‘ORA ROSA','2019-01-23','n'),(87,'ARTURO DIAZ IBAÃ‘EZ','2019-01-24','n'),(88,'SEÃ‘ORA ROSA','2019-01-25','n'),(89,'ARTURO DIAZ IBAÃ‘EZ','2019-01-25','n'),(90,'ARTURO DIAZ IBAÃ‘EZ','2019-01-26','n'),(91,'SEÃ‘ORA ROSA','2019-01-26','n'),(92,'SEÃ‘ORA ROSA','2019-01-28','n'),(93,'SEÃ‘ORA ROSA','2019-01-29','n'),(94,'ARTURO DIAZ IBAÃ‘EZ','2019-01-29','n'),(95,'ARTURO DIAZ IBAÃ‘EZ','2019-01-30','n'),(97,'SEÃ‘ORA ROSA','2019-01-30','n'),(98,'ARTURO DIAZ IBAÃ‘EZ','2019-01-31','n'),(99,'SEÃ‘ORA ROSA','2019-01-31','n'),(100,'ARTURO DIAZ IBAÃ‘EZ','2019-02-01','n'),(101,'SEÃ‘ORA ROSA','2019-02-01','n'),(102,'ARTURO DIAZ IBAÃ‘EZ','2019-02-02','n'),(103,'SEÃ‘ORA ROSA','2019-02-02','n'),(104,'ARTURO DIAZ IBAÃ‘EZ','2019-02-04','n'),(105,'SEÃ‘ORA ROSA','2019-02-04','n'),(106,'SEÃ‘ORA ROSA','2019-02-05','n'),(107,'ARTURO DIAZ IBAÃ‘EZ','2019-02-05','n'),(108,'SEÃ‘ORA ROSA','2019-02-06','n'),(109,'ARTURO DIAZ IBAÃ‘EZ','2019-02-06','n'),(110,'ARTURO DIAZ IBAÃ‘EZ','2019-02-07','n'),(111,'SEÃ‘ORA ROSA','2019-02-07','n'),(112,'ARTURO DIAZ IBAÃ‘EZ','2019-02-08','n'),(113,'SEÃ‘ORA ROSA','2019-02-08','n'),(114,'ARTURO DIAZ IBAÃ‘EZ','2019-02-09','n'),(115,'SEÃ‘ORA ROSA','2019-02-11','n'),(116,'SEÃ‘ORA ROSA','2019-02-09','n'),(117,'ARTURO DIAZ IBAÃ‘EZ','2019-02-11','n'),(118,'ARTURO DIAZ IBAÃ‘EZ','2019-02-12','n'),(119,'SEÃ‘ORA ROSA','2019-02-12','n'),(120,'SEÃ‘ORA ROSA','2019-02-13','n'),(123,'ARTURO DIAZ IBAÃ‘EZ','2019-02-13','n'),(124,'SEÃ‘ORA ROSA','2019-02-14','n'),(125,'ARTURO DIAZ IBAÃ‘EZ','2019-02-14','n'),(126,'SEÃ‘ORA ROSA','2019-02-15','n'),(127,'ARTURO DIAZ IBAÃ‘EZ','2019-02-15','n'),(128,'ARTURO DIAZ IBAÃ‘EZ','2019-02-16','n'),(129,'SEÃ‘ORA ROSA','2019-02-16','n'),(130,'SEÃ‘ORA ROSA','2019-02-18','n'),(131,'ARTURO DIAZ IBAÃ‘EZ','2019-02-18','n'),(132,'ARTURO DIAZ IBAÃ‘EZ','2019-02-19','n'),(133,'SEÃ‘ORA ROSA','2019-02-19','n'),(134,'SEÃ‘ORA ROSA','2019-02-20','n'),(135,'ARTURO DIAZ IBAÃ‘EZ','2019-02-20','n'),(136,'ARTURO DIAZ IBAÃ‘EZ','2019-02-21','n'),(137,'ARTURO DIAZ IBAÃ‘EZ','2019-02-21','n'),(138,'SEÃ‘ORA ROSA','2019-02-22','n'),(139,'ARTURO DIAZ IBAÃ‘EZ','2019-02-22','n'),(140,'SEÃ‘ORA ROSA','2019-02-23','n'),(141,'ARTURO DIAZ IBAÃ‘EZ','2019-02-23','n'),(142,'ARTURO DIAZ IBAÃ‘EZ','2019-02-23','n'),(143,'SEÃ‘ORA ROSA','2019-02-25','n'),(144,'ARTURO DIAZ IBAÃ‘EZ','2019-02-25','n'),(145,'SEÃ‘ORA ROSA','2019-02-26','n'),(146,'ARTURO DIAZ IBAÃ‘EZ','2019-02-26','n');
/*!40000 ALTER TABLE `repoCT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repoProd`
--

DROP TABLE IF EXISTS `repoProd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repoProd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supervisor` char(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `sierraCinta` char(10) DEFAULT NULL,
  `operador` int(11) DEFAULT NULL,
  `pctjOp` int(11) DEFAULT NULL,
  `ayudante` int(11) DEFAULT NULL,
  `pctjAyu` int(11) DEFAULT NULL,
  `entrego` char(20) DEFAULT NULL,
  `recibio` char(20) DEFAULT NULL,
  `aplicadaEnInventario` char(1) DEFAULT 'n',
  PRIMARY KEY (`id`),
  KEY `fecha` (`fecha`),
  KEY `operador` (`operador`),
  KEY `ayudante` (`ayudante`)
) ENGINE=InnoDB AUTO_INCREMENT=381 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repoProd`
--

LOCK TABLES `repoProd` WRITE;
/*!40000 ALTER TABLE `repoProd` DISABLE KEYS */;
INSERT INTO `repoProd` VALUES (175,'ARTURO DIAZ IBAÃ‘EZ','2019-01-02','6',72,100,93,0,'72','62','n'),(176,'ARTURO DIAZ IBAÃ‘EZ','2019-01-02','3',88,50,74,50,'88','62','n'),(177,'ARTURO DIAZ IBAÃ‘EZ','2019-01-02','4',54,50,55,50,'54','62','n'),(178,'ARTURO DIAZ IBAÃ‘EZ','2019-01-02','1',87,50,90,50,'87','62','n'),(179,'ARTURO DIAZ IBAÃ‘EZ','2019-01-02','2',69,50,79,50,'62','69','n'),(180,'ARTURO DIAZ IBAÃ‘EZ','2019-01-03','4',54,50,55,50,'54','62','n'),(181,'ARTURO DIAZ IBAÃ‘EZ','2019-01-03','6',72,50,93,50,'72','62','n'),(182,'ARTURO DIAZ IBAÃ‘EZ','2019-01-03','1',87,50,90,50,'87','62','n'),(183,'ARTURO DIAZ IBAÃ‘EZ','2019-01-03','2',69,50,79,50,'69','62','n'),(184,'ARTURO DIAZ IBAÃ‘EZ','2019-01-04','1',87,50,90,50,'87','62','n'),(185,'ARTURO DIAZ IBAÃ‘EZ','2019-01-04','2',69,50,58,50,'69','62','n'),(186,'ARTURO DIAZ IBAÃ‘EZ','2019-01-04','3',88,50,74,50,'88','62','n'),(187,'ARTURO DIAZ IBAÃ‘EZ','2019-01-04','4',54,50,55,50,'54','62','n'),(189,'ARTURO DIAZ IBAÃ‘EZ','2019-01-05','1',87,50,90,50,'87','62','n'),(190,'ARTURO DIAZ IBAÃ‘EZ','2019-01-05','2',69,50,79,50,'69','62','n'),(191,'ARTURO DIAZ IBAÃ‘EZ','2019-01-05','3',88,50,74,50,'88','62','n'),(192,'ARTURO DIAZ IBAÃ‘EZ','2019-01-05','4',54,50,55,50,'54','62','n'),(193,'ARTURO DIAZ IBAÃ‘EZ','2019-01-05','6',93,50,72,50,'93','62','n'),(194,'ARTURO DIAZ IBAÃ‘EZ','2019-01-07','1',87,50,90,50,'87','62','n'),(195,'ARTURO DIAZ IBAÃ‘EZ','2019-01-07','2',69,50,79,50,'69','62','n'),(196,'ARTURO DIAZ IBAÃ‘EZ','2019-01-07','3',88,50,74,50,'88','62','n'),(197,'ARTURO DIAZ IBAÃ‘EZ','2019-01-07','4',54,50,55,50,'54','62','n'),(198,'ARTURO DIAZ IBAÃ‘EZ','2019-01-04','6',93,50,72,50,'93','62','n'),(199,'ARTURO DIAZ IBAÃ‘EZ','2019-01-07','6',72,50,58,50,'72','62','n'),(200,'ARTURO DIAZ IBAÃ‘EZ','2019-01-08','1',87,50,90,50,'87','62','n'),(201,'ARTURO DIAZ IBAÃ‘EZ','2019-01-08','2',69,50,79,50,'69','62','n'),(202,'ARTURO DIAZ IBAÃ‘EZ','2019-01-08','3',88,50,74,50,'88','62','n'),(203,'ARTURO DIAZ IBAÃ‘EZ','2019-01-08','4',54,50,55,50,'54','62','n'),(204,'ARTURO DIAZ IBAÃ‘EZ','2019-01-08','6',72,50,58,50,'72','62','n'),(205,'ARTURO DIAZ IBAÃ‘EZ','2019-01-09','1',87,50,90,50,'87','62','n'),(206,'ARTURO DIAZ IBAÃ‘EZ','2019-01-09','2',69,50,79,50,'69','62','n'),(207,'ARTURO DIAZ IBAÃ‘EZ','2019-01-11','1',87,50,90,50,'87','62','n'),(208,'ARTURO DIAZ IBAÃ‘EZ','2019-01-11','4',54,50,55,50,'54','62','n'),(209,'ARTURO DIAZ IBAÃ‘EZ','2019-01-11','3',88,50,74,50,'88','62','n'),(210,'ARTURO DIAZ IBAÃ‘EZ','2019-01-11','2',69,50,79,50,'69','62','n'),(211,'ARTURO DIAZ IBAÃ‘EZ','2019-01-11','6',72,50,58,50,'72','62','n'),(212,'ARTURO DIAZ IBAÃ‘EZ','2019-01-12','1',87,50,90,50,'87','62','n'),(213,'ARTURO DIAZ IBAÃ‘EZ','2019-01-12','1',87,50,90,50,'87','62','n'),(214,'ARTURO DIAZ IBAÃ‘EZ','2019-01-12','4',54,50,55,50,'54','62','n'),(215,'ARTURO DIAZ IBAÃ‘EZ','2019-01-12','2',72,50,58,50,'72','62','n'),(216,'ARTURO DIAZ IBAÃ‘EZ','2019-01-12','3',88,50,74,50,'88','62','n'),(217,'ARTURO DIAZ IBAÃ‘EZ','2019-01-12','2',69,50,79,50,'69','62','n'),(219,'ARTURO DIAZ IBAÃ‘EZ','2019-01-14','1',87,50,90,50,'87','62','n'),(220,'ARTURO DIAZ IBAÃ‘EZ','2019-01-14','3',54,50,55,50,'54','62','n'),(221,'ARTURO DIAZ IBAÃ‘EZ','2019-01-14','2',69,50,79,50,'69','62','n'),(222,'ARTURO DIAZ IBAÃ‘EZ','2019-01-14','3',88,50,74,50,'88','62','n'),(223,'ARTURO DIAZ IBAÃ‘EZ','2019-01-15','1',58,50,90,50,'58','62','n'),(224,'ARTURO DIAZ IBAÃ‘EZ','2019-01-15','4',54,50,55,50,'54','62','n'),(225,'ARTURO DIAZ IBAÃ‘EZ','2019-01-15','2',69,50,79,50,'69','62','n'),(226,'ARTURO DIAZ IBAÃ‘EZ','2019-01-15','3',88,50,74,50,'88','62','n'),(227,'ARTURO DIAZ IBAÃ‘EZ','2019-01-16','1',87,50,90,50,'87','62','n'),(228,'ARTURO DIAZ IBAÃ‘EZ','2019-01-16','3',54,50,55,50,'54','62','n'),(229,'ARTURO DIAZ IBAÃ‘EZ','2019-01-16','2',69,50,79,50,'69','62','n'),(230,'ARTURO DIAZ IBAÃ‘EZ','2019-01-16','3',88,50,74,50,'88','62','n'),(231,'ARTURO DIAZ IBAÃ‘EZ','2019-01-17','1',87,50,90,50,'87','62','n'),(232,'ARTURO DIAZ IBAÃ‘EZ','2019-01-17','3',88,50,74,50,'88','62','n'),(233,'ARTURO DIAZ IBAÃ‘EZ','2019-01-17','2',69,50,79,50,'69','62','n'),(234,'ARTURO DIAZ IBAÃ‘EZ','2019-01-18','1',87,50,90,50,'87','62','n'),(235,'ARTURO DIAZ IBAÃ‘EZ','2019-01-18','4',54,50,55,50,'54','62','n'),(236,'ARTURO DIAZ IBAÃ‘EZ','2019-01-18','3',88,50,74,50,'88','62','n'),(237,'ARTURO DIAZ IBAÃ‘EZ','2019-01-18','2',69,100,79,0,'69','62','n'),(238,'ARTURO DIAZ IBAÃ‘EZ','2019-01-19','1',87,50,90,50,'87','62','n'),(239,'ARTURO DIAZ IBAÃ‘EZ','2019-01-19','4',54,50,55,50,'54','62','n'),(240,'ARTURO DIAZ IBAÃ‘EZ','2019-01-19','2',69,50,79,50,'69','62','n'),(241,'ARTURO DIAZ IBAÃ‘EZ','2019-01-19','3',88,50,74,50,'88','62','n'),(242,'ARTURO DIAZ IBAÃ‘EZ','2019-01-21','1',87,50,90,50,'87','62','n'),(243,'ARTURO DIAZ IBAÃ‘EZ','2019-01-21','4',54,50,55,50,'54','62','n'),(244,'ARTURO DIAZ IBAÃ‘EZ','2019-01-21','2',69,50,79,50,'69','62','n'),(245,'ARTURO DIAZ IBAÃ‘EZ','2019-01-21','3',88,50,74,50,'88','62','n'),(246,'ARTURO DIAZ IBAÃ‘EZ','2019-01-21','6',72,100,0,0,'72','62','n'),(247,'ARTURO DIAZ IBAÃ‘EZ','2019-01-22','1',87,50,90,50,'87','62','n'),(248,'ARTURO DIAZ IBAÃ‘EZ','2019-01-22','4',54,50,55,50,'54','62','n'),(249,'ARTURO DIAZ IBAÃ‘EZ','2019-01-22','2',69,50,79,50,'69','62','n'),(250,'ARTURO DIAZ IBAÃ‘EZ','2019-01-22','6',72,50,74,50,'72','62','n'),(251,'ARTURO DIAZ IBAÃ‘EZ','2019-01-23','1',87,50,90,50,'87','62','n'),(252,'ARTURO DIAZ IBAÃ‘EZ','2019-01-23','2',69,50,79,50,'62','','n'),(253,'ARTURO DIAZ IBAÃ‘EZ','2019-01-23','3',88,50,74,50,'88','62','n'),(254,'ARTURO DIAZ IBAÃ‘EZ','2019-01-23','4',54,50,55,50,'54','62','n'),(255,'ARTURO DIAZ IBAÃ‘EZ','2019-01-23','6',72,50,95,50,'72','62','n'),(256,'ARTURO DIAZ IBAÃ‘EZ','2019-01-24','1',87,50,90,50,'87','62','n'),(257,'ARTURO DIAZ IBAÃ‘EZ','2019-01-24','2',69,50,79,50,'69','62','n'),(258,'ARTURO DIAZ IBAÃ‘EZ','2019-01-24','3',88,100,74,0,'88','62','n'),(259,'ARTURO DIAZ IBAÃ‘EZ','2019-01-24','4',54,50,55,50,'54','62','n'),(260,'ARTURO DIAZ IBAÃ‘EZ','2019-01-24','6',74,50,95,50,'74','62','n'),(261,'ARTURO DIAZ IBAÃ‘EZ','2019-01-25','1',87,50,90,50,'87','62','n'),(262,'ARTURO DIAZ IBAÃ‘EZ','2019-01-25','2',69,50,79,50,'69','62','n'),(263,'ARTURO DIAZ IBAÃ‘EZ','2019-01-25','3',88,50,74,50,'88','62','n'),(264,'ARTURO DIAZ IBAÃ‘EZ','2019-01-25','4',54,50,55,50,'54','62','n'),(265,'ARTURO DIAZ IBAÃ‘EZ','2019-01-25','6',72,50,95,50,'72','62','n'),(267,'ARTURO DIAZ IBAÃ‘EZ','2019-01-26','1',87,50,90,50,'87','62','n'),(268,'ARTURO DIAZ IBAÃ‘EZ','2019-01-26','3',88,50,74,50,'88','62','n'),(269,'ARTURO DIAZ IBAÃ‘EZ','2019-01-26','4',54,50,55,50,'54','62','n'),(270,'ARTURO DIAZ IBAÃ‘EZ','2019-01-26','3',72,50,95,50,'72','62','n'),(272,'SEÃ‘ORA ROSA','2019-01-28','4',54,50,55,50,'54','62','n'),(273,'SEÃ‘ORA ROSA','2019-01-28','1',87,50,90,50,'87','62','n'),(274,'SEÃ‘ORA ROSA','2019-01-28','3',88,50,74,50,'88','62','n'),(275,'ARTURO DIAZ IBAÃ‘EZ','2019-01-29','2',69,50,79,50,'69','62','n'),(276,'ARTURO DIAZ IBAÃ‘EZ','2019-01-29','3',88,50,74,50,'88','62','n'),(277,'ARTURO DIAZ IBAÃ‘EZ','2019-01-29','1',87,100,90,0,'87','62','n'),(278,'ARTURO DIAZ IBAÃ‘EZ','2019-01-30','1',87,50,90,50,'87','62','n'),(279,'ARTURO DIAZ IBAÃ‘EZ','2019-01-30','2',69,50,79,50,'69','62','n'),(280,'ARTURO DIAZ IBAÃ‘EZ','2019-01-30','3',88,50,74,50,'88','62','n'),(281,'ARTURO DIAZ IBAÃ‘EZ','2019-01-30','4',55,100,54,0,'55','62','n'),(282,'ARTURO DIAZ IBAÃ‘EZ','2019-01-31','1',87,50,90,50,'62','','n'),(283,'ARTURO DIAZ IBAÃ‘EZ','2019-01-31','3',88,50,74,50,'88','62','n'),(284,'ARTURO DIAZ IBAÃ‘EZ','2019-01-31','2',69,50,79,50,'69','62','n'),(286,'ARTURO DIAZ IBAÃ‘EZ','2019-01-31','4',54,50,55,50,'54','62','n'),(287,'ARTURO DIAZ IBAÃ‘EZ','2019-02-01','1',87,50,90,50,'87','90','n'),(288,'ARTURO DIAZ IBAÃ‘EZ','2019-01-01','4',54,50,55,50,'54','62','n'),(289,'ARTURO DIAZ IBAÃ‘EZ','2019-02-01','2',69,50,79,50,'69','62','n'),(290,'ARTURO DIAZ IBAÃ‘EZ','2019-02-01','3',88,50,74,50,'88','62','n'),(291,'ARTURO DIAZ IBAÃ‘EZ','2019-02-02','1',87,50,90,50,'87','62','n'),(292,'ARTURO DIAZ IBAÃ‘EZ','2019-02-02','2',69,50,79,50,'69','62','n'),(293,'ARTURO DIAZ IBAÃ‘EZ','2019-02-02','3',88,50,74,50,'88','62','n'),(294,'ARTURO DIAZ IBAÃ‘EZ','2019-02-02','4',54,50,55,50,'54','62','n'),(295,'ARTURO DIAZ IBAÃ‘EZ','2019-02-04','1',87,50,90,50,'87','62','n'),(296,'ARTURO DIAZ IBAÃ‘EZ','2019-02-04','2',69,50,79,50,'69','62','n'),(297,'ARTURO DIAZ IBAÃ‘EZ','2019-02-04','3',88,50,74,50,'88','62','n'),(298,'ARTURO DIAZ IBAÃ‘EZ','2019-02-05','1',87,50,90,50,'87','62','n'),(299,'ARTURO DIAZ IBAÃ‘EZ','2019-03-05','2',69,50,79,50,'69','62','n'),(300,'ARTURO DIAZ IBAÃ‘EZ','2019-02-05','3',88,50,74,50,'88','62','n'),(301,'ARTURO DIAZ IBAÃ‘EZ','2019-02-05','4',72,50,56,50,'72','62','n'),(302,'ARTURO DIAZ IBAÃ‘EZ','2019-02-05','3',54,50,55,50,'54','62','n'),(303,'ARTURO DIAZ IBAÃ‘EZ','2019-02-06','1',87,50,90,50,'87','62','n'),(304,'ARTURO DIAZ IBAÃ‘EZ','2019-02-06','3',88,50,74,50,'88','62','n'),(305,'ARTURO DIAZ IBAÃ‘EZ','2019-02-06','4',72,50,56,50,'72','62','n'),(306,'ARTURO DIAZ IBAÃ‘EZ','2019-02-06','4',54,50,55,50,'54','62','n'),(307,'ARTURO DIAZ IBAÃ‘EZ','2019-02-07','1',87,50,90,50,'87','62','n'),(308,'ARTURO DIAZ IBAÃ‘EZ','2019-02-07','2',69,50,79,50,'69','62','n'),(309,'ARTURO DIAZ IBAÃ‘EZ','2019-02-07','3',88,50,74,50,'88','62','n'),(310,'ARTURO DIAZ IBAÃ‘EZ','2019-02-07','4',72,50,98,50,'72','62','n'),(311,'ARTURO DIAZ IBAÃ‘EZ','2019-02-07','4',54,50,55,50,'54','62','n'),(312,'ARTURO DIAZ IBAÃ‘EZ','2019-02-08','1',87,50,90,50,'87','62','n'),(313,'ARTURO DIAZ IBAÃ‘EZ','2019-02-08','2',69,50,79,50,'69','62','n'),(314,'ARTURO DIAZ IBAÃ‘EZ','2019-02-08','3',88,50,74,50,'88','62','n'),(316,'ARTURO DIAZ IBAÃ‘EZ','2019-02-08','4',72,50,98,50,'72','62','n'),(317,'ARTURO DIAZ IBAÃ‘EZ','2019-02-08','2',54,100,55,0,'54','62','n'),(318,'ARTURO DIAZ IBAÃ‘EZ','2019-02-09','1',87,50,90,50,'87','62','n'),(319,'ARTURO DIAZ IBAÃ‘EZ','2019-02-09','2',69,50,79,50,'69','62','n'),(320,'ARTURO DIAZ IBAÃ‘EZ','2019-02-09','3',88,50,74,50,'88','62','n'),(321,'ARTURO DIAZ IBAÃ‘EZ','2019-02-09','4',72,50,98,50,'72','62','n'),(322,'ARTURO DIAZ IBAÃ‘EZ','2019-02-09','3',54,50,55,50,'54','62','n'),(323,'ARTURO DIAZ IBAÃ‘EZ','2019-02-11','1',87,50,90,50,'87','62','n'),(324,'ARTURO DIAZ IBAÃ‘EZ','2019-02-11','2',69,50,79,50,'69','62','n'),(325,'ARTURO DIAZ IBAÃ‘EZ','2019-02-11','3',88,50,74,50,'88','62','n'),(326,'ARTURO DIAZ IBAÃ‘EZ','2019-02-11','4',72,50,98,50,'72','62','n'),(327,'ARTURO DIAZ IBAÃ‘EZ','2019-02-11','4',54,50,55,50,'54','62','n'),(328,'ARTURO DIAZ IBAÃ‘EZ','2019-02-12','1',87,100,90,0,'87','62','n'),(329,'ARTURO DIAZ IBAÃ‘EZ','2019-02-12','2',79,100,0,0,'79','62','n'),(330,'ARTURO DIAZ IBAÃ‘EZ','2019-02-12','3',88,50,74,50,'88','62','n'),(331,'ARTURO DIAZ IBAÃ‘EZ','2019-02-12','4',72,50,98,50,'72','62','n'),(332,'ARTURO DIAZ IBAÃ‘EZ','2019-02-13','1',87,50,90,50,'87','62','n'),(333,'ARTURO DIAZ IBAÃ‘EZ','2019-02-13','2',79,100,0,0,'79','62','n'),(334,'ARTURO DIAZ IBAÃ‘EZ','2019-02-13','3',88,50,74,50,'88','62','n'),(335,'ARTURO DIAZ IBAÃ‘EZ','2019-02-13','4',72,50,98,50,'72','62','n'),(336,'ARTURO DIAZ IBAÃ‘EZ','2019-02-13','2',54,100,55,0,'54','62','n'),(337,'ARTURO DIAZ IBAÃ‘EZ','2019-02-14','3',54,50,55,50,'54','62','n'),(338,'ARTURO DIAZ IBAÃ‘EZ','2019-02-14','1',87,50,90,50,'87','62','n'),(339,'ARTURO DIAZ IBAÃ‘EZ','2019-02-14','2',79,50,56,50,'79','62','n'),(340,'ARTURO DIAZ IBAÃ‘EZ','2019-02-14','3',88,50,74,50,'88','62','n'),(341,'ARTURO DIAZ IBAÃ‘EZ','2019-02-14','4',72,50,98,50,'72','62','n'),(342,'ARTURO DIAZ IBAÃ‘EZ','2019-02-15','1',87,50,90,50,'87','62','n'),(344,'ARTURO DIAZ IBAÃ‘EZ','2019-02-15','2',79,50,56,50,'79','62','n'),(345,'ARTURO DIAZ IBAÃ‘EZ','2019-02-15','3',88,50,74,50,'88','62','n'),(346,'ARTURO DIAZ IBAÃ‘EZ','2019-02-15','4',72,50,98,50,'72','62','n'),(347,'ARTURO DIAZ IBAÃ‘EZ','2019-02-15','3',54,50,55,50,'54','62','n'),(348,'ARTURO DIAZ IBAÃ‘EZ','2019-02-16','1',87,50,90,50,'87','62','n'),(349,'ARTURO DIAZ IBAÃ‘EZ','2019-02-16','3',88,50,74,50,'88','62','n'),(350,'ARTURO DIAZ IBAÃ‘EZ','2019-02-16','4',72,50,98,50,'72','','n'),(351,'ARTURO DIAZ IBAÃ‘EZ','2019-02-16','2',54,50,55,50,'54','62','n'),(352,'ARTURO DIAZ IBAÃ‘EZ','2019-02-18','1',87,50,90,50,'87','62','n'),(353,'ARTURO DIAZ IBAÃ‘EZ','2019-02-18','2',72,50,79,50,'72','62','n'),(354,'ARTURO DIAZ IBAÃ‘EZ','2019-02-18','3',88,50,74,50,'88','62','n'),(355,'ARTURO DIAZ IBAÃ‘EZ','2019-02-18','3',54,50,55,50,'54','62','n'),(356,'ARTURO DIAZ IBAÃ‘EZ','2019-02-19','1',87,50,90,50,'87','62','n'),(357,'ARTURO DIAZ IBAÃ‘EZ','2019-02-19','3',88,50,74,50,'88','62','n'),(358,'ARTURO DIAZ IBAÃ‘EZ','2019-02-19','4',72,50,79,50,'72','62','n'),(359,'ARTURO DIAZ IBAÃ‘EZ','2019-02-19','3',54,50,55,50,'54','62','n'),(360,'ARTURO DIAZ IBAÃ‘EZ','2019-02-20','1',87,50,90,50,'87','62','n'),(361,'ARTURO DIAZ IBAÃ‘EZ','2019-02-20','3',88,50,74,50,'88','62','n'),(362,'ARTURO DIAZ IBAÃ‘EZ','2019-02-20','4',72,50,79,50,'72','62','n'),(363,'ARTURO DIAZ IBAÃ‘EZ','2019-02-21','1',87,50,90,50,'87','62','n'),(364,'ARTURO DIAZ IBAÃ‘EZ','2019-02-21','3',88,50,74,50,'88','62','n'),(365,'ARTURO DIAZ IBAÃ‘EZ','2019-02-21','4',72,50,79,50,'72','62','n'),(366,'ARTURO DIAZ IBAÃ‘EZ','2019-02-21','3',54,50,55,50,'54','62','n'),(367,'ARTURO DIAZ IBAÃ‘EZ','2019-02-22','1',87,50,90,50,'87','62','n'),(368,'ARTURO DIAZ IBAÃ‘EZ','2019-02-22','3',88,50,74,50,'88','62','n'),(369,'ARTURO DIAZ IBAÃ‘EZ','2019-02-22','4',72,50,79,50,'72','62','n'),(370,'ARTURO DIAZ IBAÃ‘EZ','2019-02-22','3',54,50,55,50,'54','62','n'),(371,'ARTURO DIAZ IBAÃ‘EZ','2019-02-23','1',87,50,90,50,'87','62','n'),(372,'ARTURO DIAZ IBAÃ‘EZ','2019-02-23','3',88,50,74,50,'88','62','n'),(373,'ARTURO DIAZ IBAÃ‘EZ','2019-02-23','4',72,50,79,50,'72','62','n'),(374,'ARTURO DIAZ IBAÃ‘EZ','2019-02-23','3',54,50,55,50,'54','62','n'),(375,'ARTURO DIAZ IBAÃ‘EZ','2019-02-25','1',87,50,90,50,'87','62','n'),(376,'ARTURO DIAZ IBAÃ‘EZ','2019-02-25','3',88,50,74,50,'88','62','n'),(377,'ARTURO DIAZ IBAÃ‘EZ','2019-02-25','4',72,50,79,50,'72','62','n'),(378,'ARTURO DIAZ IBAÃ‘EZ','2019-02-25','3',54,50,55,50,'54','62','n'),(379,'ARTURO DIAZ IBAÃ‘EZ','2019-02-26','1',87,50,90,50,'87','62','n'),(380,'ARTURO DIAZ IBAÃ‘EZ','2019-02-26','4',72,50,79,50,'72','62','n');
/*!40000 ALTER TABLE `repoProd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tablas`
--

DROP TABLE IF EXISTS `tablas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tablas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `especie` char(20) DEFAULT NULL,
  `descrip` char(50) NOT NULL,
  `grueso` decimal(9,4) NOT NULL,
  `ugrueso` char(1) NOT NULL DEFAULT 'i',
  `ancho` decimal(9,4) NOT NULL,
  `uancho` char(1) NOT NULL DEFAULT 'i',
  `largo` decimal(9,4) NOT NULL,
  `ulargo` char(1) NOT NULL DEFAULT 'i',
  `volpt` decimal(9,4) NOT NULL,
  `existen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `descrip` (`descrip`),
  KEY `especie` (`especie`,`descrip`),
  KEY `especie_2` (`especie`,`grueso`)
) ENGINE=InnoDB AUTO_INCREMENT=306 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tablas`
--

LOCK TABLES `tablas` WRITE;
/*!40000 ALTER TABLE `tablas` DISABLE KEYS */;
INSERT INTO `tablas` VALUES (176,'CEDRO BLANCO','1/2x3x105',0.5000,'I',3.0000,'I',105.0000,'C',0.4306,0),(177,'CEDRO BLANCO','1/2x3x115',0.5000,'I',3.0000,'I',115.0000,'C',0.4716,0),(178,'CEDRO BLANCO','1/2x3x125',0.5000,'I',3.0000,'I',125.0000,'C',0.5126,0),(179,'CEDRO BLANCO','1/2x3 1/2x105',0.5000,'I',3.5000,'I',105.0000,'C',0.5024,0),(180,'CEDRO BLANCO','1/2x3 1/2x115',0.5000,'I',3.5000,'I',115.0000,'C',0.5502,0),(181,'CEDRO BLANCO','1/2x4x105',0.5000,'I',4.0000,'I',105.0000,'C',0.5741,0),(182,'CEDRO BLANCO','1/2x4x115',0.5000,'I',4.0000,'I',115.0000,'C',0.6288,0),(183,'CEDRO BLANCO','1 1/2x3 1/2x105',1.5000,'I',3.5000,'I',105.0000,'C',1.5071,0),(184,'CEDRO BLANCO','1 1/2x3 1/2x125',1.5000,'I',3.5000,'I',125.0000,'C',1.7942,0),(185,'CEDRO BLANCO','1 1/4x3 1/2x105',1.2500,'I',3.5000,'I',105.0000,'C',1.2559,0),(186,'CEDRO BLANCO','1 1/4x3 1/2x115',1.2500,'I',3.5000,'I',115.0000,'C',1.3756,0),(187,'CEDRO BLANCO','1 1/4x3 1/2x125',1.2500,'I',3.5000,'I',125.0000,'C',1.4952,0),(188,'CEDRO BLANCO','5/8x3 1/2x105',0.6250,'I',3.5000,'I',105.0000,'C',0.6280,0),(189,'CEDRO BLANCO','5/8x3 1/2x125',0.6250,'I',3.5000,'I',125.0000,'C',0.7476,0),(190,'CEDRO BLANCO','5/8x3 1/2x115',0.6250,'I',3.5000,'I',115.0000,'C',0.6878,0),(191,'CEDRO BLANCO','5/8x3x105',0.6250,'I',3.0000,'I',105.0000,'C',0.5383,0),(192,'CEDRO BLANCO','5/8x3x115',0.6250,'I',3.0000,'I',115.0000,'C',0.5895,0),(193,'CEDRO BLANCO','5/8x3x125',0.6250,'I',3.0000,'I',125.0000,'C',0.6408,0),(194,'CEDRO BLANCO','5/8x4x105',0.6250,'I',4.0000,'I',105.0000,'C',0.7177,0),(195,'CEDRO BLANCO','5/8x4x115',0.6250,'I',4.0000,'I',115.0000,'C',0.7860,0),(196,'CEDRO BLANCO','5/8x5x105',0.6250,'I',5.0000,'I',105.0000,'C',0.8971,0),(197,'CEDRO BLANCO','3/4x3x105',0.7500,'I',3.0000,'I',105.0000,'C',0.6459,0),(198,'CEDRO BLANCO','3/4x3x115',0.7500,'I',3.0000,'I',115.0000,'C',0.7074,0),(199,'CEDRO BLANCO','3/4x3x125',0.7500,'I',3.0000,'I',125.0000,'C',0.7689,0),(200,'CEDRO BLANCO','3/4x3 1/2x105',0.7500,'I',3.5000,'I',105.0000,'C',0.7536,0),(201,'CEDRO BLANCO','3/4x4x115',0.7500,'I',4.0000,'I',115.0000,'C',0.9432,0),(202,'CEDRO BLANCO','3/4x5x105',0.7500,'I',5.0000,'I',105.0000,'C',1.0765,0),(203,'CEDRO BLANCO','3/4x5x125',0.7500,'I',5.0000,'I',125.0000,'C',1.2816,0),(204,'CEDRO BLANCO','3 1/2x5x6 1/2',3.5000,'I',5.0000,'I',6.5000,'I',0.7899,0),(205,'CEDRO BLANCO','3 1/2x3 1/2x3 1/2',3.5000,'I',3.5000,'I',3.5000,'I',0.2977,0),(206,'CEDRO BLANCO','3 1/2x3 1/2x5',3.5000,'I',3.5000,'I',5.0000,'I',0.4253,0),(208,'CEDRO BLANCO','3/4x3 1/2x115',0.7500,'I',3.5000,'I',115.0000,'C',0.8253,0),(209,'CEDRO BLANCO','3/4x3 1/2x125',0.7500,'I',3.5000,'I',125.0000,'C',0.8971,0),(210,'PINO','1/2x3x125',0.5000,'I',3.0000,'I',125.0000,'C',0.5126,0),(211,'PINO','1/2x3 1/2x105',0.5000,'I',3.5000,'I',105.0000,'C',0.5024,0),(212,'PINO','1/2x4x105',0.5000,'I',4.0000,'I',105.0000,'C',0.5741,0),(213,'PINO','1 1/4x3 1/2x105',1.2500,'I',3.5000,'I',105.0000,'C',1.2559,0),(214,'PINO','1 1/4x3 1/2x125',1.2500,'I',3.5000,'I',125.0000,'C',1.4952,0),(215,'PINO','5/8x3x115',0.6250,'I',3.0000,'I',115.0000,'C',0.5895,0),(216,'PINO','5/8x3x125',0.6250,'I',3.0000,'I',125.0000,'C',0.6408,0),(217,'PINO','5/8x3 1/2x115',0.6250,'I',3.5000,'I',115.0000,'C',0.6878,0),(218,'PINO','5/8x4x115',0.6250,'I',4.0000,'I',115.0000,'C',0.7860,0),(219,'PINO','5/8x4x125',0.6250,'I',4.0000,'I',125.0000,'C',0.8544,0),(220,'PINO','3/4x3 1/2x105',0.7500,'I',3.5000,'I',105.0000,'C',0.7536,0),(221,'PINO','3/4x3 1/2x125',0.7500,'I',3.5000,'I',125.0000,'C',0.8971,0),(222,'PINO','3 1/2x3 1/2x5',3.5000,'I',3.5000,'I',5.0000,'I',0.4253,0),(223,'PINO','3 1/2x3 1/2x3 1/2',3.5000,'I',3.5000,'I',3.5000,'I',0.2977,0),(224,'CEDRO BLANCO','1/2x5x42 1/2',0.5000,'I',5.0000,'I',42.5000,'I',0.7378,0),(225,'CEDRO BLANCO','1/2x3x42 1/2',0.5000,'I',3.0000,'I',42.5000,'I',0.4427,0),(226,'CEDRO BLANCO','5/8x5x38',0.6250,'I',5.0000,'I',38.0000,'I',0.8247,0),(227,'CEDRO BLANCO','5/8x3x38',0.6250,'I',3.0000,'I',38.0000,'I',0.4948,0),(228,'CEDRO BLANCO','3/4x4x43 1/4',0.7500,'I',4.0000,'I',43.2500,'I',0.9010,0),(229,'CEDRO BLANCO','1 1/4x3 1/2x43 1/4',1.2500,'I',3.5000,'I',43.2500,'I',1.3140,0),(230,'CEDRO BLANCO','5/8x4x44',0.6250,'I',4.0000,'I',44.0000,'I',0.7639,0),(231,'CEDRO BLANCO','5/8x3x44',0.6250,'I',3.0000,'I',44.0000,'I',0.5729,0),(232,'CEDRO BLANCO','1 1/4x3 1/2x46',1.2500,'I',3.5000,'I',46.0000,'I',1.3976,0),(233,'CEDRO BLANCO','5/8x3.5x44',0.6250,'I',3.5000,'C',44.0000,'I',0.2632,0),(235,'CEDRO BLANCO','3/4x3 1/2x40',0.7500,'I',3.5000,'I',40.0000,'I',0.7292,0),(236,'CEDRO BLANCO','3/4x3 1/2x48',0.7500,'I',3.5000,'I',48.0000,'I',0.8750,0),(237,'CEDRO BLANCO','3/4x3 1/2x41',0.7500,'I',3.5000,'I',41.0000,'I',0.7474,0),(238,'CEDRO BLANCO','3/4x5x40',0.7500,'I',5.0000,'I',40.0000,'I',1.0417,0),(239,'CEDRO BLANCO','3/4x3 1/2x38',0.7500,'I',3.5000,'I',38.0000,'I',0.6927,0),(240,'CEDRO BLANCO','1 1/2x3 1/2x31',1.5000,'I',3.5000,'I',31.0000,'I',1.1302,0),(241,'CEDRO BLANCO','1 1/2x3 1/2x34',1.5000,'I',3.5000,'I',34.0000,'I',1.2396,0),(242,'CEDRO BLANCO','3/4x3 1/2x31',0.7500,'I',3.5000,'I',31.0000,'I',0.5651,0),(243,'CEDRO BLANCO','5/8x4x36',0.6250,'I',4.0000,'I',36.0000,'I',0.6250,0),(244,'PINO','1 1/4x3 1/2x36',1.2500,'I',3.5000,'I',36.0000,'I',1.0938,0),(245,'CEDRO BLANCO','1 1/4x3 1/2x48',1.2500,'I',3.5000,'I',48.0000,'I',1.4583,0),(246,'CEDRO BLANCO','5/8x4x43 1/4',0.6250,'I',4.0000,'I',43.2500,'I',0.7509,0),(247,'CEDRO BLANCO','1 1/4x3 1/2x38 1/2',1.2500,'I',3.5000,'I',38.5000,'I',1.1697,0),(248,'CEDRO BLANCO','1 1/4x3 1/2x38',1.2500,'I',3.5000,'I',38.0000,'I',1.1545,0),(249,'CEDRO BLANCO','1 1/4x3 1/2x36',1.2500,'I',3.5000,'I',36.0000,'I',1.0938,0),(250,'CEDRO BLANCO','1/2x4x38',0.5000,'I',4.0000,'I',38.0000,'I',0.5278,0),(251,'CEDRO BLANCO','1/2x3 1/2x38',0.5000,'I',3.5000,'I',38.0000,'I',0.4618,0),(252,'CEDRO BLANCO','1 1/4x3 1/2x31',1.2500,'I',3.5000,'I',31.0000,'I',0.9418,0),(253,'CEDRO BLANCO','1 1/4x3 1/2x34',1.2500,'I',3.5000,'I',34.0000,'I',1.0330,0),(254,'CEDRO BLANCO','5/8x3 1/2x44',0.6250,'I',3.5000,'I',44.0000,'I',0.6684,0),(255,'CEDRO BLANCO','3/4x3x40',0.7500,'I',3.0000,'I',40.0000,'I',0.6250,0),(256,'CEDRO BLANCO','3 1/2x3 1/2x6 1/2',3.5000,'I',3.5000,'I',6.5000,'I',0.5530,0),(257,'PINO','3/4x3 1/2x48',0.7500,'I',3.5000,'I',48.0000,'I',0.8750,0),(258,'PINO','1 1/4x3 1/2x48',1.2500,'I',3.5000,'I',48.0000,'I',1.4583,0),(259,'PINO','5/8x4x36',0.6250,'I',4.0000,'I',36.0000,'I',0.6250,0),(260,'PINO','3/4x3 1/2x40',0.7500,'I',3.5000,'I',40.0000,'I',0.7292,0),(261,'PINO','3/4x3 1/2x41',0.7500,'I',3.5000,'I',41.0000,'I',0.7474,0),(262,'CEDRO BLANCO','5/8x4x125',0.6250,'I',4.0000,'I',125.0000,'C',0.8544,0),(263,'PINO','1 1/2x3 1/2x34',1.5000,'I',3.5000,'I',34.0000,'I',1.2396,0),(264,'PINO','1 1/2x3 1/2x31',1.5000,'I',3.5000,'I',31.0000,'I',1.1302,0),(265,'PINO','3/4x3 1/2x31',0.7500,'I',3.5000,'I',31.0000,'I',0.5651,0),(266,'PINO','3/4x3 1/2x38',0.7500,'I',3.5000,'I',38.0000,'I',0.6927,0),(267,'CEDRO BLANCO','1/2x5x115',0.5000,'I',5.0000,'I',115.0000,'C',0.7860,0),(268,'PINO','5/8x4x43 1/4',0.6250,'I',4.0000,'I',43.2500,'I',0.7509,0),(269,'PINO','3/4x3x40',0.7500,'I',3.0000,'I',40.0000,'I',0.6250,0),(270,'PINO','1/2x3x42 1/2',0.5000,'I',3.0000,'I',42.5000,'I',0.4427,0),(271,'PINO','1 1/4x3 1/2x38',1.2500,'I',3.5000,'I',38.0000,'I',1.1545,0),(272,'PINO','1/2x4x38',0.5000,'I',4.0000,'I',38.0000,'I',0.5278,0),(273,'PINO','1/2x3 1/2x38',0.5000,'I',3.5000,'I',38.0000,'I',0.4618,0),(274,'PINO','3/4x5x40',0.7500,'I',5.0000,'I',40.0000,'I',1.0417,0),(275,'PINO','5/8x4x44',0.6250,'I',4.0000,'I',44.0000,'I',0.7639,0),(276,'PINO','1 1/2x3 1/2x125',1.5000,'I',3.5000,'I',125.0000,'C',1.7942,0),(277,'PINO','3/4x5x125',0.7500,'I',5.0000,'I',125.0000,'C',1.2816,0),(278,'PINO','3/4x3x125',0.7500,'I',3.0000,'I',125.0000,'C',0.7689,0),(279,'PINO','1 1/4x3 1/2x115',1.2500,'I',3.5000,'I',115.0000,'C',1.3756,0),(280,'PINO','1/2x3 1/2x115',0.5000,'I',3.5000,'I',115.0000,'C',0.5502,0),(281,'PINO','1 1/4x3 1/2x38 1/2',1.2500,'I',3.5000,'I',38.5000,'I',1.1697,0),(282,'PINO','3/4x3x105',0.7500,'I',3.0000,'I',105.0000,'C',0.6459,0),(283,'PINO','3/4x4x125',0.7500,'I',4.0000,'I',125.0000,'C',1.0253,0),(284,'PINO','3/4x4x115',0.7500,'I',4.0000,'I',115.0000,'C',0.9432,0),(285,'PINO','5/8x3 1/2x44',0.6250,'I',3.5000,'I',44.0000,'I',0.6684,0),(286,'PINO','1/2x3x105',0.5000,'I',3.0000,'I',105.0000,'C',0.4306,0),(287,'CEDRO BLANCO','3 1/2x3 1/2x115',3.5000,'I',3.5000,'I',115.0000,'C',3.8516,0),(288,'PINO','3 1/2x3 1/2x6 1/2',3.5000,'I',3.5000,'I',6.5000,'I',0.5530,0),(289,'CEDRO BLANCO','1/2x3 1/2x125',0.5000,'I',3.5000,'I',125.0000,'C',0.5981,0),(290,'PINO','1/2x5x115',0.5000,'I',5.0000,'I',115.0000,'C',0.7860,0),(291,'PINO','1/2x3x115',0.5000,'I',3.0000,'I',115.0000,'C',0.4716,0),(292,'PINO','3/4x3 1/2x120',0.7500,'I',3.5000,'I',120.0000,'C',0.8612,0),(293,'PINO','5/8x3x120',0.6250,'I',3.0000,'I',120.0000,'C',0.6152,0),(294,'PINO','3/4x3 1/2x115',0.7500,'I',3.5000,'I',115.0000,'C',0.8253,0),(295,'PINO','5/8x3x38',0.6250,'I',3.0000,'I',38.0000,'I',0.4948,0),(296,'CEDRO BLANCO','1 1/4x3 1/2x39',1.2500,'I',3.5000,'I',39.0000,'I',1.1849,0),(297,'PINO','5/8x3x105',0.6250,'I',3.0000,'I',105.0000,'C',0.5383,0),(298,'PINO','1 1/4x3 1/2x39',1.2500,'I',3.5000,'I',39.0000,'I',1.1849,0),(299,'CEDRO BLANCO','5/8x3 1/2x31',0.6250,'I',3.5000,'I',31.0000,'I',0.4709,0),(300,'CEDRO BLANCO','1 1/4x3 1/2x42',1.2500,'I',3.5000,'I',42.0000,'I',1.2760,0),(301,'CEDRO BLANCO','5/8x3 1/2x100',0.6250,'I',3.5000,'I',100.0000,'C',0.5981,0),(302,'CEDRO BLANCO','1/2x2 1/2x115',0.5000,'I',2.5000,'I',115.0000,'C',0.3930,0),(303,'PINO','5/8x4x31',0.6250,'I',4.0000,'I',31.0000,'I',0.5382,0),(304,'CEDRO BLANCO','5/8x3 1/2x33',0.6250,'I',3.5000,'I',33.0000,'I',0.5013,0),(305,'CEDRO BLANCO','1/2x2 1/2x105',0.5000,'I',2.5000,'I',105.0000,'C',0.3588,0);
/*!40000 ALTER TABLE `tablas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tablasIO`
--

DROP TABLE IF EXISTS `tablasIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tablasIO` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtabla` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL COMMENT 'positivo o neg, p.e. compras y ventas directas',
  `fecha` date DEFAULT NULL,
  `observaciones` char(50) DEFAULT NULL,
  `aplicadaEnInventario` char(1) DEFAULT 'n',
  PRIMARY KEY (`id`),
  KEY `fecha` (`fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tablasIO`
--

LOCK TABLES `tablasIO` WRITE;
/*!40000 ALTER TABLE `tablasIO` DISABLE KEYS */;
/*!40000 ALTER TABLE `tablasIO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarimas`
--

DROP TABLE IF EXISTS `tarimas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarimas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tarima` char(10) DEFAULT NULL,
  `descripcion` char(50) DEFAULT NULL,
  `editable` char(1) DEFAULT 's' COMMENT 'si !=s ya no se puede editar componentes',
  PRIMARY KEY (`id`),
  KEY `tarima` (`tarima`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarimas`
--

LOCK TABLES `tarimas` WRITE;
/*!40000 ALTER TABLE `tarimas` DISABLE KEYS */;
INSERT INTO `tarimas` VALUES (27,' 0085D','Daltile-38\" x 42.5\"','s'),(29,'0174D','Daltile- 36\" x 48\"','s'),(30,'0141D','Daltile-38.5\" x 43.25\"','s'),(31,'0139D','Daltile- 43.25 x 43.25 CON 3/4','s'),(32,'0043D','Daltile- 38\" x 38\"','s'),(33,'0203D','Daltile- 31\"  X  34\"','s'),(34,'0207D','Daltile- 44\" x 46\"','s'),(35,'0224D','Daltile-44\"x49\"','s'),(36,'COR01','Corona- 40 x 48 Euro','s'),(37,'MAI01','MAINLAND- 40 x 48 CON TAQUETE DE  9 TABLAS','s'),(38,'IEQ','IEQSA  40\" x 48\"','s'),(39,'0141D+','Daltile- 39\" x 44\"','s'),(40,'0236D','Daltile- 31\"  X  42\"','s');
/*!40000 ALTER TABLE `tarimas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventasMA`
--

DROP TABLE IF EXISTS `ventasMA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventasMA` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `cliente` char(80) DEFAULT NULL,
  `observ` char(80) DEFAULT NULL,
  `editable` char(1) DEFAULT 's' COMMENT 'al cambiar a no editable se aplica al inventario',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventasMA`
--

LOCK TABLES `ventasMA` WRITE;
/*!40000 ALTER TABLE `ventasMA` DISABLE KEYS */;
INSERT INTO `ventasMA` VALUES (1,NULL,'','','s');
/*!40000 ALTER TABLE `ventasMA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventasMAmovs`
--

DROP TABLE IF EXISTS `ventasMAmovs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ventasMAmovs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idVentasMA` int(11) NOT NULL,
  `idtabla` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idVentasMA` (`idVentasMA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventasMAmovs`
--

LOCK TABLES `ventasMAmovs` WRITE;
/*!40000 ALTER TABLE `ventasMAmovs` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventasMAmovs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-27 20:12:24
