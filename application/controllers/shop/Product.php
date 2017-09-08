<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

    public function __construct(){  
        parent::__construct();  
		$this->load->library('CI_Smarty'); 
		$this->get_admin_name(); 
	}
	
	public function search()
	{
		if(empty($_GET['keyword']))
			return '';
		$this->load->model('Base_page_model');	
		
		//10条关键字	
		$key_list=$this->Base_page_model
					   ->where(" `name` like '%".mysql_escape_string($_GET['keyword'])."%'")
					   ->select_one('name,uptime,s_num,id',tab_m('keyword'))
					   ->result_array(0,10,' s_num desc,id desc ');
		$str='';
		
		foreach($key_list as $v)
		{
			//每次关键字1小时更新一次  //防止频繁导致崩溃
			$time=1;//strtotime($v['uptime']);
			if($time+60*60<time())
			{
				//$str.="".$v['keyword']."|";
				$num=$this->Base_page_model
						  ->where(" name like '%".mysql_escape_string($v['name'])."%'")
						  ->select_one('id',tab_m('product'))->num_rows();
				$this->db->where(array('id'=>$v['id']));
				//$this->db->update(tab_m('keyword'),array('uptime'=>date('Y-m-d H:i:s'),'s_num'=>$num));
				//Bsee_keyword_model->update(),array('id'=>$v['id']));	
				$str.="".$v['name']."@".$num."\n";  
			}	
			else
				$str.="".$v['name']."@".$v['s_num']."\n";   
		}
		
		//print_r($_GET);
		//搜索关键字
		//关键字不存在时
		if($str=='')
		{
			$str.="请提交后查看。。@0";
		}
		echo $str;
		return ;
	}
	
	public function get_brand()
	{
		if(!empty($_POST['code'])&&!empty($_POST['brand_id']))
		{
			$_POST['brand_id']*=1;
			$ip=get_baseip();
			$code=md5(date('Ymd').config_item('cookie_authkey').$ip);
			if($_POST['code']==$code)
			{
				$this->load->model('Base_cat_model');
				$brand=$this->Base_cat_model->get_row(array('id'=>$_POST['brand_id']),'brand_ids');
				$this->load->model('Base_get_model');
				$this->Base_get_model->db_one->where_in('id',explode(',',$brand['brand_ids']));
				$d=array();
				$d['list']=$this->Base_get_model->get_list(tab_m('brand'),'name,id',array(1=>1));
				$gg=$this->Base_get_model->get_list(tab_m('cat_gg'),'id,name',array('catid'=>$_POST['brand_id']));
				foreach($gg as $k=>$v)
				{
					$gg[$k]['gg_con']=$this->Base_get_model->get_list(tab_m('cat_gg_con'),'id,name',array('cat_gg_id '=>$v['id']));
				}
				$d['gg_list']=$gg;
				echo json_encode($d);
				return;
			}
		}
		echo "error";
		return;
	}
	
	public function lists()
	{
		$ip=get_baseip();
		$this->ci_smarty->assign('code',md5(date('Ymd').config_item('cookie_authkey').$ip));
		if(!empty($_GET['keyword']))
		{
			$this->load->model('Base_page_model');	
			$num=$this->Base_page_model->where(" name='".mysql_escape_string($_GET['keyword'])."'")
				 ->select_one('id',tab_m('keyword'))->num_rows();
			if($num==0)	 
				$this->db->insert(tab_m('keyword'),array('uptime'=>date('Y-m-d H:i:s'),'s_num'=>$num,'name'=>$_GET['keyword']));
		}
		
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql="  "; 
		
		$get_check_num=array(' a.price>= '=>'search_minPrice',' a.price<= '=>'search_maxPrice');
		$get_check_split_num=array('a.catid'=>'search_cat','a.brand_id'=>'search_brand','b.gg_con_id'=>'search_gg_id');
		
		
		foreach($get_check_num as $name=>$v)
		{
			if(!empty($_GET[$v]))
				$_GET[$v]*=1;
			else
				$_GET[$v]=0;
				
			if(!empty($_GET[$v]))	
				$wsql.="  and  {$name}".$_GET[$v]; 	
		}
		
		$wsql_in=array();
		foreach($get_check_split_num as $name=>$v)
		{
			if(!empty($_GET[$v]))
			{
				$dd=explode(',',$_GET[$v]);
				foreach($dd as $k=>$v)
				{
					$dd[$k]*=1;
				}	
				$_GET[$v]=@array_filter($dd);
				$_GET[$v]=@array_unique($_GET[$v]);
			}	
			else
				$_GET[$v]=0;
				
			if(!empty($_GET[$v]))	
				$wsql_in[$name]=$_GET[$v];
		}

		$distinct=!empty($_GET['search_gg_id'])?true:false;
			
		$search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
		//===================查询 end=========================
		$this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
		$this->load->model('Base_page_model');
		if(!$this->ci_page->__get('totalRows'))
		{
			$this->ci_page->totalRows =$this->Base_page_model
				->where($wsql,'',$wsql_in)
				->select_one(($distinct?'b.product_id,':'').'a.*',tab_m('product')." as a ",$distinct)
				->left_join(tab_m('cat_gg_product_search')." as b",'a.id=b.product_id',!empty($_GET['search_gg_id'])?true:false)
				->num_rows();
		}
		
		$res=array();
		
		$de=$this->Base_page_model
				->where($wsql,'',$wsql_in)
				->select_one(($distinct?'b.product_id,':'').'a.*',tab_m('product')." as a ",$distinct)
				->left_join(tab_m('cat_gg_product_search')." as b",'a.id=b.product_id',!empty($_GET['search_gg_id'])?true:false)
				->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
				
		$res['list']=$de;
		$res['page']=$this->ci_page->prompt();
		
		$this->load->model('Base_cat_model');
		$res['cat_list']=$this->Base_cat_model->get_result_list(array('1'=>1),'cat,pid,id',' id asc');
		$this->ci_smarty->assign('re',$res,1,'page');
		$this->ci_smarty->display_ini('product_list.htm');	
	}
	
	
	public function lists1()
	{
		if(!empty($_GET['keyword']))
		{
			$this->load->model('Base_page_model');	
			$num=$this->Base_page_model->where(" name='".mysql_escape_string($_GET['keyword'])."'")
				 ->select_one('id',tab_m('keyword'))->num_rows();
			if($num==0)	 
				$this->db->insert(tab_m('keyword'),array('uptime'=>date('Y-m-d H:i:s'),'s_num'=>$num,'name'=>$_GET['keyword']));
		}
		
		$this->load->library('CI_page');
		$this->ci_page->Page();
		$this->ci_page->url=site_url($this->class."/".$this->method);
		$wsql="  "; 
		if(isset($_GET))
		{
			//非模糊查询的字段
			$search_key_ar=array('warehoust_id');
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
				->select_one('a.*',tab_m('product')." as a ")
				->num_rows();
		}
		$res=array();
		$de=$this->Base_page_model
			->where($wsql)
			->select_one('a.*',tab_m('product')." as a ")
			->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');

		$res['list']=$de;
		$res['page']=$this->ci_page->prompt();
		$this->ci_smarty->assign('re',$res,1,'page');

		$this->ci_smarty->display_ini('product_list.htm');	
	}
	
	public function get_gg()
	{
		if(empty($_POST['gg_group_md5'])||empty($_POST['gg_group_id'])||empty($_POST['gg_ids']))
		{
			echo '{msg:"无效"}';
			exit;
		}
		$gg_group_md5=$_POST['gg_group_md5'];
		$gg_group_id=$_POST['gg_group_id'];
		$gg_ids=trim($_POST['gg_ids']);
		$gg_ids_ar=explode('|gg|',$gg_ids);
		if($gg_group_md5==md5($gg_group_id."check"))
		{
			$this->load->model('Base_Product_model');
			$gg_ids_md5=md5($gg_ids);
			$de=$this->Base_Product_model->get_gg_product('gg_con_title,product_id',array('select_md5'=>$gg_ids_md5));
			$dd=$this->Base_Product_model->get_row(array('id'=>$de['product_id']),'stock,price,market_price,pic,name');	
			$ar=array('msg'=>'1','gg'=>array());
			if(!empty($dd))
			{
				$ar['gg']=array_merge($de,$dd);
				echo json_encode($ar);
				exit;
			}
			else
			{
				echo '{msg:"无该产品"}';
				exit;
			}	
		}
	}
	
	public function detail()
	{
		
		if(!empty($_GET['id']))
		{
			$this->load->model('Base_Product_model');
			$res=$this->Base_Product_model->get_row(array('id'=>$_GET['id']));
			
			if(empty($res))
				header_404();
				
			$gg_con=$this->Base_Product_model->get_gg_product('con,gg_con_title,gg_con_title_gg,gg_con_ids,select_md5',array('product_id'=>$res['id']));
			$gg_con_title_gg=explode('|',$gg_con['gg_con_title_gg']);
			$gg_con['cons']=json_decode($gg_con['con'],true);
			$ar=explode("|gg|",$gg_con['gg_con_ids']);
			$gg_con['gg_group_id']=$ar[0];
			$gg_con['gg_group_id_md5']=md5($ar[0]."check");
			$selected_gg=explode("|",$ar[1]);
			
			$this->ci_smarty->assign('gg_con_title_gg',$gg_con_title_gg);	
			$this->ci_smarty->assign('selected_gg',$selected_gg);	
			$this->ci_smarty->assign('de',$res);	
			$this->ci_smarty->assign('gg_con',$gg_con);	
		}
		else
			header_404();
			
		$this->ci_smarty->assign('nav_header_hide',1);		
		$this->ci_smarty->display_ini('product_detail.htm');	
	}

	
}
	