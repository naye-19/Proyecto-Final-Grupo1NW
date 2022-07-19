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
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `MediaId` int NOT NULL AUTO_INCREMENT,
  `MediaDoc` varchar(80) NOT NULL,
  `MediaPath` varchar(150) NOT NULL,
  `ProdId` int DEFAULT NULL,
  PRIMARY KEY (`MediaId`),
  KEY `IX_Relationship5` (`ProdId`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (12,'Billetera.jpg','public/img/productos/Billetera.jpg',2),(14,'Dell XP.jpg','public/img/productos/Dell XP.jpg',7),(24,'Rloj US Polo ASSN 2.jpg','public/img/productos/Rloj US Polo ASSN 2.jpg',1),(25,'Rloj US Polo ASSN.jpg','public/img/productos/Rloj US Polo ASSN.jpg',1),(28,'Ps4.png','public/img/productos/Ps4.png',10),(29,'IPhone X.jpg','public/img/productos/IPhone X.jpg',11),(30,'Nintendo Switch.jpg','public/img/productos/Nintendo Switch.jpg',12),(31,'Google Chromecast.jpg','public/img/productos/Google Chromecast.jpg',13),(32,'Apple Watch 2.jpg','public/img/productos/Apple Watch 2.jpg',14),(33,'Apple Watch.jpg','public/img/productos/Apple Watch.jpg',14),(34,'Sony WH-1000XM3(2).jpg','public/img/productos/Sony WH-1000XM3(2).jpg',15),(35,'Sony WH-1000XM3.jpg','public/img/productos/Sony WH-1000XM3.jpg',15),(36,'Kindle(2).jpg','public/img/productos/Kindle(2).jpg',16),(37,'Kindle.jpg','public/img/productos/Kindle.jpg',16),(43,'fitbit(2).jpg','public/img/productos/fitbit(2).jpg',17),(44,'fitbit.png','public/img/productos/fitbit.png',17),(62,'Razer Mouse 1_.jpg','public/img/productos/Razer Mouse 1_.jpg',23),(63,'Razer Mouse 2.jpeg','public/img/productos/Razer Mouse 2.jpeg',23);
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
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
