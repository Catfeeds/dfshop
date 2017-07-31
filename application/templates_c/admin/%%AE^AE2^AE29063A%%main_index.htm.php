<?php /* Smarty version 2.6.20, created on 2017-07-14 10:34:15
         compiled from D:%5Cphpstudy%5CWWW%5Cdfshop%5Capplication%5Ctemplates/admin/main_index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'config_item', 'D:\\phpstudy\\WWW\\dfshop\\application\\templates/admin/main_index.htm', 4, false),array('modifier', 'site_url', 'D:\\phpstudy\\WWW\\dfshop\\application\\templates/admin/main_index.htm', 249, false),)), $this); ?>
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ERP-多渠道管理系统-<?php echo ((is_array($_tmp='company')) ? $this->_run_mod_handler('config_item', true, $_tmp) : config_item($_tmp)); ?>
</title>
    <link href="/static/js_map/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />  
    <link rel="stylesheet" type="text/css" id="mylink"/>   
    <script src="/static/js_map/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>    
    <script src="/static/js_map/ligerUI/js/ligerui.all.js" type="text/javascript"></script> 
    <script src="/static/js_map/ligerUI/js/plugins/ligerTab.js"></script>
    <script src="/static/js_map/jquery.cookie.js"></script>
    <script src="/static/js_map/json2.js"></script>
    <link href="/static/js_map/lib.css" rel="stylesheet" type="text/css" />  
   
    <script type="text/javascript">
 			var indexdata = [];

            var tab = null;
            var accordion = null;
            var tree = null;
            var tabItems = [];
			var ItemsUrl = [];
            $(function ()
            {
                //布局
                $("#layout1").ligerLayout({ leftWidth: 160, height: '100%',heightDiff:-34,space:4, onHeightChanged: f_heightChanged });
                var height = $(".l-layout-center").height();
                //Tab
                $("#framecenter").ligerTab({
                    height: height,
                    showSwitchInTab : true,
                    showSwitch: true,
                    onAfterAddTabItem: function (tabdata)
                    {
                        tabItems.push(tabdata);
                        saveTabStatus();
                    },
                    onAfterRemoveTabItem: function (tabid)
                    { 
                        for (var i = 0; i < tabItems.length; i++)
                        {
                            var o = tabItems[i];
                            if (o.tabid == tabid)
                            {
                                tabItems.splice(i, 1);
                                saveTabStatus();
                                break;
                            }
                        }
                    },
                    onReload: function (tabdata)
                    {
                        var tabid = tabdata.tabid;
                        addFrameSkinLink(tabid);
                    }
                });

                //面板
                $("#accordion1").ligerAccordion({
                    //height: height - 24, speed: null
					height: 'auto', speed: 300
                });

                $(".l-link").hover(function ()
                {
                    $(this).addClass("l-link-over");
                }, function ()
                {
                    $(this).removeClass("l-link-over");
                });
                //树
                $("#tree1").ligerTree({
                    data : indexdata,
                    checkbox: false,
                    slide: false,
                    nodeWidth: 120,
                    attribute: ['nodename', 'url'],
                    onSelect: function (node)
                    {
                        if (!node.data.url) return;
                        var tabid = $(node.target).attr("tabid");
                        if (!tabid)
                        {
                            tabid = new Date().getTime();
                            $(node.target).attr("tabid", tabid)
                        } 
                        f_addTab(tabid, node.data.text, node.data.url);
                    }
                });

                tab = liger.get("framecenter");
                accordion = liger.get("accordion1");
                tree = liger.get("tree1");
                $("#pageloading").hide();

                css_init();
                pages_init();
            });
			
            function f_heightChanged(options)
            {  
                if (tab)
                    tab.addHeight(options.diff);
                if (accordion && options.middleHeight - 24 > 0)
                    accordion.setHeight(options.middleHeight - 24);
            }
			
            function f_addTab(tabid, text, url)
            {
				ItemsUrl.push(tabid+"|"+url);
                tab.addTabItem({
                    tabid: tabid,
                    text: text,
                    url: url,
                    callback: function ()
                    {
                        addShowCodeBtn(tabid); 
                        addFrameSkinLink(tabid); 
                    }
                });
            }


			function addShowCodeBtn(tabid)
            {
                var viewSourceBtn = $('<a class="viewsourcelink" href="javascript:void(0)">窗口查看</a>');
                var jiframe = $("#" + tabid);
                viewSourceBtn.insertBefore(jiframe);
                viewSourceBtn.click(function ()
                {
                    showCodeView(jiframe.attr("src"));
                }).hover(function ()
                {
                    viewSourceBtn.addClass("viewsourcelink-over");
                }, function ()
                {
                    viewSourceBtn.removeClass("viewsourcelink-over");
                });
            }
			
            function showCodeView(src)
            {
                $.ligerWindow.show({
                    title : '窗口查看',
                    url: '' + src,
                    width: $(window).width() *0.9,
                    height: $(window).height() * 0.9
                });

            }
			
            function addFrameSkinLink(tabid)
            {
                var prevHref = getLinkPrevHref(tabid) || "";
                var skin = getQueryString("skin");
                if (!skin) return;
                skin = skin.toLowerCase();
                attachLinkToFrame(tabid, prevHref + skin_links[skin]);
            }
			
            var skin_links = {
                "aqua": "/static/js_map/ligerUI/skins/Aqua/css/ligerui-all.css",
                "gray": "/static/js_map/ligerUI/skins/Gray/css/all.css",
                "silvery": "/static/js_map/ligerUI/skins/Silvery/css/style.css",
                "gray2014": "/static/js_map/ligerUI/skins/gray2014/css/all.css"
            };
			
			
            function pages_init()
            {
                var tabJson = $.cookie('liger-home-tab'); 
                if (tabJson)
                { 
                    var tabitems = JSON2.parse(tabJson);
                    for (var i = 0; tabitems && tabitems[i];i++)
                    { 
                        f_addTab(tabitems[i].tabid, tabitems[i].text, tabitems[i].url);
                    } 
                }
            }
			
            function saveTabStatus()
            { 
                $.cookie('liger-home-tab', JSON2.stringify(tabItems));
            }
			
            function css_init()
            {
                $("#skinSelect").change(function ()
                { 
                        location.href = this.value;
                });
            }
			
            function getQueryString(name)
            {
                var now_url = document.location.search.slice(1), q_array = now_url.split('&');
                for (var i = 0; i < q_array.length; i++)
                {
                    var v_array = q_array[i].split('=');
                    if (v_array[0] == name)
                    {
                        return v_array[1];
                    }
                }
                return false;
            }
			
            function attachLinkToFrame(iframeId, filename)
            { 
                if(!window.frames[iframeId]) return;
                var head = window.frames[iframeId].document.getElementsByTagName('head').item(0);
                var fileref = window.frames[iframeId].document.createElement("link");
                if (!fileref) return;
                fileref.setAttribute("rel", "stylesheet");
                fileref.setAttribute("type", "text/css");
                fileref.setAttribute("href", filename);
                head.appendChild(fileref);
            }
			
            function getLinkPrevHref(iframeId)
            {
                if (!window.frames[iframeId]) return;
                var head = window.frames[iframeId].document.getElementsByTagName('head').item(0);
                var links = $("link:first", head);
                for (var i = 0; links[i]; i++)
                {
                    var href = $(links[i]).attr("href");
                    if (href && href.toLowerCase().indexOf("ligerui") > 0)
                    {
                        return href.substring(0, href.toLowerCase().indexOf("lib") );
                    }
                }
            }
     </script> 

</head>
<body style="padding:0px;background:#EAEEF5;">  
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div id="pageloading"></div>  
<div id="topmenu" class="l-topmenu">
    <div class="l-topmenu-logo"><img width="180"  src="<?php echo ((is_array($_tmp='logo')) ? $this->_run_mod_handler('config_item', true, $_tmp) : config_item($_tmp)); ?>
" alt="<?php echo ((is_array($_tmp='logo')) ? $this->_run_mod_handler('config_item', true, $_tmp) : config_item($_tmp)); ?>
" /> </div>
    <div class="l-topmenu-welcome">
 	   <?php $_from = $this->_tpl_vars['menu_top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
          <a href="/<?php echo $this->_tpl_vars['index_page']; ?>
?selected=<?php echo $this->_tpl_vars['k']; ?>
" class="l-link2"><?php echo $this->_tpl_vars['v']; ?>
</a>
	   <?php endforeach; endif; unset($_from); ?>
       <a  class="l-link2">您好: <?php echo $this->_tpl_vars['admin']; ?>
</a>
       <span class="space">|</span>
       <a href="<?php echo ((is_array($_tmp="user/logout")) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
" target="_top">退出</a>
       <span class="space">|</span>
       <a target="_blank" href="/index.php">首页</a>
       <a target="_blank" href="/user.php">分销商</a> 
    </div> 
</div>


  <div id="layout1" style="width:99.2%; margin:0 auto; margin-top:4px; "> 
        <div position="left"  title="主要菜单" id="accordion1"> 
        	<?php $_from = $this->_tpl_vars['menu_left']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
             <div title="<?php echo $this->_tpl_vars['v']['name']; ?>
">
             <div style=" height:7px;"></div>
             	 <?php $_from = $this->_tpl_vars['v']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kk'] => $this->_tpl_vars['vv']):
?>
                    <?php if ($this->_tpl_vars['vv']['1'] == 1): ?>
                     <a class="l-link" href="javascript:f_addTab('<?php echo $_GET['selected']; ?>
<?php echo $this->_tpl_vars['k']; ?>
<?php echo $this->_tpl_vars['kk']; ?>
','<?php echo $this->_tpl_vars['vv']['3']; ?>
','<?php echo ((is_array($_tmp=($this->_tpl_vars['vv']['2'])."/".($this->_tpl_vars['vv']['0']))) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
')"><?php echo $this->_tpl_vars['vv']['3']; ?>
</a> 
                    <?php endif; ?> 
  				<?php endforeach; endif; unset($_from); ?>
             </div>   
           <?php endforeach; endif; unset($_from); ?>
        </div>
        <div position="center" id="framecenter"> 
            <div tabid="home" title="我的主页" style="height:300px" >
                <iframe frameborder="0" name="home" id="home" src="<?php echo ((is_array($_tmp='admin_index/info')) ? $this->_run_mod_handler('site_url', true, $_tmp) : site_url($_tmp)); ?>
"></iframe>
            </div> 
        </div> 
        
    </div>
    <div  style="height:32px; line-height:32px; text-align:center;">
            Copyright 挚捷行 © 2016 
    </div>
<div style="display:none"></div>
<script>
var windowobj='';
var windowobj1='';
function alertWin(title, w, h,src,type)
{
	/*
	$.ligerDialog.open({
		  title : title,
		  url: '' + src,
		  width:$(window).height(),
		  height: $(window).height() * 0.7
	});
	*/
	
	if(typeof(type)==='undefined'||type==0)	
	{
		if(typeof(windowobj)==='object')
			closeWin();
		    windowobj=$.ligerWindow.show({
			  title : title,
			  url: '' + src,
			  width: $(window).width() *0.8,
			  height: $(window).height() * 0.8
		    });
	}
	else if(type==1)
	{
		if(typeof(windowobj)==='object')
			closeWin();
		    windowobj=$.ligerWindow.show({
			  title : title,
			  url: '' + src,
			  width: w,
			  height: h
		 });
	
	}
	else
	{
		if(typeof(windowobj1)==='object')
		{
			windowobj1.remove();
			$('.l-window').eq(1).remove();
			$('.l-taskbar-task').eq(1).remove();
		}
		
		windowobj1=$.ligerWindow.show({
			  title : title,
			  url: '' + src,
			  width: $(window).width() *0.6,
			  height: $(window).height() * 0.6
		});		
	}
		
}

function closeWin()
{
	if(typeof(windowobj)==='object')
	{
		$('.l-window').remove();
		$('.l-taskbar').remove();
		windowobj.remove();
	}
	
	if(typeof(windowobj1)==='object')
	{
		$('.l-window').remove();
		$('.l-taskbar').remove();
		windowobj1.remove();
	}
	//windowobj.remove();
}

function frames_reload(tabid)
{
	$('#framecenter iframe').each(function(index,element ) {
		if(tabid==$(this).attr('id'))
		{
			element.contentWindow.location.reload(true);
			return ;
		}
    });
}

/*
function closeWin(url)
{
	$('#framecenter iframe').each(function(index,element ) {
        	element.src=url;
			return ;
    });
}
**/
</script>
</body>
</html>