-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 16 fév. 2021 à 09:51
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pizzacrud`
--

-- --------------------------------------------------------

--
-- Structure de la table `pizza_list`
--

DROP TABLE IF EXISTS `pizza_list`;
CREATE TABLE IF NOT EXISTS `pizza_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pizza_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pizza_inventor` int(11) NOT NULL,
  `ingredient` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients_pate_pizza` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `faconnage_pate_pizza` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients_garniture` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `realisation_piza` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pizza_list`
--

INSERT INTO `pizza_list` (`id`, `pizza_name`, `pizza_inventor`, `ingredient`, `ingredients_pate_pizza`, `faconnage_pate_pizza`, `ingredients_garniture`, `realisation_piza`) VALUES
(3, 'la meilleur pizza de la terrre du monde entier et mÃªme encore plus n importe quoi', 15, '<>>>><<>><>>>>>>>><<<<>>><<>>><<<|||||||||||||||||', '', '', '', ''),
(2, 'la meilleur pizza de la terrre du monde entier et mÃªme encore plus n importe quoi', 15, 'Â§mlkiuyjgftdsq<wxscdfvghjklmÃ¹kjhgfdswx<xcvbhn,jkl:m!kjhgfdcsxw<xcvbn,;:!;kj,hgfdsqsdcnb,;:!lkjhgfdsq>WXScdvb', '', '', '', ''),
(22, '2', 16, '2', '', '', '', ''),
(23, '3', 16, '3', '', '', '', ''),
(24, '4', 16, '4', '', '', '', ''),
(49, '6', 31, '6', '', '', '', ''),
(48, '5', 31, '5', '', '', '', ''),
(6, 'monde entier', 16, 'triple fromages ,  hjknj ', '', '', '', ''),
(11, 'rrrrrr', 16, 'mlkjhgvc', '', '', '', ''),
(47, '4', 31, '4', '', '', '', ''),
(46, '3', 31, '3', '', '', '', ''),
(19, 'saumon', 16, 'saumon', '', '', '', ''),
(44, '1', 31, '1', '', '', '', ''),
(40, '9', 31, '9', '', '', '', ''),
(41, '10', 31, '10', '', '', '', ''),
(45, '2', 31, '2', '', '', '', ''),
(43, '12', 31, '12', '', '', '', ''),
(54, '10', 31, '10', '', '', '', ''),
(55, '11', 31, '11', '', '', '', ''),
(56, '12', 31, '12', '', '', '', ''),
(57, '13', 31, '13', '', '', '', ''),
(58, '14', 31, '14', '', '', '', ''),
(59, '15', 31, '15', '', '', '', ''),
(60, '16', 31, '16', '', '', '', ''),
(61, '17', 31, '17', '', '', '', ''),
(62, '18', 31, '18', '', '', '', ''),
(63, '19', 31, '19', '', '', '', ''),
(64, '20', 31, '20', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmation_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `remember_token` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `confirmation_token`, `confirmed_at`, `reset_token`, `reset_at`, `remember_token`) VALUES
(16, 'Alex', 'alexandre.fournier@yahoo.fr', '$2y$10$DfjlHPlsIdcnEdFZZhLwoOrusQUXVJUN7zHebIsr7o3cXWHlv9Ja6', NULL, '2020-11-06 22:20:57', 'Pqp445ZU5LOTTuHhR5S5VZDQ3UG2dRSaub4OiJV4rV9PgOc7w9inTo53Lt6X', '2020-12-14 11:00:43', NULL),
(17, 'Alex2', 'alere.fournier@yahoo.fr', '$2y$10$kZBCm397HO6V..w0dD0aa.9QAhkEhphugKUzn60SSO6i0QXPfvIii', 'NCmcwi6MsyKTlWjQMOAzwjON7dPXpWq8xZBFciW2mkbjrLCUvGw0hdynAMIN', NULL, NULL, NULL, NULL),
(18, 'alexandrecuisine', 'agfdandre.fournier@yahoo.fr', '$2y$10$lUJ5crsHkzVTppU7oz6kbumEDeMfKEokH9rf82ro/wRLHRn40afCu', '7YIiokPtS5i4vkB3ZnzSQlSmBcJnqX2T91xBbrBmFGZNV9qzLXaea0L7C5Y6', NULL, NULL, NULL, NULL),
(19, '1', 'a.a@a.a', '$2y$10$Qz4xF05wg7njhu8v98pWUer0HgN4DgpDVr/XoiF1IsqSaSIsioj6q', 'Q3oLcwj3PWmgai8AtagbGt4YFznOY7KEte9UVSmsI4YQAgpuwSD1RHyQ9nzn', NULL, NULL, NULL, NULL),
(20, '2222', '2.2@2.fr', '$2y$10$7MuqTRDUQKmZoc1sBJvw5O4JBxHmJc3gW6cNJD3DaA.vpVEdhS70.', 'RHiVdJCGZ9wLcP8MIVW4x0THOifOsmxRUVVPE1zL3bZaqPHj5iyKBiBangok', NULL, NULL, NULL, NULL),
(21, '3', '3.3@3.fr', '$2y$10$p1k4SOkw06QgHEAQ2axiGuv3.NOMwMCL/MONlP8Wca9qQbH8zwa9.', 'l8knd3g3fNWeYx4QqKLqXuM6TkX59dUZTilX4Fgt3nk0Eh0kJRGozxYNzOop', NULL, NULL, NULL, NULL),
(22, '14', '14.14@14.fr', '$2y$10$1N.u8eSKHO8c2Uro87GOH.T2BIA4BHaALSstVFs8EiUV4jpSPqgIa', 'Lyo6JZxIYjZf6MnWFwb1YVFIZ2lQpZ7j22lzIqyTi0iyhWMEFicgvTPCZz8h', NULL, NULL, NULL, NULL),
(23, '141', '141.141@141.fr', '$2y$10$fnJdeakvbySqcxN761TjrOUurSmTYzYMdKBhS3r45j78LXMzDRnS2', 'h1OPAL6A3crOzhq3uKm8djdUlkE6ldt7gQF4GbNn197Jj8SMhZqpcHTqmQNa', NULL, NULL, NULL, NULL),
(24, '5', '5.5@5.fr', '$2y$10$b.GWsW1uH90X2nD62EC4Su14eRFtYXaY5MMGNxCa3fxcMnx4HdPQq', 'UwSvNcACbbzDylzgo5RfgxAluuZiROE606jeC4MEERZPbWNyB8Kou28z2jpR', NULL, NULL, NULL, NULL),
(25, '6', '6.6@6.fr', '$2y$10$sTw3LHtDZ9MViY/zNAC.eu9vsRB51.AaV0Y9QrJ14kvoxYUzkWkNy', 'JDDjCLrF1I6fsppMDii6889lRzLDgckt6UDbpzSTHMdNG77YChKrI6Ys2ply', NULL, NULL, NULL, NULL),
(26, '8', '8.8@8.fr', '$2y$10$h3Tf5IY3pV9gGY2ZoUYUU.In/.DNnHBpSKUCrth5ZIX4.9Xnyneei', 'HPj0AXPLg8mkiRs5yBtunX5vuRrVdyyIwFGX7g2HHaRm57w9hUcDj9dAtRAx', NULL, NULL, NULL, NULL),
(27, '9', '9.9@9.fr', '$2y$10$tczNfDLRn9MN08YDcs.Ly.HldxlfQWrMmIe/Xo9IQLoCRAoHbDtvy', 'wG21Shsj3Jz7mwc1Ie3NptoC28uhzLSCXz4Yuhva2KOBLf9lcbrTGzsqmdPL', NULL, NULL, NULL, NULL),
(28, '10', '10.10@10.fr', '$2y$10$jKCNV8kygXl9KKw1/ilOHO8O516ECmMurpoCNg8GR52TcY1r04WLa', 'J2JPE6WR15kTPUCkPQDnWSvlSrKbRmPzHu1YKiwzL1eg7Z2IAUIGJJeESW89', NULL, NULL, NULL, NULL),
(29, '11', '11.11@11.fr', '$2y$10$QvyCAkmtxYWuVcw847yfhutadbRGenHYB0vNMYsasPr/ygqmZdlyW', 'Biw0uu3LMAuD8WDoXu3CmF9mFyGWZRSOEAatHl713UzBltG0pMGUI9WyrUyn', NULL, NULL, NULL, NULL),
(30, '111', '111.111@111.fr', '$2y$10$/e/uczdT010L4Es.mlBRteaUlVi1IBgImBw9CLPcX1yPJn.Gvrgp.', 'XZJWjdcqW8AH1FZmyFnS1GISETNKS7uEDbheAEV9OvLheVIxU9pazHMv9OLP', NULL, NULL, NULL, NULL),
(31, 'AFournierDev', 'ae.fier@yahoo.fr', '$2y$10$MvJwcy2dblqITx7earZdZezReniIL.yWqRjwLJ00Il/5T0.pyLAIq', NULL, '2020-11-10 11:32:31', NULL, NULL, NULL),
(32, 'dfdfdffdfdfd', 'dffddfdf@dfdf.dfdf', '$2y$10$tlO4bknbQ6x5LPkPKhHgwu5D9SdGHp4MyJLy9ixqzKii3MsvrHbX6', NULL, '2020-11-10 12:00:22', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
