-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 16 mars 2022 à 03:51
-- Version du serveur :  8.0.21
-- Version de PHP : 8.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pao_manage`
--

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `planification_id` int DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_47CC8C92E65142C2` (`planification_id`),
  KEY `IDX_47CC8C92B03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `action`
--

INSERT INTO `action` (`id`, `planification_id`, `libelle`, `description`, `created_by_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Action 1', 'Première action pour la planification du programme général', NULL, '2022-03-16 01:21:36', '2022-03-16 01:21:36');

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

DROP TABLE IF EXISTS `activite`;
CREATE TABLE IF NOT EXISTS `activite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sous_action_id` int DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B8755515863B1B7A` (`sous_action_id`),
  KEY `IDX_B8755515B03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`id`, `sous_action_id`, `libelle`, `description`, `created_by_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sous Activité 1', 'Première Sous activité', 5, '2022-03-16 03:20:33', '2022-03-16 03:20:33');

-- --------------------------------------------------------

--
-- Structure de la table `agent_financement`
--

DROP TABLE IF EXISTS `agent_financement`;
CREATE TABLE IF NOT EXISTS `agent_financement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by_id` int DEFAULT NULL,
  `niveau_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_497DD634B03A8386` (`created_by_id`),
  KEY `IDX_497DD634B3E9C81` (`niveau_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `description`, `created_at`, `updated_at`, `created_by_id`, `niveau_id`) VALUES
(1, 'Secrétariat Général', 'Categorie Secrétariat Général', '2022-03-05 07:22:15', '2022-03-05 07:22:15', NULL, 1),
(2, 'Cabinet du Ministre', 'Categorie Stucture Du Cabinet du Ministre', '2022-03-08 04:26:47', '2022-03-08 04:26:47', 5, 1),
(3, 'Inspection Général', 'Catégorie Structure de l\'Inspection Général', '2022-03-08 04:27:54', '2022-03-08 04:27:54', 5, 1),
(4, 'Etablissements Publics', 'Catégorie Structure Des Etablissements Publics', '2022-03-08 04:29:00', '2022-03-08 04:29:20', 5, 1),
(5, 'Entreprises publiques', 'Catégorie Structure Des Entreprises publiques', '2022-03-08 04:30:01', '2022-03-08 04:30:01', 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `configuration_system`
--

DROP TABLE IF EXISTS `configuration_system`;
CREATE TABLE IF NOT EXISTS `configuration_system` (
  `id` int NOT NULL AUTO_INCREMENT,
  `taux` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220305070243', '2022-03-05 07:04:00', 14054),
('DoctrineMigrations\\Version20220305071814', '2022-03-05 07:18:35', 4322),
('DoctrineMigrations\\Version20220306105302', '2022-03-06 11:07:15', 23735),
('DoctrineMigrations\\Version20220306203118', '2022-03-06 20:31:53', 5881),
('DoctrineMigrations\\Version20220306203451', '2022-03-06 20:39:58', 4978),
('DoctrineMigrations\\Version20220306205152', '2022-03-06 20:52:14', 5177),
('DoctrineMigrations\\Version20220306210036', '2022-03-06 22:16:42', 10476),
('DoctrineMigrations\\Version20220306234229', '2022-03-06 23:42:55', 8260),
('DoctrineMigrations\\Version20220306234524', '2022-03-06 23:46:15', 8331),
('DoctrineMigrations\\Version20220308085538', '2022-03-08 08:56:18', 13249),
('DoctrineMigrations\\Version20220308090013', '2022-03-08 09:00:30', 545),
('DoctrineMigrations\\Version20220308091735', '2022-03-08 09:17:47', 2878),
('DoctrineMigrations\\Version20220309202117', '2022-03-09 20:21:53', 7392),
('DoctrineMigrations\\Version20220309202649', '2022-03-09 20:33:03', 3652),
('DoctrineMigrations\\Version20220310042650', '2022-03-10 04:27:12', 3136),
('DoctrineMigrations\\Version20220310044405', '2022-03-10 04:45:23', 2782),
('DoctrineMigrations\\Version20220310044900', '2022-03-10 04:49:12', 3032),
('DoctrineMigrations\\Version20220310044959', '2022-03-10 04:50:44', 295),
('DoctrineMigrations\\Version20220310045320', '2022-03-10 04:54:04', 3234),
('DoctrineMigrations\\Version20220310050009', '2022-03-10 05:00:25', 964),
('DoctrineMigrations\\Version20220310050239', '2022-03-10 05:03:20', 752),
('DoctrineMigrations\\Version20220310122147', '2022-03-10 12:22:24', 9805),
('DoctrineMigrations\\Version20220310122510', '2022-03-10 12:27:00', 4268),
('DoctrineMigrations\\Version20220310123212', '2022-03-10 12:32:24', 4427),
('DoctrineMigrations\\Version20220310125051', '2022-03-10 12:51:01', 4265),
('DoctrineMigrations\\Version20220310130611', '2022-03-10 13:06:22', 5620),
('DoctrineMigrations\\Version20220310150637', '2022-03-10 15:07:11', 10889),
('DoctrineMigrations\\Version20220310151933', '2022-03-10 15:19:53', 9141),
('DoctrineMigrations\\Version20220310161520', '2022-03-10 16:21:05', 7092),
('DoctrineMigrations\\Version20220312020312', '2022-03-12 02:03:59', 16923),
('DoctrineMigrations\\Version20220312031359', '2022-03-12 03:14:59', 5644),
('DoctrineMigrations\\Version20220312032612', '2022-03-12 03:26:29', 11756),
('DoctrineMigrations\\Version20220315072411', '2022-03-15 07:25:38', 16604),
('DoctrineMigrations\\Version20220315171341', '2022-03-15 17:16:16', 3429),
('DoctrineMigrations\\Version20220315172126', '2022-03-15 17:22:25', 4368),
('DoctrineMigrations\\Version20220315173124', '2022-03-15 17:31:36', 263),
('DoctrineMigrations\\Version20220315173559', '2022-03-15 17:36:33', 2788),
('DoctrineMigrations\\Version20220315173817', '2022-03-15 17:38:42', 5652),
('DoctrineMigrations\\Version20220315225051', '2022-03-15 22:51:27', 13243),
('DoctrineMigrations\\Version20220316014157', '2022-03-16 01:43:02', 19832),
('DoctrineMigrations\\Version20220316021159', '2022-03-16 02:13:16', 8128),
('DoctrineMigrations\\Version20220316021857', '2022-03-16 02:28:38', 2644),
('DoctrineMigrations\\Version20220316024158', '2022-03-16 02:42:25', 4129);

-- --------------------------------------------------------

--
-- Structure de la table `fonction_unite_fonctionnelle`
--

DROP TABLE IF EXISTS `fonction_unite_fonctionnelle`;
CREATE TABLE IF NOT EXISTS `fonction_unite_fonctionnelle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

DROP TABLE IF EXISTS `niveau`;
CREATE TABLE IF NOT EXISTS `niveau` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4BDFF36BB03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`id`, `libelle`, `description`, `created_at`, `updated_at`, `created_by_id`) VALUES
(1, 'Niveau central', 'Première Niveau', '2022-03-10 04:37:56', '2022-03-10 11:17:32', NULL),
(2, 'Niveau intermédiaire', 'deuxième niveau', '2022-03-10 09:47:25', '2022-03-10 09:48:17', NULL),
(3, 'Niveau périphérique', 'troisième niveau', '2022-03-10 09:49:57', '2022-03-10 09:49:57', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `niveau_province`
--

DROP TABLE IF EXISTS `niveau_province`;
CREATE TABLE IF NOT EXISTS `niveau_province` (
  `niveau_id` int NOT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`niveau_id`,`province_id`),
  KEY `IDX_F3DC14B8B3E9C81` (`niveau_id`),
  KEY `IDX_F3DC14B8E946114A` (`province_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `niveau_province`
--

INSERT INTO `niveau_province` (`niveau_id`, `province_id`) VALUES
(1, 12),
(1, 13),
(2, 1),
(3, 6);

-- --------------------------------------------------------

--
-- Structure de la table `planification`
--

DROP TABLE IF EXISTS `planification`;
CREATE TABLE IF NOT EXISTS `planification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `programme_id` int DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FFC02E1B62BB7AEE` (`programme_id`),
  KEY `IDX_FFC02E1BB03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `planification`
--

INSERT INTO `planification` (`id`, `programme_id`, `description`, `created_by_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'La Planification Sur L\'administration Generale', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `programme`
--

DROP TABLE IF EXISTS `programme`;
CREATE TABLE IF NOT EXISTS `programme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3DDCB9FFB03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `programme`
--

INSERT INTO `programme` (`id`, `libelle`, `description`, `created_at`, `updated_at`, `created_by_id`) VALUES
(1, 'Administration Générale', 'Programme Pour L\'Administration Générale', '2022-03-05 07:20:56', '2022-03-07 14:36:25', 5),
(2, 'Planification -Financement et équité', 'Programme Pour La Planification -Financement et équité', '2022-03-05 17:11:30', '2022-03-05 17:11:30', 5),
(3, 'Lutte contre la maladie', 'Programme Pour La Lutte contre la maladie', '2022-03-05 17:12:01', '2022-03-05 17:12:01', 5);

-- --------------------------------------------------------

--
-- Structure de la table `province`
--

DROP TABLE IF EXISTS `province`;
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by_id` int DEFAULT NULL,
  `chef_lieu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4ADAD40BB03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `province`
--

INSERT INTO `province` (`id`, `libelle`, `created_at`, `updated_at`, `created_by_id`, `chef_lieu`) VALUES
(1, 'Bas-Uele', '2022-03-07 00:00:19', '2022-03-08 09:20:29', 5, 'Buta'),
(2, 'Équateur', '2022-03-07 00:00:49', '2022-03-08 09:20:56', 5, 'Mbandaka'),
(3, 'Haut-Katanga', '2022-03-07 00:01:14', '2022-03-10 11:19:17', 5, 'Lubumbashi'),
(4, 'Haut-Lomami', '2022-03-08 08:41:03', '2022-03-08 09:21:42', 5, 'Kamina'),
(5, 'Haut-Uele', '2022-03-08 08:46:19', '2022-03-08 09:22:06', 5, 'Isiro'),
(6, 'ituri', '2022-03-08 08:46:31', '2022-03-08 09:22:39', 5, 'Bunia'),
(7, 'kasai', '2022-03-08 08:46:51', '2022-03-08 09:23:03', 5, 'Tshikapa'),
(8, 'Kasaï central', '2022-03-08 08:47:06', '2022-03-08 09:23:37', 5, 'Kananga'),
(9, 'Kasaï oriental', '2022-03-08 08:47:19', '2022-03-08 09:23:58', 5, 'Mbuji-Mayi'),
(10, 'Kinshasa', '2022-03-08 08:47:32', '2022-03-08 09:24:48', 5, 'Kinshasa'),
(11, 'Kongo-Central', '2022-03-08 08:47:45', '2022-03-08 09:25:32', 5, 'Matadi'),
(12, 'Kwango', '2022-03-08 08:47:58', '2022-03-08 09:25:51', 5, 'Kenge'),
(13, 'Kwilu', '2022-03-08 08:48:12', '2022-03-08 09:27:03', 5, 'Bandundu'),
(14, 'Lomami', '2022-03-08 08:48:23', '2022-03-08 09:27:30', 5, 'Kabinda'),
(15, 'Lualaba', '2022-03-08 08:48:39', '2022-03-08 09:27:49', 5, 'Kolwezi'),
(16, 'Mai-Ndombe', '2022-03-08 08:48:53', '2022-03-08 09:28:19', 5, 'Inongo'),
(17, 'Maniema', '2022-03-08 08:49:06', '2022-03-08 09:28:40', 5, 'Kindu'),
(18, 'Mongala', '2022-03-08 08:49:18', '2022-03-08 09:28:58', 5, 'Lisala'),
(19, 'Nord-Kivu', '2022-03-08 08:49:30', '2022-03-08 09:29:29', 5, 'Goma'),
(20, 'Nord-Ubangi', '2022-03-08 08:49:44', '2022-03-08 09:30:08', 5, 'Gbadolite'),
(21, 'Sankuru', '2022-03-08 08:49:58', '2022-03-08 09:30:26', 5, 'Lusambo'),
(22, 'Sud-Kivu', '2022-03-08 08:50:11', '2022-03-08 09:30:51', 5, 'Bukavu'),
(23, 'Sud-Ubangi', '2022-03-08 08:50:30', '2022-03-08 09:31:16', 5, 'Gemena'),
(24, 'Tanganyika', '2022-03-08 08:50:48', '2022-03-08 08:50:48', 5, NULL),
(25, 'Tshopo', '2022-03-08 08:51:00', '2022-03-08 08:51:00', 5, NULL),
(26, 'Tshuapa', '2022-03-08 08:51:14', '2022-03-08 08:51:14', 5, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sous_action`
--

DROP TABLE IF EXISTS `sous_action`;
CREATE TABLE IF NOT EXISTS `sous_action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `action_id` int DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_97D37E659D32F035` (`action_id`),
  KEY `IDX_97D37E65B03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sous_action`
--

INSERT INTO `sous_action` (`id`, `action_id`, `libelle`, `description`, `created_by_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sous Action 1', 'première sous activité', 5, '2022-03-16 03:07:18', '2022-03-16 03:30:24');

-- --------------------------------------------------------

--
-- Structure de la table `sous_activite`
--

DROP TABLE IF EXISTS `sous_activite`;
CREATE TABLE IF NOT EXISTS `sous_activite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `montant` decimal(10,0) NOT NULL,
  `devise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` int DEFAULT NULL,
  `activite_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B03B6140B03A8386` (`created_by_id`),
  KEY `IDX_B03B61409B0F88B1` (`activite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `structure`
--

DROP TABLE IF EXISTS `structure`;
CREATE TABLE IF NOT EXISTS `structure` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `structure_de_reference_id` int DEFAULT NULL,
  `categorie_id` int DEFAULT NULL,
  `type_de_structure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6F0137EA5B7B45C4` (`structure_de_reference_id`),
  KEY `IDX_6F0137EABCF5E72D` (`categorie_id`),
  KEY `IDX_6F0137EAB03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `structure`
--

INSERT INTO `structure` (`id`, `created_at`, `updated_at`, `structure_de_reference_id`, `categorie_id`, `type_de_structure`, `created_by_id`, `libelle`, `description`) VALUES
(1, '2022-03-16 02:49:01', '2022-03-16 02:49:01', NULL, 2, 'Aucun', 5, 'Structure 1', 'Première structure'),
(2, '2022-03-16 03:03:57', '2022-03-16 03:03:57', 1, 5, 'Enfant', 5, 'Structure 2', 'deuxième structure');

-- --------------------------------------------------------

--
-- Structure de la table `type_validation_uf`
--

DROP TABLE IF EXISTS `type_validation_uf`;
CREATE TABLE IF NOT EXISTS `type_validation_uf` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_de_validation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DAB3C314B03A8386` (`created_by_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `unite_fonctionnelle`
--

DROP TABLE IF EXISTS `unite_fonctionnelle`;
CREATE TABLE IF NOT EXISTS `unite_fonctionnelle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categorie_id` int NOT NULL,
  `libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `programme_id` int NOT NULL,
  `created_by_id` int DEFAULT NULL,
  `zone_de_sante_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5665589BCF5E72D` (`categorie_id`),
  KEY `IDX_566558962BB7AEE` (`programme_id`),
  KEY `IDX_5665589B03A8386` (`created_by_id`),
  KEY `IDX_566558915CFF4BA` (`zone_de_sante_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `unite_fonctionnelle`
--

INSERT INTO `unite_fonctionnelle` (`id`, `categorie_id`, `libelle`, `description`, `created_at`, `updated_at`, `programme_id`, `created_by_id`, `zone_de_sante_id`) VALUES
(1, 1, 'DRH', 'Unité DRH', '2022-03-05 07:25:21', '2022-03-05 07:25:21', 1, NULL, NULL),
(2, 1, 'DEP', 'Unité fonctionnelle pour le departement', '2022-03-05 18:06:01', '2022-03-05 18:06:01', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `unite_fonctionnelle_type_validation_uf`
--

DROP TABLE IF EXISTS `unite_fonctionnelle_type_validation_uf`;
CREATE TABLE IF NOT EXISTS `unite_fonctionnelle_type_validation_uf` (
  `unite_fonctionnelle_id` int NOT NULL,
  `type_validation_uf_id` int NOT NULL,
  PRIMARY KEY (`unite_fonctionnelle_id`,`type_validation_uf_id`),
  KEY `IDX_E07BB1D8EBB88846` (`unite_fonctionnelle_id`),
  KEY `IDX_E07BB1D8CFD1A8FD` (`type_validation_uf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `created_at`, `updated_at`) VALUES
(5, 'peterkofi74@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$TsJ0dHHNuIZMonnUQe6t7.xav0d.yRI9szxmS7bNHDqGHgiGXHBNK', NULL, NULL),
(6, 'crispin@gmail.com', '[]', '$2y$13$t7aTXozViiwvWiDviqYNlu9X3ZTvneOA6dIcwguDQfBMZjgLO6aHm', NULL, NULL),
(7, 'elie@gmail.com', '[]', '$2y$13$wiheh8Wj8DbclSrG92uxaeJqZBZpMZf2BXPxCcEnRSMXz2/u/0I.q', NULL, NULL),
(8, 'josue@gmail.com', '[]', '$2y$13$bGvCiclPmXDM0WemLl41t.94GNHEkoIxBJjikpyreF.aznYot2gaW', NULL, NULL),
(9, 'lord@gmail.com', '[]', '$2y$13$AY/mHENi.oW/BMIkGjLaM.Qg3F4/Aj75hABc73c0BlRGFD7TICM0S', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `id` int NOT NULL AUTO_INCREMENT,
  `province_id` int DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_by_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_43C3D9C3E946114A` (`province_id`),
  KEY `IDX_43C3D9C3B03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `province_id`, `libelle`, `description`, `created_by_id`, `created_at`, `updated_at`) VALUES
(1, 16, 'Inongo', 'Ville de Inongo', NULL, '2022-03-15 23:56:21', '2022-03-15 23:56:21'),
(2, 10, 'Kinshasa', 'Ville de kinshasa', NULL, '2022-03-16 00:19:05', '2022-03-16 00:19:05');

-- --------------------------------------------------------

--
-- Structure de la table `zone_de_sante`
--

DROP TABLE IF EXISTS `zone_de_sante`;
CREATE TABLE IF NOT EXISTS `zone_de_sante` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville_id` int DEFAULT NULL,
  `created_by_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3443E1A3A73F0036` (`ville_id`),
  KEY `IDX_3443E1A3B03A8386` (`created_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `zone_de_sante`
--

INSERT INTO `zone_de_sante` (`id`, `libelle`, `description`, `ville_id`, `created_by_id`, `created_at`, `updated_at`) VALUES
(1, 'ZS Kikimi', 'Zone de santé de kikimi', 2, NULL, '2022-03-16 00:44:28', '2022-03-16 00:44:28');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `FK_47CC8C92B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_47CC8C92E65142C2` FOREIGN KEY (`planification_id`) REFERENCES `planification` (`id`);

--
-- Contraintes pour la table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `FK_B8755515863B1B7A` FOREIGN KEY (`sous_action_id`) REFERENCES `sous_action` (`id`),
  ADD CONSTRAINT `FK_B8755515B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `FK_497DD634B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_497DD634B3E9C81` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`);

--
-- Contraintes pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD CONSTRAINT `FK_4BDFF36BB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `niveau_province`
--
ALTER TABLE `niveau_province`
  ADD CONSTRAINT `FK_F3DC14B8B3E9C81` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F3DC14B8E946114A` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `planification`
--
ALTER TABLE `planification`
  ADD CONSTRAINT `FK_FFC02E1B62BB7AEE` FOREIGN KEY (`programme_id`) REFERENCES `programme` (`id`),
  ADD CONSTRAINT `FK_FFC02E1BB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `programme`
--
ALTER TABLE `programme`
  ADD CONSTRAINT `FK_3DDCB9FFB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `province`
--
ALTER TABLE `province`
  ADD CONSTRAINT `FK_4ADAD40BB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `sous_action`
--
ALTER TABLE `sous_action`
  ADD CONSTRAINT `FK_97D37E659D32F035` FOREIGN KEY (`action_id`) REFERENCES `action` (`id`),
  ADD CONSTRAINT `FK_97D37E65B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `sous_activite`
--
ALTER TABLE `sous_activite`
  ADD CONSTRAINT `FK_B03B61409B0F88B1` FOREIGN KEY (`activite_id`) REFERENCES `activite` (`id`),
  ADD CONSTRAINT `FK_B03B6140B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `structure`
--
ALTER TABLE `structure`
  ADD CONSTRAINT `FK_6F0137EA5B7B45C4` FOREIGN KEY (`structure_de_reference_id`) REFERENCES `structure` (`id`),
  ADD CONSTRAINT `FK_6F0137EAB03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_6F0137EABCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `type_validation_uf`
--
ALTER TABLE `type_validation_uf`
  ADD CONSTRAINT `FK_DAB3C314B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `unite_fonctionnelle`
--
ALTER TABLE `unite_fonctionnelle`
  ADD CONSTRAINT `FK_566558915CFF4BA` FOREIGN KEY (`zone_de_sante_id`) REFERENCES `zone_de_sante` (`id`),
  ADD CONSTRAINT `FK_566558962BB7AEE` FOREIGN KEY (`programme_id`) REFERENCES `programme` (`id`),
  ADD CONSTRAINT `FK_5665589B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_5665589BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `unite_fonctionnelle_type_validation_uf`
--
ALTER TABLE `unite_fonctionnelle_type_validation_uf`
  ADD CONSTRAINT `FK_E07BB1D8CFD1A8FD` FOREIGN KEY (`type_validation_uf_id`) REFERENCES `type_validation_uf` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E07BB1D8EBB88846` FOREIGN KEY (`unite_fonctionnelle_id`) REFERENCES `unite_fonctionnelle` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `FK_43C3D9C3B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_43C3D9C3E946114A` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`);

--
-- Contraintes pour la table `zone_de_sante`
--
ALTER TABLE `zone_de_sante`
  ADD CONSTRAINT `FK_3443E1A3A73F0036` FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`),
  ADD CONSTRAINT `FK_3443E1A3B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
