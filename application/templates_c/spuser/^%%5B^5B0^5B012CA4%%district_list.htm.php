<?php /* Smarty version 2.6.20, created on 2017-07-28 09:31:44
         compiled from district_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'district_list.htm', 43, false),)), $this); ?>
<body class="page-header-fixed page-boxed">
<style>
    * {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    div {
        display: block;
    }
    .pbox {
        padding: 10px;
    }

    .font-m {
        font-size: 12px;
    }
    .address-box > div {
        position: relative;
    }
    .address-box > div > div {
        position: absolute;
        top: 0;
        right: 0;
    }

    .font-xl {
        font-size: 16px;
    }
    .well {
        min-height: 20px;
        padding: 19px;
        margin-bottom: 20px;
        background-color: #f5f5f5;
        border: 1px solid #e3e3e3;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
    }
</style>
<div class="container">
    <div class="pbox">
        <a href="<?php echo ((is_array($_tmp='district/district_add')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" id="vShippingAddresses_aLinkToAdd"><input type="button" class="btn blue btn-block" value="新增一个收货地址"></a>
        <?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <div class="well address-box">
            <div class="font-xl">
                <?php echo $this->_tpl_vars['item']['name']; ?>
</span>&nbsp;<?php echo $this->_tpl_vars['item']['mobile']; ?>
&nbsp;
                <div>
                    <a   href="<?php echo ((is_array($_tmp='district/district_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act=edit&id=<?php echo $this->_tpl_vars['item']['id']; ?>
">
                        <span class="icon-pencil"></span>
                    </a>
                    <a  href="javascript:void(0)" class="no_load del" data-action="delete" data-id="<?php echo $this->_tpl_vars['item']['id']; ?>
" >
                    <span class="icon-trash"></span>
                    </a>
                </div>
            </div>
            <div class="font-m">
               <?php echo $this->_tpl_vars['item']['area']; ?>

            </div>
            <div class="font-m">
               <?php echo $this->_tpl_vars['item']['address']; ?>

            </div>
        </div>
        <?php endforeach; endif; unset($_from); ?>

    </div>
</div>
</body>
<script>

        $('.del').each(function(index, element) {
            var  select_id=$(this).attr('data-id');
            var  action = $(this).attr('data-action');
            $(this).on('click',function(){
                if(action=='delete')
                {
                    var tips='确定要删除该收货地址吗？删除后将无法找回';
                }
                modal_confirm(tips,function(){
                    //$('body').modalmanager('loading');
                    $.post("<?php echo ((is_array($_tmp='district/district_list')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act="+action+"&id="+ select_id, '', function(msg){
                        try
                        {
                            // alert(msg)
                            eval("var str="+msg);
                            //操作成功
                            if(str.type==1)
                            {

                            }
                            else if(str.type==2)
                            {
                                window.location='';
                            }
                            else if(str.type==3)
                            {
                                //刷新主页面
                                window.location.reload(true);
                                return true;
                            }
                            setTimeout(modal_msg(str.msg),300)
                        }catch(e){
                            // alert(msg);
                            $('body').modalmanager('removeLoading');
                            setTimeout(modal_msg('系统异常'), 300);
                        };
                    });

                })
            })
        });

</script>