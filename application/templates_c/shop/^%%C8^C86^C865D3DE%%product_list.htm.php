<?php /* Smarty version 2.6.20, created on 2017-08-01 11:03:52
         compiled from product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'product_list.htm', 87, false),)), $this); ?>
<style>
#m_left1 { float: left; width: 80px; margin-right: -100%; height: 100px; line-height: 25px; text-align: center; color: red; position: relative; z-index: 2; }
#m_left1 img { width: 100%; margin-top: 5px; }
#m_content1 { float: left; width: 100%; position: relative; z-index: 1px; }
#m_contentInner1 { margin-left: 80px; height: 100px; line-height: 25px; border-bottom: 1px solid #ccc; color: #000; }
#m_contentInner1 a { color: #000; }
#m_contentInner1 .content { margin-left: 10px; }
#m_contentInner1 .content .tt { height: 50px; overflow: hidden; }
#m_contentInner1 .content .price em, #m_contentInner1 .content .price em i { color: red; font-style: normal; }
#m_contentInner1 .content .price del { color: #999; }
.m-popCover { height: 100%; width: 90%; overflow-y: auto; overflow-x: hidden; position: absolute; top: 0; left: 10%; z-index: 10002; background: #fff; }
.new-filtrate .filtrate-block { height: 100%; width: 100%; overflow: hidden; }
.cat_list { width: 100%; height: 100%; }
.cat_list li { display: block; border-bottom: 1px #fff solid; }
.cat_list li a { display: block; text-align: left; margin-left: 20px; }
.title-line2, .title-line3 { padding-top: 10px; padding-bottom: 2px; padding-left: 10px; padding-right: 10px; color: #252525; font-size: 15px; overflow-x: hidden; display: box; display: -webkit-box; display: -moz-box; display: -ms-box; display: -o-box; }
.title-line2 .title, .title-line3 .title { width: 60px; }
.price-section { margin-top: 10px; margin-bottom: 10px; }
.price-section .from-to { padding-left: 10px; padding-right: 13px; display: box; display: -webkit-box; display: -moz-box; display: -ms-box; display: -o-box; }
.price-section .from-to input { font-size: 100%; vertical-align: middle; outline: none; color: inherit; font: inherit; margin: 0; padding: 0; }
.price-section .from-to input { box-flex: 1; -webkit-box-flex: 1; -moz-box-flex: 1; -ms-box-flex: 1; -o-box-flex: 1; display: block; background-color: #f0f2f5; height: 28px; line-height: 28px; border-radius: 5px; text-align: center; font-size: 12px; }
.price-section .from-to span { display: block; width: 8px; margin-left: 9px; margin-right: 9px; height: 14px; border-bottom: 1px solid #848689; }
.filtrate-index .index-bnts { height: 44px; display: box; display: -webkit-box; display: -moz-box; display: -ms-box; display: -o-box; padding-right: 0px; overflow: hidden; }
.filtrate-index .index-bnts .left { background-color: #fff; color: #252525; font-size: 16px; position: relative; display: box; display: -webkit-box; display: -moz-box; display: -ms-box; display: -o-box; box-flex: 1; -webkit-box-flex: 1; -moz-box-flex: 1; -ms-box-flex: 1; -o-box-flex: 1; box-align: center; -webkit-box-align: center; -moz-box-align: center; -ms-box-align: center; -o-box-align: center; box-pack: center; -webkit-box-pack: center; -moz-box-pack: center; -ms-box-pack: center; -o-box-pack: center; }
.filtrate-index .index-bnts .right { background-color: #f23030; color: #fff; font-size: 16px; display: box; display: -webkit-box; display: -moz-box; display: -ms-box; display: -o-box; box-flex: 1; -webkit-box-flex: 1; -moz-box-flex: 1; -ms-box-flex: 1; -o-box-flex: 1; box-align: center; -webkit-box-align: center; -moz-box-align: center; -ms-box-align: center; -o-box-align: center; box-pack: center; -webkit-box-pack: center; -moz-box-pack: center; -ms-box-pack: center; -o-box-pack: center; }
.filtrate-index .index-ofyauto { overflow-y: auto; overflow-x: hidden; width: 100%; background-color: #f8f8f8; padding: 0 0px; }
.title-line3 {
    color: #252525;
    font-size: 15px;
    height: 50px;
    line-height: 50px;
    padding-left: 10px;
    overflow: hidden;
    padding-right: 12px;
    position: relative;
}
.title-line3 .all {
    display: block;
    text-align: right;
    color: #848689;
    font-size: 13px;
    float: right;
    width: 60px;
}
.title-line3:before {
    content: '';
    height: 1px;
    width: 200%;
    position: absolute;
    left: 0;
    top: 0;
    right: auto;
    bottom: auto;
    background-color: #e3e5e9;
    border: 0px solid transparent;
    border-radius: 0px;
    -webkit-border-radius: 0px;
    transform: scale(0.5);
    -webkit-transform: scale(0.5);
    transform-origin: top left;
    -webkit-transform-origin: top left;
}

</style>
<link rel="stylesheet" href="/static/wap/search_list.css?v=<?php echo $this->_tpl_vars['vsersion']; ?>
" />
<div style="clear:both; margin-top:45px;"> </div>
<div class="nav_list">
  <div class="search-list">
    <ul id="searchSort20" class="new-search-tab bdr-bom">
      <li class="new-change-eleven new-sort-integrative active" id="search1"><span>推荐</span></li>
      <li class="new-change-eleven " id="search2"><span>销量</span></li>
      <li class="new-change-eleven new-sort-price " id="search3"><span>价格</span></li>
      <li class="new-change-eleven" id="search4"><span>筛选<span class="choose-icon"></span></span></li>
    </ul>
    <div style=" clear:both;border:0; height:0px; border-bottom:1px solid red; background:#000; margin:0; padding:0;"></div>
  </div>
  <div id="search11" class="integrative-box show-position hide">
    <ul class="integrative-list">
      <li  id="search12" class="sidebar-iteam checked" ><span><i class="tick"></i><span class="sort-of-brand">推荐</span></span></li>
      <li  id="search13" class="sidebar-iteam" ><span><i class="tick"></i><span class="sort-of-brand">新品</span></span></li>
      <li  id="search14" class="sidebar-iteam"><span><i class="tick"></i><span class="sort-of-brand">热点</span></span></li>
    </ul>
  </div>
</div>
<div style="clear:both; margin-top:90px;"> </div>
<div  id='con_list' class="countdown1"> <?php $_from = $this->_tpl_vars['re']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
  <div id="m_left1"> <a tag="countdown" href="<?php echo ((is_array($_tmp="product/detail")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
"><img  src="<?php echo $this->_tpl_vars['item']['pic']; ?>
" /></a></div>
  <div id="m_content1">
    <div id="m_contentInner1">
      <div class="content">
        <div class="tt"><a href="<?php echo ((is_array($_tmp="product/detail")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
  阿斯达 阿斯达阿斯达阿斯达阿斯阿斯达阿斯达 </a></div>
        <div class="price"> <em>¥<i><?php echo $this->_tpl_vars['item']['price']; ?>
</i> </em> <del>¥ <?php echo $this->_tpl_vars['item']['market_price']; ?>
</del> </div>
        <a class="cou-btn cou-btn2" href="<?php echo ((is_array($_tmp="product/detail")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?id=<?php echo $this->_tpl_vars['item']['id']; ?>
">加入购物车</a> </div>
    </div>
  </div>
  <div style="clear:both;"></div>
  <?php endforeach; endif; unset($_from); ?> </div>
<div style="clear:both;"></div>
<div id='auto_msg' data-check='0' style="text-align:center; background:#fff; margin-top:10px; display:none;"  >数据加载中.........</div>
</div>
<div id='search_con'  class="m-popCover new-filtrate  hide">
  <div class="filtrate-block" id='s_con1' >
    <div class="filtrate-index ">
      <div id='s_con' class="index-ofyauto">
        <div>
          <div class="title-line2"> <span class="title">价格区间</span></div>
          <div class="price-section">
            <div class="from-to">
              <input  id="minPrice" type="number" value="" pattern="[0-9]*" placeholder="最低价">
              <span></span>
              <input  id="maxPrice" type="number" value="" pattern="[0-9]*" placeholder="最高价">
            </div>
          </div>
        </div>
        <div>
            <div  class="title-line3">
                <span class="title">全部分类</span>
                <span class="all">全部</span>
            </div>
        </div>
        <div>
          <div class="title-line2"> <span class="title">品牌</span></div>
        </div>
        <ul class="cat_list" style="display:none;">
          <li><a>全部分类</a></li>
          <?php $_from = $this->_tpl_vars['re']['cat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
          <li><a href=""><?php echo $this->_tpl_vars['item']['cat']; ?>
</a></li>
          <?php endforeach; endif; unset($_from); ?>
        </ul>
      </div>
      <div id="indexbnts" class="index-bnts">
        <div id="reset"  class="left">重置</div>
        <div id="submit" class="right">确定</div>
      </div>
    </div>
  </div>
</div>
<div id="SearchCover" class="mzjx-floor hide">
  <div class="cover-floor"> </div>
</div>
<script>

var resetall=function(){
	$('.integrative-list>li').removeClass('checked');
	$('#searchSort20>li').removeClass('active');
};

function load_ini()
{
	$('#search1,#search2,#search3,#search4,#search12,#search13,#search14').bind('click',function(){
		var type=$(this).attr('id');
		if(type=='search1')
			$('#SearchCover,#search11').removeClass('hide');
		if(type=='search12'||type=='search13'||type=='search14')	
		{
			resetall();
			$('#search1').addClass('active');
			$('.integrative-list>li').removeClass('checked');
			$(this).addClass('checked');
			$('#search1>span').html($(this).find('.sort-of-brand').html());
			$('#SearchCover,#search11').addClass('hide');
		}
		
		if(type=='search2')
		{
			resetall();
			$(this).addClass('active');
		}
		
		if(type=='search3')
		{
			resetall();
			$('#search3').addClass('active');
			if($('#search3>span').hasClass('arrow-down')==true)
			{
				$('#search3>span').removeClass('arrow-down');
				$('#search3>span').addClass('arrow-up');
			}
			else
			{
				$('#search3>span').removeClass('arrow-up');
				$('#search3>span').addClass('arrow-down');
			}
		}
		
		if(type=='search4')
		{
			$('#con_list').hide();
			$('#search_con').removeClass('hide');
			$('#SearchCover').removeClass('hide').find('.cover-floor').css('z-index','10001');
			$('html').css('height',"100%");
			$('#s_con').height($('#s_con1').height()-44);
			
		}
	});
	


}	
</script> 