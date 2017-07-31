<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spuser_index extends MY_Controller {
	
	public function __construct(){  
        parent::__construct();
		$this->load->library('CI_Smarty'); 
		$this->get_admin_name(); 
	}
	

	public function info()
	{
		$de=$this->Spuser_User_model->get_row('*',array('id'=>$this->user_id));
		$this->ci_smarty->assign('user',$de);
		$this->ci_smarty->display_ini('info.htm');
	}

    /*核销提交*/
	public function iframe()
	{
		$this->ci_smarty->assign('width',$_GET['width']);		
		$this->ci_smarty->assign('height',$_GET['height']);	
		$this->ci_smarty->assign('title',$_GET['title']);	
		unset($_GET['width'],$_GET['height'],$_GET['title']);
		$this->ci_smarty->assign('url',site_url($_GET['mothed'])."/?".url_convert($_GET));	
		$this->ci_smarty->display('admin_iframe.htm');
	}
	
	//错误提示页面
	public function admin_msg()
	{
		if(isset($_GET['ss']))
			$this->ci_smarty->assign("ss",$_GET['ss']*1000);
		$this->ci_smarty->display('admin_msg.htm');   
	}

}

