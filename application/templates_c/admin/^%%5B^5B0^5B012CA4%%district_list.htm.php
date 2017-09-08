<?php /* Smarty version 2.6.20, created on 2017-08-15 13:57:19
         compiled from district_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'substr', 'district_list.htm', 51, false),array('modifier', 'site_url', 'district_list.htm', 52, false),)), $this); ?>
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
            <div>
                <div>
                    <div>

                        <form action="" method="post" id="product_all">
                            <table class="table table-striped table-bordered table-hover dataTable" id="product_1" >
                                <thead>
                                <tr role="heading">
                                    <th width="50"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">
                                        <input value="0" type="checkbox" class="group-checkable list-checkable" data-set='#product_all .list-checkable'/>
                                    </th>
                                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">排序</th>
                                    <th width="100"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">ID</th>
                                    <th width="*"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">名称</th>
                                    <th width="150"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">上级ID</th>
                                    <th width="150"  class="sorting_disabled" role="columnheader" tabindex="0" aria-controls="sample_1">子类总数</th>

                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td style=" vertical-align:middle;" ><input type="checkbox"  value="<?php echo $this->_tpl_vars['item']['id']; ?>
" data-status[]="<?php echo $this->_tpl_vars['item']['filing_status']; ?>
" id="list-checkable" class="list-checkable" /></td>
                                    <td>
                                        <input type="text" value="<?php echo $this->_tpl_vars['item']['sorting']; ?>
" name="sorting" class="m-wrap small">
                                    </td>
                                    <td>
                                        <?php echo $this->_tpl_vars['item']['id']; ?>

                                    </td>
                                    <td><input type="text"  value="<?php echo $this->_tpl_vars['item']['name']; ?>
" class="m-wrap large"></td>
                                    <td>
                                        <input type="text" value="<?php echo $this->_tpl_vars['item']['pid']; ?>
" class="m-wrap small">
                                    </td>
                                    <td>
                                        <?php if (((is_array($_tmp=$this->_tpl_vars['item']['id'])) ? $this->_run_mod_handler('substr', true, $_tmp, '4') : substr($_tmp, '4')) == '00'): ?>
                                        <a href="<?php echo ((is_array($_tmp='district/district_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act=find_child&pid=<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['child_num']; ?>
</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; endif; unset($_from); ?>
                                <?php if ($this->_tpl_vars['re']['pid'] != 0): ?>
                                <tr>
                                    <td style=" vertical-align:middle;">
                                        <button type="button" class="btn mini green dis_add">新增</button>
                                        <input type="hidden" name="act" value="add">
                                    </td>
                                    <td>
                                        <input type="text"  name="sorting" class="m-wrap small">
                                    </td>
                                    <td>

                                    </td>
                                    <td><input type="text"  name="name" class="m-wrap large"></td>
                                    <td>
                                        <input type="hidden" name="pid" value="<?php echo $this->_tpl_vars['re']['pid']; ?>
">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <?php endif; ?>

                                </tbody>
                            </table>
                            <div class="input-append">
                                <input value="0" type="checkbox" class="group-checkable list-checkable"  data-set='#product_all .list-checkable' />
                            </div>
                            <div class="input-append">
                                <button type="button" data-url="<?php echo ((is_array($_tmp='district/district_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" data-act="sort" class="btn green df_submit">排序</button>
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
             //"sScrollX":'1500px',
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

        /* <?php if ($this->_tpl_vars['re']['list']): ?> */
        initTable1();
        /* <?php endif; ?> */
        process_batch();
        dis_add();
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

    var dis_add =function()
    {
        $('.dis_add').click(function(){
            var form=$('#product_all') ;
            $.post('<?php echo ((is_array($_tmp="district/district_list")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
',form.serialize(),function(msg){
               // alert(msg);
                try
                {
                    eval("var str="+msg);
                    //操作成功
                    if(str.type==1)
                    {
                        //错误提示
                    }
                    else if(str.type==2)
                    {
                        //提交成功
                    }
                    else if(str.type==3)
                    {
                        //刷新主页面
                        window.location="<?php echo ((is_array($_tmp='district/district_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act=find_child&pid="+str.id;
                    }
                    setTimeout(modal_msg(str.msg),300);
                }catch(e){
                    $('body').modalmanager('removeLoading');
                    setTimeout(modal_msg('系统异常'),300);
                };
            });
        });
    }


    var process_batch = function()
    {
        $('.df_submit').click(function(){
            var url= $(this).attr('data-url');
            var act=$(this).attr('data-act');
            var item='';
            $(":checkbox").each(function(){
                if($(this).attr("checked")){
                    if($(this).val()!=0){
                        var sort_id=$(this).parents('td').next().find('input').val();
                        if(sort_id>255)
                        {
                            return;
                        }
                        item=item+$(this).val()+"|"+sort_id+",";
                    }
                }
            })
            if(item=='')
            {
                return;
            }
            if(act=='sort')
            {
                msg='确定要执行排序操作么？';
            }
            modal_confirm(msg,function(){
                $.post(url+'?act='+act+'&item='+item+"&pid=<?php echo $this->_tpl_vars['re']['pid']; ?>
",function(msg){
                   // alert(msg);
                    try
                    {
                        eval("var str="+msg);
                        //操作成功
                        if(str.type==1)
                        {
                            //错误提示
                        }
                        else if(str.type==2)
                        {
                            //提交成功
                        }
                        else if(str.type==3)
                        {
                            //刷新主页面
                            window.location="<?php echo ((is_array($_tmp='district/district_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act=find_child&pid="+str.id;
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