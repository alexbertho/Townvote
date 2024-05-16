-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 15 mai 2024 à 17:57
-- Version du serveur : 10.3.39-MariaDB-0+deb10u1
-- Version de PHP : 8.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db`
--

-- --------------------------------------------------------

--
-- Structure de la table `ag`
--

CREATE TABLE `ag` (
  `id` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `ag`
--

INSERT INTO `ag` (`id`, `adresse`) VALUES
(1, '7 rue du grand mur'),
(2, 'adresse'),
(3, 'adresse2');

-- --------------------------------------------------------

--
-- Structure de la table `choix`
--

CREATE TABLE `choix` (
  `id` int(11) NOT NULL,
  `vote_id` int(11) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `choix`
--

INSERT INTO `choix` (`id`, `vote_id`, `desc`) VALUES
(1, 1, 'blabla'),
(2, 1, 'blabla2'),
(3, 1, 'blabla3'),
(4, 2, 'blabla4');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ag_id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `user_id`, `ag_id`, `message`) VALUES
(1, 3, 1, 'test'),
(2, 3, 1, 'test2'),
(3, 3, 1, 'test3'),
(4, 3, 1, 'test4'),
(5, 1, 1, 'test5'),
(6, 2, 1, 'test6');

-- --------------------------------------------------------

--
-- Structure de la table `message_vu`
--

CREATE TABLE `message_vu` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `username`) VALUES
(1, 'test', 'test', NULL),
(2, 'root', 'toor', 'admin'),
(3, 'hugo', '123', 'hugros'),
(4, 'hugo1', 'x}:_^T\'c:Zv75XF', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_ag`
--

CREATE TABLE `user_ag` (
  `user_id` int(11) NOT NULL,
  `ag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user_ag`
--

INSERT INTO `user_ag` (`user_id`, `ag_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `user_vote`
--

CREATE TABLE `user_vote` (
  `user_id` int(11) NOT NULL,
  `vote_id` int(11) NOT NULL,
  `choix_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user_vote`
--

INSERT INTO `user_vote` (`user_id`, `vote_id`, `choix_id`) VALUES
(1, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ag_id` int(11) NOT NULL,
  `desc` text NOT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id`, `name`, `ag_id`, `desc`, `date_fin`) VALUES
(1, 'random', 1, 'cpt', NULL),
(2, 'random2', 1, 'cpt', NULL),
(3, 'random3', 2, 'cptaa', NULL),
(4, 'random33', 3, 'cptaa', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ag`
--
ALTER TABLE `ag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `choix`
--
ALTER TABLE `choix`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message_vu`
--
ALTER TABLE `message_vu`
  ADD PRIMARY KEY (`message_id`,`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_ag`
--
ALTER TABLE `user_ag`
  ADD PRIMARY KEY (`user_id`,`ag_id`);

--
-- Index pour la table `user_vote`
--
ALTER TABLE `user_vote`
  ADD PRIMARY KEY (`user_id`,`vote_id`,`choix_id`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ag`
--
ALTER TABLE `ag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `choix`
--
ALTER TABLE `choix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
