DROP DATABASE `CompanyAdVisor`;
CREATE DATABASE `CompanyAdVisor`;
USE `CompanyAdVisor`;

CREATE TABLE `roles` (
 `name` VARCHAR(255) PRIMARY KEY NOT NULL,
 `description` VARCHAR(255) NOT NULL
);

CREATE TABLE `users`(
  `id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `surname` VARCHAR(255) NOT NULL,
  `username` VARCHAR(255) UNIQUE NOT NULL,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(255) NOT NULL DEFAULT 'User',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`role`) REFERENCES `roles`(`name`) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE `permissions` (
  `name` VARCHAR(255) NOT NULL PRIMARY KEY,
  `description` VARCHAR(255) DEFAULT NULL
);

CREATE TABLE `permission_role` (
  `permission` VARCHAR(255) NOT NULL,
  `role` VARCHAR(255) NOT NULL,
  CONSTRAINT pk_permission_role PRIMARY KEY (permission, role),
  FOREIGN KEY (`role`) REFERENCES `roles` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`permission`) REFERENCES `permissions` (`name`)
 );

CREATE TABLE `company` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `category` VARCHAR(255) DEFAULT NULL,
  `description` VARCHAR(255) DEFAULT NULL,
  `region` VARCHAR(255) NOT NULL,
  `city` VARCHAR(255) NOT NULL,
  `street` VARCHAR(255) DEFAULT NULL,
  `street number` VARCHAR(255) DEFAULT NULL,
  `phone` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(255) DEFAULT NULL
); 

CREATE TABLE `posts` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `company_id` INT(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `anonymous` TINYINT(1) NOT NULL DEFAULT 1,
  `rating` TINYINT(1) NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE, 
  FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO `roles`(`name`, `description`) VALUES ('User', 'Default user account');
INSERT INTO `roles`(`name`, `description`) VALUES ('SuperAdmin', 'Account that can manage the entire webapp');
INSERT INTO `permissions`(`name`, `description`) VALUES ('delete_users', 'Give the ability to delete other users\' account');
