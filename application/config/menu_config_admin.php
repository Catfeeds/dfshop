<?php

$config['menu_config'] = array(
	"index"=>array
	(
		'管理中心首页',
		array
		(
			array(
				'管理中心首页',
				array(
						'info,1,admin_index,管理中心首页' //操作内容,是否隐藏,类型名称,中文菜单名称
					)
				)
		)
	)
	,
	"configs"=>array
	(
		'网站管理',
		array
		(
			array(
				'管理员',
				array(
						'admin_log,1,user,操作日志',
						'group_list,1,group,权限组', 
						'group_add,0,group,添加权限组', 
						'admin_list,1,user,管理员列表',  
						'admin_add,0,user,添加管理员', 
						'admin_pwd,1,user,修改密码'
					)
				),
			array(
				'网站设置',
				array(
					    'index_diy,1,admin_index,首页设置',
						'web_config,1,admin_index,网站设置',
						'clear_temp,1,admin_index,清空缓存',
						'district_list,1,district,地区设置',
					)
				),
			array(
				'广告公告',
				array(
						'web_msg_list,1,admin_index,公告列表',
						'web_msg_add,0,admin_index,添加公告',
						'web_ad_list,1,Adv,广告列表',
						'web_ad_add,0,Adv,添加广告',
						'web_ad_add_group,0,Adv,添加广告组',
					)
				),
			array(
				'图片管理',
				array(
						'image_list,1,admin_index,图片列表',
					)
				),	
			array(
				'消息队列',
				array(
						'email_site,1,admin_index,邮箱设置',
						'mobile_site,1,admin_index,短信设置',
						'dosend,1,admin_index,队列列表',
						'dosend_site,1,admin_index,队列设置'
					)
				)		
		)
	)
	,
	"product"=>array
	(
		'商品管理',
		array
		(
			array(
				'API商品',
				array(
						'api_product_list,1,api_product,同步商品', 
					)
				),
			array(
				'商品管理',
				array(
						'product_list,1,product,商品列表',
						'product_add,1,product,添加商品'
					)
				),
			array(
				'品牌分类',
				array(
						'cat_list,1,cat,商品类型',
						'cat_gg_list,1,cat,商品规格',
						'brand_list,1,brand,商品品牌',
						'brand_add_edit,0,brand,新增品牌',
					)
				),
			array(
				'仓库产地',
				array(
						'warehouse_list,1,warehouse,仓库列表',
						'warehouse_add,0,warehouse,添加仓库',
						'country_list,1,country,产地列表',
						'update_country_display,0,country,更新产地状态'
					)
				)			
		)
	)
	,
	"order"=>array
	(
		'订单管理',
		array
		(
			array(
				'运费模板',
				array(
						'temp_list,1,logistics,模板列表', 
						'company_list,1,logistics,物流公司', 
					)
				),
			array(
				'订单管理',
				array(
						'order_list,1,order,订单管理',
						'order_site,1,order,订单设置'
					)
				)
		)
	)
	,
	"hehuo"=>array
	(
		'合伙人',
		array
		(
			array(
				'合伙人',
				array(
						'hehuo_info,1,hehuo,合伙人概况', 
						'hehuo_site,1,hehuo,合伙人设置', 
						'hehuo_info,1,hehuo,合伙人名片' 
					)
			),
			array(
				'合伙人管理',
				array(
						'hehuo_list,1,hehuo,合伙人列表', 
						'hehuo_level,1,hehuo,合伙人等级', 
						'hehuo_seller,1,hehuo,销售排行'
					)
			)
			,
			array(
				'佣金管理',
				array(
						'hehuo_commission_list,1,hehuo,佣金明细',
						'hehuo_commission_supply,1,hehuo,提现申请',
						'hehuo_commission_cash,1,hehuo,提现记录',
						'hehuo_commission_setting,1,hehuo,设置提现',
					)
			)
		)
	)
	,
	"wx"=>array
	(
		'微信管理',
		array
		( 
			array(
				'微信设置',
				array(
						'config,1,wx,公从号绑定', 
						'guanzhu,1,wx,一键关注', 
						'login,1,wx,一键登录', 
						'auto_back_msg,1,wx,自动回复',
						'auto_menu,1,wx,自定义菜单',
						'kf_site,1,wx,客户设置',
						'wx_temp,1,wx,消息模板',
						'wx_pay,1,wx,微信支付',
						'wx_pkig,1,wx,微信红包',
						'wx_sucai,1,wx,素材管理'
					)
				),
			array(
				'微信群发',
				array(
						'wx_msg,1,wx,微信群发'
					)
				),

		)
	)
	,
	"yh"=>array
	(
		'优惠管理',
		array
		( 
			array(
				'优惠劵',
				array(
						'yh_list,1,yh,优惠劵列表',
						'yh_add,0,yh,生成优惠劵',
						'yh_user_list,1,yh,会员优惠劵',
					)
				),
			array(
				'积分管理',
				array(
					    'jf_list,1,yh,积分列表',
						'jf_site,1,yh,签到设置',
						'jf_product,1,yh,积分商品',
						'jf_add,0,yh,添加积分商品'
					)
				)	
		)
	)
);

