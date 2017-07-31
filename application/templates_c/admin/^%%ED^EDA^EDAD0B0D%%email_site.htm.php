<?php /* Smarty version 2.6.20, created on 2017-07-25 09:32:30
         compiled from email_site.htm */ ?>
<div class="container-fluid">

    <!-- BEGIN PAGE HEADER-->

    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <?php echo $this->_tpl_vars['select_admin_name']; ?>

            </ul>
        </div>
    </div>
    <!-- END PAGE HEADER-->

    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i>邮箱设置</div>
                </div>
                <div class="portlet-body form">

                    <form action=""  id="form_submit"  class="form-horizontal" method="post" >
                                                <div id='alert-error_1' class="alert alert-error hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交失败</span></div>
                        <div id='alert-success_1' class="alert alert-success hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交成功</span></div>
                        <div class="control-group">
                            <label class="control-label">邮件总开关<span class="required">*</span></label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="config[is_open]" id="optionsRadios1" value="1" <?php if ($this->_tpl_vars['wx']['is_open'] == 1): ?>checked<?php endif; ?>>
                                    开启
                                </label>
                                <label class="radio">
                                    <input type="radio" name="config[is_open]" id="optionsRadios2"  value="0" <?php if ($this->_tpl_vars['wx']['is_open'] == 0): ?>checked<?php endif; ?>>
                                    关闭
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">邮件发送方式<span class="required">*</span></label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="config[type]" id="optionsRadios1" value="1" <?php if ($this->_tpl_vars['wx']['is_open'] == 1): ?>checked<?php endif; ?>>
                                    内置email
                                </label>
                                <label class="radio">
                                    <input type="radio" name="config[type]" id="optionsRadios2"  value="0" <?php if ($this->_tpl_vars['wx']['is_open'] == 0): ?>checked<?php endif; ?>>
                                    以下SMTP
                                </label>
                            </div>
                        </div>

                        <div class="control-group">

                            <table class="table table-striped table-bordered table-hover "  >
                                <thead>
                                <tr role="heading">
                                    <th width="100"  role="columnheader" tabindex="0" aria-controls="sample_1">SMTP地址</th>
                                    <th width="100"   role="columnheader" tabindex="0" aria-controls="sample_1">E_Mail地址</th>
                                    <th width="100"   role="columnheader" tabindex="0" aria-controls="sample_1">邮箱密码</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $_from = $this->_tpl_vars['email']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td><input type="text"  name="config[SMTP_address][]" value="<?php echo $this->_tpl_vars['email'][$this->_tpl_vars['key']]['SMTP_address']; ?>
"></td>
                                    <td><input type="text"  name="config[email_address][]" value="<?php echo $this->_tpl_vars['email'][$this->_tpl_vars['key']]['email_address']; ?>
"></td>
                                    <td><input type="password" name="config[email_pass][]" value="<?php echo $this->_tpl_vars['email'][$this->_tpl_vars['key']]['email_pass']; ?>
"></td>
                                </tr>
                                <?php endforeach; endif; unset($_from); ?>
                                <tr>
                                    <td colspan="99">
                                        <button type="button" id="add_gg" class="btn mini green">新增email</button>

                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="form-actions">
                            <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
                            <button type="submit"  id='submit_add'  class="btn green">保存</button>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>

    <!-- END PAGE CONTENT-->

</div>
<link rel="stylesheet" type="text/css" href="/static/css/bootstrap-toggle-buttons.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"/>
<script type="text/javascript" src="/static/js/jquery.toggle.buttons.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<script>

    function load_ini()
    {
        add_gg();
    }
    var add_gg=function()
    {
        $('#add_gg').click(function(){

            var ngg=$('<tr><td><input type="text"  name="config[SMTP_address][]" ></td> <td><input type="text"  name="config[email_address][]" ></td> <td><input type="password" name="config[email_pass][]" ></td> </tr>');
            $(this).parents('tr').before(ngg);

        })


    }
</script>