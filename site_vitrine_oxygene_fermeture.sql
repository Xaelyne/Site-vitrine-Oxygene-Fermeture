-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 05 juin 2024 à 13:44
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `site_vitrine_oxygene_fermeture`
--

-- --------------------------------------------------------

--
-- Structure de la table `ajouter`
--

DROP TABLE IF EXISTS `ajouter`;
CREATE TABLE IF NOT EXISTS `ajouter` (
  `identifiantUtilisateur` int NOT NULL,
  `identifiantService` int NOT NULL,
  PRIMARY KEY (`identifiantUtilisateur`,`identifiantService`),
  KEY `identifiantService` (`identifiantService`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `identifiantAvis` int NOT NULL AUTO_INCREMENT,
  `prenomClientAvis` varchar(50) NOT NULL,
  `etoileAvis` int NOT NULL,
  `commentaireAvis` text NOT NULL,
  PRIMARY KEY (`identifiantAvis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avoir`
--

DROP TABLE IF EXISTS `avoir`;
CREATE TABLE IF NOT EXISTS `avoir` (
  `identifiantService` int NOT NULL,
  `identifiantAvis` int NOT NULL,
  PRIMARY KEY (`identifiantService`,`identifiantAvis`),
  KEY `identifiantAvis` (`identifiantAvis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detailservice`
--

DROP TABLE IF EXISTS `detailservice`;
CREATE TABLE IF NOT EXISTS `detailservice` (
  `identifiantDetail` int NOT NULL AUTO_INCREMENT,
  `descriptionDetail` text NOT NULL,
  `identifiantService` int NOT NULL,
  PRIMARY KEY (`identifiantDetail`),
  KEY `identifiantService` (`identifiantService`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gerer`
--

DROP TABLE IF EXISTS `gerer`;
CREATE TABLE IF NOT EXISTS `gerer` (
  `identifiantUtilisateur` int NOT NULL,
  `identifiantPartenaire` int NOT NULL,
  PRIMARY KEY (`identifiantUtilisateur`,`identifiantPartenaire`),
  KEY `identifiantPartenaire` (`identifiantPartenaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `information_entreprise`
--

DROP TABLE IF EXISTS `information_entreprise`;
CREATE TABLE IF NOT EXISTS `information_entreprise` (
  `identifiantEntreprise` int NOT NULL AUTO_INCREMENT,
  `telephoneEntreprise` varchar(15) NOT NULL,
  `adresseEntreprise` varchar(100) NOT NULL,
  `codePostalEntreprise` varchar(10) NOT NULL,
  `villeEntreprise` varchar(50) NOT NULL,
  PRIMARY KEY (`identifiantEntreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--

DROP TABLE IF EXISTS `partenaires`;
CREATE TABLE IF NOT EXISTS `partenaires` (
  `identifiantPartenaire` int NOT NULL AUTO_INCREMENT,
  `imagePartenaire` varchar(100) NOT NULL,
  `nomPartenaire` varchar(100) NOT NULL,
  `lienPartenaire` varchar(200) NOT NULL,
  PRIMARY KEY (`identifiantPartenaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `realisations`
--

DROP TABLE IF EXISTS `realisations`;
CREATE TABLE IF NOT EXISTS `realisations` (
  `identifiantRealisation` int NOT NULL AUTO_INCREMENT,
  `imageRealisation` varchar(100) NOT NULL,
  `nomRealisation` varchar(100) NOT NULL,
  `identifiantService` int NOT NULL,
  PRIMARY KEY (`identifiantRealisation`),
  KEY `identifiantService` (`identifiantService`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `renseigner`
--

DROP TABLE IF EXISTS `renseigner`;
CREATE TABLE IF NOT EXISTS `renseigner` (
  `identifiantUtilisateur` int NOT NULL,
  `identifiantEntreprise` int NOT NULL,
  PRIMARY KEY (`identifiantUtilisateur`,`identifiantEntreprise`),
  KEY `identifiantEntreprise` (`identifiantEntreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `identifiantService` int NOT NULL AUTO_INCREMENT,
  `nomService` varchar(100) NOT NULL,
  `imageService` varchar(100) NOT NULL,
  PRIMARY KEY (`identifiantService`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `identifiantUtilisateur` int NOT NULL AUTO_INCREMENT,
  `emailUtilisateur` varchar(50) NOT NULL,
  `nomUtilisateur` varchar(50) NOT NULL,
  `prenomUtilisateur` varchar(50) NOT NULL,
  `MDPUtilisateur` varchar(60) NOT NULL,
  PRIMARY KEY (`identifiantUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`identifiantUtilisateur`, `emailUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `MDPUtilisateur`) VALUES
(1, 'cclauet@exemple.com', 'Clauet', 'Cedric', '123456');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ajouter`
--
ALTER TABLE `ajouter`
  ADD CONSTRAINT `ajouter_ibfk_1` FOREIGN KEY (`identifiantUtilisateur`) REFERENCES `utilisateurs` (`identifiantUtilisateur`),
  ADD CONSTRAINT `ajouter_ibfk_2` FOREIGN KEY (`identifiantService`) REFERENCES `services` (`identifiantService`);

--
-- Contraintes pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD CONSTRAINT `avoir_ibfk_1` FOREIGN KEY (`identifiantService`) REFERENCES `services` (`identifiantService`),
  ADD CONSTRAINT `avoir_ibfk_2` FOREIGN KEY (`identifiantAvis`) REFERENCES `avis` (`identifiantAvis`);

--
-- Contraintes pour la table `detailservice`
--
ALTER TABLE `detailservice`
  ADD CONSTRAINT `detailservice_ibfk_1` FOREIGN KEY (`identifiantService`) REFERENCES `services` (`identifiantService`);

--
-- Contraintes pour la table `gerer`
--
ALTER TABLE `gerer`
  ADD CONSTRAINT `gerer_ibfk_1` FOREIGN KEY (`identifiantUtilisateur`) REFERENCES `utilisateurs` (`identifiantUtilisateur`),
  ADD CONSTRAINT `gerer_ibfk_2` FOREIGN KEY (`identifiantPartenaire`) REFERENCES `partenaires` (`identifiantPartenaire`);

--
-- Contraintes pour la table `realisations`
--
ALTER TABLE `realisations`
  ADD CONSTRAINT `realisations_ibfk_1` FOREIGN KEY (`identifiantService`) REFERENCES `services` (`identifiantService`);

--
-- Contraintes pour la table `renseigner`
--
ALTER TABLE `renseigner`
  ADD CONSTRAINT `renseigner_ibfk_1` FOREIGN KEY (`identifiantUtilisateur`) REFERENCES `utilisateurs` (`identifiantUtilisateur`),
  ADD CONSTRAINT `renseigner_ibfk_2` FOREIGN KEY (`identifiantEntreprise`) REFERENCES `information_entreprise` (`identifiantEntreprise`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
