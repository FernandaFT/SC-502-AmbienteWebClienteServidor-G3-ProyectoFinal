CREATE DATABASE  IF NOT EXISTS `sgh` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `sgh`;
-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sgh
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria_hora`
--

DROP TABLE IF EXISTS `categoria_hora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria_hora` (
  `id_categoria_hora` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id_categoria_hora`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_hora`
--

LOCK TABLES `categoria_hora` WRITE;
/*!40000 ALTER TABLE `categoria_hora` DISABLE KEYS */;
INSERT INTO `categoria_hora` VALUES (1,'Desarrollo','Horas de programación',_binary ''),(2,'Pruebas','Horas de testing',_binary ''),(3,'Documentación','Horas de documentación',_binary '');
/*!40000 ALTER TABLE `categoria_hora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_permiso`
--

DROP TABLE IF EXISTS `categoria_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria_permiso` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_permiso`
--

LOCK TABLES `categoria_permiso` WRITE;
/*!40000 ALTER TABLE `categoria_permiso` DISABLE KEYS */;
INSERT INTO `categoria_permiso` VALUES (1,'Enfermedad/Incapacidad','Permiso por motivos de salud',_binary ''),(2,'Asuntos Personales','Permiso para asuntos familiares o personales',_binary ''),(3,'Maternidad/Paternidad','Permiso por nacimiento o adopción',_binary '');
/*!40000 ALTER TABLE `categoria_permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'ICE','Pruebas',_binary ''),(2,'BMW','Cliente Premium',_binary '');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro_horas`
--

DROP TABLE IF EXISTS `registro_horas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registro_horas` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_categoria_hora` int(11) NOT NULL,
  `clasificacion_hora` enum('Ordinaria','Extra','Doble') NOT NULL DEFAULT 'Ordinaria',
  `cantidad` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_registro`),
  KEY `fk_usuario` (`id_usuario`),
  KEY `fk_cliente` (`id_cliente`),
  KEY `fk_categoria` (`id_categoria_hora`),
  CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria_hora`) REFERENCES `categoria_hora` (`id_categoria_hora`),
  CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_horas`
--

LOCK TABLES `registro_horas` WRITE;
/*!40000 ALTER TABLE `registro_horas` DISABLE KEYS */;
INSERT INTO `registro_horas` VALUES (1,4,1,1,'Ordinaria',8,'CRUD','2026-04-15 00:00:00');
/*!40000 ALTER TABLE `registro_horas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_permiso`
--

DROP TABLE IF EXISTS `solicitud_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitud_permiso` (
  `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `estado` enum('Pendiente','Aprobado','Rechazado') NOT NULL DEFAULT 'Pendiente',
  `id_encargado` int(11) DEFAULT NULL,
  `fecha_solicitud` datetime DEFAULT current_timestamp(),
  `fecha_respuesta` datetime DEFAULT NULL,
  PRIMARY KEY (`id_solicitud`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_encargado` (`id_encargado`),
  KEY `estado` (`estado`),
  KEY `fecha_solicitud` (`fecha_solicitud`),
  CONSTRAINT `solicitud_permiso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `solicitud_permiso_ibfk_2` FOREIGN KEY (`id_encargado`) REFERENCES `usuario` (`id_usuario`) ON DELETE SET NULL,
  CONSTRAINT `solicitud_permiso_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_permiso` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_permiso`
--

LOCK TABLES `solicitud_permiso` WRITE;
/*!40000 ALTER TABLE `solicitud_permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `solicitud_permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_vacaciones`
--

DROP TABLE IF EXISTS `solicitud_vacaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitud_vacaciones` (
  `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_solicita` int(11) NOT NULL,
  `id_encargado` int(11) DEFAULT NULL,
  `dias_solicitados` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `estado` varchar(100) NOT NULL DEFAULT 'Pendiente',
  `fecha_solicitud` datetime DEFAULT current_timestamp(),
  `fecha_respuesta` datetime DEFAULT NULL,
  PRIMARY KEY (`id_solicitud`),
  KEY `id_usuario_solicita` (`id_usuario_solicita`),
  KEY `solicitud_vacaciones_ibfk_2` (`id_encargado`),
  CONSTRAINT `solicitud_vacaciones_ibfk_1` FOREIGN KEY (`id_usuario_solicita`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `solicitud_vacaciones_ibfk_2` FOREIGN KEY (`id_encargado`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_vacaciones`
--

LOCK TABLES `solicitud_vacaciones` WRITE;
/*!40000 ALTER TABLE `solicitud_vacaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `solicitud_vacaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(15) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `contrasenna` varchar(255) NOT NULL,
  `estado` bit(1) NOT NULL,
  `rol` int(11) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `uq_usuario_identificacion` (`identificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'111111111','Administrador','admin@admin.com','123456',_binary '',1,'2026-03-24 00:00:00'),(10,'116700557','FAJARDO TORRES MARIA FERNANDA','nanda199784@gmail.com','123456',_binary '',2,'2026-04-15 22:26:58');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacaciones`
--

DROP TABLE IF EXISTS `vacaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vacaciones` (
  `id_vacacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `dias_acumulados` int(11) DEFAULT 0,
  `dias_usados` int(11) DEFAULT 0,
  `fecha_ultimo_calculo` date DEFAULT NULL,
  PRIMARY KEY (`id_vacacion`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `vacaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacaciones`
--

LOCK TABLES `vacaciones` WRITE;
/*!40000 ALTER TABLE `vacaciones` DISABLE KEYS */;
INSERT INTO `vacaciones` VALUES (4,3,0,0,'2026-04-15'),(5,4,0,0,'2026-04-15'),(7,6,0,0,'2026-04-15'),(8,7,0,0,'2026-04-15'),(9,8,0,0,'2026-04-15'),(12,9,0,0,'2026-04-15'),(13,10,0,0,'2026-04-15');
/*!40000 ALTER TABLE `vacaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'sgh'
--
/*!50003 DROP PROCEDURE IF EXISTS `gh_ObtenerUsuarioPorId` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `gh_ObtenerUsuarioPorId`(
    pId INT
)
BEGIN
    SELECT id_usuario, identificacion, nombre, correo, rol
    FROM usuario
    WHERE id_usuario = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ActualizarCliente` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ActualizarCliente`(
    pId INT,
    pNombre VARCHAR(100),
    pDescripcion VARCHAR (255)
)
BEGIN
	UPDATE cliente
    SET nombre = pNombre,
        descripcion = pDescripcion
    WHERE id_cliente = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ActualizarContrasenna` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ActualizarContrasenna`(
	pNuevaContrasenna varchar(255),
    	pIdUsuario INT
)
BEGIN
	UPDATE usuario
    	SET contrasenna = pNuevaContrasenna
    	WHERE id_usuario = pIdUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ActualizarEstadoPermiso` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ActualizarEstadoPermiso`(
    pIdSolicitud INT,
    pEstado VARCHAR(20),
    pIdEncargado INT,
    pMotivoRechazo VARCHAR(500),
    pObservaciones VARCHAR(500)
)
BEGIN
    UPDATE solicitud_permiso
    SET estado = pEstado,
        id_encargado = pIdEncargado,
        fecha_respuesta = NOW(),
        motivo_rechazo = pMotivoRechazo,
        observaciones = pObservaciones
    WHERE id_solicitud = pIdSolicitud;
    
    SELECT 1 AS resultado, 'Estado actualizado correctamente' AS mensaje;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ActualizarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ActualizarUsuario`(
    pId INT,
    pIdentificacion VARCHAR(15),
    pNombre VARCHAR(200),
    pRol INT
)
BEGIN
    UPDATE usuario
    SET identificacion = pIdentificacion,
        nombre = pNombre,
        rol = pRol
    WHERE id_usuario = pId;

    SELECT 1 AS resultado, 'Usuario actualizado correctamente' AS mensaje;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ActualizarVacaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ActualizarVacaciones`(pIdUsuario INT)
BEGIN
	UPDATE vacaciones 
	SET dias_acumulados = TIMESTAMPDIFF(MONTH, fecha_ultimo_calculo, CURDATE())
	WHERE id_usuario =pIdUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_AprobarSolicitudPermiso` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_AprobarSolicitudPermiso`(
    pId INT
)
BEGIN
	UPDATE solicitud_permiso 
	SET estado = 'Aprobado'
	WHERE id_solicitud = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_AprobarSolicitudVacaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_AprobarSolicitudVacaciones`(
    pId INT
)
BEGIN
	UPDATE solicitud_vacaciones 
    SET estado = 'Aprobado'
    WHERE id_solicitud = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_CambiarEstadoCliente` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_CambiarEstadoCliente`(
  pId INT,
  pEstado BIT
)
BEGIN
  UPDATE cliente
  SET activo = IF(pEstado = 1, b'1', b'0')
  WHERE id_cliente = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_CambiarEstadoUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_CambiarEstadoUsuario`(
  pId INT,
  pEstado BIT
)
BEGIN
  UPDATE usuario
  SET estado = IF(pEstado = 1, b'1', b'0')
  WHERE id_usuario = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_consultarVacaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_consultarVacaciones`(pIdUsuario INT)
BEGIN
SELECT 
	(dias_acumulados - dias_usados) AS vacaciones
	FROM vacaciones
	WHERE id_usuario = pIdUsuario;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_CrearSolicitudPermiso` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_CrearSolicitudPermiso`(
    pIdUsuario INT,
    pFechaInicio DATE,
    pFechaFin DATE,
    pDescripcion VARCHAR(500),
    pIdCategoria INT
)
BEGIN
    INSERT INTO solicitud_permiso (id_usuario, fecha_inicio, fecha_fin, descripcion, id_categoria, estado)
    VALUES (pIdUsuario, pFechaInicio, pFechaFin, pDescripcion, pIdCategoria, 'Pendiente');
    
    SELECT 1 AS resultado, 'Solicitud de permiso registrada correctamente' AS mensaje;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_detalleSolicitud` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_detalleSolicitud`(
    pIdSolicitud INT, 
    pTipo VARCHAR(10)
)
BEGIN
    IF pTipo = 'Vacaciones' THEN
    
        SELECT 
            sv.id_solicitud,
            sv.fecha_inicio,
            sv.fecha_fin,
            'Vacaciones' AS categoria,
            sv.descripcion,
            sv.estado,
            sv.fecha_solicitud,
            sv.fecha_respuesta,
            u.nombre AS nombre_empleado,
            e.nombre AS nombre_encargado,
            'Vacaciones' AS tipo
        FROM solicitud_vacaciones sv
        INNER JOIN usuario u 
            ON sv.id_usuario_solicita = u.id_usuario
        LEFT JOIN usuario e 
            ON sv.id_encargado = e.id_usuario
        WHERE sv.id_solicitud = pIdSolicitud;
    ELSE
        SELECT 
            sp.id_solicitud,
            sp.fecha_inicio,
            sp.fecha_fin,
            c.nombre AS categoria,
            sp.descripcion,
            sp.estado,
            sp.fecha_solicitud,
            sp.fecha_respuesta,
            u.nombre AS nombre_empleado,
            e.nombre AS nombre_encargado,
            'Permiso' AS tipo
        FROM solicitud_permiso sp
        INNER JOIN usuario u 
            ON sp.id_usuario = u.id_usuario
        LEFT JOIN usuario e 
            ON sp.id_encargado = e.id_usuario
        INNER JOIN categoria_permiso c 
            ON sp.id_categoria = c.id_categoria
        WHERE sp.id_solicitud = pIdSolicitud;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_EditarHoras` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_EditarHoras`(
    IN p_idRegistro INT,
    IN p_idCliente INT,
    IN p_idCategoriaHora INT,
    IN p_clasificacionHora VARCHAR(20),
    IN p_cantidad INT,
    IN p_descripcion VARCHAR(255),
    IN p_fecha DATE
)
BEGIN
    UPDATE registro_horas
    SET id_cliente = p_idCliente,
        id_categoria_hora = p_idCategoriaHora,
        clasificacion_hora = p_clasificacionHora,
        cantidad = p_cantidad,
        descripcion = p_descripcion,
        fecha = p_fecha
    WHERE id_registro = p_idRegistro;

    SELECT 1 AS resultado, 'Horas actualizadas correctamente' AS mensaje;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_InactivarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_InactivarUsuario`(
	pId INT
)
BEGIN
	UPDATE usuario
    SET estado = 0
    WHERE id_usuario =pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_InicioSesion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_InicioSesion`(pCorreo varchar(255), pPassword varchar(255))
BEGIN
	Select * from usuario where correo=pCorreo and contrasenna=pPassword;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ListarCategoriasPermisos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ListarCategoriasPermisos`()
BEGIN
    SELECT id_categoria, nombre, descripcion
    FROM categoria_permiso
    WHERE estado = b'1'
    ORDER BY nombre;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ListarClientes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ListarClientes`(
	pInicio INT,
    pCantidad INT
)
BEGIN
	SELECT id_cliente, nombre,descripcion, activo
    FROM cliente
    ORDER BY id_cliente DESC
    LIMIT pInicio, pCantidad;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ListarHorasPorUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ListarHorasPorUsuario`(
    IN p_idUsuario INT,
    IN p_inicio INT,
    IN p_registrosPorPagina INT
)
BEGIN
    SELECT rh.id_registro,
           c.nombre AS cliente,
           cat.nombre AS categoria,
           rh.clasificacion_hora,
           rh.cantidad,
           rh.descripcion,
           rh.fecha
    FROM registro_horas rh
    INNER JOIN cliente c ON rh.id_cliente = c.id_cliente
    INNER JOIN categoria_hora cat ON rh.id_categoria_hora = cat.id_categoria_hora
    WHERE rh.id_usuario = p_idUsuario
    ORDER BY rh.fecha DESC
    LIMIT p_inicio, p_registrosPorPagina;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ListarUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ListarUsuarios`(
	pInicio INT,
    pCantidad INT
)
BEGIN
    SELECT id_usuario, identificacion, nombre, correo, rol, estado, fecha_registro
    FROM usuario
    ORDER BY id_usuario DESC
    LIMIT pInicio, pCantidad;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ObtenerAccionesPersonal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ObtenerAccionesPersonal`(pIdUsuario INT)
BEGIN
	SELECT 
    sp.id_solicitud,
    sp.fecha_inicio,
    sp.fecha_fin,
    c.nombre AS categoria,
    sp.descripcion,
    sp.estado,
    sp.fecha_solicitud,
    'Permiso' AS tipo
FROM solicitud_permiso sp
INNER JOIN categoria_permiso c 
    ON sp.id_categoria = c.id_categoria
WHERE sp.id_usuario = pIdUsuario

UNION ALL

SELECT 
    sv.id_solicitud,
    sv.fecha_inicio,
    sv.fecha_fin,
    'Vacaciones' AS categoria,
    sv.descripcion,
    sv.estado,
    sv.fecha_solicitud,
    'Vacaciones' AS tipo
FROM solicitud_vacaciones sv
WHERE sv.id_usuario_solicita = pIdUsuario
ORDER BY fecha_solicitud DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ObtenerClientePorId` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ObtenerClientePorId`(
    pId INT
)
BEGIN
	SELECT id_cliente, nombre, descripcion
    FROM cliente
    WHERE id_cliente = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ObtenerDatosDashboard` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ObtenerDatosDashboard`(
     IN p_id_usuario INT,
    IN p_rol INT
)
BEGIN
    DECLARE v_horas_totales INT DEFAULT 0;
    DECLARE v_vacaciones_disponibles INT DEFAULT 0;
    DECLARE v_pendientes_usuario INT DEFAULT 0;
    DECLARE v_pendientes_admin INT DEFAULT 0;
    DECLARE v_total_usuarios INT DEFAULT 0;
    DECLARE v_clientes_activos INT DEFAULT 0;
    DECLARE v_aprobadas INT DEFAULT 0;
    DECLARE v_rechazadas INT DEFAULT 0;

    DECLARE v_cliente VARCHAR(200) DEFAULT 'Sin registros';
    DECLARE v_categoria VARCHAR(100) DEFAULT 'Sin categoría';
    DECLARE v_cantidad INT DEFAULT 0;
    DECLARE v_fecha DATETIME DEFAULT NULL;

    SELECT IFNULL(SUM(rh.cantidad), 0)
    INTO v_horas_totales
    FROM registro_horas rh
    WHERE rh.id_usuario = p_id_usuario;

    SELECT IFNULL(MAX(v.dias_acumulados - v.dias_usados), 0)
    INTO v_vacaciones_disponibles
    FROM vacaciones v
    WHERE v.id_usuario = p_id_usuario;

    SELECT COUNT(*)
    INTO v_pendientes_usuario
    FROM solicitud_permiso sp
    WHERE sp.id_usuario = p_id_usuario
      AND sp.estado = 'Pendiente';

    SELECT v_pendientes_usuario + COUNT(*)
    INTO v_pendientes_usuario
    FROM solicitud_vacaciones sv
    WHERE sv.id_usuario_solicita = p_id_usuario
      AND sv.estado = 'Pendiente';

    SELECT COUNT(*)
    INTO v_pendientes_admin
    FROM solicitud_permiso
    WHERE estado = 'Pendiente';

    SELECT v_pendientes_admin + COUNT(*)
    INTO v_pendientes_admin
    FROM solicitud_vacaciones
    WHERE estado = 'Pendiente';

    IF p_rol = 1 THEN

        SELECT COUNT(*)
        INTO v_total_usuarios
        FROM usuario
        WHERE estado = b'1';

        SELECT COUNT(*)
        INTO v_clientes_activos
        FROM cliente
        WHERE activo = b'1';

        SELECT COUNT(*)
        INTO v_aprobadas
        FROM solicitud_permiso
        WHERE estado = 'Aprobado';

        SELECT v_aprobadas + COUNT(*)
        INTO v_aprobadas
        FROM solicitud_vacaciones
        WHERE estado = 'Aprobado';

        SELECT COUNT(*)
        INTO v_rechazadas
        FROM solicitud_permiso
        WHERE estado = 'Rechazado';

        SELECT v_rechazadas + COUNT(*)
        INTO v_rechazadas
        FROM solicitud_vacaciones
        WHERE estado = 'Rechazado';

    END IF;

    SELECT
        c.nombre,
        ch.nombre,
        rh.cantidad,
        rh.fecha
    INTO
        v_cliente,
        v_categoria,
        v_cantidad,
        v_fecha
    FROM registro_horas rh
    LEFT JOIN cliente c
        ON rh.id_cliente = c.id_cliente
    LEFT JOIN categoria_hora ch
        ON rh.id_categoria_hora = ch.id_categoria_hora
    WHERE rh.id_usuario = p_id_usuario
    ORDER BY rh.fecha DESC, rh.id_registro DESC
    LIMIT 1;

    SELECT
        v_horas_totales AS horas_totales,
        v_vacaciones_disponibles AS vacaciones,
        v_pendientes_usuario AS pendientes_usuario,
        v_pendientes_admin AS pendientes_admin,
        v_total_usuarios AS total_usuarios,
        v_clientes_activos AS clientes_activos,
        v_aprobadas AS solicitudes_aprobadas,
        v_rechazadas AS solicitudes_rechazadas,
        v_cliente AS cliente,
        v_categoria AS categoria,
        v_cantidad AS cantidad,
        IFNULL(DATE_FORMAT(v_fecha, '%d/%m/%Y'), 'Sin fecha') AS fecha;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ObtenerDetalleSolicitud` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ObtenerDetalleSolicitud`(
    pIdSolicitud INT
)
BEGIN
    SELECT sp.id_solicitud, sp.id_usuario, u.nombre AS nombre_empleado, sp.fecha_inicio, 
           sp.fecha_fin, sp.descripcion, cp.nombre AS categoria, sp.estado, sp.fecha_solicitud,
           sp.fecha_respuesta, sp.motivo_rechazo, sp.observaciones, 
           e.nombre AS nombre_encargado
    FROM solicitud_permiso sp
    INNER JOIN usuario u ON sp.id_usuario = u.id_usuario
    INNER JOIN categoria_permiso cp ON sp.id_categoria = cp.id_categoria
    LEFT JOIN usuario e ON sp.id_encargado = e.id_usuario
    WHERE sp.id_solicitud = pIdSolicitud;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ObtenerHoraPorId` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ObtenerHoraPorId`(IN p_idRegistro INT)
BEGIN
    SELECT rh.id_registro,
           rh.id_cliente,
           rh.id_categoria_hora,
           rh.clasificacion_hora,
           rh.cantidad,
           rh.descripcion,
           rh.fecha
    FROM registro_horas rh
    WHERE rh.id_registro = p_idRegistro;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ObtenerSolicitudesGestionar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ObtenerSolicitudesGestionar`()
BEGIN
SELECT 
    sp.id_solicitud,
    u.nombre AS usuario,
    sp.fecha_inicio,
    sp.fecha_fin,
    c.nombre AS categoria,
    sp.descripcion,
    sp.estado,
    sp.fecha_solicitud,
    'Permiso' AS tipo
FROM solicitud_permiso sp
INNER JOIN categoria_permiso c 
    ON sp.id_categoria = c.id_categoria
INNER JOIN usuario u
    ON sp.id_usuario = u.id_usuario

UNION ALL

SELECT 
    sv.id_solicitud,
    u.nombre AS usuario,
    sv.fecha_inicio,
    sv.fecha_fin,
    'Vacaciones' AS categoria,
    sv.descripcion,
    sv.estado,
    sv.fecha_solicitud,
    'Vacaciones' AS tipo
FROM solicitud_vacaciones sv
INNER JOIN usuario u
    ON sv.id_usuario_solicita = u.id_usuario

ORDER BY fecha_solicitud DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ObtenerSolicitudespendientes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ObtenerSolicitudespendientes`(
    pIdEncargado INT
)
BEGIN
    SELECT sp.id_solicitud, sp.id_usuario, u.nombre AS nombre_empleado, sp.fecha_inicio, 
           sp.fecha_fin, sp.descripcion, cp.nombre AS categoria, sp.estado, sp.fecha_solicitud
    FROM solicitud_permiso sp
    INNER JOIN usuario u ON sp.id_usuario = u.id_usuario
    INNER JOIN categoria_permiso cp ON sp.id_categoria = cp.id_categoria
    WHERE sp.id_encargado = pIdEncargado AND sp.estado = 'Pendiente'
    ORDER BY sp.fecha_solicitud DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ObtenerSolicitudesUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ObtenerSolicitudesUsuario`(
    pIdUsuario INT
)
BEGIN
    SELECT sp.id_solicitud, sp.fecha_inicio, sp.fecha_fin, sp.descripcion, 
           cp.nombre AS categoria, sp.estado, sp.fecha_solicitud, sp.fecha_respuesta,
           sp.motivo_rechazo, u.nombre AS nombre_encargado
    FROM solicitud_permiso sp
    INNER JOIN categoria_permiso cp ON sp.id_categoria = cp.id_categoria
    LEFT JOIN usuario u ON sp.id_encargado = u.id_usuario
    WHERE sp.id_usuario = pIdUsuario
    ORDER BY sp.fecha_solicitud DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ObtenerUsuarioPorId` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ObtenerUsuarioPorId`(
    pId INT
)
BEGIN
	SELECT id_usuario, nombre, correo, rol
    FROM usuario
    WHERE id_usuario = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_RechazarSolicitudPermiso` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_RechazarSolicitudPermiso`(
    pId INT
)
BEGIN
	UPDATE solicitud_permiso 
	SET estado = 'Rechazado'
	WHERE id_solicitud = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_RechazarSolicitudVacaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_RechazarSolicitudVacaciones`(
    pId INT
)
BEGIN

    DECLARE pUsuario INT;
    DECLARE pDias INT;

    SELECT id_usuario_solicita, dias_solicitados
    INTO pUsuario, pDias
    FROM solicitud_vacaciones
    WHERE id_solicitud = pId;

    UPDATE solicitud_vacaciones 
    SET estado = 'Rechazado'
    WHERE id_solicitud = pId;

    UPDATE vacaciones
    SET dias_usados = dias_usados - pDias
    WHERE id_usuario = pUsuario;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_RegistrarHoras` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_RegistrarHoras`(
    IN p_idUsuario INT,
    IN p_idCliente INT,
    IN p_idCategoriaHora INT,
    IN p_clasificacionHora VARCHAR(20),
    IN p_cantidad INT,
    IN p_descripcion VARCHAR(255),
    IN p_fecha DATE
)
BEGIN
    INSERT INTO registro_horas(id_usuario, id_cliente, id_categoria_hora, clasificacion_hora, cantidad, descripcion, fecha)
    VALUES (p_idUsuario, p_idCliente, p_idCategoriaHora, p_clasificacionHora, p_cantidad, p_descripcion, p_fecha);

    SELECT 1 AS resultado, 'Horas registradas correctamente' AS mensaje;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_RegistrarSolicitudVacaciones` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_RegistrarSolicitudVacaciones`(pIdUsuario INT,pDias INT,pFechaInicio DATE,pFechaFin DATE,pDescripcion VARCHAR(500))
BEGIN

INSERT INTO solicitud_vacaciones(id_usuario_solicita,dias_solicitados,fecha_inicio,fecha_fin,descripcion,estado)
VALUES(pIdUsuario,pDias,pFechaInicio,pFechaFin,pDescripcion,'Pendiente');

UPDATE vacaciones 
SET dias_usados = dias_usados+pDias
WHERE id_usuario=pIdUsuario;


SELECT 1 resultado, 'Solicitud enviada correctamente' mensaje;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_RegistroCliente` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_RegistroCliente`(pNombre varchar(100),pDescripcion varchar(255))
BEGIN
	IF EXISTS (SELECT 1 FROM cliente WHERE nombre = pNombre) THEN
        SELECT 0 AS resultado, 'El cliente ya está registrado' AS mensaje;
    ELSE
        INSERT INTO cliente(nombre, descripcion, activo)
            VALUES(pNombre, pDescripcion, 1);

        SELECT 1 AS resultado, 'El cliente fue registrado correctamente' AS mensaje;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_RegistroUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_RegistroUsuario`(
	pIdentificacion VARCHAR(15),
    pNombre VARCHAR(200),
    pCorreo VARCHAR(150),
    pContrasenna VARCHAR(255),
    pRol INT
)
BEGIN
    DECLARE idUsuarioN INT;

    IF EXISTS (SELECT 1 FROM usuario WHERE correo = pCorreo) THEN
        SELECT 0 AS resultado, 'El correo ya está registrado' AS mensaje;
    ELSEIF EXISTS (SELECT 1 FROM usuario WHERE identificacion = pIdentificacion) THEN
        SELECT 0 AS resultado, 'La identificación ya está registrada' AS mensaje;
    ELSE
        INSERT INTO usuario(identificacion, nombre, correo, contrasenna, estado, rol)
        VALUES(pIdentificacion, pNombre, pCorreo, pContrasenna, b'1', pRol);

        SELECT LAST_INSERT_ID() INTO idUsuarioN;

        INSERT INTO vacaciones(id_usuario, dias_acumulados, dias_usados, fecha_ultimo_calculo)
        VALUES(idUsuarioN, 0, 0, CURDATE());

        SELECT 1 AS resultado, 'Usuario registrado correctamente' AS mensaje;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_TotalClientes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_TotalClientes`()
BEGIN
	SELECT COUNT(*) AS total
    FROM cliente;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_TotalHorasPorUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_TotalHorasPorUsuario`(IN p_idUsuario INT)
BEGIN
    SELECT COUNT(*) AS total
    FROM registro_horas
    WHERE id_usuario = p_idUsuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_TotalUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_TotalUsuarios`()
BEGIN
	SELECT COUNT(*) AS total
    FROM usuario;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_ValidarCorreo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_ValidarCorreo`(
	pCorreo VARCHAR(150)
)
BEGIN
	SELECT id_usuario,
		nombre,
            	correo,
            	estado
    	FROM usuario
    	WHERE correo = pCorreo
    	AND estado = b'1';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sgh_VerSolicitud` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sgh_VerSolicitud`(pIdSolicitud INT)
BEGIN
SELECT 
                sp.id_solicitud,
                sp.fecha_inicio,
                sp.fecha_fin,
                c.nombre AS categoria,
                sp.descripcion,
                sp.estado,
                sp.fecha_solicitud,
                sp.fecha_respuesta,
                u.nombre AS nombre_empleado,
                e.nombre AS nombre_encargado,
                'Permiso' AS tipo
            FROM solicitud_permiso sp
            INNER JOIN usuario u ON sp.id_usuario = u.id_usuario
            LEFT JOIN usuario e ON sp.id_encargado = e.id_usuario
            INNER JOIN categoria_permiso c ON sp.id_categoria = c.id_categoria
            WHERE sp.id_solicitud = pIdSolicitud

            UNION ALL

            SELECT 
                sv.id_solicitud,
                sv.fecha_inicio,
                sv.fecha_fin,
                'Vacaciones' AS categoria,
                sv.descripcion,
                sv.estado,
                sv.fecha_solicitud,
                sv.fecha_respuesta,
                u.nombre AS nombre_empleado,
                e.nombre AS nombre_encargado,
                'Vacaciones' AS tipo
            FROM solicitud_vacaciones sv
            INNER JOIN usuario u ON sv.id_usuario_solicita = u.id_usuario
            LEFT JOIN usuario e ON sv.id_encargado = e.id_usuario
            WHERE sv.id_solicitud = pIdSolicitud;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-15 22:28:11
