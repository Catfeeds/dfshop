<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Order_model  extends CI_Model
{
    /**
     * 表名
     * @var string
     */
    private $_tableName='product_order';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_get_model');
        $this->load->model('Base_update_model');
        $this->load->model('Base_OrderPro_model');
        $this->load->model('Base_Cart_model');
        $this->load->model('Base_page_model');


    }

    public function getList($order_status='order_all')
    {

        switch ($order_status)
        {
            case 'order_all':
                $status='';
                    break;
            case 'order_pre_pay':
                $status=' status = 0 ';
                break;
            case 'order_pre_delivery':
                $status=' status = 1 ';
                break;
            case 'order_pre_receive':
                $status=' status = 2 ';
                break;
            default :
                $status='';
                break;
        }
        $this->load->library('CI_page');
        $this->ci_page->Page();
        $this->ci_page->url=site_url($this->class."/".$this->method);
        $this->ci_page->listRows=5;
        if(!$this->ci_page->__get('totalRows'))
        {
            $this->ci_page->totalRows =$this->Base_page_model
                ->where($status)
                ->select_one('*',tab_m($this->_tableName))
                ->num_rows();
        }

        $res=array();
        $de=$this->Base_page_model
            ->where($status)
            ->select_one('*',tab_m('product_order'))
            ->result_array($this->ci_page->firstRow,$this->ci_page->listRows,' id desc ');
        foreach ($de as $k=> $v)
        {
            $de[$k]['orderProList']=$this->Base_OrderPro_model->getList($v['id'],$v['buyer_id']);
        }
       

        $res['list']=$de;
        $res['page']=$this->ci_page->prompt();
        return $res;

    }
    
    
    /**
     * 订单 添加
     * @param $order
     * @param $order_pro
     * @param $userId
     * @return bool
     */
    public function addData( $order,$order_pro,$userId )
    {
        if ( !is_array($order) || empty($order) )
        {
            return false;
        }
        if ( !is_array($order_pro) || empty($order_pro) )
        {
            return false;
        }
        //插入订单内容 返回订单号
        $order_id=$this->Base_update_model->insert(tab_m($this->_tableName), $order);
        if(!$order_id)
        {
            return false;
        }
        //插入订单详情表
        foreach ($order_pro as $k=>$v)
        {
            $order_pro[$k]['order_id'] = $order_id;

        }
       foreach ($order_pro as $v1)
       {   
           //添加订单详情失败
           if(!$this->Base_OrderPro_model->addData($v1))
           {
               $this->deleteData($order_id,$userId);
               $this->Base_OrderPro_model->deleteData($order_id,$userId);
               return false;
           }
           //删除购物车失败
           if(!$this->Base_Cart_model->delete(array('product_id' => $v1['product_id'], 'buyer_id' => $userId)))
           {
               $this->deleteData($order_id,$userId);
               $this->Base_OrderPro_model->deleteData($order_id,$userId);
               return false;
           }
                
       }
       return true;
    }

    /**
     * 订单删除 
     * @param $orderId
     * @param $userId
     * @return bool
     */
    public function deleteData($orderId,$userId)
    {
        if(!$this->Base_update_model->delete(tab_m($this->_tableName), array('id'=>$orderId,'userid'=>$userId))) return false;
        return true;
    }


    /**
     * 获取一条订单数据
     * @param $orderId
     * @return array
     */
    public function getData($fields='*',$orderId)
    {
        if(empty($orderId)) return false;
        return $this->Base_get_model->get_row(tab_m($this->_tableName),$fields,'id='.$orderId);
    }

    /**
     * 更新订单
     * @param $orderId
     * @param $userId
     * @param $data
     * @return bool
     */
    public function updateData($orderId,$userId,$data)
    {
        if(empty($orderId) || empty($data) || !is_array($data)) return false;
        if(!$this->Base_update_model->update(tab_m($this->_tableName),$data,array('id'=>$orderId,'buyer_id'=>$userId))) return false;
        return true;
    }



    
    
    
    

}