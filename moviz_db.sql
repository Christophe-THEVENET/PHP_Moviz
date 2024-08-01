-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : jeu. 01 août 2024 à 09:02
-- Version du serveur : 10.5.25-MariaDB-ubu2004
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `moviz_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `director`
--

CREATE TABLE `director` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(8, 'Jay', 'Cocks'),
(29, 'Quentin', 'Tarantino'),
(54, 'Luc', 'Besson');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `release_year` datetime NOT NULL,
  `synopsys` longtext NOT NULL,
  `duration` time DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_size` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`id`, `name`, `release_year`, `synopsys`, `duration`, `image_name`, `image_size`, `updated_at`) VALUES
(1, 'interstellar', '2014-11-05 00:00:00', 'Le film raconte les aventures d’un groupe d’explorateurs qui utilisent une faille récemment découverte dans l’espace-temps afin de repousser les limites humaines et partir à la conquête des distances astronomiques dans un voyage interstellaire. ', '02:49:00', '669f7b3c9dd88-interstellar-jpg', 35695, '2023-11-17 15:28:38'),
(2, 'inception', '2010-07-21 00:00:00', 'Dom Cobb est un voleur expérimenté – le meilleur qui soit dans l’art périlleux de l’extraction : sa spécialité consiste à s’approprier les secrets les plus précieux d’un individu, enfouis au plus profond de son subconscient, pendant qu’il rêve et que son esprit est particulièrement vulnérable. Très recherché pour ses talents dans l’univers trouble de l’espionnage industriel, Cobb est aussi devenu un fugitif traqué dans le monde entier qui a perdu tout ce qui lui est cher. Mais une ultime mission pourrait lui permettre de retrouver sa vie d’avant – à condition qu’il puisse accomplir l’impossible : l’inception. Au lieu de subtiliser un rêve, Cobb et son équipe doivent faire l’inverse : implanter une idée dans l’esprit d’un individu. S’ils y parviennent, il pourrait s’agir du crime parfait. Et pourtant, aussi méthodiques et doués soient ils, rien n’aurait pu préparer Cobb et ses partenaires à un ennemi redoutable qui semble avoir systématiquement un coup d’avance sur eux. Un ennemi dont seul Cobb aurait pu soupçonner l’existence. ', '02:28:00', '669f7b0e373fb-inception-jpg', 34018, '2023-11-17 15:43:15'),
(4, 'matrix', '1999-05-24 00:00:00', 'Programmeur anonyme dans un service administratif le jour, Thomas Anderson devient Neo la nuit venue. Sous ce pseudonyme, il est l\'un des pirates les plus recherchés du cyber-espace. A cheval entre deux mondes, Neo est assailli par d\'étranges songes et des messages cryptés provenant d\'un certain Morpheus. Celui-ci l\'exhorte à aller au-delà des apparences et à trouver la réponse à la question qui hante constamment ses pensées : qu\'est-ce que la Matrice ? Nul ne le sait, et aucun homme n\'est encore parvenu à en percer les defenses. Mais Morpheus est persuadé que Neo est l\'Elu, le libérateur mythique de l\'humanité annoncé selon la prophétie. Ensemble, ils se lancent dans une lutte sans retour contre la Matrice et ses terribles agents.', '02:15:00', '669f7ad6d9d3f-matrix-jpg', 34230, '2023-11-17 15:49:58'),
(6, 'oss 117, le caire nid d\'espions', '2006-04-19 00:00:00', 'Égypte, 1955, le Caire est un véritable nid d\'espions. Tout le monde se méfie de tout le monde, tout le monde complote contre tout le monde : Anglais, Français, Soviétiques, la famille du Roi déchu Farouk qui veut retrouver son trône, les Aigles de Kheops, secte religieuse qui veut prendre le pouvoir. Le Président de la République Française, Monsieur René Coty, envoie son arme maîtresse mettre de l\'ordre dans cette pétaudière au bord du chaos : Hubert Bonisseur de la Bath, dit OSS 117.', '01:39:00', '669f7aa9a5bb7-oss-lecaire-webp', 29558, '2023-11-18 13:47:59'),
(7, 'strange days', '1996-02-07 00:00:00', 'Los Angeles 1999. Lenny Nero, flic déchu, mi-dandy, mi-gangster, s\'est reconverti dans le trafic de vidéos très perfectionnées qui permettent de revivre n\'importe quelle situation par procuration. Un jour, il découvre une vidéo révélant l\'identité des meurtriers d\'un leader noir. ', '02:25:00', '669f7a6e123e6-strange-days-jpg', 34182, '2023-11-18 13:50:04'),
(11, 'l\'associé du diable', '1998-01-14 00:00:00', 'Kevin Lomax est un jeune avocat aussi doué que brillant, qui s\'enorgueillit de n\'avoir jamais perdu une seule affaire. Un jour, il est recruté à prix d\'or par un puissant cabinet new-yorkais qui défend des criminels odieux. Il devient vite le protégé du patron, John Milton, un homme énigmatique. Peu à peu, Lomax se laisse entièrement absorber par son travail et la personnalité fascinante de Milton. ', '02:20:00', '66a08328e702c-associe-diable-webp', NULL, NULL),
(13, 'Pulp Fiction', '1994-10-26 00:00:00', 'L\'odyssée sanglante et burlesque de petits malfrats dans la jungle de Hollywood à travers trois histoires qui s\'entremêlent. Dans un restaurant, un couple de jeunes braqueurs, Pumpkin et Yolanda, discutent des risques que comporte leur activité. Deux truands, Jules Winnfield et son ami Vincent Vega, qui revient d\'Amsterdam, ont pour mission de récupérer une mallette au contenu mystérieux et de la rapporter à Marsellus Wallace.', '02:29:00', '66a3c2740acbc-pulp-fiction-jpg', NULL, NULL),
(14, 'Terminator 2', '1991-10-16 00:00:00', 'En 1997, les survivants de l\'apocalypse nucléaire poursuivent une guerre sans merci contre les robots et machines qu\'ils ont eux-même créés. Pour en finir avec John Connor qui dirige la résistance des hommes, deux \"cyborgs\" sont envoyés dans le passé. Leur mission : abattre Connor enfant. Le premier modèle de la série \"Terminator\" a échoué en 1984. Le second, modèle plus performant en liquide métamorphosable, se lance à la poursuite de l\'enfant et de sa mère, Sarah, dans les années quatre-vingt-dix. De leur côté, les hommes du futur ont envoyé dans le passé un Terminator chargé de protéger le jeune Connor. Le duel des robots va prendre alors des allures titanesques. Et, tandis que l\'enfant enseignera à ce Terminator des rudiments d\'humanité, sa mère tentera par tous les moyens d\'empêcher la création des premières machines intelligentes. Avec l\'aide du Terminator qu\'ils ont éduqué, ils combattront pour influencer le futur...', '02:17:00', '66a3c26ba9735-terminator-2-jpg', NULL, NULL),
(40, 'Léon', '1994-09-14 00:00:00', 'Un tueur à gages répondant au nom de Léon prend sous son aile Mathilda, une petite fille de douze ans, seule rescapée du massacre de sa famille. Bientôt, Léon va faire de Mathilda une \"nettoyeuse\", comme lui. Et Mathilda pourra venger son petit frère...', '01:43:00', '66a7988954310-leon-jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `movie_director`
--

CREATE TABLE `movie_director` (
  `movie_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `movie_director`
--

INSERT INTO `movie_director` (`movie_id`, `director_id`) VALUES
(1, 2),
(2, 2),
(4, 4),
(4, 5),
(6, 6),
(6, 7),
(7, 1),
(7, 8),
(11, 3),
(13, 29),
(14, 1),
(40, 54);

-- --------------------------------------------------------

--
-- Structure de la table `movie_genre`
--

CREATE TABLE `movie_genre` (
  `movie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `movie_genre`
--

INSERT INTO `movie_genre` (`movie_id`, `genre_id`) VALUES
(1, 5),
(2, 5),
(2, 6),
(4, 2),
(4, 5),
(4, 6),
(6, 2),
(6, 4),
(7, 2),
(7, 5),
(11, 7),
(11, 8),
(13, 1),
(13, 6),
(13, 8),
(14, 2),
(14, 5),
(14, 6),
(40, 6),
(40, 8);

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `rate` smallint(6) NOT NULL,
  `review` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `approuved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `review`
--

INSERT INTO `review` (`id`, `user_id`, `movie_id`, `rate`, `review`, `created_at`, `approuved`) VALUES
(8, 7, 14, 5, 'toto totototo toto totototo toto totototo toto toto  toto totototototo totototo totototototo totototototo totototototototototototototototo toto totototototototototo totototototototototo toto tat tatatat tonton\r\n', '2024-07-29 11:35:34', 1),
(9, 10, 14, 4, 'Sed porttitor lectus nibh. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Sed porttitor lectus nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.', '2024-07-23 11:35:34', 1),
(20, 5, 14, 5, '“Terminator 2” est un chef-d’œuvre de science-fiction. Les effets spéciaux sont incroyables pour l’époque et l’histoire est captivante. Arnold Schwarzenegger est parfait dans son rôle.', '2024-07-31 12:00:54', 1),
(21, 7, 14, 4, 'Ce film est un classique absolu. L’action est non-stop et les scènes de poursuite sont époustouflantes. Linda Hamilton est impressionnante en tant que Sarah Connor.', '2024-07-31 12:04:05', 1),
(22, 27, 14, 4, 'Un film qui a marqué mon enfance. Les scènes d’action sont mémorables et la bande-son est parfaite. Un film que je pourrais regarder encore et encore.', '2024-07-31 12:07:34', 1),
(23, 27, 40, 3, '“Léon” est un film poignant et intense. La performance de Jean Reno en tant que tueur à gages au grand cœur est inoubliable. Natalie Portman brille dans son premier rôle.', '2024-07-31 12:09:31', 1),
(24, 11, 40, 4, 'Un chef-d’œuvre de Luc Besson. L’alchimie entre Léon et Mathilda est touchante et complexe. Gary Oldman est terrifiant en méchant.', '2024-07-31 12:10:33', 1),
(25, 5, 40, 4, 'Un film culte des années 90. La relation entre Léon et Mathilda est à la fois tendre et tragique. La réalisation de Besson est impeccable.', '2024-07-31 12:11:21', 1),
(26, 5, 13, 4, 'Un chef-d’œuvre cinématographique : Pulp Fiction est un film culte de Quentin Tarantino, mêlant violence et humour avec une narration non linéaire qui captive du début à la fin', '2024-07-31 13:36:54', 1),
(27, 11, 13, 5, 'Des dialogues mémorables : Les dialogues surréalistes et kitsch de Tarantino, ainsi que la bande sonore, rendent ce film inoubliable', '2024-07-31 13:37:52', 0),
(28, 7, 13, 3, 'Des performances exceptionnelles : Les performances de John Travolta, Samuel L. Jackson et Uma Thurman sont tout simplement magistrales, ajoutant une profondeur unique aux personnages', '2024-07-31 13:39:03', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `nickname`, `roles`, `created_at`) VALUES
(5, 'digitob@yahoo.com', '$2y$10$8ofXFDFp9jHMzU0AIe3h5.p7p4/LHizkriRUKlEPSu/hamZQ1RJzm', 'Digitob', 'ROLE_ADMIN', NULL),
(7, 'test1@test1.test1', '$2y$10$jH8N5S3NuNPRtB0eMlhETuxCPPtqxGXfHYJCFfURb.iT.dPgQ17v2', 'Test 1', 'ROLE_USER', NULL),
(9, 'test4@test4.test4', '$2y$10$A0vDzz.4OaquMBRzkVouNesnf0K2UddbMfxvxEyRZaMN1j9eYhWHC', 'Test 4', 'ROLE_USER', NULL),
(10, 'test5@test5.test5', '$2y$10$P.75hLV.nq0vB8ZjrqntUuSP6C.kDi.WhfOu.ZOeywacNi4LtG6.C', 'Test 5', 'ROLE_USER', NULL),
(11, 'test6@test6.test6', '$2y$10$8BCpKJ1EQojPaGZdRmE41uM1eUFNx/BHPPRNod7vgWDbwmGO3zE6K', 'Test 6', 'ROLE_USER', NULL),
(12, 'test@test.test', '$2y$10$lwdvqvvGuRBvuou3HOT88uwYSdPGq9ISFe3BYhaJoqe4Vh2lxj//m', 'Beta T1', 'ROLE_USER', NULL),
(17, 'toto@toto.toto', '$2y$10$MRfxesqQvLdnKgtBgddqgu74Zn/6cnkAMPrLheEL3pWpxVfKazBMq', 'Toto', 'ROLE_USER', '2024-07-16 08:15:32'),
(27, 'test3@test3.test3', '$2y$10$011r4RRqffOYfF2r/h.utuboBxZvJWRiBzLG1V21o3yHT9lIUfSUe', 'Beta T3', 'ROLE_ADMIN', '2024-07-17 08:08:48');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `movie_director`
--
ALTER TABLE `movie_director`
  ADD PRIMARY KEY (`movie_id`,`director_id`),
  ADD KEY `IDX_C266487D8F93B6FC` (`movie_id`),
  ADD KEY `IDX_C266487D899FB366` (`director_id`);

--
-- Index pour la table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD PRIMARY KEY (`movie_id`,`genre_id`),
  ADD KEY `IDX_FD1229648F93B6FC` (`movie_id`),
  ADD KEY `IDX_FD1229644296D31F` (`genre_id`);

--
-- Index pour la table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_794381C6A76ED395` (`user_id`),
  ADD KEY `IDX_794381C68F93B6FC` (`movie_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
