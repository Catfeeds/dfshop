<?php /* Smarty version 2.6.20, created on 2017-09-12 11:26:22
         compiled from order_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'f_get_status', 'order_list.htm', 87, false),array('modifier', 'site_url', 'order_list.htm', 138, false),)), $this); ?>
<body class="page-header-fixed page-boxed">
<link href="/static/css/search.css" rel="stylesheet" type="text/css"/>
<style>
    .orderinfo, .orderbox .orderlist .orderimg {
        position: relative;
        font-size: 14px;
        background-color: #fff;
        padding: 10px;
        border-bottom: 1px solid #EEEEEE;
    }
     .orderinfo .price {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 16px;
        color: #ff223e;
        font-family: "Arial", "Microsoft YaHei", "Tahoma";
    }
    .orderbox .orderlist .orderimg {
        font-size: 12px;
    }
    .orderbox .orderlist .orderimg img {
        position: absolute;
        width: 60px;
        height: 60px;
    }
    img {
        border: none;
    }
    .orderinfo p{
        margin:0;
    }
    .orderbox .orderlist .orderimg .orderimginfo {
        margin-left: 70px;
        min-height: 55px;
        margin-top: 5px;
    }

    .fwnormal {
        font-weight: normal;
    }
    label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 700;
    }
    .fl {
        float: left;
    }

</style>
<div class="container">
    <div class="widget-bg-color-white widget-tab">
        <ul class="nav nav-tabs">
            <li  <?php if ($this->_tpl_vars['order_status'] == 'order_all'): ?> class="active"<?php endif; ?>>
                <a   id="order_all" data-toggle="tab">全部订单</a>
            </li>
            <li <?php if ($this->_tpl_vars['order_status'] == 'order_pre_pay'): ?> class="active"<?php endif; ?>>
                <a  id="order_pre_pay" data-toggle="tab">待付款</a>
            </li>
            <li <?php if ($this->_tpl_vars['order_status'] == 'order_pre_delivery'): ?> class="active"<?php endif; ?>>
                <a  id="order_pre_delivery" data-toggle="tab">待发货 </a>
            </li>
            <li <?php if ($this->_tpl_vars['order_status'] == 'order_pre_receive'): ?> class="active"<?php endif; ?>>
                <a id="order_pre_receive" data-toggle="tab">待收货</a>
            </li>
        </ul>
        <div class="tab-content scroller"  data-always-visible="1" data-handle-color="#D7DCE2">
            <div class="tab-pane fade active in orderbox" id="tab_1_1">
                <!--<div style="margin: 2px 8px; display: block;" class="batchoperator">-->
                    <!--<label class="fwnormal" style="font-size: 12px">-->
                        <!--<input type="checkbox" style="margin: 0;" id="cbSelectAll"> 全选-->
                    <!--</label>-->
                    <!--<span style=" display:inline-block;float:right">-->
                        <!--<input id="btnCombine" style="display:none" type="button" value="合并付款" class="btn btn-primary btn-xs">-->
                        <!--<input id="btnCancel" type="button" value="批量取消订单" class="btn disable mini">-->
                    <!--</span>-->
                <!--</div>-->
                <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                <div class="orderlist" style="margin-top: 10px">
                    <div class="orderinfo" style="font-size:12px;">
                        <p>订单编号：<?php echo $this->_tpl_vars['v']['order_id']; ?>
</p>
                        <p>下单日期：<?php echo $this->_tpl_vars['v']['create_time']; ?>
</p>
                        <p>订单货值：<?php echo $this->_tpl_vars['v']['product_price']; ?>
</p>
                        <p>订单运费：<?php echo $this->_tpl_vars['v']['logistics_price']; ?>
</p>
                        <p>订单状态：<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['status'])) ? $this->_run_mod_handler('f_get_status', true, $_tmp) : f_get_status($_tmp)); ?>
</p>
                        <p style="display:none">
                            审核进度：
                            <span style="color:Green">审核中</span>
                            <span style="display:none">→ 已审核</span>
                            <span style="display:none">→ 申报中</span>
                            <span style="display:none">→ 海关审核中</span>
                            <span style="display:none">→已作废</span>
                        </p>
                        <span class="price">￥<em><?php echo $this->_tpl_vars['v']['product_price']+$this->_tpl_vars['v']['logistics_price']; ?>
</em></span>
                    </div>
                    <?php $_from = $this->_tpl_vars['v']['orderProList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['i']):
?>
                    <div class="orderimg">
                        <img id="vMemberOrders_rptOrders_ctl00_ctl00_rporderitems_ctl00_ListImage1" src="<?php echo $this->_tpl_vars['i']['img']; ?>
" style="border-width:0px;width=30px;height: 30px;">
                        <div class="orderimginfo">
                            <a href="#">
                                <div class="name bcolor">
                                    <?php echo $this->_tpl_vars['i']['name']; ?>

                                </div>
                            </a>
                            <div class="specification"></div>
                            <div class="orderreturn">
                                数量：<i><?php echo $this->_tpl_vars['i']['num']; ?>
</i> &nbsp;&nbsp;单价：<i><?php echo $this->_tpl_vars['i']['price']; ?>
元</i>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; unset($_from); ?>
                    <div class="linkbtn" style="height: 36px;">
                        <?php if ($this->_tpl_vars['v']['status'] == 0): ?>
                        <!--<span class="fl" style="margin: 10px 0px 0px 10px;">-->
                            <!--<label class="fwnormal batchoperator" style="display: inline-block; font-size: 12px;">-->
                            <!--<input name="cbox" type="checkbox" style="margin: 0;" value="201707263159969"> 选中订单-->
                            <!--</label>-->
                        <!--</span>-->
                        <a class="btn disable mini" style="float: right;margin:10px 10px 0px 0px;" onclick="cancel_order(<?php echo $this->_tpl_vars['v']['id']; ?>
,<?php echo $this->_tpl_vars['v']['order_id']; ?>
)">取消订单</a>
                        <a href="#" style="float: right;margin:10px 10px 0px 0px;"  class="btn mini red" onclick="pay_order(<?php echo $this->_tpl_vars['v']['id']; ?>
,<?php echo $this->_tpl_vars['v']['order_id']; ?>
)">去付款</a>
                        <?php endif; ?>
                    </div>
                </div>
                <hr>
                <hr>
                <?php endforeach; endif; unset($_from); ?>
                <div class="span6">
                    <div class="dataTables_paginate paging_bootstrap pagination"> <?php echo $this->_tpl_vars['re']['page']; ?>
 </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#order_all').click(function(){
        location.href="<?php echo ((is_array($_tmp='order/order_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?status=order_all";
    })
    $('#order_pre_pay').click(function(){
        location.href="<?php echo ((is_array($_tmp='order/order_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?status=order_pre_pay";
    })
    $('#order_pre_delivery').click(function(){
        location.href="<?php echo ((is_array($_tmp='order/order_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?status=order_pre_delivery";
    })
    $('#order_pre_receive').click(function(){
        location.href="<?php echo ((is_array($_tmp='order/order_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?status=order_pre_receive";
    })
    /**
     *  取消订单
     * @param orderId
     * @param orderNo
     */
    var cancel_order=function(orderId,orderNo)
    {
        modal_confirm('您确定要取消该订单'+orderNo+'?',function(){
            var url="<?php echo ((is_array($_tmp='order/order_cancel')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?orderId="+orderId;
            $.get(url,function(msg){
                try
                {
                    eval("var str="+msg);
                    //操作成功
                    if(str.type==1)
                    {

                    }
                    else if(str.type==2)
                    {
                        window.location='';
                    }
                    else if(str.type==3)
                    {
                        window.location='';
                    }
                    setTimeout(function(){modal_msg(str.msg);},300);
                }catch(e){
                    // alert(msg);
                    $('body').modalmanager('removeLoading');
                    setTimeout(function(){modal_msg('系统异常');},300);
                };
            });
        })
    }

    var pay_order=function(orderId,orderNo)
    {
        modal_confirm('您确定要支付订单'+orderNo+'?',function(){
            var url="<?php echo ((is_array($_tmp='order/pay_order')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?orderId="+orderId;
            $.get(url,function(msg){
                try
                {
                    eval("var str="+msg);
                    //操作成功
                    if(str.type==1)
                    {

                    }
                    else if(str.type==2)
                    {
                        window.location='';
                    }
                    else if(str.type==3)
                    {
                        window.location='';
                    }
                    setTimeout(function(){modal_msg(str.msg);},300);
                }catch(e){
                    // alert(msg);
                    $('body').modalmanager('removeLoading');
                    setTimeout(function(){modal_msg('系统异常');},300);
                };
            });
        })
    }

</script>

</body>