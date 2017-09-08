<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_brand_model extends CI_Model
{
	public function insert($arr)
	{	
	    $CI = & get_instance();
		$CI->load->model('Base_update_model');
		return $CI->Base_update_model->insert(tab_m('brand'),$arr);
	}
	
	public function delete($where)
	{	
	    $CI = & get_instance();
		$CI->load->model('Base_update_model');
		return $CI->Base_update_model->delete(tab_m('brand'),$where);
	}
	
	public function update($data,$where)
	{	
	    $CI = & get_instance();
		$CI->load->model('Base_update_model');
		return $CI->Base_update_model->update(tab_m('brand'),$data,$where);
	}
	
	public function get_row($where)
	{	
	    $CI = & get_instance();
		$CI->load->model('Base_get_model');
		return $CI->Base_get_model->get_row(tab_m('brand'),'*',$where);
	}
	
	public function get_list($where,$filed='*',$id_in=array())
	{	
	    $CI = & get_instance();
		$CI->load->model('Base_get_model');
		if(!empty($id_in))
			$CI->Base_get_model->db_one->where_in('id',$id_in);
		return $CI->Base_get_model->get_list(tab_m('brand'),$filed,$where,' id desc ');
	}

}

