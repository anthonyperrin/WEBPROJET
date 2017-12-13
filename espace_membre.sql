-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 13 déc. 2017 à 13:53
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `espace_membre`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartient_a`
--

DROP TABLE IF EXISTS `appartient_a`;
CREATE TABLE IF NOT EXISTS `appartient_a` (
  `ID_Categorie` int(11) NOT NULL,
  `CodeISBM` char(13) NOT NULL,
  PRIMARY KEY (`ID_Categorie`,`CodeISBM`),
  KEY `FK_APPARTIENT_A_CodeISBM` (`CodeISBM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `ID_Auteur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Auteur` char(100) DEFAULT NULL,
  `Prenom_Auteur` char(100) DEFAULT NULL,
  `DateNai_Auteur` date DEFAULT NULL,
  PRIMARY KEY (`ID_Auteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `ID_Categorie` int(11) NOT NULL AUTO_INCREMENT,
  `Type_Categorie` char(100) NOT NULL,
  PRIMARY KEY (`ID_Categorie`,`Type_Categorie`),
  UNIQUE KEY `ID_Categorie` (`ID_Categorie`,`Type_Categorie`),
  UNIQUE KEY `Type_Categorie` (`Type_Categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`ID_Categorie`, `Type_Categorie`) VALUES
(4, 'BD'),
(7, 'BienEtre'),
(8, 'Cuisine'),
(5, 'Jeunesse'),
(6, 'LivreAdo'),
(10, 'LivresEtrangers'),
(3, 'Romance'),
(2, 'RomanPolicier'),
(1, 'RomansEtLittérature'),
(9, 'Tourisme');

-- --------------------------------------------------------

--
-- Structure de la table `devient`
--

DROP TABLE IF EXISTS `devient`;
CREATE TABLE IF NOT EXISTS `devient` (
  `DateDebut_Inscription` date DEFAULT NULL,
  `ID_Membre` int(11) NOT NULL,
  `ID_Inscrit` int(11) NOT NULL,
  PRIMARY KEY (`ID_Membre`,`ID_Inscrit`),
  KEY `FK_DEVIENT_ID_Inscrit` (`ID_Inscrit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `edite`
--

DROP TABLE IF EXISTS `edite`;
CREATE TABLE IF NOT EXISTS `edite` (
  `ID_Edition` int(11) NOT NULL,
  `ID_Ref` int(11) NOT NULL,
  PRIMARY KEY (`ID_Edition`,`ID_Ref`),
  KEY `FK_EDITE_ID_Ref` (`ID_Ref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `edition`
--

DROP TABLE IF EXISTS `edition`;
CREATE TABLE IF NOT EXISTS `edition` (
  `ID_Edition` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Editeur` char(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Edition`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `exemplaire`
--

DROP TABLE IF EXISTS `exemplaire`;
CREATE TABLE IF NOT EXISTS `exemplaire` (
  `ID_Ref` int(11) NOT NULL AUTO_INCREMENT,
  `DateDebut_Emprunt` date DEFAULT NULL,
  `ID_Inscrit` int(11) DEFAULT NULL,
  `CodeISBM` char(13) DEFAULT NULL,
  PRIMARY KEY (`ID_Ref`),
  KEY `FK_EXEMPLAIRE_ID_Inscrit` (`ID_Inscrit`),
  KEY `FK_EXEMPLAIRE_CodeISBM` (`CodeISBM`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `exemplaire`
--

INSERT INTO `exemplaire` (`ID_Ref`, `DateDebut_Emprunt`, `ID_Inscrit`, `CodeISBM`) VALUES
(13, '1970-01-01', 8, '1'),
(14, '2017-04-07', 8, '1');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `CodeISBM` char(13) NOT NULL,
  `Titre_Livre` char(150) DEFAULT NULL,
  `Resume_Livre` text,
  `Stock` int(11) DEFAULT NULL,
  `AnneeParution_Livre` date DEFAULT NULL,
  `ID_Auteur` int(11) DEFAULT NULL,
  `ID_Categorie` int(11) NOT NULL,
  PRIMARY KEY (`CodeISBM`),
  KEY `FK_LIVRE_ID_Auteur` (`ID_Auteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`CodeISBM`, `Titre_Livre`, `Resume_Livre`, `Stock`, `AnneeParution_Livre`, `ID_Auteur`, `ID_Categorie`) VALUES
('1', 'efzfez', 'fezfz', 11, '1515-06-15', NULL, 0),
('1234567890123', 'Le sang', 'FOOT', 9, '1994-06-18', NULL, 7),
('1234567890124', 'le bo jeu', 'Cest bien', 7, '1997-04-07', NULL, 7),
('1234567890147', 'Bernar', 'KROCJDSL', 5, '1547-05-08', NULL, 1),
('1234567890159', 'koko', 'rfefdzzf', 3, '2002-04-23', NULL, 1),
('2', 'lllolo', 'fezfezfez', 1, '7523-04-08', NULL, 0),
('3', 'exa', 'ezffezf', 2, '1235-05-06', NULL, 0),
('6', 'fefezf', 'efzfz', 8, '1999-09-09', NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `ID_Membre` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Membre` char(100) DEFAULT NULL,
  `Prenom_Membre` char(100) DEFAULT NULL,
  `Pseudo_Membre` char(100) DEFAULT NULL,
  `DateNai_Membre` date DEFAULT NULL,
  `Adresse1_Membre` char(255) DEFAULT NULL,
  `Adresse2_Membre` char(255) DEFAULT NULL,
  `Ville_Membre` char(100) DEFAULT NULL,
  `CP_Membre` char(10) DEFAULT NULL,
  `Tel_Membre` char(20) DEFAULT NULL,
  `Mail_Membre` char(255) DEFAULT NULL,
  `Mdp_membre` char(255) DEFAULT NULL,
  PRIMARY KEY (`ID_Membre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`ID_Membre`, `Nom_Membre`, `Prenom_Membre`, `Pseudo_Membre`, `DateNai_Membre`, `Adresse1_Membre`, `Adresse2_Membre`, `Ville_Membre`, `CP_Membre`, `Tel_Membre`, `Mail_Membre`, `Mdp_membre`) VALUES
(7, 'Perrin', 'Anthony', 'SerahF', '1999-02-08', '289 rue AndrÃ© AmpÃ¨re', '1', 'Mauguio', '34130', '0631785656', 'anthonyperrinff@gmail.com', 'd35b359a6b08400cceeeb9e61a79906b309f0fec'),
(8, 'plagnol', 'antoine', 'tutti', '1997-04-07', '730 rue de la Croix de lavit', 'etage 1 bat b app 004', 'Montpellier', '34090', '0652982835', 'antoine.plagnol@gmail.com', '57045c9761d0115d6b0b338b424f47b59274a2c5');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartient_a`
--
ALTER TABLE `appartient_a`
  ADD CONSTRAINT `FK_APPARTIENT_A_CodeISBM` FOREIGN KEY (`CodeISBM`) REFERENCES `livre` (`CodeISBM`),
  ADD CONSTRAINT `FK_APPARTIENT_A_ID_Categorie` FOREIGN KEY (`ID_Categorie`) REFERENCES `categorie` (`ID_Categorie`);

--
-- Contraintes pour la table `devient`
--
ALTER TABLE `devient`
  ADD CONSTRAINT `FK_DEVIENT_ID_Inscrit` FOREIGN KEY (`ID_Inscrit`) REFERENCES `inscrit` (`ID_Inscrit`),
  ADD CONSTRAINT `FK_DEVIENT_ID_Membre` FOREIGN KEY (`ID_Membre`) REFERENCES `membre` (`ID_Membre`);

--
-- Contraintes pour la table `edite`
--
ALTER TABLE `edite`
  ADD CONSTRAINT `FK_EDITE_ID_Edition` FOREIGN KEY (`ID_Edition`) REFERENCES `edition` (`ID_Edition`),
  ADD CONSTRAINT `FK_EDITE_ID_Ref` FOREIGN KEY (`ID_Ref`) REFERENCES `exemplaire` (`ID_Ref`);

--
-- Contraintes pour la table `exemplaire`
--
ALTER TABLE `exemplaire`
  ADD CONSTRAINT `FK_EXEMPLAIRE_CodeISBM` FOREIGN KEY (`CodeISBM`) REFERENCES `livre` (`CodeISBM`),
  ADD CONSTRAINT `FK_EXEMPLAIRE_ID_Membre` FOREIGN KEY (`ID_Inscrit`) REFERENCES `membre` (`ID_Membre`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `FK_LIVRE_ID_Auteur` FOREIGN KEY (`ID_Auteur`) REFERENCES `auteur` (`ID_Auteur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
