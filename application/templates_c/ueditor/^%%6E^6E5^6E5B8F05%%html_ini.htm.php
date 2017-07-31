<?php /* Smarty version 2.6.20, created on 2017-07-14 10:35:26
         compiled from D:%5Cphpstudy%5CWWW%5Cdfshop%5Capplication%5Ctemplates/ueditor/html_ini.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\dfshop\\application\\templates/ueditor/html_ini.htm', 146, false),)), $this); ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="utf8" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="utf8" class="ie9"> <![endif]-->

<!--[if !IE]><!-->
<html lang="utf8">
<!--<![endif]-->

<!-- BEGIN HEAD -->

<head>
<meta charset="utf-8" />
<title>ERP-多渠道管理系统</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href=/static/css/bootstrap.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/bootstrap-responsive.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/font-awesome.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/style-metro.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/style.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/style-responsive.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/default.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css" id="style_color"/>
<link href=/static/css/uniform.default.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href=/static/css/bootstrap-modal.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href=/static/css/select2_metro.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />
<link rel="stylesheet" href=/static/css/DT_bootstrap.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
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

<script src="/static/js/jquery.slimscroll.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<script src="/static/js/jquery.blockui.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<script src="/static/js/jquery.cookie.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<script src="/static/js/jquery.uniform.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript" ></script> 
<!-- END CORE PLUGINS --> 

<!-- BEGIN PAGE LEVEL PLUGINS --> 

<script type="text/javascript" src="/static/js/select2.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script type="text/javascript" src="/static/js/jquery.dataTables.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script type="text/javascript" src="/static/js/DT_bootstrap.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 

<!-- END PAGE LEVEL PLUGINS --> 

<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<!-- END CORE PLUGINS --> 
<!-- BEGIN PAGE LEVEL PLUGINS --> 
<script src="/static/js/bootstrap-modal.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript" ></script> 
<script src="/static/js/bootstrap-modalmanager.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript" ></script> 
<!-- END PAGE LEVEL PLUGINS --> 
<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="/static/js/app.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>
function load_sub()
{
    $('form').append("<input type='hidden' name='form_rand_load' value='"+Math.ceil(Math.random()*100)+"'>");
	$('body').modalmanager('loading');
	return true;
}
//弹出窗口
function alertWin(title,w,h,src)
{
	window.parent.alertWin(title,w,h,src);
}
</script>
<style>
#span_label{width:100px; font-size:14px; font-weight: normal;line-height:34px;}
</style>
</head>
<body>
  <!-- END SIDEBAR --> 
  <!-- BEGIN PAGE -->
    <!-- BEGIN PAGE CONTAINER--> 
     <?php if (! empty ( $this->_tpl_vars['output_cache'] )): ?>
        <?php echo $this->_tpl_vars['output_cache']; ?>

     <?php elseif (! empty ( $this->_tpl_vars['output'] )): ?>
   		 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['output'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
     <?php endif; ?>
    

    <!-- END PAGE CONTAINER--> 
    <div id="ajax-modal" class="modal hide fade base_msg" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true"   tabindex="-1"></div>
    <div id="ajax-modal_1"class="modal hide fade base_msg" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true"  tabindex="1"></div>
    <div id="ajax-modal_2"class="modal hide fade base_msg" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true"   tabindex="2"></div>
  <!-- END PAGE --> 
<!-- END CONTAINER --> 
<!-- BEGIN FOOTER -->

 
<div id="modal-container-confirm" class="modal hide fade base_msg" role="dialog" aria-labelledby="myModalLabel" data-backdrop='static' aria-hidden="true">
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


<div id="modal-container-msg" class="modal hide fade base_msg" role="dialog" data-backdrop='static' aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header" style="padding:0px;">
    <h3 id="myModalLabel" class="modal-title" > <span style="margin-left:8px;">消息提示</span> </h3>
  </div>
  <div class="modal-body" >
    <p> 操作后不可修改 </p>
  </div>
  <a title="Close" class="msg-modal-close" data-dismiss="modal" aria-hidden="true" href="javascript:;"></a> </div>

<script>
//close关闭窗口刷新主页
function modal_iframe(mothed,title,width,height,value)
{
   $.fn.modal.defaults.width  = (width*1+10)+''+'px';
   $.fn.modal.defaults.height = height+'px';
   $modal1=$('#ajax-modal_1');
  
   $('body').modalmanager('loading');
	setTimeout(function(){
	 $modal1.load('<?php echo ((is_array($_tmp="ueditor/iframe")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?mothed='+mothed+'&s=iframe&title='+title+'&width='+width+'px'+'&height='+height+'px'+'&'+value, '', function(){
		$modal1.modal();
	 });
	}, 200); 
	/**/
}

//消息提示框
function modal_msg(msg,obj)
{
	$.fn.modal.defaults.width  = '';
	$.fn.modal.defaults.height = '';
	$('#modal-container-msg').modal('show');
	$('#modal-container-msg .modal-body').html(msg);
	try{obj()}catch(e){}
}

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


jQuery(document).ready(function() {  
   App.init();

   try{load_ini()}catch(e){};
   $('a').bind('click',function(){
		var df=$(this).attr('href');
		if(df!='#'&&df!=''&&df!='javascript:;'&&$(this).hasClass('fancybox-button')!=true)
			load_sub();
   });
});	

</script> 

</body>
<!-- END BODY -->
</html>