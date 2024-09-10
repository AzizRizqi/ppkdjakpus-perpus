-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 10:30 AM
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
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama_lengkap`, `nisn`, `jenis_kelamin`, `alamat`, `no_telp`, `created_at`, `updated_at`) VALUES
(3, 'Aziz Rizqi', '31212312', 'Laki - Laki', 'Strategi V', '082121312', '2024-08-07 02:53:47', '2024-08-16 04:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_terbit` varchar(5) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `id_kategori`, `judul`, `jumlah`, `penerbit`, `tahun_terbit`, `penulis`, `created_at`, `updated_at`) VALUES
(2, 2, 'Nihil minim esse dol', 96, 'Qui veritatis autem ', '2014', 'Quis minus culpa qui', '2024-08-07 06:27:36', '2024-08-12 03:46:52'),
(3, 1, 'Dolores est necessi', 60, 'Odio autem minima mo', '2012', 'Dicta ducimus qui r', '2024-08-07 07:12:43', '2024-08-12 04:32:15'),
(4, 1, 'Voluptas at pariatur', 32, 'Dicta cupidatat aspe', '2022', 'Sint in quis odit qu', '2024-08-07 07:12:49', '2024-08-12 04:32:20'),
(5, 2, 'Aspernatur fugiat pr', 74, 'Corrupti aut mollit', '2320', 'Dolor labore neque f', '2024-08-07 07:12:56', '2024-08-12 04:32:24'),
(6, 1, 'Impedit dolorem dol', 92, 'Illum odio non fugi', '2021', 'Culpa maiores qui d', '2024-08-07 07:22:11', '2024-08-12 04:32:30'),
(7, 1, 'Perspiciatis iure r', 3, 'Fuga Aut libero eli', '2623', 'Atque voluptate dolo', '2024-08-07 07:22:25', '2024-08-12 04:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjam`
--

CREATE TABLE `detail_peminjam` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_peminjam`
--

INSERT INTO `detail_peminjam` (`id`, `id_peminjaman`, `id_buku`, `id_kategori`) VALUES
(1, 6, 0, 2),
(2, 6, 0, 1),
(3, 7, 0, 2),
(4, 8, 0, 2),
(5, 8, 0, 2),
(6, 9, 0, 2),
(7, 10, 0, 2),
(8, 11, 0, 2),
(9, 12, 0, 2),
(10, 13, 2, 2),
(11, 14, 5, 2),
(12, 1, 2, 2),
(13, 2, 4, 1),
(14, 2, 5, 2),
(15, 3, 2, 2),
(16, 4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Horor', 'Serem borrrr', '2024-07-31 07:03:16', '2024-07-31 07:03:16'),
(2, 'Romantis', 'Gitar ku petik bas ku betot hai nyonya cantik mari kita berdansa', '2024-07-31 07:07:09', '2024-08-07 07:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `nama_level` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `nama_level`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin dapat mengoprasikan apa pun', '2024-07-31 06:54:53', '2024-07-31 06:54:53'),
(3, 'Sekertaris', 'Mengatur ', '2024-07-31 06:59:03', '2024-07-31 06:59:03'),
(5, 'Petugas', 'asdasd', '2024-07-31 07:06:33', '2024-07-31 07:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_transaksi` varchar(30) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_anggota`, `id_user`, `kode_transaksi`, `tgl_pinjam`, `tgl_kembali`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 8, 'PJ12082024001', '2024-08-12', '2024-08-14', 2, '2024-08-16 08:11:16', '2024-08-16 08:11:16', 1),
(2, 3, 8, 'PJ13082024002', '2024-08-15', '2024-08-20', 2, '2024-08-16 08:20:16', '2024-08-16 08:20:16', 0),
(3, 3, 2, 'PJ16082024003', '2024-08-16', '2024-08-23', 2, '2024-08-16 08:23:04', '2024-08-16 08:23:04', 0),
(4, 3, 2, 'PJ16082024004', '2024-08-16', '2024-08-23', 1, '2024-08-16 08:23:33', '2024-08-16 08:23:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `kode_pengembalian` varchar(30) NOT NULL,
  `denda` double NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `terlambat` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `id_peminjaman`, `kode_pengembalian`, `denda`, `tgl_pengembalian`, `terlambat`, `created_at`, `updated_at`) VALUES
(1, 0, '', 2000000, '0000-00-00', 0, '2024-08-16 08:00:56', '2024-08-16 08:00:56'),
(2, 0, '', 0, '0000-00-00', 0, '2024-08-16 08:01:08', '2024-08-16 08:01:08'),
(3, 1, '', 2000000, '2024-08-28', 0, '2024-08-16 08:11:16', '2024-08-16 08:11:16'),
(4, 2, '', 0, '2024-08-21', 0, '2024-08-16 08:20:16', '2024-08-16 08:20:16'),
(5, 3, '', 0, '2024-08-16', 0, '2024-08-16 08:23:04', '2024-08-16 08:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_level`, `nama_lengkap`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, 1, 'Aziz Rizqi', 'aziz@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '2024-07-29 02:14:45', '2024-08-16 02:41:56'),
(8, 3, 'Sasaa ', 'sasa@gmail.com', 'f84ad3b72a615736f88ac23b43a6d4861164739b', '2024-07-31 04:05:33', '2024-08-07 02:37:40'),
(9, 0, '', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '2024-08-07 04:06:46', '2024-08-07 04:06:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `detail_peminjam`
--
ALTER TABLE `detail_peminjam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_peminjam`
--
ALTER TABLE `detail_peminjam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
