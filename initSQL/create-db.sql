-- Adminer 4.7.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';

USE m152;

DROP TABLE IF EXISTS media;
CREATE TABLE media (
  idmedia int(11) NOT NULL AUTO_INCREMENT,
  nomMedia varchar(255) DEFAULT NULL,
  typeMedia varchar(255) DEFAULT NULL,
  posts_IDPosts int(11) NOT NULL,
  PRIMARY KEY (idmedia)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
  IDPosts int(11) NOT NULL AUTO_INCREMENT,
  commentaire text,
  datePost date DEFAULT NULL,
  postType text,
  PRIMARY KEY (IDPosts)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- 2020-01-09 17:07:22
