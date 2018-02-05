SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `orangetutor` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `orangetutor`;

CREATE TABLE `group` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(64) NOT NULL DEFAULT 'Unnamed Group'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `group` (`group_id`, `group_name`) VALUES
(1, 'Administrators'),
(2, 'Tutors'),
(3, 'Students'),
(4, 'Parents');

CREATE TABLE `membership` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `membership_validfrom` datetime DEFAULT NULL,
  `membership_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `parent` (
  `parent_user_id` mediumint(9) NOT NULL,
  `child_user_id` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
  `user_id` mediumint(8) UNSIGNED NOT NULL COMMENT 'User ID',
  `user_email` varchar(255) DEFAULT NULL COMMENT 'Email',
  `user_firstname` varchar(40) NOT NULL DEFAULT '' COMMENT 'First Name',
  `user_middlename` varchar(40) NOT NULL DEFAULT '' COMMENT 'Middle Name',
  `user_lastname` varchar(40) NOT NULL DEFAULT '' COMMENT 'Last Name',
  `user_enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'User Activated',
  `user_password` varchar(256) DEFAULT NULL COMMENT 'Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `group`
  ADD PRIMARY KEY (`group_id`);
ALTER TABLE `group` ADD FULLTEXT KEY `GROUP_NAME_INDEX` (`group_name`);

ALTER TABLE `membership`
  ADD PRIMARY KEY (`user_id`,`group_id`);

ALTER TABLE `parent`
  ADD PRIMARY KEY (`parent_user_id`,`child_user_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `USER_EMAIL_INDEX` (`user_email`);
ALTER TABLE `user` ADD FULLTEXT KEY `USER_NAME_INDEX` (`user_firstname`,`user_lastname`);


ALTER TABLE `group`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `user`
  MODIFY `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User ID';
