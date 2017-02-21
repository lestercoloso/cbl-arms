-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: cblarms
-- ------------------------------------------------------
-- Server version	5.6.33-0ubuntu0.14.04.1

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
-- Table structure for table `Vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `vehicle_no` varchar(225) DEFAULT NULL,
  `vehicle_desc` varchar(255) DEFAULT NULL,
  `plate_no` varchar(225) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vehicle`
--

LOCK TABLES `Vehicle` WRITE;
/*!40000 ALTER TABLE `Vehicle` DISABLE KEYS */;
INSERT INTO `Vehicle` VALUES (1,'123','123','123','1','Status A'),(2,'321','321','321','2','Status B');
/*!40000 ALTER TABLE `Vehicle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bay_storage`
--

DROP TABLE IF EXISTS `bay_storage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bay_storage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` int(225) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bay_length` int(225) DEFAULT NULL,
  `bay_width` int(225) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `style` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bay_storage`
--

LOCK TABLES `bay_storage` WRITE;
/*!40000 ALTER TABLE `bay_storage` DISABLE KEYS */;
/*!40000 ALTER TABLE `bay_storage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bill_of_lading`
--

DROP TABLE IF EXISTS `bill_of_lading`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bill_of_lading` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) DEFAULT NULL,
  `book_id` bigint(20) DEFAULT NULL,
  `bill_no` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `shipper_information` varchar(2000) DEFAULT NULL,
  `package_content` varchar(2000) DEFAULT NULL,
  `charges` varchar(45) DEFAULT NULL,
  `additional_charges` varchar(2000) DEFAULT NULL,
  `recipient_information` varchar(2000) DEFAULT NULL,
  `others` varchar(2000) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `recipient` varchar(255) DEFAULT NULL,
  `shipper` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill_of_lading`
--

LOCK TABLES `bill_of_lading` WRITE;
/*!40000 ALTER TABLE `bill_of_lading` DISABLE KEYS */;
/*!40000 ALTER TABLE `bill_of_lading` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `booking_no` int(10) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `customer_name` varchar(225) DEFAULT NULL,
  `contact_person` varchar(225) DEFAULT NULL,
  `department` varchar(225) DEFAULT NULL,
  `contact_id` int(20) DEFAULT NULL,
  `address` varchar(775) DEFAULT NULL,
  `area` varchar(225) DEFAULT NULL,
  `mode_of_shipping` varchar(225) DEFAULT NULL,
  `vehicle_type` varchar(225) DEFAULT NULL,
  `driver` varchar(255) DEFAULT NULL,
  `driver_id` int(10) DEFAULT NULL,
  `plate_no` varchar(20) DEFAULT NULL,
  `booking_status` varchar(255) DEFAULT NULL,
  `time_called` varchar(10) DEFAULT NULL,
  `special_instruction` varchar(1000) DEFAULT NULL,
  `date_ready` datetime DEFAULT NULL,
  `document` varchar(10) DEFAULT NULL,
  `weight` decimal(20,5) DEFAULT NULL,
  `length` decimal(20,5) DEFAULT NULL,
  `width` decimal(20,5) DEFAULT NULL,
  `height` decimal(20,5) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `contact` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_no` (`booking_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_address`
--

DROP TABLE IF EXISTS `customer_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_address` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address_type` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_address`
--

LOCK TABLES `customer_address` WRITE;
/*!40000 ALTER TABLE `customer_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_contact`
--

DROP TABLE IF EXISTS `customer_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_contact` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `middle_initial` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_contact`
--

LOCK TABLES `customer_contact` WRITE;
/*!40000 ALTER TABLE `customer_contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_information`
--

DROP TABLE IF EXISTS `customer_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_information` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_code` int(10) DEFAULT NULL,
  `customer_type` int(10) DEFAULT NULL,
  `customer_name` varchar(225) DEFAULT NULL,
  `company_anniversary` date DEFAULT NULL,
  `tel_no` varchar(225) DEFAULT NULL,
  `fax_no` varchar(225) DEFAULT NULL,
  `industry_type` varchar(225) DEFAULT NULL,
  `address` varchar(775) DEFAULT NULL,
  `tin_no` varchar(50) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `assistant_executive_1` bigint(20) DEFAULT NULL,
  `assistant_executive_2` bigint(20) DEFAULT NULL,
  `area_1` varchar(225) DEFAULT NULL,
  `area_2` varchar(225) DEFAULT NULL,
  `area_3` varchar(225) DEFAULT NULL,
  `area_4` varchar(225) DEFAULT NULL,
  `area_5` varchar(225) DEFAULT NULL,
  `region` varchar(225) DEFAULT NULL,
  `tax_type` bigint(20) DEFAULT NULL,
  `payment_terms` varchar(225) DEFAULT NULL,
  `preferred_supplier` bigint(20) DEFAULT NULL,
  `pricelist_ds` bigint(20) DEFAULT NULL,
  `pricelist_da` bigint(20) DEFAULT NULL,
  `pricelist_dt` bigint(20) DEFAULT NULL,
  `pricelist_is` bigint(20) DEFAULT NULL,
  `pricelist_ia` bigint(20) DEFAULT NULL,
  `pricelist_it` bigint(20) DEFAULT NULL,
  `follow_up_day` varchar(225) DEFAULT NULL,
  `collection_day` varchar(225) DEFAULT NULL,
  `billing_cycle` varchar(225) DEFAULT NULL,
  `credit_limit` varchar(225) DEFAULT NULL,
  `billing_format` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `customer_status` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_code` (`customer_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_information`
--

LOCK TABLES `customer_information` WRITE;
/*!40000 ALTER TABLE `customer_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver_profile`
--

DROP TABLE IF EXISTS `driver_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(225) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `age` int(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `vehicle_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver_profile`
--

LOCK TABLES `driver_profile` WRITE;
/*!40000 ALTER TABLE `driver_profile` DISABLE KEYS */;
INSERT INTO `driver_profile` VALUES (1,123,'Mon Carlo','1987-03-19',29,'taguig','Vehicle A','1'),(2,0,'','1970-01-01',0,'','','1'),(3,222,'Dwe','2016-12-01',0,'ARM Solutions','Vehicle B','1');
/*!40000 ALTER TABLE `driver_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_module`
--

DROP TABLE IF EXISTS `home_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_module` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_module`
--

LOCK TABLES `home_module` WRITE;
/*!40000 ALTER TABLE `home_module` DISABLE KEYS */;
INSERT INTO `home_module` VALUES (1,'Customer Information','customer_information','customer_info.png',1,1),(2,'Booking','booking','booking.png',1,2),(3,'Warehouse','warehouse','warehouse.png',1,3),(4,'Bill of Lading','bill_of_lading','bill_of_lading.png',1,4),(5,'Billing','','billing.png',1,5),(6,'Collection Call Out','','collection_call_out.png',1,6),(7,'Payment','','payments.png',1,7),(8,'Reports','','reports.png',1,8);
/*!40000 ALTER TABLE `home_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homepage`
--

DROP TABLE IF EXISTS `homepage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homepage` (
  `sel_id` int(255) NOT NULL AUTO_INCREMENT,
  `sel_name` varchar(255) DEFAULT NULL,
  `sel_type` int(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `img_file` varchar(255) DEFAULT NULL,
  `wpage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homepage`
--

LOCK TABLES `homepage` WRITE;
/*!40000 ALTER TABLE `homepage` DISABLE KEYS */;
INSERT INTO `homepage` VALUES (1,'Customer Information',1,NULL,'Customer_Info','customerInfo'),(2,'Booking',1,NULL,'Booking','booking'),(3,'Warehouse',1,NULL,'Warehouse','warehouse'),(4,'Bill of Lading',1,NULL,'Bill_of_Lading','blading'),(5,'Billing',1,NULL,'billing','billing'),(6,'Collection Call Out',1,NULL,'Collection_Call_Out','collection'),(7,'Payment',1,NULL,'Payment','payment'),(8,'Reports',1,NULL,'Reports','reports');
/*!40000 ALTER TABLE `homepage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inbound`
--

DROP TABLE IF EXISTS `inbound`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inbound` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `client` varchar(255) DEFAULT NULL,
  `bill_of_blading` varchar(255) DEFAULT NULL,
  `delivery_receipt` varchar(255) DEFAULT NULL,
  `pallet_code` varchar(255) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `storage_type` varchar(255) DEFAULT NULL,
  `inventory_type` varchar(255) DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `pick_date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inbound`
--

LOCK TABLES `inbound` WRITE;
/*!40000 ALTER TABLE `inbound` DISABLE KEYS */;
INSERT INTO `inbound` VALUES (3,'Customer A','123456','123456','123456',1,'Description','Storage A','Inventory A','2016-11-10 00:00:00','2016-11-01 00:00:00','2016-11-19 00:00:00','inbound','2016-11-03 00:00:00'),(4,'Customer A','1234567','1234567','1234567',1234,'Inbound Desc1','Storage A','Inventory A','2016-11-10 00:00:00','2016-11-01 00:00:00','2016-11-19 00:00:00','inbound','2016-11-03 00:00:00'),(5,'','dsds','sds','212',1,'fgfgdfgdf','Storage A','Inventory A','1970-01-01 00:00:00','1970-01-01 00:00:00','2016-11-17 00:00:00','outbound','2016-11-04 00:00:00'),(6,'Customer A','bmbm','mnbmb','nmbmnb',0,'mnmnb','Storage A','Inventory A','2016-11-08 00:00:00','2016-11-01 00:00:00','2016-11-23 00:00:00','1','2016-11-10 00:00:00');
/*!40000 ALTER TABLE `inbound` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inbound_list`
--

DROP TABLE IF EXISTS `inbound_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inbound_list` (
  `id` bigint(20) NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `bill_of_lading` varchar(255) DEFAULT NULL,
  `delivery_receipt` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `invoice_no` int(45) DEFAULT NULL,
  `code` int(45) DEFAULT NULL,
  `storage` varchar(10) DEFAULT NULL,
  `type_of_shipment` tinyint(1) DEFAULT NULL,
  `rack_level` int(45) DEFAULT NULL,
  `pallet_code` int(10) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `storage_type` tinyint(1) DEFAULT NULL,
  `inventory_type` varchar(255) DEFAULT NULL,
  `ex_date` date DEFAULT NULL,
  `en_date` date DEFAULT NULL,
  `pu_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inbound_list`
--

LOCK TABLES `inbound_list` WRITE;
/*!40000 ALTER TABLE `inbound_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `inbound_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintenance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `particulars` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintenance`
--

LOCK TABLES `maintenance` WRITE;
/*!40000 ALTER TABLE `maintenance` DISABLE KEYS */;
INSERT INTO `maintenance` VALUES (1,'address_type','Home',1,'2017-02-21 17:37:22'),(2,'address_type','Business',1,'2017-02-21 17:37:22'),(3,'address_type','Billing',1,'2017-02-21 17:37:22'),(4,'address_type','Shipping',1,'2017-02-21 17:37:22'),(5,'address_type','Contact',1,'2017-02-21 17:37:22'),(6,'mode_of_shipping','Land Trip',1,'2017-02-21 17:37:22'),(7,'mode_of_shipping','Sea Freight',1,'2017-02-21 17:37:22'),(8,'mode_of_shipping','Air Freight',1,'2017-02-21 17:37:22'),(9,'booking_status','Cancelled Pick Up',1,'2017-02-21 17:37:22'),(10,'booking_status','For Monitoring',1,'2017-02-21 17:37:22'),(11,'industry_type','Accommodations',1,'2017-02-21 17:37:22'),(12,'industry_type','Accounting',1,'2017-02-21 17:37:22'),(13,'industry_type','Advertising ',1,'2017-02-21 17:37:22'),(14,'industry_type','Information',1,'2017-02-21 17:37:22'),(15,'industry_type','Music',1,'2017-02-21 17:37:22'),(16,'industry_type','Construction',1,'2017-02-21 17:37:22'),(17,'services','Sample1',1,'2017-02-21 17:37:22'),(18,'services','Sample2',1,'2017-02-21 17:37:22'),(19,'delivery_instruction','Sample1',1,'2017-02-21 17:37:22'),(20,'delivery_instruction','Sample2',1,'2017-02-21 17:37:22'),(21,'commodity_class','Sample1',1,'2017-02-21 17:37:22'),(22,'commodity_class','Sample2',1,'2017-02-21 17:37:22'),(23,'document_attached','Sample1',1,'2017-02-21 17:37:22'),(24,'document_attached','Sample2',1,'2017-02-21 17:37:22'),(25,'mode_of_payment','Sample1',1,'2017-02-21 17:37:22'),(26,'mode_of_payment','Sample2',1,'2017-02-21 17:37:22'),(27,'storage_type','Ambiant Storage',1,'2017-02-21 17:37:22'),(28,'storage_type','Cool Storage',1,'2017-02-21 17:37:22'),(29,'subinventory_type','Sample 1',1,'2017-02-21 17:37:22'),(30,'subinventory_type','Sample 2',1,'2017-02-21 17:37:22'),(31,'type_of_shipment','Pickup',1,'2017-02-21 17:37:22'),(32,'type_of_shipment','Delivery',1,'2017-02-21 17:37:22');
/*!40000 ALTER TABLE `maintenance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `appgroup` varchar(100) NOT NULL,
  `module` varchar(100) NOT NULL,
  `sub_module` int(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,'USER ADMINISTRATION','Create User Account and Assign corresponding User Type',0,1,1),(2,'USER ADMINISTRATION','Search for User Account',0,1,2),(3,'USER ADMINISTRATION','View User Account Details',0,1,3),(4,'USER ADMINISTRATION','View Own User Account Details',0,1,4),(5,'USER ADMINISTRATION','Update User Account Details',0,1,5),(6,'USER ADMINISTRATION','Update modules that the selected user account can access',0,1,6),(7,'USER ADMINISTRATION','Update modules that selected user type can access',0,1,7),(8,'USER ADMINISTRATION','Update Own User Account',0,1,8),(9,'USER ADMINISTRATION','Deactivate a selected User Account',0,1,9),(10,'MAINTENANCE','General Settings',1,1,1),(11,'MAINTENANCE','Driver Information',1,1,2),(12,'MAINTENANCE','Vehicle Information',1,1,3),(13,'MAINTENANCE','Location Management',1,1,4),(14,'CUSTOMER INFORMATION','Add Customer Information',0,1,1),(15,'CUSTOMER INFORMATION','Add Dropdown Content',0,1,2),(16,'CUSTOMER INFORMATION','Search Customer Information',0,1,3),(17,'CUSTOMER INFORMATION','View Customer Information',0,1,4),(18,'CUSTOMER INFORMATION','Update Customer Information',0,1,5),(19,'CUSTOMER INFORMATION','Delete Dropdown Content',0,1,6),(20,'BOOKING','Book Shipments',0,1,1),(21,'BOOKING','Add Dropdown Contents',0,1,2),(22,'BOOKING','Search Booking Request Form',0,1,3),(23,'BOOKING','View Booking Details',0,1,4),(24,'BOOKING','View Names who Created, Monitored and Approved Specific Shipment',0,1,5),(25,'BOOKING','Update Booking Details',0,1,6),(26,'BOOKING','Delete Booking Details',0,1,7),(27,'BOOKING','Delete Dropdown Contents',0,1,8),(28,'WAREHOUSE','Warehouse',1,1,1),(29,'WAREHOUSE','Location Management',1,1,2),(30,'WAREHOUSE','Inbound Shipment',1,1,3),(31,'WAREHOUSE','Outbound Shipment',1,1,4),(32,'BILL OF LADING','Add Bill of Lading',0,1,1),(33,'BILL OF LADING','Add Dropdown and Checkbox Content',0,1,2),(34,'BILL OF LADING','Generate Billing Report',0,1,3),(35,'BILL OF LADING','Search Bill of Lading',0,1,4),(36,'BILL OF LADING','View Bill of Lading',0,1,5),(37,'BILL OF LADING','View Names who Created, Reviewed and Approved Specific Bill of Lading',0,1,6),(38,'BILL OF LADING','Update Bill of Lading Details',0,1,7),(39,'BILL OF LADING','Delete Dropdown and Checkbox Content',0,1,8),(40,'BILL OF LADING','Download PDF FORMAT',1,0,9),(41,'BILL OF LADING','Print in PDF Format',0,1,10),(42,'BILLING','Add Billing Statement ',0,1,1),(43,'BILLING','Search Billing Statement',0,1,2),(44,'BILLING','View Billing Statement',0,1,3),(45,'BILLING','Update Billing Statement Details',0,1,4),(46,'BILLING','Void Generated Billing Statement',0,1,5),(47,'BILLING','Download PDF FORMAT',0,1,6),(48,'BILLING','Print in PDF Format',0,1,7),(49,'COLLECTION CALL-OUT','Collection Call Out',0,1,1),(50,'COLLECTION CALL-OUT','Search Billing Statement',0,1,2),(51,'COLLECTION CALL-OUT','View Billing Statement and History Logs',0,1,3),(52,'PAYMENT','Add Payment',0,1,1),(53,'PAYMENT','Add Dropdown Content',0,1,2),(54,'PAYMENT','Search Payment',0,1,3),(55,'PAYMENT','View Payment Details',0,1,4),(56,'PAYMENT','Update Payment Details',0,1,5),(57,'PAYMENT','Delete Payment',0,1,6),(58,'PAYMENT','Delete Dropdown Content',0,1,7),(59,'REPORTS','Generate Reports',0,1,1),(60,'REPORTS','Search Reports',0,1,2),(61,'REPORTS','View Reports',0,1,3),(62,'REPORTS','Download PDF FORMAT',0,1,4),(63,'REPORTS','Print Reports in PDF Format',0,1,5),(66,'REPORTS','Download EXCEL FORMAT',0,1,0),(64,'BILL OF LADING','Download EXCEL FORMAT',0,1,0),(65,'BILLING','Download EXCEL FORMAT',0,1,0);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitor_login`
--

DROP TABLE IF EXISTS `monitor_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monitor_login` (
  `id` bigint(21) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(21) NOT NULL,
  `first_login` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `previous_login` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitor_login`
--

LOCK TABLES `monitor_login` WRITE;
/*!40000 ALTER TABLE `monitor_login` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitor_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rack_storage`
--

DROP TABLE IF EXISTS `rack_storage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rack_storage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` int(225) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rack_length` int(225) DEFAULT NULL,
  `rack_width` int(225) DEFAULT NULL,
  `no_rack_level` int(225) DEFAULT NULL,
  `rack_level_height` int(225) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `style` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rack_storage`
--

LOCK TABLES `rack_storage` WRITE;
/*!40000 ALTER TABLE `rack_storage` DISABLE KEYS */;
/*!40000 ALTER TABLE `rack_storage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `select_menu`
--

DROP TABLE IF EXISTS `select_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `select_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `select_module` varchar(255) DEFAULT NULL,
  `select_name` varchar(255) DEFAULT NULL,
  `select_data` varchar(255) DEFAULT NULL,
  `select_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `select_menu`
--

LOCK TABLES `select_menu` WRITE;
/*!40000 ALTER TABLE `select_menu` DISABLE KEYS */;
INSERT INTO `select_menu` VALUES (1,'customer_info','customer_type',NULL,''),(2,'customer_info','industry_type',NULL,NULL),(3,'customer_info','ass_executive_1',NULL,NULL),(4,'customer_info','ass_executive_2',NULL,NULL),(5,'customer_info','tax_type',NULL,NULL),(6,'customer_info','preferred_supplier',NULL,NULL),(7,'customer_info','domestic_air',NULL,NULL),(8,'customer_info','domestic_sea',NULL,NULL),(9,'customer_info','domestic_trucking',NULL,NULL),(10,'customer_info','international',NULL,NULL),(11,'customer_info','international_sea',NULL,NULL),(12,'customer_info','bill_format',NULL,NULL),(13,'customer_info','international_air',NULL,NULL),(14,'booking','area',NULL,NULL),(15,'booking','contact_person',NULL,NULL),(16,'booking','mode_of_shipping',NULL,NULL),(17,'booking','vehicle_type',NULL,NULL),(18,'booking','status',NULL,NULL),(19,'Inbound_shipment','customer_name',NULL,NULL),(20,'Inbound_shipment','storage_type',NULL,NULL),(21,'Inbound_shipment','sub_inventory',NULL,NULL);
/*!40000 ALTER TABLE `select_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_modules`
--

DROP TABLE IF EXISTS `sub_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_modules` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `appgroup` varchar(100) NOT NULL,
  `module` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_modules`
--

LOCK TABLES `sub_modules` WRITE;
/*!40000 ALTER TABLE `sub_modules` DISABLE KEYS */;
INSERT INTO `sub_modules` VALUES (1,'General Settings',' Add Dropdown and Checkbox Content',1,1),(2,'General Settings','Search specific Dropdown or Checkbox',1,2),(3,'General Settings','View Dropdown and Checkbox Content',1,3),(4,'General Settings','Delete Dropdown and Checkbox Content',1,4),(5,'General Settings','Upload Price Matrix for Billing',1,5),(6,'Driver Information','Add Driver Information',1,1),(7,'Driver Information','Add Checkbox Content',1,2),(8,'Driver Information','Search Driver Information',1,3),(9,'Driver Information',' View Driver Information',1,4),(10,'Driver Information','Update Driver Information',1,5),(11,'Driver Information','Delete Driver Information',1,6),(12,'Driver Information','Delete Checkbox Content',1,7),(13,'Vehicle Information','Add Vehicle Information',1,1),(14,'Vehicle Information',' Add Dropdown Content',1,2),(15,'Vehicle Information','Search Vehicle using Vehicle Information',1,3),(16,'Vehicle Information','View Vehicle Details',1,4),(17,'Vehicle Information','Update Vehicle Information',1,5),(18,'Vehicle Information','Delete Vehicle Information',1,6),(19,'Vehicle Information','Delete Dropdown Content',1,7),(20,'Location Management','Add Location',1,1),(21,'Location Management','Add Dropdown Content',1,2),(22,'Location Management','Search Location',1,3),(23,'Location Management',' View Location Details',1,4),(24,'Location Management','Update Location Details',1,5),(25,'Location Management','Remove Location',1,6),(26,'Location Management',' Delete Dropdown Content',1,7),(27,'Warehouse','Add Racks, Shelves or Bay',1,1),(28,'Warehouse',' Search Shipment',1,2),(29,'Warehouse','Warehouse Storage View or Shelves View',1,3),(30,'Warehouse',' Shipment Location',1,4),(31,'Warehouse','Shipment Details',1,5),(32,'Warehouse','Packing List for Pull Out',1,6),(33,'Warehouse','Packing List for Pull Out',1,6),(34,'Warehouse','Available Slots',1,7),(35,'Warehouse','Move Rack or Bay',1,8),(36,'Warehouse',' Remove Rack, Shelves or Bay',1,9),(37,'Location Management','View Different Locations and Shipments per Location',1,2),(38,'Location Management','Search Location or Shipment',1,1),(39,'Inbound Shipment','Place Shipment on Warehouse',1,1),(40,'Inbound Shipment','Add Dropdown Content',1,2),(41,'Inbound Shipment',' Search Inbound Shipment',1,3),(42,'Inbound Shipment',' View Inbound Shipment',1,4),(43,'Inbound Shipment','Update Shipment Details ',1,5),(44,'Inbound Shipment','Pull Out Shipment',1,6),(45,'Inbound Shipment',' Delete Dropdown Content',1,7),(46,'Outbound Shipment','View Outbound Shipment',1,1),(47,'Outbound Shipment','Update Shipment Status',1,2);
/*!40000 ALTER TABLE `sub_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_account`
--

DROP TABLE IF EXISTS `user_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_account` (
  `id` varchar(225) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `status` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_account`
--

LOCK TABLES `user_account` WRITE;
/*!40000 ALTER TABLE `user_account` DISABLE KEYS */;
INSERT INTO `user_account` VALUES ('582563f913cd7','einstain, d-sdasdasd ','alberto1','e10adc3949ba59abbe56e057f20f883e','System Administrator','2016-11-11 02:23:53','2017-02-21 17:37:41',1),('58321d6b2d354','Rodriguez Manuson Rhaffael Jan Kalil','123456789','4297f44b13955235245b2497399d7a93','Supervisor','2016-11-21 06:02:19',NULL,1),('5832434aeb23b','123639 123 123','123','4297f44b13955235245b2497399d7a93','System Administrator','2016-11-21 08:43:54',NULL,1),('583244140577d','123123 123123 12322','123','4297f44b13955235245b2497399d7a93','System Administrator','2016-11-21 08:47:16',NULL,1),('5848137889cd5','Rito D Jon','ritojd','827ccb0eea8a706c4c34a16891f84e7b','System Administrator','2016-12-07 09:49:44','2016-12-07 21:50:17',1);
/*!40000 ALTER TABLE `user_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_module`
--

DROP TABLE IF EXISTS `user_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_module` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(225) DEFAULT NULL,
  `main_module` varchar(255) DEFAULT NULL,
  `submodule_1` varchar(255) DEFAULT NULL,
  `submodule_2` varchar(255) DEFAULT NULL,
  `submodule_3` varchar(255) DEFAULT NULL,
  `submodule_4` varchar(255) DEFAULT NULL,
  `submodule_5` varchar(255) DEFAULT NULL,
  `submodule_6` varchar(255) DEFAULT NULL,
  `submodule_7` varchar(255) DEFAULT NULL,
  `submodule_8` varchar(255) DEFAULT NULL,
  `submodule_9` varchar(255) DEFAULT NULL,
  `submodule_10` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_module`
--

LOCK TABLES `user_module` WRITE;
/*!40000 ALTER TABLE `user_module` DISABLE KEYS */;
INSERT INTO `user_module` VALUES (1,'582563f913cd7','1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1','1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1','1,1,1','1,1,1,1,1,1,1','1,1,1,1,1,1'),(6,'58321d6b2d354','1,1,1,1,1,1,0,1,1,1','0,0,0,0,0,0,0,0,0','1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1','1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1','1,1,1','1,1,1,1,1,1,1','1,1,0,0,0,0'),(7,'5832434aeb23b','1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1','1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1','1,1,1','1,1,1,1,1,1,1','1,1,1,1,1,1'),(8,'583244140577d','1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1','1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1','1,1,1','1,1,1,1,1,1,1','1,1,1,1,1,1'),(9,'5848137889cd5','1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1','1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1,1,1,1','1,1,1,1,1,1,1,1','1,1,1','1,1,1,1,1,1,1','1,1,1,1,1,1');
/*!40000 ALTER TABLE `user_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key_value` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(225) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `mobile` varchar(225) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `date_cretated` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`key_value`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profiles`
--

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
INSERT INTO `user_profiles` VALUES (15,'582563f913cd7','d-sdasdasd','','einstain','+63123123124','hehe@gmail.com','System Administrator','samples','samples','2016-11-11 02:23:53','1'),(40,'58321d6b2d354','Rhaffael Jan Kalil','Manuson','Rodriguez','+639351957042','rhaffael.ar@gmail.com','Supervisor','SM Department','Web Developer','2016-11-21 06:02:19','1'),(41,'5832434aeb23b','123','123','123639','+639999999999','nin@gmail.com','System Administrator','123123','123','2016-11-21 08:43:54','1'),(42,'583244140577d','12322','123123','123123','+639999999999','sdfsd@gmail.com','System Administrator','123','123123','2016-11-21 08:47:16','1'),(43,'5848137889cd5','Jon','D','Rito','+639999980154','jdr@arms.ph','System Administrator','ARMS','Sitting','2016-12-07 09:49:44','1');
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_types` varchar(255) DEFAULT NULL,
  `sort_order` int(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `access` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,'System Administrator',1,'1','0,0,0,1,1,1,1,1,1,1'),(2,'Manager',2,'1','1,0,1,1,1,1,1,1,1,1'),(3,'Supervisor',3,'1','0,0,0,1,1,1,1,1,1,1'),(4,'Regular User',4,'1','0,0,0,0,0,0,0,0,0,0');
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `version`
--

DROP TABLE IF EXISTS `version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `version` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(225) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `version`
--

LOCK TABLES `version` WRITE;
/*!40000 ALTER TABLE `version` DISABLE KEYS */;
/*!40000 ALTER TABLE `version` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-21 17:48:07
