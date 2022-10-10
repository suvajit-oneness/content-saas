-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2022 at 04:21 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oneness_saas_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_block` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `is_block`, `created_at`, `updated_at`) VALUES
(1, 'Content Saas Admin', 'admin@admin.com', NULL, '$2y$10$Mn3rDYjMqHppNEVGxT5gYe9MjPVWIHMLRYaPLSGAWZutv8fACYSsy', 'h0b3k1HbuzumStJ6tAlgfFGCiqXtA9jtc16DlRmPyMHhfb7dcdAfVNpHW9ga', 0, '2022-08-18 00:42:55', '2022-09-07 02:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_category_id` int(11) NOT NULL,
  `article_sub_category_id` int(11) NOT NULL,
  `article_tertiary_category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sticky_heading` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sticky_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sticky_btn` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sticky_btn_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sticky_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1: active, 0: inactive',
  `blog_status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `article_category_id`, `article_sub_category_id`, `article_tertiary_category_id`, `title`, `slug`, `image`, `content`, `meta_title`, `meta_key`, `tag`, `meta_description`, `sticky_heading`, `sticky_content`, `sticky_btn`, `sticky_btn_link`, `sticky_image`, `status`, `blog_status`, `created_at`, `updated_at`) VALUES
(1, 6, 6, 0, 'In vel metus eget neque malesuada egestas vitae ut odio.', 'in-vel-metus-eget-neque-malesuada-egestas-vitae-ut-odio', '1662919677.blog_1.png', '<div class=\"card\">\r\n<div class=\"card-body\">\r\n<h5 class=\"card-title\"><strong style=\"font-size: 14px;\">Lorem Ipsum</strong><span style=\"font-size: 14px;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></h5>\r\n</div>\r\n</div>', 'meta title', 'meta key', 'Article', '<div class=\"card\">\r\n<div class=\"card-body\">\r\n<h5 class=\"card-title\"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</h5>\r\n</div>\r\n</div>\r\n<p>&nbsp;</p>', '', '', '', '', '', 1, 1, '2022-09-11 18:07:57', '2022-09-14 08:51:00'),
(4, 7, 0, 0, 'Smart Marketing', 'smart-marketing', '1663051814.blog_2.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'meta title', 'meta key', 'advertisement', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '', '', '', '', '', 1, 2, '2022-09-13 06:50:14', '2022-09-13 06:50:14'),
(5, 7, 0, 0, 'Digital Marketing Ninja', 'digital-marketing-ninja', '1663051881.blog_4.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'meta title', 'meta key', 'advertisement', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '', '', '', '', '', 1, 0, '2022-09-13 06:51:21', '2022-09-13 06:51:21'),
(7, 7, 0, 0, 'A good advertising campaign will raise customer awareness, overall brand visibility, and at some point could even go viral.', 'a-good-advertising-campaign-will-raise-customer-awareness-overall-brand-visibility-and-at-some-point-could-even-go-viral', '1663052298.blog_1.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'meta title', 'meta key', 'advertisement', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '', '', '', '', '', 1, NULL, '2022-09-13 06:58:18', '2022-09-13 06:58:18'),
(8, 7, 0, 0, 'Career Training Video', 'career-training-video', '1663052401.blog_2.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'meta title', 'meta key', 'advertisement', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '', '', '', '', '', 1, NULL, '2022-09-13 07:00:01', '2022-09-13 07:00:01'),
(9, 4, 0, 0, 'What is Lorem Ipsum?', 'what-is-lorem-ipsum', '1663052604.blog_2.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'meta title', 'meta key', 'content', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '', '', '', '', '', 1, NULL, '2022-09-13 07:03:24', '2022-09-13 07:03:24'),
(10, 4, 0, 0, 'Where can I get some?', 'where-can-i-get-some', '1663052658.blog_3.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'meta title', 'meta key', 'content', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '', '', '', '', '', 1, NULL, '2022-09-13 07:04:18', '2022-09-13 07:04:18'),
(11, 4, 0, 0, 'Where does it come from?', 'where-does-it-come-from', '1663052701.blog_4.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'meta title', 'meta key', 'content', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '', '', '', '', '', 1, NULL, '2022-09-13 07:05:01', '2022-09-13 07:05:01'),
(12, 4, 0, 0, 'Why do we use it?', 'why-do-we-use-it', '1663052753.blog_3.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'meta title', 'meta key', 'content', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '', '', '', '', '', 1, NULL, '2022-09-13 07:05:53', '2022-09-13 07:05:53'),
(13, 4, 0, 0, 'The standard Lorem Ipsum passage, used since the 1500s', 'the-standard-lorem-ipsum-passage-used-since-the-1500s', '1663052825.blog_2.png', '<p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>', 'meta title', 'meta key', 'content', '<p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>', '', '', '', '', '', 1, NULL, '2022-09-13 07:07:05', '2022-09-13 07:07:05'),
(14, 5, 0, 0, 'What is Lorem Ipsum?', 'what-is-lorem-ipsum-2', '1663052915.blog_4.png', '<p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>', 'meta title', 'meta key', 'market', '<p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>', '', '', '', '', '', 1, NULL, '2022-09-13 07:08:35', '2022-09-13 07:08:35'),
(15, 5, 0, 0, 'Why do we use it?', 'why-do-we-use-it-2', '1663053024.blog_2.png', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'meta title', 'meta key', 'market search', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '', '', '', '', '', 1, NULL, '2022-09-13 07:10:24', '2022-09-13 07:10:24'),
(16, 3, 0, 0, 'Where can I get some?', 'where-can-i-get-some-2', '1663061103.blog_3.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'meta title', 'meta key', 'seo', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '', '', '', '', '', 1, NULL, '2022-09-13 08:22:58', '2022-09-14 08:50:38'),
(17, 3, 0, 0, 'What is Seo?', 'what-is-seo', '1663057837.blog_4.png', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'meta title', 'meta key', 'seo', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '', '', '', '', '', 1, NULL, '2022-09-13 08:30:37', '2022-09-13 08:30:37'),
(18, 6, 0, 0, 'Where can I get some?', 'where-can-i-get-some-3', '1663145191.blog_3.png', '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', 'meta title', 'meta key', 'SMM', '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:46:31', '2022-09-14 08:46:31'),
(19, 6, 0, 0, 'What is Lorem ipsum', 'what-is-lorem-ipsum', '1663145240.blog_2.png', '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', 'meta title', 'meta key', 'SMM', '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:47:20', '2022-09-14 08:47:20'),
(20, 6, 0, 0, 'what is SMM', 'what-is-smm', '1663145278.blog_2.png', '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', 'meta title', 'meta key', 'SMM', '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:47:58', '2022-09-14 08:47:58'),
(21, 6, 0, 0, 'what is lorem ipsum?', 'what-is-lorem-ipsum-3', '1663145313.blog_4.png', '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', 'meta title', 'meta key', 'SMM', '<p><em>Lorem ipsum</em>&nbsp;is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:48:33', '2022-09-14 08:48:33'),
(22, 6, 0, 0, 'Creation timelines for the standard lorem ipsum passage vary', 'creation-timelines-for-the-standard-lorem-ipsum-passage-vary', '1663145370.blog_1.png', '<p>So how did the classical Latin become so incoherent? According to McClintock, a 15th century typesetter likely scrambled part of Cicero\'s&nbsp;<em>De Finibus</em>&nbsp;in order to provide placeholder text to mockup various fonts for a type specimen book.</p>', 'meta title', 'meta key', 'SMM', '<p>So how did the classical Latin become so incoherent? According to McClintock, a 15th century typesetter likely scrambled part of Cicero\'s&nbsp;<em>De Finibus</em>&nbsp;in order to provide placeholder text to mockup various fonts for a type specimen book.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:49:30', '2022-09-14 08:49:30'),
(23, 6, 0, 0, 'Creation timelines for the standard lorem ipsum passage vary', 'creation-timelines-for-the-standard-lorem-ipsum-passage-vary-2', '1663145401.blog_4.png', '<p>So how did the classical Latin become so incoherent? According to McClintock, a 15th century typesetter likely scrambled part of Cicero\'s&nbsp;<em>De Finibus</em>&nbsp;in order to provide placeholder text to mockup various fonts for a type specimen book.</p>', 'meta title', 'meta key', 'SMM', '<p>So how did the classical Latin become so incoherent? According to McClintock, a 15th century typesetter likely scrambled part of Cicero\'s&nbsp;<em>De Finibus</em>&nbsp;in order to provide placeholder text to mockup various fonts for a type specimen book.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:50:01', '2022-09-14 08:50:01'),
(24, 6, 0, 0, 'In vel metus eget neque malesuada egestas vitae ut odio.', 'in-vel-metus-eget-neque-malesuada-egestas-vitae-ut-odio-2', '1663145525.blog_3.png', '<p>It\'s difficult to find examples of&nbsp;<em>lorem ipsum</em>&nbsp;in use before Letraset made it popular as a dummy text in the 1960s, although McClintock says he remembers coming across the&nbsp;<em>lorem ipsum</em>&nbsp;passage in a book of old metal type samples. So far he hasn\'t relocated where he once saw the passage, but the popularity of Cicero in the 15th century supports the theory that the filler text has been used for centuries.</p>', 'meta title', 'meta key', 'SMM', '<p>It\'s difficult to find examples of&nbsp;<em>lorem ipsum</em>&nbsp;in use before Letraset made it popular as a dummy text in the 1960s, although McClintock says he remembers coming across the&nbsp;<em>lorem ipsum</em>&nbsp;passage in a book of old metal type samples. So far he hasn\'t relocated where he once saw the passage, but the popularity of Cicero in the 15th century supports the theory that the filler text has been used for centuries.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:52:05', '2022-09-14 08:52:05'),
(25, 6, 0, 0, 'In vel metus eget neque malesuada egestas vitae ut odio.', 'in-vel-metus-eget-neque-malesuada-egestas-vitae-ut-odio-3', '1663145539.blog_2.png', '<p>It\'s difficult to find examples of&nbsp;<em>lorem ipsum</em>&nbsp;in use before Letraset made it popular as a dummy text in the 1960s, although McClintock says he remembers coming across the&nbsp;<em>lorem ipsum</em>&nbsp;passage in a book of old metal type samples. So far he hasn\'t relocated where he once saw the passage, but the popularity of Cicero in the 15th century supports the theory that the filler text has been used for centuries.</p>', 'meta title', 'meta key', 'SMM', '<p>It\'s difficult to find examples of&nbsp;<em>lorem ipsum</em>&nbsp;in use before Letraset made it popular as a dummy text in the 1960s, although McClintock says he remembers coming across the&nbsp;<em>lorem ipsum</em>&nbsp;passage in a book of old metal type samples. So far he hasn\'t relocated where he once saw the passage, but the popularity of Cicero in the 15th century supports the theory that the filler text has been used for centuries.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:52:19', '2022-09-14 08:52:19'),
(26, 6, 0, 0, 'McClintock wrote to Before & After to explain his discovery', 'mcclintock-wrote-to-before-after-to-explain-his-discovery', '1663145736.blog_1.png', '<p>So how did the classical Latin become so incoherent? According to McClintock, a 15th century typesetter likely scrambled part of Cicero\'s&nbsp;<em>De Finibus</em>&nbsp;in order to provide placeholder text to mockup various fonts for a type specimen book.</p>', 'meta title', 'meta key', 'SMM', '<p>So how did the classical Latin become so incoherent? According to McClintock, a 15th century typesetter likely scrambled part of Cicero\'s&nbsp;<em>De Finibus</em>&nbsp;in order to provide placeholder text to mockup various fonts for a type specimen book.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:55:36', '2022-09-14 08:55:36'),
(27, 6, 0, 0, 'In vel metus eget neque malesuada egestas vitae ut odio.', 'in-vel-metus-eget-neque-malesuada-egestas-vitae-ut-odio-4', '1663145778.blog_4.png', '<p>So how did the classical Latin become so incoherent? According to McClintock, a 15th century typesetter likely scrambled part of Cicero\'s&nbsp;<em>De Finibus</em>&nbsp;in order to provide placeholder text to mockup various fonts for a type specimen book.</p>', 'meta title', 'meta key', 'SMM', '<p>So how did the classical Latin become so incoherent? According to McClintock, a 15th century typesetter likely scrambled part of Cicero\'s&nbsp;<em>De Finibus</em>&nbsp;in order to provide placeholder text to mockup various fonts for a type specimen book.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:56:18', '2022-09-14 08:56:18'),
(28, 6, 0, 0, 'In vel metus eget neque malesuada egestas vitae ut odio.', 'in-vel-metus-eget-neque-malesuada-egestas-vitae-ut-odio-5', '1663145902.blog_1.png', '<p>So how did the classical Latin become so incoherent? According to McClintock, a 15th century typesetter likely scrambled part of Cicero\'s&nbsp;<em>De Finibus</em>&nbsp;in order to provide placeholder text to mockup various fonts for a type specimen book.</p>', 'meta title', 'meta key', 'SMM', '<p>So how did the classical Latin become so incoherent? According to McClintock, a 15th century typesetter likely scrambled part of Cicero\'s&nbsp;<em>De Finibus</em>&nbsp;in order to provide placeholder text to mockup various fonts for a type specimen book.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:58:22', '2022-09-14 08:58:22'),
(29, 6, 0, 0, 'In vel metus eget neque malesuada egestas vitae ut odio.', 'in-vel-metus-eget-neque-malesuada-egestas-vitae-ut-odio-6', '1663145915.blog_3.png', '<p>So how did the classical Latin become so incoherent? According to McClintock, a 15th century typesetter likely scrambled part of Cicero\'s&nbsp;<em>De Finibus</em>&nbsp;in order to provide placeholder text to mockup various fonts for a type specimen book.</p>', 'meta title', 'meta key', 'SMM', '<p>So how did the classical Latin become so incoherent? According to McClintock, a 15th century typesetter likely scrambled part of Cicero\'s&nbsp;<em>De Finibus</em>&nbsp;in order to provide placeholder text to mockup various fonts for a type specimen book.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:58:35', '2022-09-14 08:58:35'),
(30, 6, 0, 0, 'Lorem ipsum was purposefully designed to have no meaning', 'lorem-ipsum-was-purposefully-designed-to-have-no-meaning', '1663145986.blog_4.png', '<p>Don\'t bother typing &ldquo;lorem ipsum&rdquo; into Google translate. If you already tried, you may have gotten&nbsp;<a title=\"Krebs on Security &ndash; Lorem Ipsum: Of Good &amp; Evil, Google &amp; China\" href=\"https://krebsonsecurity.com/2014/08/lorem-ipsum-of-good-evil-google-china/\" target=\"_blank\" rel=\"noopener\">anything from \"NATO\" to \"China\"</a>, depending on how you capitalized the letters. The bizarre translation was fodder for conspiracy theories, but Google has since updated its &ldquo;lorem ipsum&rdquo; translation to, boringly enough, &ldquo;lorem ipsum&rdquo;.</p>', 'meta title', 'meta key', 'SMM', '<p>Don\'t bother typing &ldquo;lorem ipsum&rdquo; into Google translate. If you already tried, you may have gotten&nbsp;<a title=\"Krebs on Security &ndash; Lorem Ipsum: Of Good &amp; Evil, Google &amp; China\" href=\"https://krebsonsecurity.com/2014/08/lorem-ipsum-of-good-evil-google-china/\" target=\"_blank\" rel=\"noopener\">anything from \"NATO\" to \"China\"</a>, depending on how you capitalized the letters. The bizarre translation was fodder for conspiracy theories, but Google has since updated its &ldquo;lorem ipsum&rdquo; translation to, boringly enough, &ldquo;lorem ipsum&rdquo;.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 08:59:46', '2022-09-14 08:59:46'),
(31, 6, 0, 0, 'Lorem ipsum was purposefully designed to have no meaning', 'lorem-ipsum-was-purposefully-designed-to-have-no-meaning-2', '1663146000.blog_2.png', '<p>Don\'t bother typing &ldquo;lorem ipsum&rdquo; into Google translate. If you already tried, you may have gotten&nbsp;<a title=\"Krebs on Security &ndash; Lorem Ipsum: Of Good &amp; Evil, Google &amp; China\" href=\"https://krebsonsecurity.com/2014/08/lorem-ipsum-of-good-evil-google-china/\" target=\"_blank\" rel=\"noopener\">anything from \"NATO\" to \"China\"</a>, depending on how you capitalized the letters. The bizarre translation was fodder for conspiracy theories, but Google has since updated its &ldquo;lorem ipsum&rdquo; translation to, boringly enough, &ldquo;lorem ipsum&rdquo;.</p>', 'meta title', 'meta key', 'SMM', '<p>Don\'t bother typing &ldquo;lorem ipsum&rdquo; into Google translate. If you already tried, you may have gotten&nbsp;<a title=\"Krebs on Security &ndash; Lorem Ipsum: Of Good &amp; Evil, Google &amp; China\" href=\"https://krebsonsecurity.com/2014/08/lorem-ipsum-of-good-evil-google-china/\" target=\"_blank\" rel=\"noopener\">anything from \"NATO\" to \"China\"</a>, depending on how you capitalized the letters. The bizarre translation was fodder for conspiracy theories, but Google has since updated its &ldquo;lorem ipsum&rdquo; translation to, boringly enough, &ldquo;lorem ipsum&rdquo;.</p>', '', '', '', '', '', 1, NULL, '2022-09-14 09:00:00', '2022-09-14 09:00:00'),
(32, 3, 0, 0, 'Why do we use SEO', 'why-do-we-use-seo', '1663172573.pexels-hamann-la-947785.jpg', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'test  meta title', 'test meta keys', 'test tag 1, test tag 2', '<p>tset meta description</p>', '', '', '', '', '', 1, NULL, '2022-09-14 16:22:53', '2022-09-14 16:23:51'),
(33, 7, 0, 0, 'From its medieval origins to the digital era', 'from-its-medieval-origins-to-the-digital-era', '1663172751.blog_1.png', '<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with</p>', 'meta title', '', '', '<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with</p>', '', '', '', '', '', 1, NULL, '2022-09-14 16:25:51', '2022-09-14 16:25:51'),
(34, 7, 0, 0, 'From its medieval origins to the digital era', 'from-its-medieval-origins-to-the-digital-era-2', '1663172821.blog_2.png', '<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with</p>', 'meta title', 'meta key', 'Advertisement', '<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with</p>', '', '', '', '', '', 1, NULL, '2022-09-14 16:27:01', '2022-09-14 16:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

CREATE TABLE `article_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`id`, `title`, `slug`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Seo', 'seo', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type', '1663050758.blog-post.png', 1, '2022-09-13 06:31:52', '2022-09-13 06:32:38'),
(4, 'Content', 'content', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type', '1663050794.blog-post.png', 1, '2022-09-13 06:33:14', '2022-09-13 06:33:14'),
(5, 'Market Research', 'market-research', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type', '1663050822.blog-post.png', 1, '2022-09-13 06:33:42', '2022-09-13 06:33:42'),
(6, 'SMM & SERM', 'smm-serm', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type', '1663050846.blog-post.png', 1, '2022-09-13 06:34:06', '2022-09-13 06:34:06'),
(7, 'Advertising', 'advertising', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type', '1663050869.blog-post.png', 1, '2022-09-13 06:34:29', '2022-09-13 06:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `article_subcategories`
--

CREATE TABLE `article_subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_subcategories`
--

INSERT INTO `article_subcategories` (`id`, `category_id`, `title`, `slug`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 'test sub category', 'test-sub-category', '<p>Lorem ipsum ipsum</p>', NULL, 1, NULL, '2022-09-09 05:23:24');

-- --------------------------------------------------------

--
-- Table structure for table `article_tags`
--

CREATE TABLE `article_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` int(11) NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_tertiary_categories`
--

CREATE TABLE `article_tertiary_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` bigint(20) NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(10,2) NOT NULL DEFAULT 0.00,
  `offer_price` double(10,2) NOT NULL DEFAULT 0.00,
  `qty` int(11) NOT NULL DEFAULT 1,
  `coupon_code_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `ip`, `user_id`, `course_id`, `course_name`, `course_image`, `course_slug`, `author_name`, `price`, `offer_price`, `qty`, `coupon_code_id`, `status`, `created_at`, `updated_at`) VALUES
(2, '103.75.162.68', NULL, 1, 'Mastering Digital PR with Brian Dean', NULL, 'mastering-digital-pr-with-brian-dean', 'https://demo91.co.in/laravel-only/ContentSaas/public/Robert', 3999.00, 0.00, 1, NULL, 1, '2022-09-12 13:12:55', '2022-10-09 07:22:46'),
(3, '157.40.116.7', NULL, 1, 'Mastering Digital PR with Brian Dean', NULL, 'mastering-digital-pr-with-brian-dean', 'Robert', 3999.00, 0.00, 1, NULL, 1, '2022-09-14 06:18:54', '2022-10-09 07:22:46'),
(5, '49.37.45.73', NULL, 2, 'Why do we use it', NULL, 'why-do-we-use-it', 'test author', 0.00, 0.00, 1, NULL, 1, '2022-09-14 16:28:35', '2022-10-09 07:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `certificate_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `user_id`, `certificate_title`, `certificate_type`, `file`, `short_desc`, `long_desc`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'SEO Expert', 'Search Engine Optimisation', '', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Placeat atque, veniam nobis sit modi eum molestiae voluptatibus. Mollitia possimus id harum cum pariatur dolores, iste ut est quos facere enim!', '', '', '2022-09-11 13:12:52', '2022-10-09 07:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `client_name`, `occupation`, `phone_number`, `email_id`, `image`, `short_desc`, `long_desc`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mathew Perry', 'Manager at Dell', '', '', 'frontend/img/writer5.png', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab excepturi ea doloribus laudantium maxime eius autem dignissimos necessitatibus debitis exercitationem ducimus officiis, explicabo, iusto odio libero eligendi nemo aperiam quos.', '', '', '2022-09-11 13:38:12', '2022-10-09 07:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `phone_code` int(11) NOT NULL,
  `country_code` char(2) NOT NULL,
  `country_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `phone_code`, `country_code`, `country_name`) VALUES
(1, 93, 'AF', 'Afghanistan'),
(2, 358, 'AX', 'Aland Islands'),
(3, 355, 'AL', 'Albania'),
(4, 213, 'DZ', 'Algeria'),
(5, 1684, 'AS', 'American Samoa'),
(6, 376, 'AD', 'Andorra'),
(7, 244, 'AO', 'Angola'),
(8, 1264, 'AI', 'Anguilla'),
(9, 672, 'AQ', 'Antarctica'),
(10, 1268, 'AG', 'Antigua and Barbuda'),
(11, 54, 'AR', 'Argentina'),
(12, 374, 'AM', 'Armenia'),
(13, 297, 'AW', 'Aruba'),
(14, 61, 'AU', 'Australia'),
(15, 43, 'AT', 'Austria'),
(16, 994, 'AZ', 'Azerbaijan'),
(17, 1242, 'BS', 'Bahamas'),
(18, 973, 'BH', 'Bahrain'),
(19, 880, 'BD', 'Bangladesh'),
(20, 1246, 'BB', 'Barbados'),
(21, 375, 'BY', 'Belarus'),
(22, 32, 'BE', 'Belgium'),
(23, 501, 'BZ', 'Belize'),
(24, 229, 'BJ', 'Benin'),
(25, 1441, 'BM', 'Bermuda'),
(26, 975, 'BT', 'Bhutan'),
(27, 591, 'BO', 'Bolivia'),
(28, 599, 'BQ', 'Bonaire, Sint Eustatius and Saba'),
(29, 387, 'BA', 'Bosnia and Herzegovina'),
(30, 267, 'BW', 'Botswana'),
(31, 55, 'BV', 'Bouvet Island'),
(32, 55, 'BR', 'Brazil'),
(33, 246, 'IO', 'British Indian Ocean Territory'),
(34, 673, 'BN', 'Brunei Darussalam'),
(35, 359, 'BG', 'Bulgaria'),
(36, 226, 'BF', 'Burkina Faso'),
(37, 257, 'BI', 'Burundi'),
(38, 855, 'KH', 'Cambodia'),
(39, 237, 'CM', 'Cameroon'),
(40, 1, 'CA', 'Canada'),
(41, 238, 'CV', 'Cape Verde'),
(42, 1345, 'KY', 'Cayman Islands'),
(43, 236, 'CF', 'Central African Republic'),
(44, 235, 'TD', 'Chad'),
(45, 56, 'CL', 'Chile'),
(46, 86, 'CN', 'China'),
(47, 61, 'CX', 'Christmas Island'),
(48, 672, 'CC', 'Cocos (Keeling) Islands'),
(49, 57, 'CO', 'Colombia'),
(50, 269, 'KM', 'Comoros'),
(51, 242, 'CG', 'Congo'),
(52, 242, 'CD', 'Congo, Democratic Republic of the Congo'),
(53, 682, 'CK', 'Cook Islands'),
(54, 506, 'CR', 'Costa Rica'),
(55, 225, 'CI', 'Cote D\'Ivoire'),
(56, 385, 'HR', 'Croatia'),
(57, 53, 'CU', 'Cuba'),
(58, 599, 'CW', 'Curacao'),
(59, 357, 'CY', 'Cyprus'),
(60, 420, 'CZ', 'Czech Republic'),
(61, 45, 'DK', 'Denmark'),
(62, 253, 'DJ', 'Djibouti'),
(63, 1767, 'DM', 'Dominica'),
(64, 1809, 'DO', 'Dominican Republic'),
(65, 593, 'EC', 'Ecuador'),
(66, 20, 'EG', 'Egypt'),
(67, 503, 'SV', 'El Salvador'),
(68, 240, 'GQ', 'Equatorial Guinea'),
(69, 291, 'ER', 'Eritrea'),
(70, 372, 'EE', 'Estonia'),
(71, 251, 'ET', 'Ethiopia'),
(72, 500, 'FK', 'Falkland Islands (Malvinas)'),
(73, 298, 'FO', 'Faroe Islands'),
(74, 679, 'FJ', 'Fiji'),
(75, 358, 'FI', 'Finland'),
(76, 33, 'FR', 'France'),
(77, 594, 'GF', 'French Guiana'),
(78, 689, 'PF', 'French Polynesia'),
(79, 262, 'TF', 'French Southern Territories'),
(80, 241, 'GA', 'Gabon'),
(81, 220, 'GM', 'Gambia'),
(82, 995, 'GE', 'Georgia'),
(83, 49, 'DE', 'Germany'),
(84, 233, 'GH', 'Ghana'),
(85, 350, 'GI', 'Gibraltar'),
(86, 30, 'GR', 'Greece'),
(87, 299, 'GL', 'Greenland'),
(88, 1473, 'GD', 'Grenada'),
(89, 590, 'GP', 'Guadeloupe'),
(90, 1671, 'GU', 'Guam'),
(91, 502, 'GT', 'Guatemala'),
(92, 44, 'GG', 'Guernsey'),
(93, 224, 'GN', 'Guinea'),
(94, 245, 'GW', 'Guinea-Bissau'),
(95, 592, 'GY', 'Guyana'),
(96, 509, 'HT', 'Haiti'),
(97, 0, 'HM', 'Heard Island and Mcdonald Islands'),
(98, 39, 'VA', 'Holy See (Vatican City State)'),
(99, 504, 'HN', 'Honduras'),
(100, 852, 'HK', 'Hong Kong'),
(101, 36, 'HU', 'Hungary'),
(102, 354, 'IS', 'Iceland'),
(103, 91, 'IN', 'India'),
(104, 62, 'ID', 'Indonesia'),
(105, 98, 'IR', 'Iran, Islamic Republic of'),
(106, 964, 'IQ', 'Iraq'),
(107, 353, 'IE', 'Ireland'),
(108, 44, 'IM', 'Isle of Man'),
(109, 972, 'IL', 'Israel'),
(110, 39, 'IT', 'Italy'),
(111, 1876, 'JM', 'Jamaica'),
(112, 81, 'JP', 'Japan'),
(113, 44, 'JE', 'Jersey'),
(114, 962, 'JO', 'Jordan'),
(115, 7, 'KZ', 'Kazakhstan'),
(116, 254, 'KE', 'Kenya'),
(117, 686, 'KI', 'Kiribati'),
(118, 850, 'KP', 'Korea, Democratic People\'s Republic of'),
(119, 82, 'KR', 'Korea, Republic of'),
(120, 381, 'XK', 'Kosovo'),
(121, 965, 'KW', 'Kuwait'),
(122, 996, 'KG', 'Kyrgyzstan'),
(123, 856, 'LA', 'Lao People\'s Democratic Republic'),
(124, 371, 'LV', 'Latvia'),
(125, 961, 'LB', 'Lebanon'),
(126, 266, 'LS', 'Lesotho'),
(127, 231, 'LR', 'Liberia'),
(128, 218, 'LY', 'Libyan Arab Jamahiriya'),
(129, 423, 'LI', 'Liechtenstein'),
(130, 370, 'LT', 'Lithuania'),
(131, 352, 'LU', 'Luxembourg'),
(132, 853, 'MO', 'Macao'),
(133, 389, 'MK', 'Macedonia, the Former Yugoslav Republic of'),
(134, 261, 'MG', 'Madagascar'),
(135, 265, 'MW', 'Malawi'),
(136, 60, 'MY', 'Malaysia'),
(137, 960, 'MV', 'Maldives'),
(138, 223, 'ML', 'Mali'),
(139, 356, 'MT', 'Malta'),
(140, 692, 'MH', 'Marshall Islands'),
(141, 596, 'MQ', 'Martinique'),
(142, 222, 'MR', 'Mauritania'),
(143, 230, 'MU', 'Mauritius'),
(144, 269, 'YT', 'Mayotte'),
(145, 52, 'MX', 'Mexico'),
(146, 691, 'FM', 'Micronesia, Federated States of'),
(147, 373, 'MD', 'Moldova, Republic of'),
(148, 377, 'MC', 'Monaco'),
(149, 976, 'MN', 'Mongolia'),
(150, 382, 'ME', 'Montenegro'),
(151, 1664, 'MS', 'Montserrat'),
(152, 212, 'MA', 'Morocco'),
(153, 258, 'MZ', 'Mozambique'),
(154, 95, 'MM', 'Myanmar'),
(155, 264, 'NA', 'Namibia'),
(156, 674, 'NR', 'Nauru'),
(157, 977, 'NP', 'Nepal'),
(158, 31, 'NL', 'Netherlands'),
(159, 599, 'AN', 'Netherlands Antilles'),
(160, 687, 'NC', 'New Caledonia'),
(161, 64, 'NZ', 'New Zealand'),
(162, 505, 'NI', 'Nicaragua'),
(163, 227, 'NE', 'Niger'),
(164, 234, 'NG', 'Nigeria'),
(165, 683, 'NU', 'Niue'),
(166, 672, 'NF', 'Norfolk Island'),
(167, 1670, 'MP', 'Northern Mariana Islands'),
(168, 47, 'NO', 'Norway'),
(169, 968, 'OM', 'Oman'),
(170, 92, 'PK', 'Pakistan'),
(171, 680, 'PW', 'Palau'),
(172, 970, 'PS', 'Palestinian Territory, Occupied'),
(173, 507, 'PA', 'Panama'),
(174, 675, 'PG', 'Papua New Guinea'),
(175, 595, 'PY', 'Paraguay'),
(176, 51, 'PE', 'Peru'),
(177, 63, 'PH', 'Philippines'),
(178, 64, 'PN', 'Pitcairn'),
(179, 48, 'PL', 'Poland'),
(180, 351, 'PT', 'Portugal'),
(181, 1787, 'PR', 'Puerto Rico'),
(182, 974, 'QA', 'Qatar'),
(183, 262, 'RE', 'Reunion'),
(184, 40, 'RO', 'Romania'),
(185, 70, 'RU', 'Russian Federation'),
(186, 250, 'RW', 'Rwanda'),
(187, 590, 'BL', 'Saint Barthelemy'),
(188, 290, 'SH', 'Saint Helena'),
(189, 1869, 'KN', 'Saint Kitts and Nevis'),
(190, 1758, 'LC', 'Saint Lucia'),
(191, 590, 'MF', 'Saint Martin'),
(192, 508, 'PM', 'Saint Pierre and Miquelon'),
(193, 1784, 'VC', 'Saint Vincent and the Grenadines'),
(194, 684, 'WS', 'Samoa'),
(195, 378, 'SM', 'San Marino'),
(196, 239, 'ST', 'Sao Tome and Principe'),
(197, 966, 'SA', 'Saudi Arabia'),
(198, 221, 'SN', 'Senegal'),
(199, 381, 'RS', 'Serbia'),
(200, 381, 'CS', 'Serbia and Montenegro'),
(201, 248, 'SC', 'Seychelles'),
(202, 232, 'SL', 'Sierra Leone'),
(203, 65, 'SG', 'Singapore'),
(204, 1, 'SX', 'Sint Maarten'),
(205, 421, 'SK', 'Slovakia'),
(206, 386, 'SI', 'Slovenia'),
(207, 677, 'SB', 'Solomon Islands'),
(208, 252, 'SO', 'Somalia'),
(209, 27, 'ZA', 'South Africa'),
(210, 500, 'GS', 'South Georgia and the South Sandwich Islands'),
(211, 211, 'SS', 'South Sudan'),
(212, 34, 'ES', 'Spain'),
(213, 94, 'LK', 'Sri Lanka'),
(214, 249, 'SD', 'Sudan'),
(215, 597, 'SR', 'Suriname'),
(216, 47, 'SJ', 'Svalbard and Jan Mayen'),
(217, 268, 'SZ', 'Swaziland'),
(218, 46, 'SE', 'Sweden'),
(219, 41, 'CH', 'Switzerland'),
(220, 963, 'SY', 'Syrian Arab Republic'),
(221, 886, 'TW', 'Taiwan, Province of China'),
(222, 992, 'TJ', 'Tajikistan'),
(223, 255, 'TZ', 'Tanzania, United Republic of'),
(224, 66, 'TH', 'Thailand'),
(225, 670, 'TL', 'Timor-Leste'),
(226, 228, 'TG', 'Togo'),
(227, 690, 'TK', 'Tokelau'),
(228, 676, 'TO', 'Tonga'),
(229, 1868, 'TT', 'Trinidad and Tobago'),
(230, 216, 'TN', 'Tunisia'),
(231, 90, 'TR', 'Turkey'),
(232, 7370, 'TM', 'Turkmenistan'),
(233, 1649, 'TC', 'Turks and Caicos Islands'),
(234, 688, 'TV', 'Tuvalu'),
(235, 256, 'UG', 'Uganda'),
(236, 380, 'UA', 'Ukraine'),
(237, 971, 'AE', 'United Arab Emirates'),
(238, 44, 'GB', 'United Kingdom'),
(239, 1, 'US', 'United States'),
(240, 1, 'UM', 'United States Minor Outlying Islands'),
(241, 598, 'UY', 'Uruguay'),
(242, 998, 'UZ', 'Uzbekistan'),
(243, 678, 'VU', 'Vanuatu'),
(244, 58, 'VE', 'Venezuela'),
(245, 84, 'VN', 'Viet Nam'),
(246, 1284, 'VG', 'Virgin Islands, British'),
(247, 1340, 'VI', 'Virgin Islands, U.s.'),
(248, 681, 'WF', 'Wallis and Futuna'),
(249, 212, 'EH', 'Western Sahara'),
(250, 967, 'YE', 'Yemen'),
(251, 260, 'ZM', 'Zambia'),
(252, 263, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key_module` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirements` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `short_description`, `description`, `category_id`, `topic`, `key_module`, `course_content`, `certificate`, `requirements`, `image`, `target`, `language`, `company_name`, `company_description`, `author_name`, `author_description`, `author_image`, `price`, `type`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Why do we use it', 'why-do-we-use-it', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here,', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opp</p>', 1, NULL, NULL, NULL, NULL, '', '1663172868.pexels-hamann-la-947785.jpg', '', 'spanish', 'test company', 'Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'test author', '<p>Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '1663172868.7.jpg', 0, '2', 1, '2022-09-14 16:27:48', '2022-10-06 07:39:53'),
(3, 'qwerty', 'qwerty', NULL, 'qwertyuiopffffffffffff', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/courses/633ed366043a422-10-06-01-08-54.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-10-06 07:38:54', '2022-10-06 07:40:05'),
(5, 'New Course', 'new-course', NULL, 'New Latest Course description', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/courses/6342d79621e0a22-10-09-02-15-50.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-10-09 08:45:50', '2022-10-09 08:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `course_categories`
--

CREATE TABLE `course_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_categories`
--

INSERT INTO `course_categories` (`id`, `title`, `slug`, `content`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CONTENT MARKETING', 'content-marketing', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolo', '1662841657.agreement.png', 1, '2022-09-10 20:27:37', '2022-09-10 20:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `course_lessons`
--

CREATE TABLE `course_lessons` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_lessons`
--

INSERT INTO `course_lessons` (`id`, `course_id`, `lesson_id`, `created_at`) VALUES
(2, 2, 1, '2022-10-09 13:58:01'),
(5, 5, 9, '2022-10-09 14:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `course_modules`
--

CREATE TABLE `course_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_modules`
--

INSERT INTO `course_modules` (`id`, `course_id`, `title`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Create a fully-fledged blog from scratch on', 'create-a-fully-fledged-blog-from-scratch-on-any-subjectdivd', '', 1, '2022-09-13 11:25:57', '2022-09-13 11:25:57'),
(2, 1, 'Getting Started', 'getting-started', '', 1, '2022-09-13 11:37:36', '2022-09-13 11:37:36'),
(3, 1, 'Setting Up Your Blog', 'setting-up-your-blog', '', 1, '2022-09-13 11:38:49', '2022-09-13 11:38:49'),
(4, 1, 'Creating Headers and Logos', 'creating-headers-and-logos', '', 1, '2022-09-13 11:39:47', '2022-09-13 11:39:47'),
(5, 1, 'Writing Posts and Creating Pages', 'writing-posts-and-creating-pages', '', 1, '2022-09-13 11:40:28', '2022-09-13 11:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `course_quizzes`
--

CREATE TABLE `course_quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optionA` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optionB` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optionC` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `optionD` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `right_answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_slides`
--

CREATE TABLE `course_slides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `slide_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_slides`
--

INSERT INTO `course_slides` (`id`, `topic_id`, `slide_content`, `file`, `duration`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type', NULL, NULL, NULL, 1, '2022-09-11 08:41:55', '2022-09-11 08:41:55'),
(2, 1, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.<video controls=\"controls\" width=\"380\" height=\"190\">\r\n<source src=\"//www.youtube.com/embed/1u_QKOrXyMM\" /></video></p>', NULL, NULL, NULL, 1, '2022-09-13 12:47:56', '2022-09-13 12:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `course_testimonials`
--

CREATE TABLE `course_testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_topics`
--

CREATE TABLE `course_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assignment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assignment_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_topics`
--

INSERT INTO `course_topics` (`id`, `course_id`, `module_id`, `topic`, `slug`, `assignment`, `assignment_file`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '<div class=\"section--row--3PNBT\"><span class=\"section--item-title--2k1DQ\">The Potential and what Can be Achieved with a Blog</span></div>\r\n<p>&nbsp;</p>', 'div-classsection-row-3pnbtspan-classsection-item-title-2k1dqthe-potential-and-what-can-be-achieved-with-a-blogspandivdiv-classudlite-text-sm-section-hidden-on-mobile-171q9-section-item-description-1cyti-data-purposesafely-set-inner-htmlsectionlecture-desc', NULL, NULL, 1, '2022-09-13 11:29:55', '2022-09-13 12:09:53'),
(2, 1, 1, '<p>what is lorem ipsum?</p>', 'pwhat-is-lorem-ipsump', NULL, NULL, 1, '2022-09-13 11:59:23', '2022-09-13 11:59:23'),
(3, 1, 1, '<p>what is lorem ipsum?</p>', 'pwhat-is-lorem-ipsump-2', NULL, NULL, 1, '2022-09-13 11:59:43', '2022-09-13 11:59:43'),
(4, 1, 1, '<p>what is lorem ipsum?</p>', 'pwhat-is-lorem-ipsump-2', NULL, NULL, 1, '2022-09-13 11:59:51', '2022-09-13 11:59:51'),
(5, 1, 1, '<p>what is lorem ipsum?</p>', 'pwhat-is-lorem-ipsump-2', NULL, NULL, 1, '2022-09-13 12:00:53', '2022-09-13 12:00:53');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `college_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'college/ school',
  `year_from` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_to` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `user_id`, `degree`, `college_name`, `year_from`, `year_to`, `position`, `score`, `email_id`, `image`, `short_desc`, `long_desc`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'Marketing', 'Chartland institute of marketing', '2012', '2016', 3, '', '', '', '', '', '', '2022-09-11 13:22:09', '2022-10-09 07:22:47'),
(2, 1, 'Schooling', 'JN Roy School', '2000', '2010', 1, '', '', '', '', '', '', '2022-09-11 13:23:20', '2022-10-09 07:22:47'),
(3, 1, 'College', 'RERF', '2011', '2012', 2, '', '', '', '', '', '', '2022-09-11 13:23:48', '2022-10-09 07:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `employments`
--

CREATE TABLE `employments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `company_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_from` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_to` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namager_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employments`
--

INSERT INTO `employments` (`id`, `user_id`, `company_title`, `occupation`, `year_from`, `year_to`, `phone_number`, `email_id`, `image`, `owner_name`, `namager_name`, `short_desc`, `long_desc`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bough Digital', 'Managing Director', 'January 2010', 'Present', '', '', '', '', '', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi labore ea velit minus odit vero enim inventore consequuntur quis, voluptas cumque ipsam neque et perferendis non obcaecati repellendus repellat dicta.', '', '', '2022-09-11 13:49:23', '2022-10-09 07:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` decimal(10,6) DEFAULT NULL,
  `lon` decimal(10,6) DEFAULT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_type` int(11) NOT NULL DEFAULT 1 COMMENT '1: online, 2: in-person',
  `online_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_id` int(11) DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `format_id` int(11) DEFAULT NULL,
  `is_paid` int(11) NOT NULL DEFAULT 0,
  `event_cost` double(8,2) DEFAULT NULL,
  `is_recurring` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_followers` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `slug`, `event_type`, `image`, `address`, `lat`, `lon`, `pin`, `location`, `start_date`, `end_date`, `start_time`, `end_time`, `description`, `content_type`, `online_link`, `event_link`, `business_id`, `contact_email`, `contact_phone`, `event_host`, `language_id`, `format_id`, `is_paid`, `event_cost`, `is_recurring`, `no_of_followers`, `status`, `created_at`, `updated_at`) VALUES
(1, 'In vel metus eget neque malesuada egestas vitae ut odio.', 'in-vel-metus-eget-neque-malesuada-egestas-vitae-ut-odio', 1, '1662920942.blog_3.png', NULL, NULL, NULL, NULL, 'Kolkata', '2022-09-17', '2022-09-17', '16:00', '17:00', '<div class=\"card\">\r\n<div class=\"card-body\">\r\n<h5 class=\"card-title\">In vel metus eget neque malesuada egestas vitae ut odio.</h5>\r\n</div>\r\n</div>\r\n<p>&nbsp;</p>', 1, '', 'www.event.com', NULL, NULL, '', 'test', NULL, NULL, 0, 0.00, '0', 0, 1, '2022-09-11 18:29:02', '2022-09-11 18:29:02'),
(2, 'What is Lorem Ipsum', 'what-is-lorem-ipsum', 3, '1663172372.pexels-mohamed-almari-368893.jpg', NULL, NULL, NULL, NULL, 'australia', '2022-09-30', '2022-10-08', '21:48', '10:50', '<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 1, '', 'https://www.lipsum.com/', NULL, NULL, '', 'test host', NULL, NULL, 0, 0.00, '0', 0, 1, '2022-09-14 16:19:32', '2022-09-14 16:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE `event_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'conference', 'conference', 1, '2022-09-09 06:27:20', '2022-09-09 07:19:31'),
(2, 'marketing', 'marketing', 1, '2022-09-13 08:25:38', '2022-09-13 08:25:38'),
(3, 'test', 'test', 1, '2022-09-14 16:17:47', '2022-09-19 07:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp(5) NOT NULL DEFAULT current_timestamp(5) ON UPDATE current_timestamp(5),
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `user_id`, `date_from`, `date_to`, `title`, `rating`, `review`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-08-11', '2022-09-25', 'Courses Completed', '3.5', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti tenetur consequatur animi quas, quaerat ipsum officiis, eos porro ad nam quibusdam natus velit dolores doloribus enim, in voluptatem temporibus error culpa ratione molestiae maxime veritatis? Corporis sequi nam facilis assumenda.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti tenetur consequatur animi quas, quaerat ipsum officiis, eos porro ad nam quibusdam natus velit dolores doloribus enim, in voluptatem temporibus error culpa ratione molestiae maxime veritatis? Corporis sequi nam facilis assumenda.', 1, '2022-10-09 07:22:47.27846', '2022-09-25'),
(2, 1, '2022-08-01', '2022-09-25', 'Courses Completed', '5', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti tenetur consequatur animi quas, quaerat ipsum officiis, eos porro ad nam quibusdam natus velit dolores doloribus enim, in voluptatem temporibus error culpa ratione molestiae maxime veritatis? Corporis sequi nam facilis assumenda.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti tenetur consequatur animi quas, quaerat ipsum officiis, eos porro ad nam quibusdam natus velit dolores doloribus enim, in voluptatem temporibus error culpa ratione molestiae maxime veritatis? Corporis sequi nam facilis assumenda.', 1, '2022-10-09 07:22:47.27846', '2022-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `icon`, `position`, `created_at`, `updated_at`) VALUES
(1, 'English', NULL, 1, '2022-09-11 08:21:29', '2022-10-09 07:22:47'),
(2, 'Spanish', NULL, 1, '2022-09-11 08:21:29', '2022-10-09 07:22:47'),
(3, 'Portuguese', NULL, 1, '2022-09-11 08:21:29', '2022-10-09 07:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0:inactive; 1:active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `slug`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Random', 'random', 'uploads/lessons/633eaedc1d96a22-10-06-10-33-00.jpeg', 'qwerty', 1, '2022-10-06 02:49:16', '2022-10-09 07:22:47'),
(8, 'New Lesson', 'new-lesson', 'uploads/lessons/6342d681501bb22-10-09-02-11-13.png', 'New Lesson Description', 1, '2022-10-09 08:41:13', '2022-10-09 08:42:29'),
(9, 'Latest Lesson', 'latest-lesson', 'uploads/lessons/6342d7d43316922-10-09-02-16-52.png', 'New Latest lesson', 1, '2022-10-09 08:46:52', '2022-10-09 08:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_topics`
--

CREATE TABLE `lesson_topics` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_topics`
--

INSERT INTO `lesson_topics` (`id`, `lesson_id`, `topic_id`, `created_at`) VALUES
(7, 1, 4, '2022-10-09 10:16:07'),
(8, 9, 8, '2022-10-09 14:17:58'),
(9, 9, 5, '2022-10-09 14:17:58'),
(10, 9, 6, '2022-10-09 14:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

CREATE TABLE `markets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `market_btn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `market_btn_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_content_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_content_btn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_content_btn_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sticky_content_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sticky_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sticky_content_btn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sticky_content_btn_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medium_content_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medium_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_short` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `faq_banner_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `markets`
--

INSERT INTO `markets` (`id`, `tag`, `title`, `slug`, `short_description`, `market_btn`, `market_btn_link`, `image`, `short_content_heading`, `short_content`, `short_content_btn`, `short_content_btn_link`, `sticky_content_heading`, `sticky_content`, `sticky_content_btn`, `sticky_content_btn_link`, `medium_content_heading`, `medium_content`, `faq_heading`, `faq_short`, `faq_banner_image`, `blog_heading`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Contrary to popular belief', 'Make your life easier with help from Copywriter', NULL, 'We help businesses elevate their value through custom software development, product design, QA & consultancy services.', 'Get Started Today', 'https://demo91.co.in/laravel-only/ContentSaas/public/market', '1663165027.markets-banner.png', 'Pellentesque ullamcorper lectus non orci fermentum, tempus dapibus magna fermentum.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolo', 'Learn More', 'https://demo91.co.in/laravel-only/ContentSaas/public/market', 'Launch your writing career now.', 'Register for an account today', 'Register for an account today', NULL, 'Quisque vestibulum dui sit amet purus fermentum, sodales aliquam purus condimentum.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolo', 'Frequently Asked Questions', '<p>Find answers to commonly asked questions about Hiver. If your question doesn\'t figure here, reach out to us at support@copywriting.com</p>', '1663165027.market-accordion-bg.png', 'Donec scelerisque enim nec purus aliquet, porttitor rhoncus est luctus.', 1, '2022-09-14 14:17:07', '2022-09-14 14:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `market_banners`
--

CREATE TABLE `market_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_btn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_btn_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `market_banners`
--

INSERT INTO `market_banners` (`id`, `content_heading`, `content`, `content_btn`, `content_btn_link`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Content Reaches your audience’s audience.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by humour. There are many variations of passages of Lorem available.\r\nCurabitur convallis mi eget placerat hendrerit.', 'Learn More', NULL, '1663164372.content-audience.png', '2022-09-14 14:06:12', '2022-09-14 14:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `market_categories`
--

CREATE TABLE `market_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_description_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_description_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_description_btn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_description_btn_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `market_categories`
--

INSERT INTO `market_categories` (`id`, `title`, `slug`, `image`, `category_description_heading`, `category_description`, `category_description_image`, `category_description_btn`, `category_description_btn_link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'For Enterprise', 'for-enterprise', '1663155404.signature.png', 'Curabitur purus veu fermentum interdum', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by humour. There are many variations of passages of Lorem available.\r\n\r\n', '1663155404.market-content-img1.png', 'Learn More', NULL, 1, '2022-09-14 11:36:44', '2022-09-14 11:36:44'),
(3, 'Website Content', 'website-content', '1663155992.smart-contracts.png', 'Curabitur purus veu fermentum interdum', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by humour. There are many variations of passages of Lorem available.</p><p>Curabitur convallis mi eget placerat hendrerit.Morbi a', '1663155992.content-audience.png', 'Learn More', NULL, 1, '2022-09-14 11:46:32', '2022-09-14 11:46:32'),
(4, 'Blog Posts', 'blog-posts', '1663156058.blog-post.png', 'Curabitur purus veu fermentum interdum', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by humour. There are many variations of passages of Lorem available.</p>\r\n<p>Curabitur convallis mi eget placerat hendrerit. Morbi a', '1663156058.market-content-info-img.png', 'Learn More', NULL, 1, '2022-09-14 11:47:38', '2022-09-14 11:47:38'),
(5, 'For Agencies', 'for-agencies', '1663156161.agreement.png', 'Curabitur purus veu fermentum interdum', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by humour. There are many variations of passages of Lorem available.</p>\r\n<p>Curabitur convallis mi eget placerat hendrerit. Morbi a', '1663156161.market-content-info-img2.png', 'Learn More', NULL, 1, '2022-09-14 11:49:21', '2022-09-14 11:49:21'),
(6, 'For Publishers', 'for-publishers', '1663156219.publishers.png', 'Curabitur purus veu fermentum interdum', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by humour. There are many variations of passages of Lorem available.</p>\r\n<p>Curabitur convallis mi eget placerat hendrerit. Morbi a', '1663156219.research.png', 'Learn More', NULL, 1, '2022-09-14 11:50:19', '2022-09-14 11:50:19'),
(7, 'Script Writing', 'script-writing', '1663156322.script-writing.png', 'Curabitur purus veu fermentum interdum', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by humour. There are many variations of passages of Lorem available.</p><p>Curabitur convallis mi eget placerat hendrerit. Morbi a', '1663156322.research3.png', 'Learn More', NULL, 1, '2022-09-14 11:52:02', '2022-09-14 11:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `market_faqs`
--

CREATE TABLE `market_faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `market_id` int(11) DEFAULT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `market_faqs`
--

INSERT INTO `market_faqs` (`id`, `market_id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'How does the 7-day free trial work?', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde, illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut, quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis est nam.', 1, '2022-09-14 14:12:21', '2022-09-14 14:12:21'),
(2, NULL, 'Which features can I use during the trial?', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde, illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut, quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis est nam.', 1, '2022-09-14 14:12:50', '2022-09-14 14:12:50'),
(3, NULL, 'Which features can I use during the trial?', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde, illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut, quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis est nam.', 1, '2022-09-14 14:13:21', '2022-09-14 14:13:21');

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_07_14_133537_create_admins_table', 1),
(4, '2022_01_31_113855_create_article_categories_table', 1),
(5, '2022_01_31_114029_create_article_tags_table', 1),
(6, '2022_01_31_114138_create_article_subcategories_table', 1),
(7, '2022_04_11_080840_create_article_tertiary_category_table', 1),
(8, '2022_04_12_093444_create_articles_table', 1),
(9, '2022_04_30_125144_create_events_table', 2),
(10, '2022_05_03_064156_create_eventformats_table', 2),
(11, '2022_09_07_062621_create_courses_table', 2),
(12, '2022_09_09_064248_create_course_modules_table', 3),
(13, '2022_09_09_065939_create_course_topics_table', 3),
(14, '2022_09_09_070049_create_course_quizzes_table', 3),
(15, '2022_09_09_070129_create_course_testimonials_table', 3),
(16, '2022_09_09_070431_create_course_categories_table', 3),
(17, '2022_09_09_113140_create_event_types_table', 3),
(18, '2020_07_25_163412_create_users_table', 4),
(19, '2022_09_11_041344_create_social_media_table', 4),
(20, '2022_09_11_042552_create_user_social_media_table', 4),
(21, '2022_09_11_073240_create_languages_table', 4),
(22, '2022_09_11_073507_create_user_languages_table', 4),
(23, '2022_09_11_073712_create_portfolios_table', 4),
(24, '2022_09_11_074026_create_specialities_table', 4),
(25, '2022_09_11_074115_create_user_specialities_table', 4),
(26, '2022_09_11_074637_create_user_categories_table', 4),
(27, '2022_09_11_075440_create_employments_table', 4),
(28, '2022_09_11_075720_create_clients_table', 4),
(29, '2022_09_11_081417_create_education_table', 4),
(30, '2022_09_11_081605_create_certificates_table', 4),
(31, '2022_09_11_081711_create_testimonials_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `fname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address_id` bigint(20) NOT NULL DEFAULT 0,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_landmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shippingSameAsBilling` tinyint(4) NOT NULL DEFAULT 0,
  `shipping_address_id` bigint(20) NOT NULL DEFAULT 0,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_landmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(10,2) NOT NULL DEFAULT 0.00,
  `shipping_charges` double(10,2) NOT NULL DEFAULT 0.00,
  `shipping_method` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'standard',
  `tax_amount` double(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` double(10,2) NOT NULL DEFAULT 0.00,
  `coupon_code_id` bigint(20) NOT NULL DEFAULT 0,
  `final_amount` double(10,2) NOT NULL DEFAULT 0.00,
  `gst_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash_on_delivery' COMMENT 'online_payment/ cash_on_delivery',
  `is_paid` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1: paid, 0: not paid',
  `txn_id` bigint(20) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: new, 2: confirmed, 3: shipped, 4: delivered, 5: cancelled',
  `orderCancelledBy` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: admin, 1:customer',
  `orderCancelledReason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `course_id`, `order_no`, `ip`, `user_id`, `fname`, `lname`, `email`, `mobile`, `alt_mobile`, `billing_address_id`, `billing_address`, `billing_landmark`, `billing_country`, `billing_state`, `billing_city`, `billing_pin`, `shippingSameAsBilling`, `shipping_address_id`, `shipping_address`, `shipping_landmark`, `shipping_country`, `shipping_state`, `shipping_city`, `shipping_pin`, `amount`, `shipping_charges`, `shipping_method`, `tax_amount`, `discount_amount`, `coupon_code_id`, `final_amount`, `gst_no`, `payment_method`, `is_paid`, `txn_id`, `status`, `orderCancelledBy`, `orderCancelledReason`, `created_at`, `updated_at`) VALUES
(1, 1, 'Copywriter64556993', '157.40.98.161', 1, NULL, NULL, 'suvajit.bardhan@onenesstechs.in', '9038775709', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 3999.00, 0.00, 'standard', 0.00, 0.00, 0, 3999.00, NULL, 'cash_on_delivery', 0, 0, 1, 0, NULL, '2022-09-12 15:15:20', '2022-10-09 07:22:47'),
(2, 1, 'Copywriter1001835840', '43.231.243.101', 1, 'Suvajit', 'Bardhan', 'suvajit.bardhan@onenesstechs.in', '9038775709', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 3999.00, 0.00, 'standard', 0.00, 0.00, 0, 3999.00, NULL, 'cash_on_delivery', 0, 0, 1, 0, NULL, '2022-09-15 01:24:38', '2022-10-09 07:22:47');

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
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `user_id`, `category`, `title`, `image`, `tags`, `short_desc`, `long_desc`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'Market Research', 'Test Portfolio title 1', 'frontend/img/research3.png', '', 'Pellentesque ullamcorper lectus non orci fermentum, tempus dapibus magna fermentum.', '', 'https://www.lipsum.com/', '2022-09-11 15:17:29', '2022-10-09 07:22:47'),
(2, 1, 'Market Research', 'Test Portfolio title 2', 'frontend/img/research2.png', '', 'Pellentesque ullamcorper lectus non orci fermentum, tempus dapibus magna fermentum.', '', 'https://www.lipsum.com/', '2022-09-11 15:18:35', '2022-10-09 07:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` tinyint(4) DEFAULT 1,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `name`, `icon`, `position`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Facebook', '<i class=\"fa-brands fa-facebook-f\"></i>', 1, NULL, '2022-09-11 08:21:29', '2022-10-09 07:22:47'),
(2, 'Twitter', '<i class=\"fa-brands fa-twitter\"></i>', 1, NULL, '2022-09-11 08:21:29', '2022-10-09 07:22:47'),
(3, 'Instagram', '<i class=\"fa-brands fa-instagram\"></i>', 1, NULL, '2022-09-11 08:21:29', '2022-10-09 07:22:47'),
(4, 'Reddit', '<i class=\"fa-brands fa-reddit\"></i>', 1, NULL, '2022-09-11 08:21:29', '2022-10-09 07:22:47'),
(5, 'Telegram', '<i class=\"fa-brands fa-telegram\"></i>', 1, NULL, '2022-09-11 08:21:29', '2022-10-09 07:22:47'),
(6, 'Youtube', '<i class=\"fa-brands fa-youtube\"></i>', 1, NULL, '2022-09-11 08:21:29', '2022-10-09 07:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE `specialities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`id`, `name`, `icon`, `short_desc`, `long_desc`, `position`, `created_at`, `updated_at`) VALUES
(1, 'blog writing', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '', 1, '2022-09-11 08:21:30', '2022-10-09 07:22:47'),
(2, 'articles', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '', 1, '2022-09-11 08:21:30', '2022-10-09 07:22:47'),
(3, 'press releases', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '', 1, '2022-09-11 08:21:30', '2022-10-09 07:22:47'),
(4, 'journalism', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '', 1, '2022-09-11 08:21:30', '2022-10-09 07:22:47'),
(5, 'advertorials ', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '', 1, '2022-09-11 08:21:30', '2022-10-09 07:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `widget_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `widget_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supports`
--

INSERT INTO `supports` (`id`, `title`, `description`, `widget_title`, `widget_description`, `created_at`, `updated_at`) VALUES
(1, 'Have A Question', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto officiis explicabo necessitatibus optio accusantium similique aliquid quo quaerat dolor quibusdam!', 'Getting Started', 'orem ipsum dolor sit amet consectetur adipisicing elit. Ipsum reprehenderit ullam natus quis error assumenda placeat ducimus deleniti, iure consequuntur!', '2022-09-26 13:52:14', '2022-09-26 13:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `support_faqs`
--

CREATE TABLE `support_faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_faq_categories`
--

CREATE TABLE `support_faq_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_widgets`
--

CREATE TABLE `support_widgets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_testimonial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_testimonial` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `user_id`, `client_name`, `occupation`, `phone_number`, `email_id`, `image`, `short_testimonial`, `long_testimonial`, `link`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lisa Kudrow', 'Writer', '', '', 'frontend/img/writer3.png', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Placeat atque, veniam nobis sit modi eum molestiae voluptatibus. Mollitia possimus id harum cum pariatur dolores, iste ut est quos facere enim!', '', '', '2022-09-11 13:17:19', '2022-10-09 07:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1: active, 0: inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `slug`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Topic 1', 'topic-1', 'uploads/topic/63402ba46f33322-10-07-01-37-40.jpeg', '<p>New Topic</p>', 1, '2022-10-07 08:07:40', '2022-10-09 08:43:46'),
(5, 'Topic 2', 'topic-2', 'uploads/topic/63402bc1cef5e22-10-07-01-38-09.png', '<p>New topic 2</p>', 1, '2022-10-07 08:08:09', '2022-10-09 08:43:44'),
(6, 'New Topic 3', 'new-topic-3', 'uploads/topic/634032e59d55b22-10-07-02-08-37.png', '<p>New topic 3 post</p>', 1, '2022-10-07 08:38:37', '2022-10-09 08:43:41'),
(8, 'New Latest Topic', 'new-latest-topic', 'uploads/topic/6342d7f98eaf722-10-09-02-17-29.png', '<p>New latest topic description</p>', 0, '2022-10-09 08:47:29', '2022-10-09 08:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1:Writers 2: Employers 3: Publishers 4: Bloggers',
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Short Description/ headline (4-5 words)',
  `long_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Long description/ bio',
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `worked_for` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'comma seperated',
  `categories` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'comma seperated',
  `intro_video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quote` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quote_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_scheme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `is_premium` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `remember_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `first_name`, `last_name`, `mobile`, `email`, `password`, `slug`, `occupation`, `image`, `banner_image`, `short_desc`, `long_desc`, `country`, `city`, `address`, `postcode`, `worked_for`, `categories`, `intro_video`, `quote`, `quote_by`, `color_scheme`, `is_verified`, `is_premium`, `status`, `is_deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Suvajit', 'Bardhan', '9038775709', 'suvajit.bardhan@onenesstechs.in', '$2y$10$u4uBlLJK4vpDj5C3nhCF5OuXaaMdOQvI5JXo3Iu0eKdNA62sIws82', 'suvajit-bardhan', 'Freelance Copywriter & Journalist', 'uploads/user/63356508111a422-09-29-09-27-36.jpg', 'uploads/user-banner/633565081123322-09-29-09-27-36.jpeg', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', '', 'Angola', '', '', '', 'digital marketing agencies, recruiters, pr firms, non-profits, test work', 'language learning, education, sports, business, cryptocurrency, leisure, pets, entrepreneurship, recruitment, test category', '', '', '', '#f0ffa3', 0, 0, 0, 0, NULL, '2022-09-11 05:35:49', '2022-09-29 04:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_categories`
--

CREATE TABLE `user_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_languages`
--

CREATE TABLE `user_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_languages`
--

INSERT INTO `user_languages` (`id`, `user_id`, `language_id`, `created_at`, `updated_at`) VALUES
(47, 1, 1, '2022-09-29 04:49:15', '2022-10-09 07:22:48'),
(48, 1, 2, '2022-09-29 04:49:15', '2022-10-09 07:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_social_media`
--

CREATE TABLE `user_social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `social_media_id` bigint(20) NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_social_media`
--

INSERT INTO `user_social_media` (`id`, `user_id`, `social_media_id`, `link`, `created_at`, `updated_at`) VALUES
(108, 1, 1, 'https://facebook.com', '2022-09-29 04:49:15', '2022-10-09 07:22:48'),
(109, 1, 2, 'https://twitter.com', '2022-09-29 04:49:15', '2022-10-09 07:22:48'),
(110, 1, 6, 'https://youtube.com', '2022-09-29 04:49:15', '2022-10-09 07:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_specialities`
--

CREATE TABLE `user_specialities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `speciality_id` bigint(20) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_specialities`
--

INSERT INTO `user_specialities` (`id`, `user_id`, `speciality_id`, `description`, `created_at`, `updated_at`) VALUES
(2, 1, 5, 'Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry. Lorem Ipsum Has Been The Industry\'s Standard Dummy Text Ever Since The 1500s, When An Unknown Printer Took A Galley Of Type And Scrambled It To Make A Type Specimen Book.', '2022-09-26 08:01:29', '2022-10-09 07:22:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_status` (`blog_status`);

--
-- Indexes for table `article_categories`
--
ALTER TABLE `article_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_subcategories`
--
ALTER TABLE `article_subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_tags`
--
ALTER TABLE `article_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_tertiary_categories`
--
ALTER TABLE `article_tertiary_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_categories`
--
ALTER TABLE `course_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_lessons`
--
ALTER TABLE `course_lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_modules`
--
ALTER TABLE `course_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_quizzes`
--
ALTER TABLE `course_quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_slides`
--
ALTER TABLE `course_slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_testimonials`
--
ALTER TABLE `course_testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_topics`
--
ALTER TABLE `course_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employments`
--
ALTER TABLE `employments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_topics`
--
ALTER TABLE `lesson_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market_banners`
--
ALTER TABLE `market_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market_categories`
--
ALTER TABLE `market_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market_faqs`
--
ALTER TABLE `market_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_faqs`
--
ALTER TABLE `support_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_faq_categories`
--
ALTER TABLE `support_faq_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_widgets`
--
ALTER TABLE `support_widgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_categories`
--
ALTER TABLE `user_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_languages`
--
ALTER TABLE `user_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_social_media`
--
ALTER TABLE `user_social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_specialities`
--
ALTER TABLE `user_specialities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `article_categories`
--
ALTER TABLE `article_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `article_subcategories`
--
ALTER TABLE `article_subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `article_tags`
--
ALTER TABLE `article_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `article_tertiary_categories`
--
ALTER TABLE `article_tertiary_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_categories`
--
ALTER TABLE `course_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_lessons`
--
ALTER TABLE `course_lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_modules`
--
ALTER TABLE `course_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_quizzes`
--
ALTER TABLE `course_quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_slides`
--
ALTER TABLE `course_slides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_testimonials`
--
ALTER TABLE `course_testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_topics`
--
ALTER TABLE `course_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employments`
--
ALTER TABLE `employments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lesson_topics`
--
ALTER TABLE `lesson_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `markets`
--
ALTER TABLE `markets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `market_banners`
--
ALTER TABLE `market_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `market_categories`
--
ALTER TABLE `market_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `market_faqs`
--
ALTER TABLE `market_faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `specialities`
--
ALTER TABLE `specialities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support_faqs`
--
ALTER TABLE `support_faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_faq_categories`
--
ALTER TABLE `support_faq_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_widgets`
--
ALTER TABLE `support_widgets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_categories`
--
ALTER TABLE `user_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_languages`
--
ALTER TABLE `user_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_social_media`
--
ALTER TABLE `user_social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `user_specialities`
--
ALTER TABLE `user_specialities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
