<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Warehouse extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty'); 
		$this->get_admin_name();
		
	}
	
	//仓库列表
	public function warehouse_list()
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
			$search_key_ar=array('status');
			//姓名模糊查询字段
			$search_key_ar_more=array('name');
			foreach($_GET as $k=>$v)
			{
				$skey=substr($k,7,strlen($k)-7);  
				if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
				{
					//非模糊查询
					if(in_array($skey,$search_key_ar))
						$wsql.=" and a.{$skey}='{$v}'";
					//模糊查询
					if(in_array($skey,$search_key_ar_more))
						$wsql.=" and a.{$skey} like '%{$v}%'";	
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
											->select_one('a.*',tab_m('warehouse')." as a ")
											->num_rows();
		}
		
		$res=array();
		$res['list']=$this->Base_page_model
					 ->where($wsql)
					 ->select_one('a.*',tab_m('warehouse')." as a ")
					 ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
		$res['page']=$this->ci_page->prompt();	
		$this->ci_smarty->assign('re',$res,1,'page');
		//查询结束
		//***************************
		$this->ci_smarty->display_ini('warehouse_list.htm');	
	}
	
	//添加或者修改仓库
	public function warehouse_add()
	{     
		$this->load->model('Warehouse_model'); 
			
		//判断是否有数据提交
		if (!empty($_POST)) 
		{		
		
			//表单验证
			$this->load->library('MY_form_validation');		
			$this->form_validation->set_rules('name', '仓库名称', 'required|max_length[50]'); 
			$msg='';
			$this->form_validation->set_rules('con', '详情内容', 'required|max_length[50]');


			//表单验证，通过进行赋值，不通过提示错误并返回
			if ($this->form_validation->run() == FALSE||!empty($msg))
			{
				$msg=array(
					'msg'=>validation_errors("<i class='icon-comment-alt'></i> ").$msg,
					'type'=>1
				);
				echo json_encode($msg);
				die;
			}
			else
			{
				//以数组类型添加或者修改数据库
				$warehouse_arr = array();
				$warehouse_arr['name']         = $this->input->post('name',true);
				$warehouse_arr['con']          = $this->input->post('con',true);
				

				//判断是否存在id，没有进行添加，有进行修改
				if (!empty($_POST['id'])) 
				{					
					$flag = $this->Warehouse_model->update($warehouse_arr,array('id'=>$_POST['id']));	
					if($flag>=1)
					{
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
							'msg'=>'添加失败',
							'type'=>1
						);
						echo json_encode($msg);
						die;
					}									
				}
				else
				{
					$flag = $this->Warehouse_model->insert($warehouse_arr);
					if($flag>=1)
					{
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
							'msg'=>'添加失败',
							'type'=>1
						);
						echo json_encode($msg);
						die;
					}
				}
				usrl_back_msg($str_msg,$url_ar,$this->ci_smarty);
			}		
		}

		//判断是否存在id，没有进行添加，有进行修改
		if (!empty($_GET['id'])) 
		{     		
     		$wa_res = $this->Warehouse_model->get_row(array('id'=>$_GET['id']));
		
     		$this->ci_smarty->assign('wa_res',$wa_res);
		}
		$this->ci_smarty->display_ini('warehouse_add.htm'); 
	}
	
}