use project_nw;
DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `UsuarioId` int NOT NULL AUTO_INCREMENT,
  `UsuarioEmail` varchar(80) NOT NULL,
  `UsuarioNombre` varchar(80) NOT NULL,
  `UsuarioPswd` varchar(128) NOT NULL,
  `UsuarioFching` datetime NOT NULL,
  `UsuarioPswdEst` char(3) NOT NULL,
  `UsuarioPswdExp` datetime NOT NULL,
  `UsuarioEst` char(3) NOT NULL,
  `UsuarioActCod` varchar(128) NOT NULL,
  `UsuarioPswdChg` varchar(128) NOT NULL,
  `UsuarioTipo` char(3) NOT NULL COMMENT 'Tipo de Usuario, Normal, Consultor o Cliente',
  `ClienteDireccion` varchar(180) DEFAULT NULL,
  `ClienteTelefono` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`UsuarioId`),
  UNIQUE KEY `useremail_UNIQUE` (`UsuarioEmail`) USING BTREE,
  KEY `usertipo` (`UsuarioTipo`,`UsuarioEmail`,`UsuarioId`,`UsuarioEst`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
INSERT INTO `usuarios` VALUES (30,'joseosgui@hotmail.com','Jose Guillen','$2y$10$ooh0FqV4dRBT9AOPmfkPQOxfxGSBQBlknV4tpCEm6RpTK7LpS8e4G','2022-04-03 16:22:24','ACT','2022-07-02 00:00:00','ACT','8a3ba5fd7d69c6405bce0ac942216d43267e19431e62e4d73bd08fbfc9defdbc','2022-04-03 16:22:24','ADM',NULL,NULL);
UNLOCK TABLES;
