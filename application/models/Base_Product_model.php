<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Product_model extends CI_Model
{
    public function insert($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('product'),$arr);
    }

    public function delete($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->delete(tab_m('product'),$where);
    }

    public function update($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('product'),$data,$where);
    }

    public function get_row($where,$fields='*')
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('product'),$fields,$where);
    }
	
    public function get_product_con_row($where,$fields='*')
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('product_detail'),$fields,$where);
    }

    public function insert_product_con($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('product_detail'),$arr);
    }

	public function get_gg_proup_id()
    {
		$arr=array('add_time'=>date('Y-m-d H:i:s'));
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('cat_gg_product_group'),$arr);
    }

    public function update_product_con($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('product_detail'),$data,$where);
    }
	

	public function get_gg_product($fields='*',$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('cat_gg_product'),$fields,$where);
    }

	//指定产品规格修改
	public function update_gg_product($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('cat_gg_product'),$data,$where);
    }
	
	//插入指定产品规格
	public function insert_gg_product($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('cat_gg_product'),$arr);
    }
	
	//插入指定产品规格
	public function delete_gg_product($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->delete(tab_m('cat_gg_product'),$arr);
    }
}

