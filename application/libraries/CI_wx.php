<?php
/**
 * 微信SDK
 */
class CI_wx
{

  var $appid = "wxcf836d1a4e6f906a";
  var $appsecret = "f06a381f01318a5cd653d2d77f3e0df7";

  public $access_token;
  //构造函数，获取Access Token
  public function __construct($appid = NULL, $appsecret = NULL)
  {


    if($appid){
      $this->appid = $appid;
    }
	
    if($appsecret){
      $this->appsecret = $appsecret;
    }

    if(!file_exists(APPPATH.'/config/wx_config.php'))
    {

      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
      $res = $this->https_request($url);
      $result = json_decode($res, true);
      $this->access_token=$result["access_token"];
      $str="<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
      $str.=" \$config['lasttime']=' ".time()."'; \n";
      $str.=" \$config['access_token']='".$result["access_token"]."';\n";
      $this->write_file(APPPATH."config/wx_config.php",$str,'w+');

    }
    else
    {
        include APPPATH.'/config/wx_config.php';
        if($config['lasttime'] + 7200 > time())
        {
          $this->access_token=$config['access_token'];
        }
        else
        {
          $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
          $res = $this->https_request($url);
          $result = json_decode($res, true);
          $this->access_token=$result["access_token"];
          $str="<?php defined('BASEPATH') OR exit('No direct script access allowed'); \n";
          $str.=" \$config['lasttime']=' ".time()."'; \n";
          $str.=" \$config['access_token']='".$result["access_token"]."';\n";
          $this->write_file(APPPATH."config/wx_config.php",$str,'w+');

        }

    }


    
  }
  
  //刷新验证
  public function flash_token()
  {
	  require(APPPATH."/cache/wx_config.php");
	  $config['wx_access_token'];
	  $config['wx_lasttime'];
  }
  
  //获取用户基本信息
  public function get_user_info($openid)
  {

    $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".trim($this->access_token)."&openid=".$openid."&lang=zh_CN";
    $res = $this->https_request($url);
    return json_decode($res, true);
  }
  
  //https请求
  public function https_request($url, $data = null)
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
  }

  function write_file($path, $data, $mode = 'wb')
  {
    if ( ! $fp = @fopen($path, $mode))
    {
      return FALSE;
    }

    flock($fp, LOCK_EX);

    for ($result = $written = 0, $length = strlen($data); $written < $length; $written += $result)
    {
      if (($result = fwrite($fp, substr($data, $written))) === FALSE)
      {
        break;
      }
    }

    flock($fp, LOCK_UN);
    fclose($fp);

    return is_int($result);
  }



  
}