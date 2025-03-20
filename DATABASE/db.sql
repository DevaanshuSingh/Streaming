CREATE DATABASE stream_db;

use stream_db;


CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userRegSeriolNo` bigint(20) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `interests` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_picture` blob DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `myfeatures` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `featureName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `myfeatures` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `featureName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);


INSERT INTO user (id, user_pass, name) VALUES 
(NULL, 0, 'SBSR0'),
(NULL, 1, 'SBSR1'),
(NULL, 2, 'SBSR2');
