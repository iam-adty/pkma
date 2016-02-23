-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2016 at 10:54 AM
-- Server version: 5.6.28-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkma`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `status` enum('published','draft','trash','pending') NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB AUTO_INCREMENT=10343 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`id`, `name`, `description`, `status`) VALUES
(1, 'dashboard_login', '', 'published'),
(10, 'dashboard_view', '', 'published'),
(100, 'dashboard_page_view', '', 'published'),
(110, 'dashboard_page_list', '', 'published'),
(111, 'dashboard_page_list_own', '', 'published'),
(112, 'dashboard_page_list_other', '', 'published'),
(120, 'dashboard_page_create', '', 'published'),
(130, 'dashboard_page_update', '', 'published'),
(131, 'dashboard_page_update_own', '', 'published'),
(132, 'dashboard_page_update_other', '', 'published'),
(140, 'dashboard_page_delete', '', 'published'),
(141, 'dashboard_page_delete_own', '', 'published'),
(142, 'dashboard_page_delete_other', '', 'published'),
(200, 'dashboard_post_view', '', 'published'),
(210, 'dashboard_post_list', '', 'published'),
(211, 'dashboard_post_list_own', '', 'published'),
(212, 'dashboard_post_list_other', '', 'published'),
(220, 'dashboard_post_create', '', 'published'),
(230, 'dashboard_post_update', '', 'published'),
(231, 'dashboard_post_update_own', '', 'published'),
(232, 'dashboard_post_update_other', '', 'published'),
(240, 'dashboard_post_delete', '', 'published'),
(241, 'dashboard_post_delete_own', '', 'published'),
(242, 'dashboard_post_delete_other', '', 'published'),
(300, 'dashboard_category_view', '', 'published'),
(310, 'dashboard_category_list', ' ', 'published'),
(311, 'dashboard_category_list_own', ' ', 'published'),
(312, 'dashboard_category_list_other', ' ', 'published'),
(320, 'dashboard_category_create', ' ', 'published'),
(330, 'dashboard_category_update', ' ', 'published'),
(331, 'dashboard_category_update_own', ' ', 'published'),
(332, 'dashboard_category_update_other', ' ', 'published'),
(340, 'dashboard_category_delete', ' ', 'published'),
(341, 'dashboard_category_delete_own', ' ', 'published'),
(342, 'dashboard_category_delete_other', ' ', 'published'),
(10001, 'revoke_dashboard_login', '', 'published'),
(10010, 'revoke_dashboard_view', '', 'published'),
(10100, 'revoke_dashboard_page_view', '', 'published'),
(10110, 'revoke_dashboard_page_list', '', 'published'),
(10111, 'revoke_dashboard_page_list_own', '', 'published'),
(10112, 'revoke_dashboard_page_list_other', '', 'published'),
(10120, 'revoke_dashboard_page_create', '', 'published'),
(10130, 'revoke_dashboard_page_update', '', 'published'),
(10131, 'revoke_dashboard_page_update_own', '', 'published'),
(10132, 'revoke_dashboard_page_update_other', '', 'published'),
(10140, 'revoke_dashboard_page_delete', '', 'published'),
(10141, 'revoke_dashboard_page_delete_own', '', 'published'),
(10142, 'revoke_dashboard_page_delete_other', '', 'published'),
(10200, 'revoke_dashboard_post_view', '', 'published'),
(10210, 'revoke_dashboard_post_list', '', 'published'),
(10211, 'revoke_dashboard_post_list_own', '', 'published'),
(10212, 'revoke_dashboard_post_list_other', '', 'published'),
(10220, 'revoke_dashboard_post_create', '', 'published'),
(10230, 'revoke_dashboard_post_update', '', 'published'),
(10231, 'revoke_dashboard_post_update_own', '', 'published'),
(10232, 'revoke_dashboard_post_update_other', '', 'published'),
(10240, 'revoke_dashboard_post_delete', '', 'published'),
(10241, 'revoke_dashboard_post_delete_own', '', 'published'),
(10242, 'revoke_dashboard_post_delete_other', '', 'published'),
(10300, 'revoke_dashboard_category_view', '', 'published'),
(10310, 'revoke_dashboard_category_list', '', 'published'),
(10311, 'revoke_dashboard_category_list_own', '', 'published'),
(10312, 'revoke_dashboard_category_list_other', '', 'published'),
(10320, 'revoke_dashboard_category_create', '', 'published'),
(10330, 'revoke_dashboard_category_update', '', 'published'),
(10331, 'revoke_dashboard_category_update_own', '', 'published'),
(10332, 'revoke_dashboard_category_update_other', '', 'published'),
(10340, 'revoke_dashboard_category_delete', '', 'published'),
(10341, 'revoke_dashboard_category_delete_own', '', 'published'),
(10342, 'revoke_dashboard_category_delete_other', '', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) unsigned NOT NULL,
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `status` enum('published','draft','trash','pending') NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent`, `name`, `description`, `status`) VALUES
(4, 0, 'No Category', 'No Category', 'draft'),
(5, 0, 'News', 'News Category', 'draft'),
(6, 5, 'Sport News', 'Sport News Catgory', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `status` enum('published','draft','trash','pending') NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB AUTO_INCREMENT=100002 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `name`, `description`, `status`) VALUES
(1, 'admin', '', 'published'),
(100, 'page_owner', '', 'published'),
(110, 'page_writer', '', 'published'),
(200, 'post_owner', '', 'published'),
(210, 'post_writer', '', 'published'),
(300, 'category_owner', '', 'published'),
(400, 'tag_owner', '', 'published'),
(100001, 'user', '', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `level_access`
--

CREATE TABLE IF NOT EXISTS `level_access` (
  `id` int(11) unsigned NOT NULL,
  `level_id` int(11) unsigned NOT NULL,
  `access_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level_access`
--

INSERT INTO `level_access` (`id`, `level_id`, `access_id`) VALUES
(1, 1, 1),
(2, 1, 10),
(3, 1, 100),
(4, 1, 110),
(5, 1, 111),
(6, 1, 112),
(7, 1, 120),
(8, 1, 130),
(9, 1, 131),
(10, 1, 132),
(11, 1, 140),
(12, 1, 141),
(13, 1, 142),
(14, 1, 200),
(15, 1, 210),
(16, 1, 211),
(17, 1, 212),
(18, 1, 220),
(19, 1, 230),
(20, 1, 231),
(21, 1, 232),
(22, 1, 240),
(23, 1, 241),
(24, 1, 242),
(25, 100001, 1),
(26, 100001, 10),
(27, 100001, 100),
(28, 100001, 110),
(29, 100001, 111),
(30, 100, 131),
(31, 100, 141),
(32, 100, 111),
(33, 1, 300),
(34, 1, 310),
(35, 1, 311),
(36, 1, 312),
(37, 1, 320),
(38, 1, 330),
(39, 1, 331),
(40, 1, 332),
(41, 1, 340),
(42, 1, 341),
(43, 1, 342),
(44, 100001, 130),
(45, 100001, 140),
(46, 300, 311),
(47, 300, 341),
(48, 300, 331);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(1) unsigned NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `table_name` varchar(255) NOT NULL,
  `table_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `description` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `parent`, `table_name`, `table_id`, `type`, `user_id`, `description`, `date`) VALUES
(1, 0, 'post', 1, 'create', 1, '', '2016-02-17 02:18:17'),
(2, 1, 'user_post_level', 1, 'create', 1, '', '2016-02-17 02:18:17'),
(3, 0, 'post', 2, 'create', 1, '', '2016-02-18 01:31:43'),
(4, 3, 'user_post_level', 2, 'create', 1, '', '2016-02-18 01:31:43'),
(5, 0, 'post', 3, 'create', 2, '', '2016-02-18 01:37:12'),
(6, 5, 'user_post_level', 3, 'create', 2, '', '2016-02-18 01:37:12'),
(10, 0, 'category', 4, 'create', 1, '', '2016-02-21 04:27:20'),
(11, 10, 'user_category_level', 1, 'create', 1, '', '2016-02-21 04:27:20'),
(12, 0, 'category', 5, 'create', 1, '', '2016-02-21 08:04:00'),
(13, 12, 'user_category_level', 2, 'create', 1, '', '2016-02-21 08:04:00'),
(14, 0, 'category', 6, 'create', 1, '', '2016-02-21 08:04:16'),
(15, 14, 'user_category_level', 3, 'create', 1, '', '2016-02-21 08:04:16'),
(16, 0, 'category', 6, 'update', 1, '', '2016-02-21 11:59:03'),
(17, 0, 'category', 6, 'update', 1, '', '2016-02-21 12:00:15'),
(18, 0, 'category', 6, 'update', 1, '', '2016-02-21 12:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `content` text,
  `type` enum('page','post') NOT NULL DEFAULT 'post',
  `status` enum('draft','published','trash','pending') NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='table to save posts';

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `url`, `content`, `type`, `status`) VALUES
(1, 'Halaman 1', 'halaman-1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed sem odio. Nulla mattis magna vitae ante aliquet sollicitudin. Suspendisse a turpis sed lacus cursus fermentum. Donec vulputate lorem est, in mollis mi consectetur ac. Vivamus efficitur justo sed diam malesuada efficitur. Cras leo massa, auctor sit amet ex ac, condimentum laoreet erat. Suspendisse lacus tortor, consequat a auctor nec, finibus nec urna. Maecenas sodales odio in sem dignissim imperdiet. Fusce et odio non ipsum pellentesque ornare. Mauris magna augue, aliquam sed orci at, laoreet blandit justo. Mauris tincidunt mi eleifend, congue sapien non, eleifend leo. Nulla faucibus velit in augue pulvinar sagittis. Fusce pulvinar libero quis laoreet convallis.</p><p>Nam sollicitudin dolor et sem varius mollis. Aenean a lectus sed tortor accumsan pellentesque ut id mi. Fusce tristique quis massa sit amet ornare. Mauris ultricies blandit elit a pretium. Phasellus vitae molestie libero. Suspendisse quis risus varius, efficitur elit porta, hendrerit leo. Praesent suscipit ultrices pretium. Mauris mollis risus quis luctus luctus. Morbi congue elit tellus, eget auctor augue sollicitudin fringilla. Aliquam imperdiet magna eget felis porta, sed porta odio gravida. Vestibulum at nisl risus. Maecenas tincidunt dictum ligula ac volutpat. Nam magna ligula, semper vitae neque nec, volutpat viverra elit.</p><p>Fusce eu sapien eget lectus tincidunt elementum non nec elit. Vivamus fermentum egestas ultricies. Maecenas pellentesque, odio nec rhoncus finibus, odio nibh blandit ipsum, ut auctor tellus lorem ac purus. Donec nec ligula felis. Ut ultrices dui sit amet nisl elementum, sit amet volutpat ipsum volutpat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc blandit urna nec odio gravida posuere. Curabitur sit amet mollis enim. Sed aliquam urna nibh, et tincidunt felis viverra at. In malesuada justo vitae consequat sodales. Morbi ac convallis ligula, at egestas tortor. Nunc porta pharetra lectus in eleifend. Praesent id dapibus ex. Vivamus at consectetur mi. Quisque vitae pellentesque tortor, vel pharetra mi.</p><p>Proin consectetur nisi in elementum semper. Sed feugiat lacinia elementum. Aenean aliquam, est ultrices luctus tristique, ex elit blandit leo, sit amet fringilla nisi arcu eget sem. Nulla pretium enim nec arcu finibus, in interdum sem molestie. Donec commodo ante ligula. Donec eu lorem ligula. Proin interdum vitae velit eget commodo. Nunc id pretium mi, id volutpat sapien. Nam tincidunt suscipit purus vel tristique. Sed quis finibus leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>', 'page', 'published'),
(2, 'Halaman 2', 'halaman-2', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla iaculis ex iaculis risus dignissim, quis elementum massa egestas. Nulla malesuada fringilla mollis. Maecenas eu nisl consectetur, cursus felis quis, bibendum nulla. Quisque maximus odio at commodo tristique. Nam consectetur magna at tempor ullamcorper. Vestibulum est dolor, sodales eget mauris non, fermentum varius massa. Proin et justo varius, semper eros vel, porta velit. Donec blandit nisi commodo scelerisque ultricies. Mauris sollicitudin mattis risus eget pretium. Mauris id congue ipsum. Maecenas at orci sed velit malesuada condimentum.</p><p>Nulla sed libero vel neque imperdiet sollicitudin. Nam porta vestibulum orci. Phasellus egestas molestie augue, vitae dignissim ante sagittis ac. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris lobortis nibh ac eros blandit, vel bibendum ligula porta. Nullam laoreet, urna et tincidunt accumsan, magna magna euismod lectus, a gravida nunc tortor in turpis. Fusce pellentesque tortor lorem, eget viverra magna efficitur quis. Morbi iaculis faucibus augue, sed mollis lectus pulvinar quis. Sed tempor, elit at feugiat accumsan, odio lorem rutrum lacus, congue viverra lorem urna consectetur orci. Duis non felis id lacus malesuada scelerisque. Cras erat diam, porttitor at placerat in, porttitor in diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eros sem, pellentesque eu scelerisque eu, consequat eu ipsum. Aenean vehicula non nisl ac fermentum. Sed convallis arcu quis tortor blandit, consectetur placerat lorem maximus.</p>', 'page', 'draft'),
(3, 'Halaman 3', 'halaman-3', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla iaculis ex iaculis risus dignissim, quis elementum massa egestas. Nulla malesuada fringilla mollis. Maecenas eu nisl consectetur, cursus felis quis, bibendum nulla. Quisque maximus odio at commodo tristique. Nam consectetur magna at tempor ullamcorper. Vestibulum est dolor, sodales eget mauris non, fermentum varius massa. Proin et justo varius, semper eros vel, porta velit. Donec blandit nisi commodo scelerisque ultricies. Mauris sollicitudin mattis risus eget pretium. Mauris id congue ipsum. Maecenas at orci sed velit malesuada condimentum.</p><p>Nulla sed libero vel neque imperdiet sollicitudin. Nam porta vestibulum orci. Phasellus egestas molestie augue, vitae dignissim ante sagittis ac. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris lobortis nibh ac eros blandit, vel bibendum ligula porta. Nullam laoreet, urna et tincidunt accumsan, magna magna euismod lectus, a gravida nunc tortor in turpis. Fusce pellentesque tortor lorem, eget viverra magna efficitur quis. Morbi iaculis faucibus augue, sed mollis lectus pulvinar quis. Sed tempor, elit at feugiat accumsan, odio lorem rutrum lacus, congue viverra lorem urna consectetur orci. Duis non felis id lacus malesuada scelerisque. Cras erat diam, porttitor at placerat in, porttitor in diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eros sem, pellentesque eu scelerisque eu, consequat eu ipsum. Aenean vehicula non nisl ac fermentum. Sed convallis arcu quis tortor blandit, consectetur placerat lorem maximus.</p>', 'page', 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE IF NOT EXISTS `post_category` (
  `id` int(11) unsigned NOT NULL,
  `post_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE IF NOT EXISTS `post_tag` (
  `id` int(11) unsigned NOT NULL,
  `post_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE IF NOT EXISTS `preferences` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text,
  `status` enum('published','draft','trash','pending') NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `status` enum('published','draft','trash','pending') NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('pending','active','blocked') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`, `status`) VALUES
(1, 'adty', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'iam.adty@gmail.com', 'Aditiya', 'active'),
(2, 'user_1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'user_1@mail.com', 'User 1', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE IF NOT EXISTS `user_access` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `access_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `user_category_access`
--

CREATE TABLE IF NOT EXISTS `user_category_access` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `access_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `user_category_level`
--

CREATE TABLE IF NOT EXISTS `user_category_level` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `level_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_category_level`
--

INSERT INTO `user_category_level` (`id`, `user_id`, `category_id`, `level_id`) VALUES
(1, 1, 4, 300),
(2, 1, 5, 300),
(3, 1, 6, 300);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `level_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `user_id`, `level_id`) VALUES
(1, 1, 1),
(2, 2, 100001);

-- --------------------------------------------------------

--
-- Table structure for table `user_post_access`
--

CREATE TABLE IF NOT EXISTS `user_post_access` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `post_id` int(11) unsigned NOT NULL,
  `access_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `user_post_level`
--

CREATE TABLE IF NOT EXISTS `user_post_level` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `post_id` int(11) unsigned NOT NULL,
  `level_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_post_level`
--

INSERT INTO `user_post_level` (`id`, `user_id`, `post_id`, `level_id`) VALUES
(1, 1, 1, 100),
(2, 1, 2, 100),
(3, 2, 3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `user_tag_access`
--

CREATE TABLE IF NOT EXISTS `user_tag_access` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  `access_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `user_tag_level`
--

CREATE TABLE IF NOT EXISTS `user_tag_level` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  `level_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `level_access`
--
ALTER TABLE `level_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_category_access`
--
ALTER TABLE `user_category_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_category_level`
--
ALTER TABLE `user_category_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_post_access`
--
ALTER TABLE `user_post_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_post_level`
--
ALTER TABLE `user_post_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tag_access`
--
ALTER TABLE `user_tag_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tag_level`
--
ALTER TABLE `user_tag_level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10343;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100002;
--
-- AUTO_INCREMENT for table `level_access`
--
ALTER TABLE `level_access`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(1) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_category_access`
--
ALTER TABLE `user_category_access`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_category_level`
--
ALTER TABLE `user_category_level`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_post_access`
--
ALTER TABLE `user_post_access`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_post_level`
--
ALTER TABLE `user_post_level`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_tag_access`
--
ALTER TABLE `user_tag_access`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_tag_level`
--
ALTER TABLE `user_tag_level`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
