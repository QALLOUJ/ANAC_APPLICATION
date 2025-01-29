-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2025 at 10:56 AM
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
  `id` varchar(11) NOT NULL,
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
('musée du Pays de Hanau - histoire et vies d’un territoire', 'M0003', '2025-01-25', 4, 'Pas mal! Si vous passez dans le coin, très bon musée à visiter', 'Fan2histoire', 'musees', 67330, 'Bouxwiller'),
('musée du Pays de Hanau - histoire et vies d’un territoire', 'M0003', '2025-01-10', 3, 'Pas aussi enthousiaste que fan2musee, mais c\'était sympa quand meme !', 'adeptededecouverte', 'musees', 67330, 'Bouxwiller'),
('Chambres d\'Hôtes Chateau des Noces', '6', '2025-01-01', 1, 'Pire expérience de ma vie! Fuyez cet établissement coute que coute', 'bigHater', 'Hotel', 85014, 'Bazoges-en-Pareds'),
('Jardin des sculptures', '6', '2025-01-24', 4, 'Magnifiques sculture. A voir si vous passez dans le coin.', 'MonsieurPof', 'Jardin', 76780, ''),
('Kimchi (75102)', '55553', '2025-01-29', 5, 'Très bon! Je pref ceux de ma maman et de Jimin mais ce sont surement les 3èmes meilleurs kimchis du monde!', 'JK97', 'Restaurant', 75102, 'Paris 2e Arrondissement'),
('Kimchi (75102)', '55553', '2025-01-24', 5, 'jai vu mon idole dans le restau omg, ca ne peut etre que bien', 'fan2kpop', 'Restaurant', 75102, 'Paris 2e Arrondissement');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
