-- MySQL dump 10.19  Distrib 10.3.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_rentalmobil
-- ------------------------------------------------------
-- Server version	10.3.29-MariaDB-0+deb10u1

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
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `kd_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(35) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  PRIMARY KEY (`kd_customer`),
  KEY `kd_customer` (`kd_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'NONI ARIESTA','BANYUMAS','88882222'),(2,'SUSI SUSANTI','CILACAP','88883456'),(3,'RINA WIRAWAN','PURBALINGGA','88882020'),(4,'TOMI SAPUTRA','BANJARNEGARA','88889100');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mobil`
--

DROP TABLE IF EXISTS `mobil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mobil` (
  `kd_mobil` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_mobil` varchar(35) NOT NULL,
  `warna` varchar(35) NOT NULL,
  `stok` int(8) NOT NULL,
  `tarif_sewa` int(15) NOT NULL,
  PRIMARY KEY (`kd_mobil`),
  KEY `kd_mobil` (`kd_mobil`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobil`
--

LOCK TABLES `mobil` WRITE;
/*!40000 ALTER TABLE `mobil` DISABLE KEYS */;
INSERT INTO `mobil` VALUES (1,'sedan','putih',0,150000),(2,'station wagon','hitam',17,250000),(3,'suv','biru',5,300000),(4,'hatchback','silver',10,250000),(5,'avanza','coklat susu',30,300000);
/*!40000 ALTER TABLE `mobil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sewa`
--

DROP TABLE IF EXISTS `sewa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sewa` (
  `kd_sewa` int(11) NOT NULL AUTO_INCREMENT,
  `kd_mobil` int(8) NOT NULL,
  `kd_customer` int(8) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `total_sewa` int(15) NOT NULL,
  PRIMARY KEY (`kd_sewa`),
  KEY `kd_mobil` (`kd_mobil`,`kd_customer`),
  KEY `kd_customer` (`kd_customer`),
  CONSTRAINT `sewa_ibfk_1` FOREIGN KEY (`kd_customer`) REFERENCES `customer` (`kd_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sewa_ibfk_2` FOREIGN KEY (`kd_mobil`) REFERENCES `mobil` (`kd_mobil`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sewa`
--

LOCK TABLES `sewa` WRITE;
/*!40000 ALTER TABLE `sewa` DISABLE KEYS */;
INSERT INTO `sewa` VALUES (1,1,1,'2022-02-02','2022-02-04',450000),(5,2,1,'2022-02-02','2022-02-04',750000),(6,2,1,'2022-02-02','2022-02-17',4000000),(7,1,2,'2022-10-08','2022-10-18',1650000),(8,1,3,'2022-10-05','2022-10-12',1200000);
/*!40000 ALTER TABLE `sewa` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger tr_sewa
after insert on sewa
for each row
begin
update mobil set stok = stok - 1 where kd_mobil = NEW.kd_mobil;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger tr_pengembalian
after delete on sewa
for each row
begin
update mobil set stok = stok + 1 where kd_mobil = OLD.kd_mobil;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3'),(2,'user','ee11cbb19052e40b07aac0ca060c23ee');
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

-- Dump completed on 2022-10-06  7:31:39
