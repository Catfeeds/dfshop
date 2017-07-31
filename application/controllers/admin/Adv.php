<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Adv extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->get_admin_name();
    }

    public function web_ad_list()
    {
        $this->load->model('Base_Ad_model');
        if($_GET['act']=='add')
        {
            //查询广告组
            $res=$this->Base_Ad_model->get_ad_group_list(array(1=>1));
            $this->ci_smarty->assign('ueditor_auth',get_ueditor_auth($this->user_id,WEB_NAME),0);
            $this->ci_smarty->assign('re',$res);
            $this->ci_smarty->display_ini('web_ad_add.htm');
            die;
        }
        if($_GET['act']=='process_ad_group')
        {

            $res=$this->Base_Ad_model->get_ad_group_list(array(1=>1));
            $this->ci_smarty->assign('re',$res);

            $this->ci_smarty->display_ini('web_ad_group.htm');
            die;
        }

        if($_GET['act']=='do_edit_ad_group')
        {
            $this->do_edit_add_group();
            return;

        }
        if($_GET['act']=='do_add_ad_group')
        {

            $this->do_add_ad_group();
            return;
        }

        if($_GET['act']=='do_add')
        {
            $this->web_ad_add();
            return;
        }
        if($_GET['act']=='delete')
        {
            $this->del_ad_gg();
            return;
        }
        if($_GET['act']=='edit')
        {
            $res=$this->Base_Ad_model->get_row(array('id'=>$_GET['id']));
            $this->ci_smarty->assign('re',$res);
            $this->ci_smarty->display_ini('web_ad_add.htm');
            die;

        }
        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url=site_url($this->class."/".$this->method);
        $wsql='';
        if(isset($_GET))
        {
            //非模糊查询的字段
            $search_key_ar=array();
            //姓名模糊查询字段
            $search_key_ar_more=array('name');
            foreach($_GET as $k=>$v)
            {
                $skey=substr($k,7,strlen($k)-7);
                if($k!='search_page_num'&&substr($k,0,7)=='search_'&&!in_array($v,array('all','')))
                {
                    //非模糊查询
                    if(in_array($skey,$search_key_ar))
                        $wsql.=" and {$skey}='{$v}'";
                    //模糊查询
                    if(in_array($skey,$search_key_ar_more))
                        $wsql.=" and {$skey} like '%{$v}%'";
                }
            }
        }


        $search_page_num=array('all'=>15,1=>15,2=>30,3=>50);
        //===================查询 end=========================
        $this->ci_page->listRows=!isset($_GET['search_page_num'])||empty($search_page_num[$_GET['search_page_num']])?15:$search_page_num[$_GET['search_page_num']];
        $this->load->model('Base_page_model');
        if(!$this->ci_page->__get('totalRows'))
        {
            $this->ci_page->totalRows =$this->Base_page_model
                ->where($wsql)
                ->select_one('a.*',tab_m('web_ad')." as a ")
                ->num_rows();
        }

        $res=array();
        $de=$this->Base_page_model
            ->where($wsql)
            ->select_one('a.*',tab_m('web_ad')." as a ")
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');

        foreach ($de as $k=>$v)
        {
            $de[$k]['group_name']=$this->Base_Ad_model->get_row_field('name',array('id'=>$v['ad_group_id']));
        }
		
        $res['list']=$de;
        $res['page']=$this->ci_page->prompt();
        $this->ci_smarty->assign('re',$res,1,'page');
        $this->ci_smarty->display_ini('web_ad_list.htm');
    }


    /**
     * 添加公告操作
     */
    private function web_ad_add()
    {
        $this->load->library('MY_form_validation');
        $this->form_validation->set_rules('name','广告标题','required');
        $this->form_validation->set_rules('url','广告链接','required');
        $this->form_validation->set_rules('width','广告宽度','required');
        $this->form_validation->set_rules('height','广告高度','required');
        $this->form_validation->set_rules('add_time','开始时间','required');
        $this->form_validation->set_rules('end_time','结束时间','required');
        $this->form_validation->set_rules('pic','主图','required');
        $this->form_validation->set_rules('ad_group_id','广告组id','required');
        $this->form_validation->set_rules('status','是否开启','required');

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
            $msg=array();
            $msg['add_time']=$this->input->post('add_time',true);
            $msg['end_time']=$this->input->post('end_time',true);
            $msg['width']=$this->input->post('width',true);
            $msg['height']=$this->input->post('height',true);
            $msg['adm_userid']=$this->user_id;
            $msg['name']=$this->input->post('name',true);
            $msg['url']=$this->input->post('url',true);
            $msg['pic']=$this->input->post('pic',true);
            $msg['ad_group_id']=$this->input->post('ad_group_id',true);
            $msg['status']=$this->input->post('status',true);
            //model
            $this->load->model('Base_Ad_model');
            if(!empty($_POST['id']))
            {

                $res=$this->Base_Ad_model->update($msg,array('id'=>$_POST['id']));
            }
            else
            {
                $res=$this->Base_Ad_model->insert($msg);
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

    /**
     * 删除公告
     */
    private function del_ad_gg()
    {
        //model
        $this->load->model('Base_Ad_model');
        $res=$this->Base_Ad_model->delete(array('id'=>$_GET['id']));
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
     * 添加广告组
     */
    private  function do_add_ad_group()
    {
        $this->load->library('MY_form_validation');
        $this->form_validation->set_rules('name','广告组名称','required');
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
            //model
            $this->load->model('Base_Ad_model');
            $ad_group=array();
            $ad_group['name']=$this->input->post('name',true);
            $ad_group['adm_userid']=$this->user_id;
            $ad_group['add_time']=dateformat(time());
            $res=$this->Base_Ad_model->insert_ad_group($ad_group);
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

    /**
     * 编辑广告组
     */

    private  function do_edit_add_group()
    {
        $item=array_filter($_POST['name']);
        foreach ($item as $k=>$v)
        {
            $res= $this->Base_Ad_model->update_ad_group(array('name'=>$v,'uptime'=>dateformat(time())),array('id'=>$k));
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