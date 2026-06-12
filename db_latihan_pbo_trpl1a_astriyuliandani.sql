-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2026 at 03:01 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan_pbo_trpl1a_astriyuliandani`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_tiket`
--

CREATE TABLE `table_tiket` (
  `id_tiket` int NOT NULL,
  `nama_film` varchar(100) NOT NULL,
  `jadwal_tayang` datetime NOT NULL,
  `jumlah_kursi` int NOT NULL,
  `harga_dasar_tiket` decimal(10,2) NOT NULL,
  `jenis_studio` enum('regular','IMAX','velvet') NOT NULL,
  `tipe_studio` varchar(50) DEFAULT NULL,
  `lokasi_baris` varchar(10) DEFAULT NULL,
  `kacamata_3d_id` varchar(20) DEFAULT NULL,
  `efek_gerak_fitur` varchar(50) DEFAULT NULL,
  `bantal_selimut_pack` varchar(20) DEFAULT NULL,
  `layanan_butler` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `table_tiket`
--

INSERT INTO `table_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_studio`, `lokasi_baris`, `kacamata_3d_id`, `efek_gerak_fitur`, `bantal_selimut_pack`, `layanan_butler`) VALUES
(1, 'Avengers: Endgame', '2024-06-15 13:00:00', 50, 35000.00, 'regular', 'Standard', 'A1', NULL, NULL, NULL, NULL),
(2, 'Spider-Man: No Way Home', '2024-06-15 15:30:00', 50, 35000.00, 'regular', 'Standard', 'B12', NULL, NULL, NULL, NULL),
(3, 'Frozen II', '2024-06-16 10:00:00', 60, 40000.00, 'regular', 'Kids', 'C5', NULL, NULL, NULL, NULL),
(4, 'The Batman', '2024-06-16 19:00:00', 50, 45000.00, 'regular', 'Standard', 'D8', NULL, NULL, NULL, NULL),
(5, 'Inception', '2024-06-17 14:00:00', 50, 35000.00, 'regular', 'Standard', 'E2', NULL, NULL, NULL, NULL),
(6, 'Interstellar', '2024-06-17 21:00:00', 50, 35000.00, 'regular', 'Standard', 'F10', NULL, NULL, NULL, NULL),
(7, 'Parasite', '2024-06-18 16:00:00', 50, 35000.00, 'regular', 'Standard', 'G4', NULL, NULL, NULL, NULL),
(8, 'Oppenheimer', '2024-06-15 12:00:00', 100, 75000.00, 'IMAX', 'Laser', NULL, 'IMX-001', 'High Vibration', NULL, NULL),
(9, 'Dune: Part Two', '2024-06-15 18:00:00', 100, 75000.00, 'IMAX', '70mm', NULL, 'IMX-002', 'Audio Immersive', NULL, NULL),
(10, 'Avatar: Way of Water', '2024-06-16 11:00:00', 120, 85000.00, 'IMAX', 'Digital', NULL, 'IMX-003', 'Wind Effect', NULL, NULL),
(11, 'Top Gun: Maverick', '2024-06-16 15:00:00', 100, 75000.00, 'IMAX', 'Laser', NULL, 'IMX-004', 'Full Motion', NULL, NULL),
(12, 'Gravity', '2024-06-17 13:00:00', 100, 75000.00, 'IMAX', 'Digital', NULL, 'IMX-005', 'Zero-G Simulation', NULL, NULL),
(13, 'Tenet', '2024-06-17 20:00:00', 100, 75000.00, 'IMAX', 'Laser', NULL, 'IMX-006', 'Reverse Audio', NULL, NULL),
(14, 'Star Wars: Force Awakens', '2024-06-18 14:00:00', 100, 75000.00, 'IMAX', 'Digital', NULL, 'IMX-007', 'Star Jump Effect', NULL, NULL),
(15, 'Titanic', '2024-06-15 20:00:00', 20, 150000.00, 'velvet', NULL, 'Sofa 1', NULL, NULL, 'Premium Pack A', 'Available'),
(16, 'About Time', '2024-06-15 22:30:00', 20, 150000.00, 'velvet', NULL, 'Sofa 2', NULL, NULL, 'Premium Pack B', 'Available'),
(17, 'The Notebook', '2024-06-16 19:30:00', 20, 175000.00, 'velvet', NULL, 'Sofa 3', NULL, NULL, 'Luxury Silk', 'Available'),
(18, 'La La Land', '2024-06-16 22:00:00', 20, 175000.00, 'velvet', NULL, 'Sofa 4', NULL, NULL, 'Premium Pack A', 'Available'),
(19, 'Great Gatsby', '2024-06-17 19:00:00', 20, 150000.00, 'velvet', NULL, 'Sofa 5', NULL, NULL, 'Royal Velvet', 'Available'),
(20, 'Pride and Prejudice', '2024-06-17 21:30:00', 20, 150000.00, 'velvet', NULL, 'Sofa 6', NULL, NULL, 'Premium Pack B', 'Available'),
(21, 'Notting Hill', '2024-06-18 20:00:00', 20, 150000.00, 'velvet', NULL, 'Sofa 7', NULL, NULL, 'Premium Pack A', 'Available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_tiket`
--
ALTER TABLE `table_tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_tiket`
--
ALTER TABLE `table_tiket`
  MODIFY `id_tiket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
