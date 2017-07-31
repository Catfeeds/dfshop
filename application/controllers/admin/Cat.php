<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Cat extends MY_Controller 
{
    public function __construct()
    {  
        parent::__construct();  
		$this->load->library('CI_Smarty');
		$this->get_admin_name();
	}
	
	//商品类型列表
	public function cat_list()
	{    
		//编辑规格
		if($_GET['act']=='product_gg')
		{
			$this->product_gg();
			return;
		}
		
		//绑定品牌
		if($_GET['act']=='product_brand')
		{
		    $this->product_brand();
			return;
		}
		
		//添加分类
		if($_POST['act']=='add_cat')
		{	
		   $this->load->model('Admin_Cat_model');  
		   $cat_arr['pid'] = $this->input->post('new_pid',true);
		   $cat_arr['cat'] = $this->input->post('new_cat',true);
		   if(!empty($cat_arr['cat']))
		   {
				//添加分类
			   $this->Admin_Cat_model->cat_add($cat_arr);
		   }
		   header("location:".site_url('cat/cat_list'));
		   die;
		}	//修改分类
			
		if($_POST['act']=='edit_cat')
		{
			 $this->load->model('Admin_Cat_model');  
			 foreach($_POST['id'] as $id)
			 {
				if(!empty($_POST['cat'][$id])) 
				{
					$cat_arr['cat']=$_POST['cat'][$id];
			 		$this->Admin_Cat_model->cat_updata($id,$cat_arr);
				}
			 }
			header("location:".site_url('cat/cat_list'));
		    die;
		}
		
		if(!empty($_GET['del_id']))
		{
			$this->db->query("delete   from  ".tab_m('cat')."  where id='".($_GET['del_id']*1)."' ");
		    $this->db->query("delete   from  ".tab_m('cat')."  where pid='".($_GET['del_id']*1)."' ");
			header("location:".site_url('cat/cat_list'));
		    die;
		}
		
		$this->load->model('Admin_Cat_model');       
		$res_cat=$this->Admin_Cat_model->cat_list();
		$this->ci_smarty->assign('res_cat',$this->Admin_Cat_model->cat_list());
		$this->ci_smarty->display_ini('cat_list.htm');
	}
	
	
	/**
	 * 商品规格
	 */
	public function  cat_gg_list()
	{
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql='';
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('catid','id');
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
				->select_one('a.*',tab_m('cat_gg')." as a ")
				->num_rows();
		}

		$res=array();
		$de=$this->Base_page_model
			->where($wsql)
			->select_one('a.*',tab_m('cat_gg')." as a ")
			->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
		//model
		$this->load->model('Base_gg_model');

		foreach ( $de as $k=>$v)
		{
			$de[$k]['gg_con']=$this->Base_gg_model->get_con_result(array('cat_gg_id'=>$v['id']));
		}


		$res['list']=$de;
		$res['page']=$this->ci_page->prompt();
		$this->ci_smarty->assign('re',$res,1,'page');

		$this->ci_smarty->display_ini('cat_gg_list.htm');
	}


	
	private function product_gg()
	{
		if(!empty($_POST['gg_name'])&&isset($_POST['gg_name']))
		{
			$this->load->model('Base_gg_model');
			$ar_v=array();
			//删除规格同时删除规格内容
			if(!empty($_POST['gg_delete_id']))
			{
				$gg_delete_ar=explode(',',$_POST['gg_delete_id']);
				foreach($gg_delete_ar as $id)
				{
					if(!empty($id))
					{
						$this->Base_gg_model->delete(array('id'=>$id));
						$this->Base_gg_model->delete_con(array('cat_gg_id'=>$id));
					}
				}
			}
  
			//删除规格内容
			if(!empty($_POST['gg_del_item_id']))
			{
				foreach($_POST['gg_del_item_id'] as $gg_delete_id)
				{
					if(!empty($gg_delete_id))
					{
						$gg_delete_ar=explode(',',$gg_delete_id);
						foreach($gg_delete_ar as $id)
						{
							if(!empty($id))
								$this->Base_gg_model->delete_con(array('id'=>$id));
						}
					}
				}
				
			}
			
			foreach($_POST['gg_name'] as $k=>$gg_name)
			{
				if($k!=0)
				{
					$ar_v[$k]['gg_name']=$gg_name;
					$ar_v[$k]['gg_id']=$_POST['gg_id'][$k];
					$gg_name_list=explode('|@|',$_POST['gg_name_list'][$k]);
					foreach($gg_name_list as $vv)
					{
						$ar_v[$k]['gg_name_list'][]=explode('|#|',$vv);
					}
				}
			}
			
			
			foreach($ar_v as $k=>$v)
			{
				$gg_id=$v['gg_id']*1;
				if($gg_id==0)
					$gg_id=$this->Base_gg_model->insert(array('catid'=>$_GET['cat_id'],'name'=>$v['gg_name']));
				else
					$this->Base_gg_model->update(array('name'=>$v['gg_name']),array('id'=>$gg_id));
				
				if(!empty($v['gg_name_list']))
				{
					foreach($v['gg_name_list'] as $vv)
					{
						if(!empty($vv[1]))
						{
							$id=$vv[0]*1;	
							$name=$vv[1];	
							if(!empty($id))
								$this->Base_gg_model->update_con(array('cat_gg_id'=>$gg_id,'name'=>$name),array('id'=>$id));
							else
								$this->Base_gg_model ->insert_con(array('cat_gg_id'=>$gg_id,'name'=>$name));
						}
					}
				}
			}
		}	
		$res=$this->db->query("select  name,id  from  ".tab_m('cat_gg')."  where  catid=".$_GET['cat_id']."  ")->result_array();
		foreach($res as $k=>$v)
		{
			$res[$k]['id']=$v['id'];
			$res[$k]['name']=$v['name'];
			$res[$k]['list']=$this->db->query("select  name,id  from  ".tab_m('cat_gg_con')."  where  cat_gg_id=".$v['id']."  ")->result_array();
		}
		
		$this->ci_smarty->assign('res',$res);	
		$this->ci_smarty->display_ini('cat_product_gg.htm');
	}
	
	private function product_brand()
	{
		$this->load->model('Base_cat_model');  
		if(!empty($_POST))
		{
			$ids=!empty($_POST['ids'])&&is_array($_POST['ids'])?implode(',',$_POST['ids']):'';
			$this->Base_cat_model->update(array('brand_ids'=>$ids),array('id'=>$_POST['cat_id']));
			$msg=array('type'=>3,'msg'=>'操作成功');
			echo json_encode($msg);
			die;
		}
		$this->load->model('Base_brand_model');  
		$res=$this->Base_brand_model->get_list(array(1=>1));			
		$this->ci_smarty->assign('res',$res);	
		$brand_ids=$this->Base_cat_model->get_row_field('brand_ids',array('id'=>$_GET['cat_id']));
		$this->ci_smarty->assign('brand_ids',explode(',',$brand_ids));
		$this->ci_smarty->display_ini('cat_product_brand.htm');
	}
}