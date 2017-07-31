<?php /* Smarty version 2.6.20, created on 2017-07-25 09:30:57
         compiled from web_config.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'get_ueditor_image_url', 'web_config.htm', 90, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12">
    <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
      		<li> <i class="icon-home"></i> <a>管理中心首页</a> <span class="icon-angle-right"></span> </li>
            <li><a href="#">网站设置</a></li>
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
          <div class="caption"><i class="icon-reorder"></i>网站设置</div>
        </div>
        <div class="portlet-body form"> 
          <!-- BEGIN FORM-->
          <form action=""  class="form-horizontal" method="post" >
             <div class="control-group">
              <label class="control-label">网站名称<span class="required">*</span></label>
              <div class="controls">
                  <input type="text" name="config[web_name]" value="<?php echo $this->_tpl_vars['web_config']['web_name']; ?>
" data-required="1" class="span3 m-wrap"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">网站地址<span class="required">*</span></label>
              <div class="controls">
                  <input type="text" name="config[web_url]" value="<?php echo $this->_tpl_vars['web_config']['web_url']; ?>
" data-required="1" class="span3 m-wrap"/>
                  <p style="color:#F00;">如：http://www.abc.com  ,http://test.abc.com</p>
              </div>
            </div>
           <div class="control-group">
              <label class="control-label">网站域名<span class="required">*</span></label>
              <div class="controls">
                <input type="text" name="config[web_base]" value="<?php echo $this->_tpl_vars['web_config']['web_base']; ?>
" data-required="1" class="span3 m-wrap"/>
                 <p style="color:#F00;">如：非二级域名 .abc.com  二级域名 test.abc.com</p>
              </div>
           </div>
         
            
           <div class="control-group">
              <label class="control-label">Copyright <span class="required">*</span></label>
              <div class="controls">
                    <textarea name="config[copyright]"><?php echo $this->_tpl_vars['web_config']['copyright']; ?>
</textarea>
              </div>
            </div>
            
           <div class="control-group">
              <label class="control-label">网站logo <span class="required">*</span></label>
              <div class="controls">
                    <div class="span12" >
                  <div  style="width:300px; height:300px; border:1px solid red; display:block;"> <img width="100%"  id='upload_pic_bg' src="<?php echo $this->_tpl_vars['web_config']['pic']; ?>
"/> </div>
                  <span class="btn"  id='upload_image' style="width:300px;padding:0px; ">上传主图</span>
                  <input  type="hidden"  id='upload_pic' name="config[pic]" value="<?php echo $this->_tpl_vars['web_config']['pic']; ?>
"/>
              </div>
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn green">提交</button>
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
var server_auth="<?php echo $this->_tpl_vars['ueditor_auth']; ?>
";
function  set_back_pic(pic,id)
{ 
	$('#'+id).val(pic);
	$('#'+id+'_bg').attr('src',pic);
	$('body').modalmanager('removeLoading');
}

function load_ini()
{
  $('#upload_image').bind('click',function(){
	     $.fn.modal.defaults.width='80%';
	     $.fn.modal.defaults.height='400px'; 
		 $modal=$('#ajax-modal');
		 $modal.load('<?php echo ((is_array($_tmp=1)) ? $this->_run_mod_handler('get_ueditor_image_url', true, $_tmp) : get_ueditor_image_url($_tmp)); ?>
<?php echo $this->_tpl_vars['ueditor_auth']; ?>
&back_id=upload_pic','', function(){
		    $modal.modal();
		 });
  });
}
</script> 