-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: hippo_pote_ame
-- ------------------------------------------------------
-- Server version	11.6.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `client_types`
--

DROP TABLE IF EXISTS `client_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_types` (
  `ClientTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`ClientTypeId`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_types`
--

LOCK TABLES `client_types` WRITE;
/*!40000 ALTER TABLE `client_types` DISABLE KEYS */;
INSERT INTO `client_types` VALUES (2,'Particulier'),(1,'Societé');
/*!40000 ALTER TABLE `client_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `ClientId` int(11) NOT NULL AUTO_INCREMENT,
  `ClientTypeId` int(11) NOT NULL,
  `SocietyName` varchar(50) DEFAULT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `BCE` varchar(12) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Telephone` varchar(15) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Number` varchar(6) DEFAULT NULL,
  `ZipCode` varchar(8) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ClientId`),
  KEY `clients_clientstype` (`ClientTypeId`),
  CONSTRAINT `clients_clientstype` FOREIGN KEY (`ClientTypeId`) REFERENCES `client_types` (`ClientTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `invoice_sessions`
--

DROP TABLE IF EXISTS `invoice_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice_sessions` (
  `InvoiceId` int(11) NOT NULL,
  `SessionId` int(11) NOT NULL,
  KEY `invoice_sessions_sessions_FK` (`SessionId`),
  KEY `invoice_sessions_invoices_FK` (`InvoiceId`),
  CONSTRAINT `invoice_sessions_invoices_FK` FOREIGN KEY (`InvoiceId`) REFERENCES `invoices` (`InvoiceId`),
  CONSTRAINT `invoice_sessions_sessions_FK` FOREIGN KEY (`SessionId`) REFERENCES `sessions` (`SessionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `InvoiceId` int(11) NOT NULL AUTO_INCREMENT,
  `Reference` varchar(50) DEFAULT NULL,
  `Month` tinyint(4) NOT NULL,
  `Year` smallint(6) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `ClientId` int(11) NOT NULL,
  `HTVA` decimal(10,0) NOT NULL,
  `TVA` decimal(10,0) NOT NULL,
  `TVAC` decimal(10,0) NOT NULL,
  `Paid` decimal(10,0) DEFAULT NULL,
  `DatePaid` datetime DEFAULT NULL,
  PRIMARY KEY (`InvoiceId`),
  UNIQUE KEY `invoices_unique` (`Reference`),
  KEY `clients_invoices` (`ClientId`),
  CONSTRAINT `clients_invoices` FOREIGN KEY (`ClientId`) REFERENCES `clients` (`ClientId`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `medical_records`
--

DROP TABLE IF EXISTS `medical_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medical_records` (
  `RecordId` smallint(6) NOT NULL AUTO_INCREMENT,
  `PonyId` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Description` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`RecordId`),
  KEY `medical_records_ponies_FK` (`PonyId`),
  CONSTRAINT `medical_records_ponies_FK` FOREIGN KEY (`PonyId`) REFERENCES `ponies` (`PonyId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `MessageId` int(11) NOT NULL AUTO_INCREMENT,
  `Sender` varchar(100) NOT NULL,
  `Receiver` varchar(100) NOT NULL,
  `Object` varchar(100) NOT NULL,
  `Message` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `Read` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`MessageId`),
  KEY `messages_users_FK` (`Sender`),
  KEY `messages_users_FK_1` (`Receiver`),
  CONSTRAINT `messages_users_FK` FOREIGN KEY (`Sender`) REFERENCES `users` (`username`),
  CONSTRAINT `messages_users_FK_1` FOREIGN KEY (`Receiver`) REFERENCES `users` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ponies`
--

DROP TABLE IF EXISTS `ponies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ponies` (
  `PonyId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Height` varchar(50) DEFAULT NULL,
  `MaxWorkHour` tinyint(4) NOT NULL,
  `TemperamentId` int(11) NOT NULL,
  PRIMARY KEY (`PonyId`),
  UNIQUE KEY `ponies_unique` (`Name`),
  KEY `ponies_temperaments` (`TemperamentId`),
  CONSTRAINT `ponies_temperaments` FOREIGN KEY (`TemperamentId`) REFERENCES `temperaments` (`TemperamentId`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `session_clients`
--

DROP TABLE IF EXISTS `session_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `session_clients` (
  `ClientId` int(11) NOT NULL,
  `SessionId` int(11) NOT NULL,
  `Price` int(11) NOT NULL DEFAULT 0,
  `Paid` int(11) DEFAULT 0,
  `Invoice` varchar(100) DEFAULT 'NF',
  PRIMARY KEY (`ClientId`,`SessionId`),
  KEY `sessions_sessionclients` (`SessionId`),
  CONSTRAINT `clients_sessionclients` FOREIGN KEY (`ClientId`) REFERENCES `clients` (`ClientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sessions_sessionclients` FOREIGN KEY (`SessionId`) REFERENCES `sessions` (`SessionId`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `session_ponies`
--

DROP TABLE IF EXISTS `session_ponies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `session_ponies` (
  `PonyId` int(11) NOT NULL,
  `SessionId` int(11) NOT NULL,
  PRIMARY KEY (`PonyId`,`SessionId`),
  KEY `fk_sessions` (`SessionId`),
  CONSTRAINT `fk_ponies` FOREIGN KEY (`PonyId`) REFERENCES `ponies` (`PonyId`) ON DELETE CASCADE,
  CONSTRAINT `fk_sessions` FOREIGN KEY (`SessionId`) REFERENCES `sessions` (`SessionId`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `session_types`
--

DROP TABLE IF EXISTS `session_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `session_types` (
  `SessionTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  PRIMARY KEY (`SessionTypeId`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_types`
--

LOCK TABLES `session_types` WRITE;
/*!40000 ALTER TABLE `session_types` DISABLE KEYS */;
INSERT INTO `session_types` VALUES (3,'Anniversaire'),(2,'Cours'),(1,'Groupe');
/*!40000 ALTER TABLE `session_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `SessionId` int(11) NOT NULL AUTO_INCREMENT,
  `DateSession` date NOT NULL,
  `HourSession` time NOT NULL,
  `Duration` tinyint(4) DEFAULT 1,
  `Participants` tinyint(4) DEFAULT 1,
  `SessionTypeId` int(11) NOT NULL,
  PRIMARY KEY (`SessionId`),
  KEY `sessions_session_types_FK` (`SessionTypeId`),
  CONSTRAINT `sessions_session_types_FK` FOREIGN KEY (`SessionTypeId`) REFERENCES `session_types` (`SessionTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temperaments`
--

DROP TABLE IF EXISTS `temperaments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `temperaments` (
  `TemperamentId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Description` text DEFAULT NULL,
  PRIMARY KEY (`TemperamentId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temperaments`
--

LOCK TABLES `temperaments` WRITE;
/*!40000 ALTER TABLE `temperaments` DISABLE KEYS */;
INSERT INTO `temperaments` VALUES (1,'Docile','Obéissant, soumis, et disposé à se laisser conduire ou diriger. Idéal pour un débutant !'),(2,'Fougeux','Plein de vie. Pour cavalier aguerri !'),(3,'Têtu','Un peu obstiné. Il ne se laissera pas facilement guider. A laisser entre mains expertes.'),(4,'Courageux','Du courage, de la fermeté, de l\'ardeur, de l\'énergie au travail. Ne se fatigue pas très vite.'),(5,'Craintif','Peureux, il n\'osera pas se laisser approcher. Uniquement pour une personne patiente et douce.');
/*!40000 ALTER TABLE `temperaments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `leaf_auth_user_roles` text NOT NULL DEFAULT '["user"]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_unique` (`email`),
  UNIQUE KEY `users_unique_1` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@hippo.be','$2y$10$t7bnsor5zlk2j9x6u5LjpObh5bXu/l8L9PqKdCmCA36xoDFqSDxTO','2025-01-31 18:14:54','2025-01-31 18:14:54','[\"admin\"]');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'hippo_pote_ame'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-21 10:56:54
