-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2018 at 01:39 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bioskop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `email_admin` varchar(55) NOT NULL,
  `password_admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email_admin`, `password_admin`) VALUES
(1, 'Aa Suhendar', 'admin@gmail.com', 'admin'),
(2, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id_film` int(5) NOT NULL,
  `image` varchar(60) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `trailer` varchar(100) NOT NULL,
  `tgl_rilis` date NOT NULL,
  `durasi` int(3) NOT NULL,
  `sinopsis` text,
  `artis` text,
  `kategori1` varchar(20) NOT NULL,
  `kategori2` varchar(20) DEFAULT NULL,
  `kategori3` varchar(20) DEFAULT NULL,
  `rating` varchar(2) DEFAULT NULL,
  `negara` varchar(20) DEFAULT NULL,
  `produksi` varchar(60) DEFAULT NULL,
  `id_kasir` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id_film`, `image`, `judul`, `trailer`, `tgl_rilis`, `durasi`, `sinopsis`, `artis`, `kategori1`, `kategori2`, `kategori3`, `rating`, `negara`, `produksi`, `id_kasir`) VALUES
(1, 'The Matrix Reloaded.jpg', 'The Matrix Reloaded', 'https://www.youtube.com/watch?v=vKQi3bBA1y8', '2018-07-01', 139, 'Bercerita tentang bagaimana mendapat nilai A', 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss, Hugo Weaving, Joe Pantoliano', 'Action', 'Crime', 'Sci-Fi', 'BO', 'United States', 'Warner Bros. Pictures', 6),
(2, 'Titanic.jpg', 'Titanic', 'https://www.youtube.com/watch?v=tXbGHqiAmME', '2018-07-18', 194, 'Rose mati lemas, saat bermain sebagai gadis masyarakat elit, menghadiri pesta, berdandan dan terus-menerus dicermati. Ketika dia bertemu Jack di kapal Titanic, hidupnya berubah untuk selamanya.', 'Leonardo DiCaprio, Kate Winslet, Billy Zane.', 'Drama', 'Romance', 'Adventure', 'R', 'United States', '20th Century Fox', 6),
(3, 'Mongol.jpg', 'Mongol', 'https://www.youtube.com/watch?v=xrzXIaTt99U', '2018-07-18', 133, 'Menceritakan tentang pahlawan pembela kebenaran', 'Adit KR, Gilang maulana, Kurnia, Tom Holland, Michael  Keaton', 'Action', 'War', 'Comedy', 'R', 'United States', 'Marvel Studios', 6),
(4, 'Mongol.jpg', 'Mongol', 'https://www.youtube.com/watch?v=tXbGHqiAmME', '2018-07-02', 60, 'Menceritakan tentang pahlawan yang membela kebenaran', 'Adit KR', 'Action', 'Action', 'Action', 'SU', 'United States', 'Erry', 7);

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` int(5) NOT NULL,
  `nama_kasir` varchar(30) NOT NULL,
  `username_kasir` varchar(30) NOT NULL,
  `password_kasir` varchar(55) NOT NULL,
  `email_kasir` varchar(55) NOT NULL,
  `jk_kasir` varchar(1) NOT NULL,
  `alamat_kasir` varchar(55) NOT NULL,
  `id_admin` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `nama_kasir`, `username_kasir`, `password_kasir`, `email_kasir`, `jk_kasir`, `alamat_kasir`, `id_admin`) VALUES
(6, 'Aa Ganteng', 'aasuhendr', 'aasuhendr', 'batem@gmail.com', 'L', 'aasuhendr', 1),
(7, 'Kasir', 'kasir', 'kasir', 'kasir@gmail.com', 'L', 'Jl.coblong wetan batununggal - bandung', 2);

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int(5) UNSIGNED ZEROFILL NOT NULL,
  `fname_konsumen` varchar(20) NOT NULL,
  `lname_konsumen` varchar(20) NOT NULL,
  `jk_konsumen` varchar(1) NOT NULL,
  `username_konsumen` varchar(12) NOT NULL,
  `password_konsumen` varchar(60) NOT NULL,
  `email_konsumen` varchar(50) NOT NULL,
  `phone_konsumen` varchar(20) NOT NULL,
  `saldo_konsumen` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `fname_konsumen`, `lname_konsumen`, `jk_konsumen`, `username_konsumen`, `password_konsumen`, `email_konsumen`, `phone_konsumen`, `saldo_konsumen`) VALUES
(00001, 'Aa', 'Suhendar', 'L', 'batim', '$2y$10$OOMXWlm54W6quPqO1sXg1u3RAEXUWu6uAsJVFkvY07acLU5oTpb7O', 'batem@gmail.com', '081111111111', 745000),
(00002, 'Marion', 'Jola', 'P', 'marion', '$2y$10$I3J6FKXcRXM15mJduoQE/ewAqPApZwP5b6gfa2spVnBG2Zz0Kr5nG', 'marion@gmail.com', '131313', 10761111),
(00003, 'Konsumen', 'Konsumen', 'P', 'konsumen', '$2y$10$OmdJATiARcc0j1IVaMhnH.2tJK/Iyd0Jd0WhfMnBudJf1AvgD/igm', 'konsumen@gmail.com', '0812387236278', 0);

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE `studio` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `kapasitas` int(3) NOT NULL,
  `harga` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`id`, `nama`, `kapasitas`, `harga`) VALUES
(5, 'Platinum', 40, 35000);

-- --------------------------------------------------------

--
-- Table structure for table `tayang`
--

CREATE TABLE `tayang` (
  `id` int(5) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `id_film` int(5) NOT NULL,
  `id_studio` int(3) NOT NULL,
  `jam1` time NOT NULL,
  `jam2` time DEFAULT NULL,
  `jam3` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tayang`
--

INSERT INTO `tayang` (`id`, `tanggal_awal`, `tanggal_akhir`, `id_film`, `id_studio`, `jam1`, `jam2`, `jam3`) VALUES
(2, '2018-07-01', '2018-07-31', 1, 5, '13:24:00', '12:25:00', '12:23:00'),
(3, '2018-07-18', '2019-06-19', 2, 5, '10:00:00', '15:00:00', '18:00:00'),
(4, '2018-07-18', '2019-08-13', 3, 5, '08:00:00', '12:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_tonton` date NOT NULL,
  `id_konsumen` int(5) UNSIGNED ZEROFILL NOT NULL,
  `film_id` int(5) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `id_studio` int(5) NOT NULL,
  `nama_studio` varchar(15) NOT NULL,
  `seat` varchar(30) NOT NULL,
  `jam_tonton` time NOT NULL,
  `jumlah_orang` int(3) NOT NULL,
  `harga` int(6) NOT NULL,
  `total_harga` int(10) NOT NULL,
  `kodebooking` varchar(15) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id`, `tanggal`, `tanggal_tonton`, `id_konsumen`, `film_id`, `judul`, `id_studio`, `nama_studio`, `seat`, `jam_tonton`, `jumlah_orang`, `harga`, `total_harga`, `kodebooking`, `status`) VALUES
(1, '2018-07-01', '2018-07-01', 00001, 1, 'The Matrix Reloaded', 5, 'Platinum', 'A1 ', '13:24:00', 1, 35000, 35000, 'BCERIAX3FGU', 'Out Of Date'),
(2, '2018-07-09', '2018-07-09', 00002, 1, 'The Matrix Reloaded', 5, 'Platinum', 'B1 C1 B2 C2 ', '13:24:00', 4, 35000, 140000, 'BCERIALPNEF', 'Out Of Date'),
(3, '2018-07-09', '2018-07-09', 00002, 1, 'The Matrix Reloaded', 5, 'Platinum', 'A5 B5 C5 D5 E5 F5 ', '13:24:00', 6, 35000, 210000, 'BCERIAFDUSK', 'Out Of Date'),
(4, '2018-07-18', '2018-07-18', 00001, 1, 'The Matrix Reloaded', 5, 'Platinum', 'A1 B1 ', '13:24:00', 2, 35000, 70000, 'BCERIALDTXP', 'Out Of Date'),
(5, '2018-06-18', '2018-07-10', 00001, 1, 'The Matrix Reloaded', 5, 'Platinum', 'B5 C5 ', '12:23:00', 2, 35000, 70000, 'BCERIA64285', 'Out Of Date'),
(6, '2018-07-18', '2018-07-18', 00001, 1, 'The Matrix Reloaded', 5, 'Platinum', 'C1 D1 ', '12:25:00', 2, 35000, 70000, 'BCERIA4RIIW', 'Out Of Date'),
(7, '2018-07-20', '2018-07-20', 00001, 1, 'The Matrix Reloaded', 5, 'Platinum', 'A1 A2 ', '12:25:00', 2, 35000, 70000, 'BCERIAH9MBD', 'Out Of Date');

-- --------------------------------------------------------

--
-- Table structure for table `topup`
--

CREATE TABLE `topup` (
  `id` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `id_konsumen` int(5) UNSIGNED ZEROFILL NOT NULL,
  `uang` int(6) NOT NULL,
  `kode_topup` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topup`
--

INSERT INTO `topup` (`id`, `tanggal`, `id_konsumen`, `uang`, `kode_topup`, `status`) VALUES
(1, '2018-07-01', 00001, 50000, 'VOCP5N33C2YGZ', 'Approved'),
(2, '2018-07-09', 00002, 11111111, 'VOCXPZNAMBII5', 'Approved'),
(3, '2018-07-18', 00001, 1000000, 'VOCTQP2XFW7IL', 'Approved'),
(4, '2018-07-18', 00001, 10000, 'VOCPD0L6LGU25', 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`),
  ADD KEY `id_film` (`id_film`),
  ADD KEY `id_film_2` (`id_film`),
  ADD KEY `film_ibfk_1` (`id_kasir`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indexes for table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tayang`
--
ALTER TABLE `tayang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_studio` (`id_studio`),
  ADD KEY `id_film` (`id_film`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_studio` (`id_studio`),
  ADD KEY `film_id` (`film_id`),
  ADD KEY `id_konsumen` (`id_konsumen`);

--
-- Indexes for table `topup`
--
ALTER TABLE `topup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_konsumen` (`id_konsumen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id_kasir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studio`
--
ALTER TABLE `studio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tayang`
--
ALTER TABLE `tayang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `topup`
--
ALTER TABLE `topup`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_kasir`) REFERENCES `kasir` (`id_kasir`);

--
-- Constraints for table `kasir`
--
ALTER TABLE `kasir`
  ADD CONSTRAINT `kasir_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Constraints for table `tayang`
--
ALTER TABLE `tayang`
  ADD CONSTRAINT `tayang_ibfk_2` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  ADD CONSTRAINT `tayang_ibfk_3` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id`);

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id_film`),
  ADD CONSTRAINT `tiket_ibfk_3` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id`),
  ADD CONSTRAINT `tiket_ibfk_4` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumen` (`id_konsumen`);

--
-- Constraints for table `topup`
--
ALTER TABLE `topup`
  ADD CONSTRAINT `topup_ibfk_1` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumen` (`id_konsumen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
