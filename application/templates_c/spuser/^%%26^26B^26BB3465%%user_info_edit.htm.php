<?php /* Smarty version 2.6.20, created on 2017-07-28 11:36:52
         compiled from user_info_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'user_info_edit.htm', 62, false),)), $this); ?>
<body class="page-header-fixed page-boxed">
<div class="container">
    <div class="portlet box blue">
        <style>
            .form .form-bordered .form-body {
                margin: 0;
                padding: 0; }

            .form .form-row-seperated .form-body {
                padding: 0; }
            .portlet-form .form-body,
            .form .form-body {
                padding: 20px; }
            .portlet.light .portlet-form .form-body, .portlet.light
            .form .form-body {
                padding-left: 0;
                padding-right: 0; }
        </style>
        <div class="portlet-body form">

            <!-- BEGIN FORM-->

            <form action="#" id="userinfo_form">
                <div class="form-body">
                                        <div id='alert-error_1' class="alert alert-error hide">
                        <button class="close" data-dismiss="alert"></button>
                        <span>提交失败</span> </div>
                    <div id='alert-success_1' class="alert alert-success hide">
                        <button class="close" data-dismiss="alert"></button>
                        <span>提交成功</span> </div>
                    <div class="control-group">
                        <label class="control-label">账户信息</label>
                        <div class="controls">
                            <input type="text" placeholder="small" value="用户名:<?php echo $this->_tpl_vars['res']['user']; ?>
" disabled="disabled" class="m-wrap span12" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">姓名</label>
                        <div class="controls">
                            <input type="text" name="name" placeholder="请输入您的姓名" class="m-wrap span12" value="<?php echo $this->_tpl_vars['res']['name']; ?>
" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">手机</label>
                        <div class="controls">
                            <input type="text" name="mobile" placeholder="请输入您的手机号" class="m-wrap span12" value="<?php echo $this->_tpl_vars['res']['mobile']; ?>
" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">身份证号</label>
                        <div class="controls">
                            <input type="text" name="id" placeholder="请输入您的身份证号" class="m-wrap span12"  />
                        </div>
                    </div>
                    <div class="control-group">

                    </div>
                    <div class="form-actions">
                        <button type="button" id="btn_confirm" class="btn btn-block red"><i class="icon-ok"></i>保存</button>
                        <a href="<?php echo ((is_array($_tmp='user/pwd_edit')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" class="btn blue btn-block">修改密码 <i class="m-icon-swapright m-icon-white"></i></a>

                    </div>
                </div>


            </form>

            <!-- END FORM-->

        </div>
    </div>
</div>


</body>
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<script type="text/javascript" charset="utf-8" src="/static/district.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" ></script>
<script>
    var error1=$('#alert-error_1');
    var success1=$('#alert-success_1');
    var form1 = $('#userinfo_form');
    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-inline', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "hidden",
        rules: {
            name: {
                required: true
            }
            ,
            mobile: {
                required: true,
            }
            ,
            id: {
                required: true,
            }
        },
        messages : {
            name:{
                required:'姓名不能为空'
            }
            ,
            mobile: {
                required: '手机号不能为空'
            }
            ,
           id: {
                required: '身份证号不能为空'
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
            label.remove();
            error1.hide();
//            label.addClass('valid').addClass('help-inline') // mark the current input as valid and display OK icon
//                    .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
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

    $("#btn_confirm").click(function(){
        if(form1.valid()==true)
        {
            //encodeURI(msg)
            $modal=$('#ajax-modal');
            error1.hide();
            success1.show();
            success1.find('span').html('正在提交...........');
            $('body').modalmanager('loading');
            $.post('<?php echo ((is_array($_tmp="user/user_info_edit")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form1.serialize(),function(msg){
                try
                {
                    //alert(msg)
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
                        window.location='<?php echo ((is_array($_tmp="spuser_index/info")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
';
                        return true;
                    }
                    setTimeout(modal_msg(str.msg),300);
                }catch(e){
                    $('body').modalmanager('removeLoading');
                    success1.hide();
                    error1.find('span').html('系统异常');
                    error1.show();
                    setTimeout(modal_msg('系统异常'),300);
                };
            });
        }
    });
</script>