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
-- Table structure for table `carritocompraclienteanonimo`
--

DROP TABLE IF EXISTS `carritocompraclienteanonimo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carritocompraclienteanonimo` (
  `ClienteAnonimoId` varchar(300) NOT NULL,
  `ProdId` int NOT NULL,
  `ProdCantidad` int NOT NULL,
  `ProdPrecioVenta` decimal(9,2) NOT NULL,
  `ProdFechaIngreso` datetime NOT NULL,
  PRIMARY KEY (`ClienteAnonimoId`,`ProdId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carritocompraclienteanonimo`
--

LOCK TABLES `carritocompraclienteanonimo` WRITE;
/*!40000 ALTER TABLE `carritocompraclienteanonimo` DISABLE KEYS */;
INSERT INTO `carritocompraclienteanonimo` VALUES ('ilnfseesphvm3gscs33tv73u1j',1,2,2300.00,'2021-04-09 18:57:02'),('ilnfseesphvm3gscs33tv73u1j',2,1,3450.00,'2021-04-09 18:57:26'),('og2b638ukv1naqtil4snc33q91',1,1,2300.00,'2021-04-11 14:42:07'),('uo4n1vfbfbrotndtphdrrrsk7m',1,4,2300.00,'2021-04-09 00:59:46'),('uo4n1vfbfbrotndtphdrrrsk7m',2,3,3450.00,'2021-04-09 00:59:57'),('uo4n1vfbfbrotndtphdrrrsk7m',13,1,2070.00,'2021-04-09 02:31:12');
/*!40000 ALTER TABLE `carritocompraclienteanonimo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-12 22:58:12
