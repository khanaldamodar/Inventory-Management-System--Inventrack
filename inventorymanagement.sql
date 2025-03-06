-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 06:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorymanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passkey` varchar(16) NOT NULL,
  `number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `passkey`, `number`) VALUES
(1, 'root', 'root@gmail.com', 'root', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `shop_name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `address` text NOT NULL,
  `passkey` varchar(16) NOT NULL,
  `postal_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `first_name`, `middle_name`, `last_name`, `shop_name`, `email`, `phone_number`, `address`, `passkey`, `postal_code`) VALUES
(1, 'Hari', 'A', 'Bhandari', 'Johns Groceries', 'hari@gmail.com', '9847483647', '123 Main St, Cityville', 'pass1234', 12345),
(2, 'Jane', NULL, 'Smith', 'Smiths Clothing', 'jane.smith@example.com', '2147483647', '456 Elm St, Townsville', 'secure5678', 23456),
(3, 'Emily', 'R', 'Johnson', 'Emilys Bakery', 'emily.johnson@example.com', '2147483647', '789 Oak St, Villagetown', 'emily2023', 34567),
(4, 'Michael', NULL, 'Brown', 'Brown Electronics', 'michael.brown@example.com', '2147483647', '101 Pine St, Metrocity', 'tech7890', 45678),
(5, 'Chris', 'T', 'Evans', 'Chris Cafeteria', 'chris.evans@example.com', '2147483647', '202 Maple St, Capitaltown', 'food2024', 56789),
(6, 'Ram', 'Prashad', 'Khanal', 'Khanal Shop', 'ram@gmail.com', '2147483647', 'Kapilvastu', '$2y$10$bTdtXUxkN', 32809),
(7, 'Ramm', 's', 'kumar', 'xyz', 'ramm@gmail.com', '2147483647', 'ktm', '$2y$10$VPUM.4AlZ', 123456),
(8, 'Pawan', 'kumar', 'khanal', 'pawans shop', 'p@gmail.com', '1234567894', 'kplvstu', '$2y$10$ePnhHKNjU', 123212),
(9, 'Deepak', '', 'khanal', 'dpk', 'd@gmail.com', '987654321', 'asd', '123456789', 123456);

-- --------------------------------------------------------

--
-- Table structure for table `client_requests`
--

CREATE TABLE `client_requests` (
  `request_id` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_price` float NOT NULL,
  `price` float NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `status` enum('Pending','Approved','Cancelled','') NOT NULL DEFAULT 'Pending',
  `request_type` enum('stock in','stock out') DEFAULT 'stock out'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_requests`
--

INSERT INTO `client_requests` (`request_id`, `product`, `quantity`, `created_at`, `total_price`, `price`, `created_by`, `status`, `request_type`) VALUES
(25, 'HP Spectre x360', 21, '2024-12-21 14:34:04', 3570000, 170000, 'Hari Bhandari', 'Pending', 'stock out'),
(26, 'Apple MacBook Air', 3, '2024-12-21 14:45:09', 450000, 150000, 'Hari Bhandari', 'Pending', 'stock out'),
(27, 'ASUS VivoBook 15', 2, '2024-12-21 14:56:17', 110000, 55000, 'Hari Bhandari', 'Pending', 'stock out'),
(28, 'MSI GF63 Thin', 100, '2024-12-21 15:13:20', 12000000, 120000, 'Hari Bhandari', 'Pending', 'stock out'),
(29, 'Apple MacBook Air', 3, '2024-12-21 15:17:46', 450000, 150000, 'Hari Bhandari', 'Approved', 'stock out');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_products`
--

CREATE TABLE `inventory_products` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `supplier_name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_products`
--

INSERT INTO `inventory_products` (`p_id`, `p_name`, `quantity`, `category`, `price`, `description`, `created_by`, `supplier_name`, `created_at`) VALUES
(2, 'ASUS VivoBook 15', 15, 'Budget', 55000.00, 'Lightweight and portable laptop', 'rampoudel', 'rawan', '2024-12-21 16:26:10'),
(5, 'Apple MacBook Air', 9, 'Premium', 150000.00, 'Lightweight and stylish laptop for professionals', 'rampoudel', '', '2024-12-21 16:26:10'),
(6, 'HP Spectre x360', 41, 'Premium', 170000.00, 'Convertible laptop with premium build and features', 'rampoudel', '', '2024-12-21 16:26:10'),
(8, 'MSI GF63 Thin', 9, 'Gaming', 120000.00, 'Powerful gaming laptop with dedicated graphics', 'rampoudel', '', '2024-12-21 16:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_cost` decimal(10,2) GENERATED ALWAYS AS (`quantity` * `price`) STORED,
  `created_by` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_name`, `supplier_name`, `quantity`, `price`, `created_by`, `created_at`) VALUES
(1, 'demo', 'demo', 20, 100.00, '', '2024-12-03 12:44:20'),
(2, 'ACER', 'Deepak', 9, 0.00, '', '2024-12-03 12:44:20'),
(3, 'MacBook', 'Deepak', 1, 0.00, '', '2024-12-03 12:44:20'),
(4, 'ACER', 'Janaki Kumari Rokaya', 10, 0.00, '', '2024-12-03 12:44:20'),
(5, 'ACER', 'Janaki Kumari Rokaya', 10, 0.00, '', '2024-12-03 12:44:20'),
(11, 'Lenevo', 'Damodar Khanal', 10, 0.00, 'root', '2024-12-03 12:44:20'),
(12, 'Lenevo', 'Janaki Rokaya', 20, 0.00, 'root', '2024-12-03 12:44:20'),
(13, 'Lenevo', 'Janaki Rokaya', 1, 0.00, 'root', '2024-12-03 12:44:20'),
(14, 'Lenevo', 'Janaki Rokaya', 1, 60002.00, 'root', '2024-12-03 12:44:20'),
(15, 'Lenevo', 'Janaki Rokaya', 60, 60002.00, 'root', '2024-12-03 12:44:20'),
(16, 'Asus', 'Hari', 3, 20000.00, 'root', '2024-12-03 12:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `company_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `email`, `phone`, `address`, `created_by`, `created_at`, `company_name`) VALUES
(2, 'Shrestha Traders', 'shresthatraders@gmail.com', '9812345678', 'New Road, Kathmandu', 'rampoudel', '2024-08-28 06:30:00', 'Everest Enterprises'),
(3, 'Ganesh Suppliers', 'ganeshsup@gmail.com', '9841231234', 'Pokhara-8, Lakeside', 'rampoudel', '2024-08-28 08:45:00', 'Ganesh Business Group'),
(4, 'Raut Wholesalers', 'rautwholesale@yahoo.com', '9856789023', 'Biratnagar-1', 'raut123', '2024-08-28 11:00:00', 'Sunrise Wholesalers'),
(5, 'Pashupati Enterprises', 'pashupati_ent@gmail.com', '9807654321', 'Itahari-4, rampoudel', 'pashupati_admin', '2024-08-28 12:05:00', 'Pashupati Pvt. Ltd.'),
(6, 'Bhaktapur Mart', 'bktmart@gmail.com', '9816578900', 'Bhaktapur-5, Kamalbinayak', 'admin', '2024-08-29 03:35:00', 'Bhaktapur Retailers'),
(7, 'Karki Distributors', 'karkidistributors@gmail.com', '9823456712', 'Dhangadhi-3, Kailali', 'karki_admin', '2024-08-29 05:20:00', 'Karki Group of Trade'),
(8, 'Ramesh & Brothers', 'rameshbros@yahoo.com', '9847891234', 'Butwal-9, Rupandehi', 'ramesh.manager', '2024-08-29 07:30:00', 'Ramesh Global Traders');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_products`
--

CREATE TABLE `supplier_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `product_price` int(11) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Supplier_id` int(11) NOT NULL,
  `description` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_products`
--

INSERT INTO `supplier_products` (`product_id`, `product_name`, `category`, `product_price`, `created_by`, `created_at`, `Supplier_id`, `description`) VALUES
(82, 'Dell Inspiron 15 3000', 'Budget', 50000, 'admin', '2024-12-20 11:15:03', 1, 'Entry-level laptop for everyday tasks'),
(83, 'HP Pavilion 15', 'Mid-range', 75000, 'admin', '2024-12-20 11:15:03', 2, 'Versatile laptop for work and entertainment'),
(84, 'Lenovo IdeaPad 3', 'Budget', 45000, 'admin', '2024-12-20 11:15:03', 3, 'Affordable laptop for students and casual users'),
(85, 'Acer Aspire 5', 'Mid-range', 60000, 'admin', '2024-12-20 11:15:03', 4, 'All-rounder laptop with good performance'),
(86, 'ASUS VivoBook 15', 'Budget', 55000, 'admin', '2024-12-20 11:15:03', 5, 'Lightweight and portable laptop'),
(87, 'MSI GF63 Thin', 'Gaming', 120000, 'admin', '2024-12-20 11:15:03', 6, 'Powerful gaming laptop with dedicated graphics'),
(88, 'Acer Nitro 5', 'Gaming', 100000, 'admin', '2024-12-20 11:15:03', 7, 'Budget-friendly gaming laptop'),
(89, 'Lenovo Legion 5', 'Gaming', 150000, 'admin', '2024-12-20 11:15:03', 8, 'High-performance gaming laptop'),
(90, 'Apple MacBook Air', 'Premium', 150000, 'admin', '2024-12-20 11:15:03', 1, 'Lightweight and stylish laptop for professionals'),
(91, 'Apple MacBook Pro', 'Premium', 200000, 'admin', '2024-12-20 11:15:03', 2, 'Powerful and versatile laptop for demanding tasks'),
(92, 'Dell XPS 13', 'Premium', 180000, 'admin', '2024-12-20 11:15:03', 3, 'Compact and high-performance laptop'),
(93, 'HP Spectre x360', 'Premium', 170000, 'admin', '2024-12-20 11:15:03', 4, 'Convertible laptop with premium build and features'),
(94, 'Razer Blade 15', 'Gaming', 250000, 'admin', '2024-12-20 11:15:03', 5, 'Ultra-thin and powerful gaming laptop'),
(95, 'ASUS ROG Zephyrus', 'Gaming', 220000, 'admin', '2024-12-20 11:15:03', 6, 'High-end gaming laptop with top-of-the-line specs'),
(96, 'Lenovo ThinkPad X1 Carbon', 'Business', 180000, 'admin', '2024-12-20 11:15:03', 7, 'Lightweight and durable business laptop'),
(97, 'Dell Latitude 7400', 'Business', 150000, 'admin', '2024-12-20 11:15:03', 8, 'Powerful and secure business laptop'),
(98, 'HP EliteBook 840 G8', 'Business', 160000, 'admin', '2024-12-20 11:15:03', 1, 'Premium business laptop with excellent performance'),
(99, 'Acer Swift 3', 'Ultrabook', 80000, 'admin', '2024-12-20 11:15:03', 2, 'Lightweight and portable ultrabook'),
(100, 'ASUS Zenbook 14', 'Ultrabook', 120000, 'admin', '2024-12-20 11:15:03', 3, 'Stylish and powerful ultrabook'),
(101, 'Lenovo Yoga 7i', '2-in-1', 100000, 'admin', '2024-12-20 11:15:03', 4, 'Versatile 2-in-1 laptop with touchscreen');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `company_size` varchar(10) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `first_name`, `last_name`, `address`, `state`, `postal_code`, `phone_number`, `company_size`, `company_name`, `email`, `password_hash`, `profile_photo`) VALUES
('rampoudel', 'Ramm', 'Poudel', 'Sundhara, Kathmandu', 'Bagmati', '44600', '980-1234-5678', '1-10', 'Poudel Enterprises', 'ram.poudel@example.com', 'hashed_password_1', 'profile_6766f47234499.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `client_requests`
--
ALTER TABLE `client_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `inventory_products`
--
ALTER TABLE `inventory_products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `supplier_products`
--
ALTER TABLE `supplier_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client_requests`
--
ALTER TABLE `client_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `inventory_products`
--
ALTER TABLE `inventory_products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `supplier_products`
--
ALTER TABLE `supplier_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
