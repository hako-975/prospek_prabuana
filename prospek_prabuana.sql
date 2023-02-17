-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Feb 2023 pada 07.33
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prospek_prabuana`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `follow_up`
--

CREATE TABLE `follow_up` (
  `id_follow_up` int(11) NOT NULL,
  `tanggal_follow_up` datetime NOT NULL,
  `keterangan_follow_up` text NOT NULL,
  `id_prospek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `follow_up`
--

INSERT INTO `follow_up` (`id_follow_up`, `tanggal_follow_up`, `keterangan_follow_up`, `id_prospek`) VALUES
(1, '2023-02-16 23:53:00', 'Baru tanya-tanya PL', 1),
(2, '2023-02-16 23:53:00', 'menanyakan lokasi', 2),
(3, '2023-02-17 11:55:00', 'Rencana Survei', 2),
(4, '2023-02-17 01:48:00', 'Closing', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int(11) NOT NULL,
  `nama_konsumen` varchar(50) NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `alamat` text DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `npwp` varchar(20) DEFAULT NULL,
  `whatsapp` varchar(30) NOT NULL,
  `instagram` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pekerjaan` enum('pegawai / karyawan','profesional','wiraswasta / swasta / pemilik') NOT NULL,
  `gaji` int(11) DEFAULT NULL,
  `upload_ktp` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `jenis_kelamin`, `alamat`, `nik`, `npwp`, `whatsapp`, `instagram`, `email`, `pekerjaan`, `gaji`, `upload_ktp`) VALUES
(1, 'Andri Firman Saputra', 'pria', '', '', '', '6287808675313', '', '', 'pegawai / karyawan', 6000000, ''),
(2, 'Akhsya', 'pria', '', '', '', '62898998', '', '', 'pegawai / karyawan', 0, ''),
(3, 'Andre', 'pria', '', '', '', '6287733932416', '', '', 'pegawai / karyawan', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prospek`
--

CREATE TABLE `prospek` (
  `id_prospek` int(11) NOT NULL,
  `tanggal_prospek_masuk` datetime NOT NULL,
  `id_konsumen` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_sumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prospek`
--

INSERT INTO `prospek` (`id_prospek`, `tanggal_prospek_masuk`, `id_konsumen`, `id_status`, `id_sumber`) VALUES
(1, '2023-02-16 23:53:00', 1, 1, 3),
(2, '2023-02-16 23:53:00', 2, 4, 1),
(3, '2023-02-17 13:28:00', 3, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'NEW'),
(2, 'WARM'),
(3, 'HOT'),
(4, 'CLOSING'),
(5, 'CANCEL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sumber`
--

CREATE TABLE `sumber` (
  `id_sumber` int(11) NOT NULL,
  `sumber` varchar(50) NOT NULL,
  `warna_hex` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sumber`
--

INSERT INTO `sumber` (`id_sumber`, `sumber`, `warna_hex`) VALUES
(1, 'Instagram', '#962fbf'),
(2, 'Facebook', '#4267B2'),
(3, 'Lamudi', '#faee1c'),
(4, 'OLX', '#002F34'),
(5, 'Jualo', '#F79200'),
(6, 'rumah.com', '#E03C31'),
(7, 'rumah123.com', '#284E9E'),
(8, 'Website', '#17b978');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `follow_up`
--
ALTER TABLE `follow_up`
  ADD PRIMARY KEY (`id_follow_up`),
  ADD KEY `id_prospek` (`id_prospek`);

--
-- Indeks untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indeks untuk tabel `prospek`
--
ALTER TABLE `prospek`
  ADD PRIMARY KEY (`id_prospek`),
  ADD UNIQUE KEY `id_konsumen` (`id_konsumen`) USING BTREE,
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_sumber` (`id_sumber`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `sumber`
--
ALTER TABLE `sumber`
  ADD PRIMARY KEY (`id_sumber`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `follow_up`
--
ALTER TABLE `follow_up`
  MODIFY `id_follow_up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `prospek`
--
ALTER TABLE `prospek`
  MODIFY `id_prospek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `sumber`
--
ALTER TABLE `sumber`
  MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `follow_up`
--
ALTER TABLE `follow_up`
  ADD CONSTRAINT `follow_up_ibfk_1` FOREIGN KEY (`id_prospek`) REFERENCES `prospek` (`id_prospek`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `prospek`
--
ALTER TABLE `prospek`
  ADD CONSTRAINT `prospek_ibfk_1` FOREIGN KEY (`id_sumber`) REFERENCES `sumber` (`id_sumber`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `prospek_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `prospek_ibfk_3` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumen` (`id_konsumen`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
