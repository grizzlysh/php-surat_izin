-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2019 at 05:33 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_suratizin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(11) NOT NULL,
  `nik_admin` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nik_admin`, `username`, `password`, `role`) VALUES
('AD01', '', 'admin', 'admin', '1'),
('AD02', '8998', 'atasan', 'atasan', '2'),
('AD03', '9017', 'hrd', 'hrd', '3'),
('AD04', '5555', 'hus', 'hus', '4');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `id_dept` varchar(25) NOT NULL,
  `nama_dept` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`id_dept`, `nama_dept`) VALUES
('DPT01', 'ICT'),
('DPT02', 'HR'),
('DPT03', 'Fabric'),
('DPT04', 'FG'),
('DPT06', 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `m_atasan`
--

CREATE TABLE `m_atasan` (
  `kd_izin` varchar(255) NOT NULL,
  `nik_atasan` varchar(255) DEFAULT NULL,
  `jam_kirim` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_atasan`
--

INSERT INTO `m_atasan` (`kd_izin`, `nik_atasan`, `jam_kirim`) VALUES
('IZIN057', '8998', '12:52:34'),
('IZIN058', '8998', '12:57:28'),
('IZIN059', '8998', '13:00:36'),
('IZIN060', 'Hussein', '13:32:26'),
('IZIN061', 'Hussein', '13:33:50'),
('IZIN062', 'Hussein', '13:35:46'),
('IZIN063', '8998', '13:38:43'),
('IZIN064', '8998', '13:54:43'),
('IZIN065', '8998', '14:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `m_karyawan`
--

CREATE TABLE `m_karyawan` (
  `nik_karyawan` varchar(255) NOT NULL,
  `nama_karyawan` varchar(255) NOT NULL,
  `subdept_karyawan` varchar(255) DEFAULT NULL,
  `dept_karyawan` varchar(255) DEFAULT NULL,
  `position_karyawan` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `email_karyawan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_karyawan`
--

INSERT INTO `m_karyawan` (`nik_karyawan`, `nama_karyawan`, `subdept_karyawan`, `dept_karyawan`, `position_karyawan`, `status`, `email_karyawan`) VALUES
('5555', 'Sherlock', 'SUB01', 'DPT02', '701', '1', 'husseinshadowz@gmail.com'),
('8998', 'Hussein', 'SUB04', 'DPT02', '601', '1', 'husseinshadowz@gmail.com'),
('9017', 'Ali', 'SUB03', 'DPT02', '501', '1', 'muhamadat10@gmail.com'),
('9025', 'Nand', 'SUB02', 'DPT02', '801', '1', 'ananda.akf@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `m_perizinan`
--

CREATE TABLE `m_perizinan` (
  `kd_izin` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL,
  `nik_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jam` time NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `alasan` text NOT NULL,
  `alasan_atasan` text,
  `alasan_hrd` text,
  `status_atasan` enum('1','2','3') NOT NULL,
  `status_hrd` enum('1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_perizinan`
--

INSERT INTO `m_perizinan` (`kd_izin`, `created_at`, `is_active`, `nik_user`, `email_user`, `tanggal`, `jam`, `jenis`, `alasan`, `alasan_atasan`, `alasan_hrd`, `status_atasan`, `status_hrd`) VALUES
('IZIN001', '2019-05-07 04:24:00', 0, '9017', 'magnumhussein@gmail.com', '0000-00-00 00:00:00', '21:56:00', 'Terlambat Masuk Kerja', 'alll', NULL, NULL, '1', '1'),
('IZIN002', '2019-05-08 04:24:00', 0, 'a11.2015.08999', 'magnumhussein@gmail.com', '0000-00-00 00:00:00', '20:01:00', 'Dinas', 'asdasd', NULL, NULL, '1', '1'),
('IZIN003', '2019-05-06 04:24:00', 0, 'a11.2015.08999', 'muhamadat10@gmail.com', '0000-00-00 00:00:00', '23:57:00', 'Meninggalkan Pekerjaan', 'ea', NULL, NULL, '1', '1'),
('IZIN004', '2019-05-02 04:24:00', 0, 'a11.2015.08999', 'borutouzumakki@gmail.com', '0000-00-00 00:00:00', '19:56:00', 'Meninggalkan Pekerjaan', 'asd', NULL, NULL, '1', '1'),
('IZIN005', '2019-05-01 04:24:00', 0, 'a11.2015.08999', 'husseinshadowz@gmail.com', '0000-00-00 00:00:00', '22:59:00', 'Terlambat Masuk Kerja', 'asd', NULL, NULL, '3', '1'),
('IZIN006', '2019-05-03 03:53:54', 0, 'a11.2015.09017', 'husseinshadowz@gmail.com', '0000-00-00 00:00:00', '23:59:00', 'Dinas', 'asd', NULL, NULL, '1', '1'),
('IZIN007', '2019-05-09 03:53:54', 0, 'a11.2015.09017', 'muhamadat10@gmail.com', '0000-00-00 00:00:00', '23:59:00', 'Dinas', 'asdasd', NULL, NULL, '1', '1'),
('IZIN008', '2019-04-03 03:53:54', 0, '', 'husseinshadowz@gmail.com', '0000-00-00 00:00:00', '22:59:00', 'Dinas', 'a', NULL, NULL, '1', '1'),
('IZIN009', '2019-04-02 03:53:54', 0, 'a11.2015.08999', 'husseinshadowz@gmail.com', '0000-00-00 00:00:00', '22:58:00', 'Terlambat Masuk Kerja', 'asd', NULL, NULL, '2', '1'),
('IZIN010', '2019-04-01 03:53:54', 0, 'a11.2015.08999', 'husseinsharkdowz@gmail.com', '0000-00-00 00:00:00', '21:58:00', 'Terlambat Masuk Kerja', 'askd', NULL, NULL, '3', '1'),
('IZIN011', '2019-04-02 03:53:54', 0, 'A11.2015.09267', 'rghalif@gmail.com', '0000-00-00 00:00:00', '12:30:00', 'Meninggalkan Pekerjaan', 'Lelah', NULL, NULL, '3', '1'),
('IZIN012', '2019-04-01 03:53:54', 0, 'a11.2015.08999', 'magnumhussein@gmail.com', '2019-03-31 17:00:00', '22:59:00', 'Terlambat Masuk Kerja', 'c', '', NULL, '3', '1'),
('IZIN013', '2019-04-02 03:53:54', 0, 'a11.2015.08999', 'husseinshadowz@gmail.com', '2019-04-03 17:00:00', '00:59:00', 'Meninggalkan Pekerjaan', 'asd', NULL, NULL, '2', '3'),
('IZIN014', '2019-04-03 03:53:54', 0, 'a11.2015.09017', 'husseinshadowz@gmail.com', '2019-04-03 17:00:00', '22:55:00', 'Terlambat Masuk Kerja', 'maap', NULL, 'bingung', '2', '3'),
('IZIN015', '2019-04-01 03:53:54', 0, 'a11.2015.09017', 'husseinshadowz@gmail.com', '2019-04-03 17:00:00', '22:55:00', 'Meninggalkan Pekerjaan', 'hmmm', NULL, NULL, '2', '2'),
('IZIN016', '2019-04-03 03:53:54', 0, 'a11.2015.09017', 'husseinshadowz@gmail.com', '2019-04-03 17:00:00', '23:59:00', 'Dinas', 'aaa', NULL, NULL, '1', '1'),
('IZIN017', '2019-04-02 03:53:54', 0, 'a11.2015.08999', 'husseinshadowz@gmail.com', '2019-04-03 17:00:00', '23:59:00', 'Dinas', 'sss', NULL, NULL, '1', '1'),
('IZIN018', '2019-04-05 21:52:02', 0, 'a11.2015.09017', 'borutouzumakki@gmail.com', '2019-04-05 17:00:00', '23:59:00', 'Dinas', 'asd', NULL, NULL, '2', '2'),
('IZIN019', '2019-04-05 22:19:44', 0, 'A11.2015.09017', 'husseinsharkdowz@gmail.com', '2019-04-05 17:00:00', '22:59:00', 'Terlambat Masuk Kerja', 'asd', NULL, NULL, '2', '2'),
('IZIN020', '2019-04-06 03:19:20', 0, 'a11.2015.08999', 'husseinsharkdowz@gmail.com', '2019-04-05 17:00:00', '23:59:00', 'Terlambat Masuk Kerja', 'asd', NULL, NULL, '2', '2'),
('IZIN021', '2019-04-06 03:32:25', 0, 'a11.2015.09017', 'blablabla@gmail.com', '2019-04-05 17:00:00', '22:56:00', 'Terlambat Masuk Kerja', 'asd', NULL, NULL, '2', '2'),
('IZIN022', '2019-04-08 01:20:29', 0, 'a11.2015.08999', 'muhamad.at@gmail.com', '2019-04-07 17:00:00', '11:58:00', 'Dinas', 'asd', NULL, NULL, '2', '2'),
('IZIN023', '2019-04-08 03:05:51', 0, 'a11.2015.09017', 'magnumhussein@gmail.com', '2019-04-07 17:00:00', '10:59:00', 'Meninggalkan Pekerjaan', 'sad', NULL, 'hu', '2', '3'),
('IZIN024', '2019-04-08 03:08:23', 0, 'a11.2015.08999', 'borutouzumakki@gmail.com', '2019-04-07 17:00:00', '10:57:00', 'Terlambat Masuk Kerja', 'asdasd', NULL, NULL, '2', '2'),
('IZIN025', '2019-04-09 03:32:50', 0, 'a11.2015.08999', 'husseinshadowz@gmail.com', '2019-04-09 08:32:50', '23:58:00', 'Dinas', 'a', NULL, NULL, '2', '2'),
('IZIN026', '2019-04-09 03:41:01', 0, 'A11.2016.0999', 'husseinshadowz@gmail.com', '2019-04-09 08:41:01', '22:56:00', 'Meninggalkan Pekerjaan', 'asd', NULL, NULL, '2', '2'),
('IZIN027', '2019-04-09 03:45:12', 0, 'a11.2015.09017', 'husseinshadowz@gmail.com', '2019-04-09 08:45:12', '23:58:00', 'Terlambat Masuk Kerja', 'c', NULL, NULL, '2', '2'),
('IZIN028', '2019-04-09 21:16:55', 0, 'a11.2015.09017', 'husseinshadowz@gmail.com', '2019-04-10 02:16:55', '23:59:00', 'Dinas', 'adada', NULL, 'gpp', '2', '3'),
('IZIN029', '2019-04-09 21:21:13', 0, 'a11.2015.09017', 'husseinshadowz@gmail.com', '2019-04-10 02:21:13', '23:59:00', 'Terlambat Masuk Kerja', 'aqwe', NULL, NULL, '2', '2'),
('IZIN030', '2019-04-09 21:27:39', 0, 'a11.2015.08999', 'husseinshadowz@gmail.com', '2019-04-10 02:27:39', '08:54:00', 'Dinas', 'ada', NULL, NULL, '2', '2'),
('IZIN031', '2019-04-09 21:36:46', 0, 'a11.2015.08999', 'husseinsharkdowz@gmail.com', '2019-04-10 02:36:46', '08:58:00', 'Dinas', 'asd', NULL, NULL, '2', '2'),
('IZIN032', '2019-04-09 21:37:05', 0, 'A11.2016.0999', 'husseinshadowz@gmail.com', '2019-04-10 02:37:05', '11:00:00', 'Dinas', 'asd', NULL, NULL, '2', '2'),
('IZIN033', '2019-04-09 21:44:20', 0, 'A11.2016.0999', 'husseinshadowz@gmail.com', '2019-04-10 02:44:20', '07:00:00', 'Dinas', 'l', NULL, NULL, '2', '2'),
('IZIN034', '2019-04-09 21:55:17', 0, 'A11.2015.08998', 'husseinshadowz@gmail.com', '2019-04-10 02:55:17', '07:59:00', 'Terlambat Masuk Kerja', 'ssss', NULL, NULL, '2', '2'),
('IZIN035', '2019-04-09 21:55:48', 0, 'a11.2015.08999', 'husseinshadowz@gmail.com', '2019-04-10 02:55:48', '08:57:00', 'Meninggalkan Pekerjaan', 'sadad', NULL, NULL, '2', '2'),
('IZIN036', '2019-04-09 21:56:14', 0, 'a11.2015.09017', 'husseinshadowz@gmail.com', '2019-04-10 02:56:14', '12:59:00', 'Meninggalkan Pekerjaan', 'qweqwe', NULL, NULL, '2', '2'),
('IZIN037', '2019-04-09 22:01:04', 0, 'a11.2015.08999', 'husseinshadowz@gmail.com', '2019-04-10 03:01:04', '14:58:00', 'Dinas', 'qwe123', NULL, NULL, '2', '2'),
('IZIN038', '2019-04-30 03:29:35', 0, '9017', 'muhamadat10@gmail.com', '2019-04-30 08:29:35', '23:00:00', 'Dinas', 'adadad', 'gak tau', NULL, '3', '1'),
('IZIN039', '2019-04-30 03:31:50', 0, '9017', 'muhamadat10@gmail.com', '2019-04-30 08:31:50', '01:59:00', 'Terlambat Masuk Kerja', 'sssss', NULL, NULL, '2', '1'),
('IZIN040', '2019-04-30 03:40:54', 0, '9017', 'muhamadat10@gmail.com', '2019-04-30 08:40:54', '22:00:00', 'Meninggalkan Pekerjaan', 'adadada', NULL, NULL, '2', '2'),
('IZIN041', '2019-04-30 03:42:20', 0, '9017', 'muhamadat10@gmail.com', '2019-04-30 08:42:20', '22:59:00', 'Terlambat Masuk Kerja', 'qweqwe', 'aaaaa', NULL, '3', '1'),
('IZIN042', '2019-04-30 03:43:50', 0, '9017', 'muhamadat10@gmail.com', '2019-04-30 08:43:50', '23:00:00', 'Dinas', 'adadada', NULL, 'aaaa', '2', '3'),
('IZIN043', '2019-05-02 02:53:18', 0, '8998', 'muhamadat10@gmail.com', '2019-05-02 07:53:18', '01:51:00', 'Dinas', 'asd', NULL, NULL, '1', '1'),
('IZIN044', '2019-05-02 02:54:06', 0, '9017', 'muhamadat10@gmail.com', '2019-05-02 07:54:06', '03:55:00', 'Dinas', 'asd', NULL, NULL, '1', '1'),
('IZIN045', '2019-04-30 22:43:09', 0, '8998', 'muhamadat10@gmail.com', '2019-05-09 03:43:09', '09:41:00', 'Meninggalkan Pekerjaan', 'keluar dari perusahaan\r\n', NULL, NULL, '1', '1'),
('IZIN046', '2019-05-01 22:43:36', 0, '9017', 'muhamadat10@gmail.com', '2019-05-09 03:43:36', '08:42:00', 'Terlambat Masuk Kerja', 'maaf', NULL, NULL, '1', '1'),
('IZIN047', '2019-05-06 22:45:30', 0, '8998', 'muhamadat10@gmail.com', '2019-05-09 03:45:30', '10:44:00', 'Dinas', 'out', NULL, NULL, '1', '1'),
('IZIN048', '2019-05-06 22:46:01', 0, '9017', 'muhamadat10@gmail.com', '2019-05-09 03:46:01', '09:45:00', 'Meninggalkan Pekerjaan', 'kkkk', NULL, NULL, '1', '1'),
('IZIN049', '2019-05-08 22:47:36', 0, '9017', 'muhamadat10@gmail.com', '2019-05-09 03:47:36', '09:45:00', 'Dinas', 'asda', NULL, NULL, '1', '1'),
('IZIN050', '2019-05-08 22:48:02', 0, '8998', 'muhamadat10@gmail.com', '2019-05-09 03:48:02', '09:50:00', 'Dinas', 'qweqwe', NULL, NULL, '2', '2'),
('IZIN051', '2019-05-08 22:48:02', 0, '8998', 'muhamadat10@gmail.com', '2019-05-09 03:48:02', '09:50:00', 'Dinas', 'qweqwe', NULL, NULL, '3', '1'),
('IZIN052', '2019-05-08 22:48:02', 0, '8998', 'muhamadat10@gmail.com', '2019-05-09 03:48:02', '09:50:00', 'Dinas', 'qweqwe', NULL, NULL, '2', '3'),
('IZIN053', '2019-05-09 03:21:49', 0, '8998', 'muhamadat10@gmail.com', '2019-05-09 08:21:49', '15:21:00', 'Dinas', 'ijin keluar', NULL, NULL, '2', '2'),
('IZIN054', '2019-05-09 03:30:27', 0, '9017', 'muhamadat10@gmail.com', '2019-05-09 08:30:27', '14:00:00', 'Terlambat Masuk Kerja', 'maaf terlambat', NULL, NULL, '1', '1'),
('IZIN055', '2019-05-15 00:33:27', 1, '9025', 'husseinshadowz@gmail.com', '2019-05-15 05:33:27', '13:30:00', 'Terlambat Masuk Kerja', 'asd', NULL, NULL, '1', '1'),
('IZIN056', '2019-05-15 00:35:19', 1, '9025', 'husseinshadowz@gmail.com', '2019-05-15 05:35:19', '13:30:00', 'Terlambat Masuk Kerja', 'asd', NULL, NULL, '1', '1'),
('IZIN057', '2019-05-15 00:52:34', 1, '5555', 'husseinshadowz@gmail.com', '2019-05-15 05:52:34', '13:50:00', 'Dinas', 'asd', NULL, NULL, '1', '1'),
('IZIN058', '2019-05-15 00:57:28', 1, '5555', 'husseinshadowz@gmail.com', '2019-05-15 05:57:28', '14:00:00', 'Dinas', 'asd', NULL, NULL, '1', '1'),
('IZIN059', '2019-05-15 01:00:36', 1, '5555', 'husseinshadowz@gmail.com', '2019-05-15 06:00:36', '13:00:00', 'Dinas', 'asd', 'kebanyakan', NULL, '3', '3'),
('IZIN060', '2019-05-15 01:32:26', 1, '5555', 'husseinshadowz@gmail.com', '2019-05-15 06:32:26', '13:00:00', 'Dinas', 'asd', NULL, NULL, '1', '1'),
('IZIN061', '2019-05-15 01:33:50', 1, '5555', 'husseinshadowz@gmail.com', '2019-05-15 06:33:50', '23:59:00', 'Dinas', 'asd', NULL, NULL, '1', '1'),
('IZIN062', '2019-05-15 01:35:46', 1, '5555', 'husseinshadowz@gmail.com', '2019-05-15 06:35:46', '22:59:00', 'Dinas', 'asd', NULL, NULL, '1', '1'),
('IZIN063', '2019-05-15 01:38:43', 1, '5555', 'husseinshadowz@gmail.com', '2019-05-15 06:38:43', '23:59:00', 'Dinas', 'af', 'kebanyakan', NULL, '3', '3'),
('IZIN064', '2019-05-15 01:54:43', 1, '5555', 'husseinshadowz@gmail.com', '2019-05-15 06:54:43', '04:01:00', 'Dinas', 'sdf', NULL, 'kebanyakan', '2', '3'),
('IZIN065', '2019-05-15 02:01:16', 1, '5555', 'husseinshadowz@gmail.com', '2019-05-15 07:01:16', '22:59:00', 'Dinas', 'asd', NULL, NULL, '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `m_scan`
--

CREATE TABLE `m_scan` (
  `kd_izin` varchar(255) NOT NULL,
  `nik_user` varchar(255) NOT NULL,
  `jam_1` time DEFAULT NULL,
  `alasan_1` varchar(255) DEFAULT NULL,
  `ip_1` varchar(255) DEFAULT NULL,
  `jam_2` time DEFAULT NULL,
  `alasan_2` varchar(255) DEFAULT NULL,
  `ip_2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_scan`
--

INSERT INTO `m_scan` (`kd_izin`, `nik_user`, `jam_1`, `alasan_1`, `ip_1`, `jam_2`, `alasan_2`, `ip_2`) VALUES
('IZIN020', 'a11.2015.08999', '15:40:28', NULL, NULL, '14:54:53', NULL, NULL),
('IZIN021', 'a11.2015.09017', '16:03:02', NULL, NULL, '15:28:33', NULL, NULL),
('IZIN022', 'a11.2015.08999', '13:28:55', 'asd', NULL, '13:28:57', NULL, NULL),
('IZIN023', 'a11.2015.09017', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN024', 'a11.2015.08999', '15:11:06', NULL, NULL, '15:33:46', NULL, NULL),
('IZIN025', 'a11.2015.08999', '15:34:20', NULL, '192.168.77.254', '15:35:08', NULL, '192.168.77.88'),
('IZIN026', 'A11.2016.0999', '15:41:24', NULL, '::1', '15:41:46', NULL, '192.168.77.88'),
('IZIN027', 'a11.2015.09017', '15:45:51', NULL, '::1', '15:46:38', NULL, '192.168.77.88'),
('IZIN028', 'a11.2015.09017', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN029', 'a11.2015.09017', NULL, 'jnj', '::1', '09:25:58', NULL, '::1'),
('IZIN030', 'a11.2015.08999', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN031', 'a11.2015.08999', '09:51:04', 'kmk', '::1', '09:52:24', NULL, '192.168.77.254'),
('IZIN032', 'A11.2016.0999', '09:38:14', NULL, '192.168.77.254', '10:12:43', NULL, '192.168.77.101'),
('IZIN033', 'A11.2016.0999', NULL, 'nmk', '::1', NULL, NULL, NULL),
('IZIN034', 'A11.2015.08998', '09:58:28', 'mmm', '::1', '09:59:21', NULL, '192.168.77.254'),
('IZIN035', 'a11.2015.08999', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN036', 'a11.2015.09017', '10:00:17', NULL, '192.168.77.254', '10:00:32', NULL, '::1'),
('IZIN037', 'a11.2015.08999', '10:02:44', NULL, '192.168.77.254', NULL, NULL, NULL),
('IZIN038', '09017', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN039', '09017', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN040', '09017', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN041', '09017', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN042', '09017', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN043', '8998', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN044', '9017', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN045', '8998', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN046', '9017', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN047', '8998', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN048', '9017', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN049', '9017', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN050', '8998', '10:58:54', 'duhduh', '::1', NULL, NULL, NULL),
('IZIN053', '8998', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN054', '9017', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN057', '5555', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN058', '5555', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN059', '5555', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN060', '5555', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN061', '5555', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN062', '5555', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN063', '5555', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN064', '5555', NULL, NULL, NULL, NULL, NULL, NULL),
('IZIN065', '5555', '14:02:18', NULL, '::1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_validasi`
--

CREATE TABLE `m_validasi` (
  `kd_izin` varchar(255) NOT NULL,
  `nik_user` varchar(255) NOT NULL,
  `alasan_atasan` text,
  `alasan_hrd` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seksi`
--

CREATE TABLE `seksi` (
  `id_seksi` varchar(25) NOT NULL,
  `nama_seksi` varchar(255) NOT NULL,
  `level_seksi` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seksi`
--

INSERT INTO `seksi` (`id_seksi`, `nama_seksi`, `level_seksi`) VALUES
('100', 'CEO', 3),
('101', 'Presiden Direktur', 1),
('201', 'Direktur', 2),
('202', 'COO', 4),
('401', 'Factory Manager', 5),
('402', 'Dept. Head', 6),
('501', 'Sub-Dept. Head', 7),
('502', 'Dokter', 8),
('601', 'Supervisor', 8),
('701', 'Staff', 9),
('702', 'Group Leader', 9),
('704', 'Driver', 10),
('801', 'Operator', 10),
('802', 'Cleaning Service', 10),
('803', 'Worker', 10);

-- --------------------------------------------------------

--
-- Table structure for table `sub_dept`
--

CREATE TABLE `sub_dept` (
  `id_sub_dept` varchar(25) NOT NULL,
  `id_dept` varchar(25) NOT NULL,
  `nama_sub_dept` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_dept`
--

INSERT INTO `sub_dept` (`id_sub_dept`, `id_dept`, `nama_sub_dept`) VALUES
('SUB01', 'DPT03', 'EXIM'),
('SUB02', 'DPT06', 'Worker'),
('SUB03', 'DPT03', 'Packing'),
('SUB04', 'DPT01', 'QC');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perizinan`
--

CREATE TABLE `tbl_perizinan` (
  `kd_surat` int(11) NOT NULL,
  `nik` varchar(25) DEFAULT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `departemen` varchar(35) DEFAULT NULL,
  `sub_departemen` varchar(35) DEFAULT NULL,
  `seksi` varchar(35) DEFAULT NULL,
  `waktu_izin` date NOT NULL,
  `jamsd` time DEFAULT NULL,
  `jenis_izin` varchar(50) DEFAULT NULL,
  `alasan` varchar(180) DEFAULT NULL,
  `status` enum('1','2','3') NOT NULL,
  `status_personalia` enum('1','2','3') NOT NULL,
  `kode` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_perizinan`
--

INSERT INTO `tbl_perizinan` (`kd_surat`, `nik`, `nama`, `email`, `departemen`, `sub_departemen`, `seksi`, `waktu_izin`, `jamsd`, `jenis_izin`, `alasan`, `status`, `status_personalia`, `kode`) VALUES
(48, 'b11.2016.09012', 'HUSSEIN', '1111509017@mhs.dinus.ac.id', 'Accessories', 'EXIM', 'Fabric', '0000-00-00', '12:15:00', 'Meninggalkan Pekerjaan', 'adadadada', '1', '2', 0),
(47, 'A11.2015.09020', 'Ali', 'pimpinan@app.com', 'HR', 'Purchasing', 'Manajer ICT', '0000-00-00', '12:15:00', 'Dinas', 'sadaqwe', '1', '3', 0),
(46, 'A11.2015.09017', 'Muhamad Ali Taufiq', 'muhamadat10@gmail.com', 'ICT', 'Purchasing', 'Packing', '0000-00-00', '10:55:00', 'Dinas', 'sasdasd', '1', '1', 0),
(45, 'A11.2015.09021', 'HF', 'user@app.com', 'ICT', 'EXIM', 'Manajer ICT', '0000-00-00', '10:50:00', 'Terlambat Masuk Kerja', 'adawqu', '1', '1', 0),
(49, 'a11.2015.08999', 'Hussein', 'husseinsharkdowz@gmail.com', 'HR', 'Manajer ICT', 'Manajer Packing', '2019-03-19', '23:58:00', 'Terlambat Masuk Kerja', 'aaa', '1', '1', 0),
(50, 'a11.2015.08999', 'Hussein', 'husseinshadowz@gmail.com', 'HR', 'Packing', 'Manajer ICT', '2019-03-19', '23:58:00', 'Terlambat Masuk Kerja', 'aaaaa', '1', '1', 0),
(51, 'a11.2015.08999', 'Hussein', 'husseinshadowz@gmail.com', 'HR', 'Packing', 'Manajer ICT', '2019-03-19', '23:58:00', 'Terlambat Masuk Kerja', 'aaaaa', '1', '1', 0),
(52, 'a11.2015.08999', 'Hussein', 'husseinshadowz@gmail.com', 'HR', 'Packing', 'Manajer ICT', '2019-03-19', '23:58:00', 'Terlambat Masuk Kerja', 'aaaaa', '1', '1', 0),
(53, 'a11.2015.08999', 'Ali', 'muhamad.at@gmail.com', 'ICT', 'Worker', 'Packing', '2019-03-19', '23:57:00', 'Terlambat Masuk Kerja', 'sakit gigi', '1', '1', 0),
(54, 'a11.2015.09017', 'Ali Taufiq', 'muhamad.at@gmail.com', 'Accessories', 'Manajer ICT', 'Manajer Packing', '2019-03-19', '21:53:00', 'Meninggalkan Pekerjaan', 'sakit gigi', '1', '1', 0),
(55, 'A11.2016.0999', 'Hussein', 'husseinsharkdowz@gmail.com', 'HR', 'EXIM', 'Manajer ICT', '2019-03-19', '22:58:00', 'Meninggalkan Pekerjaan', 'ahhak', '1', '1', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indexes for table `m_atasan`
--
ALTER TABLE `m_atasan`
  ADD PRIMARY KEY (`kd_izin`) USING BTREE;

--
-- Indexes for table `m_karyawan`
--
ALTER TABLE `m_karyawan`
  ADD PRIMARY KEY (`nik_karyawan`);

--
-- Indexes for table `m_perizinan`
--
ALTER TABLE `m_perizinan`
  ADD PRIMARY KEY (`kd_izin`);

--
-- Indexes for table `m_scan`
--
ALTER TABLE `m_scan`
  ADD PRIMARY KEY (`kd_izin`);

--
-- Indexes for table `m_validasi`
--
ALTER TABLE `m_validasi`
  ADD PRIMARY KEY (`kd_izin`);

--
-- Indexes for table `seksi`
--
ALTER TABLE `seksi`
  ADD PRIMARY KEY (`id_seksi`);

--
-- Indexes for table `sub_dept`
--
ALTER TABLE `sub_dept`
  ADD PRIMARY KEY (`id_sub_dept`);

--
-- Indexes for table `tbl_perizinan`
--
ALTER TABLE `tbl_perizinan`
  ADD PRIMARY KEY (`kd_surat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_perizinan`
--
ALTER TABLE `tbl_perizinan`
  MODIFY `kd_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
