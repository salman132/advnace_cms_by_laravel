-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2023 at 03:27 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `advance_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_configs`
--

CREATE TABLE `email_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `settings_id` bigint(20) UNSIGNED NOT NULL,
  `host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'My Website',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `currency_symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Email verify On',
  `en` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1= Email Notify On',
  `user_register` tinyint(1) NOT NULL DEFAULT '0',
  `alert_system` int(11) NOT NULL COMMENT '1 = Toastr,2=IZI Toast,3=No',
  `bg_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uploads/thumbnails/login-bg.jpg',
  `bg_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_credit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone_id` int(11) DEFAULT NULL,
  `social_login` tinyint(1) NOT NULL DEFAULT '0',
  `active_template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text COLLATE utf8mb4_unicode_ci,
  `email_config` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_title`, `currency`, `currency_symbol`, `ev`, `en`, `user_register`, `alert_system`, `bg_image`, `bg_color`, `footer_credit`, `timezone_id`, `social_login`, `active_template`, `email`, `email_template`, `email_config`, `logo`, `favicon`, `created_at`, `updated_at`) VALUES
(1, 'My Website', 'USD', '$', 0, 0, 1, 2, 'uploads/thumbnails/15791890161577474117login-bg.jpg', '#000000', 'Salman', 343, 1, NULL, 'salman.auvi@northsouth.edu', '<div class=\"header\" style=\"font-size: medium; background-color: rgb(0, 0, 54); padding: 15px; text-align: center;\"><div class=\"logo\" style=\"text-align: justify; width: 260px; margin: 0px auto;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-family: undefined;\">﻿</span><img height=\"100px\" width=\"110px\" src=\"https://www.salmanauvi.com/uploads/logo/1571826551salman-rahman.png\" alt=\"a\" style=\"width: 191.969px; height: 174.502px;\">&nbsp;</div></div><div class=\"mailtext\" style=\"padding: 30px 15px; background-color: rgb(240, 248, 255); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 26px;\"=\"\"><br></div><div class=\"mailtext\" style=\"padding: 30px 15px; background-color: rgb(240, 248, 255); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 26px;\"=\"\"><span style=\"font-family: Verdana;\">Hi {{name}} ,&nbsp;</span></div><div class=\"mailtext\" style=\"padding: 30px 15px; background-color: rgb(240, 248, 255); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;=\"\" line-height:=\"\" 26px;\"=\"\"><span style=\"font-family: Verdana;\">{{sms}}&nbsp;</span><br><br><br></div><div class=\"footer\" style=\"font-size: medium; background-color: rgb(0, 0, 54); padding: 15px; text-align: center;\"><a href=\"\" style=\"color: rgb(255, 255, 255); background-color: rgb(46, 204, 113); font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;; font-weight: 600; padding: 10px 0px; margin: 10px; display: inline-block; width: 100px; text-transform: uppercase; border-radius: 4px;\">WEBSITE</a>&nbsp;&nbsp;<a href=\"#\" style=\"color: rgb(255, 255, 255); background-color: rgb(46, 204, 113); font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Helvetica, Arial, sans-serif, \'Apple Color Emoji\', \'Segoe UI Emoji\', \'Segoe UI Symbol\'; box-sizing: border-box;; font-weight: 600; padding: 10px 0px; margin: 10px; display: inline-block; width: 100px; text-transform: uppercase; border-radius: 4px;\">CONTACT</a></div><div class=\"footer\" style=\"font-size: medium; background-color: rgb(0, 0, 54); padding: 15px; text-align: center; border-top-color: rgba(255, 255, 255, 0.2);\"><span style=\"color: rgb(255, 255, 255);\" segoe=\"\" ui\",=\"\" roboto,=\"\" helvetica,=\"\" arial,=\"\" sans-serif,=\"\" \"apple=\"\" color=\"\" emoji\",=\"\" \"segoe=\"\" ui=\"\" symbol\";=\"\" box-sizing:=\"\" border-box;=\"\" color:=\"\" rgb(255,=\"\" 255,=\"\" 255);\"=\"\" ;=\"\" font-weight:=\"\" bolder;=\"\">© 2019 - {{date(\'Y\')}} All Rights Reserved.</span><p style=\"font-family: var(--para-font); color: rgb(221, 221, 221);\"></p><div><br style=\"color: rgb(33, 37, 41); font-family: Lato, -apple-system, BlinkMacSystemFont, \" segoe=\"\" ui\",=\"\" roboto,=\"\" \"helvetica=\"\" neue\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"></div></div>', '3', 'uploads/logo/15808332381571826551salman-rahman.png', 'uploads/logo/15808332381571826551salman-rahman.png', '2020-01-15 17:00:16', '2020-06-14 03:51:07');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uploads/language/icon.png',
  `text_decoration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 = LTR, 2 = RTL',
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Not, 1= Default',
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Language File Directory',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `text_decoration`, `is_default`, `source`, `created_at`, `updated_at`) VALUES
(1, 'Bangla', 'bn', 'uploads/language/icon.png', '1', 0, 'C:\\xampp\\htdocs\\my_project\\resources\\lang/bn.json', '2020-01-24 13:21:21', '2020-01-24 13:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `login_histories`
--

CREATE TABLE `login_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `os` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor_info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_histories`
--

INSERT INTO `login_histories` (`id`, `user_id`, `ip_address`, `browser`, `os`, `visitor_info`, `country`, `created_at`, `updated_at`) VALUES
(1, 20, 'UNKNOWN', 'Chrome', 'Windows 10', '\"Unknown\"', 'Unknown', '2023-01-08 09:05:00', '2023-01-08 09:05:00');

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
(1, '2010_12_15_175436_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2019_12_21_191710_create_login_histories_table', 1),
(7, '2019_12_23_220835_create_timezones_table', 1),
(8, '2019_12_27_204017_create_general_settings_table', 1),
(9, '2019_12_31_114832_create_languages_table', 1),
(10, '2020_01_06_213354_create_frontends_table', 1),
(11, '2020_01_12_201209_create_categories_table', 1),
(12, '2020_01_15_215742_create_tags_table', 1),
(13, '2020_01_15_215838_create_posts_table', 1),
(14, '2020_01_15_221904_create_posts_tag_table', 1),
(15, '2020_01_25_012437_create_products_table', 1),
(16, '2020_01_25_015053_create_products_tag_table', 1),
(17, '2020_02_17_124813_create_email_configs_table', 1),
(18, '2020_02_26_224209_create_payment_gateways_table', 1),
(19, '2020_03_02_164425_create_support_tickets_table', 2),
(20, '2020_03_02_165950_create_support_ticket_contents_table', 2),
(21, '2020_03_22_163235_create_permissions_table', 2),
(22, '2020_06_24_225613_create_orders_table', 2),
(23, '2020_08_09_235559_create_table_order_products_table', 2),
(24, '2020_08_12_220431_create_subscribers_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `is_accepted` tinyint(1) NOT NULL COMMENT '0= cancelled, 1= completed',
  `respond_by` int(11) DEFAULT NULL COMMENT 'record of accept/reject',
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_gateway` int(11) NOT NULL,
  `transaction_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_note` text COLLATE utf8mb4_unicode_ci,
  `cancel_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
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
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gateway_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_name` text COLLATE utf8mb4_unicode_ci,
  `client_id` text COLLATE utf8mb4_unicode_ci,
  `client_secret` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `logo`, `gateway_name`, `account_name`, `client_id`, `client_secret`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uploads/payments/paypal.png', 'PayPal', 'eyJpdiI6IlMrcEFyeHgxMFwvRTUxVGlmWUxCWVl3PT0iLCJ2YWx1ZSI6IldkejZoYjlGeXAzaVlNZ25QVGQ5dTBXXC9FY2U1UFlvdHlOYzRLNmR3Sm5YRWYyaExJMVNMVTNiRTNvdWRRSGtJIiwibWFjIjoiNTg3MTczM2I1YTE1ZGQwMzRkNjY4MGRhNWVjYjI0YzJjOGI1NmM4M2QyNGNhZGZkNzEyYjk1ZjhhNDQ4Njk3YyJ9', 'eyJpdiI6Inp6ZytPZElsS0RZcG1VVHJvdEpyckE9PSIsInZhbHVlIjoiVk42TVhBbElVV1ZzZlV6aGU1WkJsRjV4dVBBNmkraitvNkcrVEtvM2M5QVVEamdHU0I5QlFQRmxYcHhXazh2ZDVTTis3dTZFcmxJMjF3UHdnUHRCWFg1eGxhaktoY21DZTU5UWhLXC9UVFdGM2h1Z29DK2FldHRUQ3hEYWZvdk5oIiwibWFjIjoiMjM2MDg4NDhlODdjZjQyZjQ2YzRhM2Y3ZjQwMDA5NTUyMWIyZGUzNzQyYzVjZGIzMGJiODY2NDFiNTUzMDQ3MyJ9', 'eyJpdiI6IjFoRnBlTEFOUzJ4anZNXC9iXC9HTEtNZz09IiwidmFsdWUiOiJaVWN5VFU1bTJLS1hRRmF4SHVpdnBjaWFBTnhDZ0VMQ2FMUnNPM1JaSzdhV3piWDZ0Tm1sNTVRRTBac1E1bTBOc1RMYkpzY1lwakVibkp5ZEp4ZVUrTFZRU2xtekk1XC9UVzZ0TlE1MzBGalNFZnZ4dmJQN3ZyVHlTam9EcXNWeG4iLCJtYWMiOiI5Mzc2ZGIwMmQyMmY1YWZkZjIyMTA3MzFjNTM1OWYyMjQ1MWVkNGY3MTg4NTVkYmVjMzg3YmMwMjNmYmQ3YmNlIn0=', 1, '2020-02-26 13:00:00', '2020-03-01 23:12:13'),
(2, 'uploads/payments/stripe.png', 'Stripe', 'eyJpdiI6InAzeTMzZFh5T0c2XC9oWGcrMHdwQXp3PT0iLCJ2YWx1ZSI6InBrZWRBZ2o4RXJwZVZSU1pKNWJhYzNHQWN6ZkZ5WmhLRUUyN0MzYlhvMlk9IiwibWFjIjoiMDI2MDdmMTBhMDRmYzIzYTRmOWFlZWFlOTQ0YjY4MDM2OGZjNzVhMDlhZmMwZTY3MmViOGUxMzRjMzQ1MGUzZCJ9', 'eyJpdiI6IjExNGtQMWJRNkRzeWN6Q3RPNElKNVE9PSIsInZhbHVlIjoiK2Z0d081QUxIb3FiXC83QmV6Vm9Xa0FHWEV0cmtjZEJLb3BlRDNEc2RQNDQ2aUxMUXV2YnFxdWlzWXpNRnpMNFkiLCJtYWMiOiIyM2U3MDg5YzEyMTU3ZjY0MWJiYTE1OWIyNGY5ZTI1NDMyMDUzNTJhOTdmMTgwODgyNmNmODI0NDRiMmU1NDdjIn0=', 'eyJpdiI6InAwM09yWEdSaHI5OHJ6RVlzMWpEcmc9PSIsInZhbHVlIjoiUDBcL1QrXC81Zkc0UklkVEJRd0lTdm1FMHdzSW1kdG1YSzZsSHYxeTFibVp5VDJVRVBYbmxFZ3ZWd1VDbWRzWFdJIiwibWFjIjoiZTYyMTc3ZTM2Y2JmZWExYTMzNjBjOWZlNWExOTkyYmU2ZjQ5NjM2MDEyYzFjY2QyYjJlZjcxNTQwZWE0NTBjNSJ9', 1, '2020-02-26 13:04:00', '2020-03-01 06:20:28'),
(3, 'uploads/payments/cash.png', 'Cash on Delivery', NULL, NULL, NULL, 1, NULL, '2020-03-22 00:51:02'),
(4, 'uploads/payments/ssl.png', 'SSLCOMMERZ', 'eyJpdiI6IjIwM0l2eHBTRFwvcmZqbytpZkZ5SHlnPT0iLCJ2YWx1ZSI6ImdqM05WYmlWS0V6WWxTYkI3aU1HR2hEcHloMmhTaGJob1dJVHQ3b2ZPR009IiwibWFjIjoiZDY4NzBiMTZhNTQyN2MxZGVjZGZjMzFhNWUzZmMwNDJkOTBhYWY1MmE4NzNiNThiNzk5MTU1YjIxYmJhNTY0ZSJ9', 'eyJpdiI6IldMaW5HWWFYSXJVRXl2U3NUU3djQUE9PSIsInZhbHVlIjoiVWlrdnpKOEZnaTQ0NENxRmd5ejgzQU4yQVplb05XS3lvdGhNYmt3Um9sOD0iLCJtYWMiOiJjYThmNjM0Y2FlZTExMWY2NzRkYmQ3ZGU3YTZlOTdhY2VkZTU4MmJlZjUzNTRkYzE4MmM5NGNhYjIzNzAzNjkxIn0=', 'eyJpdiI6InpBOTQ4ZVF3VVdZN2VlWWxsNEFzMVE9PSIsInZhbHVlIjoiTmdJQzRiZUltSTc2NnZLZVdISWo3T0hHdWxRa05WSnFiTUN5bllWNVRRaz0iLCJtYWMiOiIwYjk4MDM1ZmExMjJlNGRlNzBkYzgzNjgzZTk3YTEyMzU5NWMwMDc2Mzk0OGFlMjRiNDZlMzYwNDQzYzAzYTJhIn0=', 1, NULL, '2020-03-02 01:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `perm_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `given_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `perm_id`, `given_by`, `created_at`, `updated_at`) VALUES
(1, 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14', 1, '2020-03-28 11:57:08', '2020-04-14 08:20:28'),
(2, 2, '1,2', 1, '2020-03-28 12:01:45', '2020-03-28 12:01:45'),
(3, 3, '1', 1, '2020-04-04 08:52:08', '2020-04-04 08:52:08');

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
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci,
  `category_id` int(11) NOT NULL,
  `stock` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=Yes,0=No',
  `contentPic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uploads/thumbnails/default.png',
  `gallery` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_tag`
--

CREATE TABLE `products_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `products_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` int(11) NOT NULL COMMENT '1=Admin,2=User',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', '2020-01-28 19:08:04', NULL),
(2, 2, 'User', '2020-01-29 14:06:00', NULL),
(3, 2, 'Demo', '2020-03-28 08:43:50', '2020-03-28 08:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ticket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Pending,1=Open,2=Closed',
  `opened_by` int(11) DEFAULT NULL,
  `closed_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `ticket`, `subject`, `status`, `opened_by`, `closed_by`, `created_at`, `updated_at`) VALUES
(1, 9, 'Ay4TMn', 'My attachment is not working', 1, 1, 1, '2020-03-06 13:00:00', '2020-04-14 04:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_contents`
--

CREATE TABLE `support_ticket_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL COMMENT '1=Counselor,2 = User',
  `message` text COLLATE utf8mb4_unicode_ci,
  `attachments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_ticket_contents`
--

INSERT INTO `support_ticket_contents` (`id`, `ticket_id`, `user_id`, `role_id`, `message`, `attachments`, `created_at`, `updated_at`) VALUES
(1, 1, 20, 1, 'Hi', NULL, '2020-08-29 04:58:34', '2020-08-29 04:58:34'),
(2, 1, 20, 1, 'i am just running a test', NULL, '2020-08-29 05:45:59', '2020-08-29 05:45:59'),
(3, 1, 20, 1, 'Thats really great', NULL, '2020-08-29 05:47:42', '2020-08-29 05:47:42'),
(4, 1, 20, 1, 'hmm , thanks', NULL, '2020-08-29 05:57:59', '2020-08-29 05:57:59'),
(5, 1, 20, 1, 'welcome', NULL, '2020-08-29 10:47:09', '2020-08-29 10:47:09'),
(6, 1, 20, 1, 'hmm', NULL, '2020-08-29 10:47:26', '2020-08-29 10:47:26'),
(7, 1, 20, 1, 'hmm vai', NULL, '2020-08-29 10:59:39', '2020-08-29 10:59:39'),
(8, 1, 20, 1, 'now this is the file', 'uploads/chat/1598720401mom-pams-demo-discussion-230720-v13.docx', '2020-08-29 11:00:01', '2020-08-29 11:00:01'),
(9, 1, 20, 1, 'great things', NULL, '2020-08-29 12:03:28', '2020-08-29 12:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(145, 'doll', '2020-01-25 09:31:26', '2020-01-25 09:31:26'),
(146, 'cinderella', '2020-01-25 09:31:26', '2020-01-25 09:31:26'),
(147, 'large', '2020-01-25 09:31:26', '2020-01-25 09:31:26'),
(148, 'smoking', '2020-02-16 23:20:44', '2020-02-16 23:20:44'),
(149, 'Heroine', '2020-02-16 23:20:44', '2020-02-20 05:42:10'),
(150, 'life', '2020-02-16 23:20:44', '2020-02-16 23:20:44'),
(151, 'test', '2020-04-14 05:58:43', '2020-04-14 05:58:43'),
(152, 'couple', '2020-04-14 05:58:43', '2020-04-14 05:58:43'),
(153, 'politics', '2020-04-14 05:58:43', '2020-04-14 05:58:43'),
(154, 'laptop', '2020-08-13 09:39:47', '2020-08-13 09:39:47'),
(155, 'dell', '2020-08-13 13:16:29', '2020-08-13 13:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `continent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `continent`, `timezone`, `created_at`, `updated_at`) VALUES
(104, 'Africa', 'Africa/Abidjan', NULL, NULL),
(105, 'Africa', 'Africa/Accra', NULL, NULL),
(106, 'Africa', 'Africa/Addis_Ababa', NULL, NULL),
(107, 'Africa', 'Africa/Algiers', NULL, NULL),
(108, 'Africa', 'Africa/Asmara', NULL, NULL),
(109, 'Africa', 'Africa/Bamako', NULL, NULL),
(110, 'Africa', 'Africa/Bangui', NULL, NULL),
(111, 'Africa', 'Africa/Banjul', NULL, NULL),
(112, 'Africa', 'Africa/Bissau', NULL, NULL),
(113, 'Africa', 'Africa/Blantyre', NULL, NULL),
(114, 'Africa', 'Africa/Brazzaville', NULL, NULL),
(115, 'Africa', 'Africa/Bujumbura', NULL, NULL),
(116, 'Africa', 'Africa/Cairo', NULL, NULL),
(117, 'Africa', 'Africa/Casablanca', NULL, NULL),
(118, 'Africa', 'Africa/Ceuta', NULL, NULL),
(119, 'Africa', 'Africa/Conakry', NULL, NULL),
(120, 'Africa', 'Africa/Dakar', NULL, NULL),
(121, 'Africa', 'Africa/Dar_es_Salaam', NULL, NULL),
(122, 'Africa', 'Africa/Djibouti', NULL, NULL),
(123, 'Africa', 'Africa/Douala', NULL, NULL),
(124, 'Africa', 'Africa/El_Aaiun', NULL, NULL),
(125, 'Africa', 'Africa/Freetown', NULL, NULL),
(126, 'Africa', 'Africa/Gaborone', NULL, NULL),
(127, 'Africa', 'Africa/Africa/Harare', NULL, NULL),
(128, 'Africa', 'Africa/Johannesburg', NULL, NULL),
(129, 'Africa', 'Africa/Juba', NULL, NULL),
(130, 'Africa', 'Africa/Kampala', NULL, NULL),
(131, 'Africa', 'Africa/Khartoum', NULL, NULL),
(132, 'Africa', 'Africa/Kigali', NULL, NULL),
(133, 'Africa', 'Africa/Kinshasa', NULL, NULL),
(134, 'Africa', 'Africa/Lagos', NULL, NULL),
(135, 'Africa', 'Africa/Libreville', NULL, NULL),
(136, 'Africa', 'Africa/Lome', NULL, NULL),
(137, 'Africa', 'Africa/Luanda', NULL, NULL),
(138, 'Africa', 'Africa/Lubumbashi', NULL, NULL),
(139, 'Africa', 'Africa/Malabo', NULL, NULL),
(140, 'Africa', 'Africa/Maputo', NULL, NULL),
(141, 'Africa', 'Africa/Maseru', NULL, NULL),
(142, 'Africa', 'Africa/Mbabane', NULL, NULL),
(143, 'Africa', 'Africa/Mogadishu', NULL, NULL),
(144, 'Africa', 'Africa/Monrovia', NULL, NULL),
(145, 'Africa', 'Africa/Nairobi', NULL, NULL),
(146, 'Africa', 'Africa/Ndjamena', NULL, NULL),
(147, 'Africa', 'Africa/Niamey', NULL, NULL),
(148, 'Africa', 'Africa/Nouakchott', NULL, NULL),
(149, 'Africa', 'Africa/Ouagadougou', NULL, NULL),
(150, 'Africa', 'Africa/Porto-Novo', NULL, NULL),
(151, 'Africa', 'Africa/Sao_Tome', NULL, NULL),
(152, 'Africa', 'Africa/Timbuktu', NULL, NULL),
(153, 'Africa', 'Africa/Tripoli', NULL, NULL),
(154, 'Africa', 'Africa/Tunis', NULL, NULL),
(155, 'Africa', 'Africa/Windhoek', NULL, NULL),
(156, 'America', 'America/Adak', NULL, NULL),
(157, 'America', 'America/Anchorage', NULL, NULL),
(158, 'America', 'America/Anguilla', NULL, NULL),
(159, 'America', 'America/Antigua', NULL, NULL),
(160, 'America', 'America/Araguaina', NULL, NULL),
(161, 'America', 'America/Argentina/Buenos_Aires', NULL, NULL),
(162, 'America', 'America/Argentina/Catamarca', NULL, NULL),
(163, 'America', 'America/Argentina/ComodRivadavia', NULL, NULL),
(164, 'America', 'America/Argentina/Cordoba', NULL, NULL),
(165, 'America', 'America/Argentina/Jujuy', NULL, NULL),
(166, 'America', 'America/Argentina/La_Rioja', NULL, NULL),
(167, 'America', 'America/Argentina/Mendoza', NULL, NULL),
(168, 'America', 'America/Argentina/Rio_Gallegos', NULL, NULL),
(169, 'America', 'America/Argentina/Salta', NULL, NULL),
(170, 'America', 'America/Argentina/San_Juan', NULL, NULL),
(171, 'America', 'America/Argentina/San_Luis', NULL, NULL),
(172, 'America', 'America/Argentina/Tucuman', NULL, NULL),
(173, 'America', 'America/Argentina/Ushuaia', NULL, NULL),
(174, 'America', 'America/Aruba', NULL, NULL),
(175, 'America', 'America/Asuncion', NULL, NULL),
(176, 'America', 'America/Atikokan', NULL, NULL),
(177, 'America', 'America/Atka', NULL, NULL),
(178, 'America', 'America/Bahia', NULL, NULL),
(179, 'America', 'America/Bahia_Banderas', NULL, NULL),
(180, 'America', 'America/Barbados', NULL, NULL),
(181, 'America', 'America/Belem', NULL, NULL),
(182, 'America', 'America/Belize', NULL, NULL),
(183, 'America', 'America/Blanc-Sablon', NULL, NULL),
(184, 'America', 'America/Boa_Vista', NULL, NULL),
(185, 'America', 'America/Bogota', NULL, NULL),
(186, 'America', 'America/Boise', NULL, NULL),
(187, 'America', 'America/Buenos_Aires', NULL, NULL),
(188, 'America', 'America/Cambridge_Bay', NULL, NULL),
(189, 'America', 'America/Campo_Grande', NULL, NULL),
(190, 'America', 'America/Cancun', NULL, NULL),
(191, 'America', 'America/Caracas', NULL, NULL),
(192, 'America', 'America/Catamarca', NULL, NULL),
(193, 'America', 'America/Cayenne', NULL, NULL),
(194, 'America', 'America/Cayman', NULL, NULL),
(195, 'America', 'America/Chicago', NULL, NULL),
(196, 'America', 'America/Chihuahua', NULL, NULL),
(197, 'America', 'America/Coral_Harbour', NULL, NULL),
(198, 'America', 'America/Cordoba', NULL, NULL),
(199, 'America', 'America/Costa_Rica', NULL, NULL),
(200, 'America', 'America/Creston', NULL, NULL),
(201, 'America', 'America/Cuiaba', NULL, NULL),
(202, 'America', 'America/Curacao', NULL, NULL),
(203, 'America', 'America/Danmarkshavn', NULL, NULL),
(204, 'America', 'America/Dawson', NULL, NULL),
(205, 'America', 'America/Dawson_Creek', NULL, NULL),
(206, 'America', 'America/Denver', NULL, NULL),
(207, 'America', 'America/Detroit', NULL, NULL),
(208, 'America', 'America/Dominica', NULL, NULL),
(209, 'America', 'America/Edmonton', NULL, NULL),
(210, 'America', 'America/Eirunepe', NULL, NULL),
(211, 'America', 'America/El_Salvador', NULL, NULL),
(212, 'America', 'America/Ensenada', NULL, NULL),
(213, 'America', 'America/Fort_Wayne', NULL, NULL),
(214, 'America', 'America/Fortaleza', NULL, NULL),
(215, 'America', 'America/Glace_Bay', NULL, NULL),
(216, 'America', 'America/Godthab', NULL, NULL),
(217, 'America', 'America/Goose_Bay', NULL, NULL),
(218, 'America', 'America/Grand_Turk', NULL, NULL),
(219, 'America', 'America/Grenada', NULL, NULL),
(220, 'America', 'America/Guadeloupe', NULL, NULL),
(221, 'America', 'America/Guatemala', NULL, NULL),
(222, 'America', 'America/Guayaquil', NULL, NULL),
(223, 'America', 'America/Guyana', NULL, NULL),
(224, 'America', 'America/Halifax', NULL, NULL),
(225, 'America', 'America/Havana', NULL, NULL),
(226, 'America', 'America/Hermosillo', NULL, NULL),
(227, 'America', 'America/Indiana/Indianapolis', NULL, NULL),
(228, 'America', 'America/Indiana/Knox', NULL, NULL),
(229, 'America', 'America/Indiana/Marengo', NULL, NULL),
(230, 'America', 'America/Indiana/Petersburg', NULL, NULL),
(231, 'America', 'America/Indiana/Tell_City', NULL, NULL),
(232, 'America', 'America/Indiana/Vevay', NULL, NULL),
(233, 'America', 'America/Indiana/Vincennes', NULL, NULL),
(234, 'America', 'America/Indiana/Winamac', NULL, NULL),
(235, 'America', 'America/Indianapolis', NULL, NULL),
(236, 'America', 'America/Inuvik', NULL, NULL),
(237, 'America', 'America/Iqaluit', NULL, NULL),
(238, 'America', 'America/Jamaica', NULL, NULL),
(239, 'America', 'America/Jujuy', NULL, NULL),
(240, 'America', 'America/Juneau', NULL, NULL),
(241, 'America', 'America/Kentucky/Louisville', NULL, NULL),
(242, 'America', 'America/Kentucky/Monticello', NULL, NULL),
(243, 'America', 'America/Knox_IN', NULL, NULL),
(244, 'America', 'America/Kralendijk', NULL, NULL),
(245, 'America', 'America/La_Paz', NULL, NULL),
(246, 'America', 'America/Lima', NULL, NULL),
(247, 'America', 'America/Los_Angeles', NULL, NULL),
(248, 'America', 'America/Louisville', NULL, NULL),
(249, 'America', 'America/Lower_Princes', NULL, NULL),
(250, 'America', 'America/Maceio', NULL, NULL),
(251, 'America', 'America/Managua', NULL, NULL),
(252, 'America', 'America/Manaus', NULL, NULL),
(253, 'America', 'America/Marigot', NULL, NULL),
(254, 'America', 'America/Martinique', NULL, NULL),
(255, 'America', 'America/Matamoros', NULL, NULL),
(256, 'America', 'America/Mazatlan', NULL, NULL),
(257, 'America', 'America/Mendoza', NULL, NULL),
(258, 'America', 'America/Menominee', NULL, NULL),
(259, 'America', 'America/Merida', NULL, NULL),
(260, 'America', 'America/Metlakatla', NULL, NULL),
(261, 'America', 'America/Mexico_City', NULL, NULL),
(262, 'America', 'America/Miquelon', NULL, NULL),
(263, 'America', 'America/Moncton', NULL, NULL),
(264, 'America', 'America/Monterrey', NULL, NULL),
(265, 'America', 'America/Montevideo', NULL, NULL),
(266, 'America', 'America/Montreal', NULL, NULL),
(267, 'America', 'America/Montserrat', NULL, NULL),
(268, 'America', 'America/Nassau', NULL, NULL),
(269, 'America', 'America/New_York', NULL, NULL),
(270, 'America', 'America/Nipigon', NULL, NULL),
(271, 'America', 'America/Nome', NULL, NULL),
(272, 'America', 'America/Noronha', NULL, NULL),
(273, 'America', 'America/North_Dakota/Beulah', NULL, NULL),
(274, 'America', 'America/North_Dakota/Center', NULL, NULL),
(275, 'America', 'America/North_Dakota/New_Salem', NULL, NULL),
(276, 'America', 'America/Ojinaga', NULL, NULL),
(277, 'America', 'America/Panama', NULL, NULL),
(278, 'America', 'America/Pangnirtung', NULL, NULL),
(279, 'America', 'America/Paramaribo', NULL, NULL),
(280, 'America', 'America/Phoenix', NULL, NULL),
(281, 'America', 'America/Port-au-Prince', NULL, NULL),
(282, 'America', 'America/Port_of_Spain', NULL, NULL),
(283, 'America', 'America/Porto_Acre', NULL, NULL),
(284, 'America', 'America/Porto_Velho', NULL, NULL),
(285, 'America', 'America/Puerto_Rico', NULL, NULL),
(286, 'America', 'America/Rainy_River', NULL, NULL),
(287, 'America', 'America/Rankin_Inlet', NULL, NULL),
(288, 'America', 'America/Recife', NULL, NULL),
(289, 'America', 'America/Regina', NULL, NULL),
(290, 'America', 'America/Resolute', NULL, NULL),
(291, 'America', 'America/Rio_Branco', NULL, NULL),
(292, 'America', 'America/Rosario', NULL, NULL),
(293, 'America', 'America/Santa_Isabel', NULL, NULL),
(294, 'America', 'America/Santarem', NULL, NULL),
(295, 'America', 'America/Santiago', NULL, NULL),
(296, 'America', 'America/Santo_Domingo', NULL, NULL),
(297, 'America', 'America/Sao_Paulo', NULL, NULL),
(298, 'America', 'America/Scoresbysund', NULL, NULL),
(299, 'America', 'America/Shiprock', NULL, NULL),
(300, 'America', 'America/Sitka', NULL, NULL),
(301, 'America', 'America/St_Barthelemy', NULL, NULL),
(302, 'America', 'America/St_Johns', NULL, NULL),
(303, 'America', 'America/St_Kitts', NULL, NULL),
(304, 'America', 'America/St_Lucia', NULL, NULL),
(305, 'America', 'America/St_Thomas', NULL, NULL),
(306, 'America', 'America/St_Vincent', NULL, NULL),
(307, 'America', 'America/Swift_Current', NULL, NULL),
(308, 'America', 'America/Tegucigalpa', NULL, NULL),
(309, 'America', 'America/Thule', NULL, NULL),
(310, 'America', 'America/Thunder_Bay', NULL, NULL),
(311, 'America', 'America/Tijuana', NULL, NULL),
(312, 'America', 'America/Toronto', NULL, NULL),
(313, 'America', 'America/Tortola', NULL, NULL),
(314, 'America', 'America/Vancouver', NULL, NULL),
(315, 'America', 'America/Virgin', NULL, NULL),
(316, 'America', 'America/Whitehorse', NULL, NULL),
(317, 'America', 'America/Winnipeg', NULL, NULL),
(318, 'America', 'America/Yakutat', NULL, NULL),
(319, 'America', 'America/Yellowknife', NULL, NULL),
(320, 'Arctic', 'Arctic/Longyearbyen', NULL, NULL),
(321, 'Asia', 'Asia/Aden', NULL, NULL),
(322, 'Asia', 'Asia/Almaty', NULL, NULL),
(323, 'Asia', 'Asia/Amman', NULL, NULL),
(324, 'Asia', 'Asia/Anadyr', NULL, NULL),
(325, 'Asia', 'Asia/Aqtau', NULL, NULL),
(326, 'Asia', 'Asia/Aqtobe', NULL, NULL),
(327, 'Asia', 'Asia/Ashgabat', NULL, NULL),
(328, 'Asia', 'Asia/Ashkhabad', NULL, NULL),
(329, 'Asia', 'Asia/Baghdad', NULL, NULL),
(330, 'Asia', 'Asia/Bahrain', NULL, NULL),
(331, 'Asia', 'Asia/Baku', NULL, NULL),
(332, 'Asia', 'Asia/Bangkok', NULL, NULL),
(333, 'Asia', 'Asia/Beirut', NULL, NULL),
(334, 'Asia', 'Asia/Bishkek', NULL, NULL),
(335, 'Asia', 'Asia/Brunei', NULL, NULL),
(336, 'Asia', 'Asia/Calcutta', NULL, NULL),
(337, 'Asia', 'Asia/Choibalsan', NULL, NULL),
(338, 'Asia', 'Asia/Chongqing', NULL, NULL),
(339, 'Asia', 'Asia/Chungking', NULL, NULL),
(340, 'Asia', 'Asia/Colombo', NULL, NULL),
(341, 'Asia', 'Asia/Dacca', NULL, NULL),
(342, 'Asia', 'Asia/Damascus', NULL, NULL),
(343, 'Asia', 'Asia/Dhaka', NULL, NULL),
(344, 'Asia', 'Asia/Dili', NULL, NULL),
(345, 'Asia', 'Asia/Dubai', NULL, NULL),
(346, 'Asia', 'Asia/Dushanbe', NULL, NULL),
(347, 'Asia', 'Asia/Gaza', NULL, NULL),
(348, 'Asia', 'Asia/Harbin', NULL, NULL),
(349, 'Asia', 'Asia/Hebron', NULL, NULL),
(350, 'Asia', 'Asia/Ho_Chi_Minh', NULL, NULL),
(351, 'Asia', 'Asia/Hong_Kong', NULL, NULL),
(352, 'Asia', 'Asia/Hovd', NULL, NULL),
(353, 'Asia', 'Asia/Irkutsk', NULL, NULL),
(354, 'Asia', 'Asia/Istanbul', NULL, NULL),
(355, 'Asia', 'Asia/Jakarta', NULL, NULL),
(356, 'Asia', 'Asia/Jayapura', NULL, NULL),
(357, 'Asia', 'Asia/Jerusalem', NULL, NULL),
(358, 'Asia', 'Asia/Kabul', NULL, NULL),
(359, 'Asia', 'Asia/Kamchatka', NULL, NULL),
(360, 'Asia', 'Asia/Karachi', NULL, NULL),
(361, 'Asia', 'Asia/Kashgar', NULL, NULL),
(362, 'Asia', 'Asia/Kathmandu', NULL, NULL),
(363, 'Asia', 'Asia/Katmandu', NULL, NULL),
(364, 'Asia', 'Asia/Khandyga', NULL, NULL),
(365, 'Asia', 'Asia/Kolkata', NULL, NULL),
(366, 'Asia', 'Asia/Krasnoyarsk', NULL, NULL),
(367, 'Asia', 'Asia/Kuala_Lumpur', NULL, NULL),
(368, 'Asia', 'Asia/Kuching', NULL, NULL),
(369, 'Asia', 'Asia/Kuwait', NULL, NULL),
(370, 'Asia', 'Asia/Macao', NULL, NULL),
(371, 'Asia', 'Asia/Macau', NULL, NULL),
(372, 'Asia', 'Asia/Magadan', NULL, NULL),
(373, 'Asia', 'Asia/Makassar', NULL, NULL),
(374, 'Asia', 'Asia/Manila', NULL, NULL),
(375, 'Asia', 'Asia/Muscat', NULL, NULL),
(376, 'Asia', 'Asia/Nicosia', NULL, NULL),
(377, 'Asia', 'Asia/Novokuznetsk', NULL, NULL),
(378, 'Asia', 'Asia/Novosibirsk', NULL, NULL),
(379, 'Asia', 'Asia/Omsk', NULL, NULL),
(380, 'Asia', 'Asia/Oral', NULL, NULL),
(381, 'Asia', 'Asia/Phnom_Penh', NULL, NULL),
(382, 'Asia', 'Asia/Pontianak', NULL, NULL),
(383, 'Asia', 'Asia/Pyongyang', NULL, NULL),
(384, 'Asia', 'Asia/Qatar', NULL, NULL),
(385, 'Asia', 'Asia/Qyzylorda', NULL, NULL),
(386, 'Asia', 'Asia/Rangoon', NULL, NULL),
(387, 'Asia', 'Asia/Riyadh', NULL, NULL),
(388, 'Asia', 'Asia/Saigon', NULL, NULL),
(389, 'Asia', 'Asia/Sakhalin', NULL, NULL),
(390, 'Asia', 'Asia/Samarkand', NULL, NULL),
(391, 'Asia', 'Asia/Seoul', NULL, NULL),
(392, 'Asia', 'Asia/Shanghai', NULL, NULL),
(393, 'Asia', 'Asia/Singapore', NULL, NULL),
(394, 'Asia', 'Asia/Taipei', NULL, NULL),
(395, 'Asia', 'Asia/Tashkent', NULL, NULL),
(396, 'Asia', 'Asia/Tbilisi', NULL, NULL),
(397, 'Asia', 'Asia/Tehran', NULL, NULL),
(398, 'Asia', 'Asia/Tel_Aviv', NULL, NULL),
(399, 'Asia', 'Asia/Thimbu', NULL, NULL),
(400, 'Asia', 'Asia/Thimphu', NULL, NULL),
(401, 'Asia', 'Asia/Tokyo', NULL, NULL),
(402, 'Asia', 'Asia/Ujung_Pandang', NULL, NULL),
(403, 'Asia', 'Asia/Ulaanbaatar', NULL, NULL),
(404, 'Asia', 'Asia/Ulan_Bator', NULL, NULL),
(405, 'Asia', 'Asia/Urumqi', NULL, NULL),
(406, 'Asia', 'Asia/Ust-Nera', NULL, NULL),
(407, 'Asia', 'Asia/Vientiane', NULL, NULL),
(408, 'Asia', 'Asia/Vladivostok', NULL, NULL),
(409, 'Asia', 'Asia/Yakutsk', NULL, NULL),
(410, 'Asia', 'Asia/Yekaterinburg', NULL, NULL),
(411, 'Asia', 'Asia/Yerevan', NULL, NULL),
(412, 'Atlantic', 'Atlantic/Azores', NULL, NULL),
(413, 'Atlantic', 'Atlantic/Bermuda', NULL, NULL),
(414, 'Atlantic', 'Atlantic/Canary', NULL, NULL),
(415, 'Atlantic', 'Atlantic/Cape_Verde', NULL, NULL),
(416, 'Atlantic', 'Atlantic/Faeroe', NULL, NULL),
(417, 'Atlantic', 'Atlantic/Faroe', NULL, NULL),
(418, 'Atlantic', 'Atlantic/Jan_Mayen', NULL, NULL),
(419, 'Atlantic', 'Atlantic/Madeira', NULL, NULL),
(420, 'Atlantic', 'Atlantic/Reykjavik', NULL, NULL),
(421, 'Atlantic', 'Atlantic/South_Georgia', NULL, NULL),
(422, 'Atlantic', 'Atlantic/St_Helena', NULL, NULL),
(423, 'Atlantic', 'Atlantic/Stanley', NULL, NULL),
(424, 'Australia', 'Australia/ACT', NULL, NULL),
(425, 'Australia', 'Australia/Adelaide', NULL, NULL),
(426, 'Australia', 'Australia/Brisbane', NULL, NULL),
(427, 'Australia', 'Australia/Broken_Hill', NULL, NULL),
(428, 'Australia', 'Australia/Canberra', NULL, NULL),
(429, 'Australia', 'Australia/Currie', NULL, NULL),
(430, 'Australia', 'Australia/Darwin', NULL, NULL),
(431, 'Australia', 'Australia/Eucla', NULL, NULL),
(432, 'Australia', 'Australia/Hobart', NULL, NULL),
(433, 'Australia', 'Australia/LHI', NULL, NULL),
(434, 'Australia', 'Australia/Lindeman', NULL, NULL),
(435, 'Australia', 'Australia/Lord_Howe', NULL, NULL),
(436, 'Australia', 'Australia/Melbourne', NULL, NULL),
(437, 'Australia', 'Australia/North', NULL, NULL),
(438, 'Australia', 'Australia/NSW', NULL, NULL),
(439, 'Australia', 'Australia/Perth', NULL, NULL),
(440, 'Australia', 'Australia/Queensland', NULL, NULL),
(441, 'Australia', 'Australia/South', NULL, NULL),
(442, 'Australia', 'Australia/Sydney', NULL, NULL),
(443, 'Australia', 'Australia/Tasmania', NULL, NULL),
(444, 'Australia', 'Australia/Victoria', NULL, NULL),
(445, 'Australia', 'Australia/West', NULL, NULL),
(446, 'Australia', 'Australia/Yancowinna', NULL, NULL),
(447, 'Europe', 'Europe/Amsterdam', NULL, NULL),
(448, 'Europe', 'Europe/Andorra', NULL, NULL),
(449, 'Europe', 'Europe/Athens', NULL, NULL),
(450, 'Europe', 'Europe/Belfast', NULL, NULL),
(451, 'Europe', 'Europe/Belgrade', NULL, NULL),
(452, 'Europe', 'Europe/Berlin', NULL, NULL),
(453, 'Europe', 'Europe/Bratislava', NULL, NULL),
(454, 'Europe', 'Europe/Brussels', NULL, NULL),
(455, 'Europe', 'Europe/Bucharest', NULL, NULL),
(456, 'Europe', 'Europe/Budapest', NULL, NULL),
(457, 'Europe', 'Europe/Busingen', NULL, NULL),
(458, 'Europe', 'Europe/Chisinau', NULL, NULL),
(459, 'Europe', 'Europe/Copenhagen', NULL, NULL),
(460, 'Europe', 'Europe/Dublin', NULL, NULL),
(461, 'Europe', 'Europe/Gibraltar', NULL, NULL),
(462, 'Europe', 'Europe/Guernsey', NULL, NULL),
(463, 'Europe', 'Europe/Helsinki', NULL, NULL),
(464, 'Europe', 'Europe/Isle_of_Man', NULL, NULL),
(465, 'Europe', 'Europe/Istanbul', NULL, NULL),
(466, 'Europe', 'Europe/Jersey', NULL, NULL),
(467, 'Europe', 'Europe/Kaliningrad', NULL, NULL),
(468, 'Europe', 'Europe/Kiev', NULL, NULL),
(469, 'Europe', 'Europe/Lisbon', NULL, NULL),
(470, 'Europe', 'Europe/Ljubljana', NULL, NULL),
(471, 'Europe', 'Europe/London', NULL, NULL),
(472, 'Europe', 'Europe/Luxembourg', NULL, NULL),
(473, 'Europe', 'Europe/Madrid', NULL, NULL),
(474, 'Europe', 'Europe/Malta', NULL, NULL),
(475, 'Europe', 'Europe/Mariehamn', NULL, NULL),
(476, 'Europe', 'Europe/Minsk', NULL, NULL),
(477, 'Europe', 'Europe/Monaco', NULL, NULL),
(478, 'Europe', 'Europe/Moscow', NULL, NULL),
(479, 'Europe', 'Europe/Nicosia', NULL, NULL),
(480, 'Europe', 'Europe/Oslo', NULL, NULL),
(481, 'Europe', 'Europe/Paris', NULL, NULL),
(482, 'Europe', 'Europe/Podgorica', NULL, NULL),
(483, 'Europe', 'Europe/Prague', NULL, NULL),
(484, 'Europe', 'Europe/Riga', NULL, NULL),
(485, 'Europe', 'Europe/Rome', NULL, NULL),
(486, 'Europe', 'Europe/Samara', NULL, NULL),
(487, 'Europe', 'Europe/San_Marino', NULL, NULL),
(488, 'Europe', 'Europe/Sarajevo', NULL, NULL),
(489, 'Europe', 'Europe/Simferopol', NULL, NULL),
(490, 'Europe', 'Europe/Skopje', NULL, NULL),
(491, 'Europe', 'Europe/Sofia', NULL, NULL),
(492, 'Europe', 'Europe/Stockholm', NULL, NULL),
(493, 'Europe', 'Europe/Tallinn', NULL, NULL),
(494, 'Europe', 'Europe/Tirane', NULL, NULL),
(495, 'Europe', 'Europe/Tiraspol', NULL, NULL),
(496, 'Europe', 'Europe/Uzhgorod', NULL, NULL),
(497, 'Europe', 'Europe/Vaduz', NULL, NULL),
(498, 'Europe', 'Europe/Vatican', NULL, NULL),
(499, 'Europe', 'Europe/Vienna', NULL, NULL),
(500, 'Europe', 'Europe/Vilnius', NULL, NULL),
(501, 'Europe', 'Europe/Volgograd', NULL, NULL),
(502, 'Europe', 'Europe/Warsaw', NULL, NULL),
(503, 'Europe', 'Europe/Zagreb', NULL, NULL),
(504, 'Europe', 'Europe/Zaporozhye', NULL, NULL),
(505, 'Europe', 'Europe/Zurich', NULL, NULL),
(506, 'Indian', 'Indian/Antananarivo', NULL, NULL),
(507, 'Indian', 'Indian/Chagos', NULL, NULL),
(508, 'Indian', 'Indian/Christmas', NULL, NULL),
(509, 'Indian', 'Indian/Cocos', NULL, NULL),
(510, 'Indian', 'Indian/Comoro', NULL, NULL),
(511, 'Indian', 'Indian/Kerguelen', NULL, NULL),
(512, 'Indian', 'Indian/Mahe', NULL, NULL),
(513, 'Indian', 'Indian/Maldives', NULL, NULL),
(514, 'Indian', 'Indian/Mauritius', NULL, NULL),
(515, 'Indian', 'Indian/Mayotte', NULL, NULL),
(516, 'Indian', 'Indian/Reunion', NULL, NULL),
(517, 'Pacific', 'Pacific/Apia', NULL, NULL),
(518, 'Pacific', 'Pacific/Auckland', NULL, NULL),
(519, 'Pacific', 'Pacific/Chatham', NULL, NULL),
(520, 'Pacific', 'Pacific/Chuuk', NULL, NULL),
(521, 'Pacific', 'Pacific/Easter', NULL, NULL),
(522, 'Pacific', 'Pacific/Efate', NULL, NULL),
(523, 'Pacific', 'Pacific/Enderbury', NULL, NULL),
(524, 'Pacific', 'Pacific/Fakaofo', NULL, NULL),
(525, 'Pacific', 'Pacific/Fiji', NULL, NULL),
(526, 'Pacific', 'Pacific/Funafuti', NULL, NULL),
(527, 'Pacific', 'Pacific/Galapagos', NULL, NULL),
(528, 'Pacific', 'Pacific/Gambier', NULL, NULL),
(529, 'Pacific', 'Pacific/Guadalcanal', NULL, NULL),
(530, 'Pacific', 'Pacific/Guam', NULL, NULL),
(531, 'Pacific', 'Pacific/Honolulu', NULL, NULL),
(532, 'Pacific', 'Pacific/Johnston', NULL, NULL),
(533, 'Pacific', 'Pacific/Kiritimati', NULL, NULL),
(534, 'Pacific', 'Pacific/Kosrae', NULL, NULL),
(535, 'Pacific', 'Pacific/Kwajalein', NULL, NULL),
(536, 'Pacific', 'Pacific/Majuro', NULL, NULL),
(537, 'Pacific', 'Pacific/Marquesas', NULL, NULL),
(538, 'Pacific', 'Pacific/Midway', NULL, NULL),
(539, 'Pacific', 'Pacific/Nauru', NULL, NULL),
(540, 'Pacific', 'Pacific/Niue', NULL, NULL),
(541, 'Pacific', 'Pacific/Norfolk', NULL, NULL),
(542, 'Pacific', 'Pacific/Noumea', NULL, NULL),
(543, 'Pacific', 'Pacific/Pago_Pago', NULL, NULL),
(544, 'Pacific', 'Pacific/Palau', NULL, NULL),
(545, 'Pacific', 'Pacific/Pitcairn', NULL, NULL),
(546, 'Pacific', 'Pacific/Pohnpei', NULL, NULL),
(547, 'Pacific', 'Pacific/Ponape', NULL, NULL),
(548, 'Pacific', 'Pacific/Port_Moresby', NULL, NULL),
(549, 'Pacific', 'Pacific/Rarotonga', NULL, NULL),
(550, 'Pacific', 'Pacific/Saipan', NULL, NULL),
(551, 'Pacific', 'Pacific/Samoa', NULL, NULL),
(552, 'Pacific', 'Pacific/Tahiti', NULL, NULL),
(553, 'Pacific', 'Pacific/Tarawa', NULL, NULL),
(554, 'Pacific', 'Pacific/Tongatapu', NULL, NULL),
(555, 'Pacific', 'Pacific/Truk', NULL, NULL),
(556, 'Pacific', 'Pacific/Wake', NULL, NULL),
(557, 'Pacific', 'Pacific/Wallis', NULL, NULL),
(558, 'Pacific', 'Pacific/Yap', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uploads/users/profile/user.png',
  `is_banned` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Banned, 0 = Active',
  `banned_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `provider_id`, `name`, `email`, `is_admin`, `role_id`, `email_verified_at`, `password`, `profile_pic`, `is_banned`, `banned_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Salman Rahman Auvi', 'salman.auvi1@gmail.com', 1, 1, NULL, '$2a$12$g2HsnB66pGKr1lIHB5u45.Flygb.HUnipoeyy0Y5D.5zJPKV4kGOa', 'uploads/users/profile/user.png', 0, NULL, NULL, 'CtCKXG8lo2jH1RWloaz9hnM13x6npDc7Z0FG30dI6yCqsqwo1goWIICmfVS1', '2020-01-15 12:35:35', '2020-01-15 12:35:35'),
(9, NULL, 'Jack Rahman', 'jack@jack.com', 0, 1, NULL, '$2y$10$pOnELrODQOqHyumECPaNdOorvJ8JliyNTxpdmxoHbOAYBf7n2f3pa', 'uploads/users/profile/158036539161424320-1543220622476928-4570649293836255232-n.jpg', 0, 1, 1, NULL, '2020-01-30 00:23:11', '2020-05-09 10:01:19'),
(10, NULL, 'Norendra Modi', 'admin@admin.com', 0, 2, NULL, '$2y$10$pOnELrODQOqHyumECPaNdOorvJ8JliyNTxpdmxoHbOAYBf7n2f3pa', 'uploads/users/profile/user.png', 1, 1, 1, 'wqduOZ6LB6JpUOf5acS2TkNP25TqWhJzFPlO2gfEf3fEsrycaY1d8g3v7HFt', '2020-01-15 12:35:35', '2020-02-27 03:12:21'),
(13, NULL, 'HR dept', 'hr@hr.com', 1, 1, NULL, '$2y$10$pOnELrODQOqHyumECPaNdOorvJ8JliyNTxpdmxoHbOAYBf7n2f3pa', 'uploads/users/profile/user.png', 0, 1, 1, NULL, '2020-02-25 04:14:00', '2020-03-14 08:32:49'),
(14, NULL, 'temp', 'temp@temp.com', 0, 1, NULL, '$2y$10$pOnELrODQOqHyumECPaNdOorvJ8JliyNTxpdmxoHbOAYBf7n2f3pa', 'uploads/users/profile/158262589883845504-2461722073934165-7316041042828984320-n.jpg', 0, NULL, NULL, NULL, '2020-02-25 04:18:18', '2020-02-25 05:43:32'),
(20, '3885927291481848', 'Salman Rahman Auvi', 'salman.auvi@gmail.com', 1, 1, NULL, '$2a$12$g2HsnB66pGKr1lIHB5u45.Flygb.HUnipoeyy0Y5D.5zJPKV4kGOa', 'https://graph.facebook.com/v3.3/3885927291481848/picture?type=normal', 0, NULL, NULL, '8PxAyAFKTowuYZfB5OI7NxveWAhEg7btVd5qB8xs7nbu95aCcdhPJdXPAAiP', '2020-05-24 03:16:14', '2020-05-24 03:16:14'),
(21, '105368689021703543791', 'Salman Rahman Auvi', 'salman.auvi@northsouth.edu', 0, 1, NULL, NULL, 'https://lh3.googleusercontent.com/a-/AOh14GirTunNTpwJHAjlV-QlEtxZZdciQK09Snb99nIZ', 0, NULL, NULL, NULL, '2020-05-30 10:30:03', '2020-05-30 10:30:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`);

--
-- Indexes for table `email_configs`
--
ALTER TABLE `email_configs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_configs_settings_id_foreign` (`settings_id`),
  ADD KEY `email_configs_host_index` (`host`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_histories`
--
ALTER TABLE `login_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_histories_user_id_foreign` (`user_id`);

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
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_gateways_gateway_name_index` (`gateway_name`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tag_post_id_foreign` (`post_id`),
  ADD KEY `post_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_product_slug_index` (`product_slug`);

--
-- Indexes for table `products_tag`
--
ALTER TABLE `products_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_tag_products_id_foreign` (`products_id`),
  ADD KEY `products_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_role_index` (`role`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_ticket_contents`
--
ALTER TABLE `support_ticket_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_name_index` (`name`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timezones_timezone_index` (`timezone`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_configs`
--
ALTER TABLE `email_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_histories`
--
ALTER TABLE `login_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_tag`
--
ALTER TABLE `products_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `support_ticket_contents`
--
ALTER TABLE `support_ticket_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=559;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `email_configs`
--
ALTER TABLE `email_configs`
  ADD CONSTRAINT `email_configs_settings_id_foreign` FOREIGN KEY (`settings_id`) REFERENCES `general_settings` (`id`);

--
-- Constraints for table `login_histories`
--
ALTER TABLE `login_histories`
  ADD CONSTRAINT `login_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `products_tag`
--
ALTER TABLE `products_tag`
  ADD CONSTRAINT `products_tag_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
