<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Warehouse_model extends CI_Model
{
	public function insert($arr)
	{	
	    $CI = & get_instance();
		$CI->load->model('Base_update_model');
		return $CI->Base_update_model->insert(tab_m('warehouse'),$arr);
	}
	
	public function delete($where)
	{	
	    $CI = & get_instance();
		$CI->load->model('Base_update_model');
		return $CI->Base_update_model->delete(tab_m('warehouse'),$where);
	}
	
	public function update($data,$where)
	{	
	    $CI = & get_instance();
		$CI->load->model('Base_update_model');
		return $CI->Base_update_model->update(tab_m('warehouse'),$data,$where);
	}
	
	public function get_row($where)
	{	
	    $CI = & get_instance();
		$CI->load->model('Base_get_model');
		return $CI->Base_get_model->get_row(tab_m('warehouse'),'*',$where);
	}

	public function get_result($where)
	{
		$CI = & get_instance();
		$CI->load->model('Base_get_model');
		return $CI->Base_get_model->get_list(tab_m('warehouse'),'*',$where);
	}
	
	public function get_row_field($field,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row_field(tab_m('warehouse'),$field,$where);
    }
}

