-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 29 juil. 2018 à 13:16
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user` varchar(15) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user`, `episode_id`, `comment`, `comment_date`) VALUES
(1, 'Dany', 1, 'Voici un 1er texte d\'essai pour l\'utilisateur Dany!!\r\nVoici un 1er texte d\'essai pour l\'utilisateur Dany!!\r\nVoici un 1er texte d\'essai pour l\'utilisateur Dany!!\r\n', '2018-07-27 00:00:00'),
(2, 'WarryPro', 2, 'Voici un 1er texte d\'essai pour l\'utilisateur WarryPro!!\r\nVoici un 1er texte d\'essai pour l\'utilisateur WarryPro!!', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `created_date` datetime NOT NULL,
  `modif_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `episodes`
--

INSERT INTO `episodes` (`id`, `title`, `content`, `created_date`, `modif_date`) VALUES
(1, '1er billet', 'Voici un 1er billet d\'essai pour l\'utilisateur Dany!!Voici un 1er billet d\'essai pour l\'utilisateur Dany!!Voici un 1er billet d\'essai pour l\'utilisateur Dany!!Voici un 1er billet d\'essai pour l\'utilisateur Dany!!Voici un 1er billet d\'essai pour l\'utilisateur Dany!!Voici un 1er billet d\'essai pour l\'utilisateur Dany!!Voici un 1er billet d\'essai pour l\'utilisateur Dany!!', '2018-07-27 00:00:00', '0000-00-00 00:00:00'),
(2, '2ème billet', 'Voici un 2ème billet d\'essai pour l\'utilisateur !!\r\n\r\nVoici un 2ème billet d\'essai pour l\'utilisateur !\r\n\r\nVoici un 2ème billet d\'essai pour l\'utilisateur Dany!!Voici un 2ème billet d\'essai pour l\'utilisateur!!', '2018-07-28 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(15) NOT NULL,
  `pass` char(32) NOT NULL,
  `email` varchar(80) NOT NULL,
  `user_role` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`, `user_role`) VALUES
(0, 'Dany', '1234', 'dannyfr.03@gmail.com', 'Admin'),
(0, 'WarryPro', '1234', 'test@test.com', 'User');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
