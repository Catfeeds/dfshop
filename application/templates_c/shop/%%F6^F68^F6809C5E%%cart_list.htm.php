<?php /* Smarty version 2.6.20, created on 2017-07-19 16:09:20
         compiled from D:%5Cphpstudy%5CWWW%5Cdfshop%5Capplication%5Ctemplates/shop/cart_list.htm */ ?>

<link href="/static/wap/Cart/css/weixin.css" rel="stylesheet" type="text/css">
<link href="/static/wap/Cart/css/ionic.min.css" rel="stylesheet" type="text/css">
<link href="/static/wap/Cart/css/signin.css" rel="stylesheet" type="text/css">
<link href="/static/wap/Cart/css/share.css" rel="stylesheet" type="text/css">
<script src="/static/wap/Cart/js/jquery-1.10.2.js"></script>
<script src="/static/wap/Cart/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/wap/Cart/js/ionic.bundle.min.js"></script>
<script type="text/javascript" src="/static/wap/Cart/js/runend.js"></script>
<script type="text/javascript">
    //定义全局变量
    var i=0;
    //金额总和
    var money=0;
    //计算合计价格
    var cart_money=new Object();
    //全部商品ID
    var cart_id=new Object();
    //备份商品ID，用于全选后去掉全选又再次全选
    var cart_id_copy=new Object();

</script>
<body class="grade-a platform-browser platform-win32 platform-ready">
<div id="totop"><a></a></div>
<div class="header_box">
    <div class="bar bar-header">
        <a class="back" href="http://www.17sucai.com/preview/1/2017-07-13/cart/$!webPath/index"><button class="button button-icon icon ion-ios-arrow-left"></button></a>
        <div id="tite" class="h1 title" style=" width: 72%; margin: 0 auto; ">购物车</div>
        <a class="rig_shai" id="rem_s" href="javascript:void(0)" style="margin-right: 2%;position: absolute; top: 5px; right: 3%;">编辑</a>
    </div>
</div>
<div style="height:44px;"></div>

<form method="post" name="cart_form" target="_self" id="cart_form" action="http://www.17sucai.com/preview/1/2017-07-13/cart/index.html">
    <!--list-->
    <div class="commodity_list_box">
        <div class="cart_top">
            <span>商品清单</span>
            <!--<p id="weights">总重量约25kg</p>-->
            <!--<div class="clear"></div>-->
        </div>
        <!--商品列表-->
        <?php $_from = $this->_tpl_vars['cart_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <div class="commodity_box">
            <div class="commodity_list">
                <!--店名信息-->
                <div class="tite_tim select">
                    <em aem="1" cart_id="warehouse_<?php echo $this->_tpl_vars['key']; ?>
"></em>
                    <span>仓库号:<?php echo $this->_tpl_vars['key']; ?>
</span>
                    <div class="clear"></div>
                </div>
                <!--商品-->
                <ul class="commodity_list_term">
                    <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                    <li class="select">
                        <em aem="0" cart_id="product_<?php echo $this->_tpl_vars['i']['product_id']; ?>
"></em>
                        <img src="<?php echo $this->_tpl_vars['i']['product_info']['pic']; ?>
">
                        <div class="div_center">
                            <h4><?php echo $this->_tpl_vars['i']['product_info']['name']; ?>
</h4>
                            <span>50斤</span>
                            <p class="now_value"><i>￥</i><b class="qu_su"><?php echo $this->_tpl_vars['i']['product_info']['price']; ?>
</b></p>
                        </div>
                        <div class="div_right">
                            <i onclick="reducew(this)">-</i>
                            <span class="zi"><?php echo $this->_tpl_vars['i']['quantity']; ?>
</span>
                            <input type="hidden" value="<?php echo $this->_tpl_vars['i']['quantity']; ?>
">
                            <i onclick="plusw(this)">+</i>
                        </div>
                    </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
                <!--优惠信息-->
                <div class="shop_ul_bottom account_info_box">
                    <ul class="account_info">

                        <li class="i_text">
                            <span class="info_name xi_cu">包邮</span>
                            <span class="info_name">商家包邮</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <?php endforeach; endif; unset($_from); ?>
        <!-- 商品列表 end -->
    </div>
    <!-- end -->

    <!-- footer -->
    <div style="height:55px;"></div>
    <div class="settle_box">
        <dl class="all_check select">
            <dt><span id="all_pitch_on"></span><em>全选</em></dt>
        </dl>
        <dl class="total_amount">
            <dt>合计：<p id="total_price">¥<b>0</b></p></dt>
            <dd>不含运费</dd>
        </dl>
        <input type="hidden" name="gcs" id="gcs">
        <a class="settle_btn" href="javascript:void(0);" id="confirm_cart">结算</a>
        <a class="settle_btn" href="javascript:void(0);" id="confirm_cart1" onclick="big_cart_remove()">删除</a>
    </div>
    <!-- end -->
</form>

<script>
    var noX = 0;  /* 没选中时点击加减计算数量  */
    var allThis = $(".commodity_box .select em"); /*底部全选*/
    /* 减  */
    function reduceMod(e,totalH,mod,noX){
        var tn = e.siblings().find(".qu_su").text(); /* 当前选中商品  */
        var tn1 = e.siblings().find(".zi").text(); /* 商品数量  */
        if(mod != 2){
            var Total = parseFloat(totalH) - (tn*tn1);	/* 总价格减该商品总数价格  */
            $("#total_price b").text(Total.toFixed(2));
        }else{
            /* 合计加单价-1 */
            var Total = parseFloat(totalH) - parseFloat(tn);	/* 总价格减该商品总数价格  */
            $("#total_price b").text(Total.toFixed(2));
        }

    };
    /* 加  */
    function plusMod(e,totalH,mod){
        var tn = e.siblings().find(".qu_su").text(); /* 当前选中商品  */
        var tn1 = e.siblings().find(".zi").text();   /* 商品数量  */
        if(mod != 2){
            var Total = parseFloat(totalH)+(tn*tn1);	/* 总价格加上该商品总数价格  */
            $("#total_price b").text(Total.toFixed(2));
        }else{
            /* 合计加单价+1 */
            var Total = parseFloat(totalH)+(parseFloat(tn)+(noX-1));	/* 总价格加上该商品总数价格  */
            $("#total_price b").text(Total.toFixed(2));
        }

    };
    /*全选该店商品价格 加*/
    function commodityPlusMod(e,totalH){
        var qu = e.parents(".commodity_list").find(".pitch_on").parent().find(".qu_su");
        var quj = e.parents(".commodity_list").find(".pitch_on").parent().find(".zi");
        var Total = 0;
        var erTotal = true;
        /* 该商品全部金额  */
        for(var i=0; i<qu.length; i++)
        {
            var n = qu.eq(i).text();
            var n1 = quj.eq(i).text();
            /*合计价格*/
            if(erTotal){
                Total = parseFloat(totalH) +(parseFloat(n)*parseFloat(n1));
                if(Total < 0)
                    Total=0;
                erTotal = false;
            }else{
                Total = parseFloat(Total) + (parseFloat(n)*parseFloat(n1));
                if(Total < 0)
                    Total=0;
            }
        }
        $("#total_price b").text(Total.toFixed(2)); /* 合计金额  */
    };
    var plus;
    /*全选该店商品价格 减*/
    function commodityReduceMod(e,totalH){
        /*商品价格*/
        var qu = e.parents(".commodity_list").find(".pitch_on").parent().find(".qu_su");
        /*商品数量*/
        var quj = e.parents(".commodity_list").find(".pitch_on").parent().find(".zi");
        var Total = 0;

        var erTotal = true;
        /* 该商品全部金额  */
        for(var i=0; i<qu.length; i++)
        {
            var n = qu.eq(i).text();
            var n1 = quj.eq(i).text();
            /*合计价格*/
            if(erTotal){
                Total = parseFloat(totalH) - (parseFloat(n)*parseFloat(n1));
                plus  = parseFloat(n)*parseFloat(n1);
                if(Total < 0)
                    Total=0;
                erTotal = false;
            }else{
                Total = parseFloat(Total) - (parseFloat(n)*parseFloat(n1));
                plus = parseFloat(n)*parseFloat(n1);
                if(Total < 0)
                    Total=0;
            }
            $("#total_price b").text(Total.toFixed(2)); /* 合计金额  */
        }
        return plus;
    };
    /*全部商品价格*/
    function commodityWhole() {
        /* 合计金额  */
        var je = $(".commodity_box .select .qu_su"); /* 全部商品单价  */
        var je1 = $(".commodity_box .select .zi");  /* 全部商品数量  */
        var TotalJe = 0;
        for(var i=0; i<je.length; i++)
        {
            var n = je.eq(i).text();
            var n1 = je1.eq(i).text();
            TotalJe = TotalJe + (parseFloat(n)*parseFloat(n1));

        }
        $("#total_price b").text(TotalJe.toFixed(2)); /* 合计金额  */
    };

    //选择结算商品

    $(".select em").click(function(){
        var su = $(this).attr("aem");
        var carts_id=$(this).attr("cart_id");
        var totalH = $("#total_price b").text(); /* 合计金额  */
        if(su == 0){
            /* 单选商品  */
            if($(this).hasClass("pitch_on")){
                /*去该店全选*/
                $(this).parents("ul").siblings(".select").find("em").removeClass("pitch_on");
                /*去底部全选*/
                $("#all_pitch_on").removeClass("pitch_on");
                $(this).removeClass("pitch_on");
                reduceMod($(this),totalH,0,noX);
                cart_id[carts_id]="";
                delete cart_id[carts_id];
            }else{
                $(this).addClass("pitch_on");
                var n = $(this).parents("ul").children().find(".pitch_on");
                var n1 = $(this).parents("ul").children();
                plusMod($(this),totalH,0,noX);
                cart_id[carts_id]="";
                /*该店商品全选中时*/
                if(n.length == n1.length){
                    $(this).parents("ul").siblings(".select").find("em").addClass("pitch_on");
                }
                /*商品全部选中时*/
                var fot = $(".commodity_list_box .tite_tim .pitch_on");
                var fot1 = $(".commodity_list_box .tite_tim em");
                if(fot.length == fot1.length)
                    $("#all_pitch_on").addClass("pitch_on");
            }
        }else{
            /* 全选该店铺  */
            if($(this).hasClass("pitch_on")){
                /*去底部全选*/
                $("#all_pitch_on").removeClass("pitch_on");
                $(this).removeClass("pitch_on");
                commodityReduceMod($(this),totalH);
                $(this).parent().siblings("ul").find("em").removeClass("pitch_on");
                delete cart_id[carts_id];
            }else{

              //  commodityReduceMod($(this),totalH);
                $(this).addClass("pitch_on");

                $(this).parent().siblings("ul").find("em").addClass("pitch_on");

//                if(plus != NaN && plus != undefined){
//                    totalH = parseFloat(totalH)-parseFloat(plus);
//                }

                commodityPlusMod($(this),totalH);
                cart_id[carts_id]="";
                /*商品全部选中时*/
                var fot = $(".commodity_list_box .tite_tim .pitch_on");
                var fot1 = $(".commodity_list_box .tite_tim em");
                if(fot.length == fot1.length)
                    $("#all_pitch_on").addClass("pitch_on");

            }
        }

        //计算选择数值
        // number();

    });
    /* 底部全选  */

    var bot = 0;
    $("#all_pitch_on").click(function(){
        if(bot == 0){
            $(this).addClass("pitch_on");
            allThis.removeClass("pitch_on");
            allThis.addClass("pitch_on");
            /*总价格*/
            commodityWhole();
            bot = 1;
            //重新加入属性对象
            for(var key in cart_id_copy){
                cart_id[key]="";
            }
        }else{
            $(this).removeClass("pitch_on");
            allThis.removeClass("pitch_on");
            $("#total_price b").text("0");
            bot = 0;
            //移除全部对象
            for(var key in cart_id){
                delete cart_id[key];
            }
        }
        //计算选择数值
        number();
    });

    function number() {
        var num=0;
        for(var key in cart_id){
            num++;
        }
        //将选择的放入到计算里面
       // $("#confirm_cart").html("结算("+num+")");
    }

    /* 编辑商品  */
    var topb = 0;
    $("#rem_s").click(function(){
        if(topb == 0){
            $(this).text("完成");
            $(".total_amount").hide(); /* 合计  */
            $("#confirm_cart").hide(); /* 结算  */
            $("#confirm_cart1").show(); /* 删除 */
            topb = 1;
        }else{
            topb = 0;
            $(this).text("编辑");
            $(".total_amount").show(); /* 合计  */
            $("#confirm_cart").show(); /* 结算  */
            $("#confirm_cart1").hide(); /* 删除 */
            allThis.removeClass("pitch_on"); /* 取消所有选择  */
            $("#all_pitch_on").removeClass("pitch_on"); /* 取消所有选择  */
            $("#total_price b").text("0"); /*合计价格清零*/
        }

    });
    /* 加减  */

    function reducew(obj){
        //减
        var $this = $(obj);
        var totalH = $("#total_price b").text(); /* 合计金额  */
        var ise = $this.siblings("span").text();
        var gc_id = $this.siblings("input").val();
        if(noX <= 0){
            noX = 0;
        }else{
            noX--;
        };

        if(parseInt(ise) <= 1){
            $this.siblings("span").text("1");
        }else{
            var n =parseInt(ise)-1;
            $this.siblings("span").text(n);
            if($this.parent().parent().children("em").hasClass("pitch_on")){
                var mo = $this.parent().parent().children("em");
                reduceMod(mo,totalH,2,noX);
                noX=0;
            }

        }

        //goods_count_adjust(gc_id,n,null);
    };

    function plusw(obj){
        //加
        var $this = $(obj);
        var totalH = $("#total_price b").text(); /* 合计金额 */
        var ise = $this.siblings("span").text(); /* 商品数量 */
        var gc_id = $this.siblings("input").val();
        var n =parseInt(ise)+1;
        noX++;

        $this.siblings("span").text(n);
        /*商品被选中时*/
        if($this.parent().parent().children("em").hasClass("pitch_on")){
            var mo = $this.parent().parent().children("em");
            plusMod(mo,totalH,2,noX);
            noX=0;
        }

        //goods_count_adjust(gc_id,n,null);
    }


    //删除
    function big_cart_remove(){
        $(".commodity_list_term .pitch_on").parent().remove();
        $(".commodity_list .tite_tim > em.pitch_on").parents(".commodity_box").remove();
    }

</script>

</body></html>