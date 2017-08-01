<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consult extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->load_sp_menu();
    }


    public function consult_list()
    {
        $this->ci_smarty->assign('show_ajax', 2);
        $this->ci_smarty->assign('seo_title', '我的资讯');
        $this->ci_smarty->display_ini('consult_list.htm');
    }

}