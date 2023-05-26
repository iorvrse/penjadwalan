-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 26, 2023 at 09:57 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwal_kuliah`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

DROP TABLE IF EXISTS `dosen`;
CREATE TABLE IF NOT EXISTS `dosen` (
  `id_dosen` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `nip` int NOT NULL,
  `bidang_ilmu` varchar(50) NOT NULL,
  `id_pengguna` int NOT NULL,
  PRIMARY KEY (`id_dosen`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE IF NOT EXISTS `jadwal` (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `jumlah_mahasiswa` int NOT NULL,
  `status_jadwal` varchar(50) NOT NULL,
  `progress_jadwal` varchar(50) NOT NULL,
  `id_semester` enum('1','2') NOT NULL,
  `id_ruangan` varchar(10) NOT NULL,
  `id_dosen` int NOT NULL,
  `id_slot` int NOT NULL,
  `kode_matakuliah` int NOT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `id_semester` (`id_semester`),
  KEY `id_ruangan` (`id_ruangan`),
  KEY `id_dosen` (`id_dosen`),
  KEY `id_slot` (`id_slot`),
  KEY `kode_matakuliah` (`kode_matakuliah`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

DROP TABLE IF EXISTS `matakuliah`;
CREATE TABLE IF NOT EXISTS `matakuliah` (
  `kode_matakuliah` int NOT NULL AUTO_INCREMENT,
  `nama_matakuliah` varchar(50) NOT NULL,
  `semester` int NOT NULL,
  `jenis_matakuliah` varchar(50) NOT NULL,
  `flag_aktif` varchar(15) NOT NULL,
  PRIMARY KEY (`kode_matakuliah`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_pengguna` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `level_pengguna` varchar(50) NOT NULL,
  `flag_aktif` varchar(15) NOT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

DROP TABLE IF EXISTS `ruangan`;
CREATE TABLE IF NOT EXISTS `ruangan` (
  `id_ruangan` int NOT NULL AUTO_INCREMENT,
  `nama_ruangan` varchar(20) NOT NULL,
  `kapasitas_ruangan` int NOT NULL,
  PRIMARY KEY (`id_ruangan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
CREATE TABLE IF NOT EXISTS `semester` (
  `id_semester` int NOT NULL,
  `nama_semester` varchar(50) NOT NULL,
  `tgl_awal_semester` date NOT NULL,
  `tgl_akhir_semester` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slot_waktu`
--

DROP TABLE IF EXISTS `slot_waktu`;
CREATE TABLE IF NOT EXISTS `slot_waktu` (
  `id_slot` int NOT NULL AUTO_INCREMENT,
  `waktu_slot_awal` time NOT NULL,
  `waktu_slot_akhir` time NOT NULL,
  `hari_slot` varchar(10) NOT NULL,
  PRIMARY KEY (`id_slot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
