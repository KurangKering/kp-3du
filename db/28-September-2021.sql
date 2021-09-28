-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.10-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for kp_edu
DROP DATABASE IF EXISTS `kp_edu`;
CREATE DATABASE IF NOT EXISTS `kp_edu` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `kp_edu`;

-- Dumping structure for table kp_edu.daftar_barang
DROP TABLE IF EXISTS `daftar_barang`;
CREATE TABLE IF NOT EXISTS `daftar_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(50) DEFAULT NULL,
  `total` int(11) DEFAULT 0,
  `satuan` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.daftar_barang: ~2 rows (approximately)
/*!40000 ALTER TABLE `daftar_barang` DISABLE KEYS */;
REPLACE INTO `daftar_barang` (`id`, `nama_barang`, `total`, `satuan`, `created_at`, `updated_at`) VALUES
	(1, 'Infokus', 3500, 'unit', '2019-07-22 20:35:27', '2019-08-02 18:51:34'),
	(2, 'Penghapus', 20000, 'unit', '2019-07-22 20:35:54', '2019-08-03 15:23:44'),
	(3, '3', 9000, NULL, NULL, NULL);
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
/*!40000 ALTER TABLE `daftar_inventaris` DISABLE KEYS */;
REPLACE INTO `daftar_inventaris` (`id`, `nama`, `stock`, `satuan`, `created_at`, `updated_at`) VALUES
	(3, 'Pena', 27, 'Pcs', '2019-08-02 19:23:47', '2021-09-28 05:39:32'),
	(4, 'Batu', 7, 'Pcs', '2019-08-03 22:38:51', '2021-09-28 05:39:32');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.det_peminjaman_barang: ~2 rows (approximately)
/*!40000 ALTER TABLE `det_peminjaman_barang` DISABLE KEYS */;
REPLACE INTO `det_peminjaman_barang` (`id`, `peminjaman_barang_id`, `daftar_barang_id`, `jumlah`, `created_at`, `updated_at`) VALUES
	(16, 11, 1, 99, '2021-09-23 12:08:16', '2021-09-23 12:08:16'),
	(17, 11, 2, 2, '2021-09-23 12:08:23', '2021-09-23 12:08:24'),
	(18, 12, 1, 88, '2021-09-23 12:08:34', '2021-09-23 12:08:35');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.det_pengajuan_inventaris: ~2 rows (approximately)
/*!40000 ALTER TABLE `det_pengajuan_inventaris` DISABLE KEYS */;
REPLACE INTO `det_pengajuan_inventaris` (`id`, `pengajuan_inventaris_id`, `daftar_inventaris_id`, `jumlah`, `created_at`, `updated_at`) VALUES
	(5, 4, 4, 5, '2021-09-28 05:39:32', '2021-09-28 05:39:32'),
	(6, 4, 3, 5, '2021-09-28 05:39:32', '2021-09-28 05:39:32');
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.det_permintaan_inventaris: ~2 rows (approximately)
/*!40000 ALTER TABLE `det_permintaan_inventaris` DISABLE KEYS */;
REPLACE INTO `det_permintaan_inventaris` (`id`, `permintaan_inventaris_id`, `daftar_inventaris_id`, `jumlah`, `created_at`, `updated_at`) VALUES
	(22, 10, 4, 22, '2021-09-25 12:34:10', '2021-09-25 12:34:10'),
	(23, 10, 3, 2, '2021-09-25 12:34:10', '2021-09-25 12:34:10');
/*!40000 ALTER TABLE `det_permintaan_inventaris` ENABLE KEYS */;

-- Dumping structure for table kp_edu.det_ruangan
DROP TABLE IF EXISTS `det_ruangan`;
CREATE TABLE IF NOT EXISTS `det_ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruangan_id` int(11) NOT NULL,
  `nama_inventaris` varchar(50) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_det_ruangan_ruangan` (`ruangan_id`),
  CONSTRAINT `FK_det_ruangan_ruangan` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.det_ruangan: ~1 rows (approximately)
/*!40000 ALTER TABLE `det_ruangan` DISABLE KEYS */;
/*!40000 ALTER TABLE `det_ruangan` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.isi_disposisi: ~0 rows (approximately)
/*!40000 ALTER TABLE `isi_disposisi` DISABLE KEYS */;
REPLACE INTO `isi_disposisi` (`id`, `lembar_disposisi_id`, `status`, `isi_penolakan`, `from_role_id`, `destination_role_id`, `created_at`, `updated_at`) VALUES
	(29, 44, '-1', 'asfsa', '3', '2', '2021-09-22 11:06:38', '2021-09-22 11:06:38');
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.lembar_disposisi: ~0 rows (approximately)
/*!40000 ALTER TABLE `lembar_disposisi` DISABLE KEYS */;
REPLACE INTO `lembar_disposisi` (`id`, `position_role_id`, `file`, `status`, `tanggal`, `peminjaman_ruangan_id`, `created_at`, `updated_at`) VALUES
	(45, '3', NULL, '1', '2021-09-25 18:53:09', 26, '2021-09-25 18:53:09', '2021-09-25 18:53:09');
/*!40000 ALTER TABLE `lembar_disposisi` ENABLE KEYS */;

-- Dumping structure for table kp_edu.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.menu: ~12 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
REPLACE INTO `menu` (`id`, `nama`, `link`, `icon`) VALUES
	(1, 'Dashboard', '/private/dashboard', NULL),
	(2, 'Master Data', 'javascript:void(0);', NULL),
	(3, 'Ruangan', '/private/ruangan', NULL),
	(4, 'Daftar Barang', '/private/daftar_barang', NULL),
	(5, 'Daftar Inventaris', '/private/daftar_inventaris', NULL),
	(6, 'Peminjaman Ruangan', '/private/peminjaman_ruangan', NULL),
	(7, 'Peminjaman Barang', '/private/peminjaman_barang', NULL),
	(8, 'Pengajuan Inventaris', '/private/pengajuan_inventaris', NULL),
	(9, 'Permintaan Inventaris', '/private/permintaan_inventaris', NULL),
	(10, 'Lembar Disposisi', '/private/lembar_disposisi', NULL),
	(11, 'Isi Disposisi', '/private/isi_disposisi', NULL),
	(12, 'Pengguna', '/private/user', NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table kp_edu.menu_group
DROP TABLE IF EXISTS `menu_group`;
CREATE TABLE IF NOT EXISTS `menu_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.menu_group: ~12 rows (approximately)
/*!40000 ALTER TABLE `menu_group` DISABLE KEYS */;
REPLACE INTO `menu_group` (`id`, `menu_id`, `parent_id`, `role_id`, `active`, `order`) VALUES
	(1, 1, 0, 0, 1, 1),
	(2, 2, 0, 2, 1, 2),
	(3, 3, 2, 2, 1, 1),
	(4, 4, 2, 2, 1, 2),
	(5, 5, 2, 2, 1, 3),
	(6, 6, 0, 2, 1, 3),
	(7, 7, 0, 2, 1, 4),
	(8, 8, 0, 2, 1, 5),
	(9, 9, 0, 2, 1, 6),
	(10, 10, 0, 3, 1, 2),
	(11, 11, 0, 3, 1, 3),
	(12, 12, 0, 1, 1, 2);
/*!40000 ALTER TABLE `menu_group` ENABLE KEYS */;

-- Dumping structure for table kp_edu.peminjaman_barang
DROP TABLE IF EXISTS `peminjaman_barang`;
CREATE TABLE IF NOT EXISTS `peminjaman_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `kegiatan` varchar(250) DEFAULT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `waktu_pengembalian` datetime DEFAULT NULL,
  `bukti` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.peminjaman_barang: ~2 rows (approximately)
/*!40000 ALTER TABLE `peminjaman_barang` DISABLE KEYS */;
REPLACE INTO `peminjaman_barang` (`id`, `nama`, `kegiatan`, `waktu_mulai`, `waktu_selesai`, `status`, `waktu_pengembalian`, `bukti`, `created_at`, `updated_at`) VALUES
	(11, 'asd', 'ask', '2021-09-23 12:07:19', '2025-09-23 12:07:20', 1, '2021-09-23 12:07:23', 'aaa', '2021-09-23 12:07:26', '2021-09-23 12:07:26'),
	(12, 'dsa', 'ksa', '2021-08-23 12:07:51', '2021-11-23 12:07:55', 1, '2021-09-23 12:07:58', 'b', '2021-09-23 12:08:04', '2021-09-23 12:08:04');
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
  `bukti` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_peminjaman_ruangan_keperluan` (`kegiatan`),
  KEY `FK_peminjaman_ruangan_ruangan` (`ruangan_id`),
  CONSTRAINT `FK_peminjaman_ruangan_ruangan` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.peminjaman_ruangan: ~2 rows (approximately)
/*!40000 ALTER TABLE `peminjaman_ruangan` DISABLE KEYS */;
REPLACE INTO `peminjaman_ruangan` (`id`, `nama`, `kegiatan`, `ruangan_id`, `waktu_mulai`, `waktu_selesai`, `status`, `bukti`, `created_at`, `updated_at`) VALUES
	(25, 'ads', 'dsa', 17, '2021-09-25 16:47:45', '2021-09-25 16:47:45', '1', 'fwe', '2021-09-25 16:47:57', '2021-09-25 16:47:57'),
	(26, 'kodok', 'makan', 17, '2021-09-13 06:00:00', '2021-09-13 07:00:00', '1', '10af37c7a63cf668b55763a064dde280.png', '2021-09-25 18:53:09', '2021-09-25 18:53:09');
/*!40000 ALTER TABLE `peminjaman_ruangan` ENABLE KEYS */;

-- Dumping structure for table kp_edu.pengajuan_inventaris
DROP TABLE IF EXISTS `pengajuan_inventaris`;
CREATE TABLE IF NOT EXISTS `pengajuan_inventaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.pengajuan_inventaris: ~0 rows (approximately)
/*!40000 ALTER TABLE `pengajuan_inventaris` DISABLE KEYS */;
REPLACE INTO `pengajuan_inventaris` (`id`, `tanggal`, `created_at`, `updated_at`) VALUES
	(4, '2021-09-28 05:39:31', '2021-09-28 05:39:32', '2021-09-28 05:39:32');
/*!40000 ALTER TABLE `pengajuan_inventaris` ENABLE KEYS */;

-- Dumping structure for table kp_edu.permintaan_inventaris
DROP TABLE IF EXISTS `permintaan_inventaris`;
CREATE TABLE IF NOT EXISTS `permintaan_inventaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.permintaan_inventaris: ~1 rows (approximately)
/*!40000 ALTER TABLE `permintaan_inventaris` DISABLE KEYS */;
REPLACE INTO `permintaan_inventaris` (`id`, `nama`, `tanggal`, `created_at`, `updated_at`) VALUES
	(10, '1231', '2021-09-25 12:34:10', '2021-09-25 12:34:10', '2021-09-25 12:34:10');
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
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
REPLACE INTO `roles` (`id`, `role_name`, `disposisi_level`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 0, '2019-06-27 21:01:54', '2019-06-27 21:01:55'),
	(2, 'Umum', 0, '2019-06-27 21:01:56', '2019-06-27 21:01:56'),
	(3, 'Kabag TU', 1, '2019-06-27 21:01:57', '2019-06-27 21:01:57'),
	(4, 'Dekan', 0, '2019-06-27 21:01:49', '2019-06-27 21:01:49');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table kp_edu.ruangan
DROP TABLE IF EXISTS `ruangan`;
CREATE TABLE IF NOT EXISTS `ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.ruangan: ~1 rows (approximately)
/*!40000 ALTER TABLE `ruangan` DISABLE KEYS */;
REPLACE INTO `ruangan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
	(17, 'cicak', '2021-09-25 14:58:49', '2021-09-25 14:58:49');
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
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `nama`, `username`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin', 'admin@admin.com', '7815696ecbf1c96e6894b779456d330e', 1, '2019-06-29 13:29:43', '2019-06-29 13:29:43'),
	(2, 'umum', 'umum', 'umum@umum.com', '7815696ecbf1c96e6894b779456d330e', 2, '0000-00-00 00:00:00', '2019-07-29 11:19:21'),
	(3, 'kabag tu', 'kabagTU', 'kabagTU@tu.com', '7815696ecbf1c96e6894b779456d330e', 3, '2019-07-10 20:34:02', '2019-07-10 20:34:02'),
	(4, 'dekan', 'dekan', 'dekan', '7815696ecbf1c96e6894b779456d330e', 4, '2019-07-29 11:19:35', '2019-07-29 11:19:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
