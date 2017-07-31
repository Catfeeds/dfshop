<?php
$config['order_status'] = array(	
	1 => '网站审核中',
	2 => '海关审核中',
	3 => '已发货',
   -1 => '系统作废'//,
   //-2 => '异常作废'
);

$config['zy_order_status'] = array(	
	1 => '待发货',
	3 => '已发货',
   -1 => '已作废'
);


$config['order_payment_status'] = array(
	0 => '未付款',
	1 => '已付款',
	2 => '交易完成',
   -1 => '已退款'	,
   -2 => '待退款'			
);			  

$config['stock_d_status'] = array(
	1 => '开启订阅',
    0 => '关闭订阅'				
);			  

$config['stock_k_status'] = array(
	1 => '库存可申请',
	0 => '库存不可申请',
   -1 => '关闭销售'				
);	

$config['order_hg_status'] = array(
	0 => '未申报',
	1 => '正在处理',
	2 => '申报完毕',
   -1 => '申报失败'				
);			  

$config['order_close_status'] = array(
    0 => '无申请',
	1 => '正在作废处理',
	2 => '作废核对中',
	3 => '作废成功',
   -1 => '不可作废'				
);			  

		  



