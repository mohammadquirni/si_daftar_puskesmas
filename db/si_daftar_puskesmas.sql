-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Nov 2020 pada 08.41
-- Versi Server: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_daftar_puskesmas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrasi`
--

CREATE TABLE IF NOT EXISTS `administrasi` (
  `id_admin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `nip` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `administrasi`
--

INSERT INTO `administrasi` (`id_admin`, `id_user`, `nama`, `nip`) VALUES
(1, 2, 'Nurhalim Asriyanto', 54321);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE IF NOT EXISTS `dokter` (
  `id_dokter` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `nip` int(20) DEFAULT NULL,
  `spesialis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `id_user`, `id_poli`, `nama`, `nip`, `spesialis`) VALUES
(1, 1, 1, 'Mohammad Quirni', 15432, 'Spesialis Penyakit Umum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kepala_puskesmas`
--

CREATE TABLE IF NOT EXISTS `kepala_puskesmas` (
  `id_kepala_puskesmas` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `nip` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kepala_puskesmas`
--

INSERT INTO `kepala_puskesmas` (`id_kepala_puskesmas`, `id_user`, `nama`, `nip`) VALUES
(1, 4, 'Tri Sapta M. H. Sinaga', 35421);

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE IF NOT EXISTS `poli` (
  `id_poli` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `nama_petugas` varchar(50) DEFAULT NULL,
  `nip` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id_poli`, `id_user`, `nama`, `nama_petugas`, `nip`) VALUES
(1, 3, 'Poli Umum', 'Deni Topan', 12345);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `hak_akses` enum('administrasi','poli','dokter','kepala_puskesmas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `hak_akses`) VALUES
(1, 'quirni', 'quirni', 'dokter'),
(2, 'halim', 'halim', 'administrasi'),
(3, 'topan', 'topan', 'poli'),
(4, 'sapta', 'sapta', 'kepala_puskesmas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrasi`
--
ALTER TABLE `administrasi`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_pengguna` (`id_user`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `id_pengguna` (`id_user`),
  ADD KEY `id_poli` (`id_poli`);

--
-- Indexes for table `kepala_puskesmas`
--
ALTER TABLE `kepala_puskesmas`
  ADD PRIMARY KEY (`id_kepala_puskesmas`),
  ADD KEY `id_pengguna` (`id_user`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id_poli`),
  ADD KEY `id_pengguna` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
