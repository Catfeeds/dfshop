<?php /* Smarty version 2.6.20, created on 2017-08-15 13:56:30
         compiled from D:%5Cphpstudy%5CWWW%5Cdfshop%5Capplication%5Ctemplates/admin/login.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config_item', 'D:\\phpstudy\\WWW\\dfshop\\application\\templates/admin/login.htm', 10, false),)), $this); ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="utf8" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="utf8" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="utf8">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title><?php echo ((is_array($_tmp='company')) ? $this->_run_mod_handler('config_item', true, $_tmp) : config_item($_tmp)); ?>
-产品库后台-登陆</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="ERP-多渠道管理系统" name="description" />
<meta content="Byron.chen" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="/static/css/bootstrap.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/bootstrap-responsive.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/font-awesome.min.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/style-metro.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/style.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/style-responsive.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<link href="/static/css/default.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css" id="style_color"/>
<link href="/static/css/uniform.default.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="/static/css/login.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<link rel="shortcut icon" href="/static/favicon.ico?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo"> <img src="/static/logo.gif" alt="" /> </div>
<!-- END LOGO --> 
<!-- BEGIN LOGIN -->
<div class="content"> 
  <!-- BEGIN LOGIN FORM -->
  <form class="form-vertical login-form"  autocomplete="off" autocorrect="off" autocapitalize="off"  spellcheck="false" action="" method="post">
     <div>温馨提示:为了您能正常体验请使用<font style="color:red;">IE8</font>以上的浏览器或者其他版本最新的浏览器</div>
    <h3 class="form-title">管理后台管理</h3>
   
    <div class="alert alert-error hide">
      <button class="close" data-dismiss="alert"></button>
      <span>请输入用户名和密码</span> </div>
    <div class="control-group"> 
      
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      
      <label class="control-label visible-ie8 visible-ie9">ERP管理员后台</label>
      <div class="controls">
        <div class="input-icon left"> <i class="icon-user"></i>
          <input class="m-wrap placeholder-no-fix" type="text"  autocomplete="off" autocorrect="off" autocapitalize="off"  spellcheck="false" placeholder="登陆账号" name="username"/>
        </div>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label visible-ie8 visible-ie9">登陆密码</label>
      <div class="controls">
        <div class="input-icon left"> <i class="icon-lock"></i>
          <input class="m-wrap placeholder-no-fix" type="password"  autocomplete="off" autocorrect="off" autocapitalize="off"  spellcheck="false" placeholder="登陆密码" name="password"/>
        </div>
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label visible-ie8 visible-ie9">验证码</label>
      <div class="controls">
        <div class="left"> 
       <img id='imgs' onclick="javacript:this.src=this.src" src="/img.php/?w=70&h=30&auth_img=<?php echo $this->_tpl_vars['auth_img']; ?>
" /> <a >看不清楚点击图片</a>
        </div>
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label visible-ie8 visible-ie9">验证码</label>
      <div class="controls">
        <div class="input-icon left"> <i class="icon-lock"></i>
          <input class="m-wrap placeholder-no-fix" type="text" placeholder="验证码" name="code"/>
        </div>
      </div>
    </div>
    
    <div class="form-actions">
      <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
      <button type="submit" class="btn green pull-right"> Login <i class="m-icon-swapright m-icon-white"></i> </button>
    </div>
 </form>
  
 
  
  <!-- END REGISTRATION FORM --> 
  
</div>
<!-- END LOGIN --> 
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> 2016 &copy; <?php echo $this->_tpl_vars['seo']['copyright']; ?>
 </div>
<!-- END COPYRIGHT --> 
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
<script src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<!-- END PAGE LEVEL PLUGINS --> 
<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="/static/js/app.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<script src="/static/js/login.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" type="text/javascript"></script> 
<!-- END PAGE LEVEL SCRIPTS --> 
<script>
jQuery(document).ready(function() {     
  App.init();
  Login.init();
});
</script> 
</body>
<!-- END BODY -->
</html>