-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 20 Mai 2015 à 18:44
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `coq_collection`
--

INSERT INTO `coq_collection` (`id`, `title`, `difficulty`) VALUES
(1, 'dscd', 1),
(2, 'Les mangas !', 2);

-- --------------------------------------------------------

--
-- Structure de la table `coq_config`
--

CREATE TABLE IF NOT EXISTS `coq_config` (
  `key_2` varchar(20) NOT NULL,
  `val` varchar(20) NOT NULL,
  UNIQUE KEY `key_2` (`key_2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `coq_config`
--

INSERT INTO `coq_config` (`key_2`, `val`) VALUES
('nb_question_collecti', '5'),
('nb_round_duel', '3');

-- --------------------------------------------------------

--
-- Structure de la table `coq_duel`
--

CREATE TABLE IF NOT EXISTS `coq_duel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user1_id` int(10) unsigned NOT NULL,
  `user2_id` int(10) unsigned NOT NULL,
  `current_round_id` int(10) unsigned NOT NULL COMMENT 'Round courant',
  `current_round_number` int(10) unsigned NOT NULL COMMENT 'Numéro de round (1, 2, 3..)',
  `score1` int(10) unsigned NOT NULL,
  `score2` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user1_id`,`user2_id`,`current_round_id`),
  UNIQUE KEY `id` (`id`),
  KEY `COQ_Dual_FKIndex1` (`user1_id`),
  KEY `COQ_Dual_FKIndex2` (`user2_id`),
  KEY `FK_DUEL__ROUND` (`current_round_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Les duels' AUTO_INCREMENT=3 ;

--
-- Contenu de la table `coq_duel`
--

INSERT INTO `coq_duel` (`id`, `user1_id`, `user2_id`, `current_round_id`, `current_round_number`, `score1`, `score2`) VALUES
(1, 1, 2, 2, 2, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `coq_question`
--

INSERT INTO `coq_question` (`id`, `theme_id`, `val`, `answer1`, `answer2`, `answer3`, `answerOK`) VALUES
(0, 1, 'Est ce que Seb sait jouer Ã  Xenoverse', 'Oui', 'Non', 'Peut Ãªtre', 'TG'),
(1, 3, 'Que joue Linkin Park ?', 'Rap', 'Varietoche', 'Techno', 'Metal'),
(2, 3, 'Qui est Bob Marley ?', 'Le gouverneur de Californie', 'Un robot qui veut detruire le monde', 'Un rappeur', 'Un fumeur de weed'),
(3, 3, 'Quel morceau n''est pas de Michael Jackson ?', 'Beat it', 'They don''t care about us', 'The song of the earth', 'Viens foutre la merde negro'),
(4, 3, 'Qui n''aurait jamais du faire de la musique ?', 'Michael Jackson', 'Daft Punk', 'Booba', 'Florant Pagnigni'),
(5, 3, 'Quel est le sens de la vie, de l''univers, et tout le reste ?', 'La biere', 'La reponse D', 'Euh, quoi ?', '42'),
(7, 1, 'lollolol', 'l', 'o', 'l', 'o'),
(8, 2, 'fdvg', 'v', 'ffd', 'd', 'f'),
(9, 4, 'Quel est le vrai nom de Sangoku ?', 'Raradis', 'Coucourget', 'Nanavet', 'Kakarot'),
(10, 4, 'Quel type de combattant est Naruto ?', 'Samouraï', 'Espion', 'Assassin', 'Ninja'),
(11, 4, 'Quel est le surnom de Luffy dans One Piece ?', 'Eichiro', 'Kurosaki', 'Pikachu', 'Mugiwara'),
(12, 4, 'Quel âge à Onizuka Eikichi dans GTO ?', '19 ans', '20 ans', '21 ans', '22 ans'),
(13, 4, 'De quel auteur s''inspire Zetsuen No Tempest ?', 'Molière', 'Booba', 'Socrate', 'Shaekspeare');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Table d''association question / série' AUTO_INCREMENT=11 ;

--
-- Contenu de la table `coq_question_collection`
--

INSERT INTO `coq_question_collection` (`id`, `question_id`, `collection_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 9, 2),
(7, 10, 2),
(8, 11, 2),
(9, 12, 2),
(10, 13, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `coq_round`
--

INSERT INTO `coq_round` (`id`, `chosen_theme1_id`, `chosen_theme2_id`, `collection_id`, `selected_theme_id`, `score1`, `score2`, `end1`, `end2`) VALUES
(1, 3, 3, 1, 3, 4, 2, 1, 1),
(2, 4, 4, 2, 4, 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `coq_theme`
--

CREATE TABLE IF NOT EXISTS `coq_theme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `val` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `coq_theme`
--

INSERT INTO `coq_theme` (`id`, `val`) VALUES
(1, 'General'),
(2, 'DBZ'),
(3, 'Musique'),
(4, 'Mangas');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `coq_user`
--

INSERT INTO `coq_user` (`id`, `login`, `pwd`, `pseudo`, `rights`) VALUES
(1, 'seb@seb.fr', 'azerty', 'Seb', 0),
(2, 'tim@tim.fr', 'azerty', 'Timo', 0),
(3, 'jo@jo.fr', 'azerty', 'Jojo', 0),
(4, 'os@os.fr', 'azerty', 'Osvaldo', 0),
(5, 're@re.fr', 'azerty', 'Renan', 0);

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
