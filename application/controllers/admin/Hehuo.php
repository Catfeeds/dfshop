<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hehuo extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->get_admin_name();
    }

    /**
     * 合伙人概况
     */
    public function hehuo_info()
    {
        $this->ci_smarty->display_ini('hehuo_info.htm');
    }


    /**
     * 合伙人列表
     */
    public function hehuo_list()
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
                ->select_one('a.*',tab_m('user')." as a ")
                ->num_rows();
        }

        $res=array();
        $de=$this->Base_page_model
            ->where($wsql)
            ->select_one('a.*',tab_m('user')." as a ")
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');

       
        $res['list']=$de;
        $res['page']=$this->ci_page->prompt();
        $this->ci_smarty->assign('re',$res,1,'page');
        $this->ci_smarty->display_ini('hehuo_list.htm');
    }


    /**
     * 合伙人等级
     */
    public function hehuo_level()
    {
        $this->ci_smarty->display_ini('hehuo_level.htm');
    }

    /**
     * 销售排行
     */
    public function hehuo_seller()
    {
        $this->ci_smarty->display_ini('hehuo_seller.htm');
    }
    
    /**
     * 佣金明细
     */
    public function hehuo_commission_list()
    {
        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url=site_url($this->class."/".$this->method);
        $wsql='';
        if(isset($_GET))
        {
            //非模糊查询的字段
            $search_key_ar=array('order_id');
            //姓名模糊查询字段
            $search_key_ar_more=array();
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
                ->select_one('a.*,b.shop_name,b.name',tab_m('user_commission')." as a ")
                ->left_join(tab_m('user')." as b ",'a.userid = b.id')
                ->num_rows();
        }

        $res=array();
        $de=$this->Base_page_model
            ->where($wsql)
            ->select_one('a.*,b.shop_name,b.name',tab_m('user_commission')." as a ")
            ->left_join(tab_m('user')." as b ",'a.userid = b.id')
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.order_id desc ');
        $res['list']=$de;
        $res['page']=$this->ci_page->prompt();


        $this->ci_smarty->assign('re',$res,1,'page');
        $this->ci_smarty->display_ini('hehuo_commission_list.htm');
    }

    /**
     * 提现申请
     */
    public function hehuo_commission_supply()
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
            $search_key_ar_more=array();
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
                ->select_one('a.*,b.name,b.shop_name,b.mobile',tab_m('user_cash_order')." as a ")
                ->left_join(tab_m('user')." as b ",'a.userid = b.id')
                ->num_rows();
        }

        $res=array();
        $de=$this->Base_page_model
            ->where($wsql)
            ->select_one('a.*,b.name,b.shop_name,b.mobile',tab_m('user_cash_order')." as a ")
            ->left_join(tab_m('user')." as b ",'a.userid = b.id')
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
        $res['list']=$de;
        $res['page']=$this->ci_page->prompt();


        $this->ci_smarty->assign('re',$res,1,'page');
        $this->ci_smarty->display_ini('hehuo_commission_supply.htm');
    }

    /**
     * 提现记录
     */
    public function hehuo_commission_cash()
    {
        $this->ci_smarty->display_ini('hehuo_commission_cash.htm');
    }

    /**
     * 设置提现
     */
    public  function hehuo_commission_setting()
    {
        if(!empty($_POST['config']))
        {


            $account_wx=empty($_POST['config']['account_wx'])? 0 :$_POST['config']['account_wx'] ;
            $account_xx=empty($_POST['config']['account_xx'])? 0 :$_POST['config']['account_xx'] ;
            $account_hb=empty($_POST['config']['account_hb'])? 0 :$_POST['config']['account_hb'] ;
            $is_batch=$_POST['config']['is_batch'];
            $name_check_type=$_POST['config']['name_check_type'];
            $min_money=$_POST['config']['min_money'];
            $str="<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
            $str.=" \$config['account_wx']='$account_wx'; \n";
            $str.=" \$config['account_xx']='$account_xx'; \n";
            $str.=" \$config['account_hb']='$account_hb'; \n";
            $str.=" \$config['is_batch']='$is_batch';\n";
            $str.=" \$config['name_check_type']='$name_check_type';\n";
            $str.=" \$config['min_money']='$min_money';\n";
            create_file(APPPATH."/cache/hehuo_commission_setting.php",$str);
        }

        if(file_exists(APPPATH."/cache/hehuo_commission_setting.php"))
        {
            require(APPPATH."/cache/hehuo_commission_setting.php");
            $this->ci_smarty->assign('wx',$config,0);
        }
        $this->ci_smarty->display_ini('hehuo_commission_setting.htm');
    }

}