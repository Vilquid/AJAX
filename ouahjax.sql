-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mar. 01 déc. 2020 à 10:13
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ouahjax`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sujet` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `id_sujet`, `id_user`, `date`, `message`, `id_parent`) VALUES
(11, 2, 3, '2020-12-01 11:00:32', 'Android est un système d\'exploitation public développé par Google. Comme il s\'agit d\'un système d\'exploitation libre, Samsung en a profité pour ajouter sa  touche personnelle sur le logiciel.', NULL),
(12, 2, 2, '2020-12-01 11:00:32', 'L\'iOS d\'Apple est polyvalent. Il existe plus d\'un million d\'applications disponibles pour votre iPhone. La sécurité prime avant tout.', NULL),
(13, 1, 1, '2020-12-01 11:00:32', 'Arch Linux est une distribution libre qui se veut rapide et légère, elle s’articule autour de la philosophie « KISS » ou « Keep It Simple, Stupid ». Il faut comprendre dans le sens « Garde ça simple ».', NULL),
(14, 1, 3, '2020-12-01 11:00:32', 'Arch Linux est une distribution libre qui se veut rapide et légère, elle s’articule autour de la philosophie « KISS » ou « Keep It Simple, Stupid ». Il faut comprendre dans le sens « Garde ça simple ».', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sujets`
--

DROP TABLE IF EXISTS `sujets`;
CREATE TABLE IF NOT EXISTS `sujets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_post` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sujets`
--

INSERT INTO `sujets` (`id`, `titre`, `user_id`, `date_post`) VALUES
(1, 'Arch, Mint ou Ubuntu', 1, '2020-12-01 10:53:14'),
(2, 'Apple ou Samsung ?', 3, '2020-12-01 10:53:14');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `pseudo` text COLLATE utf8_unicode_ci NOT NULL,
  `mail` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `password`, `pseudo`, `mail`) VALUES
(1, 'sylvain', 'Sylvain', 'sylvain@gmail.com'),
(2, 'mehdi', 'Mehdi', 'mehdi@gmail.com'),
(3, 'mathis', 'Mathis', 'mathis@gmail.com'),
(7, 'amaury', 'Amaury', 'amaury@gmail.com'),
(8, 'didier', 'Didier_pas_le_musée', 'didier@gmail.com'),
(9, 'virginie', 'Virginie', 'virginie@gmail.com'),
(10, 'picachu', 'PicachuGamer83', 'picachu@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
