<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->load_sp_menu();
        $this->load->model('Spuser_User_model');
    }

    //登录
    public function login()
    {

        if (!empty($_POST)) {


           // $this->load->library('session');

            //验证码
            if (!isset($_POST['code']) || isset($_SESSION["authrand"]) && strtolower($_SESSION["authrand"]) !== trim(strtolower($_POST['code']))) {
                $_SESSION["authrand"] = '';
                $this->ci_smarty->assign('succecc_msg', -2);
            } else {

                $this->load->library('MY_form_validation');
                $this->form_validation->set_rules('username', '登录账户', 'required|min_length[4]');
                //callback_username_check function username_check
                $this->form_validation->set_rules('password', '登录密码', 'required|min_length[6]');
                if ($this->form_validation->run() == FALSE) {

                    $this->ci_smarty->assign('succecc_msg', -1);
                } else {
                    $username = $this->input->post('username', TRUE);
                    $password = $this->input->post('password', TRUE);
                    //=========验证通过
                    $this->load->model('Spuser_User_model');
                    $user = $this->Spuser_User_model->get_row('*', array('user' => $username, 'pass' => md5($password)));
                    if (!empty($user)) {
                        set_encode_cookie("username", $user['user'], 60);
                        set_encode_cookie("user_id", $user['id'], 60);
                        header("location:" . site_url("spuser_index/info"));
                    } else {
                        $_SESSION["authrand"] = '';
                        $this->ci_smarty->assign('succecc_msg', 1);
                    }


                }
            }


        }

        $this->load->library('CI_Validationimg');
        $this->ci_smarty->assign('auth_img', $this->ci_validationimg->get_auth_img(70, 30));

        //=========防止csrf攻击=============
        $this->security->get_csrf_token_name();
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        $this->ci_smarty->assign('csrf', $csrf);
        $this->ci_smarty->display_ini('login.htm');
    }

    //通过邮箱找回密码
    public function fw_passwd()
    {
        $this->load->library('session');
        if (!empty($_POST['send_email'])) {
            $d = $this->db->query("select  email_time,email_code,id  from  "
                . tab_m('user') . "  where  email='" . mysql_escape_string($_POST['send_email']) . "'   ")->row_array();
            //30秒才能发送一次	 
            if ($d['email_time'] < time() - 30) {
                $this->load->model('Base_update_model');
                $email_code = rand(1000, 9999);
                $this->load->library('CI_email');
                $falg = $this->ci_email->send_mail($_POST['send_email'], '系统', '验证码 ' . $email_code . ' 找回密码 ' . config_item('base_url_www'), ' 验证码 ' . $email_code . '<br> 网址 ' . config_item('base_url_www'));
                if (!empty($falg))
                    echo $flag = $this->Base_update_model->update(tab_m('user'), array('email_code' => $email_code, 'email_time' => time()), array('id' => $d['id']));
            } else
                echo 1;
            die;
        }

        if (!empty($_POST)) {
            if (!empty($_POST['email'])) {
                if (!empty($_POST['new_pwd']) && !empty($_POST['confirm_pwd']) && $_POST['new_pwd'] == $_POST['confirm_pwd']) {
                    $d = $this->db->query("select  email_time,email_code,id  from  "
                        . tab_m('user') . "  where  email='" . mysql_escape_string($_POST['email']) . "'   ")
                        ->row_array();
                    //10分钟内有效		 				 
                    if (!empty($_POST['email_code']) && $d['email_code'] == $_POST['email_code'] && !empty($d['email_time']) && $d['email_time'] > time() - 60 * 10) {
                        $this->load->model('Base_update_model');
                        $flag = $this->Base_update_model->update(tab_m('user'), array('pass' => md5($_POST['new_pwd']), 'email_time' => 0), array('id' => $d['id']));
                        $this->ci_smarty->assign('succecc_msg', $flag);
                    } else
                        $this->ci_smarty->assign('succecc_msg', '-1');
                }
            }
        }


        $_SESSION["email_rand"] = rand(1000, 999);
        $this->ci_smarty->assign('email_auth', md5($_SESSION["email_rand"]));
        $this->ci_smarty->display_ini('fw_passwd_email.htm');
    }

    public function reg()
    {
        if (!empty($_POST)) {
           // $this->load->library('session');

            //验证码
            if (!isset($_POST['code']) || isset($_SESSION["authrand"]) && strtolower($_SESSION["authrand"]) !== trim(strtolower($_POST['code']))) {
                $_SESSION["authrand"] = '';
                $msg = array(
                    'msg' => '验证码不正确',
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            }

            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('username', '账户名', 'required|min_length[4]|max_length[16]|is_unique[' . tab_m('user') . '.user]');
            //callback_username_check function username_check
            $this->form_validation->set_rules('password', '密码', 'required|min_length[6]|max_length[16]');
            $this->form_validation->set_rules('repassword', '确认密码', 'required|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                $msg = array(
                    'msg' => validation_errors("<i class='icon-comment-alt'></i> "),
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            } else {
                $this->load->model('Spuser_User_model');
                $user['user'] = $this->input->post('username', true);
                $user['pass'] = md5($this->input->post('password', true));
                $res = $this->Spuser_User_model->insert($user);
                if ($res) {
                    set_encode_cookie("username", $user['user'], 60);
                    set_encode_cookie("user_id", $res, 60);
                    $msg = array(
                        'msg' => '注册成功',
                        'type' => 3
                    );
                    echo json_encode($msg);
                    die;
                } else {
                    $msg = array(
                        'msg' => '注册失败',
                        'type' => 1
                    );
                    echo json_encode($msg);
                    die;
                }

            }
        }

        $this->load->library('CI_Validationimg');
        $this->ci_smarty->assign('auth_img', $this->ci_validationimg->get_auth_img(70, 30));

        $this->security->get_csrf_token_name();
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->ci_smarty->assign('csrf', $csrf);
        $this->ci_smarty->display_ini('reg.htm');
    }

    //退出
    public function logout()
    {
        delete_cookie("username");
        delete_cookie("user_id");
        header("location:" . base_site_url("web/index", 'index.php'));
    }

    /**
     * 用户唯一验证
     */
    public function user_unique()
    {
        $user = $_GET['username'];
        $this->load->model('Spuser_User_model');
        $info = $this->Spuser_User_model->get_row('*', array('user' => $user));
        if (empty($info)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    //修改登录密码
    public function info_passwd()
    {
        $this->load->model('Seller_User_model');
        //获取登录id和用户名
        $id = $this->user_id;
        $user = $this->user;
        $this->ci_smarty->assign('user', $user);

        //判断是否有数据提交
        if (!empty($_POST)) {
            //表单验证,提交数据不能为空
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('old_pwd', '旧密码', 'required');
            $this->form_validation->set_rules('new_pwd', '新密码', 'required');
            $this->form_validation->set_rules('new_pwd1', '确认密码', 'required');
            if ($this->form_validation->run() == FALSE) {
                $ar_url = array(site_url('user/info_passwd') => '返回');
                usrl_back_msg('密码不能为空', $ar_url, $this->ci_smarty);
            } else {
                //检验两次修改密码是否一致
                $new_pwd = $this->input->post('new_pwd', true);
                $new_pwd1 = $this->input->post('new_pwd1', true);

                if ($new_pwd != $new_pwd1) {
                    $ar_url = array(site_url('user/info_passwd') => '返回');
                    usrl_back_msg('修改密码不一致', $ar_url, $this->ci_smarty);
                } else {
                    //检验原密码是否正确
                    $old_pwd = $this->input->post('old_pwd', true);
                    $res = $this->Seller_User_model->check_pass($id);
                    if (md5($old_pwd) != $res['pass']) {
                        $ar_url = array(site_url('user/info_passwd') => '返回');
                        usrl_back_msg('原密码不正确', $ar_url, $this->ci_smarty);
                    } else {
                        //修改密码
                        $pwd = array();
                        $pwd['pass'] = md5($new_pwd);
                        $flag = $this->Seller_User_model->updata_passwd($id, $pwd);
                        if ($flag == 1) {
                            $ar_url = array(site_url('user/info_passwd') => '返回');
                            usrl_back_msg('操作成功', $ar_url, $this->ci_smarty);
                        } else {
                            $ar_url = array(site_url('user/info_passwd') => '返回');
                            usrl_back_msg('操作失败', $ar_url, $this->ci_smarty);
                        }
                    }
                }
            }
        }
        //加载页面
        $this->ci_smarty->display_ini('seller_pass.htm');
    }

    //修改操作密码
    public function info_act_pass()
    {
        $this->load->model('Seller_User_model');
        //获取登录id
        $id = $this->user_id;

        //判断是否有数据提交
        if (!empty($_POST)) {
            //表单验证,提交数据不能为空
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('old_pwd', '旧密码', 'required');
            $this->form_validation->set_rules('new_pwd', '新密码', 'required');
            $this->form_validation->set_rules('new_pwd1', '确认密码', 'required');
            if ($this->form_validation->run() == FALSE) {
                $ar_url = array(site_url('user/info_act_pass') => '返回');
                usrl_back_msg('密码不能为空', $ar_url, $this->ci_smarty);
            } else {
                //检验两次修改密码是否一致
                $new_pwd = $this->input->post('new_pwd', true);
                $new_pwd1 = $this->input->post('new_pwd1', true);

                if ($new_pwd != $new_pwd1) {
                    $ar_url = array(site_url('user/info_act_pass') => '返回');
                    usrl_back_msg('修改密码不一致', $ar_url, $this->ci_smarty);
                } else {
                    //检验原密码是否正确
                    $old_pwd = $this->input->post('old_pwd', true);
                    $res = $this->Seller_User_model->check_pass($id);
                    if (md5($old_pwd) != $res['act_pass']) {
                        $ar_url = array(site_url('user/info_act_pass') => '返回');
                        usrl_back_msg('原密码不正确', $ar_url, $this->ci_smarty);
                    } else {
                        //修改密码
                        $pwd = array();
                        $pwd['act_pass'] = md5($new_pwd);
                        $flag = $this->Seller_User_model->updata_passwd($id, $pwd);
                        if ($flag == 1) {
                            $ar_url = array(site_url('user/info_act_pass') => '返回');
                            usrl_back_msg('操作成功', $ar_url, $this->ci_smarty);
                        } else {
                            $ar_url = array(site_url('user/info_act_pass') => '返回');
                            usrl_back_msg('操作失败', $ar_url, $this->ci_smarty);
                        }
                    }
                }
            }
        }
        //加载页面
        $this->ci_smarty->display_ini('seller_act_pass.htm');
    }


    //修改个人资料
    public function user_info_edit()
    {
        if (!empty($_POST)) {
            //表单验证,提交数据不能为空
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('name', '姓名', 'required');
            $this->form_validation->set_rules('mobile', '手机', 'required');
            if ($this->form_validation->run() == FALSE) {
                $msg = array(
                    'msg' => validation_errors("<i class='icon-comment-alt'></i> "),
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            } else {
                $userid = $this->user_id;
                $user = array();
                $name = $this->input->post('name', true);
                $mobile = $this->input->post('name', true);
                if (!empty($name))
                    $user['name'] = $this->input->post('name', true);
                if (!empty($mobile))
                    $user['mobile'] = $this->input->post('mobile', true);
                if (empty($user)) {
                    $msg = array(
                        'msg' => '请填写要修改的信息',
                        'type' => 1
                    );
                    echo json_encode($msg);
                    die;
                } else {
                    $flag = $this->Spuser_User_model->update($user, array('id' => $userid));
                    if ($flag) {
                        $msg = array(
                            'msg' => '操作成功',
                            'type' => 3
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
        } else {
            $user_id = $this->user_id;
            $userInfo = $this->Spuser_User_model->get_row('*', array('id' => $user_id));
            $this->ci_smarty->assign('show_ajax', 2);
            $this->ci_smarty->assign('seo_title', '修改个人资料');
            $this->ci_smarty->assign('res', $userInfo);
            $this->ci_smarty->display_ini('user_info_edit.htm');
        }


    }

    //修改个人密码
    public function pwd_edit()
    {
        if (!empty($_POST)) {
            //表单验证,提交数据不能为空
            $this->load->library('MY_form_validation');
            $this->form_validation->set_rules('old_pwd', '旧密码', 'required|min_length[6]|max_length[16]');
            $this->form_validation->set_rules('new_pwd', '新密码', 'required|min_length[6]|max_length[16]');
            $this->form_validation->set_rules('confirm_pwd', '确认密码', 'required|min_length[6]|max_length[16]|matches[new_pwd]');
            if ($this->form_validation->run() == FALSE) {
                $msg = array(
                    'msg' => validation_errors("<i class='icon-comment-alt'></i> "),
                    'type' => 1
                );
                echo json_encode($msg);
                die;
            } else {
                //用户id
                $userid = $this->user_id;
                //检验原密码是否正确
                $old_pwd = $this->input->post('old_pwd', true);
                $new_pwd = $this->input->post('new_pwd', true);
                $userInfo = $this->Spuser_User_model->get_row('pass', array('id' => $userid));
                if (md5($old_pwd) != $userInfo['pass']) {
                    $msg = array(
                        'msg' => '原密码不正确',
                        'type' => 1
                    );
                    echo json_encode($msg);
                    die;
                } else {
                    //修改密码
                    $pwd = array();
                    $pwd['pass'] = md5($new_pwd);
                    $flag = $this->Spuser_User_model->update($pwd, array('id' => $userid));
                    if ($flag) {
                        $msg = array(
                            'msg' => '操作成功',
                            'type' => 3
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
        }
        $this->ci_smarty->display_ini('pwd_edit.htm');
    }
}
