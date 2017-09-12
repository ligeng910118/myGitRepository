-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2017 at 11:25 AM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oa_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `think_auth_group`
--

CREATE TABLE `think_auth_group` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_auth_group`
--

INSERT INTO `think_auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '管理组', 1, '21,22,23,24'),
(2, '用户组', 1, '18,19,20,17');

-- --------------------------------------------------------

--
-- Table structure for table `think_auth_group_access`
--

CREATE TABLE `think_auth_group_access` (
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) UNSIGNED NOT NULL COMMENT '用户组id',
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_auth_group_access`
--

INSERT INTO `think_auth_group_access` (`uid`, `group_id`, `id`) VALUES
(2, 1, 3),
(1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `think_auth_rule`
--

CREATE TABLE `think_auth_rule` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_auth_rule`
--

INSERT INTO `think_auth_rule` (`id`, `name`, `title`, `type`, `status`, `condition`) VALUES
(1, 'Admin/User/index', '用户列表', 1, 1, ''),
(2, 'Admin/User/add', '用户添加', 1, 1, ''),
(3, 'Admin/User/update', '用户编辑', 1, 1, ''),
(4, 'Admin/User/delete', '用户删除', 1, 1, ''),
(5, 'Admin/Privilege/index', '权限列表', 1, 1, ''),
(6, 'Admin/Privilege/add', '权限添加', 1, 1, ''),
(7, 'Admin/Privilege/update', '权限修改', 1, 1, ''),
(8, 'Admin/Privilege/delete', '权限删除', 1, 1, ''),
(9, 'Admin/Group/add', '群组添加', 1, 1, ''),
(10, 'Admin/Group/index', '群组列表', 1, 1, ''),
(11, 'Admin/Group/update', '群组修改', 1, 1, ''),
(12, 'Admin/Group/delete', '群组删除', 1, 1, ''),
(13, 'Admin/UserToGroup/delete', '分配删除', 1, 1, ''),
(14, 'Admin/UserToGroup/index', '分配列表', 1, 1, ''),
(15, 'Admin/UserToGroup/add', '分配添加', 1, 1, ''),
(16, 'Admin/UserToGroup/update', '分配修改', 1, 1, ''),
(17, 'Admin/ProductOrder/index', '产品列表', 1, 1, ''),
(18, 'Admin/ProductOrder/add', '产品添加', 1, 1, ''),
(19, 'Admin/ProductOrder/update', '产品修改', 1, 1, ''),
(20, 'Admin/ProductOrder/delete', '产品删除', 1, 1, ''),
(21, 'Admin/Manage/index', '审核操作', 1, 1, ''),
(22, 'Admin/Manage/payCode', '支付二维码', 1, 1, ''),
(23, 'Admin/Manage/approve', '审核操作', 1, 1, ''),
(24, 'Admin/Manage/complete', '审核完成', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `think_product_order`
--

CREATE TABLE `think_product_order` (
  `id` int(11) NOT NULL,
  `sellName` varchar(255) NOT NULL,
  `sellPhone` varchar(255) NOT NULL,
  `firstData` varchar(255) NOT NULL,
  `manageEmail` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `createTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `worker` int(11) NOT NULL,
  `payCode` varchar(255) NOT NULL,
  `payImage` varchar(255) NOT NULL,
  `secoudData` varchar(255) NOT NULL,
  `productStart` int(255) NOT NULL,
  `productEnd` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_product_order`
--

INSERT INTO `think_product_order` (`id`, `sellName`, `sellPhone`, `firstData`, `manageEmail`, `status`, `createTime`, `worker`, `payCode`, `payImage`, `secoudData`, `productStart`, `productEnd`) VALUES
(1, 'ligeng', '13197112342', 'Uploads/2017-09-04/59acc941b13a6.zip', '19915868@qq.com', 2, '2017-09-04 03:52:19', 2, 'Uploads/2017-09-04/59accdf3af877.jpg', 'Uploads/2017-09-04/59accaa98fa0a.jpg', 'Uploads/2017-09-04/59accaa98fcdb.zip', 1504496494, 1504496494),
(3, 'xiaoming', '13197112342', 'Uploads/2017-09-04/59acd43f4a794.zip', '19915868@qq.com', 1, '2017-09-04 04:19:00', 1, '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `think_user`
--

CREATE TABLE `think_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `think_user`
--

INSERT INTO `think_user` (`id`, `username`, `email`, `last_time`, `status`, `password`) VALUES
(1, 'ligeng', '2316558806@qq.com', '2017-09-04 02:58:06', 1, 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'zhangSir', '19915868@qq.com', '2017-09-04 03:18:42', 0, 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `think_auth_group`
--
ALTER TABLE `think_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_auth_group_access`
--
ALTER TABLE `think_auth_group_access`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `think_auth_rule`
--
ALTER TABLE `think_auth_rule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `think_product_order`
--
ALTER TABLE `think_product_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_user`
--
ALTER TABLE `think_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `think_auth_group`
--
ALTER TABLE `think_auth_group`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `think_auth_group_access`
--
ALTER TABLE `think_auth_group_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `think_auth_rule`
--
ALTER TABLE `think_auth_rule`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `think_product_order`
--
ALTER TABLE `think_product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `think_user`
--
ALTER TABLE `think_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
