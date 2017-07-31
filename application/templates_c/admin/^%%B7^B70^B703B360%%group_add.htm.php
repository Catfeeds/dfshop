<?php /* Smarty version 2.6.20, created on 2017-07-20 13:18:12
         compiled from group_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'f_explode', 'group_add.htm', 58, false),array('modifier', 'strtolower', 'group_add.htm', 60, false),array('modifier', 'md5', 'group_add.htm', 60, false),array('modifier', 'in_array', 'group_add.htm', 60, false),array('modifier', 'site_url', 'group_add.htm', 172, false),)), $this); ?>
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
          <div class="caption"><i class="icon-reorder"></i><?php if (empty ( $this->_tpl_vars['de'] )): ?>添加权限组<?php else: ?>修改权限组<?php endif; ?></div>
        </div>
        <div class="portlet-body form"> 
          <!-- BEGIN FORM-->
          <form action=""  id="form_group_add"  class="form-horizontal" method="post" >
                        <div id='alert-error_1' class="alert alert-error hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交失败</span></div>
            <div id='alert-success_1' class="alert alert-success hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交成功</span></div>
            <div class="control-group">
              <label class="control-label">用户组名称<span class="required">*</span></label>
              <div class="controls">
                <input type="text" name="name" value="<?php echo $this->_tpl_vars['de']['group_name']; ?>
"  class="span6 m-wrap"/>
                <input type="hidden" name="id"  value="<?php echo $this->_tpl_vars['de']['group_id']; ?>
" class="span6 m-wrap"/>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">用户组描述<span class="required">*</span></label>
              <div class="controls">
                 <textarea name="desc" class="span6"><?php echo $this->_tpl_vars['de']['group_desc']; ?>
</textarea>
              </div>
            </div>
			
            <div class="control-group">
                 <table class="table table-striped table-bordered  ">
                     <?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?>
                          <tr valign="top">

                              <?php $_from = $this->_tpl_vars['item']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k1'] => $this->_tpl_vars['item1']):
?>
                                   <?php if (k1 > 0): ?>
                                      <tr  valign="top" >
                                   <?php endif; ?>
                                      <td width="100"> <b> <?php echo $this->_tpl_vars['item1']['0']; ?>
 </b></td>
                                      <td> <?php $_from = $this->_tpl_vars['item1']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['item2']):
?>  <?php $this->assign('ar', ((is_array($_tmp=$this->_tpl_vars['item2'])) ? $this->_run_mod_handler('f_explode', true, $_tmp) : f_explode($_tmp))); ?> 
                                      	
                                      <label style="float:left; margin-right:50px;"> <input type="checkbox" name="perms[]" <?php if (is_array ( $this->_tpl_vars['de']['arr'] ) && ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=($this->_tpl_vars['ar']['2'])."/".($this->_tpl_vars['ar']['0']))) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)))) ? $this->_run_mod_handler('md5', true, $_tmp) : md5($_tmp)))) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['de']['arr']) : in_array($_tmp, $this->_tpl_vars['de']['arr']))): ?>checked="checked"<?php endif; ?> value="<?php echo ((is_array($_tmp=($this->_tpl_vars['ar']['2'])."/".($this->_tpl_vars['ar']['0']))) ? $this->_run_mod_handler('md5', true, $_tmp) : md5($_tmp)); ?>
" /><?php echo $this->_tpl_vars['ar']['3']; ?>
 
                                      	  </label>
                                      <?php endforeach; endif; unset($_from); ?> </td>
                                      
                                   </tr>
                              <?php endforeach; endif; unset($_from); ?> 
                	 <?php endforeach; endif; unset($_from); ?> 
                  </table>
            </div>        


            
            <div class="form-actions">
              <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
              <button type="button"  id='submit_group_add'  class="btn green">提交</button>
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
<script src="/static/js/jquery.nestable.js"></script> 
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<link rel="stylesheet" type="text/css" href="/static/css/jquery.nestable.css" />
<script>

function load_ini()
{
    $('#nestable_list_3').nestable();
	var error1=$('#alert-error_1'); 
	var success1=$('#alert-success_1'); 
	
	var form1 = $('#form_group_add');
	form1.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-inline', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		ignore: "",
		rules: {
			name: {
				required: true
			},
			desc: {
				required: true
			}
		},
		messages : {
			name: {
				required: '权限组名不能为空'
			},
			desc: {
				required: '描述不能为空'
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
	
	$("#submit_group_add").click(function(){
		if(form1.valid()==true)
		{
			//encodeURI(msg)
			$modal=$('#ajax-modal');
			error1.hide();
			success1.show();
			success1.find('span').html('正在提交...........');
			$('body').modalmanager('loading');
			$.post('<?php echo ((is_array($_tmp="group/group_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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
						f_main_index();
						return true;
					}
					
					modal_msg(str.msg);	
				}catch(e){ 
				    alert(msg);
					$('body').modalmanager('removeLoading');
					success1.hide();
					error1.find('span').html('系统异常');
					error1.show();
					modal_msg('系统异常');	
			    };
			});
		}
	});
 
}

</script> 