<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Cart_model extends CI_Model
{

    /**
     * 表名
     * @var string
     */
    private $_tableName='product_cart';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_update_model');
        $this->load->model('Base_get_model');
    }

    /**
     * 购物车  加入购物车
     * @param $arr
     * @return bool
     */
    public function insert($arr)
    {
        if(empty($arr) || !is_array($arr)) return false;
        return $this->Base_update_model->insert(tab_m($this->_tableName),$arr);
    }

    /**
     * 购物车  删除
     * @param $where
     * @return bool
     */
    public function delete($where)
    {
        if(empty($where) || !is_array($where)) return false;
        if(!$this->Base_update_model->delete(tab_m($this->_tableName),$where)) return false;
        return true;
    }

    /**
     * 购物车  更新
     * @param $data
     * @param $where
     * @return bool
     */
    public function update($data,$where)
    {
        if(empty($data) || empty($where) || !is_array($data) || !is_array($where)) return false;
        if(!$this->Base_update_model->update(tab_m($this->_tableName),$data,$where)) return false;
        return true;
    }

    /**
     * 购物车  获取购物车单条记录
     * @param string $field
     * @param $where
     * @return bool
     */
    public function get_row($field="*",$where)
    {
        if(empty($where) || !is_array($where)) return false;
        return $this->Base_get_model->get_row(tab_m($this->_tableName),$field,$where);
    }

    /**
     * 购物车  获取购物车多条记录
     * @param $where
     * @param string $filed
     * @return bool
     */
    public function get_list($where,$filed='*')
    {
        if(empty($where) || !is_array($where)) return false;
        return $this->Base_get_model->get_list(tab_m($this->_tableName),$filed,$where);
    }



}
