<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Base_OrderPro_model extends CI_Model
    {
        /**
         * 表名
         * @var string
         */
        private $_tableName = 'product_order_pro';

        public function __construct()
        {
            parent::__construct();
            $this->load->model('Base_get_model');
            $this->load->model('Base_update_model');
            $this->load->model('Base_Product_model');
        }

        /**
         * 订单详情 添加
         * @param $data
         * @return bool
         */
        public function addData($data)
        {
            if (!is_array($data) || empty($data)) {
                return FALSE;
            }
            if (!$this->Base_update_model->insert(tab_m($this->_tableName), $data)) {
                return FALSE;
            }

            return TRUE;
        }

        /**
         * 订单详情列表
         * @param $orderId
         * @param $userId
         * @return bool
         */
        public function getList($orderId, $userId)
        {
            if (empty($orderId) || empty($userId)) {
                return FALSE;
            }
            $data = $this->Base_get_model->get_list(tab_m($this->_tableName), '*', array('order_id' => $orderId, 'userid' => $userId), ' id desc');
            foreach ($data as $k => $v) {
                $productInfo = $this->Base_Product_model->get_row(array('id' => $v['product_id']), 'pic');
                $data[ $k ]['img'] = $productInfo['pic'];
            }

            return $data;
        }

        /**
         * 订单详情 删除
         * @param $orderId
         * @param $userId
         * @return bool
         */
        public function deleteData($orderId, $userId)
        {
            if (empty($orderId) || empty($userId)) {
                return FALSE;
            }
            if (!$this->Base_update_model->delete(tab_m($this->_tableName), array('order_id' => $orderId, 'userid' => $userId))) return FALSE;

            return TRUE;
        }

    }