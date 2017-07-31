<?php /* Smarty version 2.6.20, created on 2017-07-20 13:19:00
         compiled from admin_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'admin_add.htm', 196, false),)), $this); ?>
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
              <div class="caption"><i class="icon-reorder"></i><?php if (empty ( $this->_tpl_vars['de']['id'] )): ?>添加管理员<?php else: ?>修改管理员<?php endif; ?></div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
              <form action=""  id="form_admin_add"  class="form-horizontal" method="post" >
                              <div id='alert-error_1' class="alert alert-error hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>提交失败</span></div>
                <div id='alert-success_1' class="alert alert-success hide">
                  <button class="close" data-dismiss="alert"></button>
                  <span>提交成功</span></div>

                <div class="control-group">
                  <label class="control-label">用户账号<span class="required">*</span></label>
                  <div class="controls">
                   <?php if (empty ( $this->_tpl_vars['de']['id'] )): ?>
                   	   <input type="text" name="ps_user"  class="span6 m-wrap"/>
                   <?php else: ?>
                    <label class="control-label" style="text-align:left;"><?php echo $this->_tpl_vars['de']['user']; ?>
</label>
                     <input type="hidden" name="ps_id"  value="<?php echo $this->_tpl_vars['de']['id']; ?>
" class="span6 m-wrap"/>
                   <?php endif; ?>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">用户姓名<span class="required">*</span></label>
                  <div class="controls">
                   <input type="text" name="ps_name" value="<?php echo $this->_tpl_vars['de']['name']; ?>
" class="span6 m-wrap"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">管理员组<span class="required">*</span></label>
                  <div class="controls">
                
                  
                   <select size="1" id="form_2_select2"  name="ps_group_id" class="form_2_select2 m-wrap span6">
                      <option value="all" selected="selected" >所有组</option>
                      <option value="0"   
                      <?php if ($this->_tpl_vars['de']['group_id'] == 0 && isset ( $this->_tpl_vars['de']['group_id'] ) && $this->_tpl_vars['de']['group_id'] != 'all'): ?>selected="selected"<?php endif; ?>  >总管理员组</option>
                      <?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
                      	<option value="<?php echo $this->_tpl_vars['v']['group_id']; ?>
"   <?php if ($this->_tpl_vars['de']['group_id'] == $this->_tpl_vars['v']['group_id']): ?>selected="selected"<?php endif; ?>  ><?php echo $this->_tpl_vars['v']['group_name']; ?>
</option>
                      <?php endforeach; endif; unset($_from); ?>
                    </select>
                  </div>
                </div>   
                
                
                
                <div class="control-group">
                  <label class="control-label">登陆密码<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="ps_password"  class="span6 m-wrap"/>
                  </div>
                </div>
               
               <div class="control-group">
                  <label class="control-label">描述</label>
                  <div class="controls">
                   <textarea name="ps_desc" class="span6 m-wrap" ><?php echo $this->_tpl_vars['de']['desc']; ?>
</textarea>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">状态<span class="required">*</span></label>
                  <div class="controls">
                   <select size="1" id="form_2_select2"  name="ps_status" class="form_2_select2 m-wrap span6">
                      <option value="all" selected="selected" >所有状态</option>
                      <option value="0"   <?php if ($this->_tpl_vars['de']['status'] == 0): ?>selected="selected"<?php endif; ?>   >关闭</option>
					  <option value="1"   <?php if ($this->_tpl_vars['de']['status'] == 1): ?>selected="selected"<?php endif; ?>   >启动</option>
                    </select>
                  </div>
                </div>   
                
                <div class="form-actions">
                  <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
                  <button type="button"  id='submit_admin_add'  class="btn green">提交</button>
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

<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>

function load_ini()
{
	var error1=$('#alert-error_1'); 
	var success1=$('#alert-success_1'); 
	
	var form1 = $('#form_admin_add');
	form1.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-inline', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		ignore: "",
		rules: {
			ps_name: {
				required: true
			}
			,
			ps_user: {
				required: true
			}
		},
		messages : {
			ps_name:{
				 required:'账号不能为空',
			 }
			,
			ps_user: {
				required: '登陆账号不能为空'
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
			$.post('<?php echo ((is_array($_tmp="user/admin_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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
					
					setTimeout(function(){
					 $modal.load('<?php echo ((is_array($_tmp="admin_index/admin_msg")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?msg='+encodeURI(str.msg),'', function(){
						$modal.modal();
					 });
					}, 300);
				}catch(e){ 
				    alert(msg);
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