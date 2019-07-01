-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.40-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
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

-- Dumping structure for table kp_edu.isi_disposisi
DROP TABLE IF EXISTS `isi_disposisi`;
CREATE TABLE IF NOT EXISTS `isi_disposisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lembar_disposisi_id` int(11) DEFAULT NULL,
  `isi` varchar(250) DEFAULT NULL,
  `from` varchar(50) DEFAULT NULL,
  `destination` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.isi_disposisi: ~0 rows (approximately)
/*!40000 ALTER TABLE `isi_disposisi` DISABLE KEYS */;
REPLACE INTO `isi_disposisi` (`id`, `lembar_disposisi_id`, `isi`, `from`, `destination`, `created_at`, `updated_at`) VALUES
	(1, 1, 'asfsa', 'atasan 1', 'atasan 2', '2019-06-29 19:41:58', '2019-06-29 19:41:58');
/*!40000 ALTER TABLE `isi_disposisi` ENABLE KEYS */;

-- Dumping structure for table kp_edu.keperluan
DROP TABLE IF EXISTS `keperluan`;
CREATE TABLE IF NOT EXISTS `keperluan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keperluan` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.keperluan: ~2 rows (approximately)
/*!40000 ALTER TABLE `keperluan` DISABLE KEYS */;
REPLACE INTO `keperluan` (`id`, `keperluan`, `created_at`, `updated_at`) VALUES
	(1, 'Seminar Hasil', '2019-06-03 16:11:23', '2019-06-03 16:11:23'),
	(2, 'Seminar KP', '2019-06-03 16:11:26', '2019-06-03 16:11:26');
/*!40000 ALTER TABLE `keperluan` ENABLE KEYS */;

-- Dumping structure for table kp_edu.lembar_disposisi
DROP TABLE IF EXISTS `lembar_disposisi`;
CREATE TABLE IF NOT EXISTS `lembar_disposisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(50) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `reference_table` varchar(50) NOT NULL,
  `file` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.lembar_disposisi: ~1 rows (approximately)
/*!40000 ALTER TABLE `lembar_disposisi` DISABLE KEYS */;
REPLACE INTO `lembar_disposisi` (`id`, `position`, `reference_id`, `reference_table`, `file`, `status`, `tanggal`, `created_at`, `updated_at`) VALUES
	(2, 'asfd', 1, 'peminjaman_ruangan', NULL, 'proses', '2019-06-29 19:55:27', '2019-06-29 19:55:27', '2019-06-29 19:55:27');
/*!40000 ALTER TABLE `lembar_disposisi` ENABLE KEYS */;

-- Dumping structure for table kp_edu.peminjaman_ruangan
DROP TABLE IF EXISTS `peminjaman_ruangan`;
CREATE TABLE IF NOT EXISTS `peminjaman_ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) NOT NULL,
  `number_id` varchar(250) NOT NULL,
  `pekerjaan` varchar(250) NOT NULL,
  `keperluan_id` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `waktu_id` int(11) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ruangan_id_waktu_id_tgl_peminjaman` (`ruangan_id`,`waktu_id`,`tgl_peminjaman`),
  KEY `FK_peminjaman_waktu` (`waktu_id`),
  KEY `FK_peminjaman_keperluan` (`keperluan_id`),
  CONSTRAINT `FK_peminjaman_keperluan` FOREIGN KEY (`keperluan_id`) REFERENCES `keperluan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_peminjaman_ruangan` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_peminjaman_waktu` FOREIGN KEY (`waktu_id`) REFERENCES `waktu` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.peminjaman_ruangan: ~3 rows (approximately)
/*!40000 ALTER TABLE `peminjaman_ruangan` DISABLE KEYS */;
REPLACE INTO `peminjaman_ruangan` (`id`, `nama`, `number_id`, `pekerjaan`, `keperluan_id`, `ruangan_id`, `waktu_id`, `tgl_peminjaman`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Toyib', '11451101967', 'Mahasiswa', 1, 1, 1, '2019-06-03', 'pending', '2019-06-03 16:12:19', '2019-06-03 16:12:19'),
	(2, '3453', '', '', 1, 1, 2, '2019-06-03', NULL, '2019-06-03 16:12:28', '2019-06-03 16:12:32'),
	(3, '65757', '', '', 2, 2, 1, '2019-06-03', NULL, '2019-06-03 16:12:44', '2019-06-03 16:12:44');
/*!40000 ALTER TABLE `peminjaman_ruangan` ENABLE KEYS */;

-- Dumping structure for table kp_edu.pengajuan_inventaris
DROP TABLE IF EXISTS `pengajuan_inventaris`;
CREATE TABLE IF NOT EXISTS `pengajuan_inventaris` (
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.pengajuan_inventaris: ~0 rows (approximately)
/*!40000 ALTER TABLE `pengajuan_inventaris` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengajuan_inventaris` ENABLE KEYS */;

-- Dumping structure for table kp_edu.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) NOT NULL,
  `is_disposisi` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.roles: ~5 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
REPLACE INTO `roles` (`id`, `role_name`, `is_disposisi`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 0, '2019-06-27 21:01:54', '2019-06-27 21:01:55'),
	(3, 'Umum', 0, '2019-06-27 21:01:56', '2019-06-27 21:01:56'),
	(4, 'Atasan 1', 1, '2019-06-27 21:01:57', '2019-06-27 21:01:57'),
	(5, 'Atasan 2', 1, '2019-06-27 21:01:49', '2019-06-27 21:01:49'),
	(6, 'Atasan 3', 1, NULL, NULL),
	(7, 'Atasan 4', 1, NULL, NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table kp_edu.ruangan
DROP TABLE IF EXISTS `ruangan`;
CREATE TABLE IF NOT EXISTS `ruangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.ruangan: ~2 rows (approximately)
/*!40000 ALTER TABLE `ruangan` DISABLE KEYS */;
REPLACE INTO `ruangan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
	(1, '1222', '2019-06-03 16:11:31', '2019-06-29 13:50:36'),
	(2, '23333', '2019-06-03 16:11:34', '2019-06-29 13:50:43');
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

-- Dumping data for table kp_edu.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `nama`, `username`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
	(4, 'asdas', 'ads', 'ada@adsa.com', 'adbf5a778175ee757c34d0eba4e932bc', 1, '2019-06-29 13:29:43', '2019-06-29 13:29:43');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table kp_edu.waktu
DROP TABLE IF EXISTS `waktu`;
CREATE TABLE IF NOT EXISTS `waktu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mulai` varchar(50) NOT NULL,
  `selesai` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table kp_edu.waktu: ~3 rows (approximately)
/*!40000 ALTER TABLE `waktu` DISABLE KEYS */;
REPLACE INTO `waktu` (`id`, `mulai`, `selesai`, `created_at`, `updated_at`) VALUES
	(1, '08:00', '10:00', NULL, NULL),
	(2, '10:00', '11:30', NULL, NULL),
	(3, '13:00', '14:30', NULL, NULL);
/*!40000 ALTER TABLE `waktu` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
