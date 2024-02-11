-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:3306
-- 生成日期： 2023-10-17 04:54:08
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
-- 数据库： `db_bank`
--

-- --------------------------------------------------------

--
-- 表的结构 `CARD`
--

CREATE TABLE `CARD` (
  `card_id` int NOT NULL,
  `card_holder_name` varchar(50) NOT NULL,
  `card_num` varchar(50) NOT NULL,
  `pin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `CARD`
--

INSERT INTO `CARD` (`card_id`, `card_holder_name`, `card_num`, `pin`) VALUES
(1, 'John Doe', '1234567890123456', '1234'),
(2, 'Jane Smith', '2345678901234567', '5678'),
(3, 'Alice Johnson', '3456789012345678', '9012'),
(4, 'Bob White', '4567890123456789', '3456');

--
-- 转储表的索引
--

--
-- 表的索引 `CARD`
--
ALTER TABLE `CARD`
  ADD PRIMARY KEY (`card_id`),
  ADD UNIQUE KEY `card_num` (`card_num`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `CARD`
--
ALTER TABLE `CARD`
  MODIFY `card_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
