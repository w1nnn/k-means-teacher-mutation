-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 03, 2024 at 02:03 PM
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
  `nama_guru` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `masa_kerja` varchar(255) NOT NULL,
  `jam_kerja` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `proses_pembelajaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int NOT NULL,
  `nip` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_guru` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '-',
  `jabatan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '-',
  `masa_kerja` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `satuan_pendidikan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '-',
  `jam_kerja` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `jenis_kelamin` enum('Pilih','L','P') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Pilih',
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nip`, `nama_guru`, `jabatan`, `masa_kerja`, `satuan_pendidikan`, `jam_kerja`, `jenis_kelamin`, `foto`) VALUES
(1, '196405211984111003', 'Ruslan Abdul Gani,S.Pd', 'Guru Matematika', '40', 'Sd Negeri 35 Dumme', '>25', 'L', '048fd8218cd931296b632284d6817ac3.jpg'),
(2, '198002062010012024', 'Ernawati Arta S.Pd', 'Guru Matematika', '14', 'Sd Negeri 5 Lappa', '18-24', 'P', '0b2ee098dcd5a221c3c0017dfaa1a5d1.jpg'),
(3, '197612072006042023', 'Wardawati, S.Pd', 'Guru Bahasa Inggris', '18', 'Sd Negeri 4 Balangnipa', '18-24', 'P', '3a8be9899a05ddd31e4930de62f2afd4.jpg'),
(4, '196512312021112040', 'Rosmiati, S.Pd', 'Guru Seni Budaya', '3', 'Sd Negeri 31 Panaikang', '10-17', 'P', 'abb6e9dd81d39559675c5025b627f3d1.jpg'),
(5, '197311242010012003', 'Widyawati, S. Pd', 'Guru IPS', '14', 'Sd Negeri No. 20 Kodingare', '18-24', 'P', '19fd40e4023e5f9513ada599c250f2eb.jpg'),
(6, '197806072010012028', 'Roslinah, S.Pd', 'Guru Agama', '14', 'Sd Negeri 45 Lempangan', '18-24', 'P', '0b2ee098dcd5a221c3c0017dfaa1a5d1.jpg'),
(7, '196710121989102002', 'Muliati S,Pd', 'Guru Bahasa Indonesia', '35', 'Sd Negeri 24 Biringere', '18-24', 'P', 'f206eabc270a9b5d081deb8f67fb4918.jpg'),
(8, '198504122021042006', 'Rina Anggriana, S.Pd', 'Guru Penjaskes', '3', 'Sd Negeri 82 Tokinjong', '10-17', 'P', '6aa7928f4101df4205d12d15a54e3a2e.jpeg'),
(9, '197001052010012003', 'Nurjannah, S.Pd', 'Guru Agama', '14', 'Sd Negeri 63 Tombolo', '18-24', 'P', 'f49a569657dbf34ef9dabb4db3ac302c.jpg'),
(10, '197208021995051001', 'Arhamuudding, S.Pd', 'Guru IPA', '29', 'Sd Negeri 88 Jennae', '10-17', 'L', 'da2f5b06dee2b55d8aa8ca7a9b156390.jpg'),
(11, '199509182020122009', 'Sunarti, S.Pd', 'Guru Matematika', '4', 'Sd Negeri 160 Boropao', '18-24', 'P', 'f6c5f2696059b1230929c08bd241d7ae.jpg'),
(12, '198503012019032010', 'Hartati, S.Pd', 'Guru IPA', '5', 'Sd Negeri 65 Kompang', '10-17', 'P', 'ded66276f21d334169e42ce78e18bcf8.jpg'),
(13, '199011122019031016', 'M. Azhar, S.Pd', 'Guru Bahasa Inggris', '5', 'Sd Negeri 83 Aruhu', '>25', 'L', 'da2f5b06dee2b55d8aa8ca7a9b156390.jpg'),
(14, '198510052020122001', 'Fatmawati S, S.Pd', 'Guru Seni Budaya', '4', 'Sd Negeri 220 Salohe', '18-24', 'P', '8e902b6b70b407352ea0b5d4a9802e68.jpg'),
(15, '198608122019031004', 'Dedi Miswar, S.Pd', 'Guru IPS', '5', 'Sd Negeri 52 Pude', '10-17', 'L', 'd730e1657a4a8f4363eb95b742bd364d.jpg'),
(16, '198002122010012015', 'Wardaningsih, S.Pd', 'Guru Seni Budaya', '14', 'Sd Negeri 87 Manipi', '>25', 'P', '111d7b37e0286426f333cbea92f3e4c5.jpg'),
(17, '198905152020121003', 'Masdedi, S.Pd.I', 'Guru Matematika', '4', 'Sd Negeri No 21 Batang Lampe', '10-17', 'L', '29ec2b92635269e4ad723e621cb06923.jpg'),
(18, '199408242020122009', 'Nurdiawati, S.Pd', 'Guru Agama', '4', 'Sd Negeri 16 Liang-liang', '18-24', 'P', '3a8be9899a05ddd31e4930de62f2afd4.jpg'),
(19, '196612311988032094', 'ST.Sunarti Noer, S.Pd', 'Guru Bahasa Indonesia', '36', 'Sd Negeri No. 39 Pattongko', '10-17', 'P', '660695fd873226e2db7632f50f0a44bf.jpg'),
(20, '198612192019032005', 'Listuliawati, S.Pd', 'Guru Seni Budaya', '5', 'Sd Negeri 95 Jatie', '>25', 'P', '650222be2044ec9d4f3f63fcafdbc099.jpg'),
(21, '199310062019032020', 'Nurul Islamiyah, S.Pd', 'Guru Matematika', '5', 'Sd Negeri 139 Larea-rea', '10-17', 'P', 'd5c325a012344e0905aa10ffaa9c08a2.jpg'),
(22, '197108251996032005', 'Oji', 'Guru IPS', '28', 'Sd Negeri 124 Lura', '18-24', 'P', '2ed953e4a96e311e0a2e8e0d7833541f.jpg'),
(23, '197207021997032006', 'Risal Rifandi, S.Pd', '-', '0', '-', '0', 'Pilih', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil_evaluasi`
--

CREATE TABLE `tb_hasil_evaluasi` (
  `id_hasil_evaluasi` int NOT NULL,
  `nama_guru` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cluster` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `euclidean` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tahun_evaluasi` year NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kebutuhan`
--

CREATE TABLE `tb_kebutuhan` (
  `id_sekolah` int NOT NULL,
  `npsn` varchar(10) NOT NULL,
  `nama_sekolah` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `guru_matematika` int NOT NULL DEFAULT '0',
  `guru_bahasa_indonesia` int NOT NULL DEFAULT '0',
  `guru_penjaskes` int NOT NULL DEFAULT '0',
  `guru_ipa` int NOT NULL DEFAULT '0',
  `guru_ips` int NOT NULL DEFAULT '0',
  `guru_agama` int NOT NULL DEFAULT '0',
  `guru_seni_budaya` int NOT NULL DEFAULT '0',
  `guru_bahasa_ingris` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_kebutuhan`
--

INSERT INTO `tb_kebutuhan` (`id_sekolah`, `npsn`, `nama_sekolah`, `kecamatan`, `guru_matematika`, `guru_bahasa_indonesia`, `guru_penjaskes`, `guru_ipa`, `guru_ips`, `guru_agama`, `guru_seni_budaya`, `guru_bahasa_ingris`) VALUES
(1, '40304435', 'Sd Negeri 35 Dumme', 'Kec. Sinjai Timur', 0, 0, 0, 0, 0, 0, 0, 0),
(2, '40304427', 'Sd Negeri No. 48 Lappae', 'Kec. Tellu Limpoe', 0, 0, 0, 0, 0, 0, 0, 0),
(3, '40314323', 'Sdn No. 251 Balappangi', 'Kec. Bulupoddo', 0, 0, 0, 0, 0, 0, 0, 0),
(4, '40304687', 'Sd Negeri 170 Bontoheru', 'Kec. Tellu Limpoe', 0, 0, 0, 0, 0, 0, 0, 0);

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
(2, 'Proses Pembelajaran'),
(3, 'Jam Kerja');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_kriteria`
--

CREATE TABLE `tb_sub_kriteria` (
  `id_sub_kriteria` int NOT NULL,
  `nama_sub_kriteria` varchar(255) NOT NULL,
  `bobot` double NOT NULL,
  `kriteria_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_sub_kriteria`
--

INSERT INTO `tb_sub_kriteria` (`id_sub_kriteria`, `nama_sub_kriteria`, `bobot`, `kriteria_id`) VALUES
(2, '>10', 20, 1),
(3, '<10', 10, 1),
(4, 'Baik', 45, 2),
(5, 'Cukup', 30, 2),
(6, 'Kurang', 15, 2),
(7, '>25', 75, 3),
(8, '18-24', 50, 3),
(9, '10-17', 25, 3);

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
-- Indexes for table `tb_kebutuhan`
--
ALTER TABLE `tb_kebutuhan`
  ADD PRIMARY KEY (`id_sekolah`);

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
  MODIFY `id_evaluasi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_hasil_evaluasi`
--
ALTER TABLE `tb_hasil_evaluasi`
  MODIFY `id_hasil_evaluasi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kebutuhan`
--
ALTER TABLE `tb_kebutuhan`
  MODIFY `id_sekolah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
