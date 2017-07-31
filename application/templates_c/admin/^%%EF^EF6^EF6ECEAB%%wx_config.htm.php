<?php /* Smarty version 2.6.20, created on 2017-07-25 09:33:30
         compiled from wx_config.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'wx_config.htm', 60, false),)), $this); ?>
<div class="container-fluid">

    <!-- BEGIN PAGE HEADER-->

    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>微信管理</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">微信设置</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">公众号绑定</a></li>
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
                    <div class="caption"><i class="icon-reorder"></i>绑定微信公众号</div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action=""  id="form_submit"  class="form-horizontal" method="post" >
                                                <div id='alert-error_1' class="alert alert-error hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交失败</span></div>
                        <div id='alert-success_1' class="alert alert-success hide">
                            <button class="close" data-dismiss="alert"></button>
                            <span>提交成功</span></div>


                        <div class="control-group">

                            <table class="table table-striped table-bordered table-hover " style="width: 800px;" >
                                <thead>
                                <tr role="heading">
                                    <th width="164"  role="columnheader" tabindex="0" aria-controls="sample_1">配置项</th>
                                    <th width="460"   role="columnheader" tabindex="0" aria-controls="sample_1">配置说明</th>
                                    <th width="77"   role="columnheader" tabindex="0" aria-controls="sample_1">状态</th>
                                    <th width="114"  role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>URL/Token</td>
                                        <td>绑定到微信公众平台以后，可通过平台后台管理您的微信公众号</td>
                                        <td>已绑定</td>
                                        <td><button class="btn green">查看详情</button></td>
                                    </tr>
                                    <tr>
                                        <td>AppID/AppSecret</td>
                                        <td>保存到平台后台以后，可在平台系统中使用更多微信公众号的功能</td>
                                        <td><?php if ($this->_tpl_vars['re']['wx'] == 0): ?>未设置<?php elseif ($this->_tpl_vars['re']['wx'] == 1): ?>已设置<?php endif; ?></td>
                                        <td><?php if ($this->_tpl_vars['re']['wx'] == 0): ?>
                                            <button onclick="alertWin('微信设置',800,400,'<?php echo ((is_array($_tmp="wx/config")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?act=config_appid')" class="btn green wx_set" >设置</button>
                                            <?php elseif ($this->_tpl_vars['re']['wx'] == 1): ?>
                                            <button  class="btn green" onclick="alertWin('微信设置',800,400,'<?php echo ((is_array($_tmp="wx/config")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?act=config_appid')">重新设置</button>
                                            <?php endif; ?></td>
                                    </tr>
                                </tbody>
                            </table>
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

<script>
    function load_ini()
    {


    }



</script>