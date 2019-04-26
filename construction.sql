-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 26 avr. 2019 à 14:46
-- Version du serveur :  10.1.34-MariaDB
-- Version de PHP :  7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `construction`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(2000) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `date_creation`) VALUES
(4, 'stephane', 'ab4dd1acdd321cbe565fc1ae53b1b56a833f252431efd0be1172a1e5b1a6db87', '2019-04-20 19:35:59'),
(5, 'anonymex1', 'b5cb14d73a124a30af9ec574f24f85e3f9382579b738adc8546d4a7fe732804b', '2019-04-20 19:36:10');

-- --------------------------------------------------------

--
-- Structure de la table `map`
--

CREATE TABLE `map` (
  `id` int(11) NOT NULL,
  `lat` float NOT NULL,
  `lng` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `userId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `map`
--

INSERT INTO `map` (`id`, `lat`, `lng`, `status`, `userId`) VALUES
(17, 5.34869, -3.9777803421020503, 1, 42);

-- --------------------------------------------------------

--
-- Structure de la table `materiaux`
--

CREATE TABLE `materiaux` (
  `id` int(11) UNSIGNED NOT NULL,
  `sable` float UNSIGNED NOT NULL,
  `ciment` float UNSIGNED NOT NULL,
  `gravier` float UNSIGNED NOT NULL,
  `bois` float UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `materiaux`
--

INSERT INTO `materiaux` (`id`, `sable`, `ciment`, `gravier`, `bois`, `userId`) VALUES
(6, 0.125014, 3.00028, 0.833334, 0.007147, 42);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date_inscrit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(200) NOT NULL DEFAULT 'default_user.jpg',
  `username` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `date_inscrit`, `image`, `username`) VALUES
(31, 'stephanesalou123@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2019-04-18 17:48:03', 'IMG_20180511_124350.jpg', 'anonymex1'),
(35, 'anonymex1@outlook.fr', '0bcb286b78d55035f2e57ccae9b4c1e1', '2019-04-18 17:56:50', 'la-casa-de-papel-netflix-768x432.jpg', 'anonymemdp'),
(42, 'test@test.test', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2019-04-23 16:03:19', 'IMG_20180729_230928.jpg', 'anonymex');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_lat` (`lat`),
  ADD UNIQUE KEY `unique_lnt` (`lng`),
  ADD KEY `userId` (`userId`);

--
-- Index pour la table `materiaux`
--
ALTER TABLE `materiaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `map`
--
ALTER TABLE `map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `materiaux`
--
ALTER TABLE `materiaux`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `map`
--
ALTER TABLE `map`
  ADD CONSTRAINT `map_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `materiaux`
--
ALTER TABLE `materiaux`
  ADD CONSTRAINT `materiaux_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
