-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 04:10 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rjm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id_akun` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `jabatan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `nama_lengkap`, `username`, `password`, `jabatan`) VALUES
(1, 'administrator', 'manager', 'manager', 'manager'),
(2, 'direktur', 'spv', 'spv', 'spv'),
(3, 'hrd', 'hrd', 'hrd', 'hrd'),
(4, 'administrator', 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `department` varchar(25) NOT NULL,
  `kedisiplinan` int(11) NOT NULL,
  `prestasi` int(11) NOT NULL,
  `nilai_akhir` double NOT NULL,
  `rangking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`id_karyawan`, `nik`, `nama_karyawan`, `department`, `kedisiplinan`, `prestasi`, `nilai_akhir`, `rangking`) VALUES
(1, '201701234', 'Aan Firmansyah', 'Produksi', 0, 3, 0.6, 2),
(2, '202005018', 'Fauzan Wijanarko', 'Produksi', 2, 2, 0.5, 4),
(3, '201904106', 'Rizki Adi Wibowo', 'Produksi', 3, 4, 0.53, 3),
(4, '201904958', 'Anton Rusdiyanto', 'Produksi', 5, 1, 0.47, 5),
(5, '202311083', 'Muhamad Haerul Rizal', 'Produksi', 4, 5, 0.7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot_kriteria` double NOT NULL,
  `kategori` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot_kriteria`, `kategori`) VALUES
(1, 'Kedisiplinan', 30, 'Cost'),
(2, 'Kinerja', 20, 'Benefit'),
(3, 'Kerjasama Tim', 10, 'Benefit'),
(4, 'Keterampilan', 20, 'Benefit'),
(5, 'Prestasi', 20, 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id_laporan` int(11) NOT NULL,
  `berkas` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_laporan`
--

INSERT INTO `tb_laporan` (`id_laporan`, `berkas`, `tanggal`, `status`) VALUES
(1, 'Laporan Hasil Penilaian - 391717711599.pdf', 'Kamis, 07-12-2024', 1),
(2, 'Laporan Hasil Penilaian - 541717711614.pdf', 'Jumat, 07-06-2024', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_subkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`id_nilai`, `id_karyawan`, `id_kriteria`, `id_subkriteria`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 8),
(3, 1, 3, 14),
(4, 1, 4, 17),
(5, 1, 5, 23),
(6, 2, 1, 2),
(7, 2, 2, 8),
(8, 2, 3, 11),
(9, 2, 4, 18),
(10, 2, 5, 23),
(11, 3, 1, 2),
(12, 3, 2, 7),
(13, 3, 3, 12),
(14, 3, 4, 18),
(15, 3, 5, 24),
(16, 4, 1, 4),
(17, 4, 2, 9),
(18, 4, 3, 13),
(19, 4, 4, 19),
(20, 4, 5, 22),
(21, 5, 1, 3),
(22, 5, 2, 8),
(23, 5, 3, 14),
(24, 5, 4, 19),
(25, 5, 5, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tb_subkriteria`
--

CREATE TABLE `tb_subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_subkriteria` varchar(50) NOT NULL,
  `nilai_subkriteria` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_subkriteria`
--

INSERT INTO `tb_subkriteria` (`id_subkriteria`, `id_kriteria`, `nama_subkriteria`, `nilai_subkriteria`) VALUES
(1, 1, 'Tanpa Alpha', 1),
(2, 1, '1 s/d 3 Kali Alpha', 2),
(3, 1, '4 s/d 6 Kali Alpha', 3),
(4, 1, '7 s/d 10 Kali Alpha', 4),
(5, 1, '> 10 Kali alpha', 5),
(6, 2, 'Tidak baik', 1),
(7, 2, 'Kurang baik', 2),
(8, 2, 'Cukup baik', 3),
(9, 2, 'Baik', 4),
(10, 2, 'Sangat Baik', 5),
(11, 3, 'Tidak baik', 1),
(12, 3, 'Kurang baik', 2),
(13, 3, 'Cukup baik', 3),
(14, 3, 'Baik', 4),
(15, 3, 'Sangat Baik', 5),
(16, 4, 'Tidak baik', 1),
(17, 4, 'Kurang baik', 2),
(18, 4, 'Cukup baik', 3),
(19, 4, 'Baik', 4),
(20, 4, 'Sangat Baik', 5),
(21, 5, 'Tidak ada sertifikat', 1),
(22, 5, '1 Sertifikat', 2),
(23, 5, '2 s/d 3 Sertifikat', 3),
(24, 5, '4 s/d 5 Sertifikat', 4),
(25, 5, 'Lebih dari 5 sertifikat', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
