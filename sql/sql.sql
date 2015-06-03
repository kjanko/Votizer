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
DROP DATABASE IF EXISTS `top100`;
CREATE DATABASE IF NOT EXISTS `top100` /*!40100 DEFAULT CHARACTER SET utf32 */;
USE `top100`;


-- Dumping structure for table top100.ci_session
DROP TABLE IF EXISTS `ci_session`;
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
DROP TABLE IF EXISTS `top_blacklist_ip`;
CREATE TABLE IF NOT EXISTS `top_blacklist_ip` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) DEFAULT '0.0.0.0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_navigation
DROP TABLE IF EXISTS `top_navigation`;
CREATE TABLE IF NOT EXISTS `top_navigation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_name` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `link_url` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_sites
DROP TABLE IF EXISTS `top_sites`;
CREATE TABLE IF NOT EXISTS `top_sites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `description` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `in_votes` int(10) unsigned NOT NULL DEFAULT '0',
  `out_votes` int(10) unsigned NOT NULL DEFAULT '0',
  `baner_url` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `premium` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_subscriptions
DROP TABLE IF EXISTS `top_subscriptions`;
CREATE TABLE IF NOT EXISTS `top_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` bigint(20) unsigned NOT NULL,
  `username` varchar(250) CHARACTER SET utf8 NOT NULL,
  `timeleft` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.


-- Dumping structure for table top100.top_users
DROP TABLE IF EXISTS `top_users`;
CREATE TABLE IF NOT EXISTS `top_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `s_id` bigint(20) unsigned NOT NULL,
  `username` varchar(250) CHARACTER SET utf8 NOT NULL,
  `name` varchar(250) NOT NULL,
  `l_name` varchar(250) NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `rank` tinyint(250) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
