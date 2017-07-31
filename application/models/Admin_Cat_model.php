<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Cat_model extends CI_Model
{
	//通过id查询产品类型
	function cat_list()
	{
		return $this->db->select('id,pid,cat')
					->from(tab_m('cat'))
					->order_by('id','asc')
					->get()
					->result_array();
	}

	//添加产品类型
	function cat_add($cat_arr)
	{	
	    if ($cat_arr['pid']!=0)
		{
			$d=$this->db->query("select id  from  ".tab_m('cat')."  where  id like '".substr($cat_arr['pid'],0,2)."__00'   
			                     order  by  id   desc  limit 1 ")->row_array();
			if(!empty($d['id']))					 
				$cat_arr['id']=$d['id']+100;
			else
				$cat_arr['id']=substr($cat_arr['pid'],0,2).'0100';		 
		}
		else
		{
			$d=$this->db->query("select id from ".tab_m('cat')."
			                    where pid=0  order  by  id desc limit 1 ")->row_array();
			if(!empty($d['id']))					 
				$cat_arr['id']=$d['id']+10000;
			else
				$cat_arr['id']=110000;							
		}
		
		
		$flag = $this->db->insert(tab_m('cat'),$cat_arr);		
		if ($flag == 1) 
			return true;
		else
			return false;		
	}

	//通过id查询产品类型
	function get_cat($id)
	{
		return $this->db->select('id,cat,pid')
					->where('id',$id)
					->from(tab_m('stock_cat'))
					->get()
					->row_array();
	}

	function cat_updata($id,$cat_arr)
	{
		$flag = $this->db->where('id',$id)->update(tab_m('cat'), $cat_arr);
		if ($flag == 1) 
			return true;
		else
			return false;
	}
	
	
	
	
}