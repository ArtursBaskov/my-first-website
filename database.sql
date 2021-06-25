-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: 127.0.0.5    Database: kvd
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Daugavpils'),(2,'Jēkabpils'),(3,'Jelgava'),(4,'Jūrmala'),(5,'Liepāja'),(6,'Rēzekne'),(7,'Rīga'),(8,'Valmiera'),(9,'Ventspils'),(10,'Ainaži'),(11,'Aizkraukle'),(12,'Aizpute'),(13,'Aknīste'),(14,'Aloja'),(15,'Alūksne'),(16,'Ape'),(17,'Auce'),(18,'Baldone'),(19,'Baloži'),(20,'Balvi'),(21,'Bauska'),(22,'Brocēni'),(23,'Cēsis'),(24,'Cesvaine'),(25,'Dagda'),(26,'Dobele'),(27,'Durbe'),(28,'Grobiņa'),(29,'Gulbene'),(30,'Ikšķile'),(31,'Ilūkste'),(32,'Jaunjelgava'),(33,'Kandava'),(34,'Kārsava'),(35,'Krāslava'),(36,'Kuldīga'),(37,'Ķegums'),(38,'Lielvārde'),(39,'Līgatne'),(40,'Limbaži'),(41,'Līvāni'),(42,'Lubāna'),(43,'Ludza'),(44,'Madona'),(45,'Mazsalaca'),(46,'Ogre'),(47,'Olaine'),(48,'Pāvilosta'),(49,'Piltene'),(50,'Pļaviņas'),(51,'Preiļi'),(52,'Priekule'),(53,'Rūjiena'),(54,'Sabile'),(55,'Salacgrīva'),(56,'Salaspils'),(57,'Saldus'),(58,'Saulkrasti'),(59,'Seda'),(60,'Sigulda'),(61,'Skrunda'),(62,'Smiltene'),(63,'Staicele'),(64,'Stende'),(65,'Strenči'),(66,'Subate'),(67,'Talsi'),(68,'Tukums'),(69,'Valdemārpils'),(70,'Valka'),(71,'Vangaži'),(72,'Varakļāni'),(73,'Viesīte'),(74,'Viļaka'),(75,'Viļāni'),(76,'Zilupe');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `comment_section`
--

LOCK TABLES `comment_section` WRITE;
/*!40000 ALTER TABLE `comment_section` DISABLE KEYS */;
INSERT INTO `comment_section` VALUES (10,'Rimi',62,'70651','Artūrs','Labs veikals! Nopikru tur makaronus.','2021-05-10 16:27:47'),(12,'Rimi',62,'70651','Artūrs','Sliktas cenas :(','2021-05-10 16:50:09'),(15,'Rimi',62,'70651','Artūrs','&lt;button&gt;&lt;/button&gt;','2021-05-10 22:44:00'),(17,'Rimi',62,'46669','adminre','Labs','2021-05-11 12:30:19'),(19,'Veikals',70,'70651','Artūrs','Labs veikals.','2021-06-07 09:27:36');
/*!40000 ALTER TABLE `comment_section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `info`
--

LOCK TABLES `info` WRITE;
/*!40000 ALTER TABLE `info` DISABLE KEYS */;
INSERT INTO `info` VALUES (62,'Artūrs','70651','Rimi','9:00 - 22:00','+37114785236','asd@asd.lv','<p><strong>Pārtikas veikals, kur.........</strong></p>\r\n','accepted','uznemumi/uzn_Rimi_files/uzn_Rimi.jpg','tur','Daugavpils','LV-2344','dasdasd'),(65,'Artūrs','70651','Maxima','9:00 - 22:00','+37114785236','asd@asd.com','Once almost all of the flour is incorporated, start bringing the dough together with your hands. (The dough should be malleable, but not sticky--add more flour if the dough is sticking too much to your hands or the surface. Alternatively, if it’s too dry and tough, whisk another egg with 1 tablespoon of water and use your hand to sprinkle some of the mixture over the dough, continuing to do so until the dough is easier to knead.)what?','accepted','uznemumi/uzn_Maxima_files/uzn_Maxima.jpg','nezinu','Daugavpils','LV-6657','OK'),(67,'Artūrs','70651','Pizza','10:00 - 21:00','14785236','asd@asd.com','<h1><strong>Pica. <q><em>pica</em></q></strong></h1>\r\n','denied','uznemumi/uzn_Pizza_files/uzn_Pizza.jpg','tur','Valmiera','LV-65766899090',''),(70,'Artūrs','70651','Veikals','8:00 - 22:00 - Darba dienās','+37112365478','veikals@veikals.lv','<p>Var nopirkt produktus.</p>\r\n','accepted','uznemumi/uzn_Veikals_files/uzn_Veikals.jpg','tur','Daugavpils','LV-2344','');
/*!40000 ALTER TABLE `info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'6425','Administrator','$2y$10$.UlKFkzGjh2f/EMfJQGbtuExrfA2u.f9obzhqWD9jSdkMIdgNyW6a','admin@admin','inactive_email_user',NULL,'2021-02-21 13:59:58.000000','admin',NULL,NULL),(9,'74765','artur.baskov','$2y$10$G5LjBcTD/rNQF5P0IEnCsebrmnqWiQ0O20o3Zce.BNria.5fG3EGK','2jauns@pasts.com','inactive_email_user',NULL,NULL,'default',NULL,NULL),(10,'84239','artur.baskovv','$2y$10$hUXnlEp6CQzE.I8AXuwuRO/kRrR0tkFOYZK6Kv8gsVg0O4jeXa.36','me@gmai.com','inactive_email_user',NULL,NULL,'default',NULL,NULL),(11,'55504','ArtursBaskov','$2y$10$sriemSb/9imL8cPOkE/Rc.V0JI7BOc97L2a9WAIP7zJWdqnvqbphG','','inactive_email_user',NULL,NULL,'default',NULL,NULL),(13,'24731','Arturs','$2y$10$Owam8URLoNRpgcfW/EaAlexSjEZNUbuDizgS0C6/MVSCmxamJoPw.','jauns@pasts.com','inactive_email_user',NULL,'2021-02-17 14:41:20.000000','default',NULL,NULL),(15,'87955','<?php ','$2y$10$P3GDVu8m/H8.qlgExQMbFe2HKfnILCGMcpgBJHbTixt/KGnXWmiYO','e@e.lv','inactive_email_user',NULL,'2021-03-02 17:02:21.000000','default',NULL,NULL),(16,'33091','Artūrs','$2y$10$n6qofmXS/oF1mJOxpHbRn.sg8Pt2X3CVUqnHkKqwymx.ZrstmO10C','12arturb34@gmail.com3333333333','inactive_email_user',NULL,'2021-04-21 22:31:43.000000','default',NULL,NULL),(17,'70651','Artūrs','$2y$10$C4pd3Lu0s/fPwGLB/D4bqu9nK/JQ8ikWG/cnlLFFhtH9YNHP6milG','12arturb34@gmail.com','email_code_is_checked_email_verified','','2021-04-21 22:32:12.000000','admin','user_files/userFolder_Arturs_70651/uzn_user_70651_Arturs.jpg','2021-05-11 17:04:06'),(29,'46669','adminre','$2y$10$hL/rPJSoWR/L2RtsCYlOuuR/jDmCr.UyTP9ghSFYCQ5dYvCK/U/QC','artur.baskov@va.lv','inactive_email_user','846248','2021-05-03 17:45:20.000000','default','user_files/userFolder_adminre_46669/uzn_user_46669_adminre.jpg','2021-05-04 14:01:13');
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

-- Dump completed on 2021-06-25 13:54:09
