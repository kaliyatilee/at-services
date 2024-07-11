/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: muzanya_atservices
-- ------------------------------------------------------
-- Server version	10.6.18-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_number` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone1` varchar(20) NOT NULL,
  `phone2` varchar(20) DEFAULT NULL,
  `credit_allowed` int(11) NOT NULL DEFAULT 0 COMMENT '0 is false, 1 is true',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (5,'32-189157N32','lee','0717716528','1231232321312',0,1,'2024-05-18 09:03:51','2024-05-18 09:03:51');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_registration`
--

DROP TABLE IF EXISTS `company_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_registration` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `charge` double(20,2) NOT NULL,
  `expenses` double(20,2) NOT NULL,
  `commission` double(20,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount_paid` double NOT NULL,
  `currency_id` int(11) NOT NULL,
  `transaction_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_registration`
--

LOCK TABLES `company_registration` WRITE;
/*!40000 ALTER TABLE `company_registration` DISABLE KEYS */;
INSERT INTO `company_registration` VALUES (5,1,'Lee','0779755462',1.00,0.00,0.00,1,'jkljkljkljkl','2024-05-09 00:28:32','2024-05-18 21:44:04',1,1,'2024-05-19 01:29:46'),(6,0,'Lee','0779755462',1.00,0.00,0.00,1,'232','2024-05-09 00:39:01','2024-05-09 00:39:01',1,1,'2024-05-19 01:29:46'),(7,0,'Lee','0779755462',1.00,0.00,0.00,1,'232','2024-05-09 00:43:57','2024-05-11 05:37:02',1,1,'2024-05-19 01:29:46'),(8,0,'Lisa','0779755462',1.00,0.00,0.00,1,'232','2024-05-10 09:23:50','2024-05-10 09:23:50',1,1,'2024-05-19 01:29:46'),(9,0,'Developer','0779755462',1.00,0.00,0.00,1,'23','2024-05-11 05:04:36','2024-05-11 05:04:36',1,1,'2024-05-19 01:29:46'),(10,0,'Peter','+27611778262',1.00,0.00,0.00,1,'jkljkljkljkl','2024-05-11 05:33:49','2024-05-11 05:33:49',1,1,'2024-05-19 01:29:46'),(11,0,'Peter','+27611778262',1.00,0.00,0.00,1,'jkljkljkljkl','2024-05-11 05:33:54','2024-05-11 05:33:54',1,1,'2024-05-19 01:29:46'),(12,0,'Peter','+27611778262',1.00,0.00,0.00,1,'jkljkljkljkl','2024-05-11 05:35:33','2024-05-11 05:35:33',1,1,'2024-05-19 01:29:46'),(13,0,'Peter','+27611778262',1.00,0.00,0.00,1,'jkljkljkljkl','2024-05-11 05:35:40','2024-05-11 05:35:40',1,1,'2024-05-19 01:29:46'),(14,0,'Leepo','0779755462',1.00,0.00,0.00,1,'232','2024-05-18 21:33:37','2024-05-18 21:33:37',1,1,'2024-05-19 01:33:37'),(15,1,'Leepo','0779755462',12.00,12.00,23.00,1,'232','2024-05-18 21:38:13','2024-05-18 21:38:13',23,2,'2024-05-19 01:38:13'),(16,1,'Developer','0779755462',12.00,12.00,23.00,1,'23','2024-05-18 21:39:18','2024-05-18 21:39:18',23,1,'2024-05-19 01:39:18'),(17,1,'Developer','+27826419236',12.00,12.00,23.00,1,'34534','2024-05-18 21:40:57','2024-05-18 21:40:57',23,2,'2024-05-19 01:40:57');
/*!40000 ALTER TABLE `company_registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_registration_supplier`
--

DROP TABLE IF EXISTS `company_registration_supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_registration_supplier` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `location` varchar(40) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_registration_supplier`
--

LOCK TABLES `company_registration_supplier` WRITE;
/*!40000 ALTER TABLE `company_registration_supplier` DISABLE KEYS */;
INSERT INTO `company_registration_supplier` VALUES (1,'Leon','0771716528',NULL,NULL,'Bulawayo',1,'any','2024-02-05 13:59:08','2024-02-05 13:59:08'),(3,'Algosec','0771716528','34534534543','lee@dotxmltech.com','Harare',1,'Heya these are my notes','2024-05-18 14:11:33','2024-05-18 14:11:33');
/*!40000 ALTER TABLE `company_registration_supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `exchange_rate` double(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` VALUES (1,'USD',1.25,'2024-02-02 16:23:57','2024-05-12 22:25:44'),(2,'ZIG',13.40,'2024-02-04 10:15:48','2024-02-04 10:15:48'),(3,'ZAR',20.00,'2024-02-20 20:39:44','2024-02-20 20:39:44');
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dstv_packages`
--

DROP TABLE IF EXISTS `dstv_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dstv_packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount_rand` double DEFAULT 0,
  `commission_usd` double DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dstv_packages`
--

LOCK TABLES `dstv_packages` WRITE;
/*!40000 ALTER TABLE `dstv_packages` DISABLE KEYS */;
INSERT INTO `dstv_packages` VALUES (1,'Family',1,'2024-01-31 16:49:14','2024-01-31 16:49:14',0,0),(2,'LITE',1,'2024-03-01 09:03:13',NULL,0,0),(3,'ACCESS',1,'2024-03-01 09:03:13',NULL,0,0),(4,'FAMILY',1,'2024-03-01 09:03:13',NULL,0,0),(5,'COMPACT',1,'2024-03-01 09:03:13',NULL,0,0),(6,'COMPACT PLUS',1,'2024-03-01 09:03:13',NULL,0,0),(7,'PREMIUM',1,'2024-03-01 09:03:13',NULL,0,0),(8,'SA LITE',1,'2024-03-01 09:03:13',NULL,0,0),(9,'SA ACCESS Zim',1,'2024-03-01 09:03:13','2024-05-13 12:09:16',120,10),(10,'SA FAMILY hehehehehehehehehe',1,'2024-03-01 09:03:13','2024-05-13 12:08:00',40,1),(11,'SA COMPACT',1,'2024-03-01 09:03:13',NULL,0,0),(12,'SA COMPACT PLUS',1,'2024-03-01 09:03:13',NULL,0,0),(13,'SA PREMIUM',1,'2024-03-01 09:03:13',NULL,0,0),(14,'SA ACCOUNT PAYMENT',1,'2024-03-01 09:03:13',NULL,0,0),(15,'TOPUP',1,'2024-03-22 11:53:02','2024-03-22 11:53:02',0,0),(16,'OTHER',1,'2024-03-22 11:53:02','2024-03-22 11:53:02',0,0),(17,'Dstv zim',1,'2024-05-12 15:55:13','2024-05-12 15:55:13',0,0),(18,'Algosec',1,'2024-05-12 21:19:51','2024-05-12 21:19:51',0,0),(19,'developer',1,'2024-05-12 21:23:23','2024-05-12 21:23:23',0,0),(20,'Developerere',1,'2024-05-12 21:26:57','2024-05-12 21:26:57',0,0),(21,'Developererewewewew',1,'2024-05-12 21:28:02','2024-05-12 21:28:02',0,0),(22,'gghjghjhg',1,'2024-05-12 21:28:56','2024-05-12 21:28:56',0,0),(23,'Pererer',1,'2024-05-12 21:32:03','2024-05-12 21:32:03',0,0),(24,'Graphics Card',1,'2024-05-12 21:38:03','2024-05-12 21:38:03',0,0),(25,'Graphics Cards',1,'2024-05-12 21:40:37','2024-05-12 21:40:37',0,0),(26,'Graphics Cardsdd',1,'2024-05-12 21:42:17','2024-05-12 21:42:17',0,0),(27,'Graphics Cardsdds',1,'2024-05-12 21:43:01','2024-05-12 21:43:01',123,12);
/*!40000 ALTER TABLE `dstv_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dstv_payment`
--

DROP TABLE IF EXISTS `dstv_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dstv_payment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `currency` varchar(5) NOT NULL,
  `dstv_transaction_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `amount_before` double(8,2) NOT NULL,
  `amount_after` double(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dstv_payment`
--

LOCK TABLES `dstv_payment` WRITE;
/*!40000 ALTER TABLE `dstv_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `dstv_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dstv_transaction`
--

DROP TABLE IF EXISTS `dstv_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dstv_transaction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dstv_account_number` varchar(255) DEFAULT NULL,
  `package_id` int(11) NOT NULL,
  `rate` varchar(255) DEFAULT '0',
  `amount_paid` varchar(255) DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `commission_usd` double(8,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `expected_amount` text NOT NULL,
  `currency_id` int(11) NOT NULL,
  `transaction_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dstv_transaction`
--

LOCK TABLES `dstv_transaction` WRITE;
/*!40000 ALTER TABLE `dstv_transaction` DISABLE KEYS */;
INSERT INTO `dstv_transaction` VALUES (25,'8432423432423',1,'5.0','9',2,0.00,'h8','2024-04-22 20:57:25','2024-05-16 16:18:50','Gilbert','3','9',2,'2026-01-16 00:00:00'),(33,'2332323',5,'11.0','11',1,0.00,NULL,'2024-04-28 20:47:31','2024-05-16 14:10:11','1111','222222','11',3,'2024-05-16 18:51:58'),(34,NULL,5,'11.0','11',1,0.00,NULL,'2024-04-28 20:54:38','2024-04-28 20:54:38','1111','222222','11',1,'2024-05-16 18:51:58'),(37,'0',16,'0.0','16',4,0.00,'paid with cash out ecocash','2024-04-30 08:40:16','2024-04-30 08:40:16','M mwale','0717569877','16',1,'2024-05-16 18:51:58'),(39,NULL,3,'0.0','20',1,0.00,NULL,'2024-05-01 19:49:21','2024-05-01 19:49:21','leon','58855','20',2,'2024-05-16 18:51:58'),(40,'ft',6,'0.0','555',1,0.00,NULL,'2024-05-01 19:49:22','2024-05-01 19:49:22','256','66555','38',2,'2024-05-16 18:51:58'),(41,'123456789',3,'1.2','20',1,0.00,'this is my first note','2024-05-02 04:11:42','2024-05-02 04:11:42','Lee','0779755462','23',1,'2024-05-16 18:51:58'),(42,'2332323',1,'0','23',1,0.00,'23','2024-05-16 14:51:12','2024-05-16 14:51:12','Lee','0779755462','2',2,'2024-05-16 18:51:58'),(43,'12312',6,'0','23',1,0.00,'Notes','2024-05-18 08:14:17','2024-05-18 08:16:34','lee','06123232','123',3,'2026-01-18 00:00:00');
/*!40000 ALTER TABLE `dstv_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ecocash`
--

DROP TABLE IF EXISTS `ecocash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ecocash` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `agent_line` int(11) NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `expected_amount` text NOT NULL,
  `amount_paid` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `transaction_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ecocash`
--

LOCK TABLES `ecocash` WRITE;
/*!40000 ALTER TABLE `ecocash` DISABLE KEYS */;
INSERT INTO `ecocash` VALUES (6,'Lee','0779755462',1,1,1,'2','23',1,NULL,'2024-05-11 05:04:12','2024-05-11 05:04:12','2024-07-11 17:32:05'),(7,'Lee','0779755462',1,2,2,'2','23',1,'232','2024-05-16 09:50:26','2024-05-16 09:50:26','2024-07-11 17:32:05');
/*!40000 ALTER TABLE `ecocash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ecocash_agent_line`
--

DROP TABLE IF EXISTS `ecocash_agent_line`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ecocash_agent_line` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ecocash_agent_line`
--

LOCK TABLES `ecocash_agent_line` WRITE;
/*!40000 ALTER TABLE `ecocash_agent_line` DISABLE KEYS */;
INSERT INTO `ecocash_agent_line` VALUES (2,'Hum RBA','0779755462','Heya these are my notes',1,'2024-03-22 12:29:52','2024-05-18 14:09:52');
/*!40000 ALTER TABLE `ecocash_agent_line` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ecocash_transaction_type`
--

DROP TABLE IF EXISTS `ecocash_transaction_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ecocash_transaction_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ecocash_transaction_type`
--

LOCK TABLES `ecocash_transaction_type` WRITE;
/*!40000 ALTER TABLE `ecocash_transaction_type` DISABLE KEYS */;
INSERT INTO `ecocash_transaction_type` VALUES (4,'Swipes',1,'2024-05-12 22:48:47','2024-05-18 13:32:51');
/*!40000 ALTER TABLE `ecocash_transaction_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eggs`
--

DROP TABLE IF EXISTS `eggs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eggs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cash_paid` double(50,2) DEFAULT 0.00,
  `quantity_received` int(11) NOT NULL DEFAULT 0,
  `order_price` double(50,2) NOT NULL DEFAULT 0.00,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `quantity_sold` int(11) NOT NULL DEFAULT 0,
  `breakages` int(11) NOT NULL DEFAULT 0,
  `name` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `currency_id` int(11) NOT NULL DEFAULT 0,
  `transaction_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eggs`
--

LOCK TABLES `eggs` WRITE;
/*!40000 ALTER TABLE `eggs` DISABLE KEYS */;
INSERT INTO `eggs` VALUES (6,23.00,23,232.00,1,'2024-05-11 05:08:18','2024-05-11 05:08:18','jkljkljkljkl',232,12,'Lee','+27611778262',0,'2024-05-19 02:23:35'),(7,23.00,0,232.00,1,'2024-05-11 05:12:10','2024-05-11 05:12:10','jkljkljkljkl',1,12,'Lee','+27611778262',0,'2024-05-19 02:23:35'),(8,23.00,0,0.00,1,'2024-05-11 05:13:43','2024-05-11 05:13:43','jkljkljkljkl',1,12,'Lee','+27611778262',0,'2024-05-19 02:23:35'),(9,23.00,23,232.00,1,'2024-05-18 22:27:04','2024-05-18 22:27:04','jkljkljkljkl edit page',232,12,'Lee','0779755462',0,'2024-05-20 00:00:00');
/*!40000 ALTER TABLE `eggs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `general_sales`
--

DROP TABLE IF EXISTS `general_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `general_sales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `general_sales`
--

LOCK TABLES `general_sales` WRITE;
/*!40000 ALTER TABLE `general_sales` DISABLE KEYS */;
INSERT INTO `general_sales` VALUES (3,'zinara','0',1,1,20.00,4,'mutero payment eddie','2024-04-21 10:02:43','2024-04-21 10:02:43','Amount Given');
/*!40000 ALTER TABLE `general_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `general_sales_transaction_type`
--

DROP TABLE IF EXISTS `general_sales_transaction_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `general_sales_transaction_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `general_sales_transaction_type`
--

LOCK TABLES `general_sales_transaction_type` WRITE;
/*!40000 ALTER TABLE `general_sales_transaction_type` DISABLE KEYS */;
INSERT INTO `general_sales_transaction_type` VALUES (1,'ZINARA',1,'2024-03-01 07:21:05',NULL),(2,'INSURANCE',1,'2024-03-01 07:21:05',NULL),(3,'DSTV',1,'2024-03-01 07:21:05',NULL),(4,'ECOCASH',1,'2024-03-01 07:21:05',NULL),(5,'RTGS',1,'2024-03-01 07:21:05',NULL),(6,'EGGS',1,'2024-03-01 07:21:05',NULL),(7,'COMPANY REGISTRATION',1,'2024-03-01 07:21:05',NULL),(8,'PERMANENT DISC',1,'2024-03-01 07:21:05',NULL),(9,'LAZZY REPAYMENT',1,'2024-03-01 07:21:05',NULL),(10,'MONSO REPAYMENT',1,'2024-03-01 07:21:05',NULL),(11,'MAI NGAA REPAYMENT',1,'2024-03-01 07:21:05',NULL),(12,'KULE SIMBA REPAYMENT',1,'2024-03-01 07:21:05',NULL),(13,'PREPAYMENT',1,'2024-03-25 13:43:56','2024-03-25 13:43:56'),(14,'OTHER',1,'2024-03-25 13:44:13','2024-03-25 13:44:13');
/*!40000 ALTER TABLE `general_sales_transaction_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insurance_brooker`
--

DROP TABLE IF EXISTS `insurance_brooker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insurance_brooker` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `commission` double(8,2) NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insurance_brooker`
--

LOCK TABLES `insurance_brooker` WRITE;
/*!40000 ALTER TABLE `insurance_brooker` DISABLE KEYS */;
INSERT INTO `insurance_brooker` VALUES (1,'Clarions',1,30.00,'Heya these are my notes','2024-02-04 13:09:44','2024-05-13 12:35:07'),(2,'Hamilton',1,25.00,'','2024-03-22 11:56:50','2024-03-22 11:56:50'),(3,'Lee',1,23.00,'232','2024-05-12 21:53:27','2024-05-12 21:53:27'),(4,'lee -',1,12.00,'Notes','2024-05-18 10:08:32','2024-05-18 10:08:32'),(5,'Chitubu',1,30.00,'Heya these are my notes','2024-05-18 13:09:14','2024-05-18 13:09:14');
/*!40000 ALTER TABLE `insurance_brooker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insurance_payment`
--

DROP TABLE IF EXISTS `insurance_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insurance_payment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `insurance_transaction_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `amount_before` double(8,2) NOT NULL,
  `amount_after` double(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insurance_payment`
--

LOCK TABLES `insurance_payment` WRITE;
/*!40000 ALTER TABLE `insurance_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `insurance_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insurance_transaction`
--

DROP TABLE IF EXISTS `insurance_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insurance_transaction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `vehicle_type` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `insurance_broker` int(11) NOT NULL,
  `reg_no` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `payment_date` date DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `expected_amount_zig` double(8,2) NOT NULL,
  `commission_amount` double(8,2) NOT NULL,
  `amount_remitted_usd` double(8,2) NOT NULL,
  `amount_remitted_zig` double(8,2) NOT NULL,
  `commission_percentage` double(8,2) NOT NULL,
  `amount_received_usd` double(8,2) NOT NULL,
  `amount_received_zig` double(8,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `rate` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insurance_transaction`
--

LOCK TABLES `insurance_transaction` WRITE;
/*!40000 ALTER TABLE `insurance_transaction` DISABLE KEYS */;
INSERT INTO `insurance_transaction` VALUES (1,'lee - 0717716528','263779755462','Hondafit',1,1,5,1,'AEH8604','2024-07-12',NULL,'2024-07-12',23.00,0.13,6.90,6.90,30.00,23.00,23.00,'erretr','123','2024-07-11 16:16:28','2024-07-11 16:16:28');
/*!40000 ALTER TABLE `insurance_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_disbursed`
--

DROP TABLE IF EXISTS `loan_disbursed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_disbursed` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double(8,2) NOT NULL,
  `rate_per_week` double(8,2) NOT NULL,
  `repayment_date` date NOT NULL,
  `collateral` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `transaction_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_disbursed`
--

LOCK TABLES `loan_disbursed` WRITE;
/*!40000 ALTER TABLE `loan_disbursed` DISABLE KEYS */;
INSERT INTO `loan_disbursed` VALUES (6,100.00,23.00,'2024-05-17','kjljkljklkjl',1,'232','2024-05-10 09:29:09','2024-05-10 09:29:09',3,'Lee','0779755462','2024-05-18 12:10:45'),(7,100.00,10.00,'2024-05-11','kjljkljklkjl',1,'232','2024-05-11 05:02:55','2024-05-18 08:21:28',1,'Lee','0779755462','2026-01-12 00:00:00');
/*!40000 ALTER TABLE `loan_disbursed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_payment`
--

DROP TABLE IF EXISTS `loan_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_payment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `amount_before` double(8,2) NOT NULL,
  `amount_after` double(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_payment`
--

LOCK TABLES `loan_payment` WRITE;
/*!40000 ALTER TABLE `loan_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2024_01_26_083530_create_insurance_brooker',1),(6,'2024_01_26_111309_create_insurance_payment',1),(7,'2024_01_26_112052_create_dstv_packages',1),(8,'2024_01_26_112440_create_dstv_payment',1),(9,'2024_01_26_132633_create_loan_disbursed',1),(10,'2024_01_26_135536_create_loan_payment',1),(11,'2024_01_26_112440_create_dstv_transaction',2),(12,'2024_01_26_192751_create_dstv_payment_table',2),(13,'2014_10_12_0000001_create_users_table',3),(14,'2024_01_26_0835301_create_insurance_brooker',3),(15,'2024_01_26_1113091_create_insurance_payment',3),(16,'2024_01_26_1120521_create_dstv_packages',3),(18,'2024_01_26_1326331_create_loan_disbursed',3),(19,'2024_01_26_1355361_create_loan_payment',3),(20,'2024_01_26_1927511_create_dstv_payment_table',3),(21,'2024_01_28_201252_create_clients_table',4),(22,'2024_02_01_194002_create_currency_table',5),(24,'2024_01_26_1355361_create_insurance_payment',7),(27,'2024_02_03_090538_create_vehicle_class',10),(28,'2024_02_04_155346_create_ecocash_table',11),(29,'2024_02_04_155411_create_rtgs_table',11),(30,'2024_02_04_155637_create_company_registration_table',11),(31,'2024_02_04_155654_create_permenant_disc_table',11),(32,'2024_02_04_155706_create_eggs_table',11),(33,'2024_02_05_103350_create_ecocash_transaction_type',11),(34,'2024_02_05_151527_create_company_registration_supplier_table',11),(35,'2024_02_04_155638_create_company_registration_table',12),(36,'2024_02_04_155347_create_ecocash_table',13),(37,'2024_02_06_203617_create_ecocash_agent_line_table',13),(38,'2024_02_04_1553471_create_ecocash_table',14),(39,'2024_02_04_155412_create_rtgs_table',14),(41,'2024_02_05_103350_create_zinara_transaction_type',16),(42,'2024_01_26_1113094_create_zinara_transaction',17),(43,'2024_02_04_1553471_create_general_sale_table',18),(53,'2024_01_26_1113094_create_insurance_transaction',19);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `notes` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
INSERT INTO `notes` VALUES (2,'Hey Lee','2024-04-22','2024-04-22 20:57:26','2024-05-18 08:54:04'),(3,'hey theedited','2024-05-02','2024-05-02 04:13:08','2024-05-18 08:54:29'),(4,'Heya these are my notes','2024-05-16','2024-05-10 09:28:31','2024-05-10 09:28:31'),(5,'Heya these are my notes','2024-05-08','2024-05-12 00:55:02','2024-05-12 00:55:02');
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permanent_disc`
--

DROP TABLE IF EXISTS `permanent_disc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permanent_disc` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cash_paid` double(50,2) NOT NULL DEFAULT 0.00,
  `quantity_sold` int(11) NOT NULL DEFAULT 0,
  `quantity_received` int(11) NOT NULL DEFAULT 0,
  `order_price` double(50,2) NOT NULL DEFAULT 0.00,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `currency_id` int(11) NOT NULL DEFAULT 0,
  `transaction_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permanent_disc`
--

LOCK TABLES `permanent_disc` WRITE;
/*!40000 ALTER TABLE `permanent_disc` DISABLE KEYS */;
INSERT INTO `permanent_disc` VALUES (5,23.00,232,23,232.00,1,'2024-05-08 05:23:08','2024-05-10 21:52:46','232','Lee','0779755462',1,'2024-05-19 02:18:30'),(7,23.00,232,23,232.00,1,'2024-05-11 05:05:00','2024-05-11 05:05:00','232','Lee','0779755462',2,'2024-05-19 02:18:30'),(8,23.00,232,23,232.00,1,'2024-05-18 22:18:33','2024-05-18 22:18:33','jkljkljkljkl','Lee','0779755462',1,'2024-05-23 00:00:00'),(9,23.00,232,23,232.00,1,'2024-05-18 22:19:59','2024-05-18 22:19:59','jkljkljkljkl','Lee','0779755462',1,'2024-05-23 00:00:00');
/*!40000 ALTER TABLE `permanent_disc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rtgs`
--

DROP TABLE IF EXISTS `rtgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rtgs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_type` int(11) NOT NULL,
  `amount` double(50,2) NOT NULL DEFAULT 0.00,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `expected_amount` varchar(255) DEFAULT '0',
  `rate` varchar(255) DEFAULT '0',
  `transaction_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rtgs`
--

LOCK TABLES `rtgs` WRITE;
/*!40000 ALTER TABLE `rtgs` DISABLE KEYS */;
INSERT INTO `rtgs` VALUES (3,2,200.00,'Lee test','+27611778262','232',1,'2024-05-16 11:43:41','2024-05-18 22:09:57','Z212','0','0','2024-05-31 00:00:00'),(6,1,100.00,'Lee','+27611778262','232',1,'2024-05-16 12:47:42','2024-05-16 12:47:42','Domain Name Registration (.co.za)','2','0','2024-05-19 02:00:20'),(7,2,10.00,'Lee Kaliyati','0779755462','Heya these are my notes',1,'2024-05-16 12:49:21','2024-05-16 12:49:21','Domain Name Registration (.co.za)','10','0','2024-05-19 02:00:20'),(8,1,100.00,'Lee','0779755462','Heya these are my notes',1,'2024-05-18 22:01:57','2024-05-18 22:01:57','Domain Name Registration (.co.za)','12','0','2024-05-19 02:01:57'),(9,1,100.00,'Developer','0779755462','Heya these are my notes',1,'2024-05-18 22:05:04','2024-05-18 22:05:04','Webhosting for period 1 March 2023 to 31 May 2023','12','0','2024-05-21 00:00:00'),(10,1,100.00,'Developer','0779755462','Heya these are my notes',1,'2024-05-18 22:05:11','2024-05-18 22:05:11','Webhosting for period 1 March 2023 to 31 May 2023','0','0','2024-05-21 00:00:00'),(11,1,100.00,'Developer','0779755462','Heya these are my notes',1,'2024-05-18 22:05:50','2024-05-18 22:05:50','Webhosting for period 1 March 2023 to 31 May 2023','10','0','2024-05-21 00:00:00');
/*!40000 ALTER TABLE `rtgs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rtgs_transaction_type`
--

DROP TABLE IF EXISTS `rtgs_transaction_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rtgs_transaction_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rtgs_transaction_type`
--

LOCK TABLES `rtgs_transaction_type` WRITE;
/*!40000 ALTER TABLE `rtgs_transaction_type` DISABLE KEYS */;
INSERT INTO `rtgs_transaction_type` VALUES (1,'Ecocash',1,'2024-02-29 20:53:07','2024-02-29 20:53:07'),(2,'Swipe',1,'2024-02-29 20:53:07','2024-02-29 20:53:07'),(3,'Airtime',1,'2024-02-29 20:53:07','2024-02-29 20:53:07'),(4,'OneMoney',1,'2024-02-29 20:53:07','2024-02-29 20:53:07'),(5,'ZESA',1,'2024-02-29 20:53:07','2024-02-29 20:53:07'),(6,'Float/Buy RTGS',1,'2024-03-22 12:33:15','2024-03-22 12:33:15');
/*!40000 ALTER TABLE `rtgs_transaction_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone1` varchar(255) NOT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_phone_unique` (`phone1`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Leon','0771716528',NULL,'$2y$10$ejPgXHO5MtQdDA0Xb6JMNOrzfxHjurx8a4UdAqmt2f6HBxsp1/CgG','2024-01-29 12:31:47','2024-01-29 12:31:47',1),(2,'Muzanya','0772473181','0191292','$2y$10$ejPgXHO5MtQdDA0Xb6JMNOrzfxHjurx8a4UdAqmt2f6HBxsp1/CgG','2024-02-13 17:30:45','2024-02-13 17:30:45',1),(4,'Valentine Njowa','263778842255',NULL,'$2y$10$ejPgXHO5MtQdDA0Xb6JMNOrzfxHjurx8a4UdAqmt2f6HBxsp1/CgG','2024-03-03 10:04:50','2024-03-03 10:04:50',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_class`
--

DROP TABLE IF EXISTS `vehicle_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_class` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_class`
--

LOCK TABLES `vehicle_class` WRITE;
/*!40000 ALTER TABLE `vehicle_class` DISABLE KEYS */;
INSERT INTO `vehicle_class` VALUES (5,'Commuter Ominibus',1,23.00,'2024-03-03 10:07:16','2024-05-18 13:06:09'),(6,'Haulage Vehicles',2,0.00,'2024-03-03 10:07:16','2024-03-03 10:07:16'),(7,'Haulage Trailers',2,0.00,'2024-03-03 10:07:16','2024-03-03 10:07:16'),(8,'Buses',2,0.00,'2024-03-03 10:07:16','2024-03-03 10:07:16'),(9,'Small trailers',2,0.00,'2024-03-03 10:07:16','2024-03-03 10:07:16'),(10,'Motor bikes',2,0.00,'2024-03-03 10:07:16','2024-03-03 10:07:16'),(11,'Special types',2,0.00,'2024-03-03 10:07:16','2024-03-03 10:07:16'),(12,'Properties',2,0.00,'2024-03-03 10:07:16','2024-03-03 10:07:16'),(13,'Others',3,100.00,'2024-03-03 10:07:16','2024-05-13 12:41:23');
/*!40000 ALTER TABLE `vehicle_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zinara_transaction`
--

DROP TABLE IF EXISTS `zinara_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zinara_transaction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_by` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `reg_no` varchar(255) DEFAULT NULL,
  `expiry_date` date NOT NULL,
  `amount_paid` varchar(255) DEFAULT '0',
  `expected_amount` varchar(255) DEFAULT '0',
  `rate` double(8,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zinara_transaction`
--

LOCK TABLES `zinara_transaction` WRITE;
/*!40000 ALTER TABLE `zinara_transaction` DISABLE KEYS */;
INSERT INTO `zinara_transaction` VALUES (3,1,3,'yiuhh','0777555222','aad5555','2024-06-30','15','348000',210000.00,NULL,'2024-03-16 17:41:24','2024-03-16 17:41:24');
/*!40000 ALTER TABLE `zinara_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zinara_transaction_type`
--

DROP TABLE IF EXISTS `zinara_transaction_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zinara_transaction_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zinara_transaction_type`
--

LOCK TABLES `zinara_transaction_type` WRITE;
/*!40000 ALTER TABLE `zinara_transaction_type` DISABLE KEYS */;
INSERT INTO `zinara_transaction_type` VALUES (1,'Online Ecocash',1,NULL,'2024-02-29 20:32:01','2024-02-29 20:53:07'),(2,'Swipe RTGS',1,NULL,'2024-02-29 20:32:01','2024-02-29 20:53:07'),(3,'USD Cash',1,NULL,'2024-02-29 20:32:01','2024-02-29 20:53:07'),(4,'USD Eocash Online',1,NULL,'2024-02-29 20:32:01','2024-02-29 20:53:07');
/*!40000 ALTER TABLE `zinara_transaction_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-11 20:23:36
