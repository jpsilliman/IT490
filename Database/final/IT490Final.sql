-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: IT490DB
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1-log

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
-- Table structure for table `Likes`
--

DROP TABLE IF EXISTS `Likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Likes` (
  `URI` varchar(64) NOT NULL,
  `UserName` varchar(32) NOT NULL,
  `Likes` tinyint(1) NOT NULL,
  `Dislike` tinyint(1) NOT NULL,
  PRIMARY KEY (`URI`,`UserName`),
  KEY `Username` (`UserName`),
  CONSTRAINT `Likes_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `logins` (`UserName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Likes`
--

LOCK TABLES `Likes` WRITE;
/*!40000 ALTER TABLE `Likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `Likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Lists`
--

DROP TABLE IF EXISTS `Lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Lists` (
  `UserName` varchar(32) NOT NULL,
  `List` json DEFAULT NULL,
  PRIMARY KEY (`UserName`),
  CONSTRAINT `Lists_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `logins` (`UserName`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Lists`
--

LOCK TABLES `Lists` WRITE;
/*!40000 ALTER TABLE `Lists` DISABLE KEYS */;
INSERT INTO `Lists` VALUES ('gary',NULL),('harry',NULL),('jerry',NULL),('kyl293',NULL),('marty',NULL),('rich',NULL),('tj',NULL);
/*!40000 ALTER TABLE `Lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pantry`
--

DROP TABLE IF EXISTS `Pantry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pantry` (
  `UserName` varchar(64) NOT NULL,
  `Item` varchar(64) NOT NULL,
  `Amount` int(16) NOT NULL,
  `Unit` varchar(64) NOT NULL COMMENT 'ABSOLUTE',
  PRIMARY KEY (`UserName`,`Item`),
  CONSTRAINT `Pantry_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `logins` (`UserName`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pantry`
--

LOCK TABLES `Pantry` WRITE;
/*!40000 ALTER TABLE `Pantry` DISABLE KEYS */;
INSERT INTO `Pantry` VALUES ('harry','honey',1,'oz'),('jerry','apples',6,'apples'),('jerry','beef',3,'oz'),('jerry','garlic',17,'cloves'),('jerry','honey',1,'oz'),('jerry','liver',4,'lbs'),('jerry','persimmon',4,'tsp'),('jerry','turkey',12,'lbs'),('kyl293','Beef',4,'oz'),('kyl293','cheese',1,'lb'),('kyl293','tomato soup',1,'can'),('rich','bread',2,'loaves'),('rich','mustard',1,'gallon'),('rich','oranges',5,'oranges'),('rich','pork chops',8,'oz'),('rich','potatoes',5,'potatoes'),('rich','tuna',16,'cans'),('rich','turkey',20,'lbs'),('rich','vanilla extract',4,'oz'),('tj','Pumpkin',1,'Absolute');
/*!40000 ALTER TABLE `Pantry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Preferences`
--

DROP TABLE IF EXISTS `Preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Preferences` (
  `UserName` varchar(32) NOT NULL COMMENT 'User Name linked by logins',
  `Balanced` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Protein/Fat/Carb values in 15/35/50 ratio',
  `High-Fiber` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'More than 5g fiber per serving',
  `High-Protein` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'More than 50% of total calories from proteins',
  `Low-Carb` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Less than 20% of total calories from carbs',
  `Low-Fat` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Less than 15% of total calories from fat',
  `Low-Sodium` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Less than 140mg Na per serving',
  `Alcohol-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No alcohol used or contained',
  `Celery-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain celery or derivatives',
  `Crustacean-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain crustaceans (shrimp, lobster etc.) or derivatives',
  `Dairy` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No dairy; no lactose',
  `Eggs` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No eggs or products containing eggs',
  `Fish` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No fish or fish derivatives',
  `Gluten` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No ingredients containing gluten',
  `Kidney-friendly` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'per serving – phosphorus less than 250 mg AND potassium less than 500 mg AND sodium: less than 500 mg',
  `Kosher` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'contains only ingredients allowed by the kosher diet. However it does not guarantee kosher preparation of the ingredients themselves',
  `Low-potassium` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Less than 150mg per serving',
  `Lupine-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain lupine or derivatives',
  `Mustard-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain mustard or derivatives',
  `No-oil-added` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No oil added except to what is contained in the basic ingredients',
  `No-sugar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '	No simple sugars – glucose, dextrose, galactose, fructose, sucrose, lactose, maltose',
  `Paleo` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Excludes what are perceived to be agricultural products; grains, legumes, dairy products, potatoes, refined salt, refined sugar, and processed oils',
  `Peanuts` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No peanuts or products containing peanuts',
  `Pescatarian` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Does not contain meat or meat based products, can contain dairy and fish',
  `Pork-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain pork or derivatives',
  `Red-meat-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain beef, lamb, pork, duck, goose, game, horse, and other types of red meat or products containing red meat.',
  `Sesame-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'does not contain sesame seed or derivatives',
  `Shellfish` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No shellfish or shellfish derivatives',
  `Soy` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No soy or products containing soy',
  `Sugar-conscious` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Less than 4g of sugar per serving',
  `Tree Nuts` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No tree nuts or products containing tree nuts',
  `Vegan` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No meat, poultry, fish, dairy, eggs or honey',
  `Vegetarian` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No meat, poultry, or fish',
  `Wheat-free` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'No wheat, can have gluten though',
  PRIMARY KEY (`UserName`),
  CONSTRAINT `Preferences_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `logins` (`UserName`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Preferences`
--

LOCK TABLES `Preferences` WRITE;
/*!40000 ALTER TABLE `Preferences` DISABLE KEYS */;
INSERT INTO `Preferences` VALUES ('gary',0,0,0,0,1,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0),('harry',0,0,0,1,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,1,0,1),('jerry',1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,1,0,0,0),('kyl293',1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0),('marty',0,0,1,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,1,1,0,0,0),('rich',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),('tj',0,0,1,0,0,0,1,0,0,0,0,0,0,1,0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0);
/*!40000 ALTER TABLE `Preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logins`
--

DROP TABLE IF EXISTS `logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logins` (
  `firstName` varchar(32) DEFAULT NULL,
  `LastName` varchar(32) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `UserName` varchar(32) NOT NULL,
  `Password` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`UserName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logins`
--

LOCK TABLES `logins` WRITE;
/*!40000 ALTER TABLE `logins` DISABLE KEYS */;
INSERT INTO `logins` VALUES ('Gary','Pineapple','gary@pineapple.com','gary','pineapple'),('When Harry','Met Sally','harry@sally.net','harry','sally'),('Jerry','Lewis','jerrylewis@famousis.me','jerry','lewis'),('kyle ','middleton','km656@njit.edu','kyl293','Id24'),('Marty','Fish','martyfish@fishman.com','marty','fish'),('Richard','Matthew','richard@matthew.com','rich','matt'),('pat','mat','matpat@cat.sat','satpat','1234'),('tj','wagner','imsofedupwiththisshit@donewith.it','tj','wags');
/*!40000 ALTER TABLE `logins` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-16 23:52:51
