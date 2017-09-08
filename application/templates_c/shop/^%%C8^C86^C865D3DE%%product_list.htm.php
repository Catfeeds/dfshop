<?php /* Smarty version 2.6.20, created on 2017-09-06 16:50:46
         compiled from product_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'site_url', 'product_list.htm', 23, false),array('modifier', 'base_site_url', 'product_list.htm', 29, false),array('modifier', 'escape', 'product_list.htm', 90, false),)), $this); ?>
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
</a></div>
        <div class="price"> <em>¥<i><?php echo $this->_tpl_vars['item']['price']; ?>
</i> </em> <del>¥ <?php echo $this->_tpl_vars['item']['market_price']; ?>
</del> </div>
        <a class="cou-btn cou-btn2" href="<?php echo ((is_array($_tmp='cart/add_cart')) ? $this->_run_mod_handler('base_site_url', true, $_tmp, 'u') : base_site_url($_tmp, 'u')); ?>
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
              <input  id="search_minPrice" class="search_param"  data-v='search_minPrice:value' type="number" value="<?php echo $_GET['minPrice']; ?>
" pattern="[0-9]*" placeholder="最低价">
              <span></span>
              <input  id="search_maxPrice" class="search_param"  data-v='search_maxPrice:value' type="number" value="<?php echo $_GET['maxPrice']; ?>
" pattern="[0-9]*" placeholder="最高价">
            </div>
          </div>
        </div>
        <div class="line1" id='cat_show'>
          <div class="title-line3" ><span class="all"><s class="search_param"  data-v='search_cat:null' id='selected_cat'></s> <i></i></span><span class="title">全部分类</span> </div>
          <div class="clear"></div>
        </div>
        
        <div id='gg_brand'  class="search_param"  data-v='search_brand:0' class="line1">
          <div class="title-line2 bottom-title"> <span class="title">品牌</span> <span class="selected"></span> <i id="open" class="down"></i> </div>
          <div class="clear"></div>
          <div class="brand_list" id='brand_list'>
            <!--div><span  class="active"><i></i>阿斯asd达</span></div-->
            
            <div class="clear"></div>
          </div>
        </div>
        
        
        <div class="clear"></div>
                <div id='gg_con' class="search_param"  data-v="search_gg:0">
        	
        </div>
        <div class="clear"></div>
      </div>
      
      
      <div id='s_con_cat' class="index-ofyauto hide">
      <div class="right-head">
        <div id="catelogy_back" class="back"><i></i></div>
        <div class="heat-title"><span>全部分类</span></div>
      </div>
      <span id="catelogy_selectAll" class="fix-classify"><span>全部分类</span><i class=""></i></span>
      <ul class="classify-ul" style="overflow:auto;" >
        <?php $_from = $this->_tpl_vars['re']['cat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['item']):
?>
        <?php if ($this->_tpl_vars['item']['pid'] == 0): ?>  
        <?php if ($this->_tpl_vars['k'] != 0): ?>
        </div>
        <?php endif; ?>
        <li> 
           <span><?php echo $this->_tpl_vars['item']['cat']; ?>
</span><i class="up"></i> </li>
           <div class="hide"> <?php else: ?> <span class="item_cat" data-cat='{"id":"<?php echo $this->_tpl_vars['item']['id']; ?>
","cat":"<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['cat'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"}'> <?php echo $this->_tpl_vars['item']['cat']; ?>
 <s></s> <i></i> </span><?php endif; ?>
        <?php endforeach; endif; unset($_from); ?> 
        </div>
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

var cat_back=function(){
	$('#s_con').removeClass('hide');	
	$('#s_con_cat').addClass('hide');
	$('#gg_brand').attr('data-v','');
	$('#gg_con').attr('data-v','');
}

var gg_tamp_htm=function(name,htm){
	 return '<div    class="line1">'
		   +'<div class="title-line2 bottom-title"> <span class="title">'+name+'</span> <span class="selected"></span><i class="down"></i></div>'
		   +'<div class="clear"></div>'
		   +'<div class="brand_list">'
		   +htm
			  //+'<div><span  class="active"><i></i>111</span></div>'
		   +'<div class="clear"></div>'
		   +'</div>'
		   +'</div><div class="clear"></div>';
}

var gg_click=function(){
	$('#gg_brand,#gg_con').find('.gg_item').unbind('click').bind('click',function(){
		//class="active"
		var idd=$(this).attr('id');
		var type=$(this).attr('data-type');
		
		if($('#'+idd).find('span').hasClass('active')==true)
			$('#'+idd).find('span').removeClass('active');
		else
			$('#'+idd).find('span').addClass('active');
	
		if(type==1)
		{
			var brand_id='';
			$('#gg_brand .gg_item').each(function(index, element) {
				if($(this).find('span').hasClass('active')==true)
				{
					brand_id+=(brand_id==''?'':',')+$(this).attr('data-id');
				}
			});
			$('#gg_brand').attr('data-v','search_brand:'+brand_id);
		}
		
		if(type==2)
		{
			var brand_id='';
			$('#gg_con .gg_item').each(function(index, element) {
				if($(this).find('span').hasClass('active')==true)
				{
					brand_id+=(brand_id==''?'':',')+$(this).attr('data-id');
				}
			});
			$('#gg_con').attr('data-v','search_gg_id:'+brand_id);
		}
		
	});
}

var cat_brand=function(catid){
	 var baseTime=new Date();	
	$.post('<?php echo ((is_array($_tmp="product/get_brand")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?t='+baseTime.getTime(),{brand_id:catid,code:'<?php echo $this->_tpl_vars['code']; ?>
'},function(msg){
		try
		{ 
			eval("var d="+msg);
			var str='';
			var k=0;
			var brand=d.list;
			for(var df in brand)
			{
				//class="active"
				k++;
				str+='<div data-type="1" id="gg_'+k+'" class="gg_item" data-id="'+brand[df].id+'" ><span ><i></i>'+brand[df].name+'</span></div>';
			}
			
			if(str=='')
				$('#gg_brand').hide();
			else
				$('#gg_brand').show();	
				
			$('#brand_list').html(str);
			var cat=d.gg_list;
			var htm='';
			var gg='';
			str='';
			for(var j in cat)
			{
				//class="active"
				gg=cat[j].gg_con;
				htm='';
				for(var i in gg)
				{
					k++;
					htm+='<div data-type="2" id="gg_'+k+'" class="gg_item" data-id="'+gg[i].id+'"><span ><i></i>'+gg[i].name+'</span></div>';
				}
				str+=gg_tamp_htm(cat[j].name,htm);
			}
			$('#gg_con').html(str);
			gg_click();
		}
		catch(e){}
	})
}

function load_ini()
{
	/**/
	cat_brand('<?php echo $_GET['search_cat']; ?>
');
	$('#search1,#search2,#search3,#search4,#search12,#search13,#search14,#catelogy_back').bind('click',function(){
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
			$('#s_con_cat').height($('#s_con1').height());
			$('.classify-ul').height($('#s_con1').height()-45-39);
			$('#cat_show').unbind('click').bind('click',function(){
				$('#s_con').addClass('hide');
				$('#s_con_cat').removeClass('hide');
			});
			
			$('.classify-ul li').each(function(index, element) {
                $(this).unbind('click').bind('click',function(){
					if($('.classify-ul li').eq(index).find('i').hasClass('up')==true)
					{
						$('.classify-ul li i').removeClass('down').addClass('up');
						$(this).find('i').removeClass('up').addClass('down');
						$('.classify-ul div').addClass('hide');
						$('.classify-ul div').eq(index).removeClass('hide');
					}
					else
					{
						$(this).find('i').removeClass('down').addClass('up');
						$('.classify-ul div').addClass('hide');
					}
				});
            });


			$('#s_con_cat .item_cat').each(function(index, element){
				var da=$(this).attr('data-cat');
				$(this).unbind('click').bind('click',function(){  
					eval("var d="+da);
					var id=decodeURI(d.id);
					var cat=decodeURI(d.cat);
					cat_back();
					$('#selected_cat').html(cat);
					$('#selected_cat').attr('data-v',"search_cat:"+d.id);
					/**/
					if(d.id!='')
						cat_brand(d.id);
				})
            });
		}
		
		if(type=='catelogy_back')
		{
			cat_back();
		}
	});
	
	$('#submit').bind('click',function(){
		var str='';
		$('#s_con .search_param').each(function(index, element) {
             d=$(this).attr('data-v');
			 var dd=d.split(":");
			 if(dd[1]=='value')
				v=$('#'+dd[0]).val();
			 else
			 	v=dd[1];
			 str+=(str==''?'':"&")+dd[0]+"="+v;
        });
		window.location='<?php echo ((is_array($_tmp="product/lists")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
?'+str;
	});
	
}	
</script> 