-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 02:26 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_listrik_pascabayar`
--

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'superadmin'),
(2, 'petugas'),
(3, 'pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_tagihan` int(11) NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `biaya_admin` decimal(10,2) NOT NULL,
  `total_bayar` decimal(10,2) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_tagihan`, `tanggal_bayar`, `biaya_admin`, `total_bayar`, `id_petugas`) VALUES
(1, 1, '2025-07-10 07:54:27', '2500.00', '1354500.00', 2),
(2, 2, '2025-07-10 07:57:08', '2500.00', '678500.00', 2),
(3, 4, '2025-07-10 09:58:01', '2500.00', '678500.00', 2),
(4, 5, '2025-07-12 13:19:08', '2500.00', '1354500.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan`
--

CREATE TABLE `penggunaan` (
  `id_penggunaan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `meter_awal` int(11) NOT NULL,
  `meter_akhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penggunaan`
--

INSERT INTO `penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`) VALUES
(1, 4, 'Juli', 2025, 0, 1000),
(2, 4, 'Agustus', 2025, 1000, 1500),
(3, 4, 'September', 2025, 1500, 2000),
(4, 6, 'Juli', 2025, 0, 500),
(5, 7, 'Juli', 2025, 0, 1000),
(9, 4, 'Oktober', 2025, 2000, 2200);

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `id_penggunaan` int(11) NOT NULL,
  `jumlah_meter` int(11) NOT NULL,
  `jumlah_bayar` decimal(10,2) NOT NULL,
  `status` enum('Belum Lunas','Menunggu Konfirmasi','Lunas') NOT NULL DEFAULT 'Belum Lunas',
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `id_penggunaan`, `jumlah_meter`, `jumlah_bayar`, `status`, `tgl_dibuat`) VALUES
(1, 1, 1000, '1352000.00', 'Lunas', '2025-07-10 05:26:52'),
(2, 2, 500, '676000.00', 'Lunas', '2025-07-10 05:56:27'),
(3, 3, 500, '676000.00', 'Menunggu Konfirmasi', '2025-07-10 06:03:49'),
(4, 4, 500, '676000.00', 'Lunas', '2025-07-10 07:57:18'),
(5, 5, 1000, '1352000.00', 'Lunas', '2025-07-12 11:18:23'),
(9, 9, 200, '270400.00', 'Belum Lunas', '2025-07-13 13:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(11) NOT NULL,
  `kode_tarif` varchar(20) NOT NULL,
  `daya` varchar(50) NOT NULL,
  `tarif_per_kwh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `kode_tarif`, `daya`, `tarif_per_kwh`) VALUES
(1, 'TRF2025070001', '900VA', 1352),
(2, 'TRF2025070002', '1300VA', 1445),
(3, 'TRF2025070003', '2200VA', 1699);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nomor_kwh` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `id_tarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`, `nomor_kwh`, `alamat`, `id_level`, `id_tarif`) VALUES
(1, 'Super Administrator', 'superadmin', '$2y$10$acff6VDWt7QBXKgoY2Y7L.Z3VnoxhxOHghYEsD/YUXThpWMUROSme', NULL, NULL, 1, NULL),
(2, 'Andi Petugas', 'petugas01', '$2y$10$acff6VDWt7QBXKgoY2Y7L.Z3VnoxhxOHghYEsD/YUXThpWMUROSme', NULL, NULL, 2, NULL),
(4, 'Andrian Fakih', 'Adyan', '$2y$10$hh8YNoG1Nrcawofi7G2tUOLdHSbakE/8c6CCJCHElMmMBZ2Fv4n0C', '288239447752', 'Perumahan Pondok Maharta Blok A10 No,19', 3, 1),
(6, 'Nayla Rabiatul Hanifa', 'Naya', '$2y$10$C565UHbWbKEryjVnqbM0ruf1NcDt6joAcHkwCDE7pnuEkJ9ytNNq2', '2993846587618', 'Depok', 3, 1),
(7, 'M. Alfi Hamzami', 'alfie', '$2y$10$zChpwfT9eTbx5RvMDI1ez.zy1YGjSJFuJ93338SFw3u7vsKwkiw1a', '288477531232', 'Cisauk', 3, 1),
(8, 'Budi Santoso', 'budi', '$2y$10$w0BuhRTbbxKv6gL2aV59Nu5aDYLzKOiI3fC.e9bjsuJSCpL1gYhJ2', '541234567890', 'Jl. Soekarno Hatta No. 25', 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_tagihan` (`id_tagihan`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id_penggunaan`),
  ADD KEY `idx_penggunaan_pelanggan_id` (`id_pelanggan`),
  ADD KEY `idx_id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `id_penggunaan` (`id_penggunaan`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_tarif` (`id_tarif`),
  ADD KEY `fk_users_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penggunaan`
--
ALTER TABLE `penggunaan`
  MODIFY `id_penggunaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan` (`id_tagihan`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD CONSTRAINT `penggunaan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`id_penggunaan`) REFERENCES `penggunaan` (`id_penggunaan`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_level` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`),
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
