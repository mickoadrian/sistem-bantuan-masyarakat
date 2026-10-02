-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Mar 2024 pada 12.51
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bansos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenisbantuan`
--

CREATE TABLE `tb_jenisbantuan` (
  `id_jenisbantuan` int(11) NOT NULL,
  `nama_jenisbantuan` varchar(100) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `jumlah_bantuan` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `lastupdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_jenisbantuan`
--

INSERT INTO `tb_jenisbantuan` (`id_jenisbantuan`, `nama_jenisbantuan`, `jenis`, `jumlah_bantuan`, `satuan`, `keterangan`, `lastupdated`) VALUES
(1, 'Bantuan Sosial', 'Tablet', 199, 'Kg', '', '2024-03-08 17:51:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penduduk`
--

CREATE TABLE `tb_penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nokk` varchar(100) NOT NULL,
  `nama_penduduk` varchar(200) NOT NULL,
  `alamat_ktp` text NOT NULL,
  `alamat_domisili` text NOT NULL,
  `telp` varchar(50) NOT NULL,
  `lastupdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_penduduk`
--

INSERT INTO `tb_penduduk` (`id_penduduk`, `nik`, `nokk`, `nama_penduduk`, `alamat_ktp`, `alamat_domisili`, `telp`, `lastupdated`) VALUES
(1, '331345678911', '331345678922', 'Sumiati', 'Kratonan,Surakarta, Jawa Tengah', 'Kratonan,Surakarta, Jawa Tengah', '087654321678', '2024-03-08 18:38:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penerimabantuan`
--

CREATE TABLE `tb_penerimabantuan` (
  `id_penerimabantuan` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `id_jenisbantuan` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `lastupdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_penerimabantuan`
--

INSERT INTO `tb_penerimabantuan` (`id_penerimabantuan`, `id_penduduk`, `id_jenisbantuan`, `keterangan`, `lastupdated`) VALUES
(1, 1, 1, '', '2024-03-08 18:48:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_role`
--

CREATE TABLE `tb_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_role`
--

INSERT INTO `tb_role` (`id_role`, `nama_role`) VALUES
(1, 'admin'),
(2, 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hak_akses` varchar(50) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `lastupdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `id_role`, `username`, `password`, `hak_akses`, `nama_user`, `lastupdated`) VALUES
(1, 1, 'admin', '$2y$10$K9dY4aOhCa0brgbgaFMYbeOJV6PumQ4UHeX8orE8Dxsv7TYx/ixbC', 'Admin', 'Admin Sistem', '2024-03-08 01:49:45'),
(3, 2, 'petugas01', '$2y$10$/lRgx0TGGazsh8i5feGRF.boEUQTX95EVC0h4lbalV446.nqGEKjq', '', 'Petugas Sistem 01', '2024-03-08 18:50:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jenisbantuan`
--
ALTER TABLE `tb_jenisbantuan`
  ADD PRIMARY KEY (`id_jenisbantuan`);

--
-- Indeks untuk tabel `tb_penduduk`
--
ALTER TABLE `tb_penduduk`
  ADD PRIMARY KEY (`id_penduduk`);

--
-- Indeks untuk tabel `tb_penerimabantuan`
--
ALTER TABLE `tb_penerimabantuan`
  ADD PRIMARY KEY (`id_penerimabantuan`),
  ADD KEY `id_penduduk` (`id_penduduk`),
  ADD KEY `id_jenisbantuan` (`id_jenisbantuan`);

--
-- Indeks untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_jenisbantuan`
--
ALTER TABLE `tb_jenisbantuan`
  MODIFY `id_jenisbantuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_penduduk`
--
ALTER TABLE `tb_penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_penerimabantuan`
--
ALTER TABLE `tb_penerimabantuan`
  MODIFY `id_penerimabantuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_penerimabantuan`
--
ALTER TABLE `tb_penerimabantuan`
  ADD CONSTRAINT `tb_penerimabantuan_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tb_penduduk` (`id_penduduk`),
  ADD CONSTRAINT `tb_penerimabantuan_ibfk_2` FOREIGN KEY (`id_jenisbantuan`) REFERENCES `tb_jenisbantuan` (`id_jenisbantuan`);

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `tb_role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
