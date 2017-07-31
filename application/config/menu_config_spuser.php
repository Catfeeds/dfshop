<?php
$nva_menu=array(
	  			0=>array(
					 "name"=>'首页',
					 "action"=>"sp_index/index",
					 "m"=>"sp_index",
					 "ico"=>'icon-home',
					 'liclass'=>'start', //开始
					 "actions"=>array(
					  )	
				)
				,
				4=>array(
					  "name"=>'订单管理',
					  "ico"=>'icon-bar-chart',
					  "m"=>"order",
					  "action"=>"",
					  'liclass'=>'', //结束的
					  "actions"=>array(
						 "order/order_list"=>"订单表",
					  )	
				),
				5=>array(
					  "name"=>'账户管理',
					  "ico"=>'icon-male',
					  "m"=>"user",
					  "action"=>"",
					  'liclass'=>'', //结束的
					  "actions"=>array(
						 "user/info_passwd"=>"修改登陆密码",
						 'user/info_act_pass'=>'修改操作密码'
					  )	
				)
			);
