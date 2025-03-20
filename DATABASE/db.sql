CREATE DATABASE stream_db;

use stream_db;

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_pass` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `data` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fromUserId` bigint(20) NOT NULL,
  `data` blob DEFAULT NULL,
  `toUserId` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




INSERT INTO user (id, user_pass, name) VALUES 
(NULL, 0, 'SBSR0'),
(NULL, 1, 'SBSR1'),
(NULL, 2, 'SBSR2');
