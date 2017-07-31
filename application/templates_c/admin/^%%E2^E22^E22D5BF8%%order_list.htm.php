<?php /* Smarty version 2.6.20, created on 2017-07-20 13:21:18
         compiled from order_list.htm */ ?>
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
                    <div class="caption"><i class="icon-search"></i>订单搜索</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a> </div>
                </div>
                <div class="portlet-body" style="display: block;">
                    <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <form action="" method="get" onsubmit="return load_sub();">
                            <div class="row-fluid">
                <span class="span1" style="display:block;">
                <div id="span_label">每页显示</div>
                </span>
                                <div class="span3" style="margin-left:0px;">
                                    <select size="1" name="search_page_num" aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                                        <option <?php if ($_GET['search_page_num'] == 'all'): ?>selected="selected"<?php endif; ?> value="all">每页显示</option>
                                        <option <?php if ($_GET['search_page_num'] == '1'): ?>selected="selected"<?php endif; ?> value="1">15</option>
                                        <option <?php if ($_GET['search_page_num'] == '2'): ?>selected="selected"<?php endif; ?> value="2">30</option>
                                        <option <?php if ($_GET['search_page_num'] == '3'): ?>selected="selected"<?php endif; ?> value="3">50</option>
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
?>
                                        <option <?php if ($_GET['search_warehoust_id'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row-fluid" style="margin-top:20px;">

                 <span class="span1" style="display:block;">
                <div id="span_label">所属分类</div>
                </span>
                                <div class="span3" style="margin-left:0px;">
                                    <select size="1" name="search_catid"  aria-controls="sample_1" class="form_2_select2 m-wrap span5">
                                        <option value="">请选择</option>
                                        <?php $_from = $this->_tpl_vars['re']['cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <option <?php if ($_GET['search_catid'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['cat']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>

                <span class="span1" style="display:block;">
                <div id="span_label">商品名</div>
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
                    <style>
                        .img {
                            width: 60px;
                            height: 60px;
                            overflow: hidden;
                        }

                        .mr10 {
                            margin-right: 10px;
                        }

                        .fl {
                            float: left;
                        }
                        .mb5 {
                            margin-bottom: 5px;
                        }
                        td{
                            vertical-align:middle;
                            text-align:center;
                        }
                    </style>
                    <div>
                        <form action="" method="post"  id='form_order_list'>
                            <table class="table table-striped table-bordered table-hover dataTable" id="table_1" >
                                <thead>
                                <tr role="heading">
                                    <th width="20"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">
                                        <input value="0" type="checkbox" class="group-checkable list-checkable" data-set='#product_all .list-checkable'/>
                                    </th>
                                    <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                                    <th width="200"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单编号</th>
                                    <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">买家</th>
                                    <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">卖家</th>
                                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人</th>
                                    <th width="200"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">收货人地址</th>
                                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">运费</th>
                                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">物流公司</th>
                                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">发货单号</th>
                                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单状态</th>
                                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单生成时间</th>
                                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单付款时间</th>
                                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单发货时间</th>
                                    <th width="*"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">订单最终修改时间</th>
                                    <th style='display:none;' class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1"></th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                    <?php if ($this->_tpl_vars['re']['list']): ?>
                                    <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td style=" vertical-align:middle;" ><input type="checkbox"  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" data-status[]="<?php echo $this->_tpl_vars['item']['filing_status']; ?>
" id="list-checkable" class="list-checkable" /></td>
                                    <td  style=" vertical-align:middle;">
                                        <p>
                                            <button type="button" class="btn mini yellow">查看详情</button>
                                        </p>
                                    </td>
                                    <td  style=" vertical-align:middle;">
                                        <?php echo $this->_tpl_vars['item']['order_id']; ?>
 <span style="margin-left:5px;" class="row-details row-details-close"></span>
                                    </td>
                                    <td><?php echo $this->_tpl_vars['item']['buyer_id']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['seller_id']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['consignee']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['consignee_address']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['logistics_price']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['logistics_name']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['logistics_no']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['status']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['create_time']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['payment_time']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['deliver_time']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['uptime']; ?>
</td>
                                    <td style='display:none;'>
                                        <table class="table table-striped table-hover table-bordered dataTable">
                                            <thead>
                                            <tr>
                                                <th width="100" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品编号</th>
                                                <th width="200" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">商品名称</th>
                                                <th width="200" class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">导入名称</th>
                                                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">是否备案</th>
                                                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">单件价格</th>
                                                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">单件税价</th>
                                                <th width="80"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">单件重量</th>
                                                <th width="*"   class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">数量</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item_list']):
?>
                                            <tr>
                                                <td><?php echo $this->_tpl_vars['item_list']['id']; ?>
</td>
                                                <td><?php echo $this->_tpl_vars['item_list']['id']; ?>
</td>
                                                <td><p style="color: blue"><?php echo $this->_tpl_vars['item_list']['id']; ?>
</p></td>
                                                <td>
                                                    <?php echo $this->_tpl_vars['item_list']['id']; ?>

                                                </td>
                                                <td><p style="color: red"><?php echo $this->_tpl_vars['item_list']['id']; ?>
</p></td>
                                                <td><p style="color: red"><?php echo $this->_tpl_vars['item_list']['id']; ?>
</p></td>
                                                <td><?php echo $this->_tpl_vars['item_list']['id']; ?>
</td>
                                                <td><?php echo $this->_tpl_vars['item_list']['id']; ?>
</td>
                                            </tr>
                                            <?php endforeach; endif; unset($_from); ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php else: ?>
                                    <tr>
                                    <td colspan="99">暂时无数据</td>
                                    </tr>
                                    <?php endif; ?>
                            </table>
                            <div class="input-append">
                                <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
                            </div>
                            <div class="input-append">
                                <button type="button" data-type="1" class="btn blue df_submit">批量备注</button>
                            </div>
                            <div class="input-append">
                                <button type="button" data-type="2" class="btn red df_submit">批量删除</button>
                            </div>
                            <div class="input-append">
                                <button type="button" data-type="2" class="btn green df_submit">同步发货订单</button>
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
    var initTable1 = function()
    {
        /* Formating function for row details */
        /*
         * Insert a 'details' column to the table
         */
        var oTable = $('#table_1').dataTable( {
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
            "bAutoWidth":true ,
            "bStateSave":false,
            "sScrollX":'2100px',
            //"sScrollY":"300px",
            // set the initial value
            "iDisplayLength": 10,
            //'sScrollXInner':true,
            //"bSortCellsTop":true,
        });
        /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = aData[15];
            return sOut;
        }

        $('#table_1').on('click', ' tbody td .row-details', function ()
        {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                $(this).addClass("row-details-close").removeClass("row-details-open");
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */
                $(this).addClass("row-details-open").removeClass("row-details-close");
                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
            }
        });


    }

    function load_ini()
    {
        /* <?php if ($this->_tpl_vars['re']['list']): ?> */
        initTable1();
        /* <?php endif; ?> */
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
    }


</script>