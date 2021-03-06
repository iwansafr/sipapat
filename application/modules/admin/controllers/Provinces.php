<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Provinces extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}

	public function index()
	{
		$this->load->view('index');
	}
	public function clear_list()
	{
		$this->load->view('provinces/index');
	}
	public function all()
	{
		output_json($this->db->get('provinces')->result_array());
	}
}