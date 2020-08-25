-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: apsky-blog    Database: apsky-blog
-- ------------------------------------------------------
-- Server version	8.0.19

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
-- Table structure for table `auth-category`
--

DROP TABLE IF EXISTS `auth-category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth-category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_id_uindex` (`id`),
  UNIQUE KEY `category_name_uindex` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth-category`
--

LOCK TABLES `auth-category` WRITE;
/*!40000 ALTER TABLE `auth-category` DISABLE KEYS */;
INSERT INTO `auth-category` VALUES (1,'Admin'),(2,'Moderator'),(3,'Registered'),(4,'Unregistered');
/*!40000 ALTER TABLE `auth-category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth-category_users`
--

DROP TABLE IF EXISTS `auth-category_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth-category_users` (
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`category_id`,`user_id`),
  KEY `auth-category_users_user_id_fk` (`user_id`),
  CONSTRAINT `auth-category_users_auth-category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `auth-category` (`id`),
  CONSTRAINT `auth-category_users_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth-category_users`
--

LOCK TABLES `auth-category_users` WRITE;
/*!40000 ALTER TABLE `auth-category_users` DISABLE KEYS */;
INSERT INTO `auth-category_users` VALUES (1,1),(2,1),(3,1),(2,2),(3,3),(3,4),(3,24);
/*!40000 ALTER TABLE `auth-category_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'defaultBlog.png',
  `text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_id_uindex` (`id`),
  KEY `blog_user_user_id_fk` (`user_id`),
  CONSTRAINT `blog_user_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (1,1,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 13:32:28','2020-08-13 11:38:03'),(7,1,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 13:32:48','2020-08-13 11:29:16'),(8,2,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.\r\n','2020-08-12 14:33:29','2020-08-13 11:29:16'),(9,2,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.\r\n','2020-08-12 14:33:32','2020-08-13 11:29:16'),(10,1,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.\r\n','2020-08-12 14:33:33','2020-08-13 11:29:16'),(13,1,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 14:33:34','2020-08-13 11:29:16'),(14,1,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 14:33:35','2020-08-13 11:29:16'),(15,1,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 14:33:35','2020-08-13 11:29:16'),(16,1,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 14:33:36','2020-08-13 11:29:16'),(18,2,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 14:33:37','2020-08-13 11:29:16'),(19,3,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 14:33:36','2020-08-13 11:29:16'),(20,3,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 14:33:38','2020-08-13 11:29:16'),(21,3,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 14:33:38','2020-08-13 11:29:16'),(22,2,'Статья','test-jpg_22.jpg','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut123.','2020-08-12 21:00:00','2020-08-13 13:13:34'),(23,3,'Статья','test-jpg_23.jpg','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 21:00:00','2020-08-14 08:50:31'),(24,3,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-13 11:27:16','2020-08-13 11:29:16'),(25,1,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-13 11:27:16','2020-08-13 11:29:16'),(26,1,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-13 11:27:16','2020-08-13 11:29:16'),(27,1,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 14:33:46','2020-08-13 11:29:16'),(28,2,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 14:33:45','2020-08-13 11:29:16'),(29,3,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 14:33:46','2020-08-13 11:29:16'),(30,1,'Статья','defaultBlog.png','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-12 14:33:46','2020-08-13 11:29:16'),(34,1,'test','defaultBlog.png','test','2020-08-14 17:11:59','2020-08-14 17:11:59'),(36,1,'test#','test-jpg_36.jpg','test#','2020-08-12 17:36:00','2020-08-19 14:24:42');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `blog_id` int NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `comment_id_uindex` (`id`),
  KEY `comment_blog_id_fk` (`blog_id`),
  KEY `comment_user_id_fk` (`user_id`),
  CONSTRAINT `comment_blog_id_fk` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`),
  CONSTRAINT `comment_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,1,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-07-28 20:16:34',1),(2,2,7,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-07-28 20:16:34',1),(3,2,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-07-28 20:16:34',1),(4,1,8,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-07-28 20:16:34',1),(5,1,13,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-07-28 20:16:34',1),(6,1,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-07-29 18:56:34',1),(7,1,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-07-29 18:56:34',1),(8,1,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-07-29 18:56:34',0),(9,1,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-07-29 18:56:34',0),(10,1,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-07-29 18:56:34',0),(11,1,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-07-29 18:56:34',0),(22,4,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-03 18:59:33',0),(23,1,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.','2020-08-03 19:22:30',1),(24,4,1,'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut1.','2020-08-03 19:22:56',1),(33,1,34,'qweqewqe','2020-08-21 08:34:12',1),(34,1,25,'qweqeq','2020-08-21 08:45:33',1),(36,4,25,'qweqe','2020-08-24 06:08:27',0);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_id_uindex` (`id`),
  UNIQUE KEY `pages_name_uindex` (`name`),
  UNIQUE KEY `pages_src_uindex` (`src`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (2,'testpage','pages/testpage.php','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto dignissimos eveniet incidunt iure laborum, libero maiores nulla, placeat praesentium quas voluptate. Adipisci aliquid, commodi eaque optio repellendus reprehenderit ut.'),(3,'rules','pages/terms.php','<h3 class=\"font-weight-bold\" style=\"font-size: 1rem\">Privacy Policy</h3>\r\n\r\n            <p>\r\n                Paul built the apsky-blog app as\r\n                an Open Source app. This SERVICE is provided by\r\n                Paul at no cost and is intended for use as\r\n                is.\r\n            </p>\r\n\r\n            <p>\r\n                This page is used to inform visitors regarding my\r\n                policies with the collection, use, and disclosure of Personal\r\n                Information if anyone decided to use my Service.\r\n            </p>\r\n\r\n            <p>\r\n                If you choose to use my Service, then you agree to\r\n                the collection and use of information in relation to this\r\n                policy. The Personal Information that I collect is\r\n                used for providing and improving the Service. I will not use or share your information with\r\n                anyone except as described in this Privacy Policy.\r\n            </p>\r\n            <p>\r\n                The terms used in this Privacy Policy have the same meanings\r\n                as in our Terms and Conditions, which is accessible at\r\n                apsky-blog unless otherwise defined in this Privacy Policy.\r\n            </p>\r\n\r\n            <h3 class=\"text-dark font-weight-bold\" style=\"font-size: 1rem\">Information Collection and Use</h3>\r\n\r\n            <p>\r\n                For a better experience, while using our Service, I\r\n                may require you to provide us with certain personally\r\n                identifiable information, including but not limited to blog. The information that\r\n                I request will be retained on your device and is not collected by me in any way.\r\n            </p>\r\n\r\n            <div>\r\n                <p>\r\n                    The app does use third party services that may collect\r\n                    information used to identify you.\r\n                </p>\r\n\r\n                <p>\r\n                    Link to privacy policy of third party service providers used\r\n                    by the app\r\n                </p>\r\n                <ul>\r\n                    <li><a href=\"https://www.google.com/policies/privacy/\" target=\"_blank\" rel=\"noopener noreferrer\">Google Play Services</a></li>\r\n                </ul>\r\n            </div>\r\n\r\n            <h3 class=\"text-dark font-weight-bold\" style=\"font-size: 1rem\">Log Data</h3>\r\n\r\n            <p>\r\n                I want to inform you that whenever you\r\n                use my Service, in a case of an error in the app\r\n                I collect data and information (through third party\r\n                products) on your phone called Log Data. This Log Data may\r\n                include information such as your device Internet Protocol\r\n                (“IP”) address, device name, operating system version, the\r\n                configuration of the app when utilizing my Service,\r\n                the time and date of your use of the Service, and other\r\n                statistics.\r\n            </p>\r\n\r\n            <h3 class=\"text-dark font-weight-bold\" style=\"font-size: 1rem\">Cookies</h3>\r\n\r\n            <p>\r\n                Cookies are files with a small amount of data that are\r\n                commonly used as anonymous unique identifiers. These are sent\r\n                to your browser from the websites that you visit and are\r\n                stored on your device\'s internal memory.\r\n            </p>\r\n\r\n            <p>\r\n                This Service does not use these “cookies” explicitly. However,\r\n                the app may use third party code and libraries that use\r\n                “cookies” to collect information and improve their services.\r\n                You have the option to either accept or refuse these cookies\r\n                and know when a cookie is being sent to your device. If you\r\n                choose to refuse our cookies, you may not be able to use some\r\n                portions of this Service.\r\n            </p>\r\n\r\n            <h3 class=\"text-dark font-weight-bold\" style=\"font-size: 1rem\">Service Providers</h3>\r\n\r\n            <p>\r\n                I may employ third-party companies and\r\n                individuals due to the following reasons:\r\n            </p>\r\n\r\n            <ul>\r\n                <li>To facilitate our Service;</li>\r\n                <li>To provide the Service on our behalf;</li>\r\n                <li>To perform Service-related services; or</li>\r\n                <li>To assist us in analyzing how our Service is used.</li>\r\n            </ul>\r\n\r\n            <p>\r\n                I want to inform users of this Service\r\n                that these third parties have access to your Personal\r\n                Information. The reason is to perform the tasks assigned to\r\n                them on our behalf. However, they are obligated not to\r\n                disclose or use the information for any other purpose.\r\n            </p>\r\n\r\n            <h3 class=\"text-dark font-weight-bold\" style=\"font-size: 1rem\">Security</h3>\r\n\r\n            <p>\r\n                I value your trust in providing us your\r\n                Personal Information, thus we are striving to use commercially\r\n                acceptable means of protecting it. But remember that no method\r\n                of transmission over the internet, or method of electronic\r\n                storage is 100% secure and reliable, and I cannot\r\n                guarantee its absolute security.\r\n            </p>\r\n\r\n            <h3 class=\"text-dark font-weight-bold\" style=\"font-size: 1rem\">Links to Other Sites</h3>\r\n\r\n            <p>\r\n                This Service may contain links to other sites. If you click on\r\n                a third-party link, you will be directed to that site. Note\r\n                that these external sites are not operated by me.\r\n                Therefore, I strongly advise you to review the\r\n                Privacy Policy of these websites. I have\r\n                no control over and assume no responsibility for the content,\r\n                privacy policies, or practices of any third-party sites or\r\n                services.\r\n            </p>\r\n\r\n            <h3 class=\"text-dark font-weight-bold\" style=\"font-size: 1rem\">Children’s Privacy</h3>\r\n\r\n            <p>\r\n                These Services do not address anyone under the age of 13.\r\n                I do not knowingly collect personally\r\n                identifiable information from children under 13. In the case\r\n                I discover that a child under 13 has provided\r\n                me with personal information, I immediately\r\n                delete this from our servers. If you are a parent or guardian\r\n                and you are aware that your child has provided us with\r\n                personal information, please contact me so that\r\n                I will be able to do necessary actions.\r\n            </p>\r\n\r\n            <h3 class=\"text-dark font-weight-bold\" style=\"font-size: 1rem\">Changes to This Privacy Policy</h3>\r\n\r\n            <p>\r\n                I may update our Privacy Policy from\r\n                time to time. Thus, you are advised to review this page\r\n                periodically for any changes. I will\r\n                notify you of any changes by posting the new Privacy Policy on\r\n                this page.\r\n            </p>\r\n\r\n            <p>This policy is effective as of 2020-08-04.</p>\r\n\r\n            <h3 class=\"text-dark font-weight-bold\" style=\"font-size: 1rem\">Contact Us</h3>\r\n            <p>\r\n                If you have any questions or suggestions about my\r\n                Privacy Policy, do not hesitate to contact me at <span class=\"text-private\">ap.sky@yandex.ru.</span>\r\n            </p>');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribes`
--

DROP TABLE IF EXISTS `subscribes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscribes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subscriber` int NOT NULL,
  `subscribe_to` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_up_to` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`subscribe_to`,`subscriber`),
  UNIQUE KEY `subscribes_id_uindex` (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `subscribes_user_id_fk` (`subscriber`),
  CONSTRAINT `subscribes_user_id_fk` FOREIGN KEY (`subscriber`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subscribes_user_id_fk_2` FOREIGN KEY (`subscribe_to`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribes`
--

LOCK TABLES `subscribes` WRITE;
/*!40000 ALTER TABLE `subscribes` DISABLE KEYS */;
INSERT INTO `subscribes` VALUES (6,2,1,'2020-08-11 12:49:37',1),(12,4,1,'2020-08-24 06:23:24',1),(7,2,3,'2020-08-11 12:45:53',2);
/*!40000 ALTER TABLE `subscribes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `secondname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'defaultProfilePhoto.png',
  `bio` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_login_uindex` (`email`),
  UNIQUE KEY `user_user_id_uindex` (`id`),
  UNIQUE KEY `user_username_uindex` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'apsky','Pavel','Groshkov','admin@mail.ru','$2y$10$OzjSoKX4KnaSiqQ2zzgugOsuo2zcwqJPpNUPMK98tLa/2ZdpeSWyW','defaultProfilePhoto.png',''),(2,'manager','Viktor','Viktorov','manager@mail.ru','$2y$10$ynjJ/25ex/vPCYoHigZB8eccUK6E5DZ3lpnYliQpbwo61REUYWxSG','defaultProfilePhoto.png',''),(3,'register','Unnamed','Unnamedov','new@mail.ru','$2y$10$eGBoHeyamosoIAkcpLKybu1erSGoR6kGK8PqVBobVzVWrfweQPPze','defaultProfilePhoto.png',''),(4,'I','I','I','I@mail.ru','$2y$10$c7Ldr3U8HbxOAkozJ64X8ufos2M7RWkSAv1Tze/T2g7D6cILIVDjy','defaultProfilePhoto.png',''),(24,'test1','test','test','test1@mail.ru','123','defaultProfilePhoto.png',NULL);
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

-- Dump completed on 2020-08-25 17:12:05
