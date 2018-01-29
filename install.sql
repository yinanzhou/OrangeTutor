SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `orangetutor` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `orangetutor`;

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_name` varchar(64) NOT NULL DEFAULT 'Unnamed Group',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `groups` (`group_id`, `group_name`) VALUES
(1, 'Administrators'),
(2, 'Tutors'),
(3, 'Students'),
(4, 'Parents');

DROP TABLE IF EXISTS `memberships`;
CREATE TABLE IF NOT EXISTS `memberships` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `membership_validfrom` datetime DEFAULT NULL,
  `membership_expiration` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `parents`;
CREATE TABLE IF NOT EXISTS `parents` (
  `parent_user_id` mediumint(9) NOT NULL,
  `child_user_id` mediumint(9) NOT NULL,
  PRIMARY KEY (`parent_user_id`,`child_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User ID',
  `user_email` varchar(255) DEFAULT NULL,
  `user_firstname` varchar(40) NOT NULL DEFAULT '' COMMENT 'First Name',
  `user_middlename` varchar(40) NOT NULL DEFAULT '' COMMENT 'Middle Name',
  `user_lastname` varchar(40) NOT NULL DEFAULT '' COMMENT 'Last Name',
  `user_password` varchar(256) DEFAULT NULL COMMENT 'User Password',
  `user_enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `USER_EMAIL_INDEX` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `groups` ADD FULLTEXT KEY `GROUP_NAME_INDEX` (`group_name`);

ALTER TABLE `users` ADD FULLTEXT KEY `USER_NAME_INDEX` (`user_firstname`,`user_lastname`);

