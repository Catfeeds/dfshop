<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class base_ajax extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');

    }

    //查询单图文
    public function search_sucai()
    {
        //查询---------
        if(!empty($_GET))
        {   
            $type=$_GET['act'];
            $act=$_GET['act']=='single'?2:3;
            $sql="select  a.id,a.create_time,a.type,b.name,b.pic  from  ".tab_m('wx_pic_group')." as a left join ".tab_m('wx_pic')." as b on a.id=b.pic_group_id  where  a.type=".$act." order by a.id  desc";
            $query=$this->db->query($sql);
            $res=array();
            $res['list']=$query->result_array();
            $this->ci_smarty->assign('re',$res);
            $this->ci_smarty->assign('type',$type);
            $this->ci_smarty->assign('re',$res);
            $this->ci_smarty->display('wx_ajax_search_sucai.htm');
        }

       
    }

}