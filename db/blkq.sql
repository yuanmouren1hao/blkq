/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : blkq

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2014-11-19 18:15:49
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `blkq_articles`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_articles`;
CREATE TABLE `blkq_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catelog_id` int(10) DEFAULT NULL,
  `author` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `read_num` varchar(45) DEFAULT NULL,
  `content` text,
  `createtime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `is_delt` int(3) DEFAULT '0' COMMENT '是否标记删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2900000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_articles
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_catelog`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_catelog`;
CREATE TABLE `blkq_catelog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `father` varchar(45) DEFAULT NULL,
  `child` varchar(45) DEFAULT NULL,
  `catelog_desc` varchar(1024) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `father_UNIQUE` (`father`,`child`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3100000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_catelog
-- ----------------------------
INSERT INTO `blkq_catelog` VALUES ('3100000001', '种植牙', '种植流程', '种植流程', '2014-11-19 20:49:05', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000002', '种植牙', '种植优势', '种植优势', '2014-11-19 20:51:00', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000003', '种植牙', '种植视频', '种植视频', '2014-11-19 20:51:21', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000004', '种植牙', '种植专家', '种植专家', '2014-11-19 20:53:06', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000005', '种植牙', '种植种类', '种植种类', '2014-11-19 20:53:27', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000006', '种植牙', '种植病例', '种植病例', '2014-11-19 20:53:44', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000007', '牙齿矫正', '隐形矫正', '隐形矫正', '2014-11-19 20:54:21', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000008', '牙齿矫正', '直弓丝牙齿矫正', '直弓丝牙齿矫正', '2014-11-19 20:58:55', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000009', '牙齿矫正', '舌侧隐形矫正', '舌侧隐形矫正', '2014-11-19 20:58:59', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000010', '牙齿矫正', '自锁托撸矫正', '自锁托撸矫正', '2014-11-19 20:59:02', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000011', '牙齿矫正', '矫正常识', '矫正常识', '2014-11-19 20:59:04', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000012', '牙齿矫正', '矫正病例', '矫正病例', '2014-11-19 20:59:07', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000013', '牙齿修复', '全瓷牙', '全瓷牙', '2014-11-19 20:59:09', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000014', '牙齿修复', '烤瓷牙', '烤瓷牙', '2014-11-19 20:59:12', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000015', '牙齿修复', '瓷贴面', '瓷贴面', '2014-11-19 20:59:14', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000016', '牙齿修复', '活动义齿', '活动义齿', '2014-11-19 20:59:18', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000017', '牙齿修复', '修复病例', '修复病例', '2014-11-19 20:59:23', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000018', '牙齿美白', '冷光美白', '冷光美白', '2014-11-19 20:59:26', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000019', '牙齿美白', '瓷贴面', '瓷贴面', '2014-11-19 20:59:29', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000020', '牙齿美白', '美白病例', '美白病例', '2014-11-19 20:59:32', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000021', '牙周专科', '牙周炎危害', '牙周炎危害', '2014-11-19 20:59:35', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000022', '牙周专科', '牙龈出血', '牙龈出血', '2014-11-19 20:59:37', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000023', '牙周专科', '牙周刮治', '牙周刮治', '2014-11-19 20:59:40', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000024', '牙周专科', '洗牙常识', '洗牙常识', '2014-11-19 20:59:42', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000025', '常规治疗', '微创拔牙', '微创拔牙', '2014-11-19 20:59:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000026', '常规治疗', '微创补牙', '微创补牙', '2014-11-19 20:59:47', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000027', '常规治疗', '根管治疗', '根管治疗', '2014-11-19 20:59:50', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000028', '儿童专题', '窝沟封闭', '窝沟封闭', '2014-11-19 20:59:52', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000029', '儿童专题', '家长须知（乳牙常识）', '家长须知（乳牙常识）', '2014-11-19 20:59:54', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000030', '儿童专题', '儿童蛀牙', '儿童蛀牙', '2014-11-19 20:59:56', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000031', '儿童专题', '常见问题', '常见问题', '2014-11-19 21:00:00', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000032', '症状自查', '牙齿不齐', '牙齿不齐', '2014-11-19 21:02:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000033', '症状自查', '牙龈出血', '牙龈出血', '2014-11-19 21:02:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000034', '症状自查', '牙齿缺失', '牙齿缺失', '2014-11-19 21:02:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000035', '症状自查', '牙齿变色', '牙齿变色', '2014-11-19 21:02:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000036', '症状自查', '口腔异常', '口腔异常', '2014-11-19 21:02:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000037', '症状自查', '牙齿酸痛', '牙齿酸痛', '2014-11-19 21:02:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000038', '经典病例', '口腔正畸', '口腔正畸', '2014-11-19 21:02:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000039', '经典病例', '美容美白', '美容美白', '2014-11-19 21:02:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000040', '经典病例', '口腔种植', '口腔种植', '2014-11-19 21:02:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000041', '经典病例', '口腔修复', '口腔修复', '2014-11-19 21:02:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000042', '经典病例', '常规治疗', '常规治疗', '2014-11-19 21:02:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000043', '经典病例', '儿童口腔', '儿童口腔', '2014-11-19 21:02:45', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000044', '口腔视频', '口腔视频', '口腔视频', '2014-11-19 21:03:40', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000045', '优雅环境', 'VIP专区', 'VIP专区', '2014-11-19 22:12:15', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000046', '优雅环境', '儿童专区', '儿童专区', '2014-11-19 22:12:15', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000047', '优雅环境', '独立诊室', '独立诊室', '2014-11-19 22:12:15', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000048', '领先设备', 'BEYOND冷光美白', 'BEYOND冷光美白', '2014-11-19 22:12:15', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000049', '领先设备', '激光治疗仪', '激光治疗仪', '2014-11-19 22:12:15', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000050', '领先设备', '笑气', '笑气', '2014-11-19 22:12:15', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000051', '医师团队', '正畸专家', '正畸专家', '2014-11-19 22:12:15', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000052', '医师团队', '种植医师', '种植医师', '2014-11-19 22:12:15', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000053', '医师团队', '修复医师', '修复医师', '2014-11-19 22:12:15', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000054', '医师团队', '牙周医师', '牙周医师', '2014-11-19 22:12:15', 'admin');
INSERT INTO `blkq_catelog` VALUES ('3100000055', '医师团队', '综合团队', '综合团队', '2014-11-19 22:12:15', 'admin');

-- ----------------------------
-- Table structure for `blkq_contact`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_contact`;
CREATE TABLE `blkq_contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weixin` varchar(45) DEFAULT NULL,
  `qq` varchar(45) DEFAULT NULL,
  `weibo` varchar(45) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `mobel_tel` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2600000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_contact
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_doctor`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_doctor`;
CREATE TABLE `blkq_doctor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `sex` int(3) DEFAULT NULL,
  `age` int(10) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `desc` varchar(1024) DEFAULT NULL,
  `createtime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2200000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_doctor
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_environment`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_environment`;
CREATE TABLE `blkq_environment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `desc` varchar(1024) DEFAULT NULL,
  `createtime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2300000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_environment
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_equipment`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_equipment`;
CREATE TABLE `blkq_equipment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `desc` varchar(1024) DEFAULT NULL,
  `createtime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2400000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_equipment
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_hospital`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_hospital`;
CREATE TABLE `blkq_hospital` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `desc` text,
  `address` varchar(255) DEFAULT NULL,
  `headpeople` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2100000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_hospital
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_indexpage`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_indexpage`;
CREATE TABLE `blkq_indexpage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `orderby` int(10) DEFAULT NULL,
  `is_show` int(3) DEFAULT NULL,
  `createtime` datetime DEFAULT NULL,
  `desc` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2800000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_indexpage
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_log`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_log`;
CREATE TABLE `blkq_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(45) DEFAULT NULL,
  `msg` varchar(1024) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1400000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_log
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_map`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_map`;
CREATE TABLE `blkq_map` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(45) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2700000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_map
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_message`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_message`;
CREATE TABLE `blkq_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ask_message` text,
  `ask_ip` varchar(45) DEFAULT NULL,
  `ask_time` datetime DEFAULT NULL,
  `ask_user` varchar(45) DEFAULT NULL,
  `reply_message` text,
  `reply_ip` varchar(45) DEFAULT NULL,
  `reply_time` datetime DEFAULT NULL,
  `reply_user` varchar(45) DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3300000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_message
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_news`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_news`;
CREATE TABLE `blkq_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `author` varchar(45) DEFAULT NULL,
  `read_num` int(10) DEFAULT NULL,
  `content` text,
  `createtime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2500000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_news
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_tables`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_tables`;
CREATE TABLE `blkq_tables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_id` int(10) DEFAULT NULL,
  `table_tag` enum('system','app') DEFAULT 'app',
  `table_name_chn` varchar(45) DEFAULT NULL,
  `table_name_eng` varchar(45) DEFAULT NULL,
  `table_desc` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1100000017 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_tables
-- ----------------------------
INSERT INTO `blkq_tables` VALUES ('1100000001', '11', 'system', '元表信息表', 'tables', '存储系统表的信息');
INSERT INTO `blkq_tables` VALUES ('1100000002', '12', 'system', '系统信息表', 'websites', '系统信息表');
INSERT INTO `blkq_tables` VALUES ('1100000003', '21', 'app', '医院信息表', 'hospital', '医院信息表');
INSERT INTO `blkq_tables` VALUES ('1100000004', '22', 'app', '医生信息表', 'dortor', '医生信息表');
INSERT INTO `blkq_tables` VALUES ('1100000005', '23', 'app', '医院环境表', 'environment', '医院环境表');
INSERT INTO `blkq_tables` VALUES ('1100000006', '24', 'app', '设备信息表', 'equipment', '设备信息表');
INSERT INTO `blkq_tables` VALUES ('1100000007', '25', 'app', '医院动态表', 'news', '新闻表');
INSERT INTO `blkq_tables` VALUES ('1100000008', '26', 'app', '联系方式表', 'contact', '联系方式表');
INSERT INTO `blkq_tables` VALUES ('1100000009', '27', 'app', '地图信息表', 'map', '地图信息表');
INSERT INTO `blkq_tables` VALUES ('1100000010', '28', 'app', '首页配置表', 'indexpage', '首页配置表');
INSERT INTO `blkq_tables` VALUES ('1100000011', '29', 'app', '文章信息表', 'articles', '文章信息表');
INSERT INTO `blkq_tables` VALUES ('1100000012', '31', 'app', '文章分类表', 'catelog', '文章分类表');
INSERT INTO `blkq_tables` VALUES ('1100000013', '32', 'app', '用户信息表', 'user', '用户信息表');
INSERT INTO `blkq_tables` VALUES ('1100000014', '33', 'app', '留言信息表', 'message', '留言信息表');
INSERT INTO `blkq_tables` VALUES ('1100000015', '13', 'system', '访问信息表', 'visit', '访问信息表');
INSERT INTO `blkq_tables` VALUES ('1100000016', '14', 'system', '日志信息表', 'log', '日志信息表');

-- ----------------------------
-- Table structure for `blkq_user`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_user`;
CREATE TABLE `blkq_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `last_login_ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3200000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_user
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_visit`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_visit`;
CREATE TABLE `blkq_visit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_url` varchar(255) DEFAULT NULL,
  `to_url` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `session_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1300000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_visit
-- ----------------------------

-- ----------------------------
-- Table structure for `blkq_website`
-- ----------------------------
DROP TABLE IF EXISTS `blkq_website`;
CREATE TABLE `blkq_website` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `last_update_time` datetime DEFAULT NULL,
  `copyright` varchar(45) DEFAULT NULL,
  `coop` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `visit_num` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1200000001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blkq_website
-- ----------------------------

-- ----------------------------
-- View structure for `blkq_view_articles`
-- ----------------------------
DROP VIEW IF EXISTS `blkq_view_articles`;
CREATE VIEW `blkq_view_articles` AS select `a`.`id` AS `id`,`a`.`catelog_id` AS `catelog_id`,`a`.`author` AS `author`,`a`.`title` AS `title`,`a`.`read_num` AS `read_num`,`a`.`content` AS `content`,`a`.`createtime` AS `createtime`,`a`.`updatetime` AS `updatetime`,`c`.`father` AS `father`,`c`.`child` AS `child`,`c`.`catelog_desc` AS `catelog_desc`,`c`.`create_time` AS `create_time`,`c`.`create_user` AS `create_user` from (`blkq_articles` `a` left join `blkq_catelog` `c` on((`a`.`catelog_id` = `c`.`id`)));
