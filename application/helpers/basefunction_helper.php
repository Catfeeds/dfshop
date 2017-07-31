<?php
defined('BASEPATH') OR exit('No direct script access allowed');
					
if ( ! function_exists('msg_json') )
{
	function msg_json($msg='',$type=1)
	{
		$msg = array('msg'  => $msg,'type' =>$type );
		return json_encode($msg);	
	}
}

if ( ! function_exists('header_404') )
{
	function header_404()
	{
		header("location:/404.php");
		exit;
	}
}

if ( ! function_exists('base_site_url') )
{

	function base_site_url($c,$type='member.php')
	{
		if($type==='u')
			$type='user.php';
		if($type==='index')
			$type='index.php';
				
		return config_item('base_url')."/".$type."/".$c;
	}
}


if ( ! function_exists('check_gg_group') )
{
	//$check_type=0 前台验证 $check_type=1 后台验证
	function check_gg_group($id,$ar_gg=array(array()),$check_type=0)
	{
		$CI = & get_instance();	
		$CI->load->model('Base_get_model');
	    $CI->load->model('Base_update_model');

		$dpro=$CI->Base_get_model->get_row(tab_m('product'),'id,group_product_id',array('id'=>$id));
		if(empty($dpro))
			return false;
			
		$row=$CI->Base_get_model->get_row(tab_m('cat_gg_product'),'con',array('product_id'=>$dpro['id']));
		if(empty($row))
			return false;
			
	 	$d=json_decode($row['con'],true);
		$arr=array();
		//获取多维数组分布
		foreach($d as $k=>$v)
		{
			foreach($v as $kk=>$vv)
			{
				$ar[$k][]=$kk;
				$arr[]=array($k,$kk);;
			}
		}
		
		//$ar_gg=array(array(7,36),array(6,35));
		$td_ar=array();
		foreach($arr as $k=>$v)
		{
			foreach($ar as $kk=>$vv)
			{
				if($v[0]!=$kk)
					$arr[$k][2][$kk]=$vv;
				else
					$arr[$k][2][$kk]=array(0=>$v[1]);
			}
			
			if(!empty($ar_gg[0])&&$v[0]==$ar_gg[0][0]&&$v[1]==$ar_gg[0][1])
			{
				$td_ar=$arr[$k][2];
				break;
			}
		}
		
		if(empty($td_ar))
			return false;
			
		if(!empty($ar_gg[1]))
		{
			foreach($td_ar as $k=>$v)
			{
				foreach($ar_gg as $v)
				{
					if($k==$v[0])
					{
						$td_ar[$k]=array($v[1]);
						break;
					}
				}
			}
		}
		
		$i=0;//列
		$j=0;
		$ar_start=array();
		$ar=array();
		foreach($td_ar as $ar_a)	
		{
		  if(empty($ar_a))
			  break;
		  if(empty($ar_start))
		  {
			  foreach($ar_a as $id)	
			  {
				  $ar[$j][$i]=$id;
				  $j++;
			  }
		  }
		  else
		  {
			  $ar=array();
			  foreach($ar_start as $v)
			  {
				  foreach($ar_a as $id)	
				  {
					  $v[$i]=$id;
					  $ar[]=$v;
				  }		
			  }
		  }
		  $i++;
		  $ar_start=$ar;
		}

		if(empty($ar_start))
			return false;
			
		$ar_gg=array();
		$ar_ggg=array();
			
		foreach($ar_start as $k=>$v)
		{
			$ar_gg[$k]=$dpro['group_product_id']."|gg|".implode("|",$v);
			$dd=$CI->Base_get_model->get_row(tab_m('cat_gg_product'),'product_id',array('select_md5'=>md5($ar_gg[$k])));
			if($check_type==1)
			{
				if(!empty($dd))
					$ar_ggg[$k]=$v;
			}
			else
			{
				$dd=$CI->Base_get_model->get_row(tab_m('product'),'stock,status',array('id'=>$dd['product_id']));
				if($dd['stock']>0&&$dd['status']==1)
					$ar_ggg[$k]=$v;
			}
		}
		
		return array($ar_gg,$ar_ggg);
	}
}

if ( ! function_exists('check_gg_con') )
{
	//规格
	function check_gg_con($id,$ar,$type=1,$prodcut_id=0)
	{
		//后台
		if($type==1)
		{	
			if(!empty($ar)&&is_array($ar))	
			{
				foreach($ar as $kk=>$ar1)
				{
					if(!empty($ar1)&&is_array($ar1))
					{
						foreach($ar1 as $sid=>$v)
						{
							if($id==$sid)
							{
								if(!empty($prodcut_id))
								{
									$d=check_gg_group($prodcut_id,array(array($kk,$id)),1);
									if(is_array($d)&&empty($d[1]))
										return 2;
								}
								return 1;
							}
						}
					}
				}
			}
		}
		elseif($type==2)
		{	
			if(!empty($ar)&&is_array($ar))	
			{
				foreach($ar as $ar1)
				{
					if(!empty($ar1)&&is_array($ar1))
						foreach($ar1 as $sid=>$v)
						{
							if($id==$sid)
								return $v;
						}
				}
			}
		}
		else
		{
		//前台
		//-----------------	
		
		}
		return 0;
	}
}

if ( ! function_exists('create_file') )
{
	function create_file($file_name, $content) 
	{     	 
		 if(!$fp = fopen($file_name, "w+")){ 
			 return false; 
		 } 
		 if(!fwrite($fp, $content)){ 
			 fclose($fp); 
			 return false; 
		 }
		 fclose($fp);
		 @chmod($file_name,0666);
	}
}
  
if ( ! function_exists('replace_outside_link') )
{
	function  replace_outside_link($str)
	{
	   $str=preg_replace("/<a.*>|<\/a>/isU",'',$str);
	   return $str;
	}
}

if (! function_exists('url_convert'))
{
	function url_convert($array)
	{
		if(is_array($array))
			 @array_walk($array,create_function('&$value, $key', '$value = $key ."=". $value;'));
		return implode("&",$array);
	}
}

if ( ! function_exists('filter_replace') )
{
	function  filter_replace($str)
	{
	   require(APPPATH."/config/filter_config.php");	
	   $filter_ar=explode("|",$filter);
	   return str_replace($filter_ar,"",$str);
	}
}

if ( ! function_exists('replace_cssx') )
{
	function replace_cssx($str)
	{
		$astr=array("a","script","iframe","font");
		foreach($astr as $v)
			$str=preg_replace("/<.*".$v.".*>|<\/.*".$v.".*>/isU",'',$str);
		return $str;
	}
}

if ( ! function_exists('get_login_auth') )
{
	//管理员直接登陆
	function get_login_auth($uid,$index,$username)
	{
		$tm=time();
		$adm_auth=md5($tm.'@#$^&8686!·￥23423·#￥34'.$uid);
		$url_ar=array('sp'=>'/sp.php/sp_index/index','seller'=>'/index.php/seller_index/index');
		return $url_ar[$index]."?tm=".$tm."&adm_auth=".$adm_auth."&uid=".$uid."&username=".urlencode($username);
	}
}

if ( ! function_exists('get_web_dir') )
{
	function get_web_dir($dir='')
	{
		return  WEB_DIR."/static/o2o";
	}
}

if ( ! function_exists('myfunctionconvert') )
{
	function myfunctionconvert(&$value,$key) 
	{
		$value= $key ."=". urlencode($value);
	}
}

if ( ! function_exists('convert') )
{
	function convert($array)
	{
		//  create_function('&$value, $key', '$value = $key ."=". $value;')
		if(is_array($array))
			 @array_walk($array,'myfunctionconvert');
		return $array;
	}
}

if ( ! function_exists('get_baseip'))
{
	function get_baseip()
	{
		if (isset($_SERVER))
		{
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			   $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
			   $realip = $_SERVER['HTTP_CLIENT_IP'];
			} else {
			   $realip = $_SERVER['REMOTE_ADDR'];
			}
		} else {
			if (getenv("HTTP_X_FORWARDED_FOR")) {
			   $realip = getenv( "HTTP_X_FORWARDED_FOR");
			} elseif (getenv("HTTP_CLIENT_IP")) {
			   $realip = getenv("HTTP_CLIENT_IP");
			} else {
			   $realip = getenv("REMOTE_ADDR");
			}
		}
		return preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $realip)?$realip:'0.0.0.0';
	}
}

if ( ! function_exists('get_logistics_type'))
{
	function get_logistics_type($logistics_type)
	{
		@include(APPPATH."/cache/logccom_config.php");
		return isset($json[$logistics_type])?$json[$logistics_type]:'';
	}
}

if ( ! function_exists('get_erp_img_url'))
{
	function get_erp_img_url($id)
	{
		if(file_exists(APPPATH.'/../web/pt_image/'.$id.".jpg"))
			return config_item('base_url').'/pt_image/'.$id.".jpg";
		else
			return config_item('base_url').'/pt_image/default.png';
	}
}

if ( ! function_exists('get_table_xls'))
{
	function get_explode_xls($xls_title,$xls_value,$name='')
	{
		if(count($xls_value)>100)
		{
			echo '导出内容不能大于1000条数';
			die;
		}
		header ( "Content-type:application/vnd.ms-excel" );
		header ( "Content-Disposition:filename=".$name.".xls" );
		$str="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html xmlns='http://www.w3.org/1999/xhtml'>
			<head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
			<title></title></head>";
			$str.="<body><table border='1'><tr><td>".implode('</td><td>',$xls_title)."</td></tr>";
			foreach($xls_value as $v)
			{
				$str.="<tr><td>".implode('</td><td>',$v)."</td></tr>";
			}
			$str.="</table></body></html>";
		echo $str;
		die;
	}
}

if ( ! function_exists('copy_url_image'))
{
	function copy_url_image($imgUrl,$id)
	{
		$imgUrl = htmlspecialchars($imgUrl);
		$imgUrl = str_replace("&amp;", "&", $imgUrl);
		//http开头验证
		if (strpos($imgUrl, "http") !== 0) {
			return false;
		}
		preg_match('/(^http*:\/\/[^:\/]+)/', $imgUrl, $matches);
		$host_with_protocol = count($matches) > 1 ? $matches[1] : '';
		
		// 判断是否是合法 url
		if (!filter_var($host_with_protocol, FILTER_VALIDATE_URL)) {
			return false;
		}
		preg_match('/^http*:\/\/(.+)/', $host_with_protocol, $matches);
		$host_without_protocol = count($matches) > 1 ? $matches[1] : '';
		// 此时提取出来的可能是 ip 也有可能是域名，先获取 ip
		$ip = gethostbyname($host_without_protocol);
		// 判断是否是私有 ip
		if(!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
			return false;
		}
		//获取请求头并检测死链
		$heads = get_headers($imgUrl, 1);
		if (!(stristr($heads[0], "200") && stristr($heads[0], "OK"))) {
		   return false;
		}
		//格式验证(扩展名验证和Content-Type验证)
		$fileType = strtolower(strrchr($imgUrl, '.'));
		if (!in_array($fileType, array(".png", ".jpg", ".jpeg", ".gif", ".bmp")) || !isset($heads['Content-Type']) || !stristr($heads['Content-Type'], "image")) {
			return false;
		}
		//打开输出缓冲区并获取远程图片
		ob_start();
		$context = stream_context_create(
			array('http' => array(
				'follow_location' => false // don't follow redirects
			))
		);
		readfile($imgUrl, false, $context);
		$img = ob_get_contents();
		ob_end_clean();
		file_put_contents(APPPATH.'/../web/pt_image/'.$id.".jpg", $img);
		
		if(file_exists(APPPATH.'/../web/pt_image/'.$id.".jpg"))
		{
			//图片的等比缩放
			//因为PHP只能对资源进行操作，所以要对需要进行缩放的图片进行拷贝，创建为新的资源
			$src=imagecreatefromjpeg(config_item('base_url').'/pt_image/'.$id.".jpg");
			
			//取得源图片的宽度和高度
			$size_src=getimagesize(config_item('base_url').'/pt_image/'.$id.".jpg");
			$w=$size_src['0'];
			$h=$size_src['1'];
			
			//指定缩放出来的最大的宽度（也有可能是高度）
			$max=100;
			//根据最大值为300，算出另一个边的长度，得到缩放后的图片宽度和高度
			if($w > $h){
			    $w=$max;
				$h=$h*($max/$size_src['0']);
			}else{
				$h=$max;
				$w=$w*($max/$size_src['1']);
			}
			
			//声明一个$w宽，$h高的真彩图片资源
			$image=imagecreatetruecolor($w, $h);
			//关键函数，参数（目标资源，源，目标资源的开始坐标x,y, 源资源的开始坐标x,y,目标资源的宽高w,h,源资源的宽高w,h）
			imagecopyresampled($image, $src, 0, 0, 0, 0, $w, $h, $size_src['0'], $size_src['1']);
			//imagepng($image);
			imagejpeg($image,APPPATH.'/../web/pt_image/'.$id."_min.jpg",100);
			//销毁资源
			imagedestroy($image);
		}
		
	 return true;
	}

}

if ( ! function_exists('get_xlsdata'))
{
//xls上传	
	function get_xlsdata($filename,$f=0)
	{
		global $config;
		if(!class_exists('Spreadsheet_Excel_Reader'))
			require APPPATH.'/libraries/xls/reader.php';	
			
		$data = new Spreadsheet_Excel_Reader ();
		$data->setOutputEncoding('gbk');
		$data->read($filename);
		$d=$data->sheets [$f];
		for($i = 1; $i <=  $d['numRows']; $i ++) {
			for($j = 1; $j <= $d['numCols']; $j ++) {
				if(isset($d['cells'] [$i] [$j]))
				{
					$str=iconv("gbk","UTF-8//IGNORE",$d['cells'] [$i] [$j]);
					$d['cells'] [$i] [$j]=is_numeric($str)?$str:mysql_escape_string($str);
				}
			}
		}
		return $d['cells'];
	}
}

if ( ! function_exists('base_isCnNewID'))
{
	//证件判断
	function base_isCnNewID($cid)
	{  
		$arrExp = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);//加权因子  
		$arrValid = array(1, 0,'x', 9, 8, 7, 6, 5, 4, 3, 2,1, 0,'x', 9, 8, 7, 6, 5, 4, 3, 2);//校验码  
		$sum = 0;  
		for($j=0;$j<17;$j++)
		{
			$sum += ($cid[$j]+10) * $arrExp[$j];  
		}
		//$cid
		// 计算模（固定算法）  
		$idx = $sum % 11;  
		// 检验第18为是否与校验码相等
		$falg=($arrValid[$idx+1].''==(strtolower(substr($cid,17,1)).""))?true:false;  
		$City = array(11=>"北京",12=>"天津",13=>"河北",14=>"山西",15=>"内蒙古",21=>"辽宁",22=>"吉林",23=>"黑龙江",31=>"上海",32=>"江苏",33=>"浙江",34=>"安徽",35=>"福建",36=>"江西",37=>"山东",41=>"河南",42=>"湖北",43=>"湖南",44=>"广东",45=>"广西",46=>"海南",50=>"重庆",51=>"四川",52=>"贵州",53=>"云南",54=>"西藏",61=>"陕西",62=>"甘肃",63=>"青海",64=>"宁夏",65=>"新疆",71=>"台湾",81=>"香港",82=>"澳门",91=>"国外");
		
		return (!preg_match("/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}(\d|x|X)$/",$cid)
			   ||!array_key_exists(substr($cid,0,2),$City)||!$falg)?false:true;
	} 
}


if ( ! function_exists('get_ueditor_auth'))
{
	//获取上传图片权限
	function get_ueditor_auth($uid='',$mod='')
	{
		$tm=time();
		$str='?userid='.$uid.'&mod='.$mod.'&tm='.$tm.'&auth='.md5($uid."erp12123!@#".$mod.$tm."erp12123!@#");
		return $str;
	}	
}


if ( ! function_exists('get_ueditor_image_url'))
{
	//获取上传图片权限
	function get_ueditor_image_url($type=1)
	{
		$str=config_item('base_url').($type==1?'/lib/ueditor':'').'/upimage_one.php';
		return $str;
	}	
}

if ( ! function_exists('check_ueditor_auth'))
{
	//验证上传权限
	function check_ueditor_auth()
	{
		$userid=isset($_GET['userid'])?$_GET['userid']:'';
		$mod=isset($_GET['mod'])?$_GET['mod']:'';
		$tm=isset($_GET['tm'])?$_GET['tm']:'';
		$auth=isset($_GET['auth'])?$_GET['auth']:'';
		if(empty($userid)||empty($tm)||empty($mod)||empty($auth)||$_GET['auth']!=md5($userid."erp12123!@#".$mod.$tm."erp12123!@#"))
			return false;
		else
		{
			$uid=authcode(get_cookie('user_id',NULL,$mod.config_item('cookie_prefix_tag')));
			if($uid==$userid)
				return array('userid'=>$uid,'mod'=>$mod);
			else
				return false;
		}
	}	
}

if ( ! function_exists('f_get_status'))
{
	function f_get_status($v='',$tag='order_status')
	{
		require(APPPATH.'/config/base_config.php');
		$ar[3]='label-important';
		$ar[2]='label-success';
		$ar[1]='label-info';
		$ar[-1]='';
		$ar[-2]='label-danger';
		$ar[0]='label-inverse';
		return isset($config[$tag][$v])?('<span class="label '.$ar[$v].'">'.$config[$tag][$v].'</span>'):'';
	}	
}

if ( ! function_exists('f_explode'))
{
	function f_explode($str,$tag=',')
	{
		$ar=explode($tag,$str);
		return $ar;
	}	
}

if ( ! function_exists('get_hg_name'))
{
	function get_hg_name($type=1)
	{
		$ar=array(1=>'保税',2=>'直邮',3=>'一般贸易');
		return $ar[$type];
	}	
}


if ( ! function_exists('usrl_back_msg'))
{
	/**
	 * 错误返回页面
	 * @param	string	
	 * @return	string
	 */
	function usrl_back_msg($msg,$ar_url=array(),$smarty_class)
	{
		$smarty_class->assign('act_msg',$msg,0);
		$smarty_class->assign('act_url',$ar_url);
		$smarty_class->display_ini('msg_url.htm');
		die;
	}
}
if ( ! function_exists('get_product_image'))
{
	//获取主图
	function get_product_image($id='')
	{
		if(!empty($id))
		{
			if(file_exists(BASEPATH."/../web/".$id))
				return config_item('base_url')."/web/".$id;
			else
				return config_item('base_url')."/pt_image/default.png";
		}
		else
			return config_item('base_url')."/pt_image/default.png";
	}
}

if ( ! function_exists('get_post_sql'))
{
	/**
	 * 获取post 提交更新的字段内容
	 * @param	$check_data      array
	 * @param	$no_xss  		 array
	 * @param	$empty_continue  array
	 * @param	$tag             string
	 * @return	array
	 * @desc    如果某字段需要处理请提前处理
	 */
	function get_post_sql_data($check_data,$empty_continue=array(),$tag='ps_')
	{
	   if(empty($_POST)||empty($check_data)||!is_array($check_data))
	     	return array();	
	   $wsql=array();
	   foreach($_POST as $k=>$v)
	   {
		  $tag_len=strlen($tag);   
		  $name=substr($k,$tag_len,strlen($k)-$tag_len);
		  //如果是非法自动过滤
		  if(!in_array($name,$check_data)&&substr($k,0,$tag_len)==$tag)
			 continue;
			
		  //如果为空不更新	 
		  if(is_array($empty_continue)&&in_array($name,$empty_continue)&&empty($v))   	
			 continue;
			 
		  //组合
		  if(substr($k,0,$tag_len)==$tag)
		  {
			  $wsql[$name]=$v;
		  }
	   }
	   return $wsql;
	}
}


if ( ! function_exists('tab_m'))
{
	/**
	 * 获取订单号
	 * @param	string	''
	 * @return	string
	 */
	function tab_m($table)
	{
		
		return 'dfshop_'.$table;
	}
}

if ( ! function_exists('get_order'))
{
	/**
	 * 获取订单号
	 * @param	string	''
	 * @return	string
	 */
	function get_order($memcachelock,$uid,$type=1,$is_false=true)
	{
		//按当月天数的偶数排断
	    $filename=APPPATH.'cache/order/'.($type==1?'im':'new').'_'.(date('d')%2==0?1:0).'.order';
		$stim=microtime(true);
		if(date('H')==11)
		{
			//1天只运行一次
			$memcachelock->tm=60*70;
			if($memcachelock->lock('check_get_order_id'))
			{
				$filename1=APPPATH.'cache/order/'.($type==1?'im':'new').'_'.(date('d')%2!=0?1:0).'.order';
				$fp = fopen($filename1,"r");
				$oid=fread($fp,1024)*1+1;
			    fclose($fp);
				if($oid>6000000)
				{
					$fp=fopen($filename1,'w+');
					fwrite($fp,'1000000',strlen('1000000'));
					fclose($fp);
				}
			}
		}

		while(1)
		{
			if($memcachelock->lock('get_order_'.$type))
			{
				if(file_exists($filename))
				{
					$fp1=fopen($filename,'r');
					$order_id=trim(fread($fp1,1028))*1+1;
					fclose($fp1);	
					$fp=fopen($filename,'w+');
					if($order_id<6000000)
						  $order_id=6000000;
					// fclose($fp1);	 
				    fwrite($fp,$order_id,strlen($order_id));//将内容写入文件．
				    fclose($fp);
				    $memcachelock->unlock('get_order_'.$type);	
					$str='';
					$n=strlen($uid);
					while($n++<5)
					{
						$str.='0';
					}
				    return $uid.$str.date('Ymd').$order_id;
				}	
				else
				{
					$memcachelock->unlock('get_order_'.$type);	
					return 0;
				}
			}
			if($is_false==true&&microtime(true)-$stim>3)
				return -2;
		}
	}
}

if ( ! function_exists('get_admin_name'))
{
	/**
	 * 获取菜单名称
	 * @param	string	
	 * @return	string
	 */
	function get_admin_name()
	{
		
		return 1;
	}
}


if ( ! function_exists('smarty_session'))
{
	function smarty_session($index='')
	{
		return isset($_SESSION[$index])?$_SESSION[$index]:'';
	}
}

if ( ! function_exists('smarty_cookie'))
{
	function smarty_cookie($index='')
	{
		return get_decode_cookie($index);
	}
}

if ( ! function_exists('smarty_post'))
{
	function smarty_post($index='')
	{
		return isset($_POST[$index])?$_POST[$index]:'';
	}
}

if ( ! function_exists('smarty_get'))
{
	function smarty_get($index='')
	{
		return isset($_GET[$index])?$_GET[$index]:'';
	}
}

if ( ! function_exists('authcode'))
{
	function authcode($string, $operation = 'DECODE', $expiry = 0,$exkey='')
	{
		$operation=($operation==1||$operation=='DECODE')?'DECODE':'';
		$ckey_length = 4;
		$key = $exkey?md5($exkey):md5(md5(config_item('cookie_authkey').$_SERVER['HTTP_USER_AGENT']).config_item('baseurl').$_SERVER['SERVER_SIGNATURE']);
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	
		$cryptkey = $keya.md5($keya.$keyc);
		$key_length = strlen($cryptkey);
	
		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
		$string_length = strlen($string);
	
		$result = '';
		$box = range(0, 255);
	
		$rndkey = array();
		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}
	
		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
	
		for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
	
		if($operation == 'DECODE') {
			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			return $keyc.str_replace('=', '', base64_encode($result));
		}
	
	}
}

if ( ! function_exists('set_encode_cookie'))
{
	/**
	 * 加密cookie
	 * @return	string
	 */
	function set_encode_cookie($name, $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = FALSE, $httponly = FALSE)
	{
		if(!empty($value))
			$value=authcode($value,'ENCODE');
		set_cookie($name, $value , $expire , $domain , $path , $prefix , $secure, $httponly);
	}
}

if ( ! function_exists('get_decode_cookie'))
{
	/**
	 * 解密cookie
	 * @return	string   
	 */
	function get_decode_cookie($index = '',$m='')
	{
		$m=empty($m)?WEB_NAME:$m;
		$str=get_instance()->input->cookie($m.config_item('cookie_prefix_tag').$index,true);
		$str=authcode($str);
		if(empty($str)&&empty($m))			
			delete_cookie($index);
		return $str;
	}
}

if ( ! function_exists('dateformat'))
{
	function dateformat($time)
	{
		if(is_numeric($time))
			return date("Y-m-d H:i:s",$time);
		else
			return date("Y-m-d H:i:s",strtotime($time));
	}
}
if ( ! function_exists('get_url_content'))
{
	function get_url_content($url)
	{
		//if(function_exists('file_get_contents'))
		//{
		//$file_contents = file_get_contents($url);
		//echo $file_contents;die;
		//}
		//else
		//{

		$ch = curl_init();
		$timeout = 30;
		// curl_setopt($ch, CURLOPT_TIMEOUT,$timeout);
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$file_contents = curl_exec($ch);
		curl_close($ch);
		//}
		return $file_contents;
	}
}