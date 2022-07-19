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
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `VentaId` int NOT NULL AUTO_INCREMENT,
  `VentaFecha` datetime NOT NULL,
  `VentaISV` decimal(9,2) NOT NULL,
  `VentaEst` varchar(10) NOT NULL,
  `VentaLinkDevolucion` varchar(100) DEFAULT NULL,
  `VentaLinkOrden` varchar(100) DEFAULT NULL,
  `VentaCantidadTotal` decimal(9,2) DEFAULT NULL,
  `VentaComisionPayPal` decimal(9,2) DEFAULT NULL,
  `VentaCantidadNeta` decimal(9,2) DEFAULT NULL,
  `ClienteDireccion` char(180) DEFAULT NULL,
  `ClienteTelefono` char(20) DEFAULT NULL,
  `UsuarioId` int DEFAULT NULL,
  PRIMARY KEY (`VentaId`),
  KEY `IX_Relationship9` (`UsuarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (7,'2021-04-12 21:21:23',0.15,'ENVIADO','https://api.sandbox.paypal.com/v2/payments/captures/3LV69036EJ103041F/refund','https://api.sandbox.paypal.com/v2/checkout/orders/1B5672203F024160M',33925.13,1669.55,32255.58,'Francisco Morazan, Tegucigalpa, Ciudad Lempira,','97977966',15),(11,'2021-04-12 22:18:23',0.15,'ENVIADO','https://api.sandbox.paypal.com/v2/payments/captures/3ME48635CU398743C/refund','https://api.sandbox.paypal.com/v2/checkout/orders/0RN72854YL7747421',8049.92,401.73,7648.19,'Francisco Morazan, Tegucigalpa, Cerro Grande Etapa 4,','76323432',26),(12,'2021-04-12 22:29:53',0.15,'PND','https://api.sandbox.paypal.com/v2/payments/captures/7A614817JS3268210/refund','https://api.sandbox.paypal.com/v2/checkout/orders/6E954533HM3539413',2070.07,108.71,1961.36,'Francisco Morazan, Tegucigalpa, Cfdsknfsdnfsdkjnfksdn,','76323432',26),(14,'2021-04-12 22:32:26',0.15,'ENVIADO','https://api.sandbox.paypal.com/v2/payments/captures/9CS39887DH7517425/refund','https://api.sandbox.paypal.com/v2/checkout/orders/0M5594752S0264119',5175.19,260.86,4914.33,'Francisco Morazan, Tegucigalpa, Cfdsknfsdnfsdkjnfksdn,','76323432',15);
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-12 22:58:15
