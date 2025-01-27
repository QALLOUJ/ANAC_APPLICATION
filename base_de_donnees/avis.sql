-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 07:41 PM
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
  `date` date NOT NULL,
  `note` int(10) NOT NULL,
  `avis` varchar(2083) NOT NULL,
  `pseudo` varchar(1000) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `code_postal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`nom`, `date`, `note`, `avis`, `pseudo`, `type`, `code_postal`) VALUES
('Les Gites de Clairier', '2025-01-09', 2, 'ml', 'lm', '', 0),
('Chez Lola', '2025-01-23', 1, 'chez nawal est mieux', 'nawal lol', '', 0),
('Chez Lola', '2025-01-23', 1, 'chez nawal est mieux', 'nawal lol', '', 0),
('Chez Lola', '2025-01-23', 1, 'chez nawal est mieux', 'nawal lol', '', 0),
('Aire Sepmes', '2025-01-29', 3, 'pas mal', 'ok', '', 0),
('Aire Sepmes', '2025-01-29', 3, 'pas mal', 'ok', '', 0),
('L\'Étoile du Maroc', '2025-01-03', 4, 'maroc >>', 'meee', '', 0),
('Cailol Villa', '2025-01-04', 2, 'pas mal', 'meeeeeee', 'Hotel', 0),
('LesSapinsVerts', '2025-01-16', 2, 'lol', 'lol', 'Hotel', 72054),
('Cailol Villa', '2025-01-30', 2, 'ml', 'lm', 'Hotel', 34007),
('Domaine le Clols', '2025-01-18', 2, 'l', 'm', 'Hotel', 66179),
('Chambres d\'Hôtes Chateau des Noces', '2025-01-10', 2, 'qz', 'cd', 'Hotel', 85014),
('Ibis Styles Hôtels', '2025-01-15', 2, 'n', 'n', 'Hotel', 22278),
('Ibis Styles Hôtels', '2025-01-15', 2, 'n', 'n', 'Hotel', 22278),
('Jardin de l\'écomusée de la Guadeloupe', '2025-01-03', 4, 'ml', 'lm', 'Jardin', 97115),
('musée de La Poterie', '2025-01-02', 5, 'jaime la poterie', 'yay', '', 0),
('maison de l\'archéologie des Vosges du Nord', '2025-01-03', 1, 'nul', 'nul', 'Musee', 67110),
('maison de l\'archéologie des Vosges du Nord', '2025-01-03', 1, 'nul', 'nul', 'Musee', 67110),
('Au pont gourmand', '2025-01-27', 4, 'tres gourmand', 'pol', '', 0),
('Quick (75108)', '2025-01-04', 5, 'quick and fast', 'qfc', 'Restaurant', 75108),
('Quick (75108)', '2025-01-04', 5, 'quick and fast', 'qfc', 'Restaurant', 75108);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
