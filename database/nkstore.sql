-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2021 at 02:05 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nkstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `cart_quantity` tinyint(3) UNSIGNED NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_bought` tinyint(1) NOT NULL DEFAULT 0,
  `bought_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `cart_quantity`, `size_id`, `added_at`, `is_bought`, `bought_at`) VALUES
(4, 1, 1, 2, 2, '2021-07-14 20:55:35', 1, '2021-07-14 20:58:19'),
(24, 3, 17, 3, 1, '2021-07-14 21:16:58', 1, '2021-07-14 21:17:01'),
(38, 1, 4, 1, 9, '2021-07-16 18:08:21', 1, '2021-07-16 18:08:23'),
(39, 3, 3, 1, 1, '2021-07-17 07:04:09', 1, '2021-07-17 07:04:41'),
(65, 9, 4, 1, 9, '2021-07-19 13:29:54', 1, '2021-07-19 13:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Dresses'),
(2, 'Skirts'),
(3, 'T-Shirts'),
(4, 'Blouses & Shirts'),
(5, 'Hoodies'),
(6, 'Trousers'),
(7, 'Shorts'),
(8, 'Jackets & Coats'),
(9, 'Swimwear'),
(10, 'Bags'),
(11, 'Shoes'),
(12, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `contact_username` varchar(50) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `contact_subject` varchar(50) NOT NULL,
  `contact_message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `contact_answer` text DEFAULT NULL,
  `answered_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `user_id`, `contact_username`, `contact_email`, `contact_subject`, `contact_message`, `created_at`, `contact_answer`, `answered_at`) VALUES
(1, 3, 'jasna1234', 'jasna@mail.com', 'Working time', 'Can you please tell me working time for your main shop in Belgrade?', '2021-07-17 12:47:30', NULL, '2021-07-19 20:58:31'),
(4, NULL, 'Milena', 'milena@mmail.com', 'Marketing proposal', 'Good afternoon, if you are interested in marketing proposal please contact me for more detail on this email.\n\n', '2021-07-19 21:01:35', NULL, '2021-07-19 21:01:35'),
(5, NULL, 'Ivana', 'iva@ivmail.com', 'Openings', 'Hello, when you will open announced new store in Montenegero?', '2021-07-19 21:02:34', 'Hello, in october!', '2021-07-20 06:55:10'),
(6, NULL, 'Ana', 'aanci@amail.com', 'Vacancy', 'Good day, can you tell me is there any vacancies in your main store for sales representatives?', '2021-07-20 12:15:42', 'Please send us your CV.', '2021-08-24 19:42:32'),
(7, NULL, 'Ina', 'ina@mail.com', 'Vacancy', 'Good day, can you tell me is there any vacancies?', '2021-09-02 10:11:14', NULL, '2021-09-02 14:39:55'),
(8, 3, 'jasna1234', 'jasna@mail.com', 'Delivery', 'Can you tell me when ordered products will be delivered?', '2021-09-02 11:29:06', '', '2021-09-02 14:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(10) UNSIGNED NOT NULL,
  `product_description` text NOT NULL,
  `product_color` varchar(20) NOT NULL,
  `product_material` varchar(40) NOT NULL,
  `product_care` varchar(30) NOT NULL,
  `product_origin` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `category_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_price`, `product_description`, `product_color`, `product_material`, `product_care`, `product_origin`, `created_at`, `updated_at`, `is_active`, `category_id`, `user_id`) VALUES
(1, 'Short Sleeve Cotton T-shirt', 12, 'A sleek everyday t-shirt in organic cotton with round neckline and short sleeves with print.', 'grey', '100 % Cotton', 'Machine washable', 'Bangladesh', '2021-05-29 18:03:42', '2021-08-24 19:39:14', 1, 3, 1),
(2, 'Simple beige office heels', 34, 'Modest / Simple Beige Office heels. Pumps 10 cm Stiletto Heels. Pointed Toe Pumps.', 'bisque', 'Leather', 'Leather spray cleaner', 'Serbia', '2021-05-29 18:16:25', '2021-07-14 18:52:34', 1, 11, 2),
(3, 'Leather Moto Style Jacket ', 55, 'Your weekend trip will be more practicle in the featured leather women padded jacket in black. A functional as well trendy option which includes track style shoulder and sleeves, asymmetrical zip-up, stand-up collar and exterior storange options.', 'black', 'Leather', 'N/A', 'China', '2021-05-30 11:24:22', NULL, 1, 8, 1),
(4, 'Cross Body Bag', 38, 'Small but surprisingly spacious, this cute mini tote is perfect for housing all your everyday essentials. Also perfect for evening outfits.', 'darkcyan', 'Leather Pu. Lining 100% Viscose', 'Wipe clean only', 'China', '2021-05-30 11:24:50', NULL, 1, 10, 1),
(5, 'Yellow Everyday Mini Dress', 18, 'Hello, sunshine - blending comfort with effortless style, this dress will be the star of your summer wardrobe. It', 'goldenrod', '57% Viscose, 35% Cotton, 8% Linen', 'Machine washable', 'Bangladesh', '2021-05-30 11:25:25', '2021-07-14 16:48:26', 1, 1, 1),
(6, 'Tinted Oversized Sunglasses', 9, 'Go glam with these tinted sunglasses the ideal finishing touch for any summer outfit. Completed with tinted lenses and pink wire inner frames.', 'mistyrose', 'Polycarbonate', 'N/A', 'China', '2021-05-30 11:26:23', NULL, 1, 12, 1),
(7, 'Puff Sleeve Blouse', 24, 'Refresh your new season style with this statement blouse. Cut with puff sleeves for added drama, it features a subtle check textured design and a gold buttons. Pair with your favourite jeans or tuck into dressy trousers.\r\n', 'white', '100% Polyester', 'Machine washable', 'Bangladesh', '2021-05-30 11:27:23', NULL, 1, 4, 1),
(8, 'Floral Short Top', 23, 'Add a burst of bold blooms to your new season wardrobe with this charming blouse. This lightweight, floaty fit blouse features a vibrant all-over floral print and batwings.', 'multicolor', '100% Polyester', 'Machine washable', 'Bangladesh', '2021-05-30 11:27:45', NULL, 1, 4, 1),
(9, 'Light Wash Ripped Denim Shorts', 22, 'Make these denim shorts your new summer essential doll. Featuring a light wash denim with distressed detailing, team this with a simple top and fresh kicks for a look that', 'lightblue', 'Denim', 'Machine washable', 'Serbia', '2021-05-30 11:28:18', '2021-07-14 19:40:28', 1, 7, 2),
(10, 'Floral Print Hair Tie Scrunchie', 8, 'Add a fierce pop of print to your everyday looks with this scarf-style scrunchie. In a classic floral spot design, it comes with tie detailing that', 'multicolor', '100% Polyester', 'Machine washable', 'China', '2021-05-30 11:28:58', '2021-07-14 16:50:22', 1, 12, 1),
(11, 'Twin Pocket Oversize Jacket', 42, 'This jacket is an ideal layer for those in-between days. It comes in a button-through style with twin pockets. Layer it over a simple white tee for easy weekend wear.', 'olive', '100% Polyester', 'Machine washable', 'Bangladesh', '2021-05-30 11:29:20', NULL, 1, 8, 1),
(12, 'Floral Swimsuit', 26, 'Amp up your beachwear look with this colourful printed swimsuit. In a twist front style, the swimming costume features a full coverage bottom, tummy control panelling and halterneck tie straps to keep you feeling supported as you sunbathe.', 'multicolor', '85% Polyamide, 15% Elastine', 'Machine Washable', 'China', '2021-06-17 15:28:58', NULL, 1, 9, 1),
(13, 'Wool Red Hat', 18, 'Women hat that can in one second upgrade your look a sophisticated look.\r\nBeautiful with a dress or jeans. For daily look or night look, it will cover you.', 'red', 'Wool', 'Sponge Clean Only', 'China', '2021-06-24 13:38:23', '2021-07-14 17:35:30', 1, 12, 1),
(14, 'T-shirt With Print', 11, 'Perfect everyday shirt. Made in a soft cotton-rich blend for cool and breathable comfort, it comes with a print that', 'white', '90% Cotton 10% Polyester', 'Machine washable', 'Bangladesh', '2021-06-24 13:42:51', '2021-09-02 14:41:09', 1, 3, 1),
(15, 'Midi Red Skirt', 26, 'Perfect for when you need to impress at work but also great for impress me outfits. Easy combined with black shirt.', 'red', '97% Polyester 3% Elastane', 'Machine washable', 'China', '2021-06-24 13:48:58', '2021-09-02 14:41:02', 1, 2, 1),
(16, 'Summer Light Trousers', 34, 'Dressing for warmer days just got easy with these classic trousers. With a comfy elasticated waist and side pockets - plus, their cropped length makes them the perfect match for summery sandals.', 'lightpink', '90% Viscose, 10% Polyester', 'Machine washable', 'Bangladesh', '2021-06-24 13:55:24', '2021-09-02 14:40:59', 1, 6, 1),
(17, 'Long Sleeve Soft Hoodie', 28, 'Get cosy in this soft pink hoodie - pretty and practical, you', 'lightpink', '60% Polyester 40% Cotton', 'Machine washable', 'Bangladesh', '2021-06-24 14:19:56', '2021-09-02 14:40:56', 1, 5, 1),
(18, 'Height Weist Bikini', 32, 'Add fun to your beachwear look with this beautiful bikinis. Cut in the classic mini silhouette with detachable side ties and carners on top.', 'teal', ' 84% Polyester 16% Elastane', 'Machine washable', 'China', '2021-06-24 15:37:52', '2021-09-02 14:40:52', 1, 9, 2),
(19, 'Black t-shirt with print', 16, 'Black street style everyday shirt with print. Perfect for walks or even jogging.', 'black', '100% Cotton', 'Machine washable', 'China', '2021-09-02 12:22:52', NULL, 1, 3, 1),
(20, 'Long sleeve plaid shirt', 22, 'Plaid shirts are a fall essential so our Long sleeve plaid shirt is exactly what you need this season! This shirt is brown and beige plaid. It features a v-neckline, button-up front, and long sleeves. ', 'beige', '100% Rayon', 'Machine washable', 'Bangladesh', '2021-09-02 12:48:15', '2021-09-02 14:40:49', 1, 4, 1),
(21, 'Light denim jeans jacket', 41, 'A comfy light blue jeans jacket with  \r\nButtoned sleeve cuffs and two chest pockets with button closure. Perfect for every day!', 'lightblue', '68% Cotton, 32% Viscose', 'Machine wash 40°', 'Bangladesh', '2021-09-02 12:55:16', NULL, 1, 8, 1),
(22, 'Classic black swimwear', 34, 'Black swimwear, comfy and perfect for all body shapes. Hidden underwire design supports like your favorite bra.', 'black', 'Nylon/Lycra', 'Machine wash and line dry', 'China', '2021-09-02 13:04:35', NULL, 1, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` int(10) UNSIGNED NOT NULL,
  `product_image_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `product_image_name`, `created_at`, `updated_at`, `product_id`) VALUES
(1, '1626291378.5735.jpg', '2021-05-30 09:37:58', '2021-07-14 19:36:18', 1),
(2, '1626291407.0832.jpg', '2021-05-30 09:38:05', '2021-07-14 19:36:47', 2),
(3, '1626282157.9357.jpg', '2021-07-14 16:53:34', '2021-07-14 17:02:37', 3),
(4, '1626282166.9582.jpg', '2021-07-14 16:53:38', '2021-07-14 17:02:46', 4),
(5, '1626282176.5052.jpg', '2021-07-14 16:53:44', '2021-07-14 17:02:56', 5),
(6, '1626282187.0504.jpg', '2021-07-14 16:53:48', '2021-07-14 17:03:07', 6),
(7, '1626282197.3382.jpg', '2021-07-14 16:53:51', '2021-07-14 17:03:17', 7),
(8, '1626282214.2664.jpg', '2021-07-14 16:53:54', '2021-07-14 17:03:34', 8),
(9, '1626291628.7725.jpg', '2021-07-14 16:53:58', '2021-07-14 19:40:28', 9),
(10, '1626282249.759.jpg', '2021-07-14 16:54:02', '2021-07-14 17:04:09', 10),
(11, '1626282259.7837.jpg', '2021-07-14 16:54:07', '2021-07-14 17:04:19', 11),
(12, '1626282270.0375.jpg', '2021-07-14 16:54:11', '2021-07-14 17:04:30', 12),
(13, '1626282281.0701.jpg', '2021-07-14 16:54:15', '2021-07-14 17:04:41', 13),
(14, '1626295938.1979.jpg', '2021-07-14 16:54:30', '2021-07-14 20:52:18', 14),
(15, '1626282304.3629.jpg', '2021-07-14 16:55:17', '2021-07-14 17:05:04', 15),
(16, '1626282314.5226.jpg', '2021-07-14 16:55:22', '2021-07-14 17:05:14', 16),
(17, '1626282326.0643.jpg', '2021-07-14 16:55:28', '2021-07-14 17:05:26', 17),
(18, '1626282381.9096.jpg', '2021-07-14 17:06:49', '2021-07-14 17:06:53', 18),
(19, '1630586345.5804.jpg', '2021-09-02 12:39:05', '2021-09-02 12:40:39', 19),
(20, '1630586895.0835.jpg', '2021-09-02 12:48:15', NULL, 20),
(21, '1630587316.9947.jpg', '2021-09-02 12:55:16', NULL, 21),
(22, '1630587875.3929.jpg', '2021-09-02 13:04:35', NULL, 22);

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`product_id`, `size_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 6, '2021-07-11 20:51:07', '2021-08-24 19:39:14'),
(1, 2, 5, '2021-07-11 20:51:07', '2021-09-02 14:41:52'),
(1, 3, 3, '2021-07-11 20:51:07', '2021-07-19 13:50:51'),
(1, 4, 3, '2021-07-11 20:51:07', '2021-07-14 19:35:48'),
(2, 5, 4, '2021-07-11 20:51:07', '2021-09-02 11:54:45'),
(2, 6, 6, '2021-07-11 20:51:07', '2021-09-02 11:53:58'),
(2, 7, 4, '2021-07-11 20:51:07', '2021-07-20 11:38:26'),
(3, 1, 5, '2021-07-11 20:51:07', '2021-07-19 19:41:03'),
(3, 2, 4, '2021-07-11 20:51:07', '2021-07-19 13:29:47'),
(3, 3, 4, '2021-07-11 20:51:07', '2021-07-14 18:35:04'),
(3, 4, 3, '2021-07-11 20:51:07', '2021-07-21 10:26:51'),
(4, 9, 6, '2021-07-11 20:51:07', '2021-08-24 16:11:40'),
(5, 4, 8, '2021-07-11 20:51:07', '2021-08-24 19:41:36'),
(5, 4, 4, '2021-07-11 20:51:07', '2021-08-24 16:15:32'),
(6, 9, 8, '2021-07-11 20:51:07', '2021-08-24 19:41:51'),
(7, 1, 3, '2021-07-11 20:51:07', '2021-09-02 11:45:27'),
(7, 2, 3, '2021-07-11 20:51:07', '2021-07-14 20:58:07'),
(7, 4, 3, '2021-07-11 20:51:07', '2021-09-02 11:44:42'),
(8, 2, 5, '2021-07-11 20:51:07', '2021-09-02 14:41:56'),
(8, 3, 5, '2021-07-11 20:51:07', '2021-09-02 14:41:59'),
(9, 1, 3, '2021-07-11 20:51:07', NULL),
(9, 3, 3, '2021-07-11 20:51:07', '2021-07-14 18:36:22'),
(9, 4, 3, '2021-07-11 20:51:07', '2021-07-14 18:36:25'),
(10, 9, 3, '2021-07-11 20:51:07', '2021-08-24 16:04:22'),
(11, 1, 2, '2021-07-11 20:51:07', '2021-07-19 13:58:57'),
(11, 2, 2, '2021-07-11 20:51:07', '2021-07-19 13:04:50'),
(11, 3, 2, '2021-07-11 20:51:07', '2021-07-19 13:54:28'),
(11, 4, 2, '2021-07-11 20:51:07', '2021-07-19 13:54:27'),
(12, 1, 2, '2021-07-11 20:51:07', NULL),
(12, 2, 2, '2021-07-11 20:51:07', '2021-07-14 18:37:05'),
(12, 3, 2, '2021-07-11 20:51:07', '2021-07-14 18:37:09'),
(13, 9, 4, '2021-07-11 20:51:07', NULL),
(14, 1, 2, '2021-07-11 20:51:07', '2021-08-24 16:12:42'),
(14, 2, 2, '2021-07-11 20:51:07', '2021-08-24 16:04:26'),
(14, 3, 2, '2021-07-11 20:51:07', '2021-08-24 16:12:45'),
(14, 4, 2, '2021-07-11 20:51:07', NULL),
(15, 3, 5, '2021-07-11 20:51:07', '2021-07-19 13:04:47'),
(15, 4, 2, '2021-07-11 20:51:07', '2021-07-19 12:39:31'),
(16, 1, 3, '2021-07-11 20:51:07', '2021-08-24 16:08:22'),
(16, 4, 3, '2021-07-11 20:51:07', '2021-09-02 11:53:54'),
(17, 1, 0, '2021-07-11 20:51:07', '2021-07-14 21:16:58'),
(17, 2, 3, '2021-07-11 20:51:07', '2021-07-19 13:40:12'),
(18, 1, 6, '2021-07-11 20:51:07', '2021-07-29 17:29:22'),
(18, 4, 6, '2021-07-11 20:51:07', '2021-07-14 18:48:27'),
(5, 1, 3, '2021-08-24 19:41:43', NULL),
(19, 1, 6, '2021-09-02 12:22:52', NULL),
(19, 2, 5, '2021-09-02 12:41:37', NULL),
(19, 3, 5, '2021-09-02 12:41:53', NULL),
(20, 2, 6, '2021-09-02 12:48:15', NULL),
(20, 4, 4, '2021-09-02 12:48:33', NULL),
(21, 2, 3, '2021-09-02 12:55:16', NULL),
(22, 1, 4, '2021-09-02 13:04:35', NULL),
(22, 2, 4, '2021-09-04 10:24:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(10) UNSIGNED NOT NULL,
  `review_name` varchar(30) NOT NULL,
  `review_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `review_name`, `review_text`, `created_at`, `is_approved`, `product_id`) VALUES
(1, 'Nataly', 'Great quality.', '2021-07-06 20:19:29', 1, 1),
(2, 'Natasha', 'Wearing at work, so light and good material!', '2021-07-10 15:31:08', 1, 7),
(3, 'Milena122', 'Great, comfortable shoes!', '2021-07-11 16:56:40', 1, 2),
(4, 'Jana9898', 'Great for every day at work. Real leather!', '2021-07-13 12:18:48', 1, 2),
(6, 'Maria', 'Even prettier than on the picture, soft cotton, perfect for everyday!', '2021-07-16 15:25:31', 0, 1),
(7, 'Maja', 'My favourite bag from now on, so cool, real leather!', '2021-07-19 11:21:28', 0, 4),
(11, 'Marina', 'So glam and cool!', '2021-07-20 12:13:19', 1, 6),
(12, 'Ana', 'Great and afordable.', '2021-09-02 14:45:18', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `size_id` int(10) UNSIGNED NOT NULL,
  `size_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `size_name`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, '37'),
(6, '38'),
(7, '39'),
(8, '40'),
(9, 'No size');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_firstname` varchar(20) NOT NULL,
  `user_lastname` varchar(25) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_address` varchar(50) NOT NULL,
  `user_role` enum('administrator','customer') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `is_valid` int(10) UNSIGNED NOT NULL,
  `is_voted` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `voted_result` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_firstname`, `user_lastname`, `user_username`, `user_email`, `user_password`, `user_phone`, `user_address`, `user_role`, `created_at`, `is_active`, `is_valid`, `is_voted`, `voted_result`) VALUES
(1, 'Neda', 'Kostić', 'neleadmin', 'nele@mail.com', '6204bb581a108b88f95b20a51c42506d261470e57376912026980432accf97eaA*d6Mr3Vvevy#&Gi', '+3815655555', 'Adminova 55, Beograd', 'administrator', '2021-05-13 21:11:27', 1, 1, 0, 0),
(2, 'Ivan ', 'Ilić', 'ivan123', 'ivan@mail.com', '6c84b1086e558a0b9dad7623979f6ddf9f337084f281d9b3a07273d04b425344A*d6Mr3Vvevy#&Gi', '0635487852', 'Bulevar kralja Aleksandra 102, Beograd', 'administrator', '2021-05-13 21:12:02', 1, 1, 0, 0),
(3, 'Jasna', 'Perović', 'jasna1234', 'jasna@mail.com', 'ef011879f6e7e19efc42d12fcd94b458572bc8d540e7fb22df10fd22e8fed2b7A*d6Mr3Vvevy#&Gi', '+3815554781', 'Ulica 23, Kragujevac', 'customer', '2021-05-17 19:33:03', 1, 1, 0, 0),
(4, 'Milos', 'Mikic', 'milosmm', 'msa@sgga.com', '3cb954831762c9b718439233fecf79ef3c1739c438a57382bb971036e7baed5eA*d6Mr3Vvevy#&Gi', '06415811225', 'Bulevar 11, Beograd', 'customer', '2021-06-27 16:20:22', 1, 4294967295, 1, 5),
(5, 'Bojan', 'Bokić', 'bbokilili', 'bboki@mail.com', '7392464f5e49d8cf0f494611913b2a8161fbfbff6b503d9ad92254c64a6380c7A*d6Mr3Vvevy#&Gi', '778855565', 'Ulica 23, stan 8, Novi Sad', 'customer', '2021-07-07 20:16:30', 1, 1, 1, 5),
(6, 'Ana', 'Anić', 'anci1234', 'ana@amail.com', 'c708106b62c80befb398afdd3d89090f2516668d26cf6dd1f353a5b12d6b4210A*d6Mr3Vvevy#&Gi', '062415123', 'Ulica 88, Beograd', 'customer', '2021-07-07 21:18:13', 1, 1, 1, 4),
(7, 'Biljana', 'Biljić', 'bbiljana66', 'bbilja@bmail.com', '714ec3743f7c4cb17872e787fa9764a6ee1a476a4f800a355f34b5eb2638db21A*d6Mr3Vvevy#&Gi', '062545871', 'Hercegovačka 12, Užice', 'customer', '2021-07-08 12:13:48', 1, 1, 0, 0),
(9, 'Jovana', 'Jovic', 'jovanajovic', 'jo@jmail.com', '54af2a2960e582263c45971cdd40da4ae31ede1db5395629d910f056479de12dA*d6Mr3Vvevy#&Gi', '008965451', 'adddress 123', 'customer', '2021-07-19 11:37:57', 1, 1, 0, 0),
(11, 'Test', 'Test', 'testuser', 'test@mail.com', '96d5e7f769f9a595192c4a075e80254ac9900ba8f968033655bf64e83bed7443A*d6Mr3Vvevy#&Gi', '00112233', 'testuser', 'customer', '2021-09-02 10:51:30', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_all_products`
-- (See below for the actual view)
--
CREATE TABLE `view_all_products` (
`product_id` int(10) unsigned
,`product_name` varchar(100)
,`product_price` int(10) unsigned
,`product_description` text
,`product_color` varchar(20)
,`product_material` varchar(40)
,`product_care` varchar(30)
,`product_origin` varchar(50)
,`created_at` timestamp
,`updated_at` timestamp
,`is_active` tinyint(1)
,`category_id` int(10) unsigned
,`user_id` int(10) unsigned
,`category_name` varchar(30)
,`quantity` tinyint(3) unsigned
,`size_id` int(10) unsigned
,`size_name` varchar(10)
,`product_image_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_cart`
-- (See below for the actual view)
--
CREATE TABLE `view_cart` (
`cart_id` int(10) unsigned
,`user_id` int(10) unsigned
,`product_id` int(10) unsigned
,`cart_quantity` tinyint(3) unsigned
,`size_id` int(10) unsigned
,`added_at` timestamp
,`is_bought` tinyint(1)
,`bought_at` timestamp
,`product_name` varchar(100)
,`product_price_per_item` int(10) unsigned
,`product_color` varchar(20)
,`size_name` varchar(10)
,`product_image_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `view_all_products`
--
DROP TABLE IF EXISTS `view_all_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_all_products`  AS SELECT `product`.`product_id` AS `product_id`, `product`.`product_name` AS `product_name`, `product`.`product_price` AS `product_price`, `product`.`product_description` AS `product_description`, `product`.`product_color` AS `product_color`, `product`.`product_material` AS `product_material`, `product`.`product_care` AS `product_care`, `product`.`product_origin` AS `product_origin`, `product`.`created_at` AS `created_at`, `product`.`updated_at` AS `updated_at`, `product`.`is_active` AS `is_active`, `product`.`category_id` AS `category_id`, `product`.`user_id` AS `user_id`, `category`.`category_name` AS `category_name`, `product_size`.`quantity` AS `quantity`, `product_size`.`size_id` AS `size_id`, `size`.`size_name` AS `size_name`, `product_image`.`product_image_name` AS `product_image_name` FROM ((((`product` join `category` on(`product`.`category_id` = `category`.`category_id`)) join `product_size` on(`product`.`product_id` = `product_size`.`product_id`)) join `size` on(`size`.`size_id` = `product_size`.`size_id`)) join `product_image` on(`product`.`product_id` = `product_image`.`product_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_cart`
--
DROP TABLE IF EXISTS `view_cart`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_cart`  AS SELECT `cart`.`cart_id` AS `cart_id`, `cart`.`user_id` AS `user_id`, `cart`.`product_id` AS `product_id`, `cart`.`cart_quantity` AS `cart_quantity`, `cart`.`size_id` AS `size_id`, `cart`.`added_at` AS `added_at`, `cart`.`is_bought` AS `is_bought`, `cart`.`bought_at` AS `bought_at`, `product`.`product_name` AS `product_name`, `product`.`product_price` AS `product_price_per_item`, `product`.`product_color` AS `product_color`, `size`.`size_name` AS `size_name`, `product_image`.`product_image_name` AS `product_image_name` FROM (((`cart` join `product` on(`cart`.`product_id` = `product`.`product_id`)) join `size` on(`cart`.`size_id` = `size`.`size_id`)) join `product_image` on(`cart`.`product_id` = `product_image`.`product_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`) USING BTREE,
  ADD KEY `fk_cart_product_id` (`product_id`),
  ADD KEY `fk_cart_user_id` (`user_id`),
  ADD KEY `fk_cart_size_id` (`size_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `fk_contact_user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_category_id` (`category_id`),
  ADD KEY `fk_product_user_id` (`user_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`),
  ADD KEY `fk_product_image_product_id` (`product_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD KEY `fk_product_size_product_id` (`product_id`),
  ADD KEY `fk_product_size_size_id` (`size_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_review_product_id` (`product_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `uq_user_username` (`user_username`) USING BTREE,
  ADD UNIQUE KEY `uq_user_email` (`user_email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `size_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_size_id` FOREIGN KEY (`size_id`) REFERENCES `size` (`size_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_contact_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `fk_product_image_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `fk_product_size_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_size_size_id` FOREIGN KEY (`size_id`) REFERENCES `size` (`size_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
