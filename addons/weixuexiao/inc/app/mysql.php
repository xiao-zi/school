<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2020/5/14
 * Time: 13:36
 */
/**
 * app 用户表
 */
pdo_query("CREATE TABLE IF NOT EXISTS `ims_app_school_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '用户名称',
  `mobile` char(11) NOT NULL COMMENT '手机号',
  `thumb` varchar (255) default '' comment 'app用户头像',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `register_time` int(10) NOT NULL COMMENT '注册时间',
  `login_time` int(10) NOT NULL COMMENT '登陆时间',
  `login_num` int(5) DEFAULT '1' COMMENT '登陆次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");

if(!pdo_fieldexists('app_school_user','thumb')) {
    pdo_query("ALTER TABLE ims_app_school_user ADD COLUMN `thumb` varchar(255) DEFAULT '' COMMENT 'app用户头像'");
}
/**
 * 消息通知 （模仿微信提醒功能）
 */
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wx_school_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `message` varchar(255) NOT NULL COMMENT '关键词',
  `url` varchar(255) NOT NULL COMMENT '链接页面',
  `parameter` varchar(255) NOT NULL COMMENT '参数',
  `is_read` TINYINT(1) unsigned NOT NULL DEFAULT 0 COMMENT '是否已读 1：已读，0：未读',
  `user_id` INT(11) unsigned NOT NULL DEFAULT 0 COMMENT 'app用户id',
  `type` TINYINT(1) unsigned NOT NULL DEFAULT 0 COMMENT '类型',
  `create_at` INT(10) unsigned NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_at` INT(10) unsigned NOT NULL DEFAULT 0 COMMENT '读的时间',
  PRIMARY KEY (`id`),
  index `user_id`(`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;");
/**
 * 补充文章点赞记录
 */
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wx_school_news_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `new_id` int(11) not  null comment '文章的id',
  `user_id` INT(11) unsigned NOT NULL DEFAULT 0 COMMENT 'app用户id',
  `create_at` INT(10) unsigned NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (`id`),
  key `user_id`(`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;");
/**
 * 绑定表
 */
if(!pdo_fieldexists('wx_school_user','userid')) {
    pdo_query("ALTER TABLE ims_wx_school_user ADD COLUMN `userid` INT(11) DEFAULT 0 COMMENT 'app用户id'");
}
if(!pdo_fieldexists('wx_school_user','type')) {
    pdo_query("ALTER TABLE ims_wx_school_user ADD COLUMN `type` tinyint(1) DEFAULT 1 COMMENT '1:微信绑定，2：app绑定'");
}
/**
 * 教师表
 */
if(!pdo_fieldexists('wx_school_teachers','userid')) {
    pdo_query("ALTER TABLE ims_wx_school_teachers ADD COLUMN `user_id` INT(11) DEFAULT 0 COMMENT 'app用户id'");
}
if(!pdo_fieldexists('wx_school_teachers','type')) {
    pdo_query("ALTER TABLE ims_wx_school_teachers ADD COLUMN `type` tinyint(1) DEFAULT 1 COMMENT '1:微信绑定，2：app绑定'");
}
/**
 * 学生表 因为一个学生可以对应多个用户所以废弃
 */
//if(!pdo_fieldexists('wx_school_students','user_id')) {
//    pdo_query("ALTER TABLE ims_wx_school_students ADD COLUMN `user_id` INT(11) DEFAULT 0 COMMENT 'app客户的id'");
//}
//if(!pdo_fieldexists('wx_school_students','userid')) {
//    pdo_query("ALTER TABLE ims_wx_school_students ADD COLUMN `userid` int(11) DEFAULT 0 COMMENT '绑定表的id'");
//}
/**
 * 请假表添加app用户id
 */
if(!pdo_fieldexists('wx_school_leave','user_id')) {
    pdo_query("ALTER TABLE ims_wx_school_leave ADD COLUMN `user_id` INT(11) DEFAULT 0 COMMENT 'app用户id'");
}
/**
 * 班级圈 添加user_id 用来代替uid的作用
 */
if(!pdo_fieldexists('wx_school_bjq','user_id')) {
    pdo_query("ALTER TABLE ims_wx_school_bjq ADD COLUMN `user_id` INT(11) DEFAULT 0 COMMENT 'app用户id'");
}
if(pdo_fieldexists('wx_school_bjq','msgtype')) {
    pdo_query("ALTER TABLE ims_wx_school_bjq modify COLUMN msgtype tinyint(1) DEFAULT 1 COMMENT '1：图文，2：语音，3：视频，4：分享，5：多媒体 7:班级通知'");
}
/**
 * 通知
 */
if(pdo_fieldexists('wx_school_notice','msgtype')) {
    pdo_query("ALTER TABLE ims_wx_school_notice modify COLUMN is_research tinyint(3) DEFAULT 0 COMMENT '调查问卷 1:是 0:不是'");
}

/**
 * 点赞 添加user_id 用来代替uid的作用
 */
if(!pdo_fieldexists('wx_school_dianzan','user_id')) {
    pdo_query("ALTER TABLE ims_wx_school_dianzan ADD COLUMN `user_id` INT(11) DEFAULT 0 COMMENT 'app用户id'");
}
/**
 * 报名 添加user_id 用来代替uid的作用
 */
if(!pdo_fieldexists('wx_school_signup','user_id')) {
    pdo_query("ALTER TABLE ims_wx_school_signup ADD COLUMN `user_id` INT(11) DEFAULT 0 COMMENT 'app用户id'");
}
if(!pdo_fieldexists('wx_school_signup','type')) {
    pdo_query("ALTER TABLE ims_wx_school_signup ADD COLUMN `type` tinyint(2) DEFAULT 0 COMMENT '用来判断用户通过什么提交申请的，1：微信，2：app'");
}
if(!pdo_fieldexists('wx_school_signup','code')) {
    pdo_query("ALTER TABLE ims_wx_school_signup ADD COLUMN `code` char(8) DEFAULT 0 COMMENT '生成的随机绑定码'");
}
/**
 * 订单表 添加user_id 用来代替uid的作用
 */
if(!pdo_fieldexists('wx_school_order','user_id')) {
    pdo_query("ALTER TABLE ims_wx_school_order ADD COLUMN `user_id` INT(11) DEFAULT 0 COMMENT 'app用户id'");
}
/**
 * 收货人表 添加user_id 用来代替openid的作用
 */
if(!pdo_fieldexists('wx_school_address','user_id')) {
    pdo_query("ALTER TABLE ims_wx_school_address ADD COLUMN `user_id` INT(11) DEFAULT 0 COMMENT 'app用户id'");
}

