-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2025 at 07:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appli_tourisme`
--

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `nom` varchar(1000) NOT NULL,
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` int(10) NOT NULL,
  `avis` varchar(2083) NOT NULL,
  `pseudo` varchar(1000) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `code_postal` int(10) NOT NULL,
  `ville` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`nom`, `id`, `date`, `note`, `avis`, `pseudo`, `type`, `code_postal`, `ville`) VALUES
('Les Gites de Clairier', 0, '2025-01-09', 2, 'ml', 'lm', '', 0, ''),
('Chez Lola', 0, '2025-01-23', 1, 'chez nawal est mieux', 'nawal lol', '', 0, ''),
('Chez Lola', 0, '2025-01-23', 1, 'chez nawal est mieux', 'nawal lol', '', 0, ''),
('Chez Lola', 0, '2025-01-23', 1, 'chez nawal est mieux', 'nawal lol', '', 0, ''),
('Aire Sepmes', 0, '2025-01-29', 3, 'pas mal', 'ok', '', 0, ''),
('Aire Sepmes', 0, '2025-01-29', 3, 'pas mal', 'ok', '', 0, ''),
('L\'Étoile du Maroc', 0, '2025-01-03', 4, 'maroc >>', 'meee', '', 0, ''),
('Cailol Villa', 0, '2025-01-04', 2, 'pas mal', 'meeeeeee', 'Hotel', 0, ''),
('LesSapinsVerts', 0, '2025-01-16', 2, 'lol', 'lol', 'Hotel', 72054, ''),
('Cailol Villa', 0, '2025-01-30', 2, 'ml', 'lm', 'Hotel', 34007, ''),
('Domaine le Clols', 0, '2025-01-18', 2, 'l', 'm', 'Hotel', 66179, ''),
('Chambres d\'Hôtes Chateau des Noces', 0, '2025-01-10', 2, 'qz', 'cd', 'Hotel', 85014, ''),
('Ibis Styles Hôtels', 0, '2025-01-15', 2, 'n', 'n', 'Hotel', 22278, ''),
('Ibis Styles Hôtels', 0, '2025-01-15', 2, 'n', 'n', 'Hotel', 22278, ''),
('Jardin de l\'écomusée de la Guadeloupe', 0, '2025-01-03', 4, 'ml', 'lm', 'Jardin', 97115, ''),
('musée de La Poterie', 0, '2025-01-02', 5, 'jaime la poterie', 'yay', '', 0, ''),
('maison de l\'archéologie des Vosges du Nord', 0, '2025-01-03', 1, 'nul', 'nul', 'Musee', 67110, ''),
('maison de l\'archéologie des Vosges du Nord', 0, '2025-01-03', 1, 'nul', 'nul', 'Musee', 67110, ''),
('Au pont gourmand', 0, '2025-01-27', 4, 'tres gourmand', 'pol', '', 0, ''),
('Quick (75108)', 0, '2025-01-04', 5, 'quick and fast', 'qfc', 'Restaurant', 75108, ''),
('Quick (75108)', 0, '2025-01-04', 5, 'quick and fast', 'qfc', 'Restaurant', 75108, ''),
('Ibis Styles Hôtels', 0, '2025-01-21', 3, 'bien', 'ik', 'Hotel', 22278, ''),
('musée Alsacien', 0, '2025-01-14', 3, 'lol', 'lololololololol', 'Musee', 67500, ''),
('Jardin de l\'écomusée de la Guadeloupe', 9, '2025-01-24', 2, 'gi', 'ji', 'Jardin', 97115, ''),
('Parc du château d’Arlay et jardin des jeux', 10, '2025-01-15', 3, 'ni', 'oui', 'Jardin', 39140, ''),
('Hôtel Foch', 0, '2025-01-13', 3, 'mp', 'pm', 'Hotel', 69386, ''),
('Hôtel de Flore', 0, '2025-01-27', 1, 'bof', 'moyen', 'Hotel', 54395, ''),
('B&B Hotel', 0, '2025-01-02', 2, 'avis', 'ndu', 'Hotel', 62160, 'Boulogne-sur-Mer');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
