<?php /* Smarty version 2.6.20, created on 2017-08-04 10:16:10
         compiled from info.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'info.htm', 100, false),)), $this); ?>

<style>
/* CSS Document */
body, h1, h2, h3, h4, h5, h6, hr, p , a , blockquote, /* structural elements 缁撴瀯鍏冪礌 */
ul, ol, li, /* list elements 鍒楄〃鍏冪礌 */
pre, /* text formatting elements 鏂囨湰鏍煎紡鍏冪礌 */
fieldset, lengend, button, input, textarea, /* form elements 琛ㄥ崟鍏冪礌 */
th, td { /* table elements 琛ㄦ牸鍏冪礌 */
    margin: 0;
    padding: 0;
}
h1,h2,h3,h4,h5,h6{font-weight: normal;font-family: "microsoft yahei";}
h1 { font-size: 18px; /* 18px / 12px = 1.5 */ }
h2 { font-size: 16px; }
h3 { font-size: 14px; }
h4, h5, h6 { font-size: 100%; }

/* 閲嶇疆鍒楄〃鍏冪礌 */
ul, ol { list-style: none; }

/* 閲嶇疆鏂囨湰鏍煎紡鍏冪礌 */
a,button{ text-decoration: none; cursor:pointer; outline:none;color: #666;}
a:link {outline:none;}		/* 鏈闂殑閾炬帴 */
a:visited {outline:none;}	/* 宸茶闂殑閾炬帴 */
a:hover {text-decoration: none;}	/* 榧犳爣绉诲姩鍒伴摼鎺ヤ笂 */
a:active {outline:none;}	/* 閫夊畾鐨勯摼鎺� */

img { border: none; } /* img 鎼溅锛氳閾炬帴閲岀殑 img 鏃犺竟妗� */
/* 娉細optgroup 鏃犳硶鎵舵 */
button, input, select, textarea {
    font-size: 100%; /* 浣垮緱琛ㄥ崟鍏冪礌鍦� ie 涓嬭兘缁ф壙瀛椾綋澶у皬 */
}
address, cite, dfn, em, var { font-style: normal; } /* 灏嗘枩浣撴壎姝� */

/* 閲嶇疆琛ㄦ牸鍏冪礌 */
table {
	border-collapse: collapse;
	border-spacing: 0;
}

/* 璁╅潪ie娴忚鍣ㄩ粯璁や篃鏄剧ず鍨傜洿婊氬姩鏉★紝闃叉鍥犳粴鍔ㄦ潯寮曡捣鐨勯棯鐑� */
input{outline:none;}

body{font-size:12px; word-wrap:break-word;font-family:12px/150% Arial,Verdana,"\5b8b\4f53";overflow-x:hidden; }
textarea,input,select{font-family:"Hiragino Sans GB","Microsoft YaHei","寰蒋闆呴粦",tahoma,arial,simsun,"瀹嬩綋";font-size:12px;}
.clearfix:after{content:"";clear:both;display:block;height:0;}
.clearfix{zoom:1;}
.fl{float: left;}
.fr{float: right;}
.container{max-width: 640px;min-height: 100%; padding: 0;background-color: #F5F5F5;overflow: hidden;}
header{background: #ff5000;padding-top: 20px;}
.usernameimginfo{position: relative; height:80px;overflow: hidden;margin-bottom: 10px; color: #fff;}
.usernameimginfo .usernameimg{position:absolute;left: 10px;top: 0; padding: 4px;border:1px solid #fff; border-radius: 50%;}
.usernameimginfo .usernameimg img{display: block;width: 70px;border-radius: 50%;}
.usernameimginfo .usernameinfo{display: table; height: 80px;margin-left: 100px;}
.usernameimginfo .usernameinfo .usernamecontent{display: table-cell;vertical-align: middle;}
.usernameimginfo .usernameinfo .usernamecontent .username{font-size: 16px;margin-bottom: 5px;}
.usernameimginfo .usernameinfo .usernamecontent .integralsign{height: 16px;line-height: 16px;padding-left: 0px;}
.usernamecontent .integralsign .integral{font-size: 14px;}
.usernamecontent .integralsign .sign{padding: 1px 3px;background-color: #fff;color: #DF011B;border-radius: 2px;margin-left: 10px;}

header nav ul li{float: left;width: 50%;padding-bottom: 5px;}
header nav ul li.active{border-bottom: 2px solid #DBDBDB;}
header nav ul li a{display: block;text-align: center;color: #fff;font-size: 14px;text-shadow:0 0 0 #fff;}
header nav ul li a:link{color: #fff;}
.navlist{background-color: #fff;padding: 10px 0;margin-bottom: 10px;box-shadow: 0 1px 1px #888A8B;}
.navlist ul li{float: left;width: 20%;text-align: center;}
.navlist ul li a span{position: relative;display: inline-block; margin-bottom: 3px;}
.navgtionList ul{overflow: hidden;}
.navgtionList ul{margin-bottom: 10px;border-top: 1px solid #EBEBEB;border-bottom: 1px solid #D2D2D2; box-shadow: 0 1px 1px #DFDFDF;}
.navgtionList ul li{height: 40px;line-height: 40px;background-color: #fff;position: relative;border-top: 1px solid #DBDBDB;margin-top: -1px;}
.navgtionList ul li a{display: block;padding-left: 20px; width: 100%;height: 100%;}
.navgtionList ul li a span{display: inline-block;width: 25px;height: 25px;vertical-align: middle;}
.navgtionList ul li a span img{display: block;}
.navgtionList ul li a strong{font-weight: 500;font-size: 14px;color: #2F2F2F;margin-left: 10px;}
.navgtionList ul li a span.number{display: inline-block;float: right; width: auto; height: 20px;line-height: 20px; margin: 10px 10% 0 0; padding: 0 10px;border-radius: 10px;border:1px solid #CC3300;color:#CC3300; }
.navgtionList ul li .glyphicon{position: absolute;top: 11px;right: 10px;font-size: 18px;color: #232323;font-weight: normal;}
.navlist ul li a .message{position:absolute;right:-3px;top:-3px; display:block; width:7px;height:7px;background-color:red;border-radius:50%;}
.distribution.navlist ul li{width: 33.33333%;color: #5F5F5F;}
.distribution.navlist ul li span{color: #2F2F2F;font: 16px/150% Arial,Verdana,"\5b8b\4f53";}


</style>
<div class="container">
  <header>
    <div class="usernameimginfo">
      <div class="usernameimg" onclick="window.location.href = '#'"> <img id="vMemberCenter_image" src="<?php echo $this->_tpl_vars['user']['pic']; ?>
" style="height:60px;width:60px;border-width:0px;"> </div>
      <div class="usernameinfo">
        <div class="usernamecontent">
          <p class="username"><?php echo $this->_tpl_vars['user']['name']; ?>
　普通会员</p>
          <p class="integralsign"> 积分：<span class="integral" id="pointAdd">0</span>&nbsp;&nbsp;&nbsp;&nbsp; <span class="sign" id="signDay">会员签到</span> </p>
          <p class="integralsign" style="margin-top:3px"> 消费：<span class="integral">￥0.00</span>&nbsp;&nbsp;&nbsp; </p>
          <input name="vMemberCenter$IsSign" type="hidden" id="vMemberCenter_IsSign" value="0">
        </div>
      </div>
      <a class="my-message" href="notice.aspx"><!--<i></i>--></a> </div>
  </header>
  <div class="navgtionList">
    <ul style="margin-bottom:2px;">
      <li> <a href="<?php echo ((is_array($_tmp='order/order_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"> <span><img src="/templates/common/images/iconfont-wodeqianbao.png"></span> <strong>我的订单</strong> </a> <span class="glyphicon glyphicon-menu-right"></span> </li>
    </ul>
  </div>
  <div class="navlist">
    <nav>
      <ul class="clearfix">
        <li> <a href="/Myshop/MemberOrders.aspx?status=1"> <span class="waitspan"> <img src="/templates/common/images/dingdan.png"> </span>
          <p>待付款</p>
          </a> </li>
        <li> <a href="/Myshop/MemberOrders.aspx?status=2"> <span class="waitspan"><img src="/templates/common/images/iconfont-daifukuan.png"></span>
          <p>待发货</p>
          </a> </li>
        <li> <a href="/Myshop/MemberOrders.aspx?status=3"> <span class="waitspan"><img src="/templates/common/images/iconfont-daifahuo.png"></span>
          <p>待收货</p>
          </a> </li>
        <li> <a href="/ProgressCheck.aspx"> <span class="waitspan"><img src="/templates/common/images/iconfont-untitled5.png"></span>
          <p>退换货</p>
          </a> </li>
        <li> <a href="/Myshop/MemberComment.aspx"> <span class="waitspan"><img src="/templates/common/images/iconfont-wodedingdan13.png"></span>
          <p>待评价</p>
          </a> </li>
      </ul>
    </nav>
  </div>
  <div class="navgtionList"> 
    <ul>
      <li style="display:none"> <a href="/BindUserMessage.aspx?returnUrl=/Myshop/MemberCenter.aspx"> <span><img src="/templates/common/images/iconfont-lianjie.png"></span> <strong style="color: #f37205">绑定用户名</strong><em>重要</em> </a> <span class="glyphicon glyphicon-menu-right"></span> </li>
      <li> <a href="<?php echo ((is_array($_tmp='Collection/collection_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"> <span><img src="/templates/common/images/iconfont-xin.png"></span> <strong>我的收藏</strong> </a> <span class="glyphicon glyphicon-menu-right"></span> </li>
      <li> <a href="<?php echo ((is_array($_tmp='Consult/consult_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"> <span><img src="/templates/common/images/iconfont-consult.png"></span> <strong>我的咨询</strong> </a> <span class="glyphicon glyphicon-menu-right"></span> </li>
    </ul>
    <ul>
      <li> <a href="/Myshop/MyCouponLists.aspx"> <span><img src="/templates/common/images/iconfont-youhuiquan.png"></span> <strong>我的优惠券</strong> </a> <span class="glyphicon glyphicon-menu-right"></span> </li>
      <li> <a href="<?php echo ((is_array($_tmp='Score/score_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"> <span><img src="/templates/common/images/iconfont-jifenb.png"></span> <strong>积分明细</strong> </a> <span class="glyphicon glyphicon-menu-right"></span> </li>
    </ul>
    <ul>
      <li> <a href="<?php echo ((is_array($_tmp='District/district_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"> <span><img src="/templates/common/images/iconfont-iconfonticon5.png"></span> <strong>我的收货地址</strong> </a> <span class="glyphicon glyphicon-menu-right"></span> </li>
      <li> <a href="<?php echo ((is_array($_tmp='User/user_info_edit')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"> <span><img src="/templates/common/images/iconfont-gerenxinxi.png"></span> <strong>个人资料</strong> </a> <span class="glyphicon glyphicon-menu-right"></span> </li>
    </ul>
  </div>
  <a class="signOut btn btn-danger" href="<?php echo ((is_array($_tmp='user/logout')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
">退出</a> </div>