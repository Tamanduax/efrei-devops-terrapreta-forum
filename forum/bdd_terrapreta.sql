-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 19 oct. 2020 à 15:54
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forumterrapreta`
--
CREATE DATABASE IF NOT EXISTS `forumterrapreta` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `forumterrapreta`;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_commentaire` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `texte_commentaire` varchar(2000) NOT NULL,
  `id_message` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `id_utilisateur`, `texte_commentaire`, `id_message`) VALUES
(1, 1, 'test utilisateur 1 message 1', 1),
(12, 1, 'salut ça va?\r\n', 1),
(15, 1, 'sqjuifdskluvgfhbnsdvbdvd', 1),
(16, 1, 'saut', 9),
(17, 1, 'bonjour a tous ffffffffffffff fffffffffffffff zzzzzzzzzzzzz fgffffffff', 4),
(18, 1, 'salut à tous', 1),
(19, 1, 'bonjour', 1),
(20, 1, 'salut', 11);

-- --------------------------------------------------------

--
-- Structure de la table `like_commentaire`
--

CREATE TABLE `like_commentaire` (
  `id_utilisateur` int(11) NOT NULL,
  `id_commentaire` int(11) NOT NULL,
  `compteur_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `like_commentaire`
--

INSERT INTO `like_commentaire` (`id_utilisateur`, `id_commentaire`, `compteur_like`) VALUES
(1, 1, 0),
(1, 12, -1),
(1, 17, 0),
(1, 15, 0),
(1, 18, -1);

-- --------------------------------------------------------

--
-- Structure de la table `like_message`
--

CREATE TABLE `like_message` (
  `id_message` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `compteur_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `like_message`
--

INSERT INTO `like_message` (`id_message`, `id_utilisateur`, `compteur_like`) VALUES
(9, 1, 0),
(1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `texte_message` varchar(2000) NOT NULL,
  `img_message` varchar(200) DEFAULT NULL,
  `titre_message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `id_utilisateur`, `texte_message`, `img_message`, `titre_message`) VALUES
(1, 1, 'Bonjour à tous je voulais vous dire que cette application de jardinage est vraiment super efficace et très simple d\'utilisation merci à toute l\'équipe de développement :)', NULL, 'Quelle belle application!!'),
(4, 1, 'test2', '../file/1test2.png', 'test2'),
(9, 1, 'test3', '', 'test3'),
(10, 1, 'bonjour', '', 'salut a tous'),
(11, 1, 'd', '', 'd');

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `id_statut` int(11) NOT NULL,
  `nom_statut` varchar(50) NOT NULL,
  `icon_statut` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom_utilisateur` varchar(50) DEFAULT NULL,
  `prenom_utilisateur` varchar(50) DEFAULT NULL,
  `pseudo_utilisateur` varchar(50) NOT NULL,
  `pwd_utilisateur` varchar(50) NOT NULL,
  `id_statut` int(11) DEFAULT NULL,
  `mail_utilisateur` varchar(200) NOT NULL,
  `nb_like_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `pseudo_utilisateur`, `pwd_utilisateur`, `id_statut`, `mail_utilisateur`, `nb_like_utilisateur`) VALUES
(1, NULL, NULL, 'admin', 'admin', NULL, 'test@mail.fr', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `messagecommentaire` (`id_message`),
  ADD KEY `utilisateurcommentaire` (`id_utilisateur`);

--
-- Index pour la table `like_commentaire`
--
ALTER TABLE `like_commentaire`
  ADD KEY `utilisateurlikecommentaire` (`id_utilisateur`),
  ADD KEY `commentairelike` (`id_commentaire`);

--
-- Index pour la table `like_message`
--
ALTER TABLE `like_message`
  ADD KEY `likeutilisateur` (`id_utilisateur`),
  ADD KEY `likemessage` (`id_message`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `messageutilisateur` (`id_utilisateur`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id_statut`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD KEY `statututilisateur` (`id_statut`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `id_statut` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `messagecommentaire` FOREIGN KEY (`id_message`) REFERENCES `message` (`id_message`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateurcommentaire` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `like_commentaire`
--
ALTER TABLE `like_commentaire`
  ADD CONSTRAINT `commentairelike` FOREIGN KEY (`id_commentaire`) REFERENCES `commentaire` (`id_commentaire`),
  ADD CONSTRAINT `utilisateurlikecommentaire` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `like_message`
--
ALTER TABLE `like_message`
  ADD CONSTRAINT `likemessage` FOREIGN KEY (`id_message`) REFERENCES `message` (`id_message`),
  ADD CONSTRAINT `likeutilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `messageutilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `statututilisateur` FOREIGN KEY (`id_statut`) REFERENCES `statut` (`id_statut`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
