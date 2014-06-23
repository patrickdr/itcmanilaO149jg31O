-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: itc_manila
-- ------------------------------------------------------
-- Server version	5.5.16

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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `source_name` varchar(45) NOT NULL,
  `source_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` VALUES (21,'AAAABBBBCCCCDDDD','sellers',1,'2014-05-04 11:14:33','2014-05-04 11:25:11'),(23,'U2107 88 CORPORATE CENTER SEDENO ST COR VALERO SALCEDO VILL MAKATI CITY','buyers',94,'2014-05-04 11:51:29','2014-05-04 11:51:29'),(24,'RM 231 DELA ROSA CONDO DELA ROSA ST MAKATI CITY','buyers',95,'2014-05-04 11:51:29','2014-05-04 11:51:29'),(25,'2/F METRO HOUSE 345 SEN GIL PUYAT AVE MAKATI CITY','buyers',96,'2014-05-04 11:51:29','2014-05-04 11:51:29'),(82,'','sellers',3,'2014-05-29 15:24:06','2014-05-29 15:24:06'),(83,'','sellers',5,'2014-05-29 15:25:00','2014-05-29 15:25:00'),(92,' 1012-E Services Atbp. Ground Floor, Festival Mall, Festival Corporate City, Alabang, Muntinlupa City','itineraries',71,'2014-06-04 15:30:04','2014-06-04 15:30:04'),(93,'QFI BLDG                        \nMULTINATIONAL AVENUE MOONWALK   PARANAQUE CITY  1704','itineraries',72,'2014-06-04 15:30:04','2014-06-04 15:30:04'),(94,'M.EUSEBIO AVE. SAN MIGUEL   \nUNIT 14 ARMAL COMPD. 2      \nPASIG 1600','itineraries',73,'2014-06-04 15:30:04','2014-06-04 15:30:04'),(95,'\nAbest Express\nRM. 4 Poblete Building #17 Gil Puyat Ave. Makati City\n\n','itineraries',74,'2014-06-04 15:30:04','2014-06-04 15:30:04'),(96,' 1012-E Services Atbp. Ground Floor, Festival Mall, Festival Corporate City, Alabang, Muntinlupa City','itineraries',75,'2014-06-04 15:30:25','2014-06-04 15:30:25'),(97,'QFI BLDG                        \nMULTINATIONAL AVENUE MOONWALK   PARANAQUE CITY  1704','itineraries',76,'2014-06-04 15:30:25','2014-06-04 15:30:25'),(98,'M.EUSEBIO AVE. SAN MIGUEL   \nUNIT 14 ARMAL COMPD. 2      \nPASIG 1600','itineraries',77,'2014-06-04 15:30:25','2014-06-04 15:30:25'),(99,'\nAbest Express\nRM. 4 Poblete Building #17 Gil Puyat Ave. Makati City\n\n','itineraries',78,'2014-06-04 15:30:25','2014-06-04 15:30:25');
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'ANTIPOLO1','ANTIPOLO1',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(2,'BATANGAS1','BATANGAS',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(3,'CAMANA1','MALABON NAVOTAS LOWER CALOOCAN',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(4,'CAMANA2','UPPER CALOOCAN',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(5,'CAVITE FAR','ROSARIO/NAIC/ CAVITE CITY/SANGLEY',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(6,'CAVITE NEAR','DASMA/TRECE MAR/BACOOR/IMUS/CARMONA/SILANG',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(7,'LAGUNA BINAN TECHNO','BINAN/ TECHNOPARK/ STA ROSA',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(8,'LAGUNA CALMBA CNLBNG','LAGUNA CALAMBA/CANLUBANG ',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(9,'LASPINAS1','GULAYAN AREA',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(10,'MANDA1','MANDALUYONG',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(11,'MARIKINA1','MARIKINA',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(12,'MKT AMORSOLO','AMOROSLO / SALCEDO STREETS - LEGASPI VILLAGE',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(13,'MKT ARNAIZ AVE','ARNAIZ AVE/ SAN LO VILLAGE',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(14,'MKT AYALA','MAKATI AYALA',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(15,'MKT BANGKAL','BANGKAL MAGALLANES',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(16,'MKT DASMA','DASMARINAS VILLAGE',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(17,'MKT GIL PUYAT','GIL PUYAT',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(18,'MKT GUADALUPE','GUADALUPE',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(19,'MKT LEGASPI ','LEGASPI VILLAGE',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(20,'MKT PALANAN','PALANAN SAN ISIDRO ETC',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(21,'MKT PASONG TAMO','PASONG TAMO',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(22,'MKT POBLACION','MAKATI POBLACION',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(23,'MKT SALCEDO VILL','SALCEDO VILLAGE',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(24,'MLA BNDO STA CRUZ','BINONDO /STA CRUZ',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(25,'MLA ERMITA ETC','ERMITA MALATE KALAW TAFT VITO CRUZ (AMORGANDA)',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(26,'MLA INTRM  PORT ETC','QUIAPO PORT AREA INTRAMUROS (CRISTOBAL)',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(27,'MLA MALATE','MALATE AREAS',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(28,'MLA TONDO','TONDO',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(29,'MUNTI1','MUNTINLUPA',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(30,'OSA','OUT OF SCOPE',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(31,'PASAY1','PASAY',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(32,'PASIG 1','CANETE AREAS',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(33,'PASIG 2','KAPASIGAN',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(34,'PASIG 3','PART 2 OF ORTIGAS COMML',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(35,'PQUE1','DEPLOMO AREAS (BF TAHANAN WVC RD VILLAGES)',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(36,'PQUE2','DE LA PAZ AREAS (AIRPORT SUCAT ETC)',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(37,'QC1','LAGRIA AREA',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(38,'QC2','CUBAO/PROJ 2 / 3/ 4/ EM-EM TEACHERS',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(39,'QC3','PROJECT 6 / 8 / TANDANG SORA',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(40,'QC4','TIERRA PURA PSSC COMMONWEALTH',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(41,'QC5','LOYOLA HTS GREEN MEADOWS CORINTHIAN GRNMDWS',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(42,'QC6','BATASAN FAIRVIEW BALARA',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(43,'QC7','NOVALICHES',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(44,'QUEZON PROVINCE','QUEZON PROVICE',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(45,'RIZAL1','NEAR RIZAL (CAINTA/TAYTAY/ANTIPOLO)',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(46,'RIZAL2','FAR RIZAL (BINANGONAN, SAN MATEO ETC)',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(47,'SAN JUAN','SAN JUAN',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(48,'SANJUAN1','SAN JUAN',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(49,'TAGUIG1','TAGUIG PATEROS',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26'),(50,'VALEN1','VALENZUELA',NULL,NULL,'2014-04-26 14:56:26','2014-04-26 14:56:26');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buyers`
--

DROP TABLE IF EXISTS `buyers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buyers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `code` varchar(45) NOT NULL,
  `customer_buyer_code` varchar(45) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(45) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_buyers_customers1_idx` (`customer_id`),
  KEY `fk_buyers_areas1_idx` (`area_id`),
  CONSTRAINT `fk_buyers_areas1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_buyers_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buyers`
--

LOCK TABLES `buyers` WRITE;
/*!40000 ALTER TABLE `buyers` DISABLE KEYS */;
INSERT INTO `buyers` VALUES (94,3,23,1,'209985683','209985683','HELLERMANNTYTON ASIA PACIFIC',NULL,NULL,'2014-05-04 11:51:29','2014-05-04 11:51:29'),(95,3,17,1,'210019200','210019200','ELISAN INT\'L CORP',NULL,NULL,'2014-05-04 11:51:29','2014-05-04 11:51:29'),(96,3,17,1,'210088768','210088768','TRICOM SYSTEMS PHILS INC',NULL,NULL,'2014-05-04 11:51:29','2014-05-04 11:51:29'),(97,3,4,4,'189490984',NULL,' SUNPOWER PHILS MFTG LTD -MODCO','Imelda Novela ','2 849 4600 ext. 30718 / 09175978498','2014-05-18 08:36:03','2014-05-18 08:36:03'),(98,3,1,4,'246887845',NULL,'QUICKFLO FORWARDERS INC','Ms Sheena ','6328227151 ext 123  ','2014-05-18 08:37:16','2014-05-18 08:37:16'),(99,3,15,4,'179101750',NULL,'PERROQUET BLEU CORPORATION','Ms Jessa - Releasing ','02 654-3612','2014-05-18 08:42:39','2014-05-18 08:42:39'),(100,3,14,4,'320486483',NULL,'ASTEC INTL LTD PHIL BRANCH','Dennis M. Camaymayan ','| T +632.687.6615 x767 ','2014-05-18 08:44:29','2014-05-18 08:44:29'),(101,3,1,1,'CAMERA HAUS',NULL,'CAMERA HAUS','','','2014-05-29 15:25:37','2014-05-29 15:25:37'),(102,3,1,1,'CAMERA HAUS 2',NULL,'CAMHAUS','','','2014-05-29 15:43:09','2014-05-29 15:43:09'),(103,3,1,5,'CAMERA HAUS3',NULL,'CAMHAUS3','','','2014-05-29 15:47:14','2014-05-29 15:47:14');
/*!40000 ALTER TABLE `buyers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collections`
--

DROP TABLE IF EXISTS `collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_type` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_collections_lookups1_idx` (`collection_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collections`
--

LOCK TABLES `collections` WRITE;
/*!40000 ALTER TABLE `collections` DISABLE KEYS */;
/*!40000 ALTER TABLE `collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `collectors`
--

DROP TABLE IF EXISTS `collectors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collectors`
--

LOCK TABLES `collectors` WRITE;
/*!40000 ALTER TABLE `collectors` DISABLE KEYS */;
INSERT INTO `collectors` VALUES (1,'Juan Castrence','Juan-01','4685298','2014-05-04 12:08:53','2014-05-04 12:08:53');
/*!40000 ALTER TABLE `collectors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `contact_person` varchar(45) DEFAULT NULL,
  `contact_number` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_customers_areas1_idx` (`area_id`),
  CONSTRAINT `fk_customers_areas1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (2,NULL,'ABS CBN','ABS','',8417709,'2014-04-26 15:34:48','2014-04-26 15:36:20'),(3,NULL,'CITIBANK','CITI','',8947245,'2014-04-26 15:39:13','2014-04-26 15:39:13');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itineraries`
--

DROP TABLE IF EXISTS `itineraries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itineraries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `reason_id` int(11) NOT NULL,
  `result_status` int(11) DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `itinerary_type` varchar(45) DEFAULT NULL,
  `trip_type` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `trip_number` int(11) DEFAULT NULL,
  `address` text,
  `mm_provl` varchar(45) DEFAULT NULL,
  `itinerary_number` int(11) DEFAULT NULL,
  `remarks` text,
  `amount` decimal(16,2) DEFAULT NULL,
  `requestor` varchar(45) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `contact_person` varchar(45) DEFAULT NULL,
  `date_received` datetime DEFAULT NULL,
  `acknowledged_receipt` varchar(45) DEFAULT NULL,
  `acknowledged_date` date DEFAULT NULL,
  `acknowledged_by` varchar(45) DEFAULT NULL,
  `collector_remarks` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_itineraries_customers1_idx` (`customer_id`),
  KEY `fk_itineraries_sellers1_idx` (`seller_id`),
  KEY `fk_itineraries_buyers1_idx` (`buyer_id`),
  KEY `fk_itineraries_reasons1_idx` (`reason_id`),
  CONSTRAINT `fk_itineraries_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_itineraries_reasons1` FOREIGN KEY (`reason_id`) REFERENCES `reasons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_itineraries_sellers1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itineraries`
--

LOCK TABLES `itineraries` WRITE;
/*!40000 ALTER TABLE `itineraries` DISABLE KEYS */;
INSERT INTO `itineraries` VALUES (71,97,3,5,3,2,15,NULL,'PC',NULL,NULL,NULL,'MMLA',123859,'Collection time:10-4pm ',1589303.25,'Mirasol','/ 2 849 4600 ext. 30718 / 09175978498','Imelda Novela ','2014-06-04 00:00:00','sdfsdf','2014-06-03','Patrick','uttewfwe','2014-06-04 15:30:04','2014-06-07 10:30:19'),(72,98,3,5,3,1,15,NULL,'PC',NULL,NULL,NULL,'MMLA',123859,'',NULL,'CHELE','6328227151 ext 123  ','Ms Sheena ','2014-06-04 00:00:00','0122547','2014-06-23','Patrick','Hey you!','2014-06-04 15:30:04','2014-06-23 05:32:49'),(73,99,3,5,0,NULL,NULL,NULL,'PC',NULL,NULL,NULL,'MMLA',123859,'',48031.45,'CHELE','02 654-3612','Ms Jessa - Releasing ','2014-06-04 00:00:00',NULL,NULL,NULL,NULL,'2014-06-04 15:30:04','2014-06-04 15:30:04'),(74,100,3,5,0,NULL,NULL,NULL,'   ',NULL,NULL,NULL,'MMLA',123859,'Please collect for the following companies\n320486483 ASTEC INTL LTD PHIL BRANCH\n320486920 ASTEC INTL LTD PHIL BRANCH\n180939369 ASTEC POWER PHILS INC\n320487463 ASTEC POWER PHILS INC\n320487587 ASTEC POWER PHILS INC\n320487587 ASTEC POWER PHILS INC\n180939369 ASTEC POWER PHILS INC\n386585563 ASTEC POWER PHILS INC-LAGUNA',NULL,'Abigail','| T +632.687.6615 x767 ','Dennis M. Camaymayan ','2014-06-04 00:00:00',NULL,NULL,NULL,NULL,'2014-06-04 15:30:04','2014-06-04 15:30:04'),(75,97,3,5,0,NULL,NULL,NULL,'PC',NULL,NULL,NULL,'MMLA',123859,'Collection time:10-4pm ',1589303.25,'Mirasol','/ 2 849 4600 ext. 30718 / 09175978498','Imelda Novela ','2014-06-04 00:00:00',NULL,NULL,NULL,NULL,'2014-06-04 15:30:25','2014-06-04 15:30:25'),(76,98,3,5,0,NULL,NULL,NULL,'PC',NULL,NULL,NULL,'MMLA',123859,'',NULL,'CHELE','6328227151 ext 123  ','Ms Sheena ','2014-06-04 00:00:00',NULL,NULL,NULL,NULL,'2014-06-04 15:30:25','2014-06-04 15:30:25'),(77,99,3,5,0,NULL,15,NULL,'PC',NULL,NULL,NULL,'MMLA',123859,'',48031.45,'CHELE','02 654-3612','Ms Jessa - Releasing ','2014-06-04 00:00:00',NULL,NULL,NULL,NULL,'2014-06-04 15:30:25','2014-06-04 15:30:25'),(78,100,3,5,0,NULL,NULL,NULL,'   ',NULL,NULL,NULL,'MMLA',123859,'Please collect for the following companies\n320486483 ASTEC INTL LTD PHIL BRANCH\n320486920 ASTEC INTL LTD PHIL BRANCH\n180939369 ASTEC POWER PHILS INC\n320487463 ASTEC POWER PHILS INC\n320487587 ASTEC POWER PHILS INC\n320487587 ASTEC POWER PHILS INC\n180939369 ASTEC POWER PHILS INC\n386585563 ASTEC POWER PHILS INC-LAGUNA',NULL,'Abigail','| T +632.687.6615 x767 ','Dennis M. Camaymayan ','2014-06-04 00:00:00',NULL,NULL,NULL,NULL,'2014-06-04 15:30:25','2014-06-04 15:30:25');
/*!40000 ALTER TABLE `itineraries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lookup_tables`
--

DROP TABLE IF EXISTS `lookup_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lookup_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `table` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lookup_tables`
--

LOCK TABLES `lookup_tables` WRITE;
/*!40000 ALTER TABLE `lookup_tables` DISABLE KEYS */;
/*!40000 ALTER TABLE `lookup_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lookups`
--

DROP TABLE IF EXISTS `lookups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lookups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `lookup_table_id` int(11) NOT NULL,
  `create` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lookup_values_lookups_idx` (`lookup_table_id`),
  CONSTRAINT `fk_lookup_values_lookups` FOREIGN KEY (`lookup_table_id`) REFERENCES `lookup_tables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lookups`
--

LOCK TABLES `lookups` WRITE;
/*!40000 ALTER TABLE `lookups` DISABLE KEYS */;
/*!40000 ALTER TABLE `lookups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `official_receipts`
--

DROP TABLE IF EXISTS `official_receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `official_receipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collector_id` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `seller_affiliate_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `or_number` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_official_receipts_sellers1_idx` (`seller_id`),
  KEY `fk_official_receipts_customers1_idx` (`customer_id`),
  CONSTRAINT `fk_official_receipts_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_official_receipts_sellers1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `official_receipts`
--

LOCK TABLES `official_receipts` WRITE;
/*!40000 ALTER TABLE `official_receipts` DISABLE KEYS */;
INSERT INTO `official_receipts` VALUES (54,1,1,5,3,'AB000009',3,'2014-06-13','2014-06-13 09:23:15','2014-06-15 13:44:04'),(55,1,1,5,3,'AB000010',5,'2014-06-13','2014-06-13 09:23:15','2014-06-21 13:20:42'),(56,1,1,5,3,'AB000011',5,'2014-06-13','2014-06-13 09:23:15','2014-06-21 13:20:42'),(57,1,1,5,3,'AB000012',5,'2014-06-13','2014-06-13 09:23:15','2014-06-21 13:20:42'),(58,1,1,5,3,'AB000013',5,'2014-06-13','2014-06-13 09:23:16','2014-06-21 13:20:42'),(59,1,1,5,3,'AB000014',4,'2014-06-13','2014-06-13 09:23:16','2014-06-21 12:08:57'),(60,1,1,5,3,'AB000015',4,'2014-06-13','2014-06-13 09:23:16','2014-06-21 12:08:57'),(61,1,1,5,3,'AB000016',4,'2014-06-13','2014-06-13 09:23:16','2014-06-21 12:08:57'),(62,1,1,5,3,'AB000017',4,'2014-06-13','2014-06-13 09:23:16','2014-06-21 12:08:57'),(63,1,1,5,3,'AB000018',4,'2014-06-13','2014-06-13 09:23:16','2014-06-21 12:08:57'),(64,1,1,5,3,'AB000019',4,'2014-06-13','2014-06-13 09:23:16','2014-06-21 12:08:57'),(65,1,1,5,3,'AB000020',4,'2014-06-13','2014-06-13 09:23:16','2014-06-21 12:08:57'),(66,1,1,5,3,'AB000021',4,'2014-06-13','2014-06-13 09:23:16','2014-06-21 12:08:57'),(67,1,1,5,3,'ABC000009',4,'2014-06-13','2014-06-13 09:31:51','2014-06-21 12:08:57'),(68,NULL,1,5,3,'CBC000009',1,'2014-06-15','2014-06-15 13:27:35','2014-06-15 13:27:35'),(69,NULL,1,5,3,'CBC000010',1,'2014-06-15','2014-06-15 13:27:35','2014-06-15 13:27:35'),(70,NULL,1,5,3,'CBC000011',1,'2014-06-15','2014-06-15 13:27:35','2014-06-15 13:27:35'),(71,NULL,1,5,3,'CBC000012',1,'2014-06-15','2014-06-15 13:27:35','2014-06-15 13:27:35'),(72,NULL,1,5,3,'CBC000013',1,'2014-06-15','2014-06-15 13:27:35','2014-06-15 13:27:35'),(73,NULL,1,5,3,'CBC000014',1,'2014-06-15','2014-06-15 13:27:35','2014-06-15 13:27:35'),(74,NULL,1,5,3,'CBC000015',1,'2014-06-15','2014-06-15 13:27:35','2014-06-15 13:27:35');
/*!40000 ALTER TABLE `official_receipts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reasons`
--

DROP TABLE IF EXISTS `reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reasons`
--

LOCK TABLES `reasons` WRITE;
/*!40000 ALTER TABLE `reasons` DISABLE KEYS */;
INSERT INTO `reasons` VALUES (1,'1','1',NULL,NULL),(2,'2','2',NULL,NULL),(3,'3','3',NULL,NULL),(4,'4','4',NULL,NULL),(5,'5','5',NULL,NULL),(6,'6','6',NULL,NULL),(7,'7','7',NULL,NULL),(8,'8','8',NULL,NULL);
/*!40000 ALTER TABLE `reasons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sellers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `code` varchar(45) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sellers_sellers1_idx` (`seller_id`),
  KEY `fk_sellers_customers1_idx` (`customer_id`),
  KEY `fk_sellers_areas1_idx` (`area_id`),
  CONSTRAINT `fk_sellers_areas1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sellers_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sellers_sellers1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sellers`
--

LOCK TABLES `sellers` WRITE;
/*!40000 ALTER TABLE `sellers` DISABLE KEYS */;
INSERT INTO `sellers` VALUES (1,3,15,'','CANON',NULL,'Makati City','2014-05-03 09:31:16','2014-05-04 11:25:11'),(3,3,2,'MOOSE12344','MOOSE GEAR',1,'Makati City','2014-05-04 11:34:24','2014-05-29 15:24:06'),(4,3,4,'FEDEX','FEDEX',NULL,'Paranaque City','2014-05-18 08:33:56','2014-05-18 08:33:56'),(5,3,1,'NIKON','NIKON',1,'','2014-05-29 14:28:12','2014-05-29 15:25:00');
/*!40000 ALTER TABLE `sellers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trip_areas`
--

DROP TABLE IF EXISTS `trip_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trip_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trips_has_areas_areas1_idx` (`area_id`),
  KEY `fk_trips_has_areas_trips1_idx` (`trip_id`),
  CONSTRAINT `fk_trips_has_areas_areas1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trips_has_areas_trips1` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trip_areas`
--

LOCK TABLES `trip_areas` WRITE;
/*!40000 ALTER TABLE `trip_areas` DISABLE KEYS */;
INSERT INTO `trip_areas` VALUES (18,15,4,'2014-06-04 15:31:06','2014-06-04 15:31:06'),(19,15,1,'2014-06-04 15:31:06','2014-06-04 15:31:06'),(20,15,4,'2014-06-04 15:31:56','2014-06-04 15:31:56'),(21,15,1,'2014-06-04 15:31:56','2014-06-04 15:31:56'),(22,15,15,'2014-06-04 15:31:56','2014-06-04 15:31:56');
/*!40000 ALTER TABLE `trip_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collector_id` int(11) NOT NULL,
  `trip_type` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_collectors_has_itineraries_collectors1_idx` (`collector_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trips`
--

LOCK TABLES `trips` WRITE;
/*!40000 ALTER TABLE `trips` DISABLE KEYS */;
INSERT INTO `trips` VALUES (15,1,'PC','2014-06-04 15:31:06','2014-06-04 15:31:56');
/*!40000 ALTER TABLE `trips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,'administrator','2014-04-13 08:43:45','2014-04-13 08:43:45');
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_user_types1_idx` (`user_type_id`),
  CONSTRAINT `fk_users_user_types1` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Patrick',1,1,'patrickdr0823@gmail.com','patrickdr0823','c0a0fd0a38642958d85cf0b3941fa27384715986','2014-04-13 09:15:08','2014-04-13 09:15:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-23 15:05:00
