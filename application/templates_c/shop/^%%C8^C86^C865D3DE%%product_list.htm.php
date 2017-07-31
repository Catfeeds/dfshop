<?php /* Smarty version 2.6.20, created on 2017-07-28 15:06:20
         compiled from product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'product_list.htm', 14, false),)), $this); ?>
<style>
#nav_left1 {float: left;width: 80px; margin-right: -100%; height:35px; line-height:35px; text-align:center; color:red;}
#nav_left1 .title{  width:60px; margin-left:10px; height:25px; margin-top:5px; line-height:25px; border-bottom:2px solid red; display:block; }
#nav_content1 {float: left;width: 100%;position:relative; z-index:1;}
#nav_contentInner1 {margin-left:80px;height:35px;line-height:35px;border-bottom:1px solid #ccc; color:#000; }
#nav_contentInner1 a{color:#000;}
</style>
<div style="clear:both; margin-top:50px;"></div>
<div style="clear:both;min-height:300px;"class="countdown">

 <ul id='con_id'>
    <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <li>
          <div class="cou-left"> <a tag="countdown" href="<?php echo ((is_array($_tmp="product/detail")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
" style="background-image: url('<?php echo $this->_tpl_vars['item']['pic']; ?>
');"> </a> </div>
          <div class="cou-right">
            <div class="timer-out"> 还剩
              <div class="timer" data-role="countdown" ms="1030744000"> <i data-name="hour">286</i>时:<i data-name="minute">16</i>分:<i data-name="second">32</i>秒</div>
            </div>
            <div class="tt"><a href="<?php echo ((is_array($_tmp="product/detail")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
 </a></div>
            <div class="price"> <em>¥<i><?php echo $this->_tpl_vars['item']['price']; ?>
</i> </em> <del>¥ <?php echo $this->_tpl_vars['item']['market_price']; ?>
</del> </div>
            <a class="cou-btn cou-btn2" href="<?php echo ((is_array($_tmp="product/detail")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
">开抢中</a> </div>
        </li>
    <?php endforeach; endif; unset($_from); ?>
  </ul>
  
<div style="clear:both;"></div>
  <div id='auto_msg' data-check='0' style="text-align:center; background:#fff; margin-top:10px; display:none;"  >数据加载中.........</div>
</div>