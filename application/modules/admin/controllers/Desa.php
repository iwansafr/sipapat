<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('esg_model');
		$this->load->model('admin_model');
		$this->load->model('pengguna_model');
		$this->load->library('esg');
		$this->load->library('ZEA/zea');
		$this->esg_model->init();
	}
	public function index()
	{
		$this->load->view('index');
	}

	public function edit()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->load->view('index',['pengguna'=>$pengguna]);
	}

	public function detail($id = 0)
	{
		$this->esg_model->set_nav_title('Detail Desa');
		$this->load->view('index', ['id'=>$id]);
	}

	public function list()
	{
		$pengguna = $this->pengguna_model->get_pengguna();
		$this->load->view('index',['pengguna'=>$pengguna]);
	}

	public function clear_list()
	{
		$this->load->view('desa/list');
	}
}