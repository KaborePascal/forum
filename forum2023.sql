-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 30 juin 2023 à 15:32
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum2023`
--

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `texte_message` text NOT NULL,
  `date_message` date NOT NULL,
  `heure_message` time NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `texte_message`, `date_message`, `heure_message`, `id_user`) VALUES
(27, 'bonjour', '2023-06-30', '10:51:00', 0),
(28, 'b', '2023-06-30', '10:59:00', 0),
(29, '', '2023-06-30', '10:59:00', 0),
(30, 'bon', '2023-06-30', '11:00:00', 0),
(31, 'b', '2023-06-30', '11:01:00', 0),
(32, 'bonjour', '2023-06-30', '11:02:00', 0),
(33, 'BONJOUR', '2023-06-30', '11:03:00', 0),
(34, 'B', '2023-06-30', '11:04:00', 0),
(35, 'BN', '2023-06-30', '11:04:00', 0),
(36, 'BONJ', '2023-06-30', '11:06:00', 0),
(37, 'B', '2023-06-30', '11:06:00', 0),
(38, 'BB', '2023-06-30', '11:07:00', 0),
(39, 'VNVJV', '2023-06-30', '11:09:00', 0),
(40, '', '2023-06-30', '11:09:00', 0),
(41, 'nokj', '2023-06-30', '11:16:00', 0),
(42, 'bonjour\r\n\r\n', '2023-06-30', '11:16:00', 0),
(43, '', '0000-00-00', '00:20:23', 11),
(44, '', '0000-00-00', '00:20:23', 11),
(45, 'bnnj', '2023-06-30', '11:44:00', 0),
(46, 'bonjour', '2023-06-30', '14:06:00', 0),
(47, 'bonjour', '2023-06-30', '14:07:00', 0),
(48, 'bonjour', '2023-06-30', '14:08:00', 0),
(49, 'bonjour', '2023-06-30', '14:09:00', 0),
(50, 'hello', '2023-06-30', '14:10:00', 0),
(51, '', '0000-00-00', '00:20:23', 14),
(52, '', '0000-00-00', '00:20:23', 14);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(50) NOT NULL,
  `prenom_user` varchar(50) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `pw_user` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom_user`, `prenom_user`, `email_user`, `pw_user`) VALUES
(18, 'BANAO', 'NADIA', 'nadia2@gmail.com', '123456'),
(19, 'KABORE', 'PASCAL', 'kaborep08@gmail.com', '123456'),
(20, 'POUYA', 'PULCHERIE', 'pouyapulcherie44@gmail.com', '123456'),
(21, 'toto', 'po', 'kaborep8@gmail.com', '12345678');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
