<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_WxRule_model extends CI_Model
{

    /**
     * 插入数据  素材组表
     * @param $arr
     * @return mixed
     */
    public function insert($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('wx_msg_auto'),$arr);
    }



    public function delete($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->delete(tab_m('wx_msg_auto'),$where);
    }

    public function update($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('wx_msg_auto'),$data,$where);
    }

    public function get_row($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('wx_msg_auto'),'*',$where);
    }

    public function get_list($where,$filed='*')
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_list(tab_m('brand'),$filed,$where);
    }



}

