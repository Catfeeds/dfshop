<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_get_model extends CI_Model
{
	var $db_one='';
    public function __construct()
    {  
	    //切换数据库
		$this->db_one=$this->db;
	}
	
	function  get_list($tab,$fields='*',$where='',$order_by=' id desc')
	{
		if(empty($where))
			return array();
		$this->db_one->where($where);
		return $this->db_one->select($fields)
					->from($tab)
					->order_by($order_by)
					->get()
					->result_array();
	}
	
	function  get_row($tab,$fields='*',$where='',$order_by=' id desc')
	{
		if(empty($where))
			return array();
		$this->db_one->where($where);
		return $this->db_one->select($fields)
					->from($tab)
					->order_by($order_by)
					->get()
					->row_array();
	}
	
	function  get_row_field($tab,$field='',$where='')
	{
		if(empty($where))
			return '';
			
		$this->db_one->where($where);
		$row=$this->db_one->select($field)
					->from($tab)
					->get()
					->row_array();
		return !empty($row[$field])?$row[$field]:'';			
	}	
}