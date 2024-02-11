-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:3306
-- 生成日期： 2023-10-17 04:54:26
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
-- 数据库： `db_seller2`
--

-- --------------------------------------------------------

--
-- 表的结构 `ITEM`
--

CREATE TABLE `ITEM` (
  `item_id` int NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `stock_qty` int DEFAULT NULL,
  `price_of_unit` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `ITEM`
--

INSERT INTO `ITEM` (`item_id`, `item_name`, `stock_qty`, `price_of_unit`) VALUES
(1, 'Chicken', 100, '15.00'),
(2, 'Beef', 100, '16.00'),
(3, 'Pork', 100, '10.00'),
(4, 'Lamb', 100, '12.00'),
(5, 'Water', 100, '5.00');

--
-- 转储表的索引
--

--
-- 表的索引 `ITEM`
--
ALTER TABLE `ITEM`
  ADD PRIMARY KEY (`item_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ITEM`
--
ALTER TABLE `ITEM`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
