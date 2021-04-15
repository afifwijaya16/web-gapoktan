-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jul 2020 pada 22.48
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kjscctv`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
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
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_transaksi`, `id_pelanggan`, `id_produk`, `harga_beli`, `jumlah_pesanan`, `status`) VALUES
(33, 7, 4, 1, 9800000, 1, 'Done'),
(34, 8, 4, 1, 9800000, 2, 'Done'),
(35, 9, 4, 1, 9800000, 1, 'Done'),
(36, 10, 0, 1, 902500, 1, 'Done'),
(37, NULL, 0, 1, 902500, 1, 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
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

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_balasan`, `id_users`, `id_pelanggan`, `id_produk`, `rating`, `komentar`, `tgl_komentar`, `status_komentar`) VALUES
(1, 0, 0, 0, 1, 5, 'Produk sangat bagus, pokoknya puas deh .....', '2020-07-17 08:03:02', 'Komentar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `harga_ongkir` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `kabupaten`, `kecamatan`, `harga_ongkir`) VALUES
(1, 'Dibeli', 'Ditoko', 0),
(2, 'Bandar Lampung', 'Bumi Waras', 10000),
(3, 'Bandar Lampung', 'Kedamaian', 10000),
(4, 'Bandar Lampung', 'Kedaton', 5000),
(5, 'Bandar Lampung', 'Kemiling', 10000),
(6, 'Bandar Lampung', 'Labuhan Ratu', 5000),
(8, 'Bandar Lampung', 'Sukarame', 10000),
(9, 'Bandar Lampung', 'Tanjung Senang', 6000),
(10, 'Bandar Lampung', 'Wayhalim', 4000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `telepon`, `email`, `password`, `tgl_daftar`) VALUES
(4, 'Susi', '0898989898', 'susi@gmail.com', '1234', '2019-10-31 03:21:13'),
(6, 'ika', '08978646778', 'ika@gmail.com', 'ika', '2019-10-31 02:59:50'),
(7, 'azizah', '0876423578', 'azizah@gmail.com', 'azizah', '2019-10-31 03:19:48'),
(8, 'dhea', '08789533513', 'dhea@gmail.com', 'dhea', '2019-10-31 02:48:47'),
(9, 'aziz', '09875425688', 'aziz@gmail.com', 'aziz', '2019-11-12 13:30:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `metode_pembayaran` varchar(25) NOT NULL,
  `bukti_transfer` text NOT NULL,
  `tgl_pembayaran` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_transaksi`, `id_pelanggan`, `metode_pembayaran`, `bukti_transfer`, `tgl_pembayaran`) VALUES
(1, 9, 4, 'BCA', '74c6426a9ff2e43f94eac8fbcf01c570.jpg', '2020-07-10 09:23:09'),
(2, 9, 4, 'BCA', '2232f6b8e9c49cc0a26527be75968167.jpg', '2020-07-10 09:23:21'),
(3, 10, 0, 'BCA', '33fe77d19c49ddeb540db212ff015344.png', '2020-07-17 08:18:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `merek` varchar(25) NOT NULL,
  `kategori_produk` varchar(50) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `harga_coret` int(11) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `diskon_pelanggan` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `gambar_produk` text NOT NULL,
  `tgl_produk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_users`, `nama_produk`, `merek`, `kategori_produk`, `deskripsi_produk`, `harga_coret`, `harga_produk`, `stok`, `diskon`, `diskon_pelanggan`, `berat`, `gambar_produk`, `tgl_produk`) VALUES
(1, 4, 'Camera CCTV Hikvision (IP Camera) DS-2CD2110-(I)', '', 'CCTV', '1.3 MP Vandal-proof Dome Camera\r\nSeri DS-2CD2110-I\r\n\r\nSpesifikasi :\r\n- 4mm lens, 73.1Â° view\r\n- 1/3\" Progressive Scan CMOS\r\n- 30m IR distance\r\n- IR cut filter with auto switch\r\n- PoE (Power over Ethernet)\r\n- 3D DNR, Digital WDR\r\n- IP66 weatherproof\r\n- IK10 Impact Protection\r\n-Up to 1280 x 960 resolution', 0, 950000, 10, 5, 0, 250, '32a1ce70d68a7091107153d9fa333658.jpg', '2020-07-18 15:08:29'),
(2, 4, 'Camera CCTV Hikvision (IP Camera) DS-2CD2120F-I(S)', '', 'CCTV', '2.0 MP IR Fixed Dome Camera\r\n- 4mm lens, 79Â° view\r\n- 1/3\" Progressive Scan CMOS\r\n- 30m IR distance\r\n- IR cut filter with auto switch\r\n- PoE (Power over Ethernet)\r\n- 3D DNR, Digital WDR\r\n- IP66 weatherproof\r\n- IK10 Impact Protection\r\n- Up to 1920 x 1280 resolution', 0, 1200000, 10, 5, 10, 250, '470007a2efa30fd7c5075f5a8ab34584.jpg', '2020-07-18 15:14:47'),
(3, 4, 'Camera CCTV Hikvision (IP Camera) DS-2CD2010-I', '', 'CCTV', '1,3 MP IR Mini Bullet Camera\r\n- 4mm lens, 69.4Â° view\r\n- 1/3\" Progressive Scan CMOS\r\n- 30m IR distance\r\n- IR cut filter with auto switch\r\n- PoE (Power over Ethernet)\r\n- 3D DNR, Digital WDR & BLC\r\n- IP66 weatherproof\r\n- Compact design\r\n- Up to 1280 x 960 resolution', 0, 1000000, 10, 5, 10, 250, 'c802c2210984265cac943b8297ec5623.jpg', '2020-07-18 15:27:59'),
(4, 4, 'Camera CCTV Hikvision (IP Camera) DS-2CD2020-I', '', 'CCTV', '2,0 MP IR Mini Bullet Camera\r\n- 4mm lens, 79Â° view\r\n- 1/3\" Progressive Scan CMOS\r\n- 30m IR distance\r\n- IR cut filter with auto switch\r\n- PoE (Power over Ethernet)\r\n- 3D DNR, Digital WDR & BLC\r\n- IP66 weatherproof\r\n- Compact design\r\n- Up to 1920 X 1280 resolution', 0, 1500000, 10, 5, 10, 250, '068607087884ba02c0ffaebf4d50e9cb.jpg', '2020-07-18 15:32:25'),
(5, 4, 'Camera CCTV Hikvision (IP Camera) DS-2CD2412F-I', '', 'CCTV', '1,3 MP Wifi IR Cube Camera\r\n- 4mm lens, 73.1Â° view\r\n- 1/3\" Progressive Scan CMOS\r\n- 10m IR distance\r\n- IR cut filter with auto switch\r\n- PoE (Power over Ethernet)\r\n- 3D DNR, Digital WDR & BLC\r\n- PIR detection 10m & 80Â°\r\n- Up to 1280 x 960 resolution\r\n- SD/SDHC/SDXC card slot (up to 64GB)', 0, 1300000, 10, 5, 10, 250, '15bacffc7d34fb99c784ad6047e0ef42.jpg', '2020-07-18 15:35:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `keterangan` text,
  `grandtotal` int(50) DEFAULT NULL,
  `total_berat` int(11) DEFAULT NULL,
  `id_ongkir` int(11) DEFAULT NULL,
  `alamat_pengiriman` text,
  `jasa_pasang` varchar(20) DEFAULT NULL,
  `status_transaksi` varchar(20) DEFAULT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `keterangan`, `grandtotal`, `total_berat`, `id_ongkir`, `alamat_pengiriman`, `jasa_pasang`, `status_transaksi`, `tgl_transaksi`) VALUES
(10, 0, NULL, 902500, 250, 8, 'Jl. Karimun Jawa No 119 									', 'Dipasangkan', 'Pending', '2020-07-17 08:12:14'),
(11, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-07-17 08:22:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `email`, `password`, `name`, `photo`, `isAdmin`, `nama_industri`, `alamat`, `tahun_berdiri`, `produk`, `telepon`) VALUES
(4, 'admin@gmail.com', 'admin', 'Admin', '', 0, '', '', 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
