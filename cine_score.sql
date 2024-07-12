-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 12 juil. 2024 à 12:33
-- Version du serveur : 10.10.2-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cine_score`
--

-- --------------------------------------------------------

--
-- Structure de la table `director`
--

DROP TABLE IF EXISTS `director`;
CREATE TABLE IF NOT EXISTS `director` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `director`
--

INSERT INTO `director` (`id`, `first_name`, `last_name`) VALUES
(1, 'James', 'Cameron'),
(2, 'Christopher', 'Nolan'),
(3, 'Taylor', 'Hackford'),
(4, 'Lana', 'Wachowski'),
(5, 'Lilly', 'Wachowski'),
(6, 'Jean-François', 'Halin'),
(7, 'Michel', 'Hazanavicius'),
(8, 'Jay', 'Cocks');

-- --------------------------------------------------------


-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Policier'),
(2, 'Action'),
(3, 'Horreur'),
(4, 'Comédie'),
(5, 'Science-Fiction'),
(6, 'Thriller'),
(7, 'Fantastique'),
(8, 'Drame');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `release_year` date NOT NULL,
  `synopsys` longtext NOT NULL,
  `duration` time DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_size` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`id`, `name`, `release_year`, `synopsys`, `duration`, `image_name`, `image_size`, `updated_at`) VALUES
(1, 'interstellar', '2014-11-05', '<div>&nbsp;Le film raconte les aventures d’un <strong>groupe d’explorateurs</strong> qui utilisent une faille récemment découverte dans l’espace-temps afin de repousser les limites humaines et partir à la conquête des distances astronomiques dans un<strong> voyage interstellaire</strong>.&nbsp;</div>', '02:49:00', 'affiche-interstellar-655786a686987571282254.jpg', 35695, '2023-11-17 15:28:38'),
(2, 'inception', '2010-07-21', '<div>&nbsp;Dom Cobb est un voleur expérimenté – le meilleur qui soit dans l’art périlleux de l’extraction : sa spécialité consiste à s’approprier les secrets les plus précieux d’un individu, enfouis au plus profond de son subconscient, pendant qu’il rêve et que son esprit est particulièrement vulnérable. Très recherché pour ses talents dans l’univers trouble de l’espionnage industriel, Cobb est aussi devenu un fugitif traqué dans le monde entier qui a perdu tout ce qui lui est cher. Mais une ultime mission pourrait lui permettre de retrouver sa vie d’avant – à condition qu’il puisse accomplir l’impossible : l’inception. Au lieu de subtiliser un rêve, Cobb et son équipe doivent faire l’inverse : implanter une idée dans l’esprit d’un individu. S’ils y parviennent, il pourrait s’agir du crime parfait. Et pourtant, aussi méthodiques et doués soient-ils, rien n’aurait pu préparer Cobb et ses partenaires à un ennemi redoutable qui semble avoir systématiquement un coup d’avance sur eux. Un ennemi dont seul Cobb aurait pu soupçonner l’existence.&nbsp;</div>', '02:28:00', 'affiche-inception-65578a137f4f6002204447.jpg', 34018, '2023-11-17 15:43:15'),
(3, 'l\'associé du diable', '1998-01-14', '<div>&nbsp;Kevin Lomax est un jeune avocat aussi doué que brillant, qui s\'enorgueillit de n\'avoir jamais perdu une seule affaire. Un jour, il est recruté à prix d\'or par un puissant cabinet new-yorkais qui défend des criminels odieux. Il devient vite le protégé du patron, John Milton, un homme énigmatique. Peu à peu, Lomax se laisse entièrement absorber par son travail et la personnalité fascinante de Milton.&nbsp;</div>', '02:20:00', 'affiche-associe-diable-65578ade3e362930712650.png', 26520, '2023-11-17 15:46:38'),
(4, 'matrix', '1999-05-24', '<div>&nbsp;Programmeur anonyme dans un service administratif le jour, Thomas Anderson devient Neo la nuit venue. Sous ce pseudonyme, il est l\'un des pirates les plus recherchés du cyber-espace. A cheval entre deux mondes, Neo est assailli par d\'étranges songes et des messages cryptés provenant d\'un certain Morpheus. Celui-ci l\'exhorte à aller au-delà des apparences et à trouver la réponse à la question qui hante constamment ses pensées : qu\'est-ce que la Matrice ? Nul ne le sait, et aucun homme n\'est encore parvenu à en percer les defenses. Mais Morpheus est persuadé que Neo est l\'Elu, le libérateur mythique de l\'humanité annoncé selon la prophétie. Ensemble, ils se lancent dans une lutte sans retour contre la Matrice et ses terribles agents...&nbsp;</div>', '02:15:00', 'affiche-matrix-65578ba629b36733480271.jpg', 34230, '2023-11-17 15:49:58'),
(6, 'oss 117, le caire nid d\'espions', '2006-04-19', '<div>&nbsp;Égypte, 1955, le Caire est un véritable nid d\'espions.<br>Tout le monde se méfie de tout le monde, tout le monde complote contre tout le monde : Anglais, Français, Soviétiques, la famille du Roi déchu Farouk qui veut retrouver son trône, les Aigles de Kheops, secte religieuse qui veut prendre le pouvoir. Le Président de la République Française, Monsieur René Coty, envoie son arme maîtresse mettre de l\'ordre dans cette pétaudière au bord du chaos : Hubert Bonisseur de la Bath, dit OSS 117.&nbsp;</div>', '01:39:00', 'affiche-oss117-6558c08ef3ee8300322458.png', 29558, '2023-11-18 13:47:59'),
(7, 'strange days', '1996-02-07', '<div>&nbsp;Los Angeles 1999. Lenny Nero, flic déchu, mi-dandy, mi-gangster, s\'est reconverti dans le trafic de vidéos très perfectionnées qui permettent de revivre n\'importe quelle situation par procuration. Un jour, il découvre une vidéo révélant l\'identité des meurtriers d\'un leader noir.&nbsp;</div>', '02:25:00', 'affiche-strangedays-6558c10cb011b050572763.jpg', 34182, '2023-11-18 13:50:04');

-- --------------------------------------------------------

--
-- Structure de la table `movie_director`
--

DROP TABLE IF EXISTS `movie_director`;
CREATE TABLE IF NOT EXISTS `movie_director` (
  `movie_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_id`,`director_id`),
  KEY `IDX_C266487D8F93B6FC` (`movie_id`),
  KEY `IDX_C266487D899FB366` (`director_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `movie_director`
--

INSERT INTO `movie_director` (`movie_id`, `director_id`) VALUES
(1, 2),
(2, 2),
(3, 3),
(4, 4),
(4, 5),
(6, 6),
(6, 7),
(7, 1),
(7, 8);

-- --------------------------------------------------------

--
-- Structure de la table `movie_genre`
--

DROP TABLE IF EXISTS `movie_genre`;
CREATE TABLE IF NOT EXISTS `movie_genre` (
  `movie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_id`,`genre_id`),
  KEY `IDX_FD1229648F93B6FC` (`movie_id`),
  KEY `IDX_FD1229644296D31F` (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `movie_genre`
--

INSERT INTO `movie_genre` (`movie_id`, `genre_id`) VALUES
(1, 5),
(2, 5),
(2, 6),
(3, 7),
(4, 2),
(4, 5),
(6, 2),
(6, 4),
(7, 2),
(7, 5);

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `rate` smallint(6) NOT NULL,
  `review` longtext DEFAULT NULL,
  `approuved` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_794381C6A76ED395` (`user_id`),
  KEY `IDX_794381C68F93B6FC` (`movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `review`
--

INSERT INTO `review` (`id`, `user_id`, `movie_id`, `rate`, `review`, `approuved`) VALUES
(1, 2, 2, 4, 'très bon film', 0),
(2, 2, 3, 4, 'flippant ce film. Les acteurs sont très bon', 0),
(3, 4, 3, 5, 'Excellent film qui donne envie de croire au diable', 0),
(4, 3, 3, 4, 'j\'ai adoré. Des frissons du début a la fin.', 0),
(5, 4, 7, 3, 'film d\'anticipation totalement d\'actualité en 2023', 0),
(6, 3, 7, 4, 'Vision du futur réaliste.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nickname`) VALUES
(2, 'admin@admin.fr', '[\"ROLE_ADMIN\"]', '$2y$13$2gDhA9w6EWsMmOB0x4IvcOLgQDSLRGlSF5Rl6cHpXZa7OKQtURY3m', 'Jean-Tobal'),
(3, 'test1@test1.test1', '[]', '$2y$13$TxFRC8j0yYFtHr1hQivE7O4N4ZR4xsNCCDz3bCOzDMy17HKSFVU.m', 'Test 1'),
(4, 'bradgarlinhouse@ripple.com', '[]', '$2y$13$NcZoovF/c38oSzgtbS3seeFw00dzdVx0fLlg3PbiN9.Xke5mL9zby', 'Bradley');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `movie_director`
--
ALTER TABLE `movie_director`
  ADD CONSTRAINT `FK_C266487D899FB366` FOREIGN KEY (`director_id`) REFERENCES `director` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C266487D8F93B6FC` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD CONSTRAINT `FK_FD1229644296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FD1229648F93B6FC` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_794381C68F93B6FC` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `FK_794381C6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
