-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 01:52 PM
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
-- Database: `car_sale_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `seats_no` int(11) NOT NULL,
  `doors` enum('2','3','4','5') NOT NULL,
  `fuel` enum('Petrol','Diesel','Gas','Electric','Hybrid/Petrol') NOT NULL,
  `transmission` enum('Automatic','Manual','CVT') NOT NULL,
  `wheel` enum('2WD','4WD') NOT NULL,
  `color` enum('Pearl white','Metallic maroon','Gray','Matte black','Blue','Silver','Black') NOT NULL,
  `mileage` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` decimal(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `brand`, `model`, `seats_no`, `doors`, `fuel`, `transmission`, `wheel`, `color`, `mileage`, `year`, `image`, `created_at`, `price`) VALUES
(1, 'Land Rover', 'Discovery 4', 5, '2', 'Petrol', 'Automatic', '2WD', 'Pearl white', 650000, 2014, 'uploads/2022-toyota-gr-86.jpg', '2024-06-18 11:02:55', 120000000.00),
(2, 'Mercedes Benz', 'GLC 220d 4MATIC', 5, '2', 'Petrol', 'Automatic', '2WD', 'Pearl white', 62000, 2015, 'uploads/images.jpeg', '2024-06-18 11:05:07', 146000000.00),
(6, 'Toyota', 'Toyota Crown 3.5 Hybrid RS Advance', 5, '4', 'Diesel', 'Manual', '2WD', 'Matte black', 80000, 2010, 'uploads/images (1).jpeg', '2024-06-19 11:19:39', 45000000.00),
(7, 'Subaru', 'Subaru Solterra', 2, '3', 'Petrol', 'Manual', '4WD', 'Silver', 75000, 2015, 'uploads/subaru-256561_1280.jpg', '2024-06-19 11:33:18', 250000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` enum('not picked','picked') DEFAULT 'not picked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `car_id`, `order_date`, `status`) VALUES
(1, 1, 1, '2024-06-19 13:14:27', 'not picked');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `address`, `contact`, `email`, `password`, `created_at`, `role`) VALUES
(1, 'Joshua Speaker Urio', 'Ilala', '0753291621', 'joshuaurio99@gmail.com', '$2y$10$RLavR5ADm8nM054fcDPzDOwWILSpqRS96rsFvNUcTcYAt1vMOmnlK', '2024-06-18 16:59:03', 'user'),
(4, 'administrato', 'Ilala', '0753291621', 'administrator@gmail.com', '$2y$10$GR3jfGjcVdag/CZANU0EzO6.saltrR.k7BEd3.vIskfdWcHo42Mx2', '2024-06-18 17:50:35', 'admin'),
(5, 'Alex Njau', 'Ilala', '0753291621', 'alex@gmail.com', '$2y$10$FsPnpDYqVnhnQ4yxSro/bueh5FMvFSLXJWVy3AzKeO1hbl7vyL8HK', '2024-06-19 10:43:37', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `car_id`) VALUES
(2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
