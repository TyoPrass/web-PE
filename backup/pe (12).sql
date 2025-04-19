-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 22, 2025 at 04:10 AM
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
-- Table structure for table `checklist_katakanesha`
--

CREATE TABLE `checklist_katakanesha` (
  `id` int NOT NULL,
  `part_no` varchar(50) NOT NULL,
  `part_name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `process` varchar(50) NOT NULL,
  `checklist_data` json NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checklist_katakanesha`
--

INSERT INTO `checklist_katakanesha` (`id`, `part_no`, `part_name`, `date`, `process`, `checklist_data`, `created_at`) VALUES
(3, '6613123', '11', '2025-03-21', '1/5 blank', '[{\"P1\": \"X\", \"P2\": \"X\", \"P3\": \"X\", \"keterangan\": \"upper error\"}, {\"P1\": \"X\", \"P2\": \"X\", \"P3\": \"X\", \"keterangan\": \"X\"}, {\"P1\": \"X\", \"P2\": \"X\", \"P3\": \"X\", \"keterangan\": \"X\"}, {\"P1\": \"X\", \"P2\": \"X\", \"P3\": \"X\", \"keterangan\": \"X\"}, {\"P1\": \"X\", \"P2\": \"X\", \"P3\": \"X\", \"keterangan\": \"X\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}]', '2025-03-21 03:34:09'),
(7, 'AD', 'ASD', '2025-03-22', 'ASD', '[{\"P1\": \"X\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"X\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"X\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"A\", \"P2\": \"A\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"A\", \"P2\": \"A\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"A\", \"P2\": \"A\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}, {\"P1\": \"\", \"P2\": \"\", \"P3\": \"\", \"keterangan\": \"\"}]', '2025-03-22 03:44:47');

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
(13, 'PT SUZUKI INDONESIA MOBIL', 'YTB'),
(14, 'PT KAWASAKI MOTOR INDONESIA', 'KMI');

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
(39, 'REINF INNER FR L', 'images.jpg', '2025-03-20', '2025-04-05', 13),
(40, 'PLATE OUTHER', 'logo.jpeg', '2025-03-20', '2025-04-05', 14),
(41, 'RETAINER FULL GAUGE', 'logo.jpeg', '2025-03-20', '2025-03-22', 13),
(42, 'BOX FUEL FILLER', 'images.jpg', '2025-03-20', '2025-04-05', 14);

-- --------------------------------------------------------

--
-- Table structure for table `jawal`
--

CREATE TABLE `jawal` (
  `id_jadwal` int NOT NULL,
  `nama_part` varchar(255) NOT NULL,
  `id_part` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(6, '61141/3-68P00', '1/5 DRAW 1', 'JSC270CN', ' 1,4 X 200 X 1219', 'images.jpg', 'logo.jpeg', 'Prod : 100 ', 42);

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
(36, '2025-03-20', '15:15', '16:17', 'YASHINO MP038', '10', '100', '0', '0', '289', '0', '<p><img src=\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxISEBUSExMVExMXERYQGBYYGBUVGBUVFRgWFxURFRUYICggGBooHxYVITIiJSkrLjAuFx8zODMtNygtLi0BCgoKDg0OGhAQGy0lICUvLS0tLS0vLi0tLS0tKy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAKIBNgMBEQACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAABAECAwUGBwj/xABEEAACAQIEAwUDBwgJBQAAAAABAgADEQQSITEFQVEGEyJhcTKBkQcUI0JSodEzU2JygpLB8BUkQ5OipLHC4RY1ZHOy/8QAGgEBAAMBAQEAAAAAAAAAAAAAAAEDBAIFBv/EADARAQACAgEDAQYFBAMBAAAAAAABAgMRBBIhMVEFExQyQWEicYGRoRUzQlIjsdHB/9oADAMBAAIRAxEAPwD3GAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIEarj6S71FHvErtmx18zCyMV58QtTidE7VF+M5jkY5/yhM4ckfRISqp2IPoQZbFonxKuYmPK+SggICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBreM8YTDrr4nI0X+JPITNyOTXDHfz6LsOC2We3hxWP4xWrHxPp9ldAPdz988XLycmSe8vVx4MdPEIBlC5S0C6niXX2WI95/0ndb2jxLi0RPltsD2qrJoxDjz3/n4TZj5uSvnuzX4uO3js6bh3aSjV0vkboZ6GLmY79p7SxZONen3bhTfUaia2dWAgIGOtXVBdmCjzM5tete8ymtZt4hrK3aTDr9Yn0F5ltzsMfVorxck/RSj2lw7H2iPUWivPwz9SeJkhtKNdXF1II8pqreto3WWe1ZrOpZJ0ggICAgICAgICAgICAgICAgICAgICAgR+IYsUqTVG2UXt1OwX3mwleXJGOk2n6O6Um9orDzbF4hqjl3uWY3P4DynzmTJOS02s9ulIpXphjHpK3ZCC8G1reklG2MiShQCDbacP45WpbNcdDrL8XKyY/EqcmCl/MOgwvbFD+UQg9Rt8Jvp7Rr/lDLbhT/AIykP2toW0Dk9LATufaOKPG3EcO/2arHdrKjaUwEHXczJl9o3t2pGmjHw6R807aOtiGc3Zix8zeYLXtad2nbZWtaxqFgnKV1o2lN4fxGpROZNba5eTDmvvl/H5FsVtx4U5sUZK6l6BhcQtRFqKbq6h1PVWFwfgZ9JE7jcPEmNMskICAgICAgICAgICAgICAgICAgICAgcz21xHhp0+pLn9nQD/EfhPL9qZNUivq38Cm7Tb0cpPFeougUMbQtIk7NKZY2jSmWTtGlrCNjG7gTqtbW8RtFrVjzKDU4th1NjXpA9DUQH4Ey+OLmn/FV7/H6slHiFJ/Zqo36rK3+hM5njZo81kjNjn6pQI6ym1bV8wsiaz4lkVZz1O9LgsjqNL1WRs0yKsRJp1HYziivTGGAbPRoU3ZtMtqhfIg1vey9LbT6nDP4Ij7Q8LJH4pl0suVkBAQEBAQEBAQEBAQEBAQEBAQEBAQOI7ZVL4kDkKSj3kuT/CeJ7SneSI+z1ODGqTP3aLMZ52obdyZz0k6hG5M8jRtQv5Ro2p3kaNrS8aNrS0keUfKRxB3xPcG2Sn4101u6pcE8x4dPUz6DhREYavH5M7yS5G01s5aBPwPGa9Gm1OlUamGdXJUkG6ZrAEbDxG452E5msT5TEzDecM7f4umfGVrL+kArW8mW33gzNk4WG/mNfkvpyclfq7zs921w2KIS5pVT9R7anojbN6aE9J5ef2deneneP5bsXMrbtbs6lTPNn0bVmIDPakn5Sqwop5Ft3t0VczHyUy/i4pyZIqqz36KTL0vCYNKahUUCyLSBsL5EFkUnmBc/Ez6rTwWeAgICAgICAgICAgICAgICAgICAgICBwHax/6246BB/hB/jPC9of3v0h6/D/tNUGmFqL+sgL+skY6r2B1kaRtfRwqmkKhqFQQCcyEW0JsOvqJ6U8GK13Nv4YY5czOohKp8HDAEVSQQCCFFiDqCNZZHs6P9nPxs/wCrW9oGo4Omr1az+JsqqEuzG1zYX5ecn+mx/sj46fR53274VQqUP6Ro1XfOy07EKAMtlI6gjz91xNmKJxdOP6M15693cBmmlSXgVQEkAAkk2AGpJOwA5wNlx/gtXB1RSqqVY00qC4t7Q1AsTs2Zf2ZCUX5jV/NVP3G/Cc9UeqemfR6d2D45UNMUqzM1QZiMyMGVVKABnPt3zG3MZTflPK9oYKTX3lfP1b+JltE9E+HpfYNVfFVKjkZlpqlJfJiTVYDm2iDyH60n2X7vpmfqjnTbcejvp67zyAgICAgICAgICAgICAgIEDE8XpI+Qk5hvYXt6zJl5uLHbptPdfTjZL16ohDXipqVitJgwsCNrAXsysTY5r306WllM9LzqsuLYrV8wnPxECpkKn2gt+euxt0l21aQMQhbLmF72t59JIywEBA837QYtXxVVkZXW6gMCCDZFBFx0NxPB53fNP6PX4k6xQ12aY9NO1MxjRtU1DJ0blFx9YhCd9Of8ZNY7w4tPZNrkmmrZQrCkwA0uRp7LDZL2uDrex5T288fgeVj+Zu8G4NNG6ora+Y2mivhTPl5x8oGMZsWVRa2WlSALUqnd/SVDm1FjmsCu3UydDFxyg9HgtH8sXd+9Nqh7zxkFQXy/Zy8pxPz1/V1X5ZcD39Xpi/74n/ZLXC75xV/8v8AvL/7YE/geKqfOqF/nVu/pe0QR7a76bQPTO1n/dcAtmIJN7AFdGuM1xpM/J/tW/Jbg+eG/VyEW7ML4arvbe62Hr5Tyoid/q37/wCmTFuQKniI/qq29ne1Y2HU6beUr1Pb83e47/klK9qupI+jUa23LHQeflOI3r9XU62j4eswp4clmHhBJNh/ZMST0nU3tu3lHTGoZC7ZK5DNoTbb80h067yN23XvJqup7MlZ3Bp2Z/bOl9/oqhtflqBIpa257ym1a9u0KYPE1ma756bdzTYpmDZWJqXGYGxOg26Tu97RHa0ua1rM94hkwteoc3jf8ow3O3xldsmTcd5dVpTv2hbh8ZU7ofSPmNMtvroN7X9JZ7zJ1+Zc9FOnxC6riaoolu8qX7ote5vfLe++8iMuXr+aT3dOnxC6vjagVrVXzBC1rm+xsbX8ormy9XzSmcePXiGWniqth9I+w5t+Mj4jNFvmk9zj14hiwePrGnTvVbM1NTqTcnKCdCZ3bPm3OrSiuLHqO0K4XHVyDeo/5SoOewdgOflF+RmifmlFcOOY8A4hX7xh3jWCofiXvz8hItys/TGrSRgxbnspU4pX8BWqSGbcagjKx0N/IRXk8jU7tKZwYu2oZl4jX/ON8JzXmZ/9pTPGxejFh+K4gopNQ3Kg7Cd35eeLTEWc14+KY8MuJ4lXFF27w3A0NgOTfgJbXk5px2nq9HM4McWjs0mAdaqGz3LA3ZWu1z9a+9+d5i1NbbmP3ae011CZZwGOjNe/iJ123PoJpy5q5r1m0aiFOPFOOs68smDxzUiXzEsSFJylzlzeFQCMxAv0l05bRmiuG3afXvH8qoxxOOZyR/8AE3AcT8RqVEvchwq3GUjmFIuSTrY8+Qmq3LvjydFq7/L/AMURx63p1VnX5pvDeJB6hJqZFzX8dwWBG1joLHTeXV5eObdMzqfSeyq3HvEbiNx9k7BcRZ2IsCoZlYgGy2v9bY9NJpi2/CmY0kUeII3UaX15iTtDzjifC0wtV6NMsVBDeIgnxAMdQBzJnh82NZpetxZ3jRc0yaadqExEImVQxjR3RccWynLfNy9eVp1TzDi3hscRm7sF98jbFcupAGf6+exuLaWvflPZz66O7zMe+ptsLiQuGR25UgzaG4soLXG/LaX0n8MKreXjaZcbixpQZq+JJJ+nzqrG1jfTRdf2Z25dp8qlJF4eq2XKrKozmoRYZQLldZXPz1/V3X5ZeO3pdMP/AJqXKy9Lph/81AncCNP51QsKF+/pbfOb+2u1za/rA9a7XlRxfht8l8zgX7y+49m2nxmfk/2bfkuwf3IbuthaVRKedKb5KFSquZScrqUs632IvvvPKi81mderdNd+WbiGGpvnLIjFMMrqSCcrWrjMOmhPxnNbTHaPVMxH1SauFpVKyh0R8qpUW63syuSri+xErrM1js7mNz3YkoI9HDo6qysgRlK3BU0HBBB5WnUdpmYRPeIiWYUVWnXVVAAuoAXQAUaYAA6RrvEn0llxA1o2tfObXGl+5q2vOYiI26mfCzBB8/0uQ1O4pZyikJmzVb5cxvb1i+tdvBXe+7Pg19v/ANrcvSRavhNZ8ouHwiGmtTIveCi1MNkGYKdSoPIXA0nUzMW19NuYiNbZaw/q50/sD9UfY6TiInrddukr4VLPUCL3hommWyjMVAJCX5i5OnnJr1do+m0Tryk010GnIchOZrPV4/h1Fo15RMHgUZKDtTUvTpDIxRcyZkAbKfq3GhtO5i/eI3qXMTXUSz4Skcp8J/KVT7I51GIi9Len8Fbx6rRh2NR7oSDTQezodalx57/fI93fpjtP7J667nuoMDkWkiUiqIwAVUsFUK4AAA0E6iuS25mJ/ZzNqRqImEkYdvsN+7/xKow3/wBZ/Z37ynrH7sOEwrimt0f2RplP4Sy+G82memf2c0yU15hfjMK7YeqvdubqRbK2ujaWtrO6Y8kY7fhn6fRzbJSbR3ho+D8JXDp4aJpXte6st/efUzPlnLbveJ/Zdj93Haswn13IRmGpCkjc6gaaDU+6c0iJtET4d2mYiZhhp1fACwuStyLW5a77D1k9P4u0o6u3dbVFMp9UqbEDQi420nVL5KZOr6/dzaKWpr6BUlbKwsLAiwIK5SMtj7j7pbXPE5veZYVzi1j6Mcsoxb0gDTzA3A8JC8tyCQu4t7/dLcVq3z/gnphxes1xfijcttwTiSUywqAG5LZ7a3JBZbdL9LbTVTmxS80vO4jxLPfjTakWrGvs1Xa9B87bzVD91v4TP7Q7Zv0X8PU4/wBWnyecw7a9KFfSNmlAv87ydmltdbqRIie5MJNPFUe7UM7FwuX2DpqCRpodQNdZ69uVivTUz/DzI4+Stt6Z1xmH7nuWdivdd0bo9yMuU6gbyyvMwxGtuJ4uWZ8Ob7PcGoYav3zYh62VStMGnkyg3F2t7RsSOW502tPxuH1/g+EyNZ8qnaSi9DuKdRhVDK1rMptca357GW0t7ya2r47q7V6Ims+XlIxlT84/7zfjNClX59V/OVP3m/GBdS4jWVgy1HDKQwOYnUG4NjoYHUY7tRV4hjaGepUpjKlEd0e7IrMPbGu3eka75R1nM61O3Ueez23sPws1cwepUdKNqRJdruzKHYMeQsVJtuWAFgLHzeNhrmmclo7fSGzNknHEUjz9Zd0MFS/Nptl9kbdJ6MYqR9IY+u3quGFp/YXp7Ik+7p6QddvVUYZPsLptoNI93X0g6p9VRQT7K/ASeivojqn1V7pfsj4COivodUq92Og+EdMehuTIOgk9MG5VyjpGoQWjUCsnQQEBAQEBAQEBAiYnhtJ90APUaH7t5nycXFk8wupnyU8S0+K7PN9RgR0Oh9OhnnX9m2id0n92yvNiY1eP2Q/+l3JvlQEm5N/v0E5jg55+sJnlYfSWwo9lqYS1ze3IAC/pz+M0V9m11+K07Uzzbb7RGmrrcEqI1u7zdGXUevlMOThZqzqI2105WK0bmdJ/C+AE3NUWFrBefqek1cb2fPnJ+yjPy/pRq+2aWxIPWkp94Zx+Er9pV/5In7O+DP4Jj7tDp/InntvZY7gSBiSsDJGRjpAi1KgB5fdCDOLXvAxGqOo+6SjbzT5RHT5yAF+ktcvfQoQMqZeRBDG/6U9/h/2YeRyf7kuTmtnICBJ4bie6rU6tr5KqVLdcjBrfdImNxpMTqdvpf5PuJotZ6eYFMQFr0mvozhArqD1KKjDqA3SefwbdO8U+Ylr5VerWSPEvQJ6LGQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBA5Lt1hzek42s1M+ujKPueeX7Sr2rZu4Nu8w5buzPI3D0dSyYbDqzHOLqqlrdSOR8v+Js4eOt7TNvozcm9qxEQ2qYdAyKKai6Fi2QBb3Ayoedr3Pl93rxip6Q86clvVnFFfsr8BOvd09IRN7eqhpC5tTzEKWyqozEgHQfzz5Seivojqn1W0tUVu71KByBl0JF8visfLb1tHTHojc+rnOy/aTE4qqwfBth6S3F3zhr66C6hTsL6jfy1nUeiNyjfKhwujV4fVq1EC1KS50qeHMDcDJcbhr2t6HcSYHgk7QQEBA7Dsh2y+bqKFcF6NwVI9qmb3BFiDYHUEEEbjpMnI40ZJ6qzq3q0Ys/RHTPeHtPZzt93ijLVTEppuctRR+kQNfRlU9SZVHIzY+2Su/vDucOO/yW/SXX8N7R0azBPFTdtFD2sx6KykqT5Xv5TRi5WPJOonuqyYL07zDcTQpICAgICAgICAgICAgICAgICAgICAgIELjOB76iyfW9pT0Yaj3cvQmU8jFGXHNVmLJ7u8WefMhBIIsQSCDuCNwZ8xas1nUvdrMWjcLDUKnMuh/nQzvFltjt1Vc5MdbxqV9LilXayAbbN8N5s/qGT0hm+Dp92U8Rqfo/A/jI/qOX7J+Cx/dHq8Uq/o+9TH9QzfY+Dx/dX+k6vUfCPj832Pg8a0cSrfaH7okfH5vU+DxNF2j7P4jiTLTNeoKYa5pIq5WsBY6W8V82pvbSw3m3DzZmnjdvszZOLq3nUNnwb5HaKgFkW9t6hNRj6r7N/wBkS7XJv6V/lV/wV9Zbet8k+FK2yUf7pF+9QDJ9znjxf+D3mKf8P5cZ2i+RjKC1HMn6t6iafoscw9c3uj3ubH89dx6x/wCHu8V/lnX5vO+LdjMTh6eZlLt3hUrTVnAQKCKpa1wL3FiBt5y7HnpfxKu+K9PMOblypVWsbg2I1B6HrIHsnYajiaiVF+nNNjTOH7+3fd4ACWNtkD2Kk8heebyYrOWnT82/p6NuHq93bq8ae9z02IgICAgICAgICAgICAgICAgICAgICAgIGk47wEVj3iWWpbXo9tr9D5/yMPL4cZvxV7T/ANtXH5M4+0+HHYrCvTbK6lT0P+oOxHpPDyYrY51aNPWpet43WWDLK3asCwrJGfCcNqVDZEJ87G0tx4L5PlhVfLSnmXRcO7I7Gqf2R+M9PD7O+uSWHJzfpSHS4XBpTFkUKPL8Z6VMdaRqsMNr2tO5lnnbkgIELG8Jo1fbQE9djKcnHx38wspmvTxLQY/sBhKp8Sq366LU/wDqU/CzHy3mFvv4n5qwswXyfYWkboqr+pTRPvUCR8LefmvJ8RWPFIdFw/hdKj7C2PXc/GXYuPTF8sfqryZrX8psvVEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQMWIw6VFyuoYdCL+8dJzelbxq0bdVtNZ3EtTV7MYc7Bl9Dp98x29nYZ8dmmvNyQsXsrR5lj77TiPZuL1l1POyekJmG4Fh01CXPU6y+nDw08Qptyctvq2CIALAADy0mmIiPCmZ35XSUEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQED//Z\"></p>', '<p>ASDFAF</p>', '<p>ADFSADFS</p>', '<p>ADSFASDF</p>', '<p>ADFSASDF</p>', '<p>ASDFDFAS</p>', '<p>ADSFASDF</p>', '<p>AFASDF</p>', '<p>ADFSASDFASDFA</p>', '<p>ASDFASDF</p>', '<p>ASDFDFAS</p>', '<p>AFASDFD</p>', '90%', '0', 6, 39, 13, '100', '90', '10', 'OK', 'OK', 'OK', 'OK', 'TONO', 'TONO', 'TONO', 'TONO', '61141/3-68P00', 'KMI', 'JSC270CN', ' 1,4 X 200 X 1219', 'PT SUZUKI INDONESIA MOBIL', 'REINF INNER FR L', '1/5 DRAW 1');

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
-- Indexes for table `checklist_katakanesha`
--
ALTER TABLE `checklist_katakanesha`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `jawal`
--
ALTER TABLE `jawal`
  ADD PRIMARY KEY (`id_jadwal`);

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
-- AUTO_INCREMENT for table `checklist_katakanesha`
--
ALTER TABLE `checklist_katakanesha`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `data_part`
--
ALTER TABLE `data_part`
  MODIFY `id_part` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `jawal`
--
ALTER TABLE `jawal`
  MODIFY `id_jadwal` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proses`
--
ALTER TABLE `proses`
  MODIFY `id_proses` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trial`
--
ALTER TABLE `trial`
  MODIFY `id_trial` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
