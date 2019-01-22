-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-09-17 12:30:00
-- 服务器版本： 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `police`
--

-- --------------------------------------------------------

--
-- 表的结构 `questioninfo`
--

CREATE TABLE `questioninfo` (
  `id` int(10) NOT NULL COMMENT '问题反馈ID，唯一自增',
  `jybh` char(10) NOT NULL COMMENT '警员编号',
  `title` varchar(30) NOT NULL COMMENT '问题标题',
  `content` text NOT NULL COMMENT '问题内容',
  `dateline` int(10) NOT NULL COMMENT 'UNIX时间戳'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `questioninfo`
--

INSERT INTO `questioninfo` (`id`, `jybh`, `title`, `content`, `dateline`) VALUES
(6, '023544', '问题反馈测试1', '问题反馈测试1问题反馈测试1问题反馈测试1问题反馈测试1问题反馈测试1问题反馈测试1问题反馈测试1问题反馈测试1问题反馈测试1问题反馈测试1问题反馈测试1问题反馈测试1', 1473469614);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questioninfo`
--
ALTER TABLE `questioninfo`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `questioninfo`
--
ALTER TABLE `questioninfo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '问题反馈ID，唯一自增', AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
