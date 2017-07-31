<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends MY_Controller {

    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty');  
		$this->get_admin_name();
	}
	
	//权限组
	public function group_list()
	{
		$this->load->model('Admin_User_model');     
	    $de=$this->Admin_User_model->get_group_list(array('group_id','group_name','group_desc'));
	    $this->ci_smarty->assign('re',$de);  
	    $this->ci_smarty->display_ini('group_list.htm'); 
	}
	
	//添加/编辑权限组
	public function group_add()
	{
		$this->load->model('Admin_User_model');
		if(!empty($_POST))
		{
			$this->load->library('MY_form_validation');
			$this->form_validation->set_rules('name', '用户组名称', 'required|min_length[2]'); 
			$this->form_validation->set_rules('desc', '描述', 'required|max_length[100]');
			if ($this->form_validation->run() == FALSE)
			{
				$msg=array(
					'msg'=>validation_errors("<i class='icon-comment-alt'></i> "),
					'type'=>1
				);
				echo json_encode($msg);
				die;
			}	
			
			$data=array();
			$data['group_name']=$this->input->post('name');
			$data['group_desc']=$this->input->post('desc');
			$data['group_perms']=implode(',',$_POST['perms']);
			
			if(empty($_POST['id']))
			{
			    $flag=$this->Admin_User_model->add_group($data);
				if($flag==1)
				{
					$msg=array(
						'msg'=>'操作成功',
						'type'=>3
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					$msg=array(
						'msg'=>'操作失败',
						'type'=>1
					);
					echo json_encode($msg);
					die;
				}
			}
			else
			{
				$flag=$this->Admin_User_model->add_group($data,array('group_id'=>$_POST['id']));
				if($flag==1)
				{
					$msg=array(
						'msg'=>'操作成功',
						'type'=>3
					);
					echo json_encode($msg);
					die;
				}
				else
				{
					$msg=array(
						'msg'=>'操作失败',
						'type'=>1
					);
					echo json_encode($msg);
					die;
				}
			}
		}
		
		if(!empty($_GET['id']))
		{
			$de=$this->Admin_User_model->get_group_one(array('group_id','group_name','group_perms','group_desc'),$_GET['id']);
			$de['arr']=explode(',',$de['group_perms']);
			$this->ci_smarty->assign('de',$de);
		}
		
		require(APPPATH.'/config/menu_config_admin.php');
		foreach($config['menu_config'] as $k=>$v)
		{
			$config['menu_config'][$k]['num']=count($v[1]); 
		}
	    $this->ci_smarty->assign('menu',$config['menu_config']);	
		$this->ci_smarty->display_ini('group_add.htm');   
	}
	
}
