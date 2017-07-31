<?php /* Smarty version 2.6.20, created on 2017-07-14 10:35:25
         compiled from D:%5Cphpstudy%5CWWW%5Cdfshop%5Capplication%5Ctemplates/ueditor/upload_image.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'get_ueditor_image_url', 'D:\\phpstudy\\WWW\\dfshop\\application\\templates/ueditor/upload_image.htm', 42, false),)), $this); ?>

<div class="modal-header" style="padding:0px;">
<h3 id="myModalLabel" class="modal-title" > <span style="margin-left:8px;">上传图片</span> </h3>
</div>
<div class="modal-body">
<div class="tabbable tabbable-custom">
       <div class="portlet box" style=" border:1px solid #EAEAEA;">
        <div class="portlet-body" style="height:430px; width:99%; padding:0px;"> 
          <!-- BEGIN FORM-->
           <iframe width="100%" scrolling="no"  style="border:0px; min-width:800px;" height="400" id='upload_image_id' src=""></iframe>
          <!-- END FORM--> 
        </div>

    </div>
  </div>
</div>
<a title="Close" class="msg-modal-close" data-dismiss="modal" aria-hidden="true" href="javascript:;"></a>

<script>
$modal=$('#ajax-modal');
function load_win()
{
	$('body').modalmanager('removeLoading');
	$('body').modalmanager('loading');
}
function load_Win_rm()
{
	$('body').modalmanager('removeLoading');
}

function close_Win(pic)
{
	$('body').modalmanager('removeLoading');
	$modal.modal('hide');
	try {
		set_back_pic(pic,'<?php echo $_GET['back_id']; ?>
');
	}catch(e){}
}

function show_upload()
{
	$('#upload_image_id').attr('src',"<?php echo ((is_array($_tmp=2)) ? $this->_run_mod_handler('get_ueditor_image_url', true, $_tmp) : get_ueditor_image_url($_tmp)); ?>
"+server_auth+"&up=1"); 
}

function show_imglist(url)
{
	$('#upload_image_id').attr('src',url+server_auth); 
}

$('#upload_image_id').attr('src',"<?php echo ((is_array($_tmp=2)) ? $this->_run_mod_handler('get_ueditor_image_url', true, $_tmp) : get_ueditor_image_url($_tmp)); ?>
"+server_auth+"&up=1&config_width=<?php echo $_GET['config_width']; ?>
&config_height=<?php echo $_GET['config_height']; ?>
"); 

</script> 