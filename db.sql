-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.1.0 - MySQL Community Server - GPL
-- SE du serveur:                Linux
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour fightinggame
DROP DATABASE IF EXISTS `fightinggame`;
CREATE DATABASE IF NOT EXISTS `fightinggame` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `fightinggame`;

-- Listage de la structure de la table fightinggame. accessory
DROP TABLE IF EXISTS `accessory`;
CREATE TABLE IF NOT EXISTS `accessory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_stat_action_id` int NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_life` int NOT NULL,
  `defense` int NOT NULL,
  `resistance` int NOT NULL,
  `bonus_attack` int NOT NULL,
  `bonus_magic` int NOT NULL,
  `energy_recovery` int NOT NULL,
  `cost` int NOT NULL,
  `name_action` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `energy_action` int NOT NULL,
  `wait_action` int NOT NULL,
  `stat_action` int NOT NULL,
  `user_creator_id` int DEFAULT NULL,
  `image_path` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_A1B1251CA513E897` (`type_stat_action_id`),
  KEY `IDX_A1B1251CC645C84A` (`user_creator_id`),
  CONSTRAINT `FK_A1B1251CA513E897` FOREIGN KEY (`type_stat_action_id`) REFERENCES `type_stat_action` (`id`),
  CONSTRAINT `FK_A1B1251CC645C84A` FOREIGN KEY (`user_creator_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.accessory : ~3 rows (environ)
DELETE FROM `accessory`;
INSERT INTO `accessory` (`id`, `type_stat_action_id`, `name`, `min_life`, `defense`, `resistance`, `bonus_attack`, `bonus_magic`, `energy_recovery`, `cost`, `name_action`, `energy_action`, `wait_action`, `stat_action`, `user_creator_id`, `image_path`) VALUES
	(1, 1, 'Petit Bouclier Rond', 200, 2, 2, 1, 1, 18, 0, 'Parade', 15, 1, 1, NULL, '/img/accessory/shield.webp'),
	(2, 3, 'Armure en Cuir Dur', 200, 3, 1, 3, 0, 36, 2650, 'Encaisser', 30, 3, 1, NULL, '/img/accessory/armor.webp'),
	(3, 2, 'Armure Lourde de Mage', 200, 1, 3, 0, 3, 36, 2650, 'Bulle Magique', 30, 3, 1, NULL, '/img/accessory/cloak.webp');

-- Listage de la structure de la table fightinggame. category_weapon
DROP TABLE IF EXISTS `category_weapon`;
CREATE TABLE IF NOT EXISTS `category_weapon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advantage` int NOT NULL,
  `disadvantage` int NOT NULL,
  `advantage_multiplicator` double NOT NULL,
  `disadvantage_multiplicator` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.category_weapon : ~3 rows (environ)
DELETE FROM `category_weapon`;
INSERT INTO `category_weapon` (`id`, `name_category`, `advantage`, `disadvantage`, `advantage_multiplicator`, `disadvantage_multiplicator`) VALUES
	(1, 'Classique', 3, 2, 1.33, 0.66),
	(2, 'Magie', 1, 3, 1.33, 0.66),
	(3, 'Alternatif', 2, 1, 1.33, 0.66);

-- Listage de la structure de la table fightinggame. doctrine_migration_versions
DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table fightinggame.doctrine_migration_versions : ~16 rows (environ)
DELETE FROM `doctrine_migration_versions`;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20231030155909', '2023-10-31 08:13:16', 3342),
	('DoctrineMigrations\\Version20231031101349', '2023-10-31 10:13:58', 47),
	('DoctrineMigrations\\Version20231031152145', '2023-10-31 15:22:49', 36),
	('DoctrineMigrations\\Version20231031152404', '2023-10-31 15:24:08', 144),
	('DoctrineMigrations\\Version20231031153454', '2023-10-31 15:35:15', 85),
	('DoctrineMigrations\\Version20231101181121', '2023-11-01 18:12:15', 36),
	('DoctrineMigrations\\Version20231101181421', '2023-11-01 18:14:33', 91),
	('DoctrineMigrations\\Version20231102143850', '2023-11-03 07:34:13', 1062),
	('DoctrineMigrations\\Version20231102150138', '2023-11-03 07:34:14', 785),
	('DoctrineMigrations\\Version20231106102059', '2023-11-07 08:14:34', 399),
	('DoctrineMigrations\\Version20231106105802', '2023-11-07 08:14:35', 19),
	('DoctrineMigrations\\Version20231109102129', '2023-11-09 10:21:39', 130),
	('DoctrineMigrations\\Version20231109103858', '2023-11-09 10:41:36', 1350),
	('DoctrineMigrations\\Version20231110082756', '2023-11-16 13:20:03', 380),
	('DoctrineMigrations\\Version20231115150822', '2023-11-16 13:20:03', 91),
	('DoctrineMigrations\\Version20231205231619', '2023-12-05 23:16:25', 157);

-- Listage de la structure de la table fightinggame. element
DROP TABLE IF EXISTS `element`;
CREATE TABLE IF NOT EXISTS `element` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_element` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advantage` int NOT NULL,
  `disadvantage` int NOT NULL,
  `advantage_multiplicator` double NOT NULL,
  `disadvantage_multiplicator` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.element : ~6 rows (environ)
DELETE FROM `element`;
INSERT INTO `element` (`id`, `name_element`, `advantage`, `disadvantage`, `advantage_multiplicator`, `disadvantage_multiplicator`) VALUES
	(1, 'Feu', 3, 2, 2, 0.5),
	(2, 'Terre', 4, 3, 2, 0.5),
	(3, 'Métal', 5, 4, 2, 0.5),
	(4, 'Eau', 1, 5, 2, 0.5),
	(5, 'Bois', 2, 1, 2, 0.5),
	(6, 'Neutre', 6, 6, 1, 1);

-- Listage de la structure de la table fightinggame. equipe
DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `assosiated_user_id` int DEFAULT NULL,
  `team_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personnage_id` int NOT NULL,
  `weapon_id` int NOT NULL,
  `accessory_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2449BA15DA9510BD` (`assosiated_user_id`),
  KEY `IDX_2449BA155E315342` (`personnage_id`),
  KEY `IDX_2449BA1595B82273` (`weapon_id`),
  KEY `IDX_2449BA1527E8CC78` (`accessory_id`),
  CONSTRAINT `FK_2449BA1527E8CC78` FOREIGN KEY (`accessory_id`) REFERENCES `accessory` (`id`),
  CONSTRAINT `FK_2449BA155E315342` FOREIGN KEY (`personnage_id`) REFERENCES `personnage` (`id`),
  CONSTRAINT `FK_2449BA1595B82273` FOREIGN KEY (`weapon_id`) REFERENCES `weapon` (`id`),
  CONSTRAINT `FK_2449BA15DA9510BD` FOREIGN KEY (`assosiated_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.equipe : ~9 rows (environ)
DELETE FROM `equipe`;
INSERT INTO `equipe` (`id`, `assosiated_user_id`, `team_name`, `personnage_id`, `weapon_id`, `accessory_id`) VALUES
	(1, 1, 'Perso 1 - 1stUser', 10, 1, 1),
	(2, 1, 'Perso 2 - 1stUser', 7, 7, 1),
	(3, 1, 'Perso 3 - 1stUser', 18, 9, 1),
	(4, 2, 'Perso 1 - 2ndUser', 8, 8, 1),
	(5, 2, 'Perso 2 - 2ndUser', 23, 5, 1),
	(6, 2, 'Perso 3 - 2ndUser', 38, 2, 1),
	(7, 2, 'aaaa', 23, 5, 1),
	(8, 3, 'aaaaaa', 30, 3, 1),
	(10, 2, 'Natsu Neutre', 48, 4, 1);

-- Listage de la structure de la table fightinggame. messenger_messages
DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.messenger_messages : ~6 rows (environ)
DELETE FROM `messenger_messages`;
INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
	(1, 'O:36:\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\":2:{s:44:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\";a:1:{s:46:\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\";a:1:{i:0;O:46:\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\":1:{s:55:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\";s:21:\\"messenger.bus.default\\";}}}s:45:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\";O:51:\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\":2:{s:60:\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\";O:39:\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\":4:{i:0;s:41:\\"registration/confirmation_email.html.twig\\";i:1;N;i:2;a:3:{s:9:\\"signedUrl\\";s:168:\\"https://127.0.0.1:8000/verify/email?expires=1698750854&signature=VT6797%2FpEh9Q05St68FFT6NEPXavocthO0AdhByGQ0w%3D&token=6TDgcCz7iCjXF2225n5MmqGCG7GSS%2FL4qrH0O0q2Mb4%3D\\";s:19:\\"expiresAtMessageKey\\";s:26:\\"%count% hour|%count% hours\\";s:20:\\"expiresAtMessageData\\";a:1:{s:7:\\"%count%\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\":2:{s:46:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\";a:3:{s:4:\\"from\\";a:1:{i:0;O:47:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:4:\\"From\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:58:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\";a:1:{i:0;O:30:\\"Symfony\\\\Component\\\\Mime\\\\Address\\":2:{s:39:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\";s:39:\\"verification.mail@fighting-adventure.fr\\";s:36:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\";s:8:\\"VerifBot\\";}}}}s:2:\\"to\\";a:1:{i:0;O:47:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:2:\\"To\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:58:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\";a:1:{i:0;O:30:\\"Symfony\\\\Component\\\\Mime\\\\Address\\":2:{s:39:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\";s:17:\\"user.nb1@test.com\\";s:36:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\";s:0:\\"\\";}}}}s:7:\\"subject\\";a:1:{i:0;O:48:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:7:\\"Subject\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:55:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\";s:25:\\"Please Confirm your Email\\";}}}s:49:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\";i:76;}i:1;N;}}}s:61:\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\";N;}}', '[]', 'default', '2023-10-31 10:14:15', '2023-10-31 10:14:15', NULL),
	(2, 'O:36:\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\":2:{s:44:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\";a:1:{s:46:\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\";a:1:{i:0;O:46:\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\":1:{s:55:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\";s:21:\\"messenger.bus.default\\";}}}s:45:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\";O:51:\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\":2:{s:60:\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\";O:39:\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\":4:{i:0;s:41:\\"registration/confirmation_email.html.twig\\";i:1;N;i:2;a:3:{s:9:\\"signedUrl\\";s:172:\\"https://127.0.0.1:8000/verify/email?expires=1698750954&signature=%2FRWlvmX8U%2BSZ7vWaCShr9AKWNmdP%2BuyzfNEmK6TEBog%3D&token=6TDgcCz7iCjXF2225n5MmqGCG7GSS%2FL4qrH0O0q2Mb4%3D\\";s:19:\\"expiresAtMessageKey\\";s:26:\\"%count% hour|%count% hours\\";s:20:\\"expiresAtMessageData\\";a:1:{s:7:\\"%count%\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\":2:{s:46:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\";a:3:{s:4:\\"from\\";a:1:{i:0;O:47:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:4:\\"From\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:58:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\";a:1:{i:0;O:30:\\"Symfony\\\\Component\\\\Mime\\\\Address\\":2:{s:39:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\";s:39:\\"verification.mail@fighting-adventure.fr\\";s:36:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\";s:8:\\"VerifBot\\";}}}}s:2:\\"to\\";a:1:{i:0;O:47:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:2:\\"To\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:58:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\";a:1:{i:0;O:30:\\"Symfony\\\\Component\\\\Mime\\\\Address\\":2:{s:39:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\";s:17:\\"user.nb1@test.com\\";s:36:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\";s:0:\\"\\";}}}}s:7:\\"subject\\";a:1:{i:0;O:48:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:7:\\"Subject\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:55:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\";s:25:\\"Please Confirm your Email\\";}}}s:49:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\";i:76;}i:1;N;}}}s:61:\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\";N;}}', '[]', 'default', '2023-10-31 10:15:54', '2023-10-31 10:15:54', NULL),
	(3, 'O:36:\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\":2:{s:44:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\";a:1:{s:46:\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\";a:1:{i:0;O:46:\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\":1:{s:55:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\";s:21:\\"messenger.bus.default\\";}}}s:45:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\";O:51:\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\":2:{s:60:\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\";O:39:\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\":4:{i:0;s:41:\\"registration/confirmation_email.html.twig\\";i:1;N;i:2;a:3:{s:9:\\"signedUrl\\";s:168:\\"https://127.0.0.1:8000/verify/email?expires=1698752023&signature=jH2wd%2BisRmkGcB4waof3y0UbE1jPWwuqMW4DMb0x41g%3D&token=zvGLmGzrPbCcUw5gy56Xn1rOv%2FtFcRmySRXPAyzzXPw%3D\\";s:19:\\"expiresAtMessageKey\\";s:26:\\"%count% hour|%count% hours\\";s:20:\\"expiresAtMessageData\\";a:1:{s:7:\\"%count%\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\":2:{s:46:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\";a:3:{s:4:\\"from\\";a:1:{i:0;O:47:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:4:\\"From\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:58:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\";a:1:{i:0;O:30:\\"Symfony\\\\Component\\\\Mime\\\\Address\\":2:{s:39:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\";s:39:\\"verification.mail@fighting-adventure.fr\\";s:36:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\";s:8:\\"VerifBot\\";}}}}s:2:\\"to\\";a:1:{i:0;O:47:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:2:\\"To\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:58:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\";a:1:{i:0;O:30:\\"Symfony\\\\Component\\\\Mime\\\\Address\\":2:{s:39:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\";s:17:\\"user.nb1@test.com\\";s:36:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\";s:0:\\"\\";}}}}s:7:\\"subject\\";a:1:{i:0;O:48:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:7:\\"Subject\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:55:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\";s:25:\\"Please Confirm your Email\\";}}}s:49:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\";i:76;}i:1;N;}}}s:61:\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\";N;}}', '[]', 'default', '2023-10-31 10:33:43', '2023-10-31 10:33:43', NULL),
	(4, 'O:36:\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\":2:{s:44:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\";a:1:{s:46:\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\";a:1:{i:0;O:46:\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\":1:{s:55:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\";s:21:\\"messenger.bus.default\\";}}}s:45:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\";O:51:\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\":2:{s:60:\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\";O:39:\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\":4:{i:0;s:41:\\"registration/confirmation_email.html.twig\\";i:1;N;i:2;a:3:{s:9:\\"signedUrl\\";s:168:\\"https://127.0.0.1:8000/verify/email?expires=1698753164&signature=J6amkj3ld3AZiKGGS67VDV7A7ZVVsTaquQgA3C45%2Bt0%3D&token=S5V3t9bo1Aghw7Wjues1Cc8GbcfxmF6FPaVMCFlh%2FBE%3D\\";s:19:\\"expiresAtMessageKey\\";s:26:\\"%count% hour|%count% hours\\";s:20:\\"expiresAtMessageData\\";a:1:{s:7:\\"%count%\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\":2:{s:46:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\";a:3:{s:4:\\"from\\";a:1:{i:0;O:47:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:4:\\"From\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:58:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\";a:1:{i:0;O:30:\\"Symfony\\\\Component\\\\Mime\\\\Address\\":2:{s:39:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\";s:39:\\"verification.mail@fighting-adventure.fr\\";s:36:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\";s:8:\\"VerifBot\\";}}}}s:2:\\"to\\";a:1:{i:0;O:47:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:2:\\"To\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:58:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\";a:1:{i:0;O:30:\\"Symfony\\\\Component\\\\Mime\\\\Address\\":2:{s:39:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\";s:17:\\"user.nb1@test.com\\";s:36:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\";s:0:\\"\\";}}}}s:7:\\"subject\\";a:1:{i:0;O:48:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:7:\\"Subject\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:55:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\";s:25:\\"Please Confirm your Email\\";}}}s:49:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\";i:76;}i:1;N;}}}s:61:\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\";N;}}', '[]', 'default', '2023-10-31 10:52:44', '2023-10-31 10:52:44', NULL),
	(5, 'O:36:\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\":2:{s:44:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\";a:1:{s:46:\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\";a:1:{i:0;O:46:\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\":1:{s:55:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\";s:21:\\"messenger.bus.default\\";}}}s:45:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\";O:51:\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\":2:{s:60:\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\";O:39:\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\":4:{i:0;s:41:\\"registration/confirmation_email.html.twig\\";i:1;N;i:2;a:3:{s:9:\\"signedUrl\\";s:164:\\"https://127.0.0.1:8000/verify/email?expires=1698753201&signature=r5VRz77zgLRjjsDlGjcFybR9sZqOB3XcoFarYZcWRO8%3D&token=wih8uXWFF8jjSwIh0SmnL6z7QMwIwwQIOZUyvBsLb3E%3D\\";s:19:\\"expiresAtMessageKey\\";s:26:\\"%count% hour|%count% hours\\";s:20:\\"expiresAtMessageData\\";a:1:{s:7:\\"%count%\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\":2:{s:46:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\";a:3:{s:4:\\"from\\";a:1:{i:0;O:47:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:4:\\"From\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:58:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\";a:1:{i:0;O:30:\\"Symfony\\\\Component\\\\Mime\\\\Address\\":2:{s:39:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\";s:39:\\"verification.mail@fighting-adventure.fr\\";s:36:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\";s:8:\\"VerifBot\\";}}}}s:2:\\"to\\";a:1:{i:0;O:47:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:2:\\"To\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:58:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\";a:1:{i:0;O:30:\\"Symfony\\\\Component\\\\Mime\\\\Address\\":2:{s:39:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\";s:18:\\"user.nb12@test.com\\";s:36:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\";s:0:\\"\\";}}}}s:7:\\"subject\\";a:1:{i:0;O:48:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:7:\\"Subject\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:55:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\";s:25:\\"Please Confirm your Email\\";}}}s:49:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\";i:76;}i:1;N;}}}s:61:\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\";N;}}', '[]', 'default', '2023-10-31 10:53:21', '2023-10-31 10:53:21', NULL),
	(6, 'O:36:\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\":2:{s:44:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\";a:1:{s:46:\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\";a:1:{i:0;O:46:\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\":1:{s:55:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\";s:21:\\"messenger.bus.default\\";}}}s:45:\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\";O:51:\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\":2:{s:60:\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\";O:39:\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\":4:{i:0;s:41:\\"registration/confirmation_email.html.twig\\";i:1;N;i:2;a:3:{s:9:\\"signedUrl\\";s:168:\\"https://127.0.0.1:8000/verify/email?expires=1698753333&signature=kt4WZS7Mw6TicmXjx7aEhLLXU%2FyOuAGmPrN8fP3Ocxc%3D&token=pjdbcr7QDmO1eijChLcGhGxyAAbq%2FHBfHLaBTST3xmA%3D\\";s:19:\\"expiresAtMessageKey\\";s:26:\\"%count% hour|%count% hours\\";s:20:\\"expiresAtMessageData\\";a:1:{s:7:\\"%count%\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\":2:{s:46:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\";a:3:{s:4:\\"from\\";a:1:{i:0;O:47:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:4:\\"From\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:58:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\";a:1:{i:0;O:30:\\"Symfony\\\\Component\\\\Mime\\\\Address\\":2:{s:39:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\";s:39:\\"verification.mail@fighting-adventure.fr\\";s:36:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\";s:8:\\"VerifBot\\";}}}}s:2:\\"to\\";a:1:{i:0;O:47:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:2:\\"To\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:58:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\";a:1:{i:0;O:30:\\"Symfony\\\\Component\\\\Mime\\\\Address\\":2:{s:39:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\";s:13:\\"aaaa@test.com\\";s:36:\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\";s:0:\\"\\";}}}}s:7:\\"subject\\";a:1:{i:0;O:48:\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\":5:{s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\";s:7:\\"Subject\\";s:56:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\";i:76;s:50:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\";N;s:53:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\";s:5:\\"utf-8\\";s:55:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\";s:25:\\"Please Confirm your Email\\";}}}s:49:\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\";i:76;}i:1;N;}}}s:61:\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\";N;}}', '[]', 'default', '2023-10-31 10:55:33', '2023-10-31 10:55:33', NULL);

-- Listage de la structure de la table fightinggame. personnage
DROP TABLE IF EXISTS `personnage`;
CREATE TABLE IF NOT EXISTS `personnage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `element_id` int NOT NULL,
  `type_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attack` int NOT NULL,
  `magic` int NOT NULL,
  `energy` int NOT NULL,
  `life` int NOT NULL,
  `user_creator_id` int DEFAULT NULL,
  `image_path` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_6AEA486D1F1F2A24` (`element_id`),
  KEY `IDX_6AEA486DC54C8C93` (`type_id`),
  KEY `IDX_6AEA486D12469DE2` (`category_id`),
  KEY `IDX_6AEA486DC645C84A` (`user_creator_id`),
  CONSTRAINT `FK_6AEA486D12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category_weapon` (`id`),
  CONSTRAINT `FK_6AEA486D1F1F2A24` FOREIGN KEY (`element_id`) REFERENCES `element` (`id`),
  CONSTRAINT `FK_6AEA486DC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type_weapon` (`id`),
  CONSTRAINT `FK_6AEA486DC645C84A` FOREIGN KEY (`user_creator_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.personnage : ~46 rows (environ)
DELETE FROM `personnage`;
INSERT INTO `personnage` (`id`, `element_id`, `type_id`, `category_id`, `name`, `attack`, `magic`, `energy`, `life`, `user_creator_id`, `image_path`) VALUES
	(1, 1, 1, 1, 'Hache Feu', 10, 10, 60, 200, NULL, '/img/character/axesman.webp'),
	(2, 1, 2, 1, 'Épée Feu', 10, 10, 60, 200, NULL, '/img/character/swordsman.webp'),
	(3, 1, 3, 1, 'Lance Feu', 10, 10, 60, 200, NULL, '/img/character/spearsman.webp'),
	(4, 1, 1, 2, 'Tatouage Feu', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.webp'),
	(5, 1, 2, 2, 'Livre Feu', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.webp'),
	(6, 1, 3, 2, 'Baton Feu', 10, 10, 60, 200, NULL, '/img/character/mageWand.webp'),
	(7, 1, 1, 3, 'Gants Feu', 10, 10, 60, 200, NULL, '/img/character/fighter.webp'),
	(8, 1, 2, 3, 'Dague Feu', 10, 10, 60, 200, NULL, '/img/character/thief.webp'),
	(9, 1, 3, 3, 'Arc Feu', 10, 10, 60, 200, NULL, '/img/character/ranger.webp'),
	(10, 2, 1, 1, 'Hache Terre', 10, 10, 60, 200, NULL, '/img/character/axesman.webp'),
	(11, 2, 2, 1, 'Épée Terre', 10, 10, 60, 200, NULL, '/img/character/swordsman.webp'),
	(12, 2, 3, 1, 'Lance Terre', 10, 10, 60, 200, NULL, '/img/character/spearsman.webp'),
	(13, 2, 1, 2, 'Tatouage Terre', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.webp'),
	(14, 2, 2, 2, 'Livre Terre', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.webp'),
	(15, 2, 3, 2, 'Baton Terre', 10, 10, 60, 200, NULL, '/img/character/mageWand.webp'),
	(16, 2, 1, 3, 'Gants Terre', 10, 10, 60, 200, NULL, '/img/character/fighter.webp'),
	(17, 2, 2, 3, 'Dague Terre', 10, 10, 60, 200, NULL, '/img/character/thief.webp'),
	(18, 2, 3, 3, 'Arc Terre', 10, 10, 60, 200, NULL, '/img/character/ranger.webp'),
	(19, 3, 1, 1, 'Hache Métal', 10, 10, 60, 200, NULL, '/img/character/axesman.webp'),
	(20, 3, 2, 1, 'Épée Métal', 10, 10, 60, 200, NULL, '/img/character/swordsman.webp'),
	(21, 3, 3, 1, 'Lance Métal', 10, 10, 60, 200, NULL, '/img/character/spearsman.webp'),
	(22, 3, 1, 2, 'Tatouage Métal', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.webp'),
	(23, 3, 2, 2, 'Livre Métal', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.webp'),
	(24, 3, 3, 2, 'Baton Métal', 10, 10, 60, 200, NULL, '/img/character/mageWand.webp'),
	(25, 3, 1, 3, 'Gants Métal', 10, 10, 60, 200, NULL, '/img/character/fighter.webp'),
	(26, 3, 2, 3, 'Dague Métal', 10, 10, 60, 200, NULL, '/img/character/thief.webp'),
	(27, 3, 3, 3, 'Arc Métal', 10, 10, 60, 200, NULL, '/img/character/ranger.webp'),
	(28, 4, 1, 1, 'Hache Eau', 10, 10, 60, 200, NULL, '/img/character/axesman.webp'),
	(29, 4, 2, 1, 'Épée Eau', 10, 10, 60, 200, NULL, '/img/character/swordsman.webp'),
	(30, 4, 3, 1, 'Lance Eau', 10, 10, 60, 200, NULL, '/img/character/spearsman.webp'),
	(31, 4, 1, 2, 'Tatouage Eau', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.webp'),
	(32, 4, 2, 2, 'Livre Eau', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.webp'),
	(33, 4, 3, 2, 'Baton Eau', 10, 10, 60, 200, NULL, '/img/character/mageWand.webp'),
	(34, 4, 1, 3, 'Gants Eau', 10, 10, 60, 200, NULL, '/img/character/fighter.webp'),
	(35, 4, 2, 3, 'Dague Eau', 10, 10, 60, 200, NULL, '/img/character/thief.webp'),
	(36, 4, 3, 3, 'Arc Eau', 10, 10, 60, 200, NULL, '/img/character/ranger.webp'),
	(37, 5, 1, 1, 'Hache Bois', 10, 10, 60, 200, NULL, '/img/character/axesman.webp'),
	(38, 5, 2, 1, 'Épée Bois', 10, 10, 60, 200, NULL, '/img/character/swordsman.webp'),
	(39, 5, 3, 1, 'Lance Bois', 10, 10, 60, 200, NULL, '/img/character/spearsman.webp'),
	(40, 5, 1, 2, 'Tatouage Bois', 10, 10, 60, 200, NULL, '/img/character/mage_tattou_midJourney_modified.webp'),
	(41, 5, 2, 2, 'Livre Bois', 10, 10, 60, 200, NULL, '/img/character/mage_book_midjourney_modified.webp'),
	(42, 5, 3, 2, 'Baton Bois', 10, 10, 60, 200, NULL, '/img/character/mageWand.webp'),
	(43, 5, 1, 3, 'Gants Bois', 10, 10, 60, 200, NULL, '/img/character/fighter.webp'),
	(44, 5, 2, 3, 'Dague Bois', 10, 10, 60, 200, NULL, '/img/character/thief.webp'),
	(45, 5, 3, 3, 'Arc Bois', 10, 10, 60, 200, NULL, '/img/character/ranger.webp'),
	(48, 1, 1, 2, 'Natsu', 40, 40, 100, 350, 2, '/img/character/mage_tattou_midJourney_modified.webp');

-- Listage de la structure de la table fightinggame. stock_accessory
DROP TABLE IF EXISTS `stock_accessory`;
CREATE TABLE IF NOT EXISTS `stock_accessory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stock_user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_392CC3F4BEC8C336` (`stock_user_id`),
  CONSTRAINT `FK_392CC3F4BEC8C336` FOREIGN KEY (`stock_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.stock_accessory : ~3 rows (environ)
DELETE FROM `stock_accessory`;
INSERT INTO `stock_accessory` (`id`, `stock_user_id`) VALUES
	(1, 1),
	(2, 2),
	(3, 3);

-- Listage de la structure de la table fightinggame. stock_accessory_accessory
DROP TABLE IF EXISTS `stock_accessory_accessory`;
CREATE TABLE IF NOT EXISTS `stock_accessory_accessory` (
  `stock_accessory_id` int NOT NULL,
  `accessory_id` int NOT NULL,
  PRIMARY KEY (`stock_accessory_id`,`accessory_id`),
  KEY `IDX_E7E200F7683F66B` (`stock_accessory_id`),
  KEY `IDX_E7E200F727E8CC78` (`accessory_id`),
  CONSTRAINT `FK_E7E200F727E8CC78` FOREIGN KEY (`accessory_id`) REFERENCES `accessory` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_E7E200F7683F66B` FOREIGN KEY (`stock_accessory_id`) REFERENCES `stock_accessory` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.stock_accessory_accessory : ~3 rows (environ)
DELETE FROM `stock_accessory_accessory`;
INSERT INTO `stock_accessory_accessory` (`stock_accessory_id`, `accessory_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1);

-- Listage de la structure de la table fightinggame. stock_personnage
DROP TABLE IF EXISTS `stock_personnage`;
CREATE TABLE IF NOT EXISTS `stock_personnage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stock_user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C4A3BFC1BEC8C336` (`stock_user_id`),
  CONSTRAINT `FK_C4A3BFC1BEC8C336` FOREIGN KEY (`stock_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.stock_personnage : ~3 rows (environ)
DELETE FROM `stock_personnage`;
INSERT INTO `stock_personnage` (`id`, `stock_user_id`) VALUES
	(1, 1),
	(2, 2),
	(3, 3);

-- Listage de la structure de la table fightinggame. stock_personnage_personnage
DROP TABLE IF EXISTS `stock_personnage_personnage`;
CREATE TABLE IF NOT EXISTS `stock_personnage_personnage` (
  `stock_personnage_id` int NOT NULL,
  `personnage_id` int NOT NULL,
  PRIMARY KEY (`stock_personnage_id`,`personnage_id`),
  KEY `IDX_35BE6CF5DAAE79A6` (`stock_personnage_id`),
  KEY `IDX_35BE6CF55E315342` (`personnage_id`),
  CONSTRAINT `FK_35BE6CF55E315342` FOREIGN KEY (`personnage_id`) REFERENCES `personnage` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_35BE6CF5DAAE79A6` FOREIGN KEY (`stock_personnage_id`) REFERENCES `stock_personnage` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.stock_personnage_personnage : ~16 rows (environ)
DELETE FROM `stock_personnage_personnage`;
INSERT INTO `stock_personnage_personnage` (`stock_personnage_id`, `personnage_id`) VALUES
	(1, 7),
	(1, 10),
	(1, 18),
	(1, 29),
	(1, 42),
	(2, 8),
	(2, 23),
	(2, 32),
	(2, 33),
	(2, 38),
	(2, 48),
	(3, 16),
	(3, 21),
	(3, 22),
	(3, 30),
	(3, 31);

-- Listage de la structure de la table fightinggame. stock_weapon
DROP TABLE IF EXISTS `stock_weapon`;
CREATE TABLE IF NOT EXISTS `stock_weapon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stock_user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A3157570BEC8C336` (`stock_user_id`),
  CONSTRAINT `FK_A3157570BEC8C336` FOREIGN KEY (`stock_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.stock_weapon : ~3 rows (environ)
DELETE FROM `stock_weapon`;
INSERT INTO `stock_weapon` (`id`, `stock_user_id`) VALUES
	(1, 1),
	(2, 2),
	(3, 3);

-- Listage de la structure de la table fightinggame. stock_weapon_weapon
DROP TABLE IF EXISTS `stock_weapon_weapon`;
CREATE TABLE IF NOT EXISTS `stock_weapon_weapon` (
  `stock_weapon_id` int NOT NULL,
  `weapon_id` int NOT NULL,
  PRIMARY KEY (`stock_weapon_id`,`weapon_id`),
  KEY `IDX_D059A225D25C49B` (`stock_weapon_id`),
  KEY `IDX_D059A22595B82273` (`weapon_id`),
  CONSTRAINT `FK_D059A22595B82273` FOREIGN KEY (`weapon_id`) REFERENCES `weapon` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D059A225D25C49B` FOREIGN KEY (`stock_weapon_id`) REFERENCES `stock_weapon` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.stock_weapon_weapon : ~27 rows (environ)
DELETE FROM `stock_weapon_weapon`;
INSERT INTO `stock_weapon_weapon` (`stock_weapon_id`, `weapon_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 4),
	(1, 5),
	(1, 6),
	(1, 7),
	(1, 8),
	(1, 9),
	(2, 1),
	(2, 2),
	(2, 3),
	(2, 4),
	(2, 5),
	(2, 6),
	(2, 7),
	(2, 8),
	(2, 9),
	(3, 1),
	(3, 2),
	(3, 3),
	(3, 4),
	(3, 5),
	(3, 6),
	(3, 7),
	(3, 8),
	(3, 9);

-- Listage de la structure de la table fightinggame. type_stat_action
DROP TABLE IF EXISTS `type_stat_action`;
CREATE TABLE IF NOT EXISTS `type_stat_action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_stat` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank_stat1` int NOT NULL,
  `rank_stat2` int NOT NULL,
  `rank_stat3` int NOT NULL,
  `rank_stat4` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.type_stat_action : ~3 rows (environ)
DELETE FROM `type_stat_action`;
INSERT INTO `type_stat_action` (`id`, `nom_stat`, `nom_type`, `rank_stat1`, `rank_stat2`, `rank_stat3`, `rank_stat4`) VALUES
	(1, 'Life', 'Réduction de dégâts', 20, 40, 60, 80),
	(2, 'Magic', 'Protection Magique', 25, 50, 75, 100),
	(3, 'Attack', 'Protection Physique', 25, 50, 75, 100);

-- Listage de la structure de la table fightinggame. type_weapon
DROP TABLE IF EXISTS `type_weapon`;
CREATE TABLE IF NOT EXISTS `type_weapon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advantage` int NOT NULL,
  `disadvantage` int NOT NULL,
  `advantage_multiplicator` double NOT NULL,
  `disadvantage_multiplicator` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.type_weapon : ~3 rows (environ)
DELETE FROM `type_weapon`;
INSERT INTO `type_weapon` (`id`, `name_type`, `advantage`, `disadvantage`, `advantage_multiplicator`, `disadvantage_multiplicator`) VALUES
	(1, 'Type 1', 3, 2, 1.25, 0.75),
	(2, 'Type 2', 1, 3, 1.25, 0.75),
	(3, 'Type 3', 2, 1, 1.25, 0.75);

-- Listage de la structure de la table fightinggame. user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gold` int NOT NULL,
  `kill_count` int NOT NULL,
  `win_count` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.user : ~3 rows (environ)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `username`, `roles`, `password`, `gold`, `kill_count`, `win_count`, `email`, `is_verified`) VALUES
	(1, '1stUserAdmin', '["ROLE_ADMIN"]', '$2y$13$ZU89MBb0ggsFCmEpwgm3rOdcartVan1IjcJRujhQemmdHGU.aHY.6', 0, 0, 1, 'user.nb1@test.com', 1),
	(2, '2ndUser', '["ROLE_ADMIN"]', '$2y$13$dLDlzaZ.i9drB8HN2amXOugFFpAP2RA./T.0/K4Rb9M3dZCa3/Z4O', 2000, 0, 5, 'user.nb2@test.com', 1),
	(3, 'test', '[]', '$2y$13$HIzfj4wwCxGyhuVtGuqQVeqzCfgkIodc7mun6.s/Rm.ufikDROxUy', 1000, 0, 0, 'test@test.test', 1);

-- Listage de la structure de la table fightinggame. weapon
DROP TABLE IF EXISTS `weapon`;
CREATE TABLE IF NOT EXISTS `weapon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `weapon_type_id` int NOT NULL,
  `weapon_category_id` int NOT NULL,
  `weapon_element_id` int NOT NULL,
  `skill_element_id` int NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attack_stat` int NOT NULL,
  `magic_stat` int NOT NULL,
  `attack_skill` int NOT NULL,
  `magic_skill` int NOT NULL,
  `energy_skill` int NOT NULL,
  `wait_skill` int NOT NULL,
  `cost` int NOT NULL,
  `name_skill` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_creator_id` int DEFAULT NULL,
  `image_path` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_6933A7E6607BCCD7` (`weapon_type_id`),
  KEY `IDX_6933A7E64011281B` (`weapon_category_id`),
  KEY `IDX_6933A7E62048E597` (`weapon_element_id`),
  KEY `IDX_6933A7E6A96F656` (`skill_element_id`),
  KEY `IDX_6933A7E6C645C84A` (`user_creator_id`),
  CONSTRAINT `FK_6933A7E62048E597` FOREIGN KEY (`weapon_element_id`) REFERENCES `element` (`id`),
  CONSTRAINT `FK_6933A7E64011281B` FOREIGN KEY (`weapon_category_id`) REFERENCES `category_weapon` (`id`),
  CONSTRAINT `FK_6933A7E6607BCCD7` FOREIGN KEY (`weapon_type_id`) REFERENCES `type_weapon` (`id`),
  CONSTRAINT `FK_6933A7E6A96F656` FOREIGN KEY (`skill_element_id`) REFERENCES `element` (`id`),
  CONSTRAINT `FK_6933A7E6C645C84A` FOREIGN KEY (`user_creator_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table fightinggame.weapon : ~9 rows (environ)
DELETE FROM `weapon`;
INSERT INTO `weapon` (`id`, `weapon_type_id`, `weapon_category_id`, `weapon_element_id`, `skill_element_id`, `name`, `attack_stat`, `magic_stat`, `attack_skill`, `magic_skill`, `energy_skill`, `wait_skill`, `cost`, `name_skill`, `user_creator_id`, `image_path`) VALUES
	(1, 1, 1, 6, 6, 'Hache Neutre', 20, 20, 50, 50, 30, 1, 0, 'Coup Sauté', NULL, '/img/weapon/axe.webp'),
	(2, 2, 1, 6, 6, 'Épée Neutre', 20, 20, 50, 50, 30, 1, 0, 'Coup Sauté', NULL, '/img/weapon/sword.webp'),
	(3, 3, 1, 6, 6, 'Lance Neutre', 20, 20, 50, 50, 30, 1, 0, 'Coup Sauté', NULL, '/img/weapon/lance.webp'),
	(4, 1, 2, 6, 6, 'Tatouage Neutre', 20, 20, 50, 50, 30, 1, 0, 'Jet Arcanique', NULL, '/img/weapon/tattoo.webp'),
	(5, 2, 2, 6, 6, 'Tome Neutre', 20, 20, 50, 50, 30, 1, 0, 'Jet Arcanique', NULL, '/img/weapon/book.webp'),
	(6, 3, 2, 6, 6, 'Sceptre Neutre', 20, 20, 50, 50, 30, 1, 0, 'Jet Arcanique', NULL, '/img/weapon/wand.webp'),
	(7, 1, 3, 6, 6, 'Gantelet Neutre', 20, 20, 50, 50, 30, 1, 0, 'Attaque Sournoise', NULL, '/img/weapon/gauntlet.webp'),
	(8, 2, 3, 6, 6, 'Dague Neutre', 20, 20, 50, 50, 30, 1, 0, 'Attaque Sournoise', NULL, '/img/weapon/dagger.webp'),
	(9, 3, 3, 6, 6, 'Arc Neutre', 20, 20, 50, 50, 30, 1, 0, 'Attaque Sournoise', NULL, '/img/weapon/bow.webp');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
