-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 09 Agu 2022 pada 03.12
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lombokmarketplace`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat`
--

CREATE TABLE `alamat` (
  `idalamat` int(11) NOT NULL,
  `alamat_lengkap` varchar(45) DEFAULT NULL,
  `nama_penerima` varchar(45) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `kotakabupaten_idkotakabupaten` int(11) NOT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `telepon` varchar(45) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `provinsi_idprovinsi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `alamat`
--

INSERT INTO `alamat` (`idalamat`, `alamat_lengkap`, `nama_penerima`, `latitude`, `created_at`, `updated_at`, `users_id`, `kotakabupaten_idkotakabupaten`, `longitude`, `telepon`, `deleted_at`, `provinsi_idprovinsi`) VALUES
(1, 'Jln. Sultan Hassanudin', 'Richardo Hartanto', '-8.578725106091214', '2022-07-16 01:26:38', '2022-07-16 01:26:38', 1, 122, '116.08215547238801', '08776127', NULL, 23),
(2, 'kk', 'Ev', '-5.236563859412162', '2022-07-16 03:06:33', '2022-07-16 03:06:33', 1, 254, '119.46130396479317', '123', NULL, 28);

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `pengirim` enum('penjual','pembeli') DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `users_id1` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `etalase_produk`
--

CREATE TABLE `etalase_produk` (
  `idetalase_produk` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `toko_users_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `etalase_produk`
--

INSERT INTO `etalase_produk` (`idetalase_produk`, `nama`, `toko_users_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mouse Gaming Bosku Edit', 1, '2022-07-07 06:01:08', '2022-07-07 07:05:51', '2022-07-07 07:05:51'),
(2, 'Logitech Gaming G', 1, '2022-07-08 08:13:36', '2022-07-08 08:13:36', NULL),
(3, 'Asus ROG', 1, '2022-07-08 19:44:44', '2022-07-08 19:44:44', NULL),
(4, 'Kue kerign', 2, '2022-07-12 11:34:13', '2022-07-12 11:34:13', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_produk`
--

CREATE TABLE `gambar_produk` (
  `idgambar_produk` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `produk_idproduk` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `gambar_produk`
--

INSERT INTO `gambar_produk` (`idgambar_produk`, `created_at`, `updated_at`, `produk_idproduk`, `deleted_at`) VALUES
('a.PNG', '2022-07-12 11:35:15', '2022-07-12 11:35:15', 3, NULL),
('baru sekaleeee ini.png', '2022-07-12 11:23:01', '2022-07-12 11:23:01', 2, NULL),
('index.jpg', '2022-07-11 20:53:45', '2022-07-11 20:53:45', 1, NULL),
('Logo-Ubaya-untuk-Watermark-v.1.jpg', '2022-07-11 20:55:30', '2022-07-11 20:55:30', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Acc Komp', NULL, NULL, NULL),
(2, 'Acc Monitor', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `produk_idproduk` int(11) NOT NULL,
  `jumlah` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`users_id`, `produk_idproduk`, `jumlah`) VALUES
(1, 1, '1'),
(1, 2, '1'),
(1, 3, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kotakabupaten`
--

CREATE TABLE `kotakabupaten` (
  `idkotakabupaten` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provinsi_idprovinsi` int(11) NOT NULL,
  `kodepos` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kotakabupaten`
--

INSERT INTO `kotakabupaten` (`idkotakabupaten`, `nama`, `created_at`, `updated_at`, `provinsi_idprovinsi`, `kodepos`) VALUES
(1, 'Aceh Barat', NULL, NULL, 21, '23681'),
(2, 'Aceh Barat Daya', NULL, NULL, 21, '23764'),
(3, 'Aceh Besar', NULL, NULL, 21, '23951'),
(4, 'Aceh Jaya', NULL, NULL, 21, '23654'),
(5, 'Aceh Selatan', NULL, NULL, 21, '23719'),
(6, 'Aceh Singkil', NULL, NULL, 21, '24785'),
(7, 'Aceh Tamiang', NULL, NULL, 21, '24476'),
(8, 'Aceh Tengah', NULL, NULL, 21, '24511'),
(9, 'Aceh Tenggara', NULL, NULL, 21, '24611'),
(10, 'Aceh Timur', NULL, NULL, 21, '24454'),
(11, 'Aceh Utara', NULL, NULL, 21, '24382'),
(12, 'Agam', NULL, NULL, 32, '26411'),
(13, 'Alor', NULL, NULL, 23, '85811'),
(14, 'Ambon', NULL, NULL, 19, '97222'),
(15, 'Asahan', NULL, NULL, 34, '21214'),
(16, 'Asmat', NULL, NULL, 24, '99777'),
(17, 'Badung', NULL, NULL, 1, '80351'),
(18, 'Balangan', NULL, NULL, 13, '71611'),
(19, 'Balikpapan', NULL, NULL, 15, '76111'),
(20, 'Banda Aceh', NULL, NULL, 21, '23238'),
(21, 'Bandar Lampung', NULL, NULL, 18, '35139'),
(22, 'Bandung', NULL, NULL, 9, '40311'),
(23, 'Bandung', NULL, NULL, 9, '40111'),
(24, 'Bandung Barat', NULL, NULL, 9, '40721'),
(25, 'Banggai', NULL, NULL, 29, '94711'),
(26, 'Banggai Kepulauan', NULL, NULL, 29, '94881'),
(27, 'Bangka', NULL, NULL, 2, '33212'),
(28, 'Bangka Barat', NULL, NULL, 2, '33315'),
(29, 'Bangka Selatan', NULL, NULL, 2, '33719'),
(30, 'Bangka Tengah', NULL, NULL, 2, '33613'),
(31, 'Bangkalan', NULL, NULL, 11, '69118'),
(32, 'Bangli', NULL, NULL, 1, '80619'),
(33, 'Banjar', NULL, NULL, 13, '70619'),
(34, 'Banjar', NULL, NULL, 9, '46311'),
(35, 'Banjarbaru', NULL, NULL, 13, '70712'),
(36, 'Banjarmasin', NULL, NULL, 13, '70117'),
(37, 'Banjarnegara', NULL, NULL, 10, '53419'),
(38, 'Bantaeng', NULL, NULL, 28, '92411'),
(39, 'Bantul', NULL, NULL, 5, '55715'),
(40, 'Banyuasin', NULL, NULL, 33, '30911'),
(41, 'Banyumas', NULL, NULL, 10, '53114'),
(42, 'Banyuwangi', NULL, NULL, 11, '68416'),
(43, 'Barito Kuala', NULL, NULL, 13, '70511'),
(44, 'Barito Selatan', NULL, NULL, 14, '73711'),
(45, 'Barito Timur', NULL, NULL, 14, '73671'),
(46, 'Barito Utara', NULL, NULL, 14, '73881'),
(47, 'Barru', NULL, NULL, 28, '90719'),
(48, 'Batam', NULL, NULL, 17, '29413'),
(49, 'Batang', NULL, NULL, 10, '51211'),
(50, 'Batang Hari', NULL, NULL, 8, '36613'),
(51, 'Batu', NULL, NULL, 11, '65311'),
(52, 'Batu Bara', NULL, NULL, 34, '21655'),
(53, 'Bau-Bau', NULL, NULL, 30, '93719'),
(54, 'Bekasi', NULL, NULL, 9, '17837'),
(55, 'Bekasi', NULL, NULL, 9, '17121'),
(56, 'Belitung', NULL, NULL, 2, '33419'),
(57, 'Belitung Timur', NULL, NULL, 2, '33519'),
(58, 'Belu', NULL, NULL, 23, '85711'),
(59, 'Bener Meriah', NULL, NULL, 21, '24581'),
(60, 'Bengkalis', NULL, NULL, 26, '28719'),
(61, 'Bengkayang', NULL, NULL, 12, '79213'),
(62, 'Bengkulu', NULL, NULL, 4, '38229'),
(63, 'Bengkulu Selatan', NULL, NULL, 4, '38519'),
(64, 'Bengkulu Tengah', NULL, NULL, 4, '38319'),
(65, 'Bengkulu Utara', NULL, NULL, 4, '38619'),
(66, 'Berau', NULL, NULL, 15, '77311'),
(67, 'Biak Numfor', NULL, NULL, 24, '98119'),
(68, 'Bima', NULL, NULL, 22, '84171'),
(69, 'Bima', NULL, NULL, 22, '84139'),
(70, 'Binjai', NULL, NULL, 34, '20712'),
(71, 'Bintan', NULL, NULL, 17, '29135'),
(72, 'Bireuen', NULL, NULL, 21, '24219'),
(73, 'Bitung', NULL, NULL, 31, '95512'),
(74, 'Blitar', NULL, NULL, 11, '66171'),
(75, 'Blitar', NULL, NULL, 11, '66124'),
(76, 'Blora', NULL, NULL, 10, '58219'),
(77, 'Boalemo', NULL, NULL, 7, '96319'),
(78, 'Bogor', NULL, NULL, 9, '16911'),
(79, 'Bogor', NULL, NULL, 9, '16119'),
(80, 'Bojonegoro', NULL, NULL, 11, '62119'),
(81, 'Bolaang Mongondow (Bolmong)', NULL, NULL, 31, '95755'),
(82, 'Bolaang Mongondow Selatan', NULL, NULL, 31, '95774'),
(83, 'Bolaang Mongondow Timur', NULL, NULL, 31, '95783'),
(84, 'Bolaang Mongondow Utara', NULL, NULL, 31, '95765'),
(85, 'Bombana', NULL, NULL, 30, '93771'),
(86, 'Bondowoso', NULL, NULL, 11, '68219'),
(87, 'Bone', NULL, NULL, 28, '92713'),
(88, 'Bone Bolango', NULL, NULL, 7, '96511'),
(89, 'Bontang', NULL, NULL, 15, '75313'),
(90, 'Boven Digoel', NULL, NULL, 24, '99662'),
(91, 'Boyolali', NULL, NULL, 10, '57312'),
(92, 'Brebes', NULL, NULL, 10, '52212'),
(93, 'Bukittinggi', NULL, NULL, 32, '26115'),
(94, 'Buleleng', NULL, NULL, 1, '81111'),
(95, 'Bulukumba', NULL, NULL, 28, '92511'),
(96, 'Bulungan (Bulongan)', NULL, NULL, 16, '77211'),
(97, 'Bungo', NULL, NULL, 8, '37216'),
(98, 'Buol', NULL, NULL, 29, '94564'),
(99, 'Buru', NULL, NULL, 19, '97371'),
(100, 'Buru Selatan', NULL, NULL, 19, '97351'),
(101, 'Buton', NULL, NULL, 30, '93754'),
(102, 'Buton Utara', NULL, NULL, 30, '93745'),
(103, 'Ciamis', NULL, NULL, 9, '46211'),
(104, 'Cianjur', NULL, NULL, 9, '43217'),
(105, 'Cilacap', NULL, NULL, 10, '53211'),
(106, 'Cilegon', NULL, NULL, 3, '42417'),
(107, 'Cimahi', NULL, NULL, 9, '40512'),
(108, 'Cirebon', NULL, NULL, 9, '45611'),
(109, 'Cirebon', NULL, NULL, 9, '45116'),
(110, 'Dairi', NULL, NULL, 34, '22211'),
(111, 'Deiyai (Deliyai)', NULL, NULL, 24, '98784'),
(112, 'Deli Serdang', NULL, NULL, 34, '20511'),
(113, 'Demak', NULL, NULL, 10, '59519'),
(114, 'Denpasar', NULL, NULL, 1, '80227'),
(115, 'Depok', NULL, NULL, 9, '16416'),
(116, 'Dharmasraya', NULL, NULL, 32, '27612'),
(117, 'Dogiyai', NULL, NULL, 24, '98866'),
(118, 'Dompu', NULL, NULL, 22, '84217'),
(119, 'Donggala', NULL, NULL, 29, '94341'),
(120, 'Dumai', NULL, NULL, 26, '28811'),
(121, 'Empat Lawang', NULL, NULL, 33, '31811'),
(122, 'Ende', NULL, NULL, 23, '86351'),
(123, 'Enrekang', NULL, NULL, 28, '91719'),
(124, 'Fakfak', NULL, NULL, 25, '98651'),
(125, 'Flores Timur', NULL, NULL, 23, '86213'),
(126, 'Garut', NULL, NULL, 9, '44126'),
(127, 'Gayo Lues', NULL, NULL, 21, '24653'),
(128, 'Gianyar', NULL, NULL, 1, '80519'),
(129, 'Gorontalo', NULL, NULL, 7, '96218'),
(130, 'Gorontalo', NULL, NULL, 7, '96115'),
(131, 'Gorontalo Utara', NULL, NULL, 7, '96611'),
(132, 'Gowa', NULL, NULL, 28, '92111'),
(133, 'Gresik', NULL, NULL, 11, '61115'),
(134, 'Grobogan', NULL, NULL, 10, '58111'),
(135, 'Gunung Kidul', NULL, NULL, 5, '55812'),
(136, 'Gunung Mas', NULL, NULL, 14, '74511'),
(137, 'Gunungsitoli', NULL, NULL, 34, '22813'),
(138, 'Halmahera Barat', NULL, NULL, 20, '97757'),
(139, 'Halmahera Selatan', NULL, NULL, 20, '97911'),
(140, 'Halmahera Tengah', NULL, NULL, 20, '97853'),
(141, 'Halmahera Timur', NULL, NULL, 20, '97862'),
(142, 'Halmahera Utara', NULL, NULL, 20, '97762'),
(143, 'Hulu Sungai Selatan', NULL, NULL, 13, '71212'),
(144, 'Hulu Sungai Tengah', NULL, NULL, 13, '71313'),
(145, 'Hulu Sungai Utara', NULL, NULL, 13, '71419'),
(146, 'Humbang Hasundutan', NULL, NULL, 34, '22457'),
(147, 'Indragiri Hilir', NULL, NULL, 26, '29212'),
(148, 'Indragiri Hulu', NULL, NULL, 26, '29319'),
(149, 'Indramayu', NULL, NULL, 9, '45214'),
(150, 'Intan Jaya', NULL, NULL, 24, '98771'),
(151, 'Jakarta Barat', NULL, NULL, 6, '11220'),
(152, 'Jakarta Pusat', NULL, NULL, 6, '10540'),
(153, 'Jakarta Selatan', NULL, NULL, 6, '12230'),
(154, 'Jakarta Timur', NULL, NULL, 6, '13330'),
(155, 'Jakarta Utara', NULL, NULL, 6, '14140'),
(156, 'Jambi', NULL, NULL, 8, '36111'),
(157, 'Jayapura', NULL, NULL, 24, '99352'),
(158, 'Jayapura', NULL, NULL, 24, '99114'),
(159, 'Jayawijaya', NULL, NULL, 24, '99511'),
(160, 'Jember', NULL, NULL, 11, '68113'),
(161, 'Jembrana', NULL, NULL, 1, '82251'),
(162, 'Jeneponto', NULL, NULL, 28, '92319'),
(163, 'Jepara', NULL, NULL, 10, '59419'),
(164, 'Jombang', NULL, NULL, 11, '61415'),
(165, 'Kaimana', NULL, NULL, 25, '98671'),
(166, 'Kampar', NULL, NULL, 26, '28411'),
(167, 'Kapuas', NULL, NULL, 14, '73583'),
(168, 'Kapuas Hulu', NULL, NULL, 12, '78719'),
(169, 'Karanganyar', NULL, NULL, 10, '57718'),
(170, 'Karangasem', NULL, NULL, 1, '80819'),
(171, 'Karawang', NULL, NULL, 9, '41311'),
(172, 'Karimun', NULL, NULL, 17, '29611'),
(173, 'Karo', NULL, NULL, 34, '22119'),
(174, 'Katingan', NULL, NULL, 14, '74411'),
(175, 'Kaur', NULL, NULL, 4, '38911'),
(176, 'Kayong Utara', NULL, NULL, 12, '78852'),
(177, 'Kebumen', NULL, NULL, 10, '54319'),
(178, 'Kediri', NULL, NULL, 11, '64184'),
(179, 'Kediri', NULL, NULL, 11, '64125'),
(180, 'Keerom', NULL, NULL, 24, '99461'),
(181, 'Kendal', NULL, NULL, 10, '51314'),
(182, 'Kendari', NULL, NULL, 30, '93126'),
(183, 'Kepahiang', NULL, NULL, 4, '39319'),
(184, 'Kepulauan Anambas', NULL, NULL, 17, '29991'),
(185, 'Kepulauan Aru', NULL, NULL, 19, '97681'),
(186, 'Kepulauan Mentawai', NULL, NULL, 32, '25771'),
(187, 'Kepulauan Meranti', NULL, NULL, 26, '28791'),
(188, 'Kepulauan Sangihe', NULL, NULL, 31, '95819'),
(189, 'Kepulauan Seribu', NULL, NULL, 6, '14550'),
(190, 'Kepulauan Siau Tagulandang Biaro (Sitaro)', NULL, NULL, 31, '95862'),
(191, 'Kepulauan Sula', NULL, NULL, 20, '97995'),
(192, 'Kepulauan Talaud', NULL, NULL, 31, '95885'),
(193, 'Kepulauan Yapen (Yapen Waropen)', NULL, NULL, 24, '98211'),
(194, 'Kerinci', NULL, NULL, 8, '37167'),
(195, 'Ketapang', NULL, NULL, 12, '78874'),
(196, 'Klaten', NULL, NULL, 10, '57411'),
(197, 'Klungkung', NULL, NULL, 1, '80719'),
(198, 'Kolaka', NULL, NULL, 30, '93511'),
(199, 'Kolaka Utara', NULL, NULL, 30, '93911'),
(200, 'Konawe', NULL, NULL, 30, '93411'),
(201, 'Konawe Selatan', NULL, NULL, 30, '93811'),
(202, 'Konawe Utara', NULL, NULL, 30, '93311'),
(203, 'Kotabaru', NULL, NULL, 13, '72119'),
(204, 'Kotamobagu', NULL, NULL, 31, '95711'),
(205, 'Kotawaringin Barat', NULL, NULL, 14, '74119'),
(206, 'Kotawaringin Timur', NULL, NULL, 14, '74364'),
(207, 'Kuantan Singingi', NULL, NULL, 26, '29519'),
(208, 'Kubu Raya', NULL, NULL, 12, '78311'),
(209, 'Kudus', NULL, NULL, 10, '59311'),
(210, 'Kulon Progo', NULL, NULL, 5, '55611'),
(211, 'Kuningan', NULL, NULL, 9, '45511'),
(212, 'Kupang', NULL, NULL, 23, '85362'),
(213, 'Kupang', NULL, NULL, 23, '85119'),
(214, 'Kutai Barat', NULL, NULL, 15, '75711'),
(215, 'Kutai Kartanegara', NULL, NULL, 15, '75511'),
(216, 'Kutai Timur', NULL, NULL, 15, '75611'),
(217, 'Labuhan Batu', NULL, NULL, 34, '21412'),
(218, 'Labuhan Batu Selatan', NULL, NULL, 34, '21511'),
(219, 'Labuhan Batu Utara', NULL, NULL, 34, '21711'),
(220, 'Lahat', NULL, NULL, 33, '31419'),
(221, 'Lamandau', NULL, NULL, 14, '74611'),
(222, 'Lamongan', NULL, NULL, 11, '64125'),
(223, 'Lampung Barat', NULL, NULL, 18, '34814'),
(224, 'Lampung Selatan', NULL, NULL, 18, '35511'),
(225, 'Lampung Tengah', NULL, NULL, 18, '34212'),
(226, 'Lampung Timur', NULL, NULL, 18, '34319'),
(227, 'Lampung Utara', NULL, NULL, 18, '34516'),
(228, 'Landak', NULL, NULL, 12, '78319'),
(229, 'Langkat', NULL, NULL, 34, '20811'),
(230, 'Langsa', NULL, NULL, 21, '24412'),
(231, 'Lanny Jaya', NULL, NULL, 24, '99531'),
(232, 'Lebak', NULL, NULL, 3, '42319'),
(233, 'Lebong', NULL, NULL, 4, '39264'),
(234, 'Lembata', NULL, NULL, 23, '86611'),
(235, 'Lhokseumawe', NULL, NULL, 21, '24352'),
(236, 'Lima Puluh Koto/Kota', NULL, NULL, 32, '26671'),
(237, 'Lingga', NULL, NULL, 17, '29811'),
(238, 'Lombok Barat', NULL, NULL, 22, '83311'),
(239, 'Lombok Tengah', NULL, NULL, 22, '83511'),
(240, 'Lombok Timur', NULL, NULL, 22, '83612'),
(241, 'Lombok Utara', NULL, NULL, 22, '83711'),
(242, 'Lubuk Linggau', NULL, NULL, 33, '31614'),
(243, 'Lumajang', NULL, NULL, 11, '67319'),
(244, 'Luwu', NULL, NULL, 28, '91994'),
(245, 'Luwu Timur', NULL, NULL, 28, '92981'),
(246, 'Luwu Utara', NULL, NULL, 28, '92911'),
(247, 'Madiun', NULL, NULL, 11, '63153'),
(248, 'Madiun', NULL, NULL, 11, '63122'),
(249, 'Magelang', NULL, NULL, 10, '56519'),
(250, 'Magelang', NULL, NULL, 10, '56133'),
(251, 'Magetan', NULL, NULL, 11, '63314'),
(252, 'Majalengka', NULL, NULL, 9, '45412'),
(253, 'Majene', NULL, NULL, 27, '91411'),
(254, 'Makassar', NULL, NULL, 28, '90111'),
(255, 'Malang', NULL, NULL, 11, '65163'),
(256, 'Malang', NULL, NULL, 11, '65112'),
(257, 'Malinau', NULL, NULL, 16, '77511'),
(258, 'Maluku Barat Daya', NULL, NULL, 19, '97451'),
(259, 'Maluku Tengah', NULL, NULL, 19, '97513'),
(260, 'Maluku Tenggara', NULL, NULL, 19, '97651'),
(261, 'Maluku Tenggara Barat', NULL, NULL, 19, '97465'),
(262, 'Mamasa', NULL, NULL, 27, '91362'),
(263, 'Mamberamo Raya', NULL, NULL, 24, '99381'),
(264, 'Mamberamo Tengah', NULL, NULL, 24, '99553'),
(265, 'Mamuju', NULL, NULL, 27, '91519'),
(266, 'Mamuju Utara', NULL, NULL, 27, '91571'),
(267, 'Manado', NULL, NULL, 31, '95247'),
(268, 'Mandailing Natal', NULL, NULL, 34, '22916'),
(269, 'Manggarai', NULL, NULL, 23, '86551'),
(270, 'Manggarai Barat', NULL, NULL, 23, '86711'),
(271, 'Manggarai Timur', NULL, NULL, 23, '86811'),
(272, 'Manokwari', NULL, NULL, 25, '98311'),
(273, 'Manokwari Selatan', NULL, NULL, 25, '98355'),
(274, 'Mappi', NULL, NULL, 24, '99853'),
(275, 'Maros', NULL, NULL, 28, '90511'),
(276, 'Mataram', NULL, NULL, 22, '83131'),
(277, 'Maybrat', NULL, NULL, 25, '98051'),
(278, 'Medan', NULL, NULL, 34, '20228'),
(279, 'Melawi', NULL, NULL, 12, '78619'),
(280, 'Merangin', NULL, NULL, 8, '37319'),
(281, 'Merauke', NULL, NULL, 24, '99613'),
(282, 'Mesuji', NULL, NULL, 18, '34911'),
(283, 'Metro', NULL, NULL, 18, '34111'),
(284, 'Mimika', NULL, NULL, 24, '99962'),
(285, 'Minahasa', NULL, NULL, 31, '95614'),
(286, 'Minahasa Selatan', NULL, NULL, 31, '95914'),
(287, 'Minahasa Tenggara', NULL, NULL, 31, '95995'),
(288, 'Minahasa Utara', NULL, NULL, 31, '95316'),
(289, 'Mojokerto', NULL, NULL, 11, '61382'),
(290, 'Mojokerto', NULL, NULL, 11, '61316'),
(291, 'Morowali', NULL, NULL, 29, '94911'),
(292, 'Muara Enim', NULL, NULL, 33, '31315'),
(293, 'Muaro Jambi', NULL, NULL, 8, '36311'),
(294, 'Muko Muko', NULL, NULL, 4, '38715'),
(295, 'Muna', NULL, NULL, 30, '93611'),
(296, 'Murung Raya', NULL, NULL, 14, '73911'),
(297, 'Musi Banyuasin', NULL, NULL, 33, '30719'),
(298, 'Musi Rawas', NULL, NULL, 33, '31661'),
(299, 'Nabire', NULL, NULL, 24, '98816'),
(300, 'Nagan Raya', NULL, NULL, 21, '23674'),
(301, 'Nagekeo', NULL, NULL, 23, '86911'),
(302, 'Natuna', NULL, NULL, 17, '29711'),
(303, 'Nduga', NULL, NULL, 24, '99541'),
(304, 'Ngada', NULL, NULL, 23, '86413'),
(305, 'Nganjuk', NULL, NULL, 11, '64414'),
(306, 'Ngawi', NULL, NULL, 11, '63219'),
(307, 'Nias', NULL, NULL, 34, '22876'),
(308, 'Nias Barat', NULL, NULL, 34, '22895'),
(309, 'Nias Selatan', NULL, NULL, 34, '22865'),
(310, 'Nias Utara', NULL, NULL, 34, '22856'),
(311, 'Nunukan', NULL, NULL, 16, '77421'),
(312, 'Ogan Ilir', NULL, NULL, 33, '30811'),
(313, 'Ogan Komering Ilir', NULL, NULL, 33, '30618'),
(314, 'Ogan Komering Ulu', NULL, NULL, 33, '32112'),
(315, 'Ogan Komering Ulu Selatan', NULL, NULL, 33, '32211'),
(316, 'Ogan Komering Ulu Timur', NULL, NULL, 33, '32312'),
(317, 'Pacitan', NULL, NULL, 11, '63512'),
(318, 'Padang', NULL, NULL, 32, '25112'),
(319, 'Padang Lawas', NULL, NULL, 34, '22763'),
(320, 'Padang Lawas Utara', NULL, NULL, 34, '22753'),
(321, 'Padang Panjang', NULL, NULL, 32, '27122'),
(322, 'Padang Pariaman', NULL, NULL, 32, '25583'),
(323, 'Padang Sidempuan', NULL, NULL, 34, '22727'),
(324, 'Pagar Alam', NULL, NULL, 33, '31512'),
(325, 'Pakpak Bharat', NULL, NULL, 34, '22272'),
(326, 'Palangka Raya', NULL, NULL, 14, '73112'),
(327, 'Palembang', NULL, NULL, 33, '30111'),
(328, 'Palopo', NULL, NULL, 28, '91911'),
(329, 'Palu', NULL, NULL, 29, '94111'),
(330, 'Pamekasan', NULL, NULL, 11, '69319'),
(331, 'Pandeglang', NULL, NULL, 3, '42212'),
(332, 'Pangandaran', NULL, NULL, 9, '46511'),
(333, 'Pangkajene Kepulauan', NULL, NULL, 28, '90611'),
(334, 'Pangkal Pinang', NULL, NULL, 2, '33115'),
(335, 'Paniai', NULL, NULL, 24, '98765'),
(336, 'Parepare', NULL, NULL, 28, '91123'),
(337, 'Pariaman', NULL, NULL, 32, '25511'),
(338, 'Parigi Moutong', NULL, NULL, 29, '94411'),
(339, 'Pasaman', NULL, NULL, 32, '26318'),
(340, 'Pasaman Barat', NULL, NULL, 32, '26511'),
(341, 'Paser', NULL, NULL, 15, '76211'),
(342, 'Pasuruan', NULL, NULL, 11, '67153'),
(343, 'Pasuruan', NULL, NULL, 11, '67118'),
(344, 'Pati', NULL, NULL, 10, '59114'),
(345, 'Payakumbuh', NULL, NULL, 32, '26213'),
(346, 'Pegunungan Arfak', NULL, NULL, 25, '98354'),
(347, 'Pegunungan Bintang', NULL, NULL, 24, '99573'),
(348, 'Pekalongan', NULL, NULL, 10, '51161'),
(349, 'Pekalongan', NULL, NULL, 10, '51122'),
(350, 'Pekanbaru', NULL, NULL, 26, '28112'),
(351, 'Pelalawan', NULL, NULL, 26, '28311'),
(352, 'Pemalang', NULL, NULL, 10, '52319'),
(353, 'Pematang Siantar', NULL, NULL, 34, '21126'),
(354, 'Penajam Paser Utara', NULL, NULL, 15, '76311'),
(355, 'Pesawaran', NULL, NULL, 18, '35312'),
(356, 'Pesisir Barat', NULL, NULL, 18, '35974'),
(357, 'Pesisir Selatan', NULL, NULL, 32, '25611'),
(358, 'Pidie', NULL, NULL, 21, '24116'),
(359, 'Pidie Jaya', NULL, NULL, 21, '24186'),
(360, 'Pinrang', NULL, NULL, 28, '91251'),
(361, 'Pohuwato', NULL, NULL, 7, '96419'),
(362, 'Polewali Mandar', NULL, NULL, 27, '91311'),
(363, 'Ponorogo', NULL, NULL, 11, '63411'),
(364, 'Pontianak', NULL, NULL, 12, '78971'),
(365, 'Pontianak', NULL, NULL, 12, '78112'),
(366, 'Poso', NULL, NULL, 29, '94615'),
(367, 'Prabumulih', NULL, NULL, 33, '31121'),
(368, 'Pringsewu', NULL, NULL, 18, '35719'),
(369, 'Probolinggo', NULL, NULL, 11, '67282'),
(370, 'Probolinggo', NULL, NULL, 11, '67215'),
(371, 'Pulang Pisau', NULL, NULL, 14, '74811'),
(372, 'Pulau Morotai', NULL, NULL, 20, '97771'),
(373, 'Puncak', NULL, NULL, 24, '98981'),
(374, 'Puncak Jaya', NULL, NULL, 24, '98979'),
(375, 'Purbalingga', NULL, NULL, 10, '53312'),
(376, 'Purwakarta', NULL, NULL, 9, '41119'),
(377, 'Purworejo', NULL, NULL, 10, '54111'),
(378, 'Raja Ampat', NULL, NULL, 25, '98489'),
(379, 'Rejang Lebong', NULL, NULL, 4, '39112'),
(380, 'Rembang', NULL, NULL, 10, '59219'),
(381, 'Rokan Hilir', NULL, NULL, 26, '28992'),
(382, 'Rokan Hulu', NULL, NULL, 26, '28511'),
(383, 'Rote Ndao', NULL, NULL, 23, '85982'),
(384, 'Sabang', NULL, NULL, 21, '23512'),
(385, 'Sabu Raijua', NULL, NULL, 23, '85391'),
(386, 'Salatiga', NULL, NULL, 10, '50711'),
(387, 'Samarinda', NULL, NULL, 15, '75133'),
(388, 'Sambas', NULL, NULL, 12, '79453'),
(389, 'Samosir', NULL, NULL, 34, '22392'),
(390, 'Sampang', NULL, NULL, 11, '69219'),
(391, 'Sanggau', NULL, NULL, 12, '78557'),
(392, 'Sarmi', NULL, NULL, 24, '99373'),
(393, 'Sarolangun', NULL, NULL, 8, '37419'),
(394, 'Sawah Lunto', NULL, NULL, 32, '27416'),
(395, 'Sekadau', NULL, NULL, 12, '79583'),
(396, 'Selayar (Kepulauan Selayar)', NULL, NULL, 28, '92812'),
(397, 'Seluma', NULL, NULL, 4, '38811'),
(398, 'Semarang', NULL, NULL, 10, '50511'),
(399, 'Semarang', NULL, NULL, 10, '50135'),
(400, 'Seram Bagian Barat', NULL, NULL, 19, '97561'),
(401, 'Seram Bagian Timur', NULL, NULL, 19, '97581'),
(402, 'Serang', NULL, NULL, 3, '42182'),
(403, 'Serang', NULL, NULL, 3, '42111'),
(404, 'Serdang Bedagai', NULL, NULL, 34, '20915'),
(405, 'Seruyan', NULL, NULL, 14, '74211'),
(406, 'Siak', NULL, NULL, 26, '28623'),
(407, 'Sibolga', NULL, NULL, 34, '22522'),
(408, 'Sidenreng Rappang/Rapang', NULL, NULL, 28, '91613'),
(409, 'Sidoarjo', NULL, NULL, 11, '61219'),
(410, 'Sigi', NULL, NULL, 29, '94364'),
(411, 'Sijunjung (Sawah Lunto Sijunjung)', NULL, NULL, 32, '27511'),
(412, 'Sikka', NULL, NULL, 23, '86121'),
(413, 'Simalungun', NULL, NULL, 34, '21162'),
(414, 'Simeulue', NULL, NULL, 21, '23891'),
(415, 'Singkawang', NULL, NULL, 12, '79117'),
(416, 'Sinjai', NULL, NULL, 28, '92615'),
(417, 'Sintang', NULL, NULL, 12, '78619'),
(418, 'Situbondo', NULL, NULL, 11, '68316'),
(419, 'Sleman', NULL, NULL, 5, '55513'),
(420, 'Solok', NULL, NULL, 32, '27365'),
(421, 'Solok', NULL, NULL, 32, '27315'),
(422, 'Solok Selatan', NULL, NULL, 32, '27779'),
(423, 'Soppeng', NULL, NULL, 28, '90812'),
(424, 'Sorong', NULL, NULL, 25, '98431'),
(425, 'Sorong', NULL, NULL, 25, '98411'),
(426, 'Sorong Selatan', NULL, NULL, 25, '98454'),
(427, 'Sragen', NULL, NULL, 10, '57211'),
(428, 'Subang', NULL, NULL, 9, '41215'),
(429, 'Subulussalam', NULL, NULL, 21, '24882'),
(430, 'Sukabumi', NULL, NULL, 9, '43311'),
(431, 'Sukabumi', NULL, NULL, 9, '43114'),
(432, 'Sukamara', NULL, NULL, 14, '74712'),
(433, 'Sukoharjo', NULL, NULL, 10, '57514'),
(434, 'Sumba Barat', NULL, NULL, 23, '87219'),
(435, 'Sumba Barat Daya', NULL, NULL, 23, '87453'),
(436, 'Sumba Tengah', NULL, NULL, 23, '87358'),
(437, 'Sumba Timur', NULL, NULL, 23, '87112'),
(438, 'Sumbawa', NULL, NULL, 22, '84315'),
(439, 'Sumbawa Barat', NULL, NULL, 22, '84419'),
(440, 'Sumedang', NULL, NULL, 9, '45326'),
(441, 'Sumenep', NULL, NULL, 11, '69413'),
(442, 'Sungaipenuh', NULL, NULL, 8, '37113'),
(443, 'Supiori', NULL, NULL, 24, '98164'),
(444, 'Surabaya', NULL, NULL, 11, '60119'),
(445, 'Surakarta (Solo)', NULL, NULL, 10, '57113'),
(446, 'Tabalong', NULL, NULL, 13, '71513'),
(447, 'Tabanan', NULL, NULL, 1, '82119'),
(448, 'Takalar', NULL, NULL, 28, '92212'),
(449, 'Tambrauw', NULL, NULL, 25, '98475'),
(450, 'Tana Tidung', NULL, NULL, 16, '77611'),
(451, 'Tana Toraja', NULL, NULL, 28, '91819'),
(452, 'Tanah Bumbu', NULL, NULL, 13, '72211'),
(453, 'Tanah Datar', NULL, NULL, 32, '27211'),
(454, 'Tanah Laut', NULL, NULL, 13, '70811'),
(455, 'Tangerang', NULL, NULL, 3, '15914'),
(456, 'Tangerang', NULL, NULL, 3, '15111'),
(457, 'Tangerang Selatan', NULL, NULL, 3, '15332'),
(458, 'Tanggamus', NULL, NULL, 18, '35619'),
(459, 'Tanjung Balai', NULL, NULL, 34, '21321'),
(460, 'Tanjung Jabung Barat', NULL, NULL, 8, '36513'),
(461, 'Tanjung Jabung Timur', NULL, NULL, 8, '36719'),
(462, 'Tanjung Pinang', NULL, NULL, 17, '29111'),
(463, 'Tapanuli Selatan', NULL, NULL, 34, '22742'),
(464, 'Tapanuli Tengah', NULL, NULL, 34, '22611'),
(465, 'Tapanuli Utara', NULL, NULL, 34, '22414'),
(466, 'Tapin', NULL, NULL, 13, '71119'),
(467, 'Tarakan', NULL, NULL, 16, '77114'),
(468, 'Tasikmalaya', NULL, NULL, 9, '46411'),
(469, 'Tasikmalaya', NULL, NULL, 9, '46116'),
(470, 'Tebing Tinggi', NULL, NULL, 34, '20632'),
(471, 'Tebo', NULL, NULL, 8, '37519'),
(472, 'Tegal', NULL, NULL, 10, '52419'),
(473, 'Tegal', NULL, NULL, 10, '52114'),
(474, 'Teluk Bintuni', NULL, NULL, 25, '98551'),
(475, 'Teluk Wondama', NULL, NULL, 25, '98591'),
(476, 'Temanggung', NULL, NULL, 10, '56212'),
(477, 'Ternate', NULL, NULL, 20, '97714'),
(478, 'Tidore Kepulauan', NULL, NULL, 20, '97815'),
(479, 'Timor Tengah Selatan', NULL, NULL, 23, '85562'),
(480, 'Timor Tengah Utara', NULL, NULL, 23, '85612'),
(481, 'Toba Samosir', NULL, NULL, 34, '22316'),
(482, 'Tojo Una-Una', NULL, NULL, 29, '94683'),
(483, 'Toli-Toli', NULL, NULL, 29, '94542'),
(484, 'Tolikara', NULL, NULL, 24, '99411'),
(485, 'Tomohon', NULL, NULL, 31, '95416'),
(486, 'Toraja Utara', NULL, NULL, 28, '91831'),
(487, 'Trenggalek', NULL, NULL, 11, '66312'),
(488, 'Tual', NULL, NULL, 19, '97612'),
(489, 'Tuban', NULL, NULL, 11, '62319'),
(490, 'Tulang Bawang', NULL, NULL, 18, '34613'),
(491, 'Tulang Bawang Barat', NULL, NULL, 18, '34419'),
(492, 'Tulungagung', NULL, NULL, 11, '66212'),
(493, 'Wajo', NULL, NULL, 28, '90911'),
(494, 'Wakatobi', NULL, NULL, 30, '93791'),
(495, 'Waropen', NULL, NULL, 24, '98269'),
(496, 'Way Kanan', NULL, NULL, 18, '34711'),
(497, 'Wonogiri', NULL, NULL, 10, '57619'),
(498, 'Wonosobo', NULL, NULL, 10, '56311'),
(499, 'Yahukimo', NULL, NULL, 24, '99041'),
(500, 'Yalimo', NULL, NULL, 24, '99481'),
(501, 'Yogyakarta', NULL, NULL, 5, '55111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurir`
--

CREATE TABLE `kurir` (
  `idkurir` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `toko_users_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kurir`
--

INSERT INTO `kurir` (`idkurir`, `nama`, `email`, `password`, `toko_users_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Fabianus', 'a@a.com', 'a', 1, '2022-08-07 06:25:23', '2022-08-08 18:15:45', NULL),
(3, 'Fransiskus', 'b@b.com', 'cccc', 1, '2022-08-07 06:45:51', '2022-08-08 18:15:50', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `midtrans`
--

CREATE TABLE `midtrans` (
  `idmidtrans` int(11) NOT NULL,
  `token` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `transaksi_idtransaksi` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `midtrans`
--

INSERT INTO `midtrans` (`idmidtrans`, `token`, `status`, `transaksi_idtransaksi`, `created_at`, `updated_at`) VALUES
(2, 'b353f502-1026-49e6-b2a2-109219faa18f', 'settlement', 6, '2022-08-06 23:32:24', '2022-08-06 23:55:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `idpengiriman` int(11) NOT NULL,
  `tanggalwaktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kurir_idkurir` int(11) DEFAULT NULL,
  `transaksi_idtransaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`idpengiriman`, `tanggalwaktu`, `status`, `created_at`, `updated_at`, `kurir_idkurir`, `transaksi_idtransaksi`) VALUES
(1, '2022-08-09 01:45:42', 'Menunggu Pickup Kurir', '2022-08-08 17:45:42', '2022-08-08 18:48:57', 2, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `harga` varchar(45) DEFAULT NULL,
  `etalase_produk_idetalase_produk` int(11) NOT NULL,
  `kategori_idkategori` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `toko_users_id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` varchar(45) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`idproduk`, `nama`, `harga`, `etalase_produk_idetalase_produk`, `kategori_idkategori`, `created_at`, `updated_at`, `deleted_at`, `toko_users_id`, `deskripsi`, `stok`) VALUES
(1, 'First Product Gawr Gura', '25000', 2, 2, '2022-07-08 08:21:40', '2022-07-12 09:51:03', NULL, 1, 'Gura', 100),
(2, 'Izumi Sagiri', '20000', 2, 1, '2022-07-12 11:23:01', '2022-07-12 11:23:01', NULL, 1, 'Eromanga Sensei terbaik', 50),
(3, 'Kue Nastar', '30000', 4, 1, '2022-07-12 11:35:15', '2022-07-12 11:35:15', NULL, 2, 'Enak pokoknya', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `idprovinsi` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`idprovinsi`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Bali', NULL, NULL),
(2, 'Bangka Belitung', NULL, NULL),
(3, 'Banten', NULL, NULL),
(4, 'Bengkulu', NULL, NULL),
(5, 'DI Yogyakarta', NULL, NULL),
(6, 'DKI Jakarta', NULL, NULL),
(7, 'Gorontalo', NULL, NULL),
(8, 'Jambi', NULL, NULL),
(9, 'Jawa Barat', NULL, NULL),
(10, 'Jawa Tengah', NULL, NULL),
(11, 'Jawa Timur', NULL, NULL),
(12, 'Kalimantan Barat', NULL, NULL),
(13, 'Kalimantan Selatan', NULL, NULL),
(14, 'Kalimantan Tengah', NULL, NULL),
(15, 'Kalimantan Timur', NULL, NULL),
(16, 'Kalimantan Utara', NULL, NULL),
(17, 'Kepulauan Riau', NULL, NULL),
(18, 'Lampung', NULL, NULL),
(19, 'Maluku', NULL, NULL),
(20, 'Maluku Utara', NULL, NULL),
(21, 'Nanggroe Aceh Darussalam (NAD)', NULL, NULL),
(22, 'Nusa Tenggara Barat (NTB)', NULL, NULL),
(23, 'Nusa Tenggara Timur (NTT)', NULL, NULL),
(24, 'Papua', NULL, NULL),
(25, 'Papua Barat', NULL, NULL),
(26, 'Riau', NULL, NULL),
(27, 'Sulawesi Barat', NULL, NULL),
(28, 'Sulawesi Selatan', NULL, NULL),
(29, 'Sulawesi Tengah', NULL, NULL),
(30, 'Sulawesi Tenggara', NULL, NULL),
(31, 'Sulawesi Utara', NULL, NULL),
(32, 'Sumatera Barat', NULL, NULL),
(33, 'Sumatera Selatan', NULL, NULL),
(34, 'Sumatera Utara', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `idrating` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `produk_idproduk` int(11) NOT NULL,
  `komen` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rating`
--

INSERT INTO `rating` (`idrating`, `users_id`, `produk_idproduk`, `komen`, `jumlah`) VALUES
(1, 2, 1, NULL, '3'),
(2, 2, 1, NULL, '5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `nama_toko` varchar(45) DEFAULT NULL,
  `deskripsi` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(12) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kotakabupaten_idkotakabupaten` int(11) NOT NULL DEFAULT '241'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`users_id`, `nama_toko`, `deskripsi`, `status`, `alamat`, `telepon`, `latitude`, `longitude`, `created_at`, `updated_at`, `kotakabupaten_idkotakabupaten`) VALUES
(1, 'Toko Barett', 'hello world', 1, 'asdasdasda', '123123', '-8.589259394724797', '116.13002335887123', NULL, '2022-07-15 19:10:18', 241),
(2, 'Teratai Cookies', 'Menjual kue khas makkasar', 1, 'Komplek catalia', '0813', '-8.843257601381023', '121.65381767079468', '2022-07-12 11:32:46', '2022-07-12 11:33:20', 241);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int(11) NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  `toko_users_id` bigint(20) UNSIGNED NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `alamat_idalamat` int(11) NOT NULL,
  `pembayaran` varchar(45) DEFAULT NULL,
  `pengiriman` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `tanggal`, `toko_users_id`, `users_id`, `created_at`, `updated_at`, `total`, `alamat_idalamat`, `pembayaran`, `pengiriman`, `status`) VALUES
(6, '2022-08-07 15:32:22', 1, 1, '2022-08-06 23:32:22', '2022-08-08 17:45:42', 45000, 1, 'transfer', 'kurir_toko', 'Pesanan Dikirim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_has_produk`
--

CREATE TABLE `transaksi_has_produk` (
  `transaksi_idtransaksi` int(11) NOT NULL,
  `produk_idproduk` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi_has_produk`
--

INSERT INTO `transaksi_has_produk` (`transaksi_idtransaksi`, `produk_idproduk`, `jumlah`, `qty`) VALUES
(6, 1, 25000, 1),
(6, 2, 20000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('pembeli','penjual','admin') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Alexander Evan', 'evan@evan.com', NULL, '$2y$10$iyHAWbls0iO1oqJfdMgX7uqkDAv8FD9WFFUuBW/l1isqOGcfIzh56', NULL, '2022-07-01 07:54:00', '2022-07-01 07:54:00', 'penjual'),
(2, 'Adit', 'adit@adit.com', NULL, '$2y$10$eeJz2EYOZXLwemv0noqKv.QvsoWAqKsiaAE2GQ08fZbmxKnwOIxn6', NULL, '2022-07-12 11:31:06', '2022-07-12 11:31:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE `wishlist` (
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `produk_idproduk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wishlist`
--

INSERT INTO `wishlist` (`users_id`, `produk_idproduk`) VALUES
(1, 1),
(1, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`idalamat`),
  ADD KEY `fk_alamat_users1_idx` (`users_id`),
  ADD KEY `fk_alamat_kotakabupaten1_idx` (`kotakabupaten_idkotakabupaten`),
  ADD KEY `fk_alamat_provinsi1_idx` (`provinsi_idprovinsi`);

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idchat`),
  ADD KEY `fk_chat_users1_idx` (`users_id`),
  ADD KEY `fk_chat_users2_idx` (`users_id1`);

--
-- Indeks untuk tabel `etalase_produk`
--
ALTER TABLE `etalase_produk`
  ADD PRIMARY KEY (`idetalase_produk`),
  ADD KEY `fk_etalase_produk_toko1_idx` (`toko_users_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gambar_produk`
--
ALTER TABLE `gambar_produk`
  ADD PRIMARY KEY (`idgambar_produk`),
  ADD KEY `fk_gambar_produk_produk1_idx` (`produk_idproduk`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`users_id`,`produk_idproduk`),
  ADD KEY `fk_users_has_produk_produk1_idx` (`produk_idproduk`),
  ADD KEY `fk_users_has_produk_users1_idx` (`users_id`);

--
-- Indeks untuk tabel `kotakabupaten`
--
ALTER TABLE `kotakabupaten`
  ADD PRIMARY KEY (`idkotakabupaten`),
  ADD KEY `fk_kotakabupaten_provinsi1_idx` (`provinsi_idprovinsi`);

--
-- Indeks untuk tabel `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`idkurir`),
  ADD KEY `fk_kurir_toko1_idx` (`toko_users_id`);

--
-- Indeks untuk tabel `midtrans`
--
ALTER TABLE `midtrans`
  ADD PRIMARY KEY (`idmidtrans`),
  ADD KEY `fk_midtrans_transaksi1_idx` (`transaksi_idtransaksi`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`idpengiriman`),
  ADD KEY `fk_pengiriman_kurir1_idx` (`kurir_idkurir`),
  ADD KEY `fk_pengiriman_transaksi1_idx` (`transaksi_idtransaksi`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `fk_produk_etalase_produk1_idx` (`etalase_produk_idetalase_produk`),
  ADD KEY `fk_produk_kategori1_idx` (`kategori_idkategori`),
  ADD KEY `fk_produk_toko1_idx` (`toko_users_id`);

--
-- Indeks untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`idprovinsi`);

--
-- Indeks untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`idrating`,`users_id`,`produk_idproduk`),
  ADD KEY `fk_users_has_produk_produk3_idx` (`produk_idproduk`),
  ADD KEY `fk_users_has_produk_users3_idx` (`users_id`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `fk_toko_users_idx` (`users_id`),
  ADD KEY `fk_toko_kotakabupaten1_idx` (`kotakabupaten_idkotakabupaten`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`),
  ADD KEY `fk_transaksi_toko1_idx` (`toko_users_id`),
  ADD KEY `fk_transaksi_users1_idx` (`users_id`),
  ADD KEY `fk_transaksi_alamat1_idx` (`alamat_idalamat`);

--
-- Indeks untuk tabel `transaksi_has_produk`
--
ALTER TABLE `transaksi_has_produk`
  ADD PRIMARY KEY (`transaksi_idtransaksi`,`produk_idproduk`),
  ADD KEY `fk_transaksi_has_produk_produk1_idx` (`produk_idproduk`),
  ADD KEY `fk_transaksi_has_produk_transaksi1_idx` (`transaksi_idtransaksi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`users_id`,`produk_idproduk`),
  ADD KEY `fk_users_has_produk_produk2_idx` (`produk_idproduk`),
  ADD KEY `fk_users_has_produk_users2_idx` (`users_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alamat`
--
ALTER TABLE `alamat`
  MODIFY `idalamat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `etalase_produk`
--
ALTER TABLE `etalase_produk`
  MODIFY `idetalase_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kurir`
--
ALTER TABLE `kurir`
  MODIFY `idkurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `midtrans`
--
ALTER TABLE `midtrans`
  MODIFY `idmidtrans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `idpengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `rating`
--
ALTER TABLE `rating`
  MODIFY `idrating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alamat`
--
ALTER TABLE `alamat`
  ADD CONSTRAINT `fk_alamat_kotakabupaten1` FOREIGN KEY (`kotakabupaten_idkotakabupaten`) REFERENCES `kotakabupaten` (`idkotakabupaten`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alamat_provinsi1` FOREIGN KEY (`provinsi_idprovinsi`) REFERENCES `provinsi` (`idprovinsi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alamat_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_chat_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chat_users2` FOREIGN KEY (`users_id1`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `etalase_produk`
--
ALTER TABLE `etalase_produk`
  ADD CONSTRAINT `fk_etalase_produk_toko1` FOREIGN KEY (`toko_users_id`) REFERENCES `toko` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `gambar_produk`
--
ALTER TABLE `gambar_produk`
  ADD CONSTRAINT `fk_gambar_produk_produk1` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `fk_users_has_produk_produk1` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_produk_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `kotakabupaten`
--
ALTER TABLE `kotakabupaten`
  ADD CONSTRAINT `fk_kotakabupaten_provinsi1` FOREIGN KEY (`provinsi_idprovinsi`) REFERENCES `provinsi` (`idprovinsi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `kurir`
--
ALTER TABLE `kurir`
  ADD CONSTRAINT `fk_kurir_toko1` FOREIGN KEY (`toko_users_id`) REFERENCES `toko` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `midtrans`
--
ALTER TABLE `midtrans`
  ADD CONSTRAINT `fk_midtrans_transaksi1` FOREIGN KEY (`transaksi_idtransaksi`) REFERENCES `transaksi` (`idtransaksi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `fk_pengiriman_kurir1` FOREIGN KEY (`kurir_idkurir`) REFERENCES `kurir` (`idkurir`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pengiriman_transaksi1` FOREIGN KEY (`transaksi_idtransaksi`) REFERENCES `transaksi` (`idtransaksi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_etalase_produk1` FOREIGN KEY (`etalase_produk_idetalase_produk`) REFERENCES `etalase_produk` (`idetalase_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produk_kategori1` FOREIGN KEY (`kategori_idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produk_toko1` FOREIGN KEY (`toko_users_id`) REFERENCES `toko` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_users_has_produk_produk3` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_produk_users3` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD CONSTRAINT `fk_toko_kotakabupaten1` FOREIGN KEY (`kotakabupaten_idkotakabupaten`) REFERENCES `kotakabupaten` (`idkotakabupaten`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_toko_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_alamat1` FOREIGN KEY (`alamat_idalamat`) REFERENCES `alamat` (`idalamat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaksi_toko1` FOREIGN KEY (`toko_users_id`) REFERENCES `toko` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaksi_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `transaksi_has_produk`
--
ALTER TABLE `transaksi_has_produk`
  ADD CONSTRAINT `fk_transaksi_has_produk_produk1` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaksi_has_produk_transaksi1` FOREIGN KEY (`transaksi_idtransaksi`) REFERENCES `transaksi` (`idtransaksi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_users_has_produk_produk2` FOREIGN KEY (`produk_idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_produk_users2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
