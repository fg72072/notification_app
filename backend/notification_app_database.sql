-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2022 at 09:00 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notification_app`
--

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
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `friendship_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_type` varchar(3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `friendship_id`, `user_id`, `request_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 3, 1, '2', '2022-07-08 16:41:24', '2022-07-08 16:41:24', NULL),
(6, 3, 8, '2', '2022-07-08 16:41:24', '2022-07-08 16:41:24', NULL),
(7, 4, 1, '2', '2022-07-08 16:55:36', '2022-07-08 16:55:36', NULL),
(8, 4, 9, '2', '2022-07-08 16:55:36', '2022-07-08 16:55:36', NULL),
(9, 5, 1, '2', '2022-07-08 16:55:50', '2022-07-08 16:55:50', NULL),
(10, 5, 10, '2', '2022-07-08 16:55:50', '2022-07-08 16:55:50', NULL),
(11, 6, 1, '2', '2022-07-13 13:33:25', '2022-07-13 13:33:25', NULL),
(12, 6, 12, '2', '2022-07-13 13:33:25', '2022-07-13 13:33:25', NULL),
(13, 7, 1, '2', '2022-07-13 13:48:35', '2022-07-13 13:48:35', NULL),
(14, 7, 11, '2', '2022-07-13 13:48:35', '2022-07-13 13:48:35', NULL),
(15, 8, 1, '2', '2022-07-19 10:36:34', '2022-07-19 10:36:34', NULL),
(16, 8, 13, '2', '2022-07-19 10:36:34', '2022-07-19 10:36:34', NULL),
(17, 9, 11, '2', '2022-07-28 02:01:16', '2022-07-28 02:01:16', NULL),
(18, 9, 12, '2', '2022-07-28 02:01:16', '2022-07-28 02:01:16', NULL),
(19, 10, 1, '2', '2022-07-29 00:43:09', '2022-07-29 00:43:09', NULL),
(20, 10, 14, '2', '2022-07-29 00:43:09', '2022-07-29 00:43:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `id` int(11) NOT NULL,
  `creater_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`id`, `creater_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 1, '2022-07-08 16:41:24', '2022-07-08 16:41:24', NULL),
(4, 1, '2022-07-08 16:55:36', '2022-07-08 16:55:36', NULL),
(5, 1, '2022-07-08 16:55:50', '2022-07-08 16:55:50', NULL),
(6, 1, '2022-07-13 13:33:25', '2022-07-13 13:33:25', NULL),
(7, 1, '2022-07-13 13:48:35', '2022-07-13 13:48:35', NULL),
(8, 1, '2022-07-19 10:36:34', '2022-07-19 10:36:34', NULL),
(9, 11, '2022-07-28 02:01:16', '2022-07-28 02:01:16', NULL),
(10, 1, '2022-07-29 00:43:09', '2022-07-29 00:43:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `creater_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `creater_id`, `slug`, `image`, `title`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, '1', 'test', '1657703197.1657284228.logo192.png', 'Test', 'test', '0', '2022-07-19 10:48:03', '2022-07-08 16:43:48', '2022-07-19 10:48:03'),
(5, '1', 'pluton', '1659073645.logo.png', 'Pluton', 'demo', '0', NULL, '2022-07-13 13:07:57', '2022-07-29 00:47:25'),
(7, '11', 'new', '1659073677.tim_80x80.png', 'New', 'new', '0', NULL, '2022-07-28 08:43:28', '2022-07-29 00:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remove_by_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_admin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `left_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remove_at` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`id`, `group_id`, `user_id`, `remove_by_id`, `is_admin`, `left_at`, `remove_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(7, '4', '1', '0', '0', NULL, NULL, '2022-07-19 10:48:03', '2022-07-08 16:43:48', '2022-07-19 10:48:03'),
(8, '4', '8', '0', '0', NULL, NULL, '2022-07-19 10:48:03', '2022-07-08 16:43:48', '2022-07-19 10:48:03'),
(9, '4', '9', '0', '0', NULL, NULL, '2022-07-19 10:48:03', '2022-07-08 16:43:48', '2022-07-19 10:48:03'),
(10, '4', '12', '0', '0', NULL, NULL, '2022-07-19 10:48:03', '2022-07-13 13:01:03', '2022-07-19 10:48:03'),
(11, '5', '1', '0', '0', NULL, NULL, NULL, '2022-07-13 13:07:57', '2022-07-13 13:07:57'),
(12, '5', '8', '0', '0', NULL, NULL, NULL, '2022-07-13 13:07:57', '2022-07-13 13:07:57'),
(13, '5', '10', '0', '0', NULL, NULL, NULL, '2022-07-13 13:07:57', '2022-07-13 13:07:57'),
(14, '5', '12', '1', '0', NULL, '2022-07-19 06:20:14', NULL, '2022-07-13 13:07:57', '2022-07-19 10:20:14'),
(15, '5', '11', '0', '0', NULL, NULL, NULL, '2022-07-19 10:18:49', '2022-07-19 10:18:49'),
(16, '4', '10', '0', '0', NULL, NULL, '2022-07-19 10:48:03', '2022-07-19 10:37:51', '2022-07-19 10:48:03'),
(17, '4', '13', '0', '0', NULL, NULL, '2022-07-19 10:48:03', '2022-07-19 10:38:08', '2022-07-19 10:48:03'),
(18, '7', '1', '0', '0', NULL, NULL, NULL, '2022-07-28 08:43:28', '2022-07-28 08:43:28'),
(19, '7', '8', '0', '0', NULL, NULL, NULL, '2022-07-28 08:43:28', '2022-07-29 00:39:22'),
(20, '7', '9', '0', '0', NULL, NULL, NULL, '2022-07-28 08:43:28', '2022-07-28 08:43:28'),
(21, '7', '10', '0', '0', NULL, NULL, NULL, '2022-07-28 08:43:28', '2022-07-28 08:43:28'),
(22, '7', '11', '0', '0', NULL, NULL, NULL, '2022-07-28 08:43:28', '2022-07-28 08:43:28'),
(23, '7', '12', '0', '0', NULL, NULL, NULL, '2022-07-28 08:43:28', '2022-07-28 08:43:28'),
(24, '7', '13', '0', '0', NULL, NULL, NULL, '2022-07-28 08:43:28', '2022-07-28 08:43:28'),
(25, '7', '14', '0', '0', NULL, NULL, NULL, '2022-07-28 08:43:28', '2022-07-29 00:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message_against_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_muted` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_seen` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message_against_id`, `user_id`, `body`, `type`, `is_muted`, `status`, `is_seen`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, '3', '1', 'hey', '1', '0', '0', '0', NULL, '2022-07-08 16:41:32', '2022-07-08 16:41:32'),
(3, '3', '1', 'how are you', '1', '0', '0', '0', NULL, '2022-07-08 16:42:46', '2022-07-08 16:42:46'),
(4, '4', '1', 'this is group test message', '2', '0', '0', '0', '2022-07-19 10:48:03', '2022-07-08 16:44:05', '2022-07-19 10:48:03'),
(5, '4', '1', 'hello', '2', '0', '0', '0', '2022-07-19 10:48:03', '2022-07-08 19:44:20', '2022-07-19 10:48:03'),
(6, '4', '1', 'hello', '2', '0', '0', '0', '2022-07-19 10:48:03', '2022-07-13 12:58:01', '2022-07-19 10:48:03'),
(7, '4', '1', 'bye', '2', '0', '0', '0', '2022-07-19 10:48:03', '2022-07-13 13:01:45', '2022-07-19 10:48:03'),
(8, '5', '9', 'jhvh', '2', '0', '0', '1', NULL, '2022-07-13 13:08:53', '2022-07-22 02:14:04'),
(9, '5', '1', 'gcg', '2', '0', '0', '0', NULL, '2022-07-13 13:09:16', '2022-07-13 13:09:16'),
(10, '6', '1', 'hi', '1', '0', '0', '0', NULL, '2022-07-13 13:33:35', '2022-07-13 13:33:35'),
(11, '7', '1', 'hiii', '1', '0', '0', '1', NULL, '2022-07-13 13:48:57', '2022-07-13 13:50:41'),
(12, '7', '11', 'hello', '1', '0', '0', '1', NULL, '2022-07-13 13:50:46', '2022-07-13 13:53:37'),
(13, '6', '1', 'hello', '1', '0', '0', '0', NULL, '2022-07-19 09:52:02', '2022-07-19 09:52:02'),
(14, '7', '1', 'hahahaha', '1', '0', '0', '0', NULL, '2022-07-19 10:02:23', '2022-07-19 10:02:23'),
(15, '4', '1', 'vjfuy', '2', '0', '0', '0', '2022-07-19 10:48:03', '2022-07-19 10:06:44', '2022-07-19 10:48:03'),
(16, '8', '1', 'hello', '1', '0', '0', '0', NULL, '2022-07-19 10:36:52', '2022-07-19 10:36:52'),
(17, '4', '1', 'gduda', '2', '0', '0', '0', '2022-07-19 10:48:03', '2022-07-19 10:39:25', '2022-07-19 10:48:03'),
(18, '4', '1', 'fiahofuha', '2', '0', '0', '0', '2022-07-19 10:48:03', '2022-07-19 10:39:34', '2022-07-19 10:48:03'),
(19, '9', '11', 'test', '1', '0', '0', '0', NULL, '2022-07-28 02:01:28', '2022-07-28 02:01:28'),
(20, '5', '1', 'test', '2', '0', '0', '0', NULL, '2022-07-28 04:31:06', '2022-07-28 04:31:06'),
(21, '9', '11', 'hey', '1', '0', '0', '0', NULL, '2022-07-28 04:32:29', '2022-07-28 04:32:29'),
(23, '7', '11', 'demo has created New', '2', '1', '0', '0', NULL, '2022-07-28 08:43:28', '2022-07-28 08:43:28'),
(24, '7', '11', 'demo added admin, demo, fayaz, fayaz, hello world, 123, Fayaz Ahmed', '2', '1', '0', '0', NULL, '2022-07-28 08:43:28', '2022-07-28 08:43:28'),
(25, '7', '11', 'demo added Fayaz Ahmed', '2', '1', '0', '0', NULL, '2022-07-28 08:54:43', '2022-07-28 08:54:43'),
(26, '7', '11', 'test', '2', '0', '0', '0', NULL, '2022-07-28 09:27:39', '2022-07-28 09:27:39'),
(28, '7', '1', 'admin added demo to this conversation', '2', '1', '0', '0', NULL, '2022-07-29 00:39:22', '2022-07-29 00:39:22'),
(29, '7', '1', 'admin has removed Fayaz Ahmed from this conversation', '2', '1', '0', '0', NULL, '2022-07-29 00:39:58', '2022-07-29 00:39:58'),
(30, '7', '1', 'admin added Fayaz Ahmed to this conversation', '2', '1', '0', '0', NULL, '2022-07-29 00:41:37', '2022-07-29 00:41:37');

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
(5, '2022_07_01_124103_create_groups_table', 2),
(6, '2022_07_04_064744_create_group_members_table', 2),
(7, '2022_07_04_125302_create_messages_table', 3);

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
-- Table structure for table `read_messages`
--

CREATE TABLE `read_messages` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `message_id` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `read_messages`
--

INSERT INTO `read_messages` (`id`, `user_id`, `message_id`, `created_at`, `updated_at`) VALUES
(14, '1', '12', '2022-07-28 03:16:22', '2022-07-28 03:16:22'),
(15, '1', '8', '2022-07-28 04:31:35', '2022-07-28 04:31:35'),
(16, '11', '11', '2022-07-28 04:32:44', '2022-07-28 04:32:44'),
(17, '11', '14', '2022-07-28 04:32:44', '2022-07-28 04:32:44'),
(18, '11', '8', '2022-07-28 04:32:52', '2022-07-28 04:32:52'),
(19, '11', '9', '2022-07-28 04:32:52', '2022-07-28 04:32:52'),
(20, '11', '20', '2022-07-28 04:32:52', '2022-07-28 04:32:52'),
(21, '1', '23', '2022-07-29 00:30:31', '2022-07-29 00:30:31'),
(22, '1', '24', '2022-07-29 00:30:31', '2022-07-29 00:30:31'),
(23, '1', '25', '2022-07-29 00:30:31', '2022-07-29 00:30:31'),
(24, '1', '26', '2022-07-29 00:30:31', '2022-07-29 00:30:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `device_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `device_id`, `image`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `is_admin`, `status`, `created_at`, `updated_at`) VALUES
(1, '9f75549c-9228-4ed8-863e-d412e96eae75\n', '1659073350.default-avatar.png', 'admin', 'admin@gmail.com', NULL, '$2y$10$gsJEm.mpxzao17EWEeSI1OWlhrzEUNN.W2x3UZJtswfeQcUHpDS.W', NULL, '1', '0', '2022-07-01 07:35:33', '2022-07-29 00:42:30'),
(8, NULL, NULL, 'demo', 'demo@gmail.com', NULL, '$2y$10$eR6soR3SVJlqFmGKqQolIerfmeAfMWcB7ejv3shpKuI2dX3w39b3K', NULL, '0', '0', '2022-07-08 16:40:33', '2022-07-08 16:40:33'),
(9, NULL, NULL, 'fayaz', 'fayazamjad@gmail.com', NULL, '$2y$10$YOs4VB2KzbXY7WEsvEZRvulEzgW.6W7dR4DQ7bEa/8NRVna3wbLZu', NULL, '0', '0', '2022-07-08 16:42:10', '2022-07-08 16:42:10'),
(10, NULL, NULL, 'fayaz', 'fayazamjad.dev@gmail.com', NULL, '$2y$10$c08lpT.pLoZkjkEH.X6dc.zElmYNxjSXklu4L.D4IAxc1B06i/RGC', NULL, '0', '0', '2022-07-08 16:44:11', '2022-07-08 16:44:11'),
(11, NULL, NULL, 'demo', 'demo1@gmail.com', NULL, '$2y$10$A8BnZ.fV0lqn6kFLtzsjYOp94tmEXpZzuHKTixrD4Up88yB9CBVFS', NULL, '1', '0', '2022-07-08 20:47:51', '2022-07-13 13:48:44'),
(12, NULL, NULL, 'hello world', 'hello@gmail.com', NULL, '$2y$10$z9BajXCcoKVHdywTtvnKY.mx9PRsuHPZtgcTOAAiVaRfUCvVCbo1W', NULL, '0', '1', '2022-07-13 12:59:43', '2022-07-13 13:35:04'),
(13, NULL, NULL, '123', '123@gmail.com', NULL, '$2y$10$KYx1kzQdruIwxLzUuYrRZerRN5xBcyLMCGTuIVuBbdK3xotL0oEAK', NULL, '1', '0', '2022-07-19 10:36:02', '2022-07-19 10:43:50'),
(14, NULL, '1659073410.tim_80x80.png', 'Fayaz Ahmed', 'fayaz.pluton@gmail.com', NULL, '$2y$10$bcKUf4scI2n0RhNt1QuDOOm2hfTouyyfEk51mWhJb.HYEj2514Lpy', NULL, '0', '0', '2022-07-19 14:49:42', '2022-07-29 00:43:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
-- Indexes for table `read_messages`
--
ALTER TABLE `read_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `read_messages`
--
ALTER TABLE `read_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
