<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_USER_ERROR|E_USER_WARNING);//
header('Content-Type: text/html; charset=utf-8');
if(@function_exists('date_default_timezone_set'))
	@date_default_timezone_set('Asia/Shanghai');
define("APPID", 'wxcf836d1a4e6f906a');
define("APPSECRET", 'f06a381f01318a5cd653d2d77f3e0df7');
//file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET);
define("ACCESS_TOKEN", 'hFxLFjOYIPY1pjV4fnwoQWtJz7P9Jpygz02XKBFU-ynapgZLlWSeWyYmBNxu92b14ML34J8ftkJyL5H3UlKaZWAGCW-vFcxF2fO2E-z1S7Kw-DuoKYTX4oOyiTB41tAVRJKgAFAMEF');
class wechat
{
	function wechat()
	{

	}
	
	//获取秘钥
	function get_access_token()
	{
		$json=file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET");
		$de=json_encode($json,true);
		//{"access_token":"-aF6QLRkOHshfulV1-snX-VtgYfuuW8Km3bMiqSXiUIFnah2o6MhETxMoDwbEekd5XC-qDTyMJECxvQd5KEbpV3LNH8bpwoEs3p1vsvW5kMYLwH4F_4Am4la4i_wLZgGRKBdAEAKDU","expires_in":7200}
		//{"access_token":"ACCESS_TOKEN","expires_in":7200}    //成功返回能容
		//{"errcode":40013,"errmsg":"invalid appid"} 失败返回内容
		/*
			grant_type	是	获取access_token填写client_credential
			appid	    是	第三方用户唯一凭证
			secret	    是	第三方用户唯一凭证密钥，即appsecret
			
			-1	   系统繁忙，此时请开发者稍候再试
			0	   请求成功
			40001  AppSecret错误或者AppSecret不属于这个公众号，请开发者确认AppSecret的正确性
			40002  请确保grant_type字段值为client_credential
			40164  调用接口的IP地址不在白名单中，请在接口IP白名单中进行设置

		*/	
	}
	
	function send_post($url,$ps)
	{
		$data =$ps;  
		$opts = array(  
		 'http'=>array(  
		   'method'=>"POST",  
		   'header'=>"Content-type: application/json;charset=utf-8 \r\n".   //application/x-www-form-urlencoded
					 "Content-length:".strlen($data)."\r\n" .   
					 "Cookie: foo=bar\r\n" .   
					 "\r\n",  
		   'content' => $data,  
		 )  
		);  
		$cxContext = stream_context_create($opts);  
		echo $sFile = file_get_contents($url, false, $cxContext);  
		return json_decode($sFile,true);
	}
	
	function send_get($url,$ps)
	{
		$data =$ps;  
		$opts = array(  
		 'http'=>array(  
		   'method'=>"POST",  
		   'header'=>"Content-type: application/json;charset=utf-8 \r\n".   //application/x-www-form-urlencoded
					 "Content-length:".strlen($data)."\r\n" .   
					 "Cookie: foo=bar\r\n" .   
					 "\r\n",  
		   'content' => $data,  
		 )  
		);  
		$cxContext = stream_context_create($opts);  
		echo $sFile = file_get_contents($url, false, $cxContext);  
		return json_decode($sFile,true);
	}

	//创建菜单
	function create_menu()
	{
		// 
		//{"errcode":0,"errmsg":"ok"}
		
		//{"errcode":40018,"errmsg":"invalid button name size"}
	    //
		$ps='{"button":[{"type": "click","name": "今日歌曲","key":"V1001_TODAY_MUSIC"},{"type": "click","name":"我要报名","key":"BM_00001"}]}';
		$this->send_post("https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".ACCESS_TOKEN,$ps);
	    //{"errcode":0,"errmsg":"ok"}
	}
	
	//删除菜单
	function delete_menu()
	{
		echo file_get_contents("https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".ACCESS_TOKEN);
		//{"errcode":0,"errmsg":"ok"}
	}

	//添加模板
	function add_temp()
	{
		//获取模板ID
		echo file_get_contents("https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=".ACCESS_TOKEN);
	}
	
	//主动推送模板内容
	function send_msg()
	{
		/*
			{{first.DATA}}
			支付金额:{{money.DATA}}
			商品信息:{{orderProduct.DATA}} 
			{
				 "touser":"测试号的关注者的openId",
				 "template_id":"你刚才得到的模板ID",
				 "url":"关注者点击你的模板消息时跳转的链接",      
				 "data":{
				 "first": {
				   "value":"恭喜你购买成功！",
				   "color":"#173177"
				 },
				 "orderMoneySum":{
				   "value":"666",
				   "color":"#173177"
				 },
				 "orderProductName": {
				   "value":"男士正装",
				   "color":"#173177"
				 },
				 "Remark":{
				   "value":"欢迎再次购买！",
				   "color":"#173177"
				 }
			}
		*/
		/*
			B1xXEGPPz3eRtGEGQUT_wX3rTkhd3XbnM9MbujkzPOs
			oeqALwzxL2sv8Egn78P5ViU_vjlE
		*/
		$ps=array();		
		$ps['touser']='oeqALwzxL2sv8Egn78P5ViU_vjlE';
		$ps['template_id']='cUXh5PrPY2iAuvlFW6nqdw1bY8oldYSCxgU1og1GPcc';
		$ps['url']='http://test-dfshop.dfocuslife.com';
		$ps['topcolor']="#FF0000";
		$ps['data']['test']['value']="大黄"; 
		$ps['data']['test']['color']="#173177"; 
		$json=json_encode($ps);
		$this->send_post("https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".ACCESS_TOKEN,$json);
	}
}

$wechat=new wechat();
$wechat->send_msg();

//$wechat->delete_menu();
//$wechat->create_menu();
 /*
{"button":[{"type":"click",
          "name":"今日歌曲",
          "key":"V1001_TODAY_MUSIC"
      },
	{
    "button": [
        {
            "name": "扫码", 
            "sub_button": [
                {
                    "type": "scancode_waitmsg", 
                    "name": "扫码带提示", 
                    "key": "rselfmenu_0_0", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "scancode_push", 
                    "name": "扫码推事件", 
                    "key": "rselfmenu_0_1", 
                    "sub_button": [ ]
                }
            ]
        }, 
        {
            "name": "发图", 
            "sub_button": [
                {
                    "type": "pic_sysphoto", 
                    "name": "系统拍照发图", 
                    "key": "rselfmenu_1_0", 
                   "sub_button": [ ]
                 }, 
                {
                    "type": "pic_photo_or_album", 
                    "name": "拍照或者相册发图", 
                    "key": "rselfmenu_1_1", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "pic_weixin", 
                    "name": "微信相册发图", 
                    "key": "rselfmenu_1_2", 
                    "sub_button": [ ]
                }
            ]
        }, 
        {
            "name": "发送位置", 
            "type": "location_select", 
            "key": "rselfmenu_2_0"
        },
        {
           "type": "media_id", 
           "name": "图片", 
           "media_id": "MEDIA_ID1"
        }, 
        {
           "type": "view_limited", 
           "name": "图文消息", 
           "media_id": "MEDIA_ID2"
        }
    ]
}	 
*/
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 