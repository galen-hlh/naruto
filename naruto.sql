/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50728
 Source Host           : 127.0.0.1:3306
 Source Schema         : naruto

 Target Server Type    : MySQL
 Target Server Version : 50728
 File Encoding         : 65001

 Date: 02/02/2020 21:29:39
*/

CREATE DATABASE /*!32312 IF NOT EXISTS*/`naruto` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `naruto`;

-- ----------------------------
-- Table structure for administrator
-- ----------------------------
DROP TABLE IF EXISTS `administrator`;
CREATE TABLE `administrator` (
  `id` bigint(20) unsigned NOT NULL COMMENT '全局唯一ID',
  `image_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '相册id',
  `account` varchar(50) NOT NULL DEFAULT '' COMMENT '账号',
  `account_type` tinyint(5) unsigned NOT NULL DEFAULT '0' COMMENT '账号类型 1超级管理员 2其他',
  `password` char(64) NOT NULL DEFAULT '' COMMENT '密码',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `phone` varchar(25) NOT NULL DEFAULT '' COMMENT '手机号',
  `is_del` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除 0未删除 1删除',
  `created_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` bigint(20) unsigned NOT NULL COMMENT '全局唯一ID',
  `article_title` varchar(65) NOT NULL DEFAULT '' COMMENT '文章标题',
  `article_description` varchar(500) NOT NULL DEFAULT '' COMMENT '文章描述',
  `article_content` text NOT NULL COMMENT '文章类容',
  `image_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '文章图像',
  `administrator_id` bigint(20) unsigned NOT NULL COMMENT '管理员ID',
  `like_num` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数量',
  `view_new` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '浏览数量',
  `words_num` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文章字数',
  `reply_num` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '留言数量',
  `article_status` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '文章状态 1发布 2关闭',
  `created_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_del` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章表';

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` bigint(20) unsigned NOT NULL COMMENT '全局唯一ID',
  `image_url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片路径',
  `cover_type` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '图片类型 1普通图片 2封面 3LOGO图片 4头像；5人脸',
  `created_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_del` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='图像表';

SET FOREIGN_KEY_CHECKS = 1;
