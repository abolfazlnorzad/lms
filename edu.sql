-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2021 at 04:05 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edu`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `parent_id`, `created_at`, `updated_at`) VALUES
(4, 'برنامه نویسی', 'programming', NULL, '2021-03-21 10:24:02', '2021-03-21 10:24:02'),
(5, 'گرافیک', 'graphic', NULL, '2021-03-21 10:24:16', '2021-03-21 10:24:16'),
(6, 'جاوا اسکریپت', 'java script', 4, '2021-03-21 10:24:26', '2021-03-21 10:24:26'),
(7, 'دارت', 'dart', 4, '2021-03-21 10:24:39', '2021-03-21 10:24:39'),
(8, 'افتر افکت', 'after effect', 5, '2021-03-21 10:25:03', '2021-03-21 10:25:29'),
(9, 'فتوشاپ', 'photoshop', 5, '2021-03-21 10:25:18', '2021-03-21 10:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` double(8,2) DEFAULT NULL,
  `price` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('free','cash') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('completed','not-completed','locked') COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmation_status` enum('accepted','pending','rejected') COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `banner_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `teacher_id`, `category_id`, `title`, `slug`, `priority`, `price`, `percent`, `type`, `status`, `confirmation_status`, `body`, `created_at`, `updated_at`, `banner_id`) VALUES
(1, 2, 6, 'دوره اموزش پروژه محور جاوا اسکریپت', 'tutorial-java-script', 1.00, '125000', '35', 'cash', 'completed', 'accepted', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.', '2021-03-21 10:27:13', '2021-03-26 04:02:28', 1),
(2, 4, 6, 'دوره اموزش پروژه محور ویو', 'tutorial-vue.js', 2.00, '200000', '45', 'cash', 'not-completed', 'accepted', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.', '2021-03-21 10:39:38', '2021-03-26 04:26:06', 6);

-- --------------------------------------------------------

--
-- Table structure for table `course_user`
--

CREATE TABLE `course_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_user`
--

INSERT INTO `course_user` (`user_id`, `course_id`, `created_at`, `updated_at`) VALUES
(4, 1, NULL, NULL),
(5, 2, NULL, NULL),
(6, 1, NULL, NULL),
(6, 2, NULL, NULL),
(7, 2, NULL, NULL),
(8, 2, NULL, NULL),
(9, 2, NULL, NULL),
(10, 2, NULL, NULL);

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
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `season_id` bigint(20) UNSIGNED DEFAULT NULL,
  `media_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` tinyint(3) UNSIGNED DEFAULT NULL,
  `priority` int(10) UNSIGNED DEFAULT NULL,
  `free` tinyint(1) NOT NULL DEFAULT 0,
  `confirmation_status` enum('accepted','pending','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status` enum('opened','locked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'opened',
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `user_id`, `season_id`, `media_id`, `title`, `slug`, `time`, `priority`, `free`, `confirmation_status`, `status`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, 'آشنایی با جاوا اسکریپت', 'ashnayy-ba-gaoa-askrybt', 13, 1, 1, 'accepted', 'opened', NULL, '2021-03-21 10:29:27', '2021-03-21 10:37:01'),
(2, 1, 1, 1, 3, 'تفاوت EcmaScript با JavaScript', 'tfaot-ecmascript-ba-javascript', 8, 2, 1, 'accepted', 'opened', NULL, '2021-03-21 10:30:15', '2021-03-21 10:37:01'),
(3, 1, 1, 2, 4, 'هملگرهای منطقی', 'hmlgrhay-mntky', 7, 3, 0, 'accepted', 'opened', NULL, '2021-03-21 10:36:17', '2021-03-21 10:37:01'),
(4, 1, 1, 3, 5, 'عبارات شرطی', 'aabarat-shrty', 18, 4, 0, 'accepted', 'opened', NULL, '2021-03-21 10:36:45', '2021-03-21 10:37:01'),
(5, 2, 1, 5, 7, 'مقدمه', 'mkdmh', 5, 1, 1, 'accepted', 'opened', NULL, '2021-03-21 10:41:19', '2021-03-21 10:41:58'),
(6, 2, 1, 6, 8, 'vue-basic', 'vue-basic', 18, 2, 0, 'accepted', 'opened', NULL, '2021-03-21 10:41:52', '2021-03-21 10:41:58');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`files`)),
  `type` enum('image','video','audio','zip','doc') COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_private` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `user_id`, `files`, `type`, `filename`, `is_private`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"original\":\"605750b918a6a.png\",\"300\":\"605750b918a6a300.png\",\"600\":\"605750b918a6a600.png\"}', 'image', 'ba23cdfe71.png', 0, '2021-03-21 10:27:13', '2021-03-21 10:27:13'),
(2, 1, '{\"video\":\"6057513f3f7d4.mp4\"}', 'video', '4cb1932543762cdb1a334f54139fea9a7392709-240p.mp4', 1, '2021-03-21 10:29:27', '2021-03-21 10:29:27'),
(3, 1, '{\"zip\":\"6057516fdb1dc.zip\"}', 'zip', 'Lilex-1.100.zip', 1, '2021-03-21 10:30:15', '2021-03-21 10:30:15'),
(4, 1, '{\"zip\":\"605752d964c27.zip\"}', 'zip', 'Lilex-1.100.zip', 1, '2021-03-21 10:36:17', '2021-03-21 10:36:17'),
(5, 1, '{\"zip\":\"605752f5e5dd7.zip\"}', 'zip', 'Lilex-1.100.zip', 1, '2021-03-21 10:36:45', '2021-03-21 10:36:45'),
(6, 1, '{\"original\":\"605753a2d99ca.png\",\"300\":\"605753a2d99ca300.png\",\"600\":\"605753a2d99ca600.png\"}', 'image', 'download (1).png', 0, '2021-03-21 10:39:38', '2021-03-21 10:39:38'),
(7, 1, '{\"video\":\"60575407137a7.mp4\"}', 'video', '4cb1932543762cdb1a334f54139fea9a7392709-240p.mp4', 1, '2021-03-21 10:41:19', '2021-03-21 10:41:19'),
(8, 1, '{\"zip\":\"60575428391d7.zip\"}', 'zip', 'Lilex-1.100.zip', 1, '2021-03-21 10:41:52', '2021-03-21 10:41:52'),
(10, 12, '{\"original\":\"605dc75425d25.png\",\"300\":\"605dc75425d25300.png\",\"600\":\"605dc75425d25600.png\"}', 'image', '244-2441777_profile-clipart-manager-manager-cartoon-transparent.png', 0, '2021-03-26 07:06:52', '2021-03-26 07:06:52');

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
(4, '2020_12_24_141128_create_categories_table', 1),
(5, '2020_12_26_074248_create_courses_table', 1),
(6, '2020_12_27_095636_create_media_table', 1),
(7, '2020_12_28_061633_add_column_to_courses_table', 1),
(8, '2020_12_29_142537_create_permissions_and_roles_tables', 1),
(9, '2021_01_02_091330_add_column_to_users_table', 1),
(10, '2021_01_04_144556_create_seasons_table', 1),
(11, '2021_01_05_071525_create_lessons_table', 1),
(12, '2021_01_10_084809_course_student', 1),
(13, '2021_01_10_122605_create_payments_table', 1),
(15, '2021_03_22_100645_create_settlements_table', 2);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `paymentable_id` bigint(20) UNSIGNED NOT NULL,
  `paymentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gateway` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','canceled','success','fail') COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_p` tinyint(3) UNSIGNED NOT NULL,
  `seller_share` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_share` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `buyer_id`, `seller_id`, `paymentable_id`, `paymentable_type`, `amount`, `invoice_id`, `gateway`, `status`, `seller_p`, `seller_share`, `site_share`, `created_at`, `updated_at`) VALUES
(3, 5, 4, 2, 'Nrz\\Course\\Model\\Course', '200000', '000000000000000000000000000000417990', 'Zarinpal', 'success', 45, '90000', '110000', '2021-03-22 02:05:10', '2021-03-22 02:05:13'),
(4, 7, 4, 2, 'Nrz\\Course\\Model\\Course', '200000', '000000000000000000000000000000418034', 'Zarinpal', 'success', 45, '90000', '110000', '2021-03-22 03:13:21', '2021-03-22 03:13:24'),
(5, 6, 2, 1, 'Nrz\\Course\\Model\\Course', '125000', '000000000000000000000000000000418043', 'Zarinpal', 'success', 35, '43750', '81250', '2021-03-22 03:32:09', '2021-03-22 03:32:11'),
(6, 6, 4, 2, 'Nrz\\Course\\Model\\Course', '200000', '000000000000000000000000000000418159', 'Zarinpal', 'success', 45, '90000', '110000', '2021-03-22 05:14:45', '2021-03-22 05:14:48'),
(7, 8, 4, 2, 'Nrz\\Course\\Model\\Course', '200000', '000000000000000000000000000000418160', 'Zarinpal', 'success', 45, '90000', '110000', '2021-03-22 05:16:32', '2021-03-22 05:16:35'),
(8, 5, 2, 1, 'Nrz\\Course\\Model\\Course', '125000', '000000000000000000000000000000418166', 'Zarinpal', 'fail', 35, '43750', '81250', '2021-03-22 05:24:48', '2021-03-22 05:26:23'),
(9, 5, 2, 1, 'Nrz\\Course\\Model\\Course', '125000', '000000000000000000000000000000418168', 'Zarinpal', 'fail', 35, '43750', '81250', '2021-03-22 05:26:30', '2021-03-22 05:26:44'),
(10, 5, 2, 1, 'Nrz\\Course\\Model\\Course', '125000', '000000000000000000000000000000418169', 'Zarinpal', 'fail', 35, '43750', '81250', '2021-03-22 05:26:48', '2021-03-22 05:27:05'),
(11, 5, 2, 1, 'Nrz\\Course\\Model\\Course', '125000', '000000000000000000000000000000418170', 'Zarinpal', 'fail', 35, '43750', '81250', '2021-03-22 05:27:09', '2021-03-22 05:29:07'),
(12, 5, 2, 1, 'Nrz\\Course\\Model\\Course', '125000', '000000000000000000000000000000418171', 'Zarinpal', 'fail', 35, '43750', '81250', '2021-03-22 05:29:11', '2021-03-22 05:29:26'),
(13, 5, 2, 1, 'Nrz\\Course\\Model\\Course', '125000', '000000000000000000000000000000418172', 'Zarinpal', 'fail', 35, '43750', '81250', '2021-03-22 05:29:29', '2021-03-22 05:29:39'),
(14, 9, 4, 2, 'Nrz\\Course\\Model\\Course', '200000', '000000000000000000000000000000418174', 'Zarinpal', 'success', 45, '90000', '110000', '2021-03-22 05:31:17', '2021-03-22 05:31:19'),
(15, 10, 4, 2, 'Nrz\\Course\\Model\\Course', '200000', '000000000000000000000000000000418177', 'Zarinpal', 'success', 45, '90000', '110000', '2021-03-22 05:33:13', '2021-03-22 05:33:16'),
(16, 4, 2, 1, 'Nrz\\Course\\Model\\Course', '125000', '000000000000000000000000000000419451', 'Zarinpal', 'success', 35, '43750', '81250', '2021-03-23 05:07:21', '2021-03-23 05:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'teach', 'مدرس', '2021-03-21 10:20:13', '2021-03-21 10:20:13'),
(2, 'create-acl', 'ایجاد نقش یا سطح دسترسی جدید', '2021-03-25 07:37:17', '2021-03-25 07:37:17'),
(3, 'edit-acl', 'ویرایش نقش یا سطح دسترسی', '2021-03-25 07:37:40', '2021-03-25 07:37:40'),
(4, 'delete-acl', 'حذف نقش یا سطح دسترسی', '2021-03-25 07:38:00', '2021-03-25 07:38:00'),
(5, 'show-acl', 'نمایش سطوح دسترسی و نقش های کاربری', '2021-03-25 07:38:21', '2021-03-25 07:38:21'),
(6, 'show-user', 'مشاهده کاربران', '2021-03-26 02:49:12', '2021-03-26 02:49:12'),
(7, 'edit-user', 'ویرایش کاربر', '2021-03-26 02:49:40', '2021-03-26 02:49:40'),
(8, 'delete-user', 'حذف کاربر', '2021-03-26 02:49:48', '2021-03-26 02:49:48'),
(9, 'show-category', 'مشاهده دسته بندی ها', '2021-03-26 02:55:41', '2021-03-26 02:55:54'),
(10, 'create-category', 'ایجاد دسته بندی', '2021-03-26 02:56:11', '2021-03-26 02:56:11'),
(11, 'edit-category', 'ویرایش دسته بندی', '2021-03-26 02:56:31', '2021-03-26 02:56:31'),
(12, 'delete-category', 'حذف دسته بندی', '2021-03-26 02:57:24', '2021-03-26 02:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 2, NULL, NULL),
(4, 4, 2, NULL, NULL),
(5, 5, 2, NULL, NULL),
(6, 6, 3, NULL, NULL),
(7, 7, 3, NULL, NULL),
(8, 8, 3, NULL, NULL),
(9, 9, 4, NULL, NULL),
(10, 10, 4, NULL, NULL),
(11, 11, 4, NULL, NULL),
(12, 12, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`id`, `user_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'teach', 'مدرس', '2021-03-21 10:20:24', '2021-03-21 10:20:24'),
(2, 'manage-acl', 'مدیریت نقش های کاربری', '2021-03-25 07:38:43', '2021-03-25 07:38:43'),
(3, 'manage-user', 'مدیریت کاربران', '2021-03-26 02:50:24', '2021-03-26 02:50:24'),
(4, 'manage-category', 'مدیریت دسته بندی', '2021-03-26 02:57:48', '2021-03-26 02:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, NULL, NULL),
(2, 3, 2, NULL, NULL),
(3, 10, 3, NULL, NULL),
(5, 9, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` tinyint(3) UNSIGNED NOT NULL,
  `confirmation_status` enum('accepted','pending','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status` enum('opened','locked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'opened',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `user_id`, `course_id`, `title`, `number`, `confirmation_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'مفدمه', 1, 'accepted', 'opened', '2021-03-21 10:27:40', '2021-03-21 10:28:23'),
(2, 1, 1, 'عملگر ها', 2, 'accepted', 'opened', '2021-03-21 10:27:53', '2021-03-21 10:28:26'),
(3, 1, 1, 'عبارت های شرطی', 3, 'accepted', 'opened', '2021-03-21 10:28:05', '2021-03-21 10:28:28'),
(4, 1, 1, 'توابع', 4, 'accepted', 'opened', '2021-03-21 10:28:15', '2021-03-21 10:28:30'),
(5, 1, 2, 'مقدمه', 1, 'accepted', 'opened', '2021-03-21 10:39:56', '2021-03-21 10:40:54'),
(6, 1, 2, 'اشنایی با موارد مقدماتی', 2, 'accepted', 'opened', '2021-03-21 10:40:22', '2021-03-21 10:40:51'),
(7, 1, 2, 'ویو روتر', 3, 'accepted', 'opened', '2021-03-21 10:40:39', '2021-03-21 10:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `settlements`
--

CREATE TABLE `settlements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `from` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`from`)),
  `to` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`to`)),
  `settled_at` timestamp NULL DEFAULT NULL,
  `status` enum('canceled','pending','rejected','settled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `amount` double(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settlements`
--

INSERT INTO `settlements` (`id`, `transaction_id`, `user_id`, `from`, `to`, `settled_at`, `status`, `amount`, `created_at`, `updated_at`) VALUES
(2, NULL, 4, '{\"cart\":\"62802313246474\",\"name\":\"\\u0639\\u0644\\u06cc\"}', '{\"cart\":\"6104337822093397\",\"name\":\"\\u0627\\u0628\\u0648\\u0627\\u0644\\u0641\\u0636\\u0644 \\u0646\\u0648\\u0631\\u0632\\u0627\\u062f\"}', NULL, 'rejected', 5000.00, '2021-03-22 08:53:54', '2021-03-22 10:22:05'),
(3, NULL, 4, '{\"cart\":null,\"name\":null}', '{\"cart\":\"10000\",\"name\":\"\\u0627\\u0628\\u0648\\u0627\\u0644\\u0641\\u0636\\u0644 \\u0646\\u0648\\u0631\\u0632\\u0627\\u062f\"}', NULL, 'rejected', 90000.00, '2021-03-23 04:57:24', '2021-03-23 05:03:06'),
(4, NULL, 4, '{\"cart\":null,\"name\":null}', '{\"cart\":\"61043378220983397\",\"name\":\"\\u0627\\u0628\\u0648\\u0627\\u0644\\u0641\\u0636\\u0644 \\u0646\\u0648\\u0631\\u0632\\u0627\\u062f\"}', NULL, 'rejected', 10000.00, '2021-03-23 05:03:27', '2021-03-24 04:28:51'),
(5, NULL, 4, '{\"cart\":\"62802313246474\",\"name\":\"\\u0639\\u0644\\u06cc\"}', '{\"cart\":\"61043378220983397\",\"name\":\"abol\"}', NULL, 'settled', 80000.00, '2021-03-24 03:04:00', '2021-03-24 03:07:27'),
(6, NULL, 2, NULL, '{\"cart\":\"61043378220983397\",\"name\":\"\\u0639\\u0644\\u06cc\"}', NULL, 'pending', 10000.00, '2021-03-24 04:37:46', '2021-03-24 04:37:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_staff` tinyint(1) NOT NULL DEFAULT 0,
  `balance` bigint(20) NOT NULL DEFAULT 0,
  `headline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shaba` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','ban') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `username`, `is_admin`, `is_staff`, `balance`, `headline`, `bio`, `ip`, `card_number`, `shaba`, `telegram`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `image_id`) VALUES
(1, 'ابوالفضل', 'abol@gmail.com', '09011216131', 'abol', 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2021-03-21 10:17:43', '$2y$10$FNucXFynrP1MQrRdB7nCN.FyMkm3yFGFREzh9yEpfwUlTW/YfXDbS', 'zD3916RwoaGpdKF1yIpJH1TlPxJcYHgJXVX6jR2lMfgVxB7FTetvEUZaXEqy', '2021-03-21 10:16:51', '2021-03-21 10:17:43', NULL),
(2, 'علی', 'ali@gmail.com', '09011216132', 'ali', 0, 0, 33750, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2021-03-21 10:17:43', '$2y$10$FNucXFynrP1MQrRdB7nCN.FyMkm3yFGFREzh9yEpfwUlTW/YfXDbS', 'BfQeSjJg3qBpOkySBNMVJ6gVBkAVwfud0HiOrnQpCYXRb4LNnGxiik1eOAwC', '2021-03-21 10:16:51', '2021-03-24 04:37:46', NULL),
(3, 'رضا', 'aclmanager@gmail.com', '09011216133', 'reza', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2021-03-21 10:17:43', '$2y$10$FNucXFynrP1MQrRdB7nCN.FyMkm3yFGFREzh9yEpfwUlTW/YfXDbS', 'H5IihAKy5vzvp08HXTnlFRrjTqVeDC28GYDyHIyB6BQJDVZEBZDiwiCLYUCc', '2021-03-21 10:16:51', '2021-03-26 02:44:10', NULL),
(4, 'امیر', 'amir@gmail.com', '09011216134', 'amir', 0, 0, 10000, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2021-03-21 10:17:43', '$2y$10$FNucXFynrP1MQrRdB7nCN.FyMkm3yFGFREzh9yEpfwUlTW/YfXDbS', 'oBZfclG33rlJo9QItCXMrst2gt4RcsT4YchPEDnK9VWo4kkk2ibzjJbVUUVV', '2021-03-21 10:16:51', '2021-03-24 04:28:51', NULL),
(5, 'علیرضا', 'stu1@gmail.com', '09011545564', 'alireza', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2021-03-21 10:33:32', '$2y$10$EifemGhEOxFy1BcKPzW9WexqvTXlsDl1a0lZA9dLdmVSRUjbaaLH6', '4krzkdWc2IJIeSGpKTFlfvBYOXqJLqDX1El6QGsj00g0LqjvVsF1FL91YEPl', '2021-03-21 10:32:53', '2021-03-21 10:33:32', NULL),
(6, 'بردیاا', 'stu2@gmail.com', '09011655644', 'bardiaa', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2021-03-21 10:34:20', '$2y$10$xGAKR.uqe33xvzBNgdVyj.7oJf/CWHpwsTy6bsyKsGxnzNDQ.5mAa', 'lWciwNaD7sORXmbDSmI8EV3QtbwxfbCVPKAJ6j9CqpXsmBI7TTwDozq2yGko', '2021-03-21 10:34:05', '2021-03-26 02:52:53', NULL),
(7, 'امیرحسین', 'stu3@gmail.com', '09025545666', 'amirhossein', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2021-03-21 10:35:35', '$2y$10$nCHJhbeFbnSBhIce0OqNZOuDE7oIs3aWkL6LobRu4ew0PfB.s77LK', 'DOSvWFVZKRhJIcPRnJPFAr7e47eZykHIqzdfnrLWHvxkA56coqIED6cuU21a', '2021-03-21 10:35:21', '2021-03-21 10:35:35', NULL),
(8, 'مبین', 'stu4@gmail.com', '09011216188', 'mobin', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2021-03-22 05:16:19', '$2y$10$mVr4p3MnRE.S9D3uplLE/..reBzAMVv0wV/1hbXKqWNHYc/h1EaDO', NULL, '2021-03-22 05:15:55', '2021-03-22 05:16:19', NULL),
(9, 'احمد', 'categorymanager@gmail.com', '09011216897', 'ahmad', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2021-03-22 05:31:06', '$2y$10$sABoRF4LZ0uajBWnEdIpcuaN52uWGtLixkhpDUAsFPEjnGoAGS4sG', 'Jz25pxxwDfYzA5GpR9TnKIsOKZOCo7g0xfhBhIDDfDoqZ2TfWqVifab9nER5', '2021-03-22 05:30:49', '2021-03-26 02:58:34', NULL),
(10, 'متین', 'usermanager@gmail.com', '09011216898', 'matin', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2021-03-22 05:31:06', '$2y$10$sABoRF4LZ0uajBWnEdIpcuaN52uWGtLixkhpDUAsFPEjnGoAGS4sG', 'YiFyPLtNhaITuXnE8wCaXh2dQRnoIXlURG8ysmdqVrx0UBll4yjJLiKkiGs6', '2021-03-22 05:30:49', '2021-03-26 02:44:48', NULL),
(11, 'مدرس', 'teacher@gmail.com', '09046589874', 'teacher', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2021-03-25 11:54:12', '$2y$10$ZF0zIB1N7Cm3oUX6KVKmsuSkSKbwwagd8GB8kha25Y53xVdHvRiRe', NULL, '2021-03-25 07:22:39', '2021-03-25 07:22:39', NULL),
(12, 'دانشجو', 'user@gmail.com', '09056879631', 'daneshjo', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2021-03-25 11:54:14', '$2y$10$tRsa99wca2mfU5aKwh732uulfE.hfvXCsZV/uBrP1ftQIvuMDlw/K', 'ty0OHdq7e5rWmXpSZ6ud7NtQkhnMJmrP41udi6ehdUgo8Msujhi3czGGC5Fy', '2021-03-25 07:23:27', '2021-03-26 07:06:52', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_teacher_id_foreign` (`teacher_id`),
  ADD KEY `courses_category_id_foreign` (`category_id`),
  ADD KEY `courses_banner_id_foreign` (`banner_id`);

--
-- Indexes for table `course_user`
--
ALTER TABLE `course_user`
  ADD UNIQUE KEY `course_user_user_id_course_id_unique` (`user_id`,`course_id`),
  ADD KEY `course_user_course_id_foreign` (`course_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lessons_slug_unique` (`slug`),
  ADD KEY `lessons_course_id_foreign` (`course_id`),
  ADD KEY `lessons_user_id_foreign` (`user_id`),
  ADD KEY `lessons_season_id_foreign` (`season_id`),
  ADD KEY `lessons_media_id_foreign` (`media_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_user_id_foreign` (`user_id`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_buyer_id_foreign` (`buyer_id`),
  ADD KEY `payments_seller_id_foreign` (`seller_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_role_permission_id_role_id_unique` (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_user_user_id_permission_id_unique` (`user_id`,`permission_id`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_user_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seasons_user_id_foreign` (`user_id`),
  ADD KEY `seasons_course_id_foreign` (`course_id`);

--
-- Indexes for table `settlements`
--
ALTER TABLE `settlements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settlements_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_image_id_foreign` (`image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settlements`
--
ALTER TABLE `settlements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `courses_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_user`
--
ALTER TABLE `course_user`
  ADD CONSTRAINT `course_user_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lessons_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lessons_season_id_foreign` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lessons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payments_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seasons`
--
ALTER TABLE `seasons`
  ADD CONSTRAINT `seasons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `seasons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settlements`
--
ALTER TABLE `settlements`
  ADD CONSTRAINT `settlements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
