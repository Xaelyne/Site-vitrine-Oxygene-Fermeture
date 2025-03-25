-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 25 mars 2025 à 10:45
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`identifiantAvis`, `prenomClientAvis`, `etoileAvis`, `commentaireAvis`) VALUES
(3, 'Laura', 5, 'Très bon travail '),
(6, 'Estelle', 4, 'Très satisfaite'),
(7, 'Manon', 5, 'Ouvrier très compétent, chantier vite terminé, je recommande !'),
(8, 'Stephane', 4, 'Travail excellent !'),
(9, 'Gilbert', 1, 'Très déçu, le chantier a duré une éternité !'),
(10, 'Kevin', 3, 'Plutôt satisfait du travail effectué'),
(11, 'Joël', 5, 'Très très satisfait ! excellent travail !'),
(13, 'Anaïs', 4, 'Super travail');

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `detailservice`
--

INSERT INTO `detailservice` (`identifiantDetail`, `descriptionDetail`, `identifiantService`) VALUES
(17, 'Porte pvc', 2),
(18, 'Porte hybride', 2),
(19, 'Porte alu', 2),
(20, 'Fer forger', 3),
(21, 'Aluminium', 3),
(22, 'Bois', 3),
(23, 'PVC', 3),
(31, 'TEXTURAL : unique sur le marché, la menuiserie TEXTURAL® allie personnalisation et raffinement. Découvrez la fenêtre qui habillera votre intérieur.', 1),
(32, 'LUMINE : élégante et esthétique, la gamme LUMINE se personnalise selon vos envies. Robustes, performantes et durables, nos fenêtres aluminium apporteront à votre habitat une vraie touche contemporaine.', 1),
(33, 'HYBRIDE (PVC+Aluminium) : la gamme HYBRIDE allie les avantages de l’aluminium & du PVC et offre les meilleures performances thermiques & acoustiques du marché.', 1),
(34, 'PVC (PERFORM) : bien plus qu’une fenêtre PVC, la gamme PERFORM en PVC vous garantit les plus hauts niveaux de performance du marché de la menuiserie française.', 1),
(42, 'PVC', 7),
(43, 'Bois', 7);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `information_entreprise`
--

INSERT INTO `information_entreprise` (`identifiantEntreprise`, `telephoneEntreprise`, `adresseEntreprise`, `codePostalEntreprise`, `villeEntreprise`) VALUES
(1, '01.23.45.67.89', '14 Ter Rue Martincourt', '60112', 'CRILLON');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `partenaires`
--

INSERT INTO `partenaires` (`identifiantPartenaire`, `imagePartenaire`, `nomPartenaire`, `lienPartenaire`) VALUES
(1, 'images/Somfy.png', 'somfy', 'https://www.somfy.fr/'),
(2, 'images/Aludoor.png', 'Aludoor', 'https://www.aludoor.fr/'),
(3, 'images/Maugin.png', 'Maugin', 'https://www.maugin.fr/'),
(4, 'images/Proferm.png', 'Proferm', 'https://proferm.net/'),
(5, 'images/RGE-eco-artisan.png', 'RGE Eco Artisant', 'https://www.eco-artisan.net/'),
(6, 'images/Soprofen.jpg', 'Soprofen', 'https://www.soprofen.fr/');

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `realisations`
--

INSERT INTO `realisations` (`identifiantRealisation`, `imageRealisation`, `nomRealisation`, `identifiantService`) VALUES
(9, 'images/296214090_452852066848046_6239352636913567797_n.jpg', 'Cloture', 3),
(11, 'images/317557070_557631993036719_6589573456572195067_n.jpg', 'Cloture', 3),
(16, 'images/440080259_932586735541241_6059296397958548524_n.jpg', 'Porte', 2),
(17, 'images/449339161_973196274813620_2404005828389044155_n.jpg', 'Cloture', 3),
(18, 'images/449516010_973197081480206_3714192297242670395_n.jpg', 'Porte', 2),
(19, 'images/449527094_975725814560666_3372150563658707429_n.jpg', 'Fenêtres', 1),
(20, 'images/449613859_975727837893797_5434945306584202146_n.jpg', 'Fenetre', 1),
(21, 'images/449701479_975726641227250_624456387362228272_n.jpg', 'Porte', 2),
(22, 'images/449744311_975728064560441_8081371509630544156_n.jpg', 'Fenetre', 1),
(23, 'images/449956898_975726674560580_3436360921234684400_n.jpg', 'Porte', 2),
(24, 'images/Photo.jpg', 'Cloture', 3),
(28, 'images/296448150_452851133514806_2496220407940631921_n.jpg', 'Velux toit', 7);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`identifiantService`, `nomService`, `imageService`) VALUES
(1, 'Fenêtres', 'images/Fenetre.png'),
(2, 'Porte', 'images/Porte.png'),
(3, 'Clôtures', 'images/Cloture.png'),
(7, 'Velux', 'images/Veluxelogo.png');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`identifiantUtilisateur`, `emailUtilisateur`, `nomUtilisateur`, `prenomUtilisateur`, `MDPUtilisateur`) VALUES
(1, 'cclauet@exemple.com', 'Clauet', 'Cedric', '$2y$10$9bnc9KqpB2aaB.4JIhoC9uUr1Ag2WbB4SPV0kf5UKYZm4IOBo./I6'),
(3, 'laura@exemple.com', 'Laura', 'Wastiau', '$2y$10$9YbeMkEw.TDZu9iPxxWuDukfeuEeJyJ2SmiZLrBOMXmsQJXMACZjC');

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
