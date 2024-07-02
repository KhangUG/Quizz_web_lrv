-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2024 at 04:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `questions_id` int(11) NOT NULL,
  `answer` varchar(500) NOT NULL,
  `is_correct` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `questions_id`, `answer`, `is_correct`, `created_at`, `updated_at`) VALUES
(5, 11, 'Nhạc sĩ', 1, '2024-06-24 09:51:54', '2024-07-01 09:23:43'),
(6, 11, 'Diễn viên', 0, '2024-06-24 09:51:54', '2024-07-01 09:23:43'),
(7, 11, 'Ans 1', 0, '2024-06-24 18:11:28', '2024-07-01 09:23:43'),
(10, 12, '18', 0, '2024-06-24 18:16:04', '2024-07-01 09:40:17'),
(11, 12, '17', 1, '2024-06-24 18:16:04', '2024-07-01 09:40:17'),
(12, 12, '16', 0, '2024-06-24 18:16:04', '2024-07-01 09:40:17'),
(22, 14, '2021', 0, '2024-06-25 22:01:46', '2024-06-25 22:01:46'),
(23, 14, '2022', 0, '2024-06-25 22:01:46', '2024-06-25 22:01:46'),
(24, 14, '2023', 0, '2024-06-25 22:01:46', '2024-06-25 22:01:46'),
(25, 14, '2024', 1, '2024-06-25 22:01:46', '2024-06-25 22:01:46'),
(26, 14, '2019', 0, '2024-06-25 22:01:46', '2024-06-25 22:01:46'),
(27, 14, '2018', 0, '2024-06-25 22:01:46', '2024-06-25 22:01:46'),
(28, 15, 'test ans 1', 1, '2024-07-01 16:15:36', '2024-07-01 16:15:36'),
(29, 15, 'test ans ep 2', 0, '2024-07-01 16:15:36', '2024-07-01 16:15:36'),
(30, 16, 'ans 1 exp', 0, '2024-07-01 16:16:05', '2024-07-01 09:21:25'),
(31, 16, 'ans 2 exp', 1, '2024-07-01 16:16:05', '2024-07-01 09:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `attempt` int(11) NOT NULL DEFAULT 0,
  `marks` float NOT NULL DEFAULT 0,
  `pass_marks` float NOT NULL DEFAULT 0,
  `enterance_id` varchar(255) NOT NULL,
  `plan` int(11) NOT NULL DEFAULT 0 COMMENT '0->Free, 1->Paid',
  `prices` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`prices`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_name`, `subject_id`, `date`, `time`, `attempt`, `marks`, `pass_marks`, `enterance_id`, `plan`, `prices`, `created_at`, `updated_at`) VALUES
(10, 'Test Exam English', 5, '2024-06-30', '01:00', 1, 1.6, 1, 'exid667db293b7e13', 0, NULL, '2024-06-27 18:42:27', '2024-07-01 06:22:16'),
(11, 'Kiểm Tra giữa kì', 4, '2024-07-01', '01:00', 2, 2, 2, 'exid667db35c2d77a', 0, NULL, '2024-06-27 18:45:48', '2024-06-30 19:30:16'),
(14, 'Thi kết thúc học phần: Thị giác máy tính', 5, '2024-06-30', '00:15', 1, 3, 7, 'exid668076d23bc92', 0, NULL, '2024-06-29 21:04:18', '2024-06-30 19:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `exams_answers`
--

CREATE TABLE `exams_answers` (
  `id` int(11) NOT NULL,
  `attempt_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `exams_answers`
--

INSERT INTO `exams_answers` (`id`, `attempt_id`, `question_id`, `answer_id`, `created_at`, `updated_at`) VALUES
(26, 19, 12, 11, '2024-06-29 19:20:03', '2024-06-29 19:20:03'),
(27, 20, 12, 11, '2024-06-29 19:31:44', '2024-06-29 19:31:44'),
(28, 21, 11, 5, '2024-06-29 19:32:04', '2024-06-29 19:32:04'),
(29, 21, 14, 24, '2024-06-29 19:32:04', '2024-06-29 19:32:04'),
(30, 21, 12, 12, '2024-06-29 19:32:04', '2024-06-29 19:32:04'),
(31, 23, 14, 22, '2024-06-30 21:04:03', '2024-06-30 21:04:03'),
(32, 23, 12, 11, '2024-06-30 21:04:03', '2024-06-30 21:04:03'),
(33, 24, 11, 7, '2024-06-30 21:04:52', '2024-06-30 21:04:52'),
(34, 24, 14, 26, '2024-06-30 21:04:52', '2024-06-30 21:04:52'),
(35, 24, 12, 11, '2024-06-30 21:04:52', '2024-06-30 21:04:52'),
(36, 25, 11, 6, '2024-06-30 21:05:04', '2024-06-30 21:05:04'),
(37, 25, 12, 11, '2024-06-30 21:05:04', '2024-06-30 21:05:04'),
(38, 25, 14, 23, '2024-06-30 21:05:04', '2024-06-30 21:05:04'),
(39, 26, 12, 11, '2024-07-01 01:26:11', '2024-07-01 01:26:11'),
(40, 26, 11, 5, '2024-07-01 01:26:11', '2024-07-01 01:26:11'),
(41, 26, 14, 25, '2024-07-01 01:26:11', '2024-07-01 01:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `exams_attempt`
--

CREATE TABLE `exams_attempt` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `marks` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `exams_attempt`
--

INSERT INTO `exams_attempt` (`id`, `exam_id`, `user_id`, `status`, `marks`, `created_at`, `updated_at`) VALUES
(23, 10, 2, 1, 1.6, '2024-06-30 21:04:03', '2024-06-30 18:24:02'),
(24, 11, 2, 1, 2, '2024-06-30 21:04:52', '2024-06-30 18:24:05'),
(25, 14, 2, 1, 3, '2024-06-30 21:05:04', '2024-06-30 18:24:29'),
(26, 11, 2, 0, 6, '2024-07-01 01:26:11', '2024-06-30 19:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('gvka7lg2@gmail.com', 'noowlbXLypFM8JMOdQJdIwT6khZ2XfpvMJPbWtMZ', '2024-06-27 09:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qna_exams`
--

CREATE TABLE `qna_exams` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `qna_exams`
--

INSERT INTO `qna_exams` (`id`, `exam_id`, `question_id`, `created_at`, `updated_at`) VALUES
(10, 4, 14, '2024-06-27 13:53:19', '2024-06-27 13:53:19'),
(11, 4, 11, '2024-06-27 15:32:41', '2024-06-27 15:32:41'),
(12, 5, 12, '2024-06-27 15:32:41', '2024-06-27 15:32:41'),
(13, 5, 12, '2024-06-27 15:34:00', '2024-06-27 15:34:00'),
(14, 6, 11, '2024-06-27 18:42:40', '2024-06-27 18:42:40'),
(15, 6, 12, '2024-06-27 18:42:40', '2024-06-27 18:42:40'),
(16, 6, 14, '2024-06-27 18:42:40', '2024-06-27 18:42:40'),
(17, 10, 11, '2024-06-27 21:01:51', '2024-06-27 21:01:51'),
(18, 10, 12, '2024-06-27 21:01:51', '2024-06-27 21:01:51'),
(19, 10, 14, '2024-06-27 21:01:51', '2024-06-27 21:01:51'),
(20, 11, 11, '2024-06-27 21:01:57', '2024-06-27 21:01:57'),
(21, 11, 12, '2024-06-27 21:01:57', '2024-06-27 21:01:57'),
(22, 11, 14, '2024-06-27 21:01:57', '2024-06-27 21:01:57'),
(23, 12, 11, '2024-06-29 15:26:42', '2024-06-29 15:26:42'),
(24, 12, 12, '2024-06-29 15:26:42', '2024-06-29 15:26:42'),
(25, 12, 14, '2024-06-29 15:26:42', '2024-06-29 15:26:42'),
(26, 13, 11, '2024-06-29 16:51:56', '2024-06-29 16:51:56'),
(27, 13, 12, '2024-06-29 16:51:56', '2024-06-29 16:51:56'),
(28, 13, 14, '2024-06-29 16:51:56', '2024-06-29 16:51:56'),
(29, 14, 11, '2024-06-29 21:04:57', '2024-06-29 21:04:57'),
(30, 14, 12, '2024-06-29 21:04:57', '2024-06-29 21:04:57'),
(31, 14, 14, '2024-06-29 21:04:57', '2024-06-29 21:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `explaination` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `explaination`, `created_at`, `updated_at`) VALUES
(11, 'Tôi là ai ?', 'vì tôi sáng tác nhac', '2024-06-24 09:51:54', '2024-07-01 09:23:43'),
(12, 'How old is he ?', 'toi sinh nam 2006', '2024-06-24 18:16:04', '2024-07-01 09:40:17'),
(14, 'Bây giờ là năm bao nhiêu ', NULL, '2024-06-25 22:01:46', '2024-06-25 22:01:46'),
(15, 'test explaination', NULL, '2024-07-01 16:15:36', '2024-07-01 16:15:36'),
(16, 'test explaination 1', 'explaination 213 test', '2024-07-01 16:16:05', '2024-07-01 09:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject`, `created_at`, `updated_at`) VALUES
(4, 'Cấu trúc dữ liệu và giải thuật', '2024-06-23 06:35:38', '2024-06-23 02:20:52'),
(5, 'Tiếng anh 1', '2024-06-23 07:52:20', '2024-06-24 00:05:40'),
(6, 'Tiếng anh 2', '2024-06-23 09:21:21', '2024-06-23 09:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Giáp Văn Khang', 'giapvankhang6789@gmail.com', NULL, 1, '$2y$10$3m/pUUhNLMtXrP6Ij/U4DO/8UMchsOgNSzw7RGCqWiIQXDbS4/Q6W', NULL, '2024-06-21 16:32:20', '2024-06-27 09:49:47'),
(2, 'Giap Khang', 'gvka7lg2@gmail.com', NULL, 0, '$2y$10$Q/IzS8vFeCR.CvKAJRklFeU./R7g31LOhKdFQr0uhUZFxjbdHcQY2', NULL, '2024-06-21 16:33:01', '2024-06-26 02:38:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams_answers`
--
ALTER TABLE `exams_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams_attempt`
--
ALTER TABLE `exams_attempt`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `qna_exams`
--
ALTER TABLE `qna_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
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
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `exams_answers`
--
ALTER TABLE `exams_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `exams_attempt`
--
ALTER TABLE `exams_attempt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qna_exams`
--
ALTER TABLE `qna_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
