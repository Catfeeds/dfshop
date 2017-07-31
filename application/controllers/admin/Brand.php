<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends MY_Controller {

    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty'); 
		$this->get_admin_name(); 
	}

	public function brand_list()
	{
		if($_GET['act']=='add')
		{
			$this->ci_smarty->assign('ueditor_auth',get_ueditor_auth($this->user_id,WEB_NAME),0);
			$this->ci_smarty->display_ini('brand_add.htm');
			die;
		}

		if($_GET['act']=='do_add')
		{
			$this->brand_add();
			return;
		}
		if($_GET['act']=='edit')
		{
			$this->load->model('Base_brand_model');
			$res=$this->Base_brand_model->get_row(array('id'=>$_GET['id']));
			$this->ci_smarty->assign('re',$res);
			$this->ci_smarty->display_ini('brand_add.htm');
			die;
		}

		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql='';
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('status','id');
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
				->select_one('a.*',tab_m('brand')." as a ")
				->num_rows();
		}

		$res=array();
		$de=$this->Base_page_model
			->where($wsql)
			->select_one('a.*',tab_m('brand')." as a ")
			->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
		$res['list']=$de;
		$res['page']=$this->ci_page->prompt();
		$this->ci_smarty->assign('re',$res,1,'page');
		$this->ci_smarty->display_ini('brand_list.htm');
	}


	/**
	 * 新增或编辑品牌
	 */
	private function brand_add()
	{
		$this->load->library('MY_form_validation');
		$this->form_validation->set_rules('name','品牌名','required');
		$this->form_validation->set_rules('pic','品牌Logo','required');
		$this->form_validation->set_rules('status','是否启用','required');
		if ($this->form_validation->run() == FALSE)
		{
			$msg = array(
				'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
				'type' => 1
			);
			echo json_encode($msg);
			die;
		}
		else
		{
			$brand_arr['name']=$this->input->post('name',true);
			$brand_arr['pic']=$this->input->post('pic',true);
			$brand_arr['status']=$this->input->post('status',true);
			//model
			$this->load->model('Base_brand_model');
			if(!empty($_POST['id']))
			{
				$brand_arr['uptime']=dateformat(time());
				$res=$this->Base_brand_model->update($brand_arr,array('id'=>$_POST['id']));
			}
			else
			{
				$brand_arr['addtime']=dateformat(time());
				$res=$this->Base_brand_model->insert($brand_arr);
			}
			if( $res )
			{
				$msg = array(
					'msg'  => '操作成功',
					'type' => 3,
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				$msg = array(
					'msg'  => '操作失败',
					'type' => 1
				);
				echo json_encode($msg);
				die;
			}

		}

	}
}

