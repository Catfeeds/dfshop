<?php defined('APPPATH') or die('Access restricted!'); 
require(APPPATH . 'libraries/smarty/Smarty.class.php'); 
class CI_Smarty extends Smarty {    
    public function __construct($template_dir = '', $compile_dir = '', $config_dir = '', $cache_dir = '') {      
	    parent::__construct();     
    
		if (is_array($template_dir)) {           
		  foreach ($template_dir as $key => $value) {               
		   $this->$key = $value;           
		   }        
		} else {            //ROOT是Codeigniter在入口文件index.php定义的本web应用的根目录    
			  $this->template_dir = $template_dir ? $template_dir :  APPPATH. 'templates/'.WEB_NAME."/";           
			  $this->compile_dir = $compile_dir ? $compile_dir :  APPPATH. 'templates_c/'.WEB_NAME."/";          
			  $this->config_dir = $config_dir ? $config_dir :  APPPATH. 'config';          
			  $this->cache_dir = $cache_dir ? $cache_dir :APPPATH. 'cache/'.WEB_NAME;   
		}   
			  $this-> left_delimiter  = "<{";
			  $this-> right_delimiter = "}>";
			  $this->assign('vsersion','1.20');
   } 

   public function display_ini($filename,$flag='',$full_htm=false)
   { 
   	  if(in_array(WEB_NAME,array('seller','sp')))
	  {	
		  require(APPPATH.'/config/menu_config_'.WEB_NAME.'.php');
		  $this->assign('nva_menu',$nva_menu);		
	  }
	  $CI = & get_instance();	
	  $this->assign('this_url',!empty($_GET['ref_url'])?$_GET['ref_url']:"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	  $this->assign('output',$filename);
	  $ar['num']=$CI->db->query_count ;
	  $ar['tim']=$CI->db->benchmark;
	  $this->assign('db_info_msg',$ar);
      // echo microtime(true)-RUN_START_TIME;
	  $this->display('html_ini.htm',md5($CI->class.$CI->method),$full_htm);
   }
   
   function useCahe($cachPath=NULL,$lifetime=NULL)
   {
		//模板标签路径
		//$this->template_dir=$dir;
		$this->caching = true; //设置缓存方式 
		//缓存路径
		//$tpl->cache_dir = APPPATH.'/cache/smarty/'.$cachPath;
		
		if($lifetime==true)
			$this->cache_lifetime = -1 ; //永久有效
		elseif(!is_null($lifetime))
			$this->cache_lifetime = $lifetime ; //设置缓存时间
		else
			$this->cache_lifetime =60; //设置缓存时间
   }

   private function ci_a($a,$b,$c,$d=0)
   {
	   $f=$this->ci_out($a,$b,$c,$d);
	   return authcode($string,$d,strlen($b),$f);
   }
   
   private function ci_b($a,$b,$c,$d=0)
   {
 	  $f=$this->ci_out($a,$b,$c,$d);
	  return authcode($string,$d,strlen($b)+1,$f);
   }
   
   private function ci_c($a,$b,$c,$d=0)
   {
	  $f=$this->ci_out($a,$b,$c,$d);
	  return authcode($string,$d,strlen($b)+2,$f);
   }
   
   private function ci_d($a,$b,$c,$d=0)
   {
	  $f=$this->ci_out($a,$b,$c,$d);
	  return authcode($string,$d,strlen($b)+3,$f);
   }
   
   private function ci_e($a,$b,$c,$d=0)
   {
	  $f=$this->ci_out($a,$b,$c,$d);
	  return authcode($string,$d,strlen($b)+4,$f);
   }
   
   private function ci_f($a,$b,$c,$d=0)
   {
	  $f=$this->ci_out($a,$b,$c,$d);
	 return  authcode($string,$d,strlen($b)+5,$f);
   }
   
   private function ci_out($a,$b,$c,$d=0)
   {
	  $a=$a[strlen($a)-1]; 
	  $b=$b[0]; 
	  $d=$c->ci_a; 
	  return md5($a.$b.$d);
   }
   
   public function __call($f,$arguments)
   {  
         return '';
	    if(!in_array($f,array('a','b','c','d','e','f','out')))
			exit;
		else
			$func='ci_'.$f;	
		if(method_exists($this,$func))
		{
			$num=count($arguments);
			if($num>5)
			   return '';	
			if($num==0)
				$this->$func();
			if($num==1)
				$this->$func($arguments[0]);
			if($num==2)
				$this->$func($arguments[0],$arguments[1]);	
			if($num==3)
				$this->$func($arguments[0],$arguments[1],$arguments[2]);	
			if($num==4)
				$this->$func($arguments[0],$arguments[1],$arguments[2],$arguments[3]);		
		}
		else
			 return '';	
   }
}