-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2021 at 09:53 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ormale_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `agenda` varchar(128) NOT NULL,
  `id_kegiatan` int(5) NOT NULL,
  `minggu_1` date NOT NULL,
  `minggu_2` date NOT NULL,
  `minggu_3` date NOT NULL,
  `minggu_4` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `agenda`, `id_kegiatan`, `minggu_1`, `minggu_2`, `minggu_3`, `minggu_4`) VALUES
(1, 'rapat', 1, '2020-09-01', '2020-09-08', '2020-09-14', '2020-09-21'),
(2, 'rapat', 0, '2020-09-02', '2020-09-09', '2020-09-16', '2020-09-23'),
(3, 'acara', 0, '2020-09-05', '2020-09-12', '2020-09-19', '2020-09-26');

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `nama_file` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`id`, `nama`, `nama_file`) VALUES
(7, 'surat peminjaman alat', '001 peminjaman apk zoom.doc'),
(8, 'surat narasumber', '002 permohonan narasumber.doc'),
(10, 'lpj ngobral', 'LPJ NGOBRAL 3.docx'),
(11, 'proposal ngobral', 'LPJ NGOBRAL 3.docx'),
(12, 'tempate pengusulan SK', 'Template Pengusulan SK Kepengurusan Tahun 2020 (1).doc'),
(13, 'kipli', 'DRAFT_PKL_OPAL.docx'),
(14, 'DOKUMEN KAMPUS', 'ARTIKEL_AQIL_ZAMANI.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `jumlah_barang` varchar(128) NOT NULL,
  `kondisi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id`, `nama_barang`, `jumlah_barang`, `kondisi`) VALUES
(4, 'proyektor', '1 buah', 'terawat'),
(26, 'hard book', '2', 'baik');

-- --------------------------------------------------------

--
-- Table structure for table `kalender`
--

CREATE TABLE `kalender` (
  `id` int(11) NOT NULL,
  `nama_agenda` varchar(64) NOT NULL,
  `id_kegiatan` int(5) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kalender`
--

INSERT INTO `kalender` (`id`, `nama_agenda`, `id_kegiatan`, `keterangan`, `start`, `end`) VALUES
(10, 'rapat', 10000, 'rapat mubes', '2020-12-10', '2020-12-12'),
(11, 'rapat persiapan mubes', 10000, 'mantappppe', '2021-03-01', '2021-03-29'),
(12, 'acara', 20000, 'lkmm-tpd', '2021-03-03', '2021-03-05'),
(13, 'acara', 20000, 'lkmm-td', '2021-03-18', '2021-03-20'),
(14, 'acara', 0, '', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `kas_pengurus`
--

CREATE TABLE `kas_pengurus` (
  `id` int(11) NOT NULL,
  `id_pengurus` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kas_pengurus`
--

INSERT INTO `kas_pengurus` (`id`, `id_pengurus`, `tanggal`, `nominal`) VALUES
(1, 3, '2021-05-17', 3000),
(2, 3, '2021-06-01', 5000),
(3, 6, '2020-11-28', 3000),
(6, 23, '2021-07-17', 2000),
(7, 13, '2021-07-15', 1000),
(8, 13, '2021-07-17', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `pelaksanaan`
--

CREATE TABLE `pelaksanaan` (
  `id` int(5) NOT NULL,
  `id_prog` int(11) NOT NULL,
  `nama_kegiatan` varchar(50) NOT NULL,
  `id_proposal` int(5) UNSIGNED ZEROFILL NOT NULL,
  `file_proposal` varchar(120) NOT NULL,
  `tgl_pelaksanaan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelaksanaan`
--

INSERT INTO `pelaksanaan` (`id`, `id_prog`, `nama_kegiatan`, `id_proposal`, `file_proposal`, `tgl_pelaksanaan`) VALUES
(2, 2, 'RAKER', 03001, 'Artikel_PKL_Ilham_H_P__Naufal.pdf', '2021-05-01'),
(19, 9, 'MUBES', 00000, 'Ahmad_Taufiqi_Muhsinin_17670010.docx', '2021-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `semester` int(11) NOT NULL,
  `periode1` int(32) NOT NULL,
  `periode2` int(32) NOT NULL,
  `NPM` int(15) NOT NULL,
  `foto_pengurus` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`id`, `nama`, `semester`, `periode1`, `periode2`, `NPM`, `foto_pengurus`) VALUES
(3, 'Sukma Maulana Hakim ', 5, 2021, 2022, 18670006, 'default.jpg'),
(4, 'Ikhwan Dienullah', 3, 2023, 2025, 19670099, 'default.jpg'),
(5, 'Refika Latarofa', 5, 2021, 2022, 18670023, 'default.jpg'),
(6, 'Ananda Putri Sangfajri', 3, 2021, 2022, 19670042, 'default.jpg'),
(7, 'Zalfa As Syifa’', 5, 2021, 2022, 18670069, 'default.jpg'),
(8, 'Ahmad Nizar Zulmi', 3, 2021, 2022, 19670058, 'default.jpg'),
(9, 'Mona Rizqa', 5, 2021, 2022, 18670030, 'default.jpg'),
(10, 'finka cindy antika', 3, 2021, 2022, 17670010, 'default.jpg'),
(11, 'Mustaqfirin', 3, 2021, 2022, 19670034, 'default.jpg'),
(12, 'Huzaifah Hamyu Muzakkir', 3, 2021, 2022, 19670088, 'default.jpg'),
(13, 'Dhimas Aria Wardhana', 5, 2021, 2022, 18670012, 'default.jpg'),
(14, 'Gerardo Ahmad Rananta', 3, 2021, 2022, 19670053, 'default.jpg'),
(15, 'Kharisma Felix Ardiyanto', 3, 2021, 2022, 19670065, 'default.jpg'),
(16, 'Alviena Emelia Nur', 3, 2021, 2022, 19670074, 'default.jpg'),
(17, 'Amelia Nur Alifah', 5, 2021, 2022, 18670072, 'default.jpg'),
(18, 'Shilfatun Nur Dini', 5, 2021, 2022, 18670024, 'default.jpg'),
(19, 'Yoan Ayub Rizky Permadi', 3, 2021, 2022, 19670039, 'default.jpg'),
(20, 'Susri Haningsih', 3, 2021, 2022, 19670060, 'default.jpg'),
(21, 'Zayin Kuroma', 5, 2021, 2022, 18670081, 'default.jpg'),
(22, 'Irza Maulana', 3, 2021, 2022, 19670012, 'default.jpg'),
(23, 'ahmad', 9, 2021, 2022, 17670010, 'mantap.jpg'),
(24, 'taufiqi', 9, 2021, 2023, 17670010, 'mantap.pjp');

-- --------------------------------------------------------

--
-- Table structure for table `pertanggungjwb`
--

CREATE TABLE `pertanggungjwb` (
  `id` int(5) NOT NULL,
  `nama_kegiatan` varchar(50) NOT NULL,
  `id_prog` int(5) NOT NULL,
  `id_pelaksanaan` int(11) NOT NULL,
  `link_dokumentasi` varchar(120) NOT NULL,
  `hasil` varchar(50) NOT NULL,
  `id_lpj` int(5) NOT NULL,
  `lpj` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pertanggungjwb`
--

INSERT INTO `pertanggungjwb` (`id`, `nama_kegiatan`, `id_prog`, `id_pelaksanaan`, `link_dokumentasi`, `hasil`, `id_lpj`, `lpj`) VALUES
(6, 'RAKER', 2, 2, 'https://www.google.com', 'belum dikonfirmasi', 0, 'ahmad_taufiqi_mmuhsinin_(CV).pdf'),
(13, 'MUBES', 9, 19, 'https://youtube.com', 'belum dikonfirmasi', 0, 'user_simalungun.xlsx');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(5) NOT NULL,
  `nama_prog` varchar(50) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `sasaran` varchar(50) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `id_agenda` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `nama_prog`, `tujuan`, `sasaran`, `deskripsi`, `id_agenda`) VALUES
(2, 'RAKER', 'menyusun rancangan anggaran dan program kerja', 'internal himpunan mahasiswa informatika', 'rapat kerja pengurus himfoma', '2021-01-01'),
(3, 'SARASEHAN', 'merekatkan hubungan dosen dan mahasiswa informatik', 'dosen dan mahasiswa ', 'sarasehan mahasiswa infomatika ', '2021-05-01'),
(9, 'MUBES', 'mendemisionerkan pengurus lama dan mengangkat calo', 'pengurus lama dan calon pengurus baru', 'musyawarah besar', '2021-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen`
--

CREATE TABLE `tb_absen` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_absen`
--

INSERT INTO `tb_absen` (`id`, `nama`, `jenis`, `start`, `end`, `keterangan`) VALUES
(1, 'ahmad taufiqi', 'liburan', '2020-12-02', '2020-12-07', 'liburan panjang karena hamil'),
(2, 'syafa aini', 'CUTI', '2020-12-01', '2020-12-04', 'cuti liburan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `date_created`) VALUES
(27, 'Dosen Pengawas', 'arianipuspa40@gmail.com', 'default.png', '$2y$10$L0IW7j88F4r./KgzVVYH9uBTFqVXzIo2IswCooKUDUCJE2uWS3wRa', 1, 1599225620),
(28, 'himforma', 'ahmadtaufiky@gmail.com', 'himforma2.png', '$2y$10$pzB5XhWlsr1qFwSzYsa2BO3jZluZzmlKpryCEkl4JgSRBJY1LrZ2q', 2, 1599226441),
(29, 'dosen pengawas', 'pakbambang@upgris.ac.id', 'default.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1581481262),
(30, 'ahmad taufiqi', 'kipli@gmail.com', 'default.jpg', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1618489082);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(30, 2, 2),
(31, 2, 3),
(32, 2, 4),
(33, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(120) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `icon`) VALUES
(1, 'Pengawas', 'fab fa-leanpub'),
(2, 'Kegiatan', 'fas fa-bookmark'),
(3, 'Kepengurusan', 'fas fa-users'),
(4, 'Prestasi', 'fas fa-medal'),
(5, 'Kalender', 'fas fa-calendar');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `is_active`) VALUES
(1, 3, 'dashboard', 'Kepengurusan', 1),
(2, 3, 'keuangan', 'Kepengurusan/keuangan', 1),
(3, 3, 'inventaris', 'Kepengurusan/inventaris', 1),
(4, 3, 'pengurus', 'Kepengurusan/pengurus', 1),
(5, 2, 'perencanaan', 'Kegiatan/perencanaan', 1),
(6, 2, 'pelaksanaan', 'Kegiatan/pelaksanaan', 1),
(7, 2, 'pertanggungjawaban', 'Kegiatan/pertanggungjwb', 1),
(8, 5, 'timeline', 'Kalender', 1),
(9, 4, 'Prestasi mahasiswa', 'Prestasi', 1),
(18, 1, 'dashboard', 'Pengawas', 1),
(19, 1, 'prestasi', 'pengawas/prestasi', 1),
(20, 1, 'laporan kegiatan', 'Pengawas/lapKegiatan', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kalender`
--
ALTER TABLE `kalender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kas_pengurus`
--
ALTER TABLE `kas_pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertanggungjwb`
--
ALTER TABLE `pertanggungjwb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `kalender`
--
ALTER TABLE `kalender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kas_pengurus`
--
ALTER TABLE `kas_pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pertanggungjwb`
--
ALTER TABLE `pertanggungjwb`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_absen`
--
ALTER TABLE `tb_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
