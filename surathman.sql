-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jan 2022 pada 06.15
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surathman`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(30) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'chandra', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblberita_acara`
--

CREATE TABLE `tblberita_acara` (
  `id` int(30) NOT NULL,
  `ba` varchar(225) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu` varchar(225) NOT NULL,
  `divisi` enum('Ketua Umum','Ketua 1','Ketua 2','Sekretaris Umum','Bendahara Umum','Dept Pengaderan','Dept Pemberdayaan Perempuan','Dept Humas','Dept Pendidikan','Dept Kesekretaiatan','Dept Kerohanian','UKH Seni','UKH Olahraga','UKH Jurnalistik','UKH Cinta Alam','UKH Kewirausahaan','UKH Bahasa') NOT NULL,
  `perihal` varchar(225) NOT NULL,
  `file` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblinventaris_brg`
--

CREATE TABLE `tblinventaris_brg` (
  `id` int(30) NOT NULL,
  `brg` varchar(225) NOT NULL,
  `namabrg` varchar(225) NOT NULL,
  `jenis` varchar(225) NOT NULL,
  `kondisi` enum('Baik','Rusak','Retensi','') NOT NULL,
  `jumlah` int(11) NOT NULL,
  `file` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblinventaris_surat`
--

CREATE TABLE `tblinventaris_surat` (
  `id` int(30) NOT NULL,
  `isurat` varchar(225) NOT NULL,
  `tglsurat` date NOT NULL,
  `tglritensi` date NOT NULL,
  `perihal` varchar(225) NOT NULL,
  `file` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblsurat_keluar`
--

CREATE TABLE `tblsurat_keluar` (
  `id` int(30) NOT NULL,
  `skl` varchar(225) NOT NULL,
  `tglsurat` date NOT NULL,
  `tglkeluar` date NOT NULL,
  `pengirim` varchar(225) NOT NULL,
  `tujuan` varchar(225) NOT NULL,
  `perihal` varchar(225) NOT NULL,
  `file` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblsurat_keputusan`
--

CREATE TABLE `tblsurat_keputusan` (
  `id` int(30) NOT NULL,
  `sk` varchar(225) NOT NULL,
  `tglsurat` date NOT NULL,
  `perihal` varchar(225) NOT NULL,
  `file` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblsurat_masuk`
--

CREATE TABLE `tblsurat_masuk` (
  `id` int(30) NOT NULL,
  `sm` varchar(225) NOT NULL,
  `tglsurat` date NOT NULL,
  `tglterima` date NOT NULL,
  `pengirim` varchar(225) NOT NULL,
  `penerima` varchar(225) NOT NULL,
  `perihal` varchar(225) NOT NULL,
  `file` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblberita_acara`
--
ALTER TABLE `tblberita_acara`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblinventaris_brg`
--
ALTER TABLE `tblinventaris_brg`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblinventaris_surat`
--
ALTER TABLE `tblinventaris_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblsurat_keluar`
--
ALTER TABLE `tblsurat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblsurat_keputusan`
--
ALTER TABLE `tblsurat_keputusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tblsurat_masuk`
--
ALTER TABLE `tblsurat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tblberita_acara`
--
ALTER TABLE `tblberita_acara`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tblinventaris_brg`
--
ALTER TABLE `tblinventaris_brg`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tblinventaris_surat`
--
ALTER TABLE `tblinventaris_surat`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tblsurat_keluar`
--
ALTER TABLE `tblsurat_keluar`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tblsurat_keputusan`
--
ALTER TABLE `tblsurat_keputusan`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tblsurat_masuk`
--
ALTER TABLE `tblsurat_masuk`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
