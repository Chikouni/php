-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : latetedarwepsi.mysql.db
-- Généré le :  jeu. 08 fév. 2018 à 16:45
-- Version du serveur :  5.5.55-0+deb7u1-log
-- Version de PHP :  5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `latetedarwepsi`
--

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE `points` (
  `id` int(11) NOT NULL,
  `x` float NOT NULL,
  `y` float NOT NULL,
  `idPolygone` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `points`
--

INSERT INTO `points` (`id`, `x`, `y`, `idPolygone`) VALUES
(194, 4, 0, 64),
(193, 5, 7, 64),
(192, 10, 2, 64);

-- --------------------------------------------------------

--
-- Structure de la table `polygones`
--

DROP TABLE IF EXISTS `polygones`;
CREATE TABLE `polygones` (
  `id` int(11) NOT NULL,
  `couleur` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `polygones`
--

INSERT INTO `polygones` (`id`, `couleur`) VALUES
(64, '#000000');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `polygones`
--
ALTER TABLE `polygones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `points`
--
ALTER TABLE `points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;
--
-- AUTO_INCREMENT pour la table `polygones`
--
ALTER TABLE `polygones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
