<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_image_model extends CI_Model
{
	//插入图片
	function insert_image($arr)
	{
		return $this->db->insert(tab_m('base_image'),$arr);
	}

	//获取图片列表
	function get_image_list($user_id=0)
	{

	
	}

}
?>