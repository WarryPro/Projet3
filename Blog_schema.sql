/*
Créér BDD pour le blog 
*/

--Sup. le tableau s'il existe
/*COMMENTER CETTE LIGNE S'IL Y A DES INFOS SUR LA BDD blog ou FAIRE UN BACKUP AVANT DE L'EXECUTER*/
DROP DATABASE IF EXISTS `blog`;

CREATE DATABASE IF NOT EXISTS `blog`;

USE `blog`;

/*
CREATION DES TABLEAUX 
*/

-- Tableau pour les billets 
DROP TABLE IF EXISTS `episodes`; 
CREATE TABLE `episodes`(
    `id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(20) NOT NULL,
    `content` TEXT NOT NULL,
    `created_date` DATETIME NOT NULL,
    `modif_date` DATETIME NOT NULL
);

-- Tableau pour les commentaires 
DROP TABLE IF EXISTS `comments`; 
CREATE TABLE `comments`(
    `id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user` VARCHAR(15) NOT NULL,
    `episode_id` INT(11) NOT NULL, 
    `comment` TEXT NOT NULL,
    `comment_date` DATETIME NOT NULL
);

--Tableau pour les utilisateurs 
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` INT(11) NOT NULL,
    `user` VARCHAR(15) NOT NULL, 
    `pass` char(32) NOT NULL, -- char(32) characters car on va crypter en MD5 
    `email` VARCHAR(80) UNIQUE NOT NULL,
    `user_role` ENUM('Admin', 'User') NOT NULL
);



