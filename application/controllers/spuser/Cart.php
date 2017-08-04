<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

    public function __construct(){
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

        $user_login=$this->is_login();
        if($user_login===FALSE)
        { //用户未登陆
           //获取cookie购物车信息

            $cart_item=get_decode_cookie('cart_items');
            $cart_item=json_decode($cart_item,TRUE);
            foreach (  $cart_item as $k=>$v )
            {
                $cart_item[$k]['product_info']=$this->Base_Product_model->get_row(array('id'=>$v['id']),'*');
            }
            $new_cart_list=array();
            foreach (  $cart_item as $k=>$v)
            {
                $new_cart_list[$v['product_info']['warehouse_id']][]=$v;
            }
        }else {
            //用户登陆
            $m_user_id=$user_login;
            $cart_list=$this->Base_Cart_model->get_list(array('buyer_id'=>$m_user_id),'*');
            foreach ( $cart_list as $k=>$v )
            {
                $cart_list[$k]['product_info']=$this->Base_Product_model->get_row(array('id'=>$v['product_id']),'*');
            }
            echo '<pre>';
            //print_r($cart_list);
            //按仓库号分类后的购物车列表
            $new_cart_list=array();
            foreach ( $cart_list as $k=>$v)
            {
                $new_cart_list[$v['product_info']['warehouse_id']][]=$v;
            }
            print_r($new_cart_list);
        }
        $this->ci_smarty->assign('cart_list',$new_cart_list);
        $this->ci_smarty->assign('show_ajax',1);
        $this->ci_smarty->display_ini('cart_list.htm');
    }


    /**
     * 加入购物车
     */
    public function insert_cart()
    {
        if(!empty($_GET))
        {
            $product_id = $_GET['id'];
            $number     = (isset($_GET['num']))?$_GET['num']:1;
            //查询商品信息
            $product_info=$this->Base_Product_model->get_row(array('id'=>$product_id),'price,name,warehouse_id');
            //如果用户登陆
            $user_login=$this->is_login();
            if($user_login===FALSE)
            {//用户未登陆
                //先查看cookie
                $cart_items=get_decode_cookie("cart_items");
                if(empty($cart_items))
                {
                    $cart_items=array();
                    $cart_items[$product_id]=array();
                    $cart_items[$product_id]['id']=$product_id;
                    $cart_items[$product_id]['price']=$product_info['price'];
                    $cart_items[$product_id]['name']=$product_info['name'];
                    $cart_items[$product_id]['quantity']=$number;
                    $cart_items[$product_id]['warehouse_id']=$product_info['warehouse_id'];
                    $cart_str=json_encode($cart_items);
                    set_encode_cookie('cart_items',$cart_str,24*60*60);
                    echo '商品'.$product_info['name'].'加入购物车成功';
                }
                else
                {
                    $cart_items=json_decode($cart_items,true);
                    $items_exists=false;
                    $new_cart_items=array();
                    foreach ($cart_items as $key=>$val)
                    {
                        $new_cart_items[$key]=$val;
                        if($key==$product_id)
                        {
                            $new_cart_items[$key]['quantity']=$val['quantity']+$number;
                            $items_exists=true;
                        }
                    }
                    if($items_exists===false)
                    {
                        $new_cart_items[$product_id]=array();
                        $new_cart_items[$product_id]['id']=$product_id;
                        $new_cart_items[$product_id]['price']=$product_info['price'];
                        $new_cart_items[$product_id]['name']=$product_info['name'];
                        $new_cart_items[$product_id]['quantity']=$number;
                        $new_cart_items[$product_id]['warehouse_id']=$product_info['warehouse_id'];
                    }
                    $cart_str=json_encode(  $new_cart_items);
                    set_encode_cookie('cart_items',$cart_str,24*60*60);
                    echo '商品'.$product_info['name'].'加入购物车成功';
                }
            }
            else
            {
             //用户登陆
                $m_user_id=1;
                if(!empty($m_user_id))
                {
                    //查询购物车表
                    $cart_goods=$this->Base_Cart_model->get_row(array('product_id'=>$product_id));
                    if(!empty($cart_goods))
                    {
                        $cart_arr['product_id']  = $product_id; /* 下单商品id */
                        $cart_arr['quantity']    = $number+$cart_goods['quantity'];     /* 下单商品数量 */
                        $res=$this->Base_Cart_model->update($cart_arr,array('product_id'=>$product_id,'buyer_id'=>$m_user_id));
                    }
                    else
                    {
                        //查询用户信息
                        $user_info=$this->Spuser_User_model->get_row('seller_userid',array('id'=>$m_user_id));
                        $cart_arr=array();
                        $cart_arr['buyer_id']    = $m_user_id;                   /* 下单用户id */
                        $cart_arr['product_id']  = $product_id;                 /* 下单商品id */
                        $cart_arr['seller_id']   = $user_info['seller_userid'];/* 下单用户的上级 */
                        $cart_arr['price']       = $product_info['price'];    /* 下单商品价格 */
                        $cart_arr['quantity']    = $number;                  /* 下单商品数量 */
                        $cart_arr['create_time'] = dateformat(time());      /* 下单创建时间 */
                        $res=$this->Base_Cart_model->insert($cart_arr);
                    }
                    if($res)
                    {
                        echo '加入购物车成功';
                    }
                    else
                    {
                        echo '加入购物车失败';
                    }
                }
            }
           
           
        }
    }
    public function cart_goods_num_change()
    {
        if(!empty($_POST))
        {
            $user_login=$this->is_login();

            if($user_login===FALSE)
            {

                //用户未登陆
                $num        = $_POST['num'];
                $product_id = $_POST['goods_id'];

                $cart_item=get_decode_cookie('cart_items');
                $cart_items=json_decode($cart_item,true);

                $new_cart_items=array();
                foreach ($cart_items as $key=>$val)
                {
                    $new_cart_items[$key]=$val;
                    if($key==$product_id)
                    {
                        $new_cart_items[$key]['quantity']=$num;
                    }

                }
                $cart_str=json_encode(  $new_cart_items);
                $cart_str=authcode($cart_str,'ENCODE');
                $msg = array(
                    'key'=>'cart_items',
                    'msg'  => $cart_str,
                    'type' => 4,
                );
                echo json_encode($msg);
                die;
            }
            else
            {
                //用户登陆
                $num        = $_POST['num'];
                $product_id = $_POST['goods_id'];
                $res=$this->Base_Cart_model->update(array('quantity'=>$num),array('product_id'=>$product_id,'buyer_id'=>$m_user_id));
                if($res)
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
        if(!empty($_POST))
        {
            $user_login=$this->is_login();
            $product_id = $_POST['goods_id'];
            if($user_login===FALSE)
            {
                $cart_item=get_decode_cookie('cart_items');
                $cart_item=json_decode($cart_item,TRUE);
                $new_cart_item=array();
                foreach ($cart_item as $key=>$val)
                {
                    if($key!=$product_id)
                    {
                        $new_cart_item[$key]=$val;   
                    }
                }

                $cart_str=json_encode(  $new_cart_item);
                $cart_str=authcode($cart_str,'ENCODE');
                $msg = array(
                    'key'=>'cart_items',
                    'msg'  => $cart_str,
                    'type' => 4,
                );
                echo json_encode($msg);
                die;
            }
            else
            {
                //用户登陆
                $m_user_id=$user_login;
                $res=$this->Base_Cart_model->delete(array('product_id'=>$product_id,'buyer_id'=>$m_user_id));
                if($res)
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
                        'type' => 1,
                    );
                    echo json_encode($msg);
                    die;
                }
            }
        }
    }

    /*确认订单*/
    public function confirm_order()
    {
        //



        $this->ci_smarty->assign('show_ajax',1);
        $this->ci_smarty->assign('seo_title', '确认订单');
        $this->ci_smarty->display('confirm_order.htm');
    }

    /*
     * 判断用户是否登录
     * 登录返回   用户id
     * 未登陆返回  FALSE
     */
    private function is_login()
    {
        if(empty($this->user_id))
           return FALSE;
        else
            return $this->user_id;
    }


}
