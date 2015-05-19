-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 19 Mai 2015 à 14:13
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `coq`
--

-- --------------------------------------------------------

--
-- Structure de la table `coq_collection`
--

CREATE TABLE IF NOT EXISTS `coq_collection` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifiant',
  `title` varchar(20) NOT NULL COMMENT 'Titre de la série',
  `difficulty` int(11) NOT NULL COMMENT 'Niveau de difficulté (1 facile, 2 moyen, 3 difficile)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `coq_config`
--

CREATE TABLE IF NOT EXISTS `coq_config` (
  `key_2` varchar(20) NOT NULL,
  `val` varchar(20) NOT NULL,
  UNIQUE KEY `key_2` (`key_2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `coq_duel`
--

CREATE TABLE IF NOT EXISTS `coq_duel` (
  `user1_id` int(10) unsigned NOT NULL,
  `user2_id` int(10) unsigned NOT NULL,
  `current_round_id` int(10) unsigned NOT NULL COMMENT 'Round courant',
  `current_round_number` int(10) unsigned NOT NULL COMMENT 'Numéro de round (1, 2, 3..)',
  PRIMARY KEY (`user1_id`,`user2_id`,`current_round_id`),
  KEY `COQ_Dual_FKIndex1` (`user1_id`),
  KEY `COQ_Dual_FKIndex2` (`user2_id`),
  KEY `FK_DUEL__ROUND` (`current_round_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Les duels';

-- --------------------------------------------------------

--
-- Structure de la table `coq_question`
--

CREATE TABLE IF NOT EXISTS `coq_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` int(10) unsigned NOT NULL COMMENT 'Question',
  `val` varchar(255) NOT NULL COMMENT 'La question',
  `answer1` varchar(255) NOT NULL COMMENT 'Une réponse fausse',
  `answer2` varchar(255) NOT NULL COMMENT 'Une réponse fausse',
  `answer3` varchar(255) NOT NULL COMMENT 'Une réponse fausse',
  `answerOK` varchar(255) NOT NULL COMMENT 'La bonne réponse',
  PRIMARY KEY (`id`),
  KEY `question_id` (`theme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `coq_question`
--

INSERT INTO `coq_question` (`id`, `theme_id`, `val`, `answer1`, `answer2`, `answer3`, `answerOK`) VALUES
(0, 1, 'Est ce que Seb sait jouer Ã  Xenoverse', 'Oui', 'Non', 'Peut Ãªtre', 'TG'),
(7, 1, 'lollolol', 'l', 'o', 'l', 'o'),
(8, 2, 'fdvg', 'v', 'ffd', 'd', 'f');

-- --------------------------------------------------------

--
-- Structure de la table `coq_question_collection`
--

CREATE TABLE IF NOT EXISTS `coq_question_collection` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique',
  `question_id` int(10) unsigned NOT NULL COMMENT 'Question',
  `collection_id` int(10) unsigned NOT NULL COMMENT 'Série',
  PRIMARY KEY (`id`),
  KEY `collection_id` (`question_id`),
  KEY `collection_id_2` (`collection_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table d''association question / série' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `coq_round`
--

CREATE TABLE IF NOT EXISTS `coq_round` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chosen_theme1_id` int(10) unsigned NOT NULL COMMENT 'Thème choisi par le joueur',
  `chosen_theme2_id` int(10) unsigned NOT NULL COMMENT 'Thème choisi par le joueur 2',
  `collection_id` int(10) unsigned NOT NULL COMMENT 'Série',
  `selected_theme_id` int(10) unsigned NOT NULL COMMENT 'Thème sélectionné par le système',
  `score1` int(10) unsigned DEFAULT NULL,
  `score2` int(10) unsigned DEFAULT NULL,
  `end1` tinyint(1) DEFAULT NULL,
  `end2` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chosen_theme1_id` (`chosen_theme1_id`,`chosen_theme2_id`,`collection_id`,`selected_theme_id`),
  KEY `chosen_theme2_id` (`chosen_theme2_id`),
  KEY `collection_id` (`collection_id`),
  KEY `selected_theme_id` (`selected_theme_id`),
  KEY `selected_theme_id_2` (`selected_theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `coq_theme`
--

CREATE TABLE IF NOT EXISTS `coq_theme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `val` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `coq_theme`
--

INSERT INTO `coq_theme` (`id`, `val`) VALUES
(1, 'General'),
(2, 'DBZ');

-- --------------------------------------------------------

--
-- Structure de la table `coq_user`
--

CREATE TABLE IF NOT EXISTS `coq_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `rights` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `coq_duel`
--
ALTER TABLE `coq_duel`
  ADD CONSTRAINT `FK_DUEL__ROUND` FOREIGN KEY (`current_round_id`) REFERENCES `coq_round` (`id`),
  ADD CONSTRAINT `FK_DUEL__USER1` FOREIGN KEY (`user1_id`) REFERENCES `coq_user` (`id`),
  ADD CONSTRAINT `FK_DUEL__USER2` FOREIGN KEY (`user2_id`) REFERENCES `coq_user` (`id`);

--
-- Contraintes pour la table `coq_question`
--
ALTER TABLE `coq_question`
  ADD CONSTRAINT `FK_QUESTION__THEME` FOREIGN KEY (`theme_id`) REFERENCES `coq_theme` (`id`);

--
-- Contraintes pour la table `coq_question_collection`
--
ALTER TABLE `coq_question_collection`
  ADD CONSTRAINT `FK_QUESTION_COLLECTION__COLLECTION` FOREIGN KEY (`collection_id`) REFERENCES `coq_collection` (`id`);

--
-- Contraintes pour la table `coq_round`
--
ALTER TABLE `coq_round`
  ADD CONSTRAINT `FK_ROUND__COLLECTION` FOREIGN KEY (`collection_id`) REFERENCES `coq_collection` (`id`),
  ADD CONSTRAINT `FK_ROUND__THEME1` FOREIGN KEY (`chosen_theme1_id`) REFERENCES `coq_theme` (`id`),
  ADD CONSTRAINT `FK_ROUND__THEME2` FOREIGN KEY (`chosen_theme2_id`) REFERENCES `coq_theme` (`id`),
  ADD CONSTRAINT `FK_ROUND__THEME_SELECTED` FOREIGN KEY (`selected_theme_id`) REFERENCES `coq_theme` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
