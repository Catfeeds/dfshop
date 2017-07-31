<?php /* Smarty version 2.6.20, created on 2017-07-28 17:02:25
         compiled from fw_passwd_email.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'fw_passwd_email.htm', 58, false),)), $this); ?>
<div class="portlet box blue">
    <div class="portlet-body form" style=" margin:10px;">
        <!-- BEGIN FORM-->
        <form action="" id="form_pwd"  method="post" class="form-horizontal form-row-seperated">
                        <div id='alert-error_1' class="alert alert-error hide">
                <button class="close" data-dismiss="alert"></button>
                <span>提交失败</span> </div>
            <div id='alert-success_1' class="alert alert-success hide">
                <button class="close" data-dismiss="alert"></button>
                <span>提交成功</span> </div>
            <div class="control-group">
                <label class="control-label">注册邮箱</label>
                <div class="controls">
                    <input type="text" id='email' name="email" placeholder="输入邮箱" class="m-wrap span12" style=" width:200px;"  />
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                      <span id='send_email' class="btn red">发送验证码</span>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">验证码</label>
                <div class="controls">
                    <input type="text"  name="email_code" placeholder="请输入验证码" class="m-wrap span6"  style="max-width:120px;" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">新的密码</label>
                <div class="controls">
                    <input type="password" id="pwd" name="new_pwd" placeholder="输入6-15位密码" class="m-wrap span12" style=" width:200px;"    />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">确认密码</label> 
                <div class="controls">
                    <input type="password" name="confirm_pwd" placeholder="请再次确认密码" class="m-wrap span12" style=" width:200px;"   />
                </div>
            </div>
            <div class="form-actions">
                <button id="btn_confirm" class="btn blue">提交</button>
                <button type="button" onclick="history.go(-1)" class="btn">返回</button>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<script type="text/javascript" charset="utf-8" src="/static/district.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" ></script>
<script>

function load_ini()
{
	/*<?php if ($this->_tpl_vars['succecc_msg'] == 1): ?>*/
		modal_msg('修改成功 - 》 <a href="<?php echo ((is_array($_tmp="user/login")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
">立即登录</a>');
	/*<?php endif; ?>*/
	/*<?php if ($this->_tpl_vars['succecc_msg'] == -1): ?>*/
		modal_msg('修改失败 - 》 <a href="<?php echo ((is_array($_tmp="user/fw_passwd")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
">刷新页面</a>');
	/*<?php endif; ?>*/
	
    var error1=$('#alert-error_1');
    var success1=$('#alert-success_1');
    var form1 = $('#form_pwd');
    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-inline', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "hidden",
        rules: {
             email: {
				required: true,
				email: true,
            }
            ,
            new_pwd: {
                required: true,
                rangelength:[6,16]
            }
            ,
            confirm_pwd: {
                required: true,
                rangelength:[6,16],
                equalTo:"#pwd"
            }
        },
        messages : {
			email: {
				required: "邮箱不能为空",
				email: "邮箱格式不正确",
            }
            ,
            new_pwd: {
                required: '新密码不能为空',
                rangelength:'新密码必须介于6-16位'

            }
            ,
            confirm_pwd: {
                required: '确认密码不能为空',
                rangelength:'确认密码必须介于6-16位',
                equalTo:"两次密码不一致"
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
                    .closest('.help-inline'); // display OK icon
            $(element)
                    .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
        },

        unhighlight: function (element) { // revert the change dony by hightlight
            $(element)
                    .closest('.control-group').removeClass('error'); // set error class to the control group
        },

        success: function (label) {
            label.addClass('valid').addClass('help-inline') // mark the current input as valid and display OK icon
                    .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
        },
        submitHandler: function (form) {
			    form.submit();
				return true;
        }
    });
	
	$('#send_email').bind('click',function(){
		 if($('#email').val()=='')
		 {
			modal_msg('邮箱不能为空');
		 	return false;
		 }
		 $('body').modalmanager('loading');
		 $.post('<?php echo ((is_array($_tmp="user/fw_passwd")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',{send_email:$('#email').val(),email_auth:"<?php echo $this->_tpl_vars['email_auth']; ?>
"},function(msg){
			 if(msg==1)
			 {
				 $('body').modalmanager('removeLoading');
				 $('#send_email').removeClass('red');
		 		 $('#send_email').unbind('click');
			 }
			 else
			 	 $('body').modalmanager('removeLoading');
		 });
	});
		
    $("#btn_confirm").click(function(){
       if(form1.valid()==true)
       {
			$('#pwd_form').submit();
        }
    });
}
</script>