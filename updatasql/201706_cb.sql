

CREATE TABLE IF NOT EXISTS `dfshop_wx_pic` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(40) DEFAULT NULL COMMENT '新闻标题',
  `pic_group_id` int(8) NOT NULL DEFAULT '0' COMMENT '素材组表',
  `pic` varchar(255) DEFAULT NULL COMMENT '',
  `con` varchar(255) DEFAULT NULL COMMENT '',
  `url` varchar(255) DEFAULT NULL COMMENT '', 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='素材表' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `dfshop_wx_pic_group` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` tinyint(1) DEFAULT NULL COMMENT '2=单图片 3=多图',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='多图组表' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `dfshop_wx_msg_auto` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `search_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=模糊匹配 2=精准',
  `type` tinyint(1) DEFAULT NULL COMMENT '1=文字 2=单图片  3=多图',
  `pic_group_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示未选择',
  `keyword` varchar(40) DEFAULT NULL COMMENT '关键内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='自动回复规则表' AUTO_INCREMENT=1;

ALTER TABLE `dfshop_cat_gg_product` ADD `gg_con_title_gg` VARCHAR( 150 ) NULL DEFAULT NULL COMMENT '规格名称' AFTER `gg_con_title` ;


--------------------------------

CREATE TABLE IF NOT EXISTS `dferp_logistics_temp` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `warehouse_id` int(8) NOT NULL DEFAULT '0' COMMENT ' 仓库号 0 表示通用',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'type=1 自定义运费  type=2 包邮 ',
  `logc_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'type=1 计件 （件） type=2 计重 (KG) ',
  `title` varchar(50) DEFAULT NULL COMMENT '模板名',
  `uptime` datetime NOT NULL COMMENT '最后编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='自定义物流模板表' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `dferp_logistics_temp_con_show` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `company` varchar(30) NOT NULL DEFAULT '',
  `temp_id` int(8) NOT NULL DEFAULT '0' COMMENT '自定义物流模板ID',
  `default_num` smallint(4) DEFAULT NULL COMMENT '默认数量',
  `default_price` float(6,2) DEFAULT NULL COMMENT '默认运费',
  `add_num` smallint(4) DEFAULT NULL COMMENT '增加数量',
  `add_price` float(6,2) DEFAULT NULL COMMENT '增加运费',
  `city_names` text COMMENT '收货城市 逗号分割',
  `cityids` text,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=待审核 1=已审核',
  PRIMARY KEY (`id`),
  KEY `temp_id` (`temp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='自定义物流模板内容表' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `dferp_logistics_temp_con` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `temp_id` int(11) DEFAULT NULL COMMENT '自定义物流模板ID',
  `default_num` smallint(4) DEFAULT NULL COMMENT '默认数量',
  `default_price` float(5,0) DEFAULT NULL COMMENT '默认运费',
  `add_num` smallint(4) DEFAULT NULL COMMENT '增加数量',
  `add_price` float(5,0) DEFAULT NULL COMMENT '增加运费',
  `define_cityid` int(6) DEFAULT NULL COMMENT '收货城市',
  `define_city_name` varchar(30) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=待审核 1=已审核',
  PRIMARY KEY (`id`),
  UNIQUE KEY `temp_id_2` (`temp_id`,`define_cityid`),
  KEY `temp_id` (`temp_id`),
  KEY `define_cityid` (`define_cityid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='自定义物流模板内容表' AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `dfshop_base_image_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `web_filename` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '图片组名',
  `add_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `web_filename` (`web_filename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `dfshop_product_cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `buyer_id` int(10) DEFAULT '0' COMMENT '会员ID',
  `product_id` int(10) DEFAULT '0' COMMENT '产品ID',
  `seller_id` int(10) DEFAULT '0' COMMENT '来源分销商家',
  `price` float(10,2) DEFAULT '0.00' COMMENT '价格',
  `quantity` mediumint(8) DEFAULT '0' COMMENT '数量',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `warehouse_id` int(10) DEFAULT '0' COMMENT '仓库ID',
  `auth` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `buyer_id` (`buyer_id`),
  KEY `product_id` (`product_id`),
  KEY `spec_id` (`warehouse_id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='购物车' AUTO_INCREMENT=1 ;


-------------------------------------------------------- 

ALTER TABLE `dfshop_cat_gg_product_group` ADD `con` TEXT NULL DEFAULT NULL COMMENT '保存规则' AFTER `add_time` 
--------------------------------------------------------

ALTER TABLE `dfshop_user` ADD `email_code` INT( 4 ) NOT NULL DEFAULT '0' COMMENT 'email 找回密码验证码' AFTER `sex`;
ALTER TABLE `dfshop_user` ADD `email_time` INT( 10 ) NOT NULL DEFAULT '0' AFTER `email_code` ; 	
ALTER TABLE `dfshop_user` ADD `email` VARCHAR( 100 ) NULL DEFAULT NULL COMMENT '注册邮箱' AFTER `sex` ;