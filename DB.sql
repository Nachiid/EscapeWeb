-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 15 déc. 2023 à 12:51
-- Version du serveur :  10.5.19-MariaDB-0+deb11u2
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e22111435_db1`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`e22111435sql`@`%` PROCEDURE `modifier_mdp_procedure` (IN `u` VARCHAR(255), IN `mdp` VARCHAR(255))  BEGIN
    DECLARE salt VARCHAR(255);
    DECLARE hashed_password VARCHAR(255);

    -- Définir le sel
    SET salt = 'OnRajouteDuSelPourAllongerleMDP123!!45678__Test';

    -- Hacher le mot de passe avec le sel
    SET hashed_password = SHA2(CONCAT(salt, mdp), 256);

    -- Mettre à jour le mot de passe dans la table T_compte_cpt
    UPDATE T_compte_cpt SET cpt_mdp = hashed_password WHERE cpt_email = u;
END$$

--
-- Fonctions
--
CREATE DEFINER=`e22111435sql`@`%` FUNCTION `nb_participant` (`scenario_id` INT) RETURNS INT(11) BEGIN
	DECLARE nb_participant INT;
-- calcule le nombre de ligne dans un tableua qui contient les participant qui ont reussis un scenario 
    SELECT COUNT(DISTINCT par_id) INTO nb_participant FROM T_reussite_reu WHERE      sce_id = scenario_id;
    RETURN nb_participant;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `T_actualite_act`
--

CREATE TABLE `T_actualite_act` (
  `act_id` int(11) NOT NULL,
  `act_intitule` varchar(200) DEFAULT NULL,
  `act_description` varchar(200) DEFAULT NULL,
  `act_validite` char(1) DEFAULT NULL,
  `act_date` date NOT NULL,
  `cpt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `T_actualite_act`
--

INSERT INTO `T_actualite_act` (`act_id`, `act_intitule`, `act_description`, `act_validite`, `act_date`, `cpt_id`) VALUES
(1, 'Nouvelle victoire de l\'équipe nationale', 'L\'équipe nationale de football a remporté un nouveau match contre son rival, marquant une victoire importante.', '1', '2023-12-07', 2),
(2, 'Lancement de la saison 2023-2024', 'La nouvelle saison de football 2023-2024 a officiellement débuté, avec de nombreuses équipes prêtes à rivaliser pour la victoire.', '1', '2023-12-10', 2),
(3, 'Nouveau contrat signé par une star du football', 'Une star du football a signé un nouveau contrat avec son club actuel, suscitant l\'enthousiasme parmi les fans.', '1', '2023-12-13', 2),
(4, 'Le championnat national de football approche', 'Le championnat national de football débutera bientôt, et les équipes se préparent pour la compétition.', '1', '2023-12-25', 3),
(5, 'Lancement d\'une nouvelle équipe de football', 'Une nouvelle équipe de football a été créée, apportant une bouffée d\'air frais à la scène du football.', '0', '2023-12-23', 3),
(6, 'Record de buts battu par un joueur de football', 'Un joueur de football a récemment battu le record du plus grand nombre de buts marqués en une saison.', '0', '2023-12-18', 3),
(7, 'Événement caritatif du monde du football', 'Une association de joueurs de football organise un événement caritatif visant à collecter des fonds pour des causes sociales importantes.', '0', '2023-12-29', 2);

-- --------------------------------------------------------

--
-- Structure de la table `T_compte_cpt`
--

CREATE TABLE `T_compte_cpt` (
  `cpt_id` int(11) NOT NULL,
  `cpt_email` varchar(200) NOT NULL,
  `cpt_mdp` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `T_compte_cpt`
--

INSERT INTO `T_compte_cpt` (`cpt_id`, `cpt_email`, `cpt_mdp`) VALUES
(1, 'administrATeur@gmail.com', '51749fdfc9e4bf37efae79744172c7735d7cf0406589b274b15d0c64e7441198'),
(2, 'aymennachid@gmail.com', '3b00cab7e5397960ca318bc89be38e55a3285907419fd0d0bf8f2cf4e626db69'),
(3, 'luciephilippe@gmail.com', '3b00cab7e5397960ca318bc89be38e55a3285907419fd0d0bf8f2cf4e626db69'),
(4, 'test@gmai.com', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb'),
(5, 'tes4512t@gmai.com', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb'),
(7, 'e22111435@gmail.com', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb'),
(8, 'leilaaziz@gmail.com', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb'),
(11, 'abdo1234@gmail.com', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb'),
(18, 'e2211143512345@gmail.com', '45db71968a98ed77af7e95803c99a1d4a05d5fee639ea070283d5d6e171e473c'),
(21, 'sanndobatengue@gmail.com', '5bcec7c6a074b7455d0d1db4e3c989d3d00ead092b26f6cf6f870de85563f2c8'),
(22, 'test\'aposthophe@gmail.com', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb'),
(23, 'test\'aposthophe123@gmail.com', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb'),
(24, 'formulaire32@gmail.com', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb'),
(25, 'test_mdp@gmail.com', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb'),
(26, 'test_a_supprimer@gmail.com', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb'),
(27, 'test_etape@gmail.com', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb'),
(28, 'vm34@gmail.com', 'af42dc9003c1873832fa919214011259de6932d8497b7c40c87e6b056d7a96eb');

-- --------------------------------------------------------

--
-- Structure de la table `T_etape_etp`
--

CREATE TABLE `T_etape_etp` (
  `etp_id` int(11) NOT NULL,
  `etp_code` char(8) DEFAULT NULL,
  `etp_intitule` varchar(80) DEFAULT NULL,
  `etp_description` varchar(200) DEFAULT NULL,
  `etp_reponse` varchar(200) DEFAULT NULL,
  `etp_num` int(11) DEFAULT NULL,
  `sce_id` int(11) NOT NULL,
  `res_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `T_etape_etp`
--

INSERT INTO `T_etape_etp` (`etp_id`, `etp_code`, `etp_intitule`, `etp_description`, `etp_reponse`, `etp_num`, `sce_id`, `res_id`) VALUES
(1, 'OPX001', 'Une belle couleur un mauvais carton !', 'Quelle est la couleur du  carton qui permet l\'expulsion d\'un joueur ?', 'rouge', 1, 1, 2),
(2, 'OPX002', 'Plus de temps Plus de stress', 'Combien dure une prologation ', '30 min', 2, 1, 3),
(7, 'OPX007', 'Ballon d\'Or 2021', 'Quel joueur a remporté le Ballon d\'Or en 2021 ?', 'lionel messi', 1, 3, 3),
(8, 'OPX008', 'Meilleur buteur de l\'histoire de la Coupe du Monde', 'Qui est le meilleur buteur de l\'histoire de la Coupe du Monde ?', 'miroslav klose', 2, 3, 1),
(9, 'OPX009', 'Gardien de but surnommé \"Spider-Man\"', 'Quel gardien de but est surnommé \"Spider-Man\" ?', 'Jordan Pickford', 3, 3, 1),
(10, 'OPX010', 'Club avec le plus de titres de Bundesliga en Allemagne ', 'Quel club a remporté le plus de titres de Bundesliga en Allemagne ?', 'bayern munich', 1, 4, 1),
(11, 'OPX011', 'Vainqueur du Soulier d\'Or européen en 2020 ', 'Qui a remporté le Soulier d\'Or européen en 2020 ?', 'ciro immobile', 2, 4, 1),
(12, 'OPX012', 'Club avec le plus de Scudetti en Serie A italienne', 'Quel club a remporté le plus de Scudetti en Serie A italienne ?', 'Juventus FC', 3, 4, 1),
(13, 'OPX013', 'Joueur souvent appelé \"CR7\"', 'Quel joueur est souvent appelé \"CR7\" ?', 'Cristiano Ronaldo', 1, 5, 1),
(14, 'OPX014', 'Gardien de but surnommé \"Spider-Man\" ', 'Quel gardien de but est surnommé \"Spider-Man\" ?', 'Jordan Pickford', 2, 5, 1),
(15, 'OPX015', 'Lieu de naissance de Lionel Messi', 'Dans quel pays Lionel Messi est-il né ?', 'Argentine', 3, 5, 1),
(20, 'OPX020', 'Durée réglementaire d\'un match de football !', 'Quelle est la durée réglementaire d\'un match de football lors des compétitions internationales telles que la Coupe du Monde de la FIFA?', '90 min', 3, 1, 3),
(21, 'OPX021', 'Tu touche le ballon, tu perds ce ballon !', 'Quel est le terme pour décrire le fait de toucher le ballon avec la main délibérément dans le football ?', 'main', 4, 1, 3),
(22, 'OPX022', 'Tu sors le ballon, tu perds ce ballon !', 'Quel est le terme pour décrire le fait de sortir le ballon du terrain ?', 'touche', 5, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `T_indice_ind`
--

CREATE TABLE `T_indice_ind` (
  `ind_id` int(11) NOT NULL,
  `ind_description` varchar(200) DEFAULT NULL,
  `ind_lien` varchar(200) DEFAULT NULL,
  `ind_difficulte` varchar(45) DEFAULT NULL,
  `etp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `T_indice_ind`
--

INSERT INTO `T_indice_ind` (`ind_id`, `ind_description`, `ind_lien`, `ind_difficulte`, `etp_id`) VALUES
(1, 'on a un carton jaune et un ', 'https://www.francebleu.fr/s3/cruiser-production/2015/10/6363e400-bed6-4a5e-8d6d-8fefb600863f/1200x680_maxsportsworldtwo237087.jpg', 'F', 1),
(2, 'Plus que 2 min', 'https://www.les-transferts.com/paris-sportifs/comment-parier/paris-sportifs-prolongations.html', 'M', 2),
(5, 'Meuilleur du monde', 'https://www.francebleu.fr/s3/cruiser-production/2015/10/6363e400-bed6-4a5e-8d6d-8fefb600863f/1200x680_maxsportsworldtwo237087.jpg', 'M', 7),
(6, 'Finaliste 2021 de champiions  league', 'https://www.francebleu.fr/s3/cruiser-production/2015/10/6363e400-bed6-4a5e-8d6d-8fefb600863f/1200x680_maxsportsworldtwo237087.jpg', 'F', 10),
(7, 'Portugais', 'https://www.francebleu.fr/s3/cruiser-production/2015/10/6363e400-bed6-4a5e-8d6d-8fefb600863f/1200x680_maxsportsworldtwo237087.jpg', 'D', 13),
(8, 'Plus que 2 min', 'http://www.amiensfootball.com/assets/uploads/images/news/max/Visuel_vestiaire-04_01.jpg', 'F', 2),
(10, 'on a un carton jaune et un ', 'https://www.safe-arbitres.fr/L-arbitre-3/Lois-du-jeu-899.html', 'M', 1),
(11, 'on a un carton jaune et un ', 'https://www.asscavaleblanchefootball.com/', 'D', 1),
(12, 'Plus que 2 min', 'https://youtu.be/LQXLEW8dMoc', 'D', 2),
(13, 'Un petit peu de base', 'https://www.football-stadiums.co.uk/articles/football-timings-and-match-lengths/', 'F', 20),
(14, 'Un petit peu de base', 'https://youtu.be/56AdTIwkJ2M', 'M', 20),
(15, 'Un petit peu de base', 'https://www.tiktok.com/@partidos.de.todo/video/7309726357284474117?is_from_webapp=1&sender_device=pc', 'D', 20),
(16, 'site pour voir une main', 'https://fr.123rf.com/photo_15347720_une-main-masser-autres-%C3%A0-l-int%C3%A9rieur.html', 'F', 21),
(17, 'site pour voir une main', 'https://support.apple.com/fr-fr/guide/iphone/iph145eba8e9/ios', 'M', 21),
(18, 'site pour voir une main', 'https://en.wikipedia.org/wiki/BMW_M1', 'D', 21),
(19, 'site pour penser a une touche', 'https://www.billionkeys.com/les-cles-de-la-reussite-techniqueextra-sportif-comment-reussir-une-touche-longue/', 'F', 22),
(20, 'site pour penser a une touche', 'https://momes.parents.fr/apprendre/matieres-scolaires/sciences/decouvrir-le-corps-humain/quest-ce-que-les-5-sens-849699', 'M', 22),
(21, 'site pour penser a une touche', 'https://conseilsport.decathlon.fr/apprendre-a-jouer-au-football', 'D', 22);

-- --------------------------------------------------------

--
-- Structure de la table `T_participant_par`
--

CREATE TABLE `T_participant_par` (
  `par_id` int(11) NOT NULL,
  `par_mail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `T_participant_par`
--

INSERT INTO `T_participant_par` (`par_id`, `par_mail`) VALUES
(1, 'ryhana1234@gmail.com'),
(2, 'karim@example.com'),
(3, 'camille@gmail.com'),
(4, 'rh@gmail.com'),
(7, 'rnl@gmail.com'),
(8, 'test@gmail.com'),
(9, 'hdhuhdh@gmail.com'),
(10, 'gmail@gmail.com'),
(11, 'ryhana_test_f@gmail.com'),
(12, 'gagner@gmail.com'),
(13, 'ryhana_test_f1@gmail.com'),
(14, 'aymen_nachid_test@gmail.com'),
(15, 'bravototo@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `T_profil_pfl`
--

CREATE TABLE `T_profil_pfl` (
  `cpt_id` int(11) NOT NULL,
  `pfl_nom` varchar(45) DEFAULT NULL,
  `pfl_prenom` varchar(45) DEFAULT NULL,
  `pfl_role` char(1) NOT NULL,
  `pfl_validite` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `T_profil_pfl`
--

INSERT INTO `T_profil_pfl` (`cpt_id`, `pfl_nom`, `pfl_prenom`, `pfl_role`, `pfl_validite`) VALUES
(1, 'admin', 'admin', 'A', '1'),
(2, 'aymen', 'nachid', 'O', '1'),
(3, 'LUCIE', 'PHILIPPE', 'O', '1'),
(4, 'test ', 'test', 'O', '0'),
(5, 'test\'aposthophe', 'test', 'O', '1'),
(7, 'Nachid', 'Aymen', 'O', '1'),
(8, 'leila', 'aziz', 'O', '1'),
(11, 'abdo', 'nachid', 'O', '1'),
(18, 'Nachid', 'Aymen', 'A', '1'),
(21, 'Batengue', 'Sanndo', 'O', '1'),
(22, 'test\'aposthophe', 'administrATeur', 'O', '1'),
(23, 'test\'aposthophe;', 'test\'aposthophe;;;', 'O', '1'),
(24, 'formulaire', 'formulaire', 'O', '1'),
(25, 'abcd', 'PHILIPPE', 'A', '1'),
(26, 'Nachid', 'Aymen', 'O', '0'),
(27, 'TEST_etape', 'test_etape', 'O', '1'),
(28, 'vm', 'vm', 'O', '1');

--
-- Déclencheurs `T_profil_pfl`
--
DELIMITER $$
CREATE TRIGGER `saler_hacher_mdp` AFTER INSERT ON `T_profil_pfl` FOR EACH ROW BEGIN
  DECLARE email_val VARCHAR(200);
  DECLARE mdp_val CHAR(64);

  SELECT cpt_email, cpt_mdp INTO email_val, mdp_val
  FROM T_compte_cpt
  WHERE cpt_id = NEW.cpt_id;

  CALL modifier_mdp_procedure(email_val, mdp_val);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `T_ressource_res`
--

CREATE TABLE `T_ressource_res` (
  `res_id` int(11) NOT NULL,
  `res_chemin` varchar(200) DEFAULT NULL,
  `res_type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `T_ressource_res`
--

INSERT INTO `T_ressource_res` (`res_id`, `res_chemin`, `res_type`) VALUES
(1, 'bootstrap/images/barcelona.jpg', 'img'),
(2, 'bootstrap/images/neymar.jpeg', 'img'),
(3, 'bootstrap/images/manc.jpg', 'img'),
(4, 'bootstrap/images/messi-2023.jpg', 'img'),
(5, 'bootstrap/images/messi-2023.jpg', 'img'),
(6, 'bootstrap/images/messi-2023.jpg', 'img'),
(7, 'bootstrap/images/messi-2023.jpg', 'img'),
(8, 'bootstrap/images/messi-2023.jpg', 'img'),
(9, 'bootstrap/images/messi-2023.jpg', 'img'),
(10, 'bootstrap/images/messi-2023.jpg', 'img'),
(11, 'bootstrap/images/messi-2023.jpg', 'img'),
(12, 'bootstrap/images/messi-2023.jpg', NULL),
(13, 'bootstrap/images/messi-2023.jpg', 'img');

-- --------------------------------------------------------

--
-- Structure de la table `T_reussite_reu`
--

CREATE TABLE `T_reussite_reu` (
  `sce_id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL,
  `reu_premiere_date` date NOT NULL,
  `reu_derniere_date` date NOT NULL,
  `reu_difficulte` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `T_reussite_reu`
--

INSERT INTO `T_reussite_reu` (`sce_id`, `par_id`, `reu_premiere_date`, `reu_derniere_date`, `reu_difficulte`) VALUES
(1, 8, '2023-12-08', '2023-12-13', 'F'),
(1, 9, '2023-12-08', '2023-12-13', 'F'),
(1, 10, '2023-12-08', '2023-12-13', 'F'),
(1, 11, '2023-12-11', '2023-12-13', 'F'),
(1, 12, '2023-12-12', '2023-12-13', 'F'),
(1, 13, '2023-12-13', '2023-12-13', 'F'),
(1, 14, '2023-12-13', '2023-12-13', 'F'),
(1, 15, '2023-12-13', '2023-12-13', 'F');

-- --------------------------------------------------------

--
-- Structure de la table `T_scenario_sce`
--

CREATE TABLE `T_scenario_sce` (
  `sce_id` int(11) NOT NULL,
  `sce_intitule` varchar(200) DEFAULT NULL,
  `sce_description` varchar(200) DEFAULT NULL,
  `sce_code` char(8) DEFAULT NULL,
  `sce_activite` char(1) DEFAULT NULL,
  `sce_image` varchar(200) NOT NULL,
  `cpt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `T_scenario_sce`
--

INSERT INTO `T_scenario_sce` (`sce_id`, `sce_intitule`, `sce_description`, `sce_code`, `sce_activite`, `sce_image`, `cpt_id`) VALUES
(1, 'QCM sur les règles du football', 'Testez vos connaissances sur les règles du football et tenter de gagner et remporter la premiere place', 'X1FOD01', '1', 'bootstrap/images/wc.jpg', 2),
(3, 'QCM sur les légendes du football', 'Testez vos connaissances sur les légendes du football et leur carrière.', 'X1FOD03', '0', 'bootstrap/images/sl.jpg', 2),
(4, 'QCM sur les trophé de football', 'Découvrez des faits intéressants sur les différentes coupes du monde de football.', 'X1FOD04', '1', 'bootstrap/images/wc.jpg', 2),
(5, 'QCM sur les joueurs ! ', 'Évaluez votre compréhension des règles d\'arbitrage dans le football.', 'X1FOD05', '1', 'bootstrap/images/messi.jpg', 2),
(6, 'testsansetape', 'pas d\'etape', 'X1FOD06', '1', 'bootstrap/images/manc.jpg', 3),
(24, 'aymentestttttttttttttttttt', 'nachiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiid', '00Eq8I0d', '0', 'images/img2.jpg', 3),
(33, 'l\'erreur', 'erreur', '00Yu2O3r', '1', 'images/souris.jpeg', 28);

--
-- Déclencheurs `T_scenario_sce`
--
DELIMITER $$
CREATE TRIGGER `generer_sce_code` BEFORE INSERT ON `T_scenario_sce` FOR EACH ROW BEGIN
    DECLARE new_id INT;
    DECLARE random_chars VARCHAR(6);
    -- Récupérer le nouvel ID à partir de la séquence AUTO_INCREMENT
    SET new_id = NEW.sce_id;
    -- Générer une chaîne aléatoire avec chiffres et lettres
    SET random_chars = CONCAT(
        CHAR(65 + ROUND(RAND() * 25)), -- Une lettre majuscule
        CHAR(97 + ROUND(RAND() * 25)), -- Une lettre minuscule
        ROUND(RAND() * 9), -- Un chiffre
        CHAR(65 + ROUND(RAND() * 25)), -- Une lettre majuscule
        ROUND(RAND() * 9), -- Un chiffre
        CHAR(97 + ROUND(RAND() * 25))  -- Une lettre minuscule
    );

    SET NEW.sce_code = CONCAT(new_id, random_chars);
    SET NEW.sce_code = LPAD(NEW.sce_code, 8, '0');
END
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `T_actualite_act`
--
ALTER TABLE `T_actualite_act`
  ADD PRIMARY KEY (`act_id`),
  ADD KEY `fk_t_actualite_act_t_compte_cpt` (`cpt_id`);

--
-- Index pour la table `T_compte_cpt`
--
ALTER TABLE `T_compte_cpt`
  ADD PRIMARY KEY (`cpt_id`);

--
-- Index pour la table `T_etape_etp`
--
ALTER TABLE `T_etape_etp`
  ADD PRIMARY KEY (`etp_id`),
  ADD KEY `fk_T_etapet_ept_T_ressource_res` (`res_id`),
  ADD KEY `fk_T_etape_etp_T_scenario_sce` (`sce_id`);

--
-- Index pour la table `T_indice_ind`
--
ALTER TABLE `T_indice_ind`
  ADD PRIMARY KEY (`ind_id`),
  ADD KEY `fk_T_indice_ind_T_etape_etp1_idx` (`etp_id`);

--
-- Index pour la table `T_participant_par`
--
ALTER TABLE `T_participant_par`
  ADD PRIMARY KEY (`par_id`);

--
-- Index pour la table `T_profil_pfl`
--
ALTER TABLE `T_profil_pfl`
  ADD PRIMARY KEY (`cpt_id`);

--
-- Index pour la table `T_ressource_res`
--
ALTER TABLE `T_ressource_res`
  ADD PRIMARY KEY (`res_id`);

--
-- Index pour la table `T_reussite_reu`
--
ALTER TABLE `T_reussite_reu`
  ADD PRIMARY KEY (`sce_id`,`par_id`),
  ADD KEY `fk_participant` (`par_id`);

--
-- Index pour la table `T_scenario_sce`
--
ALTER TABLE `T_scenario_sce`
  ADD PRIMARY KEY (`sce_id`),
  ADD KEY `fk_T_scenario_sce_T_compte_cpt` (`cpt_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `T_compte_cpt`
--
ALTER TABLE `T_compte_cpt`
  MODIFY `cpt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `T_participant_par`
--
ALTER TABLE `T_participant_par`
  MODIFY `par_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `T_scenario_sce`
--
ALTER TABLE `T_scenario_sce`
  MODIFY `sce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `T_actualite_act`
--
ALTER TABLE `T_actualite_act`
  ADD CONSTRAINT `fk_t_actualite_act_t_compte_cpt` FOREIGN KEY (`cpt_id`) REFERENCES `T_compte_cpt` (`cpt_id`);

--
-- Contraintes pour la table `T_etape_etp`
--
ALTER TABLE `T_etape_etp`
  ADD CONSTRAINT `fk_T_etape_etp_T_scenario_sce` FOREIGN KEY (`sce_id`) REFERENCES `T_scenario_sce` (`sce_id`),
  ADD CONSTRAINT `fk_T_etapet_ept_T_ressource_res` FOREIGN KEY (`res_id`) REFERENCES `T_ressource_res` (`res_id`);

--
-- Contraintes pour la table `T_indice_ind`
--
ALTER TABLE `T_indice_ind`
  ADD CONSTRAINT `fk_T_indice_ind_T_etape_etp1` FOREIGN KEY (`etp_id`) REFERENCES `T_etape_etp` (`etp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `T_profil_pfl`
--
ALTER TABLE `T_profil_pfl`
  ADD CONSTRAINT `fk_T_profil_pfl_T_compte_cpt` FOREIGN KEY (`cpt_id`) REFERENCES `T_compte_cpt` (`cpt_id`);

--
-- Contraintes pour la table `T_reussite_reu`
--
ALTER TABLE `T_reussite_reu`
  ADD CONSTRAINT `fk_T_reussite_reu_T_scenario_sce` FOREIGN KEY (`sce_id`) REFERENCES `T_scenario_sce` (`sce_id`),
  ADD CONSTRAINT `fk_participant` FOREIGN KEY (`par_id`) REFERENCES `T_participant_par` (`par_id`);

--
-- Contraintes pour la table `T_scenario_sce`
--
ALTER TABLE `T_scenario_sce`
  ADD CONSTRAINT `fk_T_scenario_sce_T_compte_cpt` FOREIGN KEY (`cpt_id`) REFERENCES `T_compte_cpt` (`cpt_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
