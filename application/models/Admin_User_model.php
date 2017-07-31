<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_User_model  extends CI_Model
{
	function is_login($time=60)
	{
		$uid=get_decode_cookie("user_id");
		if(!empty($uid))
		{
			set_encode_cookie("username",get_decode_cookie("username"),$time); 
			set_encode_cookie("user_id",get_decode_cookie("user_id"),$time);  
			set_encode_cookie("user_group_id",get_decode_cookie("group_id"),$time);  
			set_encode_cookie("user_type",get_decode_cookie("user_type"),$time); 
			return true; 
		}
		return false;
	}
		
	function login($user,$passwd)
	{
		
		$row=$this->get_user_one(array('user','id','group_id','password','type','status'),'',$user);
		if(!empty($row)&&md5($passwd)==$row['password']&&$row['status']==1)
		{
			set_encode_cookie("username",$row['user'],60); 
			set_encode_cookie("user_id",$row['id'],60);  
			set_encode_cookie("user_group_id",$row['group_id'],60);  
			set_encode_cookie("user_type",$row['type'],60);  
			return $row['id'];
		}
		else
	   		return false;
	}	
	
	function get_user($fetchFields=array(),$user_id='')
	{
		if(empty($user_id)||!is_numeric($user_id))
			return array();
			
		if(!is_array($fetchFields)||empty($fetchFields))	
			return array();
			
		$sql="select  `".implode('`,`',$fetchFields)."`  from  ".tab_m('admin')."  where id='$user_id'";
		$query=$this->db->query($sql);
	    return $query->row_array();//row()对象
	}
	
	//添加管理员
	function add_user($udata,$wdata=array())
	{
		if(empty($wdata)&&!empty($udata))
			return $this->db->insert(tab_m('admin'),$udata);
		elseif(!empty($udata)&&!empty($wdata))
			return $this->db->update(tab_m('admin'),$udata,$wdata);
	}
	
	//获取当前管理员字段内容
	function get_user_one($fetchFields=array(),$user_id='',$user='')
	{
		if(empty($user_id)&&empty($user))
			return '';
		if(!is_array($fetchFields)||empty($fetchFields))	
			return '';
		$sql="select  `".implode('`,`',$fetchFields)."`  from  ".tab_m('admin')."  where ".(!empty($user_id)?"id='$user_id'":"user='$user'");
		$query=$this->db->query($sql);
	    $row = $query->row_array();//row()对象
		return isset($row)?$row:'';
	}
	
	//获取管理员组列表
	function get_group_list($fetchFields=array())
	{
		if(!is_array($fetchFields)||empty($fetchFields))	
			return array();
		$row =$this->db->select($fetchFields)->from(tab_m('admin_group'))->get()->result_array();
		return !empty($row)?$row:array();
	}
	
	//获取单个组数据
	function get_group_one($fetchFields=array(),$id)
	{
		if(empty($id)||!is_numeric($id))
			return '';
		if(!is_array($fetchFields)||empty($fetchFields))	
			return '';
		$sql="select  `".implode('`,`',$fetchFields)."`  from  ".tab_m('admin_group')."  where group_id='$id'";
		$query=$this->db->query($sql);
	    $row = $query->row_array();//row()对象
		return isset($row)?$row:'';
	}
	
	//获取单个组数据
	function add_group($udata,$wdata=array())
	{
		if(empty($wdata)&&!empty($udata))
			return $this->db->insert(tab_m('admin_group'),$udata);
		elseif(!empty($udata)&&!empty($wdata))
			return $this->db->update(tab_m('admin_group'),$udata,$wdata);
	}
}

