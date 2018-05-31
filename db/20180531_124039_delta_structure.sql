-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: delta
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu18.04.1

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
  PRIMARY KEY (`clave`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `editable` char(1) DEFAULT 's',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `movsRepoOtrasActiv`
--

DROP TABLE IF EXISTS `movsRepoOtrasActiv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movsRepoOtrasActiv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idRepo` int(11) NOT NULL,
  `actividad` char(10) NOT NULL COMMENT 'clavado, cabecera, horas ...',
  `cantidad` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL COMMENT 'a quien se le paga el destajo',
  PRIMARY KEY (`id`),
  KEY `idRepo` (`idRepo`),
  KEY `idEmpleado` (`idEmpleado`,`idRepo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablas`
--

DROP TABLE IF EXISTS `tablas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tablas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `especie` char(10) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-31 12:40:39
