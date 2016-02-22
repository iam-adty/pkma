-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.46-0ubuntu0.14.04.2 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table adtyblog.access
DROP TABLE IF EXISTS `access`;
CREATE TABLE IF NOT EXISTS `access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `status` enum('published','draft','trash','pending') NOT NULL DEFAULT 'draft',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table adtyblog.access: ~2 rows (approximately)
DELETE FROM `access`;
/*!40000 ALTER TABLE `access` DISABLE KEYS */;
INSERT INTO `access` (`id`, `name`, `description`, `status`) VALUES
	(1, 'login_dashboard', 'Login to dashboard', 'published'),
	(2, 'view_dashboard', 'View dashboard', 'published');
/*!40000 ALTER TABLE `access` ENABLE KEYS */;


-- Dumping structure for table adtyblog.categories_and_tags
DROP TABLE IF EXISTS `categories_and_tags`;
CREATE TABLE IF NOT EXISTS `categories_and_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `type` enum('category','tag') NOT NULL DEFAULT 'category',
  `status` enum('published','draft','trash','pending') NOT NULL DEFAULT 'draft',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table adtyblog.categories_and_tags: ~0 rows (approximately)
DELETE FROM `categories_and_tags`;
/*!40000 ALTER TABLE `categories_and_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories_and_tags` ENABLE KEYS */;


-- Dumping structure for table adtyblog.level
DROP TABLE IF EXISTS `level`;
CREATE TABLE IF NOT EXISTS `level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `status` enum('published','draft','trash','pending') NOT NULL DEFAULT 'draft',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table adtyblog.level: ~1 rows (approximately)
DELETE FROM `level`;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` (`id`, `name`, `description`, `status`) VALUES
	(1, 'admin', 'Full access to blog', 'published');
/*!40000 ALTER TABLE `level` ENABLE KEYS */;


-- Dumping structure for table adtyblog.level_access
DROP TABLE IF EXISTS `level_access`;
CREATE TABLE IF NOT EXISTS `level_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `level_id` int(11) unsigned NOT NULL,
  `access_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_level_access_level` (`level_id`),
  KEY `FK_level_access_access` (`access_id`),
  CONSTRAINT `FK_level_access_access` FOREIGN KEY (`access_id`) REFERENCES `access` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_level_access_level` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table adtyblog.level_access: ~2 rows (approximately)
DELETE FROM `level_access`;
/*!40000 ALTER TABLE `level_access` DISABLE KEYS */;
INSERT INTO `level_access` (`id`, `level_id`, `access_id`) VALUES
	(1, 1, 1),
	(2, 1, 2);
/*!40000 ALTER TABLE `level_access` ENABLE KEYS */;


-- Dumping structure for table adtyblog.log
DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) NOT NULL,
  `table_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `description` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table adtyblog.log: ~0 rows (approximately)
DELETE FROM `log`;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;


-- Dumping structure for table adtyblog.post
DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `content` text,
  `type` enum('page','post') NOT NULL DEFAULT 'post',
  `status` enum('draft','published','trash','pending') NOT NULL DEFAULT 'draft',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table to save posts';

-- Dumping data for table adtyblog.post: ~0 rows (approximately)
DELETE FROM `post`;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;


-- Dumping structure for table adtyblog.post_categories_and_tags
DROP TABLE IF EXISTS `post_categories_and_tags`;
CREATE TABLE IF NOT EXISTS `post_categories_and_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) unsigned NOT NULL,
  `categories_and_tags_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table adtyblog.post_categories_and_tags: ~0 rows (approximately)
DELETE FROM `post_categories_and_tags`;
/*!40000 ALTER TABLE `post_categories_and_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_categories_and_tags` ENABLE KEYS */;


-- Dumping structure for table adtyblog.preferences
DROP TABLE IF EXISTS `preferences`;
CREATE TABLE IF NOT EXISTS `preferences` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text,
  `status` enum('published','draft','trash','pending') NOT NULL DEFAULT 'draft',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table adtyblog.preferences: ~0 rows (approximately)
DELETE FROM `preferences`;
/*!40000 ALTER TABLE `preferences` DISABLE KEYS */;
/*!40000 ALTER TABLE `preferences` ENABLE KEYS */;


-- Dumping structure for table adtyblog.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('pending','active','blocked') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table adtyblog.user: ~1 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `email`, `name`, `status`) VALUES
	(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@domain.com', 'Admin', 'active');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table adtyblog.user_access
DROP TABLE IF EXISTS `user_access`;
CREATE TABLE IF NOT EXISTS `user_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `access_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table adtyblog.user_access: ~0 rows (approximately)
DELETE FROM `user_access`;
/*!40000 ALTER TABLE `user_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_access` ENABLE KEYS */;


-- Dumping structure for table adtyblog.user_level
DROP TABLE IF EXISTS `user_level`;
CREATE TABLE IF NOT EXISTS `user_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `level_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_level_user` (`user_id`),
  KEY `FK_user_level_level` (`level_id`),
  CONSTRAINT `FK_user_level_level` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_user_level_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table adtyblog.user_level: ~1 rows (approximately)
DELETE FROM `user_level`;
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` (`id`, `user_id`, `level_id`) VALUES
	(1, 1, 1);
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;


-- Dumping structure for table adtyblog.user_post_level
DROP TABLE IF EXISTS `user_post_level`;
CREATE TABLE IF NOT EXISTS `user_post_level` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `post_id` int(11) unsigned NOT NULL,
  `level_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table adtyblog.user_post_level: ~0 rows (approximately)
DELETE FROM `user_post_level`;
/*!40000 ALTER TABLE `user_post_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_post_level` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
