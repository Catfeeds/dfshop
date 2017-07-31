<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District extends MY_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->get_admin_name();
    }


    /**
     *
     */
    public function district_list()
    {

        //model
        $this->load->model('Base_District_model');
        if($_POST['act']=='add')
        {
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('name','地区名称','required');
            if ($this->form_validation->run() == FALSE)
            {
                $msg = array(
                    'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }else
            {

                $where1=" pid = ".$_POST['pid'];
                $res1=$this->Base_District_model->get_row($where1);
                if(empty($res1))
                {
                    $id=$_POST['pid']+1;
                }
                else
                {
                    if(substr($res1['id'],4)=='00')
                    {
                        $id=(substr($res1['id'],0,4)+1).'00';
                    }
                    elseif(substr($res1['id'],4)*1>0)
                    {
                        $id=$res1['id']+1;
                    }
                }
                $dis_arr=array();
            }

            $dis_arr['id']=$id;
            $dis_arr['name']=$this->input->post('name');
            $dis_arr['pid']=$this->input->post('pid');
            $flag=$this->Base_District_model->insert($dis_arr);
            if( $flag )
            {
                $msg = array(
                    'msg'  => '操作成功',
                    'type' => 3,
                    'id'=>$dis_arr['pid']
                );
                echo json_encode($msg);
                die;
            }
            else
            {
                $msg = array(
                    'msg'  => '操作失败',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }

        }

        if($_GET['act']=='sort')
        {
            $item=$_GET['item'];
            $item=array_filter(explode(',',$item));
            foreach ( $item as $k=>$v)
            {
                $it=array_filter(explode('|',$v));
                $res=$this->Base_District_model->update(array('sorting'=>$it[1]),array('id'=>$it[0]));

            }
            if( $res )
            {
                $msg = array(
                    'msg'  => '操作成功',
                    'type' => 3,
                    'id'=>$_GET['pid']
                );
                echo json_encode($msg);
                die;
            }
            else
            {
                $msg = array(
                    'msg'  => '操作失败',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }
        }

        if($_GET['act']=='find_child')
        {
            $res['list']=$this->Base_District_model->get_district('*',array('pid'=>$_GET['pid']),' sorting ,id ASC ');
            $res['pid']=$_GET['pid'];
        }
        else
        {
            $res['list']=$this->Base_District_model->get_district('*',array('pid'=>0),' sorting ,id ASC');
            $res['pid']=0;
        }

        foreach ($res['list'] as $k=>$v)
        {
            $res['list'][$k]['child_num']=count($this->Base_District_model->get_district("*",array('pid'=>$v['id']),'id ASC'));
        }
        $this->ci_smarty->assign('re',$res);
        $this->ci_smarty->display_ini('district_list.htm');
    }

}