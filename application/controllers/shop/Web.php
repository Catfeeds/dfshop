<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MY_Controller {

    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty'); 
		$this->get_admin_name(); 
	}
	
	//每页显示 4条  获取下一页的权限
	private function get_next_page($page_num)
	{
		$page['page_num']=$page_num+1;
		$page['auth']=md5(($page_num+1).config_item('cookie_authkey'));
		return $page;
	}
	
	//每页显示 4条  获取下一页的权限
	private function check_page_auth($page_num,$auth)
	{
		if($auth==md5(($page_num).config_item('cookie_authkey')))
			return true;
		else
			return false;
	}
	
	public function index()
	{
		if(!empty($_POST['a'])&&$_POST['a']==1)
		{
			//第一页不判断权限 第二页开始判断权限
			$num=!empty($_POST['page_num'])?$_POST['page_num']*1:0;
			if($num>4)
			{
				echo '1';
				exit;
			}
			
			echo '<li>
			  <div class="cou-left"> <a tag="countdown" href="http://m.kjt.com/product/106894" style="background-image: url(http://image.kjt.com/neg/P200/f155eb95-76ae-44ef-8584-eaaf6e2fea44.jpg);"> </a> </div>
			  <div class="cou-right">
				<div class="timer-out"> 还剩
				  <div class="timer" data-role="countdown" ms="1030744000"> <i data-name="hour">286</i>:<i data-name="minute">16</i>:<i data-name="second">32</i> </div>
				</div>
				<div class="tt"><a href="http://m.kjt.com/product/106894">【洋范儿】丽得姿 美蒂优氨基酸提拉面膜10片…</a></div>
				<div class="price"> <em>¥<i>10.00</i> </em> <del>¥79.00</del> </div>
				<a class="cou-btn cou-btn2" href="http://m.kjt.com/product/106894">开抢中</a> </div>
			</li>';
			exit;
		}
		$this->ci_smarty->display_ini('web_index.htm');	
	}

}


		
		