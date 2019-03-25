-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 25 mars 2019 à 19:53
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
  `comment_date` datetime NOT NULL,
  `com_reported` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user`, `episode_id`, `comment`, `comment_date`, `com_reported`) VALUES
(4, 'Warrypro', 17, 'Voici un commentaire...', '2019-02-17 20:46:00', 0),
(13, 'Warrypro', 19, 'hello', '2019-03-09 00:37:48', 0),
(14, 'Warrypro', 21, 'Voici un commentaire! :)', '2019-03-23 19:08:02', 0),
(16, 'Warrypro', 21, 'test', '2019-03-24 23:31:28', 0);

-- --------------------------------------------------------

--
-- Structure de la table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_date` datetime NOT NULL,
  `modif_date` datetime NOT NULL,
  `image_episode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `episodes`
--

INSERT INTO `episodes` (`id`, `title`, `content`, `created_date`, `modif_date`, `image_episode`) VALUES
(11, 'épisode 1', '<p>Dum haec in oriente aguntur, Arelate hiemem agens Constantius post theatralis ludos atque circenses ambitioso editos apparatu diem sextum idus Octobres, qui imperii eius annum tricensimum terminabat, insolentiae pondera gravius librans, siquid dubium deferebatur aut falsum, pro liquido accipiens et conperto, inter alia excarnificatum Gerontium Magnentianae comitem partis exulari maerore multavit.</p>', '2019-01-05 20:41:32', '2019-03-05 00:32:02', 'public/images/pexels-photo-417074.jpeg'),
(12, 'épisode 2', '<p>Dum haec in oriente aguntur, Arelate hiemem agens Constantius post theatralis ludos atque circenses ambitioso editos apparatu diem sextum idus Octobres, qui imperii eius annum tricensimum terminabat, insolentiae pondera gravius librans, siquid dubium deferebatur aut falsum, pro liquido accipiens et conperto, inter alia excarnificatum Gerontium Magnentianae comitem partis exulari maerore multavit.</p>', '2019-01-05 20:45:12', '2019-03-05 00:32:43', 'public/images/pexels-photo-219772.jpeg'),
(13, 'épisode 3', '<p>Dum haec in oriente aguntur, Arelate hiemem agens Constantius post theatralis ludos atque circenses ambitioso editos apparatu diem sextum idus Octobres, qui imperii eius annum tricensimum terminabat, insolentiae pondera gravius librans, siquid dubium deferebatur aut falsum, pro liquido accipiens et conperto, inter alia excarnificatum Gerontium Magnentianae comitem partis exulari maerore multavit.</p>', '2019-01-05 20:46:58', '2019-03-05 00:33:24', 'public/images/wood-landscape-mountains-nature.jpg'),
(14, 'épisode 5', '<p>Dum haec in oriente aguntur, Arelate hiemem agens Constantius post theatralis ludos atque circenses ambitioso editos apparatu diem sextum idus Octobres, qui imperii eius annum tricensimum terminabat, insolentiae pondera gravius librans, siquid dubium deferebatur aut falsum, pro liquido accipiens et conperto, inter alia excarnificatum Gerontium Magnentianae comitem partis exulari maerore multavit.</p>', '2019-01-05 20:48:10', '2019-01-05 20:48:10', 'public/images/pexels-photo-289407.jpeg'),
(15, 'épisode 6', '<p>Dum haec in oriente aguntur, Arelate hiemem agens Constantius post theatralis ludos atque circenses ambitioso editos apparatu diem sextum idus Octobres, qui imperii eius annum tricensimum terminabat, insolentiae pondera gravius librans, siquid dubium deferebatur aut falsum, pro liquido accipiens et conperto, inter alia excarnificatum Gerontium Magnentianae comitem partis exulari maerore multavit.</p>', '2019-01-05 20:48:55', '2019-01-05 20:48:55', 'public/images/pexels-photo-427676.jpeg'),
(16, 'épisode 7', '<p>Dum haec in oriente aguntur, Arelate hiemem agens Constantius post theatralis ludos atque circenses ambitioso editos apparatu diem sextum idus Octobres, qui imperii eius annum tricensimum terminabat, insolentiae pondera gravius librans, siquid dubium deferebatur aut falsum, pro liquido accipiens et conperto, inter alia excarnificatum Gerontium Magnentianae comitem partis exulari maerore multavit.</p>', '2019-01-05 20:52:19', '2019-01-05 20:52:19', 'public/images/pexels-photo-301469.jpeg'),
(17, 'épisode 8', '<p>Dum haec in oriente aguntur, Arelate hiemem agens Constantius post theatralis ludos atque circenses ambitioso editos apparatu diem sextum idus Octobres, qui imperii eius annum tricensimum terminabat, insolentiae pondera gravius librans, siquid dubium deferebatur aut falsum, pro liquido accipiens et conperto, inter alia excarnificatum Gerontium Magnentianae comitem partis exulari maerore multavit.</p>', '2019-01-05 20:53:22', '2019-01-10 01:10:40', 'public/images/pexels-photo-291732.jpeg'),
(18, 'épisode 9', '<p>Ut enim quisque sibi plurimum confidit et ut quisque maxime virtute et sapientia sic munitus est, ut nullo egeat suaque omnia in se ipso posita iudicet, ita in amicitiis expetendis colendisque maxime excellit. Quid enim? Africanus indigens mei? Minime hercule! ac ne ego quidem illius; sed ego admiratione quadam virtutis eius, ille vicissim opinione fortasse non nulla, quam de meis moribus habebat, me dilexit; auxit benevolentiam consuetudo. Sed quamquam utilitates multae et magnae consecutae sunt, non sunt tamen ab earum spe causae diligendi profectae.</p>', '2019-01-05 20:53:59', '2019-02-06 22:34:46', 'public/images/pexels-photo-356808.jpeg'),
(19, 'épisode 10', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut consequat urna. Pellentesque vitae faucibus ex. Integer porttitor ex non enim finibus ornare. Aliquam vehicula massa non nisl ornare rutrum. Sed consectetur convallis ullamcorper. Quisque eleifend libero ipsum, vel vestibulum sem luctus in. Quisque aliquet ipsum libero, ut laoreet risus interdum id. Vestibulum dictum arcu velit, et mattis lectus vestibulum eu.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Sed varius purus sit amet erat dignissim elementum. Etiam nec fermentum enim. Duis sodales lectus eu nisl viverra euismod. Pellentesque maximus non velit at egestas. Curabitur et purus bibendum, mollis odio vel, luctus nulla. Suspendisse tincidunt diam eu felis iaculis aliquam. Nam orci erat, laoreet eu laoreet quis, dapibus ac neque. Mauris sed condimentum diam, in tempor urna. Sed sed libero a eros pretium blandit. Sed semper ullamcorper nunc, vel dictum leo scelerisque quis. Donec ut diam convallis felis blandit suscipit. Etiam sodales metus rutrum vehicula accumsan. Aenean lectus nisi, vehicula a orci pulvinar, convallis iaculis arcu. Quisque non hendrerit neque.</p>', '2019-02-06 22:58:19', '2019-02-06 22:58:19', 'public/images/pexels-photo-688660.jpeg'),
(20, 'épisode 11', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod mauris sit amet elementum sollicitudin. Curabitur efficitur, ante nec ultricies tincidunt, risus tortor vehicula purus, vitae tincidunt lorem ex sed nunc. Integer tempus vitae nisi sit amet luctus. Fusce vitae est porttitor, fringilla ipsum nec, lobortis augue. Nam ullamcorper tellus ac viverra laoreet. Nullam mattis, sem ut mollis consequat, est nulla egestas nunc, vel lobortis lectus dui a sapien. Vestibulum facilisis urna nisi, quis facilisis nisl consequat vel. Suspendisse potenti. Cras venenatis, est quis porttitor vestibulum, lectus justo commodo eros, in consectetur tortor purus in ante. Vestibulum et lobortis dui. Nullam ultricies faucibus diam non molestie. Ut at volutpat tellus, sed posuere magna. Integer scelerisque, urna non luctus bibendum, mauris tellus tempor nunc, mattis facilisis est urna quis mauris. Sed facilisis libero nec lobortis blandit.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Cras nec consectetur ex. Quisque fermentum turpis a eros ultrices ornare. Suspendisse ex odio, feugiat vel condimentum vel, finibus a turpis. Proin iaculis nulla risus, nec vestibulum arcu hendrerit in. Aliquam erat volutpat. Ut feugiat et sem non vulputate. Ut ex erat, aliquet vel arcu at, gravida blandit eros. Aenean tristique nisi non turpis aliquet, eu viverra dui luctus. Nam ut ullamcorper velit, sed ultrices diam. Cras lectus enim, posuere cursus mattis eu, volutpat quis libero. Morbi efficitur massa gravida quam finibus, a tristique neque sagittis.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;\">Nulla a rutrum ipsum, eu fermentum lacus. Curabitur sit amet tristique odio, ut feugiat mauris. In tempus turpis ac velit egestas, eget ornare arcu molestie. Donec vulputate egestas tellus eu dignissim. Donec tristique sed massa nec vehicula. Phasellus sit amet mauris lectus. Integer suscipit metus eu convallis pellentesque.</p>', '2019-03-02 15:52:42', '2019-03-02 15:52:42', 'public/images/pexels-photo-1266810.jpeg'),
(21, 'épisode 12', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nulla velit, laoreet non nibh a, consectetur consectetur purus. Nulla luctus magna in tempus lobortis. In massa ligula, porttitor et euismod malesuada, vehicula vehicula nunc. Pellentesque auctor consectetur ex non interdum. Proin velit turpis, elementum sed quam a, ullamcorper vulputate odio. Mauris lectus nulla, fringilla eget viverra id, dapibus quis mauris. Quisque varius tortor ac tincidunt accumsan. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin sagittis eros congue ante aliquam, vel congue metus elementum. Nam cursus imperdiet laoreet. Duis eu erat eros. Curabitur a magna tristique neque interdum egestas. Quisque condimentum bibendum venenatis. Aenean sit amet pulvinar purus. Suspendisse vitae mauris in elit congue eleifend non ac sem. Sed convallis id massa ut suscipit.</span></p>', '2019-03-05 00:14:52', '2019-03-06 23:13:13', 'public/images/denali-national-park.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reported_comms`
--

CREATE TABLE `reported_comms` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `reported_comment` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_accuser` varchar(15) NOT NULL,
  `episode_id` int(11) DEFAULT NULL,
  `reported_date` datetime NOT NULL,
  `num_reports` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reported_comms`
--

INSERT INTO `reported_comms` (`id`, `comment_id`, `reported_comment`, `user_id`, `user_accuser`, `episode_id`, `reported_date`, `num_reports`) VALUES
(2, 14, 'Voici un commentaire! :)', 9, 'Warrypro', 21, '2019-03-24 21:38:01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(15) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(80) NOT NULL,
  `user_role` enum('User','Admin') NOT NULL DEFAULT 'User',
  `user_image` varchar(80) NOT NULL DEFAULT 'public/images/user.svg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`, `user_role`, `user_image`) VALUES
(9, 'Warrypro', '$2y$10$mjiEZIQoXyCfwLzmFegVd.tUl6bZv6.aBTb8jULtpSgowrROiaWQ.', 'Warrypro@warrypro.com', 'Admin', 'public/images/dany.JPG'),
(10, 'Daking', '$2y$10$mM3RhPu7Qj0Z46.b7i.HROiAAUuQWwYkxuomz.5B/D/T06U5ZDtLi', 'daking@mail.com', 'User', 'public/images/user.svg'),
(12, 'Dany', '$2y$10$6qlGckYSyGepE2tjxwoYSORO3lqMDxBtoCkd2jMNxnf6WvduLfSTi', 'dannyfr.03@gmail.com', 'Admin', 'public/images/mel.jpg'),
(32, 'Mel', '$2y$10$KhWALN8oJRiy2fsaKuB8yesZCFK0XJIpWAsPz5eCM/WrJDYlswMPK', 'mell.aniie@hotmail.com', 'Admin', 'public/images/Mel.jpg'),
(33, 'Max', '$2y$10$d8TvPvnsExgecQwuvp5qaOFwK3Eyh0DLx/Ha7MMlHg2GeCuGHivc6', 'maxime@max.com', 'User', 'public/images/user.svg'),
(34, 'Guille', '$2y$10$dZwSOKjBLnKzO9bKh5y4u.ACHWDYk6Z9VwEBd4X71btyb82gMymzC', 'guille-2011@hotmail.com', 'User', 'public/images/user.svg'),
(41, 'test', '$2y$10$outh1uyJU.U7suZjiux/T.neYulXaYBuyImNDGM6Wo1cfzyYFf53W', 'test@test.com', 'User', 'public/images/user.svg');

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
-- Index pour la table `reported_comms`
--
ALTER TABLE `reported_comms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `reported_comms`
--
ALTER TABLE `reported_comms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
