-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2025 at 07:54 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pe`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int NOT NULL,
  `nama_customer` varchar(255) NOT NULL,
  `project` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `project`) VALUES
(1, 'PT. SUZUKI INDONESIA MOTORS', 'YTB'),
(2, 'ATESAN', 'FPF');

-- --------------------------------------------------------

--
-- Table structure for table `data_part`
--

CREATE TABLE `data_part` (
  `id_part` int NOT NULL,
  `nama_part` varchar(255) NOT NULL,
  `gambar_part` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `id_customer` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_part`
--

INSERT INTO `data_part` (`id_part`, `nama_part`, `gambar_part`, `tanggal`, `tgl_selesai`, `id_customer`) VALUES
(18, 'YTB-MM09', 'Screenshot (7).png', '2025-03-05', '2025-03-21', 1),
(19, 'REINF INNER FR L', 'Screenshot (8).png', '2025-03-14', '2025-03-29', 2);

-- --------------------------------------------------------

--
-- Table structure for table `proses`
--

CREATE TABLE `proses` (
  `id_proses` int NOT NULL,
  `part_no` varchar(20) NOT NULL,
  `Proses` varchar(50) NOT NULL,
  `mat_spec` varchar(50) NOT NULL,
  `mat_size` varchar(50) NOT NULL,
  `part_sketch` varchar(255) NOT NULL,
  `layout_sketch` varchar(255) NOT NULL,
  `target_trial` varchar(255) NOT NULL,
  `id_part` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `proses`
--

INSERT INTO `proses` (`id_proses`, `part_no`, `Proses`, `mat_spec`, `mat_size`, `part_sketch`, `layout_sketch`, `target_trial`, `id_part`) VALUES
(1, '77100T400', '1/5 DRAW 2', 'ASDFAS', '1.0 X 44 X 1260', 'logo_sjm.png', 'Thumbnail_22_0000000-removebg-preview.png', 'SAMPAI SELESAI', 19),
(2, '77100T400', '1/5 DRAW 1', 'JJK', '1.0 X 44 X 1260', 'logo_sjm.png', 'logo_sjm.png', 'SAMPAI SELESAI', 19);

-- --------------------------------------------------------

--
-- Table structure for table `trial`
--

CREATE TABLE `trial` (
  `id_trial` int NOT NULL,
  `tanggal` date NOT NULL,
  `jam_start` varchar(25) NOT NULL,
  `jam_finish` varchar(25) NOT NULL,
  `mc_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `trial` varchar(255) NOT NULL,
  `kapasitas` varchar(50) NOT NULL,
  `cush_prec` varchar(50) NOT NULL,
  `pin_cus_qtt` varchar(50) NOT NULL,
  `die_height` varchar(50) NOT NULL,
  `die_dim` varchar(50) NOT NULL,
  `problem_tool` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `analisa_sebab_tool` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `counter_measure_tool` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pic_tool` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `target_tool` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan_tool` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `problem_part` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `analisa_sebab_part` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `counter_measure_part` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PIC` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `target` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kelengkapan_dies` varchar(50) NOT NULL,
  `accuracy_part` varchar(50) NOT NULL,
  `id_proses` int NOT NULL,
  `id_part` int NOT NULL,
  `id_customer` int NOT NULL,
  `qty_trial` varchar(255) NOT NULL,
  `jumlah_ok` varchar(255) NOT NULL,
  `jumlah_ng` varchar(255) NOT NULL,
  `visual` varchar(255) NOT NULL,
  `dimensi` varchar(255) NOT NULL,
  `fungsi` varchar(255) NOT NULL,
  `judgement` varchar(255) NOT NULL,
  `dibuat` varchar(255) NOT NULL,
  `diperiksa` varchar(255) NOT NULL,
  `diketahui` varchar(255) NOT NULL,
  `peserta` varchar(255) NOT NULL,
  `part_no` varchar(255) NOT NULL,
  `project` varchar(255) NOT NULL,
  `mat_spec` varchar(255) NOT NULL,
  `mat_size` varchar(255) NOT NULL,
  `nama_customer` varchar(255) NOT NULL,
  `nama_part` varchar(255) NOT NULL,
  `Proses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trial`
--

INSERT INTO `trial` (`id_trial`, `tanggal`, `jam_start`, `jam_finish`, `mc_name`, `trial`, `kapasitas`, `cush_prec`, `pin_cus_qtt`, `die_height`, `die_dim`, `problem_tool`, `analisa_sebab_tool`, `counter_measure_tool`, `pic_tool`, `target_tool`, `keterangan_tool`, `problem_part`, `analisa_sebab_part`, `counter_measure_part`, `PIC`, `target`, `keterangan`, `kelengkapan_dies`, `accuracy_part`, `id_proses`, `id_part`, `id_customer`, `qty_trial`, `jumlah_ok`, `jumlah_ng`, `visual`, `dimensi`, `fungsi`, `judgement`, `dibuat`, `diperiksa`, `diketahui`, `peserta`, `part_no`, `project`, `mat_spec`, `mat_size`, `nama_customer`, `nama_part`, `Proses`) VALUES
(15, '2025-03-14', '05:16', '10:00', 'asfa', '10', '100', '11', '123', '213', '12', '123', '123', '123', 'qwe', 'qwe', 'qwe', '123', '123', '12', '123', '123', '123', '21', '122', 1, 19, 1, '100', '90', '10', 'OK', 'OK', 'OK', 'OK', 'TONO', 'TONO', 'Jono', 'Jono', '', '', '', '', '', '', ''),
(16, '2025-03-14', '08:35', '09:36', 'YASHINO MP038', '10', '100', '11', '11', '11', '12', '123', '12', '12', 'qwe', 'qwe', '123', '123', '123', '123', '123', '123', '123', '123', '123', 1, 18, 1, '100', '12', '10', 'OK', 'OK', 'OK', 'OK', '123', '123', '123', '123', '77100T400', 'YTB', 'ASDFAS', '1.0 X 44 X 1260', '', '', ''),
(17, '2025-03-15', '14:15', '15:15', 'YASHINO MP038', '10', '100', '0', '0', '255', '0', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '0', 1, 18, 1, '100', '99', '1', 'OK', 'OK', 'OK', 'OK', 'Jono', 'TONO', 'TONO', 'Jono', '77100T400', 'YTB', 'ASDFAS', '1.0 X 44 X 1260', 'PT. SUZUKI INDONESIA MOTORS', 'YTB-MM09', '1/5 DRAW 2'),
(18, '2025-03-14', '14:15', '17:18', 'YASHINO MP038', '10', '12', '12', '12', '12', '12', '12', '12', '12', '12', '12', '12', '12', '12', '12', '12', '12', '12', '12', '12', 1, 18, 1, '12', '12', '12', 'NG', 'NG', 'NG', 'NG', '12', '12', '12', '12', '77100T400', 'YTB', 'ASDFAS', '1.0 X 44 X 1260', 'PT. SUZUKI INDONESIA MOTORS', 'YTB-MM09', '1/5 DRAW 2'),
(19, '2025-03-14', '14:37', '17:38', 'asfa', '123', '123', '123', '123', '123', '123', '', '123', '123', '123', '123', '13', '123', '123', '123', '123', '213', '123', '123', '123', 1, 18, 1, '123', '123', '123', 'OK', 'OK', 'OK', 'OK', '213', '123', '123', '123', '77100T400', 'YTB', 'ASDFAS', '1.0 X 44 X 1260', 'PT. SUZUKI INDONESIA MOTORS', 'YTB-MM09', '1/5 DRAW 2'),
(20, '2025-03-14', '15:41', '15:42', '123', '10', '123', '123', '123', '123', '123', '', '123', '123', '123', '123', '123', '123', '123', '13', '213', '123', '123', '123', '123', 1, 18, 1, '123', '1231', '123', 'OK', 'OK', 'OK', 'OK', '123', '123', '123', '123', '77100T400', 'YTB', 'ASDFAS', '1.0 X 44 X 1260', 'PT. SUZUKI INDONESIA MOTORS', 'YTB-MM09', '1/5 DRAW 2'),
(21, '2025-03-21', '14:49', '15:50', 'YASHINO MP038', '123', '12', '12', '12', '12', '12', '', '123', '123', '213', '123', '213', '123', '123', '123', '123', '123', '123', '123', '123', 1, 18, 1, '12', '12', '12', 'OK', 'OK', 'OK', 'OK', '123', '213', '123', '123', '77100T400', 'YTB', 'ASDFAS', '1.0 X 44 X 1260', 'PT. SUZUKI INDONESIA MOTORS', 'YTB-MM09', '1/5 DRAW 2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(8, 'Dana', '$2y$10$intJ4urG/dUBg5i6EqC..OXpV260YwUBKo9Z166JQCe8ADWp2aVwq'),
(9, 'Tono', '$2y$10$20.tKwOqu/JzwjoyCtH7SO/MpxqcFso3g7p1XHJzO1OVvrIka3fFm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `data_part`
--
ALTER TABLE `data_part`
  ADD PRIMARY KEY (`id_part`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `proses`
--
ALTER TABLE `proses`
  ADD PRIMARY KEY (`id_proses`),
  ADD KEY `id_part` (`id_part`);

--
-- Indexes for table `trial`
--
ALTER TABLE `trial`
  ADD PRIMARY KEY (`id_trial`),
  ADD KEY `id_proses` (`id_proses`),
  ADD KEY `id_part` (`id_part`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_part`
--
ALTER TABLE `data_part`
  MODIFY `id_part` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `proses`
--
ALTER TABLE `proses`
  MODIFY `id_proses` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trial`
--
ALTER TABLE `trial`
  MODIFY `id_trial` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_part`
--
ALTER TABLE `data_part`
  ADD CONSTRAINT `data_part_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `proses`
--
ALTER TABLE `proses`
  ADD CONSTRAINT `proses_ibfk_1` FOREIGN KEY (`id_part`) REFERENCES `data_part` (`id_part`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `trial`
--
ALTER TABLE `trial`
  ADD CONSTRAINT `trial_ibfk_1` FOREIGN KEY (`id_proses`) REFERENCES `proses` (`id_proses`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `trial_ibfk_2` FOREIGN KEY (`id_part`) REFERENCES `data_part` (`id_part`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `trial_ibfk_3` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
