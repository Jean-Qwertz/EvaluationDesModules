-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 30 Mars 2015 à 12:10
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `evaluation_des_modules`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_annee`
--

CREATE TABLE IF NOT EXISTS `t_annee` (
  `id_annee` int(11) NOT NULL AUTO_INCREMENT,
  `ann_nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_annee`),
  UNIQUE KEY `id_annee` (`id_annee`),
  KEY `id_annee_2` (`id_annee`),
  KEY `id_annee_3` (`id_annee`),
  KEY `id_annee_4` (`id_annee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `t_annee`
--

INSERT INTO `t_annee` (`id_annee`, `ann_nom`) VALUES
(1, '2013-2014'),
(2, '2014-2015'),
(3, '2015-2016'),
(4, '2016-2017'),
(5, '2017-2018'),
(6, '2018-2019');

-- --------------------------------------------------------

--
-- Structure de la table `t_avis`
--

CREATE TABLE IF NOT EXISTS `t_avis` (
  `id_avis` int(11) NOT NULL AUTO_INCREMENT,
  `avi_contenu` varchar(255) NOT NULL,
  `idx_niveau` int(11) NOT NULL,
  PRIMARY KEY (`id_avis`),
  UNIQUE KEY `id_avis_2` (`id_avis`),
  KEY `id_avis` (`id_avis`),
  KEY `idx_niveau` (`idx_niveau`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Contenu de la table `t_avis`
--

INSERT INTO `t_avis` (`id_avis`, `avi_contenu`, `idx_niveau`) VALUES
(1, 'très clairement', 1),
(2, 'partiellement', 2),
(3, 'pas clairement', 3),
(4, 'pas du tout', 4),
(5, 'indispensable', 1),
(6, 'utile', 2),
(7, 'peut-être utile', 3),
(8, 'sans aucune utilité', 4),
(9, 'très actuels', 1),
(10, 'actuels', 2),
(11, 'un peu dépassés', 3),
(12, 'dépassés', 4),
(13, 'tout à fait adaptés', 1),
(14, 'suffisants', 2),
(15, 'trop hauts', 3),
(16, 'trop bas', 4),
(17, 'parfaitement', 1),
(18, 'partiellement', 2),
(19, 'moyennement', 3),
(20, 'nombreuse et variée', 1),
(21, 'correcte', 2),
(22, 'faible', 3),
(23, 'trop faible', 4),
(24, 'très bonne', 1),
(25, 'bonne', 2),
(26, 'moyenne', 3),
(27, 'inadaptée', 4),
(28, 'parfait', 1),
(29, 'bon', 2),
(30, 'trop de pratique', 3),
(31, 'trop de théorie', 4),
(32, 'luxueux', 1),
(33, 'adaptés', 2),
(34, 'juste suffisant ', 3),
(35, 'très utiles', 1),
(36, 'utiles', 2),
(37, 'moyennement utiles', 3),
(38, 'inadaptés', 4),
(39, 'toujours', 1),
(40, 'généralement', 2),
(41, 'rarement', 3),
(42, 'pas du tout', 4),
(43, 'assez', 2),
(44, 'avec lacunes', 3),
(45, 'faible maîtrise', 3),
(46, 'beaucoup', 1),
(47, 'correct', 2),
(48, 'un peu', 3),
(49, 'ennuyeux', 4),
(50, 'peu compréhensible', 3),
(51, 'incompréhensible', 4),
(52, 'efficaces', 1),
(53, 'correctes', 2),
(54, 'peu adaptées', 3),
(55, 'inadaptées', 4),
(56, 'très appropriés', 1),
(57, 'adéquats', 2),
(58, 'peu adaptés', 3),
(59, 'inadéquats', 4),
(60, 'parfaite', 1),
(61, 'peu pertinente', 3),
(63, 'avec peine', 4),
(64, 'suffisamment', 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_classe`
--

CREATE TABLE IF NOT EXISTS `t_classe` (
  `id_classe` int(11) NOT NULL AUTO_INCREMENT,
  `clas_nom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_classe`),
  UNIQUE KEY `id_classe` (`id_classe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `t_classe`
--

INSERT INTO `t_classe` (`id_classe`, `clas_nom`) VALUES
(1, 'Grp1A'),
(2, 'Grp1B'),
(3, 'FIN1'),
(4, 'Grp1C'),
(5, 'MIN1B'),
(6, 'CIN2A'),
(7, 'CIN2B'),
(8, 'FIN2'),
(9, 'MIN2A'),
(10, 'MIN2B'),
(11, 'CIN3A'),
(12, 'CIN3B'),
(13, 'MIN3A'),
(14, 'MIN3B'),
(15, 'CIN4A'),
(16, 'CIN4B'),
(17, 'MIN4A'),
(18, 'MIN4B'),
(19, 'CIE');

-- --------------------------------------------------------

--
-- Structure de la table `t_commentaire`
--

CREATE TABLE IF NOT EXISTS `t_commentaire` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `idx_theme` int(11) NOT NULL,
  `com_contenu` varchar(200) NOT NULL,
  `idx_lien` int(11) NOT NULL,
  PRIMARY KEY (`id_commentaire`),
  UNIQUE KEY `id_theme_commentaire` (`id_commentaire`),
  KEY `idx_theme` (`idx_theme`),
  KEY `idx_lien` (`idx_lien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_enseignant`
--

CREATE TABLE IF NOT EXISTS `t_enseignant` (
  `id_enseignant` int(11) NOT NULL AUTO_INCREMENT,
  `ens_prenom` varchar(255) DEFAULT NULL,
  `ens_nom` varchar(255) DEFAULT NULL,
  `ens_login` varchar(30) NOT NULL,
  `ens_password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_enseignant`),
  UNIQUE KEY `id_enseignant` (`id_enseignant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `t_enseignant`
--

INSERT INTO `t_enseignant` (`id_enseignant`, `ens_prenom`, `ens_nom`, `ens_login`, `ens_password`) VALUES
(1, 'Pierre', 'Aubert', 'aubertpi', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(2, 'Karim', 'Bourahla', 'bourahlaka', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(3, 'Michel', 'Delgado', 'delgadomi', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(4, 'Laurent', 'Deschamps', 'deschampla', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(5, 'Patrick', 'Chenaux', 'chenauxpa', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(6, 'Laurent', 'Duding', 'dudingla', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(7, 'Roberto', 'Ferrari', 'ferrariro', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(8, 'Alain-Philippe', 'Garraux', 'garrauxal', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(9, 'Alain', 'Girardet', 'girardetal', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(10, 'Gilbert', 'Gruaz', 'gruazgi', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(11, 'Cindy', 'Hardegger', 'hardeggeci', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(12, 'Sébastien', 'Hausammann', 'hausammase', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(13, 'Dimitrios', 'Lymberis', 'lymberisdi', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(14, 'Jonathan', 'Melly', 'mellyjo', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(15, 'Antoine', 'Mveng', 'mvengan', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(16, 'Sheyla', 'Oliveira', 'oliveirash', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(17, 'Patrick', 'Ollivier', 'ollivierpa', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(18, 'Bertrand', 'Sahli', 'sahlibe', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(19, 'Cyril', 'Sokoloff', 'sokoloffcy', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(20, 'Isabelle', 'Stucki', 'stuckiis', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(21, 'Jean', 'Zahn', 'zahnje', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');

-- --------------------------------------------------------

--
-- Structure de la table `t_fiche`
--

CREATE TABLE IF NOT EXISTS `t_fiche` (
  `id_fiche` int(11) NOT NULL AUTO_INCREMENT,
  `idx_modele` int(11) NOT NULL,
  `idx_module` int(11) NOT NULL,
  `idx_classe` int(11) NOT NULL,
  `idx_enseignant` int(11) NOT NULL,
  `idx_annee` int(11) NOT NULL,
  PRIMARY KEY (`id_fiche`),
  UNIQUE KEY `id_entete` (`id_fiche`),
  KEY `idx_annee` (`idx_annee`),
  KEY `idx_annee_2` (`idx_annee`),
  KEY `idx_annee_3` (`idx_annee`),
  KEY `idx_annee_4` (`idx_annee`),
  KEY `idx_enseignant` (`idx_enseignant`),
  KEY `idx_classe` (`idx_classe`),
  KEY `idx_module` (`idx_module`),
  KEY `idx_modele` (`idx_modele`),
  KEY `idx_modele_2` (`idx_modele`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=136 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_lien`
--

CREATE TABLE IF NOT EXISTS `t_lien` (
  `id_lien` int(11) NOT NULL AUTO_INCREMENT,
  `idx_fiche` int(11) NOT NULL,
  `lie_random` varchar(10) NOT NULL,
  `lie_valide` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_lien`),
  KEY `idx_fiche` (`idx_fiche`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_modele`
--

CREATE TABLE IF NOT EXISTS `t_modele` (
  `id_modele` int(11) NOT NULL AUTO_INCREMENT,
  `mode_nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_modele`),
  UNIQUE KEY `id_modele` (`id_modele`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `t_modele`
--

INSERT INTO `t_modele` (`id_modele`, `mode_nom`) VALUES
(1, 'default');

-- --------------------------------------------------------

--
-- Structure de la table `t_module`
--

CREATE TABLE IF NOT EXISTS `t_module` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `modu_nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_module`),
  UNIQUE KEY `id_module` (`id_module`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `t_module`
--

INSERT INTO `t_module` (`id_module`, `modu_nom`) VALUES
(1, 'Projets'),
(2, 'ELEOC1'),
(3, 'ELEOC2'),
(4, 'ELEOC3'),
(5, '100'),
(6, '101'),
(7, '103'),
(8, '104'),
(9, '105'),
(10, '112'),
(11, '117'),
(12, '122'),
(13, '123'),
(14, '124'),
(15, '127'),
(16, '129'),
(17, '132'),
(18, '133'),
(19, '137'),
(20, '138'),
(21, '143'),
(22, '146'),
(23, '151'),
(24, '182'),
(25, '212'),
(26, '213'),
(27, '214'),
(28, '239'),
(29, '301'),
(30, '302'),
(31, '303'),
(32, '304'),
(33, '305'),
(34, '340');

-- --------------------------------------------------------

--
-- Structure de la table `t_niveau`
--

CREATE TABLE IF NOT EXISTS `t_niveau` (
  `id_niveau` int(11) NOT NULL AUTO_INCREMENT,
  `niv_coleur` varchar(100) NOT NULL,
  PRIMARY KEY (`id_niveau`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `t_niveau`
--

INSERT INTO `t_niveau` (`id_niveau`, `niv_coleur`) VALUES
(1, 'vert'),
(2, 'bleu'),
(3, 'jaune'),
(4, 'rouge');

-- --------------------------------------------------------

--
-- Structure de la table `t_question`
--

CREATE TABLE IF NOT EXISTS `t_question` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `que_contenu` varchar(500) NOT NULL,
  PRIMARY KEY (`id_question`),
  UNIQUE KEY `id_question` (`id_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `t_question`
--

INSERT INTO `t_question` (`id_question`, `que_contenu`) VALUES
(1, 'Les compétences et les objectifs visés ont été déclarés'),
(2, 'Pour ma profession, l''acquisition de ces compétences m''a semblé'),
(3, 'Pour ma profession, les contenus travaillés m''ont semblé'),
(4, 'Pour suivre cette formation, mon niveau de compétences et de connaissances au départ étaient'),
(5, 'Le style des activités proposées m''a convenu'),
(6, 'La diversité des activités a été'),
(7, 'La progression de la difficulté dans le temps était'),
(8, 'Le rapport entre les parties de théories et celles de pratiques était'),
(9, 'Pour toutes les activités, le matériel et les programmes mis à disposition étaient'),
(10, 'Pour l''acquisition des compétences, les supports de cours distribués (ou construits) étaient'),
(11, 'Les questions et les besoins des élèves ont été pris en compte avec respect'),
(12, 'Dans la matière enseignée, le formateur maîtrisait son sujet'),
(13, 'Le formateur était enthousiaste et intéressant.'),
(14, 'Le formateur s''exprimait clairement et se faisait comprendre'),
(15, 'Pour réussir cette formation, les activités ont été'),
(16, ' Pour réussir cette formation, le nombre et le style des tests formatifs et/ou des révisions proposés ont été'),
(17, 'Pour vérifier les compétences et les objectifs, l''épreuve finale était');

-- --------------------------------------------------------

--
-- Structure de la table `t_question_avis`
--

CREATE TABLE IF NOT EXISTS `t_question_avis` (
  `id_question_avis` int(11) NOT NULL AUTO_INCREMENT,
  `idx_lien` int(11) NOT NULL,
  `idx_theme` int(11) NOT NULL,
  `idx_question` int(11) NOT NULL,
  `idx_avis` int(11) NOT NULL,
  PRIMARY KEY (`id_question_avis`),
  KEY `idx_avis` (`idx_avis`,`idx_question`,`idx_lien`,`idx_theme`),
  KEY `idx_question` (`idx_question`),
  KEY `idx_fiche` (`idx_lien`),
  KEY `idx_theme` (`idx_theme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=834 ;

-- --------------------------------------------------------

--
-- Structure de la table `t_question_choix`
--

CREATE TABLE IF NOT EXISTS `t_question_choix` (
  `id_question_choix` int(11) NOT NULL AUTO_INCREMENT,
  `idx_modele` int(11) NOT NULL,
  `idx_theme` int(11) NOT NULL,
  `idx_question` int(11) NOT NULL,
  `idx_avis` int(11) NOT NULL,
  PRIMARY KEY (`id_question_choix`),
  UNIQUE KEY `id_question_avis` (`id_question_choix`),
  KEY `idx_avis` (`idx_avis`),
  KEY `idx_question` (`idx_question`),
  KEY `idx_modele` (`idx_modele`),
  KEY `idx_theme` (`idx_theme`),
  KEY `idx_theme_2` (`idx_theme`),
  KEY `idx_theme_3` (`idx_theme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Contenu de la table `t_question_choix`
--

INSERT INTO `t_question_choix` (`id_question_choix`, `idx_modele`, `idx_theme`, `idx_question`, `idx_avis`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 1, 1, 2),
(3, 1, 1, 1, 3),
(4, 1, 1, 1, 4),
(5, 1, 1, 2, 5),
(6, 1, 1, 2, 6),
(7, 1, 1, 2, 7),
(8, 1, 1, 2, 8),
(9, 1, 1, 3, 9),
(10, 1, 1, 3, 10),
(11, 1, 1, 3, 11),
(12, 1, 1, 3, 12),
(13, 1, 1, 4, 13),
(14, 1, 1, 4, 14),
(15, 1, 1, 4, 15),
(16, 1, 1, 4, 16),
(17, 1, 2, 5, 17),
(18, 1, 2, 5, 18),
(19, 1, 2, 5, 19),
(20, 1, 2, 5, 4),
(21, 1, 2, 6, 20),
(22, 1, 2, 6, 21),
(23, 1, 2, 6, 22),
(24, 1, 2, 6, 23),
(25, 1, 2, 7, 24),
(26, 1, 2, 7, 25),
(27, 1, 2, 7, 26),
(28, 1, 2, 7, 27),
(29, 1, 2, 8, 28),
(30, 1, 2, 8, 29),
(31, 1, 2, 8, 30),
(32, 1, 2, 8, 31),
(33, 1, 2, 9, 32),
(35, 1, 2, 9, 33),
(36, 1, 2, 9, 34),
(37, 1, 2, 9, 27),
(38, 1, 2, 10, 35),
(39, 1, 2, 10, 36),
(40, 1, 2, 10, 37),
(41, 1, 2, 10, 38),
(42, 1, 3, 11, 39),
(43, 1, 3, 11, 40),
(44, 1, 3, 11, 41),
(45, 1, 3, 11, 42),
(46, 1, 3, 12, 17),
(47, 1, 3, 12, 43),
(48, 1, 3, 12, 44),
(49, 1, 3, 12, 63),
(50, 1, 3, 13, 46),
(51, 1, 3, 13, 47),
(52, 1, 3, 13, 48),
(53, 1, 3, 13, 49),
(54, 1, 3, 14, 17),
(55, 1, 3, 14, 64),
(56, 1, 3, 14, 50),
(57, 1, 3, 14, 51),
(58, 1, 4, 15, 52),
(59, 1, 4, 15, 53),
(60, 1, 4, 15, 54),
(61, 1, 4, 15, 55),
(62, 1, 4, 16, 56),
(63, 1, 4, 16, 57),
(64, 1, 4, 16, 58),
(65, 1, 4, 16, 59),
(66, 1, 4, 17, 60),
(67, 1, 4, 17, 21),
(68, 1, 4, 17, 61),
(69, 1, 4, 17, 55);

-- --------------------------------------------------------

--
-- Structure de la table `t_theme`
--

CREATE TABLE IF NOT EXISTS `t_theme` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT,
  `the_contenu` varchar(500) NOT NULL,
  PRIMARY KEY (`id_theme`),
  UNIQUE KEY `id_theme` (`id_theme`),
  KEY `id_theme_2` (`id_theme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `t_theme`
--

INSERT INTO `t_theme` (`id_theme`, `the_contenu`) VALUES
(1, 'Questions sur les compétences et les objectifs visés, ainsi que sur les contenus'),
(2, 'Questions sur les activités proposées et les supports fournis'),
(3, 'Questions sur l''animation du cours'),
(4, 'Questions sur l''évaluation');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_avis`
--
ALTER TABLE `t_avis`
  ADD CONSTRAINT `t_avis_ibfk_1` FOREIGN KEY (`idx_niveau`) REFERENCES `t_niveau` (`id_niveau`);

--
-- Contraintes pour la table `t_commentaire`
--
ALTER TABLE `t_commentaire`
  ADD CONSTRAINT `t_commentaire_ibfk_1` FOREIGN KEY (`idx_theme`) REFERENCES `t_theme` (`id_theme`),
  ADD CONSTRAINT `t_commentaire_ibfk_3` FOREIGN KEY (`idx_lien`) REFERENCES `t_lien` (`id_lien`);

--
-- Contraintes pour la table `t_fiche`
--
ALTER TABLE `t_fiche`
  ADD CONSTRAINT `t_fiche_ibfk_1` FOREIGN KEY (`idx_annee`) REFERENCES `t_annee` (`id_annee`),
  ADD CONSTRAINT `t_fiche_ibfk_2` FOREIGN KEY (`idx_enseignant`) REFERENCES `t_enseignant` (`id_enseignant`),
  ADD CONSTRAINT `t_fiche_ibfk_3` FOREIGN KEY (`idx_classe`) REFERENCES `t_classe` (`id_classe`),
  ADD CONSTRAINT `t_fiche_ibfk_4` FOREIGN KEY (`idx_module`) REFERENCES `t_module` (`id_module`),
  ADD CONSTRAINT `t_fiche_ibfk_5` FOREIGN KEY (`idx_modele`) REFERENCES `t_modele` (`id_modele`);

--
-- Contraintes pour la table `t_lien`
--
ALTER TABLE `t_lien`
  ADD CONSTRAINT `t_lien_ibfk_1` FOREIGN KEY (`idx_fiche`) REFERENCES `t_fiche` (`id_fiche`);

--
-- Contraintes pour la table `t_question_avis`
--
ALTER TABLE `t_question_avis`
  ADD CONSTRAINT `t_question_avis_ibfk_1` FOREIGN KEY (`idx_avis`) REFERENCES `t_avis` (`id_avis`),
  ADD CONSTRAINT `t_question_avis_ibfk_2` FOREIGN KEY (`idx_question`) REFERENCES `t_question` (`id_question`),
  ADD CONSTRAINT `t_question_avis_ibfk_3` FOREIGN KEY (`idx_lien`) REFERENCES `t_lien` (`id_lien`),
  ADD CONSTRAINT `t_question_avis_ibfk_4` FOREIGN KEY (`idx_theme`) REFERENCES `t_theme` (`id_theme`);

--
-- Contraintes pour la table `t_question_choix`
--
ALTER TABLE `t_question_choix`
  ADD CONSTRAINT `t_question_choix_ibfk_1` FOREIGN KEY (`idx_avis`) REFERENCES `t_avis` (`id_avis`),
  ADD CONSTRAINT `t_question_choix_ibfk_2` FOREIGN KEY (`idx_question`) REFERENCES `t_question` (`id_question`),
  ADD CONSTRAINT `t_question_choix_ibfk_3` FOREIGN KEY (`idx_modele`) REFERENCES `t_modele` (`id_modele`),
  ADD CONSTRAINT `t_question_choix_ibfk_4` FOREIGN KEY (`idx_theme`) REFERENCES `t_theme` (`id_theme`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
