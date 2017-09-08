<?php /* Smarty version 2.6.20, created on 2017-05-22 15:38:35
         compiled from upload_image_one.htm */ ?>

<table class="table" style="width:100%;">
  <tbody>
    <tr>
      <td width="20" ></td>
      <td><form action=""  onsubmit="load_Win()" id="form_id" enctype="multipart/form-data" method="post">
          <input id='fileupload_input' type="file"  name="upfile"  value=""/>
          <input type="submit"  class="btn" value="上传"/>
          <!--input type="button"  onclick="show_img_list()" class="btn red" value="图库"/-->
        </form></td>
    </tr>
  </tbody>
</table>
<table class="table" style="width:100%;">
  <tbody>
    <tr>
      <td  height="180" >
       <div id='product_id' style="height:180px; overflow-y:auto">
       <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
          <div class="span2" style="border:1px solid #CCC; background:#999; height:160px;"> 
             <img  style="height:140px; width-max:100px;"  src="<?php echo $this->_tpl_vars['item']['url']; ?>
" />
             <div style="width:50px;" data-url='<?php echo $this->_tpl_vars['item']['url']; ?>
' class="btn red mini item">选择</div>
          </div>
       <?php endforeach; endif; unset($_from); ?>
       </div>
     </td>
    </tr>
     <tr>
       <td>
       <div style="text-align:center;">
   	    <?php echo $this->_tpl_vars['re']['page']; ?>

        </div>
	  </td>
    </tr>
  </tbody>
</table>
</div>
<script>
function load_Win()
{
	window.parent.load_win();
}

$('#product_id .item').each(function(index, element) {
	var durl=$(this).attr('data-url');
    $(this).bind('click',function(){
		window.parent.close_Win(durl)
	});	
});


/*
function show_img_list()
{
	window.parent.show_imglist('/lib/ueditor/upimage_list.php/ueditor/upload_img_list');
}
*/
</script>