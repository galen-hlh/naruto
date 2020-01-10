/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 5.7.28 : Database - naruto
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`naruto` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `naruto`;

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` bigint(20) unsigned NOT NULL COMMENT '全局唯一ID',
  `article_name` varchar(105) NOT NULL DEFAULT '' COMMENT '文章名称',
  `description` varchar(500) NOT NULL DEFAULT '' COMMENT '文章描述',
  `content` text NOT NULL COMMENT '文章内容',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '发布者ID',
  `is_top` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `updated_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `created_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `is_del` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL COMMENT '全局唯一ID',
  `account` varchar(50) NOT NULL DEFAULT '' COMMENT '账号',
  `account_type` tinyint(5) unsigned NOT NULL DEFAULT '0' COMMENT '账号类型 1超级管理员 2其他',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `phone` varchar(25) NOT NULL DEFAULT '' COMMENT '手机号',
  `is_del` int(50) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除 0未删除 1删除',
  `created_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
