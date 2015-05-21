-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.1.54-community-log - MySQL Community Server (GPL)
-- Serveur OS:                   Win32
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- Export de données de la table coq.coq_collection: ~3 rows (environ)
/*!40000 ALTER TABLE `coq_collection` DISABLE KEYS */;
INSERT IGNORE INTO `coq_collection` (`id`, `title`, `difficulty`) VALUES
	(2, 'Les mangas !', 2),
	(3, 'Infooo', 3);
/*!40000 ALTER TABLE `coq_collection` ENABLE KEYS */;

-- Export de données de la table coq.coq_config: ~2 rows (environ)
/*!40000 ALTER TABLE `coq_config` DISABLE KEYS */;
INSERT IGNORE INTO `coq_config` (`key_2`, `val`) VALUES
	('nb_question_collection', '5'),
	('nb_round_duel', '3');
	('timeout_question', '10')
/*!40000 ALTER TABLE `coq_config` ENABLE KEYS */;

-- Export de données de la table coq.coq_duel: ~1 rows (environ)
/*!40000 ALTER TABLE `coq_duel` DISABLE KEYS */;
INSERT IGNORE INTO `coq_duel` (`id`, `user1_id`, `user2_id`, `current_round_id`, `current_round_number`, `total_score1`, `total_score2`) VALUES
	(1, 1, 2, 1, 1, 26, 0);
/*!40000 ALTER TABLE `coq_duel` ENABLE KEYS */;

-- Export de données de la table coq.coq_question: ~18 rows (environ)
/*!40000 ALTER TABLE `coq_question` DISABLE KEYS */;
INSERT IGNORE INTO `coq_question` (`id`, `theme_id`, `val`, `answer1`, `answer2`, `answer3`, `answerOK`) VALUES
	(0, 1, 'Est ce que Seb sait jouer Ã  Xenoverse', 'Oui', 'Non', 'Peut Ãªtre', 'TG'),
	(1, 3, 'Que joue Linkin Park ?', 'Rap', 'Varietoche', 'Techno', 'Metal'),
	(2, 3, 'Qui est Bob Marley ?', 'Le gouverneur de Californie', 'Un robot qui veut detruire le monde', 'Un rappeur', 'Un fumeur de weed'),
	(3, 3, 'Quel morceau n\'est pas de Michael Jackson ?', 'Beat it', 'They don\'t care about us', 'The song of the earth', 'Viens foutre la merde negro'),
	(4, 3, 'Qui n\'aurait jamais du faire de la musique ?', 'Michael Jackson', 'Daft Punk', 'Booba', 'Florant Pagnigni'),
	(5, 3, 'Quel est le sens de la vie, de l\'univers, et tout le reste ?', 'La biere', 'La reponse D', 'Euh, quoi ?', '42'),
	(9, 4, 'Quel est le vrai nom de Sangoku ?', 'Raradis', 'Coucourget', 'Nanavet', 'Kakarot'),
	(10, 4, 'Quel type de combattant est Naruto ?', 'Samourai', 'Espion', 'Assassin', 'Ninja'),
	(11, 4, 'Quel est le surnom de Luffy dans One Piece ?', 'Eichiro', 'Kurosaki', 'Pikachu', 'Mugiwara'),
	(12, 4, 'Quel age a Onizuka Eikichi dans GTO ?', '19 ans', '20 ans', '21 ans', '22 ans'),
	(13, 4, 'De quel auteur s\'inspire Zetsuen No Tempest ?', 'Moliere', 'Booba', 'Socrate', 'Shaekspeare'),
	(14, 5, 'Quelle techno n\'est pas faite pour Javascript ?', 'Node', 'Angular', 'Three', 'Django'),
	(15, 5, 'Cherchez l\'intrus', 'Symphony', 'Zend', 'Laravel', 'Smarty'),
	(16, 5, 'Quel langage est generalement utilise pour les applications Android ?', 'Javascript', 'C', 'C++', 'Java'),
	(17, 5, 'Quel langage est generalement utilise pour les applications Windows Phone ?', 'Javascript', 'C', 'C++', 'Java'),
	(18, 5, 'Que signiefie HTTP ?', 'Houla Toto Titi Poof', 'High Technology Type Protection', 'Hyper Transfer Text Protocol', 'HyperText Transfer Protocol');
/*!40000 ALTER TABLE `coq_question` ENABLE KEYS */;

-- Export de données de la table coq.coq_question_collection: ~15 rows (environ)
/*!40000 ALTER TABLE `coq_question_collection` DISABLE KEYS */;
INSERT IGNORE INTO `coq_question_collection` (`id`, `question_id`, `collection_id`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 3, 1),
	(4, 4, 1),
	(5, 5, 1),
	(6, 9, 2),
	(7, 10, 2),
	(8, 11, 2),
	(9, 12, 2),
	(10, 13, 2),
	(11, 14, 3),
	(12, 15, 3),
	(13, 16, 3),
	(14, 17, 3),
	(15, 18, 3);
/*!40000 ALTER TABLE `coq_question_collection` ENABLE KEYS */;

-- Export de données de la table coq.coq_round: ~3 rows (environ)
/*!40000 ALTER TABLE `coq_round` DISABLE KEYS */;
INSERT IGNORE INTO `coq_round` (`id`, `chosen_theme1_id`, `chosen_theme2_id`, `collection_id`, `selected_theme_id`, `round_score1`, `round_score2`, `end1`, `end2`) VALUES
	(1, 3, 3, 1, 3, 1, 0, 1, 0),
	(2, 4, 4, 2, 4, 1, 0, 0, 0),
	(3, 5, 5, 3, 5, 0, 0, 0, 0);
/*!40000 ALTER TABLE `coq_round` ENABLE KEYS */;

-- Export de données de la table coq.coq_theme: ~5 rows (environ)
/*!40000 ALTER TABLE `coq_theme` DISABLE KEYS */;
INSERT IGNORE INTO `coq_theme` (`id`, `val`) VALUES
	(1, 'General'),
	(2, 'DBZ'),
	(3, 'Musique'),
	(4, 'Mangas'),
	(5, 'Informatique');
/*!40000 ALTER TABLE `coq_theme` ENABLE KEYS */;

-- Export de données de la table coq.coq_user: ~5 rows (environ)
/*!40000 ALTER TABLE `coq_user` DISABLE KEYS */;
INSERT IGNORE INTO `coq_user` (`id`, `login`, `pwd`, `pseudo`, `rights`) VALUES
	(1, 'seb@seb.fr', 'azerty', 'Seb', 0),
	(2, 'tim@tim.fr', 'azerty', 'Timo', 0),
	(3, 'jo@jo.fr', 'azerty', 'Jojo', 0),
	(4, 'os@os.fr', 'azerty', 'Osvaldo', 0),
	(5, 're@re.fr', 'azerty', 'Renan', 0);
/*!40000 ALTER TABLE `coq_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
