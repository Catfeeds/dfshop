<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_User_model extends CI_Model
{
	public function is_login($time=60)
	{
	    $CI = & get_instance();
		$module=ucfirst(WEB_NAME).'_User_model';
		$CI->load->model($module);
		return $CI->$module->is_login($time);
	}
}

