<?php
defined('APPPATH') or die('Access restricted!'); 
require(APPPATH . 'libraries/phpmailer/class.phpmailer.php'); 
class CI_email
{
	function get_PHPMailer()
	{
		return new PHPMailer();
	}
	
	/*
		$email  收件邮箱
		$name   发件人姓名
		$title  发件标题
		$con    发件内容
	*/
	function send_mail($email,$name,$title,$con,$reply=NULL)
	{	
		include(APPPATH .'/cache/email_setting.php');
		if( $config['is_open']==0)
			return NULL;//邮件功能关闭
		else
		{
			$mail_config=$config;
			if(!empty($mail_config["type"])==2)
			{	
				$mail=json_decode($mail_config['email'],true);
				$t=count($mail);
				if(empty($t))
					return NULL;

				$get_index=rand(0,$t-1);
				$m_smtp=$mail[$get_index]['SMTP_address'];
				$from=$m_email=$mail[$get_index]['email_address'];
				$m_emailPass=$mail[$get_index]['email_pass'];

				if(empty($reply))
					$reply=$from;

				$mail = $this->get_PHPMailer();
				$mail->IsSMTP();                        
				$mail->Host = $m_smtp;  	
				$sm=explode(":",$m_smtp);

				if(count($sm)>=2)
				{
					$mail->Host = $sm[0];
					$mail->Port = $sm[1];
				}  

				$mail->SMTPAuth = true;                
				$mail->Username = $m_email;               
				$mail->Password = $m_emailPass;          
				$mail->From     = !empty($from)?$from:$m_email;
				$mail->FromName = config_item('company'); 
				$mail->FromEmail=$reply;
				$mail->AddReplyTo($reply,config_item('company'));//回复地址
				$mail->WordWrap = 50;           
				$mail->AddAddress($email,$name);
				$mail->IsHTML(true);                
				$mail->CharSet="utf-8";
				$mail->Subject =$title; 
				$mail->Body =$con;
				$re=$mail->send();
				return $re;
			}
			else
			{
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
				$headers .= 'From: '.$reply.'<'.config_item('company').'>' . "\r\n";
				$re=mail($email,$title,$con,$headers);
				return $re;
			}
		}
	}
}

?>