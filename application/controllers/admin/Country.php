<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Country extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');   
		$this->get_admin_name();
		
		//<{$select_admin_name}>
		//<{$falg_name}>
	}
	
	//产地管理列表
	public function country_list()
	{         
        $this->load->model('Admin_Country_model'); 
		//搜索字段
		$search_array = array();
		if (isset($_GET)) 
		{
			//模糊查询字段
			$search_key_ar_more = array('c_name');
			foreach($_GET as $k => $v)
			{
				$skey = substr($k,7,strlen($k)-7);  
				if($k != 'search_page_num' && substr($k,0,7) == 'search_' && !in_array($v,array('all','')))
				{
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
					{
						$search_array["$skey"] = $v;
					}	
				}
			}
		}
		//分页列表
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);  
        $search_page_num = array('all'=>15,1=>15,2=>30,3=>50);
        $this->ci_page->listRows = !isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
       	$this->ci_smarty->assign('res_country',$this->Admin_Country_model->country_list($this->ci_page->listRows,$this->ci_page->firstRow,$search_array));
       	//分页页码
       	if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows = $this->Admin_Country_model->country_totalRows($search_array);
		}
		$res['page'] = $this->ci_page->prompt();
		$this->ci_smarty->assign('re',$res,1,'page');
		//显示页面
		$this->ci_smarty->display_ini('country_list.htm');
	}

	//产地状态修改
	public function update_country_display()
	{
		$this->load->model('Admin_Country_model');
		if ($_POST) 
		{
			$country_arr = array();
			foreach ($_POST as $key => $value) 
			{
				if($value != $_GET['type'])
				{
					$country_arr[$key] = array('id' => $key,'c_display' => ($_GET['type']*1?1:0));
				}
			}
			//判断提交数据是否改变
			if(!empty($country_arr))
			{
				$flag = $this->Admin_Country_model->update_country_display($country_arr);
			}
			else
			{
				$msg=array(
						'msg'=>'操作成功',
						'type'=>3
				);
				echo json_encode($msg);
				die;
			}
			if($flag)
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
}