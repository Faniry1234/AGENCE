-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de table madavoyage. circuits
CREATE TABLE IF NOT EXISTS `circuits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table madavoyage.circuits : ~6 rows (environ)
INSERT INTO `circuits` (`id`, `titre`, `nom`, `description`, `image`, `prix`, `created_at`) VALUES
	(1, NULL, 'Aventure au Nord : Tsingy & Baobabs', 'Découvrez les magnifiques formations rocheuses des Tsingy et les majestueux baobabs', 'public/assets/images/baobab.jpg', 250000.00, '2025-09-10 11:21:40'),
	(2, NULL, 'Détente au Sud : Plages & Lémuriens', 'Profitez des plages paradisiaques du Sud et observez les lémuriens dans leur habitat naturel', 'public/assets/images/lemurien.jpg', 300000.00, '2025-09-10 11:21:40'),
	(3, NULL, 'Immersion Culturelle à l\'Est', 'Immergez-vous dans la culture malgache traditionnelle', 'public/assets/images/chute.jpg', 200000.00, '2025-09-10 11:21:40'),
	(4, NULL, 'Nosy Be : L\'île aux Parfums', 'Découvrez l\'île paradisiaque de Nosy Be et ses plages de sable blanc', 'public/assets/images/nosy.jpg', 350000.00, '2025-09-10 11:21:40'),
	(5, NULL, 'Parc National de l\'Isalo', 'Explorez les canyons spectaculaires et la faune unique de l\'Isalo', 'public/assets/images/paradis.jpg', 400000.00, '2025-09-10 11:21:40'),
	(6, NULL, 'Antananarivo : La Capitale', 'Visitez les sites historiques et culturels de la capitale', 'public/assets/images/maki.jpg', 150000.00, '2025-09-10 11:21:40');

-- Listage de la structure de table madavoyage. login_history
CREATE TABLE IF NOT EXISTS `login_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_email` (`user_email`),
  CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table madavoyage.login_history : ~2 rows (environ)
INSERT INTO `login_history` (`id`, `user_email`, `login_time`) VALUES
	(1, 'admin@madavoyage.com', '2025-09-10 12:18:50'),
	(2, 'rabearisoafaniry3@gmail.com', '2025-09-11 08:34:32');

-- Listage de la structure de table madavoyage. messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lu` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table madavoyage.messages : ~0 rows (environ)

-- Listage de la structure de table madavoyage. paiements
CREATE TABLE IF NOT EXISTS `paiements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reservation_id` int DEFAULT NULL,
  `montant` decimal(10,2) NOT NULL,
  `methode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_paiement` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `reservation_id` (`reservation_id`),
  CONSTRAINT `paiements_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table madavoyage.paiements : ~0 rows (environ)

-- Listage de la structure de table madavoyage. reservations
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `circuit_id` int DEFAULT NULL,
  `montant` decimal(10,2) NOT NULL,
  `statut` enum('en attente','confirmé','annulé') COLLATE utf8mb4_unicode_ci DEFAULT 'en attente',
  `type_paiement` enum('total','partiel') COLLATE utf8mb4_unicode_ci DEFAULT 'total',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `circuit_id` (`circuit_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`circuit_id`) REFERENCES `circuits` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table madavoyage.reservations : ~0 rows (environ)

-- Listage de la structure de table madavoyage. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table madavoyage.users : ~3 rows (environ)
INSERT INTO `users` (`id`, `nom`, `email`, `password`, `role`, `created_at`) VALUES
	(1, 'Admin', 'admin@madavoyage.com', '$2y$10$32Kl41.L9bQg.hStUwCTm.g1ceWcK8TPLzq2CJ7WUXowWmm0kgwLC', 'admin', '2025-09-10 11:21:40'),
	(2, 'AinaPrincy', 'princyaina3@gmail.com', '$2y$10$.Wnp4NBzfwHiF/cLezS9ku.SgmjIHtzcWk.5Q5QwwiV5dcIqbtSci', 'user', '2025-09-10 12:02:32'),
	(3, 'Faniry10', 'rabearisoafaniry3@gmail.com', '$2y$10$yp4wEoAOxj2KV0Z0DWJgrOUTy/l1jFam2b8J0fsasl.Jeg6YN./qG', 'user', '2025-09-11 08:34:09');

-- Listage de la structure de table madavoyage. user_actions
CREATE TABLE IF NOT EXISTS `user_actions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `action_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_email` (`user_email`),
  CONSTRAINT `user_actions_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table madavoyage.user_actions : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
