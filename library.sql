CREATE DATABASE  IF NOT EXISTS `librarian` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `librarian`;
-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: librarian
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

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
-- Table structure for table `contents_page`
--

DROP TABLE IF EXISTS `contents_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents_page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) DEFAULT NULL,
  `isi` longtext,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `halaman` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents_page`
--

LOCK TABLES `contents_page` WRITE;
/*!40000 ALTER TABLE `contents_page` DISABLE KEYS */;
/*!40000 ALTER TABLE `contents_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents_page_halaman`
--

DROP TABLE IF EXISTS `contents_page_halaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents_page_halaman` (
  `halaman` varchar(100) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `jenis` varchar(1) DEFAULT NULL,
  `parent_halaman` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `page_url` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`halaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents_page_halaman`
--

LOCK TABLES `contents_page_halaman` WRITE;
/*!40000 ALTER TABLE `contents_page_halaman` DISABLE KEYS */;
/*!40000 ALTER TABLE `contents_page_halaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents_sponsor`
--

DROP TABLE IF EXISTS `contents_sponsor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents_sponsor` (
  `sponsor_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `file_path` varchar(500) DEFAULT NULL,
  `is_aktif` smallint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`sponsor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents_sponsor`
--

LOCK TABLES `contents_sponsor` WRITE;
/*!40000 ALTER TABLE `contents_sponsor` DISABLE KEYS */;
/*!40000 ALTER TABLE `contents_sponsor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents_statistik_pengunjung`
--

DROP TABLE IF EXISTS `contents_statistik_pengunjung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents_statistik_pengunjung` (
  `statistik_pengunjung_id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  PRIMARY KEY (`statistik_pengunjung_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents_statistik_pengunjung`
--

LOCK TABLES `contents_statistik_pengunjung` WRITE;
/*!40000 ALTER TABLE `contents_statistik_pengunjung` DISABLE KEYS */;
INSERT INTO `contents_statistik_pengunjung` VALUES (36,'2015-09-22',1);
/*!40000 ALTER TABLE `contents_statistik_pengunjung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents_template_contents`
--

DROP TABLE IF EXISTS `contents_template_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents_template_contents` (
  `template_contents_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) DEFAULT NULL,
  `isi` longtext,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`template_contents_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents_template_contents`
--

LOCK TABLES `contents_template_contents` WRITE;
/*!40000 ALTER TABLE `contents_template_contents` DISABLE KEYS */;
/*!40000 ALTER TABLE `contents_template_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents_testimoni`
--

DROP TABLE IF EXISTS `contents_testimoni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents_testimoni` (
  `testimoni_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `isi` varchar(500) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `is_approve` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`testimoni_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents_testimoni`
--

LOCK TABLES `contents_testimoni` WRITE;
/*!40000 ALTER TABLE `contents_testimoni` DISABLE KEYS */;
/*!40000 ALTER TABLE `contents_testimoni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `library_buku`
--

DROP TABLE IF EXISTS `library_buku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `library_buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `library_buku`
--

LOCK TABLES `library_buku` WRITE;
/*!40000 ALTER TABLE `library_buku` DISABLE KEYS */;
/*!40000 ALTER TABLE `library_buku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `library_lokasi`
--

DROP TABLE IF EXISTS `library_lokasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `library_lokasi` (
  `id_lokasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `library_lokasi`
--

LOCK TABLES `library_lokasi` WRITE;
/*!40000 ALTER TABLE `library_lokasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `library_lokasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `library_member`
--

DROP TABLE IF EXISTS `library_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `library_member` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_identitas` varchar(45) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(45) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `library_member`
--

LOCK TABLES `library_member` WRITE;
/*!40000 ALTER TABLE `library_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `library_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `library_petugas`
--

DROP TABLE IF EXISTS `library_petugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `library_petugas` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `library_petugas`
--

LOCK TABLES `library_petugas` WRITE;
/*!40000 ALTER TABLE `library_petugas` DISABLE KEYS */;
/*!40000 ALTER TABLE `library_petugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `library_pinjam`
--

DROP TABLE IF EXISTS `library_pinjam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `library_pinjam` (
  `id_pinjam` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `jaminan` varchar(20) NOT NULL,
  `kode_jaminan` varchar(45) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pinjam`),
  KEY `fk_daftar_pinjam_1_idx` (`id_member`),
  CONSTRAINT `fk_daftar_pinjam_1` FOREIGN KEY (`id_member`) REFERENCES `library_member` (`id_member`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `library_pinjam`
--

LOCK TABLES `library_pinjam` WRITE;
/*!40000 ALTER TABLE `library_pinjam` DISABLE KEYS */;
/*!40000 ALTER TABLE `library_pinjam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `public_sys_user`
--

DROP TABLE IF EXISTS `public_sys_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `public_sys_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `last_ip` varchar(30) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_active` varchar(1) DEFAULT '1',
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `public_sys_user`
--

LOCK TABLES `public_sys_user` WRITE;
/*!40000 ALTER TABLE `public_sys_user` DISABLE KEYS */;
INSERT INTO `public_sys_user` VALUES (1,'arip','Solikul Arip','127.0.0.1','2015-09-22 07:39:27','1','6f9b0a55df8ac28564cb9f63a10be8af6ab3f7c2');
/*!40000 ALTER TABLE `public_sys_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-22  7:59:00
CREATE DATABASE  IF NOT EXISTS `librarian_upload` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `librarian_upload`;
-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: librarian_upload
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

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
-- Table structure for table `buku_file`
--

DROP TABLE IF EXISTS `buku_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku_file` (
  `id_buku_file` int(11) NOT NULL AUTO_INCREMENT,
  `isi_file` blob,
  `nama` varchar(100) DEFAULT NULL,
  `buku_filecol` varchar(45) DEFAULT NULL,
  `id_buku` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_buku_file`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku_file`
--

LOCK TABLES `buku_file` WRITE;
/*!40000 ALTER TABLE `buku_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `buku_file` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-22  7:59:00
