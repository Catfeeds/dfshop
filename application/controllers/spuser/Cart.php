<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Cart extends MY_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->library('CI_Smarty');
            $this->get_admin_name();
            $this->load->model('Spuser_User_model');
            $this->load->model('Base_Product_model');
            $this->load->model('Base_Cart_model');
        }


        /**
         * 购物车列表
         */
        public function cart_list()
        {

            $user_login = $this->is_login();
            if ($user_login === FALSE) { //用户未登陆
                //获取cookie购物车信息
                $cart_item = get_decode_cookie('cart_items');
                $cart_item = json_decode($cart_item, TRUE);
                if (empty($cart_item)) {
                    $this->ci_smarty->assign('show_ajax', 1);
                    $this->ci_smarty->display_ini('cart_error.htm');

                    return;
                } else {
                    foreach ($cart_item as $k => $v) {
                        $cart_item[ $k ]['product_info'] = $this->Base_Product_model->get_row(array('id' => $v['id']), '*');
                    }
                    $new_cart_list = array();
                    foreach ($cart_item as $k => $v) {
                        $new_cart_list[ $v['product_info']['warehouse_id'] ][] = $v;
                    }
                }

            } else {
                //用户登陆
                $m_user_id = $user_login;
                $cart_list = $this->Base_Cart_model->get_list(array('buyer_id' => $m_user_id), '*');
                if (empty($cart_list)) {
                    $this->ci_smarty->assign('show_ajax', 1);
                    $this->ci_smarty->display_ini('cart_error.htm');

                    return;
                } else {
                    foreach ($cart_list as $k => $v) {
                        $cart_list[ $k ]['product_info'] = $this->Base_Product_model->get_row(array('id' => $v['product_id']), '*');
                    }
                    //按仓库号分类后的购物车列表
                    $new_cart_list = array();
                    foreach ($cart_list as $k => $v) {
                        $new_cart_list[ $v['product_info']['warehouse_id'] ][] = $v;
                    }
                }


            }
            $this->ci_smarty->assign('cart_list', $new_cart_list);
            $this->ci_smarty->assign('show_ajax', 1);
            $this->ci_smarty->display_ini('cart_list.htm');
        }


        /**
         * 加入购物车
         */
        public function add_cart()
        {
            if (!empty($_GET)) {
                $product_id = $_GET['id'];
                $number = (isset($_GET['num'])) ? $_GET['num'] : 1;
                //查询商品信息
                $product_info = $this->Base_Product_model->get_row(array('id' => $product_id), 'price,name,warehouse_id');
                //如果用户登陆
                $user_login = $this->is_login();
                if ($user_login === FALSE) {//用户未登陆
                    //先查看cookie
                    $cart_items = get_decode_cookie("cart_items");
                    if (empty($cart_items)) {
                        $cart_items = array();
                        $cart_items[ $product_id ] = array();
                        $cart_items[ $product_id ]['id'] = $product_id;
                        $cart_items[ $product_id ]['price'] = $product_info['price'];
                        $cart_items[ $product_id ]['name'] = $product_info['name'];
                        $cart_items[ $product_id ]['quantity'] = $number;
                        $cart_items[ $product_id ]['warehouse_id'] = $product_info['warehouse_id'];
                        $cart_str = json_encode($cart_items);
                        set_encode_cookie('cart_items', $cart_str, 24 * 60 * 60);
                        echo '商品' . $product_info['name'] . '加入购物车成功';
                    } else {
                        $cart_items = json_decode($cart_items, TRUE);
                        $items_exists = FALSE;
                        $new_cart_items = array();
                        foreach ($cart_items as $key => $val) {
                            $new_cart_items[ $key ] = $val;
                            if ($key == $product_id) {
                                $new_cart_items[ $key ]['quantity'] = $val['quantity'] + $number;
                                $items_exists = TRUE;
                            }
                        }
                        if ($items_exists === FALSE) {
                            $new_cart_items[ $product_id ] = array();
                            $new_cart_items[ $product_id ]['id'] = $product_id;
                            $new_cart_items[ $product_id ]['price'] = $product_info['price'];
                            $new_cart_items[ $product_id ]['name'] = $product_info['name'];
                            $new_cart_items[ $product_id ]['quantity'] = $number;
                            $new_cart_items[ $product_id ]['warehouse_id'] = $product_info['warehouse_id'];
                        }
                        $cart_str = json_encode($new_cart_items);
                        set_encode_cookie('cart_items', $cart_str, 24 * 60 * 60);
                        echo '商品' . $product_info['name'] . '加入购物车成功';
                    }
                } else {
                    //用户登陆
                    $m_user_id = 1;
                    if (!empty($m_user_id)) {
                        //查询购物车表
                        $cart_goods = $this->Base_Cart_model->get_row('*', array('product_id' => $product_id));
                        if (!empty($cart_goods)) {
                            $cart_arr['product_id'] = $product_id; /* 下单商品id */
                            $cart_arr['quantity'] = $number + $cart_goods['quantity'];     /* 下单商品数量 */
                            $res = $this->Base_Cart_model->update($cart_arr, array('product_id' => $product_id, 'buyer_id' => $m_user_id));
                        } else {
                            //查询用户信息
                            $user_info = $this->Spuser_User_model->get_row('seller_userid', array('id' => $m_user_id));
                            $cart_arr = array();
                            $cart_arr['buyer_id'] = $m_user_id;                   /* 下单用户id */
                            $cart_arr['product_id'] = $product_id;                 /* 下单商品id */
                            $cart_arr['seller_id'] = $user_info['seller_userid'];/* 下单用户的上级 */
                            $cart_arr['price'] = $product_info['price'];    /* 下单商品价格 */
                            $cart_arr['quantity'] = $number;                  /* 下单商品数量 */
                            $cart_arr['create_time'] = dateformat(time());      /* 下单创建时间 */
                            $res = $this->Base_Cart_model->insert($cart_arr);
                        }
                        if ($res) {
                            echo '加入购物车成功';
                        } else {
                            echo '加入购物车失败';
                        }
                    }
                }


            }
        }

        public function cart_goods_num_change()
        {
            if (!empty($_POST)) {
                $user_login = $this->is_login();

                if ($user_login === FALSE) {

                    //用户未登陆
                    $num = $_POST['num'];
                    $product_id = $_POST['goods_id'];

                    $cart_item = get_decode_cookie('cart_items');
                    $cart_items = json_decode($cart_item, TRUE);

                    $new_cart_items = array();
                    foreach ($cart_items as $key => $val) {
                        $new_cart_items[ $key ] = $val;
                        if ($key == $product_id) {
                            $new_cart_items[ $key ]['quantity'] = $num;
                        }

                    }
                    $cart_str = json_encode($new_cart_items);
                    $cart_str = authcode($cart_str, 'ENCODE');
                    $msg = array(
                        'key'  => 'cart_items',
                        'msg'  => $cart_str,
                        'type' => 4,
                    );
                    echo json_encode($msg);
                    die;
                } else {
                    //用户登陆
                    $m_user_id = $user_login;
                    $num = $_POST['num'];
                    $product_id = $_POST['goods_id'];
                    $res = $this->Base_Cart_model->update(array('quantity' => $num), array('product_id' => $product_id, 'buyer_id' => $m_user_id));
                    if ($res) {
                        $msg = array(
                            'msg'  => '操作成功',
                            'type' => 3,
                        );
                        echo json_encode($msg);
                        die;
                    } else {
                        $msg = array(
                            'msg'  => '操作失败',
                            'type' => 1,
                        );
                        echo json_encode($msg);
                        die;
                    }

                }
            }
        }


        public function cart_goods_delete()
        {
            if (!empty($_POST)) {
                $user_login = $this->is_login();
                $product_id = $_POST['goods_id'];
                if ($user_login === FALSE) {
                    $cart_item = get_decode_cookie('cart_items');
                    $cart_item = json_decode($cart_item, TRUE);
                    $new_cart_item = array();
                    foreach ($cart_item as $key => $val) {
                        if ($key != $product_id) {
                            $new_cart_item[ $key ] = $val;
                        }
                    }

                    $cart_str = json_encode($new_cart_item);
                    $cart_str = authcode($cart_str, 'ENCODE');
                    $msg = array(
                        'key'  => 'cart_items',
                        'msg'  => $cart_str,
                        'type' => 4,
                    );
                    echo json_encode($msg);
                    die;
                } else {
                    //用户登陆
                    $m_user_id = $user_login;
                    $res = $this->Base_Cart_model->delete(array('product_id' => $product_id, 'buyer_id' => $m_user_id));
                    if ($res) {
                        $msg = array(
                            'msg'  => '操作成功',
                            'type' => 3,
                        );
                        echo json_encode($msg);
                        die;
                    } else {
                        $msg = array(
                            'msg'  => '操作失败',
                            'type' => 1,
                        );
                        echo json_encode($msg);
                        die;
                    }
                }
            }
        }


        /*确认订单页面*/
        public function confirm_order()
        {
            $user_id = $this->is_login();

            if ($user_id === FALSE) {
                header('Location:' . site_url('user/login'));
                die;
            } else {

                /**
                 * 用户登陆后
                 * 确认订单可以由两个页面跳转过来
                 * 1、立即购买            单个商品
                 * 2、购物车，立即购买      单个或多个商品
                 *
                 */

                //查询默认收货地址
                $this->load->model('Base_Address_model');
                $default_address = $this->Base_Address_model->get_row(array('userid' => $user_id, 'default' => 1));
                //查询要购买的商品
                $goods_arr = $_POST;
                $goods_order = array();
                foreach ($goods_arr as $k => $v) {
                    $goods_order[ $k ] = $this->Base_Product_model->get_row(array('id' => $k), '*');
                    $goods_order[ $k ]['qty'] = $v;
                }

                $new_goods_order = array();
                foreach ($goods_order as $k => $v) {
                    $new_goods_order[ $v['warehouse_id'] ][] = $v;
                }


                $new_goods_order1 = $this->process_order($new_goods_order);


                $this->ci_smarty->assign('default_address', $default_address);
                $this->ci_smarty->assign('goods_order', $new_goods_order1);
                $this->ci_smarty->assign('show_ajax', 2);
                $this->ci_smarty->assign('seo_title', '确认订单');
                $this->ci_smarty->display_ini('confirm_order.htm');
            }

        }


        /**
         * 下单操作
         */
        public function create_order()
        {
            if (!empty($_POST)) {

                $address_id = $_POST['address_id'];
                //查询默认收货地址
                $address_info = $this->_getAddressInfo($address_id);
                if (empty($address_info)) {
                    die('没有查找到该收货地址');
                }
                if ($address_info['userid'] != $this->user_id) {
                    die('请选择正确的收货地址');
                }

                $remark = $this->input->post('remark', TRUE);
                $order_list = array();
                foreach ($_POST['goods_id'] as $key => $val) {
                    foreach ($val as $k => $v) {
                        $order_list[ $key ][ $k ]['gooods_id'] = $v;
                        $product_info = $this->Base_Product_model->get_row(array('id' => $v), '*');
                        $order_list[ $key ][ $k ] = array_merge($order_list[ $key ][ $k ], $product_info);
                        $order_list[ $key ][ $k ]['qty'] = $_POST['quantity'][ $key ][ $k ];
                        $order_list[ $key ][ $k ]['total_price'] = $order_list[ $key ][ $k ]['qty'] * $order_list[ $key ][ $k ]['price'];
                        $order_list[ $key ][ $k ]['total_weight'] = $order_list[ $key ][ $k ]['qty'] * $order_list[ $key ][ $k ]['weight'];

                    }
                }

                $new_order_list = array();
                $a = 1;
                $successMark = TRUE;

                foreach ($order_list as $key => $val) {

                    //形成订单
                    $order_arr = array();
                    $order_arr['buyer_id'] = $this->user_id;
                    $order_arr['seller_id'] = 0;
                    $order_arr['consignee'] = $address_info['name'];
                    $order_arr['province_id'] = $address_info['provinceid'];
                    $order_arr['city_id'] = $address_info['cityid'];
                    $order_arr['area_id'] = $address_info['areaid'];
                    $order_arr['consignee_address'] = $address_info['area'] . $address_info['address'];
                    $order_arr['consignee_mobile'] = $address_info['mobile'];
                    $order_arr['product_price'] = $address_info['mobile'];
                    $order_arr['consignee_mobile'] = $address_info['mobile'];
                    $order_arr['order_id'] = date('Ymdhis', time()) . mt_rand(10000, 99999);
                    //订单详情
                    $total_weight = 0;
                    $cangku_total_weight = 0;
                    $total_price = 0;
                    $total_logistics_fee = 0;
                    $order_pro_arr = array();
                    foreach ($val as $k => $v) {
                        $new_order_list[ $key ][ $v['temp_id'] ][] = $v;
                        $total_weight += $v['total_weight'];
                        $total_price += $v['total_price'];
                        //形成订单详情
                        $order_pro_arr[ $a ]['product_id'] = $v['gooods_id'];
                        $order_pro_arr[ $a ]['userid'] = $this->user_id;
                        $order_pro_arr[ $a ]['name'] = $v['name'];
                        $order_pro_arr[ $a ]['price'] = $v['price'];
                        $order_pro_arr[ $a ]['weight'] = $v['weight'];
                        $order_pro_arr[ $a ]['num'] = $v['qty'];
                        $a++;
                    }
                    $cangku_total_weight += $total_weight;
                    $new_order_list[ $key ][ $v['temp_id'] ]['total_weight'] = $total_weight;
                    $new_order_list[ $key ][ $v['temp_id'] ]['total_logistics_fee'] = $this->count_logistics_fee($v['temp_id'], $total_weight);
                    $total_logistics_fee += $new_order_list[ $key ][ $v['temp_id'] ]['total_logistics_fee'];
                    $new_order_list[ $key ]['remark'] = $remark[ $key ][0];
                    $new_order_list[ $key ]['total_price'] = $total_price;
                    $new_order_list[ $key ]['total_logistics_fee'] = $total_logistics_fee;
                    $new_order_list[ $key ]['total_weight'] = $cangku_total_weight;

                    $order_arr['product_price'] = $new_order_list[ $key ]['total_price'];
                    $order_arr['logistics_price'] = $new_order_list[ $key ]['total_logistics_fee'];
                    $order_arr['status'] = 0;//待付款
                    $order_arr['des'] = $new_order_list[ $key ]['remark'];
                    $order_arr['create_time'] = dateformat(time());
                    $order_arr['weight'] = $new_order_list[ $key ]['total_weight'];

                    //model
                    $this->load->model('Base_Order_model');
                    if (!$this->Base_Order_model->addData($order_arr, $order_pro_arr, $this->user_id))
                        $successMark = FALSE;
                }
                if ($successMark) {
                    echo '下单成功';
                } else {
                    echo '下单失败';
                }

            }
        }

        /**
         * 查询单条收货地址信息
         * @param $addressId
         * @return mixed
         */
        private function _getAddressInfo($addressId)
        {
            if (empty($addressId)) {
                die('收货地址Id不能为空');
            }
            //查询默认收货地址
            $this->load->model('Base_Address_model');
            $address_info = $this->Base_Address_model->get_row(array('id' => $addressId));

            return $address_info;
            //查询要购买的商品
        }

        /*
         * 判断用户是否登录
         * 登录返回   用户id
         * 未登陆返回  FALSE
         */
        private function is_login()
        {
            if (empty($this->user_id))
                return FALSE;
            else
                return $this->user_id;
        }

        /**
         * 处理订单
         * 将订单处理成最终展示的形式
         */
        private function process_order($order)
        {
            if (!is_array($order)) {
                return FALSE;
            }
            //计算每个商品的运费
            $new_arr = array();
            foreach ($order as $k => $v) {
                $new_arr[ $k ] = $v;
                $weight = 0;
                $product_fee = 0;
                foreach ($v as $key => $val) {
                    $weight = $val['weight'] * $val['qty'];
                    $product_fee = $val['qty'] * $val['price'];
                    $new_arr[ $k ][ $key ]['product_fee'] = $product_fee;
                    $new_arr[ $k ][ $key ]['logistics_fee'] = $this->count_logistics_fee($val['temp_id'], $weight);
                }
            }
            //计算每个仓库订单的总运费
            $new_arr2 = array();
            foreach ($new_arr as $k => $v) {
                $new_arr2[ $k ] = $v;
                $new_arr2[ $k ]['total_logistics_fee'] = 0;
                $new_arr2[ $k ]['total_price'] = 0;
                foreach ($v as $key => $val) {
                    $new_arr2[ $k ]['total_price'] += $val['product_fee'];
                    $new_arr2[ $k ]['total_logistics_fee'] += $val['logistics_fee'];
                }
            }

            return $new_arr2;

        }


        /**
         * 查找运费id
         * @param $warehouse_id
         * @param $type
         * @param $city_id
         * @return mixed
         */
        private function search_temp_id($warehouse_id, $type, $city_id)
        {
            //model
            $this->load->model('Admin_Warehouse_model');
            $this->load->model('Base_Logistics_model');
            //首先确定发货的是哪个仓库,根据仓库查找运费模板(批发、零售)
            if ($type == 1) {//零售
                $field = 'logistics_temp_id_ls';
            } elseif ($type == 2) {//批发
                $field = 'logistics_temp_id';
            }
            $temp = $this->Admin_Warehouse_model->get_warehouse($warehouse_id, $field);

            $temp['id'] = $temp[ $field ];
            //根据运费模板id  查询相应城市的运费的运费模板
            $t = $this->Base_Logistics_model->get_con_row(array('temp_id' => $temp['id'], 'define_cityid' => $city_id));
            if (empty($t)) {
                return FALSE;
            }

            return $t['id'];
        }


        /**
         * 计算运费的方法
         * @param $temp_id
         * @param $weight
         * @return mixed
         */

        private function count_logistics_fee($temp_id, $weight)
        {
            //model
            $this->load->model('Base_Logistics_model');
            //首先要知道用的是哪个运费模板
            $logistics = $this->Base_Logistics_model->get_con_row(array('temp_id' => $temp_id));
            if (empty($logistics)) {
                log_message('info', $temp_id . '不存在对应的运费模板');

                return FALSE;
            }
            //运单重量,根据重量计算运费
            $log = array();
            if ($weight <= $logistics['default_num']) {
                $log['fee'] = $logistics['default_price'];
            } else {
                $log['fee'] = ceil(($weight - $logistics['default_num']) / $logistics['add_num']) * $logistics['add_price'] + $logistics['default_price'];
            }

            //返回运费
            return round($log['fee'], 2);
        }


    }
