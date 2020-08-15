<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Platform extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
	}
	public function index()
	{
		$this->load->view('platform/index');
	}
}