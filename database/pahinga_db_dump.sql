-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: pahinga_db
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `nights` int NOT NULL DEFAULT '1',
  `payment_type` enum('cash','cheque','credit') NOT NULL DEFAULT 'cash',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `additional_charge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_bill` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','confirmed','checked_in','checked_out','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,24,'IJAY JACULBE','ijayjaculbe0939@gmail.com','09398101547','2026-03-26','2026-03-31',5,'cash',5000.00,500.00,0.00,4500.00,'pending','2026-03-26 08:54:47','2026-03-26 08:54:47'),(2,18,'Zedrick Jerol Tajarros','jerol@gmail.com','09206485080','2026-03-26','2026-04-09',14,'cash',11200.00,1680.00,0.00,9520.00,'pending','2026-03-26 08:56:38','2026-03-26 08:56:38'),(3,18,'IJAY JACULBE','ijay0939@gmail.com','11111111111','2026-03-26','2026-04-09',14,'cash',11200.00,1680.00,0.00,9520.00,'pending','2026-03-26 08:58:56','2026-03-26 08:58:56'),(4,15,'IJAY JACULBE','i@gmail.com','09398101547','2026-03-26','2026-03-27',1,'cash',300.00,0.00,0.00,300.00,'pending','2026-03-26 09:04:46','2026-03-26 09:04:46'),(5,2,'lebron','lebron@gmail.com','22222222222','2026-03-26','2026-04-22',27,'cheque',5400.00,0.00,270.00,5670.00,'pending','2026-03-26 09:07:06','2026-03-26 09:07:06');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` enum('regular','deluxe','suite') NOT NULL DEFAULT 'regular',
  `description` varchar(255) NOT NULL,
  `detailed_description` text,
  `capacity` varchar(20) NOT NULL DEFAULT '1 guest',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `image` varchar(255) NOT NULL,
  `image_dir` varchar(50) NOT NULL DEFAULT 'regular',
  `offers` text COMMENT 'Comma-separated list of amenities',
  `status` enum('available','occupied','maintenance') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (1,'Regular Room 1','regular','Comfortable and cozy accommodation perfect for solo travelers.','This comfortable and cozy accommodation is perfect for solo travelers seeking a peaceful retreat. The room features a well-appointed single bed, modern amenities, and a serene atmosphere that ensures a restful stay. Ideal for business travelers or those looking for a quiet escape.','1 guest',100.00,'regular-room-one.webp','regular','Comfortable bed,Fast Wi-Fi,Air conditioning,Fresh towels','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(2,'Regular Room 2','regular','Spacious room with modern amenities for a relaxing stay.','Experience comfort in this spacious room designed with modern amenities for a truly relaxing stay. The room offers ample space, contemporary furnishings, and all the essentials you need for a pleasant visit. Perfect for couples or friends traveling together.','2 guests',200.00,'regular-room-two.webp','regular','Queen bed,Fast Wi-Fi,Air conditioning,Daily housekeeping','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(3,'Regular Room 3','regular','Affordable comfort with all essential amenities included.','Enjoy affordable comfort without compromising on quality. This room includes all essential amenities to make your stay convenient and enjoyable. Clean, well-maintained, and thoughtfully designed to provide excellent value for money.','1 guest',100.00,'regular-room-three.webp','regular','Single bed,Fast Wi-Fi,Work desk,Hot shower','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(4,'Regular Room 4','regular','Perfect for couples seeking comfort and value.','Designed with couples in mind, this room offers the perfect balance of comfort and value. The cozy space features comfortable bedding, modern amenities, and a welcoming atmosphere that makes it ideal for romantic getaways or weekend escapes.','2 guests',200.00,'regular-room-four.webp','regular','Queen bed,Fast Wi-Fi,Air conditioning,TV','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(5,'Regular Room 5','regular','Family-friendly room with extra space and comfort.','This family-friendly room provides extra space and comfort for families traveling together. With accommodations for up to four guests, the room features multiple sleeping arrangements, additional storage space, and amenities that cater to families with children.','4 guests',500.00,'regular-room-five.webp','regular','Family space,Fast Wi-Fi,Air conditioning,Mini fridge','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(6,'Regular Room 6','regular','Cozy retreat with all the essentials for a pleasant stay.','A cozy retreat that includes all the essentials for a pleasant stay. This room combines comfort and functionality, offering a peaceful environment where you can unwind after a day of exploring. Perfect for travelers who appreciate simplicity and comfort.','2 guests',200.00,'regular-room-six.webp','regular','Comfortable bed,Fast Wi-Fi,Hot shower,Wardrobe','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(7,'Regular Room 7','regular','Budget-friendly option without compromising on comfort.','A budget-friendly option that does not compromise on comfort. This room provides excellent value with clean accommodations, essential amenities, and a comfortable environment. Ideal for budget-conscious travelers who still want a quality stay experience.','1 guest',100.00,'regular-room-seven.webp','regular','Single bed,Fast Wi-Fi,Air conditioning,Basic toiletries','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(8,'Regular Room 8','regular','Spacious family room perfect for groups.','This spacious family room is perfect for groups and families. With generous space to accommodate multiple guests comfortably, the room features family-friendly amenities and a layout designed to make group stays enjoyable and convenient.','4 guests',500.00,'regular-room-eight.webp','regular','Family space,Fast Wi-Fi,Air conditioning,Extra pillows','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(9,'De Luxe Room 1','deluxe','Premium accommodation with luxury amenities and elegant design.','Indulge in premium accommodation featuring luxury amenities and elegant design. This deluxe room offers a sophisticated atmosphere with high-quality furnishings, premium bedding, and thoughtful touches throughout. Experience elevated comfort and style in every detail.','2 guests',500.00,'deluxe-room-one.webp','deluxe','Premium bed,Fast Wi-Fi,Smart TV,Mini bar','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(10,'De Luxe Room 2','deluxe','Spacious deluxe room perfect for a comfortable stay.','Enjoy a spacious deluxe room designed for maximum comfort during your stay. The generous layout provides plenty of room to relax, work, or unwind. Premium amenities and elegant decor create an atmosphere of refined luxury and relaxation.','2 guests',500.00,'deluxe-room-two.webp','deluxe','Premium bed,Fast Wi-Fi,Smart TV,Coffee & tea','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(11,'De Luxe Room 3','deluxe','Luxurious room with modern comforts and premium features.','Experience luxury in this beautifully appointed room that combines modern comforts with premium features. From high-end furnishings to state-of-the-art amenities, every element has been carefully selected to provide an exceptional stay experience.','1 guest',300.00,'deluxe-room-three.jpg','deluxe','Premium bed,Fast Wi-Fi,Smart TV,Work desk','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(12,'De Luxe Room 4','deluxe','Elegant deluxe accommodation with stunning views.','Stay in elegant deluxe accommodation that offers stunning views and sophisticated design. The room features large windows to take advantage of the scenery, premium furnishings, and an ambiance that reflects refined taste and attention to detail.','2 guests',500.00,'deluxe-room-four.jpg','deluxe','Premium bed,Fast Wi-Fi,Smart TV,Balcony view','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(13,'De Luxe Room 5','deluxe','Family-friendly deluxe room with extra space and luxury.','A family-friendly deluxe room that combines extra space with luxury amenities. Designed to accommodate families comfortably, this room features premium furnishings, additional space for relaxation, and luxury touches that make family travel more enjoyable.','4 guests',750.00,'deluxe-room-five.jpg','deluxe','Family space,Fast Wi-Fi,Smart TV,Mini bar','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(14,'De Luxe Room 6','deluxe','Premium comfort with sophisticated design elements.','Experience premium comfort enhanced by sophisticated design elements throughout. This room showcases attention to detail in every aspect, from the carefully curated decor to the premium amenities that ensure a memorable and comfortable stay.','2 guests',500.00,'deluxe-room-six.jpg','deluxe','Premium bed,Fast Wi-Fi,Smart TV,Rain shower','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(15,'De Luxe Room 7','deluxe','Luxury accommodation with all premium amenities.','Luxury accommodation that includes all premium amenities for an exceptional stay. This room features top-of-the-line furnishings, advanced technology, and premium services that define true luxury hospitality. Every detail is designed to exceed expectations.','1 guest',300.00,'deluxe-room-seven.jpg','deluxe','Premium bed,Fast Wi-Fi,Smart TV,Blackout curtains','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(16,'De Luxe Room 8','deluxe','Spacious family deluxe room with luxury features.','A spacious family deluxe room that combines generous space with luxury features. Perfect for families seeking an elevated experience, this room offers premium accommodations, luxury amenities, and thoughtful touches that make family stays special.','4 guests',750.00,'deluxe-room-eight.jpg','deluxe','Family space,Fast Wi-Fi,Smart TV,Mini fridge','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(17,'Suite Room 1','suite','Ultimate luxury with spacious accommodations and premium amenities.','Experience ultimate luxury in this spacious suite featuring premium amenities and elegant accommodations. The suite offers separate living and sleeping areas, high-end furnishings, and exclusive amenities that create an unparalleled hospitality experience. Perfect for those seeking the finest in comfort and style.','2 guests',800.00,'suite-room-one.webp','suite','King bed,Fast Wi-Fi,Premium TV,Living area','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(18,'Suite Room 2','suite','Elegant suite featuring sophisticated design and comfort.','An elegant suite that features sophisticated design and exceptional comfort throughout. The thoughtfully designed space combines luxury furnishings with modern amenities, creating an atmosphere of refined elegance. Every element has been carefully curated for an unforgettable stay.','2 guests',800.00,'suite-room-two.webp','suite','King bed,Fast Wi-Fi,Premium TV,Coffee & tea','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(19,'Suite Room 3','suite','Premium suite with exclusive amenities and stunning views.','A premium suite offering exclusive amenities and stunning views that enhance your stay experience. The suite features expansive windows, luxury accommodations, and exclusive services that set it apart. Enjoy breathtaking scenery while indulging in the finest hospitality.','1 guest',500.00,'suite-room-three.webp','suite','King bed,Fast Wi-Fi,Premium TV,Balcony view','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(20,'Suite Room 4','suite','Luxurious suite perfect for a memorable stay experience.','A luxurious suite designed to create a memorable stay experience. This exceptional accommodation features spacious living areas, premium furnishings, and exclusive amenities that ensure every moment is special. Ideal for celebrations, special occasions, or simply treating yourself to the best.','2 guests',800.00,'suite-room-four.webp','suite','King bed,Fast Wi-Fi,Premium TV,Living area','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(21,'Suite Room 5','suite','Spacious family suite with luxury features and extra comfort.','A spacious family suite that combines luxury features with extra comfort for families. The suite provides ample space for families to relax together, premium amenities throughout, and thoughtful touches that make family travel more enjoyable. Experience luxury hospitality designed for families.','4 guests',1000.00,'suite-room-five.webp','suite','Family space,Fast Wi-Fi,Premium TV,Kitchenette','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(22,'Suite Room 6','suite','Exclusive suite with premium amenities and elegant design.','An exclusive suite featuring premium amenities and elegant design that creates a truly special accommodation experience. The suite showcases sophisticated decor, high-end amenities, and exclusive services that define luxury hospitality at its finest.','2 guests',800.00,'suite-room-six.webp','suite','King bed,Fast Wi-Fi,Premium TV,Rain shower','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(23,'Suite Room 7','suite','Ultimate comfort in our most luxurious suite accommodation.','Experience ultimate comfort in our most luxurious suite accommodation. This premier suite represents the pinnacle of hospitality, featuring the finest furnishings, most exclusive amenities, and exceptional service. Every detail has been perfected to provide an unparalleled luxury experience.','1 guest',500.00,'suite-room-seven.webp','suite','King bed,Fast Wi-Fi,Premium TV,Blackout curtains','available','2026-03-26 08:27:29','2026-03-26 08:27:29'),(24,'Suite Room 8','suite','Grand family suite with all luxury amenities included.','A grand family suite that includes all luxury amenities for an exceptional family stay. This expansive suite offers generous space for families, premium accommodations throughout, and luxury amenities that ensure every family member enjoys a memorable experience. The perfect choice for families seeking the ultimate in comfort and luxury.','4 guests',1000.00,'suite-room-eight.webp','suite','Family space,Fast Wi-Fi,Premium TV,Kitchenette','available','2026-03-26 08:27:29','2026-03-26 08:27:29');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-26 18:19:55
