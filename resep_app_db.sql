-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11 Des 2017 pada 12.34
-- Versi Server: 5.7.9
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resep_app_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `nama`, `icon`) VALUES
(1, 'Makanan', 'fa-cutlery'),
(2, 'Minuman', 'fa-coffee'),
(3, 'Kue', 'fa-birthday-cake'),
(4, 'Sayur', 'fa-leaf');

-- --------------------------------------------------------

--
-- Stand-in structure for view `kategori_view`
--
DROP VIEW IF EXISTS `kategori_view`;
CREATE TABLE IF NOT EXISTS `kategori_view` (
`kategori_id` int(11)
,`nama` varchar(100)
,`icon` varchar(100)
,`jumlah_resep` bigint(21)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

DROP TABLE IF EXISTS `resep`;
CREATE TABLE IF NOT EXISTS `resep` (
  `resep_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nama_resep` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `bahan` text NOT NULL,
  `cara_membuat` text NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`resep_id`),
  KEY `kategori_id` (`user_id`),
  KEY `kategori_id_2` (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`resep_id`, `user_id`, `nama_resep`, `deskripsi`, `bahan`, `cara_membuat`, `kategori_id`, `gambar`, `tanggal`) VALUES
(15, 1, 'Contoh Resep Makanan Satu', 'Deskripsi Resep Makanan Satu', 'Bahan Satu\nBahan Dua\nBahan Tiga', 'Langkah Satu \nLangkah Dua\nLangkah Tiga', 1, 'resep20171211102512.jpg', '2017-12-11 10:25:12'),
(16, 1, 'Contoh Resep Makanan Dua', 'Deskripsi Resep Makanan Dua', 'Bahan Satu\nBahan Dua\nBahan Tiga', 'Langkah Satu \nLangkah Dua\nLangkah Tiga', 1, 'resep20171211102540.jpg', '2017-12-11 10:25:40'),
(17, 7, 'Contoh Resep Makanan Tiga ', 'Deskripsi Resep Makanan Tiga', 'Bahan Satu\nBahan Dua\nBahan Tiga', 'Langkah Satu \nLangkah Dua\nLangkah Tiga', 2, 'resep20171211102611.jpg', '2017-12-11 10:26:11'),
(18, 6, 'Contoh Resep Makanan Empat', 'Deskripsi Resep Makanan Empat', 'Bahan Satu\nBahan Dua\nBahan Tiga', 'Langkah Satu \nLangkah Dua\nLangkah Tiga', 2, 'resep20171211102637.jpg', '2017-12-11 10:26:37'),
(20, 7, 'Contoh Resep Makanan Enam', 'Deskripsi Resep Makanan Enam', 'Bahan Satu\nBahan Dua\nBahan Tiga', 'Langkah Satu \nLangkah Dua\nLangkah Tiga', 4, 'resep20171211102740.jpg', '2017-12-11 10:27:40');

-- --------------------------------------------------------

--
-- Stand-in structure for view `resep_view`
--
DROP VIEW IF EXISTS `resep_view`;
CREATE TABLE IF NOT EXISTS `resep_view` (
`resep_id` int(11)
,`user_id` int(11)
,`nama` varchar(100)
,`username` varchar(100)
,`nama_resep` varchar(255)
,`deskripsi` text
,`bahan` text
,`cara_membuat` text
,`kategori_id` int(11)
,`nama_kategori` varchar(100)
,`icon` varchar(100)
,`gambar` text
,`tanggal` datetime
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `foto` text NOT NULL,
  `token` varchar(40) NOT NULL,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `nama`, `username`, `password`, `foto`, `token`, `tanggal`) VALUES
(1, 'Keroro Gunsou', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'asdf.asdf', '6512e32f53283010ccff80f2bb7b3f7647e5c3de', '2017-12-08 05:18:05'),
(6, 'Kero Kero', 'member', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', '8f9e1bc59f74a5a45e024676ac10c4c47c00f978', '2017-12-11 11:55:26'),
(7, 'Caping Gunung', 'caping', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 'ae1121aa75a3b287765c8e543e1dd41ea070f6e6', '2017-12-11 12:54:14');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_view`
--
DROP VIEW IF EXISTS `user_view`;
CREATE TABLE IF NOT EXISTS `user_view` (
`user_id` int(11)
,`nama` varchar(100)
,`username` varchar(100)
,`foto` text
,`tanggal` datetime
,`jumlah_resep` bigint(21)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `kategori_view`
--
DROP TABLE IF EXISTS `kategori_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `kategori_view`  AS  select `kategori`.`kategori_id` AS `kategori_id`,`kategori`.`nama` AS `nama`,`kategori`.`icon` AS `icon`,count(`resep`.`resep_id`) AS `jumlah_resep` from (`kategori` left join `resep` on((`resep`.`kategori_id` = `kategori`.`kategori_id`))) group by `kategori`.`kategori_id` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `resep_view`
--
DROP TABLE IF EXISTS `resep_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `resep_view`  AS  select `resep`.`resep_id` AS `resep_id`,`resep`.`user_id` AS `user_id`,`user`.`nama` AS `nama`,`user`.`username` AS `username`,`resep`.`nama_resep` AS `nama_resep`,`resep`.`deskripsi` AS `deskripsi`,`resep`.`bahan` AS `bahan`,`resep`.`cara_membuat` AS `cara_membuat`,`resep`.`kategori_id` AS `kategori_id`,`kategori`.`nama` AS `nama_kategori`,`kategori`.`icon` AS `icon`,`resep`.`gambar` AS `gambar`,`resep`.`tanggal` AS `tanggal` from ((`resep` join `user` on((`user`.`user_id` = `resep`.`user_id`))) join `kategori` on((`kategori`.`kategori_id` = `resep`.`kategori_id`))) order by `resep`.`tanggal` desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `user_view`
--
DROP TABLE IF EXISTS `user_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `user_view`  AS  select `user`.`user_id` AS `user_id`,`user`.`nama` AS `nama`,`user`.`username` AS `username`,`user`.`foto` AS `foto`,`user`.`tanggal` AS `tanggal`,count(`resep`.`resep_id`) AS `jumlah_resep` from (`user` left join `resep` on((`resep`.`user_id` = `user`.`user_id`))) group by `user`.`user_id` ;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
