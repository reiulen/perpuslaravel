-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 04:27 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus-main`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktifitas`
--

CREATE TABLE `aktifitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aktifitas`
--

INSERT INTO `aktifitas` (`id`, `user_id`, `icon`, `background`, `notifikasi`, `created_at`, `updated_at`) VALUES
(1, 17, 'fas fa-book-reader', 'bg-success', 'Selamat kamu berhasil meminjam buku Kiarra Fishersilahkan ambil buku di perpustakaan', '2021-11-24 06:54:40', '2021-11-24 06:54:40'),
(2, 17, 'fas fa-book-reader', 'bg-success', 'Selamat kamu berhasil meminjam buku The Star And Lsilahkan ambil buku di perpustakaan', '2021-11-25 07:33:13', '2021-11-25 07:33:13'),
(3, 18, 'fas fa-book-reader', 'bg-success', 'Selamat kamu berhasil meminjam buku The Star And Lsilahkan ambil buku di perpustakaan', '2021-11-27 01:38:49', '2021-11-27 01:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `aktifitasadmins`
--

CREATE TABLE `aktifitasadmins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `backgroud` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aktifitasadmins`
--

INSERT INTO `aktifitasadmins` (`id`, `user_id`, `icon`, `backgroud`, `notifikasi`, `created_at`, `updated_at`) VALUES
(1, 1, 'fas fa-user', 'bg-danger', 'Reihan Andika mengubah status anggotaAEP21241Reihan Andika AMmenjadiNonaktif', '2021-11-24 10:01:50', '2021-11-24 10:01:50'),
(2, 1, 'fas fa-user', 'bg-primary', 'Reihan Andika mengubah status anggota AEP21241Reihan Andika AM menjadi Aktif', '2021-11-24 10:02:27', '2021-11-24 10:02:27'),
(3, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Kiarra Fisher', '2021-11-24 11:38:05', '2021-11-24 11:38:05'),
(4, 1, 'fas fa-edit', 'bg-danger', 'Reihan Andika mengahapus buku Damon Sanford', '2021-11-24 15:17:15', '2021-11-24 15:17:15'),
(5, 1, 'fas fa-edit', 'bg-danger', 'Reihan Andika mengahapus buku Prof. Shanna Bahringer V', '2021-11-24 15:17:28', '2021-11-24 15:17:28'),
(6, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Kaelyn Wehner', '2021-11-24 15:17:43', '2021-11-24 15:17:43'),
(7, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Janis Kerluke PhD', '2021-11-24 15:17:54', '2021-11-24 15:17:54'),
(8, 1, 'fas fa-book-reader', 'bg-danger', 'Reihan Andika menghapus pinjaman  dengan judul buku ', '2021-11-24 15:20:16', '2021-11-24 15:20:16'),
(9, 1, 'fas fa-book-reader', 'bg-danger', 'Reihan Andika menghapus pinjaman  dengan judul buku ', '2021-11-24 15:20:20', '2021-11-24 15:20:20'),
(10, 1, 'fas fa-book-reader', 'bg-secondary', 'Reihan Andika mengedit pinjaman  menjadi Dikembalikan', '2021-11-24 15:20:30', '2021-11-24 15:20:30'),
(11, 1, 'fas fa-book-reader', 'bg-secondary', 'Reihan Andika mengedit pinjaman  menjadi Belum diambil', '2021-11-24 15:20:40', '2021-11-24 15:20:40'),
(12, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Pulang Pergi', '2021-11-24 15:29:27', '2021-11-24 15:29:27'),
(13, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Bukan Buku Nikah', '2021-11-24 15:29:53', '2021-11-24 15:29:53'),
(14, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Dee Lestari Rapi Jali', '2021-11-24 15:30:27', '2021-11-24 15:30:27'),
(15, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Wingit - Sara Wijayanto', '2021-11-24 15:31:11', '2021-11-24 15:31:11'),
(16, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Selamat Tinggal', '2021-11-24 15:34:34', '2021-11-24 15:34:34'),
(17, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Dee Lestari Rapi Jali', '2021-11-24 15:38:27', '2021-11-24 15:38:27'),
(18, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Pulang Pergi', '2021-11-24 15:38:40', '2021-11-24 15:38:40'),
(19, 1, 'fas fa-book', 'bg-success', 'Reihan Andika menambahkan buku The Star And L', '2021-11-24 15:39:44', '2021-11-24 15:39:44'),
(20, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Dee Lestari Rapi Jali', '2021-11-24 15:42:36', '2021-11-24 15:42:36'),
(21, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Pulang Pergi', '2021-11-24 15:42:55', '2021-11-24 15:42:55'),
(22, 1, 'fas fa-book', 'bg-success', 'Reihan Andika menambahkan buku Ten Years Challange', '2021-11-24 15:44:13', '2021-11-24 15:44:13'),
(23, 1, 'fas fa-book', 'bg-success', 'Reihan Andika menambahkan buku Tikungan Maut - Kisah Tanah Jawa', '2021-11-24 15:45:44', '2021-11-24 15:45:44'),
(24, 1, 'fas fa-book', 'bg-success', 'Reihan Andika menambahkan buku TAIPAN - The Winner Take it All', '2021-11-24 15:46:56', '2021-11-24 15:46:56'),
(25, 1, 'fas fa-book', 'bg-success', 'Reihan Andika menambahkan buku Living An A Campervan', '2021-11-24 15:47:58', '2021-11-24 15:47:58'),
(26, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Kiarra Fisher', '2021-11-24 15:48:44', '2021-11-24 15:48:44'),
(27, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku The Star And L', '2021-11-24 15:49:01', '2021-11-24 15:49:01'),
(28, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku The Star And L', '2021-11-24 15:49:30', '2021-11-24 15:49:30'),
(29, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Living An A Campervan', '2021-11-24 15:49:44', '2021-11-24 15:49:44'),
(30, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Living An A Campervan', '2021-11-24 15:50:01', '2021-11-24 15:50:01'),
(31, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Living An A Campervan', '2021-11-24 15:52:26', '2021-11-24 15:52:26'),
(32, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Living An A Campervan', '2021-11-24 15:52:57', '2021-11-24 15:52:57'),
(33, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Living An A Campervan', '2021-11-24 15:58:15', '2021-11-24 15:58:15'),
(34, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Living An A Campervan', '2021-11-24 15:58:31', '2021-11-24 15:58:31'),
(35, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Kiarra Fisher', '2021-11-24 16:27:01', '2021-11-24 16:27:01'),
(36, 1, 'fas fa-book', 'bg-success', 'Reihan Andika menambahkan buku Devil Angel', '2021-11-25 07:40:38', '2021-11-25 07:40:38'),
(37, 1, 'fas fa-book', 'bg-success', 'Reihan Andika menambahkan buku Pendidikan indah', '2021-11-25 08:43:10', '2021-11-25 08:43:10'),
(38, 1, 'fas fa-book', 'bg-success', 'Reihan Andika menambahkan buku Pendidikan indah', '2021-11-25 08:47:57', '2021-11-25 08:47:57'),
(39, 1, 'fas fa-book', 'bg-secondary', 'Reihan Andika mengedit buku Pendidikan indah', '2021-11-27 02:11:12', '2021-11-27 02:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `anggotas`
--

CREATE TABLE `anggotas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_anggota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Laki-laki',
  `nis` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Nonaktif','Verify','Aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nonaktif',
  `aktifitas` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggotas`
--

INSERT INTO `anggotas` (`id`, `id_anggota`, `foto`, `nama`, `email`, `kelas`, `jenis_kelamin`, `nis`, `password`, `status`, `aktifitas`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(17, 'AEP21241', 'user.png', 'Reihan Andika AM', 'reinandika10@gmail.com', 'XI-TataBoga', 'Laki-laki', 12345675, '$2y$10$cmkO3rGNLt41PvyXIsoaQOz42pWccR2/jPf8skLwk/I22hNYHFaIS', 'Aktif', 'Login', NULL, NULL, '2021-11-24 04:08:14', '2022-01-13 13:08:48'),
(18, 'AEP212418', 'upload/user/uPxjo3PZt9Ti0Mtre93kHyS9v5SaAel7HptSoIdS.jpg', 'reiandika10@gmail.com', 'reihan.tdn@gmail.com', 'X-BDP', 'Laki-laki', 12342333, '$2y$10$wJYZJeG8CYA1DsEqfO5u..6TWDDRK6C2L.J0EeLLzb1D86LRl2B3a', 'Nonaktif', 'Login', NULL, NULL, '2021-11-24 10:57:50', '2021-12-18 11:39:01'),
(19, 'AEP212719', 'user.png', 'Reihan Andika', 'sjihanakml@gmail.com', 'XI-TataBoga', 'Laki-laki', 192030768, '$2y$10$Q5VSYHrXekZLtFYsUMTgbekGM/chBgipBTwRI6ty0sraxzSCv8Rea', 'Nonaktif', 'Baru daftar', NULL, NULL, '2021-11-27 03:40:59', '2021-11-27 03:40:59'),
(20, 'AEP212720', 'user.png', 'Reihan Andika', 'eperpussmkn1ciamis@gmail.com', 'XI-Perhotelan', 'Laki-laki', 192039876, '$2y$10$LtV0eHxCUvYtJEbbAR5/VO/iRA0FTlrhwnb3yUTqPgX6mi5LFbOxa', 'Nonaktif', 'Baru daftar', NULL, NULL, '2021-11-27 03:42:01', '2021-11-27 03:42:01'),
(21, 'AEP212721', 'user.png', 'Reihan Andika', 'reiha@gmail.com', 'XI-Perhotelan', 'Laki-laki', 192039873, '$2y$10$Nqqe0Fh5CDS5kJRpt6mhvO.GjqXy2aKrAIySQda2/QT1UU0sKkUai', 'Nonaktif', 'Baru daftar', NULL, NULL, '2021-11-27 03:48:35', '2021-11-27 03:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengarang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_buku` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `gambar_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) DEFAULT 0,
  `pinjaman` bigint(11) UNSIGNED DEFAULT 0,
  `status` enum('Publish','Draft','Pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Publish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`id`, `judul_buku`, `slug`, `pengarang`, `jumlah_buku`, `deskripsi`, `tahun_terbit`, `penerbit`, `isbn`, `kategori_id`, `gambar_buku`, `views`, `pinjaman`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Kiarra Fisher', 'kiarra-fisher', 'Saya suka kamu', 97, '<p>Quod ut magnam ut itaque. Minus quia voluptas vel eaque expedita ut repudiandae. Ut iste debitis ipsam tempore veritatis corporis facilis. Earum suscipit et repellendus nostrum.</p>', 2021, 'Saya suka kamu', '12345678', 2, 'upload/sampul/C3ZkzjcpKVublwC5yJpVtev1q2TUwIRZsKZxWHU0.jpg', 233, 3, 'Publish', '2021-11-15 06:30:18', '2021-11-26 08:59:12'),
(6, 'Pulang Pergi', 'pulang-pergi', 'Tere Liye', 99, '<p>Aliquid sit necessitatibus similique sed. Provident qui explicabo et voluptatem et omnis. Earum animi vitae autem voluptatem nihil iusto sint.</p>', 2021, 'Saya suka kamu', '12345678', 1, 'upload/sampul/fjcFWh62Q17qDAMLrm9sUL3cxikaWY7iFRYWZB9y.jpg', 11, 1, 'Publish', '2021-11-15 06:30:18', '2021-11-24 15:42:55'),
(7, 'Bukan Buku Nikah', 'bukan-buku-nikah', 'Ria Ricis', 95, '<p>Beatae earum sunt aut inventore quis aliquam. Debitis explicabo tempore praesentium tenetur et. Ut quia maiores sequi vitae.</p>', 2021, 'Saya suka kamu', '12345678', 2, 'upload/sampul/VwXIfwfYzMMvXec9pST2FQJdM5ke3RqkzKhtOnaL.jpg', 20, 5, 'Publish', '2021-11-15 06:30:18', '2021-11-25 07:30:49'),
(8, 'Dee Lestari Rapi Jali', 'dee-lestari-rapi-jali', 'Saya suka kamu', 96, '<p>Delectus labore voluptas culpa aliquid nisi. Dicta cupiditate est consectetur. Incidunt voluptas velit alias blanditiis voluptatem molestiae itaque sed.</p>', 2021, 'Saya suka kamu', '12345678', 1, 'upload/sampul/7GLGhmW7pbagvqXbMcdzxrkxRnAo2aCoPfjQzwDF.jpg', 142, 4, 'Publish', '2021-11-15 06:30:18', '2022-01-13 13:09:26'),
(9, 'Wingit - Sara Wijayanto', 'wingit---sara-wijayanto', 'Sara Wijayanto', 3, '<p>Et blanditiis nam quasi aliquid voluptatem nisi. Repellat officiis adipisci sint adipisci voluptatem repudiandae et ut. Similique corrupti laborum voluptatem aut consequatur non.</p>', 2021, 'Saya suka kamu', '12345678', 1, 'upload/sampul/zEgo32g2H4hbCT6w7P9tJKEJAeK0FDVcgDVDsdE2.jpg', 164, 4, 'Publish', '2021-11-15 06:30:18', '2021-11-25 08:19:06'),
(10, 'Selamat Tinggal', 'selamat-tinggal', 'Tere Liye', 96, '<p>Porro mollitia suscipit nostrum expedita numquam ut. Sit eligendi et nisi beatae earum consequatur. Iusto aut maiores sint pariatur. Eligendi temporibus dignissimos rerum.</p>', 2021, 'Saya suka kamu', '12345678', 1, 'upload/sampul/5toTtkHTdhb0LCr0vTgflzQT8VKewdBPceYkNCER.jpg', 100, 3, 'Publish', '2021-11-15 06:30:18', '2021-11-27 01:47:02'),
(28, 'The Star And L', 'the-star-and-l', 'Ilana Tan', 8, '<p>Tentang Olivia Mitchell yang berada di New York untuk bekerja sebagai aktris teater dan ingin mencari tahu keberadaan orang tua kandungnya. Dibantu sahabat masa kecil, Rex Rankin, Olivia mencari fakta atas masa lalunya dan juga berhasil mendapatkan jawaban atas perasaan hatinya.</p>', 2021, 'Ilana Tan', '193939DKKD', 2, 'upload/sampul/NnM8DH86fEdDnya7a6SkxPboSIUGtDM7vT5rlzgX.jpg', 8, 2, 'Publish', '2021-11-24 15:39:44', '2021-11-27 01:38:49'),
(29, 'Ten Years Challange', 'ten-years-challange', 'Mutiarani', 10, '<p>Berkisah tentang Atya yang berumur 27 tahun. Ia diputuskan sepihak oleh Diga, pacarnya sejak SMA, dan Atya merasa hidupnya hancur. Reuni SMA yang diharapkannya bisa sedikit menghibur, malah berakhir dengan buruk karena Diga datang dengan pacar baru, dan di hadapan semua orang mereka bertengkar hebat. Saat Atya pulang, ia mengalami kecelakaan, dan membawanya ke masa lalu saat membuka matanya.</p><p>Buku yang ringan dan penuh pesan kehidupan. Mengangkat tema \"<i>rebirth</i>\", sang tokoh utama dihadapkan pada kecelakaan yang ternyata membawanya kembali ke masa 10 tahun lalu. Ia pun berusaha memperbaiki kesalahannya yang lalu. Namun, hidup selalu punya rencana lain yang membuatnya bimbang pada pilihan lain.</p>', 2021, 'Mutiarani', '122323HHH', 2, 'upload/sampul//60F6pvJA0428MnpNeZmMRBEarVbTINDvmcc6nHkt.jpg', 3, 0, 'Publish', '2021-11-24 15:44:13', '2021-11-25 07:31:09'),
(30, 'Tikungan Maut - Kisah Tanah Jawa', 'tikungan-maut---kisah-tanah-jawa', 'Kisah Tanah Jawa', 2, '<p>Buku ini menjadi lanjutan dari investigasi sejarah, mitos dan kisah-kisah mistis di pulau Jawa dari kelompok yang beranggotakan Genta, Om Hao (Hari), serta Mada Zidan.</p>', 2021, 'Kisah Tanah Jawa', '192029BB', 2, 'upload/sampul//h4pL2hT54mWRpH6icfiplzlFlCAtvfrvip5BnmVN.jpg', 7, 0, 'Publish', '2021-11-24 15:45:44', '2021-11-26 00:25:13'),
(31, 'TAIPAN - The Winner Take it All', 'taipan---the-winner-take-it-all', 'Taipan', 2, '<p>Sama seperti Nero yang bernyanyi dan berpesta di tengah kota Roma yang terbakar. Kelompok ini masih ada. Mungkin orangnya berbeda, tetapi semangatnya tetap sama. Mereka muncul lagi untuk menyelamatkan tokoh-tokoh penting dengan menciptakan kambing hitam dari kalangan tidak bersalah, dan pada saat yang sama mereka melakukan pembantaian untuk mengambil aset-aset bagus dengan harga sangat murah. Sebuah kisah tentang ambisi dan korupsi yang dilatarbelakangi peristiwa bersejarah di Indonesia.</p>', 2021, 'TAIPAN', '1199BBB', 2, 'upload/sampul//Wanv7akrtFsxqo5Cu0VjuRSGtGZemoPCMGW5f959.jpg', 3, 0, 'Publish', '2021-11-24 15:46:56', '2022-01-13 13:09:07'),
(32, 'Living An A Campervan', 'living-an-a-campervan', '--', 2, '<p>Nah, pasangan ini kembali merilis buku mengenai kesukaan mereka dalam <i>traveling</i> dan ingin keliling dunia bersama selamanya. Setelah <i>vlog</i> mereka di YouTube, mereka menuliskan keseruaannya bepergian dan berkeliling di luar negeri dengan <i>campervan</i>.</p>', 2021, '--', 'JDJD999', 2, 'upload/sampul/iuJKE8TSphBa0PsGgfpaHm9f0pTfkU5MBBU4hqqm.jpg', 5, 0, 'Publish', '2021-11-24 15:47:58', '2022-02-20 15:37:27'),
(33, 'Devil Angel', 'devil-angel', '-', 10, '<p>Kent mendapatkan misi yang sulit kali ini, di mana dia harus melindungi seorang Devil Angel dari kejaran para penjahat yang ingin melenyapkan aset penting negara itu. Masalahnya terletak pada fakta bahwa Devil Angel adalah seorang wanita cantik yang membuat Kent pontang-panting menata hatinya. Namun, Negara malah berkhianat pada Devil Angel, bisakah Kent melindungi wanita itu dari kejaran dunia dan mempertaruhkan hidupnya?</p>', 2021, '-', '--', 1, 'upload/sampul//GQ9jZHpICucboUwcs2WmmOghfKBiirQCtVuKAwki.jpg', 3, 0, 'Publish', '2021-11-25 07:40:38', '2021-11-26 08:59:21'),
(34, 'Pendidikan indah', 'pendidikan-indah', 'pp', 200, '<p>ff</p>', 30, 'J', 'jfj', 3, 'gambar.jpg', 5, 0, 'Publish', '2021-11-25 08:43:10', '2021-11-27 02:12:23'),
(35, 'Pendidikan indah', 'pendidikan-indah', 'Alhamdulillah', 50, '<p>dd</p>', 2021, 'ddddd', '2020111dd', 1, 'upload/sampul/zqWPQBnbqK6CQ7ODFWm1mi68uoYkjZU8R2Oyi4uf.jpg', 0, 0, 'Publish', '2021-11-25 08:47:57', '2021-11-27 02:11:12');

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
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Pendidikan', '2021-11-15 05:39:43', '2021-11-15 05:40:20'),
(2, 'Pengetahuan', '2021-11-15 05:41:41', '2021-11-23 16:42:26'),
(3, 'Sejarah', NULL, NULL);

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_14_072950_create_bukus_table', 1),
(6, '2021_11_14_102731_create_kategoris_table', 1),
(7, '2021_11_15_165432_create_thumbnails_table', 2),
(8, '2021_11_16_131706_create_anggotas_table', 3),
(9, '2021_11_16_154054_create_anggotas_table', 4),
(10, '2021_11_17_142603_create_pinjamen_table', 5),
(11, '2021_11_17_144049_create_pinjamen_table', 6),
(12, '2021_11_18_155808_create_pinjamen_table', 7),
(13, '2021_11_20_102837_create_aktifitas_table', 8),
(14, '2021_11_21_091528_create_aktifitasadmins_table', 9);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pinjamen`
--

CREATE TABLE `pinjamen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_anggota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_buku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buku_id` bigint(20) UNSIGNED NOT NULL,
  `tgl_pinjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_kembali` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Belum diambil','Dipinjam','Dikembalikan','Denda') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum diambil',
  `denda` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pinjamen`
--

INSERT INTO `pinjamen` (`id`, `id_anggota`, `nama_peminjam`, `email`, `jenis_kelamin`, `kelas`, `judul_buku`, `buku_id`, `tgl_pinjam`, `tgl_kembali`, `status`, `denda`, `created_at`, `updated_at`) VALUES
(21, 'AEP21241', 'Reihan Andika AM', 'reinandika10@gmail.com', 'Laki-laki', 'XI-TataBoga', 'The Star And L', 28, '2021-11-25', '2021-11-26', 'Belum diambil', 0, '2021-11-25 07:33:13', '2021-11-25 07:33:13'),
(22, 'AEP212418', 'reiandika10@gmail.com', 'reihan.tdn@gmail.com', 'Laki-laki', 'X-BDP', 'The Star And L', 28, '2021-11-27', '2021-11-30', 'Belum diambil', 0, '2021-11-27 01:38:49', '2021-11-27 01:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `gambar`, `link`, `created_at`, `updated_at`) VALUES
(17, 'upload/thumbnail/E8wxi58sBbE4Ka2fEtk65mqQQrhLgNX9guMCp3Zl.jpg', NULL, '2021-11-25 07:09:19', '2021-11-25 07:09:19'),
(22, 'upload/thumbnail/z1n8ALJsHlk3Sjb7UzwTrhZ9lyWLiyE3gFKGBRhP.jpg', NULL, '2021-11-25 07:16:37', '2021-11-25 07:16:37'),
(25, 'upload/thumbnail/UubsVYqxu1Z6D78YIaV3Mr6KwKvUqgeUarzrM8t3.jpg', NULL, '2021-11-25 07:22:19', '2021-11-25 07:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_petugas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','Petugas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Petugas',
  `aktifitas` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_petugas`, `nama`, `username`, `password`, `role`, `aktifitas`, `created_at`, `updated_at`) VALUES
(1, '', 'Reihan Andika', 'admin', '$2y$10$oVxXiejBmcW1AJoivlj43OAbxE7ejMPPVAxeDTMgwWd.bytsjzVvC', 'Admin', 'Login', '2021-11-30 12:26:53', '2021-11-27 02:08:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktifitas`
--
ALTER TABLE `aktifitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aktifitasadmins`
--
ALTER TABLE `aktifitasadmins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anggotas`
--
ALTER TABLE `anggotas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anggotas_id_anggota_unique` (`id_anggota`),
  ADD UNIQUE KEY `anggotas_email_unique` (`email`);

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pinjaman` (`pinjaman`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pinjamen`
--
ALTER TABLE `pinjamen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktifitas`
--
ALTER TABLE `aktifitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aktifitasadmins`
--
ALTER TABLE `aktifitasadmins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `anggotas`
--
ALTER TABLE `anggotas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pinjamen`
--
ALTER TABLE `pinjamen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `thumbnails`
--
ALTER TABLE `thumbnails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
