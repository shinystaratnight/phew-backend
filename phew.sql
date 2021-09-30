-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2021 at 07:26 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phew`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_sponsors`
--

CREATE TABLE `ad_sponsors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sponsor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `url` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `information` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_files`
--

CREATE TABLE `app_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_fileable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_fileable_id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_images`
--

CREATE TABLE `app_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_imageable_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message_type` enum('text','image','location','voice_message','video') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_from` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `postal_code` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_cut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `lat`, `lng`, `postal_code`, `short_cut`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, '2021-09-27 13:27:48', '2021-09-27 13:27:48'),
(2, 1, NULL, NULL, NULL, NULL, NULL, '2021-09-27 13:27:48', '2021-09-27 13:27:48'),
(3, 1, NULL, NULL, NULL, NULL, NULL, '2021-09-27 13:27:48', '2021-09-27 13:27:48'),
(4, 2, NULL, NULL, NULL, NULL, NULL, '2021-09-27 13:27:48', '2021-09-27 13:27:48'),
(5, 3, NULL, NULL, NULL, NULL, NULL, '2021-09-27 13:27:48', '2021-09-27 13:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `city_translations`
--

CREATE TABLE `city_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city_translations`
--

INSERT INTO `city_translations` (`id`, `city_id`, `name`, `slug`, `locale`) VALUES
(1, 1, 'الرياض', 'alryad-1', 'ar'),
(2, 1, 'Riyadh', 'riyadh-2', 'en'),
(3, 2, 'مكة المكرمة', 'mk-almkrm-3', 'ar'),
(4, 2, 'Mecca', 'mecca-4', 'en'),
(5, 3, 'جدة', 'jd-5', 'ar'),
(6, 3, 'Jeddah', 'jeddah-6', 'en'),
(7, 4, 'أبوظبي', 'abothby-7', 'ar'),
(8, 4, 'Abu Dhabi', 'abu-dhabi-8', 'en'),
(9, 5, 'القاهرة', 'alkahr-9', 'ar'),
(10, 5, 'Cairo', 'cairo-10', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message_type` enum('text','image','location','voice_message','video') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `last_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_from` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `in_findly` tinyint(1) DEFAULT 0,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_phonecode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phonecode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `continent` enum('africa','europe','asia','south_america','north_america','australia') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'asia',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `in_findly`, `short_name`, `show_phonecode`, `phonecode`, `flag`, `continent`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 0, 'SA', '+966', '966', NULL, 'asia', NULL, '2021-09-27 13:27:48', '2021-09-27 13:27:48'),
(2, 0, 'UAE', '+971', '971', NULL, 'asia', NULL, '2021-09-27 13:27:48', '2021-09-27 13:27:48'),
(3, 0, 'EGP', '+20', '20', NULL, 'africa', NULL, '2021-09-27 13:27:48', '2021-09-27 13:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `country_translations`
--

CREATE TABLE `country_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country_translations`
--

INSERT INTO `country_translations` (`id`, `country_id`, `name`, `currency`, `slug`, `locale`) VALUES
(1, 1, 'المملكة العربية السعودية', 'ريال', 'almmlk-alaarby-alsaaody-1', 'ar'),
(2, 1, 'Kingdom of Saudi Arabia', 'SAR', 'kingdom-of-saudi-arabia-2', 'en'),
(3, 2, 'الإمارات العربية المتحدة', 'درهم', 'alemarat-alaarby-almthd-3', 'ar'),
(4, 2, 'United Arab Emirates', 'AED', 'united-arab-emirates-4', 'en'),
(5, 3, 'جمهورية مصر العربية', 'جنيه', 'jmhory-msr-alaarby-5', 'ar'),
(6, 3, 'Egypt', 'EGP', 'egypt-6', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `device_type` enum('android','ios','win_phone','undefined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'android',
  `device_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fav_posts`
--

CREATE TABLE `fav_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `findly_posts`
--

CREATE TABLE `findly_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `expire_date` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follow_users`
--

CREATE TABLE `follow_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friend_users`
--

CREATE TABLE `friend_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `friend_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hidden_ads`
--

CREATE TABLE `hidden_ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ad_sponsor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `like_posts`
--

CREATE TABLE `like_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'like',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mention_posts`
--

CREATE TABLE `mention_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2019_08_19_074744_create_devices_table', 1),
(5, '2020_02_05_171010_create_roles_table', 1),
(6, '2020_02_05_171023_create_settings_table', 1),
(7, '2020_02_05_171147_create_countries_table', 1),
(8, '2020_02_05_171148_create_nationalities_table', 1),
(9, '2020_02_05_171153_create_cities_table', 1),
(10, '2020_02_05_172350_create_app_images_table', 1),
(11, '2020_02_05_172401_create_app_files_table', 1),
(12, '2020_02_05_173134_add_role_id_to_users_table', 1),
(13, '2020_02_05_173135_add_city_id_to_users_table', 1),
(14, '2020_02_05_173136_add_nationality_id_to_users_table', 1),
(15, '2020_02_25_234426_create_packages_table', 1),
(16, '2020_03_03_161900_create_conversations_table', 1),
(17, '2020_03_03_162002_create_chats_table', 1),
(18, '2020_04_12_153945_create_notifications_table', 1),
(19, '2020_05_01_074807_create_contacts_table', 1),
(20, '2020_05_02_022426_create_user_settings_table', 1),
(21, '2020_06_23_094906_create_follow_users_table', 1),
(22, '2020_07_23_162840_create_user_socials_table', 1),
(23, '2020_08_23_134431_create_package_users_table', 1),
(24, '2020_08_24_124336_create_friend_requests_table', 1),
(25, '2020_08_25_141253_create_friend_users_table', 1),
(26, '2020_08_31_122543_create_posts_table', 1),
(27, '2020_08_31_123625_create_post_media_table', 1),
(28, '2020_08_31_123935_create_comments_table', 1),
(29, '2020_11_11_134545_create_mention_posts_table', 1),
(30, '2020_11_12_102538_create_sponsors_table', 1),
(31, '2020_11_12_102715_create_ad_sponsors_table', 1),
(32, '2020_12_29_120031_create_like_posts_table', 1),
(33, '2020_12_29_120523_create_fav_posts_table', 1),
(34, '2021_01_14_142426_create_screen_shot_posts_table', 1),
(35, '2021_01_17_115717_add_column_in_user_settings_table', 1),
(36, '2021_01_17_121916_add_last_seen_at_column_in_users_table', 1),
(37, '2021_01_19_111343_create_findly_posts_table', 1),
(38, '2021_01_19_175904_add_column_in_country_table', 1),
(39, '2021_01_19_190654_add_column_in_posts_table', 1),
(40, '2021_01_21_113712_create_secret_messages_table', 1),
(41, '2021_02_17_141220_create_movies_table', 1),
(42, '2021_02_17_162704_add_cover_name_column_in_app_images_table', 1),
(43, '2021_02_17_170433_create_hidden_ads_table', 1),
(44, '2021_02_18_122400_add_show_privacy_column_in_posts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `movie_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `movie_data` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, '2021-09-27 13:27:48', '2021-09-27 13:27:48'),
(2, NULL, '2021-09-27 13:27:49', '2021-09-27 13:27:49'),
(3, NULL, '2021-09-27 13:27:49', '2021-09-27 13:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `nationality_translations`
--

CREATE TABLE `nationality_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nationality_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nationality_translations`
--

INSERT INTO `nationality_translations` (`id`, `nationality_id`, `name`, `slug`, `locale`) VALUES
(1, 1, 'سعودي', 'saaody-1', 'ar'),
(2, 1, 'Saudi', 'saudi-2', 'en'),
(3, 2, 'إماراتي', 'emaraty-3', 'ar'),
(4, 2, 'Emirates', 'emirates-4', 'en'),
(5, 3, 'مصري', 'msry-5', 'ar'),
(6, 3, 'Egyptian', 'egyptian-6', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_type` enum('free','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'free',
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `period_type` enum('hours','days','weeks','months','years') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'months',
  `price` double NOT NULL DEFAULT 0,
  `plan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_type`, `period`, `period_type`, `price`, `plan`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'free', '1', 'years', 0, '{\"characters_post_count\":\"300\",\"profile_images_count\":\"3\",\"friends_count\":\"100\",\"period_to_pin_post_on_findly_by_seconds\":\"12\",\"minimum_period_for_clearing_inactive_accounts_by_days\":\"0\"}', NULL, '2021-09-27 13:27:49', '2021-09-27 13:27:49'),
(2, 'paid', '1', 'months', 50, '{\"characters_post_count\":\"600\",\"profile_images_count\":\"5\",\"friends_count\":\"200\",\"period_to_pin_post_on_findly_by_seconds\":\"48\",\"minimum_period_for_clearing_inactive_accounts_by_days\":\"60\"}', NULL, '2021-09-27 13:27:49', '2021-09-27 13:27:49'),
(3, 'paid', '1', 'years', 500, '{\"characters_post_count\":\"600\",\"profile_images_count\":\"5\",\"friends_count\":\"200\",\"period_to_pin_post_on_findly_by_seconds\":\"48\",\"minimum_period_for_clearing_inactive_accounts_by_days\":\"60\"}', NULL, '2021-09-27 13:27:49', '2021-09-27 13:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `package_translations`
--

CREATE TABLE `package_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_translations`
--

INSERT INTO `package_translations` (`id`, `package_id`, `name`, `slug`, `locale`) VALUES
(1, 1, 'الباقة المجانية', 'albak-almjany-1', 'ar'),
(2, 1, 'Free Package', 'free-package-2', 'en'),
(3, 2, 'الباقة الشهرية', 'albak-alshhry-3', 'ar'),
(4, 2, 'Monthly Package', 'monthly-package-4', 'en'),
(5, 3, 'الباقة السنوية', 'albak-alsnoy-5', 'ar'),
(6, 3, 'Yearly Package', 'yearly-package-6', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `package_users`
--

CREATE TABLE `package_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_type` enum('free','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'free',
  `subscription_start_date` date DEFAULT NULL,
  `subscription_end_date` date DEFAULT NULL,
  `information` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `show_privacy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all',
  `postable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_media`
--

CREATE TABLE `post_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_mediable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_mediable_id` bigint(20) UNSIGNED NOT NULL,
  `media_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `plan`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '2021-09-27 13:27:48', '2021-09-27 13:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_translations`
--

CREATE TABLE `role_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_translations`
--

INSERT INTO `role_translations` (`id`, `role_id`, `name`, `desc`, `slug`, `locale`) VALUES
(1, 1, 'مدير عام', NULL, 'mdyr-aaam-1', 'ar'),
(2, 1, 'Super Admin', NULL, 'super-admin-2', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `screen_shot_posts`
--

CREATE TABLE `screen_shot_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `secret_messages`
--

CREATE TABLE `secret_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message_type` enum('text','image','location','voice_message','video') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'dashboard_name_ar', 'لوحة تحكم تطبيق فيو', '2021-09-27 13:27:49', NULL),
(2, 'dashboard_name_en', 'Phew App Dashboard', '2021-09-27 13:27:49', NULL),
(3, 'project_name_ar', 'تطبيق فيو', '2021-09-27 13:27:49', NULL),
(4, 'project_name_en', 'Phew App', '2021-09-27 13:27:49', NULL),
(5, 'app_lang', 'ar', '2021-09-27 13:27:49', NULL),
(6, 'mobile', '966547855230', '2021-09-27 13:27:49', NULL),
(7, 'email', 'info@phew.com', '2021-09-27 13:27:49', NULL),
(8, 'facebook_url', 'https://www.facebook.com/', '2021-09-27 13:27:49', NULL),
(9, 'twitter_url', 'https://twitter.com/', '2021-09-27 13:27:49', NULL),
(10, 'youtube_url', 'https://www.youtube.com/', '2021-09-27 13:27:49', NULL),
(11, 'instagram_url', 'https://www.instagram.com/', '2021-09-27 13:27:49', NULL),
(12, 'whatsapp_phone', '96653545230', '2021-09-27 13:27:49', NULL),
(13, 'email_host', '', '2021-09-27 13:27:49', NULL),
(14, 'email_driver', '', '2021-09-27 13:27:49', NULL),
(15, 'email_port', '', '2021-09-27 13:27:49', NULL),
(16, 'email_username', '', '2021-09-27 13:27:49', NULL),
(17, 'email_password', '', '2021-09-27 13:27:49', NULL),
(18, 'email_encrypt', '', '2021-09-27 13:27:49', NULL),
(19, 'email_from_address', '', '2021-09-27 13:27:49', NULL),
(20, 'email_from_name', '', '2021-09-27 13:27:49', NULL),
(21, 'fcm_sender_id', '', '2021-09-27 13:27:49', NULL),
(22, 'fcm_server_key', '', '2021-09-27 13:27:49', NULL),
(23, 'sms_type', '', '2021-09-27 13:27:49', NULL),
(24, 'sms_username', '', '2021-09-27 13:27:49', NULL),
(25, 'sms_username', '', '2021-09-27 13:27:49', NULL),
(26, 'sms_password', '', '2021-09-27 13:27:49', NULL),
(27, 'sms_sender', '', '2021-09-27 13:27:49', NULL),
(28, 'distance_search', '10', '2021-09-27 13:27:49', NULL),
(29, 'google_map_key', 'AIzaSyDdCP49XcVxRLuY-4CYtxHXxnqcDvQLE8', '2021-09-27 13:27:49', NULL),
(30, 'total_interaction_on_post_to_be_displayed_in_findly', '3', '2021-09-27 13:27:49', NULL),
(31, 'limit_of_emojis_to_publish_on_findly', '10', '2021-09-27 13:27:49', NULL),
(32, 'duration_of_the_post_for_normal_user_in_findly_by_hours', '12', '2021-09-27 13:27:49', NULL),
(33, 'duration_of_the_post_for_premium_user_in_findly_by_hours', '48', '2021-09-27 13:27:49', NULL),
(34, 'copy_write_ar', 'جميع الحقوق محفوظة لتطبيق فيو', '2021-09-27 13:27:49', NULL),
(35, 'copy_write_en', 'All rights reserved for Phew App', '2021-09-27 13:27:49', NULL),
(36, 'about_ar', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.', '2021-09-27 13:27:49', NULL),
(37, 'about_en', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable.', '2021-09-27 13:27:49', NULL),
(38, 'conditions_terms_ar', 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام \"هنا يوجد محتوى نصي، هنا يوجد محتوى نصي\" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.', '2021-09-27 13:27:49', NULL),
(39, 'conditions_terms_en', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable.', '2021-09-27 13:27:49', NULL),
(40, 'url_echo', 'http://phew.orabi.rmal.com.sa:6001', '2021-09-27 13:27:49', NULL),
(41, 'echo_app_id', '5e125b67cc03e2f7', '2021-09-27 13:27:49', NULL),
(42, 'echo_auth_key', '00be63a87d50c753484eb5f4541a504a', '2021-09-27 13:27:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponsor_translations`
--

CREATE TABLE `sponsor_translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sponsor_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('superadmin','admin','client') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nationality_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identitity_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_banned` tinyint(1) NOT NULL DEFAULT 0,
  `ban_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `last_seen_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `type`, `username`, `fullname`, `mobile`, `email`, `email_verified_at`, `password`, `country_id`, `city_id`, `nationality_id`, `lat`, `lng`, `gender`, `identitity_number`, `is_active`, `is_banned`, `ban_reason`, `code`, `date_of_birth`, `last_seen_at`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'superadmin', NULL, 'Abdallah Orabi', '9961023624205', 'abd.asaad1994@gmail.com', '2021-09-27 13:27:49', '$2y$10$JiBTN0xspFB3YFz7Ap17QOxb/KYhshFJys7wHChlziT6OGPqvMGgW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL, NULL, NULL, 'mrMrB3mwjasJ1QPLO79OlisxhLhjVmT2ScfEcCBevQ0BGqbisHjNJ9zawzhP', '2021-09-27 13:27:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `all_notices` tinyint(1) NOT NULL DEFAULT 1,
  `notification_to_new_followers` tinyint(1) NOT NULL DEFAULT 1,
  `notification_to_mention` tinyint(1) NOT NULL DEFAULT 1,
  `delete_inactive_followers_and_friends` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_socials`
--

CREATE TABLE `user_socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_type` enum('facebook','twitter','google','apple') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'facebook',
  `provider_id` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_sponsors`
--
ALTER TABLE `ad_sponsors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_sponsors_sponsor_id_foreign` (`sponsor_id`);

--
-- Indexes for table `app_files`
--
ALTER TABLE `app_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_files_app_fileable_type_app_fileable_id_index` (`app_fileable_type`,`app_fileable_id`);

--
-- Indexes for table `app_images`
--
ALTER TABLE `app_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_images_app_imageable_type_app_imageable_id_index` (`app_imageable_type`,`app_imageable_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_conversation_id_foreign` (`conversation_id`),
  ADD KEY `chats_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `city_translations`
--
ALTER TABLE `city_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city_translations_city_id_locale_unique` (`city_id`,`locale`),
  ADD KEY `city_translations_locale_index` (`locale`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversations_sender_id_foreign` (`sender_id`),
  ADD KEY `conversations_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country_translations`
--
ALTER TABLE `country_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_translations_country_id_locale_unique` (`country_id`,`locale`),
  ADD KEY `country_translations_locale_index` (`locale`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devices_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fav_posts`
--
ALTER TABLE `fav_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fav_posts_user_id_foreign` (`user_id`),
  ADD KEY `fav_posts_post_id_foreign` (`post_id`);

--
-- Indexes for table `findly_posts`
--
ALTER TABLE `findly_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `findly_posts_user_id_foreign` (`user_id`),
  ADD KEY `findly_posts_post_id_foreign` (`post_id`);

--
-- Indexes for table `follow_users`
--
ALTER TABLE `follow_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follow_users_from_user_id_foreign` (`from_user_id`),
  ADD KEY `follow_users_to_user_id_foreign` (`to_user_id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friend_requests_from_user_id_foreign` (`from_user_id`),
  ADD KEY `friend_requests_to_user_id_foreign` (`to_user_id`);

--
-- Indexes for table `friend_users`
--
ALTER TABLE `friend_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friend_users_user_id_foreign` (`user_id`),
  ADD KEY `friend_users_friend_id_foreign` (`friend_id`);

--
-- Indexes for table `hidden_ads`
--
ALTER TABLE `hidden_ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hidden_ads_user_id_foreign` (`user_id`),
  ADD KEY `hidden_ads_ad_sponsor_id_foreign` (`ad_sponsor_id`);

--
-- Indexes for table `like_posts`
--
ALTER TABLE `like_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `like_posts_user_id_foreign` (`user_id`),
  ADD KEY `like_posts_post_id_foreign` (`post_id`);

--
-- Indexes for table `mention_posts`
--
ALTER TABLE `mention_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mention_posts_post_id_foreign` (`post_id`),
  ADD KEY `mention_posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationality_translations`
--
ALTER TABLE `nationality_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nationality_translations_nationality_id_locale_unique` (`nationality_id`,`locale`),
  ADD KEY `nationality_translations_locale_index` (`locale`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_translations`
--
ALTER TABLE `package_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_translations_package_id_locale_unique` (`package_id`,`locale`),
  ADD KEY `package_translations_locale_index` (`locale`);

--
-- Indexes for table `package_users`
--
ALTER TABLE `package_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_users_user_id_foreign` (`user_id`),
  ADD KEY `package_users_package_id_foreign` (`package_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_postable_type_postable_id_index` (`postable_type`,`postable_id`),
  ADD KEY `posts_country_id_foreign` (`country_id`),
  ADD KEY `posts_city_id_foreign` (`city_id`);

--
-- Indexes for table `post_media`
--
ALTER TABLE `post_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_media_post_mediable_type_post_mediable_id_index` (`post_mediable_type`,`post_mediable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_translations`
--
ALTER TABLE `role_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_translations_role_id_locale_unique` (`role_id`,`locale`),
  ADD KEY `role_translations_locale_index` (`locale`);

--
-- Indexes for table `screen_shot_posts`
--
ALTER TABLE `screen_shot_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `screen_shot_posts_user_id_foreign` (`user_id`),
  ADD KEY `screen_shot_posts_post_id_foreign` (`post_id`);

--
-- Indexes for table `secret_messages`
--
ALTER TABLE `secret_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `secret_messages_sender_id_foreign` (`sender_id`),
  ADD KEY `secret_messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsor_translations`
--
ALTER TABLE `sponsor_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sponsor_translations_sponsor_id_locale_unique` (`sponsor_id`,`locale`),
  ADD KEY `sponsor_translations_locale_index` (`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_identitity_number_unique` (`identitity_number`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_nationality_id_foreign` (`nationality_id`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_city_id_foreign` (`city_id`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_settings_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_socials`
--
ALTER TABLE `user_socials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_socials_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_sponsors`
--
ALTER TABLE `ad_sponsors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_files`
--
ALTER TABLE `app_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_images`
--
ALTER TABLE `app_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `city_translations`
--
ALTER TABLE `city_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `country_translations`
--
ALTER TABLE `country_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fav_posts`
--
ALTER TABLE `fav_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `findly_posts`
--
ALTER TABLE `findly_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow_users`
--
ALTER TABLE `follow_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friend_users`
--
ALTER TABLE `friend_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hidden_ads`
--
ALTER TABLE `hidden_ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `like_posts`
--
ALTER TABLE `like_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mention_posts`
--
ALTER TABLE `mention_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nationality_translations`
--
ALTER TABLE `nationality_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package_translations`
--
ALTER TABLE `package_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `package_users`
--
ALTER TABLE `package_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_media`
--
ALTER TABLE `post_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_translations`
--
ALTER TABLE `role_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `screen_shot_posts`
--
ALTER TABLE `screen_shot_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secret_messages`
--
ALTER TABLE `secret_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sponsor_translations`
--
ALTER TABLE `sponsor_translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_socials`
--
ALTER TABLE `user_socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ad_sponsors`
--
ALTER TABLE `ad_sponsors`
  ADD CONSTRAINT `ad_sponsors_sponsor_id_foreign` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `city_translations`
--
ALTER TABLE `city_translations`
  ADD CONSTRAINT `city_translations_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversations_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `country_translations`
--
ALTER TABLE `country_translations`
  ADD CONSTRAINT `country_translations_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fav_posts`
--
ALTER TABLE `fav_posts`
  ADD CONSTRAINT `fav_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fav_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `findly_posts`
--
ALTER TABLE `findly_posts`
  ADD CONSTRAINT `findly_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `findly_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follow_users`
--
ALTER TABLE `follow_users`
  ADD CONSTRAINT `follow_users_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follow_users_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD CONSTRAINT `friend_requests_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friend_requests_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friend_users`
--
ALTER TABLE `friend_users`
  ADD CONSTRAINT `friend_users_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friend_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hidden_ads`
--
ALTER TABLE `hidden_ads`
  ADD CONSTRAINT `hidden_ads_ad_sponsor_id_foreign` FOREIGN KEY (`ad_sponsor_id`) REFERENCES `ad_sponsors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hidden_ads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `like_posts`
--
ALTER TABLE `like_posts`
  ADD CONSTRAINT `like_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mention_posts`
--
ALTER TABLE `mention_posts`
  ADD CONSTRAINT `mention_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mention_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nationality_translations`
--
ALTER TABLE `nationality_translations`
  ADD CONSTRAINT `nationality_translations_nationality_id_foreign` FOREIGN KEY (`nationality_id`) REFERENCES `nationalities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_translations`
--
ALTER TABLE `package_translations`
  ADD CONSTRAINT `package_translations_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_users`
--
ALTER TABLE `package_users`
  ADD CONSTRAINT `package_users_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `package_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_translations`
--
ALTER TABLE `role_translations`
  ADD CONSTRAINT `role_translations_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `screen_shot_posts`
--
ALTER TABLE `screen_shot_posts`
  ADD CONSTRAINT `screen_shot_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `screen_shot_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `secret_messages`
--
ALTER TABLE `secret_messages`
  ADD CONSTRAINT `secret_messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `secret_messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sponsor_translations`
--
ALTER TABLE `sponsor_translations`
  ADD CONSTRAINT `sponsor_translations_sponsor_id_foreign` FOREIGN KEY (`sponsor_id`) REFERENCES `sponsors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_nationality_id_foreign` FOREIGN KEY (`nationality_id`) REFERENCES `nationalities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD CONSTRAINT `user_settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_socials`
--
ALTER TABLE `user_socials`
  ADD CONSTRAINT `user_socials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
