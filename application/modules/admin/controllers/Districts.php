<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Districts extends CI_Controller
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

	public function list($id = 0)
	{
		$this->load->view('index',['reg_id'=>@intval($id)]);
	}
	public function clear_list($id = 0)
	{
		$this->load->view('districts/list',['reg_id'=>@intval($id)]);
	}

	public function all()
	{
		output_json($this->db->get('districts')->result_array());
	}
}