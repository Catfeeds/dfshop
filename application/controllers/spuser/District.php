<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->load_sp_menu();
        $this->load->model('Base_Address_model');
    }

    /**
     * 收货地址列表
     */
    public function district_list()
    {
        if(!empty($_GET))
        {
            if($_GET['act']=='edit')
            {
                $res=$this->Base_Address_model->get_row(array('id'=>$_GET['id']));
                $this->ci_smarty->assign('re',$res);
                $this->ci_smarty->assign('show_ajax',2);
                $this->ci_smarty->assign('seo_title','编辑收货地址');
                $this->ci_smarty->display_ini('district_add.htm');
                die;
            }

            if($_GET['act']=='delete')
            {//删除收货地址

                $this->delete_address();
                return;
            }
        }

        $res=$this->Base_Address_model->get_list(array('userid'=>$this->user_id));
        $this->ci_smarty->assign('re',$res);
        $this->ci_smarty->assign('show_ajax',2);
        $this->ci_smarty->assign('seo_title','收货地址');
        $this->ci_smarty->display_ini('district_list.htm');
    }

    /**
     * 添加收货地址
     */
    public function district_add()
    {
        if(!empty($_POST))
        {
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('name','收件人','required');
            $this->form_validation->set_rules('mobile','手机号','required');
            $this->form_validation->set_rules('zip','邮政编码','required');
            $this->form_validation->set_rules('t','省市县','required');
            $this->form_validation->set_rules('province','省','required');
            $this->form_validation->set_rules('city','市','required');
            $this->form_validation->set_rules('area','县区','required');
            $this->form_validation->set_rules('address','详细地址','required');
            if ($this->form_validation->run() == FALSE)
            {
                $msg = array(
                    'msg'  => validation_errors("<i class='icon-comment-alt'></i>"),
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }
            else
            {
                $district['name']=$this->input->post('name',true);
                $district['mobile']=$this->input->post('mobile',true);
                $district['provinceid']=$this->input->post('province',true);
                $district['cityid']=$this->input->post('city',true);
                $district['areaid']=$this->input->post('area',true);
                $district['area']=$this->input->post('t',true);
                $district['address']=$this->input->post('address',true);
                $district['zip']=$this->input->post('zip',true);
                $district['userid']=$this->user_id;
                $result=$this->Base_Address_model->check_addrtcode($district['area']);
                if(!is_array($result))
                {
                    $msg = array(
                        'msg'  => $result,
                        'type' => 1
                    );
                    echo json_encode($msg);
                    die;
                }
                if(isset($_POST['default']))
                {
                    $this->Base_Address_model->set_default_address($this->user_id);
                    $district['default']=$this->input->post('default',true);
                }
                else
                {
                    $district['default']=0;
                }
                $district['address']=$this->input->post('address',true);

                if(!empty($_POST['id']))
                {
                    $res=$this->Base_Address_model->update($district,array('id'=>$_POST['id']));
                }
                else
                {
                    $res=$this->Base_Address_model->insert($district);
                }

                if( $res )
                {
                    $msg = array(
                        'msg'  => '操作成功',
                        'type' => 3,
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


        }
        $this->ci_smarty->assign('show_ajax',2);
        $this->ci_smarty->assign('seo_title','新增收货地址');
        $this->ci_smarty->display_ini('district_add.htm');
    }




    /**
     * 设置为默认地址
     */
    private function setting_default_address()
    {
        $this->Base_Address_model->set_default_address($this->user_id);
        $res=$this->Base_Address_model->update(array('default'=>1),array('id'=>$_GET['id']));
        if( $res )
        {
            $msg = array(
                'msg'  => '操作成功',
                'type' => 3,
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

    /**
     * 删除收货地址
     */
    private  function delete_address()
    {
        //不能删除默认地址
        $district=$this->Base_Address_model->get_row(array('id'=>$_GET['id']));
        if($district['default']==1)
        {
            $address=$this->Base_Address_model->get_list(array('userid'=>$this->user_id));
            $num=count($address);
            if($num>1)
            {
                $msg = array(
                    'msg'  => '请先设置一个默认地址,再删除该地址',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }

        }
        $res=$this->Base_Address_model->delete(array('id'=>$_GET['id']));
        if( $res )
        {
            $msg = array(
                'msg'  => '操作成功',
                'type' => 3,
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
}