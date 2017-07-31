<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
class Wx extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->get_admin_name();
        $this->load->model('Base_Sucai_model');
        $this->load->model('Base_WxRule_model');
    }

    /**
     * 公众号绑定
     */
    public function config()
    {
        if($_GET['act']=='config_appid')
        {

            if (!empty($_POST['config']))
            {
                $appid=$_POST['config']['appid'];
                $appsecret=$_POST['config']['appsecret'];
                $str="<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
                $str.=" \$config['appid']='$appid'; \n";
                $str.=" \$config['appsecret']='$appsecret';\n";
                create_file(APPPATH."/cache/wx_config.php",$str);
            }
            if(file_exists(APPPATH.'/cache/wx_config.php'))
                require(APPPATH.'/cache/wx_config.php');
            $this->ci_smarty->assign('wx',$config,0);

            $this->ci_smarty->display_ini('wx_setting.htm');
            return;

        }
        if(file_exists(APPPATH.'/cache/wx_config.php'))
            require(APPPATH.'/cache/wx_config.php');
        //判断是否有有配置数组
        if(!isset($config['appid']))
            $res['wx']=0;
        else
            $res['wx']=1;
        $this->ci_smarty->assign('re',$res);
        $this->ci_smarty->display_ini('wx_config.htm');
    }

    /**
     * 一键关注
     */
    public function  guanzhu()
    {

        if(!empty($_POST['config']))
        {
                $is_open=$_POST['config']['is_open'];
                $address=$_POST['config']['address'];
                $str="<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
                $str.=" \$config['is_open']=' $is_open'; \n";
                $str.=" \$config['address']=' $address';\n";
                create_file(APPPATH."/cache/wx_guanzhu.php",$str);
        }

        if(file_exists(APPPATH."/cache/wx_guanzhu.php"))
        {
            require(APPPATH."/cache/wx_guanzhu.php");
            $this->ci_smarty->assign('wx',$config,0);
        }
        $this->ci_smarty->display_ini('wx_guanzhu.htm');
    }

    /**
     * 一键登录
     */
    public function login()
    {
        if(!empty($_POST['config']))
        {
                $quick_login=$_POST['config']['quick_login'];
                $auth_login=$_POST['config']['auth_login'];
                $str="<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
                $str.=" \$config['quick_login']='$quick_login'; \n";
                $str.=" \$config['auth_login']='$auth_login';\n";
                create_file(APPPATH."/cache/wx_login.php",$str);
        }

        if(file_exists(APPPATH."/cache/wx_login.php"))
        {
            require(APPPATH."/cache/wx_login.php");
            $this->ci_smarty->assign('wx',$config,0);
        }
        $this->ci_smarty->display_ini('wx_login.htm');
    }

    /**
     * 自动回复
     *
     */
    public function auto_back_msg()
    {
        if(!empty($_GET['act']))
        {
            if($_GET['act']=='del')
            {
                $this->del_auto_back_msg();
                return;
            }
        }
        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url=site_url($this->class."/".$this->method);
        $wsql='';
        if(isset($_GET))
        {
            //非模糊查询的字段
            $search_key_ar=array('status','id');
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
                ->select_one('a.*',tab_m('wx_msg_auto')." as a ")
                ->num_rows();
        }

        $res=array();
        $de=$this->Base_page_model
            ->where($wsql)
            ->select_one('a.*',tab_m('wx_msg_auto')." as a ")
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
        $res['list']=$de;
        $res['page']=$this->ci_page->prompt();
        $this->ci_smarty->assign('re',$res,1,'page');
        $this->ci_smarty->display_ini('wx_auto_back_msg.htm');
    }
    /**
     * 删除回复规则
     */
    private function del_auto_back_msg()
    {
        $id=$_GET['id'];
        $res=$this->Base_WxRule_model->delete(array('id'=>$id));
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
     * 自定义菜单
     */

    public function auto_menu()
    {
        $this->ci_smarty->display_ini('wx_auto_menu.htm');
    }

    /**
     * 客服设置
     *
     */
    public function kf_site()
    {
        if(!empty($_POST['config']))
        {
            $is_open=$_POST['config']['is_open'];
            $str="<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
            $str.=" \$config['is_open']='$is_open'; \n";
            create_file(APPPATH."/cache/wx_kf.php",$str);
        }

        if(file_exists(APPPATH."/cache/wx_kf.php"))
        {
            require(APPPATH."/cache/wx_kf.php");
            $this->ci_smarty->assign('wx',$config,0);
        }
        $this->ci_smarty->display_ini('wx_kf_site.htm');
    }

    /**
     * 消息模板
     */
    public function wx_temp()
    {
        $this->ci_smarty->display_ini('wx_temp.htm');
    }

    /**
     * 微信支付
     */
    public function wx_pay()
    {
        if(!empty($_POST['config']))
        {
            $is_open=$_POST['config']['is_open'];
            $appid=$_POST['config']['appid'];
            $appsecret=$_POST['config']['appsecret'];
            $key=$_POST['config']['key'];
            $mch_id=$_POST['config']['mch_id'];
            $str="<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
            $str.=" \$config['is_open']='$is_open'; \n";
            $str.=" \$config['appid']='$appid'; \n";
            $str.=" \$config['appsecret']='$appsecret'; \n";
            $str.=" \$config['key']='$key'; \n";
            $str.=" \$config['mch_id']='$mch_id'; \n";
            create_file(APPPATH."/cache/wx_pay.php",$str);
        }

        if(file_exists(APPPATH."/cache/wx_pay.php"))
        {
            require(APPPATH."/cache/wx_pay.php");
            $this->ci_smarty->assign('wx',$config,0);
        }
        $this->ci_smarty->display_ini('wx_pay.htm');
    }

    /**
     * 微信红包
     */
    public function wx_pkig()
    {
        if(!empty($_POST['config']))
        {
            $is_open=$_POST['config']['is_open'];
            $certificate=$_POST['config']['certificate'];
            $certificate_pass=$_POST['config']['certificate_pass'];
            $str="<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
            $str.=" \$config['is_open']='$is_open'; \n";
            $str.=" \$config['certificate']='$certificate'; \n";
            $str.=" \$config['certificate_pass']='$certificate_pass'; \n";
            create_file(APPPATH."/cache/wx_red_packet.php",$str);
        }

        if(file_exists(APPPATH."/cache/wx_red_packet.php"))
        {
            require(APPPATH."/cache/wx_red_packet.php");
            $this->ci_smarty->assign('wx',$config,0);
        }
        $this->ci_smarty->display_ini('wx_pkig.htm');
    }

    /**
     * 添加回复规则
     */
    public function back_msg_rule_add()
    {
        if(!empty($_POST))
        {
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('keyword','关键字','required');
            $this->form_validation->set_rules('search_type','匹配类型','required');
            $this->form_validation->set_rules('type','类型','required');
            if($_POST['type']==1)
            {
                $this->form_validation->set_rules('context_msg','文本信息','required');
            }
            else if($_POST['type']==2)
            {
                $this->form_validation->set_rules('group_id','单图文模板','required');
            }
            else if($_POST['type']==2)
            {

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
                $rule_arr['keyword']=$this->input->post('keyword',true);
                $rule_arr['search_type']=$this->input->post('search_type',true);
                $rule_arr['type']=$this->input->post('type',true);
                $rule_arr['last_modify_time']=dateformat(time());
                $rule_arr['last_modify_user']=$this->user_id;
                if($_POST['type']==1)
                {
                   $rule_arr['context_msg']=$this->input->post('context_msg',true);
                    $rule_arr['pic_group_id']=0;
                }
                else if($_POST['type']==2)
                {
                    $rule_arr['pic_group_id']=$this->input->post('group_id',true);
                    $rule_arr['context_msg']='';
                }
                else if($_POST['type']==3)
                {

                }
                if(!empty($_POST['id']))
                {
                    $res=$this->Base_WxRule_model->update($rule_arr,array('id'=>$_POST['id']));
                }else
                {
                    $res=$this->Base_WxRule_model->insert($rule_arr);
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
        if(!empty($_GET['id']))
        {
            $res=$this->Base_WxRule_model->get_row(array('id'=>$_GET['id']));
            if($res['type']==2)
            {
                $res['con']=$this->Base_Sucai_model->get_row(array('pic_group_id'=>$res['pic_group_id']));
            }
            $this->ci_smarty->assign('re',$res);

        }
       
        $this->ci_smarty->display_ini('wx_back_msg_rule_add.htm');
    }
    
    
    
    /**
     * 素材管理
     */
    public function wx_sucai()
    {
        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url=site_url($this->class."/".$this->method);
        $wsql='';
        if(isset($_GET))
        {
            //非模糊查询的字段
            $search_key_ar=array('status','id');
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
                ->select_one('a.*',tab_m('wx_pic_group')." as a ")
                ->num_rows();
        }

        $res=array();
        $de=$this->Base_page_model
            ->where($wsql)
            ->select_one('a.*',tab_m('wx_pic_group')." as a ")
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' a.id desc ');
        $res['list']=$de;
        $res['page']=$this->ci_page->prompt();
        $this->ci_smarty->assign('re',$res,1,'page');
        $this->ci_smarty->display_ini('wx_sucai.htm');
    }
    
    /**
     * 新建单图文素材
     */
    public function single_sucai_add()
    {
        if(!empty($_POST))
        {
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('name','标题','required');
            $this->form_validation->set_rules('describe','描述','required');
            $this->form_validation->set_rules('pic','品牌Logo','required');
            $this->form_validation->set_rules('url','链接地址','required');
           // $this->form_validation->set_rules('con','正文','required');
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

                $group_id=$this->Base_Sucai_model->insert(array('type'=>2,'create_time'=>dateformat(time())));

                $sucai_arr['name']=$this->input->post('name',true);
                $sucai_arr['con']=$this->input->post('describe',true);
                $sucai_arr['pic']=$this->input->post('pic',true);
                $sucai_arr['url']=$this->input->post('url',true);
              //  $sucai_arr['con']=$this->input->post('con',true);
                $sucai_arr['pic_group_id']=$group_id;
                $res=$this->Base_Sucai_model->insert_sucai($sucai_arr);
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

        $this->ci_smarty->assign('ueditor_auth',get_ueditor_auth($this->user_id,WEB_NAME),0);
        $this->ci_smarty->display_ini('wx_single_sucai_add.htm');
    }
}