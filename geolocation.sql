-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 23 nov. 2021 à 20:04
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `geolocation`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20211119133927', '2021-11-19 13:40:21', 68),
('DoctrineMigrations\\Version20211121230756', '2021-11-21 23:08:12', 279),
('DoctrineMigrations\\Version20211121232919', '2021-11-21 23:29:24', 97),
('DoctrineMigrations\\Version20211122002604', '2021-11-22 00:26:09', 169),
('DoctrineMigrations\\Version20211122022304', '2021-11-22 02:23:07', 160),
('DoctrineMigrations\\Version20211122102104', '2021-11-22 10:21:09', 152),
('DoctrineMigrations\\Version20211123114944', '2021-11-23 11:49:55', 289),
('DoctrineMigrations\\Version20211123140920', '2021-11-23 14:09:24', 138);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `genre` int(11) NOT NULL,
  `date_de_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metier` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `prenom`, `nom`, `pays`, `is_verified`, `genre`, `date_de_naissance`, `metier`) VALUES
(1, 'admin@geolocati.on', '[\"ROLE_ADMIN\"]', '$2y$13$s9c2VAJZ6EQInCxjaToeDuU3A2dFM.FVumm1QSUpPlEe31JFdZcQm', 'Toto', 'Admin', 'FR', 0, 1, '10/06/1999', 13),
(2, 'user@geolocati.on', '[]', '$2y$13$rQXUScas8lj0h2qRIFRNAOPLYgJ2ahtZFCLVOdhdrhaqtpmnku2iW', 'Toto', 'Kai', 'SG', 1, 0, '20/03/1985', 1),
(3, 'bob@geolocati.on', '[\"ROLE_ADMIN\"]', '$2y$13$TAhls1q/kxHMNiOJ4bEFdezfXmJiuWRUikV.XJ7WxoFGIV6FqgQYO', 'Mia', 'FOTO', 'CA', 0, 1, '20/03/1999', 14),
(4, 'dj@geolocati.on', '[]', '$2y$13$aDFxhjDQJgNbLvnuXknsaO36QxTZEAlhfeOmhKlQLmdyaLDnKBFkO', 'Dj', 'Od', 'FR', 0, 0, '30/01/2000', 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
