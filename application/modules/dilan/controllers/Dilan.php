<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dilan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ZEA/zea');
		$this->load->helper('content');
		$this->load->library('esg');
	}
	
	public function index()
	{
		$this->load->view('index');
	}

	public function config()
	{
		$this->load->view('index');
	}
}