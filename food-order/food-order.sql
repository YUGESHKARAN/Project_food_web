-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 11:36 AM
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
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment_db`
--

CREATE TABLE `payment_db` (
  `order_id` int(100) NOT NULL,
  `razorpay_id` varchar(200) NOT NULL,
  `total_price` int(200) NOT NULL,
  `payment_status` varchar(200) NOT NULL,
  `customer_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `user_name`, `password`) VALUES
(59, 'karan', 'karan', 'db068ce9f744fbb35eedc9a883f91085'),
(64, 'neoteric', 'neoteric', 'dbf4bc08dbd17ea931b6dcd808c8a955');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(54, 'Beverages', 'Food_Category_145.png', 'Yes', 'Yes'),
(56, 'Non veg', 'Food_Category_156.png', 'Yes', 'Yes'),
(57, 'Veg Rice', 'Food_Category_154.png', 'Yes', 'Yes'),
(58, 'Combo Food', 'Food_Category_172.png', 'Yes', 'Yes'),
(59, 'Pizza', 'Food_Category_40.png', 'Yes', 'Yes'),
(60, 'Burger', 'Food_Category_651.png', 'Yes', 'Yes'),
(61, 'Snak', 'Food_Category_529.png', 'Yes', 'Yes'),
(62, 'Ice Cream', 'Food_Category_943.png', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(47, 'Badam Milk', '20% OFF \r\n', 60.00, 'Food_Name941.png', 54, 'Yes', 'Yes'),
(48, 'Butter Milk', '20 %OFF', 70.00, 'Food_Name3411.png', 54, 'Yes', 'Yes'),
(49, 'Jal Jeera', '30% OFF', 80.00, 'Food_Name2416.png', 54, 'Yes', 'Yes'),
(50, 'Masala Chai', '10% OFF', 90.00, 'Food_Name9655.png', 54, 'Yes', 'Yes'),
(51, 'Neer Mor ', '30% OFF', 80.00, 'Food_Name6045.png', 54, 'Yes', 'Yes'),
(52, 'Tender Coconut', '20% OFF', 60.00, 'Food_Name5393.png', 54, 'Yes', 'Yes'),
(53, 'Chicken Pulao Non Veg', 'Calories: 273 cal/200g', 120.00, 'Food_Name7547.png', 56, 'Yes', 'Yes'),
(54, 'Chicken Briyani Non Veg', 'Calories: 300 cal/205g', 120.00, 'Food_Name2011.png', 56, 'Yes', 'Yes'),
(55, 'Egg Briyani Non Veg', 'Calories: 220 cal/169g', 100.00, 'Food-Name-3004.png', 56, 'Yes', 'Yes'),
(56, 'Egg Fried Rice Non Veg', 'Calories: 240 cal/140g', 110.00, 'Food_Name7690.png', 56, 'Yes', 'Yes'),
(57, 'Fish Briyani Non Veg', 'Calories: 296 cal/205g', 150.00, 'Food_Name5553.png', 56, 'Yes', 'Yes'),
(58, 'Mutton Briyani Non Veg', 'Calories: 642 cal/402g', 180.00, 'Food_Name5401.png', 56, 'Yes', 'Yes'),
(59, 'Prawn Briyani Non Veg', 'Calories: 180 cal/100g', 210.00, 'Food_Name9852.png', 56, 'Yes', 'Yes'),
(60, 'Coconut Rice Veg', 'Calories: 310 cal/164g', 80.00, 'Food_Name3853.png', 57, 'Yes', 'Yes'),
(61, 'Curd Rice Veg', 'Calories: 210 cal/ 225g', 50.00, 'Food_Name1589.png', 57, 'Yes', 'Yes'),
(62, 'Ghee Rice Veg', 'Calories: 170 cal/164g', 80.00, 'Food_Name4481.png', 57, 'Yes', 'Yes'),
(63, 'Lemon Rice Veg', 'Calories: 220 cal/180g', 60.00, 'Food_Name1184.png', 57, 'Yes', 'Yes'),
(64, 'Pepper Rice Veg', 'Calories: 210 cal/158g', 80.00, 'Food_Name501.png', 57, 'Yes', 'Yes'),
(65, 'Tamarind Rice Veg', 'Calories: 340 cal/194g', 60.00, 'Food_Name4705.png', 57, 'Yes', 'Yes'),
(66, 'Tomato Rice Veg', 'Calories: 130 cal/126g', 70.00, 'Food_Name9587.png', 57, 'Yes', 'Yes'),
(67, 'Veg Briyani', 'Calories: 200 cal/168.81g', 80.00, 'Food_Name1739.png', 57, 'Yes', 'Yes'),
(68, 'Breakfast', '30% OFF', 150.00, 'Food_Name1023.png', 58, 'Yes', 'Yes'),
(69, 'Dinner', '10% OFF', 150.00, 'Food_Name7356.png', 58, 'Yes', 'Yes'),
(70, 'Lunch', '25% OFF', 150.00, 'Food_Name6580.png', 58, 'Yes', 'Yes'),
(71, 'Family Special', '5% OFF', 250.00, 'Food_Name3126.png', 58, 'Yes', 'Yes'),
(72, 'Broccoli Pizza', 'Calories: 2269cal/853g', 210.00, 'Food_Name3234.png', 59, 'Yes', 'Yes'),
(73, 'Cheese Pizza ', 'Calories: 2269/853g', 180.00, 'Food_Name7145.png', 59, 'Yes', 'Yes'),
(74, 'Panner Pizza', 'Calories: 2269/853g', 200.00, 'Food_Name7271.png', 59, 'Yes', 'Yes'),
(75, 'Butter Chicken Pizza', 'Calories: 2269/853g', 250.00, 'Food_Name7325.png', 59, 'Yes', 'Yes'),
(76, 'Aloo Tikki Burger', 'Calories: 354 cal/120g', 180.00, 'Food_Name1921.png', 60, 'Yes', 'Yes'),
(77, 'Cheesy Veggie Burger', 'Calories: 354 cal/120g', 150.00, 'Food_Name7001.png', 60, 'Yes', 'Yes'),
(78, 'Katsu Fired Burger', 'Calories: 354 cal/120g', 180.00, 'Food_Name2462.png', 60, 'Yes', 'Yes'),
(79, 'Tandoori Chicken Burger', 'Calories: 354 cal/120g', 250.00, 'Food_Name9533.png', 60, 'Yes', 'Yes'),
(80, 'Cutlet Snack', 'Calories: 90 cal/50g', 40.00, 'Food_Name5444.png', 61, 'Yes', 'Yes'),
(81, 'Milagi Bajji Snack', 'Calories: 90 cal/50g', 20.00, 'Food_Name9373.png', 61, 'Yes', 'Yes'),
(82, 'Samosa Snack', 'Calories: 90 cal/50g', 20.00, 'Food_Name9407.png', 61, 'Yes', 'Yes'),
(83, 'Kulfi Ice Cream Snack', '10% OFF', 40.00, 'Food_Name3881.png', 62, 'Yes', 'Yes'),
(84, 'Salted Caramel Ice Cream', '20% OFF', 50.00, 'Food_Name8921.png', 62, 'Yes', 'Yes'),
(85, 'Strawberry Ice Cream', '20% OFF', 50.00, 'Food_Name6492.png', 62, 'Yes', 'Yes'),
(86, 'Vanilla Ice Cream', '20% OFF', 30.00, 'Food_Name7317.png', 62, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `description_food` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_db`
--
ALTER TABLE `payment_db`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_db`
--
ALTER TABLE `payment_db`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
