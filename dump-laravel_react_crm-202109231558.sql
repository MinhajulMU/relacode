-- MySQL dump 10.13  Distrib 8.0.26, for Linux (x86_64)
--
-- Host: localhost    Database: laravel_react_crm
-- ------------------------------------------------------
-- Server version	8.0.26-0ubuntu0.21.04.3

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
-- Table structure for table `backup_db`
--

DROP TABLE IF EXISTS `backup_db`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_db` (
  `id_backup_db` varchar(36) NOT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_path` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_backup_db`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_db`
--

LOCK TABLES `backup_db` WRITE;
/*!40000 ALTER TABLE `backup_db` DISABLE KEYS */;
INSERT INTO `backup_db` VALUES ('97fbbca5-ae3c-43a5-b987-b1b5e19622d1','backup-2021-09-23.sql','backup/','2021-09-23','2021-09-23 01:03:20','2021-09-23 01:03:42','2021-09-23 01:03:42'),('ab986fd3-c220-4007-8c21-a6546657c468','backup-2021-09-23.sql','backup/','2021-09-23','2021-09-23 01:03:44','2021-09-23 01:03:44',NULL),('ad80e374-968d-48d7-8754-997b3f9aacb1','backup-2021-09-23.sql','backup/','2021-09-23','2021-09-23 01:17:20','2021-09-23 01:17:20',NULL),('ea0497aa-eace-40cd-acef-b53a8ed84cc0','backup-2021-09-23.sql','backup/','2021-09-23','2021-09-23 01:03:20','2021-09-23 01:03:40','2021-09-23 01:03:40');
/*!40000 ALTER TABLE `backup_db` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumen`
--

DROP TABLE IF EXISTS `dokumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dokumen` (
  `id_dokumen` varchar(36) NOT NULL,
  `id_jns_dokumen` varchar(36) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `file_path` varchar(100) DEFAULT NULL,
  `file_size` decimal(7,2) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `id_model` varchar(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_dokumen`),
  KEY `dokumen_FK` (`id_jns_dokumen`),
  CONSTRAINT `dokumen_FK` FOREIGN KEY (`id_jns_dokumen`) REFERENCES `ref_jns_dokumen` (`id_jns_dokumen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumen`
--

LOCK TABLES `dokumen` WRITE;
/*!40000 ALTER TABLE `dokumen` DISABLE KEYS */;
INSERT INTO `dokumen` VALUES ('1df03afc-408c-41d8-8361-fd08dcbf65b0','133174b3-eec3-42fd-b0b6-1286e086f079','2210576763_Screenshot from 2021-09-08 08-03-40.png',NULL,'2021/09/22/',821.08,'image/png','App\\Modules\\Users\\Models\\Users','3069bd28-7104-42e3-957f-65e8534e2fd7','2021-09-22 02:04:01','2021-09-22 02:06:38','2021-09-22 02:06:38'),('59df2ef1-8dac-48bf-819f-ab35fcf2da01','133174b3-eec3-42fd-b0b6-1286e086f079','2677751685_sae.jpeg',NULL,'2021/09/22/',172.31,'image/jpeg','App\\Modules\\Users\\Models\\Users','3069bd28-7104-42e3-957f-65e8534e2fd7','2021-09-22 02:07:51','2021-09-22 02:08:35','2021-09-22 02:08:35'),('62ffd99c-775a-4a14-9181-ca3366a5c880','133174b3-eec3-42fd-b0b6-1286e086f079','3623211161_sae.jpeg',NULL,'2021/09/22/',172.31,'image/jpeg','App\\Modules\\Users\\Models\\Users','3069bd28-7104-42e3-957f-65e8534e2fd7','2021-09-22 02:06:38','2021-09-22 02:07:51','2021-09-22 02:07:51'),('6d186df6-6bd8-4580-b073-5c72e85ea8f2','133174b3-eec3-42fd-b0b6-1286e086f079','3002948710_Screenshot from 2021-09-13 08-26-02.png',NULL,'2021/09/22/',776.20,'image/png','App\\Modules\\Users\\Models\\Users','3069bd28-7104-42e3-957f-65e8534e2fd7','2021-09-22 02:03:49','2021-09-22 02:04:01','2021-09-22 02:04:01'),('870cee4c-e97e-4e06-ae91-4632fb004d09','133174b3-eec3-42fd-b0b6-1286e086f079','2616111282_Screenshot from 2021-09-17 09-22-53.png',NULL,'2021/09/22/',248.45,'image/png','App\\Modules\\Users\\Models\\Users','3069bd28-7104-42e3-957f-65e8534e2fd7','2021-09-22 02:02:38','2021-09-22 02:03:49','2021-09-22 02:03:49'),('b4097dd5-4e96-4c85-beba-7b124985db26','133174b3-eec3-42fd-b0b6-1286e086f079','1800385745_sae.jpeg',NULL,'2021/09/22/',172.31,'image/jpeg','App\\Modules\\Users\\Models\\Users','3069bd28-7104-42e3-957f-65e8534e2fd7','2021-09-22 02:08:35','2021-09-22 02:09:22','2021-09-22 02:09:22'),('b9703c32-f1c9-4f17-9c68-4da561070fce','133174b3-eec3-42fd-b0b6-1286e086f079','2072091299_Screenshot from 2021-09-17 11-40-02.png',NULL,'2021/09/22/',106.39,'image/png','App\\Modules\\Users\\Models\\Users','3069bd28-7104-42e3-957f-65e8534e2fd7','2021-09-22 02:01:03','2021-09-22 02:02:38','2021-09-22 02:02:38'),('bd862d95-8079-4de4-a51b-3a0ece4716a1','133174b3-eec3-42fd-b0b6-1286e086f079','3062346862_sae_byeok.jpeg',NULL,'2021/09/22/',172.31,'image/jpeg','App\\Modules\\Users\\Models\\Users','3069bd28-7104-42e3-957f-65e8534e2fd7','2021-09-22 02:09:22','2021-09-22 02:09:22',NULL),('c8cbcf53-ac78-446e-9fc6-414b57f3f4fe','133174b3-eec3-42fd-b0b6-1286e086f079','2185964379_Screenshot from 2021-09-08 14-57-42.png',NULL,'2021/09/22/',192.60,'image/png','App\\Modules\\Users\\Models\\Users','3069bd28-7104-42e3-957f-65e8534e2fd7','2021-09-22 00:56:38','2021-09-22 00:56:38','2021-09-22 00:56:38');
/*!40000 ALTER TABLE `dokumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_user` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktifitas` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_log`),
  KEY `log_FK` (`id_user`),
  CONSTRAINT `log_FK` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,'1','Menambah MenuGrup ID = fe73d568-a426-4753-aa6a-fccec90a6ce0','2021-09-01 00:03:31','2021-09-01 00:03:31',NULL),(2,'1','Menambah MenuGrup ID = 964988a5-a287-42f2-b61b-1caa3055657e','2021-09-01 00:03:45','2021-09-01 00:03:45',NULL),(3,'1','Mengubah MenuGrup ID = fe73d568-a426-4753-aa6a-fccec90a6ce0','2021-09-01 00:03:50','2021-09-01 00:03:50',NULL),(4,'1','Mengubah Book ID = edc82dc8-f3ca-460c-ac61-d90d85674ed0','2021-09-02 21:19:58','2021-09-02 21:19:58',NULL),(5,'1','Menghapus Book ID = 644a735b-269d-30cb-aa75-f3d087ee597b','2021-09-02 21:20:03','2021-09-02 21:20:03',NULL),(6,'1','Menambah Module ID = a543a6d5-71df-43ce-b2d1-80bbe46675ce','2021-09-10 06:56:25','2021-09-10 06:56:25',NULL),(7,'1','Menambah Module ID = 4d55a183-fdd2-4df8-83aa-ea022c2771e0','2021-09-10 07:06:03','2021-09-10 07:06:03',NULL),(8,'1','Menghapus Module ID = 4d55a183-fdd2-4df8-83aa-ea022c2771e0','2021-09-10 07:06:51','2021-09-10 07:06:51',NULL),(9,'1','Menambah Module ID = f62dc9b9-9663-44b5-b8f1-84d171a22633','2021-09-10 07:06:56','2021-09-10 07:06:56',NULL),(10,'1','Menghapus Module ID = f62dc9b9-9663-44b5-b8f1-84d171a22633','2021-09-10 07:07:00','2021-09-10 07:07:00',NULL),(11,'1','Menambah Module ID = 03e9c167-7b6e-455f-9415-ff9ec4d7b017','2021-09-10 07:09:09','2021-09-10 07:09:09',NULL),(12,'1','Mengubah Module ID = 03e9c167-7b6e-455f-9415-ff9ec4d7b017','2021-09-10 07:10:45','2021-09-10 07:10:45',NULL),(13,'1','Mengubah Module ID = 03e9c167-7b6e-455f-9415-ff9ec4d7b017','2021-09-10 07:10:53','2021-09-10 07:10:53',NULL),(14,'1','Menambah Module ID = f9c038ec-3792-427c-a3c7-65ea911c5af8','2021-09-10 07:25:36','2021-09-10 07:25:36',NULL),(15,'1','Menambah Module ID = 60f45852-0030-435e-957c-25aff1a20cac','2021-09-10 07:27:05','2021-09-10 07:27:05',NULL),(16,'1','Menghapus Module ID = f9c038ec-3792-427c-a3c7-65ea911c5af8','2021-09-10 07:30:58','2021-09-10 07:30:58',NULL),(17,'1','Menghapus Module ID = 60f45852-0030-435e-957c-25aff1a20cac','2021-09-10 07:31:03','2021-09-10 07:31:03',NULL),(18,'1','Menghapus Module ID = 03e9c167-7b6e-455f-9415-ff9ec4d7b017','2021-09-10 07:31:12','2021-09-10 07:31:12',NULL),(19,'1','Mengubah Module ID = 474d9d4c-e803-4725-a0d1-e26bf6bc05ec','2021-09-10 07:32:03','2021-09-10 07:32:03',NULL),(20,'1','Menambah MenuGrup ID = 83258632-3d71-4478-aa64-b1bf62345770','2021-09-10 07:32:49','2021-09-10 07:32:49',NULL),(21,'1','Mengubah Module ID = 474d9d4c-e803-4725-a0d1-e26bf6bc05ec','2021-09-10 07:34:46','2021-09-10 07:34:46',NULL),(22,'1','Mengubah Module ID = 3be55c7b-e194-4691-95e1-450964f05678','2021-09-10 07:35:00','2021-09-10 07:35:00',NULL),(23,'1','Menambah Module ID = 68a7a54b-5e3f-4569-aee4-89ab0d5c3ddb','2021-09-10 07:38:30','2021-09-10 07:38:30',NULL),(24,'1','Menghapus Module ID = 1563e47d-c506-4073-ae61-55922f7b3d78','2021-09-10 07:38:48','2021-09-10 07:38:48',NULL),(25,'1','Menambah Module ID = 9eb6f7cf-7914-40ab-8f7f-7c55945d858b','2021-09-10 07:41:21','2021-09-10 07:41:21',NULL),(26,'1','Menambah Module ID = a070d1b1-2f31-4de7-a2a2-b4f7d1a62b2c','2021-09-10 08:03:28','2021-09-10 08:03:28',NULL),(27,'1','Menghapus Users ID = 2','2021-09-11 09:17:41','2021-09-11 09:17:41',NULL),(28,'1','Menghapus Users ID = 3','2021-09-11 09:17:44','2021-09-11 09:17:44',NULL),(29,'1','Menghapus Users ID = 4','2021-09-11 09:17:47','2021-09-11 09:17:47',NULL),(30,'1','Menghapus Users ID = 5','2021-09-11 09:17:49','2021-09-11 09:17:49',NULL),(31,'1','Menghapus Users ID = 6','2021-09-11 09:17:52','2021-09-11 09:17:52',NULL),(32,'1','Menambah Users ID = 6b5be2f0-00f1-4b5f-b3ed-024065722034','2021-09-11 10:13:42','2021-09-11 10:13:42',NULL),(33,'1','Menghapus Users ID = 6b5be2f0-00f1-4b5f-b3ed-024065722034','2021-09-11 10:13:47','2021-09-11 10:13:47',NULL),(34,'1','Menghapus Users ID = 6abb8a59-6f44-4773-b50a-fe7e86ab3ac7','2021-09-11 10:20:17','2021-09-11 10:20:17',NULL),(35,'1','Menambah Users ID = c8c549d2-dbd8-4225-a527-7e1e930c35f3','2021-09-11 10:26:09','2021-09-11 10:26:09',NULL),(36,'1','Menghapus Users ID = 061aedf8-5737-4a1d-a6ab-31324f80fb94','2021-09-11 10:26:15','2021-09-11 10:26:15',NULL),(37,'1','Menghapus Users ID = 7b6db6ec-a742-423b-b138-8d6c1b2cfe58','2021-09-11 10:26:18','2021-09-11 10:26:18',NULL),(38,'1','Menghapus Users ID = c8c549d2-dbd8-4225-a527-7e1e930c35f3','2021-09-11 10:26:23','2021-09-11 10:26:23',NULL),(39,'1','Menambah Users ID = d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 10:26:34','2021-09-11 10:26:34',NULL),(40,'1','Mengubah Users ID = d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 11:08:01','2021-09-11 11:08:01',NULL),(41,'1','Mengubah Users ID = d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 11:08:11','2021-09-11 11:08:11',NULL),(42,'1','Mengubah Users ID = d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 11:09:39','2021-09-11 11:09:39',NULL),(43,'1','Mengubah Users ID = d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 11:09:45','2021-09-11 11:09:45',NULL),(44,'1','Menghapus Users ID = d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 11:09:55','2021-09-11 11:09:55',NULL),(45,'1','Menambah Users ID = 3069bd28-7104-42e3-957f-65e8534e2fd7','2021-09-11 11:10:15','2021-09-11 11:10:15',NULL),(49,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menambah Book ID = 31428d50-5250-416d-9181-074c434123d9','2021-09-11 18:15:45','2021-09-11 18:15:45',NULL),(50,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menghapus Module ID = d3d5f2d9-2e57-480f-85c2-287b4fc05c59','2021-09-11 18:15:57','2021-09-11 18:15:57',NULL),(51,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menghapus Module ID = 7346e8d7-d59c-4f32-925c-c55ed506f622','2021-09-11 18:16:04','2021-09-11 18:16:04',NULL),(52,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menambah Module ID = 55e4e45a-1e63-429b-b2a1-f06ef4edbfac','2021-09-11 18:16:22','2021-09-11 18:16:22',NULL),(53,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menambah Module ID = f4e73593-0eae-4d81-ab44-9d2e9ad5e96e','2021-09-11 18:17:13','2021-09-11 18:17:13',NULL),(54,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menghapus Module ID = 9eb6f7cf-7914-40ab-8f7f-7c55945d858b','2021-09-11 18:17:48','2021-09-11 18:17:48',NULL),(55,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menghapus Module ID = 3e469998-af47-4b9d-88f9-463cada7406a','2021-09-11 18:21:03','2021-09-11 18:21:03',NULL),(56,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menambah Module ID = 0064bd20-0239-4380-a7c6-4c94e137b94d','2021-09-11 18:22:29','2021-09-11 18:22:29',NULL),(57,'3069bd28-7104-42e3-957f-65e8534e2fd7','Mengubah MenuGrup ID = fe73d568-a426-4753-aa6a-fccec90a6ce0','2021-09-11 18:35:15','2021-09-11 18:35:15',NULL),(58,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menambah Module ID = 262d82ad-43c3-45cd-a027-7e4a7657b504','2021-09-20 01:24:16','2021-09-20 01:24:16',NULL),(59,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menambah Jenis Dokumen ID = 133174b3-eec3-42fd-b0b6-1286e086f079','2021-09-20 01:29:57','2021-09-20 01:29:57',NULL),(60,'3069bd28-7104-42e3-957f-65e8534e2fd7','Mengubah Jenis Dokumen ID = 133174b3-eec3-42fd-b0b6-1286e086f079','2021-09-20 01:31:10','2021-09-20 01:31:10',NULL),(61,'3069bd28-7104-42e3-957f-65e8534e2fd7','Mengubah Jenis Dokumen ID = 133174b3-eec3-42fd-b0b6-1286e086f079','2021-09-22 01:23:37','2021-09-22 01:23:37',NULL),(62,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menambah Jenis Dokumen ID = 746465da-42b9-4ddd-926f-ad6febeb5725','2021-09-22 01:23:45','2021-09-22 01:23:45',NULL),(63,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menghapus Jenis Dokumen ID = 746465da-42b9-4ddd-926f-ad6febeb5725','2021-09-22 01:23:49','2021-09-22 01:23:49',NULL),(64,'3069bd28-7104-42e3-957f-65e8534e2fd7','Update Profile','2021-09-22 02:08:35','2021-09-22 02:08:35',NULL),(65,'3069bd28-7104-42e3-957f-65e8534e2fd7','Update Profile','2021-09-22 02:09:22','2021-09-22 02:09:22',NULL),(66,'3069bd28-7104-42e3-957f-65e8534e2fd7','Login','2021-09-22 02:13:31','2021-09-22 02:13:31',NULL),(67,'3069bd28-7104-42e3-957f-65e8534e2fd7','Login','2021-09-22 06:00:30','2021-09-22 06:00:30',NULL),(68,'3069bd28-7104-42e3-957f-65e8534e2fd7','Login','2021-09-22 20:32:04','2021-09-22 20:32:04',NULL),(69,'3069bd28-7104-42e3-957f-65e8534e2fd7','Update Profile','2021-09-22 20:32:58','2021-09-22 20:32:58',NULL),(70,'3069bd28-7104-42e3-957f-65e8534e2fd7','Login','2021-09-22 20:33:46','2021-09-22 20:33:46',NULL),(71,'3069bd28-7104-42e3-957f-65e8534e2fd7','Login','2021-09-22 20:34:01','2021-09-22 20:34:01',NULL),(72,'3069bd28-7104-42e3-957f-65e8534e2fd7','Login','2021-09-22 20:34:47','2021-09-22 20:34:47',NULL),(73,'3069bd28-7104-42e3-957f-65e8534e2fd7','Login','2021-09-23 00:28:08','2021-09-23 00:28:08',NULL),(74,'3069bd28-7104-42e3-957f-65e8534e2fd7','Login','2021-09-23 00:28:46','2021-09-23 00:28:46',NULL),(75,'3069bd28-7104-42e3-957f-65e8534e2fd7','Login','2021-09-23 00:35:58','2021-09-23 00:35:58',NULL),(76,'3069bd28-7104-42e3-957f-65e8534e2fd7','Login','2021-09-23 00:37:03','2021-09-23 00:37:03',NULL),(77,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menambah Module ID = 85a2eb14-2aea-44cd-9c32-e9a454358dd2','2021-09-23 00:45:10','2021-09-23 00:45:10',NULL),(78,'3069bd28-7104-42e3-957f-65e8534e2fd7','Login','2021-09-23 00:51:54','2021-09-23 00:51:54',NULL),(79,'3069bd28-7104-42e3-957f-65e8534e2fd7','Melakukan Backup DB','2021-09-23 01:03:20','2021-09-23 01:03:20',NULL),(80,'3069bd28-7104-42e3-957f-65e8534e2fd7','Melakukan Backup DB','2021-09-23 01:03:20','2021-09-23 01:03:20',NULL),(81,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menghapus BackupDB ID = ea0497aa-eace-40cd-acef-b53a8ed84cc0','2021-09-23 01:03:40','2021-09-23 01:03:40',NULL),(82,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menghapus BackupDB ID = 97fbbca5-ae3c-43a5-b987-b1b5e19622d1','2021-09-23 01:03:42','2021-09-23 01:03:42',NULL),(83,'3069bd28-7104-42e3-957f-65e8534e2fd7','Melakukan Backup DB','2021-09-23 01:03:44','2021-09-23 01:03:44',NULL),(84,'3069bd28-7104-42e3-957f-65e8534e2fd7','Melakukan Backup DB','2021-09-23 01:17:20','2021-09-23 01:17:20',NULL),(85,'3069bd28-7104-42e3-957f-65e8534e2fd7','Melakukan restore database backup-2021-09-23 (3).sql','2021-09-23 01:44:20','2021-09-23 01:44:20',NULL),(86,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menambah Jenis Dokumen ID = 2370795c-2b35-475f-a421-84dfef4830e1','2021-09-23 01:44:37','2021-09-23 01:44:37',NULL),(87,'3069bd28-7104-42e3-957f-65e8534e2fd7','Melakukan restore database backup-2021-09-23 (4).sql','2021-09-23 01:45:07','2021-09-23 01:45:07',NULL),(88,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menghapus Jenis Dokumen ID = 2370795c-2b35-475f-a421-84dfef4830e1','2021-09-23 01:45:11','2021-09-23 01:45:11',NULL),(89,'3069bd28-7104-42e3-957f-65e8534e2fd7','Login','2021-09-23 01:52:06','2021-09-23 01:52:06',NULL),(90,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menambah Jenis Dokumen ID = 271b0428-08f0-4788-8638-fdbb643b1512','2021-09-23 01:52:20','2021-09-23 01:52:20',NULL),(91,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menghapus Jenis Dokumen ID = 271b0428-08f0-4788-8638-fdbb643b1512','2021-09-23 01:52:31','2021-09-23 01:56:59','2021-09-23 01:56:59'),(92,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menambah Jenis Dokumen ID = 8624bdcc-be01-4757-9900-e168dd84014e','2021-09-23 01:57:07','2021-09-23 01:57:07',NULL),(93,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menghapus Jenis Dokumen ID = 8624bdcc-be01-4757-9900-e168dd84014e','2021-09-23 01:57:10','2021-09-23 01:57:10',NULL),(94,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menambah Jenis Dokumen ID = a1259b45-40e9-4e03-8ad8-d026836fbc84','2021-09-23 01:57:38','2021-09-23 01:57:38',NULL),(95,'3069bd28-7104-42e3-957f-65e8534e2fd7','Mengubah Jenis Dokumen ID = a1259b45-40e9-4e03-8ad8-d026836fbc84','2021-09-23 01:57:43','2021-09-23 01:57:43',NULL),(96,'3069bd28-7104-42e3-957f-65e8534e2fd7','Menghapus Jenis Dokumen ID = a1259b45-40e9-4e03-8ad8-d026836fbc84','2021-09-23 01:57:46','2021-09-23 01:57:46',NULL);
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_grup`
--

DROP TABLE IF EXISTS `menu_grup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_grup` (
  `id_menu_grup` varchar(36) NOT NULL,
  `nm_menu_grup` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `urutan` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu_grup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_grup`
--

LOCK TABLES `menu_grup` WRITE;
/*!40000 ALTER TABLE `menu_grup` DISABLE KEYS */;
INSERT INTO `menu_grup` VALUES ('0ee195cf-24b1-4a57-83fb-4addaebec367','Menu Utama','fa fa-dashboard',1,'2021-08-26 20:56:14','2021-08-26 20:56:14',NULL),('83258632-3d71-4478-aa64-b1bf62345770','Pengaturan','fa fa-folder',3,'2021-09-10 07:32:48','2021-09-10 07:32:48',NULL),('964988a5-a287-42f2-b61b-1caa3055657e','Data Utama','fa fa-folder',2,'2021-09-01 00:03:45','2021-09-01 00:03:45',NULL),('fe73d568-a426-4753-aa6a-fccec90a6ce0','Data Referensi','fa fa-folder',4,'2021-09-01 00:03:31','2021-09-11 18:35:15',NULL);
/*!40000 ALTER TABLE `menu_grup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_03_05_000000_create_accounts_table',1),(2,'2019_03_05_000000_create_contacts_table',1),(3,'2019_03_05_000000_create_organizations_table',1),(4,'2019_03_05_000000_create_password_resets_table',1),(5,'2019_03_05_000000_create_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module` (
  `id_module` varchar(36) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `is_show` tinyint DEFAULT NULL,
  `id_menu_grup` varchar(36) DEFAULT NULL,
  `urutan` int DEFAULT '0',
  `parent_id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_module`),
  KEY `module_FK` (`id_menu_grup`),
  CONSTRAINT `module_FK` FOREIGN KEY (`id_menu_grup`) REFERENCES `menu_grup` (`id_menu_grup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES ('0064bd20-0239-4380-a7c6-4c94e137b94d','Log','fa fa-history','log',1,'0ee195cf-24b1-4a57-83fb-4addaebec367',99,'0','2021-09-11 18:22:29','2021-09-11 18:22:29',NULL),('03e9c167-7b6e-455f-9415-ff9ec4d7b017','02020','fa fa-users','qwdqwd',1,'0ee195cf-24b1-4a57-83fb-4addaebec367',1,'0','2021-09-10 07:09:09','2021-09-10 07:31:12','2021-09-10 07:31:12'),('1563e47d-c506-4073-ae61-55922f7b3d78','Users','fa fa-angle-right','users',1,'0ee195cf-24b1-4a57-83fb-4addaebec367',8,'0','2021-08-31 23:55:00','2021-09-10 07:38:48','2021-09-10 07:38:48'),('262d82ad-43c3-45cd-a027-7e4a7657b504','Jenis Dokumen','fa fa-folder','ref-jns-dokumen',1,'fe73d568-a426-4753-aa6a-fccec90a6ce0',1,'0','2021-09-20 01:24:16','2021-09-20 01:24:16',NULL),('3be55c7b-e194-4691-95e1-450964f05678','Menu','fa fa-bars','module',1,'83258632-3d71-4478-aa64-b1bf62345770',2,'0','2021-08-31 23:55:00','2021-09-10 07:35:00',NULL),('3e469998-af47-4b9d-88f9-463cada7206a','Dashboard','fa fa-tachometer-alt','dashboard',1,'0ee195cf-24b1-4a57-83fb-4addaebec367',0,'0','2021-08-26 21:24:42','2021-08-26 21:24:42',NULL),('3e469998-af47-4b9d-88f9-463cada7406a','Book','fa fa-folder','book',1,'0ee195cf-24b1-4a57-83fb-4addaebec367',1,'0','2021-08-26 21:24:42','2021-09-11 18:21:03','2021-09-11 18:21:03'),('3e469998-af47-4b9d-88f9-463cada7407a','Book','fa fa-folder','book',1,'0ee195cf-24b1-4a57-83fb-4addaebec367',1,'3e469998-af47-4b9d-88f9-463cada7406a','2021-08-26 21:24:42','2021-08-26 21:24:42',NULL),('474d9d4c-e803-4725-a0d1-e26bf6bc05ec','Menu Grup','fa fa-cog','menu-grup',1,'83258632-3d71-4478-aa64-b1bf62345770',1,'0','2021-08-31 23:55:00','2021-09-10 07:34:46',NULL),('4d55a183-fdd2-4df8-83aa-ea022c2771e0','wqdw','wqd','dwqd',1,'964988a5-a287-42f2-b61b-1caa3055657e',0,'0','2021-09-10 07:06:03','2021-09-10 07:06:51','2021-09-10 07:06:51'),('55e4e45a-1e63-429b-b2a1-f06ef4edbfac','User','fa fa-folder','users',1,'0ee195cf-24b1-4a57-83fb-4addaebec367',1,'68a7a54b-5e3f-4569-aee4-89ab0d5c3ddb','2021-09-11 18:16:22','2021-09-11 18:16:22',NULL),('60f45852-0030-435e-957c-25aff1a20cac','wqewqe','wqew','wqeqw',1,'964988a5-a287-42f2-b61b-1caa3055657e',2,'03e9c167-7b6e-455f-9415-ff9ec4d7b017','2021-09-10 07:27:05','2021-09-10 07:31:03','2021-09-10 07:31:03'),('68a7a54b-5e3f-4569-aee4-89ab0d5c3ddb','Users','fa fa-users','users',1,'0ee195cf-24b1-4a57-83fb-4addaebec367',9,'0','2021-09-10 07:38:30','2021-09-10 07:38:30',NULL),('7346e8d7-d59c-4f32-925c-c55ed506f622','User','fa fa-folder','users',1,'0ee195cf-24b1-4a57-83fb-4addaebec367',1,'68a7a54b-5e3f-4569-aee4-89ab0d5c3ddb','2021-09-11 11:14:43','2021-09-11 18:16:04','2021-09-11 18:16:04'),('85a2eb14-2aea-44cd-9c32-e9a454358dd2','Backup DB','fa fa-database','backup-db',1,'83258632-3d71-4478-aa64-b1bf62345770',4,'0','2021-09-23 00:45:10','2021-09-23 00:45:10',NULL),('9eb6f7cf-7914-40ab-8f7f-7c55945d858b','Role','fa fa-folder','role',1,'0ee195cf-24b1-4a57-83fb-4addaebec367',2,'0','2021-09-10 07:41:21','2021-09-11 18:17:48','2021-09-11 18:17:48'),('a070d1b1-2f31-4de7-a2a2-b4f7d1a62b2c','Role Privilege','fa fa-folder','role-privilege',0,'0ee195cf-24b1-4a57-83fb-4addaebec367',3,'0','2021-09-10 08:03:28','2021-09-10 08:03:28',NULL),('d3d5f2d9-2e57-480f-85c2-287b4fc05c59','User','fa fa-folder','users',1,'0ee195cf-24b1-4a57-83fb-4addaebec367',1,'68a7a54b-5e3f-4569-aee4-89ab0d5c3ddb','2021-09-11 11:11:33','2021-09-11 18:15:57','2021-09-11 18:15:57'),('f4e73593-0eae-4d81-ab44-9d2e9ad5e96e','Role','fa fa-folder','role',1,'0ee195cf-24b1-4a57-83fb-4addaebec367',2,'68a7a54b-5e3f-4569-aee4-89ab0d5c3ddb','2021-09-11 18:17:13','2021-09-11 18:17:13',NULL),('f9c038ec-3792-427c-a3c7-65ea911c5af8','asasa','wqew','wqewq',0,'964988a5-a287-42f2-b61b-1caa3055657e',2,'03e9c167-7b6e-455f-9415-ff9ec4d7b017','2021-09-10 07:25:36','2021-09-10 07:30:58','2021-09-10 07:30:58');
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
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
-- Table structure for table `ref_jns_dokumen`
--

DROP TABLE IF EXISTS `ref_jns_dokumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ref_jns_dokumen` (
  `id_jns_dokumen` varchar(36) NOT NULL,
  `nm_jns_dokumen` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_jns_dokumen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ref_jns_dokumen`
--

LOCK TABLES `ref_jns_dokumen` WRITE;
/*!40000 ALTER TABLE `ref_jns_dokumen` DISABLE KEYS */;
INSERT INTO `ref_jns_dokumen` VALUES ('133174b3-eec3-42fd-b0b6-1286e086f079','Foto Profil','2021-09-20 01:29:57','2021-09-20 01:29:57',NULL),('2370795c-2b35-475f-a421-84dfef4830e1','fff','2021-09-23 01:44:37','2021-09-23 01:45:11','2021-09-23 01:45:11'),('271b0428-08f0-4788-8638-fdbb643b1512','wefwef','2021-09-23 01:52:20','2021-09-23 01:52:31','2021-09-23 01:52:31'),('746465da-42b9-4ddd-926f-ad6febeb5725','ddd','2021-09-22 01:23:45','2021-09-22 01:23:49','2021-09-22 01:23:49'),('8624bdcc-be01-4757-9900-e168dd84014e','dsfdsfe','2021-09-23 01:57:07','2021-09-23 01:57:10','2021-09-23 01:57:10'),('a1259b45-40e9-4e03-8ad8-d026836fbc84','ddd d','2021-09-23 01:57:38','2021-09-23 01:57:46','2021-09-23 01:57:46');
/*!40000 ALTER TABLE `ref_jns_dokumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `id_role` varchar(36) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `role_slug` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES ('2ab93bfc-bbad-306b-b82c-ef4c397b6610','Admin','admin','2021-08-26 21:36:09','2021-08-26 21:36:09',NULL),('4dd35b56-cf8b-334f-a497-287ec47bdc04','Superadmin','superadmin','2021-08-26 21:36:09','2021-08-26 21:36:09',NULL);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_privilege`
--

DROP TABLE IF EXISTS `role_privilege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_privilege` (
  `id_role_privilege` varchar(36) NOT NULL,
  `id_role` varchar(36) DEFAULT NULL,
  `id_module` varchar(36) DEFAULT NULL,
  `can_create` tinyint DEFAULT NULL,
  `can_read` tinyint DEFAULT NULL,
  `can_update` tinyint DEFAULT NULL,
  `can_delete` tinyint DEFAULT NULL,
  `can_validate` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_role_privilege`),
  KEY `role_privilege_FK` (`id_role`),
  KEY `role_privilege_FK_1` (`id_module`),
  CONSTRAINT `role_privilege_FK` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  CONSTRAINT `role_privilege_FK_1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_privilege`
--

LOCK TABLES `role_privilege` WRITE;
/*!40000 ALTER TABLE `role_privilege` DISABLE KEYS */;
INSERT INTO `role_privilege` VALUES ('03355bcf-be0a-489e-915b-3d5136b80c61','4dd35b56-cf8b-334f-a497-287ec47bdc04','68a7a54b-5e3f-4569-aee4-89ab0d5c3ddb',1,1,1,1,NULL,'2021-09-11 08:40:18','2021-09-11 08:40:35',NULL),('7615bd93-bb48-449e-9fa1-efcfe1250c0a','4dd35b56-cf8b-334f-a497-287ec47bdc04','f4e73593-0eae-4d81-ab44-9d2e9ad5e96e',1,1,1,1,NULL,'2021-09-11 18:17:23','2021-09-11 18:17:27',NULL),('8a40328c-4fc6-435c-9c96-b393bc369bd9','4dd35b56-cf8b-334f-a497-287ec47bdc04','0064bd20-0239-4380-a7c6-4c94e137b94d',0,1,0,1,NULL,'2021-09-11 18:22:38','2021-09-23 01:56:46',NULL),('a097e66e-5f4b-487a-beb4-15b94fa00581','4dd35b56-cf8b-334f-a497-287ec47bdc04','85a2eb14-2aea-44cd-9c32-e9a454358dd2',1,1,1,1,NULL,'2021-09-23 00:45:21','2021-09-23 00:45:23',NULL),('e24a61ea-cwec-3448-a7fd-0733badm384d','4dd35b56-cf8b-334f-a497-287ec47bdc04','9eb6f7cf-7914-40ab-8f7f-7c55945d858b',1,1,1,1,0,'2021-08-26 21:36:09','2021-08-26 21:36:09',NULL),('e24a61ea-cwec-3448-a7fd-0735badm384d','4dd35b56-cf8b-334f-a497-287ec47bdc04','a070d1b1-2f31-4de7-a2a2-b4f7d1a62b2c',1,1,1,1,0,'2021-08-26 21:36:09','2021-08-26 21:36:09',NULL),('e24a65ea-caec-3448-a7fd-0733bada384d','4dd35b56-cf8b-334f-a497-287ec47bdc04','3e469998-af47-4b9d-88f9-463cada7206a',1,1,1,1,0,'2021-08-26 21:36:09','2021-08-26 21:36:09',NULL),('e24a65ea-caec-3448-a7fd-0733badm384d','4dd35b56-cf8b-334f-a497-287ec47bdc04','474d9d4c-e803-4725-a0d1-e26bf6bc05ec',1,1,1,1,0,'2021-08-26 21:36:09','2021-08-26 21:36:09',NULL),('e24a65ea-caec-3448-a7fd-0733badt384d','4dd35b56-cf8b-334f-a497-287ec47bdc04','3e469998-af47-4b9d-88f9-463cada7407a',1,1,1,1,0,'2021-08-26 21:36:09','2021-08-26 21:36:09',NULL),('e24a65ea-caec-3448-a7fd-0733bafa382d','2ab93bfc-bbad-306b-b82c-ef4c397b6610','3e469998-af47-4b9d-88f9-463cada7406a',1,1,1,1,0,'2021-08-26 21:36:09','2021-08-26 21:36:09',NULL),('e24a65ea-caec-3448-a7fd-0733bafa384d','4dd35b56-cf8b-334f-a497-287ec47bdc04','3e469998-af47-4b9d-88f9-463cada7406a',1,1,1,1,0,'2021-08-26 21:36:09','2021-08-26 21:36:09',NULL),('e24a65ea-caec-3448-a7fd-0733cafa382d','2ab93bfc-bbad-306b-b82c-ef4c397b6610','3e469998-af47-4b9d-88f9-463cada7206a',1,1,1,1,0,'2021-08-26 21:36:09','2021-08-26 21:36:09',NULL),('e24a65ea-caec-3448-a7fs-0733cafa382d','2ab93bfc-bbad-306b-b82c-ef4c397b6610','3e469998-af47-4b9d-88f9-463cada7407a',1,1,1,1,0,'2021-08-26 21:36:09','2021-08-26 21:36:09','2021-08-26 21:36:09'),('e24a65ea-cwec-3448-a7fd-0733badm384d','4dd35b56-cf8b-334f-a497-287ec47bdc04','3be55c7b-e194-4691-95e1-450964f05678',1,1,1,1,0,'2021-08-26 21:36:09','2021-08-26 21:36:09',NULL),('e2e7013c-0e8b-4f04-a7d2-b4a5b022b4d3','2ab93bfc-bbad-306b-b82c-ef4c397b6610','3be55c7b-e194-4691-95e1-450964f05678',NULL,0,NULL,NULL,NULL,'2021-09-11 08:31:41','2021-09-11 08:40:08',NULL),('e4f51431-4108-4451-9b55-3cb6e4e908df','2ab93bfc-bbad-306b-b82c-ef4c397b6610','0064bd20-0239-4380-a7c6-4c94e137b94d',1,1,NULL,NULL,NULL,'2021-09-11 23:01:44','2021-09-11 23:01:46',NULL),('e9480740-255d-4cc2-8b86-27068ddad21b','4dd35b56-cf8b-334f-a497-287ec47bdc04','262d82ad-43c3-45cd-a027-7e4a7657b504',1,1,1,1,NULL,'2021-09-20 01:24:29','2021-09-20 01:24:33',NULL),('f33b7eeb-4ae3-4c55-840c-3cd7f22700b5','4dd35b56-cf8b-334f-a497-287ec47bdc04','55e4e45a-1e63-429b-b2a1-f06ef4edbfac',1,1,1,1,NULL,'2021-09-11 18:16:35','2021-09-11 18:16:38',NULL);
/*!40000 ALTER TABLE `role_privilege` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_role` (
  `id_user_role` varchar(36) NOT NULL,
  `id_role` varchar(36) DEFAULT NULL,
  `id_user` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user_role`),
  KEY `user_role_FK` (`id_role`),
  KEY `user_role_FK_1` (`id_user`),
  CONSTRAINT `user_role_FK` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  CONSTRAINT `user_role_FK_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES ('0f1355aa-def9-41ff-8ee9-81ce65a420c3','4dd35b56-cf8b-334f-a497-287ec47bdc04','3069bd28-7104-42e3-957f-65e8534e2fd7','2021-09-11 11:10:15','2021-09-11 11:10:15',NULL),('4dd35b56-cf8b-334f-a497-287ec47bdc24','4dd35b56-cf8b-334f-a497-287ec47bdc04','1','2021-08-26 21:36:09','2021-08-26 21:36:09',NULL),('4dd35b56-cf8b-334f-a497-287ec47wdc24','2ab93bfc-bbad-306b-b82c-ef4c397b6610','1','2021-08-26 21:36:09','2021-08-26 21:36:09',NULL),('635c3a07-c5d0-4299-80f9-91c5836b945f','2ab93bfc-bbad-306b-b82c-ef4c397b6610','d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 11:08:01','2021-09-11 11:08:11','2021-09-11 11:08:11'),('699f5f12-a16c-4c46-87bc-67a46c7d3e4d','2ab93bfc-bbad-306b-b82c-ef4c397b6610','c8c549d2-dbd8-4225-a527-7e1e930c35f3','2021-09-11 10:26:09','2021-09-11 10:26:09',NULL),('75669b59-5bd2-4a28-b155-e5c2d3d51baf','4dd35b56-cf8b-334f-a497-287ec47bdc04','d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 11:09:39','2021-09-11 11:09:45','2021-09-11 11:09:45'),('8395b9ee-5114-4ab8-bb04-2990a1e0fb91','4dd35b56-cf8b-334f-a497-287ec47bdc04','d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 11:08:11','2021-09-11 11:09:39','2021-09-11 11:09:39'),('8adc1aab-7b5f-416c-b8cc-557ad1e3885b','4dd35b56-cf8b-334f-a497-287ec47bdc04','d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 11:09:45','2021-09-11 11:09:45',NULL),('cdf5dcb3-d881-4665-9534-c483cd36f3e9','2ab93bfc-bbad-306b-b82c-ef4c397b6610','d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 11:08:11','2021-09-11 11:09:39','2021-09-11 11:09:39'),('e236e38a-7cb3-458e-9fa5-e96641a9c36c','4dd35b56-cf8b-334f-a497-287ec47bdc04','d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 11:08:01','2021-09-11 11:08:11','2021-09-11 11:08:11'),('e542ff71-1324-475b-b786-fd6350c337f8','4dd35b56-cf8b-334f-a497-287ec47bdc04','c8c549d2-dbd8-4225-a527-7e1e930c35f3','2021-09-11 10:26:09','2021-09-11 10:26:09',NULL),('f01ff450-a86d-431b-bf25-3a1b2f8e67a3','2ab93bfc-bbad-306b-b82c-ef4c397b6610','d762b9e0-891e-46a4-b86a-7d86550489f6','2021-09-11 10:26:34','2021-09-11 11:07:35','2021-09-11 11:07:35'),('f5c6904b-81de-49ee-9a61-77dc1ebc6eb6','2ab93bfc-bbad-306b-b82c-ef4c397b6610','3069bd28-7104-42e3-957f-65e8534e2fd7','2021-09-11 11:10:15','2021-09-11 11:10:15',NULL);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('061aedf8-5737-4a1d-a6ab-31324f80fb94','wdw','dwdw@dw.dwdw','$2y$10$6f2HiTWMnm9gqdE29qQZAOiMoFjmREgt6X/D8VyeFmUPhLeso4K6G',NULL,NULL,'2021-09-11 10:25:38','2021-09-11 10:26:15','2021-09-11 10:26:15'),('1','John','johndoe@example.com','$2y$10$N8qx.tvDZqnRsEPplqHoOu36eXc2BCxGL5eBuxY98m4gksMk6a8Sq',NULL,'CfvSaRymljawnWflRi6TbXJYinBxq6MNCHvgrKN5Kp5IF9fEgszUAdbPqTZm','2021-08-19 08:39:22','2021-08-19 08:39:22',NULL),('2','Carmelo','crona.elvis@example.net','$2y$10$HOG0w2T2oWV7ABvfhzw1weGneCtikdtTXMdF.Iqifr3UHmZClqdN.',NULL,'UBpslLROuV','2021-08-19 08:39:23','2021-09-11 09:17:40','2021-09-11 09:17:40'),('3','Sheila','roosevelt22@example.com','$2y$10$MDW3WB78If.Ubs/Y4LcW7.1paTAwQ7qjmUnHPZ9LIt5P6GXUjKIkm',NULL,'nDKGXDdX5N','2021-08-19 08:39:23','2021-09-11 09:17:44','2021-09-11 09:17:44'),('3069bd28-7104-42e3-957f-65e8534e2fd7','Kang Sae Byeok','admin@admin.com','$2y$10$8JQjlkqQh5AQLjBGfFaE8enTZu5oPTHj6eBGtsBVx7Dl05BnCUEBq',NULL,'VmTSjkamwlg1emhkQXzomeokD3VRk3d3OYFiV4LRQoivCyYo6yxxoGQ9pg2f','2021-09-11 11:10:15','2021-09-22 20:32:58',NULL),('4','Karine','everardo.miller@example.net','$2y$10$0zcYmFsuS0xPZvpaGDVGTOqX8ZGJRghg0PXOlKD6LXAWXvGkuy5py',NULL,'HVrlZ1KUI8','2021-08-19 08:39:23','2021-09-11 09:17:47','2021-09-11 09:17:47'),('5','Alejandra','fpouros@example.org','$2y$10$HAhu0yRyYsheq5KT3GTs2.hWK4Y/jxjYFD7DHo/74hQ.4gpehowNu',NULL,'h8CNjHYBKZ','2021-08-19 08:39:23','2021-09-11 09:17:49','2021-09-11 09:17:49'),('6','Elmo','rutherford.wellington@example.org','$2y$10$KUheq3j5k80uQedGNRH.eO2FHN5QwN5wOYB1vHfWKoEHaNfQqMapS',NULL,'8ZnY4uJMJbR5faGmtMsJ9APCPhTWDPaBlMQFIaVxzIL7UtHGd6SYAPFMp1Kj','2021-08-19 08:39:23','2021-09-11 09:17:52','2021-09-11 09:17:52'),('6abb8a59-6f44-4773-b50a-fe7e86ab3ac7','dwdw','wdwd@dw.wdw','$2y$10$HWULCYTBcvAuvMWDWMbbqu102R2PErMSbILKmCWpl4mTel03IOXtG',NULL,NULL,'2021-09-11 10:19:33','2021-09-11 10:20:17','2021-09-11 10:20:17'),('6b5be2f0-00f1-4b5f-b3ed-024065722034','dwdw','dw@dwdw.dwdw','$2y$10$SLrfeYDcL0SWZFBbXIQ2a.yz.rjztz//i4iQQwcTcCgnEgTB3QfBq',NULL,NULL,'2021-09-11 10:13:42','2021-09-11 10:13:47','2021-09-11 10:13:47'),('7b6db6ec-a742-423b-b138-8d6c1b2cfe58','wdwd','wdw@wd.wdw','$2y$10$CTxy4.fBd8OzkhNWwxGdq.C/.IfNEIXB7kLuC.AbT73reQlg0IPvS',NULL,NULL,'2021-09-11 10:20:28','2021-09-11 10:26:18','2021-09-11 10:26:18'),('c8c549d2-dbd8-4225-a527-7e1e930c35f3','wdwd','wdw@w.wdwd','$2y$10$XjuowX00UO5rN7eeCYuOZ.qnoPf14xmNop6Yw5ZgcTMCkfA/mHzZS',NULL,NULL,'2021-09-11 10:26:09','2021-09-11 10:26:23','2021-09-11 10:26:23'),('d762b9e0-891e-46a4-b86a-7d86550489f6','dwdw wdwd','sqwsw@wd.wdw','$2y$10$bW8LlLuQmEhZe/qy1Tv0h.o83drNqcr0Q/ZVIRff.gljbqJzkXLoG',NULL,NULL,'2021-09-11 10:26:34','2021-09-11 11:09:55','2021-09-11 11:09:55');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'laravel_react_crm'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-23 15:58:37
