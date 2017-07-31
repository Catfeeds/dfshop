<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_USER_ERROR|E_USER_WARNING);//
header('Content-Type: text/html; charset=utf-8');
if(@function_exists('date_default_timezone_set'))
	@date_default_timezone_set('Asia/Shanghai');
//wxcf836d1a4e6f906a
//f06a381f01318a5cd653d2d77f3e0df7
define('WEBURL','http://test-dfshop.dfocuslife.com');
define('BASEPATH',substr(dirname(__FILE__), 0, -3).'system');
$config['webpath']=dirname(__FILE__)."/";
//d2T33fYgz1bWzh8mgxlPZC8bokgG_t9BZ_GnAZCmr2A   通知模板
//include '../../application/libraries/CI_wx.php';
include('db.class.php');
include ('../../application/config/database.php');

//echo file_get_contents('../../application/logs/log-2017-07-05.php');
$db=$db['default'];
$dba=new dba($db['hostname'],$db['username'],$db['password'],$db['database'],'3306');
////$wx=new CI_wx();

$wechat ='101test00#$';
$product['weburl']='http://test-dfshop.dfocuslife.com';
$product['pname']='测试';
$product['Description']='测试内容';
$product['pic']='http://test-dfshop.dfocuslife.com/static/test.jpg';

define("TOKEN", $wechat);
$wechatObj = new wechatCallbackapiTest($dba);
if($_GET["echostr"]&&$_GET["signature"]&&$_GET["timestamp"]&&$_GET["nonce"])
	$wechatObj->valid();
else
	$wechatObj->responseMsg();

class wechatCallbackapiTest
{
	var $db;

	public function __construct($dba)
	{
		$this->db=$dba;
	}


	public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
			echo $echoStr;
        	exit;
        }
    }

	public function get_temp()
	{
		return "<xml>
				  <ToUserName><![CDATA[%s]]></ToUserName>
				  <FromUserName><![CDATA[%s]]></FromUserName>
				  <CreateTime>%s</CreateTime>
				  <MsgType><![CDATA[%s]]></MsgType>
			  	  <Content><![CDATA[%s]]></Content>
			   </xml>";
	}

    public function responseMsg()
    {

		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];	
		$token = TOKEN;
		$sin=$this->getSHA1($token, $timestamp, $nonce);
		
		if(trim($_GET["signature"])!=$sin)
		{
			$msgType = "text";
			$textTpl = $this->get_temp(); 
			$contentStr="签名失败配置 未正确";	 
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
			exit;
		}
		
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		global $product;		
		/*
		<xml>
		<ToUserName><![CDATA[toUser]]></ToUserName>
		<FromUserName><![CDATA[FromUser]]></FromUserName>
		<CreateTime>123456789</CreateTime>
		<MsgType><![CDATA[event]]></MsgType>
		<Event><![CDATA[VIEW]]></Event>
		<EventKey><![CDATA[www.qq.com]]></EventKey>
		<MenuId>MENUID</MenuId>
		</xml>
        */
		
		if (!empty($postStr)){
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;  
                $toUsername = $postObj->ToUserName;
                $time = time();
				$RX_TYPE = trim($postObj->MsgType);
				$num=0;
				$str="";

				if($RX_TYPE=='text')
				{
					$keyword = trim($postObj->Content);
					$sql="SELECT `context_msg`,`pic_group_id` from dfshop_wx_msg_auto where `keyword`='$keyword' and `search_type`=2";
					$this->db->query($sql);
					$back_msg=$this->db->fetchRow();
					if(empty($back_msg))
					{
						//模糊搜索
						$sql="SELECT `context_msg`,`pic_group_id` from dfshop_wx_msg_auto where `keyword` like '%$keyword%' and `search_type`=1";
						$this->db->query($sql);
						$mohu_back_msg=$this->db->fetchRow();

						if(empty($mohu_back_msg))
						{

						}
						else
						{
							//精准搜索
							if($mohu_back_msg['pic_group_id']!=0)
							{
								//说明图文消息  先放下
								$sql="SELECT `type` from dfshop_wx_pic_group where `id`=$mohu_back_msg[pic_group_id]";
								$this->db->query($sql);
								$type=$this->db->fetchField('type');
								if($type==2)
								{
									//单图文
									$sql="SELECT * FROM dfshop_wx_pic WHERE `pic_group_id`=$mohu_back_msg[pic_group_id]";
									$this->db->query($sql);
									$tuwen_info=$this->db->fetchRow();
									$news_arr=array();
									$news_arr[]=$tuwen_info;
									echo $this->transmitNews($postObj,$news_arr);
									die;
								}
								elseif ($type==3)
								{
									//多图文

								}

							}
							else
							{
								//说明是文本消息  直接返回
								$msg=$mohu_back_msg['context_msg'];
								$msgType = "text";
								$textTpl = $this->get_temp();
								$contentStr=$msg;
								$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
								echo $resultStr;die;

							}
						}
					}
					else
					{
						//精准搜索
						if($back_msg['pic_group_id']!=0)
						{
							//说明图文消息  先放下
							//说明图文消息  先放下
							$sql="SELECT `type` from dfshop_wx_pic_group where `id`=$back_msg[pic_group_id]";
							$this->db->query($sql);
							$type=$this->db->fetchField('type');
							if($type==2)
							{
								//单图文
								$sql="SELECT * FROM dfshop_wx_pic WHERE `pic_group_id`=$back_msg[pic_group_id]";
								$this->db->query($sql);
								$tuwen_info=$this->db->fetchRow();
								$news_arr=array();
								$news_arr[]=$tuwen_info;
								echo $this->transmitNews($postObj,$news_arr);
								die;
							}
							elseif ($type==3)
							{
								//多图文

							}

						}
						else
						{
							//说明是文本消息  直接返回
							$msg=$back_msg['context_msg'];
							$msgType = "text";
							$textTpl = $this->get_temp();
							$contentStr=$msg;
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							echo $resultStr;die;

						}
					}

					if($keyword=='优惠活动')
					{
						$msgType = "text";
						$textTpl = $this->get_temp(); 
						$contentStr="当前无优惠活动 ";	 
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						echo $resultStr;
					}
					elseif($keyword=='打折活动')
					{
						$msgType = "text";
						$textTpl = $this->get_temp(); 
						$contentStr="打折活动如下.....";	 
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						echo $resultStr;
					}
					elseif($keyword=='roll')
					{
						$msgType = "text";
						$textTpl = $this->get_temp(); 
						$contentStr="您 roll 出啦 ".rand(1,100)." ".$str;	 
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						echo $resultStr;
					}
					elseif(!empty($keyword))
					{
						$str.="<item><Title><![CDATA[".$product['pname']."]]></Title>" 
							 ."<Description><![CDATA[".$product['Description']."]]></Description>"
							 ."<PicUrl><![CDATA[".$product['pic']."]]></PicUrl>"
							 ."<Url><![CDATA[".$product['weburl']."]]></Url></item>";
							 
					    $str.="<item><Title><![CDATA[".$product['pname']."]]></Title>" 
							 ."<Description><![CDATA[".$product['Description']."]]></Description>"
							 ."<PicUrl><![CDATA[".$product['pic']."]]></PicUrl>"
							 ."<Url><![CDATA[".$product['weburl']."]]></Url></item>";
						$num=2;

						$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[news]]></MsgType>
						<ArticleCount>".$num."</ArticleCount>
						<Articles>".$str."</Articles>
						<FuncFlag>1</FuncFlag>
						</xml>"; 
						$msgType = "text";
						$contentStr = "";
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						echo $resultStr;
					}
					else
						echo "Input something...";
				}
				elseif($RX_TYPE=='event')
				{
					//Event	事件类型，subscribe(订阅)、unsubscribe(取消订阅)
					$Event=trim($postObj->Event) ;
					if($Event=='subscribe')
					{
						    //关注自动注册成为会员..........
							
						    $msgType = "text";
							$textTpl = $this->get_temp(); 
							$contentStr="欢迎您的关注 ".$product['weburl'];	 
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							echo $resultStr;

					}
					elseif($Event=='unsubscribe')
					{
						   //修改数据库做记录.............
						   	
						   echo "Input something...";
					}
					elseif($Event=='CLICK')//自动菜单点击事件
					{
						$keyword = trim($postObj->EventKey);
						if($keyword=='V1001_TODAY_MUSIC')
						{
							$msgType = "text";
							$textTpl = $this->get_temp(); 
							$contentStr="当前无音乐".$product['weburl'];	 
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							echo $resultStr;
						}
						elseif($keyword=='BM_00001')
						{
							$msgType = "text";
							$textTpl = $this->get_temp(); 
							$contentStr="报名结束".$product['pic'];	 
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							echo $resultStr;
						}
						else
							echo "Input something...";
					}

				}

				else{
                	echo "Input something...";
                }
        }else{
        	echo "";
        	exit;
        }
    }
	
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
	public function getSHA1($token, $timestamp, $nonce, $encrypt_msg='')
	{
		$array = array($encrypt_msg, $token, $timestamp, $nonce);
		sort($array, SORT_STRING);
		$str = implode($array);
		return sha1($str);
	}



	private function transmitNews($object, $newsArray)
	{
		if(!is_array($newsArray)){
			return;
		}
		$itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
    </item>
";
		$item_str = "";
		foreach ($newsArray as $item){
			$item_str .= sprintf($itemTpl, $item['name'], $item['con'], WEBURL.$item['pic'], $item['url']);
		}

		$xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
</xml>";

		$result = sprintf($xmlTpl, $object->FromUserName,$object->ToUserName, time(), count($newsArray));
		return $result;
	}

}
?>