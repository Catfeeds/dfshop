<?php /* Smarty version 2.6.20, created on 2017-08-03 10:59:42
         compiled from clear_temp.htm */ ?>
<div class="container-fluid"> 
  <!-- BEGIN PAGE HEADER-->
  <div class="row-fluid">
    <div class="span12"> 
    <h3 class="page-title"> <small> </small> </h3>
      <ul class="breadcrumb">
        <li> <i class="icon-home"></i> <a>网站管理</a> <span class="icon-angle-right"></span> </li>
        <li><a href="#">清除缓存</a></li>
      </ul>
    </div>
  </div>
  <div class="row-fluid">
        <div class="span12"> 
          
          <!-- BEGIN VALIDATION STATES-->
          
          <div class="portlet box blue">
            <div class="portlet-title">
              <div class="caption"><i class="icon-reorder"></i></div>
            </div>
            <div class="portlet-body form"> 
              <!-- BEGIN FORM-->
              <form action="" id="form_cat_add" class="form-horizontal" method="post" >               

                <p>如果发现程序不同时请清除缓存 , <?php echo $this->_tpl_vars['msg']; ?>
</p>
                <div class="form-actions">
                  <input type="hidden" name="act" value="1">
                  <button type="submit" id='submit_cat_add' class="btn green">清除缓存</button>
                </div>
              </form>
              <!-- END FORM--> 
            </div>
          </div>
          <!-- END VALIDATION STATES--> 
        </div>
      </div>
  <!-- END PAGE CONTENT--> 
</div>