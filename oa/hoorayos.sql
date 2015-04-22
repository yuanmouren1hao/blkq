/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : hoorayos

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2012-09-04 11:03:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tb_app`
-- ----------------------------
DROP TABLE IF EXISTS `tb_app`;
CREATE TABLE `tb_app` (
  `tbid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图标名称',
  `icon` tinytext COLLATE utf8_unicode_ci COMMENT '图标图片',
  `url` tinytext COLLATE utf8_unicode_ci COMMENT '图标链接',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '应用类型，参数有：app，widget',
  `kindid` int(11) DEFAULT '0',
  `width` int(11) DEFAULT NULL COMMENT '窗口宽度',
  `height` int(11) DEFAULT NULL COMMENT '窗口高度',
  `isresize` tinyint(1) DEFAULT NULL COMMENT '是否能对窗口进行拉伸',
  `issetbar` tinyint(1) DEFAULT NULL COMMENT '窗口是否有评分和介绍按钮',
  `isflash` tinyint(1) DEFAULT NULL COMMENT '是否为flash应用',
  `remark` tinytext COLLATE utf8_unicode_ci,
  `usecount` bigint(20) DEFAULT '0' COMMENT '使用人数',
  `starnum` decimal(10,2) DEFAULT '0.00' COMMENT '评分',
  `dt` datetime DEFAULT NULL,
  `indexid` bigint(20) DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`tbid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_app
-- ----------------------------
INSERT INTO `tb_app` VALUES ('1', '应用管理', 'img/shortcut/default/应用管理.png', 'sysapp/appmanage/index.php', 'app', '1', '900', '550', '0', '0', '0', '对应用进行编辑管理', '5', '0.00', '2012-02-26 22:51:53', '1');
INSERT INTO `tb_app` VALUES ('2', '网站设置', 'img/ui/system-gear.png', 'sysapp/websitesetting/index.php', 'app', '1', '900', '550', '0', '0', '0', null, '3', '0.00', '2012-02-26 22:52:40', '1');
INSERT INTO `tb_app` VALUES ('3', '会员管理', 'img/ui/system-users.png', 'sysapp/member/index.php', 'app', '1', '900', '550', '0', '0', '0', null, '3', '0.00', '2012-07-19 10:57:28', '1');
INSERT INTO `tb_app` VALUES ('4', '权限管理', 'img/ui/system-puzzle.png', 'sysapp/permission/index.php', 'app', '1', '900', '550', '1', '1', '0', '', '2', '0.00', '2012-07-19 10:59:41', '1');
INSERT INTO `tb_app` VALUES ('5', '豆瓣FM', 'img/shortcut/default/豆瓣FM.png', 'http://douban.fm/partner/webqq?fromhoorayos', 'app', '3', '420', '240', '0', '1', '0', '豆瓣FM', '1', '3.00', '2012-02-26 22:52:03', '1');
INSERT INTO `tb_app` VALUES ('6', '三维地图', 'img/shortcut/default/三维地图.png', 'http://sz.chachaba.com/api20110914.html', 'app', '6', '1050', '550', '1', '1', '1', '三维地图', '0', '0.00', '2012-02-26 22:52:55', '1');
INSERT INTO `tb_app` VALUES ('7', '美图秀秀', 'img/shortcut/default/美图秀秀.png', 'http://xiuxiu.web.meitu.com/qq/web/', 'app', '6', '900', '620', '1', '1', '1', '美图秀秀', '2', '2.00', '2012-02-26 22:52:58', '1');
INSERT INTO `tb_app` VALUES ('8', '非诚勿扰', 'img/shortcut/default/非诚勿扰.png', 'http://v.56.com/API/app/baidu/tv/index.php?mid=6085&canvas_pos=search&custom=1&bd_user=553916098&bd_', 'app', '3', '800', '480', '0', '1', '1', '非诚勿扰', '0', '0.00', '2012-02-26 22:52:24', '1');
INSERT INTO `tb_app` VALUES ('9', '搜狐视频', 'img/shortcut/default/搜狐视频.png', 'http://tv.sohu.com/upload/sohuapp/index.html?api_key=9ca7e3cdef8af010b947f4934a427a2c', 'app', '3', '840', '730', '0', '1', '1', '搜狐视频', '0', '0.00', '2012-02-26 22:52:26', '1');
INSERT INTO `tb_app` VALUES ('10', '迅雷看看', 'img/shortcut/default/迅雷看看.gif', 'http://recommend.xunlei.com/channel_360_v2/index.html?from=webqq', 'app', '3', '960', '370', '0', '1', '1', '迅雷看看', '0', '0.00', '2012-02-26 22:52:29', '1');
INSERT INTO `tb_app` VALUES ('12', '时钟', 'img/ui/system-shapes.png', 'extapp/clock/index.php', 'widget', '6', '170', '180', '0', '1', '0', '时钟', '2', '0.00', '2012-08-05 23:01:51', '1');
INSERT INTO `tb_app` VALUES ('13', '天气预报', 'img/ui/system-shapes.png', 'extapp/weather/index.php', 'widget', '6', '200', '60', '0', '1', '0', '天气预报', '2', '0.00', '2012-08-05 23:02:28', '1');

-- ----------------------------
-- Table structure for `tb_app_star`
-- ----------------------------
DROP TABLE IF EXISTS `tb_app_star`;
CREATE TABLE `tb_app_star` (
  `tbid` bigint(20) NOT NULL AUTO_INCREMENT,
  `app_id` bigint(20) DEFAULT NULL,
  `member_id` bigint(20) DEFAULT NULL,
  `starnum` int(1) DEFAULT '0',
  `dt` datetime DEFAULT NULL,
  PRIMARY KEY (`tbid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_app_star
-- ----------------------------
INSERT INTO `tb_app_star` VALUES ('1', '7', '1', '2', '2012-07-27 22:10:02');
INSERT INTO `tb_app_star` VALUES ('2', '5', '1', '3', '2012-08-08 14:27:34');

-- ----------------------------
-- Table structure for `tb_file`
-- ----------------------------
DROP TABLE IF EXISTS `tb_file`;
CREATE TABLE `tb_file` (
  `tbid` bigint(20) NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图标地址',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '文件名',
  `ext` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '扩展名',
  `size` int(11) DEFAULT NULL COMMENT '文件大小',
  `url` text COLLATE utf8_unicode_ci COMMENT '文件存放地址',
  `member_id` bigint(20) DEFAULT NULL,
  `dt` datetime DEFAULT NULL,
  PRIMARY KEY (`tbid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_file
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_folder`
-- ----------------------------
DROP TABLE IF EXISTS `tb_folder`;
CREATE TABLE `tb_folder` (
  `tbid` bigint(20) NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'default',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` tinytext COLLATE utf8_unicode_ci,
  `member_id` bigint(20) DEFAULT NULL,
  `dt` datetime DEFAULT NULL,
  PRIMARY KEY (`tbid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_folder
-- ----------------------------
INSERT INTO `tb_folder` VALUES ('1', 'img/ui/folder_default.png', '新建文件夹', 'app_2,widget_12,widget_13,app_3,app_7', '1', '2012-08-20 21:54:07');

-- ----------------------------
-- Table structure for `tb_member`
-- ----------------------------
DROP TABLE IF EXISTS `tb_member`;
CREATE TABLE `tb_member` (
  `tbid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0' COMMENT '用户类型，0普通用户，1管理员',
  `permission_id` bigint(20) DEFAULT NULL,
  `dock` longtext COLLATE utf8_unicode_ci COMMENT '[应用码头]应用id，用","相连',
  `desk1` longtext COLLATE utf8_unicode_ci COMMENT '[桌面1]应用id，用","相连',
  `desk2` longtext COLLATE utf8_unicode_ci COMMENT '[桌面2]应用id，用","相连',
  `desk3` longtext COLLATE utf8_unicode_ci COMMENT '[桌面3]应用id，用","相连',
  `desk4` longtext COLLATE utf8_unicode_ci COMMENT '[桌面4]应用id，用","相连',
  `desk5` longtext COLLATE utf8_unicode_ci COMMENT '[桌面5]应用id，用","相连',
  `appxy` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'x' COMMENT '图标排列方式',
  `dockpos` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'top' COMMENT '应用码头位置，参数：top,left,right',
  `wallpaper_id` int(11) DEFAULT '1',
  `wallpaperwebsite` text COLLATE utf8_unicode_ci,
  `wallpaperstate` tinyint(4) DEFAULT '1' COMMENT '1系统壁纸、2自定义壁纸、3网络地址',
  `wallpapertype` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'juzhong' COMMENT '壁纸显示方式：tianchong,shiying,pingpu,lashen,juzhong',
  `skin` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'default' COMMENT '窗口皮肤',
  `regdt` datetime DEFAULT NULL COMMENT '注册时间',
  `lastlogindt` datetime DEFAULT NULL COMMENT '最后登入时间',
  `lastloginip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '最后登入IP',
  PRIMARY KEY (`tbid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_member
-- ----------------------------
INSERT INTO `tb_member` VALUES ('1', 'hoorayos', 'c5e9fe42f061fa6102857db920734c33ec7b0816', '1', '1', '', 'app_5,app_1,folder_1,papp_1', 'app_4,papp_3', '', '', '', 'y', 'left', '5', 'http://localhost/_hoorayos_dev/sysapp/wallpaper/custom.php', '1', 'lashen', 'mac', '2012-02-29 00:00:00', '2012-09-04 10:58:06', '127.0.0.1');
INSERT INTO `tb_member` VALUES ('2', 'hurui', 'e32a03f385e31c98bd405012f8ad81c015360855', '0', null, 'papp_2', 'widget_13', 'app_7', 'widget_12', '', '', 'x', 'right', '1', null, '1', 'juzhong', 'default', '2012-08-24 00:17:09', '2012-08-24 00:17:12', '127.0.0.1');

-- ----------------------------
-- Table structure for `tb_papp`
-- ----------------------------
DROP TABLE IF EXISTS `tb_papp`;
CREATE TABLE `tb_papp` (
  `tbid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图标名称',
  `icon` tinytext COLLATE utf8_unicode_ci COMMENT '图标图片',
  `url` tinytext COLLATE utf8_unicode_ci COMMENT '图标链接',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '应用类型，参数有：app，widget',
  `width` int(11) DEFAULT NULL COMMENT '窗口宽度',
  `height` int(11) DEFAULT NULL COMMENT '窗口高度',
  `isresize` tinyint(1) DEFAULT NULL COMMENT '是否能对窗口进行拉伸',
  `dt` datetime DEFAULT NULL,
  `indexid` bigint(20) DEFAULT '1' COMMENT '排序',
  `member_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`tbid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_papp
-- ----------------------------
INSERT INTO `tb_papp` VALUES ('1', '自定义应用', 'img/ui/papp.png', 'http://www.baidu.com', 'papp', '600', '400', '1', '2012-08-21 09:52:02', '1', '1');
INSERT INTO `tb_papp` VALUES ('2', 'baidu', 'img/ui/papp.png', 'http://www.baidu.com', 'papp', '600', '400', '1', '2012-08-24 00:17:52', '1', '2');
INSERT INTO `tb_papp` VALUES ('3', '1111', 'img/ui/papp.png', '1211', 'papp', '600', '400', '1', '2012-08-31 11:44:46', '1', '1');

-- ----------------------------
-- Table structure for `tb_permission`
-- ----------------------------
DROP TABLE IF EXISTS `tb_permission`;
CREATE TABLE `tb_permission` (
  `tbid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apps_id` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`tbid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_permission
-- ----------------------------
INSERT INTO `tb_permission` VALUES ('1', '会员管理员', '1,2,3,4');
INSERT INTO `tb_permission` VALUES ('2', '应用管理员', '1');

-- ----------------------------
-- Table structure for `tb_pwallpaper`
-- ----------------------------
DROP TABLE IF EXISTS `tb_pwallpaper`;
CREATE TABLE `tb_pwallpaper` (
  `tbid` bigint(20) NOT NULL AUTO_INCREMENT,
  `url` tinytext COLLATE utf8_unicode_ci,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `member_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`tbid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_pwallpaper
-- ----------------------------
INSERT INTO `tb_pwallpaper` VALUES ('10', 'dofiles/member/1/wallpaper/7_06fe836c3a7f80d9b87dcb025701caecec24a5e6.png', '1920', '1080', '1');
INSERT INTO `tb_pwallpaper` VALUES ('11', 'dofiles/member/1/wallpaper/10_3fa8e2c4e66150d49acae81588983308a6544c6f.jpg', '1680', '1050', '1');
INSERT INTO `tb_pwallpaper` VALUES ('13', 'dofiles/member/1/wallpaper/123_b0411a06e594b6c290d71cfb371d2ff2cfed22f2.jpg', '588', '36', '1');

-- ----------------------------
-- Table structure for `tb_setting`
-- ----------------------------
DROP TABLE IF EXISTS `tb_setting`;
CREATE TABLE `tb_setting` (
  `tbid` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text COMMENT '网站标题',
  `description` text COMMENT '网站描述',
  `keywords` text COMMENT '网站关键字',
  PRIMARY KEY (`tbid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_setting
-- ----------------------------
INSERT INTO `tb_setting` VALUES ('1', 'HoorayOS - 作者：胡尐睿丶 - 联系方式：304327508（QQ）hooray0905[at]foxmail.com（email）', 'HoorayOS是一套web桌面应用框架，你可以用它开发出类似于Q+web这类的桌面应用网站，也可以在它的基础上二次开发出适合项目的桌面式管理系统。', 'HoorayOS,web桌面,免费开源,桌面管理系统');

-- ----------------------------
-- Table structure for `tb_wallpaper`
-- ----------------------------
DROP TABLE IF EXISTS `tb_wallpaper`;
CREATE TABLE `tb_wallpaper` (
  `tbid` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` tinytext COLLATE utf8_unicode_ci,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  PRIMARY KEY (`tbid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_wallpaper
-- ----------------------------
INSERT INTO `tb_wallpaper` VALUES ('1', '壁纸1', 'img/wallpaper/wallpaper1.jpg', '1920', '1080');
INSERT INTO `tb_wallpaper` VALUES ('2', '壁纸2', 'img/wallpaper/wallpaper2.jpg', '1920', '1080');
INSERT INTO `tb_wallpaper` VALUES ('3', '壁纸3', 'img/wallpaper/wallpaper3.jpg', '1920', '1080');
INSERT INTO `tb_wallpaper` VALUES ('4', '壁纸4', 'img/wallpaper/wallpaper4.jpg', '1920', '1080');
INSERT INTO `tb_wallpaper` VALUES ('5', '壁纸5', 'img/wallpaper/wallpaper5.jpg', '1920', '1080');
INSERT INTO `tb_wallpaper` VALUES ('6', '壁纸6', 'img/wallpaper/wallpaper6.jpg', '1920', '1080');
INSERT INTO `tb_wallpaper` VALUES ('7', '壁纸7', 'img/wallpaper/wallpaper7.jpg', '1920', '1080');
INSERT INTO `tb_wallpaper` VALUES ('8', '壁纸8', 'img/wallpaper/wallpaper8.jpg', '1920', '1080');
INSERT INTO `tb_wallpaper` VALUES ('9', '壁纸9', 'img/wallpaper/wallpaper9.jpg', '1920', '1080');
