/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;



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

DELETE FROM `ci_session`;
/*!40000 ALTER TABLE `ci_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_session` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_advertisements`;
CREATE TABLE IF NOT EXISTS `top_advertisements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `href` varchar(100) NOT NULL DEFAULT 'top_default',
  `location` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_advertisements`;
/*!40000 ALTER TABLE `top_advertisements` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_advertisements` ENABLE KEYS */;


-- Dumping structure for table top_new.top_auctions
DROP TABLE IF EXISTS `top_auctions`;
CREATE TABLE IF NOT EXISTS `top_auctions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0 - closedUNPAID // 1 - active // 2 - closedPAID',
  `date_open` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default' COMMENT 'Y-m-d',
  `date_close` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default' COMMENT 'Y-m-d',
  `sponsored_start` varchar(50) NOT NULL DEFAULT 'top_default' COMMENT 'Y-m-d',
  `sponsored_close` varchar(50) NOT NULL DEFAULT 'top_default' COMMENT 'Y-m-d',
  `winner_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `winner_bid` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_auctions`;
/*!40000 ALTER TABLE `top_auctions` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_auctions` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_auctions_bids`;
CREATE TABLE IF NOT EXISTS `top_auctions_bids` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `current_bid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `auction_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_auctions_bids`;
/*!40000 ALTER TABLE `top_auctions_bids` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_auctions_bids` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_blacklist_ip`;
CREATE TABLE IF NOT EXISTS `top_blacklist_ip` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) DEFAULT '0.0.0.0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_blacklist_ip`;
/*!40000 ALTER TABLE `top_blacklist_ip` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_blacklist_ip` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_blacklist_profanity`;
CREATE TABLE IF NOT EXISTS `top_blacklist_profanity` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_blacklist_profanity`;
/*!40000 ALTER TABLE `top_blacklist_profanity` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_blacklist_profanity` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_blacklist_url`;
CREATE TABLE IF NOT EXISTS `top_blacklist_url` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_blacklist_url`;
/*!40000 ALTER TABLE `top_blacklist_url` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_blacklist_url` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_categories`;
CREATE TABLE IF NOT EXISTS `top_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf32;

DELETE FROM `top_categories`;
/*!40000 ALTER TABLE `top_categories` DISABLE KEYS */;
INSERT INTO `top_categories` (`id`, `category`) VALUES
	(1, 'World of Warcarft'),
	(2, 'Minecraft'),
	(3, 'Runescape'),
	(4, 'MU Online'),
	(5, 'Lineage'),
	(6, 'MMORPG'),
	(7, 'Gaming'),
	(8, 'Grand Theft Auto'),
	(9, 'Guild Wars'),
	(10, 'Half Life'),
	(11, 'Halo'),
	(12, 'Habbo Hotel'),
	(13, 'Cabal Online');
/*!40000 ALTER TABLE `top_categories` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_daily_income`;
CREATE TABLE IF NOT EXISTS `top_daily_income` (
  `date` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `income` bigint(20) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_daily_income`;
/*!40000 ALTER TABLE `top_daily_income` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_daily_income` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_daily_voters`;
CREATE TABLE IF NOT EXISTS `top_daily_voters` (
  `ip` varchar(20) NOT NULL DEFAULT '0.0.0.0',
  `site_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 - in ; 1 - out'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_daily_voters`;
/*!40000 ALTER TABLE `top_daily_voters` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_daily_voters` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_finished_resets`;
CREATE TABLE IF NOT EXISTS `top_finished_resets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL DEFAULT 'top_default',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_finished_resets`;
/*!40000 ALTER TABLE `top_finished_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_finished_resets` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_finished_votes`;
CREATE TABLE IF NOT EXISTS `top_finished_votes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL DEFAULT 'top_default',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_finished_votes`;
/*!40000 ALTER TABLE `top_finished_votes` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_finished_votes` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_navigation`;
CREATE TABLE IF NOT EXISTS `top_navigation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_name` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `link_url` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf32;

DELETE FROM `top_navigation`;
/*!40000 ALTER TABLE `top_navigation` DISABLE KEYS */;
INSERT INTO `top_navigation` (`id`, `link_name`, `link_url`) VALUES
	(1, 'Users', 'dashboard/users'),
	(2, 'Blacklist', 'dashboard/blacklist'),
	(3, 'Pages', 'dashboard/pages'),
	(4, 'Sites', 'dashboard/sites'),
	(5, 'Settings', 'dashboard/settings'),
	(6, 'Subscriptions', 'dashboard/subscriptions');
/*!40000 ALTER TABLE `top_navigation` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_navigation_header`;
CREATE TABLE IF NOT EXISTS `top_navigation_header` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `href` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `permission` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0 - everyone // 1 - guests // 2 - logged_in // 3 - admin',
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf32;

DELETE FROM `top_navigation_header`;
/*!40000 ALTER TABLE `top_navigation_header` DISABLE KEYS */;
INSERT INTO `top_navigation_header` (`id`, `href`, `name`, `permission`, `position`) VALUES
	(1, 'home', 'Home', 0, 0),
	(2, 'register', 'Register', 1, 1),
	(3, 'login', 'Login', 1, 2),
	(4, 'auction', 'Auction', 0, 3),
	(5, 'contact', 'Contact', 0, 15),
	(6, 'ucp', 'UCP', 2, 4),
	(7, 'acp/dashboard', 'ACP', 3, 5),
	(8, 'points', 'Buy Points', 2, 6),
	(9, 'premium', 'Premium', 2, 7);
/*!40000 ALTER TABLE `top_navigation_header` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_pages`;
CREATE TABLE IF NOT EXISTS `top_pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `controller` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `title` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `content` varchar(1000) NOT NULL DEFAULT 'top_default',
  PRIMARY KEY (`id`),
  UNIQUE KEY `controller` (`controller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_pages`;
/*!40000 ALTER TABLE `top_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_pages` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_paymentwall_logs`;
CREATE TABLE IF NOT EXISTS `top_paymentwall_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `ref` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date` varchar(100) NOT NULL DEFAULT 'top_default',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_paymentwall_logs`;
/*!40000 ALTER TABLE `top_paymentwall_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_paymentwall_logs` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_sites`;
CREATE TABLE IF NOT EXISTS `top_sites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `description` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `details_description` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `in_votes` int(10) unsigned NOT NULL DEFAULT '0',
  `out_votes` int(10) unsigned NOT NULL DEFAULT '0',
  `total_visitors` int(10) unsigned NOT NULL DEFAULT '0',
  `banner_url` varchar(500) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `url` varchar(500) NOT NULL DEFAULT 'top_default',
  `date` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  `premium` tinyint(1) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

DELETE FROM `top_sites`;
/*!40000 ALTER TABLE `top_sites` DISABLE KEYS */;
INSERT INTO `top_sites` (`id`, `user_id`, `category_id`, `title`, `description`, `details_description`, `in_votes`, `out_votes`, `total_visitors`, `banner_url`, `url`, `date`, `premium`, `featured`) VALUES
	(1, 1, 1, 'top_default', 'top_default', 'top_default', 0, 0, 0, 'top_default', 'top_default', 'top_default', 0, 0);
/*!40000 ALTER TABLE `top_sites` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_subscriptions`;
CREATE TABLE IF NOT EXISTS `top_subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `exp_date` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'top_default',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_subscriptions`;
/*!40000 ALTER TABLE `top_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_subscriptions` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_users`;
CREATE TABLE IF NOT EXISTS `top_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `s_id` bigint(20) unsigned DEFAULT NULL,
  `username` varchar(250) CHARACTER SET utf8 NOT NULL,
  `name` varchar(250) NOT NULL,
  `l_name` varchar(250) NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `rank` tinyint(250) unsigned NOT NULL DEFAULT '0',
  `blacklist` tinyint(4) NOT NULL DEFAULT '0',
  `balance` int(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf32;

DELETE FROM `top_users`;
/*!40000 ALTER TABLE `top_users` DISABLE KEYS */;
INSERT INTO `top_users` (`id`, `s_id`, `username`, `name`, `l_name`, `password`, `email`, `rank`, `blacklist`, `balance`) VALUES
	(1, 1, 'admin', 'Votizer', 'Votizer', '112bb791304791ddcf692e29fd5cf149b35fea37', 'example@domain.com', 2, 0, 0);
/*!40000 ALTER TABLE `top_users` ENABLE KEYS */;


DROP TABLE IF EXISTS `top_users_activity`;
CREATE TABLE IF NOT EXISTS `top_users_activity` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `ip` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '0.0.0.0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DELETE FROM `top_users_activity`;
/*!40000 ALTER TABLE `top_users_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `top_users_activity` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
