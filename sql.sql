-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.20-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-06-15 18:49:31
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

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

-- Dumping data for table top100.ci_session: ~1 rows (approximately)
/*!40000 ALTER TABLE `ci_session` DISABLE KEYS */;
INSERT INTO `ci_session` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('492693029f9412dcab27b7551dab57dc', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/20100101 Firefox/12.0', 1339778439, 'a:6:{s:9:"user_data";s:0:"";s:2:"id";s:2:"21";s:8:"username";s:6:"kjanko";s:8:"password";s:40:"112bb791304791ddcf692e29fd5cf149b35fea37";s:8:"activity";b:1;s:4:"rank";s:1:"2";}');
/*!40000 ALTER TABLE `ci_session` ENABLE KEYS */;


-- Dumping structure for table top100.top_subscriptions
DROP TABLE IF EXISTS `top_subscriptions`;
CREATE TABLE IF NOT EXISTS `top_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `u_id` bigint(20) unsigned NOT NULL,
  `username` varchar(250) CHARACTER SET utf8 NOT NULL,
  `timeleft` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

-- Dumping data for table top100.top_subscriptions: ~1 rows (approximately)
/*!40000 ALTER TABLE `top_subscriptions` DISABLE KEYS */;
INSERT INTO `top_subscriptions` (`id`, `u_id`, `username`, `timeleft`) VALUES
	(1, 1, 'kjanko', 241212512512521);
/*!40000 ALTER TABLE `top_subscriptions` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf32;

-- Dumping data for table top100.top_users: ~2 rows (approximately)
/*!40000 ALTER TABLE `top_users` DISABLE KEYS */;
INSERT INTO `top_users` (`id`, `s_id`, `username`, `name`, `l_name`, `password`, `email`, `rank`) VALUES
	(21, 1, 'kjanko', 'Kristijan', 'Jankoski', '112bb791304791ddcf692e29fd5cf149b35fea37', 'kiki.janko@gmail.com', 2),
	(29, 0, 'gjanko', 'Goko', 'Jankoski', '112bb791304791ddcf692e29fd5cf149b35fea37', 'goko-jankoski@hotmail.com', 2);
/*!40000 ALTER TABLE `top_users` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
