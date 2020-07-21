-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2020 at 04:08 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ambilKesimpulanLayak` (IN `nip` VARCHAR(20))  BEGIN
	DECLARE finished INT;	
	DECLARE jabatan_id INT ;
        DECLARE banyak_kelayakan INT;
        DECLARE banyak_data_kombinasi INT;
	DECLARE total_kegiatan_point DOUBLE;
	DECLARE curJabatan CURSOR FOR SELECT id FROM jabatans;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;

	CREATE TEMPORARY TABLE tabel_sementara_kesimpulan(
           jk_id varchar(100),
 	   banyak_data_kombinasi int,
           banyak_kelayakan int,
           total_kegiatan_point DOUBLE
        );

	OPEN curJabatan;

	getJabatan: LOOP
	    FETCH curJabatan INTO jabatan_id;
	    IF finished = 1 THEN 
		LEAVE getJabatan;
	    END IF;
            DROP TEMPORARY TABLE IF EXISTS tabel_sementara_kombinasi_kum_segment_dan_nilai_minimum;
            DROP TEMPORARY TABLE IF EXISTS tabel_sementara_nilai_minimum;
            DROP TEMPORARY TABLE IF EXISTS tabel_sementara_kum_segment;
            CREATE TEMPORARY TABLE tabel_sementara_kum_segment as select `jk_id`, `nama_jk`, SUM(`hasil_kegiatan_point`) as `total_kegiatan_point`, `komparasi` from `kum_segmented` WHERE `dosen_id` = `nip` GROUP BY `jk_id`;
            CREATE TEMPORARY TABLE tabel_sementara_nilai_minimum as select * from nilai_minimum where j_id = jabatan_id;
            CREATE TEMPORARY TABLE tabel_sementara_kombinasi_kum_segment_dan_nilai_minimum as select tabel_sementara_kum_segment.jk_id, tabel_sementara_kum_segment.nama_jk, tabel_sementara_kum_segment.total_kegiatan_point as tkp, tabel_sementara_nilai_minimum.hasil, IF(tabel_sementara_kum_segment.komparasi = 1, IF(tabel_sementara_kum_segment.total_kegiatan_point > tabel_sementara_nilai_minimum.hasil, 1, 0), IF(tabel_sementara_kum_segment.total_kegiatan_point < tabel_sementara_nilai_minimum.hasil, 1, 0)) AS kelayakan from tabel_sementara_nilai_minimum inner join tabel_sementara_kum_segment on tabel_sementara_nilai_minimum.jk_id = tabel_sementara_kum_segment.jk_id;
	    SELECT SUM(`tkp`) INTO total_kegiatan_point from `tabel_sementara_kombinasi_kum_segment_dan_nilai_minimum`;
            SELECT SUM(`kelayakan`) INTO banyak_kelayakan from `tabel_sementara_kombinasi_kum_segment_dan_nilai_minimum`;
            SELECT COUNT(*) INTO banyak_data_kombinasi from `tabel_sementara_kombinasi_kum_segment_dan_nilai_minimum`;
            INSERT INTO `tabel_sementara_kesimpulan` VALUES (jabatan_id, banyak_data_kombinasi, banyak_kelayakan, total_kegiatan_point);
        END LOOP;

	CLOSE curJabatan;

          SELECT tabel_sementara_kesimpulan.banyak_data_kombinasi, tabel_sementara_kesimpulan.banyak_kelayakan, tabel_sementara_kesimpulan.total_kegiatan_point, jabatans.nama_jabatan, jabatans.kum, IF(tabel_sementara_kesimpulan.banyak_kelayakan = tabel_sementara_kesimpulan.banyak_data_kombinasi, IF(tabel_sementara_kesimpulan.total_kegiatan_point >= jabatans.kum, "Layak", "Belum Layak"), "Belum Layak") AS kesimpulan FROM tabel_sementara_kesimpulan inner join jabatans on tabel_sementara_kesimpulan.jk_id = jabatans.id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id` int(11) NOT NULL,
  `j_id` int(2) UNSIGNED NOT NULL,
  `jk_id` int(2) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id`, `j_id`, `jk_id`, `nilai`) VALUES
(1, 1, 1, 55),
(2, 1, 2, 25),
(3, 1, 3, 10),
(4, 1, 4, 10),
(5, 2, 1, 45),
(6, 2, 2, 35),
(7, 2, 3, 10),
(8, 2, 4, 10),
(9, 3, 1, 45),
(10, 3, 2, 35),
(11, 3, 3, 10),
(12, 3, 4, 10),
(13, 4, 1, 40),
(14, 4, 2, 40),
(15, 4, 3, 10),
(16, 4, 4, 10),
(17, 5, 1, 40),
(18, 5, 2, 40),
(19, 5, 3, 10),
(20, 5, 4, 10),
(21, 6, 1, 40),
(22, 6, 2, 40),
(23, 6, 3, 10),
(24, 6, 4, 10),
(25, 7, 1, 35),
(26, 7, 2, 45),
(27, 7, 3, 10),
(28, 7, 4, 10),
(29, 8, 1, 35),
(30, 8, 2, 45),
(31, 8, 3, 10),
(32, 8, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `dosens`
--

CREATE TABLE `dosens` (
  `nip` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_dosen` varchar(250) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_tlp` varchar(15) DEFAULT NULL,
  `j_id` int(2) UNSIGNED NOT NULL,
  `mulai_menjabat` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosens`
--

INSERT INTO `dosens` (`nip`, `user_id`, `nama_dosen`, `alamat`, `no_tlp`, `j_id`, `mulai_menjabat`, `created_at`, `updated_at`) VALUES
('1123922321', 5, 'Dodit Mulyanto M.Kom', 'Jl Jeruk No 23 , Jakarta Pusat', '878722112', 1, '2018-11-15', '2020-07-13 09:08:40', '2020-07-13 16:17:45'),
('1203922334', 4, 'Dudidam Dudidam S.Kom M.Kom', 'Dadadudu didam', '819292212', 3, '2020-03-05', '2020-07-13 09:08:40', '2020-07-13 16:17:45'),
('1223422534', 6, 'Tami Nurhayati M.Kom', 'Jl Pepaya No 21 Kec.Buahan,Depok', '818223492', 1, '2018-12-04', '2020-07-13 09:14:22', '2020-07-13 16:17:45'),
('1234202020', 7, 'Dosen Tester ', 'Digital Address', '928392002', 1, '2019-07-15', '2020-07-13 09:23:59', '2020-07-13 16:27:41'),
('1239292933', 8, 'Dadi Sentosa M.Kom', 'Jl Naga 02 Kec.Buahan , Depok', '982737212', 1, '2019-08-05', '2020-07-13 09:23:59', '2020-07-13 16:27:41');

-- --------------------------------------------------------

--
-- Stand-in structure for view `hasil_pengajuan`
-- (See below for the actual view)
--
CREATE TABLE `hasil_pengajuan` (
`id` int(12)
,`dosen_id` varchar(20)
,`kk_id` int(11)
,`status` tinyint(1)
,`kegiatan_point` double
,`hasil_kegiatan_point` double
);

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
  `komparasi` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jeniskegiatans`
--

INSERT INTO `jeniskegiatans` (`id`, `nama_jk`, `deskripsi`, `komparasi`, `created_at`, `updated_at`) VALUES
(1, 'Kegiatan Pendidikan', 'Deskripsi dari kegiatan Pendidikan', 1, '2020-06-13 02:11:20', '2020-07-19 22:44:12'),
(2, 'Kegiatan Penelitian', 'Deskripsi dari kegiatan penelitian', 1, '2020-06-13 02:30:17', '2020-07-19 22:44:16'),
(3, 'Kegiatan Pengabdian Masyarakat', 'Deskripsi dari Pengabdian Masyarakat', -1, '2020-06-13 02:31:57', '2020-07-19 22:44:23'),
(4, 'Kegiatan Penunjang', 'Deskripsi dari Kegiatan Penunjang', -1, '2020-06-13 02:32:29', '2020-07-19 22:44:26');

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
(1, 1, 'Pendidikan Formal dan Memperoleh Gelar/Sebutan/Ijazah : (Doktor/Sederajat)', 200, 'Upload bukti tugas / Izin belajar dan Pindai Ijazah Asli', '2020-06-18 18:37:53', '2020-07-18 23:06:56'),
(2, 1, 'Mengikuti pendidikan formal dan memperoleh gelar (Magister/Sederajat)', 150, 'Upload bukti tugas / Izin belajar dan Pindai Ijazah Asli', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(3, 1, 'Mengikuti diklat prajabatan golongan III', 3, 'Upload bukti tugas / Izin belajar dan Pindai Ijazah Asli', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(4, 1, 'pelaksanaan Pendidikan Seperti Tutorial/Perkuliahan/Praktikum/Membimbing/Menguji:  Asisten Ahli (Beban mengajar 10 sks pertama)', 0.5, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-07-18 23:12:23'),
(5, 1, 'pelaksanaan Pendidikan Seperti Tutorial/Perkuliahan/Praktikum/Membimbing/Menguji: Asisten Ahli (Beban mengajar 2 sks berikutnya)', 0.25, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-07-18 23:16:02'),
(6, 1, 'pelaksanaan Pendidikan Seperti Tutorial/Perkuliahan/Praktikum/Membimbing/Menguji: Lektor/Lektor Kepala/Profesor (Beban mengajar 10 sks pertama)', 1, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-07-18 23:15:43'),
(7, 1, 'Melakukan pengajaran untuk peserta pendidikan dokter melalui tindakan medik spesialitik', 4, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(8, 2, 'Hasil penelitian yang dipublikasikan dalam bentuk buku (Buku Referensi) ', 40, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(9, 2, 'Hasil penelitian yang dipublikasikan dalam bentuk buku (Monograf) ', 20, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(10, 3, 'Menduduki jabatan pimpinan pada lembaga pemerintahan/pqabat negara yang hanrs dibebaskan dari jabatan organiknya tiap semester.', 5.5, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(11, 3, 'Melaksanakan pengembangan hasil pendidikan, dan penelitian yang dapat dimanfaatkan oleh masyaralat/indusrri setiap program', 3, 'Pindai SK Penugasan asli dan bukti kinerja.', '2020-06-18 18:37:53', '2020-07-19 00:11:13'),
(12, 4, ' Sebagai Ketua/Wakil Ketua merangkap Anggota, tiap tahun ', 3, 'Mmjadi anggota dalam suatu Panitia/Badan pada Perguruan Tinggi a Sebagai Ketua/Wakil Ketua merangkap Anggota, tiap tahun 3', '2020-06-18 18:37:53', '2020-06-19 01:37:53'),
(13, 4, 'Sebagai Anggota, tiap tahun', 2, 'Mmjadi anggota dalam suatu Panitia/Badan pada Perguruan Tinggi a Sebagai Ketua/Wakil Ketua merangkap Anggota, tiap tahun 3', '2020-06-18 18:37:54', '2020-07-19 00:04:17'),
(14, 1, 'Pendidikan Formal dan Memperoleh Gelar/Sebutan/Ijazah : (Magister/Sederajat)', 150, 'Upload bukti tugas / Izin belajar dan pindai Ijazah Asli', '2020-07-18 16:08:14', '2020-07-18 23:08:14'),
(15, 1, 'pelaksanaan Pendidikan Seperti Tutorial/Perkuliahan/Praktikum/Membimbing/Menguji: Lektor/Lektor Kepala/Profesor (Beban Mengajar 10 Sks Pertama)', 1, NULL, '2020-07-18 16:15:22', '2020-07-18 23:15:22'),
(16, 1, 'pelaksanaan Pendidikan Seperti Tutorial/Perkuliahan/Praktikum/Membimbing/Menguji: Lektor/Lektor Kepala/Profesor (Beban mengajar 2 sks berikutnya)', 0.5, NULL, '2020-07-18 16:16:44', '2020-07-18 23:16:44'),
(17, 1, 'Melakukan pengajaran untuk  peserta   pendidikan dokter melalui tindakan medik spesialistik', 4, 'Pindai SK penugasan dan bukti Kinerja', '2020-07-18 16:23:01', '2020-07-18 23:23:01'),
(18, 1, 'Melakukan pengajaran   Konsultasi spesialis  kepada peserta   pendidikan dokter', 2, 'Pindai SK Penugasan dan bukti kinerja', '2020-07-18 16:25:17', '2020-07-18 23:25:17'),
(19, 1, 'Melakukan pemeriksaan luar dengan pembimbingan terhadap peserta   pendidikan dokter', 2, 'Pindai SK\r\nPenugasan dan\r\nbukti kinerja', '2020-07-18 16:28:21', '2020-07-18 23:28:21'),
(20, 1, 'Melakukan pemeriksaan dalam dengan pembimbingan terhadap peserta   pendidikan dokter', 3, 'Pindai SK\r\nPenugasan dan\r\nbukti kinerja', '2020-07-18 16:30:54', '2020-07-18 23:30:54'),
(21, 1, 'Menjadi saksi ahli dengan  pembimbingan terhadap peserta pendidikan dokter', 1, 'Pindai SK\r\nPenugasan dan\r\nbukti kinerja', '2020-07-18 16:31:32', '2020-07-18 23:31:32'),
(22, 1, 'Membimbing seminar mahasiswa (setiap mahasiswa)', 1, 'Pindai Sk penugasan asli dan bukti kerja', '2020-07-18 16:33:03', '2020-07-18 23:33:03'),
(23, 2, 'Hasil penelitian atau hasil pemikiran dalam buku yang dipublikasikan dan berisi berbagai tulisan dari berbagai penulis (book chapter):  International', 15, 'Pindai Halaman Sampul, daftar isi dan bukti kinerja', '2020-07-18 16:43:07', '2020-07-18 23:43:07'),
(24, 2, 'Hasil penelitian atau hasil pemikiran dalam buku yang dipublikasikan dan berisi berbagai tulisan dari berbagai penulis (book chapter): Nasional', 10, 'Pindai halaman\r\nsampul, daftar isi dan bukti kinerja', '2020-07-18 16:45:20', '2020-07-18 23:45:20'),
(25, 2, 'Hasil penelitian atau hasil pemikiran yang dipublikasikan: Jurnal internasional bereputasi (terindek pada database internasional bereputasi dan berfaktor dampak)', 40, 'Pindai halaman\r\nsampul, daftar\r\nisi, dewan\r\nredaksi/\r\nredaksi\r\npelaksana dan\r\nbukti kinerja', '2020-07-18 16:46:25', '2020-07-18 23:46:25'),
(26, 2, 'Hasil penelitian atau hasil pemikiran yang dipublikasikan: Jurnal internasional terindek pada database internasional bereputasi', 30, 'Pindai halaman\r\nsampul, daftar\r\nisi,dewan\r\nredaksi/\r\nredaksi\r\npelaksana dan\r\nbukti kinerja', '2020-07-18 16:47:34', '2020-07-18 23:47:34'),
(27, 2, 'Hasil penelitian atau hasil pemikiran yang dipublikasikan: Jurnal internasional terindeks pada database internasional di luar kategori 2)', 20, 'Pindai halaman\r\nsampul, daftar\r\nisi, redaksi\r\npelaksana dan\r\nbukti kinerja', '2020-07-18 16:49:56', '2020-07-18 23:49:56'),
(28, 2, 'Hasil penelitian atau hasil pemikiran yang dipublikasikan: Jurnal Nasional terakreditasi', 25, 'Pindai halaman\r\nsampul, daftar\r\nisi, dewan\r\nredaksi/\r\nredaksi\r\npelaksana dan\r\nbukti kinerja', '2020-07-18 16:52:27', '2020-07-18 23:52:27'),
(29, 2, 'Hasil penelitian atau hasil pemikiran yang dipublikasikan: a. Jurnal Nasional berbahasa Indonesia  terindek pada DOAJ  b. Jurnal Nasional berbahasa  Inggris atau bahasa resmi (PBB)  terindek pada DOAJ', 15, 'Pindai halaman\r\nsampul, daftar\r\nisi, redaksi\r\npelaksana dan \r\nbukti kinerja', '2020-07-18 16:55:55', '2020-07-18 23:55:55'),
(30, 2, 'Hasil penelitian atau hasil pemikiran yang dipublikasikan: Jurnal Nasional', 10, 'Pindai halaman\r\nsampul, dewan\r\nredaksi/\r\nredaksi \r\npelaksana\r\n,daftar isi dan\r\nbukti kinerja', '2020-07-18 17:00:39', '2020-07-19 00:00:39'),
(31, 2, 'Hasil penelitian atau hasil pemikiran yang dipublikasikan: Jurnal ilmiah yang ditulis dalam Bahasa Resmi PBB namun tidak memenuhi syarat-syarat sebagai jurnal ilmiah internasional', 10, 'Pindai halaman\r\nsampul, dewan\r\nredaksi/\r\nredaksi\r\npelaksana\r\n,daftar isi dan\r\nbukti kinerja', '2020-07-18 17:01:26', '2020-07-19 00:01:26'),
(32, 4, 'Menjadi anggota panitia/badan pada lembaga  pemerintah Pusat: Ketua/Wakil Ketua, tiap kepanitiaan', 3, NULL, '2020-07-18 17:05:05', '2020-07-19 00:05:05'),
(33, 4, 'Menjadi anggota panitia/badan pada lembaga pemerintah Pusat:  Anggota, tiap kepanitiaan', 2, NULL, '2020-07-18 17:05:48', '2020-07-19 00:05:48'),
(34, 4, 'Menjadi anggota panitia/badan pada lembaga  pemerintah Daerah :  Ketua/Wakil Ketua, tiap kepanitiaan', 2, NULL, '2020-07-18 17:07:09', '2020-07-19 00:07:09'),
(35, 4, 'Menjadi anggota panitia/badan pada lembaga  pemerintah Daerah: Anggota, tiap kepanitiaan', 1, NULL, '2020-07-18 17:08:17', '2020-07-19 00:08:17'),
(36, 3, 'Memberi pelayanan kepada masyarakat atau kegiatan lain yang menunjang pelaksanaan  tugas pemerintahan dan pembangunan: Berdasarkan bidang keahlian, tiap program', 1.5, NULL, '2020-07-18 17:15:36', '2020-07-19 00:15:36'),
(37, 3, 'Memberi pelayanan kepada masyarakat atau kegiatan lain yang menunjang pelaksanaan  tugas pemerintahan dan pembangunan :  Berdasarkan penugasan  lembaga terguruan tinggi,  tiap program', 1, NULL, '2020-07-18 17:16:01', '2020-07-19 00:16:01'),
(38, 3, 'Memberi pelayanan kepada masyarakat atau kegiatan lain yang menunjang pelaksanaan  tugas pemerintahan dan pembangunan: Berdasarkan fungsi/jabatan tiap program', 0.5, NULL, '2020-07-18 17:16:34', '2020-07-19 00:16:34');

-- --------------------------------------------------------

--
-- Stand-in structure for view `kum_segmented`
-- (See below for the actual view)
--
CREATE TABLE `kum_segmented` (
`id` int(12)
,`dosen_id` varchar(20)
,`kk_id` int(11)
,`jk_id` int(2)
,`nama_jk` varchar(250)
,`komparasi` int(11)
,`status` tinyint(1)
,`kegiatan_point` double
,`hasil_kegiatan_point` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `nilai_minimum`
-- (See below for the actual view)
--
CREATE TABLE `nilai_minimum` (
`id` int(11)
,`j_id` int(2) unsigned
,`nama_jabatan` varchar(255)
,`kum` int(11)
,`jk_id` int(2)
,`nama_jk` varchar(250)
,`nilai` double
,`hasil` double
);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuanaks`
--

CREATE TABLE `pengajuanaks` (
  `id` int(12) NOT NULL,
  `dosen_id` varchar(20) NOT NULL,
  `kk_id` int(11) NOT NULL,
  `file` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajuanaks`
--

INSERT INTO `pengajuanaks` (`id`, `dosen_id`, `kk_id`, `file`, `status`, `note`, `created_at`, `updated_at`) VALUES
(11, '1234202020', 2, '35-Article Text-122-2-10-20181114.pdf', 2, NULL, '2020-07-18 23:42:01', '2020-07-19 07:09:14'),
(12, '1234202020', 23, '1445-3051-1-SM.pdf', 1, NULL, '2020-07-18 23:44:13', '2020-07-19 07:09:34'),
(13, '1234202020', 9, '12949-26650-1-PB.pdf', 1, NULL, '2020-07-18 23:47:20', '2020-07-19 07:09:27'),
(14, '1223422534', 2, 'ACFrOgC6Nb1Yr07Rw7DytzsAHdWJsFCR6C8xw6eYT29h9ruEgpdcUpMJajXQ1NGvxmHZSo7plf7A8jq9Oynnwf-m_B_Xyi7OGjL3xqcS8Y88dGOAfmNp94cgZI83zkcxuZGBj9s9Mzlh4UyyQ6ns.pdf', 1, NULL, '2020-07-18 23:55:22', '2020-07-19 07:08:20'),
(15, '1223422534', 24, 'ACFrOgC6Nb1Yr07Rw7DytzsAHdWJsFCR6C8xw6eYT29h9ruEgpdcUpMJajXQ1NGvxmHZSo7plf7A8jq9Oynnwf-m_B_Xyi7OGjL3xqcS8Y88dGOAfmNp94cgZI83zkcxuZGBj9s9Mzlh4UyyQ6ns.pdf', 1, NULL, '2020-07-18 23:55:34', '2020-07-19 07:08:32'),
(16, '1223422534', 28, 'webassembly.pdf', 1, NULL, '2020-07-18 23:56:03', '2020-07-19 07:08:41'),
(17, '1223422534', 10, 'us-cons-supply-chain-meets-blockchain.pdf', 1, NULL, '2020-07-19 02:14:33', '2020-07-19 09:15:06'),
(18, '1223422534', 34, 'Yusuf Durachman.pdf', 1, NULL, '2020-07-19 02:14:45', '2020-07-19 09:15:12'),
(19, '1223422534', 35, 'Buku_MSPROJECT2007.pdf', 1, NULL, '2020-07-19 02:31:56', '2020-07-19 09:32:09'),
(20, '1223422534', 30, 'CV.pdf', 1, NULL, '2020-07-20 01:32:56', '2020-07-20 08:34:33'),
(21, '1223422534', 31, 'CV_2.pdf', 1, NULL, '2020-07-20 01:39:19', '2020-07-20 08:40:08'),
(22, '1223422534', 9, '06071303.pdf', 1, NULL, '2020-07-20 01:42:54', '2020-07-20 08:43:03');

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
(2, 2, 'Penilai', '$2y$10$.4yzPJ3.Nutl/yBohhO2med5rSMFWgTTug641Ks8CJ2jEEzh0mmW.', 'penilai@penilai.com', 'default.png', NULL, '2020-07-13 02:07:55', '2020-07-13 09:07:55'),
(3, 2, 'Penilai', '$2y$10$o.oVXuptchLBNYiF7FhLAelArO9kfluq.LJQ89HhoK0Vuj0zk8FJS', 'penilai2@penilai.com', 'default.png', NULL, '2020-07-13 02:07:56', '2020-07-13 09:07:56'),
(4, 3, 'dudidam', '$2y$10$A5HVtYf126S/klgXZNuPieK1Tr7dUQDRNnFRTL48YJ1bBSZaOFbsu', 'dudiam@dosen.com', 'default.png', NULL, '2020-07-13 02:07:56', '2020-07-13 16:22:07'),
(5, 3, 'dodimul', '$2y$10$UVtyRg2XNDWLCKJeweUPLeqsWY4mA2A99Z5ou9gktgackvUxK3Q4.', 'dodit.mulyanto@dosen.com', 'default.png', NULL, '2020-07-13 02:07:56', '2020-07-13 16:22:13'),
(6, 3, 'Tamtam', '$2y$10$y3Qe2ELcBHEJcPBYSWIjyexEYlFabXhdX0ThAFTjKZD4h5HhvwGkG', 'tami.nurhayati@dosen.com', 'default.png', NULL, '2020-07-13 02:07:56', '2020-07-13 16:22:26'),
(7, 3, 'Dosentester', '$2y$10$4mBFrJdsffp5A7vRvr3Y9e9X7ALaGxkUayBqfYiQylGMtPl.kKcRq', 'dosen@dosen.com', 'default.png', NULL, '2020-07-13 02:07:56', '2020-07-13 16:28:35'),
(8, 3, 'Dadi880', '$2y$10$ojn0QtihT2i59ElSlFjyXOYaWQ1sEKICwS2/5djP3rYG6kMTa6/ZS', 'dadi.sentosa@dosen.com', 'default.png', NULL, '2020-07-13 02:07:56', '2020-07-13 16:22:54'),
(9, 1, 'Admin', '$2y$10$Jcxe14wBpTddDiYgokqk0uJyLCU6NxAVehQ9XyG08RXN8xtqnOUeO', 'admin2@admin.com', 'default.png', NULL, '2020-07-13 02:07:55', '2020-07-13 09:07:55');

-- --------------------------------------------------------

--
-- Structure for view `hasil_pengajuan`
--
DROP TABLE IF EXISTS `hasil_pengajuan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hasil_pengajuan`  AS  select `pengajuanaks`.`id` AS `id`,`pengajuanaks`.`dosen_id` AS `dosen_id`,`pengajuanaks`.`kk_id` AS `kk_id`,`pengajuanaks`.`status` AS `status`,`komponenkegiatans`.`kegiatan_point` AS `kegiatan_point`,if(`pengajuanaks`.`status` = 1,`komponenkegiatans`.`kegiatan_point`,0) AS `hasil_kegiatan_point` from (`pengajuanaks` join `komponenkegiatans` on(`pengajuanaks`.`kk_id` = `komponenkegiatans`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `kum_segmented`
--
DROP TABLE IF EXISTS `kum_segmented`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kum_segmented`  AS  select `pengajuanaks`.`id` AS `id`,`pengajuanaks`.`dosen_id` AS `dosen_id`,`pengajuanaks`.`kk_id` AS `kk_id`,`komponenkegiatans`.`jk_id` AS `jk_id`,`jeniskegiatans`.`nama_jk` AS `nama_jk`,`jeniskegiatans`.`komparasi` AS `komparasi`,`pengajuanaks`.`status` AS `status`,`komponenkegiatans`.`kegiatan_point` AS `kegiatan_point`,if(`pengajuanaks`.`status` = 1,`komponenkegiatans`.`kegiatan_point`,0) AS `hasil_kegiatan_point` from ((`pengajuanaks` join `komponenkegiatans` on(`pengajuanaks`.`kk_id` = `komponenkegiatans`.`id`)) join `jeniskegiatans` on(`komponenkegiatans`.`jk_id` = `jeniskegiatans`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `nilai_minimum`
--
DROP TABLE IF EXISTS `nilai_minimum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nilai_minimum`  AS  select `bobot_kriteria`.`id` AS `id`,`bobot_kriteria`.`j_id` AS `j_id`,`jabatans`.`nama_jabatan` AS `nama_jabatan`,`jabatans`.`kum` AS `kum`,`bobot_kriteria`.`jk_id` AS `jk_id`,`jeniskegiatans`.`nama_jk` AS `nama_jk`,`bobot_kriteria`.`nilai` AS `nilai`,`bobot_kriteria`.`nilai` / 100 * `jabatans`.`kum` AS `hasil` from ((`bobot_kriteria` join `jabatans` on(`bobot_kriteria`.`j_id` = `jabatans`.`id`)) join `jeniskegiatans` on(`bobot_kriteria`.`jk_id` = `jeniskegiatans`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bobot_kriteria_ibfk_1` (`j_id`),
  ADD KEY `bobot_kriteria_ibfk_2` (`jk_id`);

--
-- Indexes for table `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `nip_unique` (`nip`),
  ADD UNIQUE KEY `tlp_unique` (`no_tlp`),
  ADD KEY `dosens_ibfk_1` (`j_id`),
  ADD KEY `dosens_ibfk_2` (`user_id`);

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
  ADD KEY `pengajuanaks_ibfk_4` (`kk_id`),
  ADD KEY `pengajuanaks_ibfk_1` (`dosen_id`);

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
-- AUTO_INCREMENT for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pengajuanaks`
--
ALTER TABLE `pengajuanaks`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`j_id`) REFERENCES `jabatans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bobot_kriteria_ibfk_2` FOREIGN KEY (`jk_id`) REFERENCES `jeniskegiatans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dosens`
--
ALTER TABLE `dosens`
  ADD CONSTRAINT `dosens_ibfk_1` FOREIGN KEY (`j_id`) REFERENCES `jabatans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dosens_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `komponenkegiatans`
--
ALTER TABLE `komponenkegiatans`
  ADD CONSTRAINT `komponenkegiatans_ibfk_1` FOREIGN KEY (`jk_id`) REFERENCES `jeniskegiatans` (`id`);

--
-- Constraints for table `pengajuanaks`
--
ALTER TABLE `pengajuanaks`
  ADD CONSTRAINT `pengajuanaks_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosens` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuanaks_ibfk_4` FOREIGN KEY (`kk_id`) REFERENCES `komponenkegiatans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
