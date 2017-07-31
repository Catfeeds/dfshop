<?php /* Smarty version 2.6.20, created on 2017-07-14 10:34:35
         compiled from product_htm_detail.htm */ ?>
<div class="row-fluid" style="margin-top:10px;">
  <div class="span12" >
    <label class="control-label">详情描述<span class="required">*</span></label>
    <div class="controls" > 
      <script>
               var server_auth="<?php echo $this->_tpl_vars['ueditor_auth']; ?>
";
      </script> 
      <script type="text/javascript" charset="utf-8" src="/lib/ueditor/ueditor.config.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
      <script type="text/javascript" charset="utf-8" src="/lib/ueditor/ueditor.all.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"> </script> 
      <script type="text/javascript" charset="utf-8" src="/lib/ueditor/lang/zh-cn/zh-cn.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
      <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败--> 
      <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
      <textarea id="editor" style="width:100%; height:200px"  name="con"><?php echo $this->_tpl_vars['de']['con']; ?>
</textarea>
      <script>
            var ue = UE.getEditor('editor');
      </script> 
      <!--script id="editor" type="text/plain" style="width:1024px;height:200px;"></script--> 
    </div>
  </div>
</div>