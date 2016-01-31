-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 31 Janvier 2016 à 15:22
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
USE db_starwars;
--

-- --------------------------------------------------------

--
-- Structure de la table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `command at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('finalized','unfinalized') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unfinalized',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Lazers', 'lazers', '', '2016-01-31 11:24:31', '0000-00-00 00:00:00'),
(2, 'Casques', 'casques', '', '2016-01-31 11:24:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `command_unfs`
--

CREATE TABLE `command_unfs` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `cart_id` int(10) UNSIGNED DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `command_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('finalized','unfinalized') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unfinalized',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `number_card` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `number_products_commanded` smallint(6) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `address`, `number_card`, `number_products_commanded`, `created_at`, `updated_at`) VALUES
(1, 1, '3165 Bashirian Loop\nEast Devenland, OH 04920', '343884325206293', 0, '2016-01-31 11:24:31', '2016-01-31 11:24:31'),
(2, 2, '94364 Rex Fords\nWest Enola, PA 18290-1963', '4556400549058', 0, '2016-01-31 11:24:31', '2016-01-31 11:24:31'),
(3, 3, '439 Shany Harbors Suite 138\nNew Emmalee, HI 98971-2952', '4539797526445179', 0, '2016-01-31 11:24:31', '2016-01-31 11:24:31'),
(4, 4, '953 Brock Spur Apt. 005\nEast Hendersontown, WY 59381', '4532601733384840', 0, '2016-01-31 11:24:31', '2016-01-31 11:24:31');

-- --------------------------------------------------------

--
-- Structure de la table `histories`
--

CREATE TABLE `histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(7,2) DEFAULT NULL,
  `command_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `history_details`
--

CREATE TABLE `history_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `history_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` smallint(6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_12_30_101801_create_categories_table', 1),
('2015_12_30_102102_create_tags_table', 1),
('2015_12_30_110700_create_products_table', 1),
('2015_12_30_114056_create_pictures_table', 1),
('2015_12_30_115300_create_product_tag_table', 1),
('2015_12_30_133206_create_customers_table', 1),
('2015_12_30_133935_create_histories_table', 1),
('2015_12_30_135500_alter_pictures_table', 1),
('2016_01_12_104709_alter_products_table', 1),
('2016_01_12_112600_alter_categories_table', 1),
('2016_01_20_181614_create_carts_table', 1),
('2016_01_22_195554_create_history_details_table', 1),
('2016_01_26_163516_create_command_unfs_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` smallint(6) NOT NULL,
  `type` enum('png','jpg','gif') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `pictures`
--

INSERT INTO `pictures` (`id`, `product_id`, `title`, `uri`, `size`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'Casque Stormtrooper', 'TIAeqKUcX7KY.png', 32767, 'png', '2016-01-31 11:29:56', '2016-01-31 11:29:56'),
(2, 3, 'Kit masque et casque Dark Vador', 'Smip9P9qAF3g.png', 32767, 'png', '2016-01-31 11:40:00', '2016-01-31 11:40:00'),
(3, 4, 'Masque Yoda Star Wars adulte', 'yNMo6sOOhK9H.png', 32767, 'png', '2016-01-31 11:41:54', '2016-01-31 11:41:54'),
(4, 5, 'Watto - masque de latex', 'CKGeph3OywPN.png', 32767, 'png', '2016-01-31 11:47:05', '2016-01-31 11:47:05'),
(5, 6, 'Masque maître Jedi Saesee Tiin ', 'ubZ3YELusSif.jpg', 21445, 'jpg', '2016-01-31 11:48:43', '2016-01-31 11:48:43'),
(6, 7, 'Masque adulte - pièce Captain Phasma', 'sGTMRSdfVFv4.jpg', 13696, 'jpg', '2016-01-31 11:51:20', '2016-01-31 11:51:20'),
(7, 8, 'Masque C3PO™ Star Wars adulte', 'i1SjV32qhAoi.png', 32767, 'png', '2016-01-31 11:53:21', '2016-01-31 11:53:21'),
(8, 9, 'Sabre Basic Dark Side', 'FpOblMnmDOIQ.jpg', 32767, 'jpg', '2016-01-31 11:59:15', '2016-01-31 11:59:15'),
(9, 10, 'Star Wars Dark Maul Mini Sabre Lumineux', 'L50dldvk0JQC.png', 31854, 'png', '2016-01-31 12:00:48', '2016-01-31 12:00:48'),
(11, 12, 'Clone wars - Sabre Standard - Bleu de Hasbro', 'QAjhLq64VyQy.png', 15391, 'png', '2016-01-31 12:04:33', '2016-01-31 12:04:33'),
(12, 13, 'Sabre laser Star Wars Episode I', 'mI35bTNPm0kA.png', 32767, 'png', '2016-01-31 12:05:57', '2016-01-31 12:05:57'),
(13, 14, 'Star Wars Lightsaber Electronique - Anakin', 'JnNNExcnaxIK.png', 32767, 'png', '2016-01-31 12:07:16', '2016-01-31 12:07:16'),
(14, 15, 'Réplique 1/1 sabre laser Force FX avec lame amovible Luke Skywalker', 'Li1dpbnG5MK2.png', 12219, 'png', '2016-01-31 12:08:55', '2016-01-31 12:08:55'),
(15, 16, 'Star Wars réplique 1/1 sabre laser Force FX Anakin Skywalker', '8cSrJsYdmbUo.png', 22888, 'png', '2016-01-31 12:11:10', '2016-01-31 12:11:10');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `abstract` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL,
  `status` enum('opened','closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'opened',
  `published_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `abstract`, `content`, `price`, `quantity`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Casque Stormtrooper', 'casque-stormtrooper', 'Réplique taille réelle du casque des Stormtroopers de Star Wars Episode V The Empire Strikes Back.', 'Réplique taille réelle du casque des Stormtroopers de Star Wars Episode V The Empire Strikes Back. Il s''agit d''une réplique de la version ''stunt'' du casque, utilisée pour le tournage des cascades et des combats dans le film Star Wars: A New Hope.', '403.00', 15, 'opened', '2016-01-31 13:13:16', '2016-01-31 12:13:16', '2016-01-31 12:13:16'),
(3, 2, 'Kit masque et casque Dark Vador', 'kit-masque-et-casque-dark-vador', 'Cet ensemble (casque intégral et demi-masque sur le visage ) robuste en noir brillant est la fidèle reproduction de Dark Vador.', 'Ce casque intégral avec masque de Dark Vador est proposé sous licence "Star Wars ".Cet ensemble (casque intégral et demi-masque sur le visage ) robuste en noir brillant est la fidèle reproduction de Dark Vador.Une panoplie de déguisement pour adulte authentique pour tous les passionnés et pour ceux qui recherchent un déguisement extraordinaire venu d''outre tombe...', '46.60', 10, 'opened', '2016-01-31 13:13:47', '2016-01-31 12:13:47', '2016-01-31 12:13:47'),
(4, 2, 'Masque Yoda Star Wars adulte', 'masque-yoda-star-wars-adulte', 'Ce masque de YODA (Star Wars) en taille adulte est de très haut de gamme.', 'Ce masque de YODA (Star Wars) en taille adulte est de très haut de gamme. Il est en latex de luxe très réaliste, proche de la qualité du masque du film, pour se transformer en un clin d''oeil en YODA. Le plus célèbre des maîtres jedi.', '28.36', 20, 'opened', '2016-01-31 13:14:08', '2016-01-31 12:14:08', '2016-01-31 12:14:08'),
(5, 2, 'Watto - masque de latex', 'watto-masque-de-latex', 'Le produit sous licence, très beaux latex watto masque de détail qui enveloppe toute la tête à oreilles, yeux et la bouche.', 'Le produit sous licence, très beaux latex watto masque de détail qui enveloppe toute la tête à oreilles, yeux et la bouche. Une jolie idée de costume de carnaval ou d''halloween et un must have pour tout fan star wars.', '37.00', 40, 'opened', '2016-01-31 13:14:26', '2016-01-31 12:14:26', '2016-01-31 12:14:26'),
(6, 2, 'Masque maître Jedi Saesee Tiin ', 'masque-maitre-jedi-saesee-tiin', 'Ce masque de SAESSE TIIN (Star Wars) en taille adulte est de très haut de gamme.', 'Ce masque de SAESSE TIIN (Star Wars) en taille adulte est de très haut de gamme. Il est en latex deluxe très réaliste, proche de la qualité du masque du film, pour se transformer en un clin d''oeil en SAESSE TIIN, l''un des plus célèbre des maîtres jedi.', '65.90', 20, 'opened', '2016-01-31 13:14:42', '2016-01-31 12:14:42', '2016-01-31 12:14:42'),
(7, 2, 'Masque adulte - pièce Captain Phasma', 'masque-adulte-piece-captain-phasma', 'Ce masque de Captain Phasma™ pour adulte est sous licence officielle Star Wars™.', 'Ce masque de Captain Phasma™ pour adulte est sous licence officielle Star Wars™. En plastique, ce masque est fait en 2 parties qui s''assemblent entre elles à l''aide de scratchs. Des blocs de mousse sont présents à l''intérieur du masque pour plus de confort. Des ouvertures sont présentes au niveau des yeux.', '54.90', 15, 'opened', '2016-01-31 13:14:56', '2016-01-31 12:14:56', '2016-01-31 12:14:56'),
(8, 2, 'Masque C3PO™ Star Wars adulte', 'masque-c3po-star-wars-adulte', 'Ce masque C3PO™ en taille adulte est souple.', 'Ce masque C3PO™ en taille adulte est souple. Ce casque vous transformera en un clin d''œil en C3PO™ (Star Wars™). Une bonne idée de cadeau pour les fans de Star Wars™. C''est un masque sous licence officielle Star Wars™(Lucasfilm©).', '45.90', 55, 'opened', '2016-01-31 13:15:12', '2016-01-31 12:15:12', '2016-01-31 12:15:12'),
(9, 1, 'Sabre Basic Dark Side', 'sabre-basic-dark-side', 'Le sabre électronique KYLO REN est inédit dans l''univers de Star Wars !', 'Le sabre électronique KYLO REN est inédit dans l''univers de Star Wars ! Sa poignée est protégée par une garde en laser ! Cette version inclut une mini dague que les enfants pourront fixer à la poignée grâce au système Bladebuilder !', '18.89', 25, 'opened', '2016-01-31 13:15:25', '2016-01-31 12:15:25', '2016-01-31 12:15:25'),
(10, 1, 'Star Wars Dark Maul Mini Sabre Lumineux', 'star-wars-dark-maul-mini-sabre-lumineux', 'Tout apprenti Sith doit construire son propre sabre laser.', 'Mini sabre laser darth maul à créer. Ce double laser s''éclaire en rouge. lumières led. age : 6 ans +', '15.47', 20, 'opened', '2016-01-31 13:15:44', '2016-01-31 12:15:44', '2016-01-31 12:15:44'),
(12, 1, 'Clone wars - Sabre Standard - Bleu de Hasbro', 'clone-wars-sabre-standard-bleu-de-hasbro', 'Le sabre standard des Jedi et des Siths décliné dans un nouveau packaging.', 'Age minimum: 4 ans. Nécessite des piles: Non. Descriptif produit: Le sabre standard des Jedi et des Siths décliné dans un nouveau packaging. Garantie fournisseur: 2 ans', '58.99', 20, 'opened', '2016-01-31 13:04:33', '2016-01-31 12:04:33', '2016-01-31 12:04:33'),
(13, 1, 'Sabre laser Star Wars Episode I', 'sabre-laser-star-wars-episode-i', 'Sabre laser Star Wars Episode I Sabre laser ''Comte Dooku'' (rouge) env. 90cm .', 'Sabre laser Star Wars Episode I Sabre laser ''Comte Dooku'' (rouge) env. 90cm. La guerre des étoiles. Réplique fidèle de l''épée laser du Comte Dooku. La lame rouge téléscopique se cache dans la poignée et se déploie d''un geste rapide de la main. Fonction lumineuse sans son. Fonctionne avec 2 piles AA.', '33.90', 15, 'opened', '2016-01-31 13:05:57', '2016-01-31 12:05:57', '2016-01-31 12:05:57'),
(14, 1, 'Star Wars Lightsaber Electronique - Anakin', 'star-wars-lightsaber-electronique-anakin', 'Ce sabre laser est une réplique de l''arme d''Anakin Skywalker dans la prélogie Star Wars.', 'Ce sabre laser est une réplique de l''arme d''Anakin Skywalker dans la prélogie Star Wars. Ce sabre deviendra le premier sabre laser de Luke Skywalker dans la trilogie originale de Star Wars. D''un mouvement de la main déploie la lame en plastique bleu d''environ 45 cm et le sabre laser émet des effets sonores et lumineux lorsqu''il s''entrechoque.', '98.00', 50, 'opened', '2016-01-31 13:07:16', '2016-01-31 12:07:16', '2016-01-31 12:07:16'),
(15, 1, 'Réplique 1/1 sabre laser Force FX avec lame amovible Luke Skywalker', 'replique-11-sabre-laser-force-fx-avec-lame-amovible-luke-skywalker', 'Réplique sabre laser avec halo lumineux, fonctions allumage, extinction réalistes et lame amovible.', 'Réplique sabre laser avec halo lumineux, fonctions allumage, extinction réalistes et lame amovible. Les sons digitaux extraits du film sont déclenchés par 5 détecteurs de mouvement: allumage, bourdonnement, déplacement, impact, et extinction. La lame est équipée de 3 capteurs pour une super-sensibilité: 2 pour détecter les mouvements et 1 pour détecter les impacts.', '1999.00', 2, 'opened', '2016-01-31 13:08:55', '2016-01-31 12:08:55', '2016-01-31 12:08:55'),
(16, 1, 'Star Wars réplique 1/1 sabre laser Force FX Anakin Skywalker', 'star-wars-replique-11-sabre-laser-force-fx-anakin-skywalker', 'Sabre Laser Luke Skywalker. Reproduction authentique', 'Le sabre d''Anakin qui est également le premier sabre de Luke. La lame n''est pas amovible. ', '999.00', 1, 'opened', '2016-01-31 13:11:10', '2016-01-31 12:11:10', '2016-01-31 12:11:10');

-- --------------------------------------------------------

--
-- Structure de la table `product_tag`
--

CREATE TABLE `product_tag` (
  `tag_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `product_tag`
--

INSERT INTO `product_tag` (`tag_id`, `product_id`) VALUES
(1, 1),
(4, 1),
(1, 3),
(5, 3),
(1, 4),
(1, 5),
(1, 6),
(3, 6),
(1, 7),
(1, 8),
(3, 8),
(2, 9),
(3, 9),
(2, 10),
(2, 12),
(3, 12),
(2, 13),
(2, 14),
(3, 14),
(2, 15),
(3, 15),
(2, 16),
(3, 16);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'déguisement', '2016-01-31 11:24:31', '0000-00-00 00:00:00'),
(2, 'arme', '2016-01-31 11:24:31', '0000-00-00 00:00:00'),
(3, 'jedi', '2016-01-31 11:24:31', '0000-00-00 00:00:00'),
(4, 'stormtrooper', '2016-01-31 11:24:31', '0000-00-00 00:00:00'),
(5, 'vador', '2016-01-31 11:24:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('administrator','visitor') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'visitor',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Tony', 'tony@tony.fr', '$2y$10$o2kIyt21uYXMtB8CHcTMFerDR60OQBXdOzt2FgqSBVP790mO1BBMe', 'administrator', 'rk72D5oWQ6TMnXUrdXGkydw5yuGsKBgNaPqdpocjWj8DJUutHVq1FXiQZ5nV', '2016-01-31 14:00:49', '2016-01-31 14:00:49'),
(2, 'Antoine', 'antoine@antoine.fr', '$2y$10$3CkIuq5AM1TsclL8mvSs0OO7pPMCsX2hm6xJUrUAPkTLBT2MhkBay', 'visitor', NULL, '2016-01-31 11:24:31', '0000-00-00 00:00:00'),
(3, 'Romain', 'romain@romain.fr', '$2y$10$fFUAahRO/kPkp5WITMSe1OLcureB6xTu42VOf5Ql9JeUDyd0/nrtC', 'visitor', NULL, '2016-01-31 11:24:31', '0000-00-00 00:00:00'),
(4, 'yini', 'yini@yini.fr', '$2y$10$1kZsZeMTo.cgWVCmt24jbO/UA592s.Ddxt9PE6rPVd6d5dyDf/GXO', 'visitor', NULL, '2016-01-31 11:24:31', '0000-00-00 00:00:00');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `command_unfs`
--
ALTER TABLE `command_unfs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `command_unfs_product_id_foreign` (`product_id`),
  ADD KEY `command_unfs_user_id_foreign` (`user_id`),
  ADD KEY `command_unfs_cart_id_foreign` (`cart_id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Index pour la table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `histories_customer_id_foreign` (`customer_id`);

--
-- Index pour la table `history_details`
--
ALTER TABLE `history_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_details_history_id_foreign` (`history_id`),
  ADD KEY `history_details_product_id_foreign` (`product_id`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pictures_product_id_foreign` (`product_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Index pour la table `product_tag`
--
ALTER TABLE `product_tag`
  ADD UNIQUE KEY `product_tag_product_id_tag_id_unique` (`product_id`,`tag_id`),
  ADD KEY `product_tag_tag_id_foreign` (`tag_id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `command_unfs`
--
ALTER TABLE `command_unfs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `history_details`
--
ALTER TABLE `history_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `command_unfs`
--
ALTER TABLE `command_unfs`
  ADD CONSTRAINT `command_unfs_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `command_unfs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `command_unfs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `histories`
--
ALTER TABLE `histories`
  ADD CONSTRAINT `histories_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `history_details`
--
ALTER TABLE `history_details`
  ADD CONSTRAINT `history_details_history_id_foreign` FOREIGN KEY (`history_id`) REFERENCES `histories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `history_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
