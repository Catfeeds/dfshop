<?php /* Smarty version 2.6.20, created on 2017-07-25 09:32:02
         compiled from web_ad_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'web_ad_list.htm', 58, false),)), $this); ?>
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
                    <div class="caption"><i class="icon-search"></i>广告搜索</div>
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
                <div id="span_label">广告标题</div>
                </span>
                                <div class="span3" style="margin-left:0px;">
                                    <div class="input-append">
                                        <input class="m-wrap small" type="text" name="search_name" value="<?php echo $_GET['search_name']; ?>
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
                            <span onclick="alertWin('添加广告',800,400,'<?php echo ((is_array($_tmp="adv/web_ad_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?act=add')" class="btn red">添加广告</span>
                            <span onclick="alertWin('添加广告组',800,400,'<?php echo ((is_array($_tmp="adv/web_ad_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?act=process_ad_group')" class="btn green">添加广告组</span>
                            <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                                <thead>
                                <tr role="heading">
                                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">操作</th>
                                    <th width="50"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">ID</th>
                                    <th width="50"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">管理员</th>
                                    <th width="150"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">广告标题</th>
                                    <th width="150"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">广告主图</th>
                                    <th width="150"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">主图宽高</th>
                                    <th width="150"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">广告组</th>
                                    <th width="150"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">是否开启</th>
                                    <th width="200"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">开始时间</th>
                                    <th width="*"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">结束时间</th>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php if ($this->_tpl_vars['re']['list']): ?>
                                <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn mini red product_process" data-type="del" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
">删除</button>
                                        <button type="button"  class="btn mini green "  onclick="alertWin('编辑公告',800,400,'<?php echo ((is_array($_tmp="adv/web_ad_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?act=edit&id=<?php echo $this->_tpl_vars['item']['id']; ?>
')" class="btn red">编辑</span>
                                    </td>
                                    <td>
                                        <?php echo $this->_tpl_vars['item']['id']; ?>

                                    </td>
                                    <td>
                                        <?php echo $this->_tpl_vars['item']['adm_userid']; ?>

                                    </td>
                                    <td style=" vertical-align:middle;"><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
                                    <td style=" vertical-align:middle;"><a class="fancybox" rel="group" href="<?php echo $this->_tpl_vars['item']['pic']; ?>
">查看图片</a></td>
                                    <td style=" vertical-align:middle;">宽度：<?php echo $this->_tpl_vars['item']['width']; ?>
&nbsp;&nbsp;高度：<?php echo $this->_tpl_vars['item']['height']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['group_name']; ?>
</td>
                                    <td>
                                        <?php if ($this->_tpl_vars['item']['status'] == 1): ?>
                                        <span class="label label-important">开启</span>
                                        <?php else: ?>
                                        <span class="label label-success">关闭</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style=" vertical-align:middle;"><?php echo $this->_tpl_vars['item']['add_time']; ?>
</td>
                                    <td style=" vertical-align:middle;"><?php echo $this->_tpl_vars['item']['end_time']; ?>
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
            "sScrollX":'2000px',
            //"sScrollY":"300px",
            // set the initial value
            "iDisplayLength": 10,
            //'sScrollXInner':true,
            //"bSortCellsTop":true,
        });
    }
    $( ".fancybox").fancybox({
        'showNavArrows':'false'
    });
    function load_ini()
    {

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
            if(type=='edit')
            {
                $('body').modalmanager('loading');
                $.post('<?php echo ((is_array($_tmp="adv/web_ad_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?act=edit&id='+id,{},function(msg){
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

            }
            else if(type=='del')
            {
                modal_confirm('确定要执行删除操作吗？',function(){
                    $('body').modalmanager('loading');
                    $.post('<?php echo ((is_array($_tmp="adv/web_ad_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
/?act=delete&id='+id,{},function(msg){
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
                                window.location='';
                                return true;
                            }
                            setTimeout(modal_msg(str.msg),300);
                        }catch(e){
                            $('body').modalmanager('removeLoading');
                            setTimeout(modal_msg('系统异常'),300);
                        };
                    });
                })
            }

        })
    }


</script>