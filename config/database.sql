-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 23 oct. 2023 à 13:50
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pti-cuisto`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(100) DEFAULT NULL,
  `cat_desc` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `com_date` datetime NOT NULL DEFAULT current_timestamp(),
  `com_title` varchar(256) DEFAULT NULL,
  `com_content` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `ing_id` int(11) NOT NULL,
  `ing_title` varchar(100) DEFAULT NULL,
  `ing_desc` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ingredients_list`
--

CREATE TABLE `ingredients_list` (
  `rec_id` int(11) NOT NULL DEFAULT 0,
  `ing_id` int(11) NOT NULL DEFAULT 0,
  `ing_quantity` double NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `lik_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL DEFAULT 0,
  `rec_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

CREATE TABLE `recipes` (
  `rec_id` int(11) NOT NULL,
  `rec_title` varchar(200) DEFAULT NULL,
  `rec_content` varchar(300) DEFAULT NULL,
  `rec_summary` varchar(300) DEFAULT NULL,
  `com_id` int(11) NOT NULL DEFAULT 0,
  `cat_id` int(3) NOT NULL DEFAULT 0,
  `rec_creation_date` datetime NOT NULL DEFAULT current_timestamp(),
  `rec_image_src` varchar(100) DEFAULT NULL,
  `rec_modification_date` datetime DEFAULT NULL,
  `users_id` int(3) NOT NULL DEFAULT 0,
  `rec_nb_person` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(3) NOT NULL,
  `tag_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tags_list`
--

CREATE TABLE `tags_list` (
  `tag_id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_pseudo` varchar(25) DEFAULT NULL,
  `users_email` varchar(100) DEFAULT NULL,
  `users_password` char(64) NOT NULL,
  `users_surname` varchar(100) DEFAULT NULL,
  `users_name` varchar(100) DEFAULT NULL,
  `users_inscription_date` date DEFAULT NULL,
  `users_type` int(1) NOT NULL DEFAULT 0,
  `users_status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ing_id`);

--
-- Index pour la table `ingredients_list`
--
ALTER TABLE `ingredients_list`
  ADD KEY `fk_foreign_rec_id` (`rec_id`),
  ADD KEY `fk_foreign_ing_id` (`ing_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`lik_id`),
  ADD KEY `fk_likes_users_id` (`users_id`),
  ADD KEY `fk_likes_rec_id` (`rec_id`);

--
-- Index pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`rec_id`),
  ADD KEY `fk_foreign_cat_id` (`cat_id`),
  ADD KEY `fk_foreign_users_id` (`users_id`),
  ADD KEY `fk_comments_com_id` (`com_id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Index pour la table `tags_list`
--
ALTER TABLE `tags_list`
  ADD KEY `fk_foreign_tag_id` (`tag_id`),
  ADD KEY `fk_tag_rec_id` (`rec_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `lik_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ingredients_list`
--
ALTER TABLE `ingredients_list`
  ADD CONSTRAINT `fk_foreign_ing_id` FOREIGN KEY (`ing_id`) REFERENCES `ingredient` (`ing_id`),
  ADD CONSTRAINT `fk_foreign_rec_id` FOREIGN KEY (`rec_id`) REFERENCES `recipes` (`rec_id`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likes_rec_id` FOREIGN KEY (`rec_id`) REFERENCES `recipes` (`rec_id`),
  ADD CONSTRAINT `fk_likes_users_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Contraintes pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_comments_com_id` FOREIGN KEY (`com_id`) REFERENCES `comments` (`com_id`),
  ADD CONSTRAINT `fk_foreign_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`),
  ADD CONSTRAINT `fk_foreign_users_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Contraintes pour la table `tags_list`
--
ALTER TABLE `tags_list`
  ADD CONSTRAINT `fk_foreign_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`),
  ADD CONSTRAINT `fk_tag_rec_id` FOREIGN KEY (`rec_id`) REFERENCES `recipes` (`rec_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;