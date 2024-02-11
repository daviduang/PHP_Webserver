-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:3306
-- 生成日期： 2023-10-17 04:54:16
-- 服务器版本： 8.0.34-0ubuntu0.20.04.1
-- PHP 版本： 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `db_market`
--

-- --------------------------------------------------------

--
-- 表的结构 `PURCHASE`
--

CREATE TABLE `PURCHASE` (
  `pur_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `item_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `seller_ip` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `PURCHASE`
--

INSERT INTO `PURCHASE` (`pur_id`, `user_id`, `item_id`, `quantity`, `price`, `seller_ip`, `date`) VALUES
(14, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-13 09:24:19'),
(15, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-13 09:44:01'),
(16, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-13 09:45:49'),
(17, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-13 13:04:08'),
(18, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-13 13:05:25'),
(19, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-13 13:43:16'),
(20, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-13 14:11:48'),
(21, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-14 07:30:20'),
(22, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-14 07:31:06'),
(23, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-15 07:09:53'),
(24, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-15 11:48:21'),
(25, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-15 12:01:49'),
(26, 1, 1, 5, '25.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-15 12:08:53'),
(27, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-16 11:00:18'),
(28, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-16 11:00:53'),
(29, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-16 11:02:15'),
(30, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-16 11:04:09'),
(31, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-16 11:04:45'),
(32, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1/', '2023-10-16 11:35:40'),
(33, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller2/', '2023-10-16 11:36:13'),
(34, 1, 1, 1, '5.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller2/', '2023-10-16 11:36:59'),
(35, 1, 1, 5, '25.00', 'lab-3395bfef-7de6-4b90-af98-caa76e5daa8a.australiasoutheast.cloudapp.azure.com:7078/Assignment2/seller1', '2023-10-16 11:43:25'),
(36, 1, 1, 1, '15.00', 'lab-299b5d82-0c6f-40e1-a191-9f9b2e05db14.australiasoutheast.cloudapp.azure.com:7055/Assignment2/seller2', '2023-10-16 12:23:04'),
(37, 1, 1, 5, '75.00', 'lab-299b5d82-0c6f-40e1-a191-9f9b2e05db14.australiasoutheast.cloudapp.azure.com:7055/Assignment2/seller2', '2023-10-16 14:13:16');

-- --------------------------------------------------------

--
-- 表的结构 `USER`
--

CREATE TABLE `USER` (
  `user_id` int NOT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `user_address` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `USER`
--

INSERT INTO `USER` (`user_id`, `balance`, `user_address`, `user_name`, `user_password`) VALUES
(1, '25.00', '42 Melville st', 'David', '$2y$10$AoJZFN5.DKXT/sWw4nX.n.lGZ/0gVDPPgO9KXNwt625O9HSFR0HWW'),
(2, '150.00', '56 Green Lane', 'Alice', '$2y$10$KgFTJWhFGfYIcvN8L7cDA.ck4a4t0C2DMaIfODwjdnRmLOO9Cmq1W'),
(3, '80.00', '14 Elm Street', 'Bob', '$2y$10$KgFTJWhFGfYIcvN8L7cDA.ck4a4t0C2DMaIfODwjdnRmLOO9Cmq1W'),
(4, '200.00', '25 Oak Avenue', 'Charlie', '$2y$10$KgFTJWhFGfYIcvN8L7cDA.ck4a4t0C2DMaIfODwjdnRmLOO9Cmq1W');

--
-- 转储表的索引
--

--
-- 表的索引 `PURCHASE`
--
ALTER TABLE `PURCHASE`
  ADD PRIMARY KEY (`pur_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 表的索引 `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `PURCHASE`
--
ALTER TABLE `PURCHASE`
  MODIFY `pur_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 使用表AUTO_INCREMENT `USER`
--
ALTER TABLE `USER`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 限制导出的表
--

--
-- 限制表 `PURCHASE`
--
ALTER TABLE `PURCHASE`
  ADD CONSTRAINT `PURCHASE_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `USER` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
