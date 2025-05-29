-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 08:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ekstrakurikuler`
--

-- --------------------------------------------------------

--
-- Table structure for table `eskul`
--

CREATE TABLE `eskul` (
  `id_eskul` int(11) NOT NULL,
  `nama_eskul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `pembina` varchar(100) NOT NULL,
  `hari_kegiatan` varchar(10) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `kuota` int(11) DEFAULT NULL,
  `foto_eskul` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eskul`
--

INSERT INTO `eskul` (`id_eskul`, `nama_eskul`, `deskripsi`, `pembina`, `hari_kegiatan`, `jam_mulai`, `jam_selesai`, `lokasi`, `kuota`, `foto_eskul`) VALUES
(16, 'Robotik', 'gatau', 'Pal Adiw', 'senin', '12:14:00', '14:17:00', 'smkn 13 bandung', 2, NULL),
(17, 'Pramuka', 'jawa only', 'bu linda', 'selasa', '22:36:00', '22:40:00', 'lapangan', 13, NULL),
(18, 'piano', 'gatau', 'pak amba ', 'selasa', '12:06:00', '15:05:00', 'mulut', 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_eskul`
--

CREATE TABLE `pendaftaran_eskul` (
  `id_pendaftaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_eskul` int(11) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `status` enum('tunda','diterima','ditolak') NOT NULL DEFAULT 'tunda',
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran_eskul`
--

INSERT INTO `pendaftaran_eskul` (`id_pendaftaran`, `id_siswa`, `id_eskul`, `tanggal_daftar`, `status`, `keterangan`) VALUES
(22, 24, 16, '2025-05-15', 'tunda', 'gatau'),
(23, 24, 16, '2025-05-02', 'ditolak', 'gatau'),
(25, 24, 16, '2025-04-30', 'tunda', 'gatau'),
(26, 23, 16, '2025-05-09', 'diterima', 'gstsu'),
(27, 23, 16, '2025-05-01', 'tunda', 'gatau'),
(28, 24, 17, '2025-05-07', 'tunda', 'gatau'),
(29, 24, 16, '2025-05-14', 'tunda', 'gatau'),
(30, 23, 18, '2025-05-08', 'tunda', 'hallo');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('admin','pembina','pelatih') NOT NULL,
  `terakhir_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `nama_lengkap`, `role`, `terakhir_login`) VALUES
(19, 'radit', '$2y$10$EISH1mT/QC6nUl0Hz4wwCO9btwpaotjaM23u/HIPckq9GpeIicpXO', 'rafaditya', 'admin', NULL),
(22, 'rai', '$2y$10$bDE4fAloMNG75SCK.agm9OCvzDgXaXEKe6rSfMUZAKeICBNSfy7W2', '', 'admin', NULL),
(23, 'rafa', '$2y$10$a7tPPvLAqxApDPvCmcvj7.CK5dVQZ/noIpOHSVb279i2Q8CepgM0y', '', 'pembina', NULL),
(24, 'cucu', '$2y$10$qBhs.2BaNe86j37RN27egeAmDnL.sDFuuyvZLtyk66bR7sr03n9.2', '', 'pelatih', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_eskul` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status_hadir` enum('hadir','izin','sakit','alpa') NOT NULL,
  `status` enum('tunda','diterima','ditolak') NOT NULL DEFAULT 'tunda',
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id_presensi`, `id_siswa`, `id_eskul`, `tanggal`, `status_hadir`, `status`, `catatan`) VALUES
(29, 23, 17, '2025-05-18', 'hadir', 'tunda', 'yo'),
(30, 24, 16, '2025-05-18', 'sakit', 'tunda', 'oke'),
(31, 24, 16, '2025-05-18', 'sakit', 'tunda', 'oke'),
(33, 23, 17, '2025-05-23', 'hadir', 'tunda', 'gatau'),
(34, 23, 16, '2025-05-29', 'sakit', 'tunda', 'maaf pak');

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `nama_prestasi` varchar(100) NOT NULL,
  `tingkat` enum('sekolah','kecamatan','kabupaten','provinsi','nasional','internasional') NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `sertifikat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama_siswa`, `kelas`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `no_telp`, `email`, `foto_profil`) VALUES
(23, '12345678', 'farel', 'X RPL 2', 'L', '2025-05-09', 'gatau', '0892893892', 'farel@gmail.com', NULL),
(24, '12345', 'radit', 'X RPL 1', 'L', '2025-05-02', 'gatau', '0892893892', 'radit@gmail.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eskul`
--
ALTER TABLE `eskul`
  ADD PRIMARY KEY (`id_eskul`);

--
-- Indexes for table `pendaftaran_eskul`
--
ALTER TABLE `pendaftaran_eskul`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `pendaftaran_eskul_ibfk_1` (`id_eskul`),
  ADD KEY `pendaftaran_eskul_ibfk_2` (`id_siswa`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `presensi_ibfk_1` (`id_eskul`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `id_pendaftaran` (`id_pendaftaran`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eskul`
--
ALTER TABLE `eskul`
  MODIFY `id_eskul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pendaftaran_eskul`
--
ALTER TABLE `pendaftaran_eskul`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftaran_eskul`
--
ALTER TABLE `pendaftaran_eskul`
  ADD CONSTRAINT `pendaftaran_eskul_ibfk_1` FOREIGN KEY (`id_eskul`) REFERENCES `eskul` (`id_eskul`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftaran_eskul_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_1` FOREIGN KEY (`id_eskul`) REFERENCES `eskul` (`id_eskul`),
  ADD CONSTRAINT `presensi_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_ibfk_1` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran_eskul` (`id_pendaftaran`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
