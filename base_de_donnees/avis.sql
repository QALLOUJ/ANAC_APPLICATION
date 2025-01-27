-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 04:19 PM
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
  `pseudo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`nom`, `date`, `note`, `avis`, `pseudo`) VALUES
('Les Gites de Clairier', '2025-01-09', 2, 'ml', 'lm'),
('Chez Lola', '2025-01-23', 1, 'chez nawal est mieux', 'nawal lol'),
('Chez Lola', '2025-01-23', 1, 'chez nawal est mieux', 'nawal lol'),
('Chez Lola', '2025-01-23', 1, 'chez nawal est mieux', 'nawal lol'),
('Aire Sepmes', '2025-01-29', 3, 'pas mal', 'ok'),
('Aire Sepmes', '2025-01-29', 3, 'pas mal', 'ok'),
('L\'Étoile du Maroc', '2025-01-03', 4, 'maroc >>', 'meee');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
