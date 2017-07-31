--------20170523----------
ALTER TABLE `dfshop_cat` ADD `pic` VARCHAR( 255 ) NULL DEFAULT NULL AFTER `cat_name` ;
ALTER TABLE `dfshop_brand` ADD `pic` VARCHAR( 255 ) NULL DEFAULT NULL AFTER `name` ;
--------------------------
ALTER TABLE `dfshop_cat` CHANGE `catid` `pid` INT( 6 ) NULL DEFAULT '0' COMMENT '分类ID';
ALTER TABLE `dfshop_cat` CHANGE `cat_name` `cat` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类名称';
ALTER TABLE `dfshop_cat` ADD `brand_ids` TEXT NULL DEFAULT NULL AFTER `cat` ;
CREATE TABLE IF NOT EXISTS `dfshop_warehouse` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '仓库名称',
  `con` varchar(100) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='仓库名称' AUTO_INCREMENT=1;

---------------------------
CREATE TABLE IF NOT EXISTS `dfshop_cat_gg_con` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cat_gg_id` int(6) DEFAULT '0' COMMENT '规格ID',
  `name` varchar(20) COMMENT '规格',
  PRIMARY KEY (`id`),
  KEY `cat_gg_id` (`cat_gg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='规格内容' AUTO_INCREMENT=1 ;

---------------------------

CREATE TABLE IF NOT EXISTS `dfshop_wx` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `temp_id` int(8) NOT NULL DEFAULT '0' COMMENT '模板ID',
  `name` varchar(40) NULL DEFAULT NULL COMMENT '模板名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='模板列表' AUTO_INCREMENT=1;

--------------------------
ALTER TABLE `dfshop_cat_gg_product` ADD `gg_con_ids` VARCHAR( 255 ) NULL DEFAULT '' COMMENT '规格ID' AFTER `select_md5` ;
ALTER TABLE `dfshop_cat_gg_con` ADD `group_product_id` INT( 8 ) NOT NULL DEFAULT '0' COMMENT '产品自定义规格' AFTER `cat_gg_id`;

--------------------------
CREATE TABLE IF NOT EXISTS `dfshop_web_gg` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `adm_userid` int(8) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL COMMENT '名称',
  `con` text COMMENT '描述',
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `adm_userid` (`adm_userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='公告' AUTO_INCREMENT=1;
-------------------------
CREATE TABLE IF NOT EXISTS `dfshop_web_ad` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `adm_userid` int(8) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL COMMENT '广告名称',
  `pic` varchar(20) NOT NULL COMMENT '广告主图',
  `width` varchar(20) NOT NULL COMMENT '宽度',
  `height` varchar(20) NOT NULL COMMENT '高度',
  `url` text COMMENT '广告链接',
  `add_time` datetime DEFAULT NULL  COMMENT '广告开始时间',
  `end_time` datetime DEFAULT NULL  COMMENT '广告结束时间',
  PRIMARY KEY (`id`),
  KEY `adm_userid` (`adm_userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='广告' AUTO_INCREMENT=1;

------------------------
ALTER TABLE `dfshop_cat_gg_product` ADD `status` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT '0=统一内容 1=独立内容' AFTER `con` ;
------------------------
#------------以下为队列--------------
CREATE TABLE IF NOT EXISTS `dfshop_dosend` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `api_id` int(6) NOT NULL DEFAULT '0' COMMENT '0 非API 接口',
  `flag_title` varchar(20) NOT NULL DEFAULT '0' COMMENT '查询标示',
  `type` tinyint(2) NOT NULL COMMENT '消息类型  1 订单推送 2 产品同步 3 订单同步  4 自动处理订单关闭',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '队列状态  1=排队中 -1=失败  2=执行完毕',
  `add_time` datetime DEFAULT NULL,
  `uptime` datetime DEFAULT NULL,
  `act_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '执行状态  0=无  1=执行 2=拦截  执行完毕清0 ',
  `dosend_lock` tinyint(1) NOT NULL DEFAULT '0' COMMENT '拦截状态 0=可运行 1=拦截',
  PRIMARY KEY (`id`),
  KEY `flag_title` (`flag_title`),
  KEY `type` (`type`),
  KEY `status` (`status`),
  KEY `act_status` (`act_status`),
  KEY `dosend_lock` (`dosend_lock`)
) ENGINE=myisam  DEFAULT CHARSET=utf8 COMMENT='消息队列' AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `dfshop_dosend_con` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `dosend_id` int(6) NOT NULL DEFAULT '0' COMMENT '0 非API 接口',
  `con` text NOT NULL COMMENT '推送内容',
  `return_con` text NOT NULL COMMENT '结果',
  PRIMARY KEY (`id`),
  KEY `dosend_id` (`dosend_id`)
) ENGINE=myisam  DEFAULT CHARSET=utf8 COMMENT='消息队列' AUTO_INCREMENT=1 ;
--------------------------------------

ALTER TABLE `dfshop_web_ad` ADD `status` INT NOT NULL DEFAULT '0' COMMENT '0=关闭 1=开启' AFTER `end_time` ;
ALTER TABLE `dfshop_web_ad` ADD `ad_group_id` INT( 6 ) NOT NULL DEFAULT '0' COMMENT '广告组' AFTER `end_time` ;

CREATE TABLE IF NOT EXISTS `dfshop_web_ad_group` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `adm_userid` int(8) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL COMMENT '广告组名称',
  `add_time` datetime DEFAULT NULL,
  `uptime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `adm_userid` (`adm_userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='广告组' AUTO_INCREMENT=1 ;

-----------------------------------------------
ALTER TABLE `dfshop_base_image` ADD `new_name` VARCHAR( 50 ) NULL DEFAULT NULL COMMENT '图片别名时使用该字段' AFTER `upload_name` ;
ALTER TABLE `dfshop_product` ADD `country_id` INT( 6 ) NOT NULL DEFAULT '0' COMMENT '国家ID' AFTER `country` ;
ALTER TABLE `dfshop_user_coupon` DROP `coupon_id` ;
ALTER TABLE `dfshop_user_coupon` DROP `userid` ;

CREATE TABLE IF NOT EXISTS `dfshop_user_coupon_use` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(8) NOT NULL DEFAULT '0' COMMENT 'userid',
  `price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '可低金额',
  `coupon_id` int(8) NOT NULL DEFAULT '0' COMMENT '优惠劵ID',
  `use_product_id` int(8) NOT NULL DEFAULT '0' COMMENT '购买的商品',
  `use_time` int(8) NOT NULL DEFAULT '0' COMMENT '使用时间',
  `product_id` int(8) NOT NULL DEFAULT '0' COMMENT '产品ID 指定产品可以使用',
  `cat_id` int(8) NOT NULL DEFAULT '0' COMMENT '指定分类可使用',
  `name` varchar(20) NOT NULL COMMENT '产品名称',
  `num` int(6) DEFAULT '0' COMMENT '商品数量',
  `pic` varchar(255) DEFAULT NULL COMMENT '产品图片',
  `endtime` datetime DEFAULT NULL COMMENT '结束时间',
  `addtime` datetime DEFAULT NULL COMMENT '开始时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=过期 1=待使用 2=已使用',
  `con` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='优惠券使用表' AUTO_INCREMENT=1 ;
ALTER TABLE `dfshop_logistics_temp` ADD `company` VARCHAR( 20 ) NULL DEFAULT NULL AFTER `title` ;
-------------------------------------------------

CREATE TABLE IF NOT EXISTS `dfshop_cat_gg_product_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='规格组ID' AUTO_INCREMENT=1;
----------------------------------------------------------------------------------------
ALTER TABLE `dfshop_user`
ADD COLUMN `level`  int(2) NULL DEFAULT 1 COMMENT '合伙人顶级',
ADD COLUMN `sale_total`  decimal(10,2) NULL COMMENT '销售总额' AFTER `level`,
ADD COLUMN `sex`  tinyint(1) NULL COMMENT '性别' AFTER `sale_total`



