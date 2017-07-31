<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Logistics extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->get_admin_name();
        $this->load->model('Base_Logistics_model');
        $this->load->model('Base_District_model');
    }
    /**
     * 物流模板列表
     */

    public function temp_list()
    {
        if($_GET['act']=='add')
        {
            //查询广告组
            //查询仓库
    
            $this->load->model('Warehouse_model');
            $warehouse=$this->Warehouse_model->get_result(array(1=>1));
            $this->ci_smarty->assign('warehouse',$warehouse);
            $this->ci_smarty->display_ini('temp_add.htm');
            die;
        }
        if($_GET['act']=='edit')
        {   
            $temp_id=$_GET['id'];
            $res=$this->Base_Logistics_model->get_row(array('id'=>$temp_id));
            $this->load->model('Warehouse_model');
            $warehouse=$this->Warehouse_model->get_result(array(1=>1));
            $this->ci_smarty->assign('warehouse',$warehouse);
            $this->ci_smarty->assign('re',$res);
            $this->ci_smarty->display_ini('temp_add.htm');
            return;
        }
        if($_GET['act']=='do_add')
        {
            $this->add_temp();
            return;
        }
        
        $res=$this->Base_Logistics_model->get_row_list(array(1=>1));
        foreach ($res  as $k=>$v)
        {
           if($v['id'])
           {
               $res[$k]['temp_show']=$this->Base_Logistics_model->get_show_list(array('temp_id'=>$v['id']));
           }
        }
        $this->ci_smarty->assign('res',$res);
        $this->ci_smarty->display_ini('temp_list.htm');
    }



    /**
     * 添加运费模板
     */
    public function logistics_add()
    {
        if($_GET['act']=='new_add')
        {   //新增运费模板

            $temp['sp_userid']=$this->user_id;
            $temp['uptime']=dateformat(time());
            $res=$this->Base_Logistics_model->insert($temp);
            if( !$res )
            {

                $msg=array(
                    'msg'=>"操作失败",
                    'type'=>1
                );
                echo json_encode($msg);
                die;
            }
            else
            {
                $msg=array(
                    'msg'=>"操作成功",
                    'type'=>3
                );
                echo json_encode($msg);
                die;
            }
        }

        if($_GET['act']=='edit')
        {
            $res['district']=$this->Base_District_model->get_district('*',array('pid'=>0),'id desc');
            //查询已有的
            $de=$this->Base_Logistics_model->get_show_list(array('id'=>$_GET['id']));
            $cids=array_filter(explode(',',$de[0]['cityids']));
            $dis_arr=$this->Base_Logistics_model->get_con_row_list('define_cityid',array('temp_id'=>$de[0]['temp_id']));
            $de[0]['fee_type']=$this->Base_Logistics_model->get_row(array('id'=>$de[0]['temp_id']));
            $res['exists_district']=array();
            //排除选择的
            foreach ($dis_arr as $k=>$v)
            {
                if(!in_array($v['define_cityid'],$cids))
                {
                    $res['exists_district'][$k]=$v['define_cityid'];
                }
            }
            $res['logistics_com']=$this->Base_Logistics_model->logccom_list();
            $this->ci_smarty->assign('show_ajax',1);
            $this->ci_smarty->assign('re',$res);
            $this->ci_smarty->assign('de',$de[0]);
            $this->ci_smarty->assign('cids',$cids);

            $this->ci_smarty->display_ini('logistics_add.htm');
            return ;
        }

        if($_GET['act']=='add')
        {//新增运费内容页面显示
            $res['district']=$this->Base_District_model->get_district('*',array('pid'=>0),'id desc');
            $res['temp_id']=$_GET['temp_id'];
            $res['fee_type']=$this->Base_Logistics_model->get_row(array('id'=>$_GET['temp_id']));
            //model
            $dis_arr=$this->Base_Logistics_model->get_con_row_list('define_cityid',array('temp_id'=>$res['temp_id']));
            $res['exists_district']=array();
            foreach ($dis_arr as $k=>$v)
            {
                $res['exists_district'][$k]=$v['define_cityid'];
            }

            //物流企业
            $res['logistics_com']=$this->Base_Logistics_model->logccom_list();
            $this->ci_smarty->assign('show_ajax',1);
            $this->ci_smarty->assign('re',$res);
            $this->ci_smarty->display_ini('logistics_add.htm');
            return ;
        }

        if($_GET['act']=='do_add')
        {
            $this->add_logistics_con();
            return;
        }


        if($_GET['act']=='del_show_temp')
        {//删除运费内容

            $res=$this->del_logistics($_GET['id']);
            if( !$res )
            {

                $msg=array(
                    'msg'=>"操作失败",
                    'type'=>1
                );
                echo json_encode($msg);
                die;
            }
            else
            {
                $msg=array(
                    'msg'=>"操作成功",
                    'type'=>3
                );
                echo json_encode($msg);
                die;
            }
        }

        if($_GET['act']=='del_temp')
        {//删除运费内容
            $res=$this->del_logistics_temp($_GET['id']);
            if( !$res )
            {

                $msg=array(
                    'msg'=>"操作失败",
                    'type'=>1
                );
                echo json_encode($msg);
                die;
            }
            else
            {
                $msg=array(
                    'msg'=>"操作成功",
                    'type'=>3
                );
                echo json_encode($msg);
                die;
            }
        }

        if($_GET['act']=='del_batch')
        {//删除运费内容
            $res=array_filter(explode(',',$_GET['id']));
            foreach ($res as $k=>$v)
            {
                $result=$this->del_logistics_temp($v);
            }
            if( !$result )
            {

                $msg=array(
                    'msg'=>"操作失败",
                    'type'=>1
                );
                echo json_encode($msg);
                die;
            }
            else
            {
                $msg=array(
                    'msg'=>"操作成功",
                    'type'=>3
                );
                echo json_encode($msg);
                die;
            }
        }

    }


    /**
     * 物流公司列表
     */
    public function company_list()
    {    $this->load->model('Base_Logistics_model');
        if($_GET['act']=='add')
        {
            //查询广告组
          
            $this->ci_smarty->display_ini('company_add.htm');
            die;
        }

        if($_GET['act']=='do_add')
        {
            $this->company_add();
            return;
        }

        if($_GET['act']=='edit')
        {
            $res=$this->Base_Logistics_model->get_logccom(array('id'=>$_GET['id']));
            $this->ci_smarty->assign('re',$res);
            $this->ci_smarty->display_ini('company_add.htm');
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
                ->select_one('a.*',tab_m('logistics_company')." as a ")
                ->num_rows();
        }

        $res=array();
        $de=$this->Base_page_model
            ->where($wsql)
            ->select_one('a.*',tab_m('logistics_company')." as a ")
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');

        $res['list']=$de;
        $res['page']=$this->ci_page->prompt();
        $this->ci_smarty->assign('re',$res,1,'page');
        $this->ci_smarty->display_ini('company_list.htm');
    }

    /**
     * 添加/编辑物流公司操作
     */
    private function company_add()
    {
        $this->load->library('MY_form_validation');
        $this->form_validation->set_rules('company','物流公司','required');
        $this->form_validation->set_rules('type','物流公司编号','required');
       

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
            $msg['company']=$this->input->post('company',true);
            $msg['type']=$this->input->post('type',true);
         
            //model
            $this->load->model('Base_Logistics_model');
            if(!empty($_POST['id']))
            {

                $res=$this->Base_Logistics_model->update_company($msg,array('id'=>$_POST['id']));
            }
            else
            {
                $res=$this->Base_Logistics_model->insert_company($msg);
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
     * 添加运费模板
     */
    private  function add_temp()
    {
        $this->load->library('MY_form_validation');
        $this->form_validation->set_rules('title','模板名称','required');
        $this->form_validation->set_rules('warehouse_id','仓库号','required');
        if(empty($_POST['id']))
        {
            $this->form_validation->set_rules('type','是否包邮','required');
            $this->form_validation->set_rules('logc_type','计费方式','required');
        }

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
            $temp_arr=array();
            $temp_arr['title']=$this->input->post('title',true);
            $temp_arr['warehouse_id']=$this->input->post('warehouse_id',true);

            $temp_arr['uptime']=dateformat(time());
            if(!empty($_POST['id']))
            {

                $res=$this->Base_Logistics_model->update($temp_arr,array('id'=>$_POST['id']));
            }
            else
            {
                $temp_arr['type']=$this->input->post('type',true);
                $temp_arr['logc_type']=$this->input->post('logc_type',true);
                $res=$this->Base_Logistics_model->insert($temp_arr);
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
     * 添加运费内容
     */
    private function add_logistics_con()
    {
        $this->load->library('MY_form_validation');
        $this->form_validation->set_rules('company','首重','required');
        $this->form_validation->set_rules('default_num','首重','required');
        $this->form_validation->set_rules('default_price','首重费','required');
        $this->form_validation->set_rules('add_num','续重','required');
        $this->form_validation->set_rules('add_price','续重费','required');
        if(empty($_POST['district_id']))
        {
            $msg=array(
                'msg'=>"请选择地区",
                'type'=>1
            );
            echo json_encode($msg);
            die;
        }
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
            $temp_arr['company'] = $this->input->post('company', true);
            $temp_arr['default_num'] = $this->input->post('default_num', true);
            $temp_arr['default_price'] = $this->input->post('default_price', true);
            $temp_arr['add_num'] = $this->input->post('add_num', true);
            $temp_arr['add_price'] = $this->input->post('add_price', true);
            $city_names='';
            $cityids='';
            $temp_id=$this->input->post('temp_id', true);

            if(!empty($_POST['id']))
            {
                $this->del_logistics($_POST['id']);
                $where=array('temp_id'=>$temp_id,'id!='=>$_POST['id']);
            }
            else
                $where=array('temp_id'=>$temp_id);

            foreach ($_POST['district_id'] as $k=>$v)
            {
                $arr=explode('|',$v);
                $res=$this->Base_Logistics_model->check_exists($where,$arr[0]);
                if(!empty($res))
                {
                    $this->Base_Logistics_model->insert_con(array(
                        'temp_id'=>$temp_id,
                        'default_num'=> $temp_arr['default_num'],
                        'default_price'=> $temp_arr['default_price'],
                        'add_num'=>$temp_arr['add_num'],
                        'add_price'=> $temp_arr['add_price'],
                        'define_cityid'=>$arr[0],
                        'define_city_name'=>$arr[1]
                    ));
                    $city_names.=$arr[1].',';
                    $cityids.=$arr[0].',';
                }
            }

            $temp_arr['city_names']=$city_names;
            $temp_arr['cityids']=$cityids;
            $temp_arr['temp_id']=$temp_id;
            if($temp_arr['cityids']!='')
            {
                $res=$this->Base_Logistics_model->insert_show_con($temp_arr);
                if( $res )
                {
                    $msg=array(
                        'msg'=>"操作成功",
                        'type'=>3
                    );
                    echo json_encode($msg);
                    exit;
                }
                else
                {
                    $msg=array(
                        'msg'=>"操作失败",
                        'type'=>1
                    );
                    echo json_encode($msg);
                    exit;
                }
            }
            else
            {
                $msg=array(
                    'msg'=>"操作失败",
                    'type'=>2
                );
                echo json_encode($msg);
                exit;
            }
        }
    }



    /**
     * 删除指定运费内容
     */
    private function del_logistics($show_id)
    {
        $cids=$this->Base_Logistics_model->get_show_row_field('cityids',array('id'=>$show_id));
        $temp_id=$this->Base_Logistics_model->get_show_row_field('temp_id',array('id'=>$show_id));
        $cids_arr=array_filter(explode(',',$cids));
        foreach ($cids_arr as $k=>$v)
        {
            $this->Base_Logistics_model->delete_con(array('temp_id'=>$temp_id,'define_cityid'=>$v));
        }
        return $this->Base_Logistics_model->delete_show(array('id'=>$show_id));
    }



    /**
     * 删除指定运费模板
     */
    private function del_logistics_temp($temp_id)
    {
        $this->Base_Logistics_model->delete_con(array('temp_id'=>$temp_id));
        $this->Base_Logistics_model->delete_show(array('temp_id'=>$temp_id));
        return $this->Base_Logistics_model->delete(array('id'=>$temp_id));
    }
}