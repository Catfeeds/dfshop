<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_Smarty');
        $this->load->model('Base_Order_model');
        $this->load_sp_menu();
    }

    /**
     * 订单首页
     */
    public function order_list()
    {
        $order_status=$this->input->get('status',true);
        $status_arr=array('order_all','order_pre_pay','order_pre_delivery','order_pre_receive');
        $order_status=(empty($order_status) || !in_array($order_status,$status_arr))?'order_all':$order_status;
        $res=$this->Base_Order_model->getList($order_status);
        $this->ci_smarty->assign('order_status',$order_status);
        $this->ci_smarty->assign('show_ajax', 2);
        $this->ci_smarty->assign('seo_title', '我的订单');
        $this->ci_smarty->assign('re',$res,1,'page');
        $this->ci_smarty->display_ini('order_list.htm');
    }


    /**
     * 取消订单
     */
    public function order_cancel()
    {

        $orderId=$this->input->get('orderId',true);
        if(empty($orderId))
        {
            $msg = array(
                'msg'  => '订单号不能为空',
                'type' => 1
            );
            echo json_encode($msg);
            die;
        }
        $data=$this->view_order('buyer_id',$orderId);
        if($data['buyer_id']!=$this->user_id)
        {
            $msg = array(
                'msg'  => '您无权操作该订单',
                'type' => 1
            );
            echo json_encode($msg);
            die;
        }
        //更新订单状态
        $status=array(
            'status'=>-1
        );

        $res=$this->Base_Order_model->updateData($orderId,$this->user_id,$status);
        if($res){
            $msg = array(
                'msg'  => '取消订单成功',
                'type' => 3
            );
            echo json_encode($msg);
            die;
        }else{
            $msg = array(
                'msg'  => '取消订单操作失败',
                'type' => 1
            );
            echo json_encode($msg);
            die;
        }
    }

    /**
     * 订单 付款
     */
    public function pay_order()
    {
        $orderId=$this->input->get('orderId',true);
        if(empty($orderId))
        {
            $msg = array(
                'msg'  => '订单号不能为空',
                'type' => 1
            );
            echo json_encode($msg);
            die;
        }
        $data=$this->view_order('buyer_id',$orderId);
        if($data['buyer_id']!=$this->user_id)
        {
            $msg = array(
                'msg'  => '您无权操作该订单',
                'type' => 1
            );
            echo json_encode($msg);
            die;
        }
        //更新订单状态
        $status=array(
            'status'=>2
        );

        $res=$this->Base_Order_model->updateData($orderId,$this->user_id,$status);
        if($res){
            $msg = array(
                'msg'  => '订单付款成功',
                'type' => 3
            );
            echo json_encode($msg);
            die;
        }else{
            $msg = array(
                'msg'  => '订单付款失败',
                'type' => 1
            );
            echo json_encode($msg);
            die;
        }
    }
    
    /**
     * 查看一条订单
     * @param $field
     * @param $orderId
     * @return mixed
     */
    protected function view_order($field='*',$orderId)
    {
        if(empty($orderId))
        {
           show_error('订单号不能为空',403);
        }
        return $this->Base_Order_model->getData($field,$orderId);
    }


    

    



}
