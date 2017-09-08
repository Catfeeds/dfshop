<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_cat_model extends CI_Model
{
    public function insert($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('cat'),$arr);
    }

    public function delete($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->delete(tab_m('cat'),$where);
    }

    public function update($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('cat'),$data,$where);
    }

    public function get_row($where,$filed)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('cat'),$filed='*',$where);
    }
	
	public function get_row_field($field,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row_field(tab_m('cat'),$field,$where);
    }
	

    public function get_result_list($where,$field='*',$order_by=' id desc ')
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_list(tab_m('cat'),$field,$where,$order_by);
    }


   
	
	
	
}
