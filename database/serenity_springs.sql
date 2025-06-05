-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 05 juin 2025 à 13:38
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `serenity_springs`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idCommande` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `dateCommande` date NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `type`, `prix`, `dateCommande`, `quantite`) VALUES
(4, 'Céréales', 40.00, '2024-11-12', 15),
(5, 'Engrais', 300.00, '2024-11-11', 8),
(10, 'Fruit', 45.00, '2024-11-17', 5),
(11, 'Fruit', 50.00, '2024-11-17', 10),
(12, 'Fruit', 50.00, '2024-11-18', 10),
(13, 'Fruit', 20.00, '2024-11-18', 10),
(14, 'Légume', 90.00, '2024-11-21', 2),
(15, 'Légume', 33.00, '2024-10-30', 6),
(16, 'Légume', 50.00, '2024-11-13', 23),
(17, 'Fruit', 60.00, '2024-11-07', 45),
(18, 'Fruit', 20.00, '2024-12-10', 12),
(19, 'Légume', 4.00, '2024-11-29', 1),
(20, 'Fruit', 5.00, '2024-12-19', 13),
(21, 'Légume', 93.00, '2024-12-04', 30),
(22, 'Fruit', 37.00, '2024-12-21', 14),
(23, 'Fruit', 56.00, '2024-12-07', 14),
(24, 'Fruit', 66.00, '2024-12-19', 20),
(25, 'Légume', 24.00, '2024-12-16', 32),
(26, 'Légume', 77.00, '2024-12-27', 32),
(27, 'Légume', 77.00, '2024-12-05', 66),
(28, 'Fruit', 67.00, '2024-11-28', 51),
(29, 'Fruit', 69.00, '2024-12-09', 30),
(30, 'Légume', 12.00, '2024-12-18', 22),
(31, 'Légume', 22.00, '2024-12-19', 11);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `content`, `author_name`, `created_at`) VALUES
(56, 31, 'hhhhhhhhh', '', '2024-12-14 16:50:47'),
(60, 31, 'its so good', '', '2024-12-15 00:27:25'),
(61, 31, 'so good', '', '2024-12-15 00:28:06');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `Event_id` int(11) NOT NULL,
  `Event_name` varchar(128) NOT NULL,
  `Event_description` varchar(512) NOT NULL,
  `Event_date` datetime NOT NULL,
  `Event_location` varchar(512) NOT NULL,
  `Event_organizer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`Event_id`, `Event_name`, `Event_description`, `Event_date`, `Event_location`, `Event_organizer`) VALUES
(69, 'SIAMAP 2024', 'The International Agriculture and Fishing Machinery Fair showcasing modern agriculture and sustainable farming practices', '2024-12-21 00:00:00', 'Parc des Expositions du Kram, Tunis', 28),
(70, 'Foire Internationale de l’Olivier', 'An event focused on olive cultivation, production, and modern technologies for olive oil production.', '2024-03-25 09:00:00', 'Sfax International Fair, Sfax', 29),
(71, 'Agricultural Innovation Forum', 'A forum discussing digital transformation in Tunisian agriculture and investment opportunities.', '2024-06-10 08:30:00', 'Laico Hotel, Tunis', 30);

-- --------------------------------------------------------

--
-- Structure de la table `event_participations`
--

CREATE TABLE `event_participations` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `Event_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `event_participations`
--

INSERT INTO `event_participations` (`id`, `username`, `Event_id`, `email`) VALUES
(52, 'muralmak47@gmail.com', 0, '64'),
(56, 'mal', 64, 'molka.makri@esprit.tn'),
(79, 'molka.makri', 70, 'molkamk4@gmail.com'),
(80, 'molka.makri', 69, 'molkamk4@gmail.com'),
(81, 'molka.makri', 71, 'molkamk4@gmail.com'),
(82, 'molka.makri', 71, 'molkamk4@gmail.com'),
(83, 'molka.makri', 71, 'molka.makri@esprit.tn'),
(84, 'molka.makri', 71, 'molkamk4@gmail.com'),
(85, 'molka.makri', 71, 'molkamk4@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `organizers`
--

CREATE TABLE `organizers` (
  `Organizer_id` int(11) NOT NULL,
  `Organizer_name` varchar(255) NOT NULL,
  `Organizer_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `organizers`
--

INSERT INTO `organizers` (`Organizer_id`, `Organizer_name`, `Organizer_email`) VALUES
(28, 'APIA (Agence de Promotion des Investissements Agricoles)', 'info@apia.tn'),
(29, 'GDA Sidi Bouzid', 'gda.sidibouzid@gmail.com'),
(30, 'Chambre Syndicale des Producteurs d’Olivier', 'oliveproducers.sfax@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `idPaiement` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `datePayment` date NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `moyenPaiement` varchar(50) DEFAULT NULL,
  `numeroCarte` varchar(16) DEFAULT NULL,
  `statuspaiement` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`idPaiement`, `idCommande`, `datePayment`, `montant`, `moyenPaiement`, `numeroCarte`, `statuspaiement`) VALUES
(22, 3, '2024-11-23', 20.00, 'carte_credit', '1023456789014785', 'en_attente'),
(23, 3, '2024-11-24', 10.00, 'virement', '1234567891234567', 'en_cours'),
(24, 4, '2024-11-24', 12.00, 'virement', '1234567891234567', 'en_cours'),
(26, 3, '2024-11-27', 60.00, 'carte_credit', '1234567891234567', 'en_attente'),
(27, 3, '2024-11-22', 43.00, 'virement', '1234567891234567', 'en_attente'),
(28, 3, '2024-11-24', 110.00, 'carte_credit', '1234567891234567', 'en_attente'),
(29, 7, '2024-11-29', 70.00, 'virement', '1234567891234567', 'en_attente'),
(30, 3, '2024-11-25', 100.00, 'virement', '1234567891234567', 'en_attente'),
(33, 3, '2024-11-24', 33.00, 'paypal', '', 'en_attente'),
(34, 3, '2024-11-13', 12.00, 'virement', '5523112345678978', 'en_attente'),
(35, 3, '2024-11-13', 61.00, 'virement', '5523112345678978', 'en_attente'),
(36, 3, '2024-11-14', 57.00, 'paypal', '', 'en_attente'),
(37, 3, '2024-11-07', 66.00, 'paypal', '', 'en_attente'),
(38, 17, '2024-11-03', 97.00, 'virement', '1234567897894561', 'en_attente'),
(39, 16, '2024-11-30', 23.00, 'virement', '1234567891234567', 'en_attente'),
(40, 11, '2024-11-07', 62.00, 'paypal', '', 'en_attente'),
(41, 12, '2024-11-08', 40.00, 'paypal', '', 'en_attente'),
(42, 3, '2024-12-21', 54.00, 'paypal', '', 'en_attente'),
(43, 3, '2024-12-27', 55.00, 'paypal', '', 'en_attente'),
(44, 4, '2025-01-01', 66.00, 'paypal', '', 'en_attente'),
(53, 4, '2024-12-15', 55.00, 'virement', '1234567891234567', 'en_attente'),
(54, 8, '2024-12-27', 100.00, 'carte_credit', '1234567891234567', 'en_attente'),
(55, 10, '2024-12-08', 10.00, 'carte_credit', '1234567891234567', 'en_attente'),
(56, 4, '2024-12-02', 33.00, 'carte_credit', '1234567891234567', 'en_attente'),
(57, 4, '2024-12-08', 2.00, 'carte_credit', '1234567891234567', 'en_attente'),
(58, 16, '2024-12-18', 36.00, 'carte_credit', '1234567891234567', 'en_attente'),
(59, 11, '2025-01-01', 66.00, 'paypal', '', 'en_attente'),
(60, 4, '2024-12-13', 33.00, 'carte_credit', '1234567891234567', 'en_attente'),
(61, 14, '2024-12-13', 22.00, 'carte_credit', '1234567891234567', 'en_attente'),
(62, 3, '2024-12-19', 33.00, 'carte_credit', '1234567891234567', 'en_attente'),
(64, 14, '2024-12-11', 123.00, 'carte_credit', '1234567891234567', 'en_attente'),
(65, 14, '2024-12-11', 123.00, 'carte_credit', '1234567891234567', 'en_attente'),
(66, 14, '2024-12-11', 123.00, 'carte_credit', '1234567891234567', 'en_attente'),
(67, 17, '2024-12-20', 1.00, 'virement', '555555551522', 'en_cours'),
(68, 4, '2024-12-14', 23.00, 'virement', '2222222222222222', 'en_attente');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `image`, `image_path`, `likes`) VALUES
(31, 'nice products', 'nice products', '2024-12-14 16:34:18', NULL, '../../../uploads/1734194058_banner-image-1.jpg', 5),
(32, 'good events', 'good events keep going', '2024-12-14 16:51:06', NULL, '../../../uploads/1734195066_offer3.png', 0),
(34, 'nice marketplace', 'i really enjoy ur services', '2024-12-15 00:28:31', NULL, '../../../uploads/1734222511_87.jpg', 0),
(35, 'tttttttt', 'ffffffffffffff', '2024-12-16 09:07:58', NULL, '../../../uploads/1734340078_chad-stembridge--8FjF1p-aw0-unsplash.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `Product_id` int(11) NOT NULL,
  `Product_name` varchar(255) NOT NULL,
  `Product_description` varchar(512) NOT NULL,
  `Product_price` int(11) NOT NULL,
  `Product_categorie` int(11) NOT NULL,
  `Product_img` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`Product_id`, `Product_name`, `Product_description`, `Product_price`, `Product_categorie`, `Product_img`) VALUES
(23, 'bannana', 'its so delicious !!!!', 1, 20, 'products/bannana.png'),
(24, 'ORNAGE ', 'sweet oranges !!', 1, 20, 'products/orange.png'),
(25, 'cucumber', 'its great for salads !!! ', 1, 21, 'products/cucumber.png'),
(26, 'mashroom', 'good mashroom !!', 5, 21, 'products/mashroom.png'),
(28, 'solar dryer', 'Solar dryers are used to eliminate the moisture content from crops, vegetables, and fruits. The solar dryer consists of a box made up of easily available and cheap material like cement, galvanized iron, brick, and plywood. The top surface of the dryer is covered by transparent single and double-layered sheets.', 22, 24, 'products/solar-dryer.png'),
(31, 'dragon fruit', 'very exotic fruit', 5, 20, 'products/dragon-fruit.png');

-- --------------------------------------------------------

--
-- Structure de la table `products_categories`
--

CREATE TABLE `products_categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `category_img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products_categories`
--

INSERT INTO `products_categories` (`category_id`, `category`, `category_img`) VALUES
(20, 'fruits', ''),
(21, 'vegetables', ''),
(24, 'materials', '/categories/materials');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `review_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `rating`, `review_text`, `created_at`) VALUES
(5, 23, 5, 'This product is amazing! The quality exceeded my expectations. Totally worth the price.', '2024-11-30 15:25:25'),
(6, 23, 4, 'Good product, but the packaging could have been better. Still a great buy!', '2024-11-30 15:25:25'),
(7, 24, 3, 'The product is decent, but it didn’t meet all of my expectations. The build quality could be better.', '2024-11-30 15:25:25'),
(8, 25, 5, 'Absolutely love it! The features are great and it works as expected. Highly recommend!', '2024-11-30 15:25:25'),
(9, 23, 1, 'kjkj', '2024-11-30 15:30:42'),
(10, 28, 5, 'amazing product !!', '2024-11-30 15:50:02'),
(11, 28, 3, 'decent product .', '2024-11-30 16:16:32'),
(12, 28, 5, 'pretty good product !!!!', '2024-12-01 17:52:53'),
(13, 28, 4, 'great', '2024-12-01 19:03:52'),
(14, 28, 4, 'great product', '2024-12-02 06:39:40'),
(15, 28, 3, 'average', '2024-12-02 07:24:36'),
(16, 31, 5, 'great product !!', '2024-12-09 07:08:34'),
(17, 31, 1, 'bad', '2024-12-09 07:08:46'),
(18, 26, 3, 'chayy majet chay', '2024-12-12 18:26:21'),
(19, 25, 5, 'nice product❤️', '2024-12-15 01:29:19'),
(20, 23, 5, 'good product❤️', '2024-12-15 12:58:27'),
(21, 31, 4, 'good', '2024-12-16 08:57:28');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_type_id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `contact` varchar(500) NOT NULL,
  `photo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`service_id`, `service_type_id`, `nom`, `contact`, `photo`) VALUES
(17, 2, 'Molka Makri', '213225', 'uploads\\service1.jpg'),
(20, 1, 'mounir', '555555', 'service1'),
(21, 1, 'moenes', '555555', 'service1.jpg\"'),
(22, 1, 'Molka Makri', '21322541', 'service2.jp'),
(23, 1, 'salmatt', '44444', ''),
(24, 26, 'aaaaaaaaaaaaaaaa', '64564563', '');

-- --------------------------------------------------------

--
-- Structure de la table `service_types`
--

CREATE TABLE `service_types` (
  `service_type_id` int(50) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `service_types`
--

INSERT INTO `service_types` (`service_type_id`, `type_name`) VALUES
(1, 'vétérinaire'),
(2, 'médecin d\'urgence'),
(3, 'Spécialiste des plantes\r\n'),
(4, 'Demander un avis rapide'),
(26, 'salmatt');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT '0',
  `roleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `email`, `mdp`, `role`, `roleName`) VALUES
(40, 'g', 'b@gmail.Com', '$2y$10$UcKfg9dnQVQPNH20Cql6sOrAJbn0p.3MZ56utGqYJu0TywmEU7oYG', '2', ''),
(41, 'BBB', 'BOK@GMAIL.Com', '$2y$10$pNiEDQyCcsikeAg6PXwfVOQinn874fwZVOM88ejxnWoc/NpfOWnfe', '2', ''),
(43, 'vv', 'vv@gmail.COM', '$2y$10$Oxes/F9PAtmhrI5FW5CVfefBiSPGF23q.o7BBjLQJ30p5PhjH6qlO', '2', ''),
(44, 'NN', 'NN@GMAILt.TN', '$2y$10$VW5GlE6ZXdJ7I0UEi0MJbuOPaA63Hki9.7g6x0Bw8aYBgaTIDVvQe', '2', ''),
(45, 'SALMA', 'SALMA@GM.TN', '$2y$10$wtT0uhd1yDd8mJ./MmDSx.YDh1L2nWNKPIfWx1e0v5a5s3lAoIn.y', '1', ''),
(47, 'SSSSS', 'PFF@GMAIL;.com', '$2y$10$haWWaVC0AacBnPXzjvVs7.oop.IOOjp8p58.MnaTwBntmw2BWkFv.', '2', ''),
(54, 'Molka Makri', 'molkamk4@gmail.com', '$2y$10$UkhnHE/kYZB1WcVGgZUfMO7fEFLxIIwMAgdCvXENhESAWFFsvIUzm', '2', ''),
(55, 'Molka Makri', 'molka.makri@ieee.org', '$2y$10$il3a8O4jkyP2vQgPJWvBAuCwQTA8HQL7pBdrEB5c1zD/4.39lq/wq', '2', ''),
(56, 'salmatt', 'salmatt@gmail.com', '$2y$10$fjXREzIPGKVPOc0JpwkQUeCPLJqnTMAdlO.PT.EnL74ptCnvy2gUG', '1', '');

-- --------------------------------------------------------

--
-- Structure de la table `users_roles`
--

CREATE TABLE `users_roles` (
  `Role_id` int(11) NOT NULL,
  `RoleName` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`Event_id`),
  ADD KEY `fk_event_organizer` (`Event_organizer`);

--
-- Index pour la table `event_participations`
--
ALTER TABLE `event_participations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_participations_ibfk_1` (`Event_id`);

--
-- Index pour la table `organizers`
--
ALTER TABLE `organizers`
  ADD PRIMARY KEY (`Organizer_id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`idPaiement`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Product_id`),
  ADD KEY `fk_product_category` (`Product_categorie`);

--
-- Index pour la table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `fk_service_type` (`service_type_id`);

--
-- Index pour la table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`service_type_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `users_roles`
--
ALTER TABLE `users_roles`
  ADD KEY `id` (`Role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `Event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `event_participations`
--
ALTER TABLE `event_participations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `organizers`
--
ALTER TABLE `organizers`
  MODIFY `Organizer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `idPaiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `service_type_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_event_organizer` FOREIGN KEY (`Event_organizer`) REFERENCES `organizers` (`Organizer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `event_participations`
--
ALTER TABLE `event_participations`
  ADD CONSTRAINT `event_participations_ibfk_1` FOREIGN KEY (`Event_id`) REFERENCES `events` (`Event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`Product_categorie`) REFERENCES `products_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`Product_id`);

--
-- Contraintes pour la table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_service_type` FOREIGN KEY (`service_type_id`) REFERENCES `service_types` (`service_type_id`);

--
-- Contraintes pour la table `users_roles`
--
ALTER TABLE `users_roles`
  ADD CONSTRAINT `users_roles_ibfk_1` FOREIGN KEY (`Role_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
