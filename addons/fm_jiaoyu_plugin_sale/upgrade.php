<?php
//升级数据表
pdo_query("CREATE TABLE IF NOT EXISTS `ims_wx_school_sale_team` (
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

");

if(!pdo_fieldexists('wx_school_sale_team','id')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD 
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT");}
if(!pdo_fieldexists('wx_school_sale_team','weid')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `weid` int(10) unsigned NOT NULL COMMENT '公众号ID'");}
if(!pdo_fieldexists('wx_school_sale_team','schoolid')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `schoolid` int(10) unsigned NOT NULL COMMENT '学校ID'");}
if(!pdo_fieldexists('wx_school_sale_team','kcid')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `kcid` int(10) unsigned NOT NULL COMMENT '归属课程ID'");}
if(!pdo_fieldexists('wx_school_sale_team','userid')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `userid` int(10) unsigned NOT NULL COMMENT '参团的学生归属用户ID'");}
if(!pdo_fieldexists('wx_school_sale_team','openid')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `openid` varchar(500) DEFAULT NULL COMMENT '此粉丝openid'");}
if(!pdo_fieldexists('wx_school_sale_team','ismaster')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `ismaster` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '队长团长'");}
if(!pdo_fieldexists('wx_school_sale_team','masterid')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `masterid` int(10) unsigned NOT NULL COMMENT '归属团或组'");}
if(!pdo_fieldexists('wx_school_sale_team','is_sale')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `is_sale` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否消费'");}
if(!pdo_fieldexists('wx_school_sale_team','is_success')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `is_success` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否成功'");}
if(!pdo_fieldexists('wx_school_sale_team','is_really')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `is_really` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0真实1虚拟'");}
if(!pdo_fieldexists('wx_school_sale_team','pkuser')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `pkuser` varchar(500) DEFAULT NULL COMMENT '虚拟团组添加人'");}
if(!pdo_fieldexists('wx_school_sale_team','orderid')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `orderid` int(10) unsigned NOT NULL COMMENT '订单ID'");}
if(!pdo_fieldexists('wx_school_sale_team','tuifei')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `tuifei` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '退费申请'");}
if(!pdo_fieldexists('wx_school_sale_team','tfuser')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `tfuser` varchar(500) DEFAULT NULL COMMENT '推翻操作人'");}
if(!pdo_fieldexists('wx_school_sale_team','type')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `type` tinyint(1) unsigned NOT NULL COMMENT '1团购2助力'");}
if(!pdo_fieldexists('wx_school_sale_team','endtime')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `endtime` int(10) unsigned NOT NULL COMMENT '创建时间'");}
if(!pdo_fieldexists('wx_school_sale_team','createtime')) {pdo_query("ALTER TABLE ".tablename('wx_school_sale_team')." ADD   `createtime` int(10) unsigned NOT NULL COMMENT '创建时间'");}
