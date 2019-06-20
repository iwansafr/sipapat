<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Chart extends CI_Controller
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
		$data = file_get_contents(base_url('api/pengumuman'));
		$data = !empty($data) ? json_decode($data,1) : [];
		$this->load->view('index', ['data'=>$data]);
	}
}