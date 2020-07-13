-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2020 at 06:25 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skrps`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvaldatas`
--

CREATE TABLE `approvaldatas` (
  `id` int(11) NOT NULL,
  `pak_id` int(12) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dosens`
--

CREATE TABLE `dosens` (
  `nip` int(20) NOT NULL,
  `nama_dosen` varchar(250) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_tlp` int(15) DEFAULT NULL,
  `j_id` int(2) UNSIGNED NOT NULL,
  `mulai_menjabat` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosens`
--

INSERT INTO `dosens` (`nip`, `nama_dosen`, `alamat`, `no_tlp`, `j_id`, `mulai_menjabat`, `created_at`, `updated_at`) VALUES
(128200321, 'Dosen Kedua', 'Jalan Kedua No 32. Rt 07 RW 05', 878723144, 1, '2012-09-30', '2020-07-12 03:30:15', '2020-07-12 10:30:15'),
(130200332, 'Dudy Dudidam', 'Dadidam no 12 RT 05 Rw 10, Kec.LancarJaya', 878723223, 2, '2011-07-22', '2020-07-12 03:31:32', '2020-07-12 10:31:32'),
(481200332, 'Dosen Pertama', 'Dosen ABC Alamatnya Jl.Bundar bulat', 2123949923, 1, '2012-07-22', '2020-07-12 03:28:50', '2020-07-12 10:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `jabatans`
--

CREATE TABLE `jabatans` (
  `id` int(2) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kum` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatans`
--

INSERT INTO `jabatans` (`id`, `nama_jabatan`, `kum`, `created_at`, `updated_at`) VALUES
(1, 'Asisten Ahli', 100, '2020-06-10 01:50:08', '2020-06-10 01:50:08'),
(2, 'Lektor (Penata Gol III/C)', 200, '2020-06-10 01:50:08', '2020-06-10 01:50:08'),
(3, 'Lektor (Penata Tingkat I Gol III/D)', 300, '2020-06-10 01:50:08', '2020-06-10 01:50:08'),
(4, 'Lektor Kepala (Pembina Gol IV/A)', 400, '2020-06-10 01:50:08', '2020-06-10 01:50:08'),
(5, 'Lektor Kepala (Pembina Tingkat 1 Gol IV/B)', 550, '2020-06-10 01:50:08', '2020-06-10 01:50:08'),
(6, 'Lektor Kepala (Pembina Utama Muda Gol IV/C)', 700, '2020-06-10 01:50:08', '2020-06-10 01:50:08'),
(7, 'Guru Besar / Prof. (Pembina Utama Muda Gol IV/D)', 800, '2020-06-10 01:50:08', '2020-06-10 01:50:08'),
(8, 'Guru Besar / Prof. (Pembina Utama Gol IV/E)', 950, '2020-06-10 01:50:08', '2020-06-10 01:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `jeniskegiatans`
--

CREATE TABLE `jeniskegiatans` (
  `id` int(2) NOT NULL,
  `nama_jk` varchar(250) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jeniskegiatans`
--

INSERT INTO `jeniskegiatans` (`id`, `nama_jk`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Kegiatan Pendidikan', 'Deskripsi dari kegiatan Pendidikan', '2020-06-13 02:11:20', '2020-06-13 09:21:11'),
(2, 'Kegiatan Penelitian', 'Deskripsi dari kegiatan penelitian', '2020-06-13 02:30:17', '2020-06-13 09:30:17'),
(3, 'Kegiatan Pengabdian Masyarakat', 'Deskripsi dari Pengabdian Masyarakat', '2020-06-13 02:31:57', '2020-06-13 09:31:57'),
(4, 'Kegiatan Penunjang', 'Deskripsi dari Kegiatan Penunjang', '2020-06-13 02:32:29', '2020-06-13 09:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `komponenkegiatans`
--

CREATE TABLE `komponenkegiatans` (
  `id` int(11) NOT NULL,
  `jk_id` int(2) NOT NULL,
  `nama_kegiatan` varchar(250) NOT NULL,
  `kegiatan_point` double NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komponenkegiatans`
--

INSERT INTO `komponenkegiatans` (`id`, `jk_id`, `nama_kegiatan`, `kegiatan_point`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pendidikan', 200, 'Upload bukti tugas / Izin belajar dan Pindai Ijazah Asli', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(2, 1, 'Mengikuti pendidikan formal dan memperoleh gelar (Magister/Sederajat)', 150, 'Upload bukti tugas / Izin belajar dan Pindai Ijazah Asli', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(3, 1, 'Mengikuti diklat prajabatan golongan III', 3, 'Upload bukti tugas / Izin belajar dan Pindai Ijazah Asli', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(4, 1, 'Asisten Ahli (Beban mengajar 10 sks pertama) ', 0.5, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(5, 1, 'Asisten Ahli (Beban mengajar 2 sks pertama) ', 0.25, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(6, 1, 'Lektor/Lektor Kepala/Profesor (Beban mengajar 10 sks pertama) ', 1, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(7, 1, 'Melakukan pengajaran untuk peserta pendidikan dokter melalui tindakan medik spesialitik', 4, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(8, 2, 'Hasil penelitian yang dipublikasikan dalam bentuk buku (Buku Referensi) ', 40, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(9, 2, 'Hasil penelitian yang dipublikasikan dalam bentuk buku (Monograf) ', 20, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(10, 3, 'Menduduki jabatan pimpinan pada lembaga pemerintahan/pqabat negara yang hanrs dibebaskan dari jabatan organiknya tiap semester.', 5.5, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(11, 3, 'Melaksanakan pengembangan hasil pendidikan, dan penelitian yang dapat dimanfaatkan oleh masyaralat/indusrri setiap program', 20, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(12, 4, ' Sebagai Ketua/Wakil Ketua merangkap Anggota, tiap tahun ', 3, 'Mmjadi anggota dalam suatu Panitia/Badan pada Perguruan Tinggi a Sebagai Ketua/Wakil Ketua merangkap Anggota, tiap tahun 3', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(13, 4, 'Sebagai Anggota, tiap tahun ', 20, 'Mmjadi anggota dalam suatu Panitia/Badan pada Perguruan Tinggi a Sebagai Ketua/Wakil Ketua merangkap Anggota, tiap tahun 3', '2020-06-18 18:37:54', '2020-06-19 01:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuanaks`
--

CREATE TABLE `pengajuanaks` (
  `id` int(12) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dosen_id` int(20) DEFAULT NULL,
  `kk_id` int(11) NOT NULL,
  `files` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `poindosen`
--

CREATE TABLE `poindosen` (
  `id` int(11) NOT NULL,
  `dosen_id` int(20) NOT NULL,
  `point` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(2) NOT NULL,
  `role` varchar(12) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Administrator dapat mengubah data data, yang berkaitan dengan website ini', '2020-06-14 06:25:00', '2020-06-14 13:25:00'),
(2, 'Penilai', 'Penilai Adalah User yang  hanya memiliki akses Aproval data pengajuan kum dari Dosen', '2020-06-14 06:25:56', '2020-06-14 13:25:56'),
(3, 'dosen', 'Dosen mengajukan nilai', '2020-07-06 00:07:35', '2020-07-06 07:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(2) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL DEFAULT 'default.png',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin Dua', '$2y$10$MrLuJyONDnfPKZj8HYMAxeuQeneQh3oC6mmY2R6.7ut4/57IqQmHy', 'admin2@admin.com', '1593440002.jpg', NULL, '2020-07-05 18:07:52', '2020-07-12 07:41:39'),
(2, 2, 'penilai01', '$2y$10$o/SJY6Yt4btg984eDHO.kOtd6ymb4LHqrQ8mMAbkdHvWskRjXphsW', 'penilai@penilai.com', 'default.png', NULL, '2020-07-05 18:07:53', '2020-07-06 01:07:53'),
(3, 3, 'Dosen Ku', '$2y$10$jIs/IerHNIsJbt33Bl3XYOlrWOo.EQXH4qkpRpK5Zd1MxZ6Eeryxq', 'dosen@dosen.com', 'default.png', NULL, '2020-07-05 18:07:53', '2020-07-06 01:07:53'),
(4, 1, 'admin01', '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19', 'admin@admin.com', 'default.png', NULL, '2020-07-06 01:08:37', '2020-07-06 08:10:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvaldatas`
--
ALTER TABLE `approvaldatas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pak_constraint` (`pak_id`);

--
-- Indexes for table `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `nip_unique` (`nip`),
  ADD UNIQUE KEY `tlp_unique` (`no_tlp`),
  ADD KEY `j_id` (`j_id`);

--
-- Indexes for table `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jeniskegiatans`
--
ALTER TABLE `jeniskegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komponenkegiatans`
--
ALTER TABLE `komponenkegiatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jk_id` (`jk_id`);

--
-- Indexes for table `pengajuanaks`
--
ALTER TABLE `pengajuanaks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `pengajuanak_ibfk_4` (`kk_id`);

--
-- Indexes for table `poindosen`
--
ALTER TABLE `poindosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approvaldatas`
--
ALTER TABLE `approvaldatas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jeniskegiatans`
--
ALTER TABLE `jeniskegiatans`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `komponenkegiatans`
--
ALTER TABLE `komponenkegiatans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pengajuanaks`
--
ALTER TABLE `pengajuanaks`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poindosen`
--
ALTER TABLE `poindosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approvaldatas`
--
ALTER TABLE `approvaldatas`
  ADD CONSTRAINT `pak_constraint` FOREIGN KEY (`pak_id`) REFERENCES `pengajuanaks` (`id`);

--
-- Constraints for table `dosens`
--
ALTER TABLE `dosens`
  ADD CONSTRAINT `dosens_ibfk_1` FOREIGN KEY (`j_id`) REFERENCES `jabatans` (`id`);

--
-- Constraints for table `komponenkegiatans`
--
ALTER TABLE `komponenkegiatans`
  ADD CONSTRAINT `komponenkegiatans_ibfk_1` FOREIGN KEY (`jk_id`) REFERENCES `jeniskegiatans` (`id`);

--
-- Constraints for table `pengajuanaks`
--
ALTER TABLE `pengajuanaks`
  ADD CONSTRAINT `pengajuanaks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pengajuanaks_ibfk_2` FOREIGN KEY (`dosen_id`) REFERENCES `dosens` (`nip`),
  ADD CONSTRAINT `pengajuanaks_ibfk_4` FOREIGN KEY (`kk_id`) REFERENCES `komponenkegiatans` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
