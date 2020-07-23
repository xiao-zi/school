/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80018
 Source Host           : 127.0.0.1:3306
 Source Schema         : weixuexiao

 Target Server Type    : MySQL
 Target Server Version : 80018
 File Encoding         : 65001

 Date: 14/04/2020 14:02:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ims_account
-- ----------------------------
DROP TABLE IF EXISTS `ims_account`;
CREATE TABLE `ims_account` (
  `acid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `hash` varchar(8) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `isconnect` tinyint(4) NOT NULL,
  `isdeleted` tinyint(3) unsigned NOT NULL,
  `endtime` int(10) unsigned NOT NULL,
  `send_account_expire_status` tinyint(1) NOT NULL,
  `send_api_expire_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`acid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_account
-- ----------------------------
BEGIN;
INSERT INTO `ims_account` VALUES (1, 1, 'uRr8qvQV', 1, 0, 0, 0, 0, 0);
COMMIT;

-- ----------------------------
-- Table structure for ims_account_aliapp
-- ----------------------------
DROP TABLE IF EXISTS `ims_account_aliapp`;
CREATE TABLE `ims_account_aliapp` (
  `acid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `level` tinyint(4) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `key` varchar(16) NOT NULL,
  PRIMARY KEY (`acid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_account_baiduapp
-- ----------------------------
DROP TABLE IF EXISTS `ims_account_baiduapp`;
CREATE TABLE `ims_account_baiduapp` (
  `acid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `appid` varchar(32) NOT NULL,
  `key` varchar(32) NOT NULL,
  `secret` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`acid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_account_phoneapp
-- ----------------------------
DROP TABLE IF EXISTS `ims_account_phoneapp`;
CREATE TABLE `ims_account_phoneapp` (
  `acid` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`acid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_account_toutiaoapp
-- ----------------------------
DROP TABLE IF EXISTS `ims_account_toutiaoapp`;
CREATE TABLE `ims_account_toutiaoapp` (
  `acid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `appid` varchar(32) NOT NULL,
  `key` varchar(32) NOT NULL,
  `secret` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`acid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_account_webapp
-- ----------------------------
DROP TABLE IF EXISTS `ims_account_webapp`;
CREATE TABLE `ims_account_webapp` (
  `acid` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT '',
  PRIMARY KEY (`acid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_account_wechats
-- ----------------------------
DROP TABLE IF EXISTS `ims_account_wechats`;
CREATE TABLE `ims_account_wechats` (
  `acid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `token` varchar(32) NOT NULL,
  `encodingaeskey` varchar(255) NOT NULL,
  `level` tinyint(4) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `account` varchar(30) NOT NULL,
  `original` varchar(50) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `country` varchar(10) NOT NULL,
  `province` varchar(3) NOT NULL,
  `city` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  `key` varchar(50) NOT NULL,
  `secret` varchar(50) NOT NULL,
  `styleid` int(10) unsigned NOT NULL,
  `subscribeurl` varchar(120) NOT NULL,
  `auth_refresh_token` varchar(255) NOT NULL,
  PRIMARY KEY (`acid`),
  KEY `idx_key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_account_wechats
-- ----------------------------
BEGIN;
INSERT INTO `ims_account_wechats` VALUES (1, 1, 'omJNpZEhZeHj1ZxFECKkP48B5VFbk1HP', '', 1, '飞鹰', '', '', '', '', '', '', '', '', 0, '', '', 1, '', '');
COMMIT;

-- ----------------------------
-- Table structure for ims_account_wxapp
-- ----------------------------
DROP TABLE IF EXISTS `ims_account_wxapp`;
CREATE TABLE `ims_account_wxapp` (
  `acid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `token` varchar(32) NOT NULL,
  `encodingaeskey` varchar(43) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `account` varchar(30) NOT NULL,
  `original` varchar(50) NOT NULL,
  `key` varchar(50) NOT NULL,
  `secret` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `appdomain` varchar(255) NOT NULL,
  `auth_refresh_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`acid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_account_xzapp
-- ----------------------------
DROP TABLE IF EXISTS `ims_account_xzapp`;
CREATE TABLE `ims_account_xzapp` (
  `acid` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `original` varchar(50) NOT NULL,
  `lastupdate` int(10) NOT NULL,
  `styleid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `token` varchar(32) NOT NULL,
  `encodingaeskey` varchar(255) NOT NULL,
  `xzapp_id` varchar(30) NOT NULL,
  `level` tinyint(4) unsigned NOT NULL,
  `key` varchar(80) NOT NULL,
  `secret` varchar(80) NOT NULL,
  PRIMARY KEY (`acid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_activity_clerk_menu
-- ----------------------------
DROP TABLE IF EXISTS `ims_activity_clerk_menu`;
CREATE TABLE `ims_activity_clerk_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `displayorder` int(4) NOT NULL,
  `pid` int(6) NOT NULL,
  `group_name` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `permission` varchar(50) NOT NULL,
  `system` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_activity_clerks
-- ----------------------------
DROP TABLE IF EXISTS `ims_activity_clerks`;
CREATE TABLE `ims_activity_clerks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `storeid` int(10) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `password` (`password`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_activity_coupon_allocation
-- ----------------------------
DROP TABLE IF EXISTS `ims_activity_coupon_allocation`;
CREATE TABLE `ims_activity_coupon_allocation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `couponid` int(10) unsigned NOT NULL,
  `groupid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`couponid`,`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_activity_coupon_modules
-- ----------------------------
DROP TABLE IF EXISTS `ims_activity_coupon_modules`;
CREATE TABLE `ims_activity_coupon_modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `couponid` int(10) unsigned NOT NULL,
  `module` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `couponid` (`couponid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_activity_exchange
-- ----------------------------
DROP TABLE IF EXISTS `ims_activity_exchange`;
CREATE TABLE `ims_activity_exchange` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `thumb` varchar(500) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `extra` varchar(3000) NOT NULL,
  `credit` int(10) unsigned NOT NULL,
  `credittype` varchar(10) NOT NULL,
  `pretotal` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `total` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `starttime` int(10) unsigned NOT NULL,
  `endtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `extra` (`extra`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_activity_exchange_trades
-- ----------------------------
DROP TABLE IF EXISTS `ims_activity_exchange_trades`;
CREATE TABLE `ims_activity_exchange_trades` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `exid` int(10) unsigned NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`tid`),
  KEY `uniacid` (`uniacid`,`uid`,`exid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_activity_exchange_trades_shipping
-- ----------------------------
DROP TABLE IF EXISTS `ims_activity_exchange_trades_shipping`;
CREATE TABLE `ims_activity_exchange_trades_shipping` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `exid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `province` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(6) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`tid`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_activity_modules
-- ----------------------------
DROP TABLE IF EXISTS `ims_activity_modules`;
CREATE TABLE `ims_activity_modules` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `exid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `available` int(10) unsigned NOT NULL,
  PRIMARY KEY (`mid`),
  KEY `uniacid` (`uniacid`),
  KEY `module` (`module`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_activity_modules_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_activity_modules_record`;
CREATE TABLE `ims_activity_modules_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL,
  `num` tinyint(3) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mid` (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_activity_stores
-- ----------------------------
DROP TABLE IF EXISTS `ims_activity_stores`;
CREATE TABLE `ims_activity_stores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `business_name` varchar(50) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `category` varchar(255) NOT NULL,
  `province` varchar(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `district` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `longitude` varchar(15) NOT NULL,
  `latitude` varchar(15) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `photo_list` varchar(10000) NOT NULL,
  `avg_price` int(10) unsigned NOT NULL,
  `recommend` varchar(255) NOT NULL,
  `special` varchar(255) NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `open_time` varchar(50) NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `source` tinyint(3) unsigned NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `location_id` (`location_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_article_category
-- ----------------------------
DROP TABLE IF EXISTS `ims_article_category`;
CREATE TABLE `ims_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_article_comment
-- ----------------------------
DROP TABLE IF EXISTS `ims_article_comment`;
CREATE TABLE `ims_article_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(10) unsigned NOT NULL,
  `parentid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `content` varchar(500) DEFAULT NULL,
  `is_like` tinyint(1) NOT NULL,
  `is_reply` tinyint(1) NOT NULL,
  `like_num` int(10) unsigned NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `articleid` (`articleid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_article_news
-- ----------------------------
DROP TABLE IF EXISTS `ims_article_news`;
CREATE TABLE `ims_article_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `is_display` tinyint(3) unsigned NOT NULL,
  `is_show_home` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `click` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `cateid` (`cateid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_article_notice
-- ----------------------------
DROP TABLE IF EXISTS `ims_article_notice`;
CREATE TABLE `ims_article_notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `is_display` tinyint(3) unsigned NOT NULL,
  `is_show_home` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `click` int(10) unsigned NOT NULL,
  `style` varchar(200) NOT NULL,
  `group` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `cateid` (`cateid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_article_unread_notice
-- ----------------------------
DROP TABLE IF EXISTS `ims_article_unread_notice`;
CREATE TABLE `ims_article_unread_notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notice_id` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `is_new` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `notice_id` (`notice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_attachment_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_attachment_group`;
CREATE TABLE `ims_attachment_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_basic_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_basic_reply`;
CREATE TABLE `ims_basic_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `content` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_business
-- ----------------------------
DROP TABLE IF EXISTS `ims_business`;
CREATE TABLE `ims_business` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `lng` varchar(10) NOT NULL,
  `lat` varchar(10) NOT NULL,
  `industry1` varchar(10) NOT NULL,
  `industry2` varchar(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_lat_lng` (`lng`,`lat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_attachment
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_attachment`;
CREATE TABLE `ims_core_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `module_upload_dir` varchar(100) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_cache
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_cache`;
CREATE TABLE `ims_core_cache` (
  `key` varchar(100) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_cache
-- ----------------------------
BEGIN;
INSERT INTO `ims_core_cache` VALUES ('we7:setting', 'a:6:{s:9:\"copyright\";a:1:{s:6:\"slides\";a:3:{i:0;s:58:\"https://img.alicdn.com/tps/TB1pfG4IFXXXXc6XXXXXXXXXXXX.jpg\";i:1;s:58:\"https://img.alicdn.com/tps/TB1sXGYIFXXXXc5XpXXXXXXXXXX.jpg\";i:2;s:58:\"https://img.alicdn.com/tps/TB1h9xxIFXXXXbKXXXXXXXXXXXX.jpg\";}}s:8:\"authmode\";i:1;s:5:\"close\";a:2:{s:6:\"status\";s:1:\"0\";s:6:\"reason\";s:0:\"\";}s:8:\"register\";a:4:{s:4:\"open\";i:1;s:6:\"verify\";i:0;s:4:\"code\";i:1;s:7:\"groupid\";i:1;}s:10:\"thirdlogin\";a:4:{s:6:\"system\";a:3:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"authstate\";s:0:\"\";}s:2:\"qq\";a:3:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"authstate\";i:0;}s:6:\"wechat\";a:3:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"authstate\";s:0:\"\";}s:6:\"mobile\";a:3:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"authstate\";s:0:\"\";}}s:18:\"module_receive_ban\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:system_frame:0', 'a:21:{s:8:\"phoneapp\";a:7:{s:5:\"title\";s:3:\"APP\";s:4:\"icon\";s:18:\"wi wi-white-collar\";s:3:\"url\";s:41:\"./index.php?c=phoneapp&a=display&do=home&\";s:7:\"section\";a:2:{s:15:\"platform_module\";a:3:{s:5:\"title\";s:6:\"应用\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}s:16:\"phoneapp_profile\";a:4:{s:5:\"title\";s:6:\"配置\";s:4:\"menu\";a:2:{s:28:\"profile_phoneapp_module_link\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:1:{i:0;i:6;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"数据同步\";s:3:\"url\";s:42:\"./index.php?c=wxapp&a=module-link-uniacid&\";s:15:\"permission_name\";s:28:\"profile_phoneapp_module_link\";s:4:\"icon\";s:18:\"wi wi-data-synchro\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:14:\"front_download\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";b:1;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"下载APP\";s:3:\"url\";s:40:\"./index.php?c=phoneapp&a=front-download&\";s:15:\"permission_name\";s:23:\"phoneapp_front_download\";s:4:\"icon\";s:13:\"wi wi-examine\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:10:\"is_display\";b:1;s:18:\"permission_display\";a:1:{i:0;i:6;}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:0;s:12:\"displayorder\";i:0;}s:7:\"welcome\";a:7:{s:5:\"title\";s:6:\"首页\";s:4:\"icon\";s:10:\"wi wi-home\";s:3:\"url\";s:48:\"./index.php?c=home&a=welcome&do=system&page=home\";s:7:\"section\";a:0:{}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:2;}s:8:\"platform\";a:8:{s:5:\"title\";s:12:\"平台入口\";s:4:\"icon\";s:14:\"wi wi-platform\";s:9:\"dimension\";i:2;s:3:\"url\";s:44:\"./index.php?c=account&a=display&do=platform&\";s:7:\"section\";a:0:{}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:3;}s:6:\"module\";a:8:{s:5:\"title\";s:12:\"应用入口\";s:4:\"icon\";s:11:\"wi wi-apply\";s:9:\"dimension\";i:2;s:3:\"url\";s:53:\"./index.php?c=module&a=display&do=switch_last_module&\";s:7:\"section\";a:0:{}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:4;}s:14:\"account_manage\";a:8:{s:5:\"title\";s:12:\"平台管理\";s:4:\"icon\";s:21:\"wi wi-platform-manage\";s:9:\"dimension\";i:2;s:3:\"url\";s:31:\"./index.php?c=account&a=manage&\";s:7:\"section\";a:1:{s:14:\"account_manage\";a:2:{s:5:\"title\";s:12:\"平台管理\";s:4:\"menu\";a:4:{s:22:\"account_manage_display\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"平台列表\";s:3:\"url\";s:31:\"./index.php?c=account&a=manage&\";s:15:\"permission_name\";s:22:\"account_manage_display\";s:4:\"icon\";N;s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";a:1:{i:0;a:2:{s:5:\"title\";s:12:\"帐号停用\";s:15:\"permission_name\";s:19:\"account_manage_stop\";}}}s:22:\"account_manage_recycle\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"回收站\";s:3:\"url\";s:32:\"./index.php?c=account&a=recycle&\";s:15:\"permission_name\";s:22:\"account_manage_recycle\";s:4:\"icon\";N;s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{i:0;a:2:{s:5:\"title\";s:12:\"帐号删除\";s:15:\"permission_name\";s:21:\"account_manage_delete\";}i:1;a:2:{s:5:\"title\";s:12:\"帐号恢复\";s:15:\"permission_name\";s:22:\"account_manage_recover\";}}}s:30:\"account_manage_system_platform\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:19:\" 微信开放平台\";s:3:\"url\";s:32:\"./index.php?c=system&a=platform&\";s:15:\"permission_name\";s:30:\"account_manage_system_platform\";s:4:\"icon\";N;s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:30:\"account_manage_expired_message\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:22:\" 自定义到期提示\";s:3:\"url\";s:40:\"./index.php?c=account&a=expired-message&\";s:15:\"permission_name\";s:30:\"account_manage_expired_message\";s:4:\"icon\";N;s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:5;}s:13:\"module_manage\";a:8:{s:5:\"title\";s:12:\"应用管理\";s:4:\"icon\";s:19:\"wi wi-module-manage\";s:9:\"dimension\";i:2;s:3:\"url\";s:50:\"./index.php?c=module&a=manage-system&do=installed&\";s:7:\"section\";a:1:{s:13:\"module_manage\";a:2:{s:5:\"title\";s:12:\"应用管理\";s:4:\"menu\";a:6:{s:23:\"module_manage_installed\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"已安装列表\";s:3:\"url\";s:50:\"./index.php?c=module&a=manage-system&do=installed&\";s:15:\"permission_name\";s:23:\"module_manage_installed\";s:4:\"icon\";N;s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:20:\"module_manage_stoped\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"已停用列表\";s:3:\"url\";s:54:\"./index.php?c=module&a=manage-system&do=recycle&type=1\";s:15:\"permission_name\";s:20:\"module_manage_stoped\";s:4:\"icon\";N;s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:27:\"module_manage_not_installed\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"未安装列表\";s:3:\"url\";s:54:\"./index.php?c=module&a=manage-system&do=not_installed&\";s:15:\"permission_name\";s:27:\"module_manage_not_installed\";s:4:\"icon\";N;s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:21:\"module_manage_recycle\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"回收站\";s:3:\"url\";s:54:\"./index.php?c=module&a=manage-system&do=recycle&type=2\";s:15:\"permission_name\";s:21:\"module_manage_recycle\";s:4:\"icon\";N;s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:23:\"module_manage_subscribe\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"订阅管理\";s:3:\"url\";s:50:\"./index.php?c=module&a=manage-system&do=subscribe&\";s:15:\"permission_name\";s:23:\"module_manage_subscribe\";s:4:\"icon\";N;s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:20:\"module_manage_expire\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"应用停用提醒\";s:3:\"url\";s:30:\"./index.php?c=module&a=expire&\";s:15:\"permission_name\";s:20:\"module_manage_expire\";s:4:\"icon\";N;s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:6;}s:11:\"user_manage\";a:8:{s:5:\"title\";s:12:\"用户管理\";s:4:\"icon\";s:16:\"wi wi-user-group\";s:9:\"dimension\";i:2;s:3:\"url\";s:29:\"./index.php?c=user&a=display&\";s:7:\"section\";a:1:{s:11:\"user_manage\";a:2:{s:5:\"title\";s:12:\"用户管理\";s:4:\"menu\";a:6:{s:19:\"user_manage_display\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"普通用户\";s:3:\"url\";s:29:\"./index.php?c=user&a=display&\";s:15:\"permission_name\";s:19:\"user_manage_display\";s:4:\"icon\";N;s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:19:\"user_manage_founder\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"副站长\";s:3:\"url\";s:32:\"./index.php?c=founder&a=display&\";s:15:\"permission_name\";s:19:\"user_manage_founder\";s:4:\"icon\";N;s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:17:\"user_manage_clerk\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"店员管理\";s:3:\"url\";s:39:\"./index.php?c=user&a=display&type=clerk\";s:15:\"permission_name\";s:17:\"user_manage_clerk\";s:4:\"icon\";N;s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:17:\"user_manage_check\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"审核用户\";s:3:\"url\";s:39:\"./index.php?c=user&a=display&type=check\";s:15:\"permission_name\";s:17:\"user_manage_check\";s:4:\"icon\";N;s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:19:\"user_manage_recycle\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"回收站\";s:3:\"url\";s:41:\"./index.php?c=user&a=display&type=recycle\";s:15:\"permission_name\";s:19:\"user_manage_recycle\";s:4:\"icon\";N;s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:18:\"user_manage_fields\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"用户属性设置\";s:3:\"url\";s:39:\"./index.php?c=user&a=fields&do=display&\";s:15:\"permission_name\";s:18:\"user_manage_fields\";s:4:\"icon\";N;s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:7;}s:10:\"permission\";a:8:{s:5:\"title\";s:9:\"权限组\";s:4:\"icon\";s:22:\"wi wi-userjurisdiction\";s:9:\"dimension\";i:2;s:3:\"url\";s:29:\"./index.php?c=module&a=group&\";s:7:\"section\";a:1:{s:10:\"permission\";a:2:{s:5:\"title\";s:9:\"权限组\";s:4:\"menu\";a:4:{s:23:\"permission_module_group\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"应用权限组\";s:3:\"url\";s:29:\"./index.php?c=module&a=group&\";s:15:\"permission_name\";s:23:\"permission_module_group\";s:4:\"icon\";N;s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:31:\"permission_create_account_group\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"账号权限组\";s:3:\"url\";s:34:\"./index.php?c=user&a=create-group&\";s:15:\"permission_name\";s:31:\"permission_create_account_group\";s:4:\"icon\";N;s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:21:\"permission_user_group\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"用户权限组合\";s:3:\"url\";s:27:\"./index.php?c=user&a=group&\";s:15:\"permission_name\";s:21:\"permission_user_group\";s:4:\"icon\";N;s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:24:\"permission_founder_group\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:21:\"副站长权限组合\";s:3:\"url\";s:30:\"./index.php?c=founder&a=group&\";s:15:\"permission_name\";s:24:\"permission_founder_group\";s:4:\"icon\";N;s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:8;}s:6:\"system\";a:8:{s:5:\"title\";s:12:\"系统功能\";s:4:\"icon\";s:13:\"wi wi-setting\";s:9:\"dimension\";i:3;s:3:\"url\";s:31:\"./index.php?c=article&a=notice&\";s:7:\"section\";a:5:{s:7:\"article\";a:3:{s:5:\"title\";s:12:\"站内公告\";s:4:\"menu\";a:1:{s:14:\"system_article\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"站内公告\";s:3:\"url\";s:31:\"./index.php?c=article&a=notice&\";s:15:\"permission_name\";s:14:\"system_article\";s:4:\"icon\";s:13:\"wi wi-article\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{i:0;a:2:{s:5:\"title\";s:12:\"公告列表\";s:15:\"permission_name\";s:26:\"system_article_notice_list\";}i:1;a:2:{s:5:\"title\";s:12:\"公告分类\";s:15:\"permission_name\";s:30:\"system_article_notice_category\";}}}}s:7:\"founder\";b:1;}s:15:\"system_template\";a:3:{s:5:\"title\";s:6:\"模板\";s:4:\"menu\";a:1:{s:15:\"system_template\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"微官网模板\";s:3:\"url\";s:32:\"./index.php?c=system&a=template&\";s:15:\"permission_name\";s:15:\"system_template\";s:4:\"icon\";s:17:\"wi wi-wx-template\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:7:\"founder\";b:1;}s:14:\"system_welcome\";a:3:{s:5:\"title\";s:12:\"系统首页\";s:4:\"menu\";a:2:{s:14:\"system_welcome\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"系统首页应用\";s:3:\"url\";s:60:\"./index.php?c=module&a=manage-system&support=welcome_support\";s:15:\"permission_name\";s:14:\"system_welcome\";s:4:\"icon\";s:20:\"wi wi-system-welcome\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:11:\"system_news\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"系统新闻\";s:3:\"url\";s:29:\"./index.php?c=article&a=news&\";s:15:\"permission_name\";s:11:\"system_news\";s:4:\"icon\";s:13:\"wi wi-article\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{i:0;a:2:{s:5:\"title\";s:13:\"新闻列表 \";s:15:\"permission_name\";s:24:\"system_article_news_list\";}i:1;a:2:{s:5:\"title\";s:13:\"新闻分类 \";s:15:\"permission_name\";s:28:\"system_article_news_category\";}}}}s:7:\"founder\";b:1;}s:17:\"system_statistics\";a:3:{s:5:\"title\";s:6:\"统计\";s:4:\"menu\";a:1:{s:23:\"system_account_analysis\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"访问统计\";s:3:\"url\";s:35:\"./index.php?c=statistics&a=account&\";s:15:\"permission_name\";s:23:\"system_account_analysis\";s:4:\"icon\";s:17:\"wi wi-statistical\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:7:\"founder\";b:1;}s:5:\"cache\";a:2:{s:5:\"title\";s:6:\"缓存\";s:4:\"menu\";a:1:{s:26:\"system_setting_updatecache\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"更新缓存\";s:3:\"url\";s:35:\"./index.php?c=system&a=updatecache&\";s:15:\"permission_name\";s:26:\"system_setting_updatecache\";s:4:\"icon\";s:12:\"wi wi-update\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:9;}s:4:\"site\";a:9:{s:5:\"title\";s:12:\"站点设置\";s:4:\"icon\";s:17:\"wi wi-system-site\";s:9:\"dimension\";i:3;s:3:\"url\";s:28:\"./index.php?c=system&a=site&\";s:7:\"section\";a:3:{s:7:\"setting\";a:2:{s:5:\"title\";s:6:\"设置\";s:4:\"menu\";a:9:{s:19:\"system_setting_site\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"站点设置\";s:3:\"url\";s:28:\"./index.php?c=system&a=site&\";s:15:\"permission_name\";s:19:\"system_setting_site\";s:4:\"icon\";s:18:\"wi wi-site-setting\";s:12:\"displayorder\";i:9;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"system_setting_menu\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"菜单设置\";s:3:\"url\";s:28:\"./index.php?c=system&a=menu&\";s:15:\"permission_name\";s:19:\"system_setting_menu\";s:4:\"icon\";s:18:\"wi wi-menu-setting\";s:12:\"displayorder\";i:8;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:25:\"system_setting_attachment\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"附件设置\";s:3:\"url\";s:34:\"./index.php?c=system&a=attachment&\";s:15:\"permission_name\";s:25:\"system_setting_attachment\";s:4:\"icon\";s:16:\"wi wi-attachment\";s:12:\"displayorder\";i:7;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:25:\"system_setting_systeminfo\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"系统信息\";s:3:\"url\";s:34:\"./index.php?c=system&a=systeminfo&\";s:15:\"permission_name\";s:25:\"system_setting_systeminfo\";s:4:\"icon\";s:17:\"wi wi-system-info\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"system_setting_logs\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"查看日志\";s:3:\"url\";s:28:\"./index.php?c=system&a=logs&\";s:15:\"permission_name\";s:19:\"system_setting_logs\";s:4:\"icon\";s:9:\"wi wi-log\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:26:\"system_setting_ipwhitelist\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:11:\"IP白名单\";s:3:\"url\";s:35:\"./index.php?c=system&a=ipwhitelist&\";s:15:\"permission_name\";s:26:\"system_setting_ipwhitelist\";s:4:\"icon\";s:8:\"wi wi-ip\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:28:\"system_setting_sensitiveword\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"过滤敏感词\";s:3:\"url\";s:37:\"./index.php?c=system&a=sensitiveword&\";s:15:\"permission_name\";s:28:\"system_setting_sensitiveword\";s:4:\"icon\";s:15:\"wi wi-sensitive\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:25:\"system_setting_thirdlogin\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:25:\"用户登录/注册设置\";s:3:\"url\";s:33:\"./index.php?c=user&a=registerset&\";s:15:\"permission_name\";s:25:\"system_setting_thirdlogin\";s:4:\"icon\";s:10:\"wi wi-user\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:20:\"system_setting_oauth\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"全局借用权限\";s:3:\"url\";s:29:\"./index.php?c=system&a=oauth&\";s:15:\"permission_name\";s:20:\"system_setting_oauth\";s:4:\"icon\";s:11:\"wi wi-oauth\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:7:\"utility\";a:2:{s:5:\"title\";s:12:\"常用工具\";s:4:\"menu\";a:6:{s:24:\"system_utility_filecheck\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"系统文件校验\";s:3:\"url\";s:33:\"./index.php?c=system&a=filecheck&\";s:15:\"permission_name\";s:24:\"system_utility_filecheck\";s:4:\"icon\";s:10:\"wi wi-file\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:23:\"system_utility_optimize\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"性能优化\";s:3:\"url\";s:32:\"./index.php?c=system&a=optimize&\";s:15:\"permission_name\";s:23:\"system_utility_optimize\";s:4:\"icon\";s:14:\"wi wi-optimize\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:23:\"system_utility_database\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"数据库\";s:3:\"url\";s:32:\"./index.php?c=system&a=database&\";s:15:\"permission_name\";s:23:\"system_utility_database\";s:4:\"icon\";s:9:\"wi wi-sql\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"system_utility_scan\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"木马查杀\";s:3:\"url\";s:28:\"./index.php?c=system&a=scan&\";s:15:\"permission_name\";s:19:\"system_utility_scan\";s:4:\"icon\";s:12:\"wi wi-safety\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:18:\"system_utility_bom\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"检测文件BOM\";s:3:\"url\";s:27:\"./index.php?c=system&a=bom&\";s:15:\"permission_name\";s:18:\"system_utility_bom\";s:4:\"icon\";s:9:\"wi wi-bom\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:20:\"system_utility_check\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"系统常规检测\";s:3:\"url\";s:29:\"./index.php?c=system&a=check&\";s:15:\"permission_name\";s:20:\"system_utility_check\";s:4:\"icon\";s:9:\"wi wi-bom\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:7:\"backjob\";a:2:{s:5:\"title\";s:12:\"后台任务\";s:4:\"menu\";a:1:{s:10:\"system_job\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"后台任务\";s:3:\"url\";s:38:\"./index.php?c=system&a=job&do=display&\";s:15:\"permission_name\";s:10:\"system_job\";s:4:\"icon\";s:9:\"wi wi-job\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:7:\"founder\";b:1;s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:10;}s:6:\"myself\";a:8:{s:5:\"title\";s:12:\"我的账户\";s:4:\"icon\";s:10:\"wi wi-bell\";s:9:\"dimension\";i:2;s:3:\"url\";s:29:\"./index.php?c=user&a=profile&\";s:7:\"section\";a:0:{}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:11;}s:7:\"message\";a:8:{s:5:\"title\";s:12:\"消息管理\";s:4:\"icon\";s:10:\"wi wi-bell\";s:9:\"dimension\";i:2;s:3:\"url\";s:31:\"./index.php?c=message&a=notice&\";s:7:\"section\";a:1:{s:7:\"message\";a:2:{s:5:\"title\";s:12:\"消息管理\";s:4:\"menu\";a:3:{s:14:\"message_notice\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"消息提醒\";s:3:\"url\";s:31:\"./index.php?c=message&a=notice&\";s:15:\"permission_name\";s:14:\"message_notice\";s:4:\"icon\";N;s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:15:\"message_setting\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"消息设置\";s:3:\"url\";s:42:\"./index.php?c=message&a=notice&do=setting&\";s:15:\"permission_name\";s:15:\"message_setting\";s:4:\"icon\";N;s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:22:\"message_wechat_setting\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"微信提醒设置\";s:3:\"url\";s:49:\"./index.php?c=message&a=notice&do=wechat_setting&\";s:15:\"permission_name\";s:22:\"message_wechat_setting\";s:4:\"icon\";N;s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:12;}s:7:\"account\";a:8:{s:5:\"title\";s:9:\"公众号\";s:4:\"icon\";s:18:\"wi wi-white-collar\";s:9:\"dimension\";i:3;s:3:\"url\";s:41:\"./index.php?c=home&a=welcome&do=platform&\";s:7:\"section\";a:5:{s:8:\"platform\";a:4:{s:5:\"title\";s:12:\"增强功能\";s:4:\"menu\";a:6:{s:14:\"platform_reply\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"自动回复\";s:3:\"url\";s:31:\"./index.php?c=platform&a=reply&\";s:15:\"permission_name\";s:14:\"platform_reply\";s:4:\"icon\";s:11:\"wi wi-reply\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";a:7:{s:22:\"platform_reply_keyword\";a:4:{s:5:\"title\";s:21:\"关键字自动回复\";s:3:\"url\";s:40:\"./index.php?c=platform&a=reply&m=keyword\";s:15:\"permission_name\";s:22:\"platform_reply_keyword\";s:6:\"active\";s:7:\"keyword\";}s:22:\"platform_reply_special\";a:4:{s:5:\"title\";s:24:\"非关键字自动回复\";s:3:\"url\";s:40:\"./index.php?c=platform&a=reply&m=special\";s:15:\"permission_name\";s:22:\"platform_reply_special\";s:6:\"active\";s:7:\"special\";}s:22:\"platform_reply_welcome\";a:4:{s:5:\"title\";s:24:\"首次访问自动回复\";s:3:\"url\";s:40:\"./index.php?c=platform&a=reply&m=welcome\";s:15:\"permission_name\";s:22:\"platform_reply_welcome\";s:6:\"active\";s:7:\"welcome\";}s:22:\"platform_reply_default\";a:4:{s:5:\"title\";s:12:\"默认回复\";s:3:\"url\";s:40:\"./index.php?c=platform&a=reply&m=default\";s:15:\"permission_name\";s:22:\"platform_reply_default\";s:6:\"active\";s:7:\"default\";}s:22:\"platform_reply_service\";a:4:{s:5:\"title\";s:12:\"常用服务\";s:3:\"url\";s:40:\"./index.php?c=platform&a=reply&m=service\";s:15:\"permission_name\";s:22:\"platform_reply_service\";s:6:\"active\";s:7:\"service\";}s:22:\"platform_reply_userapi\";a:5:{s:5:\"title\";s:21:\"自定义接口回复\";s:3:\"url\";s:40:\"./index.php?c=platform&a=reply&m=userapi\";s:15:\"permission_name\";s:22:\"platform_reply_userapi\";s:6:\"active\";s:7:\"userapi\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:22:\"platform_reply_setting\";a:4:{s:5:\"title\";s:12:\"回复设置\";s:3:\"url\";s:38:\"./index.php?c=profile&a=reply-setting&\";s:15:\"permission_name\";s:22:\"platform_reply_setting\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}}}s:13:\"platform_menu\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:0;s:5:\"title\";s:15:\"自定义菜单\";s:3:\"url\";s:38:\"./index.php?c=platform&a=menu&do=post&\";s:15:\"permission_name\";s:13:\"platform_menu\";s:4:\"icon\";s:16:\"wi wi-custommenu\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{s:21:\"platform_menu_default\";a:4:{s:5:\"title\";s:12:\"默认菜单\";s:3:\"url\";s:38:\"./index.php?c=platform&a=menu&do=post&\";s:15:\"permission_name\";s:21:\"platform_menu_default\";s:6:\"active\";s:4:\"post\";}s:25:\"platform_menu_conditional\";a:5:{s:5:\"title\";s:15:\"个性化菜单\";s:3:\"url\";s:47:\"./index.php?c=platform&a=menu&do=display&type=3\";s:15:\"permission_name\";s:25:\"platform_menu_conditional\";s:6:\"active\";s:7:\"display\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}}}s:11:\"platform_qr\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:2:{i:0;i:1;i:1;i:3;}s:10:\"is_display\";i:0;s:5:\"title\";s:22:\"二维码/转化链接\";s:3:\"url\";s:28:\"./index.php?c=platform&a=qr&\";s:15:\"permission_name\";s:11:\"platform_qr\";s:4:\"icon\";s:12:\"wi wi-qrcode\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{s:14:\"platform_qr_qr\";a:4:{s:5:\"title\";s:9:\"二维码\";s:3:\"url\";s:36:\"./index.php?c=platform&a=qr&do=list&\";s:15:\"permission_name\";s:14:\"platform_qr_qr\";s:6:\"active\";s:4:\"list\";}s:22:\"platform_qr_statistics\";a:4:{s:5:\"title\";s:21:\"二维码扫描统计\";s:3:\"url\";s:39:\"./index.php?c=platform&a=qr&do=display&\";s:15:\"permission_name\";s:22:\"platform_qr_statistics\";s:6:\"active\";s:7:\"display\";}}}s:17:\"platform_masstask\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"定时群发\";s:3:\"url\";s:30:\"./index.php?c=platform&a=mass&\";s:15:\"permission_name\";s:17:\"platform_masstask\";s:4:\"icon\";s:13:\"wi wi-crontab\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{s:22:\"platform_masstask_post\";a:4:{s:5:\"title\";s:12:\"定时群发\";s:3:\"url\";s:38:\"./index.php?c=platform&a=mass&do=post&\";s:15:\"permission_name\";s:22:\"platform_masstask_post\";s:6:\"active\";s:4:\"post\";}s:22:\"platform_masstask_send\";a:4:{s:5:\"title\";s:12:\"群发记录\";s:3:\"url\";s:38:\"./index.php?c=platform&a=mass&do=send&\";s:15:\"permission_name\";s:22:\"platform_masstask_send\";s:6:\"active\";s:4:\"send\";}}}s:17:\"platform_material\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:0;s:5:\"title\";s:16:\"素材/编辑器\";s:3:\"url\";s:34:\"./index.php?c=platform&a=material&\";s:15:\"permission_name\";s:17:\"platform_material\";s:4:\"icon\";s:12:\"wi wi-redact\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:5:{s:22:\"platform_material_news\";a:4:{s:5:\"title\";s:6:\"图文\";s:3:\"url\";s:43:\"./index.php?c=platform&a=material&type=news\";s:15:\"permission_name\";s:22:\"platform_material_news\";s:6:\"active\";s:4:\"news\";}s:23:\"platform_material_image\";a:4:{s:5:\"title\";s:6:\"图片\";s:3:\"url\";s:44:\"./index.php?c=platform&a=material&type=image\";s:15:\"permission_name\";s:23:\"platform_material_image\";s:6:\"active\";s:5:\"image\";}s:23:\"platform_material_voice\";a:4:{s:5:\"title\";s:6:\"语音\";s:3:\"url\";s:44:\"./index.php?c=platform&a=material&type=voice\";s:15:\"permission_name\";s:23:\"platform_material_voice\";s:6:\"active\";s:5:\"voice\";}s:23:\"platform_material_video\";a:5:{s:5:\"title\";s:6:\"视频\";s:3:\"url\";s:44:\"./index.php?c=platform&a=material&type=video\";s:15:\"permission_name\";s:23:\"platform_material_video\";s:6:\"active\";s:5:\"video\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:24:\"platform_material_delete\";a:3:{s:5:\"title\";s:6:\"删除\";s:15:\"permission_name\";s:24:\"platform_material_delete\";s:10:\"is_display\";b:0;}}}s:13:\"platform_site\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:2:{i:0;i:1;i:1;i:3;}s:10:\"is_display\";i:0;s:5:\"title\";s:16:\"微官网-文章\";s:3:\"url\";s:27:\"./index.php?c=site&a=multi&\";s:15:\"permission_name\";s:13:\"platform_site\";s:4:\"icon\";s:10:\"wi wi-home\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:4:{s:19:\"platform_site_multi\";a:4:{s:5:\"title\";s:9:\"微官网\";s:3:\"url\";s:38:\"./index.php?c=site&a=multi&do=display&\";s:15:\"permission_name\";s:19:\"platform_site_multi\";s:6:\"active\";s:5:\"multi\";}s:19:\"platform_site_style\";a:4:{s:5:\"title\";s:15:\"微官网模板\";s:3:\"url\";s:39:\"./index.php?c=site&a=style&do=template&\";s:15:\"permission_name\";s:19:\"platform_site_style\";s:6:\"active\";s:5:\"style\";}s:21:\"platform_site_article\";a:4:{s:5:\"title\";s:12:\"文章管理\";s:3:\"url\";s:40:\"./index.php?c=site&a=article&do=display&\";s:15:\"permission_name\";s:21:\"platform_site_article\";s:6:\"active\";s:7:\"article\";}s:22:\"platform_site_category\";a:4:{s:5:\"title\";s:18:\"文章分类管理\";s:3:\"url\";s:41:\"./index.php?c=site&a=category&do=display&\";s:15:\"permission_name\";s:22:\"platform_site_category\";s:6:\"active\";s:8:\"category\";}}}}s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:0;}s:15:\"platform_module\";a:3:{s:5:\"title\";s:12:\"应用模块\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}s:2:\"mc\";a:4:{s:5:\"title\";s:6:\"粉丝\";s:4:\"menu\";a:3:{s:7:\"mc_fans\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"粉丝管理\";s:3:\"url\";s:24:\"./index.php?c=mc&a=fans&\";s:15:\"permission_name\";s:7:\"mc_fans\";s:4:\"icon\";s:16:\"wi wi-fansmanage\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{s:15:\"mc_fans_display\";a:4:{s:5:\"title\";s:12:\"全部粉丝\";s:3:\"url\";s:35:\"./index.php?c=mc&a=fans&do=display&\";s:15:\"permission_name\";s:15:\"mc_fans_display\";s:6:\"active\";s:7:\"display\";}s:21:\"mc_fans_fans_sync_set\";a:4:{s:5:\"title\";s:18:\"粉丝同步设置\";s:3:\"url\";s:41:\"./index.php?c=mc&a=fans&do=fans_sync_set&\";s:15:\"permission_name\";s:21:\"mc_fans_fans_sync_set\";s:6:\"active\";s:13:\"fans_sync_set\";}}}s:9:\"mc_member\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:5:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;i:4;i:5;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"会员管理\";s:3:\"url\";s:26:\"./index.php?c=mc&a=member&\";s:15:\"permission_name\";s:9:\"mc_member\";s:4:\"icon\";s:10:\"wi wi-fans\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:7:{s:17:\"mc_member_diaplsy\";a:4:{s:5:\"title\";s:12:\"会员管理\";s:3:\"url\";s:37:\"./index.php?c=mc&a=member&do=display&\";s:15:\"permission_name\";s:17:\"mc_member_diaplsy\";s:6:\"active\";s:7:\"display\";}s:15:\"mc_member_group\";a:4:{s:5:\"title\";s:9:\"会员组\";s:3:\"url\";s:36:\"./index.php?c=mc&a=group&do=display&\";s:15:\"permission_name\";s:15:\"mc_member_group\";s:6:\"active\";s:7:\"display\";}s:12:\"mc_member_uc\";a:5:{s:5:\"title\";s:12:\"会员中心\";s:3:\"url\";s:34:\"./index.php?c=site&a=editor&do=uc&\";s:15:\"permission_name\";s:12:\"mc_member_uc\";s:6:\"active\";s:2:\"uc\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:19:\"mc_member_quickmenu\";a:5:{s:5:\"title\";s:12:\"快捷菜单\";s:3:\"url\";s:41:\"./index.php?c=site&a=editor&do=quickmenu&\";s:15:\"permission_name\";s:19:\"mc_member_quickmenu\";s:6:\"active\";s:9:\"quickmenu\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:25:\"mc_member_register_seting\";a:5:{s:5:\"title\";s:12:\"注册设置\";s:3:\"url\";s:46:\"./index.php?c=mc&a=member&do=register_setting&\";s:15:\"permission_name\";s:25:\"mc_member_register_seting\";s:6:\"active\";s:16:\"register_setting\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:24:\"mc_member_credit_setting\";a:4:{s:5:\"title\";s:12:\"积分设置\";s:3:\"url\";s:44:\"./index.php?c=mc&a=member&do=credit_setting&\";s:15:\"permission_name\";s:24:\"mc_member_credit_setting\";s:6:\"active\";s:14:\"credit_setting\";}s:16:\"mc_member_fields\";a:4:{s:5:\"title\";s:18:\"会员字段管理\";s:3:\"url\";s:34:\"./index.php?c=mc&a=fields&do=list&\";s:15:\"permission_name\";s:16:\"mc_member_fields\";s:6:\"active\";s:4:\"list\";}}}s:10:\"mc_message\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"留言管理\";s:3:\"url\";s:27:\"./index.php?c=mc&a=message&\";s:15:\"permission_name\";s:10:\"mc_message\";s:4:\"icon\";s:13:\"wi wi-message\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:18:\"permission_display\";a:5:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;i:4;i:5;}s:10:\"is_display\";i:0;}s:7:\"profile\";a:4:{s:5:\"title\";s:6:\"配置\";s:4:\"menu\";a:7:{s:15:\"profile_setting\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:5:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;i:4;i:5;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"参数配置\";s:3:\"url\";s:31:\"./index.php?c=profile&a=remote&\";s:15:\"permission_name\";s:15:\"profile_setting\";s:4:\"icon\";s:23:\"wi wi-parameter-setting\";s:12:\"displayorder\";i:7;s:2:\"id\";N;s:14:\"sub_permission\";a:5:{s:22:\"profile_setting_remote\";a:4:{s:5:\"title\";s:12:\"远程附件\";s:3:\"url\";s:42:\"./index.php?c=profile&a=remote&do=display&\";s:15:\"permission_name\";s:22:\"profile_setting_remote\";s:6:\"active\";s:7:\"display\";}s:24:\"profile_setting_passport\";a:5:{s:5:\"title\";s:12:\"借用权限\";s:3:\"url\";s:42:\"./index.php?c=profile&a=passport&do=oauth&\";s:15:\"permission_name\";s:24:\"profile_setting_passport\";s:6:\"active\";s:5:\"oauth\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:25:\"profile_setting_tplnotice\";a:5:{s:5:\"title\";s:18:\"微信通知设置\";s:3:\"url\";s:42:\"./index.php?c=profile&a=tplnotice&do=list&\";s:15:\"permission_name\";s:25:\"profile_setting_tplnotice\";s:6:\"active\";s:4:\"list\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:22:\"profile_setting_notify\";a:5:{s:5:\"title\";s:18:\"邮件通知参数\";s:3:\"url\";s:39:\"./index.php?c=profile&a=notify&do=mail&\";s:15:\"permission_name\";s:22:\"profile_setting_notify\";s:6:\"active\";s:4:\"mail\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:27:\"profile_setting_upload_file\";a:5:{s:5:\"title\";s:20:\"上传JS接口文件\";s:3:\"url\";s:46:\"./index.php?c=profile&a=common&do=upload_file&\";s:15:\"permission_name\";s:27:\"profile_setting_upload_file\";s:6:\"active\";s:11:\"upload_file\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}}}s:15:\"profile_payment\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:2:{i:0;i:1;i:1;i:3;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"支付参数\";s:3:\"url\";s:32:\"./index.php?c=profile&a=payment&\";s:15:\"permission_name\";s:15:\"profile_payment\";s:4:\"icon\";s:17:\"wi wi-pay-setting\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{s:19:\"profile_payment_pay\";a:4:{s:5:\"title\";s:12:\"支付配置\";s:3:\"url\";s:32:\"./index.php?c=profile&a=payment&\";s:15:\"permission_name\";s:19:\"profile_payment_pay\";s:6:\"active\";s:7:\"payment\";}s:22:\"profile_payment_refund\";a:4:{s:5:\"title\";s:12:\"退款配置\";s:3:\"url\";s:42:\"./index.php?c=profile&a=refund&do=display&\";s:15:\"permission_name\";s:22:\"profile_payment_refund\";s:6:\"active\";s:6:\"refund\";}}}s:23:\"profile_app_module_link\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"数据同步\";s:3:\"url\";s:44:\"./index.php?c=profile&a=module-link-uniacid&\";s:15:\"permission_name\";s:31:\"profile_app_module_link_uniacid\";s:4:\"icon\";s:18:\"wi wi-data-synchro\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"profile_bind_domain\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"域名绑定\";s:3:\"url\";s:36:\"./index.php?c=profile&a=bind-domain&\";s:15:\"permission_name\";s:19:\"profile_bind_domain\";s:4:\"icon\";s:17:\"wi wi-bind-domain\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:18:\"webapp_module_link\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:1:{i:0;i:5;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"数据同步\";s:3:\"url\";s:44:\"./index.php?c=profile&a=module-link-uniacid&\";s:15:\"permission_name\";s:18:\"webapp_module_link\";s:4:\"icon\";s:18:\"wi wi-data-synchro\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:14:\"webapp_rewrite\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:1:{i:0;i:5;}s:10:\"is_display\";i:0;s:5:\"title\";s:9:\"伪静态\";s:3:\"url\";s:31:\"./index.php?c=webapp&a=rewrite&\";s:15:\"permission_name\";s:14:\"webapp_rewrite\";s:4:\"icon\";s:13:\"wi wi-rewrite\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:18:\"webapp_bind_domain\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:1:{i:0;i:5;}s:10:\"is_display\";i:0;s:5:\"title\";s:18:\"域名访问设置\";s:3:\"url\";s:35:\"./index.php?c=webapp&a=bind-domain&\";s:15:\"permission_name\";s:18:\"webapp_bind_domain\";s:4:\"icon\";s:17:\"wi wi-bind-domain\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:18:\"permission_display\";a:5:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;i:4;i:5;}s:10:\"is_display\";i:0;}s:10:\"statistics\";a:4:{s:5:\"title\";s:6:\"统计\";s:4:\"menu\";a:2:{s:16:\"statistics_visit\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:5:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;i:4;i:5;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"访问统计\";s:3:\"url\";s:31:\"./index.php?c=statistics&a=app&\";s:15:\"permission_name\";s:16:\"statistics_visit\";s:4:\"icon\";s:17:\"wi wi-statistical\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:3:{s:20:\"statistics_visit_app\";a:4:{s:5:\"title\";s:24:\"app端访问统计信息\";s:3:\"url\";s:42:\"./index.php?c=statistics&a=app&do=display&\";s:15:\"permission_name\";s:20:\"statistics_visit_app\";s:6:\"active\";s:3:\"app\";}s:21:\"statistics_visit_site\";a:4:{s:5:\"title\";s:24:\"所有用户访问统计\";s:3:\"url\";s:51:\"./index.php?c=statistics&a=site&do=current_account&\";s:15:\"permission_name\";s:21:\"statistics_visit_site\";s:6:\"active\";s:4:\"site\";}s:24:\"statistics_visit_setting\";a:4:{s:5:\"title\";s:18:\"访问统计设置\";s:3:\"url\";s:46:\"./index.php?c=statistics&a=setting&do=display&\";s:15:\"permission_name\";s:24:\"statistics_visit_setting\";s:6:\"active\";s:7:\"setting\";}}}s:15:\"statistics_fans\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"用户统计\";s:3:\"url\";s:32:\"./index.php?c=statistics&a=fans&\";s:15:\"permission_name\";s:15:\"statistics_fans\";s:4:\"icon\";s:17:\"wi wi-statistical\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:18:\"permission_display\";a:5:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;i:4;i:5;}s:10:\"is_display\";i:0;}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:13;}s:5:\"wxapp\";a:8:{s:5:\"title\";s:15:\"微信小程序\";s:4:\"icon\";s:19:\"wi wi-small-routine\";s:9:\"dimension\";i:3;s:3:\"url\";s:38:\"./index.php?c=wxapp&a=display&do=home&\";s:7:\"section\";a:5:{s:14:\"wxapp_entrance\";a:4:{s:5:\"title\";s:15:\"小程序入口\";s:4:\"menu\";a:1:{s:20:\"module_entrance_link\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"入口页面\";s:3:\"url\";s:36:\"./index.php?c=wxapp&a=entrance-link&\";s:15:\"permission_name\";s:19:\"wxapp_entrance_link\";s:4:\"icon\";s:18:\"wi wi-data-synchro\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;}s:15:\"platform_module\";a:3:{s:5:\"title\";s:6:\"应用\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}s:2:\"mc\";a:4:{s:5:\"title\";s:6:\"粉丝\";s:4:\"menu\";a:1:{s:9:\"mc_member\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;s:5:\"title\";s:6:\"会员\";s:3:\"url\";s:26:\"./index.php?c=mc&a=member&\";s:15:\"permission_name\";s:15:\"mc_wxapp_member\";s:4:\"icon\";s:10:\"wi wi-fans\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:4:{s:17:\"mc_member_diaplsy\";a:4:{s:5:\"title\";s:12:\"会员管理\";s:3:\"url\";s:37:\"./index.php?c=mc&a=member&do=display&\";s:15:\"permission_name\";s:17:\"mc_member_diaplsy\";s:6:\"active\";s:7:\"display\";}s:15:\"mc_member_group\";a:4:{s:5:\"title\";s:9:\"会员组\";s:3:\"url\";s:36:\"./index.php?c=mc&a=group&do=display&\";s:15:\"permission_name\";s:15:\"mc_member_group\";s:6:\"active\";s:7:\"display\";}s:24:\"mc_member_credit_setting\";a:4:{s:5:\"title\";s:12:\"积分设置\";s:3:\"url\";s:44:\"./index.php?c=mc&a=member&do=credit_setting&\";s:15:\"permission_name\";s:24:\"mc_member_credit_setting\";s:6:\"active\";s:14:\"credit_setting\";}s:16:\"mc_member_fields\";a:4:{s:5:\"title\";s:18:\"会员字段管理\";s:3:\"url\";s:34:\"./index.php?c=mc&a=fields&do=list&\";s:15:\"permission_name\";s:16:\"mc_member_fields\";s:6:\"active\";s:4:\"list\";}}}}s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;}s:13:\"wxapp_profile\";a:3:{s:5:\"title\";s:6:\"配置\";s:4:\"menu\";a:5:{s:33:\"wxapp_profile_module_link_uniacid\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:7:{i:0;i:4;i:1;i:7;i:2;i:8;i:3;i:6;i:4;i:11;i:5;i:12;i:6;i:13;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"数据同步\";s:3:\"url\";s:42:\"./index.php?c=wxapp&a=module-link-uniacid&\";s:15:\"permission_name\";s:33:\"wxapp_profile_module_link_uniacid\";s:4:\"icon\";s:18:\"wi wi-data-synchro\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:21:\"wxapp_profile_payment\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"支付参数\";s:3:\"url\";s:30:\"./index.php?c=wxapp&a=payment&\";s:15:\"permission_name\";s:21:\"wxapp_profile_payment\";s:4:\"icon\";s:16:\"wi wi-appsetting\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{s:17:\"wxapp_payment_pay\";a:4:{s:5:\"title\";s:12:\"支付参数\";s:3:\"url\";s:41:\"./index.php?c=wxapp&a=payment&do=display&\";s:15:\"permission_name\";s:17:\"wxapp_payment_pay\";s:6:\"active\";s:7:\"payment\";}s:20:\"wxapp_payment_refund\";a:4:{s:5:\"title\";s:12:\"退款配置\";s:3:\"url\";s:40:\"./index.php?c=wxapp&a=refund&do=display&\";s:15:\"permission_name\";s:20:\"wxapp_payment_refund\";s:6:\"active\";s:6:\"refund\";}}}s:28:\"wxapp_profile_front_download\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"下载程序包\";s:3:\"url\";s:37:\"./index.php?c=wxapp&a=front-download&\";s:15:\"permission_name\";s:28:\"wxapp_profile_front_download\";s:4:\"icon\";s:13:\"wi wi-examine\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:23:\"wxapp_profile_domainset\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"域名设置\";s:3:\"url\";s:32:\"./index.php?c=wxapp&a=domainset&\";s:15:\"permission_name\";s:23:\"wxapp_profile_domainset\";s:4:\"icon\";s:13:\"wi wi-examine\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:22:\"profile_setting_remote\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:7:{i:0;i:4;i:1;i:7;i:2;i:8;i:3;i:6;i:4;i:11;i:5;i:12;i:6;i:13;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"参数配置\";s:3:\"url\";s:31:\"./index.php?c=profile&a=remote&\";s:15:\"permission_name\";s:22:\"profile_setting_remote\";s:4:\"icon\";s:23:\"wi wi-parameter-setting\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:18:\"permission_display\";a:7:{i:0;i:4;i:1;i:7;i:2;i:8;i:3;i:6;i:4;i:11;i:5;i:12;i:6;i:13;}}s:10:\"statistics\";a:4:{s:5:\"title\";s:6:\"统计\";s:4:\"menu\";a:2:{s:16:\"statistics_visit\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:7:{i:0;i:4;i:1;i:7;i:2;i:8;i:3;i:6;i:4;i:11;i:5;i:12;i:6;i:13;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"访问统计\";s:3:\"url\";s:31:\"./index.php?c=statistics&a=app&\";s:15:\"permission_name\";s:22:\"statistics_visit_wxapp\";s:4:\"icon\";s:17:\"wi wi-statistical\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:3:{s:20:\"statistics_visit_app\";a:4:{s:5:\"title\";s:24:\"app端访问统计信息\";s:3:\"url\";s:42:\"./index.php?c=statistics&a=app&do=display&\";s:15:\"permission_name\";s:20:\"statistics_visit_app\";s:6:\"active\";s:3:\"app\";}s:21:\"statistics_visit_site\";a:4:{s:5:\"title\";s:24:\"所有用户访问统计\";s:3:\"url\";s:51:\"./index.php?c=statistics&a=site&do=current_account&\";s:15:\"permission_name\";s:21:\"statistics_visit_site\";s:6:\"active\";s:4:\"site\";}s:24:\"statistics_visit_setting\";a:4:{s:5:\"title\";s:18:\"访问统计设置\";s:3:\"url\";s:46:\"./index.php?c=statistics&a=setting&do=display&\";s:15:\"permission_name\";s:24:\"statistics_visit_setting\";s:6:\"active\";s:7:\"setting\";}}}s:15:\"statistics_fans\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"用户统计\";s:3:\"url\";s:33:\"./index.php?c=wxapp&a=statistics&\";s:15:\"permission_name\";s:21:\"statistics_fans_wxapp\";s:4:\"icon\";s:17:\"wi wi-statistical\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:18:\"permission_display\";a:7:{i:0;i:4;i:1;i:7;i:2;i:8;i:3;i:6;i:4;i:11;i:5;i:12;i:6;i:13;}s:10:\"is_display\";i:0;}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:14;}s:6:\"webapp\";a:7:{s:5:\"title\";s:2:\"PC\";s:4:\"icon\";s:8:\"wi wi-pc\";s:3:\"url\";s:39:\"./index.php?c=webapp&a=home&do=display&\";s:7:\"section\";a:0:{}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:15;}s:5:\"xzapp\";a:7:{s:5:\"title\";s:9:\"熊掌号\";s:4:\"icon\";s:11:\"wi wi-xzapp\";s:3:\"url\";s:38:\"./index.php?c=xzapp&a=home&do=display&\";s:7:\"section\";a:1:{s:15:\"platform_module\";a:3:{s:5:\"title\";s:12:\"应用模块\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:16;}s:6:\"aliapp\";a:7:{s:5:\"title\";s:18:\"支付宝小程序\";s:4:\"icon\";s:12:\"wi wi-aliapp\";s:3:\"url\";s:40:\"./index.php?c=miniapp&a=display&do=home&\";s:7:\"section\";a:1:{s:15:\"platform_module\";a:3:{s:5:\"title\";s:6:\"应用\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:17;}s:8:\"baiduapp\";a:7:{s:5:\"title\";s:15:\"百度小程序\";s:4:\"icon\";s:14:\"wi wi-baiduapp\";s:3:\"url\";s:40:\"./index.php?c=miniapp&a=display&do=home&\";s:7:\"section\";a:1:{s:15:\"platform_module\";a:3:{s:5:\"title\";s:6:\"应用\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:18;}s:10:\"toutiaoapp\";a:7:{s:5:\"title\";s:15:\"头条小程序\";s:4:\"icon\";s:16:\"wi wi-toutiaoapp\";s:3:\"url\";s:40:\"./index.php?c=miniapp&a=display&do=home&\";s:7:\"section\";a:1:{s:15:\"platform_module\";a:3:{s:5:\"title\";s:6:\"应用\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:19;}s:5:\"store\";a:7:{s:5:\"title\";s:6:\"商城\";s:4:\"icon\";s:11:\"wi wi-store\";s:3:\"url\";s:43:\"./index.php?c=home&a=welcome&do=ext&m=store\";s:7:\"section\";a:7:{s:11:\"store_goods\";a:2:{s:5:\"title\";s:12:\"商品分类\";s:4:\"menu\";a:6:{s:18:\"store_goods_module\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"应用模块\";s:3:\"url\";s:69:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=module\";s:15:\"permission_name\";s:18:\"store_goods_module\";s:4:\"icon\";s:11:\"wi wi-apply\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"store_goods_account\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"平台个数\";s:3:\"url\";s:74:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=account_num\";s:15:\"permission_name\";s:19:\"store_goods_account\";s:4:\"icon\";s:13:\"wi wi-account\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:25:\"store_goods_account_renew\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"平台续费\";s:3:\"url\";s:68:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=renew\";s:15:\"permission_name\";s:25:\"store_goods_account_renew\";s:4:\"icon\";s:21:\"wi wi-appjurisdiction\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"store_goods_package\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"应用权限组\";s:3:\"url\";s:64:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=5\";s:15:\"permission_name\";s:19:\"store_goods_package\";s:4:\"icon\";s:21:\"wi wi-appjurisdiction\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:25:\"store_goods_users_package\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"用户权限组\";s:3:\"url\";s:64:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=9\";s:15:\"permission_name\";s:25:\"store_goods_users_package\";s:4:\"icon\";s:22:\"wi wi-userjurisdiction\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:15:\"store_goods_api\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:23:\"应用访问流量(API)\";s:3:\"url\";s:64:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=6\";s:15:\"permission_name\";s:15:\"store_goods_api\";s:4:\"icon\";s:9:\"wi wi-api\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:16:\"store_wish_goods\";a:2:{s:5:\"title\";s:12:\"预购应用\";s:4:\"menu\";a:2:{s:21:\"store_wish_goods_list\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"应用列表\";s:3:\"url\";s:84:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=module_wish&is_wish=1\";s:15:\"permission_name\";s:21:\"store_wish_goods_list\";s:4:\"icon\";s:11:\"wi wi-apply\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:21:\"store_wish_goods_edit\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:19:\"添加/设置应用\";s:3:\"url\";s:82:\"./index.php?c=site&a=entry&do=wishgoodsEdit&m=store&direct=1&op=wishgoods&status=1\";s:15:\"permission_name\";s:21:\"store_wish_goods_edit\";s:4:\"icon\";s:15:\"wi wi-goods-add\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:12:\"store_manage\";a:3:{s:5:\"title\";s:12:\"商城管理\";s:7:\"founder\";b:1;s:4:\"menu\";a:4:{s:18:\"store_manage_goods\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"添加商品\";s:3:\"url\";s:58:\"./index.php?c=site&a=entry&do=goodsSeller&m=store&direct=1\";s:15:\"permission_name\";s:18:\"store_manage_goods\";s:4:\"icon\";s:15:\"wi wi-goods-add\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:20:\"store_manage_setting\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"商城设置\";s:3:\"url\";s:54:\"./index.php?c=site&a=entry&do=setting&m=store&direct=1\";s:15:\"permission_name\";s:20:\"store_manage_setting\";s:4:\"icon\";s:11:\"wi wi-store\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"store_manage_payset\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"支付设置\";s:3:\"url\";s:57:\"./index.php?c=site&a=entry&do=paySetting&m=store&direct=1\";s:15:\"permission_name\";s:19:\"store_manage_payset\";s:4:\"icon\";s:11:\"wi wi-money\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:23:\"store_manage_permission\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"商城访问权限\";s:3:\"url\";s:57:\"./index.php?c=site&a=entry&do=permission&m=store&direct=1\";s:15:\"permission_name\";s:23:\"store_manage_permission\";s:4:\"icon\";s:15:\"wi wi-blacklist\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:12:\"store_orders\";a:2:{s:5:\"title\";s:12:\"订单管理\";s:4:\"menu\";a:2:{s:15:\"store_orders_my\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"我的订单\";s:3:\"url\";s:53:\"./index.php?c=site&a=entry&do=orders&m=store&direct=1\";s:15:\"permission_name\";s:15:\"store_orders_my\";s:4:\"icon\";s:17:\"wi wi-sale-record\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:17:\"store_cash_orders\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"分销订单\";s:3:\"url\";s:71:\"./index.php?c=site&a=entry&do=cash&m=store&operate=cash_orders&direct=1\";s:15:\"permission_name\";s:17:\"store_cash_orders\";s:4:\"icon\";s:11:\"wi wi-order\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:14:\"store_payments\";a:2:{s:5:\"title\";s:12:\"收入明细\";s:4:\"menu\";a:1:{s:8:\"payments\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"收入明细\";s:3:\"url\";s:55:\"./index.php?c=site&a=entry&do=payments&m=store&direct=1\";s:15:\"permission_name\";s:8:\"payments\";s:4:\"icon\";s:17:\"wi wi-sale-record\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:17:\"store_cash_manage\";a:2:{s:5:\"title\";s:12:\"分销管理\";s:4:\"menu\";a:2:{s:25:\"store_manage_cash_setting\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"分销设置\";s:3:\"url\";s:58:\"./index.php?c=site&a=entry&do=cashsetting&m=store&direct=1\";s:15:\"permission_name\";s:25:\"store_manage_cash_setting\";s:4:\"icon\";s:18:\"wi wi-site-setting\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:16:\"store_check_cash\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"提现审核\";s:3:\"url\";s:73:\"./index.php?c=site&a=entry&do=cash&m=store&operate=consume_order&direct=1\";s:15:\"permission_name\";s:16:\"store_check_cash\";s:4:\"icon\";s:18:\"wi wi-check-select\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:10:\"store_cash\";a:2:{s:5:\"title\";s:12:\"佣金管理\";s:4:\"menu\";a:1:{s:8:\"payments\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"我的佣金\";s:3:\"url\";s:66:\"./index.php?c=site&a=entry&do=cash&m=store&operate=mycash&direct=1\";s:15:\"permission_name\";s:8:\"payments\";s:4:\"icon\";s:10:\"wi wi-list\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:20;}s:11:\"custom_help\";a:7:{s:5:\"title\";s:12:\"本站帮助\";s:4:\"icon\";s:12:\"wi wi-market\";s:3:\"url\";s:39:\"./index.php?c=help&a=display&do=custom&\";s:7:\"section\";a:0:{}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:21;}}');
INSERT INTO `ims_core_cache` VALUES ('we7:userbasefields', 'a:46:{s:7:\"uniacid\";s:17:\"同一公众号id\";s:7:\"groupid\";s:8:\"分组id\";s:7:\"credit1\";s:6:\"积分\";s:7:\"credit2\";s:6:\"余额\";s:7:\"credit3\";s:19:\"预留积分类型3\";s:7:\"credit4\";s:19:\"预留积分类型4\";s:7:\"credit5\";s:19:\"预留积分类型5\";s:7:\"credit6\";s:19:\"预留积分类型6\";s:10:\"createtime\";s:12:\"加入时间\";s:6:\"mobile\";s:12:\"手机号码\";s:5:\"email\";s:12:\"电子邮箱\";s:8:\"realname\";s:12:\"真实姓名\";s:8:\"nickname\";s:6:\"昵称\";s:6:\"avatar\";s:6:\"头像\";s:2:\"qq\";s:5:\"QQ号\";s:6:\"gender\";s:6:\"性别\";s:5:\"birth\";s:6:\"生日\";s:13:\"constellation\";s:6:\"星座\";s:6:\"zodiac\";s:6:\"生肖\";s:9:\"telephone\";s:12:\"固定电话\";s:6:\"idcard\";s:12:\"证件号码\";s:9:\"studentid\";s:6:\"学号\";s:5:\"grade\";s:6:\"班级\";s:7:\"address\";s:6:\"地址\";s:7:\"zipcode\";s:6:\"邮编\";s:11:\"nationality\";s:6:\"国籍\";s:6:\"reside\";s:9:\"居住地\";s:14:\"graduateschool\";s:12:\"毕业学校\";s:7:\"company\";s:6:\"公司\";s:9:\"education\";s:6:\"学历\";s:10:\"occupation\";s:6:\"职业\";s:8:\"position\";s:6:\"职位\";s:7:\"revenue\";s:9:\"年收入\";s:15:\"affectivestatus\";s:12:\"情感状态\";s:10:\"lookingfor\";s:13:\" 交友目的\";s:9:\"bloodtype\";s:6:\"血型\";s:6:\"height\";s:6:\"身高\";s:6:\"weight\";s:6:\"体重\";s:6:\"alipay\";s:15:\"支付宝帐号\";s:3:\"msn\";s:3:\"MSN\";s:6:\"taobao\";s:12:\"阿里旺旺\";s:4:\"site\";s:6:\"主页\";s:3:\"bio\";s:12:\"自我介绍\";s:8:\"interest\";s:12:\"兴趣爱好\";s:8:\"password\";s:6:\"密码\";s:12:\"pay_password\";s:12:\"支付密码\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:usersfields', 'a:49:{s:8:\"realname\";s:12:\"真实姓名\";s:8:\"nickname\";s:6:\"昵称\";s:6:\"avatar\";s:6:\"头像\";s:2:\"qq\";s:5:\"QQ号\";s:6:\"mobile\";s:12:\"手机号码\";s:3:\"vip\";s:9:\"VIP级别\";s:6:\"gender\";s:6:\"性别\";s:9:\"birthyear\";s:12:\"出生生日\";s:13:\"constellation\";s:6:\"星座\";s:6:\"zodiac\";s:6:\"生肖\";s:9:\"telephone\";s:12:\"固定电话\";s:6:\"idcard\";s:12:\"证件号码\";s:9:\"studentid\";s:6:\"学号\";s:5:\"grade\";s:6:\"班级\";s:7:\"address\";s:12:\"邮寄地址\";s:7:\"zipcode\";s:6:\"邮编\";s:11:\"nationality\";s:6:\"国籍\";s:14:\"resideprovince\";s:12:\"居住地址\";s:14:\"graduateschool\";s:12:\"毕业学校\";s:7:\"company\";s:6:\"公司\";s:9:\"education\";s:6:\"学历\";s:10:\"occupation\";s:6:\"职业\";s:8:\"position\";s:6:\"职位\";s:7:\"revenue\";s:9:\"年收入\";s:15:\"affectivestatus\";s:12:\"情感状态\";s:10:\"lookingfor\";s:13:\" 交友目的\";s:9:\"bloodtype\";s:6:\"血型\";s:6:\"height\";s:6:\"身高\";s:6:\"weight\";s:6:\"体重\";s:6:\"alipay\";s:15:\"支付宝帐号\";s:3:\"msn\";s:3:\"MSN\";s:5:\"email\";s:12:\"电子邮箱\";s:6:\"taobao\";s:12:\"阿里旺旺\";s:4:\"site\";s:6:\"主页\";s:3:\"bio\";s:12:\"自我介绍\";s:8:\"interest\";s:12:\"兴趣爱好\";s:10:\"birthmonth\";s:12:\"出生月份\";s:8:\"birthday\";s:12:\"出生日期\";s:7:\"credit1\";s:6:\"积分\";s:7:\"credit2\";s:6:\"余额\";s:7:\"uniacid\";s:17:\"同一公众号id\";s:7:\"groupid\";s:8:\"分组id\";s:7:\"credit3\";s:19:\"预留积分类型3\";s:7:\"credit4\";s:19:\"预留积分类型4\";s:7:\"credit5\";s:19:\"预留积分类型5\";s:7:\"credit6\";s:19:\"预留积分类型6\";s:10:\"createtime\";s:12:\"加入时间\";s:8:\"password\";s:12:\"用户密码\";s:12:\"pay_password\";s:12:\"支付密码\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_receive_enable', 'a:3:{s:9:\"subscribe\";a:1:{i:0;s:9:\"fm_jiaoyu\";}s:11:\"unsubscribe\";a:1:{i:0;s:9:\"fm_jiaoyu\";}s:2:\"qr\";a:1:{i:0;s:9:\"fm_jiaoyu\";}}');
INSERT INTO `ims_core_cache` VALUES ('upgrade', 'a:3:{s:7:\"upgrade\";b:0;s:4:\"data\";a:5:{s:5:\"errno\";N;s:7:\"message\";s:14:\"发生错误: \";s:5:\"files\";a:0:{}s:7:\"schemas\";a:0:{}s:7:\"upgrade\";b:0;}s:10:\"lastupdate\";i:1586843351;}');
INSERT INTO `ims_core_cache` VALUES ('cloud:transtoken', 's:39:\"ce5ew4/QQR4hfDsfemOPqLYjHXA/8iL/H6BmmJs\";');
INSERT INTO `ims_core_cache` VALUES ('we7:uniaccount:1', 'a:21:{s:4:\"acid\";s:1:\"1\";s:7:\"uniacid\";s:1:\"1\";s:5:\"token\";s:32:\"omJNpZEhZeHj1ZxFECKkP48B5VFbk1HP\";s:14:\"encodingaeskey\";s:0:\"\";s:5:\"level\";s:1:\"1\";s:4:\"name\";s:6:\"飞鹰\";s:7:\"account\";s:0:\"\";s:8:\"original\";s:0:\"\";s:9:\"signature\";s:0:\"\";s:7:\"country\";s:0:\"\";s:8:\"province\";s:0:\"\";s:4:\"city\";s:0:\"\";s:8:\"username\";s:0:\"\";s:8:\"password\";s:0:\"\";s:10:\"lastupdate\";s:1:\"0\";s:3:\"key\";s:0:\"\";s:6:\"secret\";s:0:\"\";s:7:\"styleid\";s:1:\"1\";s:12:\"subscribeurl\";s:0:\"\";s:18:\"auth_refresh_token\";s:0:\"\";s:11:\"encrypt_key\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:unisetting:1', 'a:31:{s:7:\"uniacid\";s:1:\"1\";s:8:\"passport\";a:3:{s:8:\"focusreg\";i:0;s:4:\"item\";s:5:\"email\";s:4:\"type\";s:8:\"password\";}s:5:\"oauth\";s:0:\"\";s:11:\"jsauth_acid\";s:1:\"0\";s:2:\"uc\";s:23:\"a:1:{s:6:\"status\";i:0;}\";s:6:\"notify\";a:1:{s:3:\"sms\";a:2:{s:7:\"balance\";i:0;s:9:\"signature\";s:0:\"\";}}s:11:\"creditnames\";a:5:{s:7:\"credit1\";a:2:{s:5:\"title\";s:6:\"积分\";s:7:\"enabled\";i:1;}s:7:\"credit2\";a:2:{s:5:\"title\";s:6:\"余额\";s:7:\"enabled\";i:1;}s:7:\"credit3\";a:2:{s:5:\"title\";s:0:\"\";s:7:\"enabled\";i:0;}s:7:\"credit4\";a:2:{s:5:\"title\";s:0:\"\";s:7:\"enabled\";i:0;}s:7:\"credit5\";a:2:{s:5:\"title\";s:0:\"\";s:7:\"enabled\";i:0;}}s:15:\"creditbehaviors\";a:2:{s:8:\"activity\";s:7:\"credit1\";s:8:\"currency\";s:7:\"credit2\";}s:7:\"welcome\";s:0:\"\";s:7:\"default\";s:0:\"\";s:15:\"default_message\";s:0:\"\";s:7:\"payment\";a:4:{s:6:\"credit\";a:3:{s:6:\"switch\";b:0;s:15:\"recharge_switch\";b:0;s:10:\"pay_switch\";b:0;}s:6:\"alipay\";a:6:{s:6:\"switch\";b:0;s:7:\"account\";s:0:\"\";s:7:\"partner\";s:0:\"\";s:6:\"secret\";s:0:\"\";s:15:\"recharge_switch\";b:0;s:10:\"pay_switch\";b:0;}s:6:\"wechat\";a:7:{s:6:\"switch\";b:0;s:7:\"account\";b:0;s:7:\"signkey\";s:0:\"\";s:7:\"partner\";s:0:\"\";s:3:\"key\";s:0:\"\";s:15:\"recharge_switch\";b:0;s:10:\"pay_switch\";b:0;}s:8:\"delivery\";a:3:{s:6:\"switch\";b:0;s:15:\"recharge_switch\";b:0;s:10:\"pay_switch\";b:0;}}s:4:\"stat\";s:0:\"\";s:12:\"default_site\";s:1:\"1\";s:4:\"sync\";s:1:\"0\";s:8:\"recharge\";s:0:\"\";s:9:\"tplnotice\";s:0:\"\";s:10:\"grouplevel\";s:1:\"0\";s:8:\"mcplugin\";s:0:\"\";s:15:\"exchange_enable\";s:1:\"0\";s:11:\"coupon_type\";s:1:\"0\";s:7:\"menuset\";s:0:\"\";s:10:\"statistics\";s:0:\"\";s:11:\"bind_domain\";s:0:\"\";s:14:\"comment_status\";s:1:\"0\";s:13:\"reply_setting\";s:1:\"0\";s:14:\"default_module\";s:0:\"\";s:16:\"attachment_limit\";N;s:15:\"attachment_size\";N;s:11:\"sync_member\";s:1:\"0\";s:6:\"remote\";s:0:\"\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:user_accounts:wechats:1', 'a:1:{i:1;a:8:{s:4:\"acid\";s:1:\"1\";s:7:\"uniacid\";s:1:\"1\";s:4:\"name\";s:6:\"飞鹰\";s:4:\"type\";s:1:\"1\";s:5:\"level\";s:1:\"1\";s:3:\"key\";s:0:\"\";s:6:\"secret\";s:0:\"\";s:5:\"token\";s:32:\"omJNpZEhZeHj1ZxFECKkP48B5VFbk1HP\";}}');
INSERT INTO `ims_core_cache` VALUES ('we7:user_accounts:wxapp:1', 'a:0:{}');
INSERT INTO `ims_core_cache` VALUES ('we7:user_accounts:webapp:1', 'a:0:{}');
INSERT INTO `ims_core_cache` VALUES ('we7:user_accounts:phoneapp:1', 'a:0:{}');
INSERT INTO `ims_core_cache` VALUES ('we7:user_accounts:xzapp:1', 'a:0:{}');
INSERT INTO `ims_core_cache` VALUES ('we7:user_accounts:aliapp:1', 'a:0:{}');
INSERT INTO `ims_core_cache` VALUES ('we7:user_accounts:baiduapp:1', 'a:0:{}');
INSERT INTO `ims_core_cache` VALUES ('we7:user_accounts:toutiaoapp:1', 'a:0:{}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:fm_jiaoyu', 'a:36:{s:3:\"mid\";s:2:\"14\";s:4:\"name\";s:9:\"fm_jiaoyu\";s:4:\"type\";s:8:\"business\";s:5:\"title\";s:15:\"微教育平台\";s:7:\"version\";s:7:\"3.12.51\";s:7:\"ability\";s:120:\"教育行业通用模块，适用于培训学校，幼儿园，具备成绩查询，教师管理，课程安排等功能\";s:11:\"description\";s:120:\"教育行业通用模块，适用于培训学校，幼儿园，具备成绩查询，教师管理，课程安排等功能\";s:6:\"author\";s:15:\"飞鹰微教育\";s:3:\"url\";s:21:\"http://www.nyabc.net/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";a:4:{i:0;s:4:\"text\";i:1;s:9:\"subscribe\";i:2;s:11:\"unsubscribe\";i:3;s:2:\"qr\";}s:7:\"handles\";a:4:{i:0;s:4:\"text\";i:1;s:9:\"subscribe\";i:2;s:11:\"unsubscribe\";i:3;s:2:\"qr\";}s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"0\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"1\";s:11:\"permissions\";s:6:\"a:0:{}\";s:13:\"title_initial\";s:1:\"W\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"0\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"1\";s:10:\"oauth_type\";s:1:\"1\";s:16:\"phoneapp_support\";s:1:\"1\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"1\";s:14:\"aliapp_support\";s:1:\"1\";s:4:\"logo\";s:50:\"http://www.weixuexiao.me/addons/fm_jiaoyu/icon.jpg\";s:16:\"baiduapp_support\";s:1:\"1\";s:18:\"toutiaoapp_support\";s:1:\"1\";s:4:\"from\";s:5:\"local\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:73:\"http://www.weixuexiao.me/addons/fm_jiaoyu/preview-custom.jpg?v=1586844092\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:2:{i:0;s:24:\"fm_jiaoyu_plugin_bigdata\";i:1;s:21:\"fm_jiaoyu_plugin_sale\";}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:fm_jiaoyu_plugin_sale', 'a:37:{s:3:\"mid\";s:2:\"15\";s:4:\"name\";s:21:\"fm_jiaoyu_plugin_sale\";s:4:\"type\";s:3:\"biz\";s:5:\"title\";s:30:\"微教育培训营销插件包\";s:7:\"version\";s:6:\"1.0.19\";s:7:\"ability\";s:195:\"本插件需要配合微教育主程序使用，插件内容涵盖了培训课程推广员系统，其中包括课程团购系统，助力系统，分销系统以手机端课程销售管理系统\";s:11:\"description\";s:195:\"本插件需要配合微教育主程序使用，插件内容涵盖了培训课程推广员系统，其中包括课程团购系统，助力系统，分销系统以手机端课程销售管理系统\";s:6:\"author\";s:15:\"营销插件包\";s:3:\"url\";s:21:\"http://www.nyabc.net/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";a:0:{}s:7:\"handles\";a:1:{i:0;s:4:\"text\";}s:12:\"isrulefields\";s:1:\"0\";s:8:\"issystem\";s:1:\"0\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:6:\"a:0:{}\";s:13:\"title_initial\";s:1:\"W\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"0\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"1\";s:10:\"oauth_type\";s:1:\"1\";s:16:\"phoneapp_support\";s:1:\"1\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"1\";s:14:\"aliapp_support\";s:1:\"1\";s:4:\"logo\";s:62:\"http://www.weixuexiao.me/addons/fm_jiaoyu_plugin_sale/icon.jpg\";s:16:\"baiduapp_support\";s:1:\"1\";s:18:\"toutiaoapp_support\";s:1:\"1\";s:4:\"from\";s:5:\"local\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:78:\"http://www.weixuexiao.me/addons/fm_jiaoyu_plugin_sale/preview.jpg?v=1586844094\";s:11:\"main_module\";s:9:\"fm_jiaoyu\";s:16:\"main_module_logo\";s:50:\"http://www.weixuexiao.me/addons/fm_jiaoyu/icon.jpg\";s:17:\"main_module_title\";s:15:\"微教育平台\";s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:user_modules:1', 'a:2:{s:9:\"fm_jiaoyu\";s:3:\"all\";s:21:\"fm_jiaoyu_plugin_sale\";s:3:\"all\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:system_frame:1', 'a:21:{s:8:\"phoneapp\";a:7:{s:5:\"title\";s:3:\"APP\";s:4:\"icon\";s:18:\"wi wi-white-collar\";s:3:\"url\";s:41:\"./index.php?c=phoneapp&a=display&do=home&\";s:7:\"section\";a:2:{s:15:\"platform_module\";a:3:{s:5:\"title\";s:6:\"应用\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}s:16:\"phoneapp_profile\";a:4:{s:5:\"title\";s:6:\"配置\";s:4:\"menu\";a:2:{s:28:\"profile_phoneapp_module_link\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:1:{i:0;i:6;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"数据同步\";s:3:\"url\";s:42:\"./index.php?c=wxapp&a=module-link-uniacid&\";s:15:\"permission_name\";s:28:\"profile_phoneapp_module_link\";s:4:\"icon\";s:18:\"wi wi-data-synchro\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:14:\"front_download\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";b:1;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"下载APP\";s:3:\"url\";s:40:\"./index.php?c=phoneapp&a=front-download&\";s:15:\"permission_name\";s:23:\"phoneapp_front_download\";s:4:\"icon\";s:13:\"wi wi-examine\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:10:\"is_display\";b:1;s:18:\"permission_display\";a:1:{i:0;i:6;}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:0;s:12:\"displayorder\";i:0;}s:7:\"welcome\";a:7:{s:5:\"title\";s:6:\"首页\";s:4:\"icon\";s:10:\"wi wi-home\";s:3:\"url\";s:48:\"./index.php?c=home&a=welcome&do=system&page=home\";s:7:\"section\";a:0:{}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:2;}s:8:\"platform\";a:8:{s:5:\"title\";s:12:\"平台入口\";s:4:\"icon\";s:14:\"wi wi-platform\";s:9:\"dimension\";i:2;s:3:\"url\";s:44:\"./index.php?c=account&a=display&do=platform&\";s:7:\"section\";a:0:{}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:3;}s:6:\"module\";a:8:{s:5:\"title\";s:12:\"应用入口\";s:4:\"icon\";s:11:\"wi wi-apply\";s:9:\"dimension\";i:2;s:3:\"url\";s:53:\"./index.php?c=module&a=display&do=switch_last_module&\";s:7:\"section\";a:0:{}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:4;}s:14:\"account_manage\";a:8:{s:5:\"title\";s:12:\"平台管理\";s:4:\"icon\";s:21:\"wi wi-platform-manage\";s:9:\"dimension\";i:2;s:3:\"url\";s:31:\"./index.php?c=account&a=manage&\";s:7:\"section\";a:1:{s:14:\"account_manage\";a:2:{s:5:\"title\";s:12:\"平台管理\";s:4:\"menu\";a:4:{s:22:\"account_manage_display\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"平台列表\";s:3:\"url\";s:31:\"./index.php?c=account&a=manage&\";s:15:\"permission_name\";s:22:\"account_manage_display\";s:4:\"icon\";N;s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";a:1:{i:0;a:2:{s:5:\"title\";s:12:\"帐号停用\";s:15:\"permission_name\";s:19:\"account_manage_stop\";}}}s:22:\"account_manage_recycle\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"回收站\";s:3:\"url\";s:32:\"./index.php?c=account&a=recycle&\";s:15:\"permission_name\";s:22:\"account_manage_recycle\";s:4:\"icon\";N;s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{i:0;a:2:{s:5:\"title\";s:12:\"帐号删除\";s:15:\"permission_name\";s:21:\"account_manage_delete\";}i:1;a:2:{s:5:\"title\";s:12:\"帐号恢复\";s:15:\"permission_name\";s:22:\"account_manage_recover\";}}}s:30:\"account_manage_system_platform\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:19:\" 微信开放平台\";s:3:\"url\";s:32:\"./index.php?c=system&a=platform&\";s:15:\"permission_name\";s:30:\"account_manage_system_platform\";s:4:\"icon\";N;s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:30:\"account_manage_expired_message\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:22:\" 自定义到期提示\";s:3:\"url\";s:40:\"./index.php?c=account&a=expired-message&\";s:15:\"permission_name\";s:30:\"account_manage_expired_message\";s:4:\"icon\";N;s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:5;}s:13:\"module_manage\";a:8:{s:5:\"title\";s:12:\"应用管理\";s:4:\"icon\";s:19:\"wi wi-module-manage\";s:9:\"dimension\";i:2;s:3:\"url\";s:50:\"./index.php?c=module&a=manage-system&do=installed&\";s:7:\"section\";a:1:{s:13:\"module_manage\";a:2:{s:5:\"title\";s:12:\"应用管理\";s:4:\"menu\";a:6:{s:23:\"module_manage_installed\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"已安装列表\";s:3:\"url\";s:50:\"./index.php?c=module&a=manage-system&do=installed&\";s:15:\"permission_name\";s:23:\"module_manage_installed\";s:4:\"icon\";N;s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:20:\"module_manage_stoped\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"已停用列表\";s:3:\"url\";s:54:\"./index.php?c=module&a=manage-system&do=recycle&type=1\";s:15:\"permission_name\";s:20:\"module_manage_stoped\";s:4:\"icon\";N;s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:27:\"module_manage_not_installed\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"未安装列表\";s:3:\"url\";s:54:\"./index.php?c=module&a=manage-system&do=not_installed&\";s:15:\"permission_name\";s:27:\"module_manage_not_installed\";s:4:\"icon\";N;s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:21:\"module_manage_recycle\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"回收站\";s:3:\"url\";s:54:\"./index.php?c=module&a=manage-system&do=recycle&type=2\";s:15:\"permission_name\";s:21:\"module_manage_recycle\";s:4:\"icon\";N;s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:23:\"module_manage_subscribe\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"订阅管理\";s:3:\"url\";s:50:\"./index.php?c=module&a=manage-system&do=subscribe&\";s:15:\"permission_name\";s:23:\"module_manage_subscribe\";s:4:\"icon\";N;s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:20:\"module_manage_expire\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"应用停用提醒\";s:3:\"url\";s:30:\"./index.php?c=module&a=expire&\";s:15:\"permission_name\";s:20:\"module_manage_expire\";s:4:\"icon\";N;s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:6;}s:11:\"user_manage\";a:8:{s:5:\"title\";s:12:\"用户管理\";s:4:\"icon\";s:16:\"wi wi-user-group\";s:9:\"dimension\";i:2;s:3:\"url\";s:29:\"./index.php?c=user&a=display&\";s:7:\"section\";a:1:{s:11:\"user_manage\";a:2:{s:5:\"title\";s:12:\"用户管理\";s:4:\"menu\";a:6:{s:19:\"user_manage_display\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"普通用户\";s:3:\"url\";s:29:\"./index.php?c=user&a=display&\";s:15:\"permission_name\";s:19:\"user_manage_display\";s:4:\"icon\";N;s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:19:\"user_manage_founder\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"副站长\";s:3:\"url\";s:32:\"./index.php?c=founder&a=display&\";s:15:\"permission_name\";s:19:\"user_manage_founder\";s:4:\"icon\";N;s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:17:\"user_manage_clerk\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"店员管理\";s:3:\"url\";s:39:\"./index.php?c=user&a=display&type=clerk\";s:15:\"permission_name\";s:17:\"user_manage_clerk\";s:4:\"icon\";N;s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:17:\"user_manage_check\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"审核用户\";s:3:\"url\";s:39:\"./index.php?c=user&a=display&type=check\";s:15:\"permission_name\";s:17:\"user_manage_check\";s:4:\"icon\";N;s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:19:\"user_manage_recycle\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"回收站\";s:3:\"url\";s:41:\"./index.php?c=user&a=display&type=recycle\";s:15:\"permission_name\";s:19:\"user_manage_recycle\";s:4:\"icon\";N;s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:18:\"user_manage_fields\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"用户属性设置\";s:3:\"url\";s:39:\"./index.php?c=user&a=fields&do=display&\";s:15:\"permission_name\";s:18:\"user_manage_fields\";s:4:\"icon\";N;s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:7;}s:10:\"permission\";a:8:{s:5:\"title\";s:9:\"权限组\";s:4:\"icon\";s:22:\"wi wi-userjurisdiction\";s:9:\"dimension\";i:2;s:3:\"url\";s:29:\"./index.php?c=module&a=group&\";s:7:\"section\";a:1:{s:10:\"permission\";a:2:{s:5:\"title\";s:9:\"权限组\";s:4:\"menu\";a:4:{s:23:\"permission_module_group\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"应用权限组\";s:3:\"url\";s:29:\"./index.php?c=module&a=group&\";s:15:\"permission_name\";s:23:\"permission_module_group\";s:4:\"icon\";N;s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:31:\"permission_create_account_group\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"账号权限组\";s:3:\"url\";s:34:\"./index.php?c=user&a=create-group&\";s:15:\"permission_name\";s:31:\"permission_create_account_group\";s:4:\"icon\";N;s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:21:\"permission_user_group\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"用户权限组合\";s:3:\"url\";s:27:\"./index.php?c=user&a=group&\";s:15:\"permission_name\";s:21:\"permission_user_group\";s:4:\"icon\";N;s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}s:24:\"permission_founder_group\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:21:\"副站长权限组合\";s:3:\"url\";s:30:\"./index.php?c=founder&a=group&\";s:15:\"permission_name\";s:24:\"permission_founder_group\";s:4:\"icon\";N;s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:0:{}}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:8;}s:6:\"system\";a:8:{s:5:\"title\";s:12:\"系统功能\";s:4:\"icon\";s:13:\"wi wi-setting\";s:9:\"dimension\";i:3;s:3:\"url\";s:31:\"./index.php?c=article&a=notice&\";s:7:\"section\";a:5:{s:7:\"article\";a:3:{s:5:\"title\";s:12:\"站内公告\";s:4:\"menu\";a:1:{s:14:\"system_article\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"站内公告\";s:3:\"url\";s:31:\"./index.php?c=article&a=notice&\";s:15:\"permission_name\";s:14:\"system_article\";s:4:\"icon\";s:13:\"wi wi-article\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{i:0;a:2:{s:5:\"title\";s:12:\"公告列表\";s:15:\"permission_name\";s:26:\"system_article_notice_list\";}i:1;a:2:{s:5:\"title\";s:12:\"公告分类\";s:15:\"permission_name\";s:30:\"system_article_notice_category\";}}}}s:7:\"founder\";b:1;}s:15:\"system_template\";a:3:{s:5:\"title\";s:6:\"模板\";s:4:\"menu\";a:1:{s:15:\"system_template\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"微官网模板\";s:3:\"url\";s:32:\"./index.php?c=system&a=template&\";s:15:\"permission_name\";s:15:\"system_template\";s:4:\"icon\";s:17:\"wi wi-wx-template\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:7:\"founder\";b:1;}s:14:\"system_welcome\";a:3:{s:5:\"title\";s:12:\"系统首页\";s:4:\"menu\";a:2:{s:14:\"system_welcome\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"系统首页应用\";s:3:\"url\";s:60:\"./index.php?c=module&a=manage-system&support=welcome_support\";s:15:\"permission_name\";s:14:\"system_welcome\";s:4:\"icon\";s:20:\"wi wi-system-welcome\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:11:\"system_news\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"系统新闻\";s:3:\"url\";s:29:\"./index.php?c=article&a=news&\";s:15:\"permission_name\";s:11:\"system_news\";s:4:\"icon\";s:13:\"wi wi-article\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{i:0;a:2:{s:5:\"title\";s:13:\"新闻列表 \";s:15:\"permission_name\";s:24:\"system_article_news_list\";}i:1;a:2:{s:5:\"title\";s:13:\"新闻分类 \";s:15:\"permission_name\";s:28:\"system_article_news_category\";}}}}s:7:\"founder\";b:1;}s:17:\"system_statistics\";a:3:{s:5:\"title\";s:6:\"统计\";s:4:\"menu\";a:1:{s:23:\"system_account_analysis\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"访问统计\";s:3:\"url\";s:35:\"./index.php?c=statistics&a=account&\";s:15:\"permission_name\";s:23:\"system_account_analysis\";s:4:\"icon\";s:17:\"wi wi-statistical\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:7:\"founder\";b:1;}s:5:\"cache\";a:2:{s:5:\"title\";s:6:\"缓存\";s:4:\"menu\";a:1:{s:26:\"system_setting_updatecache\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"更新缓存\";s:3:\"url\";s:35:\"./index.php?c=system&a=updatecache&\";s:15:\"permission_name\";s:26:\"system_setting_updatecache\";s:4:\"icon\";s:12:\"wi wi-update\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:9;}s:4:\"site\";a:9:{s:5:\"title\";s:12:\"站点设置\";s:4:\"icon\";s:17:\"wi wi-system-site\";s:9:\"dimension\";i:3;s:3:\"url\";s:28:\"./index.php?c=system&a=site&\";s:7:\"section\";a:3:{s:7:\"setting\";a:2:{s:5:\"title\";s:6:\"设置\";s:4:\"menu\";a:9:{s:19:\"system_setting_site\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"站点设置\";s:3:\"url\";s:28:\"./index.php?c=system&a=site&\";s:15:\"permission_name\";s:19:\"system_setting_site\";s:4:\"icon\";s:18:\"wi wi-site-setting\";s:12:\"displayorder\";i:9;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"system_setting_menu\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"菜单设置\";s:3:\"url\";s:28:\"./index.php?c=system&a=menu&\";s:15:\"permission_name\";s:19:\"system_setting_menu\";s:4:\"icon\";s:18:\"wi wi-menu-setting\";s:12:\"displayorder\";i:8;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:25:\"system_setting_attachment\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"附件设置\";s:3:\"url\";s:34:\"./index.php?c=system&a=attachment&\";s:15:\"permission_name\";s:25:\"system_setting_attachment\";s:4:\"icon\";s:16:\"wi wi-attachment\";s:12:\"displayorder\";i:7;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:25:\"system_setting_systeminfo\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"系统信息\";s:3:\"url\";s:34:\"./index.php?c=system&a=systeminfo&\";s:15:\"permission_name\";s:25:\"system_setting_systeminfo\";s:4:\"icon\";s:17:\"wi wi-system-info\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"system_setting_logs\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"查看日志\";s:3:\"url\";s:28:\"./index.php?c=system&a=logs&\";s:15:\"permission_name\";s:19:\"system_setting_logs\";s:4:\"icon\";s:9:\"wi wi-log\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:26:\"system_setting_ipwhitelist\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:11:\"IP白名单\";s:3:\"url\";s:35:\"./index.php?c=system&a=ipwhitelist&\";s:15:\"permission_name\";s:26:\"system_setting_ipwhitelist\";s:4:\"icon\";s:8:\"wi wi-ip\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:28:\"system_setting_sensitiveword\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"过滤敏感词\";s:3:\"url\";s:37:\"./index.php?c=system&a=sensitiveword&\";s:15:\"permission_name\";s:28:\"system_setting_sensitiveword\";s:4:\"icon\";s:15:\"wi wi-sensitive\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:25:\"system_setting_thirdlogin\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:25:\"用户登录/注册设置\";s:3:\"url\";s:33:\"./index.php?c=user&a=registerset&\";s:15:\"permission_name\";s:25:\"system_setting_thirdlogin\";s:4:\"icon\";s:10:\"wi wi-user\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:20:\"system_setting_oauth\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"全局借用权限\";s:3:\"url\";s:29:\"./index.php?c=system&a=oauth&\";s:15:\"permission_name\";s:20:\"system_setting_oauth\";s:4:\"icon\";s:11:\"wi wi-oauth\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:7:\"utility\";a:2:{s:5:\"title\";s:12:\"常用工具\";s:4:\"menu\";a:6:{s:24:\"system_utility_filecheck\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"系统文件校验\";s:3:\"url\";s:33:\"./index.php?c=system&a=filecheck&\";s:15:\"permission_name\";s:24:\"system_utility_filecheck\";s:4:\"icon\";s:10:\"wi wi-file\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:23:\"system_utility_optimize\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"性能优化\";s:3:\"url\";s:32:\"./index.php?c=system&a=optimize&\";s:15:\"permission_name\";s:23:\"system_utility_optimize\";s:4:\"icon\";s:14:\"wi wi-optimize\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:23:\"system_utility_database\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:9:\"数据库\";s:3:\"url\";s:32:\"./index.php?c=system&a=database&\";s:15:\"permission_name\";s:23:\"system_utility_database\";s:4:\"icon\";s:9:\"wi wi-sql\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"system_utility_scan\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"木马查杀\";s:3:\"url\";s:28:\"./index.php?c=system&a=scan&\";s:15:\"permission_name\";s:19:\"system_utility_scan\";s:4:\"icon\";s:12:\"wi wi-safety\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:18:\"system_utility_bom\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"检测文件BOM\";s:3:\"url\";s:27:\"./index.php?c=system&a=bom&\";s:15:\"permission_name\";s:18:\"system_utility_bom\";s:4:\"icon\";s:9:\"wi wi-bom\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:20:\"system_utility_check\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"系统常规检测\";s:3:\"url\";s:29:\"./index.php?c=system&a=check&\";s:15:\"permission_name\";s:20:\"system_utility_check\";s:4:\"icon\";s:9:\"wi wi-bom\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:7:\"backjob\";a:2:{s:5:\"title\";s:12:\"后台任务\";s:4:\"menu\";a:1:{s:10:\"system_job\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"后台任务\";s:3:\"url\";s:38:\"./index.php?c=system&a=job&do=display&\";s:15:\"permission_name\";s:10:\"system_job\";s:4:\"icon\";s:9:\"wi wi-job\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:7:\"founder\";b:1;s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:10;}s:6:\"myself\";a:8:{s:5:\"title\";s:12:\"我的账户\";s:4:\"icon\";s:10:\"wi wi-bell\";s:9:\"dimension\";i:2;s:3:\"url\";s:29:\"./index.php?c=user&a=profile&\";s:7:\"section\";a:0:{}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:11;}s:7:\"message\";a:8:{s:5:\"title\";s:12:\"消息管理\";s:4:\"icon\";s:10:\"wi wi-bell\";s:9:\"dimension\";i:2;s:3:\"url\";s:31:\"./index.php?c=message&a=notice&\";s:7:\"section\";a:1:{s:7:\"message\";a:2:{s:5:\"title\";s:12:\"消息管理\";s:4:\"menu\";a:3:{s:14:\"message_notice\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"消息提醒\";s:3:\"url\";s:31:\"./index.php?c=message&a=notice&\";s:15:\"permission_name\";s:14:\"message_notice\";s:4:\"icon\";N;s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:15:\"message_setting\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"消息设置\";s:3:\"url\";s:42:\"./index.php?c=message&a=notice&do=setting&\";s:15:\"permission_name\";s:15:\"message_setting\";s:4:\"icon\";N;s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:22:\"message_wechat_setting\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"微信提醒设置\";s:3:\"url\";s:49:\"./index.php?c=message&a=notice&do=wechat_setting&\";s:15:\"permission_name\";s:22:\"message_wechat_setting\";s:4:\"icon\";N;s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:12;}s:7:\"account\";a:8:{s:5:\"title\";s:9:\"公众号\";s:4:\"icon\";s:18:\"wi wi-white-collar\";s:9:\"dimension\";i:3;s:3:\"url\";s:41:\"./index.php?c=home&a=welcome&do=platform&\";s:7:\"section\";a:5:{s:8:\"platform\";a:3:{s:5:\"title\";s:12:\"增强功能\";s:4:\"menu\";a:6:{s:14:\"platform_reply\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"自动回复\";s:3:\"url\";s:31:\"./index.php?c=platform&a=reply&\";s:15:\"permission_name\";s:14:\"platform_reply\";s:4:\"icon\";s:11:\"wi wi-reply\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";a:7:{s:22:\"platform_reply_keyword\";a:4:{s:5:\"title\";s:21:\"关键字自动回复\";s:3:\"url\";s:40:\"./index.php?c=platform&a=reply&m=keyword\";s:15:\"permission_name\";s:22:\"platform_reply_keyword\";s:6:\"active\";s:7:\"keyword\";}s:22:\"platform_reply_special\";a:4:{s:5:\"title\";s:24:\"非关键字自动回复\";s:3:\"url\";s:40:\"./index.php?c=platform&a=reply&m=special\";s:15:\"permission_name\";s:22:\"platform_reply_special\";s:6:\"active\";s:7:\"special\";}s:22:\"platform_reply_welcome\";a:4:{s:5:\"title\";s:24:\"首次访问自动回复\";s:3:\"url\";s:40:\"./index.php?c=platform&a=reply&m=welcome\";s:15:\"permission_name\";s:22:\"platform_reply_welcome\";s:6:\"active\";s:7:\"welcome\";}s:22:\"platform_reply_default\";a:4:{s:5:\"title\";s:12:\"默认回复\";s:3:\"url\";s:40:\"./index.php?c=platform&a=reply&m=default\";s:15:\"permission_name\";s:22:\"platform_reply_default\";s:6:\"active\";s:7:\"default\";}s:22:\"platform_reply_service\";a:4:{s:5:\"title\";s:12:\"常用服务\";s:3:\"url\";s:40:\"./index.php?c=platform&a=reply&m=service\";s:15:\"permission_name\";s:22:\"platform_reply_service\";s:6:\"active\";s:7:\"service\";}s:22:\"platform_reply_userapi\";a:5:{s:5:\"title\";s:21:\"自定义接口回复\";s:3:\"url\";s:40:\"./index.php?c=platform&a=reply&m=userapi\";s:15:\"permission_name\";s:22:\"platform_reply_userapi\";s:6:\"active\";s:7:\"userapi\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:22:\"platform_reply_setting\";a:4:{s:5:\"title\";s:12:\"回复设置\";s:3:\"url\";s:38:\"./index.php?c=profile&a=reply-setting&\";s:15:\"permission_name\";s:22:\"platform_reply_setting\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}}}s:13:\"platform_menu\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"自定义菜单\";s:3:\"url\";s:38:\"./index.php?c=platform&a=menu&do=post&\";s:15:\"permission_name\";s:13:\"platform_menu\";s:4:\"icon\";s:16:\"wi wi-custommenu\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{s:21:\"platform_menu_default\";a:4:{s:5:\"title\";s:12:\"默认菜单\";s:3:\"url\";s:38:\"./index.php?c=platform&a=menu&do=post&\";s:15:\"permission_name\";s:21:\"platform_menu_default\";s:6:\"active\";s:4:\"post\";}s:25:\"platform_menu_conditional\";a:5:{s:5:\"title\";s:15:\"个性化菜单\";s:3:\"url\";s:47:\"./index.php?c=platform&a=menu&do=display&type=3\";s:15:\"permission_name\";s:25:\"platform_menu_conditional\";s:6:\"active\";s:7:\"display\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}}}s:11:\"platform_qr\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:2:{i:0;i:1;i:1;i:3;}s:10:\"is_display\";i:1;s:5:\"title\";s:22:\"二维码/转化链接\";s:3:\"url\";s:28:\"./index.php?c=platform&a=qr&\";s:15:\"permission_name\";s:11:\"platform_qr\";s:4:\"icon\";s:12:\"wi wi-qrcode\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{s:14:\"platform_qr_qr\";a:4:{s:5:\"title\";s:9:\"二维码\";s:3:\"url\";s:36:\"./index.php?c=platform&a=qr&do=list&\";s:15:\"permission_name\";s:14:\"platform_qr_qr\";s:6:\"active\";s:4:\"list\";}s:22:\"platform_qr_statistics\";a:4:{s:5:\"title\";s:21:\"二维码扫描统计\";s:3:\"url\";s:39:\"./index.php?c=platform&a=qr&do=display&\";s:15:\"permission_name\";s:22:\"platform_qr_statistics\";s:6:\"active\";s:7:\"display\";}}}s:17:\"platform_masstask\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"定时群发\";s:3:\"url\";s:30:\"./index.php?c=platform&a=mass&\";s:15:\"permission_name\";s:17:\"platform_masstask\";s:4:\"icon\";s:13:\"wi wi-crontab\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{s:22:\"platform_masstask_post\";a:4:{s:5:\"title\";s:12:\"定时群发\";s:3:\"url\";s:38:\"./index.php?c=platform&a=mass&do=post&\";s:15:\"permission_name\";s:22:\"platform_masstask_post\";s:6:\"active\";s:4:\"post\";}s:22:\"platform_masstask_send\";a:4:{s:5:\"title\";s:12:\"群发记录\";s:3:\"url\";s:38:\"./index.php?c=platform&a=mass&do=send&\";s:15:\"permission_name\";s:22:\"platform_masstask_send\";s:6:\"active\";s:4:\"send\";}}}s:17:\"platform_material\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:1;s:5:\"title\";s:16:\"素材/编辑器\";s:3:\"url\";s:34:\"./index.php?c=platform&a=material&\";s:15:\"permission_name\";s:17:\"platform_material\";s:4:\"icon\";s:12:\"wi wi-redact\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:5:{s:22:\"platform_material_news\";a:4:{s:5:\"title\";s:6:\"图文\";s:3:\"url\";s:43:\"./index.php?c=platform&a=material&type=news\";s:15:\"permission_name\";s:22:\"platform_material_news\";s:6:\"active\";s:4:\"news\";}s:23:\"platform_material_image\";a:4:{s:5:\"title\";s:6:\"图片\";s:3:\"url\";s:44:\"./index.php?c=platform&a=material&type=image\";s:15:\"permission_name\";s:23:\"platform_material_image\";s:6:\"active\";s:5:\"image\";}s:23:\"platform_material_voice\";a:4:{s:5:\"title\";s:6:\"语音\";s:3:\"url\";s:44:\"./index.php?c=platform&a=material&type=voice\";s:15:\"permission_name\";s:23:\"platform_material_voice\";s:6:\"active\";s:5:\"voice\";}s:23:\"platform_material_video\";a:5:{s:5:\"title\";s:6:\"视频\";s:3:\"url\";s:44:\"./index.php?c=platform&a=material&type=video\";s:15:\"permission_name\";s:23:\"platform_material_video\";s:6:\"active\";s:5:\"video\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:24:\"platform_material_delete\";a:3:{s:5:\"title\";s:6:\"删除\";s:15:\"permission_name\";s:24:\"platform_material_delete\";s:10:\"is_display\";b:0;}}}s:13:\"platform_site\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:2:{i:0;i:1;i:1;i:3;}s:10:\"is_display\";i:1;s:5:\"title\";s:16:\"微官网-文章\";s:3:\"url\";s:27:\"./index.php?c=site&a=multi&\";s:15:\"permission_name\";s:13:\"platform_site\";s:4:\"icon\";s:10:\"wi wi-home\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:4:{s:19:\"platform_site_multi\";a:4:{s:5:\"title\";s:9:\"微官网\";s:3:\"url\";s:38:\"./index.php?c=site&a=multi&do=display&\";s:15:\"permission_name\";s:19:\"platform_site_multi\";s:6:\"active\";s:5:\"multi\";}s:19:\"platform_site_style\";a:4:{s:5:\"title\";s:15:\"微官网模板\";s:3:\"url\";s:39:\"./index.php?c=site&a=style&do=template&\";s:15:\"permission_name\";s:19:\"platform_site_style\";s:6:\"active\";s:5:\"style\";}s:21:\"platform_site_article\";a:4:{s:5:\"title\";s:12:\"文章管理\";s:3:\"url\";s:40:\"./index.php?c=site&a=article&do=display&\";s:15:\"permission_name\";s:21:\"platform_site_article\";s:6:\"active\";s:7:\"article\";}s:22:\"platform_site_category\";a:4:{s:5:\"title\";s:18:\"文章分类管理\";s:3:\"url\";s:41:\"./index.php?c=site&a=category&do=display&\";s:15:\"permission_name\";s:22:\"platform_site_category\";s:6:\"active\";s:8:\"category\";}}}}s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}}s:15:\"platform_module\";a:3:{s:5:\"title\";s:12:\"应用模块\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}s:2:\"mc\";a:3:{s:5:\"title\";s:6:\"粉丝\";s:4:\"menu\";a:3:{s:7:\"mc_fans\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"粉丝管理\";s:3:\"url\";s:24:\"./index.php?c=mc&a=fans&\";s:15:\"permission_name\";s:7:\"mc_fans\";s:4:\"icon\";s:16:\"wi wi-fansmanage\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{s:15:\"mc_fans_display\";a:4:{s:5:\"title\";s:12:\"全部粉丝\";s:3:\"url\";s:35:\"./index.php?c=mc&a=fans&do=display&\";s:15:\"permission_name\";s:15:\"mc_fans_display\";s:6:\"active\";s:7:\"display\";}s:21:\"mc_fans_fans_sync_set\";a:4:{s:5:\"title\";s:18:\"粉丝同步设置\";s:3:\"url\";s:41:\"./index.php?c=mc&a=fans&do=fans_sync_set&\";s:15:\"permission_name\";s:21:\"mc_fans_fans_sync_set\";s:6:\"active\";s:13:\"fans_sync_set\";}}}s:9:\"mc_member\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:5:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;i:4;i:5;}s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"会员管理\";s:3:\"url\";s:26:\"./index.php?c=mc&a=member&\";s:15:\"permission_name\";s:9:\"mc_member\";s:4:\"icon\";s:10:\"wi wi-fans\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:7:{s:17:\"mc_member_diaplsy\";a:4:{s:5:\"title\";s:12:\"会员管理\";s:3:\"url\";s:37:\"./index.php?c=mc&a=member&do=display&\";s:15:\"permission_name\";s:17:\"mc_member_diaplsy\";s:6:\"active\";s:7:\"display\";}s:15:\"mc_member_group\";a:4:{s:5:\"title\";s:9:\"会员组\";s:3:\"url\";s:36:\"./index.php?c=mc&a=group&do=display&\";s:15:\"permission_name\";s:15:\"mc_member_group\";s:6:\"active\";s:7:\"display\";}s:12:\"mc_member_uc\";a:5:{s:5:\"title\";s:12:\"会员中心\";s:3:\"url\";s:34:\"./index.php?c=site&a=editor&do=uc&\";s:15:\"permission_name\";s:12:\"mc_member_uc\";s:6:\"active\";s:2:\"uc\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:19:\"mc_member_quickmenu\";a:5:{s:5:\"title\";s:12:\"快捷菜单\";s:3:\"url\";s:41:\"./index.php?c=site&a=editor&do=quickmenu&\";s:15:\"permission_name\";s:19:\"mc_member_quickmenu\";s:6:\"active\";s:9:\"quickmenu\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:25:\"mc_member_register_seting\";a:5:{s:5:\"title\";s:12:\"注册设置\";s:3:\"url\";s:46:\"./index.php?c=mc&a=member&do=register_setting&\";s:15:\"permission_name\";s:25:\"mc_member_register_seting\";s:6:\"active\";s:16:\"register_setting\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:24:\"mc_member_credit_setting\";a:4:{s:5:\"title\";s:12:\"积分设置\";s:3:\"url\";s:44:\"./index.php?c=mc&a=member&do=credit_setting&\";s:15:\"permission_name\";s:24:\"mc_member_credit_setting\";s:6:\"active\";s:14:\"credit_setting\";}s:16:\"mc_member_fields\";a:4:{s:5:\"title\";s:18:\"会员字段管理\";s:3:\"url\";s:34:\"./index.php?c=mc&a=fields&do=list&\";s:15:\"permission_name\";s:16:\"mc_member_fields\";s:6:\"active\";s:4:\"list\";}}}s:10:\"mc_message\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"留言管理\";s:3:\"url\";s:27:\"./index.php?c=mc&a=message&\";s:15:\"permission_name\";s:10:\"mc_message\";s:4:\"icon\";s:13:\"wi wi-message\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:18:\"permission_display\";a:5:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;i:4;i:5;}}s:7:\"profile\";a:3:{s:5:\"title\";s:6:\"配置\";s:4:\"menu\";a:7:{s:15:\"profile_setting\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:5:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;i:4;i:5;}s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"参数配置\";s:3:\"url\";s:31:\"./index.php?c=profile&a=remote&\";s:15:\"permission_name\";s:15:\"profile_setting\";s:4:\"icon\";s:23:\"wi wi-parameter-setting\";s:12:\"displayorder\";i:7;s:2:\"id\";N;s:14:\"sub_permission\";a:5:{s:22:\"profile_setting_remote\";a:4:{s:5:\"title\";s:12:\"远程附件\";s:3:\"url\";s:42:\"./index.php?c=profile&a=remote&do=display&\";s:15:\"permission_name\";s:22:\"profile_setting_remote\";s:6:\"active\";s:7:\"display\";}s:24:\"profile_setting_passport\";a:5:{s:5:\"title\";s:12:\"借用权限\";s:3:\"url\";s:42:\"./index.php?c=profile&a=passport&do=oauth&\";s:15:\"permission_name\";s:24:\"profile_setting_passport\";s:6:\"active\";s:5:\"oauth\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:25:\"profile_setting_tplnotice\";a:5:{s:5:\"title\";s:18:\"微信通知设置\";s:3:\"url\";s:42:\"./index.php?c=profile&a=tplnotice&do=list&\";s:15:\"permission_name\";s:25:\"profile_setting_tplnotice\";s:6:\"active\";s:4:\"list\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:22:\"profile_setting_notify\";a:5:{s:5:\"title\";s:18:\"邮件通知参数\";s:3:\"url\";s:39:\"./index.php?c=profile&a=notify&do=mail&\";s:15:\"permission_name\";s:22:\"profile_setting_notify\";s:6:\"active\";s:4:\"mail\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}s:27:\"profile_setting_upload_file\";a:5:{s:5:\"title\";s:20:\"上传JS接口文件\";s:3:\"url\";s:46:\"./index.php?c=profile&a=common&do=upload_file&\";s:15:\"permission_name\";s:27:\"profile_setting_upload_file\";s:6:\"active\";s:11:\"upload_file\";s:10:\"is_display\";a:2:{i:0;i:1;i:1;i:3;}}}}s:15:\"profile_payment\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:2:{i:0;i:1;i:1;i:3;}s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"支付参数\";s:3:\"url\";s:32:\"./index.php?c=profile&a=payment&\";s:15:\"permission_name\";s:15:\"profile_payment\";s:4:\"icon\";s:17:\"wi wi-pay-setting\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{s:19:\"profile_payment_pay\";a:4:{s:5:\"title\";s:12:\"支付配置\";s:3:\"url\";s:32:\"./index.php?c=profile&a=payment&\";s:15:\"permission_name\";s:19:\"profile_payment_pay\";s:6:\"active\";s:7:\"payment\";}s:22:\"profile_payment_refund\";a:4:{s:5:\"title\";s:12:\"退款配置\";s:3:\"url\";s:42:\"./index.php?c=profile&a=refund&do=display&\";s:15:\"permission_name\";s:22:\"profile_payment_refund\";s:6:\"active\";s:6:\"refund\";}}}s:23:\"profile_app_module_link\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"数据同步\";s:3:\"url\";s:44:\"./index.php?c=profile&a=module-link-uniacid&\";s:15:\"permission_name\";s:31:\"profile_app_module_link_uniacid\";s:4:\"icon\";s:18:\"wi wi-data-synchro\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"profile_bind_domain\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"域名绑定\";s:3:\"url\";s:36:\"./index.php?c=profile&a=bind-domain&\";s:15:\"permission_name\";s:19:\"profile_bind_domain\";s:4:\"icon\";s:17:\"wi wi-bind-domain\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:18:\"webapp_module_link\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:1:{i:0;i:5;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"数据同步\";s:3:\"url\";s:44:\"./index.php?c=profile&a=module-link-uniacid&\";s:15:\"permission_name\";s:18:\"webapp_module_link\";s:4:\"icon\";s:18:\"wi wi-data-synchro\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:14:\"webapp_rewrite\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:1:{i:0;i:5;}s:10:\"is_display\";i:0;s:5:\"title\";s:9:\"伪静态\";s:3:\"url\";s:31:\"./index.php?c=webapp&a=rewrite&\";s:15:\"permission_name\";s:14:\"webapp_rewrite\";s:4:\"icon\";s:13:\"wi wi-rewrite\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:18:\"webapp_bind_domain\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:1:{i:0;i:5;}s:10:\"is_display\";i:0;s:5:\"title\";s:18:\"域名访问设置\";s:3:\"url\";s:35:\"./index.php?c=webapp&a=bind-domain&\";s:15:\"permission_name\";s:18:\"webapp_bind_domain\";s:4:\"icon\";s:17:\"wi wi-bind-domain\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:18:\"permission_display\";a:5:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;i:4;i:5;}}s:10:\"statistics\";a:3:{s:5:\"title\";s:6:\"统计\";s:4:\"menu\";a:2:{s:16:\"statistics_visit\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:5:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;i:4;i:5;}s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"访问统计\";s:3:\"url\";s:31:\"./index.php?c=statistics&a=app&\";s:15:\"permission_name\";s:16:\"statistics_visit\";s:4:\"icon\";s:17:\"wi wi-statistical\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:3:{s:20:\"statistics_visit_app\";a:4:{s:5:\"title\";s:24:\"app端访问统计信息\";s:3:\"url\";s:42:\"./index.php?c=statistics&a=app&do=display&\";s:15:\"permission_name\";s:20:\"statistics_visit_app\";s:6:\"active\";s:3:\"app\";}s:21:\"statistics_visit_site\";a:4:{s:5:\"title\";s:24:\"所有用户访问统计\";s:3:\"url\";s:51:\"./index.php?c=statistics&a=site&do=current_account&\";s:15:\"permission_name\";s:21:\"statistics_visit_site\";s:6:\"active\";s:4:\"site\";}s:24:\"statistics_visit_setting\";a:4:{s:5:\"title\";s:18:\"访问统计设置\";s:3:\"url\";s:46:\"./index.php?c=statistics&a=setting&do=display&\";s:15:\"permission_name\";s:24:\"statistics_visit_setting\";s:6:\"active\";s:7:\"setting\";}}}s:15:\"statistics_fans\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:4:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;}s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"用户统计\";s:3:\"url\";s:32:\"./index.php?c=statistics&a=fans&\";s:15:\"permission_name\";s:15:\"statistics_fans\";s:4:\"icon\";s:17:\"wi wi-statistical\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:18:\"permission_display\";a:5:{i:0;i:1;i:1;i:3;i:2;i:9;i:3;i:10;i:4;i:5;}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:13;}s:5:\"wxapp\";a:8:{s:5:\"title\";s:15:\"微信小程序\";s:4:\"icon\";s:19:\"wi wi-small-routine\";s:9:\"dimension\";i:3;s:3:\"url\";s:38:\"./index.php?c=wxapp&a=display&do=home&\";s:7:\"section\";a:5:{s:14:\"wxapp_entrance\";a:4:{s:5:\"title\";s:15:\"小程序入口\";s:4:\"menu\";a:1:{s:20:\"module_entrance_link\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"入口页面\";s:3:\"url\";s:36:\"./index.php?c=wxapp&a=entrance-link&\";s:15:\"permission_name\";s:19:\"wxapp_entrance_link\";s:4:\"icon\";s:18:\"wi wi-data-synchro\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;}s:15:\"platform_module\";a:3:{s:5:\"title\";s:6:\"应用\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}s:2:\"mc\";a:4:{s:5:\"title\";s:6:\"粉丝\";s:4:\"menu\";a:1:{s:9:\"mc_member\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;s:5:\"title\";s:6:\"会员\";s:3:\"url\";s:26:\"./index.php?c=mc&a=member&\";s:15:\"permission_name\";s:15:\"mc_wxapp_member\";s:4:\"icon\";s:10:\"wi wi-fans\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";a:4:{s:17:\"mc_member_diaplsy\";a:4:{s:5:\"title\";s:12:\"会员管理\";s:3:\"url\";s:37:\"./index.php?c=mc&a=member&do=display&\";s:15:\"permission_name\";s:17:\"mc_member_diaplsy\";s:6:\"active\";s:7:\"display\";}s:15:\"mc_member_group\";a:4:{s:5:\"title\";s:9:\"会员组\";s:3:\"url\";s:36:\"./index.php?c=mc&a=group&do=display&\";s:15:\"permission_name\";s:15:\"mc_member_group\";s:6:\"active\";s:7:\"display\";}s:24:\"mc_member_credit_setting\";a:4:{s:5:\"title\";s:12:\"积分设置\";s:3:\"url\";s:44:\"./index.php?c=mc&a=member&do=credit_setting&\";s:15:\"permission_name\";s:24:\"mc_member_credit_setting\";s:6:\"active\";s:14:\"credit_setting\";}s:16:\"mc_member_fields\";a:4:{s:5:\"title\";s:18:\"会员字段管理\";s:3:\"url\";s:34:\"./index.php?c=mc&a=fields&do=list&\";s:15:\"permission_name\";s:16:\"mc_member_fields\";s:6:\"active\";s:4:\"list\";}}}}s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;}s:13:\"wxapp_profile\";a:3:{s:5:\"title\";s:6:\"配置\";s:4:\"menu\";a:5:{s:33:\"wxapp_profile_module_link_uniacid\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:7:{i:0;i:4;i:1;i:7;i:2;i:8;i:3;i:6;i:4;i:11;i:5;i:12;i:6;i:13;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"数据同步\";s:3:\"url\";s:42:\"./index.php?c=wxapp&a=module-link-uniacid&\";s:15:\"permission_name\";s:33:\"wxapp_profile_module_link_uniacid\";s:4:\"icon\";s:18:\"wi wi-data-synchro\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:21:\"wxapp_profile_payment\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"支付参数\";s:3:\"url\";s:30:\"./index.php?c=wxapp&a=payment&\";s:15:\"permission_name\";s:21:\"wxapp_profile_payment\";s:4:\"icon\";s:16:\"wi wi-appsetting\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";a:2:{s:17:\"wxapp_payment_pay\";a:4:{s:5:\"title\";s:12:\"支付参数\";s:3:\"url\";s:41:\"./index.php?c=wxapp&a=payment&do=display&\";s:15:\"permission_name\";s:17:\"wxapp_payment_pay\";s:6:\"active\";s:7:\"payment\";}s:20:\"wxapp_payment_refund\";a:4:{s:5:\"title\";s:12:\"退款配置\";s:3:\"url\";s:40:\"./index.php?c=wxapp&a=refund&do=display&\";s:15:\"permission_name\";s:20:\"wxapp_payment_refund\";s:6:\"active\";s:6:\"refund\";}}}s:28:\"wxapp_profile_front_download\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";i:1;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"下载程序包\";s:3:\"url\";s:37:\"./index.php?c=wxapp&a=front-download&\";s:15:\"permission_name\";s:28:\"wxapp_profile_front_download\";s:4:\"icon\";s:13:\"wi wi-examine\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:23:\"wxapp_profile_domainset\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"域名设置\";s:3:\"url\";s:32:\"./index.php?c=wxapp&a=domainset&\";s:15:\"permission_name\";s:23:\"wxapp_profile_domainset\";s:4:\"icon\";s:13:\"wi wi-examine\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:22:\"profile_setting_remote\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:7:{i:0;i:4;i:1;i:7;i:2;i:8;i:3;i:6;i:4;i:11;i:5;i:12;i:6;i:13;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"参数配置\";s:3:\"url\";s:31:\"./index.php?c=profile&a=remote&\";s:15:\"permission_name\";s:22:\"profile_setting_remote\";s:4:\"icon\";s:23:\"wi wi-parameter-setting\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:18:\"permission_display\";a:7:{i:0;i:4;i:1;i:7;i:2;i:8;i:3;i:6;i:4;i:11;i:5;i:12;i:6;i:13;}}s:10:\"statistics\";a:4:{s:5:\"title\";s:6:\"统计\";s:4:\"menu\";a:2:{s:16:\"statistics_visit\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:7:{i:0;i:4;i:1;i:7;i:2;i:8;i:3;i:6;i:4;i:11;i:5;i:12;i:6;i:13;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"访问统计\";s:3:\"url\";s:31:\"./index.php?c=statistics&a=app&\";s:15:\"permission_name\";s:22:\"statistics_visit_wxapp\";s:4:\"icon\";s:17:\"wi wi-statistical\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";a:3:{s:20:\"statistics_visit_app\";a:4:{s:5:\"title\";s:24:\"app端访问统计信息\";s:3:\"url\";s:42:\"./index.php?c=statistics&a=app&do=display&\";s:15:\"permission_name\";s:20:\"statistics_visit_app\";s:6:\"active\";s:3:\"app\";}s:21:\"statistics_visit_site\";a:4:{s:5:\"title\";s:24:\"所有用户访问统计\";s:3:\"url\";s:51:\"./index.php?c=statistics&a=site&do=current_account&\";s:15:\"permission_name\";s:21:\"statistics_visit_site\";s:6:\"active\";s:4:\"site\";}s:24:\"statistics_visit_setting\";a:4:{s:5:\"title\";s:18:\"访问统计设置\";s:3:\"url\";s:46:\"./index.php?c=statistics&a=setting&do=display&\";s:15:\"permission_name\";s:24:\"statistics_visit_setting\";s:6:\"active\";s:7:\"setting\";}}}s:15:\"statistics_fans\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";a:3:{i:0;i:4;i:1;i:7;i:2;i:8;}s:10:\"is_display\";i:0;s:5:\"title\";s:12:\"用户统计\";s:3:\"url\";s:33:\"./index.php?c=wxapp&a=statistics&\";s:15:\"permission_name\";s:21:\"statistics_fans_wxapp\";s:4:\"icon\";s:17:\"wi wi-statistical\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}s:18:\"permission_display\";a:7:{i:0;i:4;i:1;i:7;i:2;i:8;i:3;i:6;i:4;i:11;i:5;i:12;i:6;i:13;}s:10:\"is_display\";i:0;}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:14;}s:6:\"webapp\";a:7:{s:5:\"title\";s:2:\"PC\";s:4:\"icon\";s:8:\"wi wi-pc\";s:3:\"url\";s:39:\"./index.php?c=webapp&a=home&do=display&\";s:7:\"section\";a:0:{}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:15;}s:5:\"xzapp\";a:7:{s:5:\"title\";s:9:\"熊掌号\";s:4:\"icon\";s:11:\"wi wi-xzapp\";s:3:\"url\";s:38:\"./index.php?c=xzapp&a=home&do=display&\";s:7:\"section\";a:1:{s:15:\"platform_module\";a:3:{s:5:\"title\";s:12:\"应用模块\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:16;}s:6:\"aliapp\";a:7:{s:5:\"title\";s:18:\"支付宝小程序\";s:4:\"icon\";s:12:\"wi wi-aliapp\";s:3:\"url\";s:40:\"./index.php?c=miniapp&a=display&do=home&\";s:7:\"section\";a:1:{s:15:\"platform_module\";a:3:{s:5:\"title\";s:6:\"应用\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:17;}s:8:\"baiduapp\";a:7:{s:5:\"title\";s:15:\"百度小程序\";s:4:\"icon\";s:14:\"wi wi-baiduapp\";s:3:\"url\";s:40:\"./index.php?c=miniapp&a=display&do=home&\";s:7:\"section\";a:1:{s:15:\"platform_module\";a:3:{s:5:\"title\";s:6:\"应用\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:18;}s:10:\"toutiaoapp\";a:7:{s:5:\"title\";s:15:\"头条小程序\";s:4:\"icon\";s:16:\"wi wi-toutiaoapp\";s:3:\"url\";s:40:\"./index.php?c=miniapp&a=display&do=home&\";s:7:\"section\";a:1:{s:15:\"platform_module\";a:3:{s:5:\"title\";s:6:\"应用\";s:4:\"menu\";a:0:{}s:10:\"is_display\";b:1;}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:19;}s:5:\"store\";a:7:{s:5:\"title\";s:6:\"商城\";s:4:\"icon\";s:11:\"wi wi-store\";s:3:\"url\";s:43:\"./index.php?c=home&a=welcome&do=ext&m=store\";s:7:\"section\";a:7:{s:11:\"store_goods\";a:2:{s:5:\"title\";s:12:\"商品分类\";s:4:\"menu\";a:6:{s:18:\"store_goods_module\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"应用模块\";s:3:\"url\";s:69:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=module\";s:15:\"permission_name\";s:18:\"store_goods_module\";s:4:\"icon\";s:11:\"wi wi-apply\";s:12:\"displayorder\";i:6;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"store_goods_account\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"平台个数\";s:3:\"url\";s:74:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=account_num\";s:15:\"permission_name\";s:19:\"store_goods_account\";s:4:\"icon\";s:13:\"wi wi-account\";s:12:\"displayorder\";i:5;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:25:\"store_goods_account_renew\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"平台续费\";s:3:\"url\";s:68:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=renew\";s:15:\"permission_name\";s:25:\"store_goods_account_renew\";s:4:\"icon\";s:21:\"wi wi-appjurisdiction\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"store_goods_package\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"应用权限组\";s:3:\"url\";s:64:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=5\";s:15:\"permission_name\";s:19:\"store_goods_package\";s:4:\"icon\";s:21:\"wi wi-appjurisdiction\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:25:\"store_goods_users_package\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:15:\"用户权限组\";s:3:\"url\";s:64:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=9\";s:15:\"permission_name\";s:25:\"store_goods_users_package\";s:4:\"icon\";s:22:\"wi wi-userjurisdiction\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:15:\"store_goods_api\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:23:\"应用访问流量(API)\";s:3:\"url\";s:64:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=6\";s:15:\"permission_name\";s:15:\"store_goods_api\";s:4:\"icon\";s:9:\"wi wi-api\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:16:\"store_wish_goods\";a:2:{s:5:\"title\";s:12:\"预购应用\";s:4:\"menu\";a:2:{s:21:\"store_wish_goods_list\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"应用列表\";s:3:\"url\";s:84:\"./index.php?c=site&a=entry&do=goodsbuyer&m=store&direct=1&type=module_wish&is_wish=1\";s:15:\"permission_name\";s:21:\"store_wish_goods_list\";s:4:\"icon\";s:11:\"wi wi-apply\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:21:\"store_wish_goods_edit\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:19:\"添加/设置应用\";s:3:\"url\";s:82:\"./index.php?c=site&a=entry&do=wishgoodsEdit&m=store&direct=1&op=wishgoods&status=1\";s:15:\"permission_name\";s:21:\"store_wish_goods_edit\";s:4:\"icon\";s:15:\"wi wi-goods-add\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:12:\"store_manage\";a:3:{s:5:\"title\";s:12:\"商城管理\";s:7:\"founder\";b:1;s:4:\"menu\";a:4:{s:18:\"store_manage_goods\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"添加商品\";s:3:\"url\";s:58:\"./index.php?c=site&a=entry&do=goodsSeller&m=store&direct=1\";s:15:\"permission_name\";s:18:\"store_manage_goods\";s:4:\"icon\";s:15:\"wi wi-goods-add\";s:12:\"displayorder\";i:4;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:20:\"store_manage_setting\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"商城设置\";s:3:\"url\";s:54:\"./index.php?c=site&a=entry&do=setting&m=store&direct=1\";s:15:\"permission_name\";s:20:\"store_manage_setting\";s:4:\"icon\";s:11:\"wi wi-store\";s:12:\"displayorder\";i:3;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:19:\"store_manage_payset\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"支付设置\";s:3:\"url\";s:57:\"./index.php?c=site&a=entry&do=paySetting&m=store&direct=1\";s:15:\"permission_name\";s:19:\"store_manage_payset\";s:4:\"icon\";s:11:\"wi wi-money\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:23:\"store_manage_permission\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:18:\"商城访问权限\";s:3:\"url\";s:57:\"./index.php?c=site&a=entry&do=permission&m=store&direct=1\";s:15:\"permission_name\";s:23:\"store_manage_permission\";s:4:\"icon\";s:15:\"wi wi-blacklist\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:12:\"store_orders\";a:2:{s:5:\"title\";s:12:\"订单管理\";s:4:\"menu\";a:2:{s:15:\"store_orders_my\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"我的订单\";s:3:\"url\";s:53:\"./index.php?c=site&a=entry&do=orders&m=store&direct=1\";s:15:\"permission_name\";s:15:\"store_orders_my\";s:4:\"icon\";s:17:\"wi wi-sale-record\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:17:\"store_cash_orders\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"分销订单\";s:3:\"url\";s:71:\"./index.php?c=site&a=entry&do=cash&m=store&operate=cash_orders&direct=1\";s:15:\"permission_name\";s:17:\"store_cash_orders\";s:4:\"icon\";s:11:\"wi wi-order\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:14:\"store_payments\";a:2:{s:5:\"title\";s:12:\"收入明细\";s:4:\"menu\";a:1:{s:8:\"payments\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"收入明细\";s:3:\"url\";s:55:\"./index.php?c=site&a=entry&do=payments&m=store&direct=1\";s:15:\"permission_name\";s:8:\"payments\";s:4:\"icon\";s:17:\"wi wi-sale-record\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:17:\"store_cash_manage\";a:2:{s:5:\"title\";s:12:\"分销管理\";s:4:\"menu\";a:2:{s:25:\"store_manage_cash_setting\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"分销设置\";s:3:\"url\";s:58:\"./index.php?c=site&a=entry&do=cashsetting&m=store&direct=1\";s:15:\"permission_name\";s:25:\"store_manage_cash_setting\";s:4:\"icon\";s:18:\"wi wi-site-setting\";s:12:\"displayorder\";i:2;s:2:\"id\";N;s:14:\"sub_permission\";N;}s:16:\"store_check_cash\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"提现审核\";s:3:\"url\";s:73:\"./index.php?c=site&a=entry&do=cash&m=store&operate=consume_order&direct=1\";s:15:\"permission_name\";s:16:\"store_check_cash\";s:4:\"icon\";s:18:\"wi wi-check-select\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}s:10:\"store_cash\";a:2:{s:5:\"title\";s:12:\"佣金管理\";s:4:\"menu\";a:1:{s:8:\"payments\";a:10:{s:9:\"is_system\";i:1;s:18:\"permission_display\";N;s:10:\"is_display\";i:1;s:5:\"title\";s:12:\"我的佣金\";s:3:\"url\";s:66:\"./index.php?c=site&a=entry&do=cash&m=store&operate=mycash&direct=1\";s:15:\"permission_name\";s:8:\"payments\";s:4:\"icon\";s:10:\"wi wi-list\";s:12:\"displayorder\";i:1;s:2:\"id\";N;s:14:\"sub_permission\";N;}}}}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:20;}s:11:\"custom_help\";a:7:{s:5:\"title\";s:12:\"本站帮助\";s:4:\"icon\";s:12:\"wi wi-market\";s:3:\"url\";s:39:\"./index.php?c=help&a=display&do=custom&\";s:7:\"section\";a:0:{}s:9:\"is_system\";b:1;s:10:\"is_display\";b:1;s:12:\"displayorder\";i:21;}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:fm_jiaoyu_plugin_sale:1', 'a:1:{s:6:\"module\";s:21:\"fm_jiaoyu_plugin_sale\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:fm_jiaoyu:1', 'a:1:{s:6:\"module\";s:9:\"fm_jiaoyu\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:stat_todaylock:1', 'a:1:{s:6:\"expire\";i:1586851304;}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:basic', 'a:36:{s:3:\"mid\";s:1:\"1\";s:4:\"name\";s:5:\"basic\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"基本文字回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:24:\"和您进行简单对话\";s:11:\"description\";s:201:\"一问一答得简单对话. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的回复内容.\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"0\";s:10:\"oauth_type\";s:1:\"0\";s:16:\"phoneapp_support\";s:1:\"0\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"0\";s:14:\"aliapp_support\";s:1:\"0\";s:4:\"logo\";s:0:\"\";s:16:\"baiduapp_support\";s:1:\"0\";s:18:\"toutiaoapp_support\";s:1:\"0\";s:4:\"from\";s:0:\"\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:62:\"http://www.weixuexiao.me/addons/basic/preview.jpg?v=1586844104\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:basic:1', 'a:1:{s:6:\"module\";s:5:\"basic\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:news', 'a:36:{s:3:\"mid\";s:1:\"2\";s:4:\"name\";s:4:\"news\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:24:\"基本混合图文回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:33:\"为你提供生动的图文资讯\";s:11:\"description\";s:272:\"一问一答得简单对话, 但是回复内容包括图片文字等更生动的媒体内容. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的图文回复内容.\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"0\";s:10:\"oauth_type\";s:1:\"0\";s:16:\"phoneapp_support\";s:1:\"0\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"0\";s:14:\"aliapp_support\";s:1:\"0\";s:4:\"logo\";s:0:\"\";s:16:\"baiduapp_support\";s:1:\"0\";s:18:\"toutiaoapp_support\";s:1:\"0\";s:4:\"from\";s:0:\"\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:61:\"http://www.weixuexiao.me/addons/news/preview.jpg?v=1586844104\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:news:1', 'a:1:{s:6:\"module\";s:4:\"news\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:music', 'a:36:{s:3:\"mid\";s:1:\"3\";s:4:\"name\";s:5:\"music\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"基本音乐回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:39:\"提供语音、音乐等音频类回复\";s:11:\"description\";s:183:\"在回复规则中可选择具有语音、音乐等音频类的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝，实现一问一答得简单对话。\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"0\";s:10:\"oauth_type\";s:1:\"0\";s:16:\"phoneapp_support\";s:1:\"0\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"0\";s:14:\"aliapp_support\";s:1:\"0\";s:4:\"logo\";s:0:\"\";s:16:\"baiduapp_support\";s:1:\"0\";s:18:\"toutiaoapp_support\";s:1:\"0\";s:4:\"from\";s:0:\"\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:62:\"http://www.weixuexiao.me/addons/music/preview.jpg?v=1586844104\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:music:1', 'a:1:{s:6:\"module\";s:5:\"music\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:userapi', 'a:36:{s:3:\"mid\";s:1:\"4\";s:4:\"name\";s:7:\"userapi\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:21:\"自定义接口回复\";s:7:\"version\";s:3:\"1.1\";s:7:\"ability\";s:33:\"更方便的第三方接口设置\";s:11:\"description\";s:141:\"自定义接口又称第三方接口，可以让开发者更方便的接入微擎系统，高效的与微信公众平台进行对接整合。\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"0\";s:10:\"oauth_type\";s:1:\"0\";s:16:\"phoneapp_support\";s:1:\"0\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"0\";s:14:\"aliapp_support\";s:1:\"0\";s:4:\"logo\";s:0:\"\";s:16:\"baiduapp_support\";s:1:\"0\";s:18:\"toutiaoapp_support\";s:1:\"0\";s:4:\"from\";s:0:\"\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:64:\"http://www.weixuexiao.me/addons/userapi/preview.jpg?v=1586844104\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:userapi:1', 'a:1:{s:6:\"module\";s:7:\"userapi\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:recharge', 'a:36:{s:3:\"mid\";s:1:\"5\";s:4:\"name\";s:8:\"recharge\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:24:\"会员中心充值模块\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:24:\"提供会员充值功能\";s:11:\"description\";s:0:\"\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"0\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"0\";s:10:\"oauth_type\";s:1:\"0\";s:16:\"phoneapp_support\";s:1:\"0\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"0\";s:14:\"aliapp_support\";s:1:\"0\";s:4:\"logo\";s:0:\"\";s:16:\"baiduapp_support\";s:1:\"0\";s:18:\"toutiaoapp_support\";s:1:\"0\";s:4:\"from\";s:0:\"\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:65:\"http://www.weixuexiao.me/addons/recharge/preview.jpg?v=1586844104\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:recharge:1', 'a:1:{s:6:\"module\";s:8:\"recharge\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:images', 'a:36:{s:3:\"mid\";s:1:\"7\";s:4:\"name\";s:6:\"images\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"基本图片回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:18:\"提供图片回复\";s:11:\"description\";s:132:\"在回复规则中可选择具有图片的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝图片。\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"0\";s:10:\"oauth_type\";s:1:\"0\";s:16:\"phoneapp_support\";s:1:\"0\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"0\";s:14:\"aliapp_support\";s:1:\"0\";s:4:\"logo\";s:0:\"\";s:16:\"baiduapp_support\";s:1:\"0\";s:18:\"toutiaoapp_support\";s:1:\"0\";s:4:\"from\";s:0:\"\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:63:\"http://www.weixuexiao.me/addons/images/preview.jpg?v=1586844104\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:images:1', 'a:1:{s:6:\"module\";s:6:\"images\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:video', 'a:36:{s:3:\"mid\";s:1:\"8\";s:4:\"name\";s:5:\"video\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"基本视频回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:18:\"提供图片回复\";s:11:\"description\";s:132:\"在回复规则中可选择具有视频的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝视频。\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"0\";s:10:\"oauth_type\";s:1:\"0\";s:16:\"phoneapp_support\";s:1:\"0\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"0\";s:14:\"aliapp_support\";s:1:\"0\";s:4:\"logo\";s:0:\"\";s:16:\"baiduapp_support\";s:1:\"0\";s:18:\"toutiaoapp_support\";s:1:\"0\";s:4:\"from\";s:0:\"\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:62:\"http://www.weixuexiao.me/addons/video/preview.jpg?v=1586844104\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:video:1', 'a:1:{s:6:\"module\";s:5:\"video\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:voice', 'a:36:{s:3:\"mid\";s:1:\"9\";s:4:\"name\";s:5:\"voice\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"基本语音回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:18:\"提供语音回复\";s:11:\"description\";s:132:\"在回复规则中可选择具有语音的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝语音。\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:18:\"http://www.we7.cc/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"0\";s:10:\"oauth_type\";s:1:\"0\";s:16:\"phoneapp_support\";s:1:\"0\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"0\";s:14:\"aliapp_support\";s:1:\"0\";s:4:\"logo\";s:0:\"\";s:16:\"baiduapp_support\";s:1:\"0\";s:18:\"toutiaoapp_support\";s:1:\"0\";s:4:\"from\";s:0:\"\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:62:\"http://www.weixuexiao.me/addons/voice/preview.jpg?v=1586844104\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:voice:1', 'a:1:{s:6:\"module\";s:5:\"voice\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:wxcard', 'a:36:{s:3:\"mid\";s:2:\"11\";s:4:\"name\";s:6:\"wxcard\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"微信卡券回复\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:18:\"微信卡券回复\";s:11:\"description\";s:18:\"微信卡券回复\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:20:\"http://www.nyabc.net\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"0\";s:10:\"oauth_type\";s:1:\"0\";s:16:\"phoneapp_support\";s:1:\"0\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"0\";s:14:\"aliapp_support\";s:1:\"0\";s:4:\"logo\";s:0:\"\";s:16:\"baiduapp_support\";s:1:\"0\";s:18:\"toutiaoapp_support\";s:1:\"0\";s:4:\"from\";s:0:\"\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:63:\"http://www.weixuexiao.me/addons/wxcard/preview.jpg?v=1586844104\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:wxcard:1', 'a:1:{s:6:\"module\";s:6:\"wxcard\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:custom', 'a:36:{s:3:\"mid\";s:1:\"6\";s:4:\"name\";s:6:\"custom\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:15:\"多客服转接\";s:7:\"version\";s:5:\"1.0.0\";s:7:\"ability\";s:36:\"用来接入腾讯的多客服系统\";s:11:\"description\";s:0:\"\";s:6:\"author\";s:13:\"WeEngine Team\";s:3:\"url\";s:17:\"http://bbs.we7.cc\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";a:0:{}s:7:\"handles\";a:6:{i:0;s:5:\"image\";i:1;s:5:\"voice\";i:2;s:5:\"video\";i:3;s:8:\"location\";i:4;s:4:\"link\";i:5;s:4:\"text\";}s:12:\"isrulefields\";s:1:\"1\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"0\";s:10:\"oauth_type\";s:1:\"0\";s:16:\"phoneapp_support\";s:1:\"0\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"0\";s:14:\"aliapp_support\";s:1:\"0\";s:4:\"logo\";s:0:\"\";s:16:\"baiduapp_support\";s:1:\"0\";s:18:\"toutiaoapp_support\";s:1:\"0\";s:4:\"from\";s:0:\"\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:63:\"http://www.weixuexiao.me/addons/custom/preview.jpg?v=1586844104\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:custom:1', 'a:1:{s:6:\"module\";s:6:\"custom\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:chats', 'a:36:{s:3:\"mid\";s:2:\"10\";s:4:\"name\";s:5:\"chats\";s:4:\"type\";s:6:\"system\";s:5:\"title\";s:18:\"发送客服消息\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:77:\"公众号可以在粉丝最后发送消息的48小时内无限制发送消息\";s:11:\"description\";s:0:\"\";s:6:\"author\";s:12:\"飞鹰网络\";s:3:\"url\";s:21:\"http://www.nyabc.net/\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"0\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:0:\"\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"0\";s:10:\"oauth_type\";s:1:\"0\";s:16:\"phoneapp_support\";s:1:\"0\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"0\";s:14:\"aliapp_support\";s:1:\"0\";s:4:\"logo\";s:0:\"\";s:16:\"baiduapp_support\";s:1:\"0\";s:18:\"toutiaoapp_support\";s:1:\"0\";s:4:\"from\";s:0:\"\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:62:\"http://www.weixuexiao.me/addons/chats/preview.jpg?v=1586844104\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:chats:1', 'a:1:{s:6:\"module\";s:5:\"chats\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_info:store', 'a:36:{s:3:\"mid\";s:2:\"12\";s:4:\"name\";s:5:\"store\";s:4:\"type\";s:8:\"business\";s:5:\"title\";s:12:\"站内商城\";s:7:\"version\";s:3:\"1.0\";s:7:\"ability\";s:12:\"站内商城\";s:11:\"description\";s:12:\"站内商城\";s:6:\"author\";s:3:\"we7\";s:3:\"url\";s:0:\"\";s:8:\"settings\";s:1:\"0\";s:10:\"subscribes\";s:0:\"\";s:7:\"handles\";s:0:\"\";s:12:\"isrulefields\";s:1:\"0\";s:8:\"issystem\";s:1:\"1\";s:6:\"target\";s:1:\"0\";s:6:\"iscard\";s:1:\"0\";s:11:\"permissions\";s:0:\"\";s:13:\"title_initial\";s:1:\"Z\";s:13:\"wxapp_support\";s:1:\"1\";s:11:\"app_support\";s:1:\"2\";s:14:\"webapp_support\";s:1:\"1\";s:15:\"welcome_support\";s:1:\"0\";s:10:\"oauth_type\";s:1:\"0\";s:16:\"phoneapp_support\";s:1:\"0\";s:15:\"account_support\";s:1:\"2\";s:13:\"xzapp_support\";s:1:\"0\";s:14:\"aliapp_support\";s:1:\"0\";s:4:\"logo\";s:0:\"\";s:16:\"baiduapp_support\";s:1:\"0\";s:18:\"toutiaoapp_support\";s:1:\"0\";s:4:\"from\";s:0:\"\";s:9:\"isdisplay\";i:1;s:7:\"preview\";s:62:\"http://www.weixuexiao.me/addons/store/preview.jpg?v=1586844104\";s:11:\"main_module\";b:0;s:11:\"plugin_list\";a:0:{}s:12:\"recycle_info\";a:0:{}}');
INSERT INTO `ims_core_cache` VALUES ('we7:module_setting:store:1', 'a:1:{s:6:\"module\";s:5:\"store\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:unimodules:1', 'a:2:{i:0;s:21:\"fm_jiaoyu_plugin_sale\";i:1;s:9:\"fm_jiaoyu\";}');
INSERT INTO `ims_core_cache` VALUES ('we7:unicount:1', 's:1:\"1\";');
COMMIT;

-- ----------------------------
-- Table structure for ims_core_cron
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_cron`;
CREATE TABLE `ims_core_cron` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cloudid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `lastruntime` int(10) unsigned NOT NULL,
  `nextruntime` int(10) unsigned NOT NULL,
  `weekday` tinyint(3) NOT NULL,
  `day` tinyint(3) NOT NULL,
  `hour` tinyint(3) NOT NULL,
  `minute` varchar(255) NOT NULL,
  `extra` varchar(5000) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `createtime` (`createtime`),
  KEY `nextruntime` (`nextruntime`),
  KEY `uniacid` (`uniacid`),
  KEY `cloudid` (`cloudid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_cron_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_cron_record`;
CREATE TABLE `ims_core_cron_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `note` varchar(500) NOT NULL,
  `tag` varchar(5000) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `tid` (`tid`),
  KEY `module` (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_job
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_job`;
CREATE TABLE `ims_core_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `payload` varchar(255) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `title` varchar(22) NOT NULL,
  `handled` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `isdeleted` tinyint(1) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_menu
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_menu`;
CREATE TABLE `ims_core_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `title` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `url` varchar(255) NOT NULL,
  `append_title` varchar(30) NOT NULL,
  `append_url` varchar(255) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `type` varchar(15) NOT NULL,
  `is_display` tinyint(3) unsigned NOT NULL,
  `is_system` tinyint(3) unsigned NOT NULL,
  `permission_name` varchar(50) NOT NULL,
  `group_name` varchar(30) NOT NULL,
  `icon` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_menu
-- ----------------------------
BEGIN;
INSERT INTO `ims_core_menu` VALUES (1, 0, '', '', '', '', '', 0, '', 0, 1, 'phoneapp', 'frame', '');
COMMIT;

-- ----------------------------
-- Table structure for ims_core_menu_shortcut
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_menu_shortcut`;
CREATE TABLE `ims_core_menu_shortcut` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `modulename` varchar(100) NOT NULL,
  `displayorder` int(10) NOT NULL,
  `position` varchar(100) NOT NULL,
  `updatetime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_paylog
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_paylog`;
CREATE TABLE `ims_core_paylog` (
  `plid` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `acid` int(10) NOT NULL,
  `openid` varchar(40) NOT NULL,
  `uniontid` varchar(64) NOT NULL,
  `tid` varchar(128) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `module` varchar(50) NOT NULL,
  `tag` varchar(2000) NOT NULL,
  `is_usecard` tinyint(3) unsigned NOT NULL,
  `card_type` tinyint(3) unsigned NOT NULL,
  `card_id` varchar(50) NOT NULL,
  `card_fee` decimal(10,2) unsigned NOT NULL,
  `encrypt_code` varchar(100) NOT NULL,
  `is_wish` tinyint(1) NOT NULL,
  PRIMARY KEY (`plid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_tid` (`tid`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `uniontid` (`uniontid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_performance
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_performance`;
CREATE TABLE `ims_core_performance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `runtime` varchar(10) NOT NULL,
  `runurl` varchar(512) NOT NULL,
  `runsql` varchar(512) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_queue
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_queue`;
CREATE TABLE `ims_core_queue` (
  `qid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `message` varchar(2000) NOT NULL,
  `params` varchar(1000) NOT NULL,
  `keyword` varchar(1000) NOT NULL,
  `response` varchar(2000) NOT NULL,
  `module` varchar(50) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  PRIMARY KEY (`qid`),
  KEY `uniacid` (`uniacid`,`acid`),
  KEY `module` (`module`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_refundlog
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_refundlog`;
CREATE TABLE `ims_core_refundlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `refund_uniontid` varchar(64) NOT NULL,
  `reason` varchar(80) NOT NULL,
  `uniontid` varchar(64) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `status` int(2) NOT NULL,
  `is_wish` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `refund_uniontid` (`refund_uniontid`),
  KEY `uniontid` (`uniontid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_resource
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_resource`;
CREATE TABLE `ims_core_resource` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `media_id` varchar(100) NOT NULL,
  `trunk` int(10) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  PRIMARY KEY (`mid`),
  KEY `acid` (`uniacid`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_sendsms_log
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_sendsms_log`;
CREATE TABLE `ims_core_sendsms_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `createtime` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_sessions`;
CREATE TABLE `ims_core_sessions` (
  `sid` char(32) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `data` varchar(5000) NOT NULL,
  `expiretime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_core_settings
-- ----------------------------
DROP TABLE IF EXISTS `ims_core_settings`;
CREATE TABLE `ims_core_settings` (
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_core_settings
-- ----------------------------
BEGIN;
INSERT INTO `ims_core_settings` VALUES ('copyright', 'a:1:{s:6:\"slides\";a:3:{i:0;s:58:\"https://img.alicdn.com/tps/TB1pfG4IFXXXXc6XXXXXXXXXXXX.jpg\";i:1;s:58:\"https://img.alicdn.com/tps/TB1sXGYIFXXXXc5XpXXXXXXXXXX.jpg\";i:2;s:58:\"https://img.alicdn.com/tps/TB1h9xxIFXXXXbKXXXXXXXXXXXX.jpg\";}}');
INSERT INTO `ims_core_settings` VALUES ('authmode', 'i:1;');
INSERT INTO `ims_core_settings` VALUES ('close', 'a:2:{s:6:\"status\";s:1:\"0\";s:6:\"reason\";s:0:\"\";}');
INSERT INTO `ims_core_settings` VALUES ('register', 'a:4:{s:4:\"open\";i:1;s:6:\"verify\";i:0;s:4:\"code\";i:1;s:7:\"groupid\";i:1;}');
INSERT INTO `ims_core_settings` VALUES ('thirdlogin', 'a:4:{s:6:\"system\";a:3:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"authstate\";s:0:\"\";}s:2:\"qq\";a:3:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"authstate\";i:0;}s:6:\"wechat\";a:3:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"authstate\";s:0:\"\";}s:6:\"mobile\";a:3:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"authstate\";s:0:\"\";}}');
INSERT INTO `ims_core_settings` VALUES ('module_receive_ban', 'a:0:{}');
COMMIT;

-- ----------------------------
-- Table structure for ims_coupon_location
-- ----------------------------
DROP TABLE IF EXISTS `ims_coupon_location`;
CREATE TABLE `ims_coupon_location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `business_name` varchar(50) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `category` varchar(255) NOT NULL,
  `province` varchar(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `district` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `longitude` varchar(15) NOT NULL,
  `latitude` varchar(15) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `photo_list` varchar(10000) NOT NULL,
  `avg_price` int(10) unsigned NOT NULL,
  `open_time` varchar(50) NOT NULL,
  `recommend` varchar(255) NOT NULL,
  `special` varchar(255) NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `offset_type` tinyint(3) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`acid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_cover_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_cover_reply`;
CREATE TABLE `ims_cover_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `module` varchar(30) NOT NULL,
  `do` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_cover_reply
-- ----------------------------
BEGIN;
INSERT INTO `ims_cover_reply` VALUES (1, 1, 0, 7, 'mc', '', '进入个人中心', '', '', './index.php?c=mc&a=home&i=1');
INSERT INTO `ims_cover_reply` VALUES (2, 1, 1, 8, 'site', '', '进入首页', '', '', './index.php?c=home&i=1&t=1');
COMMIT;

-- ----------------------------
-- Table structure for ims_custom_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_custom_reply`;
CREATE TABLE `ims_custom_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `start1` int(10) NOT NULL,
  `end1` int(10) NOT NULL,
  `start2` int(10) NOT NULL,
  `end2` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_images_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_images_reply`;
CREATE TABLE `ims_images_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `mediaid` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_job
-- ----------------------------
DROP TABLE IF EXISTS `ims_job`;
CREATE TABLE `ims_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `payload` varchar(255) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `title` varchar(22) NOT NULL,
  `handled` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `isdeleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_card
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_card`;
CREATE TABLE `ims_mc_card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `color` varchar(255) NOT NULL,
  `background` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `format_type` tinyint(3) unsigned NOT NULL,
  `format` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `fields` varchar(1000) NOT NULL,
  `snpos` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `business` text NOT NULL,
  `discount_type` tinyint(3) unsigned NOT NULL,
  `discount` varchar(3000) NOT NULL,
  `grant` varchar(3000) NOT NULL,
  `grant_rate` varchar(20) NOT NULL,
  `offset_rate` int(10) unsigned NOT NULL,
  `offset_max` int(10) NOT NULL,
  `nums_status` tinyint(3) unsigned NOT NULL,
  `nums_text` varchar(15) NOT NULL,
  `nums` varchar(1000) NOT NULL,
  `times_status` tinyint(3) unsigned NOT NULL,
  `times_text` varchar(15) NOT NULL,
  `times` varchar(1000) NOT NULL,
  `params` longtext NOT NULL,
  `html` longtext NOT NULL,
  `recommend_status` tinyint(3) unsigned NOT NULL,
  `sign_status` tinyint(3) unsigned NOT NULL,
  `brand_name` varchar(128) NOT NULL DEFAULT '',
  `quantity` int(10) NOT NULL DEFAULT '0',
  `notice` varchar(48) NOT NULL DEFAULT '',
  `max_increase_bonus` int(10) NOT NULL DEFAULT '0',
  `least_money_to_use_bonus` int(10) NOT NULL DEFAULT '0',
  `source` int(1) NOT NULL DEFAULT '1',
  `card_id` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_card_care
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_card_care`;
CREATE TABLE `ims_mc_card_care` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `groupid` int(10) unsigned NOT NULL,
  `credit1` int(10) unsigned NOT NULL,
  `credit2` int(10) unsigned NOT NULL,
  `couponid` int(10) unsigned NOT NULL,
  `granttime` int(10) unsigned NOT NULL,
  `days` int(10) unsigned NOT NULL,
  `time` tinyint(3) unsigned NOT NULL,
  `show_in_card` tinyint(3) unsigned NOT NULL,
  `content` varchar(1000) NOT NULL,
  `sms_notice` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_card_credit_set
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_card_credit_set`;
CREATE TABLE `ims_mc_card_credit_set` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `sign` varchar(1000) NOT NULL,
  `share` varchar(500) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_card_members
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_card_members`;
CREATE TABLE `ims_mc_card_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) DEFAULT NULL,
  `openid` varchar(50) NOT NULL,
  `cid` int(10) NOT NULL,
  `cardsn` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `nums` int(10) unsigned NOT NULL,
  `endtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_card_notices
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_card_notices`;
CREATE TABLE `ims_mc_card_notices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `groupid` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_card_notices_unread
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_card_notices_unread`;
CREATE TABLE `ims_mc_card_notices_unread` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `notice_id` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `is_new` tinyint(3) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`),
  KEY `notice_id` (`notice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_card_recommend
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_card_recommend`;
CREATE TABLE `ims_mc_card_recommend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_card_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_card_record`;
CREATE TABLE `ims_mc_card_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `type` varchar(15) NOT NULL,
  `model` tinyint(3) unsigned NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `tag` varchar(10) NOT NULL,
  `note` varchar(255) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`),
  KEY `addtime` (`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_card_sign_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_card_sign_record`;
CREATE TABLE `ims_mc_card_sign_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `credit` int(10) unsigned NOT NULL,
  `is_grant` tinyint(3) unsigned NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_cash_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_cash_record`;
CREATE TABLE `ims_mc_cash_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `clerk_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `clerk_type` tinyint(3) unsigned NOT NULL,
  `fee` decimal(10,2) unsigned NOT NULL,
  `final_fee` decimal(10,2) unsigned NOT NULL,
  `credit1` int(10) unsigned NOT NULL,
  `credit1_fee` decimal(10,2) unsigned NOT NULL,
  `credit2` decimal(10,2) unsigned NOT NULL,
  `cash` decimal(10,2) unsigned NOT NULL,
  `return_cash` decimal(10,2) unsigned NOT NULL,
  `final_cash` decimal(10,2) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `trade_type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_chats_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_chats_record`;
CREATE TABLE `ims_mc_chats_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `flag` tinyint(3) unsigned NOT NULL,
  `openid` varchar(32) NOT NULL,
  `msgtype` varchar(15) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`acid`),
  KEY `openid` (`openid`),
  KEY `createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_credits_recharge
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_credits_recharge`;
CREATE TABLE `ims_mc_credits_recharge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `tid` varchar(64) NOT NULL,
  `transid` varchar(30) NOT NULL,
  `fee` varchar(10) NOT NULL,
  `type` varchar(15) NOT NULL,
  `tag` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `backtype` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid_uid` (`uniacid`,`uid`),
  KEY `idx_tid` (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_credits_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_credits_record`;
CREATE TABLE `ims_mc_credits_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `uniacid` int(11) NOT NULL,
  `credittype` varchar(10) NOT NULL,
  `num` decimal(10,2) NOT NULL,
  `operator` int(10) unsigned NOT NULL,
  `module` varchar(30) NOT NULL,
  `clerk_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `clerk_type` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `remark` varchar(200) NOT NULL,
  `real_uniacid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_fans_groups
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_fans_groups`;
CREATE TABLE `ims_mc_fans_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `groups` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_fans_tag
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_fans_tag`;
CREATE TABLE `ims_mc_fans_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `fanid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL,
  `subscribe` int(11) DEFAULT '0',
  `nickname` varchar(100) DEFAULT NULL,
  `sex` int(11) DEFAULT '0',
  `language` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `headimgurl` varchar(150) DEFAULT NULL,
  `subscribe_time` int(11) NOT NULL DEFAULT '0',
  `unionid` varchar(100) DEFAULT NULL,
  `remark` varchar(250) DEFAULT NULL,
  `groupid` varchar(100) DEFAULT NULL,
  `tagid_list` varchar(250) DEFAULT NULL,
  `subscribe_scene` varchar(100) DEFAULT NULL,
  `qr_scene_str` varchar(250) DEFAULT NULL,
  `qr_scene` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fanid` (`fanid`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_fans_tag_mapping
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_fans_tag_mapping`;
CREATE TABLE `ims_mc_fans_tag_mapping` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fanid` int(11) unsigned NOT NULL,
  `tagid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mapping` (`fanid`,`tagid`),
  KEY `fanid_index` (`fanid`),
  KEY `tagid_index` (`tagid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_groups
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_groups`;
CREATE TABLE `ims_mc_groups` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `credit` int(10) unsigned NOT NULL,
  `isdefault` tinyint(4) NOT NULL,
  PRIMARY KEY (`groupid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_mc_groups
-- ----------------------------
BEGIN;
INSERT INTO `ims_mc_groups` VALUES (1, 1, '默认会员组', 0, 1);
COMMIT;

-- ----------------------------
-- Table structure for ims_mc_handsel
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_handsel`;
CREATE TABLE `ims_mc_handsel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `touid` int(10) unsigned NOT NULL,
  `fromuid` varchar(32) NOT NULL,
  `module` varchar(30) NOT NULL,
  `sign` varchar(100) NOT NULL,
  `action` varchar(20) NOT NULL,
  `credit_value` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`touid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_mapping_fans
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_mapping_fans`;
CREATE TABLE `ims_mc_mapping_fans` (
  `fanid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `groupid` varchar(60) NOT NULL,
  `salt` char(8) NOT NULL,
  `follow` tinyint(1) unsigned NOT NULL,
  `followtime` int(10) unsigned NOT NULL,
  `unfollowtime` int(10) unsigned NOT NULL,
  `tag` varchar(1000) NOT NULL,
  `updatetime` int(10) unsigned DEFAULT NULL,
  `unionid` varchar(64) NOT NULL,
  `user_from` tinyint(1) NOT NULL,
  PRIMARY KEY (`fanid`),
  UNIQUE KEY `openid_2` (`openid`),
  KEY `acid` (`acid`),
  KEY `uniacid` (`uniacid`),
  KEY `nickname` (`nickname`),
  KEY `updatetime` (`updatetime`),
  KEY `uid` (`uid`),
  KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_mapping_ucenter
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_mapping_ucenter`;
CREATE TABLE `ims_mc_mapping_ucenter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `centeruid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_mass_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_mass_record`;
CREATE TABLE `ims_mc_mass_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `groupname` varchar(50) NOT NULL,
  `fansnum` int(10) unsigned NOT NULL,
  `msgtype` varchar(10) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `group` int(10) NOT NULL,
  `attach_id` int(10) unsigned NOT NULL,
  `media_id` varchar(100) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `cron_id` int(10) unsigned NOT NULL,
  `sendtime` int(10) unsigned NOT NULL,
  `finalsendtime` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `msg_id` varchar(50) NOT NULL,
  `msg_data_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`acid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_member_address
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_member_address`;
CREATE TABLE `ims_mc_member_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(50) unsigned NOT NULL,
  `username` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `zipcode` varchar(6) NOT NULL,
  `province` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `district` varchar(32) NOT NULL,
  `address` varchar(512) NOT NULL,
  `isdefault` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uinacid` (`uniacid`),
  KEY `idx_uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_member_fields
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_member_fields`;
CREATE TABLE `ims_mc_member_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `fieldid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `displayorder` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_fieldid` (`fieldid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_member_property
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_member_property`;
CREATE TABLE `ims_mc_member_property` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `property` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_members
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_members`;
CREATE TABLE `ims_mc_members` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `mobile` varchar(18) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(8) NOT NULL,
  `groupid` int(11) NOT NULL,
  `credit1` decimal(10,2) unsigned NOT NULL,
  `credit2` decimal(10,2) unsigned NOT NULL,
  `credit3` decimal(10,2) unsigned NOT NULL,
  `credit4` decimal(10,2) unsigned NOT NULL,
  `credit5` decimal(10,2) unsigned NOT NULL,
  `credit6` decimal(10,2) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `realname` varchar(10) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `vip` tinyint(3) unsigned NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthyear` smallint(6) unsigned NOT NULL,
  `birthmonth` tinyint(3) unsigned NOT NULL,
  `birthday` tinyint(3) unsigned NOT NULL,
  `constellation` varchar(10) NOT NULL,
  `zodiac` varchar(5) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `idcard` varchar(30) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `resideprovince` varchar(30) NOT NULL,
  `residecity` varchar(30) NOT NULL,
  `residedist` varchar(30) NOT NULL,
  `graduateschool` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `education` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `revenue` varchar(10) NOT NULL,
  `affectivestatus` varchar(30) NOT NULL,
  `lookingfor` varchar(255) NOT NULL,
  `bloodtype` varchar(5) NOT NULL,
  `height` varchar(5) NOT NULL,
  `weight` varchar(5) NOT NULL,
  `alipay` varchar(30) NOT NULL,
  `msn` varchar(30) NOT NULL,
  `taobao` varchar(30) NOT NULL,
  `site` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `interest` text NOT NULL,
  `pay_password` varchar(30) NOT NULL,
  `user_from` tinyint(1) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `groupid` (`groupid`),
  KEY `uniacid` (`uniacid`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`),
  KEY `createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mc_oauth_fans
-- ----------------------------
DROP TABLE IF EXISTS `ims_mc_oauth_fans`;
CREATE TABLE `ims_mc_oauth_fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `oauth_openid` varchar(50) NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_oauthopenid_acid` (`oauth_openid`,`acid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_menu_event
-- ----------------------------
DROP TABLE IF EXISTS `ims_menu_event`;
CREATE TABLE `ims_menu_event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `keyword` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `picmd5` varchar(32) NOT NULL,
  `openid` varchar(128) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `picmd5` (`picmd5`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_message_notice_log
-- ----------------------------
DROP TABLE IF EXISTS `ims_message_notice_log`;
CREATE TABLE `ims_message_notice_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(3) NOT NULL,
  `uid` int(11) NOT NULL,
  `sign` varchar(22) NOT NULL,
  `type` tinyint(3) NOT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_mobilenumber
-- ----------------------------
DROP TABLE IF EXISTS `ims_mobilenumber`;
CREATE TABLE `ims_mobilenumber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(10) NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `dateline` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_modules
-- ----------------------------
DROP TABLE IF EXISTS `ims_modules`;
CREATE TABLE `ims_modules` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `version` varchar(15) NOT NULL,
  `ability` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `author` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `settings` tinyint(1) NOT NULL,
  `subscribes` varchar(500) NOT NULL,
  `handles` varchar(500) NOT NULL,
  `isrulefields` tinyint(1) NOT NULL,
  `issystem` tinyint(1) unsigned NOT NULL,
  `target` int(10) unsigned NOT NULL,
  `iscard` tinyint(3) unsigned NOT NULL,
  `permissions` varchar(5000) NOT NULL,
  `title_initial` varchar(1) NOT NULL,
  `wxapp_support` tinyint(1) NOT NULL,
  `app_support` tinyint(1) NOT NULL,
  `webapp_support` tinyint(1) NOT NULL DEFAULT '1',
  `welcome_support` int(2) NOT NULL,
  `oauth_type` tinyint(1) NOT NULL,
  `phoneapp_support` tinyint(1) NOT NULL,
  `account_support` tinyint(1) NOT NULL,
  `xzapp_support` tinyint(1) NOT NULL,
  `aliapp_support` tinyint(1) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `baiduapp_support` tinyint(1) NOT NULL,
  `toutiaoapp_support` tinyint(1) NOT NULL,
  `from` varchar(10) NOT NULL,
  PRIMARY KEY (`mid`),
  KEY `idx_name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_modules
-- ----------------------------
BEGIN;
INSERT INTO `ims_modules` VALUES (1, 'basic', 'system', '基本文字回复', '1.0', '和您进行简单对话', '一问一答得简单对话. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的回复内容.', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2, 1, 0, 0, 0, 2, 0, 0, '', 0, 0, '');
INSERT INTO `ims_modules` VALUES (2, 'news', 'system', '基本混合图文回复', '1.0', '为你提供生动的图文资讯', '一问一答得简单对话, 但是回复内容包括图片文字等更生动的媒体内容. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的图文回复内容.', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2, 1, 0, 0, 0, 2, 0, 0, '', 0, 0, '');
INSERT INTO `ims_modules` VALUES (3, 'music', 'system', '基本音乐回复', '1.0', '提供语音、音乐等音频类回复', '在回复规则中可选择具有语音、音乐等音频类的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝，实现一问一答得简单对话。', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2, 1, 0, 0, 0, 2, 0, 0, '', 0, 0, '');
INSERT INTO `ims_modules` VALUES (4, 'userapi', 'system', '自定义接口回复', '1.1', '更方便的第三方接口设置', '自定义接口又称第三方接口，可以让开发者更方便的接入微擎系统，高效的与微信公众平台进行对接整合。', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2, 1, 0, 0, 0, 2, 0, 0, '', 0, 0, '');
INSERT INTO `ims_modules` VALUES (5, 'recharge', 'system', '会员中心充值模块', '1.0', '提供会员充值功能', '', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 0, 1, 0, 0, '', '', 1, 2, 1, 0, 0, 0, 2, 0, 0, '', 0, 0, '');
INSERT INTO `ims_modules` VALUES (6, 'custom', 'system', '多客服转接', '1.0.0', '用来接入腾讯的多客服系统', '', 'WeEngine Team', 'http://bbs.we7.cc', 0, 'a:0:{}', 'a:6:{i:0;s:5:\"image\";i:1;s:5:\"voice\";i:2;s:5:\"video\";i:3;s:8:\"location\";i:4;s:4:\"link\";i:5;s:4:\"text\";}', 1, 1, 0, 0, '', '', 1, 2, 1, 0, 0, 0, 2, 0, 0, '', 0, 0, '');
INSERT INTO `ims_modules` VALUES (7, 'images', 'system', '基本图片回复', '1.0', '提供图片回复', '在回复规则中可选择具有图片的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝图片。', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2, 1, 0, 0, 0, 2, 0, 0, '', 0, 0, '');
INSERT INTO `ims_modules` VALUES (8, 'video', 'system', '基本视频回复', '1.0', '提供图片回复', '在回复规则中可选择具有视频的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝视频。', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2, 1, 0, 0, 0, 2, 0, 0, '', 0, 0, '');
INSERT INTO `ims_modules` VALUES (9, 'voice', 'system', '基本语音回复', '1.0', '提供语音回复', '在回复规则中可选择具有语音的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝语音。', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2, 1, 0, 0, 0, 2, 0, 0, '', 0, 0, '');
INSERT INTO `ims_modules` VALUES (10, 'chats', 'system', '发送客服消息', '1.0', '公众号可以在粉丝最后发送消息的48小时内无限制发送消息', '', '飞鹰网络', 'http://www.nyabc.net/', 0, '', '', 0, 1, 0, 0, '', '', 1, 2, 1, 0, 0, 0, 2, 0, 0, '', 0, 0, '');
INSERT INTO `ims_modules` VALUES (11, 'wxcard', 'system', '微信卡券回复', '1.0', '微信卡券回复', '微信卡券回复', 'WeEngine Team', 'http://www.nyabc.net', 0, '', '', 1, 1, 0, 0, '', '', 1, 2, 1, 0, 0, 0, 2, 0, 0, '', 0, 0, '');
INSERT INTO `ims_modules` VALUES (12, 'store', 'business', '站内商城', '1.0', '站内商城', '站内商城', 'we7', '', 0, '', '', 0, 1, 0, 0, '', 'Z', 1, 2, 1, 0, 0, 0, 2, 0, 0, '', 0, 0, '');
INSERT INTO `ims_modules` VALUES (14, 'fm_jiaoyu', 'business', '微教育平台', '3.12.51', '教育行业通用模块，适用于培训学校，幼儿园，具备成绩查询，教师管理，课程安排等功能', '教育行业通用模块，适用于培训学校，幼儿园，具备成绩查询，教师管理，课程安排等功能', '飞鹰微教育', 'http://www.nyabc.net/', 0, 'a:4:{i:0;s:4:\"text\";i:1;s:9:\"subscribe\";i:2;s:11:\"unsubscribe\";i:3;s:2:\"qr\";}', 'a:4:{i:0;s:4:\"text\";i:1;s:9:\"subscribe\";i:2;s:11:\"unsubscribe\";i:3;s:2:\"qr\";}', 1, 0, 0, 1, 'a:0:{}', 'W', 1, 0, 1, 1, 1, 1, 2, 1, 1, 'addons/fm_jiaoyu/icon.jpg', 1, 1, 'local');
INSERT INTO `ims_modules` VALUES (15, 'fm_jiaoyu_plugin_sale', 'biz', '微教育培训营销插件包', '1.0.19', '本插件需要配合微教育主程序使用，插件内容涵盖了培训课程推广员系统，其中包括课程团购系统，助力系统，分销系统以手机端课程销售管理系统', '本插件需要配合微教育主程序使用，插件内容涵盖了培训课程推广员系统，其中包括课程团购系统，助力系统，分销系统以手机端课程销售管理系统', '营销插件包', 'http://www.nyabc.net/', 0, 'a:0:{}', 'a:1:{i:0;s:4:\"text\";}', 0, 0, 0, 0, 'a:0:{}', 'W', 1, 0, 1, 1, 1, 1, 2, 1, 1, 'addons/fm_jiaoyu_plugin_sale/icon.jpg', 1, 1, 'local');
COMMIT;

-- ----------------------------
-- Table structure for ims_modules_bindings
-- ----------------------------
DROP TABLE IF EXISTS `ims_modules_bindings`;
CREATE TABLE `ims_modules_bindings` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL,
  `entry` varchar(30) NOT NULL,
  `call` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `do` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `direct` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `displayorder` tinyint(255) unsigned NOT NULL,
  `multilevel` tinyint(1) NOT NULL,
  `parent` varchar(50) NOT NULL,
  PRIMARY KEY (`eid`),
  KEY `idx_module` (`module`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_modules_bindings
-- ----------------------------
BEGIN;
INSERT INTO `ims_modules_bindings` VALUES (12, 'fm_jiaoyu', 'menu', '', '平台功能', 'manager', '', 0, '', '', 0, 0, '');
INSERT INTO `ims_modules_bindings` VALUES (11, 'fm_jiaoyu', 'menu', '', '参数设置', 'basic', '', 0, '', '', 0, 0, '');
INSERT INTO `ims_modules_bindings` VALUES (10, 'fm_jiaoyu', 'menu', '', '分类设置', 'type', '', 0, '', '', 0, 0, '');
INSERT INTO `ims_modules_bindings` VALUES (9, 'fm_jiaoyu', 'menu', '', '校区设置', 'area', '', 0, '', '', 0, 0, '');
INSERT INTO `ims_modules_bindings` VALUES (8, 'fm_jiaoyu', 'menu', '', '学校管理', 'school', '', 0, '', '', 0, 0, '');
INSERT INTO `ims_modules_bindings` VALUES (7, 'fm_jiaoyu', 'cover', '', '校园列表', 'wapindex', '', 0, '', '', 0, 0, '');
COMMIT;

-- ----------------------------
-- Table structure for ims_modules_cloud
-- ----------------------------
DROP TABLE IF EXISTS `ims_modules_cloud`;
CREATE TABLE `ims_modules_cloud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `title_initial` varchar(1) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `version` varchar(10) NOT NULL,
  `install_status` tinyint(4) NOT NULL,
  `account_support` tinyint(4) NOT NULL,
  `wxapp_support` tinyint(4) NOT NULL,
  `webapp_support` tinyint(4) NOT NULL,
  `phoneapp_support` tinyint(4) NOT NULL,
  `welcome_support` tinyint(4) NOT NULL,
  `main_module_name` varchar(50) NOT NULL,
  `main_module_logo` varchar(100) NOT NULL,
  `has_new_version` tinyint(1) NOT NULL,
  `has_new_branch` tinyint(1) NOT NULL,
  `is_ban` tinyint(4) NOT NULL,
  `lastupdatetime` int(11) NOT NULL,
  `xzapp_support` tinyint(1) NOT NULL,
  `cloud_id` int(11) NOT NULL,
  `aliapp_support` tinyint(1) NOT NULL,
  `baiduapp_support` tinyint(1) NOT NULL,
  `toutiaoapp_support` tinyint(1) NOT NULL,
  `buytime` int(10) NOT NULL,
  `module_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `lastupdatetime` (`lastupdatetime`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_modules_ignore
-- ----------------------------
DROP TABLE IF EXISTS `ims_modules_ignore`;
CREATE TABLE `ims_modules_ignore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `version` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_modules_plugin
-- ----------------------------
DROP TABLE IF EXISTS `ims_modules_plugin`;
CREATE TABLE `ims_modules_plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `main_module` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `main_module` (`main_module`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_modules_plugin
-- ----------------------------
BEGIN;
INSERT INTO `ims_modules_plugin` VALUES (4, 'fm_jiaoyu_plugin_bigdata', 'fm_jiaoyu');
INSERT INTO `ims_modules_plugin` VALUES (3, 'fm_jiaoyu_plugin_sale', 'fm_jiaoyu');
COMMIT;

-- ----------------------------
-- Table structure for ims_modules_plugin_rank
-- ----------------------------
DROP TABLE IF EXISTS `ims_modules_plugin_rank`;
CREATE TABLE `ims_modules_plugin_rank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `rank` int(10) unsigned NOT NULL,
  `plugin_name` varchar(200) NOT NULL,
  `main_module_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_modules_rank
-- ----------------------------
DROP TABLE IF EXISTS `ims_modules_rank`;
CREATE TABLE `ims_modules_rank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) NOT NULL,
  `uid` int(10) NOT NULL,
  `rank` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module_name` (`module_name`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_modules_recycle
-- ----------------------------
DROP TABLE IF EXISTS `ims_modules_recycle`;
CREATE TABLE `ims_modules_recycle` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `modulename` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `account_support` tinyint(1) NOT NULL,
  `wxapp_support` tinyint(1) NOT NULL,
  `welcome_support` tinyint(1) NOT NULL,
  `webapp_support` tinyint(1) NOT NULL,
  `phoneapp_support` tinyint(1) NOT NULL,
  `xzapp_support` tinyint(1) NOT NULL,
  `aliapp_support` tinyint(1) NOT NULL,
  `baiduapp_support` tinyint(1) NOT NULL,
  `toutiaoapp_support` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `modulename` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_music_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_music_reply`;
CREATE TABLE `ims_music_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url` varchar(300) NOT NULL,
  `hqurl` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_news_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_news_reply`;
CREATE TABLE `ims_news_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `parent_id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumb` varchar(500) NOT NULL,
  `content` mediumtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `displayorder` int(10) NOT NULL,
  `incontent` tinyint(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  `media_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_phoneapp_versions
-- ----------------------------
DROP TABLE IF EXISTS `ims_phoneapp_versions`;
CREATE TABLE `ims_phoneapp_versions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `version` varchar(20) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `modules` text,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `version` (`version`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_profile_fields
-- ----------------------------
DROP TABLE IF EXISTS `ims_profile_fields`;
CREATE TABLE `ims_profile_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `displayorder` smallint(6) NOT NULL,
  `required` tinyint(1) NOT NULL,
  `unchangeable` tinyint(1) NOT NULL,
  `showinregister` tinyint(1) NOT NULL,
  `field_length` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_profile_fields
-- ----------------------------
BEGIN;
INSERT INTO `ims_profile_fields` VALUES (1, 'realname', 1, '真实姓名', '', 0, 1, 1, 1, 0);
INSERT INTO `ims_profile_fields` VALUES (2, 'nickname', 1, '昵称', '', 1, 1, 0, 1, 0);
INSERT INTO `ims_profile_fields` VALUES (3, 'avatar', 1, '头像', '', 1, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (4, 'qq', 1, 'QQ号', '', 0, 0, 0, 1, 0);
INSERT INTO `ims_profile_fields` VALUES (5, 'mobile', 1, '手机号码', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (6, 'vip', 1, 'VIP级别', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (7, 'gender', 1, '性别', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (8, 'birthyear', 1, '出生生日', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (9, 'constellation', 1, '星座', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (10, 'zodiac', 1, '生肖', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (11, 'telephone', 1, '固定电话', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (12, 'idcard', 1, '证件号码', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (13, 'studentid', 1, '学号', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (14, 'grade', 1, '班级', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (15, 'address', 1, '邮寄地址', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (16, 'zipcode', 1, '邮编', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (17, 'nationality', 1, '国籍', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (18, 'resideprovince', 1, '居住地址', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (19, 'graduateschool', 1, '毕业学校', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (20, 'company', 1, '公司', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (21, 'education', 1, '学历', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (22, 'occupation', 1, '职业', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (23, 'position', 1, '职位', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (24, 'revenue', 1, '年收入', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (25, 'affectivestatus', 1, '情感状态', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (26, 'lookingfor', 1, ' 交友目的', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (27, 'bloodtype', 1, '血型', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (28, 'height', 1, '身高', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (29, 'weight', 1, '体重', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (30, 'alipay', 1, '支付宝帐号', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (31, 'msn', 1, 'MSN', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (32, 'email', 1, '电子邮箱', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (33, 'taobao', 1, '阿里旺旺', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (34, 'site', 1, '主页', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (35, 'bio', 1, '自我介绍', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (36, 'interest', 1, '兴趣爱好', '', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (37, 'birthmonth', 0, '出生月份', '出生月份', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (38, 'birthday', 0, '出生日期', '出生日期', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (39, 'credit1', 0, '积分', '积分', 0, 0, 0, 0, 0);
INSERT INTO `ims_profile_fields` VALUES (40, 'credit2', 0, '余额', '余额', 0, 0, 0, 0, 0);
COMMIT;

-- ----------------------------
-- Table structure for ims_qrcode
-- ----------------------------
DROP TABLE IF EXISTS `ims_qrcode`;
CREATE TABLE `ims_qrcode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `extra` int(10) unsigned NOT NULL,
  `qrcid` bigint(20) NOT NULL,
  `scene_str` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `model` tinyint(1) unsigned NOT NULL,
  `ticket` varchar(250) NOT NULL,
  `url` varchar(256) NOT NULL,
  `expire` int(10) unsigned NOT NULL,
  `subnum` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_qrcid` (`qrcid`),
  KEY `uniacid` (`uniacid`),
  KEY `ticket` (`ticket`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_qrcode_stat
-- ----------------------------
DROP TABLE IF EXISTS `ims_qrcode_stat`;
CREATE TABLE `ims_qrcode_stat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `qid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `qrcid` bigint(20) unsigned NOT NULL,
  `scene_str` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_rule
-- ----------------------------
DROP TABLE IF EXISTS `ims_rule`;
CREATE TABLE `ims_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `displayorder` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `containtype` varchar(100) NOT NULL,
  `reply_type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_rule
-- ----------------------------
BEGIN;
INSERT INTO `ims_rule` VALUES (1, 0, '城市天气', 'userapi', 255, 1, '', 0);
INSERT INTO `ims_rule` VALUES (2, 0, '百度百科', 'userapi', 255, 1, '', 0);
INSERT INTO `ims_rule` VALUES (3, 0, '即时翻译', 'userapi', 255, 1, '', 0);
INSERT INTO `ims_rule` VALUES (4, 0, '今日老黄历', 'userapi', 255, 1, '', 0);
INSERT INTO `ims_rule` VALUES (5, 0, '看新闻', 'userapi', 255, 1, '', 0);
INSERT INTO `ims_rule` VALUES (6, 0, '快递查询', 'userapi', 255, 1, '', 0);
INSERT INTO `ims_rule` VALUES (7, 1, '个人中心入口设置', 'cover', 0, 1, '', 0);
INSERT INTO `ims_rule` VALUES (8, 1, '微擎团队入口设置', 'cover', 0, 1, '', 0);
COMMIT;

-- ----------------------------
-- Table structure for ims_rule_keyword
-- ----------------------------
DROP TABLE IF EXISTS `ims_rule_keyword`;
CREATE TABLE `ims_rule_keyword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_content` (`content`),
  KEY `rid` (`rid`),
  KEY `idx_rid` (`rid`),
  KEY `idx_uniacid_type_content` (`uniacid`,`type`,`content`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_rule_keyword
-- ----------------------------
BEGIN;
INSERT INTO `ims_rule_keyword` VALUES (1, 1, 0, 'userapi', '^.+天气$', 3, 255, 1);
INSERT INTO `ims_rule_keyword` VALUES (2, 2, 0, 'userapi', '^百科.+$', 3, 255, 1);
INSERT INTO `ims_rule_keyword` VALUES (3, 2, 0, 'userapi', '^定义.+$', 3, 255, 1);
INSERT INTO `ims_rule_keyword` VALUES (4, 3, 0, 'userapi', '^@.+$', 3, 255, 1);
INSERT INTO `ims_rule_keyword` VALUES (5, 4, 0, 'userapi', '日历', 1, 255, 1);
INSERT INTO `ims_rule_keyword` VALUES (6, 4, 0, 'userapi', '万年历', 1, 255, 1);
INSERT INTO `ims_rule_keyword` VALUES (7, 4, 0, 'userapi', '黄历', 1, 255, 1);
INSERT INTO `ims_rule_keyword` VALUES (8, 4, 0, 'userapi', '几号', 1, 255, 1);
INSERT INTO `ims_rule_keyword` VALUES (9, 5, 0, 'userapi', '新闻', 1, 255, 1);
INSERT INTO `ims_rule_keyword` VALUES (10, 6, 0, 'userapi', '^(申通|圆通|中通|汇通|韵达|顺丰|EMS) *[a-z0-9]{1,}$', 3, 255, 1);
INSERT INTO `ims_rule_keyword` VALUES (11, 7, 1, 'cover', '个人中心', 1, 0, 1);
INSERT INTO `ims_rule_keyword` VALUES (12, 8, 1, 'cover', '首页', 1, 0, 1);
COMMIT;

-- ----------------------------
-- Table structure for ims_site_article
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_article`;
CREATE TABLE `ims_site_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `kid` int(10) unsigned NOT NULL,
  `iscommend` tinyint(1) NOT NULL,
  `ishot` tinyint(1) unsigned NOT NULL,
  `pcate` int(10) unsigned NOT NULL,
  `ccate` int(10) unsigned NOT NULL,
  `template` varchar(300) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `incontent` tinyint(1) NOT NULL,
  `source` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `displayorder` int(10) unsigned NOT NULL,
  `linkurl` varchar(500) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `edittime` int(10) NOT NULL,
  `click` int(10) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `credit` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_iscommend` (`iscommend`),
  KEY `idx_ishot` (`ishot`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_article_comment
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_article_comment`;
CREATE TABLE `ims_site_article_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `articleid` int(10) unsigned NOT NULL,
  `parentid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `content` text,
  `is_read` tinyint(1) NOT NULL,
  `iscomment` tinyint(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `articleid` (`articleid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_category
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_category`;
CREATE TABLE `ims_site_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `nid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `parentid` int(10) unsigned NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `icon` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `styleid` int(10) unsigned NOT NULL,
  `linkurl` varchar(500) NOT NULL,
  `ishomepage` tinyint(1) NOT NULL,
  `icontype` tinyint(1) unsigned NOT NULL,
  `css` varchar(500) NOT NULL,
  `multiid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_multi
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_multi`;
CREATE TABLE `ims_site_multi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `styleid` int(10) unsigned NOT NULL,
  `site_info` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `bindhost` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `bindhost` (`bindhost`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_multi
-- ----------------------------
BEGIN;
INSERT INTO `ims_site_multi` VALUES (1, 1, '微擎团队', 1, '', 1, '');
COMMIT;

-- ----------------------------
-- Table structure for ims_site_nav
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_nav`;
CREATE TABLE `ims_site_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `section` tinyint(4) NOT NULL,
  `module` varchar(50) NOT NULL,
  `displayorder` smallint(5) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `position` tinyint(4) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(500) NOT NULL,
  `css` varchar(1000) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `categoryid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `multiid` (`multiid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_page
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_page`;
CREATE TABLE `ims_site_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `params` longtext NOT NULL,
  `html` longtext NOT NULL,
  `multipage` longtext NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `goodnum` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `multiid` (`multiid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_slide
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_slide`;
CREATE TABLE `ims_site_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `displayorder` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `multiid` (`multiid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_store_cash_log
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_store_cash_log`;
CREATE TABLE `ims_site_store_cash_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `founder_uid` int(10) NOT NULL,
  `number` char(30) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `founder_uid` (`founder_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_store_cash_order
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_store_cash_order`;
CREATE TABLE `ims_site_store_cash_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` char(30) NOT NULL,
  `founder_uid` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `goods_id` int(10) NOT NULL,
  `order_amount` decimal(10,2) NOT NULL,
  `cash_log_id` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `founder_uid` (`founder_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_store_create_account
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_store_create_account`;
CREATE TABLE `ims_site_store_create_account` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `endtime` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_store_goods
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_store_goods`;
CREATE TABLE `ims_site_store_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `title` varchar(100) NOT NULL,
  `module` varchar(50) NOT NULL,
  `account_num` int(10) NOT NULL,
  `wxapp_num` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` varchar(15) NOT NULL,
  `slide` varchar(1000) NOT NULL,
  `category_id` int(10) NOT NULL,
  `title_initial` varchar(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  `synopsis` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `module_group` int(10) NOT NULL,
  `api_num` int(10) NOT NULL,
  `user_group` int(10) NOT NULL,
  `user_group_price` varchar(1000) DEFAULT NULL,
  `account_group` int(10) NOT NULL,
  `is_wish` tinyint(1) NOT NULL,
  `logo` varchar(300) NOT NULL,
  `platform_num` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module` (`module`),
  KEY `category_id` (`category_id`),
  KEY `price` (`price`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_store_goods_cloud
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_store_goods_cloud`;
CREATE TABLE `ims_site_store_goods_cloud` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cloud_id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `logo` varchar(300) NOT NULL,
  `wish_branch` int(10) NOT NULL,
  `is_edited` tinyint(1) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL,
  `branchs` varchar(6000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cloud_id` (`cloud_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_store_order
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_store_order`;
CREATE TABLE `ims_site_store_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` varchar(28) NOT NULL,
  `goodsid` int(10) NOT NULL,
  `duration` int(10) NOT NULL,
  `buyer` varchar(50) NOT NULL,
  `buyerid` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `changeprice` tinyint(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `endtime` int(15) NOT NULL,
  `wxapp` int(15) NOT NULL,
  `is_wish` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `goodid` (`goodsid`),
  KEY `buyerid` (`buyerid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_styles
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_styles`;
CREATE TABLE `ims_site_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `templateid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_styles
-- ----------------------------
BEGIN;
INSERT INTO `ims_site_styles` VALUES (1, 1, 1, '微站默认模板_gC5C');
COMMIT;

-- ----------------------------
-- Table structure for ims_site_styles_vars
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_styles_vars`;
CREATE TABLE `ims_site_styles_vars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `templateid` int(10) unsigned NOT NULL,
  `styleid` int(10) unsigned NOT NULL,
  `variable` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_site_templates
-- ----------------------------
DROP TABLE IF EXISTS `ims_site_templates`;
CREATE TABLE `ims_site_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `version` varchar(64) NOT NULL,
  `description` varchar(500) NOT NULL,
  `author` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `sections` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_site_templates
-- ----------------------------
BEGIN;
INSERT INTO `ims_site_templates` VALUES (1, 'default', '微站默认模板', '', '由微擎提供默认微站模板套系', '飞鹰团队', 'http://www.nyabc.net', '1', 0);
COMMIT;

-- ----------------------------
-- Table structure for ims_stat_fans
-- ----------------------------
DROP TABLE IF EXISTS `ims_stat_fans`;
CREATE TABLE `ims_stat_fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `new` int(10) unsigned NOT NULL,
  `cancel` int(10) unsigned NOT NULL,
  `cumulate` int(10) NOT NULL,
  `date` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`,`date`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_stat_fans
-- ----------------------------
BEGIN;
INSERT INTO `ims_stat_fans` VALUES (1, 1, 0, 0, 0, '20200413');
INSERT INTO `ims_stat_fans` VALUES (2, 1, 0, 0, 0, '20200412');
INSERT INTO `ims_stat_fans` VALUES (3, 1, 0, 0, 0, '20200411');
INSERT INTO `ims_stat_fans` VALUES (4, 1, 0, 0, 0, '20200410');
INSERT INTO `ims_stat_fans` VALUES (5, 1, 0, 0, 0, '20200409');
INSERT INTO `ims_stat_fans` VALUES (6, 1, 0, 0, 0, '20200408');
INSERT INTO `ims_stat_fans` VALUES (7, 1, 0, 0, 0, '20200407');
COMMIT;

-- ----------------------------
-- Table structure for ims_stat_keyword
-- ----------------------------
DROP TABLE IF EXISTS `ims_stat_keyword`;
CREATE TABLE `ims_stat_keyword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` varchar(10) NOT NULL,
  `kid` int(10) unsigned NOT NULL,
  `hit` int(10) unsigned NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_stat_msg_history
-- ----------------------------
DROP TABLE IF EXISTS `ims_stat_msg_history`;
CREATE TABLE `ims_stat_msg_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `kid` int(10) unsigned NOT NULL,
  `from_user` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `type` varchar(10) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_stat_rule
-- ----------------------------
DROP TABLE IF EXISTS `ims_stat_rule`;
CREATE TABLE `ims_stat_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `hit` int(10) unsigned NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_stat_visit
-- ----------------------------
DROP TABLE IF EXISTS `ims_stat_visit`;
CREATE TABLE `ims_stat_visit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `module` varchar(100) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `ip_count` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`),
  KEY `module` (`module`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_stat_visit
-- ----------------------------
BEGIN;
INSERT INTO `ims_stat_visit` VALUES (1, 0, '', 31, 20200414, 'web', 1);
INSERT INTO `ims_stat_visit` VALUES (2, 1, 'we7_account', 9, 20200414, 'web', 0);
INSERT INTO `ims_stat_visit` VALUES (3, 1, '', 2, 20200414, 'web', 0);
COMMIT;

-- ----------------------------
-- Table structure for ims_stat_visit_ip
-- ----------------------------
DROP TABLE IF EXISTS `ims_stat_visit_ip`;
CREATE TABLE `ims_stat_visit_ip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` bigint(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `module` varchar(100) NOT NULL,
  `date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip_date_module_uniacid` (`ip`,`date`,`module`,`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_stat_visit_ip
-- ----------------------------
BEGIN;
INSERT INTO `ims_stat_visit_ip` VALUES (1, 2130706433, 0, 'web', '', 20200414);
COMMIT;

-- ----------------------------
-- Table structure for ims_system_stat_visit
-- ----------------------------
DROP TABLE IF EXISTS `ims_system_stat_visit`;
CREATE TABLE `ims_system_stat_visit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `modulename` varchar(100) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `displayorder` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `updatetime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_uni_account
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_account`;
CREATE TABLE `ims_uni_account` (
  `uniacid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `default_acid` int(10) unsigned NOT NULL,
  `rank` int(10) DEFAULT NULL,
  `title_initial` varchar(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_uni_account
-- ----------------------------
BEGIN;
INSERT INTO `ims_uni_account` VALUES (1, -1, '默认测试，正式使用请停用此测试号之后新建', '一个朝气蓬勃的团队', 1, NULL, 'W', 0);
COMMIT;

-- ----------------------------
-- Table structure for ims_uni_account_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_account_group`;
CREATE TABLE `ims_uni_account_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `groupid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_uni_account_menus
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_account_menus`;
CREATE TABLE `ims_uni_account_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `menuid` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `sex` tinyint(3) unsigned NOT NULL,
  `group_id` int(10) NOT NULL,
  `client_platform_type` tinyint(3) unsigned NOT NULL,
  `area` varchar(50) NOT NULL,
  `data` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `isdeleted` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `menuid` (`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_uni_account_modules
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_account_modules`;
CREATE TABLE `ims_uni_account_modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `settings` text NOT NULL,
  `shortcut` tinyint(1) unsigned NOT NULL,
  `displayorder` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_module` (`module`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_uni_account_modules_shortcut
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_account_modules_shortcut`;
CREATE TABLE `ims_uni_account_modules_shortcut` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `url` varchar(250) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `version_id` int(10) unsigned NOT NULL,
  `module_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_uni_account_users
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_account_users`;
CREATE TABLE `ims_uni_account_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `role` varchar(255) NOT NULL,
  `rank` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_memberid` (`uid`),
  KEY `uniacid` (`uniacid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_uni_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_group`;
CREATE TABLE `ims_uni_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_uid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `modules` text NOT NULL,
  `templates` varchar(5000) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_uni_group
-- ----------------------------
BEGIN;
INSERT INTO `ims_uni_group` VALUES (1, 0, '体验套餐服务', 'N;', 'N;', 0, 0);
COMMIT;

-- ----------------------------
-- Table structure for ims_uni_link_uniacid
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_link_uniacid`;
CREATE TABLE `ims_uni_link_uniacid` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `link_uniacid` int(10) NOT NULL,
  `version_id` int(10) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_uni_modules
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_modules`;
CREATE TABLE `ims_uni_modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_uni_modules
-- ----------------------------
BEGIN;
INSERT INTO `ims_uni_modules` VALUES (1, 1, 'fm_jiaoyu_plugin_sale');
INSERT INTO `ims_uni_modules` VALUES (2, 1, 'fm_jiaoyu');
COMMIT;

-- ----------------------------
-- Table structure for ims_uni_settings
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_settings`;
CREATE TABLE `ims_uni_settings` (
  `uniacid` int(10) unsigned NOT NULL,
  `passport` varchar(200) NOT NULL,
  `oauth` varchar(100) NOT NULL,
  `jsauth_acid` int(10) unsigned NOT NULL,
  `uc` varchar(700) NOT NULL,
  `notify` varchar(2000) NOT NULL,
  `creditnames` varchar(500) NOT NULL,
  `creditbehaviors` varchar(500) NOT NULL,
  `welcome` varchar(60) NOT NULL,
  `default` varchar(60) NOT NULL,
  `default_message` varchar(2000) NOT NULL,
  `payment` text NOT NULL,
  `stat` varchar(300) NOT NULL,
  `default_site` int(10) unsigned DEFAULT NULL,
  `sync` tinyint(3) unsigned NOT NULL,
  `recharge` varchar(500) NOT NULL,
  `tplnotice` varchar(2000) NOT NULL,
  `grouplevel` tinyint(3) unsigned NOT NULL,
  `mcplugin` varchar(500) NOT NULL,
  `exchange_enable` tinyint(3) unsigned NOT NULL,
  `coupon_type` tinyint(3) unsigned NOT NULL,
  `menuset` text NOT NULL,
  `statistics` varchar(100) NOT NULL,
  `bind_domain` varchar(200) NOT NULL,
  `comment_status` tinyint(1) NOT NULL,
  `reply_setting` tinyint(4) NOT NULL,
  `default_module` varchar(100) NOT NULL,
  `attachment_limit` int(11) DEFAULT NULL,
  `attachment_size` varchar(20) DEFAULT NULL,
  `sync_member` tinyint(1) NOT NULL,
  `remote` varchar(2000) NOT NULL DEFAULT '',
  PRIMARY KEY (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_uni_settings
-- ----------------------------
BEGIN;
INSERT INTO `ims_uni_settings` VALUES (1, 'a:3:{s:8:\"focusreg\";i:0;s:4:\"item\";s:5:\"email\";s:4:\"type\";s:8:\"password\";}', '', 0, 'a:1:{s:6:\"status\";i:0;}', 'a:1:{s:3:\"sms\";a:2:{s:7:\"balance\";i:0;s:9:\"signature\";s:0:\"\";}}', 'a:5:{s:7:\"credit1\";a:2:{s:5:\"title\";s:6:\"积分\";s:7:\"enabled\";i:1;}s:7:\"credit2\";a:2:{s:5:\"title\";s:6:\"余额\";s:7:\"enabled\";i:1;}s:7:\"credit3\";a:2:{s:5:\"title\";s:0:\"\";s:7:\"enabled\";i:0;}s:7:\"credit4\";a:2:{s:5:\"title\";s:0:\"\";s:7:\"enabled\";i:0;}s:7:\"credit5\";a:2:{s:5:\"title\";s:0:\"\";s:7:\"enabled\";i:0;}}', 'a:2:{s:8:\"activity\";s:7:\"credit1\";s:8:\"currency\";s:7:\"credit2\";}', '', '', '', 'a:4:{s:6:\"credit\";a:3:{s:6:\"switch\";b:0;s:15:\"recharge_switch\";b:0;s:10:\"pay_switch\";b:0;}s:6:\"alipay\";a:6:{s:6:\"switch\";b:0;s:7:\"account\";s:0:\"\";s:7:\"partner\";s:0:\"\";s:6:\"secret\";s:0:\"\";s:15:\"recharge_switch\";b:0;s:10:\"pay_switch\";b:0;}s:6:\"wechat\";a:7:{s:6:\"switch\";b:0;s:7:\"account\";b:0;s:7:\"signkey\";s:0:\"\";s:7:\"partner\";s:0:\"\";s:3:\"key\";s:0:\"\";s:15:\"recharge_switch\";b:0;s:10:\"pay_switch\";b:0;}s:8:\"delivery\";a:3:{s:6:\"switch\";b:0;s:15:\"recharge_switch\";b:0;s:10:\"pay_switch\";b:0;}}', '', 1, 0, '', '', 0, '', 0, 0, '', '', '', 0, 0, '', NULL, NULL, 0, '');
COMMIT;

-- ----------------------------
-- Table structure for ims_uni_verifycode
-- ----------------------------
DROP TABLE IF EXISTS `ims_uni_verifycode`;
CREATE TABLE `ims_uni_verifycode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `verifycode` varchar(6) NOT NULL,
  `total` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `failed_count` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_userapi_cache
-- ----------------------------
DROP TABLE IF EXISTS `ims_userapi_cache`;
CREATE TABLE `ims_userapi_cache` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_userapi_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_userapi_reply`;
CREATE TABLE `ims_userapi_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `description` varchar(300) NOT NULL,
  `apiurl` varchar(300) NOT NULL,
  `token` varchar(32) NOT NULL,
  `default_text` varchar(100) NOT NULL,
  `cachetime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_userapi_reply
-- ----------------------------
BEGIN;
INSERT INTO `ims_userapi_reply` VALUES (1, 1, '\"城市名+天气\", 如: \"北京天气\"', 'weather.php', '', '', 0);
INSERT INTO `ims_userapi_reply` VALUES (2, 2, '\"百科+查询内容\" 或 \"定义+查询内容\", 如: \"百科姚明\", \"定义自行车\"', 'baike.php', '', '', 0);
INSERT INTO `ims_userapi_reply` VALUES (3, 3, '\"@查询内容(中文或英文)\"', 'translate.php', '', '', 0);
INSERT INTO `ims_userapi_reply` VALUES (4, 4, '\"日历\", \"万年历\", \"黄历\"或\"几号\"', 'calendar.php', '', '', 0);
INSERT INTO `ims_userapi_reply` VALUES (5, 5, '\"新闻\"', 'news.php', '', '', 0);
INSERT INTO `ims_userapi_reply` VALUES (6, 6, '\"快递+单号\", 如: \"申通1200041125\"', 'express.php', '', '', 0);
COMMIT;

-- ----------------------------
-- Table structure for ims_users
-- ----------------------------
DROP TABLE IF EXISTS `ims_users`;
CREATE TABLE `ims_users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupid` int(10) unsigned NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `salt` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `joindate` int(10) unsigned NOT NULL,
  `joinip` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastvisit` int(10) unsigned NOT NULL,
  `lastip` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `remark` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `starttime` int(10) unsigned NOT NULL,
  `endtime` int(10) unsigned NOT NULL,
  `owner_uid` int(10) NOT NULL,
  `founder_groupid` tinyint(4) NOT NULL,
  `credit1` decimal(11,2) DEFAULT '0.00' COMMENT '用户积分',
  `credit2` decimal(11,2) DEFAULT '0.00' COMMENT '交易币',
  `tid` int(10) NOT NULL DEFAULT '0',
  `schoolid` int(10) NOT NULL DEFAULT '0',
  `uniacid` int(10) NOT NULL DEFAULT '0',
  `register_type` tinyint(3) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `welcome_link` tinyint(4) NOT NULL,
  `is_bind` tinyint(1) NOT NULL,
  `notice_setting` varchar(5000) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_users
-- ----------------------------
BEGIN;
INSERT INTO `ims_users` VALUES (1, 1, 'admin', '6b23d4cdd7aa2c0f71d1415f79fba98cd6ec3520', '0fae31b4', 0, 0, 1586843309, '', 1586843351, '127.0.0.1', '', 0, 0, 0, 0, 0.00, 0.00, 0, 0, 0, 0, '', 0, 0, '');
COMMIT;

-- ----------------------------
-- Table structure for ims_users_bind
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_bind`;
CREATE TABLE `ims_users_bind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `bind_sign` varchar(50) NOT NULL,
  `third_type` tinyint(4) NOT NULL,
  `third_nickname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `bind_sign` (`bind_sign`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_create_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_create_group`;
CREATE TABLE `ims_users_create_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `maxaccount` int(10) unsigned NOT NULL,
  `maxwxapp` int(10) unsigned NOT NULL,
  `maxwebapp` int(10) unsigned NOT NULL,
  `maxphoneapp` int(10) unsigned NOT NULL,
  `maxxzapp` int(10) unsigned NOT NULL,
  `maxaliapp` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `maxbaiduapp` int(10) NOT NULL,
  `maxtoutiaoapp` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_extra_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_extra_group`;
CREATE TABLE `ims_users_extra_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `uni_group_id` int(10) unsigned NOT NULL,
  `create_group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `uni_group_id` (`uni_group_id`),
  KEY `create_group_id` (`create_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_extra_limit
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_extra_limit`;
CREATE TABLE `ims_users_extra_limit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `maxaccount` int(10) unsigned NOT NULL,
  `maxwxapp` int(10) unsigned NOT NULL,
  `maxwebapp` int(10) unsigned NOT NULL,
  `maxphoneapp` int(10) unsigned NOT NULL,
  `maxxzapp` int(10) unsigned NOT NULL,
  `maxaliapp` int(10) unsigned NOT NULL,
  `timelimit` int(10) unsigned NOT NULL,
  `maxbaiduapp` int(10) NOT NULL,
  `maxtoutiaoapp` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_extra_modules
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_extra_modules`;
CREATE TABLE `ims_users_extra_modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `support` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `module_name` (`module_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_extra_templates
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_extra_templates`;
CREATE TABLE `ims_users_extra_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `template_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `template_id` (`template_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_failed_login
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_failed_login`;
CREATE TABLE `ims_users_failed_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `username` varchar(32) NOT NULL,
  `count` tinyint(1) unsigned NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip_username` (`ip`,`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_founder_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_founder_group`;
CREATE TABLE `ims_users_founder_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `package` varchar(5000) NOT NULL,
  `maxaccount` int(10) unsigned NOT NULL,
  `maxsubaccount` int(10) unsigned NOT NULL,
  `timelimit` int(10) unsigned NOT NULL,
  `maxwxapp` int(10) unsigned NOT NULL,
  `maxwebapp` int(10) NOT NULL DEFAULT '0',
  `maxphoneapp` int(10) NOT NULL,
  `maxxzapp` int(10) NOT NULL,
  `maxaliapp` int(10) NOT NULL,
  `maxbaiduapp` int(10) NOT NULL,
  `maxtoutiaoapp` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_founder_own_create_groups
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_founder_own_create_groups`;
CREATE TABLE `ims_users_founder_own_create_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `founder_uid` int(10) unsigned NOT NULL,
  `create_group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `founder_uid` (`founder_uid`),
  KEY `create_group_id` (`create_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_founder_own_uni_groups
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_founder_own_uni_groups`;
CREATE TABLE `ims_users_founder_own_uni_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `founder_uid` int(10) unsigned NOT NULL,
  `uni_group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `founder_uid` (`founder_uid`),
  KEY `uni_group_id` (`uni_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_founder_own_users
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_founder_own_users`;
CREATE TABLE `ims_users_founder_own_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `founder_uid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `founder_uid` (`founder_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_founder_own_users_groups
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_founder_own_users_groups`;
CREATE TABLE `ims_users_founder_own_users_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `founder_uid` int(10) unsigned NOT NULL,
  `users_group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `founder_uid` (`founder_uid`),
  KEY `users_group_id` (`users_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_group`;
CREATE TABLE `ims_users_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_uid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `package` varchar(5000) NOT NULL,
  `maxaccount` int(10) unsigned NOT NULL,
  `maxsubaccount` int(10) unsigned NOT NULL,
  `timelimit` int(10) unsigned NOT NULL,
  `maxwxapp` int(10) unsigned NOT NULL,
  `maxwebapp` int(10) NOT NULL DEFAULT '0',
  `maxphoneapp` int(10) NOT NULL,
  `maxxzapp` int(10) NOT NULL,
  `maxaliapp` int(10) NOT NULL,
  `maxbaiduapp` int(10) NOT NULL,
  `maxtoutiaoapp` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_invitation
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_invitation`;
CREATE TABLE `ims_users_invitation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(64) NOT NULL,
  `fromuid` int(10) unsigned NOT NULL,
  `inviteuid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_lastuse
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_lastuse`;
CREATE TABLE `ims_users_lastuse` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `uniacid` int(10) DEFAULT NULL,
  `modulename` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ims_users_lastuse
-- ----------------------------
BEGIN;
INSERT INTO `ims_users_lastuse` VALUES (1, 1, 1, '', 'account_display');
INSERT INTO `ims_users_lastuse` VALUES (2, 1, 1, 'fm_jiaoyu', 'module_display');
COMMIT;

-- ----------------------------
-- Table structure for ims_users_permission
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_permission`;
CREATE TABLE `ims_users_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `type` varchar(100) NOT NULL,
  `permission` varchar(10000) NOT NULL,
  `url` varchar(255) NOT NULL,
  `modules` text NOT NULL,
  `templates` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_users_profile
-- ----------------------------
DROP TABLE IF EXISTS `ims_users_profile`;
CREATE TABLE `ims_users_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `edittime` int(10) NOT NULL,
  `realname` varchar(10) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `fakeid` varchar(30) NOT NULL,
  `vip` tinyint(3) unsigned NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthyear` smallint(6) unsigned NOT NULL,
  `birthmonth` tinyint(3) unsigned NOT NULL,
  `birthday` tinyint(3) unsigned NOT NULL,
  `constellation` varchar(10) NOT NULL,
  `zodiac` varchar(5) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `idcard` varchar(30) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `resideprovince` varchar(30) NOT NULL,
  `residecity` varchar(30) NOT NULL,
  `residedist` varchar(30) NOT NULL,
  `graduateschool` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `education` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `revenue` varchar(10) NOT NULL,
  `affectivestatus` varchar(30) NOT NULL,
  `lookingfor` varchar(255) NOT NULL,
  `bloodtype` varchar(5) NOT NULL,
  `height` varchar(5) NOT NULL,
  `weight` varchar(5) NOT NULL,
  `alipay` varchar(30) NOT NULL,
  `msn` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `taobao` varchar(30) NOT NULL,
  `site` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `interest` text NOT NULL,
  `workerid` varchar(64) NOT NULL,
  `is_send_mobile_status` tinyint(3) NOT NULL,
  `send_expire_status` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_video_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_video_reply`;
CREATE TABLE `ims_video_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `mediaid` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_voice_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_voice_reply`;
CREATE TABLE `ims_voice_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `mediaid` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_wechat_attachment
-- ----------------------------
DROP TABLE IF EXISTS `ims_wechat_attachment`;
CREATE TABLE `ims_wechat_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `media_id` varchar(255) NOT NULL,
  `width` int(10) unsigned NOT NULL,
  `height` int(10) unsigned NOT NULL,
  `type` varchar(15) NOT NULL,
  `model` varchar(25) NOT NULL,
  `tag` varchar(5000) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `module_upload_dir` varchar(100) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `media_id` (`media_id`),
  KEY `acid` (`acid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_wechat_news
-- ----------------------------
DROP TABLE IF EXISTS `ims_wechat_news`;
CREATE TABLE `ims_wechat_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned DEFAULT NULL,
  `attach_id` int(10) unsigned NOT NULL,
  `thumb_media_id` varchar(60) NOT NULL,
  `thumb_url` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(30) NOT NULL,
  `digest` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `content_source_url` varchar(200) NOT NULL,
  `show_cover_pic` tinyint(3) unsigned NOT NULL,
  `url` varchar(200) NOT NULL,
  `displayorder` int(2) NOT NULL,
  `need_open_comment` tinyint(1) NOT NULL,
  `only_fans_can_comment` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `attach_id` (`attach_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_wx_school_address
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_address`;
CREATE TABLE `ims_wx_school_address` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `openid` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `province` varchar(40) NOT NULL,
  `city` varchar(40) NOT NULL,
  `county` varchar(40) NOT NULL,
  `address` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_allcamera
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_allcamera`;
CREATE TABLE `ims_wx_school_allcamera` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `kcid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '画面名称',
  `conet` text COMMENT '说明',
  `videopic` varchar(1000) NOT NULL DEFAULT '' COMMENT '监控地址',
  `videourl` varchar(1000) NOT NULL DEFAULT '' COMMENT '监控地址',
  `starttime1` varchar(50) NOT NULL,
  `endtime1` varchar(50) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `allowpy` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1允许2拒绝',
  `videotype` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1公共2指定班级',
  `bj_id` text COMMENT '关联班级组',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1监控2课程直播',
  `click` int(10) unsigned NOT NULL COMMENT '查看量',
  `ssort` int(10) unsigned NOT NULL COMMENT '排序',
  `startime2` varchar(50) NOT NULL,
  `startime3` varchar(50) NOT NULL,
  `endtime2` varchar(50) NOT NULL,
  `endtime3` varchar(50) NOT NULL,
  `is_pay` tinyint(1) NOT NULL DEFAULT '2' COMMENT '单独付费与否',
  `price_one` float NOT NULL,
  `price_one_cun` float NOT NULL,
  `price_all` float NOT NULL,
  `price_all_cun` float NOT NULL,
  `days` int(11) unsigned DEFAULT '10',
  `is_try` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否允许试看',
  `try_time` int(11) unsigned DEFAULT '30' COMMENT '试看时间',
  `payweid` int(11) unsigned DEFAULT NULL COMMENT '收款公众号',
  `starttime2` varchar(50) NOT NULL,
  `starttime3` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_ans_remark
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_ans_remark`;
CREATE TABLE `ims_wx_school_ans_remark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `tname` varchar(30) NOT NULL,
  `sid` int(11) NOT NULL,
  `zyid` int(11) NOT NULL,
  `tmid` int(11) NOT NULL,
  `type` int(3) NOT NULL COMMENT '1是电脑创建的作业2是手机创建的作业',
  `content` varchar(500) NOT NULL,
  `createtime` int(11) NOT NULL,
  `audio` varchar(1000) NOT NULL,
  `audiotime` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_answers
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_answers`;
CREATE TABLE `ims_wx_school_answers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `schoolid` int(10) NOT NULL,
  `zyid` int(10) NOT NULL COMMENT '问题id',
  `sid` int(10) NOT NULL,
  `tid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tmid` int(10) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1回答2单选3多选4图片5语音6视频',
  `MyAnswer` varchar(2000) NOT NULL,
  `createtime` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_apartment
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_apartment`;
CREATE TABLE `ims_wx_school_apartment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `ssort` int(11) NOT NULL,
  `tid` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_app
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_app`;
CREATE TABLE `ims_wx_school_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `bigdata` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tuiguang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tuan` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `zhuli` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_aproom
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_aproom`;
CREATE TABLE `ims_wx_school_aproom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `apid` int(11) NOT NULL COMMENT '楼栋id',
  `noon_start` varchar(20) NOT NULL,
  `noon_end` varchar(20) NOT NULL,
  `night_start` varchar(20) NOT NULL,
  `night_end` varchar(20) NOT NULL,
  `ssort` int(11) NOT NULL,
  `floornum` int(11) NOT NULL,
  `noon_deadline` varchar(20) NOT NULL COMMENT '午间归寝死限',
  `night_deadline` varchar(20) NOT NULL COMMENT '晚归寝死限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_area
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_area`;
CREATE TABLE `ims_wx_school_area` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `name` varchar(50) NOT NULL COMMENT '区域名称',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `ssort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '显示状态',
  `type` char(20) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_banners
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_banners`;
CREATE TABLE `ims_wx_school_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `uniacid` int(10) unsigned NOT NULL,
  `schoolid` int(11) DEFAULT '0',
  `bannername` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(5000) NOT NULL DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `begintime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `leixing` int(1) NOT NULL DEFAULT '0' COMMENT '0学校,1平台',
  `arr` text COMMENT '列表信息',
  `click` varchar(1000) DEFAULT '' COMMENT '点击量',
  `place` tinyint(1) NOT NULL COMMENT '位置',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_bjq
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_bjq`;
CREATE TABLE `ims_wx_school_bjq` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `content` text NOT NULL COMMENT '详细内容或评价',
  `uid` int(10) unsigned NOT NULL COMMENT '发布者UID',
  `www` varchar(30) NOT NULL DEFAULT '0' COMMENT '0',
  `wx` varchar(30) NOT NULL DEFAULT '0' COMMENT '0',
  `wq` varchar(30) NOT NULL DEFAULT '0' COMMENT '0',
  `bj_id1` int(10) unsigned NOT NULL COMMENT '班级ID1',
  `bj_id2` int(10) unsigned NOT NULL COMMENT '班级ID2',
  `bj_id3` int(10) unsigned NOT NULL COMMENT '班级ID3',
  `sherid` int(10) unsigned NOT NULL COMMENT '所属图文id',
  `shername` varchar(50) DEFAULT '' COMMENT '分享者名字',
  `openid` varchar(30) NOT NULL COMMENT '帖子所属openid',
  `isopen` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型0为班级圈1为评论',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `msgtype` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1文字图片2语音3视频',
  `video` varchar(1000) DEFAULT '',
  `videoimg` varchar(1000) DEFAULT '',
  `plid` int(10) NOT NULL DEFAULT '0',
  `is_private` varchar(3) NOT NULL DEFAULT 'N' COMMENT '禁止评论',
  `audio` varchar(1000) DEFAULT '' COMMENT '音频地址',
  `audiotime` int(10) NOT NULL DEFAULT '0' COMMENT '音频时间',
  `link` varchar(1000) DEFAULT '' COMMENT '外链地址',
  `linkdesc` varchar(200) DEFAULT '' COMMENT '外链标题',
  `hftoname` varchar(100) DEFAULT '',
  `userid` int(10) NOT NULL COMMENT '发布者用户ID',
  `kc_id` int(11) NOT NULL,
  `ali_vod_id` varchar(100) DEFAULT '',
  `is_all` tinyint(3) DEFAULT NULL COMMENT '是否全校可见',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5937 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_booksborrow
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_booksborrow`;
CREATE TABLE `ims_wx_school_booksborrow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `bookname` varchar(200) NOT NULL,
  `worth` varchar(30) NOT NULL,
  `borrowtime` int(11) NOT NULL,
  `status` int(3) NOT NULL,
  `returntime` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_busgps
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_busgps`;
CREATE TABLE `ims_wx_school_busgps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `macid` varchar(200) NOT NULL,
  `lat` decimal(18,10) NOT NULL DEFAULT '0.0000000000' COMMENT '经度',
  `lon` decimal(18,10) NOT NULL DEFAULT '0.0000000000' COMMENT '纬度',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=259596 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_buzhulog
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_buzhulog`;
CREATE TABLE `ims_wx_school_buzhulog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `start_yue` float(8,2) NOT NULL,
  `now_yue` float(8,2) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_camerapl
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_camerapl`;
CREATE TABLE `ims_wx_school_camerapl` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `carmeraid` int(10) unsigned NOT NULL COMMENT '画面ID',
  `userid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `bj_id` int(10) unsigned NOT NULL COMMENT '班级ID',
  `conet` text COMMENT '内容',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1点赞2评论',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=803 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_camerask
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_camerask`;
CREATE TABLE `ims_wx_school_camerask` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `carmeraid` int(10) unsigned NOT NULL COMMENT '画面ID',
  `userid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1视频试看',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_checkdatedetail
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_checkdatedetail`;
CREATE TABLE `ims_wx_school_checkdatedetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `year` int(10) NOT NULL,
  `sum_start` varchar(20) NOT NULL,
  `sum_end` varchar(20) NOT NULL,
  `win_start` varchar(20) NOT NULL,
  `win_end` varchar(20) NOT NULL,
  `holiday` varchar(1000) NOT NULL,
  `checkdatesetid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_checkdateset
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_checkdateset`;
CREATE TABLE `ims_wx_school_checkdateset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) NOT NULL,
  `weid` int(10) NOT NULL,
  `name` varchar(500) NOT NULL,
  `friday` tinyint(3) NOT NULL,
  `saturday` tinyint(3) NOT NULL,
  `sunday` tinyint(3) NOT NULL,
  `holiday` varchar(1000) NOT NULL,
  `bj_id` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_checklog
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_checklog`;
CREATE TABLE `ims_wx_school_checklog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `macid` int(10) unsigned NOT NULL,
  `cardid` varchar(200) NOT NULL DEFAULT '' COMMENT '卡号',
  `sid` int(10) unsigned NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `bj_id` int(10) unsigned NOT NULL,
  `temperature` varchar(10) DEFAULT '',
  `pic` varchar(255) DEFAULT '' COMMENT '图片',
  `type` varchar(50) DEFAULT '' COMMENT '进校类型',
  `leixing` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1进校2离校3迟到4早退',
  `pard` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '1本人2母亲3父亲4爷爷5奶奶6外公7外婆8叔叔9阿姨10其他11老师',
  `createtime` int(10) unsigned NOT NULL,
  `lat` decimal(18,10) NOT NULL DEFAULT '0.0000000000' COMMENT '经度',
  `lon` decimal(18,10) NOT NULL DEFAULT '0.0000000000' COMMENT '纬度',
  `isread` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1已读2未读',
  `pic2` varchar(255) DEFAULT '' COMMENT '图片2',
  `checktype` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1刷卡2微信',
  `isconfirm` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1确认2拒绝',
  `qdtid` int(11) NOT NULL COMMENT '代签userid',
  `sc_ap` tinyint(3) NOT NULL COMMENT '0普通考勤1寝室考勤',
  `apid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `ap_type` tinyint(3) NOT NULL COMMENT '1进寝2离寝',
  `pname` varchar(100) NOT NULL COMMENT '刷卡人名字',
  `bet` varchar(10) NOT NULL COMMENT '距学校距离',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=424484 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_checkmac
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_checkmac`;
CREATE TABLE `ims_wx_school_checkmac` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `macname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `macid` varchar(200) NOT NULL DEFAULT '' COMMENT '设备编号',
  `createtime` int(10) unsigned NOT NULL,
  `is_on` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1启用2不启用',
  `banner` varchar(2000) DEFAULT '',
  `macset` varchar(2000) DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1进校2离校',
  `twmac` varchar(200) NOT NULL DEFAULT '-1',
  `cardtype` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1IC2ID',
  `is_bobao` tinyint(1) NOT NULL DEFAULT '1' COMMENT '播报',
  `is_master` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否全校',
  `bj_id` int(10) unsigned DEFAULT NULL COMMENT '绑定班级ID',
  `js_id` int(10) unsigned DEFAULT NULL COMMENT '教室ID',
  `areaid` int(10) NOT NULL,
  `model_type` tinyint(1) NOT NULL,
  `qh_id` int(10) NOT NULL,
  `exam_plan` varchar(1000) NOT NULL,
  `cityname` varchar(50) NOT NULL,
  `exam_room_name` varchar(200) NOT NULL,
  `apid` int(11) NOT NULL,
  `stu1` int(10) DEFAULT NULL,
  `stu2` int(10) DEFAULT NULL,
  `stu3` int(10) DEFAULT NULL,
  `lastedittime` int(11) DEFAULT NULL COMMENT '最近一次修改时间',
  `is_heartbeat` tinyint(3) DEFAULT NULL COMMENT '是否接收心跳任务',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_checkmac_remote
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_checkmac_remote`;
CREATE TABLE `ims_wx_school_checkmac_remote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `pid` varchar(100) NOT NULL,
  `deviceId` varchar(100) NOT NULL,
  `passType` int(11) NOT NULL,
  `passDeviceId` varchar(255) NOT NULL,
  `cameras` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_checktimeset
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_checktimeset`;
CREATE TABLE `ims_wx_school_checktimeset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `start` varchar(20) NOT NULL,
  `end` varchar(20) NOT NULL,
  `type` tinyint(3) NOT NULL COMMENT '1工作日2周五3周六4周日5特殊上6特殊休',
  `year` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `checkdatesetid` int(11) NOT NULL,
  `out_in` tinyint(1) DEFAULT NULL,
  `s_type` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_chongzhi
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_chongzhi`;
CREATE TABLE `ims_wx_school_chongzhi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `cost` float NOT NULL,
  `chongzhi` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `ssort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_classify
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_classify`;
CREATE TABLE `ims_wx_school_classify` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分校id',
  `sname` varchar(50) NOT NULL,
  `ssort` int(5) NOT NULL,
  `weid` int(10) unsigned NOT NULL,
  `type` char(20) NOT NULL,
  `erwei` varchar(200) NOT NULL DEFAULT '' COMMENT '群二维码',
  `qun` varchar(200) NOT NULL DEFAULT '' COMMENT 'QQ群链接',
  `tid` int(11) unsigned NOT NULL COMMENT '班级主任userid',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `video` varchar(1000) NOT NULL DEFAULT '' COMMENT '教室监控地址',
  `videostart` varchar(50) NOT NULL DEFAULT '',
  `videoend` varchar(50) NOT NULL DEFAULT '',
  `cost` varchar(50) NOT NULL DEFAULT '',
  `video1` varchar(1000) NOT NULL DEFAULT '' COMMENT '教室监控地址1',
  `pname` varchar(50) NOT NULL DEFAULT '' COMMENT '称谓',
  `carmeraid` text COMMENT '说明',
  `videoclick` int(11) unsigned NOT NULL COMMENT '视频点击量',
  `allowpy` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1允许2拒绝',
  `icon` varchar(500) DEFAULT '' COMMENT '图标',
  `start` varchar(1000) DEFAULT '' COMMENT '班级之星',
  `star` varchar(1000) DEFAULT '' COMMENT '班级之星',
  `is_bjzx` tinyint(1) NOT NULL DEFAULT '1' COMMENT '班级之星',
  `qh_bjlist` varchar(1000) DEFAULT '' COMMENT '期号对应班级',
  `qhtype` tinyint(1) NOT NULL DEFAULT '1',
  `sd_start` int(11) NOT NULL,
  `sd_end` int(11) NOT NULL,
  `js_id` int(10) NOT NULL,
  `is_over` tinyint(1) NOT NULL DEFAULT '1',
  `datesetid` int(11) NOT NULL,
  `class_device` varchar(100) NOT NULL COMMENT '分班播报id',
  `is_print` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否启用打印机',
  `printarr` varchar(100) NOT NULL DEFAULT '' COMMENT '打印机',
  `tidarr` varchar(500) NOT NULL,
  `fzid` int(11) NOT NULL,
  `is_review` tinyint(3) NOT NULL,
  `addedinfo` text NOT NULL COMMENT '附加设置信息-以后所有不索引的附加信息都在这里，不用再加字段',
  `lastedittime` int(11) DEFAULT NULL COMMENT '最近一次修改时间',
  `checksendset` text COMMENT '考勤记录推送对象',
  `typt_id` varchar(30) NOT NULL COMMENT '统一平台对应 ID',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=697 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_cookbook
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_cookbook`;
CREATE TABLE `ims_wx_school_cookbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分校id',
  `weid` int(10) unsigned NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `begintime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `monday` text NOT NULL,
  `tuesday` text NOT NULL,
  `wednesday` text NOT NULL,
  `thursday` text NOT NULL,
  `friday` text NOT NULL,
  `saturday` text NOT NULL,
  `sunday` text NOT NULL,
  `ishow` int(1) NOT NULL DEFAULT '1' COMMENT '1:显示,2隐藏,默认1',
  `sort` int(11) NOT NULL DEFAULT '1',
  `type` varchar(15) NOT NULL DEFAULT '',
  `headpic` varchar(200) NOT NULL DEFAULT '',
  `infos` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_cost
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_cost`;
CREATE TABLE `ims_wx_school_cost` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `cost` decimal(18,2) NOT NULL DEFAULT '0.00',
  `bj_id` text COMMENT '关联班级组',
  `name` varchar(100) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` text NOT NULL COMMENT '缴费说明',
  `about` int(10) unsigned NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `is_sys` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1关联缴费，2不关联',
  `is_time` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1有时间限制，2不限制',
  `is_on` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1启用，2不启用',
  `createtime` int(10) unsigned NOT NULL,
  `starttime` int(10) unsigned NOT NULL,
  `endtime` int(10) unsigned NOT NULL,
  `dataline` int(10) unsigned NOT NULL,
  `payweid` int(10) unsigned NOT NULL COMMENT '支付公众号',
  `is_print` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否启用打印机',
  `printarr` varchar(100) NOT NULL DEFAULT '' COMMENT '打印机',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_coursebuy
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_coursebuy`;
CREATE TABLE `ims_wx_school_coursebuy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `kcid` int(11) NOT NULL,
  `ksnum` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `overtime` int(11) NOT NULL COMMENT '过期时间',
  `is_change` tinyint(3) NOT NULL COMMENT '0默认1调前旧的2调后新的',
  `change_id` int(11) NOT NULL COMMENT '调课关联coursebuy id',
  `orderid` int(10) unsigned NOT NULL COMMENT '归属订单ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_courseorder
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_courseorder`;
CREATE TABLE `ims_wx_school_courseorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `kcid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `beizhu` varchar(200) NOT NULL,
  `tid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `type` int(3) NOT NULL COMMENT '类型，0为预约',
  `totid` int(11) NOT NULL,
  `fromuserid` int(11) NOT NULL,
  `huifu` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_coursetable
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_coursetable`;
CREATE TABLE `ims_wx_school_coursetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分校id',
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `ishow` int(1) NOT NULL DEFAULT '1' COMMENT '1:显示,2隐藏,默认1',
  `sort` int(11) NOT NULL DEFAULT '1',
  `type` varchar(15) NOT NULL DEFAULT '',
  `headpic` varchar(200) NOT NULL DEFAULT '',
  `infos` varchar(500) NOT NULL,
  `xq_id` int(11) NOT NULL COMMENT '学期id',
  `bj_id` int(11) NOT NULL COMMENT '班级id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_cyybeizhu_teacher
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_cyybeizhu_teacher`;
CREATE TABLE `ims_wx_school_cyybeizhu_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `beizhu` varchar(200) NOT NULL,
  `cyyid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_dianzan
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_dianzan`;
CREATE TABLE `ims_wx_school_dianzan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `uid` int(10) unsigned NOT NULL COMMENT '发布者UID',
  `sherid` int(10) unsigned NOT NULL COMMENT '所属图文id',
  `zname` varchar(50) DEFAULT '' COMMENT '点赞人名字',
  `order` int(10) unsigned NOT NULL COMMENT '排序',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `aitewo` varchar(30) NOT NULL DEFAULT '0' COMMENT '图片路径',
  `0953` varchar(30) NOT NULL DEFAULT '0' COMMENT '图片路径',
  `userid` int(10) unsigned DEFAULT NULL COMMENT 'userid',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16962 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_email
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_email`;
CREATE TABLE `ims_wx_school_email` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned NOT NULL,
  `userid` int(10) unsigned NOT NULL,
  `bj_id` int(10) unsigned NOT NULL,
  `pard` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1本人2母亲3父亲4爷爷5奶奶6外公7外婆8叔叔9阿姨10其他',
  `suggesd` varchar(1000) DEFAULT '',
  `emailid` int(10) unsigned NOT NULL,
  `isread` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_how` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ssort` int(10) unsigned NOT NULL COMMENT '排序',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_fans_group
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_fans_group`;
CREATE TABLE `ims_wx_school_fans_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0',
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `group_desc` varchar(50) NOT NULL DEFAULT '',
  `ssort` int(10) unsigned NOT NULL COMMENT '排序',
  `type` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '二维码状态',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '生成时间',
  `is_zhu` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否本校主二维码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_formid
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_formid`;
CREATE TABLE `ims_wx_school_formid` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `fromto` varchar(100) NOT NULL COMMENT '点击来源',
  `formid` varchar(500) NOT NULL COMMENT 'formid',
  `openid` varchar(500) NOT NULL COMMENT 'openid',
  `creattime` int(10) NOT NULL COMMENT '时间',
  `times` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2213 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_fzqx
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_fzqx`;
CREATE TABLE `ims_wx_school_fzqx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `fzid` int(11) NOT NULL,
  `qxid` int(11) NOT NULL,
  `type` int(3) NOT NULL COMMENT '1后台2前端',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4846 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_gkkpj
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_gkkpj`;
CREATE TABLE `ims_wx_school_gkkpj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `gkkid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `iconid` int(11) NOT NULL,
  `iconlevel` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `torjz` int(1) NOT NULL COMMENT '来自老师2还是家长1',
  `createtime` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '评语1还是等级2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_gkkpjbz
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_gkkpjbz`;
CREATE TABLE `ims_wx_school_gkkpjbz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(1) NOT NULL,
  `title` varchar(50) NOT NULL,
  `ssort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_gkkpjk
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_gkkpjk`;
CREATE TABLE `ims_wx_school_gkkpjk` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `schoolid` int(10) NOT NULL,
  `bzid` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `icon1title` varchar(10) NOT NULL,
  `icon2title` varchar(10) NOT NULL,
  `icon3title` varchar(10) NOT NULL,
  `icon4title` varchar(10) NOT NULL,
  `icon5title` varchar(10) NOT NULL,
  `icon1` varchar(1000) NOT NULL,
  `icon2` varchar(1000) NOT NULL,
  `icon3` varchar(1000) NOT NULL,
  `icon4` varchar(1000) NOT NULL,
  `icon5` varchar(1000) NOT NULL,
  `type` int(1) NOT NULL,
  `ssort` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_gongkaike
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_gongkaike`;
CREATE TABLE `ims_wx_school_gongkaike` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `ssort` int(3) NOT NULL,
  `bzid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `km_id` int(11) NOT NULL,
  `bj_id` int(11) NOT NULL,
  `dagang` text NOT NULL,
  `ticket` varchar(255) NOT NULL,
  `qrid` int(11) NOT NULL,
  `xq_id` int(11) NOT NULL,
  `is_pj` int(1) NOT NULL,
  `createtime` int(11) NOT NULL,
  `createtid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_groupactivity
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_groupactivity`;
CREATE TABLE `ims_wx_school_groupactivity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `thumb` varchar(500) NOT NULL COMMENT '缩略图',
  `banner` varchar(2000) NOT NULL COMMENT '幻灯片',
  `content` varchar(2000) NOT NULL COMMENT '活动描述',
  `bjarray` varchar(1000) NOT NULL COMMENT '班级组',
  `cost` float NOT NULL COMMENT '报名费',
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `type` int(3) NOT NULL COMMENT '1活动2家政3家教',
  `ssort` int(3) NOT NULL COMMENT '排序',
  `createtime` int(11) NOT NULL,
  `isall` int(2) NOT NULL COMMENT '是否全校可报',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_groupsign
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_groupsign`;
CREATE TABLE `ims_wx_school_groupsign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `gaid` int(11) NOT NULL,
  `type` int(3) NOT NULL COMMENT '1集体活动2家政3家教',
  `createtime` int(11) NOT NULL,
  `servetime` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_helps
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_helps`;
CREATE TABLE `ims_wx_school_helps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `schoolid` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `content` mediumtext NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `lasttime` int(10) unsigned NOT NULL,
  `click` int(10) unsigned NOT NULL,
  `is_share` tinyint(1) unsigned NOT NULL,
  `share_id` tinyint(1) unsigned NOT NULL,
  `type` int(10) NOT NULL COMMENT '分类',
  `displayorder` int(10) unsigned NOT NULL,
  `could_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_hothit
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_hothit`;
CREATE TABLE `ims_wx_school_hothit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `btnid` int(10) unsigned NOT NULL,
  `formid_use` int(10) unsigned NOT NULL,
  `fromto` varchar(100) NOT NULL COMMENT '点击来源',
  `openid` varchar(500) NOT NULL COMMENT 'openid',
  `creattime` int(10) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2213 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_icon
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_icon`;
CREATE TABLE `ims_wx_school_icon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '公众号',
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分校id',
  `name` varchar(50) NOT NULL COMMENT '按钮名称',
  `icon` varchar(1000) NOT NULL COMMENT '按钮图标',
  `icon2` varchar(1000) NOT NULL,
  `url` varchar(1000) NOT NULL COMMENT '链接url',
  `do` varchar(100) NOT NULL,
  `place` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1首页菜单2底部菜单',
  `ssort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '显示状态',
  `beizhu` varchar(50) NOT NULL COMMENT '备注或小字',
  `color` varchar(50) NOT NULL COMMENT '颜色',
  `typeid` int(10) unsigned NOT NULL COMMENT 'icon分类ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2079 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_icontype
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_icontype`;
CREATE TABLE `ims_wx_school_icontype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '公众号',
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分校id',
  `title` varchar(50) NOT NULL COMMENT '分类名称',
  `place` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '位置',
  `ssort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '显示状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_idcard
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_idcard`;
CREATE TABLE `ims_wx_school_idcard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `bj_id` int(10) unsigned NOT NULL,
  `idcard` varchar(200) NOT NULL DEFAULT '' COMMENT '卡号',
  `orderid` int(10) unsigned NOT NULL,
  `pard` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1本人2母亲3父亲4爷爷5奶奶6外公7外婆8叔叔9阿姨10其他',
  `createtime` int(10) unsigned NOT NULL,
  `severend` int(10) unsigned NOT NULL,
  `is_on` int(1) NOT NULL DEFAULT '0' COMMENT '1:使用,2未用,默认0',
  `usertype` int(1) NOT NULL DEFAULT '0' COMMENT '1:老师,学生0',
  `spic` varchar(1000) NOT NULL,
  `tpic` varchar(1000) NOT NULL,
  `pname` varchar(200) NOT NULL,
  `is_frist` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:首次,2非首次',
  `cardtype` tinyint(1) NOT NULL DEFAULT '1',
  `lastedittime` int(11) DEFAULT NULL,
  `photo_guid` varchar(200) NOT NULL,
  `guid` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8873 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_index
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_index`;
CREATE TABLE `ims_wx_school_index` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL DEFAULT '0' COMMENT '公众号id',
  `areaid` int(10) NOT NULL DEFAULT '0' COMMENT '区域id',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `logo` varchar(200) NOT NULL DEFAULT '' COMMENT '学校logo',
  `thumb` varchar(200) NOT NULL DEFAULT '' COMMENT '图文消息缩略图',
  `info` varchar(1000) NOT NULL DEFAULT '' COMMENT '简短描述',
  `content` text NOT NULL COMMENT '简介',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '联系电话',
  `location_p` varchar(100) NOT NULL DEFAULT '' COMMENT '省',
  `location_c` varchar(100) NOT NULL DEFAULT '' COMMENT '市',
  `location_a` varchar(100) NOT NULL DEFAULT '' COMMENT '区',
  `address` varchar(200) NOT NULL COMMENT '地址',
  `place` varchar(200) NOT NULL DEFAULT '',
  `lat` decimal(18,10) NOT NULL DEFAULT '0.0000000000' COMMENT '经度',
  `lng` decimal(18,10) NOT NULL DEFAULT '0.0000000000' COMMENT '纬度',
  `0953` varchar(30) NOT NULL DEFAULT '0' COMMENT '0',
  `copyright` varchar(100) NOT NULL DEFAULT '' COMMENT '版权',
  `is_stuewcode` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1开启2关闭',
  `headcolor` varchar(20) NOT NULL DEFAULT '#06c1ae' COMMENT '头部颜色',
  `thumb_url` varchar(1000) DEFAULT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否在手机端显示',
  `ssort` tinyint(3) NOT NULL DEFAULT '0',
  `is_sms` tinyint(1) NOT NULL DEFAULT '0',
  `dateline` int(10) NOT NULL DEFAULT '0',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '搜索页显示',
  `gonggao` varchar(1000) NOT NULL DEFAULT '' COMMENT '通知',
  `is_rest` tinyint(1) NOT NULL DEFAULT '0',
  `typeid` int(10) NOT NULL DEFAULT '0' COMMENT '学校类型',
  `style1` varchar(200) NOT NULL DEFAULT '' COMMENT '模版名称',
  `isopen` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0显示1否',
  `qroce` varchar(200) NOT NULL DEFAULT '' COMMENT '二维码',
  `issale` tinyint(1) NOT NULL DEFAULT '5' COMMENT '5种状态',
  `style2` varchar(200) NOT NULL DEFAULT '' COMMENT '模版名称2',
  `style3` varchar(200) NOT NULL DEFAULT '' COMMENT '模版名称3',
  `zhaosheng` text NOT NULL COMMENT '招生简章',
  `uid` int(10) NOT NULL DEFAULT '0' COMMENT '账户ID',
  `is_cost` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1启用2不启用',
  `is_sign` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1启用2不启用',
  `manger` varchar(200) NOT NULL DEFAULT '' COMMENT '信息审核员',
  `signset` varchar(200) NOT NULL COMMENT '报名设置',
  `is_video` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1启用2不启用',
  `is_recordmac` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1启用2不启用',
  `jxstart` varchar(50) DEFAULT '',
  `jxend` varchar(50) DEFAULT '',
  `lxstart` varchar(50) DEFAULT '',
  `lxend` varchar(50) DEFAULT '',
  `jxstart1` varchar(50) DEFAULT '',
  `jxend1` varchar(50) DEFAULT '',
  `lxstart1` varchar(50) DEFAULT '',
  `lxend1` varchar(50) DEFAULT '',
  `jxstart2` varchar(50) DEFAULT '',
  `jxend2` varchar(50) DEFAULT '',
  `lxstart2` varchar(50) DEFAULT '',
  `lxend2` varchar(50) DEFAULT '',
  `is_cardpay` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1启用2不启用',
  `cardset` varchar(500) NOT NULL COMMENT '刷卡设置',
  `is_cardlist` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1启用2不启用',
  `spic` varchar(200) NOT NULL DEFAULT '' COMMENT '默认学生头像',
  `tpic` varchar(200) NOT NULL DEFAULT '' COMMENT '默认教师头像',
  `is_showew` tinyint(1) NOT NULL DEFAULT '1' COMMENT '2显示1否',
  `is_zjh` tinyint(1) NOT NULL DEFAULT '1' COMMENT '2显示1否',
  `is_showad` int(10) NOT NULL DEFAULT '0' COMMENT '广告ID',
  `is_comload` int(10) NOT NULL DEFAULT '0' COMMENT '广告ID',
  `shoucename` varchar(200) NOT NULL DEFAULT '' COMMENT '手册名称',
  `is_wxsign` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1启用2不启用微信签到',
  `is_signneedcomfim` tinyint(1) NOT NULL DEFAULT '1' COMMENT '手机签到是否需确认1是2否',
  `videoname` varchar(200) NOT NULL DEFAULT '' COMMENT '监控名称',
  `videopic` varchar(1000) NOT NULL DEFAULT '' COMMENT '监控封面',
  `is_openht` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1启用2不启用独立后台',
  `wqgroupid` int(10) NOT NULL DEFAULT '0' COMMENT '微擎默认用户组',
  `cityid` int(10) NOT NULL DEFAULT '0' COMMENT '城市ID',
  `userstyle` varchar(50) NOT NULL DEFAULT 'user' COMMENT '家长学生中心模板',
  `bjqstyle` varchar(50) NOT NULL DEFAULT 'old',
  `is_fbnew` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1启用2不启用语音和视频',
  `txid` varchar(100) NOT NULL DEFAULT '' COMMENT '腾讯云APPID',
  `txms` varchar(100) NOT NULL DEFAULT '0' COMMENT '腾讯云密钥',
  `is_kb` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1启用2不启公立课表',
  `is_fbvocie` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1启用2不启语音',
  `bd_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1名手2名码3名学4名手码5名手学6名学码7名手学码7名手学码',
  `send_overtime` int(10) NOT NULL DEFAULT '-1' COMMENT '延迟发送',
  `sms_set` varchar(1000) NOT NULL DEFAULT '' COMMENT '短信设置',
  `sms_use_times` int(10) NOT NULL COMMENT '短信调用次数',
  `sms_rest_times` int(10) NOT NULL COMMENT '可用短信条数',
  `mallsetinfo` varchar(500) NOT NULL,
  `wxsignrange` int(11) NOT NULL,
  `yzxxtid` int(11) NOT NULL,
  `comtid` int(11) NOT NULL,
  `Cost2Point` int(11) NOT NULL COMMENT '一元换多少积分',
  `Is_point` int(3) NOT NULL COMMENT '是否开启积分抵用',
  `is_star` int(3) NOT NULL COMMENT '是否星级1是0否',
  `is_chongzhi` int(3) NOT NULL,
  `chongzhiweid` int(11) NOT NULL,
  `is_shoufei` int(3) NOT NULL DEFAULT '1',
  `is_picarr` int(3) NOT NULL COMMENT '是否图片组',
  `picarrset` varchar(500) NOT NULL COMMENT '图片组设置',
  `is_textarr` int(3) NOT NULL COMMENT '是否文字组',
  `textarrset` varchar(2000) NOT NULL COMMENT '文字组设置',
  `is_qx` int(3) NOT NULL DEFAULT '1',
  `savevideoto` tinyint(1) NOT NULL DEFAULT '1',
  `shareset` varchar(500) NOT NULL,
  `is_printer` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用打印机',
  `sh_teacherids` varchar(1000) DEFAULT NULL COMMENT '校园圈模式审核人',
  `chargesetinfo` text NOT NULL COMMENT '充电桩设置',
  `is_buzhu` tinyint(3) NOT NULL COMMENT '是否启用学生补助余额',
  `is_ap` tinyint(3) NOT NULL,
  `is_book` tinyint(3) NOT NULL,
  `fxlocation` text NOT NULL,
  `checksendset` text COMMENT '考勤记录推送对象',
  `typt_school_id` int(11) NOT NULL COMMENT '统一平台schoolid',
  `typt_ec_code` varchar(30) NOT NULL COMMENT '统一平台集团ec',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_kc_formal_log
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_kc_formal_log`;
CREATE TABLE `ims_wx_school_kc_formal_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `kcid` int(10) unsigned NOT NULL COMMENT '来源kcid',
  `tokcid` int(10) unsigned NOT NULL COMMENT '转正到kcid',
  `sid` int(10) unsigned NOT NULL COMMENT 'sid',
  `tid` int(10) unsigned NOT NULL COMMENT '申请操作人',
  `shtid` int(10) unsigned NOT NULL COMMENT '审核人',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未审核1通过2拒绝',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_kc_menu
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_kc_menu`;
CREATE TABLE `ims_wx_school_kc_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `kcid` int(10) unsigned NOT NULL COMMENT '归属课程ID',
  `name` varchar(500) NOT NULL COMMENT '名称',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_kc_promote
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_kc_promote`;
CREATE TABLE `ims_wx_school_kc_promote` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `kcid` int(10) unsigned NOT NULL COMMENT '归属课程ID',
  `name` varchar(500) DEFAULT NULL COMMENT '名称/暂以课程名',
  `team` varchar(1000) DEFAULT NULL COMMENT '推广成员',
  `price` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '优惠格',
  `use_pop` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1启用海报2禁止',
  `pop_id` int(10) unsigned NOT NULL COMMENT '海报风格ID',
  `pop_img` varchar(1000) DEFAULT NULL COMMENT '海报底图',
  `share_title` varchar(600) DEFAULT NULL COMMENT '分享标题',
  `share_word` varchar(600) DEFAULT NULL COMMENT '分享文案',
  `rule_word` varchar(600) DEFAULT NULL COMMENT '规则文案',
  `allow_normal` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1允许普通粉丝推广2禁止',
  `show_ranking` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1推广员端排名2禁止',
  `tg_number` int(10) unsigned NOT NULL COMMENT '试听任务人数',
  `is_royalty` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1提成2否',
  `need_done` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1需完成2否',
  `royalty` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '提成',
  `xg_royalty` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '续购提成',
  `mobile_sign` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1前端分配2否',
  `mobile_sign_fp` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1随机2顺序',
  `count_menber` int(10) unsigned NOT NULL COMMENT '达标人数',
  `type` tinyint(1) unsigned NOT NULL COMMENT '1推广',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_kc_saleset
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_kc_saleset`;
CREATE TABLE `ims_wx_school_kc_saleset` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `kcid` int(10) unsigned NOT NULL COMMENT '归属课程ID',
  `name` varchar(500) DEFAULT NULL COMMENT '名称/暂以课程名',
  `price` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '优惠格',
  `tuanz_price` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '团长优惠',
  `suc_munber` int(10) unsigned NOT NULL COMMENT '成功人数',
  `overtimeset` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1按课程结束时间2自定义',
  `overtime` int(10) unsigned NOT NULL COMMENT '结束时间小时',
  `endtime` int(10) unsigned NOT NULL COMMENT '整个活动结束时间',
  `allow_again` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1允许继续2禁止',
  `allow_help` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1允许虚拟2禁止',
  `use_pop` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1启用海报2禁止',
  `pop_id` int(10) unsigned NOT NULL COMMENT '海报风格ID',
  `pop_img` varchar(1000) DEFAULT NULL COMMENT '海报底图',
  `share_title` varchar(600) DEFAULT NULL COMMENT '分享标题',
  `share_word` varchar(600) DEFAULT NULL COMMENT '分享文案',
  `rule_word` varchar(600) DEFAULT NULL COMMENT '规则文案',
  `type` tinyint(1) unsigned NOT NULL COMMENT '1团购2助力',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_kc_vislog
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_kc_vislog`;
CREATE TABLE `ims_wx_school_kc_vislog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `kcid` int(10) unsigned NOT NULL COMMENT '归属课程ID',
  `sid` int(10) unsigned NOT NULL COMMENT 'sid',
  `log` varchar(500) DEFAULT NULL COMMENT '记录',
  `tid` int(10) unsigned NOT NULL COMMENT '回访人',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_kcbiao
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_kcbiao`;
CREATE TABLE `ims_wx_school_kcbiao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分校id',
  `weid` int(10) unsigned NOT NULL,
  `tid` int(11) NOT NULL COMMENT '所属教师ID',
  `kcid` int(11) NOT NULL COMMENT '所属课程ID',
  `nub` int(11) NOT NULL COMMENT '第几堂课或第几讲',
  `bj_id` int(11) NOT NULL,
  `km_id` int(11) NOT NULL,
  `xq_id` int(11) NOT NULL,
  `sd_id` int(11) NOT NULL,
  `date` int(10) unsigned NOT NULL COMMENT '开课日期',
  `isxiangqing` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0显示1否',
  `content` text NOT NULL COMMENT '课程内容',
  `is_remind` int(3) NOT NULL COMMENT '是否已提醒',
  `addr_id` int(11) NOT NULL,
  `costnum` tinyint(3) NOT NULL DEFAULT '1' COMMENT '消耗课时',
  `rulsetid` varchar(100) DEFAULT NULL COMMENT '规则排课固定值',
  `re_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1每周2隔周3日期0手动',
  `is_try_see` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1试看2否',
  `menu_id` int(10) NOT NULL COMMENT '所属章节',
  `content_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0富文本1直播2视频3语音4纯图5文档',
  `sign_ewcode` varchar(1000) DEFAULT NULL COMMENT '线下签到二维码',
  `name` varchar(500) DEFAULT NULL COMMENT '课时名称',
  `pkuser` varchar(500) DEFAULT NULL COMMENT '排课人',
  `clicks` int(10) DEFAULT NULL COMMENT '点击次数',
  `ssort` int(10) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_kcpingjia
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_kcpingjia`;
CREATE TABLE `ims_wx_school_kcpingjia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `kcid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `type` int(3) NOT NULL COMMENT '评分1留言2',
  `content` varchar(1000) NOT NULL,
  `star` int(3) NOT NULL,
  `createtime` int(11) NOT NULL,
  `masterid` int(10) unsigned NOT NULL COMMENT '主ID',
  `is_master` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1主评论0回复',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示',
  `pfxmid` int(11) NOT NULL COMMENT '评分项ID',
  `anony` tinyint(1) NOT NULL COMMENT '0不匿名1匿名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_kcsign
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_kcsign`;
CREATE TABLE `ims_wx_school_kcsign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `kcid` int(11) NOT NULL COMMENT '课程id',
  `ksid` int(11) NOT NULL COMMENT '课时id',
  `sid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `signtime` int(11) NOT NULL COMMENT '签哪天的到',
  `status` int(3) NOT NULL,
  `type` int(3) NOT NULL COMMENT '自由or固定',
  `qrtid` int(11) NOT NULL,
  `kcname` varchar(200) NOT NULL,
  `costnum` tinyint(3) NOT NULL DEFAULT '1' COMMENT '消耗课时',
  `qjid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_language
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_language`;
CREATE TABLE `ims_wx_school_language` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '公众号',
  `schoolid` int(10) unsigned NOT NULL COMMENT '分校id',
  `is_on` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用',
  `lanset` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_leave
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_leave`;
CREATE TABLE `ims_wx_school_leave` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `leaveid` int(10) unsigned NOT NULL,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `uid` int(10) unsigned NOT NULL COMMENT '微擎UID',
  `tuid` int(10) unsigned NOT NULL COMMENT '老师微擎UID',
  `openid` varchar(200) DEFAULT '' COMMENT 'openid',
  `sid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学生ID',
  `tid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '教师ID',
  `type` varchar(10) DEFAULT '' COMMENT '请假类型',
  `startime` varchar(200) DEFAULT '' COMMENT '开始时间',
  `endtime` varchar(200) DEFAULT '' COMMENT '结束时间',
  `conet` varchar(200) DEFAULT '' COMMENT '详细内容',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `cltime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '处理时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核状态',
  `bj_id` int(10) unsigned NOT NULL COMMENT '班级ID',
  `isliuyan` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否留言',
  `teacherid` int(11) DEFAULT NULL,
  `isfrist` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1是0否',
  `is_on` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1启用2不启用',
  `banner` varchar(2000) DEFAULT '',
  `userid` int(11) DEFAULT NULL,
  `touserid` int(11) DEFAULT NULL,
  `isread` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1是2否',
  `startime1` int(10) DEFAULT NULL,
  `endtime1` int(10) DEFAULT NULL,
  `cltid` int(10) unsigned NOT NULL COMMENT '老师id',
  `reconet` varchar(200) DEFAULT '' COMMENT '教师回复',
  `audio` varchar(1000) DEFAULT '',
  `tonjzrtid` int(11) NOT NULL COMMENT '年级主任tid',
  `toxztid` int(11) NOT NULL COMMENT '校长tid',
  `njzryj` varchar(200) NOT NULL COMMENT '年级主任审批意见',
  `njzrcltime` int(11) NOT NULL,
  `picurl` varchar(1000) NOT NULL,
  `tktype` int(3) NOT NULL COMMENT '调课类型',
  `ksnum` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `more_less` tinyint(3) NOT NULL,
  `kcid` int(10) unsigned NOT NULL,
  `ksid` int(10) unsigned NOT NULL,
  `kcsignid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1353 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_mall
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_mall`;
CREATE TABLE `ims_wx_school_mall` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `thumb` varchar(1000) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(500) NOT NULL,
  `fenlei` varchar(500) NOT NULL,
  `sort` int(10) NOT NULL,
  `old_price` float NOT NULL,
  `new_price` float NOT NULL,
  `points` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `sold` int(10) NOT NULL,
  `cop` int(11) NOT NULL COMMENT '1纯积分2纯金额3混合',
  `xsxg` int(3) NOT NULL COMMENT '学生限购数量.0为不限购',
  `showtype` int(3) NOT NULL COMMENT '家长端1/教师端2/两者0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_mallorder
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_mallorder`;
CREATE TABLE `ims_wx_school_mallorder` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `goodsid` int(11) NOT NULL,
  `addressid` int(11) NOT NULL,
  `torderid` int(11) NOT NULL,
  `tname` varchar(50) NOT NULL,
  `tphone` varchar(15) NOT NULL,
  `taddress` varchar(500) NOT NULL,
  `count` int(10) NOT NULL,
  `allcash` float NOT NULL,
  `allpoint` int(11) NOT NULL,
  `beizhu` varchar(500) NOT NULL,
  `cop` int(11) NOT NULL COMMENT '1纯积分2纯金额3混合',
  `status` int(3) NOT NULL,
  `fahuo` int(3) NOT NULL,
  `createtime` int(10) NOT NULL,
  `sid` int(11) NOT NULL COMMENT '学生id',
  `userid` int(11) NOT NULL COMMENT '购买者userid（学生用）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_media
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_media`;
CREATE TABLE `ims_wx_school_media` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `uid` int(10) unsigned NOT NULL COMMENT '发布者UID',
  `picurl` varchar(255) DEFAULT '' COMMENT '图片',
  `bj_id1` int(10) unsigned NOT NULL COMMENT '班级ID1',
  `bj_id2` int(10) unsigned NOT NULL COMMENT '班级ID2',
  `bj_id3` int(10) unsigned NOT NULL COMMENT '班级ID3',
  `order` int(10) unsigned NOT NULL COMMENT '排序',
  `sherid` int(10) unsigned NOT NULL COMMENT '所属图文id',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `sid` int(10) unsigned NOT NULL COMMENT '学生SID',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0班级圈1相册',
  `fmpicurl` varchar(255) DEFAULT '' COMMENT '封面图片',
  `isfm` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0否1是',
  `kc_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38752 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_news
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_news`;
CREATE TABLE `ims_wx_school_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `cateid` int(10) unsigned NOT NULL,
  `type` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `picarr` text COMMENT '图片组',
  `displayorder` int(10) unsigned NOT NULL COMMENT '排序',
  `description` varchar(255) NOT NULL,
  `is_display` tinyint(3) unsigned NOT NULL,
  `is_show_home` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `click` int(10) unsigned NOT NULL,
  `dianzan` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=393 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_notice
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_notice`;
CREATE TABLE `ims_wx_school_notice` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `tid` int(10) unsigned NOT NULL COMMENT '教师ID',
  `tname` varchar(10) DEFAULT '' COMMENT '发布老师名字',
  `title` varchar(50) DEFAULT '' COMMENT '文章名称',
  `content` text NOT NULL COMMENT '详细内容',
  `picarr` text COMMENT '用户信息',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `bj_id` int(10) unsigned NOT NULL COMMENT '班级ID',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否班级通知',
  `groupid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1为全体师生2为全体教师3为全体家长和学生',
  `km_id` int(10) unsigned NOT NULL COMMENT '科目ID',
  `ismobile` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0手机1电脑',
  `outurl` varchar(500) DEFAULT '' COMMENT '外部链接',
  `video` varchar(2000) NOT NULL DEFAULT '' COMMENT '视频地址',
  `videopic` varchar(1000) NOT NULL DEFAULT '' COMMENT '视频封面',
  `audio` varchar(100) DEFAULT '' COMMENT '音频',
  `audiotime` int(10) unsigned NOT NULL COMMENT '音频时长',
  `anstype` varchar(200) NOT NULL,
  `kc_id` int(11) NOT NULL,
  `usertype` varchar(100) DEFAULT '' COMMENT '接收用户',
  `userdatas` varchar(1000) DEFAULT '' COMMENT '用户数据',
  `is_research` tinyint(3) NOT NULL,
  `ali_vod_id` varchar(100) DEFAULT '' COMMENT '视频画面ID',
  `comment` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3518 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_notice_comment
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_notice_comment`;
CREATE TABLE `ims_wx_school_notice_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `userid` int(10) unsigned NOT NULL,
  `noticeid` int(10) unsigned NOT NULL,
  `commentid` int(10) unsigned NOT NULL,
  `comment` varchar(100) DEFAULT NULL COMMENT '评论内容',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_object
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_object`;
CREATE TABLE `ims_wx_school_object` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item` int(10) unsigned NOT NULL,
  `type` varchar(50) NOT NULL,
  `displayorder` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_online
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_online`;
CREATE TABLE `ims_wx_school_online` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `macid` int(10) unsigned NOT NULL,
  `commond` int(10) unsigned NOT NULL,
  `result` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `isread` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `createtime` int(10) unsigned NOT NULL COMMENT '生成时间',
  `dotime` int(10) unsigned NOT NULL COMMENT '执行时间',
  `lastedittime` int(11) DEFAULT NULL COMMENT '任务对应的最近一次修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_order
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_order`;
CREATE TABLE `ims_wx_school_order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `orderid` int(10) unsigned NOT NULL COMMENT '订单ID',
  `userid` int(10) unsigned NOT NULL COMMENT '发布者UID',
  `uid` int(10) unsigned NOT NULL COMMENT '发布者UID',
  `sid` int(10) unsigned NOT NULL COMMENT '所属图文id',
  `kcid` int(10) unsigned NOT NULL COMMENT '课程ID',
  `obid` int(10) unsigned NOT NULL COMMENT '项目ID',
  `cose` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1未支付2为未支付3为已退款',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1课程2项目3功能',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `aitewo` varchar(30) NOT NULL DEFAULT '0' COMMENT '支付LOGO',
  `0953` varchar(30) NOT NULL DEFAULT '0' COMMENT '支付LOGO',
  `paytime` int(10) unsigned NOT NULL COMMENT '支付时间',
  `tuitime` int(10) unsigned NOT NULL COMMENT '退款时间',
  `costid` int(10) unsigned NOT NULL COMMENT '项目ID',
  `signid` int(10) unsigned NOT NULL COMMENT '报名ID',
  `paytype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1线上2现金',
  `bdcardid` int(10) unsigned NOT NULL COMMENT '帮卡ID',
  `pay_type` varchar(100) DEFAULT '' COMMENT '支付方式',
  `xufeitype` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1已续费2未续费',
  `lastorderid` int(10) unsigned NOT NULL COMMENT '继承订单,用于续费',
  `payweid` int(10) unsigned NOT NULL COMMENT '支付公众号',
  `uniontid` varchar(1000) DEFAULT '' COMMENT '微信或支付宝返回的订单号',
  `morderid` int(11) NOT NULL,
  `vodid` int(10) unsigned DEFAULT NULL COMMENT '视频ID',
  `vodtype` varchar(30) NOT NULL COMMENT '视频课程购买类型',
  `ksnum` int(11) NOT NULL,
  `spoint` int(11) NOT NULL COMMENT '学生积分',
  `tempsid` int(11) NOT NULL,
  `tempopenid` varchar(50) NOT NULL,
  `tid` varchar(100) NOT NULL,
  `taocanid` int(11) NOT NULL,
  `shareuserid` int(11) NOT NULL,
  `print_nums` int(11) NOT NULL,
  `refundid` int(10) unsigned NOT NULL,
  `wxpayid` int(10) unsigned NOT NULL,
  `new_stu` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0默认1新增学生',
  `sale_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1团2助力0关闭',
  `sale_rule` int(10) unsigned NOT NULL COMMENT '营销所属规则',
  `team_id` int(10) unsigned NOT NULL COMMENT '组队ID',
  `superior_tid` int(10) unsigned NOT NULL COMMENT '推广员ID',
  `team_price` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '队伍优惠',
  `team_dz_price` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '队长优惠',
  `kcstatus` tinyint(4) NOT NULL COMMENT '0首购，1续购',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1476 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_points
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_points`;
CREATE TABLE `ims_wx_school_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `op` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dailytime` int(11) NOT NULL,
  `adpoint` int(11) NOT NULL,
  `is_on` int(1) NOT NULL COMMENT '1开启2关闭',
  `type` int(3) NOT NULL COMMENT '1规则2任务',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_pointsrecord
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_pointsrecord`;
CREATE TABLE `ims_wx_school_pointsrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `createtime` int(10) NOT NULL,
  `type` int(3) NOT NULL,
  `mcount` int(3) NOT NULL COMMENT '任务已完成次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=435 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_print_log
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_print_log`;
CREATE TABLE `ims_wx_school_print_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0',
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0',
  `pid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `oid` int(10) unsigned NOT NULL DEFAULT '0',
  `foid` varchar(50) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '1:打印成功,2:打印未成功',
  `printer_type` varchar(20) NOT NULL DEFAULT 'feie',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_printer
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_printer`;
CREATE TABLE `ims_wx_school_printer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0',
  `schoolid` int(10) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'feie',
  `print_no` varchar(30) NOT NULL,
  `member_code` varchar(50) NOT NULL COMMENT '飞蛾打印机机器号',
  `key` varchar(30) NOT NULL,
  `api_key` varchar(100) NOT NULL COMMENT '易联云打印机api_key',
  `print_nums` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `qrcode_link` varchar(100) NOT NULL,
  `print_header` varchar(50) NOT NULL,
  `print_footer` varchar(50) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `delivery_type` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_printset
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_printset`;
CREATE TABLE `ims_wx_school_printset` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0',
  `schoolid` int(10) unsigned NOT NULL,
  `ordertype` varchar(20) NOT NULL COMMENT '缴费类型',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `printarr` varchar(30) NOT NULL,
  `print_nums` int(10) NOT NULL DEFAULT '1',
  `print_header` varchar(50) NOT NULL,
  `print_footer` varchar(50) NOT NULL,
  `qrcode_link` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_promote_fans
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_promote_fans`;
CREATE TABLE `ims_wx_school_promote_fans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `kcid` int(10) unsigned NOT NULL COMMENT '归属课程ID',
  `openid` varchar(500) DEFAULT NULL COMMENT '此粉丝openid',
  `userid` int(10) unsigned NOT NULL COMMENT '用户userid',
  `superior_tid` varchar(500) DEFAULT NULL COMMENT '归属推广tid',
  `superior_uid` varchar(500) DEFAULT NULL COMMENT '归属粉丝openid',
  `superior_userid` int(10) unsigned NOT NULL COMMENT '归属推广userid',
  `opt_tid` int(10) unsigned NOT NULL COMMENT '分配操作人',
  `is_sale` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否消费',
  `com_form` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1推广海报2团购海报3助力海报4前端分配',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_promote_pop
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_promote_pop`;
CREATE TABLE `ims_wx_school_promote_pop` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `kcid` int(10) unsigned NOT NULL COMMENT '归属课程ID',
  `teamid` int(10) unsigned NOT NULL COMMENT '队伍ID',
  `openid` varchar(500) DEFAULT NULL COMMENT '此粉丝openid',
  `userid` int(10) unsigned NOT NULL COMMENT '用户userid',
  `tid` varchar(500) DEFAULT NULL COMMENT '归属推广tid',
  `pop_url` varchar(1000) DEFAULT NULL COMMENT '海报路径',
  `type` tinyint(1) unsigned NOT NULL COMMENT '1营销海报2推广海报',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_promote_team
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_promote_team`;
CREATE TABLE `ims_wx_school_promote_team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `kcid` int(10) unsigned NOT NULL COMMENT '归属课程ID',
  `tid` int(10) unsigned NOT NULL COMMENT '推广员TID',
  `sid` int(10) unsigned NOT NULL COMMENT '正式学生ID',
  `openid` varchar(500) DEFAULT NULL COMMENT '此粉丝openid',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_qrcode_info
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_qrcode_info`;
CREATE TABLE `ims_wx_school_qrcode_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0',
  `qrcid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '二维码场景ID',
  `gpid` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '场景名称',
  `keyword` varchar(100) NOT NULL COMMENT '关联关键字',
  `model` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '模式，1临时，2为永久',
  `ticket` varchar(250) NOT NULL DEFAULT '' COMMENT '标识',
  `show_url` varchar(550) NOT NULL DEFAULT '' COMMENT '图片地址',
  `expire` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间',
  `subnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关注扫描次数',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '生成时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0为未启用，1为启用',
  `group_id` int(3) unsigned NOT NULL DEFAULT '0',
  `rid` int(3) unsigned NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '1',
  `schoolid` int(10) unsigned DEFAULT NULL COMMENT '学校ID',
  `qr_url` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_qrcid` (`qrcid`)
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_qrcode_set
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_qrcode_set`;
CREATE TABLE `ims_wx_school_qrcode_set` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bg` int(10) unsigned NOT NULL DEFAULT '0',
  `qrleft` int(10) unsigned NOT NULL DEFAULT '0',
  `qrtop` int(10) unsigned NOT NULL DEFAULT '0',
  `qrwidth` int(10) unsigned NOT NULL DEFAULT '0',
  `qrheight` int(10) unsigned NOT NULL DEFAULT '0',
  `model` int(10) unsigned NOT NULL DEFAULT '1',
  `logoheight` int(10) unsigned NOT NULL DEFAULT '0',
  `logowidth` int(10) unsigned NOT NULL DEFAULT '0',
  `logoqrheight` int(10) unsigned NOT NULL DEFAULT '0',
  `logoqrwidth` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_qrcode_statinfo
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_qrcode_statinfo`;
CREATE TABLE `ims_wx_school_qrcode_statinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0',
  `qid` int(10) unsigned NOT NULL,
  `openid` varchar(150) NOT NULL DEFAULT '' COMMENT '用户的唯一身份ID',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否发生在订阅时',
  `qrcid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '二维码场景ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '场景名称',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '生成时间',
  `group_id` int(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6728 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_questions
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_questions`;
CREATE TABLE `ims_wx_school_questions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `schoolid` int(10) NOT NULL,
  `zyid` int(10) NOT NULL COMMENT '作业id',
  `tid` int(10) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1单选2多选3提问4图片5语音6视频',
  `title` varchar(1000) NOT NULL,
  `qorder` int(10) NOT NULL COMMENT '排序',
  `content` varchar(1000) NOT NULL,
  `AnsType` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_qzkh
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_qzkh`;
CREATE TABLE `ims_wx_school_qzkh` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `shareid` int(11) NOT NULL COMMENT '分享者',
  `openid` varchar(64) NOT NULL COMMENT '用户ID',
  `sname` varchar(32) NOT NULL COMMENT '学生姓名',
  `name` varchar(32) NOT NULL COMMENT '家长姓名',
  `mobile` char(11) NOT NULL COMMENT '联系电话',
  `birthday` varchar(10) NOT NULL COMMENT '出生日期',
  `sex` tinyint(4) NOT NULL COMMENT '孩子性别',
  `pard` int(11) NOT NULL COMMENT '关系',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1未分配2已分配',
  `createtime` char(10) NOT NULL,
  `hobby` text NOT NULL COMMENT '爱好',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_record
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_record`;
CREATE TABLE `ims_wx_school_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `noticeid` int(10) unsigned NOT NULL,
  `userid` int(10) unsigned NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned NOT NULL,
  `openid` varchar(30) NOT NULL COMMENT 'openid',
  `createtime` int(10) unsigned NOT NULL,
  `readtime` int(10) unsigned NOT NULL,
  `type` int(1) unsigned NOT NULL COMMENT '类型1通知2作业',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=173039 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_reply`;
CREATE TABLE `ims_wx_school_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0',
  `schoolid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_rid` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_roomcheck
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_roomcheck`;
CREATE TABLE `ims_wx_school_roomcheck` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `type` tinyint(3) NOT NULL COMMENT '1中午2晚上',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_sale_team
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_sale_team`;
CREATE TABLE `ims_wx_school_sale_team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `kcid` int(10) unsigned NOT NULL COMMENT '归属课程ID',
  `userid` int(10) unsigned NOT NULL COMMENT '参团的学生归属用户ID',
  `openid` varchar(500) DEFAULT NULL COMMENT '此粉丝openid',
  `ismaster` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '队长团长',
  `masterid` int(10) unsigned NOT NULL COMMENT '归属团或组',
  `is_sale` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否消费',
  `is_success` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否成功',
  `is_really` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0真实1虚拟',
  `pkuser` varchar(500) DEFAULT NULL COMMENT '虚拟团组添加人',
  `orderid` int(10) unsigned NOT NULL COMMENT '订单ID',
  `tuifei` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '退费申请',
  `tfuser` varchar(500) DEFAULT NULL COMMENT '推翻操作人',
  `type` tinyint(1) unsigned NOT NULL COMMENT '1团购2助力',
  `endtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_scforxs
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_scforxs`;
CREATE TABLE `ims_wx_school_scforxs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `scid` int(10) unsigned NOT NULL,
  `setid` int(10) unsigned NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned NOT NULL,
  `userid` int(10) unsigned NOT NULL,
  `iconsetid` int(10) unsigned NOT NULL COMMENT '评价id',
  `iconlevel` int(10) unsigned NOT NULL COMMENT '本评价等级',
  `tword` varchar(1000) DEFAULT '' COMMENT '老师评语',
  `jzword` varchar(1000) DEFAULT '' COMMENT '家长评语',
  `dianzan` varchar(1000) DEFAULT '' COMMENT '点赞数',
  `dianzopenid` varchar(500) DEFAULT '' COMMENT '点赞人openid',
  `fromto` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1来自老师2来自家长',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1文字2表现评价3点赞',
  `createtime` int(10) unsigned NOT NULL,
  `ssort` int(10) unsigned NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_schoolset
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_schoolset`;
CREATE TABLE `ims_wx_school_schoolset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alivodappid` varchar(100) NOT NULL,
  `alivodkey` varchar(100) NOT NULL,
  `alivodcate` int(10) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `is_bigdata` tinyint(3) NOT NULL,
  `pwd` varchar(64) NOT NULL,
  `short_url` varchar(32) NOT NULL,
  `bgtitle` varchar(100) NOT NULL,
  `refund` tinyint(1) NOT NULL DEFAULT '0',
  `zyvideolimit` tinyint(3) NOT NULL COMMENT '单位M',
  `remindday` int(11) NOT NULL COMMENT '报名过期提前提醒天数',
  `wt_appid` varchar(200) NOT NULL COMMENT '沃土appid',
  `wt_appkey` varchar(200) NOT NULL COMMENT '沃土appkey',
  `wt_appsecret` varchar(200) NOT NULL COMMENT '沃土appsecret',
  `wt_token` varchar(200) NOT NULL COMMENT '沃土token',
  `wt_token_time` int(10) NOT NULL COMMENT '沃土token获取时间',
  `wt_version` varchar(10) NOT NULL COMMENT '沃土版本号',
  `is_wtcheck` tinyint(3) NOT NULL COMMENT '1启用0不启用 沃土设备',
  `xk_type` tinyint(3) NOT NULL COMMENT '消课类型',
  `is_show_pm` tinyint(3) NOT NULL COMMENT '是否显示成绩排名0否1是',
  `ah_appid` varchar(200) NOT NULL,
  `ah_secret` varchar(200) NOT NULL,
  `uid` text,
  `stutemplate` varchar(10) DEFAULT NULL,
  `teatemplate` varchar(10) DEFAULT NULL,
  `is_gw` tinyint(3) NOT NULL COMMENT '0关闭1启用',
  `is_csyd` tinyint(3) NOT NULL COMMENT '场室预定，0关闭1启用',
  `gwtidarr` text NOT NULL COMMENT '公物管理tidarr',
  `csydtidarr` text NOT NULL COMMENT '场室预定管理tidarr',
  `no_ks_num` int(11) NOT NULL COMMENT '课时不足',
  `no_kcsign_num` int(11) NOT NULL COMMENT '课程签到值',
  `shareinfo` text NOT NULL COMMENT '分享配置信息',
  `teatopiconarr` text NOT NULL COMMENT '普通老师顶部三按钮',
  `mastertopiconarr` text NOT NULL COMMENT '校长顶部四按钮',
  `is_teatotea` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1开启2关闭',
  `is_stutostu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1开启2关闭',
  `is_teatostu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1开启2关闭',
  `is_unbind` tinyint(1) NOT NULL DEFAULT '0',
  `msgsendtype` tinyint(3) NOT NULL COMMENT '短信发送方式 0 默认 1统一平台',
  `typt_admin_tid` int(11) NOT NULL COMMENT '默认管理员tid',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_score
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_score`;
CREATE TABLE `ims_wx_school_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分校id',
  `xq_id` int(11) NOT NULL,
  `bj_id` int(11) NOT NULL,
  `qh_id` int(11) NOT NULL,
  `km_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `my_score` varchar(50) NOT NULL,
  `info` varchar(1000) NOT NULL DEFAULT '' COMMENT '教师评价',
  `createtime` int(10) unsigned NOT NULL,
  `is_absent` tinyint(3) DEFAULT NULL COMMENT '1缺考0未缺考',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=696 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_set
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_set`;
CREATE TABLE `ims_wx_school_set` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `istplnotice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否模版通知',
  `xsqingjia` varchar(200) DEFAULT '' COMMENT '学生请假申请ID',
  `xsqjsh` varchar(200) DEFAULT '' COMMENT '学生请假审核通知ID',
  `jsqingjia` varchar(200) DEFAULT '' COMMENT '教员请假申请体提醒ID',
  `jsqjsh` varchar(200) DEFAULT '' COMMENT '教员请假审核通知ID',
  `xxtongzhi` varchar(200) DEFAULT '' COMMENT '学校通知ID',
  `liuyan` varchar(200) DEFAULT '' COMMENT '家长留言ID',
  `liuyanhf` varchar(200) DEFAULT '' COMMENT '教师回复家长留言ID',
  `bjtz` varchar(200) DEFAULT '' COMMENT '班级通知ID',
  `zuoye` varchar(200) DEFAULT '' COMMENT '发布作业提醒ID',
  `bjqshjg` varchar(200) DEFAULT '',
  `bjqshtz` varchar(200) DEFAULT '',
  `guanli` tinyint(1) NOT NULL DEFAULT '0' COMMENT '管理方式',
  `jxtx` varchar(200) DEFAULT '' COMMENT '进校提醒',
  `jxlxtx` varchar(200) DEFAULT '' COMMENT '进校提醒',
  `jfjgtz` varchar(200) DEFAULT '' COMMENT '缴费结果通知',
  `htname` varchar(200) DEFAULT '' COMMENT '后台系统名称',
  `bgcolor` varchar(20) DEFAULT '' COMMENT '后台系统背景颜色',
  `banner1` varchar(200) DEFAULT '',
  `banner2` varchar(200) DEFAULT '',
  `banner3` varchar(200) DEFAULT '',
  `banner4` varchar(200) DEFAULT '',
  `bgimg` varchar(200) DEFAULT '',
  `bd_set` varchar(1000) DEFAULT '',
  `sms_acss` varchar(1000) DEFAULT '',
  `sms_use_times` int(10) NOT NULL COMMENT '短信调用次数',
  `sensitive_word` mediumtext NOT NULL COMMENT '敏感词库',
  `sykstx` varchar(300) NOT NULL,
  `kcyytx` varchar(300) NOT NULL,
  `kcqdtx` varchar(300) NOT NULL,
  `sktxls` varchar(300) NOT NULL,
  `newcenteriocn` varchar(1000) NOT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '1' COMMENT '新旧风格',
  `banquan` varchar(200) NOT NULL COMMENT '版权',
  `school_max` int(10) NOT NULL DEFAULT '0',
  `baidumapapi` varchar(200) DEFAULT '',
  `fkyytx` varchar(300) DEFAULT NULL COMMENT '访客消息推送模板ID',
  `pttz` varchar(200) DEFAULT NULL COMMENT '拼团通知',
  `zltz` varchar(200) DEFAULT NULL COMMENT '助力通知',
  `stutemplate` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_shouce
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_shouce`;
CREATE TABLE `ims_wx_school_shouce` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `bj_id` int(10) unsigned NOT NULL,
  `xq_id` int(10) unsigned NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `title` varchar(1000) DEFAULT '',
  `setid` int(10) unsigned NOT NULL COMMENT '设置ID',
  `kcid` int(10) unsigned NOT NULL COMMENT '课程ID',
  `ksid` int(10) unsigned NOT NULL COMMENT '课时ID',
  `starttime` int(10) unsigned NOT NULL,
  `endtime` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `sendtype` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1未发送2部分发送3全部发送',
  `ssort` int(10) unsigned NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_shoucepyk
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_shoucepyk`;
CREATE TABLE `ims_wx_school_shoucepyk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `bj_id` int(10) unsigned NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `title` text COMMENT '内容',
  `createtime` int(10) unsigned NOT NULL,
  `ssort` int(10) unsigned NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_shouceset
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_shouceset`;
CREATE TABLE `ims_wx_school_shouceset` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `title` varchar(7) DEFAULT '',
  `bottext` varchar(7) DEFAULT '',
  `boturl` varchar(1000) DEFAULT '',
  `lasttxet` varchar(7) DEFAULT '',
  `nj_id` int(10) unsigned NOT NULL,
  `icon` varchar(1000) DEFAULT '',
  `bg1` varchar(1000) DEFAULT '',
  `bg2` varchar(1000) DEFAULT '',
  `bg3` varchar(1000) DEFAULT '',
  `bg4` varchar(1000) DEFAULT '',
  `bg5` varchar(1000) DEFAULT '',
  `bg6` varchar(1000) DEFAULT '',
  `bgm` varchar(1000) DEFAULT '',
  `top1` varchar(1000) DEFAULT '',
  `top2` varchar(1000) DEFAULT '',
  `top3` varchar(1000) DEFAULT '',
  `top4` varchar(1000) DEFAULT '',
  `top5` varchar(1000) DEFAULT '',
  `guidword1` varchar(20) DEFAULT '',
  `guidword2` varchar(20) DEFAULT '',
  `guidurl` varchar(1000) DEFAULT '',
  `createtime` int(10) unsigned NOT NULL,
  `allowshare` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1允许2禁止',
  `ssort` int(10) unsigned NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_shouceseticon
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_shouceseticon`;
CREATE TABLE `ims_wx_school_shouceseticon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `setid` int(10) unsigned NOT NULL COMMENT '设置ID',
  `title` varchar(7) DEFAULT '',
  `icon1title` varchar(10) DEFAULT '',
  `icon2title` varchar(10) DEFAULT '',
  `icon3title` varchar(10) DEFAULT '',
  `icon4title` varchar(10) DEFAULT '',
  `icon5title` varchar(10) DEFAULT '',
  `icon1` varchar(1000) DEFAULT '',
  `icon2` varchar(1000) DEFAULT '',
  `icon3` varchar(1000) DEFAULT '',
  `icon4` varchar(1000) DEFAULT '',
  `icon5` varchar(1000) DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1教师使用2家长',
  `ssort` int(10) unsigned NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_signup
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_signup`;
CREATE TABLE `ims_wx_school_signup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `icon` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `numberid` int(11) DEFAULT NULL,
  `sex` int(1) NOT NULL,
  `mobile` char(11) NOT NULL,
  `nj_id` int(10) unsigned NOT NULL COMMENT '年级ID',
  `bj_id` int(10) unsigned NOT NULL COMMENT '班级ID',
  `idcard` varchar(18) NOT NULL,
  `cost` varchar(10) NOT NULL,
  `birthday` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `passtime` int(10) unsigned NOT NULL,
  `lasttime` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL COMMENT '发布者UID',
  `orderid` int(10) unsigned NOT NULL,
  `openid` varchar(30) NOT NULL COMMENT 'openid',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1审核中2审核通过3不通过',
  `pard` tinyint(1) unsigned NOT NULL COMMENT '关系',
  `sid` int(11) unsigned NOT NULL,
  `picarr1` varchar(1000) NOT NULL,
  `picarr2` varchar(1000) NOT NULL,
  `picarr3` varchar(1000) NOT NULL,
  `picarr4` varchar(1000) NOT NULL,
  `picarr5` varchar(1000) NOT NULL,
  `textarr1` varchar(1000) NOT NULL,
  `textarr2` varchar(1000) NOT NULL,
  `textarr3` varchar(1000) NOT NULL,
  `textarr4` varchar(1000) NOT NULL,
  `textarr5` varchar(1000) NOT NULL,
  `textarr6` varchar(1000) NOT NULL,
  `textarr7` varchar(1000) NOT NULL,
  `textarr8` varchar(1000) NOT NULL,
  `textarr9` varchar(1000) NOT NULL,
  `textarr10` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_sms_log
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_sms_log`;
CREATE TABLE `ims_wx_school_sms_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `type` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `sendtime` int(10) unsigned NOT NULL COMMENT '生成时间',
  `msg` varchar(1000) NOT NULL COMMENT '返回消息',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '默认成功1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_students
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_students`;
CREATE TABLE `ims_wx_school_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分校id',
  `xq_id` int(11) NOT NULL,
  `area_addr` varchar(200) NOT NULL DEFAULT '',
  `ck_id` int(11) NOT NULL,
  `bj_id` int(11) NOT NULL,
  `birthdate` int(10) unsigned NOT NULL,
  `sex` int(1) NOT NULL,
  `createdate` int(10) unsigned NOT NULL,
  `seffectivetime` int(10) unsigned NOT NULL,
  `wq` varchar(30) NOT NULL DEFAULT '0' COMMENT '0',
  `stheendtime` int(10) unsigned NOT NULL,
  `jf_statu` int(11) DEFAULT NULL,
  `mobile` char(11) NOT NULL,
  `homephone` char(16) NOT NULL,
  `s_name` varchar(50) NOT NULL,
  `localdate_id` char(20) NOT NULL DEFAULT '',
  `note` varchar(50) NOT NULL DEFAULT '',
  `amount` int(11) NOT NULL,
  `area` varchar(50) NOT NULL,
  `weid` int(10) unsigned NOT NULL,
  `own` varchar(30) NOT NULL DEFAULT '0' COMMENT '本人微信info',
  `mom` varchar(30) NOT NULL DEFAULT '0' COMMENT '母亲微信info',
  `dad` varchar(30) NOT NULL DEFAULT '0' COMMENT '父亲微信info',
  `xjid` int(11) unsigned NOT NULL COMMENT '学籍信息',
  `ouid` int(10) unsigned NOT NULL COMMENT '微擎系统memberID',
  `muid` int(10) unsigned NOT NULL COMMENT '微擎系统memberID',
  `duid` int(10) unsigned NOT NULL COMMENT '微擎系统memberID',
  `numberid` varchar(40) NOT NULL,
  `icon` varchar(255) DEFAULT '' COMMENT '头像',
  `ouserid` int(11) unsigned NOT NULL,
  `muserid` int(11) unsigned NOT NULL,
  `duserid` int(11) unsigned NOT NULL,
  `otheruserid` int(11) unsigned NOT NULL,
  `other` varchar(30) DEFAULT '0' COMMENT '家长',
  `otheruid` int(10) unsigned NOT NULL COMMENT '微擎系统memberID',
  `code` varchar(18) DEFAULT NULL COMMENT '绑定码',
  `keyid` int(11) unsigned DEFAULT '0',
  `qrcode_id` int(10) unsigned DEFAULT NULL COMMENT '二维码ID',
  `points` int(11) NOT NULL COMMENT '学生积分',
  `chongzhi` float(10,2) NOT NULL COMMENT '余额',
  `s_type` tinyint(3) NOT NULL COMMENT '走读住校',
  `infocard` text NOT NULL,
  `roomid` int(11) NOT NULL,
  `chargenum` int(11) NOT NULL COMMENT '充电桩剩余次数',
  `sellteaid` int(11) NOT NULL COMMENT '业务员id',
  `guid` varchar(200) NOT NULL COMMENT '沃土 guid',
  `photo_guid` varchar(200) NOT NULL COMMENT '头像guid',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0激活1锁定',
  `superior_tid` int(10) unsigned NOT NULL COMMENT '招生tid',
  `from_kcid` int(10) unsigned NOT NULL COMMENT '来源课程ID',
  `province` varchar(100) DEFAULT NULL COMMENT '省',
  `city` varchar(100) DEFAULT NULL COMMENT '市',
  `county` varchar(100) DEFAULT NULL COMMENT '区',
  `buzhu` float(8,2) NOT NULL,
  `typt_user_id` varchar(30) NOT NULL COMMENT '统一平台用户ID',
  `typt_user_token` varchar(30) NOT NULL COMMENT '统一平台用户令牌',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6219 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_stuoverhuifang
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_stuoverhuifang`;
CREATE TABLE `ims_wx_school_stuoverhuifang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `content` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `recordid` int(11) NOT NULL COMMENT 'coursebuy id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_task
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_task`;
CREATE TABLE `ims_wx_school_task` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` varchar(50) NOT NULL,
  `kcid` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL COMMENT '分类',
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_task_list
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_task_list`;
CREATE TABLE `ims_wx_school_task_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` varchar(50) NOT NULL,
  `ksid` int(10) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL COMMENT '分类',
  `createtime` int(11) NOT NULL,
  `taskid` int(10) unsigned NOT NULL,
  `kcid` int(11) NOT NULL COMMENT '课程id',
  `sid` int(11) NOT NULL COMMENT 'sid',
  `remind_type` tinyint(3) NOT NULL COMMENT '0上课提醒1过期提醒',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_tcourse
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_tcourse`;
CREATE TABLE `ims_wx_school_tcourse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分校id',
  `weid` int(10) unsigned NOT NULL,
  `tid` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '课程名称',
  `dagang` text NOT NULL COMMENT '课程大纲',
  `start` int(10) unsigned NOT NULL COMMENT '开始时间',
  `end` int(10) unsigned NOT NULL COMMENT '结束时间',
  `minge` int(11) NOT NULL COMMENT '名额限制',
  `adrr` varchar(100) NOT NULL DEFAULT '' COMMENT '授课地址或教室',
  `km_id` int(11) NOT NULL,
  `bj_id` int(11) NOT NULL,
  `xq_id` int(11) NOT NULL,
  `sd_id` int(11) NOT NULL,
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `yibao` int(11) NOT NULL COMMENT '已报人数',
  `cose` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1显示,2否',
  `ssort` tinyint(5) NOT NULL DEFAULT '0',
  `payweid` int(10) unsigned NOT NULL COMMENT '支付公众号',
  `signTime` int(5) NOT NULL COMMENT '签到时间',
  `isSign` int(3) NOT NULL COMMENT '是否可签到',
  `OldOrNew` int(2) NOT NULL COMMENT '固定课时or自由课程',
  `Ctype` int(3) NOT NULL COMMENT '课程类型',
  `FirstNum` int(3) NOT NULL COMMENT '首次包含多少课时',
  `RePrice` decimal(18,2) NOT NULL COMMENT '续费价格/课时',
  `ReNum` int(3) NOT NULL COMMENT '起续课时数',
  `AllNum` int(3) NOT NULL COMMENT '总共多少课时',
  `thumb` varchar(1000) NOT NULL,
  `maintid` int(11) NOT NULL COMMENT '主讲老师',
  `Point2Cost` int(11) NOT NULL COMMENT '多少积分抵一元',
  `MinPoint` int(11) NOT NULL COMMENT '最低使用下限',
  `MaxPoint` int(11) NOT NULL COMMENT '最高使用上限',
  `yytid` int(11) NOT NULL COMMENT '预约负责老师',
  `is_remind_pj` int(2) NOT NULL,
  `is_tuijian` int(3) NOT NULL COMMENT '是否推荐课程',
  `is_tx` tinyint(1) unsigned NOT NULL COMMENT '提醒开关',
  `txtime` int(10) unsigned NOT NULL COMMENT '提前分钟',
  `is_print` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否启用打印机',
  `printarr` varchar(100) NOT NULL DEFAULT '' COMMENT '打印机',
  `bigimg` text COMMENT '幻灯片',
  `is_dm` tinyint(1) NOT NULL DEFAULT '1' COMMENT '弹幕',
  `overtimeday` int(10) NOT NULL COMMENT '购买/续购后多少天过期',
  `remindday` int(10) NOT NULL COMMENT '提前多少天提醒',
  `tea_sign_confirm` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1老师签到确认2无需确认',
  `rechecktime` int(10) NOT NULL COMMENT '多少分钟内刷卡算重复刷卡',
  `is_print_xk` tinyint(3) NOT NULL COMMENT '是否打印销课记录',
  `allow_menu` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1启用章节2否',
  `allow_tuiguang` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1启用推广2否',
  `kc_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1线上0线下',
  `is_try` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1试听2否',
  `allow_pl` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '1评论2否',
  `sale_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1团2助力0关闭',
  `sale_id` int(10) unsigned NOT NULL COMMENT '营销设置ID',
  `tg_id` int(10) unsigned NOT NULL COMMENT '推广设置ID',
  `pkuser` varchar(500) DEFAULT NULL COMMENT '排课人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_teachers
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_teachers`;
CREATE TABLE `ims_wx_school_teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分校id',
  `weid` int(10) unsigned NOT NULL,
  `tname` varchar(50) NOT NULL,
  `birthdate` int(10) unsigned NOT NULL,
  `tel` varchar(20) NOT NULL,
  `mobile` char(11) NOT NULL,
  `email` char(50) NOT NULL,
  `sex` int(1) NOT NULL,
  `km_id1` int(11) NOT NULL COMMENT '授课科目1',
  `km_id2` int(11) NOT NULL COMMENT '授课科目2',
  `bj_id1` int(11) NOT NULL COMMENT '授课班级1',
  `bj_id2` int(11) NOT NULL COMMENT '授课班级2',
  `bj_id3` int(11) NOT NULL COMMENT '授课班级3',
  `xq_id1` int(11) NOT NULL COMMENT '授课年级1',
  `xq_id2` int(11) NOT NULL COMMENT '授课年级2',
  `xq_id3` int(11) NOT NULL COMMENT '授课年级3',
  `cc` varchar(30) NOT NULL DEFAULT '0' COMMENT '0',
  `jiontime` int(10) unsigned NOT NULL,
  `info` text NOT NULL COMMENT '教学成果',
  `jinyan` text NOT NULL COMMENT '教学经验',
  `headinfo` text NOT NULL COMMENT '教学特点',
  `thumb` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `sort` int(11) DEFAULT NULL,
  `code` int(11) unsigned NOT NULL COMMENT '绑定码',
  `openid` varchar(30) NOT NULL DEFAULT '0' COMMENT '老师微信',
  `uid` int(10) unsigned NOT NULL COMMENT '微擎系统memberID',
  `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示',
  `km_id3` int(11) NOT NULL COMMENT '授课科目3',
  `userid` int(11) NOT NULL COMMENT '用户ID',
  `fz_id` int(11) NOT NULL COMMENT '分组ID',
  `com` int(11) unsigned NOT NULL,
  `point` int(10) NOT NULL,
  `star` float NOT NULL COMMENT '平均星级',
  `idcard` varchar(20) NOT NULL,
  `jiguan` varchar(80) NOT NULL,
  `minzu` varchar(20) NOT NULL,
  `zzmianmao` varchar(30) NOT NULL,
  `address` varchar(300) NOT NULL,
  `otherinfo` text NOT NULL,
  `plate_num` varchar(15) DEFAULT NULL COMMENT '教师车牌号',
  `is_sell` tinyint(3) NOT NULL COMMENT '0不参与1业务员2销售经理',
  `guid` varchar(200) NOT NULL,
  `photo_guid` varchar(200) NOT NULL,
  `typt_user_id` varchar(30) NOT NULL COMMENT '统一平台用户ID',
  `typt_user_token` varchar(30) NOT NULL COMMENT '统一平台用户令牌',
  `typt_is_admin` tinyint(3) NOT NULL COMMENT '是否统一平台管理员',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=547 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_teascore
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_teascore`;
CREATE TABLE `ims_wx_school_teascore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `score` float(5,2) NOT NULL,
  `fromfzid` int(11) NOT NULL COMMENT '评分人分组',
  `fromtid` varchar(30) NOT NULL COMMENT '评分人tid',
  `scoretime` int(11) NOT NULL COMMENT '评分时间',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `obid` int(11) NOT NULL,
  `parentobid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `type` tinyint(3) NOT NULL,
  `bj_id` int(11) NOT NULL,
  `nj_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_teasencefiles
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_teasencefiles`;
CREATE TABLE `ims_wx_school_teasencefiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `senceid` int(11) NOT NULL,
  `up_word` varchar(500) NOT NULL,
  `up_imgs` varchar(5000) NOT NULL,
  `up_audio` varchar(1000) NOT NULL,
  `audiotime` int(11) NOT NULL,
  `up_video` varchar(1000) NOT NULL,
  `videoimg` varchar(500) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_tempstudent
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_tempstudent`;
CREATE TABLE `ims_wx_school_tempstudent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `sex` int(3) NOT NULL,
  `addr` varchar(200) NOT NULL,
  `nj_id` int(11) NOT NULL,
  `bj_id` int(11) NOT NULL,
  `pard` varchar(3) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_timetable
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_timetable`;
CREATE TABLE `ims_wx_school_timetable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分校id',
  `weid` int(10) unsigned NOT NULL,
  `bj_id` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `begintime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `monday` text NOT NULL,
  `tuesday` text NOT NULL,
  `wednesday` text NOT NULL,
  `thursday` text NOT NULL,
  `friday` text NOT NULL,
  `saturday` text NOT NULL,
  `sunday` text NOT NULL,
  `ishow` int(1) NOT NULL DEFAULT '1' COMMENT '1:显示,2隐藏,默认1',
  `sort` int(11) NOT NULL DEFAULT '1',
  `type` varchar(15) NOT NULL DEFAULT '',
  `headpic` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_todo
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_todo`;
CREATE TABLE `ims_wx_school_todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `fsid` int(11) NOT NULL COMMENT '发布者id',
  `jsid` int(11) NOT NULL COMMENT '接收者id',
  `zjid` int(11) NOT NULL COMMENT '转交者id',
  `todoname` varchar(100) NOT NULL COMMENT '任务名称',
  `content` varchar(2000) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `acttime` int(11) NOT NULL,
  `status` int(3) NOT NULL COMMENT '状态（7种）',
  `zjbeizhu` varchar(100) NOT NULL COMMENT '转交备注',
  `jjbeizhu1` varchar(100) NOT NULL COMMENT '第一人拒绝备注',
  `jjbeizhu2` varchar(100) NOT NULL COMMENT '第二人拒绝备注',
  `picurls` varchar(5000) NOT NULL,
  `audio` varchar(1000) NOT NULL,
  `audiotime` varchar(300) NOT NULL,
  `videoimg` varchar(1000) NOT NULL,
  `video` varchar(2000) NOT NULL,
  `ali_vod_id` varchar(100) DEFAULT '' COMMENT '视频画面ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_type
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_type`;
CREATE TABLE `ims_wx_school_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `name` varchar(50) NOT NULL COMMENT '类型名称',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `ssort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '显示状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_upsence
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_upsence`;
CREATE TABLE `ims_wx_school_upsence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `sencetime` int(11) NOT NULL,
  `qxfzid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `ali_vod_id` varchar(100) DEFAULT '' COMMENT '视频画面ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_user
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_user`;
CREATE TABLE `ims_wx_school_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学生ID',
  `tid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '老师ID',
  `weid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `uid` int(10) unsigned NOT NULL COMMENT '微擎系统memberID',
  `openid` varchar(30) NOT NULL COMMENT 'openid',
  `userinfo` text COMMENT '用户信息',
  `pard` int(1) unsigned NOT NULL COMMENT '关系',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户状态',
  `is_allowmsg` tinyint(1) NOT NULL DEFAULT '1' COMMENT '私聊信息接收语法',
  `is_frist` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1首次2不是',
  `realname` varchar(200) DEFAULT NULL COMMENT '用户真实姓名',
  `mobile` char(11) DEFAULT NULL COMMENT '手机号',
  `superior_tid` int(10) unsigned NOT NULL COMMENT '招生tid',
  `com_from` tinyint(1) DEFAULT '0' COMMENT '1营销0正常',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6396 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_user_class
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_user_class`;
CREATE TABLE `ims_wx_school_user_class` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned NOT NULL,
  `bj_id` int(10) unsigned NOT NULL,
  `km_id` int(10) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1老师2学生',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=514 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_wxpay
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_wxpay`;
CREATE TABLE `ims_wx_school_wxpay` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aitewo` varchar(30) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `0953` varchar(30) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID',
  `orderid` int(10) unsigned NOT NULL COMMENT '返回订单ID',
  `od1` int(10) unsigned NOT NULL COMMENT '1',
  `od2` int(10) unsigned NOT NULL COMMENT '2',
  `od3` int(10) unsigned NOT NULL COMMENT '3',
  `od4` int(10) unsigned NOT NULL COMMENT '4',
  `od5` int(10) unsigned NOT NULL COMMENT '5',
  `cose` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1未支付2为未支付3为已退款',
  `openid` varchar(30) NOT NULL DEFAULT '' COMMENT 'openid',
  `payweid` int(10) unsigned NOT NULL COMMENT '支付公众号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=660 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_yuecostlog
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_yuecostlog`;
CREATE TABLE `ims_wx_school_yuecostlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `yue_type` tinyint(3) NOT NULL COMMENT '1补助余额2普通余额3充电桩',
  `cost` float(8,2) NOT NULL,
  `costtime` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `cost_type` tinyint(3) NOT NULL COMMENT '1收入2消费',
  `macid` varchar(100) NOT NULL,
  `on_offline` tinyint(3) NOT NULL COMMENT '1线上2线下',
  `createtime` int(11) NOT NULL,
  `cztid` int(11) NOT NULL COMMENT '操作tid',
  `off_fid` varchar(70) NOT NULL COMMENT '线下流水fid',
  `paykind` tinyint(3) NOT NULL,
  `aftermoney` float(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_zjh
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_zjh`;
CREATE TABLE `ims_wx_school_zjh` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_on` tinyint(1) NOT NULL DEFAULT '1',
  `picrul` varchar(1000) NOT NULL,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `planuid` varchar(37) NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `bj_id` int(10) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1图片2文字',
  `start` int(10) unsigned NOT NULL,
  `end` int(10) unsigned NOT NULL,
  `ssort` int(10) unsigned NOT NULL COMMENT '排序',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_zjhdetail
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_zjhdetail`;
CREATE TABLE `ims_wx_school_zjhdetail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `planuid` varchar(37) NOT NULL,
  `curactivename` varchar(100) NOT NULL,
  `detailuid` varchar(37) NOT NULL,
  `curactiveid` varchar(100) NOT NULL,
  `activedesc` text COMMENT '内容',
  `week` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1-5',
  `ssort` int(10) unsigned NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wx_school_zjhset
-- ----------------------------
DROP TABLE IF EXISTS `ims_wx_school_zjhset`;
CREATE TABLE `ims_wx_school_zjhset` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `schoolid` int(10) unsigned NOT NULL,
  `planuid` varchar(37) NOT NULL,
  `activetypeid` varchar(100) NOT NULL,
  `curactiveid` varchar(100) NOT NULL,
  `activetypename` varchar(30) DEFAULT '' COMMENT '名称',
  `type` varchar(2) DEFAULT '' COMMENT 'AM,PM',
  `ssort` int(10) unsigned NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for ims_wxapp_general_analysis
-- ----------------------------
DROP TABLE IF EXISTS `ims_wxapp_general_analysis`;
CREATE TABLE `ims_wxapp_general_analysis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `session_cnt` int(10) NOT NULL,
  `visit_pv` int(10) NOT NULL,
  `visit_uv` int(10) NOT NULL,
  `visit_uv_new` int(10) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `stay_time_uv` varchar(10) NOT NULL,
  `stay_time_session` varchar(10) NOT NULL,
  `visit_depth` varchar(10) NOT NULL,
  `ref_date` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `ref_date` (`ref_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_wxapp_versions
-- ----------------------------
DROP TABLE IF EXISTS `ims_wxapp_versions`;
CREATE TABLE `ims_wxapp_versions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `version` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `modules` varchar(1000) NOT NULL,
  `design_method` tinyint(1) NOT NULL,
  `template` int(10) NOT NULL,
  `quickmenu` varchar(2500) NOT NULL,
  `createtime` int(10) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '0',
  `entry_id` int(11) NOT NULL DEFAULT '0',
  `appjson` text NOT NULL,
  `default_appjson` text NOT NULL,
  `use_default` tinyint(1) NOT NULL DEFAULT '1',
  `redirect` varchar(300) NOT NULL,
  `connection` varchar(1000) NOT NULL,
  `last_modules` varchar(1000) DEFAULT NULL,
  `tominiprogram` varchar(1000) NOT NULL,
  `upload_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `version` (`version`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ims_wxcard_reply
-- ----------------------------
DROP TABLE IF EXISTS `ims_wxcard_reply`;
CREATE TABLE `ims_wxcard_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `card_id` varchar(50) NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `brand_name` varchar(30) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  `success` varchar(255) NOT NULL,
  `error` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
