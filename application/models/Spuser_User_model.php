<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Spuser_User_model  extends CI_Model
{
    function is_login($time=60)
    {
        $uid=get_decode_cookie("user_id");
        if(!empty($uid))
        {
            set_encode_cookie("username",get_decode_cookie("username"),$time);
            set_encode_cookie("user_id",get_decode_cookie("user_id"),$time);
            return true;
        }
        return false;
    }

  



    public function get_row($fields,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('user'),$fields,$where);
    }

    public function insert($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('user'),$arr);
    }

    public function update($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('user'),$data,$where);
    }






}

