<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_gg_model extends CI_Model
{
    public function insert($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('cat_gg'),$arr);
    }

    public function delete($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->delete(tab_m('cat_gg'),$where);
    }

    public function update($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('cat_gg'),$data,$where);
    }

    public function get_row($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('cat_gg'),'*',$where);
    }
	
	public function get_list($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_list(tab_m('cat_gg'),'*',$where);
    }

	public function update_con($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('cat_gg_con'),$data,$where);
    }
	
    public function insert_con($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('cat_gg_con'),$arr);
        
    }
	
	public function delete_con($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->delete(tab_m('cat_gg_con'),$arr);
        
    }

    public function get_con_result($where,$fields='*',$order_by=' id desc')
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_list(tab_m('cat_gg_con'),$fields,$where,$order_by);
    }

}
