-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-03-25 10:50:32
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
-- 表的结构 `notice_receiver`
--

CREATE TABLE `notice_receiver` (
  `nrid` bigint(20) NOT NULL,
  `noticeid` bigint(10) NOT NULL COMMENT '信息ID',
  `isReading` char(1) DEFAULT NULL COMMENT '是否阅读，默认为0; 1 已阅读 0 未阅读',
  `receiver` varchar(6) DEFAULT NULL COMMENT '接收警员编号',
  `createTime` varchar(20) DEFAULT NULL COMMENT '创建日期',
  `dateline` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='通知公告与警员子表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notice_receiver`
--
ALTER TABLE `notice_receiver`
  ADD PRIMARY KEY (`nrid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `notice_receiver`
--
ALTER TABLE `notice_receiver`
  MODIFY `nrid` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
