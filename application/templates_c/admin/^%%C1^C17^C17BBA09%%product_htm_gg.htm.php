<?php /* Smarty version 2.6.20, created on 2017-07-14 10:34:35
         compiled from product_htm_gg.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'check_gg_con', 'product_htm_gg.htm', 49, false),array('modifier', 'escape', 'product_htm_gg.htm', 58, false),array('modifier', 'site_url', 'product_htm_gg.htm', 132, false),)), $this); ?>

<div class="row-fluid" style="margin-top:10px;">
  <div class="span4" >
    <label class="control-label" style="color:red;">销售价<span class="required">*</span></label>
    <div class="controls">
      <input type="text"  class="span12 m-wrap" id='price' value="<?php echo $this->_tpl_vars['re']['price']; ?>
"  name="price" />
    </div>
  </div>
  <div class="span4" >
    <label class="control-label">市场价<span class="required">*</span></label>
    <div class="controls">
      <input type="text"  id='market_price1' class="span12 m-wrap" name="market_price"   value="<?php echo $this->_tpl_vars['re']['price']; ?>
"  />
    </div>
  </div>
</div>
<div class="row-fluid" style="margin-top:10px;">
  <div class="span4" >
    <label class="control-label">商品库存<span class="required">*</span></label>
    <div class="controls">
      <input type="text" id='stock' class="span12 m-wrap" name="stock"  value="<?php echo $this->_tpl_vars['re']['stock']; ?>
"  />
    </div>
  </div>
  <div class="span4" >
    <label class="control-label">货号<span class="required">*</span></label>
    <div class="controls">
      <input type="text" id='barcode' class="span12 m-wrap" name="barcode"  value="<?php echo $this->_tpl_vars['re']['barcode']; ?>
"  />
    </div>
  </div>
</div>
<div class="row-fluid" style="margin-top:10px;">

  <?php if ($this->_tpl_vars['gg_con']['cons'] || empty ( $this->_tpl_vars['re']['name'] )): ?>
      <div class="span12" >
        <label class="control-label">规格<span class="required">*</span></label>
        <div class="controls" >
        
              <table id='gg_checkbox'  class="table table-striped table-bordered">
                <tr>
                  <th width="80">规格名称</th>
                  <td>规格项目</td>
                </tr>
                <?php $_from = $this->_tpl_vars['re']['gg_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?>
                <tr>
                  <td><label class="checkbox inline"><?php echo $this->_tpl_vars['item']['name']; ?>
</label></td>
                  <td><?php $_from = $this->_tpl_vars['item']['con_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
                    <label class="checkbox inline"> 
                    
                        <?php if (! empty ( $this->_tpl_vars['gg_con']['cons'] )): ?>
                          <?php $this->assign('check_flag', ((is_array($_tmp=$this->_tpl_vars['v']['id'])) ? $this->_run_mod_handler('check_gg_con', true, $_tmp, $this->_tpl_vars['gg_con']['cons']) : check_gg_con($_tmp, $this->_tpl_vars['gg_con']['cons']))); ?>
                          <?php $this->assign('name', ((is_array($_tmp=$this->_tpl_vars['v']['id'])) ? $this->_run_mod_handler('check_gg_con', true, $_tmp, $this->_tpl_vars['gg_con']['cons'], 2) : check_gg_con($_tmp, $this->_tpl_vars['gg_con']['cons'], 2))); ?>
                        <?php else: ?>  
                          <?php $this->assign('name', $this->_tpl_vars['v']['name']); ?>
                        <?php endif; ?>      
                        
                        <?php if ($this->_tpl_vars['check_flag'] == 1): ?>
                         <input type="checkbox" style="border:1px solid red;"  checked="checked" disabled="disabled"  >
                         <div style="display:none;">
                         <input type="checkbox"  checked="checked" class="gg_item" value="<?php echo $this->_tpl_vars['v']['id']; ?>
"  name="gg_ids[<?php echo $this->_tpl_vars['v']['id']; ?>
]" data-gg-id="<?php echo $this->_tpl_vars['item']['id']; ?>
"  data-gg-name="<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"  data-name="<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" >
                        </div>	
                      <?php else: ?>
                          <input type="checkbox"  class="gg_item" value="<?php echo $this->_tpl_vars['v']['id']; ?>
"  name="gg_ids[<?php echo $this->_tpl_vars['v']['id']; ?>
]" data-gg-id="<?php echo $this->_tpl_vars['item']['id']; ?>
"  data-gg-name="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"  data-name="<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" >
                      <?php endif; ?>
        
                      <input class="item_v"  type="text" id='item_gg_<?php echo $this->_tpl_vars['v']['id']; ?>
' name="gg_name[<?php echo $this->_tpl_vars['item']['id']; ?>
][<?php echo $this->_tpl_vars['v']['id']; ?>
]" value="<?php echo $this->_tpl_vars['name']; ?>
" />
                    </label>
                    <?php endforeach; endif; unset($_from); ?> </td>
                </tr>
                <?php endforeach; endif; unset($_from); ?>
              </table>
        </div>
      </div>
      <div class="span12" style="margin-left:0px;" >
        <label class="control-label">规格清单<span class="required">*</span></label>
        <div class="controls" > 
             <div  id='gg_list' style="overflow-x:hidden; width:100%;">
             
             </div>
        </div> 
      </div>
  <?php elseif ($this->_tpl_vars['re']['gg_list']): ?>
   <div class="span12" >
     <div class="controls" >
       1.当前分类有规格，该产品无规格;<br />
       2.可关联到【相同分类】新产品和有规格的产品中;
       </div></div>
  <?php endif; ?>
</div>
<style>
#gg_selected td{background:#039;background:#039!important; color:#fff;}
div.checker.disabled, div.checker.disabled.active{ background:#999;}
</style>
<script>

//关联产品
function link_product(k,p)
{
   var check_id=0;
   $('#gg_list .pid_v').each(function(index,element) {
    	if($(this).val()==p[5])
		{
			check_id=p[5];
			return 0;
		}
   });
   
   if(check_id!=0)
	  return 0;
	  
   $("#gg_price_"+k).val(p[1]);	
   $("#gg_mark_price_"+k).val(p[2]);	
   $("#gg_barcode_"+k).val(p[3]);	
   $("#gg_num_"+k).val(p[4]);	
   $("#pid_"+k).html(p[5]);	
   $("#pid_v_"+k).val(p[5]);	
   $("#gg_list input[name='gg_status["+k+"]']").eq(0).attr('checked','true');
   $('#ajax-modal_1').modal('hide');
   return 1;
}

var b_product=function()
{
	  $("#gg_list .show_product").each(function(index, element) {
				$(this).unbind('click').bind('click',function(){
					//先确认删除关联才能关联新产品
					var old_pid=$("#gg_list .show_product").eq(index).attr('data-old_pid');
					var key=$(this).attr('data-id');
					if(old_pid!=''&&old_pid!='0')
					{
						if(old_pid=='<?php echo $this->_tpl_vars['re']['id']; ?>
')
						{
							modal_confirm('删除【当前产品规格】将【刷新页面】不能进行关联操作要继续吗?',function(){
								$.post('<?php echo ((is_array($_tmp="product/product_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act=del_gg',{old_pid:old_pid},function(msg){
									if(msg==1)
									{
										f_main_index();
										return;
									}
									else
										modal_msg(msg);
								});	
							});
							return ;
						}
						
						modal_confirm('该规格已关联-'+old_pid+"该规格已有关联产品,删除关联才能关联其他产品,删除关联请提交",function(){
							$.post('<?php echo ((is_array($_tmp="product/product_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act=del_gg',{old_pid:old_pid},function(msg){
								if(msg==1)
								{
									$("#gg_list .show_product").eq(index).attr('data-old_pid','');
									$('#pid_'+key).html('0');
									modal_iframe('product/product_add','关联相同分类产品','800','400','&act=select_product&cat_id=<?php echo $this->_tpl_vars['re']['catid']; ?>
&back_id='+key);
								}
								else
									modal_msg('系统异常请重试');
							});
						});
						return ;
					}
					//分类
					modal_iframe('product/product_add','关联相同分类产品','800','400','&act=select_product&cat_id=<?php echo $this->_tpl_vars['re']['catid']; ?>
&back_id='+key);
	
				});
			});
}
var gg_list=function()
{
	var itemid='';
	$('#gg_checkbox .gg_item').each(function(index, element) {
		if($(this).attr('checked'))
		{
			// gg_id  gg_name  gg_con_id gg_con_name
			itemid+=(itemid!=''?',':'')+$(this).attr('data-gg-id')+'|'+$(this).attr('data-gg-name')+'|'+$(this).val()+"|"+encodeURI($('#item_gg_'+$(this).val()).val());
		}
	});
	
	if(itemid!='')
	{
		$.post('<?php echo ((is_array($_tmp="product/product_add")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?act=get_gg_html',{itemid:itemid,group_product_id:'<?php echo $this->_tpl_vars['re']['group_product_id']; ?>
',product_id:'<?php echo $this->_tpl_vars['re']['id']; ?>
',p_select_index_id:'<?php echo $_GET['p_select_index_id']; ?>
'},function(msg){
			$('#gg_list').html(msg);
			b_product();
		});	
		$('#price').attr('disabled',true);
		$('#market_price1').attr('disabled',true);
		$('#stock').attr('disabled',true);
		$('#barcode').attr('disabled',true);
	}
	else
	{
		$('#gg_list').html('');
		$('#price').attr('disabled',false);
		$('#market_price1').attr('disabled',false);
		$('#stock').attr('disabled',false);
		$('#barcode').attr('disabled',false);
	}
}	

$('#gg_checkbox .gg_item').bind('click',function(){
   gg_list();
});
$('#gg_checkbox .item_v').bind('change',function(){
   gg_list();
});
/*<?php if (! empty ( $this->_tpl_vars['gg_con'] )): ?>*/
	gg_list();
/*<?php endif; ?>*/

</script>