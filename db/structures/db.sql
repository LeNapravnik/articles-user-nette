CREATE DATABASE IF NOT EXISTS articles_db;
USE articles_db;

CREATE TABLE IF NOT EXISTS `article` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , 
    `link` VARCHAR(255) NULL DEFAULT NULL , 
    `title` VARCHAR(255) NULL DEFAULT NULL , 
    `description` VARCHAR(255) NULL DEFAULT NULL , 
    `content` TEXT NOT NULL , 
    `insertion_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `rating` INT NULL DEFAULT '0', 
    `visibility` ENUM('all_users','logged_users') NOT NULL DEFAULT 'all_users' , 
    PRIMARY KEY (`id`) ,
    UNIQUE `link` (`link`) USING BTREE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    
CREATE TABLE IF NOT EXISTS `user` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT , 
    `username` VARCHAR(255) NOT NULL , 
    `mail` VARCHAR(100) NOT NULL ,
    `passwd` VARCHAR(60) NOT NULL , 
    `role` ENUM('admin','member') NOT NULL DEFAULT 'member', 
    `registration_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `active` BOOLEAN NOT NULL DEFAULT TRUE , 
    PRIMARY KEY (`id`) , 
    UNIQUE `username` (`username`) USING BTREE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    
CREATE TABLE IF NOT EXISTS `rating` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, 
    `article_id` INT(11) UNSIGNED NOT NULL , 
    `user_id` INT(11) UNSIGNED NOT NULL , 
    `value` INT NOT NULL , 
    `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`) ,
    KEY `article_id` (`article_id`),
    CONSTRAINT `article_id` 
        FOREIGN KEY (`article_id`) 
        REFERENCES `article` (`id`) 
        ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY `article_user` (`article_id`,`user_id`) USING BTREE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
