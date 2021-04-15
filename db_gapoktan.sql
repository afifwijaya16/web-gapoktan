-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2021 at 03:48 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gapoktan`
--

-- --------------------------------------------------------

--
-- Table structure for table `galery`
--

CREATE TABLE `galery` (
  `id_galery` int(11) NOT NULL,
  `judul` varchar(300) DEFAULT NULL,
  `tgl_posting` datetime DEFAULT NULL,
  `isi_galery` text,
  `gambar` text,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galery`
--

INSERT INTO `galery` (`id_galery`, `judul`, `tgl_posting`, `isi_galery`, `gambar`, `id_users`) VALUES
(2, 'Galery', '2021-04-15 08:05:00', 'isi galery', '81fab4b6dd726354d8b3a4e69c392493.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `jumlah_pesanan` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_transaksi`, `id_pelanggan`, `id_produk`, `harga_beli`, `jumlah_pesanan`, `status`) VALUES
(57, 31, 26, 12, 48000, 2, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_balasan` int(11) DEFAULT '0',
  `id_users` int(11) DEFAULT '0',
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `komentar` text NOT NULL,
  `tgl_komentar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_komentar` varchar(50) NOT NULL DEFAULT 'Komentar'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `harga_ongkir` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `kabupaten`, `kecamatan`, `harga_ongkir`) VALUES
(1, 'Dibeli ', 'Ditoko', 0),
(2, 'Bandar Lampung', 'Wilayah Bandar Lampung', 20000),
(3, 'Metro', 'Luar Bandar Lampung', 50000),
(4, 'Lampung Tengah', 'Luar Bandar Lampung', 50000),
(5, 'Lampung Timur', 'Luar Bandar Lampung', 50000),
(6, 'Lampung Selatan', 'Luar Bandar Lampung', 50000),
(8, 'Lampung Utara', 'Luar Bandar Lampung', 70000),
(9, 'Lampung Barat', 'Luar Bandar Lampung', 70000),
(10, 'Pesisir Barat', 'Luar Bandar Lampung', 100000),
(11, 'Tanggamus', 'Luar Bandar Lampung', 60000),
(12, 'Way Kanan', 'Luar Bandar Lampung', 80000),
(13, 'Way Kanan', 'Luar Bandar Lampung', 80000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status_pelanggan` varchar(15) NOT NULL DEFAULT 'Umum',
  `tgl_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verif` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `telepon`, `email`, `password`, `status_pelanggan`, `tgl_daftar`, `verif`) VALUES
(26, 'Ervia Dwi Rolyana', '081265980065', 'ervia@gmail.com', '123', 'Umum', '2020-11-23 01:57:35', 1),
(30, 'Surya Dinata', '082282108836', 'surya@gmail.com', '123', 'Umum', '2020-11-23 02:03:55', 1),
(33, 'Maya Apriyani', '089765345687', 'maya@gmail.com', 'maya', 'Umum', '2020-11-23 02:13:30', 1),
(40, 'Ratna Anjani', '081265980065', 'ratna@@gmail.com', '123', 'Umum', '2020-12-10 07:48:57', 1),
(41, 'Sinta Dwi Lestari', '081265980065', 'sinta@gmail.com', '123', 'Umum', '2020-12-10 07:50:46', 1),
(42, 'Mora Andara', '087789899098', 'mora@gmail.com', '123', 'Umum', '2021-03-22 04:04:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `metode_pembayaran` varchar(25) NOT NULL,
  `bukti_transfer` text NOT NULL,
  `status_pembayaran` varchar(25) NOT NULL DEFAULT 'Pending',
  `keterangan_pembayaran` text NOT NULL,
  `tgl_pembayaran` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_transaksi`, `id_pelanggan`, `metode_pembayaran`, `bukti_transfer`, `status_pembayaran`, `keterangan_pembayaran`, `tgl_pembayaran`) VALUES
(12, 31, 26, 'BCA', '8c613a5ae5f2c1edb908da7f9aa5f3a0.png', 'Done', 'Diterima', '2021-03-22 04:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `merek` varchar(25) NOT NULL,
  `kategori_produk` varchar(50) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `gambar_produk` text NOT NULL,
  `tgl_produk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `klik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_users`, `nama_produk`, `merek`, `kategori_produk`, `deskripsi_produk`, `harga_produk`, `stok`, `diskon`, `berat`, `gambar_produk`, `tgl_produk`, `klik`) VALUES
(12, 4, 'Beras Super Gapoktan 5 Kg', '', 'Beras', 'Beras Super merupakan beras yang diproduksi dari gabah kering dan diproses menggunakan peralatan modern tanpa campuran bahan kimia, pemutih maupun pengawet, menjadikan beras ini aman untuk dikonsumsi oleh anak-anak maupun dewasa. Manfaat Beras Super: 1.Enak, bergizi tinggi, aman dan sehat untuk dikonsumsi (bebas pestisida kimia, pupuk kimia, dan pemutih) 2.Memiliki kandungan vitamin dan mineral yang lebih tinggi 3.Memiliki nilai ketercernaan yang lebih baik karena kaya akan serat 4.Baik untuk diet dan mengurangi kolesterol', 60000, 9, 20, 500, '7d804c91a1274eb3a37fb2dd0d032748.png', '2021-03-23 12:48:22', 5);

-- --------------------------------------------------------

--
-- Table structure for table `statis`
--

CREATE TABLE `statis` (
  `id_halaman` int(11) NOT NULL,
  `judul` varchar(200) DEFAULT '',
  `isi_halaman` text,
  `tgl_posting` datetime DEFAULT NULL,
  `gambar` text,
  `id_users` int(11) DEFAULT NULL,
  `dibaca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statis`
--

INSERT INTO `statis` (`id_halaman`, `judul`, `isi_halaman`, `tgl_posting`, `gambar`, `id_users`, `dibaca`) VALUES
(2, 'Promosi', 'tes', '2021-04-15 07:56:00', '3c6276855ce699adf8d9d83a8e4f9ef4.png', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `keterangan` text,
  `grandtotal` int(50) DEFAULT NULL,
  `total_berat` int(11) DEFAULT NULL,
  `id_ongkir` int(11) DEFAULT NULL,
  `alamat_pengiriman` text,
  `status_transaksi` varchar(20) DEFAULT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `keterangan`, `grandtotal`, `total_berat`, `id_ongkir`, `alamat_pengiriman`, `status_transaksi`, `tgl_transaksi`) VALUES
(31, 26, NULL, 96000, 1000, 2, 'Sukarame', 'Done', '2021-03-22 04:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  `nama_industri` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_berdiri` int(4) NOT NULL,
  `produk` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `email`, `password`, `name`, `photo`, `isAdmin`, `nama_industri`, `alamat`, `tahun_berdiri`, `produk`, `telepon`) VALUES
(4, 'admin@gmail.com', 'admin', 'Admin', '', 0, '', '', 0, '', '081218130071'),
(5, 'pimpinan@gmail.com', 'pimpinan', 'Pimpinan', '', 1, '', '', 0, '', '081218130071');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id_galery`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `statis`
--
ALTER TABLE `statis`
  ADD PRIMARY KEY (`id_halaman`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galery`
--
ALTER TABLE `galery`
  MODIFY `id_galery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `statis`
--
ALTER TABLE `statis`
  MODIFY `id_halaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
