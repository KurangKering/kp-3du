-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.40-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for kp_edu
DROP DATABASE IF EXISTS `kp_edu`;
CREATE DATABASE IF NOT EXISTS `kp_edu` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `kp_edu`;

-- Dumping structure for table kp_edu.daftar_barang
DROP TABLE IF EXISTS `daftar_barang`;
CREATE TABLE IF NOT EXISTS `daftar_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(50) DEFAULT NULL,
  `total` int(11) DEFAULT '0',
  `satuan` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.daftar_barang: ~3 rows (approximately)
DELETE FROM `daftar_barang`;
/*!40000 ALTER TABLE `daftar_barang` DISABLE KEYS */;
INSERT INTO `daftar_barang` (`id`, `nama_barang`, `total`, `satuan`, `created_at`, `updated_at`) VALUES
	(1, 'Infokus', 3500, 'unit', '2019-07-22 20:35:27', '2019-08-02 18:51:34'),
	(2, 'Penghapus', 20000, 'unit', '2019-07-22 20:35:54', '2019-08-03 15:23:44');
/*!40000 ALTER TABLE `daftar_barang` ENABLE KEYS */;

-- Dumping structure for table kp_edu.daftar_inventaris
DROP TABLE IF EXISTS `daftar_inventaris`;
CREATE TABLE IF NOT EXISTS `daftar_inventaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.daftar_inventaris: ~2 rows (approximately)
DELETE FROM `daftar_inventaris`;
/*!40000 ALTER TABLE `daftar_inventaris` DISABLE KEYS */;
INSERT INTO `daftar_inventaris` (`id`, `nama`, `stock`, `satuan`, `created_at`, `updated_at`) VALUES
	(3, 'Pena', 2007, 'Pcs', '2019-08-02 19:23:47', '2019-08-04 23:47:49'),
	(4, 'Batu', 2007, 'Pcs', '2019-08-03 22:38:51', '2019-08-04 23:47:49');
/*!40000 ALTER TABLE `daftar_inventaris` ENABLE KEYS */;

-- Dumping structure for table kp_edu.det_peminjaman_barang
DROP TABLE IF EXISTS `det_peminjaman_barang`;
CREATE TABLE IF NOT EXISTS `det_peminjaman_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peminjaman_barang_id` int(11) DEFAULT NULL,
  `daftar_barang_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.det_peminjaman_barang: ~1 rows (approximately)
DELETE FROM `det_peminjaman_barang`;
/*!40000 ALTER TABLE `det_peminjaman_barang` DISABLE KEYS */;
INSERT INTO `det_peminjaman_barang` (`id`, `peminjaman_barang_id`, `daftar_barang_id`, `jumlah`, `created_at`, `updated_at`) VALUES
	(10, 6, 1, 2, '2019-08-03 14:12:16', '2019-08-03 14:12:33'),
	(11, 7, 2, 2000, '2019-08-03 14:51:26', '2019-08-03 14:51:26');
/*!40000 ALTER TABLE `det_peminjaman_barang` ENABLE KEYS */;

-- Dumping structure for table kp_edu.det_pengajuan_inventaris
DROP TABLE IF EXISTS `det_pengajuan_inventaris`;
CREATE TABLE IF NOT EXISTS `det_pengajuan_inventaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengajuan_inventaris_id` int(11) DEFAULT NULL,
  `daftar_inventaris_id` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.det_pengajuan_inventaris: ~2 rows (approximately)
DELETE FROM `det_pengajuan_inventaris`;
/*!40000 ALTER TABLE `det_pengajuan_inventaris` DISABLE KEYS */;
INSERT INTO `det_pengajuan_inventaris` (`id`, `pengajuan_inventaris_id`, `daftar_inventaris_id`, `jumlah`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 2000, '2019-08-04 23:47:49', '2019-08-04 23:47:49'),
	(2, 1, 3, 2000, '2019-08-04 23:47:49', '2019-08-04 23:47:49');
/*!40000 ALTER TABLE `det_pengajuan_inventaris` ENABLE KEYS */;

-- Dumping structure for table kp_edu.det_permintaan_inventaris
DROP TABLE IF EXISTS `det_permintaan_inventaris`;
CREATE TABLE IF NOT EXISTS `det_permintaan_inventaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permintaan_inventaris_id` int(11) DEFAULT NULL,
  `daftar_inventaris_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.det_permintaan_inventaris: ~4 rows (approximately)
DELETE FROM `det_permintaan_inventaris`;
/*!40000 ALTER TABLE `det_permintaan_inventaris` DISABLE KEYS */;
INSERT INTO `det_permintaan_inventaris` (`id`, `permintaan_inventaris_id`, `daftar_inventaris_id`, `jumlah`, `created_at`, `updated_at`) VALUES
	(13, 7, 4, 2, '2019-08-04 23:44:04', '2019-08-04 23:44:04'),
	(14, 7, 3, 2, '2019-08-04 23:44:05', '2019-08-04 23:44:05'),
	(15, 8, 4, 3, '2019-08-04 23:44:59', '2019-08-04 23:44:59'),
	(16, 8, 3, 3, '2019-08-04 23:44:59', '2019-08-04 23:44:59');
/*!40000 ALTER TABLE `det_permintaan_inventaris` ENABLE KEYS */;

-- Dumping structure for table kp_edu.isi_disposisi
DROP TABLE IF EXISTS `isi_disposisi`;
CREATE TABLE IF NOT EXISTS `isi_disposisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lembar_disposisi_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `isi_penolakan` varchar(250) DEFAULT NULL,
  `from_role_id` varchar(50) DEFAULT NULL,
  `destination_role_id` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.isi_disposisi: ~4 rows (approximately)
DELETE FROM `isi_disposisi`;
/*!40000 ALTER TABLE `isi_disposisi` DISABLE KEYS */;
INSERT INTO `isi_disposisi` (`id`, `lembar_disposisi_id`, `status`, `isi_penolakan`, `from_role_id`, `destination_role_id`, `created_at`, `updated_at`) VALUES
	(18, 32, '1', NULL, '3', '4', '2019-07-29 06:51:06', '2019-07-29 06:51:06'),
	(20, 32, '1', NULL, '4', '2', '2019-07-29 07:34:19', '2019-07-29 07:34:19'),
	(21, 33, '1', NULL, '3', '4', '2019-08-02 11:02:30', '2019-08-02 11:02:30'),
	(22, 33, '-1', 'er', '4', '2', '2019-08-02 11:02:54', '2019-08-02 11:02:54'),
	(23, 34, '-1', 'cicak', '3', '2', '2019-08-02 18:36:34', '2019-08-02 18:36:34');
/*!40000 ALTER TABLE `isi_disposisi` ENABLE KEYS */;

-- Dumping structure for table kp_edu.lembar_disposisi
DROP TABLE IF EXISTS `lembar_disposisi`;
CREATE TABLE IF NOT EXISTS `lembar_disposisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_role_id` varchar(50) NOT NULL,
  `file` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `peminjaman_ruangan_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_lembar_disposisi_peminjaman_ruangan` (`peminjaman_ruangan_id`),
  CONSTRAINT `FK_lembar_disposisi_peminjaman_ruangan` FOREIGN KEY (`peminjaman_ruangan_id`) REFERENCES `peminjaman_ruangan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.lembar_disposisi: ~0 rows (approximately)
DELETE FROM `lembar_disposisi`;
/*!40000 ALTER TABLE `lembar_disposisi` DISABLE KEYS */;
INSERT INTO `lembar_disposisi` (`id`, `position_role_id`, `file`, `status`, `tanggal`, `peminjaman_ruangan_id`, `created_at`, `updated_at`) VALUES
	(32, '2', NULL, '2', '2019-07-29 06:46:48', 12, '2019-07-29 06:46:48', '2019-07-29 07:34:19'),
	(33, '2', NULL, '2', '2019-08-02 10:56:58', 13, '2019-08-02 10:56:58', '2019-08-02 11:02:54'),
	(34, '2', NULL, '2', '2019-08-02 18:04:03', 14, '2019-08-02 18:04:03', '2019-08-02 18:36:34');
/*!40000 ALTER TABLE `lembar_disposisi` ENABLE KEYS */;

-- Dumping structure for table kp_edu.peminjaman_barang
DROP TABLE IF EXISTS `peminjaman_barang`;
CREATE TABLE IF NOT EXISTS `peminjaman_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `kegiatan` varchar(250) DEFAULT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `waktu_pengembalian` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.peminjaman_barang: ~1 rows (approximately)
DELETE FROM `peminjaman_barang`;
/*!40000 ALTER TABLE `peminjaman_barang` DISABLE KEYS */;
INSERT INTO `peminjaman_barang` (`id`, `nama`, `kegiatan`, `waktu_mulai`, `waktu_selesai`, `status`, `waktu_pengembalian`, `created_at`, `updated_at`) VALUES
	(6, 'sdafas', 'sadf', '2019-08-03 14:11:00', NULL, 1, '2019-08-03 14:47:00', '2019-08-03 14:12:16', '2019-08-03 14:47:27'),
	(7, 'yrtyr', 'sfsdafsaf', '2019-08-03 14:50:00', NULL, 1, NULL, '2019-08-03 14:51:26', '2019-08-03 14:51:26');
/*!40000 ALTER TABLE `peminjaman_barang` ENABLE KEYS */;

-- Dumping structure for table kp_edu.peminjaman_ruangan
DROP TABLE IF EXISTS `peminjaman_ruangan`;
CREATE TABLE IF NOT EXISTS `peminjaman_ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) NOT NULL,
  `kegiatan` varchar(250) NOT NULL DEFAULT '',
  `ruangan_id` int(11) NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `status` varchar(50) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_peminjaman_ruangan_keperluan` (`kegiatan`),
  KEY `FK_peminjaman_ruangan_ruangan` (`ruangan_id`),
  CONSTRAINT `FK_peminjaman_ruangan_ruangan` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.peminjaman_ruangan: ~3 rows (approximately)
DELETE FROM `peminjaman_ruangan`;
/*!40000 ALTER TABLE `peminjaman_ruangan` DISABLE KEYS */;
INSERT INTO `peminjaman_ruangan` (`id`, `nama`, `kegiatan`, `ruangan_id`, `waktu_mulai`, `waktu_selesai`, `status`, `created_at`, `updated_at`) VALUES
	(12, 'aa', 'aa', 1, '2019-07-31 08:00:00', '2019-07-31 09:00:00', '1', '2019-07-29 06:46:48', '2019-07-29 06:46:48'),
	(13, '1', '1', 1, '2019-08-03 09:00:00', '2019-08-03 10:00:00', '2', '2019-08-02 10:56:58', '2019-08-02 18:03:02'),
	(14, 'sf', 'saf', 1, '2019-08-06 09:00:00', '2019-08-06 10:00:00', '-1', '2019-08-02 18:04:03', '2019-08-02 18:37:46');
/*!40000 ALTER TABLE `peminjaman_ruangan` ENABLE KEYS */;

-- Dumping structure for table kp_edu.pengajuan_inventaris
DROP TABLE IF EXISTS `pengajuan_inventaris`;
CREATE TABLE IF NOT EXISTS `pengajuan_inventaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.pengajuan_inventaris: ~1 rows (approximately)
DELETE FROM `pengajuan_inventaris`;
/*!40000 ALTER TABLE `pengajuan_inventaris` DISABLE KEYS */;
INSERT INTO `pengajuan_inventaris` (`id`, `tanggal`, `created_at`, `updated_at`) VALUES
	(1, '2019-08-04 23:47:49', '2019-08-04 23:47:49', '2019-08-04 23:47:49');
/*!40000 ALTER TABLE `pengajuan_inventaris` ENABLE KEYS */;

-- Dumping structure for table kp_edu.permintaan_inventaris
DROP TABLE IF EXISTS `permintaan_inventaris`;
CREATE TABLE IF NOT EXISTS `permintaan_inventaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.permintaan_inventaris: ~2 rows (approximately)
DELETE FROM `permintaan_inventaris`;
/*!40000 ALTER TABLE `permintaan_inventaris` DISABLE KEYS */;
INSERT INTO `permintaan_inventaris` (`id`, `tanggal`, `created_at`, `updated_at`) VALUES
	(7, '2019-08-04 23:44:04', '2019-08-04 23:44:04', '2019-08-04 23:44:04'),
	(8, '2019-08-04 23:44:58', '2019-08-04 23:44:59', '2019-08-04 23:44:59');
/*!40000 ALTER TABLE `permintaan_inventaris` ENABLE KEYS */;

-- Dumping structure for table kp_edu.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) NOT NULL,
  `disposisi_level` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.roles: ~4 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `role_name`, `disposisi_level`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 0, '2019-06-27 21:01:54', '2019-06-27 21:01:55'),
	(2, 'Umum', 0, '2019-06-27 21:01:56', '2019-06-27 21:01:56'),
	(3, 'Kabag TU', 1, '2019-06-27 21:01:57', '2019-06-27 21:01:57'),
	(4, 'Dekan', 2, '2019-06-27 21:01:49', '2019-06-27 21:01:49');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table kp_edu.ruangan
DROP TABLE IF EXISTS `ruangan`;
CREATE TABLE IF NOT EXISTS `ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.ruangan: ~2 rows (approximately)
DELETE FROM `ruangan`;
/*!40000 ALTER TABLE `ruangan` DISABLE KEYS */;
INSERT INTO `ruangan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
	(1, '1222', '2019-06-03 16:11:31', '2019-06-29 13:50:36'),
	(2, '23333', '2019-06-03 16:11:34', '2019-06-29 13:50:43'),
	(3, 'sdfs', '2019-07-10 20:33:39', '2019-07-10 20:33:39');
/*!40000 ALTER TABLE `ruangan` ENABLE KEYS */;

-- Dumping structure for table kp_edu.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_users_roles` (`role_id`),
  CONSTRAINT `FK_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.users: ~4 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin', 'admin@admin.com', '7815696ecbf1c96e6894b779456d330e', 1, '2019-06-29 13:29:43', '2019-06-29 13:29:43'),
	(2, 'umum', 'umum', 'umum@umum.com', '7815696ecbf1c96e6894b779456d330e', 2, '0000-00-00 00:00:00', '2019-07-29 11:19:21'),
	(3, 'kabag tu', 'kabagTU', 'kabagTU@tu.com', '7815696ecbf1c96e6894b779456d330e', 3, '2019-07-10 20:34:02', '2019-07-10 20:34:02'),
	(4, 'dekan', 'dekan', 'dekan', '7815696ecbf1c96e6894b779456d330e', 4, '2019-07-29 11:19:35', '2019-07-29 11:19:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
