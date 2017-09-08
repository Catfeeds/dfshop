<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Logistics_model  extends CI_Model
{
    public function insert($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('logistics_temp'),$arr);
    }

    public function delete($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->delete(tab_m('logistics_temp'),$where);
    }

    public function update($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('logistics_temp'),$data,$where);
    }


    public function update_show($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('logistics_temp_con_show'),$data,$where);
    }

    /**
     * 更新运费内容
     * @param $data
     * @param $where
     * @return mixed
     */
    public function update_con($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('logistics_temp_con'),$data,$where);
    }

    public function get_row($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('logistics_temp'),'*',$where);
    }

    public function get_con_row($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('logistics_temp_con'),'*',$where);
    }

    public function get_row_list($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_list(tab_m('logistics_temp'),'*',$where);
    }

    public function get_show_list($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_list(tab_m('logistics_temp_con_show'),'*',$where);
    }

    public function get_show_row($field='*',$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('logistics_temp_con_show'),$field,$where);
    }

    public function get_show_row_field($field,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row_field(tab_m('logistics_temp_con_show'),$field,$where);
    }


    public function insert_show_con($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('logistics_temp_con_show'),$arr);
    }

    public function insert_con($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('logistics_temp_con'),$arr);
    }

    public function get_con_row_list($field,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_list(tab_m('logistics_temp_con'),$field,$where);
    }

    public function delete_con($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->delete(tab_m('logistics_temp_con'),$where);
    }

  

    public function delete_show($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->delete(tab_m('logistics_temp_con_show'),$where);
    }

    /**
     * 获取物流企业列表
     * @return mixed
     */
    public function logccom_list()
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_list(tab_m('logistics_company'),'*',array(1=>1));
    }

    /**
     * 添加物流企业
     * @param $arr
     * @return mixed
     */
    public function logccom_add($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('logistics_company'),$arr);
    }

    /**
     * 更新物流企业
     * @param $data
     * @param $where
     * @return mixed
     */
    public function logccom_updata($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('logistics_company'),$data,$where);
    }

    /**
     * 获取单条物流企业信息
     * @param $where
     * @return mixed
     */
    public function get_logccom($where)
    {

        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('logistics_company'),'*',$where);
    }

    /**
     * 运费模板显示列表
     */
    public function logistics_list()
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_list(tab_m('logistics_temp_con_show'),'*',array(1=>1));
    }

    /**
     * 判断是否存在
     */
    public function check_exists($where,$like)
    {
        $this->db->where($where);
        $this->db->like('cityids',$like);
        $res=$this->db
            ->select('*')
            ->from(tab_m('logistics_temp_con_show'))
            ->get()
            ->row_array();
        if(empty($res))
            return TRUE;
        else
            return FALSE;
    }

}