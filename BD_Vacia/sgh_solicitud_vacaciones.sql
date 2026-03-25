CREATE DATABASE  IF NOT EXISTS `sgh` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `sgh`;
-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_vacaciones`
--

LOCK TABLES `solicitud_vacaciones` WRITE;
/*!40000 ALTER TABLE `solicitud_vacaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `solicitud_vacaciones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-24 22:19:01
