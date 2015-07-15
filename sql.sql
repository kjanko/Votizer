-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for top100
CREATE DATABASE IF NOT EXISTS `top100` /*!40100 DEFAULT CHARACTER SET utf32 */;
USE `top100`;


-- Dumping structure for table top100.ci_session
CREATE TABLE IF NOT EXISTS `ci_session` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_blacklist_ip
CREATE TABLE IF NOT EXISTS `top_blacklist_ip` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) DEFAULT '0.0.0.0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_blacklist_profanity
CREATE TABLE IF NOT EXISTS `top_blacklist_profanity` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(50) NOT NULL DEFAULT '0',
  `replacement` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_blacklist_url
CREATE TABLE IF NOT EXISTS `top_blacklist_url` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `url` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_monthly_income
CREATE TABLE IF NOT EXISTS `top_monthly_income` (
  `month` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `amount` bigint(20) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_navigation
CREATE TABLE IF NOT EXISTS `top_navigation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_name` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `link_url` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_pages
CREATE TABLE IF NOT EXISTS `top_pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `controller` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `title` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `content` varchar(5000) NOT NULL DEFAULT 'top_default',
  PRIMARY KEY (`id`),
  UNIQUE KEY `controller` (`controller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_sites
CREATE TABLE IF NOT EXISTS `top_sites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `description` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `in_votes` int(10) unsigned NOT NULL DEFAULT '0',
  `out_votes` int(10) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `url` varchar(500) NOT NULL DEFAULT 'top_default',
  `premium` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_subscriptions
CREATE TABLE IF NOT EXISTS `top_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `username` varchar(250) CHARACTER SET utf8 NOT NULL,
  `timeleft` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_subscriptions_log
CREATE TABLE IF NOT EXISTS `top_subscriptions_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `date` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_users
CREATE TABLE IF NOT EXISTS `top_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `s_id` bigint(20) unsigned NOT NULL,
  `username` varchar(250) CHARACTER SET utf8 NOT NULL,
  `name` varchar(250) NOT NULL,
  `l_name` varchar(250) NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `rank` tinyint(250) unsigned NOT NULL DEFAULT '0',
  `blacklist` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_users_activity
CREATE TABLE IF NOT EXISTS `top_users_activity` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `ip` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '0.0.0.0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
