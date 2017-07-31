<?php /* Smarty version 2.6.20, created on 2017-07-25 09:30:54
         compiled from index_diy.htm */ ?>
<link href="/static/dragula/dragula.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css">
<link href="/static/dragula/example.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" rel="stylesheet" type="text/css">
<div class="examples" style="width:1200px;">
  <div class="parent" style="width:600px;">
    <div class="wrapper">
      <div id="sortable" class="container left-lovehandles">
        <div id='con1'  style="height:200px;" data-id='1'>
          <span class="handle">移动+</span>
          <div  class="clear"></div>
          <div id='con1_pic' >
            <div>1</div>
            <div>2</div>
            <div>3</div>
            <div>4</div>
          </div>
          <div  class="clear"></div>
          <span class="act_del btn red">删除</span> 
        </div>
        <div id='con2' data-id='2'><span class="handle">移动+</span>Try dragging or clicking on this element.</div>
        <div id='con3' data-id='3'><span class="handle">移动+</span>Note how you can click normally?</div>
        <div id='con4' data-id='4'><span class="handle">移动+</span>Drags don't trigger click events.</div>
        <div id='con5' data-id='5'><span class="handle">移动+</span>Clicks don't end up in a drag, either.</div>
        <div id='con6' data-id='6'><span class="handle">移动+</span>This is useful if you have elements that can be both clicked or dragged.</div>
      </div>
    </div>
  </div>
</div>
<style>
.selected{ border:1px solid red;}
.clear{ clear:both;}
#con1_pic div{ width:100px; height:80px; text-align:center; line-height:40px; display:block; background:#000; float:left; margin:10px; color:#fff;}
.handle{ display:none;}
</style>
<script src="/static/dragula/dragula.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script src="/static/dragula/example.min.js?v=<?php echo $this->_tpl_vars['vsersion']; ?>
"></script> 
<script>
$('#sortable').append(function(index, html) {
   
});
</script>