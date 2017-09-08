<?php /* Smarty version 2.6.20, created on 2017-08-03 11:12:45
         compiled from login.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'login.htm', 49, false),array('modifier', 'escape', 'login.htm', 49, false),)), $this); ?>
<section  class="form"  style="padding-left:20px;"> 
  <!-- BEGIN LOGIN FORM -->
  <form class="form-horizontal"  id="login_form" autocomplete="off" autocorrect="off" autocapitalize="off"  spellcheck="false" action="" method="POST">
    <div class="control-group">
            <div id='alert-error_1' class="alert alert-error hide">
        <button class="close" data-dismiss="alert"></button>
        <span>提交失败</span></div>
      <div id='alert-success_1' class="alert alert-success hide">
        <button class="close" data-dismiss="alert"></button>
        <span>提交成功</span></div>
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      
      <label class="control-label visible-ie8 visible-ie9">登陆账号</label>
      <div class="controls">
        <div class="input-icon left"> 
          <input class="m-wrap placeholder-no-fix" type="text"  autocomplete="off" autocorrect="off" autocapitalize="off"  spellcheck="false" placeholder="登陆账号" name="username"/>
        </div>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label visible-ie8 visible-ie9">登陆密码</label>
      <div class="controls">
        <div class="input-icon left"> 
          <input class="m-wrap placeholder-no-fix" type="password"  autocomplete="off" autocorrect="off" autocapitalize="off"  spellcheck="false" placeholder="登陆密码" name="password"/>
        </div>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label visible-ie8 visible-ie9">验证码</label>
      <div class="controls">
        <div class="left"> <img id='imgs' onclick="javacript:this.src=this.src" src="/img.php/?w=70&h=30&auth_img=<?php echo $this->_tpl_vars['auth_img']; ?>
" /> <a >看不清楚点击图片</a> </div>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label visible-ie8 visible-ie9">验证码</label>
      <div class="controls">
        <div class="input-icon left">
          <input class="m-wrap placeholder-no-fix" type="text" placeholder="验证码" name="code"/>
        </div>
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label visible-ie8 visible-ie9"></label>
      <div class="controls">
        <div class="input-icon left">
           <button type="submit" id="submit_admin_add" class="btn green "> 登陆  </button>
          <a  href="<?php echo ((is_array($_tmp='user/reg')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?ref_url=<?php echo ((is_array($_tmp=$_GET['ref_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"  class="btn green "> 注册 <i class="m-icon-swapright m-icon-white"></i> </a>
          <p style="margin-top:20px;"><a href="<?php echo ((is_array($_tmp='user/fw_passwd')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?ref_url=<?php echo ((is_array($_tmp=$_GET['ref_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
">找回密码</a></p>
        </div>
      </div>
    </div>
    
    <!--<div class="control-group">-->
      <!--<label class="control-label visible-ie8 visible-ie9"></label>-->
      <!--<div class="controls">-->
        <!--<div class="input-icon left">-->
           <!--<a class="btn green "  > 微信登陆</a>-->
           <!--&lt;!&ndash;<a  class="btn green "> QQ </a>&ndash;&gt;-->
        <!--</div>-->
      <!--</div>-->
    <!--</div>-->
  </form>
</section>
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<script>
  function load_ini()
  {

    /*<?php if ($this->_tpl_vars['succecc_msg'] == 1): ?>*/
    modal_msg('账号或密码错误 - 》 <a href="<?php echo ((is_array($_tmp="user/login")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
">刷新页面</a>');
    /*<?php endif; ?>*/
    /*<?php if ($this->_tpl_vars['succecc_msg'] == -1): ?>*/
    modal_msg('账号或密码没有填写 - 》 <a href="<?php echo ((is_array($_tmp="user/login")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
">刷新页面</a>');
    /*<?php endif; ?>*/
    /*<?php if ($this->_tpl_vars['succecc_msg'] == -2): ?>*/
    modal_msg('验证码错误 - 》 <a href="<?php echo ((is_array($_tmp="user/login")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
">刷新页面</a>');
    /*<?php endif; ?>*/

    var error1=$('#alert-error_1');
    var success1=$('#alert-success_1');

    var form1 = $('#login_form');
    form1.validate({
      errorElement: 'span', //default input error message container
      errorClass: 'help-inline', // default input error message class
      focusInvalid: false, // do not focus the last invalid input
      ignore: "",
      rules: {
        username: {
          required: true
        }
        ,
        password: {
          required: true
        }
        ,
        code:{
          required:true
        }
      },
      messages : {
        username:{
          required:'登陆账户不能为空'
        }
        ,
        password: {
          required: '密码不能为空'
        }
        ,
        code:{
          required:'验证码'
        }
      }
      ,
      invalidHandler: function (event, validator) { //display error alert on form submit
        success1.hide();
        error1.find('span').html('请完善提交内容再提交');
        error1.show();
        App.scrollTo(error1, -200);
      },

      highlight: function (element) { // hightlight error inputs
        $(element)
                .closest('.help-inline').removeClass('ok'); // display OK icon
        $(element)
                .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
      },

      unhighlight: function (element) { // revert the change dony by hightlight
        $(element)
                .closest('.control-group').removeClass('error'); // set error class to the control group
      },

      success: function (label) {
        label.addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
      },
      submitHandler: function (form) {
        $modal=$('#ajax-modal');
        error1.hide();
        success1.show();
        success1.find('span').html('正在提交...........');
        $('body').modalmanager('loading');
        form.submit();
        return true;
      }
    });



  }

</script>


