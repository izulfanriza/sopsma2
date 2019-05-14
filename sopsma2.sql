-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2019 at 04:32 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sopsma2`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_siswas`
--

CREATE TABLE `detail_siswas` (
  `id_detail_siswa` int(22) NOT NULL,
  `nominal_sop` int(22) DEFAULT NULL,
  `aksi` enum('terkunci','tidak-terkunci') NOT NULL DEFAULT 'tidak-terkunci',
  `nis` varchar(22) NOT NULL,
  `id_kelas` int(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(22) NOT NULL,
  `tingkat_kelas` enum('X','XI','XII') NOT NULL,
  `jurusan_kelas` enum('MIA','IS') NOT NULL,
  `kode_kelas` enum('1','2','3','4','5') NOT NULL,
  `aksi` enum('terkunci','tidak-terkunci') NOT NULL DEFAULT 'tidak-terkunci',
  `id_tahun_ajaran` int(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswas`
--

CREATE TABLE `siswas` (
  `nis` varchar(22) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tempat_lahir` varchar(22) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_wali` varchar(50) NOT NULL,
  `no_hp_wali` varchar(50) NOT NULL,
  `status` enum('aktif','non-aktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajarans`
--

CREATE TABLE `tahun_ajarans` (
  `id_tahun_ajaran` int(22) NOT NULL,
  `tahun_ajaran` varchar(22) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('aktif','non-aktif') NOT NULL DEFAULT 'non-aktif',
  `aksi` enum('terkunci','tidak-terkunci') NOT NULL DEFAULT 'tidak-terkunci'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajarans`
--

INSERT INTO `tahun_ajarans` (`id_tahun_ajaran`, `tahun_ajaran`, `tanggal_mulai`, `tanggal_selesai`, `status`, `aksi`) VALUES
(32, '2017/2018', '2017-08-07', '2018-07-06', 'aktif', 'terkunci'),
(33, '2018/2019', '2018-07-23', '2019-06-14', 'non-aktif', 'terkunci');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id_transaksi` int(22) NOT NULL,
  `tanggal_transaksi` datetime DEFAULT CURRENT_TIMESTAMP,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `status` enum('belum-rekap','sudah-rekap') DEFAULT 'belum-rekap',
  `id_detail_siswa` int(22) NOT NULL,
  `id_petugas` int(22) NOT NULL,
  `tanggal_rekap` date DEFAULT NULL,
  `id_petugas_rekap` int(22) DEFAULT NULL,
  `tanggal_setor` date DEFAULT NULL,
  `status_setor` enum('belum-setor','sudah-setor') DEFAULT 'belum-setor',
  `id_petugas_setor` int(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(22) NOT NULL,
  `nama_petugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('sarpras','tu','admin','superadmin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tu',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_petugas`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(23, 'Meikawati, S.Kom', 'meikawati@gmail.com', '$2y$10$0ufQgzgjDAgOBWVfZ6U4Qe0rQBDgWtEzeFeLbUvyimcJiuckMsmvm', 'admin', 'iZDvHI24yt8csgReBUShQdifCnvBlTmjSVRSdkCJ5GtY41MtACWVJd0S7SRn', NULL, '2018-05-26 00:41:55'),
(49, 'Cahyono, S.Kom, M.Pd', 'cahyono@gmail.com', '$2y$10$b73HAh7Sno73HCUcE1C92O5vs.SWFjE6U90zyseTSZ9epwpyVf25S', 'superadmin', 'iUhUbwtfLR0tpxCplSKksw5PFNuEIUpR5jSnqd7CWH3U6HvWzgxNK9R4PvyQ', NULL, NULL),
(50, 'Dwi Setyorini, S.Pd.', 'dwisetyorini@gmail.com', '$2y$10$shW9qQfi0wHCWY9Ybkge5.LzOoWy4v36c5lXQY0qKH8p5EiQkpw8C', 'sarpras', 'Kr8lB0mkqpO5jOkH6K9jzgm4u3gghVuhJ60PvOQDex2iitWEkBnlPQcpGDTS', NULL, NULL),
(51, 'Riyo Lukisworo, S.Pd.', 'riyolukisworo@gmail.com', '$2y$10$jrqvy.LC4D/ai11iM0CGrOOrXRESRdxJyVRIjVvnqwGBAGYJK0mfi', 'sarpras', NULL, NULL, NULL),
(52, 'Cintya Dwi N, S.Pd.', 'cintyadwin@gmail.com', '$2y$10$jmeZFlAtX8LgMd2O.XaCYu3ZLaPXG48mm.yjOCRvGZ.jts8WJrkD2', 'sarpras', NULL, NULL, NULL),
(53, 'Fatmawati', 'fatmawati@gmail.com', '$2y$10$l2qAezNypgkc8rvKaarT7.FuSsylIiqUlSXURQ4/JKIuXScA.A7c6', 'tu', 'rqxmVRa6i111Tt5yMgKjo9iymFn8EGVqsaJGjGhMkunIROjLcV0ZUfrGkFvZ', NULL, NULL),
(54, 'Aenal Maun', 'aenalmaun@gmail.com', '$2y$10$/wZv6xpl70ZmMJafAOOKtuhdqIKytvk1yP8Ui0vKOAIeRx4eqAqly', 'tu', 'Im05JgAm5aNl60QSdt42gTBw6vjYfNPQ9579mXBXFhKFSJuuih8SNNGiPbKl', NULL, NULL),
(58, 'Susmiyati', 'susmiyati@gmail.com', '$2y$10$Vo/8lxWyxhx9hiHAZTU/CuCu3az1I02RgYIh0pQT0V2vUwtGRMYNW', 'tu', NULL, NULL, NULL),
(59, 'Dra. Sri Utakari Amanah, M.Si', 'sriutakari@gmail.com', '$2y$10$SqHGjd7kaPNAk0KLgmZWuuvHS6G7gC90vlKyOzW6zm5b44YRJfn0O', 'admin', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_siswas`
--
ALTER TABLE `detail_siswas`
  ADD PRIMARY KEY (`id_detail_siswa`),
  ADD KEY `nis` (`nis`,`id_kelas`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_tahun_ajaran` (`id_tahun_ajaran`);

--
-- Indexes for table `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  ADD PRIMARY KEY (`id_tahun_ajaran`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `nis` (`id_detail_siswa`,`id_petugas`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_petugas_2` (`id_petugas`),
  ADD KEY `id_petugas_setor` (`id_petugas_setor`),
  ADD KEY `id_petugas_rekap` (`id_petugas_rekap`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_siswas`
--
ALTER TABLE `detail_siswas`
  MODIFY `id_detail_siswa` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  MODIFY `id_tahun_ajaran` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id_transaksi` int(22) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_siswas`
--
ALTER TABLE `detail_siswas`
  ADD CONSTRAINT `detail_siswas_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_siswas_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswas` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajarans` (`id_tahun_ajaran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksis_ibfk_3` FOREIGN KEY (`id_petugas_setor`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksis_ibfk_4` FOREIGN KEY (`id_petugas_rekap`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksis_ibfk_5` FOREIGN KEY (`id_detail_siswa`) REFERENCES `detail_siswas` (`id_detail_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
