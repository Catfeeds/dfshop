<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class User extends MY_Controller {

    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
		$this->get_admin_name();
	}
	//登录
	public function login()
	{
		if(!empty($_POST))
		{
			$this->load->library('session');
			
			//验证码
			if(!isset($_POST['code'])||isset($_SESSION["authrand"])&&strtolower($_SESSION["authrand"])!==trim(strtolower($_POST['code'])))
			{
				  $_SESSION["authrand"]='';
				  show_error('<p>验证码错误</p>  <p><a href="">返回</a> </p>', 403);
			}
			
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('username', '登录账户', 'required|min_length[4]'); 
			//callback_username_check function username_check
			$this->form_validation->set_rules('password', '登录密码', 'required|min_length[6]');
			if ($this->form_validation->run() == FALSE)
			{
				show_error(validation_errors().'<p>  <a href="">返回</a> </p>', 403);
				die;
			}	
			else
			{
				$username=$this->input->post('username',true);
				$password=$this->input->post('password',true);
			    //=========验证通过
				$this->load->model('Admin_User_model');
				$uid=$this->Admin_User_model->login($username,$password);
				if($uid>0)
				{
					//记录IP和时间
					$this->db->query("update   ".tab_m('admin')."   set  `logoip`='".get_baseip()."',`lastlogotime`='".date('Y-m-d H:i:s')."'   where    id='".$uid."'   ");
					header("location:".site_url("admin_index/index"));  
				}
			}	
		}

		$this->load->library('CI_Validationimg');
		$this->ci_smarty->assign('auth_img',$this->ci_validationimg->get_auth_img(70,30));

		//=========防止csrf攻击=============
		$this->security->get_csrf_token_name();
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		
		$this->ci_smarty->assign('csrf',$csrf);
		$seo=array('title'=>'管理员登录');
		$this->ci_smarty->assign('seo',$seo);
		$this->ci_smarty->display('login.htm');   
	}

	//退出
	public function logout()
	{
	    delete_cookie("username");
		delete_cookie("user_id");
		delete_cookie("user_group_id");
		delete_cookie("user_type");
		header("location:".site_url("user/login"));  
	}
	
	//管理员列表
	public function admin_list()
	{
		
		//***************************
		//         查询开始
		
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql='';
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('status','group_id');
			//姓名模糊查询字段
			$search_key_ar_more=array('name');
			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);  
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
						$wsql.=" and {$skey}='{$v}'";
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and {$skey} like '%{$v}%'";	
				}
			}
		}
		
		/*
		$this->load->model('Admin_User_model');
		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||isset($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$sql="select  *  from  ".tab_m('admin')."  where  1=1  ".$wsql;
		if(!$this->ci_page->__get('totalRows'))
		{
			$query=$this->db->query($sql);
			$this->ci_page->totalRows =$query->num_rows;
		}
		
		$sql.=" limit ".$this->ci_page->firstRow.",".$this->ci_page->listRows;
		$row=$this->db->query($sql)->result_array();
		*/
		
		
	     $search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$this->load->model('Base_page_model');
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows =$this->Base_page_model
			                                ->where($wsql)
											->select_one('a.*',tab_m('admin')." as a ")
											->num_rows();
		}
		
		$res=array();
		$de=$this->Base_page_model
				 ->where($wsql)
				 ->select_one('a.*',tab_m('admin')." as a ")
				 ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
				
		
		$res=array();
		foreach($row as $v)
		{
			if(!empty($v['group_id']))
			{
				$d=$this->Admin_User_model->get_group_one(array('group_name'),$v['group_id']);
				if(isset($d['group_name']))
					$v['group_name']=$d['group_name'];
			}
			else
				$v['group_name']='总管理员';
			
			$res['list'][]=$v;
		}
		$res['page']=$this->ci_page->prompt();
		$this->ci_smarty->assign('re',$res,1,'page');
		//查询结束
		//***************************
		//权限组
		$res=$this->Admin_User_model->get_group_list(array('group_name','group_id'));
		$this->ci_smarty->assign('group',$res);
		//***************************
		$this->ci_smarty->display_ini('admin_list.htm');   
	}
	
	//添加或者修改管理员
	public function admin_add()
	{
		$this->load->model('Admin_User_model');
		if($_POST)
		{ 
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('ps_name', '管理姓名', 'required|min_length[2]|max_length[10]'); 
			$this->form_validation->set_rules('ps_desc', '描述', 'max_length[50]'); 
			$_POST['lastlogotime']=date('Y-m-d H:i:s');
			$str_msg='';
			//可以通过的字段
			if(!isset($_POST['ps_id']))	
			{
				$this->form_validation->set_rules('ps_user', '登录账户', 'required|min_length[4]|max_length[10]'); 
				$this->form_validation->set_rules('ps_password', '登录密码', 'required|min_length[6]|max_length[20]'); 
				$url_ar=array(site_url("user/admin_add")=>'返回页面');
				$updata=array('user','name','password','group_id','desc','type','status');	
				$upnochange=array();
				$row=$this->Admin_User_model->get_user_one(array('group_id'),'',$_POST['ps_user']);
				if(!empty($row))
					$str_msg="<i class='icon-comment-alt'></i> 登陆账号已存在";
			} 
			else
			{
				if(!empty($_POST['ps_password']))
					$this->form_validation->set_rules('ps_password', '登录密码', 'required|min_length[6]|max_length[20]'); 
	
				$url_ar=array(site_url("user/admin_add")=>'返回页面');
				$updata=array('user','name','password','group_id','desc','type','status');	
				//为空不改变的字段
				$upnochange=array('password');
			}
			if($this->form_validation->run() == FALSE || !empty($str_msg))
			{
				$msg=array(
					'msg'=>validation_errors("<i class='icon-comment-alt'></i> ").$str_msg,
					'type'=>1
				);
				
				echo json_encode($msg);
				die;
				//usrl_back_msg(validation_errors("<i class='icon-comment-alt'></i> ").$str_msg,$url_ar,$this->ci_smarty);
			}
			
			$_POST['ps_password']=empty($_POST['ps_password'])?'':md5($_POST['ps_password']);
			//获取组合好的array	
			$data=get_post_sql_data($updata,$upnochange);	
			
			
			if(!isset($_POST['ps_id']))	
				$this->Admin_User_model->add_user($data);
			else
				$this->Admin_User_model->add_user($data,array('id'=>$_POST['ps_id']));

			if(isset($_POST['ps_id']))
			{		
				//关闭窗口刷新页面	
				//$this->ci_smarty->assign('close_msg',1);
				$msg=array(
					'msg'=>"操作成功",
					'type'=>3
				);
				echo json_encode($msg);
		  	    die;
			}
			else
			{
				$msg=array(
					'msg'=>"操作成功",
					'type'=>3
				);
				echo json_encode($msg);
		  	    die;
			}
		}
		else
		{
			//管理员组
			$res=$this->Admin_User_model->get_group_list(array('group_name','group_id'));
			$this->ci_smarty->assign('group',$res);
			
			//如果已编辑
			if(isset($_GET['id']))	
			{
				$row=$this->Admin_User_model->get_user(array('user','id','status','desc','name','group_id'),$_GET['id']);
				$this->ci_smarty->assign('de',$row);
			}
		}
		
		//=========防止csrf攻击=============
		$this->security->get_csrf_token_name();
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->ci_smarty->assign('csrf',$csrf);
		$this->ci_smarty->display_ini('admin_add.htm');   
	}
	
	//登陆的管理员修改自己的密码
	public function admin_pwd()
	{ 
		if($_POST)
		{
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('old_pwd','旧密码', 'required'); 
			$this->form_validation->set_rules('new_pwd','新密码', 'required|differs[old_pwd]|min_length[6]'); 
			$this->form_validation->set_rules('new_pwd1','确认密码', 'required|matches[new_pwd]'); 
			$pwd1=$this->input->post('old_pwd');
			$this->load->library('MY_form_validation');
			if($this->form_validation->run() == FALSE)
				$str_msg=validation_errors("<i class='icon-comment-alt'></i> ");
			else
			{
				$user_id=get_decode_cookie("user_id");
				$this->load->model('Admin_User_model');
				$row=$this->Admin_User_model->get_user_one(array('password'),$user_id);
				if(md5($pwd1)!=$row['password'])
					$str_msg="<i class='icon-comment-alt'></i> 旧密码错误";
				else
					$str_msg='';
			}	
			
			if(!empty($str_msg))
			{
				$url_ar=array(
							site_url("user/admin_pwd")=>'返回页面'
						   );
				usrl_back_msg($str_msg,$url_ar,$this->ci_smarty);
			}
			
			$new_pwd=$this->input->post('new_pwd');
			$flag=$this->Admin_User_model->add_user(array('password'=>md5($new_pwd)),array('id'=>$user_id));
			if($flag===true)
			{
				$str_msg="<i class='icon-comment-alt'></i> 修改成功";
				$url_ar=array(
							site_url("user/admin_pwd")=>'返回页面'
						   );
			}
			else
			{
				$str_msg="<i class='icon-comment-alt'></i> 修改失败系统异常";
				$url_ar=array(
							site_url("user/admin_pwd")=>'返回页面'
						   );
			}
			usrl_back_msg($str_msg,$url_ar,$this->ci_smarty);
		}
		$this->ci_smarty->assign('user',get_decode_cookie("username"));
		
		//=========防止csrf攻击=============
		$this->security->get_csrf_token_name();
		$csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->ci_smarty->assign('csrf',$csrf);
		$this->ci_smarty->display_ini('admin_pwd.htm');   
	}


	public  function  admin_log()
	{
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql='';
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('type');
			//姓名模糊查询字段
			$search_key_ar_more=array('name');
			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
						$wsql.=" and {$skey}='{$v}'";
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and {$skey} like '%{$v}%'";
				}
			}
		}

		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$this->load->model('Base_page_model');
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows =$this->Base_page_model
				->where($wsql)
				->select_one('a.*',tab_m('admin_log')." as a ")
				->num_rows();
		}

		$res=array();
		$de=$this->Base_page_model
			->where($wsql)
			->select_one('a.*',tab_m('admin_log')." as a ")
			->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
		$res['list']=$de;
		$res['page']=$this->ci_page->prompt();
		$this->ci_smarty->assign('re',$res,1,'page');

		$this->ci_smarty->display_ini('admin_log.htm');
	}
	
}
