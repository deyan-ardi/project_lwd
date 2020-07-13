-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 13 Jul 2020 pada 16.01
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `LWD`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about_me`
--

CREATE TABLE `about_me` (
  `id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `about_me`
--

INSERT INTO `about_me` (`id`, `project_name`, `description`, `link`) VALUES
(2, 'E-ORS HMJ TI Undiksha', 'Sistem  Informasi ini digunakan untuk melakukan proses Open Recruitment HMJ TI Undiksha tahun 2020. Website ini dirancang dengan menggunakan struktur konsep MVC/membuat framework sendiri, Boostrap, CSS, Javascript, HTML, PHP,MYSQL,dan PDO.', 'http://if.undiksha.ac.id/hmj/oprec'),
(3, 'Learning With Deyan', 'Sistem Informasi ini adalah sistem informasi yang baru saja dikembangkan oleh Deyan, Sistem Informasi ini bertujuan untuk sharing terhadap pembaca terkait pembelajaran TI. Dibuat dengan Codeigniter 3 dan bantuan Template dari Colorlib', 'http://localhost/coronaWeb/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `article` text NOT NULL,
  `id_category_article` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` varchar(500) NOT NULL,
  `category_date` datetime NOT NULL,
  `category_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id_category`, `category_name`, `category_description`, `category_date`, `category_by`) VALUES
(9, 'KSI', 'KSI File', '2020-05-26 10:58:57', 'De '),
(10, 'ALPRO', 'Alpro Category', '2020-05-25 23:01:58', 'Admin ');

--
-- Trigger `category`
--
DELIMITER $$
CREATE TRIGGER `datetime_category_insert` BEFORE INSERT ON `category` FOR EACH ROW BEGIN
    IF NEW.category_date = '0000-00-00 00:00:00' THEN
        SET NEW.category_date = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `datetime_category_update` BEFORE UPDATE ON `category` FOR EACH ROW BEGIN
    IF NEW.category_date = '0000-00-00 00:00:00' THEN
        SET NEW.category_date = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_article`
--

CREATE TABLE `category_article` (
  `id_category_article` int(11) NOT NULL,
  `article_name` varchar(100) NOT NULL,
  `article_description` text NOT NULL,
  `article_datetime` datetime NOT NULL,
  `article_created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_category`
--

CREATE TABLE `detail_category` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  `file_protection` varchar(100) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `file_name` text NOT NULL,
  `size` varchar(5) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_category`
--

INSERT INTO `detail_category` (`id`, `id_category`, `name`, `description`, `date`, `file_protection`, `created_by`, `file_name`, `size`, `id_user`) VALUES
(19, 9, 'ksi - 3', 'TEST FILE', '2020-05-26 10:59:30', 'no', 'De ', 'ksi_-_3.zip', '20.12', 23),
(20, 9, 'ksi - 2', 'Ini File KSI -2', '2020-05-25 20:08:51', 'no', 'Admin ', 'ksi_-_2.zip', '', 23),
(21, 9, 'ksi - 4', 'file ksi', '2020-05-25 22:21:35', 'yes', 'Admin ', 'ksi_-_4.zip', '15.89', 23),
(23, 10, 'test', 'Test', '2020-05-26 14:19:24', 'no', 'Admin ', 'test.zip', '911.1', 23),
(24, 10, 'testku fileku', 'Test', '2020-05-30 23:26:03', 'no', 'Admin ', 'testku.zip', '302.5', 23);

--
-- Trigger `detail_category`
--
DELIMITER $$
CREATE TRIGGER `date_time_insert` BEFORE INSERT ON `detail_category` FOR EACH ROW BEGIN
    IF NEW. date = '0000-00-00 00:00:00' THEN
        SET NEW.date = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `date_time_update` BEFORE UPDATE ON `detail_category` FOR EACH ROW BEGIN
    IF NEW. date = '0000-00-00 00:00:00' THEN
        SET NEW.date = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'super_user', 'Super User Group');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `isi` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id`, `user`, `date`, `isi`) VALUES
(7, 'Admin ', '2020-05-23 15:03:15', 'Hallo'),
(17, 'HMJ ', '2020-05-27 16:09:32', 'Hallo nama saya i gede riyan ardi darmawan, saya dari pendidikan teknik informatika, jadi saya ingin berkomentar begini bos, jadi websitenya lumayanlah cuma untuk harga gmana bos?'),
(18, 'Admin ', '2020-05-31 00:55:54', '  Hallo nama saya i gede riyan ardi darmawan, saya dari pendidikan teknik informatika, jadi saya ingin berkomentar begini bos, jadi websitenya lumayanlah cuma untuk harga gmana bos? \r\n\r\n~Deyan'),
(19, 'Deyan ', '2020-05-31 12:48:32', 'Ok');

--
-- Trigger `komentar`
--
DELIMITER $$
CREATE TRIGGER `date_time` BEFORE INSERT ON `komentar` FOR EACH ROW BEGIN
    IF NEW. date = '0000-00-00 00:00:00' THEN
        SET NEW.date = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(33, '127.0.0.1', 'riyan.clsg@gmail.com', 1594647051),
(34, '127.0.0.1', 'riyan.clsg13@gmail.com', 1594647068);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(23, '127.0.0.1', NULL, '$2y$12$L8l9A8N.x27iia.dThoihOgIToZ36JciTvBMFZ4ADHYys7FzcSjK2', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-29 22:58:00', 1594648703, 1, 'Admin', 'Deyan', 'Undiksha', '081915656865'),
(25, '127.0.0.1', NULL, '$2y$10$zM2gAp8Uxh7OL2zP1tuH..V4dEk/ahOhHGMDEjsc/jvmgSauENtwC', 'riyan.clsg12@gmail.com', 'e07fa3190fad7f25ae9c', '$2y$10$xlRKQtKEO0IcrtzOVW8k1eYB.pxjtXG.QKjdLQxYfrHYMBCgdOFD6', NULL, NULL, NULL, NULL, NULL, '2020-05-30 17:13:06', 1594647118, 1, 'Deyan', 'Ardi', 'Undiksha', '081915656865');

--
-- Trigger `users`
--
DELIMITER $$
CREATE TRIGGER `datetime_users_insert` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.created_on = '0000-00-00 00:00:00' THEN
        SET NEW.created_on = CURRENT_TIMESTAMP();
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(47, 23, 1),
(43, 25, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about_me`
--
ALTER TABLE `about_me`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `article_ibfk_1` (`id_category_article`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `category_article`
--
ALTER TABLE `category_article`
  ADD PRIMARY KEY (`id_category_article`);

--
-- Indeks untuk tabel `detail_category`
--
ALTER TABLE `detail_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category` (`id_category`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indeks untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about_me`
--
ALTER TABLE `about_me`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `category_article`
--
ALTER TABLE `category_article`
  MODIFY `id_category_article` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_category`
--
ALTER TABLE `detail_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_category_article`) REFERENCES `category_article` (`id_category_article`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_category`
--
ALTER TABLE `detail_category`
  ADD CONSTRAINT `detail_category_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
