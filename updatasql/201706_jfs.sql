ALTER TABLE `dfshop_wx_msg_auto`
ADD COLUMN `context_msg`  varchar(255) NULL AFTER `keyword`




ALTER TABLE `dfshop_wx_msg_auto`
ADD COLUMN `last_modify_time`  datetime NULL COMMENT '最后修改时间' AFTER `context_msg`,
ADD COLUMN `last_modify_user`  int(3) NULL COMMENT '最后修改用户' AFTER `last_modify_time`


ALTER TABLE `dfshop_wx_pic_group`
ADD COLUMN `create_time`  datetime NULL COMMENT '创建时间' AFTER `type`,


ALTER TABLE `dfshop_wx_pic`
ADD COLUMN `describe`  varchar(32) NULL COMMENT '描述' AFTER `url`,





DROP TABLE IF EXISTS `dfshop_logistics_company`;
CREATE TABLE `dfshop_logistics_company` (
  `id` int(8) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `type` int(3) NOT NULL DEFAULT '0' COMMENT '物流企业编号',
  `company` varchar(20) NOT NULL DEFAULT '0' COMMENT '物流企业名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='物流企业配置';




DROP TABLE IF EXISTS `dfshop_delivery_address`;
CREATE TABLE `dfshop_delivery_address` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `userid` int(8) unsigned NOT NULL COMMENT '会员ID',
  `name` varchar(40) NOT NULL COMMENT '收货人',
  `provinceid` int(6) NOT NULL COMMENT '省ID',
  `cityid` int(6) NOT NULL COMMENT '市ID',
  `areaid` int(6) NOT NULL COMMENT '区ID',
  `area` varchar(255) NOT NULL COMMENT '省市区',
  `address` varchar(50) NOT NULL COMMENT '地址',
  `zip` varchar(20) DEFAULT NULL COMMENT '邮编',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机',
  `default` tinyint(1) DEFAULT '0' COMMENT '是否默认',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='收货地址表';