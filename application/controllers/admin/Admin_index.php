<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_index extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->get_admin_name();
    }

    public function index_diy()
    {

        $this->ci_smarty->display_ini('index_diy.htm');
    }

    public function image_list()
    {
        if (isset($_GET['del_id'])) {
            if (file_exists(APPPATH . "../web" . $_GET['url'])) {
                @unlink(APPPATH . "../web" . $_GET['url']);
                $this->db->query("delete  from  " . tab_m('base_image') . "   where  id='" . $_GET['del_id'] . "' ");
            }
        }
        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url = site_url($this->class . "/" . $this->method);
        $this->ci_page->listRows = 15;

        $sql = "select upload_name,url,user_id,add_time,id,size   from  " . tab_m('base_image');
        if (!$this->ci_page->__get('totalRows')) {
            $this->ci_page->totalRows = $this->db->query($sql)->num_rows;
        }
        $sql .= " order by id desc limit " . $this->ci_page->firstRow . "," . $this->ci_page->listRows;
        $res = array();
        $query = $this->db->query($sql);
        $res['list'] = $query->result_array();
        $res['page'] = $this->ci_page->prompt();
        $this->ci_smarty->assign('re', $res, 1, 'page');
        $this->ci_smarty->display_ini('image_list.htm');
    }

    public function web_config()
    {
        if (!empty($_POST['config'])) {
            require(APPPATH . '/config/config_base.php');
            if (!empty($config)) {
                if (file_exists(APPPATH . "/config/config.php"))
                    @unlink(APPPATH . "/config/config.php");

                $ar = explode('.', $_POST['config']['web_base']);
                $config['cookie_prefix_tag'] = '_df_' . implode('_', $ar);
                $config['company'] = $_POST['config']['web_name'];
                $config['logo'] = $_POST['config']['pic'];
                $config['copyright'] = $_POST['config']['copyright'];
                $config['cookie_authkey'] = md5($config['cookie_prefix_tag']);
                $str = "<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";

                foreach ($config as $k => $v) {
                    if ($k == 'base_url')
                        $str .= "\$config['{$k}'] = '" . $_POST['config']['web_url'] . "'.WEB_DIR; \n";
                    elseif ($k == 'base_url_www')
                        $str .= "\$config['{$k}'] = '" . $_POST['config']['web_url'] . "'; \n";
                    elseif ($k == 'baseurl')
                        $str .= "\$config['{$k}'] = '" . $_POST['config']['web_base'] . "'; \n";
                    elseif ($k == 'index_page')
                        $str .= "\$config['{$k}'] = INDEX_PAGE; \n";
                    elseif ($k == 'cookie_domain')
                        $str .= "\$config['{$k}'] = '." . $ar[count($ar) - 2] . "." . $ar[count($ar) - 1] . "'; \n";    //tst.erp.com
                    elseif ($k == 'cookie_prefix')
                        $str .= "\$config['{$k}'] =  WEB_NAME.\$config['cookie_prefix_tag']; \n";
                    elseif (is_bool($v))
                        $str .= "\$config['{$k}'] = " . ($v == true ? 'TRUE' : 'FALSE') . "; \n";
                    elseif (is_array($v))
                        $str .= "\$config['{$k}'] = array(); \n";
                    elseif (is_numeric($v))
                        $str .= "\$config['{$k}'] = {$v}; \n";
                    elseif (is_null($v))
                        $str .= "\$config['{$k}'] = NULL; \n";
                    else
                        $str .= "\$config['{$k}'] = '{$v}'; \n";
                }
                error_log($str . " ?>", 3, APPPATH . "/config/config.php");
            }

            if (file_exists(APPPATH . "/config/config_back.php"))
                @unlink(APPPATH . "/config/config_back.php");
            $str = "<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
            foreach ($_POST['config'] as $k => $v) {
                if (is_numeric($v))
                    $str .= "\$config['{$k}'] = {$v}; \n";
                else
                    $str .= "\$config['{$k}'] = '{$v}'; \n";
            }
            error_log($str . " ?>", 3, APPPATH . "/config/config_back.php");
        }
        if (file_exists(APPPATH . "/config/config_back.php")) {
            require(APPPATH . "/config/config_back.php");
            $this->ci_smarty->assign('web_config', $config, 0);
        }
        $this->ci_smarty->assign('ueditor_auth', get_ueditor_auth($this->user_id, WEB_NAME), 0);
        $this->ci_smarty->display_ini('web_config.htm');
    }


    public function clear_temp()
    {
        if (!empty($_POST)) {
            $dir = APPPATH . "templates_c";
            $dh = opendir($dir);
            //读取模板缓存目录
            while ($file = readdir($dh)) {
                if ($file != "." && $file != "..") {
                    $fullpath = $dir . "/" . $file;
                    if (is_dir($fullpath)) {

                        $dh2 = opendir($fullpath);
                        //删除缓存目录下的文件 
                        while ($file_2 = readdir($dh2)) {
                            $fullpath2 = $dir . "/" . $file . "/" . $file_2;
                            if (!is_dir($fullpath2))
                                unlink($fullpath2);
                        }
                    }
                }
            }
            $this->ci_smarty->assign('msg', '清除成功' . date('Y-m-d H:i:s'));
        }
        $this->ci_smarty->display_ini('clear_temp.htm');
    }

    //后台菜单
    public function index()
    {
        require(APPPATH . '/config/menu_config_admin.php');
        if ($this->user_type != 1) {
            //查询已有权限
            $this->load->model('Admin_User_model');
            $row = $this->Admin_User_model->get_group_one(array('group_perms'), $this->user_group_id);
            $group_perms = explode(',', $row['group_perms']);
        } else
            $group_perms = array();

        //头部-----------
        foreach ($config['menu_config'] as $k => $v) {
            $menu_top[$k] = $v[0];
            if ($this->user_type != 1) {
                $falg = 0;
                foreach ($v[1] as $v1) {
                    foreach ($v1[1] as $kkk => $v2) {
                        $ar = explode(',', $v2);
                        if (is_array($group_perms) && in_array(md5(strtolower($ar[2] . '/' . $ar[0])), $group_perms)) {
                            $falg = 1;
                        }
                    }
                }
                if ($falg == 0)
                    unset($menu_top[$k]);
            }
        }


        if (isset($menu_top))
            $this->ci_smarty->assign('menu_top', $menu_top);
        if (!isset($_GET['selected']) && isset($config['menu_config']['index']))
            $menu_left = $config['menu_config']['index'][1];
        elseif (isset($_GET['selected']) && !empty($config['menu_config'][$_GET['selected']]))
            $menu_left = $config['menu_config'][$_GET['selected']][1];

        $menu_lefts = array();
        //左边----------
        foreach ($menu_left as $k => $v1) {
            $menu_lefts[$k]['name'] = $v1[0];
            foreach ($v1[1] as $v2) {
                $ar = explode(',', $v2);
                if ($this->user_type == 1 || is_array($group_perms) && in_array(md5(strtolower($ar[2] . '/' . $ar[0])), $group_perms)) {
                    $menu_lefts[$k]['list'][] = $ar;
                }
            }
            if (empty($menu_lefts[$k]['list']))
                unset($menu_lefts[$k]);
        }
        //登陆账号
        $this->ci_smarty->assign('index_page', INDEX_PAGE);
        $this->ci_smarty->assign('admin', get_decode_cookie('username'));
        $this->ci_smarty->assign('menu_left', $menu_lefts);
        $this->ci_smarty->display('main_index.htm');
    }

    //默认首页
    public function info()
    {
        $row = array();

        $this->ci_smarty->assign("de", $row);
        $this->ci_smarty->display_ini('info.htm');
    }

    //核销提交
    public function iframe()
    {
        $this->ci_smarty->assign('width', $_GET['width']);
        $this->ci_smarty->assign('height', $_GET['height']);
        $this->ci_smarty->assign('title', $_GET['title']);
        unset($_GET['width'], $_GET['height'], $_GET['title']);
        $this->ci_smarty->assign('url', site_url($_GET['mothed']) . "/?" . url_convert($_GET));
        $this->ci_smarty->display('admin_iframe.htm');
    }


    //错误提示页面
    public function admin_msg()
    {
        if (isset($_GET['ss']))
            $this->ci_smarty->assign("ss", $_GET['ss'] * 1000);;
        $this->ci_smarty->display('admin_msg.htm');
    }

    /**
     * 邮箱设置
     */
    public function email_site()
    {
        if (!empty($_POST['send_email'])) {
            $this->load->library('CI_email');
            $this->ci_email->send_mail($_POST['email'], 'chenbo', '你好', '你好,这是一条信息');
        } else {
            if (!empty($_POST['config'])) {
                $is_open = $_POST['config']['is_open'];
                $type = $_POST['config']['type'];
                $SMTP_address = array_filter($_POST['config']['SMTP_address']);
                $email_address = array_filter($_POST['config']['email_address']);
                $email_pass = array_filter($_POST['config']['email_pass']);
                $config_email = array();
                foreach ($SMTP_address as $k => $v) {
                    $config_email[$k] = array('SMTP_address' => $v, 'email_address' => $email_address[$k], 'email_pass' => $email_pass[$k]);
                }

                $config_email = json_encode($config_email);
                $str = "<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
                $str .= " \$config['is_open']='$is_open'; \n";
                $str .= " \$config['type']='$type';\n";
                $str .= " \$config['email']='$config_email';\n";
                create_file(APPPATH . "/cache/email_setting.php", $str);
            }
        }

        if (file_exists(APPPATH . "/cache/email_setting.php")) {
            require(APPPATH . "/cache/email_setting.php");
            $email = json_decode($config['email'], true);
            $this->ci_smarty->assign('wx', $config, 0);
            $this->ci_smarty->assign('email', $email, 0);
        }
        $this->ci_smarty->display_ini('email_site.htm');
    }

    /**
     * 网站公告
     */
    public function web_msg_list()
    {
        if ($_GET['act'] == 'add') {

            $this->ci_smarty->assign('ueditor_auth', get_ueditor_auth($this->user_id, WEB_NAME), 0);
            $this->ci_smarty->display_ini('web_msg_add.htm');
            die;
        }
        if ($_GET['act'] == 'do_add') {
            $this->web_msg_add();
            return;
        }

        if ($_GET['act'] == 'delete') {
            $this->del_web_gg();
            return;
        }
        if ($_GET['act'] == 'edit') {
            $this->load->model('Base_Webgg_model');
            $res = $this->Base_Webgg_model->get_row(array('id' => $_GET['id']));
            $this->ci_smarty->assign('re', $res);
            $this->ci_smarty->display_ini('web_msg_add.htm');
            die;

        }

        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url = site_url($this->class . "/" . $this->method);
        $wsql = '';
        if (isset($_GET)) {
            //非模糊查询的字段
            $search_key_ar = array();
            //姓名模糊查询字段
            $search_key_ar_more = array('name');
            foreach ($_GET as $k => $v) {
                $skey = substr($k, 7, strlen($k) - 7);
                if ($k != 'search_page_num' && substr($k, 0, 7) == 'search_' && !in_array($v, array('all', ''))) {
                    //非模糊查询
                    if (in_array($skey, $search_key_ar))
                        $wsql .= " and {$skey}='{$v}'";
                    //模糊查询
                    if (in_array($skey, $search_key_ar_more))
                        $wsql .= " and {$skey} like '%{$v}%'";
                }
            }
        }


        $search_page_num = array('all' => 15, 1 => 15, 2 => 30, 3 => 50);
        //===================查询 end=========================
        $this->ci_page->listRows = !isset($_GET['search_page_num']) || empty($search_page_num[$_GET['search_page_num']]) ? 15 : $search_page_num[$_GET['search_page_num']];
        $this->load->model('Base_page_model');
        if (!$this->ci_page->__get('totalRows')) {
            $this->ci_page->totalRows = $this->Base_page_model
                ->where($wsql)
                ->select_one('a.*', tab_m('web_gg') . " as a ")
                ->num_rows();
        }

        $res = array();
        $de = $this->Base_page_model
            ->where($wsql)
            ->select_one('a.*', tab_m('web_gg') . " as a ")
            ->result_array($this->ci_page->firstRow, $this->ci_page->listRows, ' a.id desc ');

        $res['list'] = $de;
        $res['page'] = $this->ci_page->prompt();
        $this->ci_smarty->assign('re', $res, 1, 'page');
        $this->ci_smarty->display_ini('web_msg_list.htm');
    }


    /**
     * 队列列表
     */
    public function dosend()
    {
        if ($_GET['act'] == 'intercept') {
            $this->intercept();
            return;
        }

        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url = site_url($this->class . "/" . $this->method);
        $wsql = '';
        if (isset($_GET)) {
            //非模糊查询的字段
            $search_key_ar = array();
            //姓名模糊查询字段
            $search_key_ar_more = array('name');
            foreach ($_GET as $k => $v) {
                $skey = substr($k, 7, strlen($k) - 7);
                if ($k != 'search_page_num' && substr($k, 0, 7) == 'search_' && !in_array($v, array('all', ''))) {
                    //非模糊查询
                    if (in_array($skey, $search_key_ar))
                        $wsql .= " and {$skey}='{$v}'";
                    //模糊查询
                    if (in_array($skey, $search_key_ar_more))
                        $wsql .= " and {$skey} like '%{$v}%'";
                }
            }
        }


        $search_page_num = array('all' => 15, 1 => 15, 2 => 30, 3 => 50);
        //===================查询 end=========================
        $this->ci_page->listRows = !isset($_GET['search_page_num']) || empty($search_page_num[$_GET['search_page_num']]) ? 15 : $search_page_num[$_GET['search_page_num']];
        $this->load->model('Base_page_model');
        if (!$this->ci_page->__get('totalRows')) {
            $this->ci_page->totalRows = $this->Base_page_model
                ->where($wsql)
                ->select_one('a.*', tab_m('dosend') . " as a ")
                ->num_rows();
        }

        $res = array();
        $de = $this->Base_page_model
            ->where($wsql)
            ->select_one('a.*', tab_m('dosend') . " as a ")
            ->result_array($this->ci_page->firstRow, $this->ci_page->listRows, ' a.id desc ');

        $res['list'] = $de;
        $res['page'] = $this->ci_page->prompt();
        $this->ci_smarty->assign('re', $res, 1, 'page');
        $this->ci_smarty->display_ini('dosend.htm');
    }


    /**
     * 拦截操作
     */
    private function intercept()
    {
        $item = array_filter(explode(',', $_GET['item']));
        //model
        $this->load->model('Base_Dosend_model');

        foreach ($item as $k => $v) {
            $num = $this->Base_Dosend_model->update(array('act_status' => 2), array('id' => $v, 'act_status' => 0));
            if ($num == 1) {
                $this->Base_Dosend_model->update(array('dosend_lock' => 2), array('id' => $v));
                $this->Base_Dosend_model->update(array('act_status' => 0), array('id' => $v, 'act_status' => 2));
            }
        }


    }


    /**
     * 添加编辑公告操作
     */
    private function web_msg_add()
    {
        $this->load->library('MY_form_validation');
        $this->form_validation->set_rules('name', '公告标题', 'required');
        $this->form_validation->set_rules('con', '公告描述', 'required');
        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'msg' => validation_errors("<i class='icon-comment-alt'></i>"),
                'type' => 1
            );
            echo json_encode($msg);
            die;
        } else {
            $msg = array();
            $msg['add_time'] = dateformat(time());
            $msg['adm_userid'] = $this->user_id;
            $msg['name'] = $this->input->post('name', true);
            $msg['con'] = $this->input->post('con', true);
            //model
            $this->load->model('Base_Webgg_model');
            if (!empty($_POST['id'])) {

                $res = $this->Base_Webgg_model->update($msg, array('id' => $_POST['id']));
            } else {
                $res = $this->Base_Webgg_model->insert($msg);
            }


            if ($res) {
                $msg = array(
                    'msg' => '操作成功',
                    'type' => 3,
                );
                echo json_encode($msg);
                die;
            } else {
                $msg = array(
                    'msg' => '操作失败',
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
    private function del_web_gg()
    {
        //model
        $this->load->model('Base_Webgg_model');
        $res = $this->Base_Webgg_model->delete(array('id' => $_GET['id']));
        if ($res) {
            $msg = array(
                'msg' => '操作成功',
                'type' => 3,
            );
            echo json_encode($msg);
            die;
        } else {
            $msg = array(
                'msg' => '操作失败',
                'type' => 1
            );
            echo json_encode($msg);
            die;
        }
    }


}

