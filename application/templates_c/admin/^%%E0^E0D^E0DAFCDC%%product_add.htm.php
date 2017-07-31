<?php /* Smarty version 2.6.20, created on 2017-07-14 10:34:16
         compiled from product_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'product_add.htm', 31, false),array('modifier', 'site_url', 'product_add.htm', 286, false),array('modifier', 'get_ueditor_image_url', 'product_add.htm', 379, false),)), $this); ?>
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
          <div class="caption"><i class="icon-reorder"></i>添加商品仓库和分类</div>
        </div>
        <div class="portlet-body form"> 
          <!-- BEGIN FORM-->
          <form action=''  id="form_submit"  class="form-horizontal" method="post" >
            <?php if (empty ( $this->_tpl_vars['re']['catid'] ) || empty ( $this->_tpl_vars['re']['warehouse_id'] )): ?>
            <div class="control-group">
              <label class="control-label">仓库<span class="required">*</span></label>
              <div class="controls">
                <select size="1" name="proj_id" id="select_warehouse_id" aria-controls="sample_1" class="form_2_select2 m-wrap span6">
                  <option value="">请选择</option>
                  <?php $_from = $this->_tpl_vars['re']['warehouse']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                  <option value="<?php echo $this->_tpl_vars['item']['id']; ?>
|<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">分类<span class="required">*</span></label>
              <div class="controls">
                <select size="1" name="proj_id"  id="select_cat" aria-controls="sample_1" class="form_2_select2 m-wrap span6">
                  <option value="">请选择</option>
                  <?php $_from = $this->_tpl_vars['re']['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                  <option value="<?php echo $this->_tpl_vars['item']['id']; ?>
|<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['cat'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo $this->_tpl_vars['item']['cat']; ?>
</option>
                  <?php endforeach; endif; unset($_from); ?>
                </select>
              </div>
            </div>
            
            <div class="control-group" id="c_ele"> </div>
            <div class="form-actions">
              <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
              <input type="hidden" value='<?php echo $this->_tpl_vars['re']['c_cat']; ?>
' id="c_cat">
              <button type="button" id='submit_btn_next' class="btn green">下一步</button>
            </div>
            <?php endif; ?>
            
            <?php if (! empty ( $this->_tpl_vars['re']['catid'] ) && ! empty ( $this->_tpl_vars['re']['warehouse_id'] )): ?>
                        <div id='alert-error_1' class="alert alert-error hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交失败</span> </div>
            <div id='alert-success_1' class="alert alert-success hide">
              <button class="close" data-dismiss="alert"></button>
              <span>提交成功</span> </div>
            <table class="table table1">
              <thead>
                <tr>
                  <th class="partition" colspan="99">商品基本信息</th>
                </tr>
              </thead>
              <tr>
			      <td colspan="99"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'product_htm_info.htm', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </td>
               </tr>   
              <thead>
                <tr>
                  <th class="partition" colspan="99">商品图片 </th>
                </tr>
              </thead>
              <tr>
                <td colspan="99"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'product_htm_pic.htm', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
              <thead>
                <tr>
                  <th class="partition" colspan="99">商品价格规格  </th>
                </tr>
              </thead>
              <tr>
                <td colspan="99"> 
                      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'product_htm_gg.htm', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'product_htm_detail.htm', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                 </td>
              </tr>
            </table>
            <div class="form-actions">
              <input type="hidden" name="type" value="add">
              <input type="hidden" name="<?php echo $this->_tpl_vars['csrf']['name']; ?>
" value="<?php echo $this->_tpl_vars['csrf']['hash']; ?>
">
              <button type="button"  id='submit_btn_prev' class="btn green">上一步</button>
              <button type="button"  id='submit_btn' class="btn red">提交</button>
            </div>
            <?php endif; ?>
          </form>
          <!-- END FORM--> 
        </div>
      </div>
      <!-- END VALIDATION STATES--> 
    </div>
  </div>
  <!-- END PAGE CONTENT--> 
</div>
<link href="/static/css/jquery.fancybox.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script type="text/javascript" src="/static/js/jquery.validate.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script>
<link rel="stylesheet" type="text/css" href="/static/css/datepicker.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
">
<script type="text/javascript" src="/static/js/bootstrap-datepicker.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>
    var server_auth="<?php echo $this->_tpl_vars['ueditor_auth']; ?>
";
</script> 
<script>
    /*日期选择*/
    $('.date-picker').datepicker({
        format:'yyyy-mm-dd',
        language: 'zh-CN',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 0,
        startView: 0,
        forceParse: 0,
        showMeridian: 1
    });

    function  set_back_pic(pic,back_id)
    {
        $('#'+back_id).val(pic);
        $('#'+back_id+'_bg').attr('src',pic);
        $('body').modalmanager('removeLoading');
    }
	
    $('.form_2_select2').select2({
        placeholder: "请选择",
        allowClear: true
    });
	

	var sub_from=function(){
		var error1=$('#alert-error_1');
        var success1=$('#alert-success_1');

        var form1 = $('#form_submit');
        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-inline', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                name: {
                    required: true
                }
                ,
                hg_type: {
                    required: true
                }
                ,
                brand:{
                    required: true
                }
                ,
                country:{
                    required:true
                }
                ,
				/*
                temp_id:{
                    required:true
                }
                ,*/
                weight:{
                    required:true
                }
                ,
                cubage:{
                    required:true
                }

                ,
                rate:{
                    required:true
                }
                ,
                keywords:{
                    required:true
                }
                ,
               
                start_time:{
                    required:true
                }
                ,
                valid_time:{
                    required:true
                }
            },
            messages : {
                name:{
                    required:'必填'
                }
                ,
                hg_type: {
                    required: '必填'
                }
                ,
                brand: {
                    required: '必填'
                }
                ,
                country: {
                    required: '必填'
                }
                ,
               /* temp_id: {
                    required: '必填'
                }
                ,*/
                weight: {
                    required: '必填'
                }
                ,
                cubage: {
                    required: '必填'
                }


                ,
                rate: {
                    required: '必填'
                }
                ,
                keywords: {
                    required: '必填'
                }
                ,
               
                start_time: {
                    required: '必填'
                }
                ,
                valid_time: {
                    required: '必填'
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
                label.addClass('valid').addClass('help-inline') // mark the current input as valid and display OK icon
                        .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
            },
            submitHandler: function (form) {

            }
        });
		//无规格时
				
        $("#submit_btn_next").click(function()
        {
            var warehouse_id = $("#select_warehouse_id option:selected").val();
            var cat_id = $("#select_cat_id  input:radio:checked").val();
            if (warehouse_id && cat_id )
            {
                window.location.href = '<?php echo ((is_array($_tmp="product/product_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?index=1&warehouse_id='+warehouse_id+'&cat_id='+cat_id;
            };
        });

        $("#submit_btn_prev").click(function()
        {
            window.location.href = '<?php echo ((is_array($_tmp="product/product_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
';
        });

        $("#submit_btn").click(function(){
			
            if ( form1.valid()==true )
            {
                //encodeURI(msg)
                $modal=$('#ajax-modal');
                error1.hide();
                success1.show();
                success1.find('span').html('正在提交...........');
                $('body').modalmanager('loading');

                $.post('<?php echo ((is_array($_tmp="product/product_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
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
	

    var change_cat=function()
    {
        $('#select_cat').change(function()
        {
            $('#c_ele').empty();
            var cat= $(this).val().split("|");
            var cat_id=cat[0];//分类ID
            var c_el=$('<label class="control-label"></label> <div class="control span4" id="select_cat_id"> </div>');
            $('#c_ele').append(c_el);
            //子级分类
            var c_cat= eval($('#c_cat').val());
            for(var i=0;i<c_cat.length; i++)
            {
                if(c_cat[i].pid==cat_id)
                {
                    var cc=$('<label class="radio line" > <input type="radio"   name="c_cat"   value="'+c_cat[i].id+'|'+encodeURI(c_cat[i].cat)+'"/>'+ c_cat[i].cat +'</label> ');
                    $('#c_ele div.control').append(cc);
                }
            }
        })
    }
	

    function load_ini()
    {
		
        change_cat();
		sub_from();
        $('.upload_image').bind('click',function(){
            $.fn.modal.defaults.width='80%';
            $.fn.modal.defaults.height='400px';
            $modal=$('#ajax-modal');
            $modal.load('<?php echo ((is_array($_tmp=1)) ? $this->_run_mod_handler('get_ueditor_image_url', true, $_tmp) : get_ueditor_image_url($_tmp)); ?>
<?php echo $this->_tpl_vars['ueditor_auth']; ?>
&back_id='+$(this).attr('data-id'),'', function(){
                $modal.modal();
            });
        });
    }

</script> 