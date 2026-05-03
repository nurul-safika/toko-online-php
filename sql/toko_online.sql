-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2025 at 02:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sesi_id` varchar(100) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `sesi_id`, `produk_id`, `qty`) VALUES
(2, 'fd3dblnqbfvj25mhgfq4atcr7b', 6, 1),
(3, 'fd3dblnqbfvj25mhgfq4atcr7b', 10, 1),
(4, 'jeqvvatnn25989rhv7nm263l4e', 6, 1),
(5, 'ct1hvjn9l8bfr80tolta7n4qja', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'Baju pria'),
(2, 'Baju Wanita'),
(3, 'Hoodie'),
(4, 'Jam Tangan'),
(5, 'Tas'),
(6, 'Sepatu');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `order_code` varchar(50) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `customer_name`, `customer_email`, `customer_phone`, `total`, `payment_status`, `created_at`) VALUES
(1, 'INV1765264146', 'fika', '', '', 0, 'pending', '2025-12-08 23:09:06'),
(2, 'INV1765445572', 'fika', '', '', 0, 'pending', '2025-12-11 01:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `produk_id`, `qty`, `harga`) VALUES
(1, 1, 6, 1, 1),
(2, 2, 6, 1, 1),
(3, 2, 10, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `ketersediaan_stok` enum('habis','tersedia') DEFAULT 'tersedia',
  PRIMARY KEY (`id`),
  KEY `kategori_produk` (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama`, `harga`, `foto`, `detail`, `ketersediaan_stok`) VALUES
(6, 1, 'baju pria', 150000, 'VsKBUqpSzz8f3m89UDbG.jpg', 'kaos pria prenium berbahan katun', 'tersedia'),
(7, 1, 'baju pria', 110000, 'vvdawWYcrnxOfWG82TWz.jpg', 'kaos pria prenium berbahan katun', 'tersedia'),
(9, 1, 'baju pria', 120000, 'p4N8z5r8sJmbZQKncae8.jpeg', 'kaos pria warna hijau modern', 'tersedia'),
(10, 2, 'baju wanita', 20000, 'w3CDEcAd79LisNgsHPA1.jpeg', 'kemeja wanita ', 'tersedia'),
(11, 2, 'baju wanita', 210000, 'IxX87z2t1VGsuDS62MWD.jpeg', 'kemeja wanita', 'tersedia'),
(12, 3, 'hoodie ', 90000, 'lJZ6k6CUiPXZURMwJeh4.jpeg', 'hoodie keren', 'tersedia'),
(13, 3, 'hoodie', 100000, 'UHdplnEL6A1YGCqpI8LE.jpeg', 'hoodie warna hitam berbahan prenium', 'tersedia'),
(14, 4, 'jam ', 150000, 'R3omDr6lCnZvoXunwz6x.jpeg', 'jam wanita', 'tersedia'),
(15, 4, 'jam 2', 300000, 'nsjPZr7jmAYjZIadpH68.jpeg', 'jam smartwatch', 'tersedia'),
(16, 4, 'jam 3', 170000, 'HTK7wFl8GjrthQdNMJnb.jpeg', 'jam wanita klasik', 'tersedia'),
(17, 4, 'jam 3', 140000, 'Qke1WuyOhZbLkRdTClcj.jpeg', 'jam tangan wanita dial oval ', 'tersedia'),
(19, 5, 'Tas 1 ', 250000, 'N4OTF9hS5v7B6TMT0u5r.jpeg', 'tas wanita cantik premium', 'tersedia'),
(20, 5, 'tas 2', 250000, 'ii4HuCO9BgjgRwCbZV24.jpeg', 'Tas wanita lucu', 'tersedia'),
(21, 5, 'tas 3', 250000, 'Y6snHJ15tF5ytrDEIiVw.jpeg', 'Tas wanita kekinian', 'tersedia'),
(22, 5, 'tas 4', 250000, 'rhjTZr369AGAJWyUou6d.jpeg', 'tas wanita kasual', 'tersedia'),
(24, 6, 'sepatu 2', 200000, '4m0E65G7xLzYc0Ooh4Dm.jpeg', 'sepatu wanita', 'tersedia'),
(25, 6, 'sepatu 3', 150000, 'qEKmCwSYnlzD2BhBTF9n.jpeg', 'Sepatu wanita elegan', 'tersedia'),
(26, 6, 'Sepatu 4', 200000, 'Y676pprBgTHJJPJ1fCnn.jpeg', 'Sepatu peria', 'tersedia'),
(27, 6, 'sepatu 1', 200000, '1KdPo5lw0nFj6k7se7fj.jpeg', 'sepatu', 'tersedia'),
(29, 2, 'baju wanita', 200000, 'mNudMZNbJGvsROlrcK0I.jpg', 'baju wanita korean style', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
