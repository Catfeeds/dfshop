<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Yh extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->get_admin_name();
    }


    public function yh_list()
    {
        //model
        $this->load->model('Base_cat_model');
        $this->load->model('Base_Product_model');


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
                ->select_one('a.*',tab_m('user_coupon')." as a ")
                ->num_rows();
        }

        $res=array();
        $de=$this->Base_page_model
            ->where($wsql)
            ->select_one('a.*',tab_m('user_coupon')." as a ")
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');

        foreach ($de as $k=>$v)
        {
            //$de[$k]['product_name']=$this->Base_Ad_model->get_row_field();
            //$de[$k]['group_name']=$this->Base_Ad_model->get_row_field('name',array('id'=>$v['ad_group_id']));
        }
        $res['list']=$de;
        $res['page']=$this->ci_page->prompt();
        $this->ci_smarty->assign('re',$res,1,'page');
        $this->ci_smarty->display_ini('yh_list.htm');
    }
    
    
    public function yh_add()
    {   
        //model
        $this->load->model('Base_Yh_model');
        if($_GET['act']=='add')
        {//添加优惠券页面显示
            $this->ci_smarty->assign('ueditor_auth',get_ueditor_auth($this->user_id,WEB_NAME),0);
            $this->ci_smarty->display_ini('yh_add.htm');
            die;
        }
        if($_GET['act']=='del')
        {//删除优惠券
            $this->del_yh();
            return;
        }
        if($_GET['act']=='do_add')
        {//添加优惠券操作
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('name','广告标题','required');
            $this->form_validation->set_rules('price','抵用金额','required');
            $this->form_validation->set_rules('product_id','商品ID','required');
            $this->form_validation->set_rules('num','优惠券数量','required');
            $this->form_validation->set_rules('cat_id','分类ID','required');
            $this->form_validation->set_rules('add_time','开始时间','required');
            $this->form_validation->set_rules('end_time','结束时间','required');
            $this->form_validation->set_rules('pic','主图','required');
            $this->form_validation->set_rules('con','备注','required');
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
                $yh=array();
                $yh['name']=$this->input->post('name',true);
                $yh['price']=$this->input->post('price',true);
                $yh['product_id']=$this->input->post('product_id',true);
                $yh['cat_id']=$this->input->post('cat_id',true);
                $yh['num']=$this->input->post('num',true);
                $yh['addtime']=$this->input->post('add_time',true);
                $yh['endtime']=$this->input->post('end_time',true);
                $yh['pic']=$this->input->post('pic',true);
                $yh['con']=$this->input->post('con',true);

                $res=$this->Base_Yh_model->insert($yh);

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
    }


    public function yh_user_list()
    {
        //model
        $this->load->model('Base_cat_model');
        $this->load->model('Base_Product_model');
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
                ->select_one('a.*',tab_m('user_coupon_use')." as a ")
                ->num_rows();
        }

        $res=array();
        $de=$this->Base_page_model
            ->where($wsql)
            ->select_one('a.*',tab_m('user_coupon_use')." as a ")
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');

        foreach ($de as $k=>$v)
        {
            //$de[$k]['product_name']=$this->Base_Ad_model->get_row_field();
            //$de[$k]['group_name']=$this->Base_Ad_model->get_row_field('name',array('id'=>$v['ad_group_id']));
        }
        $res['list']=$de;
        $res['page']=$this->ci_page->prompt();
        $this->ci_smarty->assign('re',$res,1,'page');
        $this->ci_smarty->display_ini('yh_user_list.htm');
    }




    public function jf_list()
    {
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
                ->select_one('a.*',tab_m('fen_shop')." as a ")
                ->num_rows();
        }

        $res=array();
        $de=$this->Base_page_model
            ->where($wsql)
            ->select_one('a.*',tab_m('fen_shop')." as a ")
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');

        foreach ($de as $k=>$v)
        {
            //$de[$k]['product_name']=$this->Base_Ad_model->get_row_field();
            //$de[$k]['group_name']=$this->Base_Ad_model->get_row_field('name',array('id'=>$v['ad_group_id']));
        }
        $res['list']=$de;
        $res['page']=$this->ci_page->prompt();
        $this->ci_smarty->assign('re',$res,1,'page');

        $this->ci_smarty->display_ini('jf_list.htm');
    }



    /**
     * 删除优惠券
     */
    private function del_yh()
    {
        //model
        $this->load->model('Base_Yh_model');
        $res=$this->Base_Yh_model->delete(array('id'=>$_GET['id']));
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