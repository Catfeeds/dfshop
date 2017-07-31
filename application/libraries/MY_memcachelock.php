<?php
defined('APPPATH') or die('Access restricted!'); 
/*
cmd.exe以管理员 
windows
5>cd C:\memcached（回车） 

6>memcached -d start(回车)可以关闭此cmd窗口。 

此时可以使用新配置的memcache服务器了。 


上述方法虽然解决了修改默认配置的问题，但是始终会有一个cmd窗口不可以关闭，否则就回到11211端口的默认配置。 

更好的解决方案是通过修改服务的注册表配置： 

1>开始>运行：regedit(回车) 

2>在注册表中找到：HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Services\memcached Server 

3>默认的ImagePath键的值是："c:\memcached\memcached.exe" -d runservice，改为："c:\memcached\memcached.exe" -d runservice -m 20 -p 11211 -l 127.0.0.1（确定，关闭注册表） 

*/
class  MY_memcachelock
{
	public $memcache='';
    public $tm;
	public $lock_name;
	public $tag_lock;
    public function __construct()
	{ 
	    @include(APPPATH . 'config/config.php'); 
		if(empty($config['cookie_prefix_tag']))
			die;
		$this->tag_lock=$config['cookie_prefix_tag']; //memache 前缀
		$this->memcache='';
	}
	
	public function get_memcache()
	{
		if(!empty($this->tm))
			$this->tm    = 30;	
		$de=@memcache_connect('127.0.0.1', 11211);
		if(empty($de))
		{
			echo '服务繁忙';
			die;
		}
		return $de;
	}
	
	
	//刷新锁定时间
	public function flush_lock($lock_name='')
	{
		if(empty($this->memcache))
			$this->memcache=$this->get_memcache();
		$this->lock_name=empty($lock_name)?$this->lock_name:$lock_name;
		$f=md5($this->lock_name.$this->tag_lock);
		@memcache_set($this->memcache,$f,1,0,$this->tm); 
	}
	
	//锁定
	public function lock($lock_name='',$times='')
	{
		$times*=1;
		if(!empty($times)&&$times>30)
			$this->tm    = $times;	
		if(empty($this->memcache))
			$this->memcache=$this->get_memcache();
		$this->lock_name=empty($lock_name)?$this->lock_name:$lock_name;
		$f=md5($this->lock_name.$this->tag_lock);
		$num=0;
		//过期时间30秒
		if(@memcache_add($this->memcache,$f,1, FALSE,$this->tm)===true)
			$flag=true;
		else
			$flag=false;
		return $flag;
	}
	
	//解锁  $times 延迟时间 
	public function unlock($lock_name='',$times=0)
	{
		if(empty($this->memcache))
			$this->memcache=$this->get_memcache();
		$flag=false;	
		$this->lock_name=empty($lock_name)?$this->lock_name:$lock_name;
		$f=md5($this->lock_name.$this->tag_lock);
		if(@memcache_delete($this->memcache,$f,$times))
			$flag=true;
		return $flag;	
	}
	
	//查询
	public function get($lock_name='')
	{
		if(empty($this->memcache))
			$this->memcache=$this->get_memcache();
		$this->lock_name=empty($lock_name)?$this->lock_name:$lock_name;
		$f=md5($this->lock_name.$this->tag_lock);	
		$de=@memcache_get($this->memcache,$f); 
		return  $de;	
	}	
	
	//查询
	public function close()
	{
		if(!empty($this->memcache))
		{
			memcache_close($this->memcache);
			$this->memcache='';
		}
	}	
}


?>