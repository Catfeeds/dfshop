<?php
defined('APPPATH') or die('Access restricted!'); 
$CI = & get_instance();
$CI->load->library('Form_validation');
class MY_Form_validation extends CI_Form_validation{  
    public function __construct(){  
        parent::__construct();
	}
	
}