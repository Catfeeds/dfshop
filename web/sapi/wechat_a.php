<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_USER_ERROR|E_USER_WARNING);//
header('Content-Type: text/html; charset=utf-8');
if(@function_exists('date_default_timezone_set'))
    @date_default_timezone_set('Asia/Shanghai');

$config['webpath']=dirname(__FILE__)."/";

include '../../application/libraries/CI_wx.php';
include './db.class.php';


$dba=new dba('127.0.0.1','root','123456','dfshop','3306');
$wx=new CI_wx();

if($RX_TYPE=='text')
{
    $keyword = trim($postObj->Content);
    $sql="SELECT `context_msg`,`pic_group_id` from ".tab_m('wx_msg_auto')." WHERE `keyword`=".$keyword;
    $dba->query($sql);
    $dba->fetchField('context_msg');




    $sql="SELECT `context_msg`,`pic_group_id` from dfshop_wx_msg_auto WHERE `keyword`='$keyword'";
    $this->db->query($sql);
    $back_msg=$this->db->fetch_row();
    if(empty($back_msg))
    {
        //模糊搜索


    }
    else
    {
        //精准搜索
        if($back_msg['pic_group_id']!=0)
        {
            //说明图文消息  先放下
        }
        else
        {
            //说明是文本消息  直接返回
            $msg=$back_msg['context_msg'];
            $msgType = "text";
            $textTpl = $this->get_temp();
            $contentStr=$msg;
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;

        }
    }
    
}