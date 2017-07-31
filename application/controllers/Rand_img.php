<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rand_img extends MY_Controller {
    public function __construct(){  
        parent::__construct();  
	}
	
	function index()
	{
		$width=isset($_GET['w'])?$_GET['w']*1:0;  
		$height=isset($_GET['h'])?$_GET['h']*1:0; 
		$this->load->library('CI_Validationimg'); 
		if($width>0&&$height>0&&$this->ci_validationimg->check($width,$height))
		{
		   $this->ci_validationimg->validationvcode($width,$height,'4');
		   $this->ci_validationimg->outImg();
		   $this->load->library('session');
		   $_SESSION["authrand"] = $this->ci_validationimg->checkcode;
		}
		else
			exit;
	}
}