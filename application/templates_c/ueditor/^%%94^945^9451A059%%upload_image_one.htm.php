<?php /* Smarty version 2.6.20, created on 2017-07-14 10:35:26
         compiled from upload_image_one.htm */ ?>

<table width="100%" class="table" id='pic_all'>
  <tr>
    <td width="*" style="border:0px;">
    <div style="height:360px; width:100%; overflow-y:auto; display:block;">
     <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
      <div class="span2" style="border:1px solid #CCC; background:#fff; height:140px; margin-bottom:10px; width:100px;"> <img  style="height:100px; width-max:100px;"  src="<?php echo $this->_tpl_vars['item']['url']; ?>
" />
        <div style="border-top:1px solid #CCC;border-bottom:1px solid #CCC;">
          <div style=" height:20px;;">
            <input type="text" id='vname<?php echo $this->_tpl_vars['item']['id']; ?>
'  style=" width:100%; padding:0px; border:0px;" value="<?php echo $this->_tpl_vars['item']['upload_name']; ?>
"/>
          </div>
          <div style="clear:both;"></div>
          <div style="width:33px; padding-left:0px;padding-right:0px; margin-bottom:0px; float:right;"
             data-id='<?php echo $this->_tpl_vars['item']['id']; ?>
'
             data-url='<?php echo $this->_tpl_vars['item']['url']; ?>
' class="btn blue mini item_edit">改</div>
          <div style="width:33px; padding-left:0px;padding-right:0px; margin-bottom:0px;float:right;"
             data-id='<?php echo $this->_tpl_vars['item']['id']; ?>
'
             data-url='<?php echo $this->_tpl_vars['item']['url']; ?>
' class="btn red mini item_del">删</div>
          <div style="width:33px; padding-left:0px;padding-right:0px; margin-bottom:0px;float:left;"
             data-id='<?php echo $this->_tpl_vars['item']['id']; ?>
'
             data-url='<?php echo $this->_tpl_vars['item']['url']; ?>
' class="btn red mini item_select">选</div>
          <div style="clear:both;"></div>
        </div>
      </div>
      <?php endforeach; endif; unset($_from); ?>
     </div>
        <div style="clear:both;"></div>
        <div style=" margin-left:10px; border-top:1px solid #DFDFDF; padding-top:10px;"><?php echo $this->_tpl_vars['re']['page']; ?>
</div>
    </td>
    <td width="100" style="border:0px; border-left:1px solid #ccc;"><div style="margin-top:10px;"></div>
      
      <!--select class="m-wrap small" name="group">
         	 <option value="">所有管理员</option>
             <option value="">管理员</option>
         </select-->
      
      <form action=""  onsubmit="load_Win()" method="post">
        <select class="m-wrap small" name="search_group">
          <option value="all">全部分组</option>
          <option value="-1">未分组</option>
          <?php $_from = $this->_tpl_vars['ress']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
          <option  <?php if ($_POST['search_group'] == $this->_tpl_vars['item']['id']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
          <?php endforeach; endif; unset($_from); ?>
        </select>
        <div class="input-append">
          <input type="text" class="m-wrap small" name="search_name" value="<?php echo $_POST['search_name']; ?>
" />
          <input type="submit" class="btn red" name="sub" value="搜素" />
        </div>
      </form>
      
      <div style="border:1px solid #CCC; padding-left:10px; margin-top:10px; ">
      <form action=""  onsubmit="load_Win()" style=" margin-top:10px;" id="form_id" enctype="multipart/form-data" method="post">
        <select class="m-wrap small" name="group"  style=" margin-top:10px;" >
          <option value="">选择上传组</option>
          <?php $_from = $this->_tpl_vars['ress']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
          <option value="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
          <?php endforeach; endif; unset($_from); ?>
        </select>
        <input id='fileupload_input' style="width:100px; margin-top:10px;" type="file"  name="upfile"  value=""/>
        <div style="clear:both;margin-top:10px;"></div>
        宽
        <input type="text" name="width" style="width:50px;" value="<?php echo $_GET['config_width']*1; ?>
" />
        高
        <input type="text" name="height" style="width:50px;" value="<?php echo $_GET['config_height']*1; ?>
" />
        <div style="clear:both;margin-top:10px;"></div>
        填0时为默认宽度和高度
        <div style="clear:both;margin-top:10px;"></div>
        <div><span class="btn blue" id='group_ed' style="float:right; margin-right:10px;"> 编辑组</span>
          <input type="submit"  class="btn red" value="上传"/>
        </div>
        </div>
      </form></td>
  </tr>
</table>
</div>

<!--

--> 

<script>

function load_Win()
{
	 $('body').modalmanager('loading');
} 

function load_ini()
{
	/*<?php if ($this->_tpl_vars['error_msg']): ?>*/
		modal_msg('<?php echo $this->_tpl_vars['error_msg']; ?>
');
	/*<?php endif; ?>*/
	$('#group_ed').bind('click',function(){
		modal_iframe('ueditor/iframe','编辑图片组','600','300','mothed=group_ed&<?php echo $this->_tpl_vars['url']; ?>
');
	});
	
	$('#pic_all .item_select').each(function(index, element) {
		var durl=$(this).attr('data-url');
		$(this).bind('click',function(){
			window.parent.close_Win(durl)
		});	
	});
	
	$('#pic_all .item_edit').each(function(index, element) {
		var durl=$(this).attr('data-url');
		var id=$(this).attr('data-id');
		$(this).bind('click',function(){
			 vname=$('#vname'+id).val();
			$.post('<?php echo $this->_tpl_vars['url_action']; ?>
',{id:id,vname:vname},function(msg){
				modal_msg(msg);
			});
		});	
	});
	
	$('#pic_all .item_del').each(function(index, element) {
		var durl=$(this).attr('data-url');
		var id=$(this).attr('data-id');
		var vname=$('#vname'+id).val();
		$(this).bind('click',function(){
			modal_confirm("确认 【"+vname+"】 删除吗？删除后与之相关的产品不能显示图片",function(){
				 window.location='<?php echo $this->_tpl_vars['url_action']; ?>
&del_id='+id;
			});
		});	
	})
}

</script>