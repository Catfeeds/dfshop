<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_update_model extends CI_Model
{
	var $db_one='';
    public function __construct()
    {  
	    //切换数据库
		$this->db_one=$this->db;
	}
	
	//返回影响行数 更新成功大于等于1
	function  update($tab,$data,$where_ar)
	{
		if(!is_array($data)||empty($data))
			return false;
		if(!is_array($where_ar)||empty($where_ar))
			return false;	
			
		$this->db_one->where($where_ar);
		$this->db_one->update($tab,$data);
		return $this->db_one->affected_rows();
	}
	
	//返回插入ID
	function  insert($tab,$arr)
	{
		$this->db_one->insert($tab,$arr);		
		return $this->db_one->insert_id();
	}	
	
	//返回bool
	function  delete($tab,$where)
	{
		$falg=$this->db_one->delete($tab,$where);
		return $falg?true:false;
	}	
	
	function  get_list($tab,$fields='*',$where='',$order_by=' id desc')
	{
		if(empty($where))
			return array();
		if($where[0]!=1&&empty($where[1]))
			$this->db_one->where($where);
			
		return $this->db_one->select($fields)
					->from($tab)
					->order_by($order_by)
					->get()
					->result_array();
	}
	
	
	function query($sql)
	{
		$this->db_one->query($sql);			
	}	
	
	
	//特殊业务必须用到主表  如用户金额修改,前查询
	function get_row($tab,$where,$fileds='*')
	{
		$row = $this->db_one->select($fileds)
						->from($tab)
						->where($where)
						->get()
						->row_array();
		return !empty($row)?$row:array();				
	}	
	
	//回收站
	function tab_gc($tab_from,$tab,$where_ar)
	{
		if(!is_array($where_ar)||empty($where_ar))
			return false;
    	$row = $this->db_one->select('*')
						->from($tab_from)
						->where($where_ar)
						->get()
						->row_array();
		if(!empty($row))
		{
		    $flag = $this->db_one->insert($tab,$row);
		    if ($flag == 1) 
		    	return $this->db_one->delete($tab_from, $where_ar);
		    else
		    	return false;
		}
		else
			return false;
	}	
}
