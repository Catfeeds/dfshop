<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_page_model extends CI_Model
{
	var $page='';
	function where($where_ar='',$like_ar='',$in_arr=array())
	{
		$where_ar=trim($where_ar);
		if(strtolower(substr($where_ar,0,3))=='and')
			$where_ar=" 1=1 ".$where_ar;
			
		$like_ar=trim($like_ar);
		if(strtolower(substr($like_ar,0,3))=='and')
			$like_ar=" 1=1 ".$like_ar;	
		
		if(!empty($where_ar))
			$this->db->where($where_ar);
		if(!empty($like_ar))
			$this->db->like($like_ar);

		if(!empty($in_arr))
		{
			foreach($in_arr as $name=>$v)
				$this->db->where_in($name,$v);
		}
		
		return $this;		
	}
	
	function select_one($filds='*',$tab,$distinct=false)
	{
		 $this->db->distinct($distinct);
		 $this->page=$this->db->select($filds)->from($tab);
		 return  $this;
	}
	
	
	//->left('','a.id=b.a_id')->left('','a.id=b.a_id')
	function left_join($tab,$on,$bool=false)
	{
		if($bool==true)
			$this->page=$this->page->join($tab,$on,'left');
	    return  $this;				
	}

	function result_array($page_start,$page_end,$order_by='a.id asc')
	{
		$row=$this->page->limit($page_end,$page_start)->order_by($order_by)->get()->result_array();
		return $row;
	}
	
	//获取商品总数
	function num_rows()
	{
		$num=$this->page->get()->num_rows;
		return $num;
	}
}