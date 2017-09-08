<?php
class MY_Controller extends CI_Controller{  
    public function __construct(){  
        parent::__construct();
		ob_clean();
		global $class,$method;  
		$this->class=$class;
		$this->method=$method;
		$this->db = $this->load->database('default', TRUE);
		
		//$this->db_def = $this->load->database('def', TRUE);
		
		header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");	
		 
		//$this->benchmark->mark('my_mark_start');
		//http://codeigniter.org.cn/user_guide/database/utilities.html
	
		$this->load->helper("cookie");  
		$this->load->helper("basefunction"); 
		$this->load->helper("url"); 
		
		if(!in_array(WEB_NAME,array('img','api','ueditor','shop')))
		{
			$this->load->model("Base_User_model");//user_model模型类实例化对象
			$this->cur_user=$this->Base_User_model->is_login(60*120);//50分钟无任何操作退出
			
			if(WEB_NAME=='spuser' && strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false)
			{

				if(empty($_GET['wx_login'])&&$this->cur_user===false)
					$this->wx_login();

			}

			//检测是否登陆，如果登陆，返回登陆用户信息，否则返回false
			if(empty($this->cur_user) && $this->class!='Cart' && $this->method!='login' && $this->method!='reg' && $this->method!='fw_passwd'){
				
				header("location:".site_url("user/login").(!empty($_GET['ref_url'])?("?ref_url=".urlencode($_GET['ref_url'])):''));  
				die;
			}
			else
			{
				if($this->cur_user)
				{
					if(WEB_NAME=='spuser'&&($this->method=='login' || $this->method=='reg')) 
					{
						if(!empty($_GET['login']))
						{
							echo 1;
							die;
						}
						header("location:".site_url(WEB_NAME."_index/info"."?login=1"));
						die;
					}	
					
					$this->user_id=get_decode_cookie("user_id");
					$this->user=get_decode_cookie("username");;

					if(WEB_NAME=='admin')
					{	
						$this->user_group_id=$this->get_group_id();
						$this->user_type=get_decode_cookie("user_type");
						//------选定---------
						if($this->user_type==1)
						{
							//if($this->check_admin()===false)
								//die("无权限");
						}
					}
				}
				else
				{
					$this->user='';
					$this->user_id='';
					if(WEB_NAME=='admin')
					{
						$this->user_group_id='';
						$this->user_type='';
					}
				}
			}
		}
    }
	
	//$re_bind_id不为 为微信绑定已等账号 
	public function wx_login($re_bind_id=0)
	{
		$this->load->library('CI_wx');
		//检测是否登陆，如果登陆，返回登陆用户信息，否则返回false
		if(empty($_GET['code']))
		{
			if(!empty($re_bind_id))
				$redirect_uri=urlencode(site_url()."?wx_bind_id=".$re_bind_id);
			else
				$redirect_uri=site_url();
				
			$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".trim($this->ci_wx->appid)."&redirect_uri="
				 .$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
			header("location:".$url);
			return;
		}
		else
		{
			$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".trim($this->ci_wx->appid)."&secret="
				 .trim($this->ci_wx->appsecret)."&code=".$_GET['code']."&grant_type=authorization_code";
				 
			$res=get_url_content($url);
			$user_wx=json_decode($res,true);
			$openid=$user_wx['openid'];
			//查询该用户是否已经注册
			$this->load->model('Spuser_User_model');
			$de=$this->Spuser_User_model->get_row('*',array('wx_id'=>$openid));
			if(empty($de))
			{
				//没有注册，则需要注册
				$user_arr['wx_id']=$openid;
				//获取用户信息
				$user_info=$this->ci_wx->get_user_info($openid);
				$user_arr['name']=$user_info['nickname'];
				//$user_arr['sex']=$res['sex'];
				
				$user_arr['pic']=$user_info['headimgurl'];
				$user_arr['user']='zjx_wx';
				$user_arr['pass']=0;
				$user_arr['addtime']=dateformat(time());
				$uid=$this->Spuser_User_model->insert($user_arr);
				$this->Spuser_User_model->update(array('user'=>'zjx_'.$uid),array('id'=>$uid));
				set_encode_cookie("user_id",$uid,30);
				set_encode_cookie("username",urldecode($user_arr['user']),30);
				header("location:".site_url(WEB_NAME."_index/info")."?wx_login=1");
				return;
			}
			else
			{
				if($de['user']=='zjx_wx')
					$this->Spuser_User_model->update(array('user'=>'zjx_'.$de['id']),array('id'=>$de['id']));
				set_encode_cookie("user_id",$de['id'],30);
				set_encode_cookie("username",$de['name'],30);
				header("location:".site_url(WEB_NAME."_index/info"."?wx_login=1"));
				return;
			}
		}
	}
	
	
	public function get_admin_name()
	{
		require(APPPATH.'/config/menu_config_admin.php');
        // <li><a href="#">权限管理</a> <span class="icon-angle-right"></span></li>
        // <li><a href="#">修改密码</a></li>';
		$falg_name='';
		$str=array();
		$select_index_id='';
		
		foreach($config['menu_config'] as $k=>$v)
		{
			$str[1]='<li><i class="icon-home"></i><a>'.$v[0].'</a> <span class="icon-angle-right"></span></li>';
			foreach($v[1] as  $kk=>$v2)
			{
				$str[2]='<li><a>'.$v2[0].'</a> <span class="icon-angle-right"></span></li>';
				foreach($v2[1] as  $kkk=>$v3)
				{
					$ar=explode(',',$v3);
					if(strtolower($ar[0]).""==strtolower($this->method)."" &&strtolower($ar[2]).""==strtolower($this->class)."")	
					{
						$select_index_id=$k.$kk.$kkk;
						$falg_name=$str[3]=$ar[3];
						break;
					}		
				}
				if(empty($str[3]))
					unset($str[2]);	
				else
					break;	
			}
			if(!empty($str[3]))
				break;
		}

	    $this->ci_smarty->assign('select_index_id',$select_index_id);	
		$this->ci_smarty->assign('select_admin_name',implode('',$str),0);	
		$this->ci_smarty->assign('falg_name',$falg_name);	
		$this->ci_smarty->assign('select_class',strtolower($this->class));	
	}
	
	//加载供应商菜单
	public function load_sp_menu()
	{
		//-------------------选中标志-----------------------
		$this->ci_smarty->assign('select_class',strtolower($this->class));	
		$this->ci_smarty->assign('select_method',strtolower($this->method));
		//===================菜单==========================
		require(APPPATH.'/config/menu_config_'.WEB_NAME.'.php');
		$seo_tltie=config_item('company').'|';
		foreach($nva_menu as $k=>$v)
		{
			if(strtolower($v['action'])==strtolower($this->class.'/'.$this->method))
			{
				$seo_tltie.=$v['name'];
			}
			
			foreach($v['actions'] as $kk=>$vv)
			{
				//echo $kk."--".strtolower($this->class.'/'.$this->method)."<br>";
				if(strtolower($kk)==strtolower($this->class.'/'.$this->method))
				{
					$seo_tltie.=$v['name']."|".$vv;
				}
			}
		}

		//用户账户
		$this->ci_smarty->assign('admin',$this->user);	
		$this->ci_smarty->assign('seo_tltie',$seo_tltie);	
		//$this->ci_smarty->assign('nva_menu',$nva_menu);	
	}
	
	//检测后台菜单权限
	private function check_admin()
	{
		$this->load->model('Admin_User_model');
		$row=$this->Admin_User_model->get_group_one(array('group_perms'),$this->user_group_id);
		$str=md5(strtolower($this->class.'/'.$this->method));
		if(in_array($str,explode(',',$row['group_perms'])))
			return true;
		else
			return false;
	}
	
	//检测后台菜单权限
	private function  get_group_id()
	{
		$this->load->model('Admin_User_model');
		$row=$this->Admin_User_model->get_user(array('group_id'),$this->user_id);
		return $row['group_id'];
	}
}
?>   