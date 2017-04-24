-- MySQL dump 10.13  Distrib 5.6.35, for osx10.10 (x86_64)
--
-- Host: 127.0.0.1    Database: fruityco
-- ------------------------------------------------------
-- Server version	5.6.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES UTF8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `DepartmentID` int(11) NOT NULL AUTO_INCREMENT,
  `Location` varchar(20) NOT NULL,
  `DepartmentDesc` varchar(20) NOT NULL,
  `ManagerID` int(11) NOT NULL,
  PRIMARY KEY (`DepartmentID`),
  UNIQUE KEY `Department_DepartmentID_uindex` (`DepartmentID`),
  KEY `department_employee_EmployeeID_fk` (`ManagerID`),
  CONSTRAINT `department_employee_EmployeeID_fk` FOREIGN KEY (`ManagerID`) REFERENCES `employee` (`EmployeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'Chicago','Administration',5005),(2,'Kalamzaoo','Production',5020);
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `EmployeeID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentID` int(11) NOT NULL,
  `Fname` varchar(12) NOT NULL,
  `Lname` varchar(12) NOT NULL,
  `Compensation` int(11) NOT NULL,
  `DOB` date NOT NULL,
  `SSN` varchar(9) NOT NULL,
  `EmployeeStatus` varchar(3) NOT NULL,
  `SupID` int(11) DEFAULT NULL,
  `SaltedPassword` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`),
  UNIQUE KEY `Employee_EmployeeID_uindex` (`EmployeeID`),
  KEY `employee_department_DepartmentID_fk` (`DepartmentID`),
  KEY `employee__EmployeeID_fk` (`SupID`),
  CONSTRAINT `employee__EmployeeID_fk` FOREIGN KEY (`SupID`) REFERENCES `employee` (`EmployeeID`),
  CONSTRAINT `employee_department_DepartmentID_fk` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`DepartmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=5021 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (5005,1,'John','Doe',45000,'1990-09-07','123456789','ACT',NULL,'$2y$10$/m4SqJOz5ZAWdB.H1rYNiOc77ZNkyDK.eBH8wpwEuxoKE5fsutxwe'),(5010,1,'Jane','Smith',30000,'1985-01-01','987654321','ACT',5005,NULL),(5015,1,'Adam','Johnson',35000,'1988-02-29','123654756','TRM',5005,NULL),(5020,2,'Jacob','Maxson',40000,'1980-03-30','324435322','ACT',5005,NULL);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `PayID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`OrderID`),
  UNIQUE KEY `Order_OrderID_uindex` (`OrderID`),
  KEY `order_payment_PayID_fk` (`PayID`),
  KEY `order_user_UserID_fk` (`UserID`),
  CONSTRAINT `order_payment_PayID_fk` FOREIGN KEY (`PayID`) REFERENCES `payment` (`PayID`),
  CONSTRAINT `order_user_UserID_fk` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderline`
--

DROP TABLE IF EXISTS `orderline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderline` (
  `OrderLineId` int(11) NOT NULL AUTO_INCREMENT,
  `ProductID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`OrderLineId`),
  UNIQUE KEY `OrderLine_OrderLineId_uindex` (`OrderLineId`),
  KEY `ProductID_fk` (`ProductID`),
  KEY `OrderID_fk` (`OrderID`),
  CONSTRAINT `OrderID_fk` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`),
  CONSTRAINT `ProductID_fk` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderline`
--

LOCK TABLES `orderline` WRITE;
/*!40000 ALTER TABLE `orderline` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `UserId` int(11) DEFAULT NULL,
  `PayID` int(11) NOT NULL AUTO_INCREMENT,
  `BillingName` varchar(50) NOT NULL,
  `BillingStreetAddress` varchar(50) NOT NULL,
  `BillingCity` varchar(15) NOT NULL,
  `BillingState` varchar(15) NOT NULL,
  `BillingZipCode` int(11) NOT NULL,
  `BillingCountry` varchar(15) NOT NULL,
  `CreditCardNum` varchar(16) NOT NULL,
  `CreditCardExpiryDate` varchar(5) NOT NULL,
  `CreditCardSecurityCode` varchar(3) NOT NULL,
  PRIMARY KEY (`PayID`),
  UNIQUE KEY `Payment_PayID_uindex` (`PayID`),
  KEY `payment_user_UserID_fk` (`UserId`),
  CONSTRAINT `payment_user_UserID_fk` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (301,2,'Evan Brennan','1381 W. Western','Chicago','IL',60202,'USA','2245987574832957','04/21','392');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductDesc` varchar(50) DEFAULT NULL,
  `ProductPic` blob,
  `Price` float NOT NULL,
  `QuantityAval` int(11) NOT NULL,
  `AtCost` float NOT NULL,
  PRIMARY KEY (`ProductID`),
  UNIQUE KEY `Product_ProductID_uindex` (`ProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=12004 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (12001,'FruityBook Pro','images/fireman.jpg',1500,4,1300),(12002,'FruityBook Wind','<null>',1100,3,900),(12003,'FruityBox Expert',NULL,3999.99,1,3029.85);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requestedrepairs`
--

DROP TABLE IF EXISTS `requestedrepairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requestedrepairs` (
  `RequestID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `RequestDate` date NOT NULL,
  PRIMARY KEY (`RequestID`),
  UNIQUE KEY `RequestedRepairs_RequestID_uindex` (`RequestID`),
  KEY `requestedrepairs_user_UserID_fk` (`UserID`),
  KEY `requestedrepairs_product_ProductID_fk` (`ProductID`),
  KEY `requestedrepairs_order_OrderID_fk` (`OrderID`),
  CONSTRAINT `requestedrepairs_order_OrderID_fk` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`),
  CONSTRAINT `requestedrepairs_product_ProductID_fk` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  CONSTRAINT `requestedrepairs_user_UserID_fk` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requestedrepairs`
--

LOCK TABLES `requestedrepairs` WRITE;
/*!40000 ALTER TABLE `requestedrepairs` DISABLE KEYS */;
/*!40000 ALTER TABLE `requestedrepairs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `ShipStreetAddress` varchar(20) DEFAULT NULL,
  `ShipCity` varchar(15) DEFAULT NULL,
  `ShipState` varchar(15) DEFAULT NULL,
  `ShipZipCode` int(11) DEFAULT NULL,
  `ShipCountry` varchar(15) DEFAULT NULL,
  `PhoneNumber` varchar(10) DEFAULT NULL,
  `EmailAddress` varchar(50) NOT NULL,
  `fName` varchar(15) DEFAULT NULL,
  `LName` varchar(15) DEFAULT NULL,
  `PasswordHash` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `User_UserID_uindex` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=375 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (301,'1381 W. Western','Chicago','IL',60202,'USA','2698675309','e.brennan@gmail.com','Evan','Brennan','$2y$10$DTAsj2ILVhKF2nex7LLxdu6lAklxvzJwRpKrkirGw.fggQSOQR07i'),(374,'123 Chicago','Chicago','IL',23456,'USA','1234567890','abc@abc.com','Harrison','Goscenski','$2y$10$Fc1ECM8HZU.jse1wkQF3qeWlI/JPEkcej731rytKDlJ7dbc0EmOj6');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-21 20:06:37
