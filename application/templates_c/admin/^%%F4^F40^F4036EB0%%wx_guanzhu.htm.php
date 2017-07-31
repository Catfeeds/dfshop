<?php /* Smarty version 2.6.20, created on 2017-07-25 09:33:31
         compiled from wx_guanzhu.htm */ ?>
<div class="container-fluid">

    <!-- BEGIN PAGE HEADER-->

    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title"> <small> </small> </h3>
            <ul class="breadcrumb">
                <li> <i class="icon-home"></i> <a>微信管理</a> <span class="icon-angle-right"></span> </li>
                <li> <a href="#">微信设置</a> <span class="icon-angle-right"></span> </li>
                <li><a href="#">一键关注</a></li>
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
                    <div class="caption"><i class="icon-reorder"></i>一键关注</div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action=""  id="form_submit"  class="form-horizontal" method="post" >
                        <div class="control-group">
                            <label class="control-label">是否开启关注引导<span class="required">*</span></label>
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
                            <label class="control-label">微信引导页面地址<span class="required">*</span></label>
                            <div class="controls">
                                <input type="text" name="config[address]" class="span6 m-wrap" value="<?php echo $this->_tpl_vars['wx']['address']; ?>
" />
                            </div>
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