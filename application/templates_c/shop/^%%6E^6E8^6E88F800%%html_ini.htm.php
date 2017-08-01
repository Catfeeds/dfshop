<?php /* Smarty version 2.6.20, created on 2017-08-01 10:48:28
         compiled from D:%5Cphpstudy%5CWWW%5Cdfshop%5Capplication%5Ctemplates/shop/html_ini.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\dfshop\\application\\templates/shop/html_ini.htm', 127, false),array('modifier', 'base_site_url', 'D:\\phpstudy\\WWW\\dfshop\\application\\templates/shop/html_ini.htm', 278, false),array('modifier', 'escape', 'D:\\phpstudy\\WWW\\dfshop\\application\\templates/shop/html_ini.htm', 278, false),)), $this); ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="utf8" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="utf8" class="ie9"> <![endif]-->

<!--[if !IE]><!-->
<html lang="utf8">
<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>
<meta charset="utf-8" />
<title>挚捷行优选</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href=/static/css/bootstrap.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>

" rel="stylesheet" type="text/css"/>
<link href=/static/css/bootstrap-responsive.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>

" rel="stylesheet" type="text/css"/>
<link href="/static/css/font-awesome.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/style-metro.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/bootstrap-modal.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" href="/static/css/jquery.fancybox.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />
<link rel="stylesheet" href="/static/wap/wap.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />
<link rel="stylesheet" href="/static/wap/header.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />

<!-- END PAGE LEVEL STYLES -->
<link rel="shortcut icon" href="/static/favicon.ico?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />
<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<script src="/static/js/jquery-1.10.1.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script>
<script src="/static/js/jquery-migrate-1.2.1.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="/static/js/jquery-ui-1.10.1.custom.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script>
<script src="/static/js/bootstrap.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script>
<!--[if lt IE 9]>
	<script src="/static/js/excanvas.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
	<script src="/static/js/respond.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>  
<![endif]-->
<script src="/static/js/bootstrap-modal.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript" ></script>
<script src="/static/js/bootstrap-modalmanager.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript" ></script>

<!--幻灯片插件-->
<script src="/static/wap/Carousel.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript" ></script>
<script src="/static/js/app.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript" ></script>
<SCRIPT src="/static/jquery.lazyload.min.js" type=text/javascript></SCRIPT>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script>
function load_sub()
{
	$('body').modalmanager('loading');
	return true;
}
</script>
</head>
<body style="margin:0px; padding:0px;">

<div id="modal-container-confirm" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
  <div class="modal-header" style="padding:0px;">
    <h3 id="myModalLabel" class="modal-title" > <span style="margin-left:8px;">消息提示</span> </h3>
  </div>
  <div class="modal-body">
    <p> 操作后不可修改 </p>
  </div>
  <div class="modal-footer">
    <button class="btn mini red" data-dismiss="modal" aria-hidden="true">取消</button>
    <button class="act btn mini blue btn-primary">提交</button>
  </div>
  <a title="Close" class="msg-modal-close" data-dismiss="modal" aria-hidden="true" href="javascript:;"></a></div>
</div>

<div id="modal-container-msg" class="modal hide fade" role="dialog" data-backdrop='static' aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header" style="padding:0px;">
    <h3 id="myModalLabel" class="modal-title" > <span style="margin-left:8px;">消息提示</span> </h3>
  </div>
  <div class="modal-body" >
    <p> 操作后不可修改 </p>
  </div>
  <a title="Close" class="msg-modal-close" data-dismiss="modal" aria-hidden="true" href="javascript:;"></a> </div>
</div>

<link rel="stylesheet" type="text/css" href=/static/jquery.autocomplete.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" /> 
<script type="text/javascript" src="/static/jquery.autocomplete.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<?php if ($this->_tpl_vars['show_ajax'] != 1): ?>
<section style="background:#E81328; position:fixed; width:100%; color:#fff; z-index:10000; <?php if ($this->_tpl_vars['nav_header_hide'] == 1): ?>display:none;<?php endif; ?>">
  <div id="left"> logo </div>
  <div id="content">
    <div id="contentInner">
      <div id="nav_right"><span class="btn red mini" style="position:relative; z-index:1000000;">搜素</span></div>
      <div id="nav_content" >
        <div id="nav_contentInner" >
          <input name="seach_key" id='keyword' type="text" class="m-wrap" maxlength="50" style=" width:100%; background:#fff; border:0px; margin-top:5px;" value="<?php echo $_GET['keyword']; ?>
">
         </div>
      </div>
    </div>
  </div>
  <div style="clear:both;"></div>
</section>
<?php endif; ?>
<style>
.ac_results li{ line-height:25px; border-bottom:1px solid #ccc;}
</style>
<script>
//-------------
function formatItem(row) {
	return " <p>"+row[0] +" </p>"+ " <span>" + row[1] + "</span>";
}

function formatResult(row) {
	return row[0].replace(/(<.+<?php echo '?>'; ?>
)/gi, '');
}

function selectItem(li) {
   // alert(li.selectValue);
  window.location='<?php echo ((is_array($_tmp="product/lists")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?keyword='+li.selectValue;
}

$("#keyword").autocomplete('<?php echo ((is_array($_tmp="product/search")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/',
{
	delay:10,
	matchSubset:2,
	matchContains:2,
	cacheLength:10,
	onItemSelect:selectItem,
	formatItem: formatItem,
	formatResult: formatResult
}
);

</script>

<style>
#left {float: left;width: 80px;margin-right: -100%; height:45px; line-height:45px; text-align:center;}
#content {float: left;width: 100%;}
#contentInner {margin-left:80px;height:45px;line-height:45px; }
#nav_right {float: right;width: 80px;margin-left: -100%; height:45px; line-height:45px; text-align:center;}
#nav_content {float: right;width: 100%;}
#nav_contentInner {margin-right:80px;height:45px;line-height:45px; text-align:center; }
</style>

<!---分类-->
<section class="panel-left-tab panel-left-in" id="panel-left-box" >
  <h2><i class="sort-left-ico"></i>全部分类</h2>
  <div class="overflow-list">
    <ul class="first-classify">
      <li> <a href="javascript:;"><b class="ico right"></b>厨房日用</a>
        <ul class="second-classify">
          <li> <a href="#"><b class="ico right"></b>酒杯</a> </li>
        </ul>
      </li>
      <li> <a href="javascript:;"><b class="ico right"></b>健康保健</a>
        <ul class="second-classify">
          <li> <a href="#"><b class="ico right"></b>蜂蜜</a> </li>
        </ul>
      </li>
      <li> <a href="javascript:;"><b class="ico right"></b>休闲食品</a>
        <ul class="second-classify">
          <li> <a href="#"><b class="ico right"></b>糖果</a> </li>
          <li> <a href="#"><b class="ico right"></b>肉干肉脯</a> </li>
          <li> <a href="#"><b class="ico right"></b>巧克力</a> </li>
          <li> <a href="#"><b class="ico right"></b>坚果</a> </li>
          <li> <a href="#"><b class="ico right"></b>海产水产</a> </li>
          <li> <a href="#"><b class="ico right"></b>果干果脯</a> </li>
          <li> <a href="#"><b class="ico right"></b>冲调饮品</a> </li>
          <li> <a href="#"><b class="ico right"></b>饼干膨化</a> </li>
        </ul>
      </li>
      <li> <a href="javascript:;"><b class="ico right"></b>少儿产品</a>
        <ul class="second-classify">
          <li> <a href="#"><b class="ico right"></b>文具</a> </li>
          <li> <a href="#"><b class="ico right"></b>玩具</a> </li>
        </ul>
      </li>
      <li> <a href="javascript:;"><b class="ico right"></b>母婴童玩</a>
        <ul class="second-classify">
          <li> <a href="#"><b class="ico right"></b>宝宝喂养</a> </li>
          <li> <a href="#"><b class="ico right"></b>车床玩具</a> </li>
          <li> <a href="#"><b class="ico right"></b>孕妇必备</a> </li>
          <li> <a href="#"><b class="ico right"></b>纸尿裤</a> </li>
          <li> <a href="#"><b class="ico right"></b>清洁洗护</a> </li>
          <li> <a href="#"><b class="ico right"></b>药品保健</a> </li>
          <li> <a href="#"><b class="ico right"></b>宝宝辅食</a> </li>
          <li> <a href="#"><b class="ico right"></b>宝宝奶粉</a> </li>
        </ul>
      </li>
      <li> <a href="javascript:;"><b class="ico right"></b>美容美妆</a>
        <ul class="second-classify">
          <li> <a href="#"><b class="ico right"></b>美体护理</a> </li>
          <li> <a href="#"><b class="ico right"></b>美发护发</a> </li>
          <li> <a href="#"><b class="ico right"></b>彩妆工具</a> </li>
          <li> <a href="#"><b class="ico right"></b>眼线笔睫毛</a> </li>
        </ul>
      </li>
      <li> <a href="javascript:;"><b class="ico right"></b>酒水软饮</a>
        <ul class="second-classify">
          <li> <a href="#"><b class="ico right"></b>饮料</a> </li>
          <li> <a href="#"><b class="ico right"></b>水</a> </li>
          <li> <a href="#"><b class="ico right"></b>葡萄酒</a> </li>
          <li> <a href="#"><b class="ico right"></b>啤酒</a> </li>
          <li> <a href="#"><b class="ico right"></b>果汁</a> </li>
          <li> <a href="#"><b class="ico right"></b>白酒</a> </li>
        </ul>
      </li>
      <li> <a href="javascript:;"><b class="ico right"></b>家居生活</a>
        <ul class="second-classify">
          <li> <a href="#"><b class="ico right"></b>油</a> </li>
          <li> <a href="#"><b class="ico right"></b>饮料</a> </li>
          <li> <a href="#"><b class="ico right"></b>水</a> </li>
          <li> <a href="#"><b class="ico right"></b>葡萄酒</a> </li>
          <li> <a href="#"><b class="ico right"></b>啤酒</a> </li>
          <li> <a href="#"><b class="ico right"></b>果汁</a> </li>
          <li> <a href="#"><b class="ico right"></b>白酒</a> </li>
        </ul>
      </li>
      <li> <a href="javascript:;"><b class="ico right"></b>精选套餐</a>
        <ul class="second-classify">
          <li> <a href="#"><b class="ico right"></b>饮料</a> </li>
          <li> <a href="#"><b class="ico right"></b>水</a> </li>
          <li> <a href="#"><b class="ico right"></b>葡萄酒</a> </li>
          <li> <a href="#"><b class="ico right"></b>啤酒</a> </li>
          <li> <a href="#"><b class="ico right"></b>果汁</a> </li>
          <li> <a href="#"><b class="ico right"></b>白酒</a> </li>
        </ul>
      </li>
      <li> <a href="javascript:;"><b class="ico right"></b>中万之友</a>
        <ul class="second-classify">
          <li> <a href="#"><b class="ico right"></b>饮料</a> </li>
          <li> <a href="#"><b class="ico right"></b>水</a> </li>
          <li> <a href="#"><b class="ico right"></b>葡萄酒</a> </li>
          <li> <a href="#"><b class="ico right"></b>啤酒</a> </li>
          <li> <a href="#"><b class="ico right"></b>果汁</a> </li>
          <li> <a href="#"><b class="ico right"></b>白酒</a> </li>
        </ul>
      </li>
    </ul>
  </div>
</section>
<!--分类结束--> 



<!--右边挂件-->
<section id="sideWidget" style="background-color:rgba(0,0,0,0.6);<?php if ($this->_tpl_vars['nav_header_hide'] == 1): ?>display:none;<?php endif; ?>"> <a href="javascript:;" onClick="modal_msg('主页')" class="sideWidget-btn"><i class="icon-home" ></i>&nbsp;</a><!-- 返回主页 --> 
  <a href="javascript:;" onClick="modal_msg('购物车')"  class="sideWidget-btn"><i class="icon-shopping-cart"></i>&nbsp;</a><!-- 购物车 --> 
  <a href="tel:111111" onClick="modal_confirm('电话')" class="sideWidget-btn"><i class="icon-phone"></i>&nbsp;</a><!-- 电话 --> 
  <a href="javascript:;" onClick="modal_msg('头部')" class="sideWidget-btn" style="display: block;"> <i class="icon-angle-up"></i>&nbsp;</a><!-- gotop --> 
</section>
<!--右边挂件结束-->
<section  class="row-fluid"  > <?php if (! empty ( $this->_tpl_vars['output_cache'] )): ?>
  <?php echo $this->_tpl_vars['output_cache']; ?>

  <?php elseif (! empty ( $this->_tpl_vars['output'] )): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['output'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
  <?php endif; ?>
  <div style="clear:both;"></div>
  <div  style="display:block; margin-bottom:40px;"> </div>
</section>
<?php if ($this->_tpl_vars['show_ajax'] != 1): ?>
<!--底部-->
<div id='df_footer' style="<?php if ($this->_tpl_vars['nav_header_hide'] == 1): ?>display:none;<?php endif; ?>" >
  <div class="floor bottom-bar-pannel">
    <div class="floor-container ">
      <ul class="tab4" >
        <li><span class="bar-img"><a class="J_ping" href="/index.php"><i class="icon-home" ></i>首页</a></span></li>
        <li><span class="bar-img"><a class="J_ping" href="<?php echo ((is_array($_tmp="product/lists")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"><i class="icon-eye-open"></i>商品</a></span></li>
        <li><span class="bar-img"><a class="J_ping" href="<?php echo ((is_array($_tmp="product/lists2")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"><i class=" icon-bullhorn"></i>促销</a></span></li>
        <li><span class="bar-img"><a class="J_ping" href="<?php echo ((is_array($_tmp="spuser_index/info")) ? $this->_run_mod_handler('base_site_url', true, $_tmp, 'u') : base_site_url($_tmp, 'u')); ?>
?ref_url=<?php echo ((is_array($_tmp=$this->_tpl_vars['this_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><i class="icon-user-md"></i>会员</a></span></li>
      </ul>
    </div>
  </div>
</div>
<!--底部 结束--> 
<?php endif; ?>
<!-- END PAGE CONTAINER-->
<div id="ajax-modal" class="modal hide fade"   tabindex="-1"></div>
<div id="ajax-modal_1" class="modal hide fade"   tabindex="1"></div>
<div id="ajax-modal_2" class="modal hide fade"   tabindex="2"></div>
<!-- END PAGE --> 
<!-- END CONTAINER --> 
<!-- BEGIN FOOTER --> 
<script>
//close关闭窗口刷新主页
//消息提示框
function modal_confirm(msg,obj)
{
	$.fn.modal.defaults.width  = '';
	$.fn.modal.defaults.height = '';
	$('#modal-container-confirm').modal('show');
	$('#modal-container-confirm .modal-body').html(msg);
	$('#modal-container-confirm .act').unbind('click').bind('click',function(e){
		$('#modal-container-confirm').modal('hide');
		obj(e);
	});
}
 
//消息提示框
function modal_msg(msg)
{
	$.fn.modal.defaults.width  = '400px';
	$.fn.modal.defaults.height = '';
	$('#modal-container-msg').modal('show');
	$('#modal-container-msg .modal-body').html(msg);
}


//登录窗口
function modal_login()
{
	$.fn.modal.defaults.width  = '400px';
	$.fn.modal.defaults.height = '';
	$('#modal-container-login').modal('show');
}



jQuery(document).ready(function() {  
   App.init();

   try{load_ini()}catch(e){};
   $('a').bind('click',function(){
		var df=$(this).attr('href');
		if(df!='#'&&df!=''&&df!='javascript:;'&&$(this).hasClass('fancybox-button')!=true&&$(this).hasClass('no_load')!=true)
			load_sub();
   });
   $(".img_load").lazyload({ 
   placeholder : "/static/loading.gif",
		 effect: "fadeIn"
   });  
   
});	
</script>
</body>
<!-- END BODY -->
</html>