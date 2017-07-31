<?php /* Smarty version 2.6.20, created on 2017-07-28 14:29:05
         compiled from reg.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'reg.htm', 57, false),array('modifier', 'escape', 'reg.htm', 57, false),)), $this); ?>
<section  class="form"  style="padding-left:20px;">
    <!-- BEGIN LOGIN FORM -->
    <form class="form-horizontal" id="reg_form"  autocomplete="off" autocorrect="off" autocapitalize="off"  spellcheck="false" action="" method="post">
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
                    <input class="m-wrap placeholder-no-fix" type="password" id="password"  autocomplete="off" autocorrect="off" autocapitalize="off"  spellcheck="false" placeholder="登陆密码" name="password"/>
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label visible-ie8 visible-ie9">确认密码</label>
            <div class="controls">
                <div class="input-icon left">
                    <input class="m-wrap placeholder-no-fix" type="password"  autocomplete="off" autocorrect="off" autocapitalize="off"  spellcheck="false" placeholder="确认密码" name="repassword"/>
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
                    <button type="button" id="submit_admin_add" class="btn green ">注册</button>
                    <button type="button" onclick="window.location.href='<?php echo ((is_array($_tmp='user/login')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?ref_url=<?php echo ((is_array($_tmp=$_GET['ref_url'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
'" class="btn green "> 去登陆 <i class="m-icon-swapright m-icon-white"></i> </button>
                </div>
            </div>
        </div>

        <!--<div class="control-group">-->
        <!--<label class="control-label visible-ie8 visible-ie9"></label>-->
        <!--<div class="controls">-->
        <!--<div class="input-icon left">-->
        <!--<a class="btn green "> 微信</a>-->
        <!--<a  class="btn green "> QQ </a>-->
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
        var error1=$('#alert-error_1');
        var success1=$('#alert-success_1');

        var form1 = $('#reg_form');
        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                username: {
                    required: true,
                    remote:"<?php echo ((is_array($_tmp='user/user_unique')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"
                }
                ,
                password: {
                    required: true
                }
                ,
                repassword:{
                    required:true,
                    equalTo:'#password'
                }
                ,
                code:{
                    required:true
                }
            },
            messages : {
                username:{
                    required:'登陆账户不能为空',
                    remote:'账户已经存在'
                }
                ,
                password: {
                    required: '密码不能为空'
                }
                ,
                repassword:{
                    required:'确认密码不能为空',
                    equalTo:'两次密码不一致'
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
                /*
                 $.post("?m=<?php echo $_GET['m']; ?>
&s=<?php echo $_GET['s']; ?>
&act_ajax=1",form1.serialize(),function(msg){
                 success1.hide();
                 if(msg==1)
                 {
                 success1.find('span').html('订阅成功');
                 success1.show();
                 }
                 else
                 {
                 error1.find('span').html(msg);
                 error1.show();
                 }
                 });
                 */
            }
        });

        $("#submit_admin_add").click(function(){
            if(form1.valid()==true)
            {
                //encodeURI(msg)
                $modal=$('#ajax-modal');
                error1.hide();
                success1.show();
                success1.find('span').html('正在提交...........');
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="user/reg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg){
                    try
                    {
                        eval("var str="+msg);
                        //操作成功
                        if(str.type==1)
                        {
                            //错误提示
                            error1.show();
                            success1.hide();
                            error1.find('span').html(str.msg);
                        }
                        else if(str.type==2)
                        {
                            //提交成功
                            error1.hide();
                            success1.show();
                            success1.find('span').html('提交成功');
                        }
                        else if(str.type==3)
                        {
                            //刷新主页面
                            window.location="<?php echo ((is_array($_tmp='spuser_index/info')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
";
                            return true;
                        }
                        setTimeout(modal_msg(str.msg),300)
                    }catch(e){
                        // alert(msg);
                        $('body').modalmanager('removeLoading');
                        success1.hide();
                        error1.find('span').html('系统异常');
                        error1.show();
                    };
                });
            }
        });

    }


</script>