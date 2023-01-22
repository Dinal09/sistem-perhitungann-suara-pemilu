-- MySQL dump 10.13  Distrib 5.1.72, for Win32 (ia32)
--
-- Host: localhost    Database: pemilu_caleg
-- ------------------------------------------------------
-- Server version	5.7.33

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
-- Table structure for table `dapil`
--

DROP TABLE IF EXISTS `dapil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dapil` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dapil`
--

LOCK TABLES `dapil` WRITE;
/*!40000 ALTER TABLE `dapil` DISABLE KEYS */;
INSERT INTO `dapil` VALUES (8,'RIAU 1','2022-12-06 17:34:15','2022-12-06 17:34:15'),(9,'RIAU 2','2022-12-06 17:34:26','2022-12-06 17:34:26'),(10,'RIAU 3','2022-12-06 17:34:34','2022-12-06 17:34:34'),(11,'RIAU 4','2022-12-06 17:34:46','2022-12-06 17:34:46'),(12,'RIAU 5','2022-12-06 17:34:55','2022-12-06 17:34:55'),(13,'RIAU 6','2022-12-06 17:35:03','2022-12-06 17:35:03'),(14,'RIAU 7','2022-12-06 17:35:12','2022-12-06 17:35:12'),(15,'RIAU 8','2022-12-06 17:35:23','2022-12-06 17:35:23');
/*!40000 ALTER TABLE `dapil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desa`
--

DROP TABLE IF EXISTS `desa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desa` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_kecamatan` int(5) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jumlah_penduduk` int(7) DEFAULT '0',
  `target_kunjungan` int(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desa`
--

LOCK TABLES `desa` WRITE;
/*!40000 ALTER TABLE `desa` DISABLE KEYS */;
INSERT INTO `desa` VALUES (1,1,'Air Tiris',1,97,'2022-12-06 18:41:01','2023-01-01 17:20:09'),(2,1,'Pulau Tinggi',1,NULL,'2022-12-17 10:17:43','2023-01-01 17:20:09'),(3,1,'Pulau Birandang',0,NULL,'2023-01-01 16:56:08','2023-01-01 16:56:08');
/*!40000 ALTER TABLE `desa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jenis_suara`
--

DROP TABLE IF EXISTS `jenis_suara`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jenis_suara` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_suara`
--

LOCK TABLES `jenis_suara` WRITE;
/*!40000 ALTER TABLE `jenis_suara` DISABLE KEYS */;
INSERT INTO `jenis_suara` VALUES (2,'Suara TIdak Sah',NULL,NULL),(3,'Suara Sendiri',NULL,'2022-12-06 09:44:42'),(4,'Suara Sah','2022-12-17 17:00:14','2022-12-17 17:00:14');
/*!40000 ALTER TABLE `jenis_suara` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kecamatan`
--

DROP TABLE IF EXISTS `kecamatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kecamatan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_dapil` int(5) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kecamatan`
--

LOCK TABLES `kecamatan` WRITE;
/*!40000 ALTER TABLE `kecamatan` DISABLE KEYS */;
INSERT INTO `kecamatan` VALUES (1,9,'Kampar','2022-12-06 17:51:11','2022-12-06 17:51:11'),(2,8,'Siak','2022-12-17 17:22:19','2022-12-17 17:22:19');
/*!40000 ALTER TABLE `kecamatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pemilih`
--

DROP TABLE IF EXISTS `pemilih`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pemilih` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_tps` int(5) DEFAULT NULL,
  `id_suara_abu` int(5) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_kk` varchar(100) DEFAULT NULL,
  `no_nik` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(100) DEFAULT NULL,
  `foto_ktp` varchar(100) DEFAULT NULL,
  `foto_kk` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `is_kunjungan` enum('belum','sudah') DEFAULT 'belum',
  `is_keluarga` enum('tidak','keluarga-mendukung','keluarga-tidak') DEFAULT 'tidak',
  `is_simpatisan` enum('tidak','iya') DEFAULT 'tidak',
  `is_pengkhianat` enum('tidak','iya') DEFAULT 'tidak',
  `is_daftar_hitam` enum('tidak','iya') DEFAULT 'tidak',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `suara_abu_tgl` datetime DEFAULT NULL,
  `kunjungan_tgl` datetime DEFAULT NULL,
  `keluarga_tgl` datetime DEFAULT NULL,
  `simpatisan_tgl` datetime DEFAULT NULL,
  `pengkhianat_tgl` datetime DEFAULT NULL,
  `daftar_hitam_tgl` datetime DEFAULT NULL,
  `suara_abu_by` int(5) DEFAULT NULL,
  `kunjungan_by` int(5) DEFAULT NULL,
  `keluarga_by` int(5) DEFAULT NULL,
  `simpatisan_by` int(5) DEFAULT NULL,
  `pengkhianat_by` int(5) DEFAULT NULL,
  `daftar_hitam_by` int(5) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pemilih`
--

LOCK TABLES `pemilih` WRITE;
/*!40000 ALTER TABLE `pemilih` DISABLE KEYS */;
INSERT INTO `pemilih` VALUES (2,1,2,'Dinal Khairi','1401020907980001','1401020907980001','Pulau Tinggi','1998-07-09','Pulau Tinggi','082285501519','mi3AXlAk4jFCyAKVzxuk1erFtGQD1tdNCOvzIbgP.jpg','dxfFrhoEpgn3PDRcbfwbfFmebw6ilqrcqMDtTe88.jpg','mgmX6iw9EuOtKcKxzmdjr9UoCPWALEh0yPkWYsiB.jpg','belum','tidak','tidak','tidak','tidak','2022-12-18 22:24:19',NULL,NULL,NULL,'2023-01-04 23:06:41',NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,'2023-01-04 16:06:41'),(3,3,NULL,'Rudi','2039481034914122','1234567890123456','Pulau Birandang','2022-09-02','Pulau Birandang','082210342034','unpKiUddCrujCRUOUVBsdDfqPO2FZmJoWRYrHcTj.png','VxkIgr8VqefsXvPdyu3FqV1y0kKHZ9hoPuS9qD6V.png','HuFtSpqg1YxqRNlQmQqsdEUTqdoK0ugi9DiwIG71.png','belum','tidak','iya','tidak','tidak','2023-01-01 17:02:11',NULL,NULL,NULL,'2023-01-04 21:43:10',NULL,NULL,NULL,NULL,NULL,7,NULL,NULL,NULL,'2023-01-04 14:43:10');
/*!40000 ALTER TABLE `pemilih` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suara_abu`
--

DROP TABLE IF EXISTS `suara_abu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suara_abu` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suara_abu`
--

LOCK TABLES `suara_abu` WRITE;
/*!40000 ALTER TABLE `suara_abu` DISABLE KEYS */;
INSERT INTO `suara_abu` VALUES (1,'Belum Memahami Visi & Misi atau Maksud & Tujuan','2022-12-17 17:08:04','2022-12-17 17:08:41'),(2,'Materialistis','2022-12-17 17:08:59','2022-12-17 17:08:59');
/*!40000 ALTER TABLE `suara_abu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tps`
--

DROP TABLE IF EXISTS `tps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tps` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_desa` int(5) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `berkas_c1` varchar(100) DEFAULT NULL,
  `rekap_mandiri` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tps`
--

LOCK TABLES `tps` WRITE;
/*!40000 ALTER TABLE `tps` DISABLE KEYS */;
INSERT INTO `tps` VALUES (1,1,'TPS 1',NULL,NULL,'2022-12-17 16:52:40','2022-12-17 16:52:40'),(2,1,'TPS 3',NULL,NULL,'2022-12-17 16:55:18','2022-12-17 16:56:53'),(3,2,'TPS 1',NULL,NULL,'2023-01-01 17:14:25','2023-01-01 17:14:25');
/*!40000 ALTER TABLE `tps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('super admin','admin','caleg') DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'Dinal Khairi','superadmin','superAdmin@email.com','$2y$10$nwRaC/Ufl/bhEPk63WWT8OxOnSmVEQbYrXZZCfomRx9YEK1ZnUGri','super admin','qo6yD2GEGBrpGcMPsiVUZELGbjWlwnt58kli9i2h.jpg','082285501519','Perumahan At-thaya 2 Jalan Melati','2022-12-17 20:42:18','2022-12-18 08:29:44');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'pemilu_caleg'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-04 23:19:07
