<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->load_sp_menu();
    }

    public function order_list()
    {
        $this->ci_smarty->assign('show_ajax', 2);
        $this->ci_smarty->assign('seo_title', '我的订单');
        $this->ci_smarty->display_ini('order_list.htm');
    }

}
