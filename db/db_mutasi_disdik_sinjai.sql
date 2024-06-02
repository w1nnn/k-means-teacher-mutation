-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 25, 2024 at 02:32 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mutasi_disdik_sinjai`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_lengkap`, `username`, `password`, `foto`) VALUES
(1, 'Fitriani', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_evaluasi`
--

CREATE TABLE `tb_evaluasi` (
  `id_evaluasi` int NOT NULL,
  `nip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `masa_kerja` varchar(255) NOT NULL,
  `proses_mengajar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jam_kerja` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kebutuhan_sekolah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_evaluasi`
--

INSERT INTO `tb_evaluasi` (`id_evaluasi`, `nip`, `masa_kerja`, `proses_mengajar`, `jam_kerja`, `kebutuhan_sekolah`) VALUES
(5, '196405211984111003', '>20', 'Baik', '>25', 'Tersedia'),
(6, '196910252006041007', '>10', 'Cukup', '10-17', 'Tersedia'),
(7, '197112312000051003', '<10', 'Cukup', '>25', 'Tersedia'),
(8, '199509182020122009', '>10', 'Baik', '>25', 'Tidak Tersedia'),
(9, '198009262022212017', '>20', 'Kurang', '10-17', 'Tidak Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int NOT NULL,
  `nip` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_guru` varchar(120) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `satuan_pendidikan` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nip`, `nama_guru`, `jabatan`, `satuan_pendidikan`, `jenis_kelamin`, `foto`) VALUES
(5, '196405211984111003', 'Nirwah R S.Pd', 'Guru Agama', 'SD Muhammadiyah Sinjai', 'P', 'LILIS-SINTAMI-ERTIFA-S.Pd_-scaled.jpg'),
(11, '197612312006042063', 'Surtia Mada S.Pd', 'Guru Seni Budaya', 'SD Negeri6 Paruntu', 'P', 'SUCI-ERNINGSIH-S-scaled.jpg'),
(12, '196910252006041007', 'Tamrin, S.Pd.I', 'Guru Bahasa Inggris', 'SD Negeri 5 Lappa', 'L', 'guru (4).jpg'),
(13, '198009262022212017', 'A. Hermiati.S.Pd', 'Guru Matematika', 'SD Negeri 105 Bonto', 'P', 'guru (13).jpg'),
(14, '196912311999031023', 'Fauziah Ruslan ABD Gani, S.Pd', 'Guru IPS', 'SD Negeri 124 Lura', 'P', 'guru (7).jpg'),
(15, '197112312000051003', 'Ramlah', 'Guru IPA', 'SD Negeri 95 Jatie', 'P', 'guru (10).jpg'),
(16, '199509182020122009', 'Sunarti, S.Pd', 'Guru Bahasa Inggris', 'SD Negeri 151 Kanalo I', 'P', 'guru (14).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil_evaluasi`
--

CREATE TABLE `tb_hasil_evaluasi` (
  `id_hasil_evaluasi` int NOT NULL,
  `layak` varchar(20) NOT NULL,
  `tidak_layak` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tahun` year NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_hasil_evaluasi`
--

INSERT INTO `tb_hasil_evaluasi` (`id_hasil_evaluasi`, `layak`, `tidak_layak`, `tahun`) VALUES
(26, '196405211984111003', '197112312000051003', '2024'),
(27, '196910252006041007', '199509182020122009', '2024'),
(28, '', '198009262022212017', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nama_kriteria`) VALUES
(1, 'Masa Kerja'),
(2, 'Proses Mengajar'),
(3, 'Jam Kerja'),
(4, 'Kebutuhan Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_kriteria`
--

CREATE TABLE `tb_sub_kriteria` (
  `id_sub_kriteria` int NOT NULL,
  `nama_sub_kriteria` varchar(255) NOT NULL,
  `bobot` int NOT NULL,
  `kriteria_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_sub_kriteria`
--

INSERT INTO `tb_sub_kriteria` (`id_sub_kriteria`, `nama_sub_kriteria`, `bobot`, `kriteria_id`) VALUES
(1, '>20', 3, 1),
(2, '>10', 2, 1),
(3, '<10', 1, 1),
(4, 'Baik', 3, 2),
(5, 'Cukup', 2, 2),
(6, 'Kurang', 1, 2),
(7, '>25', 3, 3),
(8, '18-24', 2, 3),
(9, '10-17', 1, 3),
(10, 'Tersedia', 1, 4),
(11, 'Tidak Tersedia', 0, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_evaluasi`
--
ALTER TABLE `tb_evaluasi`
  ADD PRIMARY KEY (`id_evaluasi`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tb_hasil_evaluasi`
--
ALTER TABLE `tb_hasil_evaluasi`
  ADD PRIMARY KEY (`id_hasil_evaluasi`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `kriteria_id` (`kriteria_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_evaluasi`
--
ALTER TABLE `tb_evaluasi`
  MODIFY `id_evaluasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_hasil_evaluasi`
--
ALTER TABLE `tb_hasil_evaluasi`
  MODIFY `id_hasil_evaluasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
  MODIFY `id_sub_kriteria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_sub_kriteria`
--
ALTER TABLE `tb_sub_kriteria`
  ADD CONSTRAINT `tb_sub_kriteria_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `tb_kriteria` (`id_kriteria`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
