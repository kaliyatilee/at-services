-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2024 at 10:51 AM
-- Server version: 10.6.16-MariaDB-cll-lve
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leonappl_atservices`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id_number` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone1` varchar(20) NOT NULL,
  `phone2` varchar(20) DEFAULT NULL,
  `credit_allowed` int(11) NOT NULL DEFAULT 0 COMMENT '0 is false, 1 is true',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_registration`
--

CREATE TABLE `company_registration` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `charge` double(20,2) NOT NULL,
  `expenses` double(20,2) NOT NULL,
  `commission` double(20,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount_paid` double NOT NULL,
  `currency_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_registration_supplier`
--

CREATE TABLE `company_registration_supplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `location` varchar(40) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_registration_supplier`
--

INSERT INTO `company_registration_supplier` (`id`, `name`, `phone1`, `phone2`, `email`, `location`, `created_by`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Leon', '0771716528', NULL, NULL, 'Bulawayo', 1, 'any', '2024-02-05 13:59:08', '2024-02-05 13:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `exchange_rate` double(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `exchange_rate`, `created_at`, `updated_at`) VALUES
(1, 'USD', 1.00, '2024-02-02 16:23:57', '2024-02-02 16:23:57'),
(2, 'ZIG', 13.40, '2024-02-04 10:15:48', '2024-02-04 10:15:48'),
(3, 'ZAR', 20.00, '2024-02-20 20:39:44', '2024-02-20 20:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `dstv_packages`
--

CREATE TABLE `dstv_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dstv_packages`
--

INSERT INTO `dstv_packages` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Family', 1, '2024-01-31 16:49:14', '2024-01-31 16:49:14'),
(2, 'LITE', 1, '2024-03-01 09:03:13', NULL),
(3, 'ACCESS', 1, '2024-03-01 09:03:13', NULL),
(4, 'FAMILY', 1, '2024-03-01 09:03:13', NULL),
(5, 'COMPACT', 1, '2024-03-01 09:03:13', NULL),
(6, 'COMPACT PLUS', 1, '2024-03-01 09:03:13', NULL),
(7, 'PREMIUM', 1, '2024-03-01 09:03:13', NULL),
(8, 'SA LITE', 1, '2024-03-01 09:03:13', NULL),
(9, 'SA ACCESS', 1, '2024-03-01 09:03:13', NULL),
(10, 'SA FAMILY', 1, '2024-03-01 09:03:13', NULL),
(11, 'SA COMPACT', 1, '2024-03-01 09:03:13', NULL),
(12, 'SA COMPACT PLUS', 1, '2024-03-01 09:03:13', NULL),
(13, 'SA PREMIUM', 1, '2024-03-01 09:03:13', NULL),
(14, 'SA ACCOUNT PAYMENT', 1, '2024-03-01 09:03:13', NULL),
(15, 'TOPUP', 1, '2024-03-22 11:53:02', '2024-03-22 11:53:02'),
(16, 'OTHER', 1, '2024-03-22 11:53:02', '2024-03-22 11:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `dstv_payment`
--

CREATE TABLE `dstv_payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(5) NOT NULL,
  `dstv_transaction_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `amount_before` double(8,2) NOT NULL,
  `amount_after` double(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dstv_transaction`
--

CREATE TABLE `dstv_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dstv_account_number` varchar(255) DEFAULT NULL,
  `package_id` int(11) NOT NULL,
  `rate` text DEFAULT '0',
  `amount_paid` text NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `commission_usd` double(8,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `expected_amount` text NOT NULL,
  `currency_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dstv_transaction`
--


-- --------------------------------------------------------

--
-- Table structure for table `ecocash`
--

CREATE TABLE `ecocash` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `agent_line` int(11) NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `expected_amount` text NOT NULL,
  `amount_paid` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ecocash_agent_line`
--

CREATE TABLE `ecocash_agent_line` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ecocash_agent_line`
--

INSERT INTO `ecocash_agent_line` (`id`, `name`, `phone`, `notes`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Hum Agent', '0', NULL, 1, '2024-02-06 19:19:28', '2024-02-06 19:19:28'),
(2, 'Hum RBA', '0', NULL, 1, '2024-03-22 12:29:52', '2024-03-22 12:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `ecocash_transaction_type`
--

CREATE TABLE `ecocash_transaction_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ecocash_transaction_type`
--

INSERT INTO `ecocash_transaction_type` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Cash In', 1, '2024-02-06 17:13:13', '2024-02-06 17:13:13'),
(2, 'Cash Out', 1, '2024-02-06 19:21:59', '2024-02-06 19:21:59'),
(3, 'Artime', 1, '2024-02-07 14:18:55', '2024-02-07 14:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `eggs`
--

CREATE TABLE `eggs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cash_paid` double(50,2) DEFAULT 0.00,
  `quantity_received` int(11) NOT NULL DEFAULT 0,
  `order_price` double(50,2) NOT NULL DEFAULT 0.00,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `quantity_sold` int(11) NOT NULL DEFAULT 0,
  `breakages` int(11) NOT NULL DEFAULT 0,
  `name` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `currency_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eggs`
--

INSERT INTO `eggs` (`id`, `cash_paid`, `quantity_received`, `order_price`, `created_by`, `created_at`, `updated_at`, `notes`, `quantity_sold`, `breakages`, `name`, `phone`, `currency_id`) VALUES
(3, 55.00, 0, 0.00, 1, '2024-04-29 20:46:15', '2024-04-29 20:46:15', NULL, 0, 0, 'llll', NULL, 0);

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
-- Table structure for table `general_sales`
--

CREATE TABLE `general_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `currency` int(11) NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_sales`
--

INSERT INTO `general_sales` (`id`, `name`, `phone`, `currency`, `transaction_type`, `amount`, `created_by`, `notes`, `created_at`, `updated_at`, `payment_type`) VALUES
(3, 'zinara', '0', 1, 1, 20.00, 4, 'mutero payment eddie', '2024-04-21 10:02:43', '2024-04-21 10:02:43', 'Amount Given');

-- --------------------------------------------------------

--
-- Table structure for table `general_sales_transaction_type`
--

CREATE TABLE `general_sales_transaction_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_sales_transaction_type`
--

INSERT INTO `general_sales_transaction_type` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'ZINARA', 1, '2024-03-01 07:21:05', NULL),
(2, 'INSURANCE', 1, '2024-03-01 07:21:05', NULL),
(3, 'DSTV', 1, '2024-03-01 07:21:05', NULL),
(4, 'ECOCASH', 1, '2024-03-01 07:21:05', NULL),
(5, 'RTGS', 1, '2024-03-01 07:21:05', NULL),
(6, 'EGGS', 1, '2024-03-01 07:21:05', NULL),
(7, 'COMPANY REGISTRATION', 1, '2024-03-01 07:21:05', NULL),
(8, 'PERMANENT DISC', 1, '2024-03-01 07:21:05', NULL),
(9, 'LAZZY REPAYMENT', 1, '2024-03-01 07:21:05', NULL),
(10, 'MONSO REPAYMENT', 1, '2024-03-01 07:21:05', NULL),
(11, 'MAI NGAA REPAYMENT', 1, '2024-03-01 07:21:05', NULL),
(12, 'KULE SIMBA REPAYMENT', 1, '2024-03-01 07:21:05', NULL),
(13, 'PREPAYMENT', 1, '2024-03-25 13:43:56', '2024-03-25 13:43:56'),
(14, 'OTHER', 1, '2024-03-25 13:44:13', '2024-03-25 13:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_brooker`
--

CREATE TABLE `insurance_brooker` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `commission` double(8,2) NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insurance_brooker`
--

INSERT INTO `insurance_brooker` (`id`, `name`, `created_by`, `commission`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Clarion', 1, 25.00, '', '2024-02-04 13:09:44', '2024-02-04 13:09:44'),
(2, 'Hamilton', 1, 25.00, '', '2024-03-22 11:56:50', '2024-03-22 11:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `insurance_payment`
--

CREATE TABLE `insurance_payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `insurance_transaction_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `amount_before` double(8,2) NOT NULL,
  `amount_after` double(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_transaction`
--

CREATE TABLE `insurance_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `insurance_broker` int(11) NOT NULL,
  `reg_no` varchar(255) DEFAULT NULL,
  `expiry_date` date NOT NULL,
  `amount_paid` text NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `rate` text NOT NULL DEFAULT '0',
  `currency_id` int(11) NOT NULL,
  `expected_amount` text NOT NULL,
  `vehicle_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insurance_transaction`
--

INSERT INTO `insurance_transaction` (`id`, `created_by`, `class`, `insurance_broker`, `reg_no`, `expiry_date`, `amount_paid`, `notes`, `created_at`, `updated_at`, `name`, `phone`, `rate`, `currency_id`, `expected_amount`, `vehicle_type`) VALUES
(5, 4, 3, 2, 'AED5546', '2024-07-31', '0.0', 'already wrote 45 kuzinara section', '2024-04-04 09:11:47', '2024-04-04 09:11:47', 'NYEMBA', '0771601150', '0', 1, '0', 'BLADE'),
(6, 4, 3, 2, 'ACS2560', '2024-07-31', '0.0', 'already wrote 45 kuzinara', '2024-04-04 11:04:53', '2024-04-04 11:04:53', 'GIBSON', '0773568549', '0', 1, '0', 'Vitz');

-- --------------------------------------------------------

--
-- Table structure for table `loan_disbursed`
--

CREATE TABLE `loan_disbursed` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(8,2) NOT NULL,
  `rate_per_week` double(8,2) NOT NULL,
  `repayment_date` date NOT NULL,
  `collateral` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_payment`
--

CREATE TABLE `loan_payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `amount_before` double(8,2) NOT NULL,
  `amount_after` double(8,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_26_083530_create_insurance_brooker', 1),
(6, '2024_01_26_111309_create_insurance_payment', 1),
(7, '2024_01_26_112052_create_dstv_packages', 1),
(8, '2024_01_26_112440_create_dstv_payment', 1),
(9, '2024_01_26_132633_create_loan_disbursed', 1),
(10, '2024_01_26_135536_create_loan_payment', 1),
(11, '2024_01_26_112440_create_dstv_transaction', 2),
(12, '2024_01_26_192751_create_dstv_payment_table', 2),
(13, '2014_10_12_0000001_create_users_table', 3),
(14, '2024_01_26_0835301_create_insurance_brooker', 3),
(15, '2024_01_26_1113091_create_insurance_payment', 3),
(16, '2024_01_26_1120521_create_dstv_packages', 3),
(17, '2024_01_26_1124401_create_dstv_transaction', 3),
(18, '2024_01_26_1326331_create_loan_disbursed', 3),
(19, '2024_01_26_1355361_create_loan_payment', 3),
(20, '2024_01_26_1927511_create_dstv_payment_table', 3),
(21, '2024_01_28_201252_create_clients_table', 4),
(22, '2024_02_01_194002_create_currency_table', 5),
(23, '2024_01_26_1113091_create_insurance_transaction', 6),
(24, '2024_01_26_1355361_create_insurance_payment', 7),
(25, '2024_01_26_1113092_create_insurance_transaction', 8),
(26, '2024_01_26_1113093_create_insurance_transaction', 9),
(27, '2024_02_03_090538_create_vehicle_class', 10),
(28, '2024_02_04_155346_create_ecocash_table', 11),
(29, '2024_02_04_155411_create_rtgs_table', 11),
(30, '2024_02_04_155637_create_company_registration_table', 11),
(31, '2024_02_04_155654_create_permenant_disc_table', 11),
(32, '2024_02_04_155706_create_eggs_table', 11),
(33, '2024_02_05_103350_create_ecocash_transaction_type', 11),
(34, '2024_02_05_151527_create_company_registration_supplier_table', 11),
(35, '2024_02_04_155638_create_company_registration_table', 12),
(36, '2024_02_04_155347_create_ecocash_table', 13),
(37, '2024_02_06_203617_create_ecocash_agent_line_table', 13),
(38, '2024_02_04_1553471_create_ecocash_table', 14),
(39, '2024_02_04_155412_create_rtgs_table', 14),
(40, '2024_01_26_1113094_create_insurance_transaction', 15),
(41, '2024_02_05_103350_create_zinara_transaction_type', 16),
(42, '2024_01_26_1113094_create_zinara_transaction', 17),
(43, '2024_02_04_1553471_create_general_sale_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `notes`, `date`, `created_at`, `updated_at`) VALUES
(2, 'thvhvjbmjkkhh\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\nhhhjjj', '2024-04-22', '2024-04-22 20:57:26', '2024-04-22 20:57:26'),
(3, 'hey these are notes from Lee , Lets see how this works', '2024-05-02', '2024-05-02 04:13:08', '2024-05-02 04:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permanent_disc`
--

CREATE TABLE `permanent_disc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cash_paid` double(50,2) NOT NULL DEFAULT 0.00,
  `quantity_sold` int(11) NOT NULL DEFAULT 0,
  `quantity_received` int(11) NOT NULL DEFAULT 0,
  `order_price` double(50,2) NOT NULL DEFAULT 0.00,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `currency_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permanent_disc`
--

INSERT INTO `permanent_disc` (`id`, `cash_paid`, `quantity_sold`, `quantity_received`, `order_price`, `created_by`, `created_at`, `updated_at`, `notes`, `name`, `phone`, `currency_id`) VALUES
(4, 0.00, 0, 0, 0.00, 1, '2024-04-29 20:46:18', '2024-04-29 20:46:18', NULL, 'kkk', NULL, 0);

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
-- Table structure for table `rtgs`
--

CREATE TABLE `rtgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_type` int(11) NOT NULL,
  `amount` double(50,2) NOT NULL DEFAULT 0.00,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `expected_amount` text NOT NULL DEFAULT '0',
  `rate` text NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rtgs_transaction_type`
--

CREATE TABLE `rtgs_transaction_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rtgs_transaction_type`
--

INSERT INTO `rtgs_transaction_type` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Ecocash', 1, '2024-02-29 20:53:07', '2024-02-29 20:53:07'),
(2, 'Swipe', 1, '2024-02-29 20:53:07', '2024-02-29 20:53:07'),
(3, 'Airtime', 1, '2024-02-29 20:53:07', '2024-02-29 20:53:07'),
(4, 'OneMoney', 1, '2024-02-29 20:53:07', '2024-02-29 20:53:07'),
(5, 'ZESA', 1, '2024-02-29 20:53:07', '2024-02-29 20:53:07'),
(6, 'Float/Buy RTGS', 1, '2024-03-22 12:33:15', '2024-03-22 12:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone1` varchar(255) NOT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone1`, `phone2`, `password`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Leon', '0771716528', NULL, '$2y$10$ejPgXHO5MtQdDA0Xb6JMNOrzfxHjurx8a4UdAqmt2f6HBxsp1/CgG', '2024-01-29 12:31:47', '2024-01-29 12:31:47', 1),
(2, 'Muzanya', '0772473181', '0191292', '$2y$10$ejPgXHO5MtQdDA0Xb6JMNOrzfxHjurx8a4UdAqmt2f6HBxsp1/CgG', '2024-02-13 17:30:45', '2024-02-13 17:30:45', 1),
(4, 'Valentine Njowa', '263778842255', NULL, '$2y$10$ejPgXHO5MtQdDA0Xb6JMNOrzfxHjurx8a4UdAqmt2f6HBxsp1/CgG', '2024-03-03 10:04:50', '2024-03-03 10:04:50', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_class`
--

CREATE TABLE `vehicle_class` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_class`
--

INSERT INTO `vehicle_class` (`id`, `name`, `currency_id`, `amount`, `created_at`, `updated_at`) VALUES
(3, 'Light Vehicle', 2, 0.00, '2024-03-03 10:07:16', '2024-03-03 10:07:16'),
(4, 'Taxi', 2, 0.00, '2024-03-03 10:07:16', '2024-03-03 10:07:16'),
(5, 'Commuter Ominibus', 2, 0.00, '2024-03-03 10:07:16', '2024-03-03 10:07:16'),
(6, 'Haulage Vehicles', 2, 0.00, '2024-03-03 10:07:16', '2024-03-03 10:07:16'),
(7, 'Haulage Trailers', 2, 0.00, '2024-03-03 10:07:16', '2024-03-03 10:07:16'),
(8, 'Buses', 2, 0.00, '2024-03-03 10:07:16', '2024-03-03 10:07:16'),
(9, 'Small trailers', 2, 0.00, '2024-03-03 10:07:16', '2024-03-03 10:07:16'),
(10, 'Motor bikes', 2, 0.00, '2024-03-03 10:07:16', '2024-03-03 10:07:16'),
(11, 'Special types', 2, 0.00, '2024-03-03 10:07:16', '2024-03-03 10:07:16'),
(12, 'Properties', 2, 0.00, '2024-03-03 10:07:16', '2024-03-03 10:07:16'),
(13, 'Other', 2, 0.00, '2024-03-03 10:07:16', '2024-03-03 10:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `zinara_transaction`
--

CREATE TABLE `zinara_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `reg_no` varchar(255) DEFAULT NULL,
  `expiry_date` date NOT NULL,
  `amount_paid` text NOT NULL DEFAULT '0',
  `expected_amount` text NOT NULL DEFAULT '0',
  `rate` double(8,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zinara_transaction`
--

INSERT INTO `zinara_transaction` (`id`, `created_by`, `class`, `name`, `phone`, `reg_no`, `expiry_date`, `amount_paid`, `expected_amount`, `rate`, `notes`, `created_at`, `updated_at`) VALUES
(3, 1, 3, 'yiuhh', '0777555222', 'aad5555', '2024-06-30', '15', '348000', 210000.00, NULL, '2024-03-16 17:41:24', '2024-03-16 17:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `zinara_transaction_type`
--

CREATE TABLE `zinara_transaction_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `notes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zinara_transaction_type`
--

INSERT INTO `zinara_transaction_type` (`id`, `name`, `created_by`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Online Ecocash', 1, NULL, '2024-02-29 20:32:01', '2024-02-29 20:53:07'),
(2, 'Swipe RTGS', 1, NULL, '2024-02-29 20:32:01', '2024-02-29 20:53:07'),
(3, 'USD Cash', 1, NULL, '2024-02-29 20:32:01', '2024-02-29 20:53:07'),
(4, 'USD Eocash Online', 1, NULL, '2024-02-29 20:32:01', '2024-02-29 20:53:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_number`);

--
-- Indexes for table `company_registration`
--
ALTER TABLE `company_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_registration_supplier`
--
ALTER TABLE `company_registration_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dstv_packages`
--
ALTER TABLE `dstv_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dstv_payment`
--
ALTER TABLE `dstv_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dstv_transaction`
--
ALTER TABLE `dstv_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecocash`
--
ALTER TABLE `ecocash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecocash_agent_line`
--
ALTER TABLE `ecocash_agent_line`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecocash_transaction_type`
--
ALTER TABLE `ecocash_transaction_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eggs`
--
ALTER TABLE `eggs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_sales`
--
ALTER TABLE `general_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_sales_transaction_type`
--
ALTER TABLE `general_sales_transaction_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurance_brooker`
--
ALTER TABLE `insurance_brooker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurance_payment`
--
ALTER TABLE `insurance_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurance_transaction`
--
ALTER TABLE `insurance_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_disbursed`
--
ALTER TABLE `loan_disbursed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_payment`
--
ALTER TABLE `loan_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permanent_disc`
--
ALTER TABLE `permanent_disc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rtgs`
--
ALTER TABLE `rtgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rtgs_transaction_type`
--
ALTER TABLE `rtgs_transaction_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone1`);

--
-- Indexes for table `vehicle_class`
--
ALTER TABLE `vehicle_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zinara_transaction`
--
ALTER TABLE `zinara_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zinara_transaction_type`
--
ALTER TABLE `zinara_transaction_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_registration`
--
ALTER TABLE `company_registration`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_registration_supplier`
--
ALTER TABLE `company_registration_supplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dstv_packages`
--
ALTER TABLE `dstv_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `dstv_payment`
--
ALTER TABLE `dstv_payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dstv_transaction`
--
ALTER TABLE `dstv_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `ecocash`
--
ALTER TABLE `ecocash`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ecocash_agent_line`
--
ALTER TABLE `ecocash_agent_line`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ecocash_transaction_type`
--
ALTER TABLE `ecocash_transaction_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `eggs`
--
ALTER TABLE `eggs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_sales`
--
ALTER TABLE `general_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `general_sales_transaction_type`
--
ALTER TABLE `general_sales_transaction_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `insurance_brooker`
--
ALTER TABLE `insurance_brooker`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `insurance_payment`
--
ALTER TABLE `insurance_payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `insurance_transaction`
--
ALTER TABLE `insurance_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loan_disbursed`
--
ALTER TABLE `loan_disbursed`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan_payment`
--
ALTER TABLE `loan_payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permanent_disc`
--
ALTER TABLE `permanent_disc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rtgs`
--
ALTER TABLE `rtgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rtgs_transaction_type`
--
ALTER TABLE `rtgs_transaction_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicle_class`
--
ALTER TABLE `vehicle_class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `zinara_transaction`
--
ALTER TABLE `zinara_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zinara_transaction_type`
--
ALTER TABLE `zinara_transaction_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
