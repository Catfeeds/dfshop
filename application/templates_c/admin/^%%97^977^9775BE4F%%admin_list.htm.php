<?php /* Smarty version 2.6.20, created on 2017-07-20 11:32:19
         compiled from admin_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'admin_list.htm', 78, false),)), $this); ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
      <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
          <?php echo $this->_tpl_vars['select_admin_name']; ?>

      </ul>
      <!-- END PAGE TITLE & BREADCRUMB--> 
    </div>
  </div>
  <!-- END PAGE HEADER--> 
  <!-- BEGIN PAGE CONTENT-->
  <div class="row-fluid">
    <div class="span12">
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption"><i class="icon-search"></i>管理员搜索</div>
          <div class="tools"> <a href="javascript:;" class="collapse"></a> </div>
        </div>
        <div class="portlet-body" style="display: block;">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <form action="" method="get" onsubmit="return load_sub();">
              <div class="row-fluid"> <span class="span1" style="display:block;">
                <div id="span_label">每页显示</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_page_num" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option <?php if ($_GET['search_page_num'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">每页显示
                    </option>
                    <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?> value="1">15
                    </option>
                    <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?> value="2">30
                    </option>
                    <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?> value="3">50
                    </option>
                  </select>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">管理员组</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2"  name="search_group_id" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all" selected="selected" >所有组</option>
                    <option value="0"   <?php if ($_GET['search_group_id'] == 0 && isset ( $_GET['search_group_id'] ) && $_GET['search_group_id'] != 'all'): ?>selected="selected"<?php endif; ?> >总管理员组
                    </option>
                    <?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?> <option value="<?php echo $this->_tpl_vars['v']['group_id']; ?>
" <?php if ($_GET['search_group_id'] == $this->_tpl_vars['v']['group_id']): ?>selected="selected"<?php endif; ?> ><?php echo $this->_tpl_vars['v']['group_name']; ?>

                    </option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
              </div>
              <div class="row-fluid" style="margin-top:20px;"> <span class="span1" style="display:block;">
                <div id="span_label">是否关闭</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" id="form_2_select2"  name="search_status" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">所有状态</option>
                    <option value="0" <?php if ($_GET['search_status'] == 0 && isset ( $_GET['search_status'] ) && $_GET['search_status'] != 'all'): ?>selected="selected"<?php endif; ?> >关闭
                    </option>
                    <option value="1" <?php if ($_GET['search_status'] == 1): ?>selected="selected"<?php endif; ?> >开启
                    </option>
                  </select>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">管理姓名</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <div class="input-append">
                    <input class="m-wrap small" type="text" name="search_cname" value="<?php echo $_GET['search_cname']; ?>
">
                    <button class="btn green" type="submit">Search</button>
                  </div>
                </div>
              </div>
              
              <div class="row-fluid" style="margin-top:20px;">
                <div class="span3" style="margin-left:0px;"> <span onclick="alertWin('添加管理员',800,400,'<?php echo ((is_array($_tmp="user/admin_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
')" class="btn red">添加管理员</span> </div>
              </div>
              
            </form>
          </div>
        </div>
      </div>
      <div>
        <div>
          <div>
            <form action="" method="post">
              <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                <thead>
                  <tr role="heading">
                    <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                    <th width="40"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">状态</th>
                    <th width="40"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">UID</th>
                    <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">登陆账号</th>
                    <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">姓名</th>
                    <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">所属组</th>
                    <th width="70"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">类型</th>
                    <th width="130" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">最后登陆时间</th>
                    <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">最后登陆IP</th>
                  </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                <?php if ($this->_tpl_vars['re']['list']): ?>
                <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr>
                  <td><a href="#" onclick="alertWin('编辑管理员',800,400,'<?php echo ((is_array($_tmp="user/admin_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn green mini"><i class="icon-edit"></i> 编辑</a></td>
                  <td><?php if ($this->_tpl_vars['item']['status'] == 1): ?> <span class="label label-important">开启</span> <?php else: ?> <span class="label label-success">关闭</span> <?php endif; ?> </td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['user']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['group_name']; ?>
</td>
                  <td><?php if ($this->_tpl_vars['item']['type'] == 1): ?>总管理员<?php else: ?>分管理员<?php endif; ?></td>
                  <td><?php echo $this->_tpl_vars['item']['lastlogotime']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['item']['logoip']; ?>
</td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                <tr>
                  <td colspan="99">暂时无数据</td>
                </tr>
                <?php endif; ?>
              </table>
              <div class="row-fluid">
                <div class="span6"> </div>
                <div class="clear"></div>
                <div class="span6">
                  <div class="dataTables_paginate paging_bootstrap pagination"> <?php echo $this->_tpl_vars['re']['page']; ?>
 </div>
                </div>
              </div>
            </form>
          </div>
          <!--show window--> 
        </div>
      </div>
    </div>
  </div>
  <!-- END PAGE CONTENT--> 
</div>
<link href="/static/css/jquery.fancybox.css" rel="stylesheet">
<script src="/static/js/jquery.fancybox.pack.js"></script> 
<script>
$('.form_2_select2').select2({
            placeholder: "请选择",
            allowClear: true
});
var bind_window=function()
{
	 App.initFancybox();
	$.fn.modalmanager.defaults.resize = true;
	$.fn.modalmanager.defaults.spinner = '<div class="loading-spinner fade" style="width: 200px; margin-left: -100px;"><img src="/static/ajax-modal-loading.gif" align="middle">&nbsp;<span style="font-weight:300; color: #eee; font-size: 18px; font-family:Open Sans;">&nbsp;Loading...</div>';
	var $modal = $('#ajax-modal');
	$('#product_1 .show_detail').each(function(index, element) {
		  var  select_id=$(this).attr('data-id');
		  $(this).on('click', function(){
			  // create the backdrop and wait for next modal to be triggered
			  $('body').modalmanager('loading');
				setTimeout(function(){
				 $modal.load('?m=product&s=bs_pro&select_id='+ select_id, '', function(){
					$modal.modal();
					//$modal.css('margin-top','0');
				 });
				}, 200);
		});
	});
}
//row-details row-details-close
var initTable1 = function() {
        /* Formating function for row details */
        /*
         * Insert a 'details' column to the table
         */
		var oTable = $('#product_1').dataTable( {
           "aoColumnDefs": [
               {"bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']],
            "aLengthMenu": [
               [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
           ],
		    "oLanguage": {
					"sProcessing": "正在加载中......",
					"sLengthMenu": "每页显示 _MENU_ 条记录",
					"sZeroRecords": "正在加载中......",
					"sEmptyTable": "查询无数据！",
					"sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
					"sInfoEmpty": "显示0到0条记录",
					"sInfoFiltered": "数据表中共为 _MAX_ 条记录",
					"sSearch": "当前页数据搜索",
					"oPaginate": {
					 "sFirst": "首页",
					 "sPrevious": "上一页",
					 "sNext": "下一页",
					 "sLast": "末页"
					}
  			},
			"bSort":false,
			"bInfo":false,
			"bPaginate":false,
			"bAutoWidth":true,
			"bStateSave":false,
			"sScrollX":'1690px',
			//"sScrollY":"300px",
      // set the initial value
      "iDisplayLength": 10,
			//'sScrollXInner':true,
			//"bSortCellsTop":true,
        });
    }

function load_ini()
{
	bind_window();
	/* <?php if ($this->_tpl_vars['re']['list']): ?> */
	initTable1();
	/* <?php endif; ?> */
	/*
	jQuery('.group-checkable').change(function () {
	  var set = jQuery(this).attr("data-set");
	  var checked = jQuery(this).is(":checked");
	  jQuery(set).each(function () {
		  if (checked) {
			  $(this).attr("checked", true);
		  } else {
			  $(this).attr("checked", false);
		  }
	  });
	  jQuery.uniform.update(set);
	});
	*/	
}
</script> 