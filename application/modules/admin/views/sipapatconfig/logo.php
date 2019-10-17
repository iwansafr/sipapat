<?php defined('BASEPATH') OR exit('No direct script access allowed');

pr(base_url());
pr($_SERVER);
if(preg_match('~sipapat~', base_url()))
{
	$this->load->view('admin/config/logo');
}else{
	
}