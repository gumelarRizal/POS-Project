-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2021 at 03:26 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `dt_checkout`
--

CREATE TABLE `dt_checkout` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_dt_checkout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_checkout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `disc` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dt_checkout`
--

INSERT INTO `dt_checkout` (`id`, `id_dt_checkout`, `id_checkout`, `id_barang`, `id_kategori_barang`, `harga_barang`, `subtotal`, `qty`, `disc`, `created_at`, `updated_at`) VALUES
(27, 'DTCK-001', 'TRXCK-001', 'BRG001', 'KTG001', 75000, 375000, 5, 0, '2021-08-24 07:08:18', '2021-08-24 07:08:18'),
(28, 'DTCK-002', 'TRXCK-001', 'BRG002', 'KTG002', 120000, 12000000, 100, 0, '2021-08-24 07:08:18', '2021-08-24 07:08:18'),
(29, 'DTCK-003', 'TRXCK-001', 'BRG003', 'KTG002', 15000, 225000, 15, 0, '2021-08-24 07:08:18', '2021-08-24 07:08:18'),
(30, 'DTCK-004', 'TRXCK-001', 'BRG-001', 'KTG001', 15000, 75000, 5, 0, '2021-08-28 01:12:47', '2021-08-28 01:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `dt_custompesanan`
--

CREATE TABLE `dt_custompesanan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_dt_customPesanan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_customPesanan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_jasa` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kategori_barang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `harga_jasa` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `subtotal2` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dt_custompesanan`
--

INSERT INTO `dt_custompesanan` (`id`, `id_dt_customPesanan`, `id_customPesanan`, `id_barang`, `id_jasa`, `id_kategori_barang`, `harga_barang`, `harga_jasa`, `discount`, `subtotal2`, `subtotal`, `qty`, `deskripsi`, `created_at`, `updated_at`) VALUES
(47, 'DTCP-001', 'TRXCP-001', 'BRG-002', 'JS001', 'KTG002', 130000, 150000, 0, 150000, 13000000, 100, 'Pemasangan Keramik', '2021-08-28 01:25:33', '2021-08-28 01:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `dt_pembelian`
--

CREATE TABLE `dt_pembelian` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_dt_pembelian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pembelian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dt_pengeluarankas`
--

CREATE TABLE `dt_pengeluarankas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_dt_pengeluaranKas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pengeluaranKas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_coa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dt_pengeluarankas`
--

INSERT INTO `dt_pengeluarankas` (`id`, `id_dt_pengeluaranKas`, `id_pengeluaranKas`, `id_coa`, `subtotal`, `created_at`, `updated_at`) VALUES
(9, 'PNGD-001', 'PNG-001', '513', 1500000, '2021-08-28 01:32:33', '2021-08-28 01:32:33'),
(10, 'PNGD-002', 'PNG-001', '515', 550000, '2021-08-28 01:32:33', '2021-08-28 01:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `dt_retur`
--

CREATE TABLE `dt_retur` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_dt_retur` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_retur` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_15_122536_table_master_system', 1),
(5, '2021_06_19_155627_master_menu', 1),
(6, '2021_06_19_155712_master_pegawai', 1),
(7, '2021_07_01_034259_mt_kategori_barang', 1),
(8, '2021_07_02_143702_tr_checkout', 1),
(9, '2021_07_03_150941_dt_checkout', 1),
(10, '2021_07_08_112448_tr_pembelian', 1),
(11, '2021_07_08_112622_dt_pembelian', 1),
(12, '2021_07_08_144720_create_permission_tables', 1),
(13, '2021_07_12_142053_mt_jasa', 2),
(14, '2021_07_18_142501_tr_custom_pesanan', 3),
(15, '2021_07_18_145604_dt_custom_pesanan', 3),
(16, '2021_07_30_081028_mt_pelanggan', 4),
(17, '2021_08_12_162142_tr_retur', 5),
(18, '2021_08_12_163842_dt_retur', 5),
(19, '2021_08_15_150235_mt_coa', 6),
(20, '2021_08_15_154600_tr_pengeluaran_kas', 7),
(21, '2021_08_15_154613_dt_pengeluaran_kas', 7),
(22, '2021_08_17_103033_tr_presensi', 8),
(23, '2021_08_20_020527_tr_hpp', 9),
(24, '2021_08_26_145137_harga_jual', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mt_barang`
--

CREATE TABLE `mt_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori_barang` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mt_barang`
--

INSERT INTO `mt_barang` (`id`, `id_barang`, `id_kategori_barang`, `nama_barang`, `harga`, `stok`, `satuan`, `created_at`, `updated_at`, `harga_jual`) VALUES
(6, 'BRG-001', 'KTG001', 'Wallpaper Brick 3D', 12500, 50, 'meter', '2021-08-26 08:38:27', '2021-08-26 08:38:27', 15000),
(7, 'BRG-002', 'KTG002', 'Marmer', 100000, 100, 'rim', '2021-08-26 08:39:01', '2021-08-26 08:39:01', 130000),
(9, 'BRG-003', 'KTG001', 'Wallpaper ABC', 12500, 50, 'meter', '2021-08-26 08:38:27', '2021-08-26 08:38:27', 15000),
(10, 'BRG-004', 'KTG002', 'Granit', 100000, 100, 'Dus', '2021-08-26 08:39:01', '2021-08-26 08:39:01', 130000),
(11, 'BRG-005', 'KTG001', 'Walpaper BCAD', 5000, 5, 'pcs', '2021-09-22 07:58:26', '2021-09-22 07:58:38', 5500);

-- --------------------------------------------------------

--
-- Table structure for table `mt_coa`
--

CREATE TABLE `mt_coa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_coa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_coa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CREATED_BY` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mt_coa`
--

INSERT INTO `mt_coa` (`id`, `id_coa`, `nama_coa`, `CREATED_BY`, `created_at`, `updated_at`) VALUES
(1, '111', 'Kas', 'Fajri', '2021-08-15 08:30:24', '2021-08-15 08:30:42'),
(2, '511', 'Beban Gaji', 'Fajri', '2021-08-15 08:32:15', '2021-08-15 08:32:15'),
(3, '512', 'Beban administrasi dan Umum', 'Fajri', '2021-08-15 08:34:26', '2021-08-15 08:34:26'),
(4, '513', 'Beban Listrik', 'Fajri', '2021-08-15 08:42:00', '2021-08-15 08:42:00'),
(5, '514', 'Beban Air', 'Fajri', '2021-08-15 08:42:15', '2021-08-15 08:42:15'),
(6, '515', 'Beban Internet', 'Fajri', '2021-08-15 08:42:25', '2021-08-15 08:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `mt_jasa`
--

CREATE TABLE `mt_jasa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_jasa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jasa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jasa` int(11) NOT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mt_jasa`
--

INSERT INTO `mt_jasa` (`id`, `id_jasa`, `nama_jasa`, `harga_jasa`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 'JS001', 'Jasa Tukang', 150000, 'Hari', '2021-07-18 13:05:57', '2021-07-18 13:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `mt_kategori_barang`
--

CREATE TABLE `mt_kategori_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kategori_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kategori_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CREATED_BY` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mt_kategori_barang`
--

INSERT INTO `mt_kategori_barang` (`id`, `id_kategori_barang`, `nama_kategori_barang`, `CREATED_BY`, `created_at`, `updated_at`) VALUES
(1, 'KTG001', 'Wallpaper', 'Cupay', '2021-07-09 08:43:03', '2021-07-09 08:43:03'),
(2, 'KTG002', 'Keramik', 'Cupay', '2021-07-09 08:43:13', '2021-07-09 08:43:13'),
(3, 'KTG003', 'Cat Tembok', 'Cupay', '2021-07-09 08:44:59', '2021-07-09 08:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `mt_pegawai`
--

CREATE TABLE `mt_pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mt_pelanggan`
--

CREATE TABLE `mt_pelanggan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pelanggan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelanggan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mt_pelanggan`
--

INSERT INTO `mt_pelanggan` (`id`, `id_pelanggan`, `nama_pelanggan`, `email`, `alamat`, `created_at`, `updated_at`) VALUES
(4, 'PLG-001', 'Rizal Gumelar', 'mrizalgumelar@gmail.com', 'Jl. Warung Awi', '2021-07-30 10:42:51', '2021-07-30 10:42:51'),
(5, 'PLG-002', 'Faisal Maulana', 'faisal@gmail.com', 'Jl. Papanggungan', '2021-08-01 08:15:54', '2021-08-01 08:15:54'),
(6, 'PLG-003', 'NovHaris', 'NovHaris@gmail.com', 'Jl. Karawang No 45', '2021-08-05 06:10:30', '2021-08-05 06:10:30'),
(7, 'PLG-004', 'Novrian Haris', 'gumelar@gmail.com', 'jl. Wardlaksdjkaj dlaskjdajks', '2021-08-14 12:30:44', '2021-08-14 12:30:44');

-- --------------------------------------------------------

--
-- Table structure for table `mt_system`
--

CREATE TABLE `mt_system` (
  `id` int(10) UNSIGNED NOT NULL,
  `SYSTEM_CD` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SYSTEM_VALUE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CHILD_VALUE` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CHILD_TEXT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CREATED_BY` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mt_system`
--

INSERT INTO `mt_system` (`id`, `SYSTEM_CD`, `SYSTEM_VALUE`, `CHILD_VALUE`, `CHILD_TEXT`, `CREATED_BY`, `created_at`, `updated_at`) VALUES
(13, 'MENU_ADMIN', 'MASTER DATA', 'COA', 'COA.index', 'RIZAL', '2021-07-07 21:00:10', NULL),
(14, 'MENU_ADMIN', 'TRANSAKSI', 'Pengeluaran Kas', 'Pengeluaran.index', 'RIZAL', '2021-07-07 21:00:10', NULL),
(15, 'MENU_ADMIN', 'LAPORAN', 'Laporan Laba Rugi', 'Report.Laba', 'RIZAL', '2021-07-07 21:00:10', NULL),
(16, 'MENU_ADMIN', 'MASTER DATA', 'Pegawai', 'Pegawai.index', 'RIZAL', '2021-07-07 21:00:10', NULL),
(17, 'MENU_ADMIN', 'MASTER DATA', 'Menu', 'Menu.index', 'RIZAL', '2021-07-07 21:00:10', NULL),
(18, 'MENU_ADMIN', 'TRANSAKSI', 'Check Out Pesanan', 'Checkout.index', 'RIZAL', '2021-07-07 21:00:10', NULL),
(19, 'MENU_ADMIN', 'LAPORAN', 'Laporan Penjualan', 'Report.index', 'RIZAL', '2021-07-07 21:00:10', NULL),
(20, 'MENU_ADMIN', 'MASTER DATA', 'Kategori Barang', 'KtgBrg.index', 'RIZAL', '2021-07-07 21:00:10', NULL),
(21, 'MENU_ADMIN', 'TRANSAKSI', 'Pembelian Barang', 'Pembelian.index', 'RIZAL', '2021-07-07 21:00:10', NULL),
(22, 'MENU_ADMIN', 'TRANSAKSI', 'Custom Pesanan', 'CustomPesanan.index', 'RIZAL', '2021-07-07 21:00:10', NULL),
(23, 'MENU_ADMIN', 'TRANSAKSI', 'Retur Barang', 'Retur.index', 'RIZAL', '2021-07-07 21:00:10', NULL),
(24, 'MENU_ADMIN', 'LAPORAN', 'Presensi Karyawan', 'presensi.index', 'RIZAL', '2021-07-07 21:00:10', NULL),
(25, 'MENU_ADMIN', 'MASTER DATA', 'Pelanggan', 'Pelanggan.index', 'RIZAL', '2021-07-07 21:00:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2021-07-08 08:22:38', '2021-07-08 08:22:38'),
(2, 'user', 'web', '2021-07-08 08:22:38', '2021-07-08 08:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_checkout`
--

CREATE TABLE `tr_checkout` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_checkout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_checkout`
--

INSERT INTO `tr_checkout` (`id`, `id_checkout`, `total`, `id_user`, `tgl_transaksi`, `created_at`, `updated_at`) VALUES
(16, 'TRXCK-001', 75000, 1, '2021-08-28 08:12:47', '2021-08-28 01:12:47', '2021-08-28 01:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `tr_custompesanan`
--

CREATE TABLE `tr_custompesanan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_customPesanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pelanggan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlahByr` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_custompesanan`
--

INSERT INTO `tr_custompesanan` (`id`, `id_customPesanan`, `id_pelanggan`, `jumlahByr`, `total`, `id_user`, `status`, `tgl_transaksi`, `created_at`, `updated_at`) VALUES
(39, 'TRXCP-001', 'PLG-001', 13150000, 13150000, 1, '0', '2021-08-28 15:25:33', '2021-08-28 01:25:33', '2021-08-28 01:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `tr_hpp`
--

CREATE TABLE `tr_hpp` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_hpp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_trans` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalHpp` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_pembelian`
--

CREATE TABLE `tr_pembelian` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pembelian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_pengeluarankas`
--

CREATE TABLE `tr_pengeluarankas` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pengeluaranKas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_pengeluarankas`
--

INSERT INTO `tr_pengeluarankas` (`id`, `id_pengeluaranKas`, `total`, `deskripsi`, `tgl_transaksi`, `created_at`, `updated_at`) VALUES
(13, 'PNG-001', 2050000, 'Pembayaran Internet, Listrik', '2021-08-28 15:32:33', '2021-08-28 01:32:33', '2021-08-28 01:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `tr_presensi`
--

CREATE TABLE `tr_presensi` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_presensi` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `total_jam` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_transaksi` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_presensi`
--

INSERT INTO `tr_presensi` (`id`, `id_presensi`, `id_user`, `jam_masuk`, `jam_keluar`, `total_jam`, `tgl_transaksi`, `created_at`, `updated_at`) VALUES
(11, 'ABS-001', 1, '23:47:35', '23:47:48', 'Jam = 0 Menit = 0 Detik = 13', '2021-08-17', '2021-08-17 16:47:35', '2021-08-17 16:47:48'),
(12, 'ABS-002', 2, '23:48:37', '23:48:39', 'Jam = 0 Menit = 0 Detik = 2', '2021-08-17', '2021-08-17 16:48:37', '2021-08-17 16:48:39'),
(14, 'ABS-003', 1, '00:27:49', '00:32:36', 'Jam = 0 Menit = 4 Detik = 287', '2021-08-18', '2021-08-17 17:27:49', '2021-08-17 17:32:36'),
(18, 'ABS-004', 1, '00:36:23', '00:36:27', 'Jam = 0 Menit = 0 Detik = 4', '2021-08-19', '2021-08-18 17:36:23', '2021-08-18 17:36:27'),
(19, 'ABS-005', 1, '00:37:10', '00:37:13', 'Jam = 0 Menit = 0 Detik = 3', '2021-08-20', '2021-08-19 17:37:10', '2021-08-19 17:37:13'),
(20, 'ABS-006', 1, '20:49:13', '20:49:17', 'Jam = 0 Menit = 0 Detik = 4', '2021-08-24', '2021-08-24 13:49:13', '2021-08-24 13:49:17'),
(21, 'ABS-007', 1, '22:28:01', NULL, NULL, '2021-09-29', '2021-09-29 15:28:01', '2021-09-29 15:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `tr_retur`
--

CREATE TABLE `tr_retur` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_retur` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_customPesanan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fajri', 'fajri', 'fajri123@gmail.com', NULL, '$2y$10$7WqEkWAMaWP8sTMeFuq/PuhXDidkoFY6I.C1Uq.eM.JZQU3NsjXIq', NULL, '2021-07-08 08:22:38', '2021-07-08 08:22:38'),
(2, 'Cupay', 'cupay', 'cupay123@gmail.com', NULL, '$2y$10$Jooojme7cahUpYdDol8TTOknBa6bEbKVAI2rmZi/B.HubiQduAdry', NULL, '2021-07-08 08:22:38', '2021-07-08 08:22:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dt_checkout`
--
ALTER TABLE `dt_checkout`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dt_checkout_id_dt_checkout_unique` (`id_dt_checkout`);

--
-- Indexes for table `dt_custompesanan`
--
ALTER TABLE `dt_custompesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dt_custompesanan_id_dt_custompesanan_unique` (`id_dt_customPesanan`);

--
-- Indexes for table `dt_pembelian`
--
ALTER TABLE `dt_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dt_pembelian_id_dt_pembelian_unique` (`id_dt_pembelian`);

--
-- Indexes for table `dt_pengeluarankas`
--
ALTER TABLE `dt_pengeluarankas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dt_pengeluarankas_id_dt_pengeluarankas_unique` (`id_dt_pengeluaranKas`);

--
-- Indexes for table `dt_retur`
--
ALTER TABLE `dt_retur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dt_retur_id_dt_retur_unique` (`id_dt_retur`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `mt_barang`
--
ALTER TABLE `mt_barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mt_barang_id_barang_unique` (`id_barang`);

--
-- Indexes for table `mt_coa`
--
ALTER TABLE `mt_coa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mt_coa_id_coa_unique` (`id_coa`);

--
-- Indexes for table `mt_jasa`
--
ALTER TABLE `mt_jasa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mt_jasa_id_jasa_unique` (`id_jasa`);

--
-- Indexes for table `mt_kategori_barang`
--
ALTER TABLE `mt_kategori_barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mt_kategori_barang_id_kategori_barang_unique` (`id_kategori_barang`);

--
-- Indexes for table `mt_pegawai`
--
ALTER TABLE `mt_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mt_pegawai_id_pegawai_unique` (`id_pegawai`);

--
-- Indexes for table `mt_pelanggan`
--
ALTER TABLE `mt_pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mt_pelanggan_id_pelanggan_unique` (`id_pelanggan`);

--
-- Indexes for table `mt_system`
--
ALTER TABLE `mt_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tr_checkout`
--
ALTER TABLE `tr_checkout`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_checkout_id_checkout_unique` (`id_checkout`);

--
-- Indexes for table `tr_custompesanan`
--
ALTER TABLE `tr_custompesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_custompesanan_id_custompesanan_unique` (`id_customPesanan`);

--
-- Indexes for table `tr_hpp`
--
ALTER TABLE `tr_hpp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_hpp_id_hpp_unique` (`id_hpp`);

--
-- Indexes for table `tr_pembelian`
--
ALTER TABLE `tr_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_pembelian_id_pembelian_unique` (`id_pembelian`);

--
-- Indexes for table `tr_pengeluarankas`
--
ALTER TABLE `tr_pengeluarankas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_pengeluarankas_id_pengeluarankas_unique` (`id_pengeluaranKas`);

--
-- Indexes for table `tr_presensi`
--
ALTER TABLE `tr_presensi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_presensi_id_presensi_unique` (`id_presensi`);

--
-- Indexes for table `tr_retur`
--
ALTER TABLE `tr_retur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_return_id_return_unique` (`id_retur`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dt_checkout`
--
ALTER TABLE `dt_checkout`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `dt_custompesanan`
--
ALTER TABLE `dt_custompesanan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `dt_pembelian`
--
ALTER TABLE `dt_pembelian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dt_pengeluarankas`
--
ALTER TABLE `dt_pengeluarankas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dt_retur`
--
ALTER TABLE `dt_retur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mt_barang`
--
ALTER TABLE `mt_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mt_coa`
--
ALTER TABLE `mt_coa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mt_jasa`
--
ALTER TABLE `mt_jasa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mt_kategori_barang`
--
ALTER TABLE `mt_kategori_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mt_pegawai`
--
ALTER TABLE `mt_pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mt_pelanggan`
--
ALTER TABLE `mt_pelanggan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mt_system`
--
ALTER TABLE `mt_system`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tr_checkout`
--
ALTER TABLE `tr_checkout`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tr_custompesanan`
--
ALTER TABLE `tr_custompesanan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tr_hpp`
--
ALTER TABLE `tr_hpp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_pembelian`
--
ALTER TABLE `tr_pembelian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tr_pengeluarankas`
--
ALTER TABLE `tr_pengeluarankas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tr_presensi`
--
ALTER TABLE `tr_presensi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tr_retur`
--
ALTER TABLE `tr_retur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
