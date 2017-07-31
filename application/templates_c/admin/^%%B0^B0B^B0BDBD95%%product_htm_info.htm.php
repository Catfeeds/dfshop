<?php /* Smarty version 2.6.20, created on 2017-07-14 10:34:35
         compiled from product_htm_info.htm */ ?>
<div class="row-fluid">
<div class="row-fluid" style="margin-top:10px;">
  <div class="span12" >
    <div class="control-group">
      <label class="control-label">商品状态<span class="required">*</span></label>
      <div class="controls">
        <label class="radio">
            <input type="radio" name="status"  value="1" <?php if ($this->_tpl_vars['re']['status'] == 1): ?>checked<?php endif; ?>>
           上架
        </label>
        <label class="radio">
        <input type="radio" name="status"  value="0" <?php if ($this->_tpl_vars['re']['status'] == 0): ?>checked<?php endif; ?>>
           下架 (仓库中商品)
        </label>
          <label class="radio">
        <input type="radio" name="status"  value="-1" <?php if ($this->_tpl_vars['re']['status'] == -1): ?>checked<?php endif; ?>>
           回收站
        </label>
      </div>
    </div>
  </div>
</div>
<div class="row-fluid" style="margin-top:10px;">
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">商品名称<span class="required">*</span></label>
      <div class="controls">
        <input type="text"  class="span12 m-wrap" name="name" value="<?php echo $this->_tpl_vars['re']['name']; ?>
" />
      </div>
    </div>
  </div>
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">贸易类型<span class="required">*</span></label>
      <div class="controls">
        <select size="1" id="form_2_select2" name="hg_type" aria-controls="sample_1" class="form_2_select2 m-wrap span12">
          <option value=''>请选择商品类别</option>
          <option <?php if ($this->_tpl_vars['re']['hg_type'] == 1): ?>value="1"<?php endif; ?> >保税商品</option>
          <option <?php if ($this->_tpl_vars['re']['hg_type'] == 2): ?>value="2"<?php endif; ?> >直邮商品</option>
          <option <?php if ($this->_tpl_vars['re']['hg_type'] == 3): ?>value="3"<?php endif; ?>>国外现货</option>
          <option <?php if ($this->_tpl_vars['re']['hg_type'] == 4): ?>value="4"<?php endif; ?> >国内现货</option>
        </select>
      </div>
    </div>
  </div>
</div>
<div class="row-fluid" style="margin-top:10px;">
  <div class="span4" >
    <label class="control-label">促销简称</label>
    <div class="controls">
      <input type="text" class="span12 m-wrap" name="desc" />
    </div>
  </div>
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">品牌<span class="required">*</span></label>
      <div class="controls">
        <select name="brand">
          <option value="">选择品牌</option>
          <?php $_from = $this->_tpl_vars['re']['brand_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
          <option <?php if ($this->_tpl_vars['re']['brand'] == $this->_tpl_vars['item']['name']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['item']['name']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
          <?php endforeach; endif; unset($_from); ?>
        </select>
      </div>
    </div>
  </div>
</div>
<div class="row-fluid" style="margin-top:10px;">
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">关键词<span class="required">*</span></label>
      <div class="controls">
        <input type="text" class="span12 m-wrap" name="keywords" value="<?php echo $this->_tpl_vars['re']['keywords']; ?>
" />
      </div>
    </div>
  </div>
</div>
<div class="row-fluid" style="margin-top:10px;">
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">开售时间<span class="required">*</span></label>
      <div class="controls date date-picker" data-date="search_stime" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
        <input type="text" name="start_time" value="<?php echo $this->_tpl_vars['re']['start_time']; ?>
"  class="m-wrap m-ctrl-medium date-picker span12">
        <span class="add-on"></span> </div>
    </div>
  </div>
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">结束时间<span class="required">*</span></label>
      <div class="controls date date-picker" data-date="search_stime" data-date-format="yyyy-mm-dd hh:ii:ss" data-date-viewmode="years">
        <input type="text" name="valid_time" value="<?php echo $this->_tpl_vars['re']['valid_time']; ?>
" class="m-wrap m-ctrl-medium date-picker span12">
        <span class="add-on"></span> </div>
    </div>
  </div>
</div>
<div class="row-fluid" style="margin-top:10px;">
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">仓库名称<span class="required">*</span></label>
      <div class="controls">
        <input type="text" class="span12 m-wrap"  value="<?php echo $this->_tpl_vars['re']['warehouse_name']; ?>
" readonly="readonly"/>
        <input type="hidden" name="warehouse_id" value="<?php echo $this->_tpl_vars['re']['warehouse_id']; ?>
">
      </div>
    </div>
  </div>
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">分类名称<span class="required">*</span></label>
      <div class="controls">
        <input type="text"  class="span12 m-wrap" value="<?php echo $this->_tpl_vars['re']['cat_name']; ?>
" readonly="readonly" />
        <input type="hidden" name="cat_id" value="<?php echo $this->_tpl_vars['re']['catid']; ?>
">
      </div>
    </div>
  </div>
</div>
<div class="row-fluid" style="margin-top:10px;">
  <div class="span4">
    <div class="control-group">
      <label class="control-label">产地<span class="required">*</span></label>
      <div class="controls">
        <select size="1" id="form_2_select2" name="country" aria-controls="sample_1" class="form_2_select2 m-wrap span12">
          <option value=''>请选择产地</option>
          <?php $_from = $this->_tpl_vars['re']['counrty']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
          <option  value="<?php echo $this->_tpl_vars['item']['id']; ?>
"> <?php echo $this->_tpl_vars['item']['c_name']; ?>
 </option>
          <?php endforeach; endif; unset($_from); ?>
        </select>
      </div>
    </div>
  </div>
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">运费模板<span class="required">*</span></label>
      <div class="controls">
        <select size="1" id="form_2_select2" name="temp_id" aria-controls="sample_1" class="form_2_select2 m-wrap span12">
          <option value='1'>请选择产地</option>
          <?php $_from = $this->_tpl_vars['re']['logistics']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
          <option  value="<?php echo $this->_tpl_vars['item']['id']; ?>
"> 【<?php if ($this->_tpl_vars['item']['type'] == 1): ?>不包邮<?php else: ?>包邮<?php endif; ?>】<?php echo $this->_tpl_vars['item']['title']; ?>
 </option>
          <?php endforeach; endif; unset($_from); ?>
        </select>
      </div>
    </div>
  </div>
</div>
<div class="row-fluid" style="margin-top:10px;">
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">重量(KG)<span class="required">*</span></label>
      <div class="controls">
        <input type="text" class="span12 m-wrap" name="weight" />
      </div>
    </div>
  </div>
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">体积(m<sup>3</sup>)<span class="required">*</span></label>
      <div class="controls">
        <input type="text"  class="span12 m-wrap" name="cubage"  value="0"/>
      </div>
    </div>
  </div>
</div>
<div class="row-fluid" style="margin-top:10px;">
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">虚拟商品<span class="required">*</span></label>
      <div class="controls">
        <label class="radio">
          <input type="radio" name="is_virtual"  value="1" <?php if ($this->_tpl_vars['re']['is_virtual'] == 1): ?>checked<?php endif; ?> >
           是
        </label>
         <label class="radio">
        <input type="radio" name="is_virtual"  value="0" <?php if ($this->_tpl_vars['re']['is_virtual'] == 0 || empty ( $this->_tpl_vars['re']['is_virtual'] )): ?>checked<?php endif; ?> >
           否
        </label>
      </div>
    </div>
  </div>
  <div class="span4" >
    <div class="control-group">
      <label class="control-label">税率（如0.119）<span class="required">*</span></label>
      <div class="controls">
        <input type="text"  class="span12 m-wrap" name="rate" value="<?php echo $this->_tpl_vars['product']['content']['gg']; ?>
"/>
      </div>
    </div>
  </div>
</div>