<?php /* Smarty version 2.6.20, created on 2017-07-14 10:34:16
         compiled from product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'product_list.htm', 154, false),)), $this); ?>
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
          <div class="caption"><i class="icon-search"></i>商品规格搜索</div>
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
                <div id="span_label">所属仓库</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_warehoust_id"  aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="">请选择</option>
                    <?php $_from = $this->_tpl_vars['re']['warehouse']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <option <?php if ($_GET['search_warehoust_id'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>

                    </option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
              </div>
              
              <div class="row-fluid" style="margin-top:20px;"> <span class="span1" style="display:block;">
                <div id="span_label">规格显示</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_gg_group_show"  aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">全部</option>
                    <option <?php if ($_GET['search_gg_group_show'] == 0 && is_numeric ( $_GET['search_gg_group_show'] )): ?>selected="selected"<?php endif; ?> value="0">不显示</option>
                    <option <?php if ($_GET['search_gg_group_show'] == 1 && is_numeric ( $_GET['search_gg_group_show'] )): ?>selected="selected"<?php endif; ?> value="1">列表显示</option>
                
                  </select>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">库存状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_seller_status"  aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">全部</option>
                    <option <?php if ($_GET['seller_status'] == 1): ?>selected="selected"<?php endif; ?> value="1">无货</option>
                    <option <?php if ($_GET['seller_status'] == 2): ?>selected="selected"<?php endif; ?> value="2">小于5件</option>
                    <option <?php if ($_GET['seller_status'] == 3): ?>selected="selected"<?php endif; ?> value="3">有货物无销售</option>
                  </select>
                </div>
              </div>
              
             <div class="row-fluid" style="margin-top:20px;"> <span class="span1" style="display:block;">
                <div id="span_label">商品状态</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_gg_group_show"  aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="all">全部</option>
                    <option <?php if ($_GET['search_status'] == 1 && is_numeric ( $_GET['search_status'] )): ?>selected="selected"<?php endif; ?> value="1">上架</option>
                    <option <?php if ($_GET['search_status'] == 0 && is_numeric ( $_GET['search_status'] )): ?>selected="selected"<?php endif; ?> value="0">下架</option>
                    <option <?php if ($_GET['search_status'] == 0 && is_numeric ( $_GET['search_status'] )): ?>selected="selected"<?php endif; ?> value="-1">回收站</option>
                  </select>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">条形码</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <div >
                    <input class="m-wrap small" type="text" name="search_barcode" value="<?php echo $_GET['search_barcode']; ?>
">

                  </div>
                </div>
              </div>
              
              <div class="row-fluid" style="margin-top:20px;"> <span class="span1" style="display:block;">
                <div id="span_label">所属分类</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <select size="1" name="search_catid"  aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                    <option value="">请选择</option>
                    <?php $_from = $this->_tpl_vars['re']['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> <option <?php if ($_GET['search_catid'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php if ($this->_tpl_vars['item']['pid'] != 0): ?>--<?php endif; ?><?php echo $this->_tpl_vars['item']['cat']; ?>

                    </option>
                    <?php endforeach; endif; unset($_from); ?>
                  </select>
                </div>
                <span class="span1" style="display:block;">
                <div id="span_label">商品名称</div>
                </span>
                <div class="span3" style="margin-left:0px;">
                  <div class="input-append">
                    <input class="m-wrap small" type="text" name="search_name" value="<?php echo $_GET['search_cname']; ?>
">
                    <button class="btn green" type="submit">Search</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div>
        <div>
          <div>
            <form action="" method="post" id="product_all">
              <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                <thead>
                  <tr role="heading">
                    <th width="20"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"> <input value="0" type="checkbox" class="group-checkable list-checkable" data-set='#product_all .list-checkable'/>
                    </th>
                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                    <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">状态</th>
                    <th width="60"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">ID</th>
                    <th width="200"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品名称</th>
                    <th width="200"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">规格组</th>
                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">价格</th>
                    <th width="50"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">总库存</th>
                    <th width="50"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">总销量</th>
                    <th width="120"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">条形码</th>
                    <th width="*"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">更新时间</th>
                  </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                <?php if ($this->_tpl_vars['re']['list']): ?>
                <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <tr>
                  <td><input type="checkbox"  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" data-status[]="<?php echo $this->_tpl_vars['item']['filing_status']; ?>
" id="list-checkable" class="list-checkable" /></td>
                  <td><p> <a href="javascript:;" onclick="alertWin('编辑产品-<?php echo $this->_tpl_vars['item']['id']; ?>
',800,400,'<?php echo ((is_array($_tmp='product/product_add')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?act=product_edit&id=<?php echo $this->_tpl_vars['item']['id']; ?>
')">编辑</a> </p>
                    <p> 
                    <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                  	  <a href="#" class="product_process"  data-type="1" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
">下架</a>&nbsp; ︱ <a href="#"  class="product_process"  data-type="2"  data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
">回收站</a>
                    <?php elseif ($this->_tpl_vars['item']['status'] == 0): ?>
                  	  <a href="#" class="product_process"  data-type="3" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
">上架</a>&nbsp; ︱ <a href="#"  class="product_process"  data-type="4"  data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
">回收站</a>
             		<?php elseif ($this->_tpl_vars['item']['status'] == -1): ?>
                      <a href="#" class="product_process"  data-type="5" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
">上架</a>&nbsp; ︱ <a href="#"  class="product_process"  data-type="6"  data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
">彻底删除</a>
                    <?php endif; ?>  
                    </p></td>
                  <td><?php if ($this->_tpl_vars['item']['status'] == 1): ?>销售中<?php endif; ?> <?php if ($this->_tpl_vars['item']['status'] == 0): ?>下架<?php endif; ?> <?php if ($this->_tpl_vars['item']['status'] == -1): ?>已删除<?php endif; ?></td>
                  <td><?php echo $this->_tpl_vars['item']['id']; ?>
 </td>
                  <td><div class="img fl mr10"> <img  src="<?php echo $this->_tpl_vars['item']['pic']; ?>
" style="height:60px;width:60px;border-width:0px;"> </div>
                    <div class="shop-info">
                      <p class="mb5"><a href="#" target="_blank" style="width: auto; display: inline;"><?php echo $this->_tpl_vars['item']['name']; ?>
</a></p>
                    </div></td>
                  <td><p>组ID：<span><?php echo $this->_tpl_vars['item']['group_product_id']; ?>
</span></p>
                    <p>规格：<span> <?php echo $this->_tpl_vars['item']['gg_con_title']; ?>
</span></p>
                    <p>列表显示：<span> <?php if ($this->_tpl_vars['item']['gg_group_show'] == 1): ?><span class="btn mini red">是</span><?php endif; ?> <?php if ($this->_tpl_vars['item']['gg_group_show'] == 0): ?>否<?php endif; ?></span></p></td>
                  <td><p style="color:red;">售价：<br /><span style="margin-left:10px;"><?php echo $this->_tpl_vars['item']['price']; ?>
</span> 元 </p>
                    <p>市场价：<br /><span style="margin-left:10px;"><?php echo $this->_tpl_vars['item']['market_price']; ?>
</span> 元</p></td>
                  <td style=" vertical-align:middle;"><?php echo $this->_tpl_vars['item']['stock']; ?>
</td>
                  <td style=" vertical-align:middle;"><?php echo $this->_tpl_vars['item']['sales']; ?>
</td>
                  <td style=" vertical-align:middle;"><?php echo $this->_tpl_vars['item']['barcode']; ?>
</td>
                  <td style=" vertical-align:middle"><?php echo $this->_tpl_vars['item']['uptime']; ?>
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
                <div  class="input-append">
                  <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
                  <button type="button" data-type="2" class="btn red df_submit">批量删除</button>
                </div>
                <div class="input-append">
                  <select   size="1"  aria-controls="sample_1" class="m-wrap span2" style="width:150px;" name="act_type">
                    <option value="">操作类型</option>
                    <option value="1">商品上架</option>
                    <option value="2">商品下架</option>
                    <option value="3">回收站</option>
                  </select>
                  <span type="button"  class="btn green df_submit">批量操作</span> </div>
              </div>
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
        product_shelves();
        batch_process();
        /* <?php if ($this->_tpl_vars['re']['list']): ?> */
        initTable1();
        /* <?php endif; ?> */

    }

    var product_shelves=function()
    {
        $('.product_process').click(function(){
            var type=$(this).attr('data-type');
            var id=$(this).attr('data-id');
			var lang=Array();
			   	lang[1]='您确定要下架所选商品吗？下架之后的前台将不可销售';	
				lang[2]='1';
				lang[3]='1';
				lang[4]='1';
				lang[5]='1';
				lang[6]='1';
				
			var url=Array();
			   	url[1]='您确定要下架所选商品吗？下架之后的前台将不可销售';	
				url[2]='1';
				url[3]='1';
				url[4]='1';
				url[5]='1';
				url[6]='1';	
			
		   if(type>7)
		   {	
		   	   var ids=''; 
			   $('#product_all .list-checkable').each(function(index,element){
					if($(this).is(':checked') && $(this).val()!=0)
					{
						ids+=$(this).val()+",";
					}
	
				})
		   }
					
		   modal_confirm(lang[type],function(){
				$('body').modalmanager('loading');
				$.post(url[type],{},function(msg){
					try
					{
						//alert(msg);
						eval("var str="+msg);
						//操作成功
						if(str.type==1)
						{

						}
						else if(str.type==2)
						{

						}
						else if(str.type==3)
						{
							//刷新主页面
							f_main_index();
							return true;
						}
						setTimeout(modal_msg(str.msg),300);
					}catch(e){
						$('body').modalmanager('removeLoading');
						setTimeout(modal_msg('系统异常'),300);
					};
				});
			})
			
        })
    }

</script>