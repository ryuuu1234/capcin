-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2019 at 06:29 PM
-- Server version: 5.7.24
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `t_myapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_menu`
--

CREATE TABLE `akses_menu` (
  `id` int(11) NOT NULL,
  `id_level` tinyint(4) NOT NULL,
  `id_menu` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_menu`
--

INSERT INTO `akses_menu` (`id`, `id_level`, `id_menu`) VALUES
(1, 2, 11),
(2, 2, 4),
(3, 2, 8),
(4, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `appmenu`
--

CREATE TABLE `appmenu` (
  `id` int(11) NOT NULL,
  `controller` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `is_main` tinyint(2) NOT NULL,
  `id_main` int(3) NOT NULL,
  `urut` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appmenu`
--

INSERT INTO `appmenu` (`id`, `controller`, `url`, `icon`, `is_main`, `id_main`, `urut`) VALUES
(1, 'Dashboard', 'admin/dashboard', 'fa fa-home', 0, 0, 1),
(2, 'Settings', 'admin/settings', 'fa fa-gear', 1, 0, 100),
(4, 'Sidemenu', 'admin/settings/sidemenu', 'fa fa-list', 0, 2, 2),
(5, 'Master', 'admin/master', 'fa fa-database', 1, 0, 2),
(6, 'Item Barang', 'admin/master/item_barang', 'fa fa-gear', 0, 5, 1),
(7, 'App', 'admin/settings/app', 'fa fa-gear', 0, 2, 2),
(8, 'File', 'admin/file', 'fa fa-file', 1, 0, 3),
(9, 'Users', 'admin/file/users', 'fa fa-gear', 0, 8, 1),
(10, 'Level', 'admin/settings/level', 'fa fa-gear', 0, 2, 3),
(11, 'Hak Akses user', 'admin/settings/hak_akses', 'fa fa-gear', 0, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `t_app`
--

CREATE TABLE `t_app` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text,
  `kota` varchar(50) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_app`
--

INSERT INTO `t_app` (`id`, `nama`, `alamat`, `kota`, `telp`, `logo`) VALUES
(1, 'namaApp', 'Jl. Letjend Sutoyo IV Gg.Taurus No.3', 'Probolinggo', '085204569382', 'logo3.png');

-- --------------------------------------------------------

--
-- Table structure for table `t_item_barang`
--

CREATE TABLE `t_item_barang` (
  `id` int(11) NOT NULL,
  `barcode` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `satuan` tinyint(4) NOT NULL,
  `harga_beli` double DEFAULT '0',
  `harga_jual_cust` double DEFAULT '0',
  `harga_jual_umum` double DEFAULT '0',
  `stok` int(6) DEFAULT '0',
  `limit_stok` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_level`
--

CREATE TABLE `t_level` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_level`
--

INSERT INTO `t_level` (`id`, `nama`) VALUES
(1, 'Root'),
(2, 'Admin'),
(3, 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`id`, `nama`, `username`, `password`, `level`, `photo`) VALUES
(1, 'Hariyadi', 'harry', '$2y$10$idvH764HcZ6zdsViF7lY5eLNN.jYST4aUec2ZBrFCZD6Rff83js9K', 1, '37a7ba18425671b58fb23462f02b75f1.jpg'),
(2, 'LULUK Abc', 'luluk', '$2y$10$NO1rK5F5TQDOw2tj8P0XKefBigFCTcyMZGfQSU0ugyWd6Rm0aYx8.', 2, '3-logo12.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_menu`
--
ALTER TABLE `akses_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appmenu`
--
ALTER TABLE `appmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_app`
--
ALTER TABLE `t_app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_item_barang`
--
ALTER TABLE `t_item_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_level`
--
ALTER TABLE `t_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_menu`
--
ALTER TABLE `akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appmenu`
--
ALTER TABLE `appmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_app`
--
ALTER TABLE `t_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_item_barang`
--
ALTER TABLE `t_item_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_level`
--
ALTER TABLE `t_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
