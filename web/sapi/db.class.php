<?php
if(!isset($config['webpath']))
{
	header("location:404.php");
	die;
}
class dba {
	
	var $Link_ID;
	var $Query_ID;
	var $Record;
	var $Row;
	var $Auto_free   = 0;
	var $sql_flag=NULL;
	var $memcache_obj=NULL;
	var $is_cache=NULL;
	var $cache_valid=FALSE;
	var $serverid=88;

	function dba($h,$u,$p,$dbname,$port=NULL)
	{
		$port=empty($port)?"3306":$port;
		$this->Link_ID=mysql_connect("$h:$port",$u,$p) or die("Can not connect mysql server"); 
		if($this->version() > '4.1')
		{
			$serverset = "character_set_connection='utf8', character_set_results='utf8', character_set_client=binary";
			$serverset .= $this->version() > '5.0.1' ? ((empty($serverset) ? '' : ',').'sql_mode=\'\'') : '';
			$serverset && mysql_query("SET $serverset", $this->Link_ID);
			mysql_query("SET NAMES 'utf8'");
		}
		mysql_select_db($dbname,$this->Link_ID) or die("Can not select database");
	}

	function next_record()
	{
		$this->Record = @mysql_fetch_array($this->Query_ID,MYSQL_ASSOC);
		$this->Row += 1;
		$stat = is_array($this->Record);
		if (!$stat && $this->Auto_free)
		{
			mysql_free_result($this->Query_ID);
			$this->Query_ID = 0;
		}
		return $stat;
	}
	
	function fetchField($name)
	{
		if($this->Query_ID!="")
		{
			$re=mysql_fetch_array($this->Query_ID,MYSQL_ASSOC);
			return $re[$name];
		}
		else
			return NULL;
	}
	
	function num_rows()
	{
		if($this->Query_ID!="")
			return mysql_num_rows($this->Query_ID);
	}
	
	function f($Name)
	{
		return $this->Record[$Name];
	}
	
	function lastid()
	{
		return ($id = mysql_insert_id($this->Link_ID)) >= 0 ? $id : $this->result($this->query("SELECT last_insert_id()"), 0);
	}
	
	function version()
	{
		if(empty($this->version))
		{
			$this->version = mysql_get_server_info($this->Link_ID);
			return $this->version;
		}
	}
	function insert($tbname, $row)
	{
		$sqlfield=NULL;$sqlvalue=NULL;
		foreach ($row as $key=>$value)
		{
			$sqlfield .='`'.$key."`,";
			$sqlvalue .= "'".mysql_escape_string($value)."',";
		}
		$sql = "INSERT INTO `".$tbname."`(".substr($sqlfield, 0, -1).") VALUES (".substr($sqlvalue, 0, -1).")";   
		return $this->query($sql);
	}
	function row_update($tbname, $row, $where)
	{
		$sqlud='';
		foreach ($row as $key=>$value) {
			$sqlud .= "`".$key."`= $value,";
		}
		$sql = "UPDATE `".$tbname."` SET ".substr($sqlud, 0, -1)." WHERE ".$where;
		return $this->query($sql);
	}
	function num_fields()
	{
		if($this->Query_ID!="")
			return mysql_num_fields($this->Query_ID);
	}
	function fetch_row()
	{
		if($this->Query_ID!="")
			return mysql_fetch_row($this->Query_ID);
	}
	function close()
	{
		mysql_close($this->Link_ID);
	}
	
	//获取影响行数
	function get_row_up_num()
	{
		$this->Query_ID=mysql_query('SELECT ROW_COUNT() as num');
		$re=mysql_fetch_array($this->Query_ID,MYSQL_ASSOC);
		return $re['num']*1==0?false:true;
	}
	
	//---------------------------
	function fetchRow()
	{ 	
		if(!$this->is_cache)
		{
			$re=@mysql_fetch_array($this->Query_ID,MYSQL_ASSOC);
			if($this->cache_valid)
				memcache_set($this->memcache_obj, $this->sql_flag, $re,MEMCACHE_COMPRESSED);
			return $re;
		}
		else
		{
			return $this->is_cache;
		}
	}

	//----------------------------
	function query($sql,$upfate=false)
	{	
		global $config;
		$t1 = microtime(true);
		$sql=trim($sql);
		if(!empty($upfate))
			$sql.=' FOR UPDATE';//（排它锁）
			
		$sqlr=explode(" ",$sql);
		$type=strtolower(trim($sqlr[0]));

		$filename=$config['webpath']."../../application/cache/error_sql_log.php";
		if($type=='drop')
		{
			error_log("\n--------非法操作---".$type."------"
			         .var_export(debug_backtrace(),true)."---------".$sql.mysql_error()
					 ."\n\n[.... ".date("Y-m-d H:i:s")."........".$_SERVER["REQUEST_URI"]
					 ."................]\n\n","3",$filename); 
			return 0;
		}
		unset($sqlr,$ar,$amd5,$ar);
		$flag=$this->Query_ID=mysql_query($sql);
		
		if(!$flag)
		{
			if(file_exists($filename))
				$filesize=abs(filesize($filename));
			else
				error_log ("<?php if(!isset(\$_GET['show']))exit;?>","3",$filename); 
				
			if($filesize>2024*1024)
				unlink($filename);	
				
			error_log("\n--------error----".var_export(debug_backtrace(),true)."---------".$sql.mysql_error()
					 ."\n\n[.... ".date("Y-m-d H:i:s")."........".$_SERVER["REQUEST_URI"]
					 ."................]\n\n","3",$filename) ;  
			return 0;  	
		}
		
		
		/*
		$filename=$config['webpath']."../../application/cache/sql_min_1_log.php";
		if(file_exists($filename))
			$filesize=abs(filesize($filename));
		else
			error_log ("<?php if(!isset(\$_GET['show']))exit;?>","3",$filename) ; 
		if($filesize>1024*1024)
			unlink($filename);
			
		//if(microtime(true)-$t1>3)
		//{
			error_log("\n".$sql."\n","3",$filename) ;  
		//}
		*/	
			
		return $this->Query_ID;
	}
	
	//--------------------------
	function getRows()
	{ 
		if(!$this->is_cache)
		{	
			$re=array();
			if($this->Query_ID!="")
			{
				while($k=mysql_fetch_array($this->Query_ID,MYSQL_ASSOC))
				{
					$re[]=$k;
				}
			}
			if($this->cache_valid)
				memcache_set($this->memcache_obj, $this->sql_flag, $re,MEMCACHE_COMPRESSED);
			return $re;
		}
		else
			return $this->is_cache;
	}
	
	function begin_start()
	{
		$this->query('SET AUTOCOMMIT = 0');
		$this->query('BEGIN');//START TRANSACTION
	}
	
	function tran_commit()
	{
		$this->query('COMMIT');// 或 BEGIN
		$this->query('SET AUTOCOMMIT = 1');
	}
	
	function tran_roollback($str='服务器异常')
	{
		$this->query('ROLLBACK');// 或 BEGIN
		$this->query('SET AUTOCOMMIT = 1');
		get_apiencode('','{"code":"S2","msg":"'.$str.'"}',2);
	}
}

function tab_m($tab_m)
{
	return "dferp_".$tab_m;
}

function authcode($string, $operation = 'DECODE', $expiry = 0,$exkey='')
{
		$ckey_length = 4;
		$key = $exkey?md5($exkey):md5(md5(config_item('cookie_authkey').$_SERVER['HTTP_USER_AGENT']).config_item('baseurl').$_SERVER['SERVER_SIGNATURE']);
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	
		$cryptkey = $keya.md5($keya.$keyc);
		$key_length = strlen($cryptkey);
	
		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
		$string_length = strlen($string);
	
		$result = '';
		$box = range(0, 255);
	
		$rndkey = array();
		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}
	
		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
	
		for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
	
		if($operation == 'DECODE') {
			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			return $keyc.str_replace('=', '', base64_encode($result));
		}
	
	}

?>