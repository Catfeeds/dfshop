<?php /* Smarty version 2.6.20, created on 2017-07-21 09:32:22
         compiled from wx_login.htm */ ?>
<div class="container-fluid">

    <!-- BEGIN PAGE HEADER-->

    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>微信管理</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">微信设置</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">一键登陆</a></li>
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
                    <div class="caption"><i class="icon-reorder"></i>会员登陆授权</div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action=""  id="form_submit"  class="form-horizontal" method="post" >
                        <div class="control-group">
                            <label class="control-label">是否开启快速登陆<span class="required">*</span></label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="config[quick_login]" id="optionsRadios1" value="1" <?php if ($this->_tpl_vars['wx']['quick_login'] == 1): ?>checked<?php endif; ?>>
                                    开启
                                </label>
                                <label class="radio">
                                    <input type="radio" name="config[quick_login]" id="optionsRadios2" value="0"  <?php if ($this->_tpl_vars['wx']['quick_login'] == 0): ?>checked<?php endif; ?>>
                                    关闭
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">是否开启授权登陆<span class="required">*</span></label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="config[auth_login]" id="optionsRadios1" value="1" <?php if ($this->_tpl_vars['wx']['auth_login'] == 1): ?>checked<?php endif; ?>>
                                    开启
                                </label>
                                <label class="radio">
                                    <input type="radio" name="config[auth_login]" id="optionsRadios2" value="0" <?php if ($this->_tpl_vars['wx']['auth_login'] == 0): ?>checked<?php endif; ?>>
                                    关闭
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <h1>注释</h1>
                            <p style="color:red">1、是否开启快速登陆：开启以后，会员可在微信端通过微信授权快速登录系统。
                                (仅认证服务号可用）</p>
                            <p style="color:red">2、是否开启授权登陆：开启以后，首次访问微信端商城任何页面的用户，都将被要求先进行微信授权登录（需要系统先开启微信授权登录）。
                            </p>
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