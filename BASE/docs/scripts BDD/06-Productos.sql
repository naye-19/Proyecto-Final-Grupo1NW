-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: globalshophn
-- ------------------------------------------------------
-- Server version	8.0.23

use project_nw;

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
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `ProdId` int NOT NULL AUTO_INCREMENT,
  `ProdNombre` varchar(120) NOT NULL,
  `ProdDescripcion` varchar(500) NOT NULL,
  `ProdPrecioVenta` decimal(9,2) NOT NULL,
  `ProdPrecioCompra` decimal(9,2) NOT NULL,
  `ProdEst` char(3) NOT NULL,
  `ProdStock` int NOT NULL,
  PRIMARY KEY (`ProdId`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Reloj US Polo Assn','Reloj US Polo Assn',2000.00,1000.00,'ACT',16),(2,'Billetera Tommy Hilfigher','Billeter Tommy Hilfigher de Cuero',3000.00,1500.00,'ACT',28),(7,'Laptop Dell XP 2016','Laptop Dell XP 2016, SSD de 512 GB, Memoria RAM de 16gbs, Windows 10 Home, Teclado Backlit',30000.00,20000.00,'ACT',10),(10,'PlayStation 4','Consola Playstation 4 con un control.',7000.00,5000.00,'ACT',9),(11,'IPhone X','Pantalla Super Retina HD\r\nPantalla OLED Multi-Touch de 5,8 pulgadas (en diagonal)\r\nPantalla HDR\r\nResolución de 2.436 por 1.125 píxeles a 458 p/p\r\nContraste de 1.000.000:1 (típico)',30000.00,20000.00,'ACT',3),(12,'Nintendo Switch','Obtén el sistema de juego que te permite jugar los juegos que desees, donde estés, como quieras.\r\nIncluye la consola Nintendo Switch y la base de Nintendo Switch en color negro.',14000.00,8000.00,'ACT',3),(13,'Google ChromeCast','Transmite desde tu teléfono a tu televisor. Así es. Enchufa Chromecast en el puerto HDMI de tu televisor para alimentar y transmitir tu entretenimiento favorito',1800.00,800.00,'ACT',9),(14,'Apple Watch Series 6 (GPS, 40mm)','El modelo GPS te permite hacer llamadas y responder a los textos de tu muñeca.\r\nSincroniza tu música, podcasts y audiolibros.',12000.00,8000.00,'ACT',3),(15,'Headphones Sony WH-1000XM3','Su calidad de sonido les permite medirse de tú a tú con los mejores auriculares circumaurales de su rango de precio.',8000.00,4000.00,'ACT',1),(16,'Kindle Paperwhite','El Kindle Paperwhite más delgado y liviano hasta el momento, con un diseño frontal al ras y una pantalla sin reflejos de 300 ppp',4000.00,2000.00,'ACT',9),(17,'Fitbit Inspire 2 Health & Fitness','Seguimiento de la actividad durante todo el día: tus pasos, distancia, actividad cada hora y calorías quemadas.',4500.00,1000.00,'ACT',8),(23,'Razer Viper 8KHz Ultralight Ambidextrous Wired Gaming Mouse','El fabricante de periféricos para juegos más vendido en los Estados Unidos: Source - The NPD Group, Inc., U.S. Retail Tracking Service, Gaming Diseñado: teclados, ratones, auriculares de PC y micrófonos de PC, basado en ventas de dólares, enero de 2017 a junio de 2020 combinado.',2200.00,1800.00,'ACT',12);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-12 22:58:14
