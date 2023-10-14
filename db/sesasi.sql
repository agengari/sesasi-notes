-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2023 at 02:16 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sesasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `group_id` int(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`group_id`, `name`, `description`) VALUES
(1, 'admin', 'Admin system'),
(2, 'editor', 'Notes editor'),
(3, 'user', 'Ordinary User');

-- --------------------------------------------------------

--
-- Table structure for table `auth_group_permission`
--

CREATE TABLE `auth_group_permission` (
  `group_id` int(2) NOT NULL,
  `permission_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_group_permission`
--

INSERT INTO `auth_group_permission` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(3, 5),
(3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `auth_group_user`
--

CREATE TABLE `auth_group_user` (
  `group_id` int(2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_group_user`
--

INSERT INTO `auth_group_user` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `permission_id` int(2) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`permission_id`, `name`, `description`) VALUES
(1, 'create_note', 'Membuat catatan'),
(2, 'read_note', 'Membaca catatan'),
(3, 'update_note', 'Memperbarui catatan'),
(4, 'delete_note', 'Hapus catatan'),
(5, 'manage_own_profile', 'Mengubah profil sendiri'),
(6, 'manage_user_profile', 'Mengubah profil pengguna lain'),
(7, 'view_user_list', 'Melihat daftar Pengguna'),
(8, 'delete_user', 'Menghapus pengguna'),
(9, 'delete_own_account', 'Menghapus akun sendiri');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `user_id`, `title`, `note`) VALUES
(1, 1, 'Catatan Pertama', 'Catatan Pertama dari user pengguna biasa'),
(2, 1, 'Catatan Kedua', 'Catatan Kedua dari user pengguna biasa'),
(10, 3, 'Catatan dari User Nugroho', 'Catatan Pertama'),
(11, 3, 'Catatan kedua user Nugroho', 'Test Catatan Ke-2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user` varchar(25) NOT NULL,
  `pass` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `user`, `pass`) VALUES
(1, 'Ageng', 'ageng', '123'),
(2, 'Ari', 'ari', '123'),
(3, 'Nugroho', 'nugroho', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `auth_group_permission`
--
ALTER TABLE `auth_group_permission`
  ADD KEY `fk_group_permission` (`group_id`),
  ADD KEY `fk_permission` (`permission_id`);

--
-- Indexes for table `auth_group_user`
--
ALTER TABLE `auth_group_user`
  ADD KEY `fk_group` (`group_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `group_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `permission_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_group_permission`
--
ALTER TABLE `auth_group_permission`
  ADD CONSTRAINT `fk_group_permission` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`group_id`),
  ADD CONSTRAINT `fk_permission` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`permission_id`);

--
-- Constraints for table `auth_group_user`
--
ALTER TABLE `auth_group_user`
  ADD CONSTRAINT `fk_group` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`group_id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
